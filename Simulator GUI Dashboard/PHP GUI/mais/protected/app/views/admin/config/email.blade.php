
  <div class="page-content row">
    <!-- Page header -->
    <div class="page-header">
      <div class="page-title">
        <h3> {{ Lang::get('core.t_blastemail') }}  <small>{{ Lang::get('core.t_blastemailsmall'); }}</small></h3>
      </div>
   
      <ul class="breadcrumb">
        <li><a href="{{ URL::to('dashboard') }}">{{ Lang::get('core.home'); }}</a></li>
		<li><a href="{{ URL::to('config') }}">{{ Lang::get('core.t_blastemail') }}</a></li>
		
      </ul>
	  
	  
    </div>

 <div class="page-content-wrapper">  
	@if(Session::has('message'))
	  
		   {{ Session::get('message') }}
	   
	@endif
	<ul class="parsley-error-list">
		@foreach($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
	</ul>		
<div class="block-content">
	<ul class="nav nav-tabs" >
	  <li ><a href="{{ URL::to('config')}}">{{ Lang::get('core.tab_siteinfo'); }} </a></li>
	  <li class="active"><a href="{{ URL::to('config/email') }}" >{{ Lang::get('core.tab_email'); }}</a></li>
	  <li ><a href="{{ URL::to('config/security') }}" > {{ Lang::get('core.tab_loginsecurity'); }}  </a></li>
	  <li ><a href="{{ URL::to('config/translation') }}" >  Translation  <sup class="badge " style="background:#5BC0DE" >New </sup> </a></li>
	    <li ><a href="{{ URL::to('config/log') }}" >  Clear Cache & Logs  </a></li>
	</ul>	
<div class="tab-content">
	  <div class="tab-pane active use-padding" id="info">	
	 {{ Form::open(array('url'=>'config/email/', 'class'=>'form-vertical row')) }}
	
	<div class="col-sm-6">
	
		<fieldset > <legend> New Account Registered Info </legend>
		  <div class="form-group">
			<label for="ipt" class=" control-label"> {{ Lang::get('core.tab_email'); }} </label>		
			<textarea rows="20" name="regEmail" class="form-control input-sm  markItUp">{{ $regEmail }}</textarea>		
		  </div>  
		

		<div class="form-group">   
			<button class="btn btn-primary" type="submit"> {{ Lang::get('core.sb_savechanges'); }}</button>	 
		</div>
	
  	</fieldset>


</div> 


	<div class="col-sm-6">
	
	 <fieldset> <legend> {{ Lang::get('core.forgotpassword'); }} </legend>
  
		
		  <div class="form-group">
			<label for="ipt" class=" control-label ">{{ Lang::get('core.tab_email'); }} </label>
			
			<textarea rows="20" name="resetEmail" class="form-control input-sm markItUp">{{ $resetEmail }}</textarea>
			 
		  </div> 
	  <div class="form-group">
		<label for="ipt" class=" control-label col-md-4">&nbsp;</label>
		<div class="col-md-8">
			<button class="btn btn-primary" type="submit">{{ Lang::get('core.sb_savechanges'); }}</button>
		 </div> 
	 
	  </div>	  
	 </fieldset>    
 	
 </div>
 {{ Form::close() }}
</div>
</div>
</div>
</div>





