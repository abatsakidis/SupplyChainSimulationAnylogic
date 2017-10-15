<?php
class MenuController extends BaseController {

	protected $layout = "layouts.main";
	protected $data = array();	
	public $module = 'menu';
	static $per_page	= '5';
	
	public function __construct() {
		parent::__construct();
		$this->beforeFilter('csrf', array('on'=>'post'));
		$this->model = new Menu();
		$this->info = $this->model->makeInfo( $this->module);
		$this->access = $this->model->validAccess($this->info['id']);
	
		$this->data = array(
			'pageTitle'	=> 	$this->info['title'],
			'pageNote'	=>  $this->info['note'],
		);
			
				
	} 
	
	public function getIndex( $id = null )
	{
		//$id = ($id == null ? '' : SiteHelpers::encryptID($id,true)) ;
		
		$pos = (!is_null(Input::get('pos')) ? Input::get('pos') : 'top' );
		$row = $this->model->find($id);
		if($row)
		{
			$this->data['row'] =  $row;
		} else {
			$this->data['row'] = $this->model->getColumnTable('tb_menu'); 
		}
		$this->data['menus']		= SiteHelpers::menus( $pos ,'all');
		$this->data['modules'] 		= DB::table('tb_module')->where('module_type','!=','core')->get();
		$this->data['groups'] = DB::select(" SELECT * FROM tb_groups ");
		$this->data['pages'] = DB::select(" SELECT * FROM tb_pages ");
		$this->data['active'] = $pos;	
		$this->layout->nest('content','menu.index',$this->data)
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
			$this->data['row'] = $this->model->getColumnTable('tb_menu'); 
		}

		$this->layout->nest('content','menu.form',$this->data)->with('menus', $this->menus );	
	}
	
	function getShow( $id = null)
	{
	
		if($this->access['is_detail'] ==0) 
			return Redirect::to('')
				->with('message', SiteHelpers::alert('error',' Your are not allowed to access the page '));
					
		$ids = ($id == null ? '' : SiteHelpers::encryptID($id,true)) ;
		$row = $this->model->find($ids);
		if($row)
		{
			$this->data['row'] =  $row;
		} else {
			$this->data['row'] = $this->model->getColumnTable('tb_menu'); 
		}
		$this->data['id'] = $id;
		$this->data['access']		= $this->access;
		$this->layout->nest('content','menu.view',$this->data)->with('menus', $this->menus );	
	}	

	function postSaveorder( $id =0)
	{

		$rules = array(
			'reorder'	=> 'required'
		);
		$validator = Validator::make(Input::all(), $rules);	
		if ($validator->passes()) {
			$menus = json_decode(Input::get('reorder'),true);
			$child = array();
			$a=0;
			foreach($menus as $m)
			{			
				if(isset($m['children']))
				{
					$b=0;
					foreach($m['children'] as $l)					
					{
						if(isset($l['children']))
						{
							$c=0;
							foreach($l['children'] as $l2)
							{
								$level3[] = $l2['id'];
								DB::table('tb_menu')->where('menu_id','=',$l2['id'])
									->update(array('parent_id'=> $l['id'],'ordering'=>$c));
								$c++;	
							}		
						}
						DB::table('tb_menu')->where('menu_id','=', $l['id'])
							->update(array('parent_id'=> $m['id'],'ordering'=>$b));	
						$b++;
					}							
				}
				DB::table('tb_menu')->where('menu_id','=', $m['id'])
					->update(array('parent_id'=>'0','ordering'=>$a));
				$a++;		
			}

			return Redirect::to('menu')->with('message', SiteHelpers::alert('success','Data Has Been Save Successfull'));
		} else {
			return Redirect::to('menu')->with('message', SiteHelpers::alert('error','The following errors occurred'));
		}	

	
	}
	
	function postSave( $id =0)
	{

		$rules = array(
			'menu_name'	=> 'required',	
			'active'	=> 'required',	
			'menu_type'	=> 'required',
			'position'	=> 'required',	
		);
		$validator = Validator::make(Input::all(), $rules);	
		if ($validator->passes()) {
			$pos = Input::get('position');	
			$data = $this->validatePost('tb_menu');
			$arr = array();
			$groups = DB::table('tb_groups')->get();
			foreach($groups as $g)
			{
				$arr[$g->group_id] = (isset($_POST['groups'][$g->group_id]) ? "1" : "0" );	
			}
			$data['access_data'] = json_encode($arr);		
			$data['allow_guest'] = Input::get('allow_guest');
			$this->model->insertRow($data , Input::get('menu_id'));
			
			return Redirect::to('menu?pos='.$pos)->with('message', SiteHelpers::alert('success','Data Has Been Save Successfull'));
			
		} else {
			return Redirect::to('menu')->with('message', SiteHelpers::alert('error','The following errors occurred'))
			->withErrors($validator)->withInput();
		}	
	
	}
	
	public function getDestroy($id)
	{
		// delete multipe rows 
		
		$menus = DB::table('tb_menu')->where('parent_id','=',$id)->get();
		foreach($menus as $row)
		{
			$this->model->destroy($row->menu_id);
		}
		
		$this->model->destroy($id);
		// redirect
		Session::flash('message', SiteHelpers::alert('success','Successfully deleted row!'));
		return Redirect::to('menu');
	}			
		
}
