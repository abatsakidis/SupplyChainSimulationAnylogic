<div class="wrapper-header ">
    <div class="container">
		<div class="row">
			<div class="col-sm-6 col-lg-6">
			  <div class="page-title">
				<h3> {{ $page['pageTitle'] }} <small> {{ $page['pageNote'] }} </small></h3>
			  </div>
			</div>
			<div class="col-sm-6 col-lg-6 ">
			  <ul class="breadcrumb pull-right">
				<li><a href="{{ URL::to('') }}">Home</a></li>
				<li class="active"> {{  $page['pageTitle'] }}</li>
			  </ul>		
			</div>
		</div>		  
    </div>
</div>