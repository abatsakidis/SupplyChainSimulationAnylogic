<div class="sbox">
	<div class="sbox-title">
			
				<h3 >{{ CNF_APPNAME }}</h3>
				
	</div>
	<div class="sbox-content">
 {{ Form::open(array('url'=>'user/create', 'class'=>'form-signup')) }}
	    	@if(Session::has('message'))
				{{ Session::get('message') }}
			@endif
		<ul class="parsley-error-list">
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	
	<div class="form-group has-feedback">
		<label>{{ Lang::get('core.firstname'); }}	 </label>
	  {{ Form::text('firstname', null, array('class'=>'form-control', 'placeholder'=>'First Name' ,'required'=>'' )) }}
		<i class="icon-users form-control-feedback"></i>
	</div>
	
	<div class="form-group has-feedback">
		<label>{{ Lang::get('core.lastname'); }}	 </label>
	 {{ Form::text('lastname', null, array('class'=>'form-control', 'placeholder'=>'Last Name','required'=>'')) }}
		<i class="icon-users form-control-feedback"></i>
	</div>
	
	<div class="form-group has-feedback">
		<label>{{ Lang::get('core.email'); }}	 </label>
	 {{ Form::text('email', null, array('class'=>'form-control', 'placeholder'=>'Email Address','required'=>'email')) }}
		<i class="icon-envelop form-control-feedback"></i>
	</div>
	
	<div class="form-group has-feedback">
		<label>{{ Lang::get('core.password'); }}	</label>
	 {{ Form::password('password', array('class'=>'form-control', 'placeholder'=>'Password','required'=>'')) }}
		<i class="icon-lock form-control-feedback"></i>
	</div>
	
	<div class="form-group has-feedback">
		<label>{{ Lang::get('core.repassword'); }}	</label>
	 {{ Form::password('password_confirmation', array('class'=>'form-control', 'placeholder'=>'Confirm Password','required'=>'')) }}
		<i class="icon-lock form-control-feedback"></i>
	</div>
	@if(CNF_RECAPTCHA =='true') 
	<div class="form-group has-feedback">
		<label> Are u human ? </label>
		{{ Form::captcha(array('theme' => 'white')); }}
	</div>	
 	@endif						

      <div class="row form-actions">
        <div class="col-sm-12">
          <button type="submit" style="width:100%;" class="btn btn-primary pull-right"><i class="icon-user-plus"></i> {{ Lang::get('core.signup'); }}	</button>
       </div>
      </div>
	  <p style="padding:10px 0" class="text-center">
	  <a href="{{ URL::to('user/login')}}"> Back to Login </a> | <a href="{{ URL::to('')}}"> Back to Site </a> 
   		</p>
 {{ Form::close() }}
 </div>
</div> 
