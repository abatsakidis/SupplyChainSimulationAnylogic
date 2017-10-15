<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/
	
	public function __construct() {
		
		parent::__construct();
		 $this->layout = "layouts.".CNF_THEME.".index";
		
		
	} 	
	

	public function index()
	{
		if(CNF_FRONT =='false' && Request::segment(1) =='' ) :
            return Redirect::to('dashboard');
        endif; 
		
		if(is_null(Input::get('p')))
		{
			$page = Request::segment(1); 	
		} else {
			$page = Input::get('p'); 	
		}
		if($page !='') :
			$content = Pages::where('alias','=',$page)->where('status','=','enable');
			if($content->count() >=1)
			{
				$content = $content->get();
				$row = $content[0];
				$this->data['pageTitle'] = $row->title;
				$this->data['pageNote'] = $row->note;		
				$this->data['breadcrumb'] = 'active';					
				
				if($row->access !='')
				{
					$access = json_decode($row->access,true)	;	
				} else {
					$access = array();
				}	

				// If guest not allowed 
				if($row->allow_guest !=1)
				{	
					$group_id = Session::get('gid');				
					$isValid =  (isset($access[$group_id]) && $access[$group_id] == 1 ? 1 : 0 );	
					if($isValid ==0)
					{
						return Redirect::to('')
							->with('message', SiteHelpers::alert('error',Lang::get('core.note_restric')));				
					}
				}				
				if($row->template =='backend')
				{
					 $this->layout = View::make("layouts.main");
				}
				
				$filename = public_path() ."protected/app/views/pages/template/".$row->filename.".blade.php";
				if(file_exists($filename))
				{
					$page = 'pages.template.'.$row->filename;
				} else {
					return Redirect::to('')
						->with('message', SiteHelpers::alert('error',Lang::get('core.note_noexists')));					
				}
				
			} else {
				return Redirect::to('')
					->with('message', SiteHelpers::alert('error',Lang::get('core.note_noexists')));	
			}
			
			
		else :
			$this->data['pageTitle'] = 'Home';
			$this->data['pageNote'] = 'Welcome To Our Site';
			$this->data['breadcrumb'] = 'inactive';			
			$page = 'pages.template.home';
		endif;	
		
		$page = SiteHelpers::renderHtml($page);
		

		$this->layout->nest('content',$page)->with('menus', $this->menus );
			
	}
	
	public function  postContactform()
	{
	
		$this->beforeFilter('csrf', array('on'=>'post'));
		$rules = array(
				'name'		=>'required',
				'subject'	=>'required',
				'message'	=>'required|min:20',
				'sender'	=>'required|email'			
		);
		$validator = Validator::make(Input::all(), $rules);	
		if ($validator->passes()) 
		{
			
			$data = array('name'=>Input::get('name'),'sender'=>Input::get('sender'),'subject'=>Input::get('subject'),'notes'=>Input::get('message')); 
			$message = View::make('emails.contact', $data); 		
			
			$to 		= 	CNF_EMAIL;
			$subject 	= Input::get('subject');
			$headers  	= 'MIME-Version: 1.0' . "\r\n";
			$headers 	.= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers 	.= 'From: '.Input::get('name').' <'.Input::get('sender').'>' . "\r\n";
				//mail($to, $subject, $message, $headers);			

			return Redirect::to('?p='.Input::get('redirect'))->with('message', SiteHelpers::alert('success','Thank You , Your message has been sent !'));	
				
		} else {
			return Redirect::to('?p='.Input::get('redirect'))->with('message', SiteHelpers::alert('error','The following errors occurred'))
			->withErrors($validator)->withInput();
		}		
	}
	public function  getLang($lang='en')
	{
		Session::put('lang', $lang);
		return  Redirect::back();
	}	
}