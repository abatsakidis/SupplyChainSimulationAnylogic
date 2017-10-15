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
						{{ SiteHelpers::activeLang('Id', (isset($fields['id']['language'])? $fields['id']['language'] : array())) }}	
						</td>
						<td>{{ $row->id }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>
						{{ SiteHelpers::activeLang('OrderSetupCost', (isset($fields['OrderSetupCost']['language'])? $fields['OrderSetupCost']['language'] : array())) }}	
						</td>
						<td>{{ $row->OrderSetupCost }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>
						{{ SiteHelpers::activeLang('OrderCostPerItem', (isset($fields['OrderCostPerItem']['language'])? $fields['OrderCostPerItem']['language'] : array())) }}	
						</td>
						<td>{{ $row->OrderCostPerItem }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>
						{{ SiteHelpers::activeLang('HoldingCostPerItemPerDay', (isset($fields['HoldingCostPerItemPerDay']['language'])? $fields['HoldingCostPerItemPerDay']['language'] : array())) }}	
						</td>
						<td>{{ $row->HoldingCostPerItemPerDay }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>
						{{ SiteHelpers::activeLang('ShortageCostPerItemPerDay', (isset($fields['ShortageCostPerItemPerDay']['language'])? $fields['ShortageCostPerItemPerDay']['language'] : array())) }}	
						</td>
						<td>{{ $row->ShortageCostPerItemPerDay }} </td>
						
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