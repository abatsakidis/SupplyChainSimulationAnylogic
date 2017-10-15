
  <div class="page-content row">
    <!-- Page header -->
    <div class="page-header">
      <div class="page-title">
        <h3> {{ Lang::get('core.t_loginsecurity') }} <small> {{ Lang::get('core.t_loginsecuritysmall') }} </small></h3>
      </div>

		  <ul class="breadcrumb">
		   <li><a href="{{ URL::to('dashboard') }}">{{ Lang::get('core.home'); }}</a></li>
			<li><a href="{{ URL::to('config') }}">{{ Lang::get('core.t_loginsecurity') }}</a></li>
			
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
	  <li ><a href="{{ URL::to('config')}}"> {{ Lang::get('core.tab_siteinfo'); }} </a></li>
	  <li ><a href="{{ URL::to('config/email') }}" >{{ Lang::get('core.tab_email'); }}</a></li>
	  <li class="active"><a href="{{ URL::to('config/security') }}" > {{ Lang::get('core.tab_loginsecurity'); }}  </a></li>
	  <li ><a href="{{ URL::to('config/translation') }}" >  Translation  <sup class="badge " style="background:#5BC0DE" >New </sup> </a></li>
	  <li><a href="{{ URL::to('config/log') }}" >  Clear Cache & Logs  </a></li>
	</ul>	
<div class="tab-content">
	  <div class="tab-pane active use-padding row" id="info">	
	 {{ Form::open(array('url'=>'config/social/', 'class'=>'form-horizontal')) }}
	
	<div class="col-sm-6">
	
		<fieldset > <legend> {{ Lang::get('core.t_socialmedia') }}
			
		</legend>
		  <div class="form-group">
			<label for="ipt" class=" control-label col-sm-4"><i class="fa fa-facebook"></i> Login Facebook </label>	
			<div class="col-sm-8">
					<div >
						<label class="checkbox-inline">
						<input type="checkbox" name="FB_ENABLE"  value="true"
						@if($hybrid['providers']['Facebook']['enabled'] =='true') checked @endif
						 /> {{ Lang::get('core.fr_enable') }}
						</label>
					</div>				
				
				 	<label for="ipt" class=" control-label ">{{ Lang::get('core.fr_appid') }} </label>
				 	
					<input type="text" class="form-control" value="{{ $hybrid['providers']['Facebook']['keys']['id']}}" name="FB_ID"  />
					
					<label for="ipt" class=" control-label "> {{ Lang::get('core.fr_secret') }} </label>
					<input type="text" class="form-control" value="{{ $hybrid['providers']['Facebook']['keys']['secret']}}"  name="FB_SECRET"  /> 
				
							
			</div>	
					
		  </div>  
		
		  <div class="form-group">
			<label for="ipt" class=" control-label col-sm-4"><i class="fa fa-google-plus"></i> Login Google </label>	
			<div class="col-sm-8">
					<div >
						<label class="checkbox-inline">
						<input type="checkbox"  value="true" name="GOOGLE_ENABLE" @if($hybrid['providers']['Google']['enabled'] =='true') checked @endif/> {{ Lang::get('core.fr_enable') }}
						</label>
					</div>				
				
				 	<label for="ipt" class=" control-label "> {{ Lang::get('core.fr_appid') }} </label>
				 	
					<input type="text" class="form-control" name="GOOGLE_ID"  value="{{ $hybrid['providers']['Google']['keys']['id']}}" />
					
					<label for="ipt" class=" control-label "> {{ Lang::get('core.fr_secret') }}</label>
					<input type="text" class="form-control" name="GOOGLE_SECRET"  value="{{ $hybrid['providers']['Google']['keys']['secret']}}" /> 
				
							
			</div>	
					
		  </div>  
		  
		  <div class="form-group">
			<label for="ipt" class=" control-label col-sm-4"><i class="fa fa-twitter"></i> Login Twitter </label>	
			<div class="col-sm-8">
					<div >
						<label class="checkbox-inline">
						<input type="checkbox" value="true" name="TWIT_ENABLE" @if($hybrid['providers']['Twitter']['enabled'] =='true') checked @endif /> {{ Lang::get('core.fr_enable') }}
						</label>
					</div>				
				
				 	<label for="ipt" class=" control-label " >{{ Lang::get('core.fr_appid') }} </label>
				 	
					<input type="text" class="form-control" name="TWIT_ID" value="{{ $hybrid['providers']['Twitter']['keys']['key']}}"/>
					
					<label for="ipt" class=" control-label "> {{ Lang::get('core.fr_secret') }} </label>
					<input type="text" class="form-control" name="TWIT_SECRET" value="{{ $hybrid['providers']['Twitter']['keys']['secret']}}"/> 
				
							
			</div>	
					
		  </div>  
		  
		  		  
		<div class="form-group">   
			<label for="ipt" class=" control-label col-sm-4"> &nbsp;</label>	
			<div class="col-sm-8">
				<button class="btn btn-primary" type="submit"> {{ Lang::get('core.sb_savechanges') }}</button>	 
			</div>	
		</div>
	
  </fieldset>


