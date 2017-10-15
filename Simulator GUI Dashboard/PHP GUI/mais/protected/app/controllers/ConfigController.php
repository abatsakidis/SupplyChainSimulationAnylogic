<?php

class ConfigController extends BaseController  {

	protected $layout = "layouts.main";
	
	public function __construct() {
		$this->beforeFilter('csrf', array('on'=>'post'));
		parent::__construct();
		$this->data = array(
			'pageTitle'	=> 'Site Config',
			'pageNote'	=> 'Manage Setting COnfiguration'
		);
		if(Session::get('gid') != '1'){
			
			echo "
			<script type='text/javascript' >
				location.href='".url( 'dashboard' )."';
			</script>				
			";		
		} 		
	} 	
	public function getDashboard()
	{
		$this->data['user_groups'] = Users::getUserStatus();
		$this->data['lastest_users'] = Users::getLatestUser();
		$this->layout->nest('content','admin/config/dashboard',$this->data);	
	}	

	public function getIndex()
	{
		$this->layout->nest('content','admin/config/index',$this->data)->with('menus', $this->menus );	
	}
	
	static function postSave()
	{

		$rules = array(
			'cnf_appname'=>'required|min:2',
			'cnf_appdesc'=>'required|min:2',
			'cnf_comname'=>'required|min:2',
			'cnf_email'=>'required|email',
		);
		$validator = Validator::make(Input::all(), $rules);	
		if ($validator->passes()) {
			$val  =		"<?php \n"; 
			$val .= 	"define('CNF_APPNAME','".Input::get('cnf_appname')."');\n";
			$val .= 	"define('CNF_APPDESC','".Input::get('cnf_appdesc')."');\n";
			$val .= 	"define('CNF_COMNAME','".Input::get('cnf_comname')."');\n";
			$val .= 	"define('CNF_EMAIL','".Input::get('cnf_email')."');\n";	
			$val .= 	"define('CNF_METAKEY','".Input::get('cnf_metakey')."');\n";	
			$val .= 	"define('CNF_METADESC','".Input::get('cnf_metadesc')."');\n";		
			$val .= 	"define('CNF_GROUP','".CNF_GROUP."');\n";	
			$val .= 	"define('CNF_ACTIVATION','".CNF_ACTIVATION."');\n";	
			$val .= 	"define('CNF_MULTILANG','".(!is_null(Input::get('cnf_multilang')) ? 1 : 0 )."');\n";
			$val .= 	"define('CNF_LANG','".Input::get('cnf_lang')."');\n";
			$val .= 	"define('CNF_REGIST','".CNF_REGIST."');\n";	
			$val .= 	"define('CNF_FRONT','".CNF_FRONT."');\n";		
			$val .= 	"define('CNF_RECAPTCHA','".CNF_RECAPTCHA."');\n";	
			$val .= 	"define('CNF_THEME','".Input::get('cnf_theme')."');\n";		
			$val .= 	"define('CNF_RECAPTCHAPUBLICKEY','".CNF_RECAPTCHAPUBLICKEY."');\n";
			$val .= 	"define('CNF_RECAPTCHAPRIVATEKEY','".CNF_RECAPTCHAPRIVATEKEY."');\n";								
			$val .= 	"?>";
	
			$filename = 'setting.php';
			$fp=fopen($filename,"w+"); 
			fwrite($fp,$val); 
			fclose($fp); 
			return Redirect::to('config')->with('message',SiteHelpers::alert('success','Setting Has Been Save Successful') );
		} else {
			return Redirect::to('config')->with('message', SiteHelpers::alert('success','The following errors occurred'))
			->withErrors($validator)->withInput();
		}			
	
	}

	public function getHelp( $type = null)
	{
	
	
		$this->data = array(
			'pageTitle'	=> 'Help Manual',
			'pageNote'	=> 'Documentation'
		);	
		$this->layout->nest('content','admin.config.manual.intro',$this->data)->with('menus', $this->menus );	
	}

