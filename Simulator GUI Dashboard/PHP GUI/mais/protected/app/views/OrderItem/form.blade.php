
  <div class="page-content row">
    <!-- Page header -->
    <div class="page-header">
      <div class="page-title">
        <h3> {{ $pageTitle }} <small>{{ $pageNote }}</small></h3>
      </div>
      <ul class="breadcrumb">
        <li><a href="{{ URL::to('dashboard') }}">{{ Lang::get('core.home') }}</a></li>
		<li><a href="{{ URL::to('OrderItem?md='.$filtermd) }}">{{ $pageTitle }}</a></li>
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
		 {{ Form::open(array('url'=>'OrderItem/save/'.SiteHelpers::encryptID($row['OrderDetailsID']).'?md='.$filtermd.$trackUri, 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) }}
				<div class="col-md-12">
						<fieldset><legend> OrderItem</legend>
									
								  <div class="form-group hidethis " style="display:none;">
									<label for="OrderDetailsID" class=" control-label col-md-4 text-left"> 
									{{ SiteHelpers::activeLang('OrderDetailsID', (isset($fields['OrderDetailsID']['language'])? $fields['OrderDetailsID']['language'] : array())) }} </label>
									<div class="col-md-6">
									  {{ Form::text('OrderDetailsID', $row['OrderDetailsID'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="OrderID" class=" control-label col-md-4 text-left"> 
									{{ SiteHelpers::activeLang('OrderID', (isset($fields['OrderID']['language'])? $fields['OrderID']['language'] : array())) }} </label>
									<div class="col-md-6">
									  {{ Form::text('OrderID', $row['OrderID'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="ProductID" class=" control-label col-md-4 text-left"> 
									{{ SiteHelpers::activeLang('ProductID', (isset($fields['ProductID']['language'])? $fields['ProductID']['language'] : array())) }} </label>
									<div class="col-md-6">
									  <select name='ProductID' rows='5' id='ProductID' code='{$ProductID}' 
							class='select2 '    ></select> 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Unit Price" class=" control-label col-md-4 text-left"> 
									{{ SiteHelpers::activeLang('Unit Price', (isset($fields['UnitPrice']['language'])? $fields['UnitPrice']['language'] : array())) }} </label>
									<div class="col-md-6">
									  {{ Form::text('UnitPrice', $row['UnitPrice'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Quantity" class=" control-label col-md-4 text-left"> 
									{{ SiteHelpers::activeLang('Quantity', (isset($fields['Quantity']['language'])? $fields['Quantity']['language'] : array())) }} </label>
									<div class="col-md-6">
									  {{ Form::text('Quantity', $row['Quantity'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Discount" class=" control-label col-md-4 text-left"> 
									{{ SiteHelpers::activeLang('Discount', (isset($fields['Discount']['language'])? $fields['Discount']['language'] : array())) }} </label>
									<div class="col-md-6">
									  {{ Form::text('Discount', $row['Discount'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
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
				<button type="button" onclick="location.href='{{ URL::to('OrderItem?md='.$masterdetail["filtermd"].$trackUri) }}' " id="submit" class="btn btn-success ">  {{ Lang::get('core.sb_cancel') }} </button>
				</div>	  
		
			  </div> 
		 
		 {{ Form::close() }}
		</div>
	</div>	
</div>	
</div>			 
   <script type="text/javascript">
	$(document).ready(function() { 
		
		$("#ProductID").jCombo("{{ URL::to('OrderItem/comboselect?filter=products:ProductID:ProductName') }}",
		{  selected_value : '{{ $row["ProductID"] }}' });
		 
	});
	</script>		 