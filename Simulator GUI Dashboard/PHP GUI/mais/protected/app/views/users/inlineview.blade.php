@if($access['is_detail'] ==1)
<tr class="expand-open" id="exp-{{ SiteHelpers::encryptID($row->id) }}" style="display:none;">
	<td></td>
	<td></td>
	<td></td>
		<td colspan="{{ $colspan }}" id="expand-{{ SiteHelpers::encryptID($row->id) }}"> 
		<table class="table table-bordered table-striped " >
			<tbody>						
			@foreach ($tableGrid as $field)
										 
				 @if($field['detail'] =='1')
				 <tr>
				 <td width='25%' class='label-view text-right'>{{ $field['label'] }} </td>
				 <td width='45%'>								 				 
					@if($field['attribute']['image']['active'] =='1')
					<img src="{{ asset($field['attribute']['image']['path'].'/'.$row->$field['field'])}}" width="50" />
					@else	
						{{--*/ $conn = (isset($field['conn']) ? $field['conn'] : array() ) /*--}}
						{{ SiteHelpers::gridDisplay($row->$field['field'],$field['field'],$conn) }}	
					@endif												 
				 </td>
			</tr>
				 @endif					 
			 @endforeach

			</tbody>
		</table>					
	</td>
	<td></td>
	
</tr>	
@endif