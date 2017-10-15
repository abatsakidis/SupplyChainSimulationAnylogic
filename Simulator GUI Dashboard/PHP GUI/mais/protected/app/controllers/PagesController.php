<?php
class PagesController extends BaseController {

	protected $layout = "layouts.main";
	protected $data = array();	
	public $module = 'pages';
	static $per_page	= '10';
	
	public function __construct() {
		parent::__construct();
		$this->beforeFilter('csrf', array('on'=>'post'));
		$this->model = new Pages();
		$this->info = $this->model->makeInfo( $this->module);
		$this->access = $this->model->validAccess($this->info['id']);
	
		$this->data = array(
			'pageTitle'	=> 	$this->info['title'],
			'pageNote'	=>  $this->info['note'],
			'pageModule'	=> 'pages'
		);
			
				
	} 

	
	public function getIndex()
	{
		if($this->access['is_view'] ==0) 
			return Redirect::to('')
				->with('message', SiteHelpers::alert('error',Lang::get('core.note_restric')));
				
		// Filter sort and order for query 
		$sort = (!is_null(Input::get('sort')) ? Input::get('sort') : 'pageID'); 
		$order = (!is_null(Input::get('order')) ? Input::get('order') : 'asc');
		// End Filter sort and order for query 
		// Filter Search for query		
		$filter = (!is_null(Input::get('search')) ? $this->buildSearch() : '');
		// End Filter Search for query 
		
		// Take param master detail if any
		$master  = $this->buildMasterDetail(); 
		// append to current $filter
		$filter .=  $master['masterFilter'];
	
		
		$page = Input::get('page', 1);
		$params = array(
			'page'		=> $page ,
			'limit'		=> (!is_null(Input::get('rows')) ? filter_var(Input::get('rows'),FILTER_VALIDATE_INT) : static::$per_page ) ,
			'sort'		=> $sort ,
			'order'		=> $order,
			'params'	=> $filter,
			'global'	=> (isset($this->access['is_global']) ? $this->access['is_global'] : 0 )
		);
		// Get Query 
		$results = $this->model->getRows( $params );		
		
		// Build pagination setting
		$page = $page >= 1 && filter_var($page, FILTER_VALIDATE_INT) !== false ? $page : 1;	
		$pagination = Paginator::make($results['rows'], $results['total'],$params['limit']);		
		
		
		$this->data['rowData']		= $results['rows'];
		// Build Pagination 
		$this->data['pagination']	= $pagination;
		// Build pager number and append current param GET
		$this->data['pager'] 		= $this->injectPaginate();	
		// Row grid Number 
		$this->data['i']			= ($page * $params['limit'])- $params['limit']; 
		// Grid Configuration 
		$this->data['tableGrid'] 	= $this->info['config']['grid'];
		// Group users permission
		$this->data['access']		= $this->access;
		// Detail from master if any
		$this->data['details']		= $master['masterView'];
		// Master detail link if any 
		$this->data['subgrid']	= (isset($this->info['config']['subgrid']) ? $this->info['config']['subgrid'] : array()); 
		// Render into template
		$this->layout->nest('content','pages.index',$this->data)
						->with('menus', SiteHelpers::menus());
	}		
	

	function getAdd( $id = null)
	{
	
		if($this->access['is_view'] ==0) 
			return Redirect::to('')
				->with('message', SiteHelpers::alert('error',' Your are not allowed to access the page '));
			
		$id = ($id == null ? '' : SiteHelpers::encryptID($id,true)) ;
		
		$row = $this->model->find($id);
		if($row)
		{
			$this->data['row'] =  $row;
		} else {
			$this->data['row'] = $this->model->getColumnTable('tb_pages'); 
		}
		
		if($id =='') 
		{ 
			$this->data['content'] = '';
		} else {
			
			if($row->pageID ==1) {
				$filename = public_path() ."protected/app/views/pages/template/home.blade.php";
				$this->data['content'] = file_get_contents($filename);
			
			} else {
			
				$filename = public_path() ."protected/app/views/pages/template/".$row->filename.".blade.php";
				if(file_exists($filename))
				{
					$this->data['content'] = file_get_contents($filename);
				} else {
					$this->data['content'] = '';
				} 	
			}	
		}

		if($this->data['row']['access'] !='')
		{
			$access = json_decode($this->data['row']['access'],true)	;	
		} else {
			$access = array();
		}
		$groups = Groups::all();
		$group = array();
		foreach($groups as $g) {
			$group_id = $g['group_id'];			
			$a = (isset($access[$group_id]) && $access[$group_id] ==1 ? 1 : 0);		
			$group[] = array('id'=>$g->group_id ,'name'=>$g->name,'access'=> $a); 			
		}		

		$this->data['groups'] = $group;	
		
		
		$this->data['id'] = $id;
		$this->layout->nest('content','pages.form',$this->data)->with('menus', $this->menus );	
	}
	
