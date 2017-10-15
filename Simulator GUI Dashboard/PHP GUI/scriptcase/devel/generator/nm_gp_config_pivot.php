<?php

session_start();

$s_inc = '../_lib/css/' . $_SESSION['scriptcase']['css_popup'];
include_once str_replace('.css', '.php', $s_inc);

$nome_apl  = (isset($_GET['nome_apl']))  ? $_GET['nome_apl']  : "";
$sc_page   = (isset($_GET['sc_page']))   ? $_GET['sc_page']   : "";
$language  = (isset($_GET['language']))  ? $_GET['language']  : "port";

if (!function_exists("NM_is_utf8"))
{
    include_once($SC_apl_proc . "_nmutf8.php");
}

$tradutor = array();
if (isset($_SESSION['scriptcase']['sc_idioma_pivot']))
{
    $tradutor = $_SESSION['scriptcase']['sc_idioma_pivot'];
}
if (!isset($tradutor[$language]))
{
    foreach ($tradutor as $language => $resto)
    {
        break;
    }
}
if (!isset($_SESSION['sc_session'][$sc_page][$nome_apl]))
{
   $sc_page  = $_SESSION['scriptcase']['sc_page_process'];
   $nome_apl = $SC_apl_proc;
}

if (isset($_GET['b_ok']) && 'Y' == $_GET['b_ok'])
{
    $a_x_axys = array();
    $a_y_axys = array();
    foreach ($_SESSION['sc_session'][$sc_page][$nome_apl]['pivot_group_by'] as $i_group => $l_group)
    {
        $_SESSION['sc_session'][$sc_page][$nome_apl]['pivot_order'][$i_group] = $_GET['order_' . $i_group];
        if ('x' == $_GET['axys_' . $i_group])
        {
            $a_x_axys[] = $i_group;
        }
        else
        {
            $a_y_axys[] = $i_group;
        }
    }
    $_SESSION['sc_session'][$sc_page][$nome_apl]['pivot_x_axys']  = $a_x_axys;
    $_SESSION['sc_session'][$sc_page][$nome_apl]['pivot_y_axys']  = $a_y_axys;
    $_SESSION['sc_session'][$sc_page][$nome_apl]['pivot_tabular'] = isset($_GET['tabular']) && 'Y' == $_GET['tabular'];

?>
<html>
<body>
<script language="javascript">
self.parent.document.refresh_config.submit();
self.parent.tb_remove();
</script>
</body>
</html>
<?php
    exit;
}

?>
<html<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=<?php  echo $_SESSION['scriptcase']['charset_html'];       ?>" />
<?php
/*
$tmp_useragent = $_SERVER['HTTP_USER_AGENT'];
if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$tmp_useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($tmp_useragent,0,4)))
*/
if ($_SESSION['scriptcase']['proc_mobile'])
{
?>
 <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
<?php
}
?>
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php     echo $_SESSION['scriptcase']['css_popup'];     ?>" />
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php     echo $_SESSION['scriptcase']['css_popup_dir'];     ?>" />
 <link rel="stylesheet" type="text/css" href="../_lib/buttons/<?php echo $_SESSION['scriptcase']['css_btn_popup']; ?>" />
 <script language="javascript" type="text/javascript" src="<?php    echo $_SESSION['sc_session']['path_third'];    ?>/jquery/js/jquery.js"></script>
 <script language="javascript" type="text/javascript">
    var maxGroup = <?php  echo sizeof($_SESSION['sc_session'][$sc_page][$nome_apl]['pivot_group_by']); ?>,
        icoLine  = "../_lib/img/<?php echo $sum_ico_line;   ?>",
        icoCol   = "../_lib/img/<?php echo $sum_ico_column; ?>",
        txtLine  = "<?php echo $tradutor[$language]['smry_ppup_posi_labl']; ?>",
        txtCol   = "<?php echo $tradutor[$language]['smry_ppup_posi_data']; ?>";
    $(function(){
        $(".sc-ui-axys").mouseover(function() { $(this).css("cursor", "pointer"); })
                        .mouseout(function() { $(this).css("cursor", ""); })
                        .click(function(){
            var oDis = $(this),
                sId  = oDis.attr("id").substr(3),
                oVal = $("#id_" + sId),
                iIdx = parseInt(sId.substr(5));
            if ("y" == oVal.val()) {
                for (var i = 0; i <= iIdx; i++) {
                    $("#ui_axys_" + i).attr("src", icoLine);
                    $("#ui_axys_" + i).attr("title", txtLine);
                    $("#id_axys_" + i).val("x");
                }
            }
            else {
                for (var i = iIdx; i < maxGroup; i++) {
                    $("#ui_axys_" + i).attr("src", icoCol);
                    $("#ui_axys_" + i).attr("title", txtCol);
                    $("#id_axys_" + i).val("y");
                }
            }
        });
        x_dim();
    });
    function processa() {
        document.config_pivot.b_ok.value = 'Y';
        document.config_pivot.submit();
    }
    function x_dim() {
        var mt = $("#main_table"),
            W  = mt.width(),
            H  = mt.height();
        if (0 == W || 0 == H) {
            setTimeout("x_dim()", 50);
        }
        else {
            self.parent.tb_resize(H + 40, W + 40);
        }
    }
 </script>
</head>

<body class="scGridPage" style="margin: 0px; overflow-x: hidden">

