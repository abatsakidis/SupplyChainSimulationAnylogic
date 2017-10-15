	<script type="text/javascript">
	$(document).ready(function() { 
		$('.markItUp').markItUp(mySettings ); 
	});
	</script>	
		 {{ Form::open(array('url'=>'eventcalendar/save/'.SiteHelpers::encryptID($row['id']), 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) }}

									
								   <div class="form-group  "  style="display:none;">
									<label for="Id" class=" control-label col-md-4 text-left"> Id </label>
									<div class="col-md-6">
									  {{ Form::text('id', $row['id'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
									 <div class="col-md-2">
									 	
									 </div>
								  </div> 					
								  <div class="form-group  " >
									<label for="Title" class=" control-label col-md-2 text-left"> Title </label>
									<div class="col-md-10">
									  {{ Form::text('title', $row['title'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
								  </div> 	
								  <div class="form-group  " >
									<label for="Start" class=" control-label col-md-2 text-left"> From - To  </label>
									<div class="col-md-5">
										<div class="input-group m-b">
										  {{ Form::text('start', $row['start'],array('class'=>'form-control date', 'placeholder'=>'',   )) }} 
										  <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
										</div>
									 </div> 
									 <div class="col-md-5">
									 	<div class="input-group m-b">
									 		{{  Form::text('end', $row['end'],array('class'=>'form-control date', 'placeholder'=>'',   )) }} 
											<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
										</div>
									 </div>
								  </div>								  				
								  <div class="form-group  form-horizontal" >
									<label for="Description" class=" control-label "> Description </label>
									
									 
									  <textarea name="description" rows="15" class="form-control markItUp">{{ $row['description'] }}</textarea>
									 
								  </div> 					
		
			
			<div style="clear:both"></div>	
				
			  <div class="form-group">
				<label class="col-sm-4 text-right">&nbsp;</label>
				<div class="col-sm-8">	
				<button type="submit" class="btn btn-primary ">  {{ Lang::get('core.sb_save') }} </button>
				<button type="button" onclick="$('#sximo-modal').modal('hide');" id="submit" class="btn btn-success ">  Cancel </button>
				@if($access['is_remove'] ==1)
				<button type="button" onclick="SximoDelete();" id="submit" class="btn btn-danger ">  Delete </button>
				@endif
				</div>	  
		
			  </div> 
		 
		 {{ Form::close() }}
	<script type="text/javascript">
	$(document).ready(function() { 
		$('.date').datepicker({format:'yyyy-mm-dd',autoClose:true})	;
	});
	</script>	
	
	 {{ Form::open(array('url'=>'eventcalendar/destroy/', 'class'=>'form-horizontal' ,'ID' =>'SximoTable' )) }}
	 <input type="checkbox" style="display:none" checked="checked" class="ids"  name="id[]" value="{{ $row['id'] }}" />
	{{ Form::close() }}	