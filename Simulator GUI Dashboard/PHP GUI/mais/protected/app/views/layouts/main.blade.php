<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>{{ CNF_APPNAME }}</title>
<link rel="shortcut icon" href="{{ URL::to('')}}/logo.ico" type="image/x-icon">
		{{ HTML::style('sximo/js/plugins/bootstrap/css/bootstrap.css')}}
		{{ HTML::style('sximo/fonts/awesome/css/font-awesome.min.css')}}
		{{ HTML::style('sximo/js/plugins/bootstrap.summernote/summernote.css')}}
		{{ HTML::style('sximo/js/plugins/datepicker/css/bootstrap-datetimepicker.min.css')}}
		{{ HTML::style('sximo/js/plugins/bootstrap.datetimepicker/css/bootstrap-datetimepicker.min.css')}}
		{{ HTML::style('sximo/js/plugins/select2/select2.css')}}
		{{ HTML::style('sximo/js/plugins/iCheck/skins/square/green.css')}}
		{{ HTML::style('sximo/js/plugins/fancybox/jquery.fancybox.css') }}
		{{ HTML::style('sximo/css/sximo.css')}}			
		{{ HTML::style('sximo/css/icons.min.css')}}
		



		{{ HTML::script('sximo/js/plugins/jquery.min.js') }}
		{{ HTML::script('sximo/js/plugins/jquery.cookie.js') }}			
		{{ HTML::script('sximo/js/plugins/jquery-ui.min.js') }}				
		{{ HTML::script('sximo/js/plugins/iCheck/icheck.min.js') }}
		{{ HTML::script('sximo/js/plugins/select2/select2.min.js') }}
		{{ HTML::script('sximo/js/plugins/fancybox/jquery.fancybox.js') }}
		{{ HTML::script('sximo/js/plugins/prettify.js') }}
		{{ HTML::script('sximo/js/plugins/parsley.js') }}
		{{ HTML::script('sximo/js/plugins/datepicker/js/bootstrap-datetimepicker.min.js') }}
		{{ HTML::script('sximo/js/plugins/switch.min.js') }}
		{{ HTML::script('sximo/js/plugins/bootstrap.datetimepicker/js/bootstrap-datetimepicker.min.js') }}
		{{ HTML::script('sximo/js/plugins/bootstrap/js/bootstrap.js') }}
		{{ HTML::script('sximo/js/sximo.js') }}
		{{ HTML::script('sximo/js/plugins/jquery.jCombo.min.js') }}
		{{ HTML::script('sximo/js/plugins/bootstrap.summernote/summernote.min.js') }}
		{{ SiteHelpers::initMarkitUp() }}



{{ HTML::script('sximo/js/plugins/ajax/ajaxSximo.js') }}
{{ HTML::script('sximo/js/plugins/ajax/jquery.form.js') }}
{{ HTML::style('sximo/js/plugins/ajax/ajaxSximo.css') }} 





		 <script src="//use.edgefonts.net/source-sans-pro.js"></script>

		<script language="javascript">
		jQuery(document).ready(function($)	{
		   $('.markItUp').markItUp(mySettings );
		});
		</script>
		
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->	

		
	
  	</head>

<body class="sxim-init" >
<div id="wrapper">
	@include('layouts/sidemenu')	
	<div class="gray-bg " id="page-wrapper">
		@include('layouts/headmenu')	
		{{ $content }}		
	</div>

</div>

<div class="modal fade" id="sximo-modal" tabindex="-1" role="dialog">
<div class="modal-dialog">
  <div class="modal-content">
	<div class="modal-header bg-default">
		
		<button type="button " class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h4 class="modal-title">Modal title</h4>
	</div>
	<div class="modal-body" id="sximo-modal-content">

	</div>

  </div>
</div>
</div>

<script type="text/javascript">
jQuery(document).ready(function ($) {

    $('#sidemenu').sximMenu();


		
});	
	
	
</script>
 
</body> 
</html>
