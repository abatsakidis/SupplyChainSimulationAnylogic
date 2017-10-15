{{ Form::open(array('url'=>'Products/save/'.SiteHelpers::encryptID($row['ProductID']), 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ','id'=> 'ProductsFormAjax')) }}
<div class="col-md-12">
						<fieldset><legend> Products</legend>
									
								  <div class="form-group hidethis " style="display:none;">
									<label for="Κωδικός προϊόντος" class=" control-label col-md-4 text-left"> 
									{{ SiteHelpers::activeLang('Κωδικός προϊόντος', (isset($fields['ProductID']['language'])? $fields['ProductID']['language'] : array())) }} </label>
									<div class="col-md-6">
									  {{ Form::text('ProductID', $row['ProductID'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Όνομα" class=" control-label col-md-4 text-left"> 
									{{ SiteHelpers::activeLang('Όνομα', (isset($fields['ProductName']['language'])? $fields['ProductName']['language'] : array())) }} </label>
									<div class="col-md-6">
									  {{ Form::text('ProductName', $row['ProductName'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Προμηθευτής" class=" control-label col-md-4 text-left"> 
									{{ SiteHelpers::activeLang('Προμηθευτής', (isset($fields['SupplierID']['language'])? $fields['SupplierID']['language'] : array())) }} </label>
									<div class="col-md-6">
									  <select name='SupplierID' rows='5' id='SupplierID' code='{$SupplierID}' 
							class='select2 '    ></select> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Κατηγορία" class=" control-label col-md-4 text-left"> 
									{{ SiteHelpers::activeLang('Κατηγορία', (isset($fields['CategoryID']['language'])? $fields['CategoryID']['language'] : array())) }} </label>
									<div class="col-md-6">
									  <select name='CategoryID' rows='5' id='CategoryID' code='{$CategoryID}' 
							class='select2 '    ></select> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Ποσότητα ανά μονάδα" class=" control-label col-md-4 text-left"> 
									{{ SiteHelpers::activeLang('Ποσότητα ανά μονάδα', (isset($fields['QuantityPerUnit']['language'])? $fields['QuantityPerUnit']['language'] : array())) }} </label>
									<div class="col-md-6">
									  {{ Form::text('QuantityPerUnit', $row['QuantityPerUnit'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Τιμή μονάδας" class=" control-label col-md-4 text-left"> 
									{{ SiteHelpers::activeLang('Τιμή μονάδας', (isset($fields['UnitPrice']['language'])? $fields['UnitPrice']['language'] : array())) }} </label>
									<div class="col-md-6">
									  {{ Form::text('UnitPrice', $row['UnitPrice'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Ποσότητα σε απόθεμα" class=" control-label col-md-4 text-left"> 
									{{ SiteHelpers::activeLang('Ποσότητα σε απόθεμα', (isset($fields['UnitsInStock']['language'])? $fields['UnitsInStock']['language'] : array())) }} </label>
									<div class="col-md-6">
									  {{ Form::text('UnitsInStock', $row['UnitsInStock'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Ποσότητα σε παραγγελία" class=" control-label col-md-4 text-left"> 
									{{ SiteHelpers::activeLang('Ποσότητα σε παραγγελία', (isset($fields['UnitsOnOrder']['language'])? $fields['UnitsOnOrder']['language'] : array())) }} </label>
									<div class="col-md-6">
									  {{ Form::text('UnitsOnOrder', $row['UnitsOnOrder'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="ReorderLevel" class=" control-label col-md-4 text-left"> 
									{{ SiteHelpers::activeLang('ReorderLevel', (isset($fields['ReorderLevel']['language'])? $fields['ReorderLevel']['language'] : array())) }} </label>
									<div class="col-md-6">
									  {{ Form::text('ReorderLevel', $row['ReorderLevel'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Κατάσταση" class=" control-label col-md-4 text-left"> 
									{{ SiteHelpers::activeLang('Κατάσταση', (isset($fields['Discontinued']['language'])? $fields['Discontinued']['language'] : array())) }} </label>
									<div class="col-md-6">
									  
					<?php $Discontinued = explode(',',$row['State']);
					$Discontinued_opt = array( '0' => 'Ενεργό' ,  '1' => 'Ανενεργό' , ); ?>
					<select name='Discontinued' rows='5'   class='select2 '  > 
						<?php 
						foreach($Discontinued_opt as $key=>$val)
						{
							echo "<option  value ='$key' ".($row['Discontinued'] == $key ? " selected='selected' " : '' ).">$val</option>"; 						
						}						
						?></select> 
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
		
		$("#SupplierID").jCombo("{{ URL::to('Products/comboselect?filter=suppliers:SupplierID:CompanyName') }}",
		{  selected_value : '{{ $row["SupplierID"] }}' });
		
		$("#CategoryID").jCombo("{{ URL::to('Products/comboselect?filter=categories:CategoryID:CategoryName') }}",
		{  selected_value : '{{ $row["CategoryID"] }}' });
		 
		
		$('.previewImage').fancybox();	
		$('.tips').tooltip();	
		$(".select2").select2({ width:"98%"});	
		$('.date').datepicker({format:'yyyy-mm-dd',autoClose:true})
		$('.datetime').datetimepicker({format: 'yyyy-mm-dd hh:ii:ss'}); 
		 $('.markItUp').markItUp(mySettings );				
		
		var form = $('#ProductsFormAjax'); 
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