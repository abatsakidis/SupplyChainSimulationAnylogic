
  <div class="page-content row">
    <!-- Page header -->
    <div class="page-header">
      <div class="page-title">
        <h3> Translation   <small> Manage Language Translation </small></h3>
      </div>

		  <ul class="breadcrumb">
			<li><a href="{{ URL::to('dashboard') }}">{{ Lang::get('core.home'); }}</a></li>
			<li><a href="{{ URL::to('config') }}"> Languange Manager </a></li>
		  </ul>
			  
	  
    </div>


	<div class="page-content-wrapper m-t">  	
	<ul class="nav nav-tabs" >
	  <li ><a href="{{ URL::to('config')}}">{{ Lang::get('core.tab_siteinfo'); }} </a></li>
	  <li ><a href="{{ URL::to('config/email') }}" >{{ Lang::get('core.tab_email'); }}</a></li>
	  <li ><a href="{{ URL::to('config/security') }}" > {{ Lang::get('core.tab_loginsecurity'); }}  </a></li>
	  <li class="active" ><a href="{{ URL::to('config/translation') }}" >  Translation  <sup class="badge " style="background:#5BC0DE" >New </sup> </a></li>
	    <li  ><a href="{{ URL::to('config/log') }}" >  Clear Cache & Logs  </a></li>
	</ul>	
	 <div class="tab-pane active use-padding" id="info">	
<div class="tab-content">
	 

	@if(Session::has('message'))
	  
		   {{ Session::get('message') }}
	   
	@endif
	<ul class="parsley-error-list">
		@foreach($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
	</ul>	  
	  
	 {{ Form::open(array('url'=>'config/translation/', 'class'=>'form-vertical row')) }}
	
	<div class="col-sm-9 m-t">
		<h4> Languange Manager </h4>
		<hr />
		<a href="{{ URL::to('config/addtranslation')}} " onclick="SximoModal(this.href,'Add New Language');return false;" class="btn btn-success"> Add New Translation </a>  
		<hr />
		<table class="table table-striped">
			<thead>
				<tr>
					<th> Name </th>
					<th> Folder </th>
					<th> Author </th>
					<th> Action </th>
				</tr>
			</thead>
			<tbody>		
		
			@foreach(SiteHelpers::langOption() as $lang)
				<tr>
					<td>  {{  $lang['name'] }}   </td>
					<td> {{  $lang['folder'] }} </td>
					<td> {{  $lang['author'] }} </td>
				  	<td>
					@if($lang['folder'] !='en')
					<a href="{{ URL::to('config/translation?edit='.$lang['folder'])}} " class="btn btn-sm btn-primary"> Manage </a>
					<a href="{{ URL::to('config/removetranslation/'.$lang['folder'])}} " class="btn btn-sm btn-danger"> Delete </a> 
					 
					@endif 
				
				</td>
				</tr>
			@endforeach
			
			</tbody>
		</table>
	</div> 


 	
 </div>
 {{ Form::close() }}
</div>
</div>
</div>
</div>