	function getShow( $id = null)
	{
	
		if($this->access['is_detail'] ==0) 
			return Redirect::to('')
				->with('message', SiteHelpers::alert('error',' Your are not allowed to access the page '));
					
		$ids = ($id == null ? '' : SiteHelpers::encryptID($id,true)) ;
		$row = $this->model->getRow($ids);
		if($row)
		{
			$this->data['row'] =  $row;
		} else {
			$this->data['row'] = $this->model->getColumnTable('tb_pages'); 
		}
		
		$this->data['id'] = $id;
		$this->data['access']		= $this->access;
		$this->layout->nest('content','pages.view',$this->data)->with('menus', $this->menus );	
	}	
	
	function postSave( $id =0)
	{

		$rules = array(
				'title'=>'required',
				'alias'=>'required|alpha_dash',
				'filename'=>'required|alpha',
				'status'=>'required',

				
		);
		$validator = Validator::make(Input::all(), $rules);	
		if ($validator->passes()) {
			$content = 	Input::get('content');
			$data = $this->validatePost('tb_pages');
			
				if(Input::get('pageID') ==1)
				{	
					$filename = public_path() ."protected/app/views/pages/template/home.blade.php";
				} else {
					$filename = public_path() ."protected/app/views/pages/template/".Input::get('filename').".blade.php";
				}	
				$fp=fopen($filename,"w+"); 				
				fwrite($fp,$content); 
				fclose($fp);	
				
			 $groups = Groups::all();
			 $access = array();				
			 foreach($groups as $group) {		 	
				$access[$group->group_id]	= (isset($_POST['group_id'][$group->group_id]) ? '1' : '0');
			 }
		 						
			$data['access'] = json_encode($access);
			
			$data['allow_guest'] = Input::get('allow_guest');
			$data['template'] = Input::get('template');	
			$this->model->insertRow($data , Input::get('pageID'));
			self::createRouters();
			return Redirect::to('pages')->with('message', SiteHelpers::alert('success','Data Has Been Save Successfull'));
		} else {
			return Redirect::to('pages/add/'.$id)->with('message', SiteHelpers::alert('error','The following errors occurred'))
			->withErrors($validator)->withInput();
		}	
	
	}
	
	public function postDestroy()
	{
		
		if($this->access['is_remove'] ==0) 
			return Redirect::to('')
				->with('message', SiteHelpers::alert('error',' Your are not allowed to access the page '));	
		
		$ids = Input::get('id')	;	
		for($i=0; $i<count($ids);$i++)
		{
			$row = Pages::find( $ids[$i]);	
			$filename = public_path() ."protected/app/views/pages/template/".$row->filename.".blade.php";
			if(file_exists($filename) &&$row->filename !='')
			{
				unlink( public_path() ."protected/app/views/pages/template/".$row->filename.".blade.php");
			}				
		} 
				
					
		// delete multipe rows 
		$data = $this->model->destroy(Input::get('id'));
		self::createRouters();
		Session::flash('message', SiteHelpers::alert('success','Successfully deleted row!'));
		return Redirect::to('pages');
	}	

	function createRouters()
	{
		$rows = DB::table('tb_pages')->where('pageID','!=','1')->get();
		$val  =	"<?php \n"; 
		foreach($rows as $row)
		{
			
			$slug = $row->alias;
			$val .= "Route::get('{$slug}', 'HomeController@index');\n";		
		}
		$val .= 	"?>";
		$filename = app_path().'/pageroutes.php';
		$fp=fopen($filename,"w+"); 
		fwrite($fp,$val); 
		fclose($fp);	
		return true;	
		
	}			
		
}