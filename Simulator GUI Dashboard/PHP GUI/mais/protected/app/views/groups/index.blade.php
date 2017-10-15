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
				<a href="{{ URL::to('groups/add') }}" class="tips btn btn-xs btn-primary"  title="{{ Lang::get('core.btn_create') }}">
				<i class="icon-plus-circle2"></i>&nbsp; {{ Lang::get('core.btn_create') }}</a>
				@endif  
				@if($access['is_remove'] ==1)
				<a href="javascript://ajax"  onclick="SximoDelete();" class="tips btn btn-xs btn-danger" title="{{ Lang::get('core.btn_remove') }}">
				<i class="icon-bubble-trash"></i>&nbsp; {{ Lang::get('core.btn_remove') }}</a>
				@endif 		
				@if($access['is_excel'] ==1)
				<a href="{{ URL::to('groups/download') }}" class="tips btn btn-xs btn-default" title="{{ Lang::get('core.btn_download') }}">
				<i class="icon-folder-download2"></i>&nbsp;{{ Lang::get('core.btn_download') }} </a>
				@endif		
				@if(Session::get('gid') ==1)
				<a href="{{ URL::to('module/config/groups') }}" class="tips btn btn-xs btn-default"  title="{{ Lang::get('core.btn_config') }}">
				<i class="icon-cog"></i>&nbsp; {{ Lang::get('core.btn_config') }}</a>
				@endif  	  
		</div>  		 

	<ul class="nav nav-tabs" style="margin-bottom:10px;">
	  <li><a href="{{ URL::to('users')}}"> Users </a></li>
	  <li  class="active"><a href="{{ URL::to('groups')}}">Groups</a></li>
	</ul>		
		
	@if(Session::has('message'))	  
		   {{ Session::get('message') }}
	@endif	
	{{ $details }}
	<div class="table-responsive">
	 {{ Form::open(array('url'=>'groups/destroy/', 'class'=>'form-horizontal' ,'ID' =>'SximoTable' )) }}
    <table class="table table-striped ">
        <thead>
			<tr>
				<th> No </th>
				<th> <input type="checkbox" class="checkall" /></th>
				@foreach ($tableGrid as $t)
				@if($t['view'] =='1')
				<th>{{ $t['label'] }}</th>
				@endif
				@endforeach
				<th>{{ Lang::get('core.btn_action') }}</th>
			  </tr>
        </thead>

        <tbody>
            @foreach ($rowData as $row)
                <tr>
					<td width="50"> {{ ++$i }} </td>
					<td width="50"><input type="checkbox" class="ids" name="id[]" value="{{ $row->group_id }}" />  </td>				
				 @foreach ($tableGrid as $field)
					 @if($field['view'] =='1')
					 <td>					 
					 	@if($field['attribute']['image']['active'] =='1')
							<img src="{{ asset($field['attribute']['image']['path'].'/'.$row->$field['field'])}}" width="50" />
						@else	
							{{--*/ $conn = (isset($field['conn']) ? $field['conn'] : array() ) /*--}}
							{{ SiteHelpers::gridDisplay($row->$field['field'],$field['field'],$conn) }}	
						@endif						 
					 </td>
					 @endif					 
				 @endforeach
				 <td>
				 
					{{--*/ $id = SiteHelpers::encryptID($row->group_id) /*--}}
				 	@if($access['is_detail'] ==1)
					<a href="{{ URL::to('groups/show/'.$id)}}"  class="tips btn btn-xs btn-primary"  title="{{ Lang::get('core.btn_view') }}"><i class="fa  fa-search"></i> </a>
					@endif
					@if($access['is_edit'] ==1)
					<a  href="{{ URL::to('groups/add/'.$id)}}"  class="tips btn btn-xs btn-success"  title="{{ Lang::get('core.btn_edit') }}"> <i class="fa fa-edit"></i></a>
					@endif
					@foreach($subgrid as $md)
					<a href="{{ URL::to($md['module'].'?md='.$md['master'].'+'.$md['master_key'].'+'.$md['module'].'+'.$md['key'].'+'.$id) }}"  class="tips btn btn-xs btn-info"  title=" {{ $md['title'] }}">
						<i class="icon-eye2"></i></a>
					@endforeach							
				
				</td>				 
                </tr>
            @endforeach
              
        </tbody>
      
    </table>
	</div>
	{{ Form::close() }}
	@include('footer')
	
	
	
	</div>	  
</div>	