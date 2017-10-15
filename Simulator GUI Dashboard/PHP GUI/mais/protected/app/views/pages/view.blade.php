<div class="page-content row ">
    <!-- Page header -->
    <div class="page-header">
      <div class="page-title">
        <h3> {{ $pageTitle }} <small>{{ $pageNote }}</small></h3>
      </div>
      <ul class="breadcrumb">
         <li><a href="{{ URL::to('dashboard') }}">{{ Lang::get('core.home'); }}</a></li>
		<li><a href="{{ URL::to('pages') }}">{{ $pageTitle }}</a></li>
        <li class="active"> view </li>
      </ul>
	</div>  
	
	<div class="page-content-wrapper">
	   <div class="toolbar-line">
	   		<a href="{{ URL::to('pages') }}" class="tips btn btn-xs btn-default" title="{{ Lang::get('core.btn_back') }}"><i class="icon-table"></i>&nbsp;{{ Lang::get('core.btn_back') }}</a>
			@if($access['is_add'] ==1)
	   		<a href="{{ URL::to('pages/add/'.$id) }}" class="tips btn btn-xs btn-primary" title="{{ Lang::get('core.btn_edit') }}"><i class="icon-pencil3"></i>&nbsp;{{ Lang::get('core.btn_edit') }}</a>
			@endif  
			@if($access['is_remove'] ==1)
			<a href="javascript://ajax"  onclick="SximoDelete();"class="tips btn btn-xs btn-danger" title="{{ Lang::get('core.btn_remove') }}"><i class="icon-bubble-trash"></i>&nbsp;{{ Lang::get('core.btn_remove') }}</a>
			@endif 			   	  
		</div>
			
	 {{ Form::open(array('url'=>'pages/destroy/', 'class'=>'form-horizontal' ,'ID' =>'SximoTable' )) }}
	 	<div style=" display:none;">
			<input type="checkbox" style="display:none" checked="checked" class="ids"  name="id[]" value="{{ $id }}" />
		</div>	
	{{ Form::close() }}
	<div class="table-responsive">
	<table class="table table-striped table-bordered" >
		<tbody>	
	
					<tr>
						<td width='30%' class='label-view text-right'>Title</td>
						<td>{{ $row->title }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Slug</td>
						<td>{{ $row->alias }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Created</td>
						<td>{{ $row->created }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Updated</td>
						<td>{{ $row->updated }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Filename</td>
						<td>{{ $row->filename }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Status</td>
						<td>{{ $row->status }} </td>
						
					</tr>

				
		</tbody>	
	</table>    
	</div>
	</div>
</div>
	  