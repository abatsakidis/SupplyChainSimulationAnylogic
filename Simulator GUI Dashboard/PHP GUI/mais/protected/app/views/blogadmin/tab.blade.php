<?php $active = Request::segment(1);;?>
<ul class="nav nav-tabs" style="margin-bottom:10px;">
  <li <?php if($active =='blogadmin') echo  'class="active"';?>><a href="{{ URL::to('blogadmin')}}"> Posts </a></li>
  <li <?php if($active =='blogcategories') echo  'class="active"';?>><a href="{{ URL::to('blogcategories')}}"> Categories </a></li>
  <li <?php if($active =='blogcomment') echo  'class="active"';?>><a href="{{ URL::to('blogcomment')}}">Comments</a></li>
</ul>	