<?php
class BlogadminController extends BaseController {

	protected $layout = "layouts.main";
	protected $data = array();	
	public $module = 'blogadmin';
	static $per_page	= '10';
	
	public function __construct() {
		parent::__construct();
		$this->beforeFilter('csrf', array('on'=>'post'));
		$this->model = new Blogadmin();
		$this->info = $this->model->makeInfo( $this->module);
		$this->access = $this->model->validAccess($this->info['id']);
	
		$this->data = array(
			'pageTitle'	=> 	$this->info['title'],
			'pageNote'	=>  $this->info['note'],
			'pageModule'	=> 'blogadmin',
		);
			
				
	} 

	
	public function getIndex()
	{
		if($this->access['is_view'] ==0) 
			return Redirect::to('')
				->with('message', SiteHelpers::alert('error',Lang::get('core.note_restric')));
				
		// Filter sort and order for query 
		$sort = (!is_null(Input::get('sort')) ? Input::get('sort') : 'created'); 
		$order = (!is_null(Input::get('order')) ? Input::get('order') : 'desc');
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
		$this->data['tableForm'] 	= $this->info['config']['forms'];
		$this->data['colspan'] 		= SiteHelpers::viewColSpan($this->info['config']['grid']);		
		// Group users permission
		$this->data['access']		= $this->access;
		// Detail from master if any
		$this->data['details']		= $master['masterView'];
		// Master detail link if any 
		$this->data['subgrid']	= (isset($this->info['config']['subgrid']) ? $this->info['config']['subgrid'] : array()); 
		// Render into template
		$this->layout->nest('content','blogadmin.index',$this->data)
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
			$this->data['row'] = $this->model->getColumnTable('tb_blogs'); 
		}
		$this->data['id'] = $id;
		$this->layout->nest('content','blogadmin.form',$this->data)->with('menus', $this->menus );	
	}
	
	function getShow( $id = null)
	{
	
		if($this->access['is_detail'] ==0) 
			return Redirect::to('')
				->with('message', SiteHelpers::alert('error',Lang::get('core.note_restric')));
					
		$ids = ($id == null ? '' : SiteHelpers::encryptID($id,true)) ;
		$row = $this->model->getRow($ids);
		if($row)
		{
			$this->data['row'] =  $row;
		} else {
			$this->data['row'] = $this->model->getColumnTable('tb_blogs'); 
		}
		$this->data['id'] = $id;
		$this->data['access']		= $this->access;
		$this->layout->nest('content','blogadmin.view',$this->data)->with('menus', $this->menus );	
	}	
	
	function postSave( $id =0)
	{

		$rules = array(
			
		);
		$validator = Validator::make(Input::all(), $rules);	
		if ($validator->passes()) {
			$data = $this->validatePost('tb_blogs');
			$data['slug'] = SiteHelpers::seoUrl( trim(Input::get('title')));
			$data['content'] =$_POST['content'];
			$ID = $this->model->insertRow($data , Input::get('blogID'));
			// Input logs
			if( Input::get('blogID') =='')
			{
				$this->inputLogs("New Entry row with ID : $ID  , Has Been Save Successfull");
			} else {
				$this->inputLogs(" ID : $ID  , Has Been Changed Successfull");
			}
			// Redirect after save	
			return Redirect::to('blogadmin')->with('message', SiteHelpers::alert('success',Lang::get('core.note_success')));
		} else {
			return Redirect::to('blogadmin/add/'.$id)->with('message', SiteHelpers::alert('error',Lang::get('core.note_error')))
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
		return Redirect::to('blogadmin');
	}	
	
			
		
}