</div> 

{{ Form::close() }}

 {{ Form::open(array('url'=>'config/login/', 'class'=>'form-horizontal')) }}
	<div class="col-sm-6">
	
	 <fieldset> <legend> {{ Lang::get('core.fr_registrationsetting') }} </legend>
  
		  <div class="form-group">
			<label for="ipt" class=" control-label col-sm-4"> {{ Lang::get('core.fr_registrationdefault') }}  </label>	
			<div class="col-sm-8">
					<div >
						<label class="checkbox-inline">
						<select class="form-control" name="CNF_GROUP">
							@foreach($groups as $group)
							<option value="{{ $group->group_id }}"
							 @if(CNF_GROUP == $group->group_id ) selected @endif
							>{{ $group->name }}</option>
							@endforeach
						</select>
						</label>
					</div>				
			</div>	
					
		  </div> 

		  <div class="form-group">
			<label for="ipt" class=" control-label col-sm-4">{{ Lang::get('core.fr_registration') }} </label>	
			<div class="col-sm-8">
					
					<label class="radio">
					<input type="radio" name="CNF_ACTIVATION" value="auto" @if(CNF_ACTIVATION =='auto') checked @endif /> 
					{{ Lang::get('core.fr_registrationauto') }}
					</label>
					
					<label class="radio">
					<input type="radio" name="CNF_ACTIVATION" value="manual" @if(CNF_ACTIVATION =='manual') checked @endif /> 
					{{ Lang::get('core.fr_registrationmanual') }}
					</label>								
					<label class="radio">
					<input type="radio" name="CNF_ACTIVATION" value="confirmation" @if(CNF_ACTIVATION =='confirmation') checked @endif/>
					{{ Lang::get('core.fr_registrationemail') }}
					</label>	
				
							
			</div>	
					
		  </div> 
		  
 		  <div class="form-group">
			<label for="ipt" class=" control-label col-sm-4"> Allow Registration </label>	
			<div class="col-sm-8">
					<label class="checkbox">
					<input type="checkbox" name="CNF_REGIST" value="true"  @if(CNF_REGIST =='true') checked @endif/> 
					{{ Lang::get('core.fr_enable') }}
					</label>			
			</div>
		</div>	
		
 		  <div class="form-group">
			<label for="ipt" class=" control-label col-sm-4"> Allow Frontend </label>	
			<div class="col-sm-8">
					<label class="checkbox">
					<input type="checkbox" name="CNF_FRONT" value="false" @if(CNF_FRONT =='true') checked @endif/> 
					{{ Lang::get('core.fr_enable') }}
					</label>			
			</div>
		</div>		
		
 		  <div class="form-group">
			<label for="ipt" class=" control-label col-sm-4"> Recaptcha </label>	
			<div class="col-sm-8">
					<label class="checkbox">
					<input type="checkbox" name="CNF_RECAPTCHA" value="false" @if(CNF_RECAPTCHA =='true') checked @endif/> 
					{{ Lang::get('core.fr_enable') }}
					</label>	
					
				 	<label for="ipt" class=" control-label "> Public Key </label>
				 	
					<input type="text" class="form-control" name="CNF_RECAPTCHAPUBLICKEY"  value="{{ CNF_RECAPTCHAPUBLICKEY }}" />
					
					<label for="ipt" class=" control-label "> Private Key:</label>
					<input type="text" class="form-control" name="CNF_RECAPTCHAPRIVATEKEY"  value="{{ CNF_RECAPTCHAPRIVATEKEY}}" /> 							
			</div>
		</div>				
		  		  
	  <div class="form-group">
		<label for="ipt" class=" control-label col-md-4">&nbsp;</label>
		<div class="col-md-8">
			<button class="btn btn-primary" type="submit"> {{ Lang::get('core.sb_savechanges') }}</button>
		 </div> 
	 
	  </div>	  
	 </fieldset>    
 	
 </div>
 {{ Form::close() }}
</div>
</div>
</div>
</div>





