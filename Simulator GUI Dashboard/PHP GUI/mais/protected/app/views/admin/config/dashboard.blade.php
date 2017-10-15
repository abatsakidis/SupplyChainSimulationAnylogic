
<div class="page-content">
	<div class="page-header">
	  <div class="page-title">
		<h3> Dashboard <small> Summary info site </small></h3>
	  </div>
	</div>
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="{{ URL::to('config/dashboard') }}">Home</a></li>
        <li class="active">Dashboard</li>
      </ul>
	  
	</div> 
	
	@if(Session::get('gid') ==1)
    <!-- Default info blocks -->


				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="dashboard-stat blue-madison">
						<div class="visual">
							<i class="icon-plus-circle2"></i>
						</div>
						<div class="details">
							<div class="number">
								Module(s) 
							</div>
							<div class="desc">
								
								{{ Lang::get('core.btn_create'); }} Module
							</div>
						</div>
						<a href="{{ URL::to('module') }}" class="more">
						View more <i class="fa fa-arrow-circle-o-right"></i>
						</a>
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="dashboard-stat red-intense">
						<div class="visual">
							<i class="icon-cogs"></i>
						</div>
						<div class="details">
							<div class="number">
								{{ Lang::get('core.m_setting'); }}
							</div>
							<div class="desc">
								 Configuration Application
							</div>
						</div>
						<a href="{{ URL::to('config') }}" class="more">
						View more  <i class="fa fa-arrow-circle-o-right"></i>
						</a>
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="dashboard-stat green-haze">
						<div class="visual">
							<i class="icon-stats2"></i>
						</div>
						<div class="details">
							<div class="number">
								 Site Menu
							</div>
							<div class="desc">
								{{ Lang::get('core.m_menu'); }}
							</div>
						</div>
						<a href="{{ URL::to('menu') }}" class="more">
						View more  <i class="fa fa-arrow-circle-o-right"></i>
						</a>
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="dashboard-stat purple-plum">
						<div class="visual">
							<i class="icon-users"></i>
						</div>
						<div class="details">
							<div class="number">
									Users
							</div>
							<div class="desc">
								  {{ Lang::get('core.m_users'); }} + {{ Lang::get('core.m_groups'); }} 
							</div>
						</div>
						<a href="{{ URL::to('users') }}" class="more">
						View more  <i class="fa fa-arrow-circle-o-right"></i>
						</a>
					</div>
				</div>	
	
	
	<!-- /default info blocks -->	
	

	@endif
	
	

				
	
</div>