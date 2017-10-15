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
						{{ SiteHelpers::activeLang('Manufacturing Setup Cost (F)', (isset($fields['f_ManufacturingSetupCost']['language'])? $fields['f_ManufacturingSetupCost']['language'] : array())) }}	
						</td>
						<td>{{ $row->f_ManufacturingSetupCost }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>
						{{ SiteHelpers::activeLang('Manufacturing Cost Per Item (F)', (isset($fields['f_ManufacturingCostPerItem']['language'])? $fields['f_ManufacturingCostPerItem']['language'] : array())) }}	
						</td>
						<td>{{ $row->f_ManufacturingCostPerItem }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>
						{{ SiteHelpers::activeLang('Holding Cost PerI tem Per Day (F)', (isset($fields['f_HoldingCostPerItemPerDay']['language'])? $fields['f_HoldingCostPerItemPerDay']['language'] : array())) }}	
						</td>
						<td>{{ $row->f_HoldingCostPerItemPerDay }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>
						{{ SiteHelpers::activeLang('Shortage Cost PerI tem Per Day (F)', (isset($fields['f_ShortageCostPerItemPerDay']['language'])? $fields['f_ShortageCostPerItemPerDay']['language'] : array())) }}	
						</td>
						<td>{{ $row->f_ShortageCostPerItemPerDay }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>
						{{ SiteHelpers::activeLang('Order Setup Cost (R)', (isset($fields['r_OrderSetupCost']['language'])? $fields['r_OrderSetupCost']['language'] : array())) }}	
						</td>
						<td>{{ $row->r_OrderSetupCost }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>
						{{ SiteHelpers::activeLang('Order Cost Per Item (R)', (isset($fields['r_OrderCostPerItem']['language'])? $fields['r_OrderCostPerItem']['language'] : array())) }}	
						</td>
						<td>{{ $row->r_OrderCostPerItem }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>
						{{ SiteHelpers::activeLang('Holding Cost Per Item Per Day (R)', (isset($fields['r_HoldingCostPerItemPerDay']['language'])? $fields['r_HoldingCostPerItemPerDay']['language'] : array())) }}	
						</td>
						<td>{{ $row->r_HoldingCostPerItemPerDay }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>
						{{ SiteHelpers::activeLang('Shortage Cost Per Item Per Day (R)', (isset($fields['r_ShortageCostPerItemPerDay']['language'])? $fields['r_ShortageCostPerItemPerDay']['language'] : array())) }}	
						</td>
						<td>{{ $row->r_ShortageCostPerItemPerDay }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>
						{{ SiteHelpers::activeLang('Order Setup Cost (W)', (isset($fields['w_OrderSetupCost']['language'])? $fields['w_OrderSetupCost']['language'] : array())) }}	
						</td>
						<td>{{ $row->w_OrderSetupCost }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>
						{{ SiteHelpers::activeLang('Order Cost Per Item (W)', (isset($fields['w_OrderCostPerItem']['language'])? $fields['w_OrderCostPerItem']['language'] : array())) }}	
						</td>
						<td>{{ $row->w_OrderCostPerItem }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>
						{{ SiteHelpers::activeLang('Holding Cost Per Item Per Day (W)', (isset($fields['w_HoldingCostPerItemPerDay']['language'])? $fields['w_HoldingCostPerItemPerDay']['language'] : array())) }}	
						</td>
						<td>{{ $row->w_HoldingCostPerItemPerDay }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>
						{{ SiteHelpers::activeLang('Shortage Cost Per Item Per Day (W)', (isset($fields['w_ShortageCostPerItemPerDay']['language'])? $fields['w_ShortageCostPerItemPerDay']['language'] : array())) }}	
						</td>
						<td>{{ $row->w_ShortageCostPerItemPerDay }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>
						{{ SiteHelpers::activeLang('Status', (isset($fields['Status']['language'])? $fields['Status']['language'] : array())) }}	
						</td>
						<td>{{ $row->Status }} </td>
						
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