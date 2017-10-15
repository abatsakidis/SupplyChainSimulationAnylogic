    <div class="toolbar-line row">
			@if($access['is_add'] ==1)
	   		<a href="{{ URL::to($pageModule.'/add?md='.$masterdetail["filtermd"]) }}" class="tips btn btn-xs btn-primary"  title="{{ Lang::get('core.btn_create') }}"
			onclick="SximoModal(this.href,'{{ Lang::get('core.btn_create') }}'); return false;">
			<i class="icon-plus-circle2"></i>&nbsp;{{ Lang::get('core.btn_create') }}</a>
			<button type="button" onclick="ajaxCopy('#{{ $pageModule }}','{{ $pageUrl }}')" class="tips btn btn-info btn-xs" title="{{ Lang::get('core.btn_copy') }}"><i class="icon-file-plus" ></i>&nbsp;{{ Lang::get('core.btn_copy') }}</button>
			@endif  
			@if($access['is_remove'] ==1)
			<a href="javascript://ajax"  onclick="ajaxRemove('#{{ $pageModule }}','{{ $pageUrl }}');" class="tips btn btn-xs btn-danger" title="{{ Lang::get('core.btn_remove') }}">
			<i class="icon-bubble-trash"></i>&nbsp;{{ Lang::get('core.btn_remove') }}</a>
			@endif 		

				@if($access['is_excel'] ==1)
				<div class="btn-group">				
				   <button type="button" class="btn btn-primary btn-xs dropdown-toggle tips"  title=" {{ Lang::get('core.btn_download') }} "
					  data-toggle="dropdown">
					  <i class="icon-folder-download2"></i> {{ Lang::get('core.btn_download') }} <span class="caret"></span>
				   </button>
				   <ul class="dropdown-menu" role="menu">
					  <li><a href="{{ URL::to( $pageModule .'/export/excel?md='.$masterdetail["filtermd"]) }}" title="Export to Excel" > Export Excel </a></li>
					  <li><a href="{{ URL::to( $pageModule .'/export/word?md='.$masterdetail["filtermd"]) }}"  title="Export to Word"> Export Word </a></li>
					  <li><a href="{{ URL::to( $pageModule .'/export/csv?md='.$masterdetail["filtermd"]) }}"   title="Export to CSV"> Export CSV</a></li>
				   </ul>
				</div> 			
				@endif	
				<a href="{{ URL::to( $pageModule .'/export/print?md='.$masterdetail["filtermd"]) }}" onclick="ajaxPopupStatic(this.href); return false;" class="tips btn btn-xs btn-info"  title=" Print ">
				<i class="icon-print"></i> Print </a>			
				@if(Session::get('gid') ==1)
				<a href="{{ URL::to('module/config/'.$pageModule) }}" class="tips btn btn-xs btn-default"  title="{{ Lang::get('core.btn_config') }}">
				<i class="icon-cog"></i>&nbsp; {{ Lang::get('core.btn_config') }}</a>	
				@endif 
				<a href="javascript:void(0)" class="tips btn btn-xs btn-default" 
				onclick="reloadData('#{{ $pageModule }}','{{ $pageUrl }}/data?md={{ $masterdetail["filtermd"] }}')"  title="Reload Data">
			<i class="icon-spinner7"></i> Reload </a>				
					
		
	</div> 
