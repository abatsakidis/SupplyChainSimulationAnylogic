
<div class="page-content row">
    <!-- Page header -->
    <div class="page-header ">
      <div class="page-title">
        <h3> {{ Lang::get('core.t_module') }} <small>{{ Lang::get('core.t_modulesmall') }}</small></h3>
      </div>
    </div>
	<div class="page-content-wrapper">
	<div class="ribon-sximo">
<section >

		<div class="row m-l-none m-r-none m-t  white-bg shortcut " >
			<div class="col-sm-6 col-md-3 b-r  p-sm ">
				<span class="pull-left m-r-sm text-info"><i class="icon-plus-circle2"></i></span> 
				<a href="{{ URL::to('module/add') }}" class="clear">
					<span class="h3 block m-t-xs"><strong> Create Module </strong>
					</span> <small class="text-muted text-uc"> Create new module  </small>
				</a>
			</div>
			<div class="col-sm-6 col-md-3 b-r  p-sm">
				<span class="pull-left m-r-sm text-success"><i class="icon-folder-upload2"></i></span>
				<a href="javascript:void(0)" class="clear " onclick="$('.unziped').toggle()">
					<span class="h3 block m-t-xs"><strong>Install Module </strong>
					</span> <small class="text-muted text-uc"> Install new module packages </small> 
				</a>
			</div>				
			<div class="col-sm-6 col-md-3 b-r  p-sm">
				<span class="pull-left m-r-sm text-warning"><i class="icon-file-zip"></i></span>
				<a href="{{ URL::to('module/package') }}" class="clear post_url">
					<span class="h3 block m-t-xs"><strong>Backup</strong>
					</span> <small class="text-muted text-uc"> Backup and make installer for modules </small> 
				</a>
			</div>

		</div> </section>		

		
	</div>
	


	


	<ul class="nav nav-tabs" style="margin-bottom:10px;">
	  <li @if($type =='addon') class="active" @endif><a href="{{ URL::to('module')}}"> {{ Lang::get('core.tab_installed') }}  </a></li>
	  <li @if($type =='core') class="active" @endif><a href="{{ URL::to('module?t=core')}}">{{ Lang::get('core.tab_core') }}</a></li>
	</ul>
		
	@if(Session::has('message'))
		   {{ Session::get('message') }}
	@endif	
	      <div class="white-bg p-sm m-b unziped" style=" border:solid 1px #ddd; display:none;">
		   {{ Form::open(array('url'=>'module/install/', 'class'=>'breadcrumb-search','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) }}
			<h3>Select File ( Module zip installer ) </h3>
            <p>  <input type="file" name="installer" required style="float:left;">  <button type="submit" class="btn btn-primary btn-xs" style="float:left;"  ><i class="icon-upload"></i> Install</button></p>
            </form>
			<div class="clr"></div>
          </div>
		  	
	
	 {{ Form::open(array('url'=>'module/package#', 'class'=>'form-horizontal' ,'ID' =>'SximoTable' )) }}
	<div class="table-responsive ibox-content" style="min-height:400px;">
	@if(count($rowData) >=1) 
		<table class="table table-striped ">
			<thead>
			<tr>
				<th>Action</th>					
				<th><input type="checkbox" class="checkall" /></th>
				<th>Module</th>
				<th>Controller</th>
				<th>Database</th>
				<th>PRI</th>
				<th>Created</th>
		
			</tr>
			</thead>
        <tbody>
		@foreach ($rowData as $row)
			<tr>		
				<td>
				<div class="btn-group">
				<button class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown">
				<I class="icon-cogs"></I> <span class="caret"></span>
				</button>
					<ul style="display: none;" class="dropdown-menu icons-right">
						<li><a href="{{ URL::to($row->module_name)}}"><i class="icon-grid"></i> {{ Lang::get('core.btn_view') }} Module </a></li>
						<li><a href="{{ URL::to($module.'/config/'.$row->module_name)}}"><i class="icon-pencil3"></i> {{ Lang::get('core.btn_edit') }}</a></li>
						@if($type !='core')
						<li><a href="javascript://ajax" onclick="SximoConfirmDelete('{{ URL::to('module/destroy/'.$row->module_id)}}')"><i class="icon-bubble-trash"></i> {{ Lang::get('core.btn_remove') }}</a></li>
						<li class="divider"></li>
						<li><a href="{{ URL::to('module/rebuild/'.$row->module_id)}}"><i class="icon-spinner7"></i> Rebuild All Codes</a></li>
						@endif
					</ul>
				</div>					
				</td>
				<td>
				 @if($type !='core')
				<input type="checkbox" class="ids" name="id[]" value="{{ $row->module_id }}" /> @endif</td>
				<td>{{ $row->module_title }} </td>
				<td>{{ $row->module_name }} </td>
				<td>{{ $row->module_db }} </td>
				<td>{{ $row->module_db_key }} </td>
				<td>{{ $row->module_created }} </td>
			</tr>
		@endforeach	
	</tbody>		
	</table>
	
	@else
		
		<p class="text-center" style="padding:50px 0;">{{ Lang::get('core.norecord') }} 
		<br /><br />
		<a href="{{ URL::to('module/add')}}" class="btn btn-default "><i class="icon-plus-circle2"></i> New module </a>
		 </p>	
	@endif
	</div>	
	{{ Form::close() }}
	</div>	

</div>	  
	  
  <script language='javascript' >
  jQuery(document).ready(function($){
    $('.post_url').click(function(e){
      e.preventDefault();
      if( ( $('.ids',$('#SximoTable')).is(':checked') )==false ){
        alert( $(this).attr('data-title') + " not selected");
        return false;
      }
      $('#SximoTable').attr({'action' : $(this).attr('href') }).submit();
    })
  })
  </script>	  
