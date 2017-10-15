
<!-- Login wrapper -->
<div class="login-wrapper">
<div class="panel panel-success">
<div class="panel-heading"><span class="text-semibold"><i class="icon-user-plus"></i> {{ CNF_APPNAME}}</span></div>
	<div class="panel-body">
		{{ Form::open(array('url' => 'user/doreset/'.$verCode, 'class'=>'form-vertical')) }}
	
	    	@if(Session::has('message'))
				{{ Session::get('message') }}
			@endif
				

		<div class="form-group has-feedback">
			<ul class="parsley-error-list">
				@foreach($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>			
		</div>			
				
		<div class="form-group has-feedback">
			<label>New Password </label>
			{{ Form::password('password',  array('class'=>'form-control', 'placeholder'=>'New Password')) }}
			<i class="icon-lock form-control-feedback"></i>
		</div>
		
		  <div class="form-group has-feedback">
			<label>Re-type Password</label>
		   {{ Form::password('password_confirmation', array('class'=>'form-control', 'placeholder'=>'Confirm Password')) }}
			<i class="icon-lock form-control-feedback"></i>
		</div>
      <div class="form-group has-feedback">
			<div class="col-xs-6">
			  <button type="submit" class="btn btn-success pull-right">Reset My Password</button>
			</div>
      </div>
	  		
	
	 {{ Form::close() }}
	 </div>
</div> 
</div>
<!-- /login wrapper -->