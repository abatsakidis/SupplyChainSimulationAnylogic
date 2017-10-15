<div class="page-content row">
    <!-- Page header -->
    <div class="page-header">
      <div class="page-title">
        <h3> {{ $pageTitle }} <small>{{ $pageNote }}</small></h3>
      </div>
      <ul class="breadcrumb">
        <li><a href="{{ URL::to('config/dashboard') }}">{{ Lang::get('core.home') }}</a></li>
		<li><a href="{{ URL::to('OrderItem?md='.$masterdetail["filtermd"]) }}">{{ $pageTitle }}</a></li>
        <li class="active"> {{ Lang::get('core.detail') }} </li>
      </ul>
	 </div>  
	 
	 
 	<div class="page-content-wrapper">   
	   <div class="toolbar-line">
	   		<a href="{{ URL::to('OrderItem?md='.$masterdetail["filtermd"].$trackUri) }}" class="tips btn btn-xs btn-default" title="{{ Lang::get('core.btn_back') }}"><i class="icon-table"></i>&nbsp;{{ Lang::get('core.btn_back') }}</a>
			@if($access['is_add'] ==1)
	   		<a href="{{ URL::to('OrderItem/add/'.$id.'?md='.$masterdetail["filtermd"].$trackUri) }}" class="tips btn btn-xs btn-primary" title="{{ Lang::get('core.btn_edit') }}"><i class="icon-pencil3"></i>&nbsp;{{ Lang::get('core.btn_edit') }}</a>
			@endif  		   	  
		</div>
	<div class="table-responsive">
	<table class="table table-striped table-bordered" >
		<tbody>	
	
					<tr>
						<td width='30%' class='label-view text-right'>
						{{ SiteHelpers::activeLang('OrderDetailsID', (isset($fields['OrderDetailsID']['language'])? $fields['OrderDetailsID']['language'] : array())) }}	
						</td>
						<td>{{ $row->OrderDetailsID }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>
						{{ SiteHelpers::activeLang('OrderID', (isset($fields['OrderID']['language'])? $fields['OrderID']['language'] : array())) }}	
						</td>
						<td>{{ $row->OrderID }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>
						{{ SiteHelpers::activeLang('Προϊόν', (isset($fields['ProductID']['language'])? $fields['ProductID']['language'] : array())) }}	
						</td>
						<td>{{ SiteHelpers::gridDisplayView($row->ProductID,'ProductID','1:products:ProductID:ProductName') }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>
						{{ SiteHelpers::activeLang('Τιμή μονάδας', (isset($fields['UnitPrice']['language'])? $fields['UnitPrice']['language'] : array())) }}	
						</td>
						<td>{{ $row->UnitPrice }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>
						{{ SiteHelpers::activeLang('Ποσότητα', (isset($fields['Quantity']['language'])? $fields['Quantity']['language'] : array())) }}	
						</td>
						<td>{{ $row->Quantity }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>
						{{ SiteHelpers::activeLang('Έκπτωση', (isset($fields['Discount']['language'])? $fields['Discount']['language'] : array())) }}	
						</td>
						<td>{{ $row->Discount }} </td>
						
					</tr>
				
		</tbody>	
	</table>    
	</div>
	</div>
</div>
	  