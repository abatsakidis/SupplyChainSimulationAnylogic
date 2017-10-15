<div class="page-content row">
    <!-- Page header -->
    <div class="page-header">
      <div class="page-title">
        <h3> {{ $pageTitle }} <small>{{ $pageNote }}</small></h3>
      </div>
  

      <ul class="breadcrumb">
        <li><a href="{{ URL::to('dashboard') }}">{{ Lang::get('core.home') }}</a></li>
		<li><a href="{{ URL::to('blogcategories') }}">{{ $pageTitle }}</a></li>
        <li class="active"> {{ Lang::get('core.detail') }} </li>
      </ul>
	  </div>
	 <div class="page-content-wrapper">  
		<div class="toolbar-line">  
	  
	   		<a href="{{ URL::to('blogcategories') }}" class="tips btn btn-xs btn-default" title="{{ Lang::get('core.btn_back') }}"><i class="icon-table"></i>&nbsp;{{ Lang::get('core.btn_back') }}</a>
			@if($access['is_add'] ==1)
	   		<a href="{{ URL::to('blogcategories/add/'.$id) }}" class="tips btn btn-xs btn-success" title="{{ Lang::get('core.btn_edit') }}"><i class="icon-pencil3"></i>&nbsp;{{ Lang::get('core.btn_edit') }}</a>
			@endif  
			@if($access['is_remove'] ==1)
			<a href="javascript://ajax"  onclick="SximoDelete();"class="tips btn btn-xs btn-danger" title="{{ Lang::get('core.btn_remove') }}"><i class="icon-bubble-trash"></i>&nbsp;{{ Lang::get('core.btn_remove') }}</a>
			@endif 	   
	   
	   	  
	</div>  
	
	
	 {{ Form::open(array('url'=>'blogcategories/destroy/', 'class'=>'form-horizontal' ,'ID' =>'SximoTable' )) }}
	 <div style="display:none;">
	 <input type="checkbox" style="display:none !important" checked="checked" class="ids"  name="id[]" value="{{ $id }}" />
	 </div>
	{{ Form::close() }}
	<div class="table-responsive">
	<table class="table table-striped table-bordered" >
		<tbody>	
	
					<tr>
						<td width='30%' class='label-view text-right'>CatID</td>
						<td>{{ $row->CatID }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Name</td>
						<td>{{ $row->name }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Alias</td>
						<td>{{ $row->alias }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Enable</td>
						<td>{{ $row->enable }} </td>
						
					</tr>
				
		</tbody>	
	</table>   
	</div> 
	</div>
</div>
	  