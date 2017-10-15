<?php usort($tableGrid, "SiteHelpers::_sort"); ?>
@include( $pageModule.'/toolbar')
<div class="table-responsive">	
    <table class="table table-striped  " id="{{ $pageModule }}Table">
        <thead>
			<tr>
				<th> No </th>
				<?php foreach ($tableGrid as $t) :
					if($t['view'] =='1'):
						echo '<th>'.SiteHelpers::activeLang($t['label'],(isset($t['language'])? $t['language'] : array())).'</th>';
					endif;
				endforeach; ?>
			  </tr>
        </thead>

        <tbody>			
           		<?php foreach ($rowData as $row) : ?>
                <tr>
					<td width="50"> <?php echo ++$i;?>  </td>								
				 <?php foreach ($tableGrid as $field) :
					 if($field['view'] =='1') : ?>
					 <td>					 
							<?php 
							$conn = (isset($field['conn']) ? $field['conn'] : array() );
							echo AjaxHelpers::gridFormater($row->$field['field'], $row , $field['attribute'],$conn);?>					 
					 </td>
					 <?php endif;					 
				 	endforeach; 
				  ?>			 
                </tr>
				
            <?php endforeach;?>
              
        </tbody>
      
    </table>
	</div>
	@include('ajaxfooter')
	
<script>
$(document).ready(function() {
	$('.tips').tooltip();		
	$('#{{ $pageModule }}Paginate .pagination li a').click(function() {
		var url = $(this).attr('href');
		reloadData('#{{ $pageModule }}',url+'&md={{ $masterdetail["filtermd"] }}');		
		return false ;
	});

	
});		
</script>	
	