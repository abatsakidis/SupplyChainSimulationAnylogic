<ul class="nav nav-tabs" style="margin-bottom:10px;">
  <li @if($active == 'config') class="active" @endif ><a href="{{ URL::to($module.'/config/'.$module_name)}}">Info</a></li>
  <li @if($active == 'sql') class="active" @endif >
  <a href="{{ URL::to($module.'/sql/'.$module_name)}}">SQL</a></li>
  <li @if($active == 'table') class="active" @endif >
  <a href="{{ URL::to($module.'/table/'.$module_name)}}">Table</a></li>
  <li @if($active == 'form') class="active" @endif >
  <a href="{{ URL::to($module.'/form/'.$module_name)}}">Form</a></li>
  <li @if($active == 'sub') class="active" @endif >
  <a href="{{ URL::to($module.'/sub/'.$module_name)}}">Master Detail</a></li>  
  <li @if($active == 'permission') class="active" @endif >
  <a href="{{ URL::to($module.'/permission/'.$module_name)}}">Permission</a></li>
   <li @if($active == 'rebuild') class="active" @endif >
   <a href="javascript://ajax" onclick="SximoModal('{{ URL::to($module.'/build/'.$module_name)}}','Rebuild Module {{$module_name}}')">Rebuild</a></li>
</ul>