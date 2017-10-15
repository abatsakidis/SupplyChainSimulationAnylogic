{{--*/ usort($tableGrid, "SiteHelpers::_sort") /*--}}
  <div class="page-content row">
    <!-- Page header -->
    <div class="page-header">
      <div class="page-title">
        <h3> {{ $pageTitle }} <small>{{ $pageNote }}</small></h3>
      </div>
      <ul class="breadcrumb">
        <li><a href="{{ URL::to('config/dashboard') }}">{{ Lang::get('core.home') }}</a></li>
        <li class="active">{{ $pageTitle }}</li>
      </ul>
	</div>  
	
	<div class="page-content-wrapper">
		<div class="toolbar-line ">	
				@if($access['is_excel'] ==1)
				<a href="{{ URL::to('{class}/download') }}" class="tips btn btn-xs btn-default" title="{{ Lang::get('core.btn_download') }}">
				<i class="icon-folder-download2"></i>&nbsp;{{ Lang::get('core.btn_download') }} </a>
				@endif		
				@if(Session::get('gid') ==1)
				<a href="{{ URL::to('module/config/{class}') }}" class="tips btn btn-xs btn-default"  title="{{ Lang::get('core.btn_config') }}">
				<i class="icon-cog"></i>&nbsp;{{ Lang::get('core.btn_config') }} </a>	
				@endif  			
		 
		</div> 	
		
	@if(Session::has('message'))	  
		   {{ Session::get('message') }}
	@endif	
	<div class="table-responsive">
	 {{ Form::open(array('url'=>'{class}/destroy/', 'class'=>'form-horizontal' ,'ID' =>'SximoTable' )) }}
    <table class="table table-striped ">
        <thead>
		<tr>
			<th> No </th>
		 @foreach ($tableGrid as $t)
		 	@if($t['view'] =='1')
			 <th>{{ $t['label'] }}</th>
			 @endif
		  @endforeach
           </tr>
        </thead>

        <tbody>
            @foreach ($rowData as $row)
                <tr>
					<td width="50"> {{ ++$i }} </td>
				 @foreach ($tableGrid as $field)
					 @if($field['view'] =='1')
					 <td>					 
					 	@if($field['attribute']['image']['active'] =='1')
							<img src="{{ asset($field['attribute']['image']['path'].'/'.$row->$field['field'])}}" width="50" />
						@else	
							{{ $row->$field['field'] }}	
						@endif						 
					 </td>
					 @endif					 
				 @endforeach
                </tr>
            @endforeach
              
        </tbody>
      
    </table>
	{{ Form::close() }}
	</div>
	@include('footer')
</div>	  