{{ Form::open(array('url'=>'Categories/save/'.SiteHelpers::encryptID($row['CategoryID']), 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ','id'=> 'CategoriesFormAjax')) }}
<div class="col-md-12">
						<fieldset><legend> Categories</legend>
									
								  <div class="form-group hidethis " style="display:none;">
									<label for="CategoryID" class=" control-label col-md-4 text-left"> 
									{{ SiteHelpers::activeLang('CategoryID', (isset($fields['CategoryID']['language'])? $fields['CategoryID']['language'] : array())) }} </label>
									<div class="col-md-6">
									  {{ Form::text('CategoryID', $row['CategoryID'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Category Name" class=" control-label col-md-4 text-left"> 
									{{ SiteHelpers::activeLang('Category Name', (isset($fields['CategoryName']['language'])? $fields['CategoryName']['language'] : array())) }} </label>
									<div class="col-md-6">
									  {{ Form::text('CategoryName', $row['CategoryName'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Description" class=" control-label col-md-4 text-left"> 
									{{ SiteHelpers::activeLang('Description', (isset($fields['Description']['language'])? $fields['Description']['language'] : array())) }} </label>
									<div class="col-md-6">
									  {{ Form::text('Description', $row['Description'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Picture" class=" control-label col-md-4 text-left"> 
									{{ SiteHelpers::activeLang('Picture', (isset($fields['Picture']['language'])? $fields['Picture']['language'] : array())) }} </label>
									<div class="col-md-6">
									  {{ Form::text('Picture', $row['Picture'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> </fieldset>
			</div>
			
												
					
			
<div style="clear:both"></div>	
				
<div class="form-group">
	<label class="col-sm-4 text-right">&nbsp;</label>
	<div class="col-sm-8">	
		<button type="submit" class="btn btn-primary btn-sm ">  {{ Lang::get('core.sb_save') }} </button>
		<button type="button" onclick="$('#sximo-modal').modal('hide')" id="submit" class="btn btn-success btn-sm">  {{ Lang::get('core.sb_cancel') }} </button>
	</div>			
</div> 		 
{{ Form::close() }}

			 
   <script type="text/javascript">
	$(document).ready(function() { 
		 
		
		$('.previewImage').fancybox();	
		$('.tips').tooltip();	
		$(".select2").select2({ width:"98%"});	
		$('.date').datepicker({format:'yyyy-mm-dd',autoClose:true})
		$('.datetime').datetimepicker({format: 'yyyy-mm-dd hh:ii:ss'}); 
		 $('.markItUp').markItUp(mySettings );				
		
		var form = $('#CategoriesFormAjax'); 
		form.parsley();
		form.submit(function(){
			
			if(form.parsley('isValid') == true){			
				var options = { 
					dataType:      'json', 
					beforeSubmit :  showRequest,
					success:       showResponse  
				}  
				$(this).ajaxSubmit(options); 
				return false;
							
			} else {
				return false;
			}		
		
		});

	});
	
	function showRequest()
	{
		$('.formLoading').show();	
	}  
	function showResponse(data)  {		
		
		if(data.status == 'success')
		{
			$( ".resultData" ).html( data.message );
			$('#sximo-modal').modal('hide')	;	
			ajaxFilter('#{{ $pageModule }}','{{ $pageUrl }}/data');
		} else {
			$( ".{{ $pageModule }}FR" ).html( data.message );
			return false;
		}	
	}			 
	
	</script>		 