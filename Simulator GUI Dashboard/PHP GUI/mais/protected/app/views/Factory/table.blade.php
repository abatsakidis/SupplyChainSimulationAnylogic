<?php usort($tableGrid, "SiteHelpers::_sort"); ?>
	@include( $pageModule.'/toolbar')

	 <?php echo Form::open(array('url'=>'Factory/destroy/', 'class'=>'form-horizontal' ,'id' =>'SximoTable'  ,'data-parsley-validate'=>'' )) ;?>
<div class="table-responsive">	
    <table class="table table-striped  " id="{{ $pageModule }}Table">
        <thead>
			<tr>
				<th> No </th>
				<th> <input type="checkbox" class="checkall" /></th>
				
				<?php foreach ($tableGrid as $t) :
					if($t['view'] =='1'):
						echo '<th align="'.$t['align'].'">'.SiteHelpers::activeLang($t['label'],(isset($t['language'])? $t['language'] : array())).'</th>';
					endif;
				endforeach; ?>
				<th><?php echo Lang::get('core.btn_action') ;?></th>
			  </tr>
        </thead>

        <tbody>
			<tr id="FactorySearch"  >
				<td> # </td>
				<td> </td>
				
				<?php foreach ($tableGrid as $t) :
					if($t['view'] =='1') :
						echo '<td >'.SiteHelpers::transForm($t['field'] , $tableForm).'</td>';
					endif;
				endforeach ;?>
			
				<td style="width:130px;">
				
				<button type="button"  class=" do-quick-search btn btn-xs btn-info" onClick="ajaxDoSearch('#Factory','<?php echo $pageUrl.'/data?md='.$masterdetail["filtermd"];?>')"><i class="fa fa-search"></i></button>
				<?php if($access['is_add'] ==1) :?>
				<button type="button"  class=" btn btn-xs btn-info tips" onclick="ajaxQuickAdd('#{{ $pageModule }}','{{ $pageUrl}}')"  title="Quick Add Row"><i class="fa fa-plus-circle"></i></button>
				<?php endif; ?>	
				
				</td>
			  </tr>				
           		<?php foreach ($rowData as $row) : ?>
                <tr>
					<td width="50"> <?php echo ++$i;?>  </td>
					<td width="50"><input type="checkbox" class="ids" name="id[]" value="<?php echo $row->id ;?>" />  </td>									
					 <?php foreach ($tableGrid as $field) :
						 if($field['view'] =='1') : ?>
						 <td align="<?php echo $field['align'];?>">					 
							<?php 
							$conn = (isset($field['conn']) ? $field['conn'] : array() );
							echo AjaxHelpers::gridFormater($row->$field['field'], $row , $field['attribute'],$conn);?>							 
						 </td>
						 <?php endif;					 
						endforeach; 
					  ?>
				 <td>
				 	
					<?php $id = SiteHelpers::encryptID($row->id);
				 	if($access['is_detail'] ==1) :?>
					<a href="<?php echo  URL::to('Factory/show/'.$id);?>"  class="tips btn btn-xs btn-primary"  
					title="<?php echo  Lang::get('core.btn_view');?>"
					onclick="ajaxViewDetail('#{{ $pageModule }}',this.href); return false;"  >
					<i class="fa  fa-search"></i></a>
					<?php endif ;
					if($access['is_edit'] ==1) : ?>
					<a  href="<?php echo URL::to('Factory/add/'.$id.'?md='.$masterdetail["filtermd"]);?>"  class="tips btn btn-xs btn-success"  
					title="<?php echo Lang::get('core.btn_edit') ;?>"
					onclick="SximoModal(this.href,'<?php echo Lang::get('core.btn_create') ;?>'); return false;" > 
					<i class="fa  fa-edit"></i></a>
					<?php endif; ?>							
					
				</td>				 
                </tr>
				
            <?php endforeach;?>
              
        </tbody>
      
    </table>
	</div>
	<?php echo Form::close() ;?>
	
	@include('ajaxfooter')
	
<script>
$(document).ready(function() {
	$('.tips').tooltip();	
	$('input[type="checkbox"],input[type="radio"]').iCheck({
		checkboxClass: 'icheckbox_square-green',
		radioClass: 'iradio_square-green',
	});	
	$('#{{ $pageModule }}Table .checkall').on('ifChecked',function(){
		$('#{{ $pageModule }}Table input[type="checkbox"]').iCheck('check');
	});
	$('#{{ $pageModule }}Table .checkall').on('ifUnchecked',function(){
		$('#{{ $pageModule }}Table input[type="checkbox"]').iCheck('uncheck');
	});	
	
	$('#{{ $pageModule }}Paginate .pagination li a').click(function() {
		var url = $(this).attr('href');
		reloadData('#{{ $pageModule }}',url+'&md={{ $masterdetail["filtermd"] }}');		
		return false ;
	});

	
});		
</script>	
<style>
.table th.right { text-align:right !important;}
.table th.center { text-align:center !important;}

</style>
	