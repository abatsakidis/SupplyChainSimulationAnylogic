<?php
class UsersController extends BaseController {

	protected $layout = "layouts.main";
	protected $data = array();	
	public $module = 'users';
	static $per_page	= '10';
	
	public function __construct() {
		parent::__construct();
		$this->beforeFilter('csrf', array('on'=>'post'));
		$this->model = new Users();
		$this->info = $this->model->makeInfo( $this->module);
		$this->access = $this->model->validAccess($this->info['id']);
	
		$this->data = array(
			'pageTitle'	=> 	$this->info['title'],
			'pageNote'	=>  $this->info['note'],
			'pageModule'	=> 'users'
		);
			
				
	} 
	
	public function getIndex()
	{
		if($this->access['is_view'] ==0) 
			return Redirect::to('')
				->with('message', SiteHelpers::alert('error',' Your are not allowed to access the page '));
				
		// Filter sort and order for query 
		$sort = (!is_null(Input::get('sort')) ? Input::get('sort') : 'id'); 
		$order = (!is_null(Input::get('order')) ? Input::get('order') : 'asc');
		// End Filter sort and order for query 
		// Filter Search for query 
		$filter = (!is_null(Input::get('search')) ? $this->buildSearch() : '');
		// End Filter Search for query 
		$filter .= " AND id !='1' AND tb_groups.level > ".Session::get('gid')."";
		
		$page = Input::get('page', 1);
		$params = array(
			'page'		=> $page ,
			'limit'		=> (!is_null(Input::get('rows')) ? filter_var(Input::get('rows'),FILTER_VALIDATE_INT) : static::$per_page ) ,
			'sort'		=> $sort ,
			'order'		=> $order,
			'params'	=> $filter
		);
		// Get Query 
		$results = $this->model->getRows( $params );
		
		
		
		$page = $page >= 1 && filter_var($page, FILTER_VALIDATE_INT) !== false ? $page : 1;	
		$pagination = Paginator::make($results['rows'], $results['total'],$params['limit']);		
		
		
		$this->data['rowData']		= $results['rows'];
		$this->data['pagination']	= $pagination;
		$this->data['pager'] 		= $this->injectPaginate();	
		$this->data['i']			= ($page * $params['limit'])- $params['limit']; 
		$this->data['tableGrid'] 	= $this->info['config']['grid'];
		$this->data['tableForm'] 	= $this->info['config']['forms'];
		$this->data['colspan'] 		= SiteHelpers::viewColSpan($this->info['config']['grid']);	
		$this->data['access']		= $this->access;
		
		$this->layout->nest('content','users.index',$this->data)
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
			$this->data['row'] = $this->model->getColumnTable('tb_users'); 
		}
		$res = DB::table('tb_groups')->where('group_id',Session::get('gid'))->get();
		$res = $res[0];
		$this->data['level'] = $res->level;		
		$this->data['id'] = $id;
		$this->layout->nest('content','users.form',$this->data)->with('menus', $this->menus );	
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
			$this->data['row'] = $this->model->getColumnTable('tb_users'); 
		}
		$this->data['id'] = $id;
		$this->data['access']		= $this->access;
		$this->layout->nest('content','users.view',$this->data)->with('menus', $this->menus );	
	}	
	
	function postSave( $id =0)
	{

		$rules = array(
			'active'		=> 'required',
			'first_name'	=> 'required|alpha',
			'first_name'	=> 'required|alpha',				
		);
		if(Input::get('id') =='')
		{
			$rules['password'] 				= 'required|alpha_num|between:6,12';
			$rules['password_confirmation'] = 'required|alpha_num|between:6,12';
			$rules['email'] 				= 'required|email|unique:tb_users';
			$rules['username'] 				= 'required|alpha_num||min:2|unique:tb_users';
			
		} else {
			if(Input::get('password') !='')
			{
				$rules['password'] 				='required|alpha_num|between:6,12';
				$rules['password_confirmation'] ='required|alpha_num|between:6,12';			
			}
		}
		
		$validator = Validator::make(Input::all(), $rules);	
		if ($validator->passes()) {
			$data = $this->validatePost('tb_users');
			if(Input::get('id') =='')
			{
				$data['password'] = Hash::make(Input::get('password'));
			} else {
				if(Input::get('password') !='')
				{
					$data['password'] = Hash::make(Input::get('password'));
				}
			}
			
			$this->model->insertRow($data , Input::get('id'));

			return Redirect::to('users')->with('message', SiteHelpers::alert('success','Data Has Been Save Successfull'));
		} else {
			return Redirect::to('users/add/'.$id)->with('message', SiteHelpers::alert('error','The following errors occurred'))
			->withErrors($validator)->withInput();
		}	
	
	}
	
	public function postDestroy()
	{
		// delete multipe rows 
		$data = $this->model->destroy(Input::get('id'));
		// redirect
		Session::flash('message', SiteHelpers::alert('success','Successfully deleted row!'));
		return Redirect::to('users');
	}			
		
}