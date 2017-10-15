
  <div class="page-content row">
    <!-- Page header -->
    <div class="page-header">
      <div class="page-title">
        <h3> {{ $pageTitle }} <small>{{ $pageNote }}</small></h3>
      </div>
      <ul class="breadcrumb">
        <li><a href="{{ URL::to('dashboard') }}">{{ Lang::get('core.home') }}</a></li>
		<li><a href="{{ URL::to('Orders?md='.$filtermd) }}">{{ $pageTitle }}</a></li>
        <li class="active">{{ Lang::get('core.addedit') }} </li>
      </ul>
	  	  
    </div>
 
 	<div class="page-content-wrapper">
	<div class="panel-default panel">
		<div class="panel-body">
		@if(Session::has('message'))	  
			   {{ Session::get('message') }}
		@endif	
		<ul class="parsley-error-list">
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
		 {{ Form::open(array('url'=>'Orders/save/'.SiteHelpers::encryptID($row['OrderID']).'?md='.$filtermd.$trackUri, 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) }}
				<div class="col-md-12">
						<fieldset><legend> Orders</legend>
									
								  <div class="form-group hidethis " style="display:none;">
									<label for="Κωδικός παραγγελίας" class=" control-label col-md-4 text-left"> 
									{{ SiteHelpers::activeLang('Κωδικός παραγγελίας', (isset($fields['OrderID']['language'])? $fields['OrderID']['language'] : array())) }} </label>
									<div class="col-md-6">
									  {{ Form::text('OrderID', $row['OrderID'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Πελάτης" class=" control-label col-md-4 text-left"> 
									{{ SiteHelpers::activeLang('Πελάτης', (isset($fields['CustomerID']['language'])? $fields['CustomerID']['language'] : array())) }} </label>
									<div class="col-md-6">
									  <select name='CustomerID' rows='5' id='CustomerID' code='{$CustomerID}' 
							class='select2 '    ></select> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Υπάλληλος" class=" control-label col-md-4 text-left"> 
									{{ SiteHelpers::activeLang('Υπάλληλος', (isset($fields['EmployeeID']['language'])? $fields['EmployeeID']['language'] : array())) }} </label>
									<div class="col-md-6">
									  <select name='EmployeeID' rows='5' id='EmployeeID' code='{$EmployeeID}' 
							class='select2 '    ></select> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Ημερομηνία παραγγελίας" class=" control-label col-md-4 text-left"> 
									{{ SiteHelpers::activeLang('Ημερομηνία παραγγελίας', (isset($fields['OrderDate']['language'])? $fields['OrderDate']['language'] : array())) }} </label>
									<div class="col-md-6">
									  
				{{ Form::text('OrderDate', $row['OrderDate'],array('class'=>'form-control datetime', 'style'=>'width:150px !important;')) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Ημερομηνία αποστολής" class=" control-label col-md-4 text-left"> 
									{{ SiteHelpers::activeLang('Ημερομηνία αποστολής', (isset($fields['ShippedDate']['language'])? $fields['ShippedDate']['language'] : array())) }} </label>
									<div class="col-md-6">
									  
				{{ Form::text('ShippedDate', $row['ShippedDate'],array('class'=>'form-control datetime', 'style'=>'width:150px !important;')) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Όνομα αποστολής" class=" control-label col-md-4 text-left"> 
									{{ SiteHelpers::activeLang('Όνομα αποστολής', (isset($fields['ShipName']['language'])? $fields['ShipName']['language'] : array())) }} </label>
									<div class="col-md-6">
									  {{ Form::text('ShipName', $row['ShipName'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Διεύθυνση αποστολής" class=" control-label col-md-4 text-left"> 
									{{ SiteHelpers::activeLang('Διεύθυνση αποστολής', (isset($fields['ShipAddress']['language'])? $fields['ShipAddress']['language'] : array())) }} </label>
									<div class="col-md-6">
									  {{ Form::text('ShipAddress', $row['ShipAddress'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Πόλη αποστολής" class=" control-label col-md-4 text-left"> 
									{{ SiteHelpers::activeLang('Πόλη αποστολής', (isset($fields['ShipCity']['language'])? $fields['ShipCity']['language'] : array())) }} </label>
									<div class="col-md-6">
									  {{ Form::text('ShipCity', $row['ShipCity'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Περιοχή αποστολής" class=" control-label col-md-4 text-left"> 
									{{ SiteHelpers::activeLang('Περιοχή αποστολής', (isset($fields['ShipRegion']['language'])? $fields['ShipRegion']['language'] : array())) }} </label>
									<div class="col-md-6">
									  {{ Form::text('ShipRegion', $row['ShipRegion'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Τ.Κ. αποστολής" class=" control-label col-md-4 text-left"> 
									{{ SiteHelpers::activeLang('Τ.Κ. αποστολής', (isset($fields['ShipPostalCode']['language'])? $fields['ShipPostalCode']['language'] : array())) }} </label>
									<div class="col-md-6">
									  {{ Form::text('ShipPostalCode', $row['ShipPostalCode'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Χώρα αποστολής" class=" control-label col-md-4 text-left"> 
									{{ SiteHelpers::activeLang('Χώρα αποστολής', (isset($fields['ShipCountry']['language'])? $fields['ShipCountry']['language'] : array())) }} </label>
									<div class="col-md-6">
									  {{ Form::text('ShipCountry', $row['ShipCountry'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> </fieldset>
			</div>
			
			
			<div style="clear:both"></div>	
				
			  <div class="form-group">
				<label class="col-sm-4 text-right">&nbsp;</label>
				<div class="col-sm-8">	
				<input type="submit" name="apply" class="btn btn-info" value="{{ Lang::get('core.sb_apply') }} " />
				<input type="submit" name="submit" class="btn btn-primary" value="{{ Lang::get('core.sb_save') }}  " />
				<button type="button" onclick="location.href='{{ URL::to('Orders?md='.$masterdetail["filtermd"].$trackUri) }}' " id="submit" class="btn btn-success ">  {{ Lang::get('core.sb_cancel') }} </button>
				</div>	  
		
			  </div> 
		 
		 {{ Form::close() }}
		</div>
	</div>	
</div>	
</div>			 
   <script type="text/javascript">
	$(document).ready(function() { 
		
		$("#CustomerID").jCombo("{{ URL::to('Orders/comboselect?filter=customers:CustomerID:CompanyName') }}",
		{  selected_value : '{{ $row["CustomerID"] }}' });
		
		$("#EmployeeID").jCombo("{{ URL::to('Orders/comboselect?filter=employees:EmployeeID:LastName|FirstName') }}",
		{  selected_value : '{{ $row["EmployeeID"] }}' });
		 
	});
	</script>		 