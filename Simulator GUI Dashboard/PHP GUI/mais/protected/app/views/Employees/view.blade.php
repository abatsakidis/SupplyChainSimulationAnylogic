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
						{{ SiteHelpers::activeLang('Κωδικός εργαζόμενου', (isset($fields['EmployeeID']['language'])? $fields['EmployeeID']['language'] : array())) }}	
						</td>
						<td>{{ $row->EmployeeID }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>
						{{ SiteHelpers::activeLang('Επώνυμο', (isset($fields['LastName']['language'])? $fields['LastName']['language'] : array())) }}	
						</td>
						<td>{{ $row->LastName }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>
						{{ SiteHelpers::activeLang('Όνομα', (isset($fields['FirstName']['language'])? $fields['FirstName']['language'] : array())) }}	
						</td>
						<td>{{ $row->FirstName }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>
						{{ SiteHelpers::activeLang('Θέση', (isset($fields['Title']['language'])? $fields['Title']['language'] : array())) }}	
						</td>
						<td>{{ $row->Title }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>
						{{ SiteHelpers::activeLang('Τίτλος ευγενείας', (isset($fields['TitleOfCourtesy']['language'])? $fields['TitleOfCourtesy']['language'] : array())) }}	
						</td>
						<td>{{ $row->TitleOfCourtesy }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>
						{{ SiteHelpers::activeLang('Ημερομηνία γέννησης', (isset($fields['BirthDate']['language'])? $fields['BirthDate']['language'] : array())) }}	
						</td>
						<td>{{ $row->BirthDate }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>
						{{ SiteHelpers::activeLang('Ημερομηνία πρόσληψης', (isset($fields['HireDate']['language'])? $fields['HireDate']['language'] : array())) }}	
						</td>
						<td>{{ $row->HireDate }} </td>
						
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
						{{ SiteHelpers::activeLang('Τηλέφωνο', (isset($fields['HomePhone']['language'])? $fields['HomePhone']['language'] : array())) }}	
						</td>
						<td>{{ $row->HomePhone }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>
						{{ SiteHelpers::activeLang('Extension', (isset($fields['Extension']['language'])? $fields['Extension']['language'] : array())) }}	
						</td>
						<td>{{ $row->Extension }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>
						{{ SiteHelpers::activeLang('Φωτογραφία', (isset($fields['Photo']['language'])? $fields['Photo']['language'] : array())) }}	
						</td>
						<td>{{ $row->Photo }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>
						{{ SiteHelpers::activeLang('Σημειώσεις', (isset($fields['Notes']['language'])? $fields['Notes']['language'] : array())) }}	
						</td>
						<td>{{ $row->Notes }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>
						{{ SiteHelpers::activeLang('Αναφέρεται στον/στην', (isset($fields['ReportsTo']['language'])? $fields['ReportsTo']['language'] : array())) }}	
						</td>
						<td>{{ $row->ReportsTo }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>
						{{ SiteHelpers::activeLang('Μισθός', (isset($fields['Salary']['language'])? $fields['Salary']['language'] : array())) }}	
						</td>
						<td>{{ $row->Salary }} </td>
						
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