	public function getManual( $page = null)
	{
		$template = ($page != null ? $page : 'index');	
		if($page != null ) $template = $page;
		$this->data = array(
			'pageTitle'	=> 'Help Manual',
			'pageNote'	=> 'Documentation',
			'active'	=> $template
		);	
			
		$this->layout->nest('content','admin.config.manual.'.$template,$this->data)->with('menus', $this->menus );	
	}
	
	public function getDeveloper( $page = null)
	{
		$template = ($page != null ? $page : 'devindex');	
		if($page != null ) $template = $page;
		$this->data = array(
			'pageTitle'	=> 'Developer Guide',
			'pageNote'	=> 'Documentation',
			'active'	=> $template
		);	
			
		$this->layout->nest('content','admin.config.manual.'.$template,$this->data)->with('menus', $this->menus );	
	}
	

	function getBlast()
	{
		$this->data = array(
			'groups'	=> Groups::all(),
			'pageTitle'	=> 'Blast Email',
			'pageNote'	=> 'Send email to users'
		);	
		$this->layout->nest('content','admin/config/blast',$this->data)->with('menus', $this->menus );		
	}

	function postDoblast()
	{

		$rules = array(
			'subject'		=> 'required',
			'message'		=> 'required|min:10',
			'groups'		=> 'required',				
		);	
		$validator = Validator::make(Input::all(), $rules);	
		if ($validator->passes()) 
		{	

			if(!is_null(Input::get('groups')))
			{
				$groups = Input::get('groups');
				for($i=0; $i<count($groups); $i++)
				{
					if(Input::get('uStatus') == 'all')
					{
						$users = Users::all()->where('group_id','=',$groups[$i]);
					} else {
						$users = Users::where('active','=',Input::get('uStatus'))->where('group_id','=',$groups[$i]);
					}
					$count = 0;
					foreach($users as $row)
					{

						$to = $row->email;
						$subject = Input::get('subject');
						$message = Input::get('message');
						$headers  = 'MIME-Version: 1.0' . "\r\n";
						$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
						$headers .= 'From: '.CNF_APPNAME.' <'.CNF_EMAIL.'>' . "\r\n";
							mail($to, $subject, $message, $headers);
						
						$count = ++$count;					
					} 
					
				}
				return Redirect::to('config/blast')->with('message', SiteHelpers::alert('success','Total '.$count.' Message has been sent'));

			}
			return Redirect::to('config/blast')->with('message', SiteHelpers::alert('info','No Message has been sent'));
			

		} else {

			return Redirect::to('config/blast')->with('message', SiteHelpers::alert('error','The following errors occurred'))
			->withErrors($validator)->withInput();
		}	

	}

	function getTemplate( $page = 'general')
	{
		switch ($page) {

				case 'typography':
					$tmp = 'admin/config/template/Typography';
					break;

				case 'icon-moon':
					$tmp = 'admin/config/template/Iconmoon';
					break;

				case 'forms':
					$tmp = 'admin/config/template/Forms';
					break;

				case 'tables':
					$tmp = 'admin/config/template/Tables';
					break;

				case 'panel':
					$tmp = 'admin/config/template/Panel';
					break;		
								
				case 'grid':
					$tmp = 'admin/config/template/Grid';
					break;	
					
				case 'icons':
					$tmp = 'admin/config/template/Icons';
					break;

				default:
					$tmp = 'admin/config/template/Index';
					break;
			}	
		

		$this->data = array(
			'pageTitle'	=> 'Templates',
			'pageNote'	=> 'Elements for template',
			'page'		=> $page
			
		);	
		$this->layout->nest('content',$tmp,$this->data)->with('menus', $this->menus );	

	}	
	
