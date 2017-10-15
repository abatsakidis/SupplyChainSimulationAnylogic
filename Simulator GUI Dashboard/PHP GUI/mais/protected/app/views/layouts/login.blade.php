<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>{{ CNF_APPNAME }}</title>
<link rel="shortcut icon" href="{{ URL::to('')}}/logo.ico" type="image/x-icon">
		{{ HTML::style('sximo/js/plugins/bootstrap/css/bootstrap.css')}}
		{{ HTML::style('sximo/css/sximo.css')}}
	
		
		{{ HTML::style('sximo/css/icons.min.css')}}
		 <script src="//use.edgefonts.net/source-sans-pro.js"></script>
		{{ HTML::script('sximo/js/plugins/jquery.min.js') }}
		{{ HTML::script('sximo/js/plugins/parsley.js') }}
		{{ HTML::script('sximo/js/plugins/bootstrap/js/bootstrap.js') }}

		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->	

		
	
  	</head>
<body class="gray-bg">
    <div class="middle-box  ">
        <div>

            {{ $content }}	
        </div>
    </div>



</body> 
</html>