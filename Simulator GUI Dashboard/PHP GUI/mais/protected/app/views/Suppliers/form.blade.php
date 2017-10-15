{{ Form::open(array('url'=>'Suppliers/save/'.SiteHelpers::encryptID($row['SupplierID']), 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ','id'=> 'SuppliersFormAjax')) }}
<div class="col-md-12">
						<fieldset><legend> Suppliers</legend>
									
								  <div class="form-group hidethis " style="display:none;">
									<label for="Κωδικός προμηθευτή" class=" control-label col-md-4 text-left"> 
									{{ SiteHelpers::activeLang('Κωδικός προμηθευτή', (isset($fields['SupplierID']['language'])? $fields['SupplierID']['language'] : array())) }} </label>
									<div class="col-md-6">
									  {{ Form::text('SupplierID', $row['SupplierID'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Όνομα εταιρίας" class=" control-label col-md-4 text-left"> 
									{{ SiteHelpers::activeLang('Όνομα εταιρίας', (isset($fields['CompanyName']['language'])? $fields['CompanyName']['language'] : array())) }} </label>
									<div class="col-md-6">
									  {{ Form::text('CompanyName', $row['CompanyName'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Όνομα επαφής" class=" control-label col-md-4 text-left"> 
									{{ SiteHelpers::activeLang('Όνομα επαφής', (isset($fields['ContactName']['language'])? $fields['ContactName']['language'] : array())) }} </label>
									<div class="col-md-6">
									  {{ Form::text('ContactName', $row['ContactName'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Τίτλος επαφής" class=" control-label col-md-4 text-left"> 
									{{ SiteHelpers::activeLang('Τίτλος επαφής', (isset($fields['ContactTitle']['language'])? $fields['ContactTitle']['language'] : array())) }} </label>
									<div class="col-md-6">
									  {{ Form::text('ContactTitle', $row['ContactTitle'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Διεύθυνση" class=" control-label col-md-4 text-left"> 
									{{ SiteHelpers::activeLang('Διεύθυνση', (isset($fields['Address']['language'])? $fields['Address']['language'] : array())) }} </label>
									<div class="col-md-6">
									  {{ Form::text('Address', $row['Address'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Πόλη" class=" control-label col-md-4 text-left"> 
									{{ SiteHelpers::activeLang('Πόλη', (isset($fields['City']['language'])? $fields['City']['language'] : array())) }} </label>
									<div class="col-md-6">
									  {{ Form::text('City', $row['City'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Περιοχή" class=" control-label col-md-4 text-left"> 
									{{ SiteHelpers::activeLang('Περιοχή', (isset($fields['Region']['language'])? $fields['Region']['language'] : array())) }} </label>
									<div class="col-md-6">
									  {{ Form::text('Region', $row['Region'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Τ.Κ." class=" control-label col-md-4 text-left"> 
									{{ SiteHelpers::activeLang('Τ.Κ.', (isset($fields['PostalCode']['language'])? $fields['PostalCode']['language'] : array())) }} </label>
									<div class="col-md-6">
									  {{ Form::text('PostalCode', $row['PostalCode'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Χώρα" class=" control-label col-md-4 text-left"> 
									{{ SiteHelpers::activeLang('Χώρα', (isset($fields['Country']['language'])? $fields['Country']['language'] : array())) }} </label>
									<div class="col-md-6">
									  {{ Form::text('Country', $row['Country'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Τηλέφωνο" class=" control-label col-md-4 text-left"> 
									{{ SiteHelpers::activeLang('Τηλέφωνο', (isset($fields['Phone']['language'])? $fields['Phone']['language'] : array())) }} </label>
									<div class="col-md-6">
									  {{ Form::text('Phone', $row['Phone'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Fax" class=" control-label col-md-4 text-left"> 
									{{ SiteHelpers::activeLang('Fax', (isset($fields['Fax']['language'])? $fields['Fax']['language'] : array())) }} </label>
									<div class="col-md-6">
									  {{ Form::text('Fax', $row['Fax'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Website" class=" control-label col-md-4 text-left"> 
									{{ SiteHelpers::activeLang('Website', (isset($fields['HomePage']['language'])? $fields['HomePage']['language'] : array())) }} </label>
									<div class="col-md-6">
									  {{ Form::text('HomePage', $row['HomePage'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> </fieldset>
			</div>
			
												
					
			
<div style="clear:both"></div>	
				
<div class="form-group">
	<label class="col-sm-4 text-right">&nbsp;</label>
	<div class="col-sm-8">	
		<button type="submit" class="btn btn-primary btn-sm ">  {{ Lang::get('core.sb_save') }} </button>
		<button type="button" onclick="$('#sximo-modal').modal('hide')" id="submit" class="btn btn-success btn-sm">  {{ Lang::get('core.sb_cancel') }} </button>
	</div>			
</div> 		 
{{ Form::close() }}

			 
   <script type="text/javascript">
	$(document).ready(function() { 
		 
		
		$('.previewImage').fancybox();	
		$('.tips').tooltip();	
		$(".select2").select2({ width:"98%"});	
		$('.date').datepicker({format:'yyyy-mm-dd',autoClose:true})
		$('.datetime').datetimepicker({format: 'yyyy-mm-dd hh:ii:ss'}); 
		 $('.markItUp').markItUp(mySettings );				
		
		var form = $('#SuppliersFormAjax'); 
		form.parsley();
		form.submit(function(){
			
			if(form.parsley('isValid') == true){			
				var options = { 
					dataType:      'json', 
					beforeSubmit :  showRequest,
					success:       showResponse  
				}  
				$(this).ajaxSubmit(options); 
				return false;
							
			} else {
				return false;
			}		
		
		});

	});
	
	function showRequest()
	{
		$('.formLoading').show();	
	}  
	function showResponse(data)  {		
		
		if(data.status == 'success')
		{
			$( ".resultData" ).html( data.message );
			$('#sximo-modal').modal('hide')	;	
			ajaxFilter('#{{ $pageModule }}','{{ $pageUrl }}/data');
		} else {
			$( ".{{ $pageModule }}FR" ).html( data.message );
			return false;
		}	
	}			 
	
	</script>		 