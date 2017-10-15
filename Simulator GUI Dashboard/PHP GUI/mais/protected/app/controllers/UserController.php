<?php

class UserController extends BaseController {

	
	protected $layout = "layouts.main";

	public function __construct() {
		$this->beforeFilter('csrf', array('on'=>'post'));

	} 

	public function getRegister() {
        
		if(CNF_REGIST =='false') :    
			if(Auth::check()):
				 return Redirect::to('')->with('message',SiteHelpers::alert('success','Youre already login'));
			else:
				 return Redirect::to('user/login');
			  endif;
			  
			else :
				$this->layout = View::make('layouts.login');
				$this->layout->content = View::make('user.register');			  
		 endif ; 
           
	

	}

	public function postCreate() {
	
		$rules = array(
			'firstname'=>'required|alpha_num|min:2',
			'lastname'=>'required|alpha_num|min:2',
			'email'=>'required|email|unique:tb_users',
			'password'=>'required|alpha_num|between:6,12|confirmed',
			'password_confirmation'=>'required|alpha_num|between:6,12'
			);	
		if(CNF_RECAPTCHA =='true') $rules['recaptcha_response_field'] = 'required|recaptcha';
				
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->passes()) {
			$code = rand(10000,10000000);
			
			$authen = new User;
			$authen->first_name = Input::get('firstname');
			$authen->last_name = Input::get('lastname');
			$authen->email = trim(Input::get('email'));
			$authen->activation = $code;
			$authen->group_id = 3;
			$authen->password = Hash::make(Input::get('password'));
			if(CNF_ACTIVATION == 'auto') { $authen->active = '1'; } else { $authen->active = '0'; }
			$authen->save();
			
			$data = array(
				'firstname'	=> Input::get('firstname') ,
				'lastname'	=> Input::get('lastname') ,
				'email'		=> Input::get('email') ,
				'password'	=> Input::get('password') ,
				'code'		=> $code
				
			);
			if(CNF_ACTIVATION == 'confirmation')
			{ 
			


				$to = Input::get('email');
				$subject = "[ " .CNF_APPNAME." ] REGISTRATION "; 			
				$message = view::make('emails.registration', $data);
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers .= 'From: '.CNF_APPNAME.' <'.CNF_EMAIL.'>' . "\r\n";
					mail($to, $subject, $message, $headers);	
				
				$message = "Thanks for registering! . Please check your inbox and follow activation link";
								
			} elseif(CNF_ACTIVATION=='manual') {
				$message = "Thanks for registering! . We will validate you account before your account active";
			} else {
			
			}	


			return Redirect::to('user/login')->with('message',SiteHelpers::alert('success',$message));
		} else {
			return Redirect::to('user/register')->with('message',SiteHelpers::alert('error','The following errors occurred')
			)->withErrors($validator)->withInput();
		}
	}
	
	public function getActivation( )
	{
		$num = Input::get('code');
		if($num =='')
			return Redirect::to('user/login')->with('message',SiteHelpers::alert('error','Invalid Code Activation!'));
		
		$user =  User::where('activation','=',$num)->get();
		if (count($user) >=1)
		{
			DB::table('tb_users')->where('activation', $num )->update(array('active' => 1,'activation'=>''));
			return Redirect::to('user/login')->with('message',SiteHelpers::alert('success','Your account is active now!'));
			
		} else {
			return Redirect::to('user/login')->with('message',SiteHelpers::alert('error','Invalid Code Activation!'));
		}
		
		
	
	}

	public function getLogin() {
	
		if(Auth::check())
		{
			return Redirect::to('')->with('message',SiteHelpers::alert('success','Youre already login'));

		} else {
			$soc =  Config::get('hybridauth');

			$data = array(
				'fb_enabled' => $soc['providers']['Facebook']['enabled'],
				'google_enabled' => $soc['providers']['Google']['enabled'],
				'twit_enabled' => $soc['providers']['Twitter']['enabled'],
			);
			$this->layout = View::make('layouts.login');
			$this->layout->nest('content','user.login',$data);
		}	
	}

	public function postSignin() {
		
		$rules = array(
			'email'=>'required|email',
			'password'=>'required',
		);		
		if(CNF_RECAPTCHA =='true') $rules['recaptcha_response_field'] = 'required|recaptcha';
		$validator = Validator::make(Input::all(), $rules);
		if ($validator->passes()) {	
			if (Auth::attempt(array('email'=>Input::get('email'), 'password'=>Input::get('password')))) {
				if(Auth::check())
				{
					$row = User::find(Auth::user()->id); 
	
					if($row->active =='0')
					{
						// inactive 
						Auth::logout();
						return Redirect::to('user/login')->with('message', SiteHelpers::alert('error','Your Account is not active'));
	
					} else if($row->active=='2')
					{
						// BLocked users
						Auth::logout();
						return Redirect::to('user/login')->with('message', SiteHelpers::alert('error','Your Account is BLocked'));
					} else {
						DB::table('tb_users')->where('id', '=',$row->id )->update(array('last_login' => date("Y-m-d H:i:s")));
						Session::put('uid', $row->id);
						Session::put('gid', $row->group_id);
						Session::put('eid', $row->email);
						Session::put('ll', $row->last_login);
						Session::put('fid', $row->first_name.' '. $row->last_name);	
						Session::put('lang', Input::get('lang'));
						if(CNF_FRONT =='false') :
							return Redirect::to('dashboard');						
						else :
							return Redirect::to('');
						endif;							
											
					}			
					
				}			
				
			} else {
				return Redirect::to('user/login')
					->with('message', SiteHelpers::alert('error','Your username/password combination was incorrect'))
					->withInput();
			}
		} else {
		
				return Redirect::to('user/login')
					->with('message', SiteHelpers::alert('error','The following re-Captcha errors occurred'))
					->withErrors($validator)->withInput();
		}	
	}

	public function getDashboard() {
		$data = array('menus'=> SiteHelpers::menus());
		$this->layout->nest('content','users.dashboard')->with('menus', SiteHelpers::menus());
	}
	
	public function getProfile() {
		
		if(!Auth::check()) return Redirect::to('user/login');
		
		
		$user_id = Auth::user()->id;
		$info =	User::find($user_id);
		$this->data = array(
			'pageTitle'	=> 'My Profile',
			'pageNote'	=> 'View Detail My Info',
			'info'		=> $info,
		);
		$this->layout = View::make('layouts.main');
		$this->layout->nest('content','user.profile',$this->data)->with('menus', SiteHelpers::menus());
	}
	
	public function postSaveprofile()
	{
		if(!Auth::check()) return Redirect::to('user/login');
		$rules = array(
			'first_name'=>'required|alpha_num|min:2',
			'last_name'=>'required|alpha_num|min:2',
			);	
			
		if(Input::get('email') != Session::get('eid'))
		{
			$rules['email'] = 'required|email|unique:tb_users';
		}	
				
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->passes()) {
			
			
			if(!is_null(Input::file('avatar')))
			{
				$file = Input::file('avatar'); 
				$destinationPath = './uploads/users/';
				$filename = $file->getClientOriginalName();
				$extension = $file->getClientOriginalExtension(); //if you need extension of the file
				 $newfilename = Session::get('uid').'.'.$extension;
				$uploadSuccess = Input::file('avatar')->move($destinationPath, $newfilename);				 
				if( $uploadSuccess ) {
				    $data['avatar'] = $newfilename; 
				} 
				
			}		
			
			$user = User::find(Session::get('uid'));
			$user->first_name 	= Input::get('first_name');
			$user->last_name 	= Input::get('last_name');
			$user->email 		= Input::get('email');
			if(isset( $data['avatar']))  $user->avatar  = $newfilename; 			
			$user->save();

			return Redirect::to('user/profile')->with('message',SiteHelpers::alert('success','Profile has been saved!'));
		} else {
			return Redirect::to('user/profile')->with('message', SiteHelpers::alert('error','The following errors occurred')
			)->withErrors($validator)->withInput();
		}	
	
	}
	
	public function postSavepassword()
	{
		$rules = array(
			'password'=>'required|alpha_num|between:6,12',
			'password_confirmation'=>'required|alpha_num|between:6,12'
			);		
		$validator = Validator::make(Input::all(), $rules);
		if ($validator->passes()) {
			$user = User::find(Session::get('uid'));
			$user->password = Hash::make(Input::get('password'));
			$user->save();

			return Redirect::to('user/profile')->with('message',SiteHelpers::alert('success','Password has been saved!'));
		} else {
			return Redirect::to('user/profile')->with('message', SiteHelpers::alert('error','The following errors occurred')
			)->withErrors($validator)->withInput();
		}	
	
	}	
	
	public function getReminder()
	{
	
		$this->layout->content = View::make('user.remind');
	}	

	public function postRequest()
	{

		$rules = array(
			'credit_email'=>'required|email'
		);	
		
		$validator = Validator::make(Input::all(), $rules);
		if ($validator->passes()) {	
	
			$user =  User::where('email','=',Input::get('credit_email'));
			if($user->count() >=1)
			{
				$user = $user->get();
				$user = $user[0];
				$data = array('token'=>Input::get('_token'));	
				$to = Input::get('credit_email');
				$subject = "[ " .CNF_APPNAME." ] REQUEST PASSWORD RESET "; 			
				$message = view::make('emails.auth.reminder', $data);
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers .= 'From: '.CNF_APPNAME.' <'.CNF_EMAIL.'>' . "\r\n";
					mail($to, $subject, $message, $headers);				
			
				
				$affectedRows = User::where('email', '=',$user->email)
								->update(array('reminder' => Input::get('_token')));
								
				return Redirect::to('user/login')->with('message', SiteHelpers::alert('success','Please check your email'));	
				
			} else {
				return Redirect::to('user/login')->with('message', SiteHelpers::alert('error','Cant find email address'));
			}

		}  else {
			return Redirect::to('user/login')->with('message', SiteHelpers::alert('error','The following errors occurred')
			)->withErrors($validator)->withInput();
		}	 
	}	
	
	public function getReset( $token = '')
	{
		
		$user = User::where('reminder','=',$token);
		if($user->count() >=1)
		{
			$data = array('verCode'=>$token);
			$this->layout->nest('content','user.remind',$data);	
		} else {
			return Redirect::to('user/login')->with('message', SiteHelpers::alert('error','Cant find your reset code'));
		}
		
	}	
	
	public function postDoreset( $token = '')
	{
		$rules = array(
			'password'=>'required|alpha_num|between:6,12|confirmed',
			'password_confirmation'=>'required|alpha_num|between:6,12'
			);		
		$validator = Validator::make(Input::all(), $rules);
		if ($validator->passes()) {
			
			$user =  User::where('reminder','=',$token);
			if($user->count() >=1)
			{
				$data = $user->get();
				$user = User::find($data[0]->id);
				$user->reminder = '';
				$user->password = Hash::make(Input::get('password'));
			//	$user->save();			
			}

			return Redirect::to('user/login')->with('message',SiteHelpers::alert('success','Password has been saved!'));
		} else {
			return Redirect::to('user/reset/'.$token)->with('message', SiteHelpers::alert('error','The following errors occurred')
			)->withErrors($validator)->withInput();
		}	
	
	}	

	public function getLogout() {
		Auth::logout();
		Session::flush();
		return Redirect::to('')->with('message', SiteHelpers::alert('info','Your are now logged out!'));
	}

	function getGoogle($client = 'google'){
		
		$auth = Config::get('hybridauth');
		 $config = array( 
			"base_url"   => URL::to('user/google'),
			"providers"  => array (
			"Google"     => array (
				"enabled"    => true,
				"keys"       => array ( "id" => $auth['providers']['Google']['keys']['id'] , 
										"secret" => $auth['providers']['Google']['keys']['secret']
									),
				),
			),		 
		 );
		 
		if (isset($_REQUEST['hauth_start']) || isset($_REQUEST['hauth_done']))
        {
            Hybrid_Endpoint::process();

        }
		$socialAuth = new Hybrid_Auth($config);
		$provider = $socialAuth->authenticate("google");
		$userProfile = $provider->getUserProfile();		
		$provider->logout();

		$user =  User::where('email','=',$userProfile->email)->first();
		return self::autoSignin($user);
		

	}

	function getFacebook()
	{
		$auth = Config::get('hybridauth');
		 $config = array( 
			"base_url"   => URL::to('user/google'),
			"providers"  => array (
				"Facebook"   => array (
					"enabled"    => true,
					"keys"       => array ( "id" => $auth['providers']['Facebook']['keys']['id'] , 
										"secret" => $auth['providers']['Facebook']['keys']['secret']
									),
					),
			),		 
		 );
		 	

		if (isset($_REQUEST['hauth_start']) || isset($_REQUEST['hauth_done']))
        {
            Hybrid_Endpoint::process();

        }
			
		$socialAuth = new Hybrid_Auth($config);
		
		$provider = $socialAuth->authenticate("facebook");
		$userProfile = $provider->getUserProfile();
		$provider->logout();

		$user =  User::where('email','=',$userProfile->email)->first();
		return self::autoSignin($user);
	}
	
	function getTwitter()
	{
		$auth = Config::get('hybridauth');
		 $config = array( 
			"base_url"   => URL::to('user/twitter'),
			"providers"  => array (
				"Twitter"    => array (
					"enabled"    => true,
					"keys"       => array ( "key" =>  $auth['providers']['Twitter']['keys']['key'], 
											"secret" => $auth['providers']['Twitter']['keys']['secret'])
					)
			),		 
		 );
		
		if (isset($_REQUEST['hauth_start']) || isset($_REQUEST['hauth_done']))
        {
            Hybrid_Endpoint::process();

        }
			
		$socialAuth = new Hybrid_Auth($config);
		
		$provider = $socialAuth->authenticate("Twitter");
		$userProfile = $provider->getUserProfile();
		$provider->logout();

		$user =  User::where('email','=',$userProfile->email)->first();
		return self::autoSignin($user);
	}

	function autoSignin($user)
	{

		if(is_null($user)){
		  return Redirect::to('user/login')
				->with('message', SiteHelpers::alert('error','You have not registered yet '))
				->withInput();
		} else{

		    Auth::login($user);
			if(Auth::check())
			{
				$row = User::find(Auth::user()->id); 

				if($row->active =='0')
				{
					// inactive 
					Auth::logout();
					return Redirect::to('user/login')->with('message', SiteHelpers::alert('error','Your Account is not active'));

				} else if($row->active=='2')
				{
					// BLocked users
					Auth::logout();
					return Redirect::to('user/login')->with('message', SiteHelpers::alert('error','Your Account is BLocked'));
				} else {
					Session::put('uid', $row->id);
					Session::put('gid', $row->group_id);
					Session::put('eid', $row->group_email);
					Session::put('fid', $row->first_name.' '. $row->last_name);	
					if(CNF_FRONT =='false') :
						return Redirect::to('config/dashboard');						
					else :
						return Redirect::to('');
					endif;					
					
										
				}
				
				
			}
		}

	}
	
	 function getZcaptcha()
	{
		if (Input::get('reset')){
		  	echo  $_SESSION['obj'];
			return '';
		
		}	

		if (Input::get('phrase')){
			$random_key = rand(0, 4);
			$img_ar=array();
			$_SESSION['secure']=false;
			$_SESSION['images'] =  $img_ar;
			$_SESSION['passed'] =false;
			
			$_SESSION['id'] = $random_key;
			//session_distroy();
			return self::set_zcaptcha();
			//return false;
		}		
		
	
	}
	
	function set_zcaptcha(){
	  $rr=  rand(100000,900000);
	   $tmp = "<div id='incorrect' class='incorrect'>
	   <p>Your choice was incorrect</p>
		 <p class='retry' onclick='reset();'>Retry</p>
	   </div>";
	  $tmp .= "<div id='refresh' title='Reload' class='refresh' onclick='reset();'></div>";
	
	  $tmp .= "<div id='choices' class='itembox'>";
	
	   for ($i=0; $i<=4; $i++){
	
		 if ($i==4){
		 		$url = URL::to('zCaptcha/scripts/zCaptchaGet.php?item=d'.$i."&_".$rr);
			    $tmp .= "<p id='".$i."' class='item' onclick='Check(this.id)'><img onload='getphrase();' src='".$url."'/></p>";
		  }else{
				$urls = URL::to('zCaptcha/scripts/zCaptchaGet.php?item=d'.$i."&_".$rr);
			  $tmp .= "<p id='".$i."' class='item' onclick='Check(this.id)'><img src='".$urls."'/></p>";
	
		 }
		 }
	    $tmp .= "</div>";
	    $tmp .= "<p id='question' style='display:none'>Click on the <strong class='phrase' id='phrase'></strong></p>";
		return $tmp;
	
	}	
	

	
	
}