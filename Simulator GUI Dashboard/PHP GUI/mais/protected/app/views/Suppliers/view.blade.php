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
						{{ SiteHelpers::activeLang('Κωδικός προμηθευτή', (isset($fields['SupplierID']['language'])? $fields['SupplierID']['language'] : array())) }}	
						</td>
						<td>{{ $row->SupplierID }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>
						{{ SiteHelpers::activeLang('Όνομα εταιρίας', (isset($fields['CompanyName']['language'])? $fields['CompanyName']['language'] : array())) }}	
						</td>
						<td>{{ $row->CompanyName }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>
						{{ SiteHelpers::activeLang('Όνομα επαφής', (isset($fields['ContactName']['language'])? $fields['ContactName']['language'] : array())) }}	
						</td>
						<td>{{ $row->ContactName }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>
						{{ SiteHelpers::activeLang('Τίτλος επαφής', (isset($fields['ContactTitle']['language'])? $fields['ContactTitle']['language'] : array())) }}	
						</td>
						<td>{{ $row->ContactTitle }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>
						{{ SiteHelpers::activeLang('Διεύθυνση', (isset($fields['Address']['language'])? $fields['Address']['language'] : array())) }}	
						</td>
						<td>{{ $row->Address }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>
						{{ SiteHelpers::activeLang('Πόλη', (isset($fields['City']['language'])? $fields['City']['language'] : array())) }}	
						</td>
						<td>{{ $row->City }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>
						{{ SiteHelpers::activeLang('Περιοχή', (isset($fields['Region']['language'])? $fields['Region']['language'] : array())) }}	
						</td>
						<td>{{ $row->Region }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>
						{{ SiteHelpers::activeLang('Τ.Κ.', (isset($fields['PostalCode']['language'])? $fields['PostalCode']['language'] : array())) }}	
						</td>
						<td>{{ $row->PostalCode }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>
						{{ SiteHelpers::activeLang('Χώρα', (isset($fields['Country']['language'])? $fields['Country']['language'] : array())) }}	
						</td>
						<td>{{ $row->Country }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>
						{{ SiteHelpers::activeLang('Τηλέφωνο', (isset($fields['Phone']['language'])? $fields['Phone']['language'] : array())) }}	
						</td>
						<td>{{ $row->Phone }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>
						{{ SiteHelpers::activeLang('Fax', (isset($fields['Fax']['language'])? $fields['Fax']['language'] : array())) }}	
						</td>
						<td>{{ $row->Fax }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>
						{{ SiteHelpers::activeLang('Website', (isset($fields['HomePage']['language'])? $fields['HomePage']['language'] : array())) }}	
						</td>
						<td>{{ $row->HomePage }} </td>
						
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