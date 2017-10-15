{{--*/ usort($tableGrid, "SiteHelpers::_sort") /*--}}
  <div class="page-content row">
    <!-- Page header -->
    <div class="page-header">
      <div class="page-title">
        <h3> {{ $pageTitle }} <small>{{ $pageNote }}</small></h3>
      </div>

      <ul class="breadcrumb">
	  	<li><a href="{{ URL::to('dashboard') }}">{{ Lang::get('core.home') }}</a></li>
		<li class="active">{{ $pageTitle }}</li>
	</ul>	  
	  
    </div>


  <div class="page-content-wrapper">
    <div class="toolbar-line">	  
			@if($access['is_add'] ==1)<a href="{{ URL::to('blogcategories/add') }}" class="tips btn btn-xs btn-primary"  title="{{ Lang::get('core.btn_create') }}">
			<i class="icon-plus-circle2"></i>&nbsp;{{ Lang::get('core.btn_create') }}</a>@endif  
			@if($access['is_remove'] ==1)<a href="javascript://ajax"  onclick="SximoDelete();" class="tips btn btn-xs btn-danger" title="{{ Lang::get('core.btn_remove') }}">
			<i class="icon-bubble-trash"></i>&nbsp;{{ Lang::get('core.btn_remove') }}</a>@endif 		
			@if($access['is_excel'] ==1)<a href="{{ URL::to('blogcategories/download') }}" class="tips btn btn-xs btn-default" title="{{ Lang::get('core.btn_download') }}">
			<i class="icon-folder-download2"></i>&nbsp;{{ Lang::get('core.btn_download') }} </a>@endif		
		 	@if(Session::get('gid') ==1)<a href="{{ URL::to('module/config/blogcategories') }}" class="tips btn btn-xs btn-default"  title="{{ Lang::get('core.btn_config') }}">
			<i class="icon-cog"></i>&nbsp;{{ Lang::get('core.btn_config') }} </a>@endif  			
	</div>  
	
	@include('blogadmin/tab')	
	@if(Session::has('message'))	  
		   {{ Session::get('message') }}
	@endif	

	{{ $details }}

		

	 {{ Form::open(array('url'=>'blogcategories/destroy/', 'class'=>'form-horizontal' ,'id' =>'SximoTable' )) }}
	 <div class="table-responsive">
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
					<td width="50"><input type="checkbox" class="ids" name="id[]" value="{{ $row->CatID }}" />  </td>									
				 @foreach ($tableGrid as $field)
					 @if($field['view'] =='1')
					 <td>					 
					 	@if($field['attribute']['image']['active'] =='1')
							{{ SiteHelpers::showUploadedFile($row->$field['field'],$field['attribute']['image']['path']) }}
						@else	
							{{--*/ $conn = (isset($field['conn']) ? $field['conn'] : array() ) /*--}}
							{{ SiteHelpers::gridDisplay($row->$field['field'],$field['field'],$conn) }}	
						@endif						 
					 </td>
					 @endif					 
				 @endforeach
				 <td>
				 	<div class="btn-group">
					{{--*/ $id = SiteHelpers::encryptID($row->CatID) /*--}}
				 	@if($access['is_detail'] ==1)
					<a href="{{ URL::to('blogcategories/show/'.$id)}}"  class="tips btn btn-xs btn-default"  title="{{ Lang::get('core.btn_view') }}"><i class="icon-paragraph-justify"></i> </a>
					@endif
					@if($access['is_edit'] ==1)
					<a  href="{{ URL::to('blogcategories/add/'.$id)}}"  class="tips btn btn-xs btn-success"  title="{{ Lang::get('core.btn_edit') }}"> <i class="icon-pencil4"></i></a>
					@endif
					@foreach($subgrid as $md)
					<a href="{{ URL::to($md['module'].'?md='.$md['master'].'+'.$md['master_key'].'+'.$md['module'].'+'.$md['key'].'+'.$id) }}"  class="tips btn btn-xs btn-info"  title=" {{ $md['title'] }}">
						<i class="icon-eye2"></i></a>
					@endforeach							
					</div>
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
	
<script>
$(document).ready(function(){

	$('.do-quick-search').click(function(){
		$('#SximoTable').attr('action','{{ URL::to("blogcategories/multisearch")}}');
		$('#SximoTable').submit();
	});
	
});	
</script>		