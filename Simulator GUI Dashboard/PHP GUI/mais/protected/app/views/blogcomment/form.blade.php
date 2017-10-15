
  <div class="page-content row">
    <!-- Page header -->
    <div class="page-header">
      <div class="page-title">
        <h3> {{ $pageTitle }} <small>{{ $pageNote }}</small></h3>
      </div>

      <ul class="breadcrumb">
        <li><a href="{{ URL::to('dashboard') }}">{{ Lang::get('core.home') }}</a></li>
		<li><a href="{{ URL::to('blogcomment') }}">{{ $pageTitle }}</a></li>
        <li class="active">{{ Lang::get('core.addedit') }} </li>
      </ul>
	</div>  
	
	<div class="page-content-wrapper">
	
	@if(Session::has('message'))	  
		   {{ Session::get('message') }}
	@endif	
	<div class="panel-default panel">
		<div class="panel-body">

		<ul class="parsley-error-list">
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
		 {{ Form::open(array('url'=>'blogcomment/save/'.SiteHelpers::encryptID($row['commentID']), 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) }}
				<div class="col-md-12">
						<fieldset><legend> Blog Comments</legend>
									
								  <div class="form-group hidethis " style="display:none;">
									<label for="CommentID" class=" control-label col-md-4 text-left"> CommentID </label>
									<div class="col-md-8">
									  {{ Form::text('commentID', $row['commentID'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="User Id" class=" control-label col-md-4 text-left"> User Id </label>
									<div class="col-md-8">
									  <select name='user_id' rows='5' id='user_id' code='{$user_id}' 
							class='select2 '    ></select> 
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="BlogID" class=" control-label col-md-4 text-left"> BlogID </label>
									<div class="col-md-8">
									  <select name='blogID' rows='5' id='blogID' code='{$blogID}' 
							class='select2 '    ></select> 
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Comment" class=" control-label col-md-4 text-left"> Comment </label>
									<div class="col-md-8">
									  <textarea name='comment' rows='2' id='comment' class='form-control '  
				           >{{ $row['comment'] }}</textarea> 
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Created" class=" control-label col-md-4 text-left"> Created </label>
									<div class="col-md-8">
									  
				{{ Form::text('created', $row['created'],array('class'=>'form-control datetime', 'style'=>'width:150px !important;')) }} 
									 </div> 
								  </div> </fieldset>
			</div>
			
			
			<div style="clear:both"></div>	
				
			  <div class="form-group">
				<label class="col-sm-4 text-right">&nbsp;</label>
				<div class="col-sm-8">	
				<button type="submit" class="btn btn-primary ">  {{ Lang::get('core.sb_save') }} </button>
				<button type="button" onclick="location.href='{{ URL::to('blogcomment') }}' " id="submit" class="btn btn-success ">  {{ Lang::get('core.sb_cancel') }} </button>
				</div>	  
		
			  </div> 
		 
		 {{ Form::close() }}
		</div>
		</div>
	</div>	
</div>				 
   <script type="text/javascript">
	$(document).ready(function() { 
		
		$("#user_id").jCombo("{{ URL::to('blogcomment/comboselect?filter=tb_users:id:email') }}",
		{  selected_value : '{{ $row["user_id"] }}' });
		
		$("#blogID").jCombo("{{ URL::to('blogcomment/comboselect?filter=tb_blogs:blogID:title') }}",
		{  selected_value : '{{ $row["blogID"] }}' });
		 
	});
	</script>		 