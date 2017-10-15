<?php
class BlogController extends BaseController {

	protected $layout = "layouts.main";
	protected $data = array();	
	public $module = 'blog';
	static $per_page	= '5';
	
	public function __construct() {
		parent::__construct();
		$this->beforeFilter('csrf', array('on'=>'post'));

	
		$this->data = array(
			'pageTitle'	=> 	'Blog',
			'pageNote'	=>  'Simple Blog',
			'pageModule'	=> 'blog',
			'breadcrumb'	=> 'inactive',
		);
			
				
	} 

	
	public function getIndex( $type ='' , $id ='')
	{

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
	
		if($type !='' && $type =='category') $filter .= " AND tb_blogcategories.alias ='".$id."' ";
		
		
		$page = Input::get('page', 1);
		$params = array(
			'page'		=> $page ,
			'limit'		=> (!is_null(Input::get('rows')) ? filter_var(Input::get('rows'),FILTER_VALIDATE_INT) : static::$per_page ) ,
			'sort'		=> $sort ,
			'order'		=> $order,
			'params'	=> $filter,
			'global'	=> 0
		);
		// Get Query 
		$results = Blog::getRows( $params );		
		
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

		$this->data['blogcategories']			= Blog::summaryCategory();
		$this->data['clouds']					= Blog::clouds();
		$this->data['recent']					= Blog::recentPosts();
		 $this->layout = View::make("layouts.".CNF_THEME.".index");
		// Render into template
		$this->layout->nest('content','blog.index',$this->data)->with('page', $this->data);
	}		
	
	function getRead( $id = null)
	{
			
		$row = Blog::getRowBlog($id);
		if($row)
		{
			$this->data['row'] =  $row;
			$this->data['id'] = $row->blogID;
			$this->data['alias'] =  $row->slug;
	
			$this->data['blogcategories']			= Blog::summaryCategory();
			$this->data['clouds']					= Blog::clouds();
			$this->data['recent']					= Blog::recentPosts();
			$this->data['comments']					= Blog::getComments($row->blogID);

			
			$this->layout = View::make("layouts.".CNF_THEME.".index");
			$this->layout->nest('content','blog.view',$this->data)->with('page', $this->data);
		} else {
			return Redirect::to('blog')->with('message', SiteHelpers::alert('error',' Article not found !'));
		}	
	}
	
	function getCategory( $id = null )
	{
		if($id == null ) 
			return Redirect::to('blog')->with('message', SiteHelpers::alert('error','Could not find category'));
		self::getIndex('category' ,$id );
	}
	
	function getTags( $id = null )
	{
		if($id == null ) 
			return Redirect::to('blog')->with('message', SiteHelpers::alert('error','Could not find category'));
		self::getIndex('tags' ,$id );
	}	
		

	function getShow( $id = null)
	{
	
		if($this->access['is_detail'] ==0) 
			return Redirect::to('')
				->with('message', SiteHelpers::alert('error',Lang::get('core.note_restric')));
					
		$ids = ($id == null ? '' : SiteHelpers::encryptID($id,true)) ;
		$row = Blog::getRow($ids);
		if($row)
		{
			$this->data['row'] =  $row;
		} else {
			$this->data['row'] = $this->model->getColumnTable('tb_blogs'); 
		}
		$this->data['id'] = $id;
		$this->data['access']		= $this->access;
		$this->layout->nest('content','blog.view',$this->data)->with('menus', $this->menus );	
	}	
	
	function postSave( $id =0)
	{

		$rules = array(
			
		);
		$validator = Validator::make(Input::all(), $rules);	
		if ($validator->passes()) {
			$data = $this->validatePost('tb_blogs');
			$data['content'] = $_POST['content'];
			
			$ID = $this->model->insertRow($data , Input::get('blogID'));
			// Input logs
			if( Input::get('blogID') =='')
			{
				$this->inputLogs("New Entry row with ID : $ID  , Has Been Save Successfull");
			} else {
				$this->inputLogs(" ID : $ID  , Has Been Changed Successfull");
			}
			// Redirect after save	
			return Redirect::to('blog/add/'.$id)->with('message', SiteHelpers::alert('success',Lang::get('core.note_success')));
		} else {
			return Redirect::to('blog/add/'.$id)->with('message', SiteHelpers::alert('error',Lang::get('core.note_error')))
			->withErrors($validator)->withInput();
		}	
	
	}

	function postSavecomment( $id =0)
	{

		$rules = array(
			'comment' => 'required'	
		);
		$validator = Validator::make(Input::all(), $rules);	
		if ($validator->passes()) {
			$data = array(
				'comment'	=> Input::get("comment"),
				'blogID'	=> Input::get("blogID"),
				'created'	=> date("Y-m-d H:i:s"),
				'user_id'	=> Session::get('uid')
				
			);
			$ID = DB::table("tb_blogcomments")->insert($data);		
			return Redirect::to('blog/read/'.Input::get('alias'))->with('message', SiteHelpers::alert('success',Lang::get('core.note_success')));
		} else {
			return Redirect::to('blog/read/'.Input::get('alias'))->with('message', SiteHelpers::alert('error',Lang::get('core.note_error')))
			->withErrors($validator)->withInput();
		}	
	
	}
	
		

	public function getRemovecomm( $id , $alias )
	{
		
		if(Session::get('uid') != 1) 
			return Redirect::to('')
				->with('message', SiteHelpers::alert('error',Lang::get('core.note_restric')));
						
		// delete multipe rows 
	
		 DB::table('tb_blogcomments')->where('commentID',$id)->delete();   
		// redirect
		Session::flash('message', SiteHelpers::alert('success','Comment has been removed !'));
		return Redirect::to('blog/read/'.$alias);
	}			
	
}