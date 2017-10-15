<div class="page-content row">
    <!-- Page header -->
    <div class="page-header">
      <div class="page-title">
        <h3> {{ $pageTitle }} <small>{{ $pageNote }}</small></h3>
      </div>
      <ul class="breadcrumb">
        <li><a href="{{ URL::to('config/dashboard') }}">{{ Lang::get('core.home') }}</a></li>
		<li><a href="{{ URL::to('Orders?md='.$masterdetail["filtermd"]) }}">{{ $pageTitle }}</a></li>
        <li class="active"> {{ Lang::get('core.detail') }} </li>
      </ul>
	 </div>  
	 
	 
 	<div class="page-content-wrapper">   
	   <div class="toolbar-line">
	   		<a href="{{ URL::to('Orders?md='.$masterdetail["filtermd"].$trackUri) }}" class="tips btn btn-xs btn-default" title="{{ Lang::get('core.btn_back') }}"><i class="icon-table"></i>&nbsp;{{ Lang::get('core.btn_back') }}</a>
			@if($access['is_add'] ==1)
	   		<a href="{{ URL::to('Orders/add/'.$id.'?md='.$masterdetail["filtermd"].$trackUri) }}" class="tips btn btn-xs btn-primary" title="{{ Lang::get('core.btn_edit') }}"><i class="icon-pencil3"></i>&nbsp;{{ Lang::get('core.btn_edit') }}</a>
			@endif  		   	  
		</div>
	<div class="table-responsive">
	<table class="table table-striped table-bordered" >
		<tbody>	
	
					<tr>
						<td width='30%' class='label-view text-right'>
						{{ SiteHelpers::activeLang('Κωδικός παραγγελίας', (isset($fields['OrderID']['language'])? $fields['OrderID']['language'] : array())) }}	
						</td>
						<td>{{ $row->OrderID }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>
						{{ SiteHelpers::activeLang('Όνομα Πελάτη', (isset($fields['CustomerID']['language'])? $fields['CustomerID']['language'] : array())) }}	
						</td>
						<td>{{ SiteHelpers::gridDisplayView($row->CustomerID,'CustomerID','1:customers:CustomerID:CompanyName') }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>
						{{ SiteHelpers::activeLang('Υπάλληλος', (isset($fields['EmployeeID']['language'])? $fields['EmployeeID']['language'] : array())) }}	
						</td>
						<td>{{ SiteHelpers::gridDisplayView($row->EmployeeID,'EmployeeID','1:employees:EmployeeID:LastName|FirstName') }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>
						{{ SiteHelpers::activeLang('Ημερομηνία παραγγελίας', (isset($fields['OrderDate']['language'])? $fields['OrderDate']['language'] : array())) }}	
						</td>
						<td>{{ $row->OrderDate }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>
						{{ SiteHelpers::activeLang('Ημερομηνία απαίτησης', (isset($fields['RequiredDate']['language'])? $fields['RequiredDate']['language'] : array())) }}	
						</td>
						<td>{{ $row->RequiredDate }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>
						{{ SiteHelpers::activeLang('Ημερομηνία αποστολής', (isset($fields['ShippedDate']['language'])? $fields['ShippedDate']['language'] : array())) }}	
						</td>
						<td>{{ $row->ShippedDate }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>
						{{ SiteHelpers::activeLang('Αποστολή με...', (isset($fields['ShipVia']['language'])? $fields['ShipVia']['language'] : array())) }}	
						</td>
						<td>{{ $row->ShipVia }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>
						{{ SiteHelpers::activeLang('Όνομα αποστολής', (isset($fields['ShipName']['language'])? $fields['ShipName']['language'] : array())) }}	
						</td>
						<td>{{ $row->ShipName }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>
						{{ SiteHelpers::activeLang('Διεύθυνση αποστολής', (isset($fields['ShipAddress']['language'])? $fields['ShipAddress']['language'] : array())) }}	
						</td>
						<td>{{ $row->ShipAddress }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>
						{{ SiteHelpers::activeLang('Πόλη αποστολής', (isset($fields['ShipCity']['language'])? $fields['ShipCity']['language'] : array())) }}	
						</td>
						<td>{{ $row->ShipCity }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>
						{{ SiteHelpers::activeLang('Περιοχή αποστολής', (isset($fields['ShipRegion']['language'])? $fields['ShipRegion']['language'] : array())) }}	
						</td>
						<td>{{ $row->ShipRegion }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>
						{{ SiteHelpers::activeLang('Τ.Κ. αποστολής', (isset($fields['ShipPostalCode']['language'])? $fields['ShipPostalCode']['language'] : array())) }}	
						</td>
						<td>{{ $row->ShipPostalCode }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>
						{{ SiteHelpers::activeLang('Χώρα αποστολής', (isset($fields['ShipCountry']['language'])? $fields['ShipCountry']['language'] : array())) }}	
						</td>
						<td>{{ $row->ShipCountry }} </td>
						
					</tr>
				
		</tbody>	
	</table>    
	</div>
	</div>
</div>
	  