	public function getEmail()
	{
		
		$regEmail = public_path() ."protected/app/views/emails/registration.blade.php";
		$resetEmail = public_path() ."protected/app/views/emails/auth/reminder.blade.php";
		$this->data = array(
			'groups'	=> Groups::all(),
			'pageTitle'	=> 'Blast Email',
			'pageNote'	=> 'Send email to users',
			'regEmail' 	=> file_get_contents($regEmail),
			'resetEmail'	=> 	file_get_contents($resetEmail)
		);	
		$this->layout->nest('content','admin/config/email',$this->data)->with('menus', $this->menus );		
	
	}
	
	function postEmail()
	{
		
		//print_r($_POST);exit;
		$rules = array(
			'regEmail'		=> 'required|min:10',
			'resetEmail'		=> 'required|min:10',				
		);	
		$validator = Validator::make(Input::all(), $rules);	
		if ($validator->passes()) 
		{
			$regEmailFile = public_path() ."protected/app/views/emails/registration.blade.php";
			$resetEmailFile = public_path() ."protected/app/views/emails/auth/reminder.blade.php";
			
			$fp=fopen($regEmailFile,"w+"); 				
			fwrite($fp,$_POST['regEmail']); 
			fclose($fp);	
			
			$fp=fopen($resetEmailFile,"w+"); 				
			fwrite($fp,$_POST['resetEmail']); 
			fclose($fp);
			
			return Redirect::to('config/email')->with('message', SiteHelpers::alert('success','Email Has Been Updated'));	
			
		}	else {

			return Redirect::to('config/email')->with('message', SiteHelpers::alert('error','The following errors occurred'))
			->withErrors($validator)->withInput();
		}
	
	}
	
	public function getSecurity()
	{
		
		$this->data = array(
			'groups'	=> Groups::all(),
			'pageTitle'	=> 'Login And Security',
			'pageNote'	=> 'Login Configuration and Setting',
			'hybrid' 	=> Config::get('hybridauth'),
			'groups'	=> Groups::all()
		);
		
	
		$this->layout->nest('content','admin/config/security',$this->data)->with('menus', $this->menus );		
	
	}	
	
