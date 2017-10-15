class CoreHelpers
{
static public function status( $status )
{
switch($status) :
default:
$val = '< span class="label label-default"> Open ';
break;
case '1':
$val = '< span class="label label-warning"> Inprogress < /span>';
break;
case '0':
$val = '< span class="label label-primary"> Closed < /span>';
break;
endswitch;
return $val;
}
}	