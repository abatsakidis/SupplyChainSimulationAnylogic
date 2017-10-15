
  <div class="page-content row">
    <!-- Page header -->
    <div class="page-header">
      <div class="page-title">
        <h3> {{ $pageTitle }} <small>{{ $pageNote }}</small></h3>
      </div>

      <ul class="breadcrumb">
        <li><a href="{{ URL::to('') }}">Home</a></li>
        <li class="active"> Documentation </li>
      </ul>
	</div>  
	
	 <div class="page-content-wrapper m-t">  

	@include('admin.config.manual.manualsidebar')
	<div class="col-md-8" style="margin-bottom:50px;">
	
		<h2 > Setting Up Application Info </h2>
		<p>After your successfull install your application , now you need to setting your app . </p>
		<p class="alert alert-info"> Go to : Control Panel -> setting </p>
		<img src="{{asset('assets/images/fanssignupsplash.png')}}">
		
		<h4 > Basic Info Application  </h4>
<table width="100%" border="0" cellspacing="2" cellpadding="2" class="table table-bordered">
              <tr>
                <th scope="col">Parameter</th>
                <th scope="col">Description</th>
                <th scope="col">Example</th>
              </tr>
              <tr>
                <td>Application Name </td>
                <td>Name of your application , this name will show as title page , logo title </td>
                <td>Inventory , HRD System </td>
              </tr>
              <tr>
                <td>Application Desc </td>
                <td>Short description for your application </td>
                <td>Manage Inventory , Manage HRD </td>
              </tr>
              <tr>
                <td>Company Name </td>
                <td>Your company name </td>
                <td>My Company </td>
              </tr>
              <tr>
                <td>Email System </td>
                <td>Email addres used for email sender  forgot password , registration activation etc </td>
                <td>info@mycompany.com</td>
              </tr>
              <tr>
                <td>Muliti language <br />
Only Layout Interface </td>
                <td>Enabling translatation interface ( no content translation ) </td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>Main Language </td>
                <td>Set default language </td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>Metakey</td>
                <td>key for your app ( frontend ) </td>
                <td>my site , my company  , Larvel Crud</td>
              </tr>			  			  			  
              <tr>
                <td>Meta Description</td>
                <td>Key description for your app ( frontend ) </td>
                <td>&nbsp;</td>
              </tr>				  
            </table>
		
		<div class="doc-line"></div>	
			
		<h4 > Email Template </h4>
		<p> Email template used for sending activation link and forgot password info. You only need to change text as you desire , but do not delete link code  </p>
		<div class="doc-line"></div>
		<h4 >Login And Security  </h4>

<table width="100%" border="0" cellspacing="2" cellpadding="2" class="table table-bordered">
              <tr>
                <th scope="col">Parameter</th>
                <th scope="col">Description</th>
                <th scope="col">Example</th>
              </tr>
              <tr>
                <td>Login Facebook </td>
                <td>Allow users to login via facebook account  </td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td> Login Google </td>
                <td>Allow users to login via Google account </td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>Login Twitter </td>
                <td>Allow users to login via Twitter account </td>
                <td>&nbsp;</td>
              </tr>

              <tr>
                <td>Default Group Registration</td>
                <td>Set new  registrant users as spesific group </td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>Registration</td>
                <td>Registration proccess </td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>Allow Registration</td>
                <td>Allow users to registration </td>
                <td>TRUE / FALSE </td>
              </tr>
              <tr>
                <td>Allow Frontend </td>
                <td>Disable Frontend </td>
                <td>TRUE / FALSE </td>
              </tr>
            </table>	
			<div class="doc-line"></div>
			<h2 > Setting Up Social Network </h2>
			<p>Before you activate social media login , you need to register your webste and get API ID and SECRET .
Please follow instruction for each account ID </p>
			<h5>GOOGLE + </h5>
<ul>
	<li>Go To : https://code.google.com/apis/console/</li>
	<li>Go to API Access under API Project. After that click on Create an OAuth 2.0 client ID to create a new application.</li>
	<li>A pop-up named "Create Client ID" will appear, fill out any required fields such as the application name and description.</li>
	<li>Click on Next.</li>
	<li>On the popup set Application type to Web application and switch to advanced settings by clicking on (more options).</li>
	<li>Provide this URL as the Callback URL for your application: http://mywebsite.com/user/google?hauth.done=Google</li>
	<li>Once you have registered, copy and past the created application credentials (Client ID and Secret) into the setting page. </li>
</ul>
		<h5>FACEBOOK </h5>
<ul>
<li>Go to https://developers.facebook.com/apps and create a new application by clicking "Create New App". 2. Fill out any required fields such as the application name and description.</li>
<li>Put your website domain in the Site Url field.</li>
<li>Once you have registered, copy and past the created application credentials (Client ID and Secret) into the setting page. </li>
</ul>
		<h5>TWITTER </h5>	
<ul>
	<li> Go to https://dev.twitter.com/apps and create a new application. </li>
	<li>Fill out any required fields such as the application name and description. </li>
	<li>Put your website domain in the Website field.  </li>
	<li>Provide this URL as the Callback URL for your application: http://mywebsite.com/user/twitter?hauth.done=Google </li>
	<li>Once you have registered, copy and past the created application credentials (Client ID and Secret) into the setting page.   </li>
</ul>		
			
							
</div>
</div>
</div>


