	<div class="block-widget">	
		<h3 >Categories</h3>	
	
			<ul class="list-unstyled categories"> 
			@foreach($blogcategories as $cat)
				<li> <a class="dk" href="{{ URL::to('blog/category/'.$cat->alias)}}"> <i class="fa fa-caret-right"></i> {{ $cat->name}} &nbsp; ({{ $cat->total}}) </a> </li> 
			@endforeach	
			</ul>
	</div>


	<div class="block-widget">	
		<h3 class="font-semibold">Recent Posts</h3>
		<div class="line line-dashed"></div>
		<ul class="recent-post">
			@foreach($recent as $r)
			<li><a href="{{ URL::to('blog/read/'.$r->slug)}}">{{ $r->title }} <br />
				<span>On {{ date("F j, Y " , strtotime($r->created)) }} </span>  </a>
			</li>
			@endforeach			
		</ul>
		
		
	</div>
	
