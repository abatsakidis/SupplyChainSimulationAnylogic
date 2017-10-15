<div class="col-md-4">
	<div class="sbox">
	<div class="sbox-title"><h5> Developer Guide  </h5></div>
	<div class="sbox-content">

	<ul class="docs" >
		<li><a  @if($active =='index') class="active" @endif href="{{ URL::to('config/developer') }}"><i class="icon-arrow-right3"></i> Introduction </a></li>
		
		<li><a @if($active =='module') class="active" @endif
		href="{{ URL::to('config/manual/devcontroller') }}"><i class="icon-arrow-right3"></i> Module Structure   </a>
		<ul>
				
		<li><a href="{{ URL::to('config/developer/devcontroller') }}"><i class="icon-arrow-right3"></i> Controller </a></li>			
		 <li><a href="{{ URL::to('config/developer/devmodel') }}"><i class="icon-arrow-right3"></i> Models </a></li>
		 <li><a href="{{ URL::to('config/developer/devgrid') }}"><i class="icon-arrow-right3"></i> Views/index.blade.php </a></li>
		 <li><a href="{{ URL::to('config/developer/devform') }}"><i class="icon-arrow-right3"></i> Views/form.blade.php </a></li>
		 <li><a href="{{ URL::to('config/developer/devview') }}"><i class="icon-arrow-right3"></i> Views/view.blade.php </a></li>
		 
		 </ul>
		</li>	
		<li><a @if($active =='staticpage') class="active" @endif
		href="{{ URL::to('config/manual/devlayout') }}"><i class="icon-arrow-right3"></i>  Layout Template  </a></li>
		<li><a @if($active =='staticpage') class="active" @endif
		href="{{ URL::to('config/manual/devclasssession') }}"><i class="icon-arrow-right3"></i>  Class & Session  </a></li>
	</ul>
	<h3> Manual Guide  </h3>
	<a href="{{ URL::to('config/manual') }}" class="btn btn-info" style="width:100%;"> Manual Guide </a>
	
	</div>
	</div>
</div>