	public function postSocial()
	{	
		
		
		$rules = array(
					
		);	
		$validator = Validator::make(Input::all(), $rules);	
		if ($validator->passes()) 
		{
		
$content = '<?php
return array(	
	"base_url"   => "'.URL::to('').'/user/socmed",
	"providers"  => array (
		"Google"     => array (
			"enabled"    => '.(!is_null(Input::get('GOOGLE_ENABLE')) ? 'true':'false').',
			"keys"       => array ( "id" => "'.Input::get('GOOGLE_ID').'", "secret" => "'.Input::get('GOOGLE_SECRET').'" ),
			),
		"Facebook"   => array (
			"enabled"    => '.(!is_null(Input::get('FB_ENABLE')) ? 'true':'false').',
			"keys"       => array ( "id" => "'.Input::get('FB_ID').'", "secret" => "'.Input::get('FB_SECRET').'" ),
			),
		"Twitter"    => array (
			"enabled"    => '.(!is_null(Input::get('TWIT_ENABLE')) ? 'true':'false').',
			"keys"       => array ( "key" => "'.Input::get('TWIT_ID').'", "secret" => "'.Input::get('TWIT_SECRET').'" )
			)
	),
);';
			
			$hybrid = public_path() ."protected/app/config/hybridauth.php";
				
			$fp=fopen($hybrid,"w+"); 				
			fwrite($fp,$content); 
			fclose($fp);		
			return Redirect::to('config/security')->with('message', SiteHelpers::alert('success','Social Media Has Been Updated'));
		}	else {

			return Redirect::to('config/security')->with('message', SiteHelpers::alert('error','The following errors occurred'))
			->withErrors($validator)->withInput();
		}	
	}		

	
	public function postLogin()
	{

		$rules = array(

		);
		$validator = Validator::make(Input::all(), $rules);	
		if ($validator->passes()) {
			$val  =		"<?php \n"; 
			$val .= 	"define('CNF_APPNAME','".CNF_APPNAME."');\n";
			$val .= 	"define('CNF_APPDESC','".CNF_APPDESC."');\n";
			$val .= 	"define('CNF_COMNAME','".CNF_COMNAME."');\n";
			$val .= 	"define('CNF_EMAIL','".CNF_EMAIL."');\n";
			$val .= 	"define('CNF_METAKEY','".CNF_METAKEY."');\n";	
			$val .= 	"define('CNF_METADESC','".CNF_METADESC."');\n";					
			$val .= 	"define('CNF_GROUP','".Input::get('CNF_GROUP')."');\n";	
			$val .= 	"define('CNF_ACTIVATION','".Input::get('CNF_ACTIVATION')."');\n";	
			$val .= 	"define('CNF_MULTILANG','".CNF_MULTILANG."');\n";
			$val .= 	"define('CNF_LANG','".CNF_LANG."');\n";		
			$val .= 	"define('CNF_REGIST','".(!is_null(Input::get('CNF_REGIST')) ? 'true':'false')."');\n";		
			$val .= 	"define('CNF_FRONT','".(!is_null(Input::get('CNF_FRONT')) ? 'true':'false')."');\n";		
			$val .= 	"define('CNF_RECAPTCHA','".(!is_null(Input::get('CNF_RECAPTCHA')) ? 'true':'false')."');\n";	
			$val .= 	"define('CNF_THEME','".CNF_THEME."');\n";	
			$val .= 	"define('CNF_RECAPTCHAPUBLICKEY','".Input::get('CNF_RECAPTCHAPUBLICKEY')."');\n";
			$val .= 	"define('CNF_RECAPTCHAPRIVATEKEY','".Input::get('CNF_RECAPTCHAPRIVATEKEY')."');\n";								
			$val .= 	"?>";
	
			$filename = 'setting.php';
			$fp=fopen($filename,"w+"); 
			fwrite($fp,$val); 
			fclose($fp); 
			return Redirect::to('config/security')->with('message',SiteHelpers::alert('success','Setting Has Been Save Successful') );
		} else {
			return Redirect::to('config/security')->with('message', SiteHelpers::alert('success','The following errors occurred'))
			->withErrors($validator)->withInput();
		}	
	}
	
	public function getLog( $type = null)
	{
	
		$file = './protected/app/storage/logs/laravel.log';

		$filesize = file_exists($file) ? self::sizeFilter(filesize($file)) : self::sizeFilter(0);
		$this->data = array(
			'pageTitle'	=> 'Help Manual',
			'pageNote'	=> 'Documentation',
			'filesize'	=> $filesize
		);	
		$this->layout->nest('content','admin.config.log',$this->data)->with('menus', $this->menus );	
	}
	
	public function sizeFilter( $bytes )
	{
		$label = array( 'B', 'KB', 'MB', 'GB', 'TB', 'PB' );
		for( $i = 0; $bytes >= 1024 && $i < ( count( $label ) -1 ); $bytes /= 1024, $i++ );
		return( round( $bytes, 2 ) . " " . $label[$i] );
	}	
	
	public function getClearlog()
	{
		self::removeDir( app_path()."/storage/views");	
		if(file_exists( app_path()."/storage/logs/laravel.log")) 
			unlink( app_path()."/storage/logs/laravel.log");
		mkdir( app_path()."/storage/views" ,0777 );	
		return Redirect::to('config/log')->with('message',SiteHelpers::alert('success','Cache has been cleared !') );
	}
	
	function removeDir($dir) {
		foreach(glob($dir . '/*') as $file) {
			if(is_dir($file))
				removedir($file);
			else
				unlink($file);
		}
		rmdir($dir);
	}
	
