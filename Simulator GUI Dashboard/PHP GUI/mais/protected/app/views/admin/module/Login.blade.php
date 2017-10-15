 <div style="width:350px; margin:50px auto"> 
 <div class="sbox">
 	<div class="sbox-title"><h5> Client Login </h5> </div>
	<div class="sbox-content">
		
	<p class="text-muted">Please login using your envato purchase code   </p>
	<hr />
	<div id="result"></div>
	  {{ Form::open(array('url'=>'authen/validate', 'class'=>'form-vertical' ,'id'=>'clientValidate' ,'parsley-validate'=>'','novalidate'=>' ')) }}
	
 	<div class="form-group has-feedback">
		<label> Email Registered On <a href="http://sximobuilder.com" target="_blank">Sximobuilder.com</a> <br />
		<small style="font-weight:normal;"> If you dont have yet , then system will create it automatic .<br /> please use valid email , we will send You  user and password </small>
		</label>
		{{ Form::text('puname', null, array('class'=>'form-control', 'placeholder'=>'Your Email Address','required'=>'','data-parsley-type'=>'email')) }}
		<i class="icon-users form-control-feedback"></i>
	</div>
	
	<div class="form-group has-feedback">
		<label>Envanto Purchased code	</label>
		{{ Form::text('pcode', null, array('class'=>'form-control', 'placeholder'=>'Envanto Purchased code ','required'=>'')) }}
		<i class="icon-lock form-control-feedback"></i>
	</div>
		<div class="form-group ">        
          <button type="submit" class="btn btn-primary "> Validate </button>        
      </div>
	  <strong> Note </strong>
	  <p><small> By registering your purchased code and email  , you can always keep your licence save from being used by other users </small> </p>

		{{ Form::close() }}	
	</div>
</div>
</div>	

<script type="text/javascript">
$(document).ready(function() { 
	var form = $('#clientValidate'); 
	form.parsley();
	form.submit(function(){
		if(form.parsley('isValid') == true){	
			$('#result').html('Please wait ... Validating purchased code <br /><br />');
			var data =  $('#clientValidate').serialize();
			var url = $(this).attr('action');
			$.post(url,data,function(data){
				if(data.status =='success')
				{
					$('#result').html(data.message);
					window.location.href = '{{ URL::to("module") }}';
				}	else {
					$('#result').html(data.message);
				}
			}, "json");
			
			return false;
		} else {
			return false;
		}	
	});
});
</script>