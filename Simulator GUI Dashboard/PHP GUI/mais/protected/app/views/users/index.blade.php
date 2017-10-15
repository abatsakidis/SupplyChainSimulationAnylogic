{{--*/ usort($tableGrid, "SiteHelpers::_sort") /*--}}
  <div class="page-content row">
    <!-- Page header -->
    <div class="page-header">
      <div class="page-title">
        <h3> {{ $pageTitle }} <small>{{ $pageNote }}</small></h3>
      </div>
	  
      <ul class="breadcrumb">
        <li><a href="{{ URL::to('dashboard') }}">{{ Lang::get('core.home'); }}</a></li>
        <li class="active">{{ $pageTitle }}</li>
      </ul>	  
 	
	</div>
	
	<div class="page-content-wrapper">
    <div class="toolbar-line">
			@if($access['is_add'] ==1)
	   		<a href="{{ URL::to('users/add') }}" class="tips btn btn-xs btn-primary"  title="{{ Lang::get('core.btn_create') }}">
			<i class="icon-plus-circle2"></i>&nbsp; {{ Lang::get('core.btn_create') }}</a>
			@endif  
			@if($access['is_remove'] ==1)
			<a href="javascript://ajax"  onclick="SximoDelete();" class="tips btn btn-xs btn-danger" title="{{ Lang::get('core.btn_remove') }}">
			<i class="icon-bubble-trash"></i>&nbsp; {{ Lang::get('core.btn_remove') }}</a>
			@endif 		
			@if($access['is_excel'] ==1)
			<a href="{{ URL::to('users/download') }}" class="tips btn btn-xs btn-default" title="{{ Lang::get('core.btn_download') }}">
			<i class="icon-folder-download2"></i>&nbsp;{{ Lang::get('core.btn_download') }} </a>
			@endif		
		 	@if(Session::get('gid') ==1)
			<a href="{{ URL::to('module/config/users') }}" class="tips btn btn-xs btn-default"  title="{{ Lang::get('core.btn_config') }}">
			<i class="icon-cog"></i>&nbsp; {{ Lang::get('core.btn_config') }}</a>
			@endif  	  
	</div>  	  
	  
   
	
	
	
	
	<ul class="nav nav-tabs" style="margin-bottom:10px;">
	  <li class="active"><a href="#"> Users </a></li>
	  <li ><a href="{{ URL::to('groups')}}">Groups</a></li>
	</ul>	
		
	@if(Session::has('message'))	  
		   {{ Session::get('message') }}
	@endif	

	
	 {{ Form::open(array('url'=>'users/destroy/', 'class'=>'form-horizontal' ,'ID' =>'SximoTable' )) }}
	 <div class="table-responsive">
    <table class="table table-striped  ">
        <thead>
			<tr>
				<th> No </th>
				<th> <input type="checkbox" class="checkall" /></th>
				<th>Avatar</th>
				<th>{{ Lang::get('core.group') }}</th>
				<th>{{ Lang::get('core.username') }}</th>
				<th>{{ Lang::get('core.firstname') }}</th>
				<th>{{ Lang::get('core.lastname') }}</th>
				<th>{{ Lang::get('core.email') }}</th>
				<th>Status</th>
				<th>{{ Lang::get('core.btn_action') }}</th>
			  </tr>
        </thead>

        <tbody>
			<tr id="sximo-quick-search" >
				@if($access['is_detail'] ==1)<td> </td>@endif
				<td> </td>
				@foreach ($tableGrid as $t)
					@if($t['view'] =='1')
					<td>						
						{{ SiteHelpers::transForm($t['field'] , $tableForm) }}								
					</td>
					@endif
				@endforeach
				<td style="width:100px;">
				<input type="hidden"  value="Search">
				<button type="button"  class=" do-quick-search btn btn-sx btn-info"> GO</button></td>
			  </tr>			
            @foreach ($rowData as $row)
                <tr>
					<td width="50"> {{ ++$i }} </td>
					<td width="50"><input type="checkbox" class="ids" name="id[]" value="{{ $row->id }}" />  </td>								
				 @foreach ($tableGrid as $field)
					 @if($field['view'] =='1')
					 <td>					 
					 	
						@if($field['field'] == 'avatar')
							<?php if( file_exists( './uploads/users/'.$row->avatar) && $row->avatar !='') { ?>
							<img src="{{ URL::to('uploads/users').'/'.$row->avatar }} " border="0" width="40" class="img-circle" />
							<?php  } else { ?> 
							<img alt="" src="http://www.gravatar.com/avatar/{{ md5($row->email) }}" width="40" class="img-circle" />
							<?php } ?>					
							
						@elseif($field['field'] =='active')
							{{ ($row->active ==1 ? '<lable class="label label-success">Active</label>' : '<lable class="label label-danger">Inactive</label>')  }}
								
						@else	
							{{--*/ $conn = (isset($field['conn']) ? $field['conn'] : array() ) /*--}}
							{{ SiteHelpers::gridDisplay($row->$field['field'],$field['field'],$conn) }}	
						@endif						 
					 </td>
					 @endif					 
				 @endforeach
				 <td>
				
					{{--*/ $id = SiteHelpers::encryptID($row->id) /*--}}
				 	@if($access['is_detail'] ==1)
					<a href="{{ URL::to('users/show/'.$id)}}"  class="tips btn btn-xs btn-primary"  title="{{ Lang::get('core.btn_view') }}"><i class="fa  fa-search"></i> </a>
					@endif
					@if($access['is_edit'] ==1)
					<a  href="{{ URL::to('users/add/'.$id)}}"  class="tips btn btn-xs btn-success"  title="{{ Lang::get('core.btn_edit') }}"> <i class="fa fa-edit"></i></a>
					@endif
						
					
				</td>				 
                </tr>
					@include('users.inlineview')
            @endforeach
              
        </tbody>
      
    </table>
	</div>
	{{ Form::close() }}
	
	@include('footer')
	
	
	
	</div>	
</div>	
<script>
$(document).ready(function(){

	$('.do-quick-search').click(function(){
		$('#SximoTable').attr('action','{{ URL::to("users/multisearch")}}');
		$('#SximoTable').submit();
	});
	
});	
</script>	  