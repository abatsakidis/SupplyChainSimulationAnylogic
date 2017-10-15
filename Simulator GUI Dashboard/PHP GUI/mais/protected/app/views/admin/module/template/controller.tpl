<?php
class {controller}Controller extends BaseController {

	protected $layout = "layouts.main";
	protected $data = array();	
	public $module = '{class}';
	static $per_page	= '10';
	
	public function __construct() {
		parent::__construct();
		$this->beforeFilter('csrf', array('on'=>'post'));
		$this->model = new {controller}();
		$this->info = $this->model->makeInfo( $this->module);
		$this->access = $this->model->validAccess($this->info['id']);
	
		$this->data = array(
			'pageTitle'	=> 	$this->info['title'],
			'pageNote'	=>  $this->info['note'],
			'pageModule'=> '{class}',
			'trackUri' 	=> $this->trackUriSegmented()	
		);
			
				
	} 

	
	public function getIndex()
	{
		if($this->access['is_view'] ==0) 
			return Redirect::to('')
				->with('message', SiteHelpers::alert('error',Lang::get('core.note_restric')));
				
		// Filter sort and order for query 
		$sort = (!is_null(Input::get('sort')) ? Input::get('sort') : $this->info['setting']['orderby']); 
		$order = (!is_null(Input::get('order')) ? Input::get('order') : $this->info['setting']['ordertype']);
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
			'limit'		=> (!is_null(Input::get('rows')) ? filter_var(Input::get('rows'),FILTER_VALIDATE_INT) : $this->info['setting']['perpage'] ) ,
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
		$this->data['tableForm'] 	= $this->info['config']['forms'];
		$this->data['colspan'] 		= SiteHelpers::viewColSpan($this->info['config']['grid']);		
		// Group users permission
		$this->data['access']		= $this->access;
		// Detail from master if any
		$this->data['masterdetail']  = $this->masterDetailParam(); 
		$this->data['details']		= $master['masterView'];
		// Master detail link if any 
		$this->data['subgrid']	= (isset($this->info['config']['subgrid']) ? $this->info['config']['subgrid'] : array()); 
		// Render into template
		$this->layout->nest('content','{class}.index',$this->data)
						->with('menus', SiteHelpers::menus());
	}		
	

	function getAdd( $id = null)
	{
	
		if($id =='')
		{
			if($this->access['is_add'] ==0 )
			return Redirect::to('')->with('message', SiteHelpers::alert('error',Lang::get('core.note_restric')));
		}	
		
		if($id !='')
		{
			if($this->access['is_edit'] ==0 )
			return Redirect::to('')->with('message', SiteHelpers::alert('error',Lang::get('core.note_restric')));
		}				
			
		$id = ($id == null ? '' : SiteHelpers::encryptID($id,true)) ;
		
		$row = $this->model->find($id);
		if($row)
		{
			$this->data['row'] =  $row;
		} else {
			$this->data['row'] = $this->model->getColumnTable('{table}'); 
		}
		/* Master detail lock key and value */
		if(!is_null(Input::get('md')) && Input::get('md') !='')
		{
			$filters = explode(" ", Input::get('md') );
			$this->data['row'][$filters[3]] = SiteHelpers::encryptID($filters[4],true); 	
		}
		/* End Master detail lock key and value */
		$this->data['masterdetail']  = $this->masterDetailParam(); 
		$this->data['filtermd'] = str_replace(" ","+",Input::get('md')); 		
		$this->data['id'] = $id;
		$this->layout->nest('content','{class}.form',$this->data)->with('menus', $this->menus );	
	}
	
	
	public function getExport( $t = 'excel')
	{
		$info 		= $this->model->makeInfo( $this->module);
		$master  = $this->buildMasterDetail(); 
		$params = array(
			'params'	=> $master['masterFilter']
		);		
		$results 	= $this->model->getRows( $params );
		$fields		= $info['config']['grid'];
		$rows		= $results['rows'];
		$content 	= array(
						'fields' => $fields,
						'rows' => $rows,
						'title' => $this->data['pageTitle'],
					);
		
		if($t == 'word')
		{			
			 return View::make('admin.module.utility.word',$content);
			 
		} else if($t == 'csv') {		
		 
			return View::make('admin.module.utility.csv',$content);
			
		} else if ($t == 'print') {
		
			 return View::make('admin.module.utility.print',$content);
			 
		} else  {
		
			 return View::make('admin.module.utility.excel',$content);
		}	
	}
		
	function getShow( $id = null)
	{
	
		if($this->access['is_detail'] ==0) 
			return Redirect::to('')
				->with('message', SiteHelpers::alert('error',Lang::get('core.note_restric')));
					
		$ids = (is_numeric($id) ? $id : SiteHelpers::encryptID($id,true)  );
		$row = $this->model->getRow($ids);
		if($row)
		{
			$this->data['row'] =  $row;
		} else {
			$this->data['row'] = $this->model->getColumnTable('{table}'); 
		}
		$this->data['masterdetail']  = $this->masterDetailParam(); 
		$this->data['id'] = $id;
		$this->data['access']		= $this->access;
		$this->layout->nest('content','{class}.view',$this->data)->with('menus', $this->menus );	
	}	
	
	function postCopy()
	{
		
	    foreach(DB::select("SHOW COLUMNS FROM {table}") as $column)
        {
			if( $column->Field != '{key}')
				$columns[] = $column->Field;
        }
		$toCopy = implode(",",Input::get('id'));
		
				
		$sql = "INSERT INTO {table} (".implode(",", $columns).") ";
		$sql .= " SELECT ".implode(",", $columns)." FROM {table} WHERE {key} IN (".$toCopy.")";
		DB::insert($sql);
		return Redirect::to('{class}')->with('message', SiteHelpers::alert('success',Lang::get('core.note_success')));		
	}	
		
	
	function postSave( $id =0)
	{
		$trackUri = $this->data['trackUri'];
		$rules = $this->validateForm();
		$validator = Validator::make(Input::all(), $rules);	
		if ($validator->passes()) {
			$data = $this->validatePost('{table}');
			$ID = $this->model->insertRow($data , Input::get('{key}'));
			// Input logs
			if( Input::get('{key}') =='')
			{
				$this->inputLogs("New Entry row with ID : $ID  , Has Been Save Successfull");
				$id = SiteHelpers::encryptID($ID);
			} else {
				$this->inputLogs(" ID : $ID  , Has Been Changed Successfull");
			}
			// Redirect after save	
			$md = str_replace(" ","+",Input::get('md'));
			$redirect = (!is_null(Input::get('apply')) ? '{class}/add/'.$id.'?md='.$md.$trackUri :  '{class}?md='.$md.$trackUri );
			return Redirect::to($redirect)->with('message', SiteHelpers::alert('success',Lang::get('core.note_success')));
		} else {
			return Redirect::to('{class}/add/'.$id.'?md='.$md)->with('message', SiteHelpers::alert('error',Lang::get('core.note_error')))
			->withErrors($validator)->withInput();
		}	
	
	}
	
	public function postDestroy()
	{
		
		if($this->access['is_remove'] ==0) 
			return Redirect::to('')
				->with('message', SiteHelpers::alert('error',Lang::get('core.note_restric')));		
		// delete multipe rows 
		$this->model->destroy(Input::get('id'));
		$this->inputLogs("ID : ".implode(",",Input::get('id'))."  , Has Been Removed Successfull");
		// redirect
		Session::flash('message', SiteHelpers::alert('success',Lang::get('core.note_success_delete')));
		return Redirect::to('{class}?md='.Input::get('md'));
	}			
		
}