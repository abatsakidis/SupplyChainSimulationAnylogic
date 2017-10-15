{{ HTML::script('sximo/js/plugins/tinymce/jscripts/tiny_mce/jquery.tinymce.js')}}
{{ HTML::script('sximo/js/plugins/tinymce/jscripts/tiny_mce/tiny_mce.js')}}
{{ HTML::style('protected/app/views/blog/blog.css')}}


  <div class="page-content row">
    <!-- Page header -->
    <div class="page-header">
      <div class="page-title">
        <h3> {{ $pageTitle }} <small>{{ $pageNote }}</small></h3>
      </div>

      <ul class="breadcrumb">
        <li><a href="{{ URL::to('dashboard') }}">{{ Lang::get('core.home') }}</a></li>
		<li><a href="{{ URL::to('blogadmin') }}">{{ $pageTitle }}</a></li>
        <li class="active">{{ Lang::get('core.addedit') }} </li>
      </ul>
	</div>  
	
	 <div class="page-content-wrapper">
	@if(Session::has('message'))	  
		   {{ Session::get('message') }}
	@endif	


		<ul class="parsley-error-list">
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
		 {{ Form::open(array('url'=>'blogadmin/save/'.$row['blogID'], 'files' => true , 'parsley-validate'=>'','novalidate'=>' ')) }}
	
	<div class="col-md-8 form-vertical">
		  <div class="form-group  " >
			<label for="Title" class=" control-label text-left"> Title </label>
			
			  {{ Form::text('title', $row['title'],array('class'=>'form-control', 'placeholder'=>'', 'required'=>'true'  )) }} 
			
		  </div> 					
					
		  <div class="form-group  " >
			<label for="Content" class=" control-label text-left"> Content </label>
			
			  <textarea name='content' rows='15' id='editor' style="width:100%;" class='mceEditor form-control' 
required >{{ $row['content'] }}</textarea> 
			
		  </div> 	
	
	</div>
	
	<div class="col-md-4 form-horizontal">

			  <div class="form-group hidethis " style="display:none;">
				<label for="BlogID" class=" control-label col-md-4 text-left"> BlogID </label>
				<div class="col-md-8">
				  {{ Form::text('blogID', $row['blogID'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
				 </div> 
			  </div> 					
			  <div class="form-group  " >
				<label for="CatID" class=" control-label col-md-4 text-left"> CatID </label>
				<div class="col-md-8">
				  <select name='CatID' rows='5' id='CatID' code='{$CatID}' 
		class='select2 '    ></select> 
				 </div> 
			  </div> 					

			  <div class="form-group  " >
				<label for="Created" class=" control-label col-md-4 text-left"> Created </label>
				<div class="col-md-8">
				  
{{ Form::text('created', $row['created'],array('class'=>'form-control datetime', 'style'=>'width:150px !important;')) }} 
				 </div> 
			  </div> 					
			  <div class="form-group  " >
				<label for="Tags" class=" control-label col-md-4 text-left"> Tags </label>
				<div class="col-md-8">
				  {{ Form::text('tags', $row['tags'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
				 </div> 
			  </div> 					
			  <div class="form-group  " >
				<label for="Status" class=" control-label col-md-4 text-left"> Status </label>
				<div class="col-md-8">
				  
<label class='radio'>
<input type='radio' name='status' value ='draft' requred @if($row['status'] == 'draft') checked="checked" @endif > Draft </label>
<label class='radio'>
<input type='radio' name='status' value ='publish' requred @if($row['status'] == 'publish') checked="checked" @endif > Publish </label>
<label class='radio '>
<input type='radio' name='status' value ='unpublish' requred @if($row['status'] == 'unpublish') checked="checked" @endif > Unpublish </label> 
				 </div> 
			  </div> 	

			  <div class="form-group">
				<label class="col-sm-4 text-right">&nbsp;</label>
				<div class="col-sm-8">	
				<button type="submit" class="btn btn-primary ">  {{ Lang::get('core.sb_save') }} </button>
				<button type="button" onclick="location.href='{{ URL::to('blogadmin') }}' " id="submit" class="btn btn-success ">  {{ Lang::get('core.sb_cancel') }} </button>
				</div>	  
		
			  </div> 			  
			  				

	</div>	 
		 
			
			<div style="clear:both"></div>	
				

		 
		 {{ Form::close() }}
		 </div>

</div>				 
   <script type="text/javascript">
	$(document).ready(function() { 
		
		$("#CatID").jCombo("{{ URL::to('blogadmin/comboselect?filter=tb_blogcategories:CatID:name') }}",
		{  selected_value : '{{ $row["CatID"] }}' });

	
		$(function(){
			tinymce.init({	
				mode : "specific_textareas",
				editor_selector : "mceEditor",
				 plugins : "openmanager",
				 file_browser_callback: "openmanager",
				 open_manager_upload_path: '../../../../../../../../uploads/images/',
			 });	
		});
		 
	});
	</script>		 

