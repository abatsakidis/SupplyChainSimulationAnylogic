{{ HTML::style('sximo/js/plugins/markitup/skins/simple/style.css')}}
{{ HTML::style('sximo/js/plugins/markitup/sets/bbcode/style.css')}}
{{ HTML::style('protected/app/views/blog/blog.css')}}
{{ HTML::script('sximo/js/plugins/markitup/sets/bbcode/set.js')}}
{{ HTML::script('sximo/js/plugins/markitup/jquery.markitup.js')}}

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
					<li><a href="{{ URL::to('blog') }}">Blog</a></li>
					<li><a href="{{ URL::to('blog/category/'.$row->alias) }}">{{ $row->alias }}</a></li>
					<li class="active"> {{ $row->title }}	 </li>
				  </ul>		
				</div>
			</div>		  
		</div>
	</div>



<div class="page-content container">


  
	@if(Session::has('message'))	  
		   {{ Session::get('message') }}
	@endif	
	<div class="row">
	<div class="col-md-9">
		<div class="blog-post ">
			<div class="post-item">
				<div class="title"><h3> {{ $row->title }} </h3></div>
				<div class="blog-info-small">
				<i class="fa fa-user icon-muted"></i>  <span>  {{ $row->username }} </span>   
				<i class="fa fa-calendar icon-muted"></i>  <span> {{ date("M j, Y " , strtotime($row->created)) }} </span> 
				<i class="fa fa-comment-o icon-muted"></i>   <span>  {{ $row->comments }} comment(s)  </span> 
							
				
				</div>				
				<div class="summary">{{ SiteHelpers::renderHtml( str_replace('<hr />',"",$row->content)) }}</div>
				

			</div>	
		</div>
		<hr />

		<h3 id="comments"> ( {{ $row->comments }} )  Comment(s) </h3>
		<hr />
		<div class="comment-list">
		@foreach($comments as $com)

				<div class="comm" >
			
					<div class="info">{{ date("F j, Y " , strtotime($com['created'])) }} | {{ $com['name'] }} says :  </div>
					<div class="body"><blockquote>{{ SiteHelpers::BBCode2Html($com['comment']) }}</blockquote></div>
					@if(Session::get('gid') == 1)
						<div class="action"><a href="{{ URL::to('blog/removecomm/'.$com['commentID'].'/'.$row->slug) }}" class="btn btn-danger btn-xs"> Remove </a></div>
					@endif	
				</div>

			
		@endforeach	
		
		
		</div>
		@if(Auth::check()):
		 {{ Form::open(array('url'=>'blog/savecomment/',  'parsley-validate'=>'','novalidate'=>' ')) }}
			<div class="form-group pull-in clearfix hidden" > 
				<div class="col-sm-6"> <label>Your name</label> <input type="text" placeholder="Name" class="form-control"> </div> 
				<div class="col-sm-6"> <label>Email</label> <input type="email" placeholder="Enter email" class="form-control"> </div> 
			</div> 
			<div class="form-group "> 
				<div class="col-sm-12">
					<label>Post Your Comment</label>
					<textarea placeholder="Type your comment" rows="5" id="comment_area" name="comment" class="form-control markItUp"></textarea> 
				</div>	
			</div>
			<br /><br /> 
			<div class="form-group "> 
				<div class="col-sm-12">
					<label>&nbsp;</label>
					<button class="btn btn-success" type="submit">Submit comment</button> 
				</div>	
			</div> 
			<input type="hidden" name="blogID" value="{{ $id }}" />
			<input type="hidden" name="alias" value="{{ $alias }}" />
		{{ Form::close() }}	
		@else 
		<div class="alert alert-danger"> Please login to post comment </div>
		@endif	
	
	</div>
		
	
	<div class="col-md-3">
		@include('blog.sidebar')
	</div>
	
	</div>
	
</div>

<script type="text/javascript" >
   $(document).ready(function() {
     // $(".markItUp").markItUp(mySettings );
   });
</script>
