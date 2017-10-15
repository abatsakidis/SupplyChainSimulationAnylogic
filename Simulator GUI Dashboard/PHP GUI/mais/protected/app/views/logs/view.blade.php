<div class="page-content row">
    <!-- Page header -->
    <div class="page-header">
      <div class="page-title">
        <h3> {{ $pageTitle }} <small>{{ $pageNote }}</small></h3>
      </div>
      <ul class="breadcrumb">
        <li><a href="{{ URL::to('config/dashboard') }}">{{ Lang::get('core.home') }}</a></li>
		<li><a href="{{ URL::to('logs') }}">{{ $pageTitle }}</a></li>
        <li class="active"> {{ Lang::get('core.detail') }} </li>
      </ul>
	 </div>  
	 
	 
 	<div class="page-content-wrapper">   
	   <div class="toolbar-line">
	   		<a href="{{ URL::to('logs') }}" class="tips btn btn-xs btn-default" title="{{ Lang::get('core.btn_back') }}"><i class="icon-table"></i>&nbsp;{{ Lang::get('core.btn_back') }}</a>
			@if($access['is_add'] ==1)
	   		<a href="{{ URL::to('logs/add/'.$id) }}" class="tips btn btn-xs btn-primary" title="{{ Lang::get('core.btn_edit') }}"><i class="icon-pencil3"></i>&nbsp;{{ Lang::get('core.btn_edit') }}</a>
			@endif  
			@if($access['is_remove'] ==1)
			<a href="javascript://ajax"  onclick="SximoDelete();"class="tips btn btn-xs btn-danger" title="{{ Lang::get('core.btn_remove') }}"><i class="icon-bubble-trash"></i>&nbsp;{{ Lang::get('core.btn_remove') }}</a>
			@endif 			   	  
		</div>
		  
	 {{ Form::open(array('url'=>'logs/destroy/', 'class'=>'form-horizontal' ,'ID' =>'SximoTable' )) }}
		<div style="display:none"> <input type="checkbox"  checked="checked" class="ids"  name="id[]" value="{{ $id }}" /></div>
	{{ Form::close() }}
	<div class="table-responsive">
	<table class="table table-striped table-bordered" >
		<tbody>	
	
					<tr>
						<td width='30%' class='label-view text-right'>IP</td>
						<td>{{ $row->ipaddress }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Users</td>
						<td>{{ SiteHelpers::gridDisplayView($row->user_id,'user_id','1:tb_users:id:first_name') }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Module</td>
						<td>{{ $row->module }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Task</td>
						<td>{{ $row->task }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Note</td>
						<td>{{ $row->note }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Logdate</td>
						<td>{{ $row->logdate }} </td>
						
					</tr>
				
		</tbody>	
	</table>    
	</div>
	</div>
</div>
	  