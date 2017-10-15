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
    <div class="toolbar-line ">
			@if($access['is_add'] ==1)
	   		<a href="{{ URL::to('{class}/add?md='.$masterdetail["filtermd"].$trackUri) }}" class="tips btn btn-xs btn-info"  title="{{ Lang::get('core.btn_create') }}">
			<i class="icon-plus-circle2"></i>&nbsp;{{ Lang::get('core.btn_create') }}</a>
			<button type="button" onclick="ajaxCopy('#{class}','{{ URL::to('{class}')}}')" class="tips btn btn-info btn-xs" title="{{ Lang::get('core.btn_copy') }}"><i class="icon-file-plus" ></i>&nbsp;{{ Lang::get('core.btn_copy') }}</button>
			@endif  
			@if($access['is_remove'] ==1)
			<a href="javascript://ajax"  onclick="SximoDelete();" class="tips btn btn-xs btn-danger" title="{{ Lang::get('core.btn_remove') }}">
			<i class="icon-bubble-trash"></i>&nbsp;{{ Lang::get('core.btn_remove') }}</a>
			@endif 		
			@if($access['is_excel'] ==1)
			<div class="btn-group">				
			   <button type="button" class="btn btn-primary btn-xs dropdown-toggle tips"  title=" {{ Lang::get('core.btn_download') }} "
				  data-toggle="dropdown">
				  <i class="icon-folder-download2"></i> {{ Lang::get('core.btn_download') }} <span class="caret"></span>
			   </button>
			   <ul class="dropdown-menu" role="menu">
				  <li><a href="{{ URL::to('{class}/export/excel?md='.$masterdetail["filtermd"]) }}" title="Export to Excel" > Export Excel1 </a></li>
				  <li><a href="{{ URL::to( '{class}/export/word?md='.$masterdetail["filtermd"]) }}"  title="Export to Word"> Export Word </a></li>
				  <li><a href="{{ URL::to('{class}/export/csv?md='.$masterdetail["filtermd"]) }}"   title="Export to CSV"> Export CSV</a></li>
			   </ul>
			</div> 	
			@endif	
			<a href="{{ URL::to( '{class}/export/print?md='.$masterdetail["filtermd"]) }}" onclick="ajaxPopupStatic(this.href); return false;" class="tips btn btn-xs btn-info"  title=" Print ">
				<i class="icon-print"></i> Print </a>		
		 	@if(Session::get('gid') ==1)
			<a href="{{ URL::to('module/config/{class}') }}" class="tips btn btn-xs btn-default"  title="{{ Lang::get('core.btn_config') }}">
			<i class="icon-cog"></i>&nbsp;{{ Lang::get('core.btn_config') }} </a>	
			@endif  			
	 
	</div> 	
	 
		
	@if(Session::has('message'))	  
		   {{ Session::get('message') }}
	@endif	
	{{ $details }}
	
	 {{ Form::open(array('url'=>'{class}/destroy/', 'class'=>'form-horizontal' ,'id' =>'SximoTable' )) }}
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
			<tr id="sximo-quick-search" >
				<td> # </td>
				<td> </td>
				@foreach ($tableGrid as $t)
					@if($t['view'] =='1')
					<td>						
						{{ SiteHelpers::transForm($t['field'] , $tableForm) }}								
					</td>
					@endif
				@endforeach
				<td style="width:130px;">
				<input type="hidden"  value="Search">
				<button type="button"  class=" do-quick-search btn btn-sx btn-info"> GO</button></td>
			  </tr>				
            @foreach ($rowData as $row)
                <tr>
					<td width="50"> {{ ++$i }} </td>
					<td width="50"><input type="checkbox" class="ids" name="id[]" value="{{ $row->{key} }}" />  </td>									
				 @foreach ($tableGrid as $field)
					 @if($field['view'] =='1')
					 <td>					 
					 	<?php 
							$conn = (isset($field['conn']) ? $field['conn'] : array() );
							echo AjaxHelpers::gridFormater($row->$field['field'], $row , $field['attribute'],$conn);?>						 
					 </td>
					 @endif					 
				 @endforeach
				 <td>
				 	
					{{--*/ $id = SiteHelpers::encryptID($row->{key}) /*--}}
				 	@if($access['is_detail'] ==1)
					<a href="{{ URL::to('{class}/show/'.$id.'?md='.$masterdetail["filtermd"].$trackUri)}}"  class="tips btn btn-xs btn-primary"  title="{{ Lang::get('core.btn_view') }}"><i class="fa  fa-search"></i> </a>
					@endif
					@if($access['is_edit'] ==1)
					<a  href="{{ URL::to('{class}/add/'.$id.'?md='.$masterdetail["filtermd"].$trackUri)}}"  class="tips btn btn-xs btn-success"  title="{{ Lang::get('core.btn_edit') }}"> <i class="fa fa-edit"></i></a>
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
	<input type="hidden" name="md" value="{{ $masterdetail['filtermd']}}" />
	</div>
	{{ Form::close() }}
	@include('footer')
	
	</div>	  
</div>	
<script>
$(document).ready(function(){

	$('.do-quick-search').click(function(){
		$('#SximoTable').attr('action','{{ URL::to("{class}/multisearch")}}');
		$('#SximoTable').submit();
	});
	
});	

function ajaxCopy(  id , url )
{
	if(confirm('Are u sure copy selected row(s)?')) {
		$('#SximoTable').attr('action','{{ URL::to("{class}/copy")}}');
		$('#SximoTable').submit();		
	}	
}
</script>		
