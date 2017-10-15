<div class="sbox">
	<div class="sbox-title"> 
		<h3> {{ $pageTitle }} <small> {{ $pageNote }} </small> </h3> 
		<div class="sbox-tools">
			 <a class="collapse-close" onclick="ajaxViewClose('#{{ $pageModule }}')"><i class="fa fa fa-times"></i></a>
		</div>	
	</div>
	<div class="sbox-content white-bg" style="background:#fff !important;">	
	<ul class="nav nav-tabs" style="margin-bottom:10px;">
		<li class="active" ><a href="#{{$pageModule }}-home" role="tab" data-toggle="tab"> Info Detail </a></li>
		@foreach($subgrid as $md)
		<li ><a href="#{{ $md['module'] }}" role="tab" data-toggle="tab">{{ $md['title'] }}</a></li>
		@endforeach
	</ul>
	
	<div class="tab-content">
		<div class="tab-pane active" id="{{$pageModule }}-home">
		<table class="table table-striped table-bordered" >
			<tbody>	

					<tr>
						<td width='30%' class='label-view text-right'>
						{{ SiteHelpers::activeLang('Κωδικός προϊόντος', (isset($fields['ProductID']['language'])? $fields['ProductID']['language'] : array())) }}	
						</td>
						<td>{{ $row->ProductID }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>
						{{ SiteHelpers::activeLang('Όνομα', (isset($fields['ProductName']['language'])? $fields['ProductName']['language'] : array())) }}	
						</td>
						<td>{{ $row->ProductName }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>
						{{ SiteHelpers::activeLang('Προμηθευτής', (isset($fields['SupplierID']['language'])? $fields['SupplierID']['language'] : array())) }}	
						</td>
						<td>{{ SiteHelpers::gridDisplayView($row->SupplierID,'SupplierID','1:suppliers:SupplierID:CompanyName') }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>
						{{ SiteHelpers::activeLang('Κατηγορία', (isset($fields['CategoryID']['language'])? $fields['CategoryID']['language'] : array())) }}	
						</td>
						<td>{{ SiteHelpers::gridDisplayView($row->CategoryID,'CategoryID','1:categories:CategoryID:CategoryName') }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>
						{{ SiteHelpers::activeLang('Ποσότητα ανά μονάδα', (isset($fields['QuantityPerUnit']['language'])? $fields['QuantityPerUnit']['language'] : array())) }}	
						</td>
						<td>{{ $row->QuantityPerUnit }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>
						{{ SiteHelpers::activeLang('Τιμή μονάδας', (isset($fields['UnitPrice']['language'])? $fields['UnitPrice']['language'] : array())) }}	
						</td>
						<td>{{ $row->UnitPrice }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>
						{{ SiteHelpers::activeLang('Ποσότητα σε απόθεμα', (isset($fields['UnitsInStock']['language'])? $fields['UnitsInStock']['language'] : array())) }}	
						</td>
						<td>{{ $row->UnitsInStock }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>
						{{ SiteHelpers::activeLang('Ποσότητα σε παραγγελία', (isset($fields['UnitsOnOrder']['language'])? $fields['UnitsOnOrder']['language'] : array())) }}	
						</td>
						<td>{{ $row->UnitsOnOrder }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>
						{{ SiteHelpers::activeLang('ReorderLevel', (isset($fields['ReorderLevel']['language'])? $fields['ReorderLevel']['language'] : array())) }}	
						</td>
						<td>{{ $row->ReorderLevel }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>
						{{ SiteHelpers::activeLang('Κατάσταση', (isset($fields['Discontinued']['language'])? $fields['Discontinued']['language'] : array())) }}	
						</td>
						<td>{{ $row->Discontinued }} </td>
						
					</tr>
				
			</tbody>	
		</table>  	
		
		</div>
		@foreach($subgrid as $md)
		<div class="tab-pane" id="{{ $md['module'] }}">
			<div id="{{ $md['module'] }}View"></div>
			<div class="table-responsive">
				<div id="{{ $md['module'] }}Grid"></div>
			</div>	
		</div>
		@endforeach
	</div>

	</div>  
</div>
<script>
$(document).ready(function(){
<?php foreach($subgrid as $md) : ?>
	$.post( '<?php echo URL::to($md['module'].'/data?md='.$md['master'].'+'.$md['master_key'].'+'.$md['module'].'+'.$md['key'].'+'.$id) ;?>' ,function( data ) {
		$( '#<?php echo $md['module'] ;?>Grid' ).html( data );
	});		
<?php endforeach ?>
});
</script>	