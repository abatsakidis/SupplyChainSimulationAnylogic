
  <div class="page-content row">
    <!-- Page header -->
    <div class="page-header">
      <div class="page-title">
        <h3> {{ $pageTitle }} <small>{{ $pageNote }}</small></h3>
      </div>
   

   
      <ul class="breadcrumb">
        <li><a href="{{ URL::to('dashboard') }}">{{ Lang::get('core.home') }}</a></li>
		<li><a href="{{ URL::to('blogcategories') }}">{{ $pageTitle }}</a></li>
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
		 {{ Form::open(array('url'=>'blogcategories/save/'.SiteHelpers::encryptID($row['CatID']), 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) }}
				<div class="col-md-12">
						<fieldset><legend> Blog Categories</legend>
									
								  <div class="form-group hidethis " style="display:none;">
									<label for="CatID" class=" control-label col-md-4 text-left"> CatID </label>
									<div class="col-md-8">
									  {{ Form::text('CatID', $row['CatID'],array('class'=>'form-control', 'placeholder'=>'',   )) }} 
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Name" class=" control-label col-md-4 text-left"> Name </label>
									<div class="col-md-8">
									  {{ Form::text('name', $row['name'],array('class'=>'form-control', 'placeholder'=>'', 'required'=>'true'  )) }} 
									 </div> 
								  </div> 									
								  <div class="form-group  " >
									<label for="Enable" class=" control-label col-md-4 text-left"> Enable </label>
									<div class="col-md-8">
									  
					<label class='radio radio-inline'>
					<input type='radio' name='enable' value ='0'  @if($row['enable'] == '0') checked="checked" @endif > No </label>
					<label class='radio radio-inline'>
					<input type='radio' name='enable' value ='1'  @if($row['enable'] == '1') checked="checked" @endif > Yes </label> 
									 </div> 
								  </div> </fieldset>
			</div>
			
			
			<div style="clear:both"></div>	
				
			  <div class="form-group">
				<label class="col-sm-4 text-right">&nbsp;</label>
				<div class="col-sm-8">	
				<button type="submit" class="btn btn-primary ">  {{ Lang::get('core.sb_save') }} </button>
				<button type="button" onclick="location.href='{{ URL::to('blogcategories') }}' " id="submit" class="btn btn-success ">  {{ Lang::get('core.sb_cancel') }} </button>
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