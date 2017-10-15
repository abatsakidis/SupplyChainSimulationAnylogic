{{ HTML::style('protected/app/views/blog/blog.css')}}


	<div class="wrapper-header ">
		<div class="container">
			<div class="row">
				<div class="col-sm-6 col-lg-6">
				  <div class="page-title">
					<h3> {{ $pageTitle }} <small> {{ $pageNote }} </small></h3>
				  </div>
				</div>
				<div class="col-sm-6 col-lg-6 ">
				  <ul class="breadcrumb pull-right">
					<li><a href="{{ URL::to('') }}">Home</a></li>
					<li class="active"> {{  $pageTitle }}</li>
				  </ul>		
				</div>
			</div>		  
		</div>
	</div>


  <div class="container">
	<div class="row">

	
	
	@if(Session::has('message'))	  
		   {{ Session::get('message') }}
	@endif	

	
	<div class="col-md-9">
	 @foreach ($rowData as $row)
		<div class="blog-post">
			<div class="post-item">
				<div class="title"><h3><a href="{{ URL::to('blog/read/'.$row->slug)}}"> {{ $row->title }} </a></h3></div>
				<div class="blog-info-small">
					<i class="fa fa-folder icon-muted"></i> <span>  <a href="{{ URL::to('blog/category/'.$row->alias)}}">{{ $row->name}}</a>  </span> 
					<i class="fa fa-user icon-muted"></i> <span> {{ $row->username }} </span>  
					<i class="fa fa-calendar"></i> <span> {{ date("M j, Y " , strtotime($row->created)) }} </span> 
					<i class="fa fa-comments"></i> <span> <a href="{{ URL::to('blog/read/'.$row->slug.'#comments')}}"> {{ $row->comments }} comments</a> </span> 
				</div>	
				<div class="summary">
				
				<?php 
				$content = explode("<hr />",$row->content);
				echo SiteHelpers::renderHtml( $content[0] );
				?>
					<a href="{{ URL::to('blog/read/'.$row->slug)}}" class="btn btn-success btn-sm"> Read More <i class="fa fa-angle-right"></i></a>
				</div>
			</div>	
			
		</div>	
	 @endforeach
	 
	   <div class="col-sm-3">
		<p class="text-center" style="line-height:30px;">
		{{ Lang::get('core.grid_displaying') }} :  <b>{{ $pagination->getFrom() }}</b> 
		{{ Lang::get('core.grid_to') }} <b>{{ $pagination->getTo() }}</b> 
		{{ Lang::get('core.grid_of') }} <b>{{ $pagination->getTotal() }}</b>
		</p>
	   </div>
		<div class="col-sm-4">			 
	  {{ $pagination->appends($pager)->links() }}
	  </div>
	
	</div>
	
	<div class="col-md-3">
		@include('blog.sidebar')
	</div>
	
	</div>
	

	</div>	  
	
<script>
$(document).ready(function(){

	$('.do-quick-search').click(function(){
		$('#SximoTable').attr('action','{{ URL::to("blog/multisearch")}}');
		$('#SximoTable').submit();
	});
	
});	
</script>		