	public function getTranslation( $type = null)
	{
		if(!is_null(Input::get('edit')))
		{
			$file = (!is_null(Input::get('file')) ? Input::get('file') : 'core.php'); 
			$files = scandir('./protected/app/lang/'.Input::get('edit').'/');
			//$str = serialize(file_get_contents('./protected/app/lang/'.Input::get('edit').'/core.php'));
			$str = File::getRequire(base_path().'/app/lang/'.Input::get('edit').'/'.$file);
		//	$arr = unserialize($str);
		//	echo '<pre>';print_r($str);echo '</pre>';
			
			
			$this->data = array(
				'pageTitle'	=> 'Help Manual',
				'pageNote'	=> 'Documentation',
				'stringLang'	=> $str,
				'lang'			=> Input::get('edit'),
				'files'			=> $files ,
				'file'			=> $file ,
			);	
			$template = 'edit';
		
		} else {

			$this->data = array(
				'pageTitle'	=> 'Help Manual',
				'pageNote'	=> 'Documentation',
			);	
			$template = 'index';		
		
		}

		$this->layout->nest('content','admin.config.translation.'.$template,$this->data)->with('menus', $this->menus );	
	}
	
	public function getAddtranslation()
	{
		return View::make("admin.config.translation.add");
	} 
	
	public function postAddtranslation()
	{
		$rules = array(
			'name'		=> 'required',
			'folder'	=> 'required|alpha',
			'author'	=> 'required',
		);
		$validator = Validator::make(Input::all(), $rules);	
		if ($validator->passes()) {
			$folder = Input::get('folder');
			mkdir( app_path()."/lang/".$folder ,0777 );	
			
			$info = json_encode(array("name"=> Input::get('name'),"folder"=> $folder , "author" => Input::get('author')));
			$fp=fopen('./protected/app/lang/'.$folder.'/info.json',"w+"); 
			fwrite($fp,$info); 
			fclose($fp); 	
					
			$files = scandir('./protected/app/lang/en/');
			foreach($files as $f)
			{
				if($f != "." and $f != ".." and $f != 'info.json')
				{
					copy('./protected/app/lang/en/'.$f, './protected/app/lang/'.$folder.'/'.$f);
				}
			}
			return Redirect::to('config/translation')->with('message',SiteHelpers::alert('success','New Translation has been added !') );			
			
		} else {
			return Redirect::to('config/translation')->with('message',SiteHelpers::alert('error','Failed to add translation !') )->withErrors($validator)->withInput();
		}		
	
	}
	
	public function postSavetranslation()
	{
		
		SiteHelpers::globalXssClean();
		$form  	= "<?php \n"; 
		$form 	.= "return array( \n";
		foreach($_POST as $key => $val)
		{
			if($key !='_token' && $key !='lang' && $key !='file') 
			{
				if(!is_array($val))
				{
					$form .= '"'.$key.'"			=> "'.strip_tags($val).'", '." \n ";
				
				} else {
					$form .= '"'.$key.'"			=> array( '." \n ";
					foreach($val as $k=>$v)
					{
							$form .= '      "'.$k.'"			=> "'.strip_tags($v).'", '." \n ";
					}
					$form .= "), \n";
				}
			}		
		
		}
		$form .= ');';
		//echo $form; exit;
		$lang = Input::get('lang');
		$file	= Input::get('file');
		$filename = './protected/app/lang/'.$lang.'/'.$file;
	//	$filename = 'lang.php';
		$fp=fopen($filename,"w+"); 
		fwrite($fp,$form); 
		fclose($fp); 	
		return Redirect::to('config/translation?edit='.$lang.'&file='.$file)
		->with('message',SiteHelpers::alert('success','Translation has been saved !') );
	
	} 	
	
	public function getRemovetranslation( $folder )
	{
		self::removeDir( app_path()."/lang/".$folder);
		return Redirect::to('config/translation')->with('message',SiteHelpers::alert('success','Translation has been removed !') );
		
	}		
}