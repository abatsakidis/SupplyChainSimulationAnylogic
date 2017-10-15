<?php
class {controller}Controller extends BaseController {

	protected $layout = "layouts.main";
	protected $data = array();	
	public $module = '{class}';
	static $per_page	= '10';
	
	public function __construct() {
		parent::__construct();
		$this->model = new {controller}();
		$this->info = $this->model->makeInfo( $this->module);
		$this->access = $this->model->validAccess($this->info['id']);
	
		$this->data = array(
			'pageTitle'	=> 	$this->info['title'],
			'pageNote'	=>  $this->info['note'],
			'pageModule'	=> '{class}',
			'pageUrl'			=> URL::to('{class}')	
		);
			
				
	} 

	public function getIndex()
	{
		if($this->access['is_view'] ==0) 
			return Redirect::to('')
				->with('message', SiteHelpers::alert('error',Lang::get('core.note_restric')));	
				
		$this->data['access']		= $this->access;	
		$master  = $this->buildMasterDetail(); 
		$this->data['masterdetail']  = $this->masterDetailParam(); 
		$this->layout->nest('content','{class}.index',$this->data);
	}	
	

	public function postData()
	{ 
		if($this->access['is_view'] ==0) { echo SiteHelpers::alert('error',Lang::get('core.note_restric')); die; }	
		
		$sort = (!is_null(Input::get('sort')) ? Input::get('sort') : $this->info['setting']['orderby']); 
		$order = (!is_null(Input::get('order')) ? Input::get('order') : $this->info['setting']['ordertype']);	
		$filter = (!is_null(Input::get('search')) ? $this->buildSearch() : '');
		$page = Input::get('page', 1);
		$params = array(
			'page'		=> $page ,
			'limit'		=> (!is_null(Input::get('rows')) ? filter_var(Input::get('rows'),FILTER_VALIDATE_INT) : $this->info['setting']['perpage']) ,
			'sort'		=> $sort ,
			'order'		=> $order,
			'params'	=> $filter,
			'global'	=> (isset($this->access['is_global']) ? $this->access['is_global'] : 0 )
		);
			
		$results = $this->model->getRows( $params );	
		
		$this->data['param']		= $params;
		$this->data['rowData']		= $results['rows'];
		$this->data['tableGrid'] 	= $this->info['config']['grid'];
		$this->data['tableForm'] 	= $this->info['config']['forms'];	
		$this->data['access']		= $this->access;	
		$this->data['subgrid']	= (isset($this->info['config']['subgrid']) ? $this->info['config']['subgrid'] : array()); 
		$this->data['masterdetail']  = $this->masterDetailParam(); 
		
		// Build pagination setting
		$page = $page >= 1 && filter_var($page, FILTER_VALIDATE_INT) !== false ? $page : 1;	
		$pagination = Paginator::make($results['rows'], $results['total'],$params['limit']);		
		// Build Pagination 
		$this->data['pagination']	= $pagination;
		// Build pager number and append current param GET
		$this->data['pager'] 		= $this->injectPaginate();	
		// Row grid Number 
		$this->data['i']			= ($page * $params['limit'])- $params['limit']; 
				
		return View::make('{class}.table',$this->data);

	}
	
	public function getExport( $t = 'excel')
	{
		$info 		= $this->model->makeInfo( $this->module);
		$master  = $this->buildMasterDetail(); 	
		$params = array(
			'filter'	=> $master['masterFilter']
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
		

}