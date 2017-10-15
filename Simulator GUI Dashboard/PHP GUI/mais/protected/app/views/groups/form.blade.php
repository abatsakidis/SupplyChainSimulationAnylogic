
  <div class="page-content row">
    <!-- Page header -->
    <div class="page-header">
      <div class="page-title">
        <h3> {{ $pageTitle }} <small>{{ $pageNote }}</small></h3>
      </div>
	  
      <ul class="breadcrumb">
        <li><a href="{{ URL::to('dashboard') }}">{{ Lang::get('core.home'); }}</a></li>
		<li><a href="{{ URL::to('groups') }}">{{ $pageTitle }}</a></li>
        <li class="active"> Add Or Edit </li>
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
		 {{ Form::open(array('url'=>'groups/save/'.SiteHelpers::encryptID($row['group_id']), 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) }}
				<div class="col-md-12">
						<fieldset><legend> Users Group</legend>
									
								  <div class="form-group hidethis " style="display:none;">
									<label for="Group Id" class=" control-label col-md-4 text-left"> Group Id </label>
									<div class="col-md-8">
									  {{ Form::text('group_id', $row['group_id'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Name" class=" control-label col-md-4 text-left"> Name </label>
									<div class="col-md-8">
									  {{ Form::text('name', $row['name'],array('class'=>'form-control', 'placeholder'=>'', 'required'=>'true'  )) }} 
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Description" class=" control-label col-md-4 text-left"> Description </label>
									<div class="col-md-8">
									  <textarea name='description' rows='2' id='description' class='form-control '  
				           >{{ $row['description'] }}</textarea> 
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Level" class=" control-label col-md-4 text-left"> Level </label>
									<div class="col-md-8">
									  {{ Form::text('level', $row['level'],array('class'=>'form-control', 'placeholder'=>'', 'required'=>'true'  )) }} 
									 </div> 
								  </div> </fieldset>
			</div>
			
			
			<div style="clear:both"></div>	
				
			  <div class="form-group">
				<label class="col-sm-4 text-right">&nbsp;</label>
				<div class="col-sm-8">	
				<button type="submit" class="btn btn-primary ">  Submit </button>
				<button type="button" onclick="location.href='{{ URL::to('groups') }}' " id="submit" class="btn btn-success ">  Cancel </button>
				</div>	  
		
			  </div> 
		 
		 {{ Form::close() }}
		</div>
		</div>
	</div>	
</div>				 
   <script type="text/javascript">
	$(document).ready(function() { 
		 
	});
	</script>		 