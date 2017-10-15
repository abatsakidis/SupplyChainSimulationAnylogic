
  <div class="page-content row">
    <!-- Page header -->
    <div class="page-header">
      <div class="page-title">
        <h3> {{ $pageTitle }} <small>{{ $pageNote }}</small></h3>
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
	
		<h2 >Introduction  </h2>
		<p> SXIMO Builder is based on the Model-View-Controller development pattern. MVC is a software approach that separates application logic from presentation. In practice, it permits your web pages to contain minimal scripting since the presentation is separate from the PHP scripting.</p>

<p>The Model represents your data structures. Typically your model classes will contain functions that help you retrieve, insert, and update information in your database.</p>

<p>The View is the information that is being presented to a user. A View will normally be a web page, but in Sximo, a view can also be a page fragment like a header or footer. It can also be an RSS page, or any other type of "page".</p>

The Controller serves as an intermediary between the Model, the View, and any other resources needed to process the HTTP request and generate a web page.
</p>
		<div class="doc-line"></div>


		<h2 >Folder Structure   </h2>
		<div class="row">
			<div class="col-sm-6">
				<div class="padding-lg">		
				<strong> Native Laravel 4.1 structure </strong>
				<ul class="list-unstyled">
					<li><i style="color: #FFCC00" class="fa fa-folder"></i> app </li>
					<li><i style="color: #FFCC00" class="fa fa-folder"></i> bootstrap </li>
					<li><i style="color: #FFCC00" class="fa fa-folder"></i> public </li>
					<li><i style="color: #FFCC00" class="fa fa-folder"></i> vendor </li>
					<li><i style="color: #ddd" class="fa fa-file"></i> artisan </li>	
					<li><i style="color: #ddd" class="fa fa-file"></i> composer </li>
					<li><i style="color: #ddd" class="fa fa-file"></i> phpunit </li>
					<li><i style="color: #ddd" class="fa fa-file"></i> readme </li>
					<li><i style="color: #ddd" class="fa fa-file"></i> server </li>
				</ul>
				</div>
			</div>	
			<div class="col-sm-6">
				<div class="padding-lg">	
				<strong> Sximo CRUD </strong>
				<ul class="list-unstyled">
					<li><i style="color: #FFCC00" class="fa fa-folder"></i> protected </li>
					<li><i style="color: #FFCC00" class="fa fa-folder"></i> uploads </li>
					<li><i style="color: #FFCC00" class="fa fa-folder"></i> sximo </li>
					<li><i style="color: #FFCC00" class="fa fa-folder"></i> packages </li>
					<li><i style="color: #ddd" class="fa fa-file"></i> .htaccess </li>	
					<li><i style="color: #ddd" class="fa fa-file"></i> index </li>
					<li><i style="color: #ddd" class="fa fa-file"></i> logo.ico </li>
					<li><i style="color: #ddd" class="fa fa-file"></i> robots </li>
					<li><i style="color: #ddd" class="fa fa-file"></i> setting </li>
				</ul>
				</div>
			</div>
			</div>
			
			<p>We have change folder structure , so it will ready to be application as on root or sub root application </p>
		<div class="doc-line"></div>
		
		<h2 >Module Structure   </h2>
		<p>Everytime you create new module , it wil create files and folder as following items : </p>
<ul class="list-unstyled">
				<li><i style="color: #FFCC00" class="fa fa-folder"></i> protected
					<ul> 
					<li><i style="color: #FFCC00" class="fa fa-folder"></i>  app
						<ul>
							<li><i style="color: #FFCC00" class="fa fa-folder"></i> controllers 
								<ul>
									<li><i style="color: #ddd" class="fa fa-file"></i> ModuleController.php </li>	
								</ul>
							</li>
							<li><i style="color: #FFCC00" class="fa fa-folder"></i> models 
								<ul>
									<li><i style="color: #ddd" class="fa fa-file"></i> Module.php </li>	
								</ul>							
							</li>
							<li><i style="color: #FFCC00" class="fa fa-folder"></i> views 
								<ul>
									<li><i style="color: #ddd" class="fa fa-file"></i> module
										<ul>
											<li><i style="color: #ddd" class="fa fa-file"></i> index.blade.php </li>
											<li><i style="color: #ddd" class="fa fa-file"></i> form.blade.php </li>
											<li><i style="color: #ddd" class="fa fa-file"></i> view.blade.php </li>	
											<li><i style="color: #ddd" class="fa fa-file"></i> inlineview.blade.php </li>	
										</ul>									
									 </li>	
								</ul>							
							</li>						
						</ul>
					</li>
					</ul>
				</li>	
				</ul>			
							
</div>
</div>
</div>

