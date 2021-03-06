{{ Form::open(array('url'=>'Employees/save/'.SiteHelpers::encryptID($row['EmployeeID']), 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ','id'=> 'EmployeesFormAjax')) }}
<div class="col-md-12">
						<fieldset><legend> Employees</legend>
									
								  <div class="form-group hidethis " style="display:none;">
									<label for="Κωδικός εργαζόμενου" class=" control-label col-md-4 text-left"> 
									{{ SiteHelpers::activeLang('Κωδικός εργαζόμενου', (isset($fields['EmployeeID']['language'])? $fields['EmployeeID']['language'] : array())) }} </label>
									<div class="col-md-6">
									  {{ Form::text('EmployeeID', $row['EmployeeID'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Επώνυμο" class=" control-label col-md-4 text-left"> 
									{{ SiteHelpers::activeLang('Επώνυμο', (isset($fields['LastName']['language'])? $fields['LastName']['language'] : array())) }} </label>
									<div class="col-md-6">
									  {{ Form::text('LastName', $row['LastName'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Όνομα" class=" control-label col-md-4 text-left"> 
									{{ SiteHelpers::activeLang('Όνομα', (isset($fields['FirstName']['language'])? $fields['FirstName']['language'] : array())) }} </label>
									<div class="col-md-6">
									  {{ Form::text('FirstName', $row['FirstName'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Θέση" class=" control-label col-md-4 text-left"> 
									{{ SiteHelpers::activeLang('Θέση', (isset($fields['Title']['language'])? $fields['Title']['language'] : array())) }} </label>
									<div class="col-md-6">
									  {{ Form::text('Title', $row['Title'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Τίτλος ευγενείας" class=" control-label col-md-4 text-left"> 
									{{ SiteHelpers::activeLang('Τίτλος ευγενείας', (isset($fields['TitleOfCourtesy']['language'])? $fields['TitleOfCourtesy']['language'] : array())) }} </label>
									<div class="col-md-6">
									  {{ Form::text('TitleOfCourtesy', $row['TitleOfCourtesy'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Ημερομηνία γέννησης" class=" control-label col-md-4 text-left"> 
									{{ SiteHelpers::activeLang('Ημερομηνία γέννησης', (isset($fields['BirthDate']['language'])? $fields['BirthDate']['language'] : array())) }} </label>
									<div class="col-md-6">
									  
				{{ Form::text('BirthDate', $row['BirthDate'],array('class'=>'form-control datetime', 'style'=>'width:150px !important;')) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Ημερομηνία πρόσληψης" class=" control-label col-md-4 text-left"> 
									{{ SiteHelpers::activeLang('Ημερομηνία πρόσληψης', (isset($fields['HireDate']['language'])? $fields['HireDate']['language'] : array())) }} </label>
									<div class="col-md-6">
									  
				{{ Form::text('HireDate', $row['HireDate'],array('class'=>'form-control datetime', 'style'=>'width:150px !important;')) }} 
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
									{{ SiteHelpers::activeLang('Τηλέφωνο', (isset($fields['HomePhone']['language'])? $fields['HomePhone']['language'] : array())) }} </label>
									<div class="col-md-6">
									  {{ Form::text('HomePhone', $row['HomePhone'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Extension" class=" control-label col-md-4 text-left"> 
									{{ SiteHelpers::activeLang('Extension', (isset($fields['Extension']['language'])? $fields['Extension']['language'] : array())) }} </label>
									<div class="col-md-6">
									  {{ Form::text('Extension', $row['Extension'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Φωτογραφία" class=" control-label col-md-4 text-left"> 
									{{ SiteHelpers::activeLang('Φωτογραφία', (isset($fields['Photo']['language'])? $fields['Photo']['language'] : array())) }} </label>
									<div class="col-md-6">
									  {{ Form::text('Photo', $row['Photo'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Σημειώσεις" class=" control-label col-md-4 text-left"> 
									{{ SiteHelpers::activeLang('Σημειώσεις', (isset($fields['Notes']['language'])? $fields['Notes']['language'] : array())) }} </label>
									<div class="col-md-6">
									  {{ Form::text('Notes', $row['Notes'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Αναφέρεται στον/στην" class=" control-label col-md-4 text-left"> 
									{{ SiteHelpers::activeLang('Αναφέρεται στον/στην', (isset($fields['ReportsTo']['language'])? $fields['ReportsTo']['language'] : array())) }} </label>
									<div class="col-md-6">
									  {{ Form::text('ReportsTo', $row['ReportsTo'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Μισθός" class=" control-label col-md-4 text-left"> 
									{{ SiteHelpers::activeLang('Μισθός', (isset($fields['Salary']['language'])? $fields['Salary']['language'] : array())) }} </label>
									<div class="col-md-6">
									  {{ Form::text('Salary', $row['Salary'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
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
		
		var form = $('#EmployeesFormAjax'); 
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