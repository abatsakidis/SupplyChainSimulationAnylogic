{{ Form::open(array('url'=>'Factory/save/'.SiteHelpers::encryptID($row['id']), 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ','id'=> 'FactoryFormAjax')) }}
<div class="col-md-12">
						<fieldset><legend> Factory</legend>
									
								  <div class="form-group hidethis " style="display:none;">
									<label for="Id" class=" control-label col-md-4 text-left"> 
									{{ SiteHelpers::activeLang('Id', (isset($fields['id']['language'])? $fields['id']['language'] : array())) }} </label>
									<div class="col-md-6">
									  {{ Form::text('id', $row['id'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="ManufacturingSetupCost" class=" control-label col-md-4 text-left"> 
									{{ SiteHelpers::activeLang('ManufacturingSetupCost', (isset($fields['ManufacturingSetupCost']['language'])? $fields['ManufacturingSetupCost']['language'] : array())) }} </label>
									<div class="col-md-6">
									  {{ Form::text('ManufacturingSetupCost', $row['ManufacturingSetupCost'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="ManufacturingCostPerItem" class=" control-label col-md-4 text-left"> 
									{{ SiteHelpers::activeLang('ManufacturingCostPerItem', (isset($fields['ManufacturingCostPerItem']['language'])? $fields['ManufacturingCostPerItem']['language'] : array())) }} </label>
									<div class="col-md-6">
									  {{ Form::text('ManufacturingCostPerItem', $row['ManufacturingCostPerItem'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="HoldingCostPerItemPerDay" class=" control-label col-md-4 text-left"> 
									{{ SiteHelpers::activeLang('HoldingCostPerItemPerDay', (isset($fields['HoldingCostPerItemPerDay']['language'])? $fields['HoldingCostPerItemPerDay']['language'] : array())) }} </label>
									<div class="col-md-6">
									  {{ Form::text('HoldingCostPerItemPerDay', $row['HoldingCostPerItemPerDay'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="ShortageCostPerItemPerDay" class=" control-label col-md-4 text-left"> 
									{{ SiteHelpers::activeLang('ShortageCostPerItemPerDay', (isset($fields['ShortageCostPerItemPerDay']['language'])? $fields['ShortageCostPerItemPerDay']['language'] : array())) }} </label>
									<div class="col-md-6">
									  {{ Form::text('ShortageCostPerItemPerDay', $row['ShortageCostPerItemPerDay'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
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
		
		var form = $('#FactoryFormAjax'); 
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