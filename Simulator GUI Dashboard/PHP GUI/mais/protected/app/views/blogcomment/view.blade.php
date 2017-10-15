<div class="page-content row">
    <!-- Page header -->
    <div class="page-header">
      <div class="page-title">
        <h3> {{ $pageTitle }} <small>{{ $pageNote }}</small></h3>
      </div>

      <ul class="breadcrumb">
        <li><a href="{{ URL::to('dashboard') }}">{{ Lang::get('core.home') }}</a></li>
		<li><a href="{{ URL::to('blogcomment') }}">{{ $pageTitle }}</a></li>
        <li class="active"> {{ Lang::get('core.detail') }} </li>
      </ul>
	</div>
	
  
	   <div class="page-content-wrapper">
	   <div class="toolbar-line">
	   		<a href="{{ URL::to('blogcomment') }}" class="tips btn btn-xs btn-default" title="{{ Lang::get('core.btn_back') }}"><i class="icon-table"></i>&nbsp;{{ Lang::get('core.btn_back') }}</a>
			@if($access['is_add'] ==1)
	   		<a href="{{ URL::to('blogcomment/add/'.$id) }}" class="tips btn btn-xs btn-primary" title="{{ Lang::get('core.btn_edit') }}"><i class="icon-pencil3"></i>&nbsp;{{ Lang::get('core.btn_edit') }}</a>
			@endif  
			@if($access['is_remove'] ==1)
			<a href="javascript://ajax"  onclick="SximoDelete();"class="tips btn btn-xs btn-danger" title="{{ Lang::get('core.btn_remove') }}"><i class="icon-bubble-trash"></i>&nbsp;{{ Lang::get('core.btn_remove') }}</a>
			@endif 	   	   	  
		</div> 
		
		 
	 {{ Form::open(array('url'=>'blogcomment/destroy/', 'class'=>'form-horizontal' ,'ID' =>'SximoTable' )) }}
		<div style=" display:none;"> <input type="checkbox" style="display:none" checked="checked" class="ids"  name="id[]" value="{{ $id }}" /></div>
	{{ Form::close() }}
	<div class="table-responsive">
	<table class="table table-striped table-bordered" >
		<tbody>	
	
					<tr>
						<td width='30%' class='label-view text-right'>Post By</td>
						<td>{{ SiteHelpers::gridDisplayView($row->user_id,'user_id','1:tb_users:id:email') }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Post Title</td>
						<td>{{ SiteHelpers::gridDisplayView($row->blogID,'blogID','1:tb_blogs:blogID:title') }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Comment</td>
						<td>{{ $row->comment }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Created</td>
						<td>{{ $row->created }} </td>
						
					</tr>
				
		</tbody>	
	</table>    
	</div>
</div>
	  