<form name="config_pivot" method="get">
<?php
if ($_SESSION['scriptcase']['reg_conf']['html_dir'] == " DIR='RTL'")
{
    echo "<table class=\"scGridBorder\" id=\"main_table\" style=\"position: relative; top: 20px; right: 20px\">";
}
else
{
    echo "<table class=\"scGridBorder\" id=\"main_table\" style=\"position: relative; top: 20px; left: 20px\">";
}
?>
<tr><td class="scGridTabelaTd">

<table class="scGridTabela" style="width: 100%">
 <tr>
  <td class="scGridLabelVert"><?php echo $tradutor[$language]['smry_ppup_titl']; ?></td>
 </tr>
 <tr>
  <td class="scGridFieldOdd scGridFieldOddFont">
   <table style="border-collapse: collapse; border-width: 0; width: 100%">
    <tr>
     <td class="scGridFieldOddFont" style="padding: 1px 4px"><b><?php echo $tradutor[$language]['smry_ppup_fild']; ?></b></td>
     <td class="scGridFieldOddFont" style="padding: 1px 4px"><b><?php echo $tradutor[$language]['smry_ppup_posi']; ?></b></td>
     <td class="scGridFieldOddFont" style="padding: 1px 4px"><b><?php echo $tradutor[$language]['smry_ppup_sort']; ?></b></td>
    </tr>
<?php

foreach ($_SESSION['sc_session'][$sc_page][$nome_apl]['pivot_group_by'] as $i_group => $l_group)
{
    if ('label' == $_SESSION['sc_session'][$sc_page][$nome_apl]['pivot_order'][$i_group])
    {
        $order_sel_label = ' selected';
        $order_sel_value = '';
    }
    else
    {
        $order_sel_label = '';
        $order_sel_value = ' selected';
    }
        if ('UTF-8' != $_SESSION['scriptcase']['charset'] && NM_is_utf8($l_group))
        {
            $l_group = mb_convert_encoding($l_group, $_SESSION['scriptcase']['charset'], 'UTF-8');
        }
?>
    <tr>
     <td class="scGridFieldOddFont" style="padding: 1px 4px"><?php echo $l_group; ?></td>
<?php
    if (sizeof($_SESSION['sc_session'][$sc_page][$nome_apl]['pivot_group_by']) - 1 == $i_group)
    {
?>
     <td class="scGridFieldOddFont" style="padding: 1px 4px">
      &nbsp;
      <input type="hidden" name="axys_<?php echo $i_group; ?>" value="y">
     </td>
<?php
    }
    else
    {
?>
     <td class="scGridFieldOddFont" style="padding: 1px 4px; text-align: center">
<?php
        if (in_array($i_group, $_SESSION['sc_session'][$sc_page][$nome_apl]['pivot_x_axys']))
        {
            $s_axys_lab  = '../_lib/img/' . $sum_ico_line;
            $s_axys_val  = 'x';
            $s_axys_hint = $tradutor[$language]['smry_ppup_posi_labl'];
        }
        else
        {
            $s_axys_lab  = '../_lib/img/' . $sum_ico_column;
            $s_axys_val  = 'y';
            $s_axys_hint = $tradutor[$language]['smry_ppup_posi_data'];
        }
?>
      <img class="sc-ui-axys" id="ui_axys_<?php echo $i_group; ?>" src="<?php echo $s_axys_lab; ?>" title="<?php echo $s_axys_hint; ?>" />
      <input type="hidden" id="id_axys_<?php echo $i_group; ?>" name="axys_<?php echo $i_group; ?>" value="<?php echo NM_encode_input($s_axys_val); ?>">
     </td>
<?php
    }
?>
     <td class="scGridFieldOddFont" style="padding: 1px 4px">
      <select class="scGridObjectOdd" name="order_<?php echo $i_group; ?>">
       <option value="label"<?php echo $order_sel_label; ?>><?php echo $tradutor[$language]['smry_ppup_sort_labl']; ?></option>
       <option value="value"<?php echo $order_sel_value; ?>><?php echo $tradutor[$language]['smry_ppup_sort_vlue']; ?></option>
      </select>
     </td>
    </tr>
<?php
}

?>
   </table>
<?php
if (isset($_SESSION['sc_session'][$sc_page][$nome_apl]['pivot_group_by']) && 1 < sizeof($_SESSION['sc_session'][$sc_page][$nome_apl]['pivot_group_by']))
{
?>
   <input id="id_chk_tab" type="checkbox" name="tabular" value="Y"<?php if ($_SESSION['sc_session'][$sc_page][$nome_apl]['pivot_tabular']) { echo ' checked'; } ?> /> <label for="id_chk_tab"><?php echo $tradutor[$language]['smry_ppup_chek_tabu']; ?></label>
<?php
}
else
{
?>
   <input type="hidden" name="tabular" value="<?php if ($_SESSION['sc_session'][$sc_page][$nome_apl]['pivot_tabular']) { echo 'Y'; } else { echo 'N'; } ?>" />
<?php
}
?>
  </td>
 </tr>
 <tr>
  <td class="scGridToolbar" style="text-align: center">
   <?php echo $_SESSION['scriptcase']['bg_btn_popup']['bok'];       ?>
   &nbsp; &nbsp; &nbsp;
   <?php echo $_SESSION['scriptcase']['bg_btn_popup']['btbremove']; ?>
  </td>
 </tr>
</table>

</td></tr></table>
<input type="hidden" name="nome_apl" value="<?php echo NM_encode_input($nome_apl); ?>">
<input type="hidden" name="sc_page" value="<?php  echo NM_encode_input($sc_page); ?>" >
<input type="hidden" name="language" value="<?php echo NM_encode_input($language); ?>" >
<input type="hidden" name="b_ok" value="" >
</form>

</body>

</html>