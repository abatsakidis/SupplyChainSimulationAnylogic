
  <div class="page-content row">
    <!-- Page header -->
    <div class="page-header">
      <div class="page-title">
        <h3> Help <small> Developer Guide </small></h3>
      </div>

      <ul class="breadcrumb">
        <li><a href="{{ URL::to('config/dashboard') }}">Home</a></li>
        <li><a href="{{ URL::to('config/help') }}">Help</a></li>
        <li class="active"> Developer </li>
      </ul>
	</div> 
	 <div class="page-content-wrapper m-t">  

	@include('admin.config.manual.developersidebar')
	<div class="col-md-8" style="margin-bottom:50px;">
	
		<h2 > Layout Structure </h2>
			<p> There are 2 different layout template . public template ( index.blade.php ) and admin template ( main.blade.php ) .<br />All files location at : <code>protected/app/views/layouts/</code> </p>
			<p> Both of layouts template almost having same structure , except admin template( <code>main.blade.php</code> ) having sidebar menu </p> 
			<p> <b>Render content into public template</b>  </p>
<pre class="prettyprint lang-php">
class YourController extends BaseController {
	protected $layout = "layouts.index";

	function yourFucntion ()
	{
		$data = array( );
		$this->layout->nest('content','folder.yourtemplate','$data')
	}
}

</pre>

<p> <b>Render content into Admin  template</b>  </p>
<pre class="prettyprint lang-php">
class YourController extends BaseController {
	protected $layout = "layouts.main";

	function yourFucntion ()
	{
		$data = array( );
		$this->layout->nest('content','folder.yourtemplate','$data')
	}
}

</pre>
<p> <b>Using 2 template inside one controller</b> </p>
<pre class="prettyprint lang-php">
class YourController extends BaseController {
	/* Default layout */
	protected $layout = "layouts.main";

	function yourFunction ()
	{
		$data = array( );
		$this->layout->nest('content','folder.yourtemplate','$data');
	}

	function yourFunction ()
	{
		// Change template to public template
		$this->layout = View::make('layouts.index');
		
		$data = array( );
		$this->layout->nest('content','folder.yourtemplate','$data')
	}

}

</pre>


					
</div>
</div>
</div>

