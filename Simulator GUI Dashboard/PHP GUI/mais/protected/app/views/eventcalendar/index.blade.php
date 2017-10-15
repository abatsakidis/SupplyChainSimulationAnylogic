{{ HTML::style('sximo/js/plugins/fullcalendar/fullcalendar/fullcalendar.css') }}
{{ HTML::style('sximo/js/plugins/fullcalendar/fullcalendar/fullcalendar.print.css') }}
{{ HTML::script('sximo/js/plugins/fullcalendar/lib/moment.min.js') }}
{{ HTML::script('sximo/js/plugins/fullcalendar/fullcalendar/fullcalendar.min.js') }}	
		

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
		<div class="toolbar-line">
			@if($access['is_add'] ==1)
			<a href="{{ URL::to('eventcalendar/add') }}" onclick="SximoModal(this.href,'New Calendar'); return false;" class="tips btn btn-xs btn-primary"  title="{{ Lang::get('core.btn_create') }}">
			<i class="icon-plus-circle2"></i>&nbsp; {{ Lang::get('core.btn_create') }}</a>
			@endif  		
			@if($access['is_excel'] ==1)
			<a href="{{ URL::to('eventcalendar/download') }}" class="tips btn btn-xs btn-success" title="{{ Lang::get('core.btn_download') }}">
			<i class="icon-folder-download2"></i>&nbsp;{{ Lang::get('core.btn_download') }} </a>
			@endif		
		 	@if(Session::get('gid') ==1)
			<a href="{{ URL::to('module/config/eventcalendar') }}" class="tips btn btn-xs btn-default"  title="{{ Lang::get('core.btn_config') }}">
			<i class="icon-cog"></i>&nbsp;{{ Lang::get('core.btn_config') }} </a>
			@endif  
		
	  </ul>
	</div>  	
	@if(Session::has('message'))	  
		   {{ Session::get('message') }}
	@endif	

	
	<div class="row">
		
	<div style="padding:10px; background:#fff;">
		<div id='calendar' > </div>
	</div>			

	<div class="alert alert-info">
			<ol>
				<li> Clik on date to add new event</li>  
				<li> Clik on event title to edit current event</li>  
				<li> Drag event title to change event data</li> 
			</ol>	
	</div>
		
	</div>

	
	</div>	  

<script>
$(document).ready(function(){

	$('.do-quick-search').click(function(){
		$('#SximoTable').attr('action','{{ URL::to("eventcalendar/multisearch")}}');
		$('#SximoTable').submit();
	});
	
});	
</script>	

<script>

	$(document).ready(function() {
		
		$('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
			defaultDate: '{{ date("Y-m-d")}}',
			selectable: true,
			selectHelper: true,
			select: function(start, end) {
				SximoModal('{{ URL::to("eventcalendar/add?s='+start+'") }}','Add New Events');
				
			},
		   	eventClick: function(calEvent, jsEvent, view) {
				SximoModal('{{ URL::to("eventcalendar/add/'+calEvent.id+'") }}','Edit :'+calEvent.title );				
		
			},			
			editable: true,
			events: {
				url: '{{ URL::to("eventcalendar/jsondata") }}',
				error: function() {
					$('#script-warning').show();
				}
			},
			eventDrop: function(event, revertFunc) {
				if (confirm("Are you sure about this change?")) {
					
					$.post( '{{ URL::to("eventcalendar/savedrop") }}', 
					{ id:event.id,start : event.start.format(),end : event.end.format()});					
				} else {
					revertFunc();
				}
		
			}		
		});
		
	});

</script>

<style>
	#script-warning {
		display: none;
		background: #eee;
		border-bottom: 1px solid #ddd;
		padding: 0 10px;
		line-height: 40px;
		text-align: center;
		font-weight: bold;
		font-size: 12px;
		color: red;
	}
	.fc-event-inner { background:#0099CC; color:#fff;}

	#loading {
		display: none;
		position: absolute;
		top: 10px;
		right: 10px;
	}

</style>	