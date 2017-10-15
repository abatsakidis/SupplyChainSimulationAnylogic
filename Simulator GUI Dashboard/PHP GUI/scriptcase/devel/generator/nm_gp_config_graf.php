<?php
    session_start();

    $nome_apl  = (isset($_GET['nome_apl']))  ? $_GET['nome_apl']  : "";
    $campo_apl = (isset($_GET['campo_apl'])) ? $_GET['campo_apl'] : "nm_resumo_graf";
    $sc_page   = (isset($_GET['sc_page']))   ? $_GET['sc_page']   : "";
    $language  = (isset($_GET['language']))  ? $_GET['language']  : "port";
    $sint_anal = false;

    if (!function_exists("NM_is_utf8"))
    {
        include_once($SC_apl_proc . "_nmutf8.php");
    }
    if (!isset($_SESSION['sc_session'][$sc_page][$nome_apl]))
    {
       $sc_page  = $_SESSION['scriptcase']['sc_page_process'];
       $nome_apl = $SC_apl_proc;
    }

    if (isset($_POST['bok_graf']) && $_POST['bok_graf'] == "OK" && $_POST['campo_apl'] == "nm_resumo_graf")
    {
       if (isset($_POST['tipo']))
       {
           $_SESSION['sc_session'] [$_POST['sc_page']] [$_POST['nome_apl']] ['graf_tipo']   = $_POST['tipo'];
       }
       if (isset($_POST['largura']))
       {
           $_SESSION['sc_session'] [$_POST['sc_page']] [$_POST['nome_apl']] ['graf_larg']   = $_POST['largura'];
       }
       if (isset($_POST['altura']))
       {
           $_SESSION['sc_session'] [$_POST['sc_page']] [$_POST['nome_apl']] ['graf_alt']    = $_POST['altura'];
       }
       if (isset($_POST['margem']))
       {
           $_SESSION['sc_session'] [$_POST['sc_page']] [$_POST['nome_apl']] ['graf_margem'] = $_POST['margem'];
       }
       if (isset($_POST['aspecto']))
       {
           $_SESSION['sc_session'] [$_POST['sc_page']] [$_POST['nome_apl']] ['graf_aspec']  = $_POST['aspecto'];
       }
       if (isset($_POST['cor_fundo']))
       {
           $_SESSION['sc_session'] [$_POST['sc_page']] [$_POST['nome_apl']] ['graf_cor_fundo']  = $_POST['cor_fundo'];
       }
       if (isset($_POST['preencher']))
       {
           $_SESSION['sc_session'] [$_POST['sc_page']] [$_POST['nome_apl']] ['graf_preencher']  = $_POST['preencher'];
       }
       if (isset($_POST['exibe_val']))
       {
           $_SESSION['sc_session'] [$_POST['sc_page']] [$_POST['nome_apl']] ['graf_exibe_val']  = $_POST['exibe_val'];
       }
       if (isset($_POST['exibe_marcas']))
       {
           $_SESSION['sc_session'] [$_POST['sc_page']] [$_POST['nome_apl']] ['graf_exibe_marcas']  = $_POST['exibe_marcas'];
       }
       if (isset($_POST['cor_margens']))
       {
           $_SESSION['sc_session'] [$_POST['sc_page']] [$_POST['nome_apl']] ['graf_cor_margens']  = $_POST['cor_margens'];
       }
       if (isset($_POST['cor_label']))
       {
           $_SESSION['sc_session'] [$_POST['sc_page']] [$_POST['nome_apl']] ['graf_cor_label']  = $_POST['cor_label'];
       }
       if (isset($_POST['cor_valores']))
       {
           $_SESSION['sc_session'] [$_POST['sc_page']] [$_POST['nome_apl']] ['graf_cor_valores']  = $_POST['cor_valores'];
       }
       if (isset($_POST['tipo_marcas']))
       {
           $_SESSION['sc_session'] [$_POST['sc_page']] [$_POST['nome_apl']] ['graf_tipo_marcas']  = $_POST['tipo_marcas'];
       }
       if (isset($_POST['opc_atual']))
       {
           $_SESSION['sc_session'] [$_POST['sc_page']] [$_POST['nome_apl']] ['graf_opc_atual']  = $_POST['opc_atual'];
       }
       if (isset($_POST['order']))
       {
           $_SESSION['sc_session'] [$_POST['sc_page']] [$_POST['nome_apl']] ['graf_order']  = $_POST['order'];
       }
       if (isset($_POST['angulo']))
       {
           $_SESSION['sc_session'] [$_POST['sc_page']] [$_POST['nome_apl']] ['graf_angulo']  = $_POST['angulo'];
       }
    }
    elseif (isset($_POST['bok_graf']) && $_POST['bok_graf'] == "OK")
    {
       if (isset($_POST['tipo']))
       {
           $_SESSION['sc_session'] [$_POST['sc_page']] [$_POST['nome_apl']] [$_POST['campo_apl']] ['graf_tipo']   = $_POST['tipo'];
       }
       if (isset($_POST['largura']))
       {
           $_SESSION['sc_session'] [$_POST['sc_page']] [$_POST['nome_apl']] [$_POST['campo_apl']] ['graf_larg']   = $_POST['largura'];
       }
       if (isset($_POST['altura']))
       {
           $_SESSION['sc_session'] [$_POST['sc_page']] [$_POST['nome_apl']] [$_POST['campo_apl']] ['graf_alt']    = $_POST['altura'];
       }
       if (isset($_POST['margem']))
       {
           $_SESSION['sc_session'] [$_POST['sc_page']] [$_POST['nome_apl']] [$_POST['campo_apl']] ['graf_margem'] = $_POST['margem'];
       }
       if (isset($_POST['aspecto']))
       {
           $_SESSION['sc_session'] [$_POST['sc_page']] [$_POST['nome_apl']] [$_POST['campo_apl']] ['graf_aspec']  = $_POST['aspecto'];
       }
       if (isset($_POST['cor_fundo']))
       {
           $_SESSION['sc_session'] [$_POST['sc_page']] [$_POST['nome_apl']] [$_POST['campo_apl']] ['graf_cor_fundo']  = $_POST['cor_fundo'];
       }
       if (isset($_POST['preencher']))
       {
           $_SESSION['sc_session'] [$_POST['sc_page']] [$_POST['nome_apl']] [$_POST['campo_apl']] ['graf_preencher']  = $_POST['preencher'];
       }
       if (isset($_POST['exibe_val']))
       {
           $_SESSION['sc_session'] [$_POST['sc_page']] [$_POST['nome_apl']] [$_POST['campo_apl']] ['graf_exibe_val']  = $_POST['exibe_val'];
       }
       if (isset($_POST['exibe_marcas']))
       {
           $_SESSION['sc_session'] [$_POST['sc_page']] [$_POST['nome_apl']] [$_POST['campo_apl']] ['graf_exibe_marcas']  = $_POST['exibe_marcas'];
       }
       if (isset($_POST['cor_margens']))
       {
           $_SESSION['sc_session'] [$_POST['sc_page']] [$_POST['nome_apl']] [$_POST['campo_apl']] ['graf_cor_margens']  = $_POST['cor_margens'];
       }
       if (isset($_POST['cor_label']))
       {
           $_SESSION['sc_session'] [$_POST['sc_page']] [$_POST['nome_apl']] [$_POST['campo_apl']] ['graf_cor_label']  = $_POST['cor_label'];
       }
       if (isset($_POST['cor_valores']))
       {
           $_SESSION['sc_session'] [$_POST['sc_page']] [$_POST['nome_apl']] [$_POST['campo_apl']] ['graf_cor_valores']  = $_POST['cor_valores'];
       }
       if (isset($_POST['tipo_marcas']))
       {
           $_SESSION['sc_session'] [$_POST['sc_page']] [$_POST['nome_apl']] [$_POST['campo_apl']] ['graf_tipo_marcas']  = $_POST['tipo_marcas'];
       }
       if (isset($_POST['angulo']))
       {
           $_SESSION['sc_session'] [$_POST['sc_page']] [$_POST['nome_apl']] [$_POST['campo_apl']] ['graf_angulo']  = $_POST['angulo'];
       }
    }
    if (isset($_POST['bok_graf']) && $_POST['bok_graf'] == "OK")
    {
?>
       <html>
       <body>
       <script type="text/javascript">
          self.parent.tb_remove();
       </script>
       </body>
       </html>
<?php
       exit;
    }
    elseif ($campo_apl == "nm_resumo_graf")
    {
           $tipo         = $_SESSION['sc_session'][$sc_page][$nome_apl]['graf_tipo'];
           $largura      = $_SESSION['sc_session'][$sc_page][$nome_apl]['graf_larg'];
           $altura       = $_SESSION['sc_session'][$sc_page][$nome_apl]['graf_alt'];
           $margem       = $_SESSION['sc_session'][$sc_page][$nome_apl]['graf_margem'];
           $aspecto      = $_SESSION['sc_session'][$sc_page][$nome_apl]['graf_aspec'];
           $cor_fundo    = $_SESSION['sc_session'][$sc_page][$nome_apl]['graf_cor_fundo'];
           $preencher    = $_SESSION['sc_session'][$sc_page][$nome_apl]['graf_preencher'];
           $exibe_val    = $_SESSION['sc_session'][$sc_page][$nome_apl]['graf_exibe_val'];
           $exibe_marcas = $_SESSION['sc_session'][$sc_page][$nome_apl]['graf_exibe_marcas'];
           $cor_margens  = $_SESSION['sc_session'][$sc_page][$nome_apl]['graf_cor_margens'];
           $cor_label    = $_SESSION['sc_session'][$sc_page][$nome_apl]['graf_cor_label'];
           $cor_valores  = $_SESSION['sc_session'][$sc_page][$nome_apl]['graf_cor_valores'];
           $tipo_marcas  = $_SESSION['sc_session'][$sc_page][$nome_apl]['graf_tipo_marcas'];
           $opc_atual    = $_SESSION['sc_session'][$sc_page][$nome_apl]['graf_opc_atual'] ;
           $order        = $_SESSION['sc_session'][$sc_page][$nome_apl]['graf_order'] ;
           $angulo       = $_SESSION['sc_session'][$sc_page][$nome_apl]['graf_angulo'] ;
           if (isset($_SESSION['sc_session'][$sc_page][$nome_apl]['graf_permitidos']))
           {
               $arr_graf_perm = explode(",", $_SESSION['sc_session'][$sc_page][$nome_apl]['graf_permitidos']);
           }
           else
           {
               $arr_graf_perm = array(1,4,2,5,3,8,6,7,20,21,26,27,28,29);
           }
           if ($_SESSION['sc_session'][$sc_page][$nome_apl]['graf_opc_graf'] == 3)
           {
               $sint_anal = true;
           }
    }
    elseif (isset($_SESSION['sc_session'][$sc_page][$nome_apl][$campo_apl]))
    {
           $tipo         = $_SESSION['sc_session'][$sc_page][$nome_apl][$campo_apl]['graf_tipo'];
           $largura      = $_SESSION['sc_session'][$sc_page][$nome_apl][$campo_apl]['graf_larg'];
           $altura       = $_SESSION['sc_session'][$sc_page][$nome_apl][$campo_apl]['graf_alt'];
           $margem       = $_SESSION['sc_session'][$sc_page][$nome_apl][$campo_apl]['graf_margem'];
           $aspecto      = $_SESSION['sc_session'][$sc_page][$nome_apl][$campo_apl]['graf_aspec'];
           $cor_fundo    = $_SESSION['sc_session'][$sc_page][$nome_apl][$campo_apl]['graf_cor_fundo'];
           $preencher    = $_SESSION['sc_session'][$sc_page][$nome_apl][$campo_apl]['graf_preencher'];
           $exibe_val    = $_SESSION['sc_session'][$sc_page][$nome_apl][$campo_apl]['graf_exibe_val'];
           $exibe_marcas = $_SESSION['sc_session'][$sc_page][$nome_apl][$campo_apl]['graf_exibe_marcas'];
           $cor_margens  = $_SESSION['sc_session'][$sc_page][$nome_apl][$campo_apl]['graf_cor_margens'];
           $cor_label    = $_SESSION['sc_session'][$sc_page][$nome_apl][$campo_apl]['graf_cor_label'];
           $cor_valores  = $_SESSION['sc_session'][$sc_page][$nome_apl][$campo_apl]['graf_cor_valores'];
           $tipo_marcas  = $_SESSION['sc_session'][$sc_page][$nome_apl][$campo_apl]['graf_tipo_marcas'];
           $angulo       = $_SESSION['sc_session'][$sc_page][$nome_apl][$campo_apl]['graf_angulo'];
           $opc_atual    = 2;
           $order        = '';
           if (isset($_SESSION['sc_session'][$sc_page][$nome_apl][$campo_apl]['graf_permitidos']))
           {
               $arr_graf_perm = explode(",", $_SESSION['sc_session'][$sc_page][$nome_apl][$campo_apl]['graf_permitidos']);
           }
           else
           {
               $arr_graf_perm = array(1,4,2,5,3,8,6,7,20,21,26,27,28,29);
           }
    }
    if (empty($largura))
    {
        $largura = 512;
    }
    if (empty($altura))
    {
        $altura = 384;
    }
    if (empty($margem))
    {
        $margem = 10;
    }

    $tradutor = array();
    if (isset($_SESSION['scriptcase']['sc_idioma_graf']))
    {
        $tradutor = $_SESSION['scriptcase']['sc_idioma_graf'];
    }
    if (!isset($tradutor[$language]))
    {
        foreach ($tradutor as $language => $resto)
        {
            break;
        }
    }

    $arr_selected[1]  = ($tipo == 1) ? " selected" : "";
    $arr_selected[2]  = ($tipo == 2) ? " selected" : "";
    $arr_selected[3]  = ($tipo == 3) ? " selected" : "";
    $arr_selected[4]  = ($tipo == 4) ? " selected" : "";
    $arr_selected[5]  = ($tipo == 5) ? " selected" : "";
    $arr_selected[6]  = ($tipo == 6) ? " selected" : "";
    $arr_selected[7]  = ($tipo == 7) ? " selected" : "";
    $arr_selected[8]  = ($tipo == 8) ? " selected" : "";
    $arr_selected[20] = ($tipo == 20) ? " selected" : "";
    $arr_selected[21] = ($tipo == 21) ? " selected" : "";
    $arr_selected[26] = ($tipo == 26) ? " selected" : "";
    $arr_selected[27] = ($tipo == 27) ? " selected" : "";
    $arr_selected[28] = ($tipo == 28) ? " selected" : "";
    $arr_selected[29] = ($tipo == 29) ? " selected" : "";
    $arr_tp_graf[1]  = "       <option value=\"1\"" . $arr_selected[1] . ">" . $tradutor[$language]['tp_barra'] . "</option>";
    $arr_tp_graf[2]  = "       <option value=\"2\"" . $arr_selected[2] . ">" . $tradutor[$language]['tp_linha'] . "</option>";
    $arr_tp_graf[3]  = "       <option value=\"3\"" . $arr_selected[3] . ">" . $tradutor[$language]['tp_pizza_abs'] . "</option>";
    $arr_tp_graf[4]  = "       <option value=\"4\"" . $arr_selected[4] . ">" . $tradutor[$language]['tp_bar_horiz'] . "</option>";
    $arr_tp_graf[5]  = "       <option value=\"5\"" . $arr_selected[5] . ">" . $tradutor[$language]['tp_lin_horiz'] . "</option>";
    $arr_tp_graf[6]  = "       <option value=\"6\"" . $arr_selected[6] . ">" . $tradutor[$language]['tp_renda'] . "</option>";
    $arr_tp_graf[7]  = "       <option value=\"7\"" . $arr_selected[7] . ">" . $tradutor[$language]['tp_renda_horiz'] . "</option>";
    $arr_tp_graf[8]  = "       <option value=\"8\"" . $arr_selected[8] . ">" . $tradutor[$language]['tp_pizza_per'] . "</option>";
    $arr_tp_graf[20] = "       <option value=\"20\"" . $arr_selected[20] . ">" . $tradutor[$language]['tp_pizza3d_abs'] . "</option>";
    $arr_tp_graf[21] = "       <option value=\"21\"" . $arr_selected[21] . ">" . $tradutor[$language]['tp_pizza3d_per'] . "</option>";
    $arr_tp_graf[26] = "       <option value=\"26\"" . $arr_selected[26] . ">" . $tradutor[$language]['tp_impulse'] . "</option>";
    $arr_tp_graf[27] = "       <option value=\"27\"" . $arr_selected[27] . ">" . $tradutor[$language]['tp_impulse_horiz'] . "</option>";
    $arr_tp_graf[28] = "       <option value=\"28\"" . $arr_selected[28] . ">" . $tradutor[$language]['tp_scatter'] . "</option>";
    $arr_tp_graf[29] = "       <option value=\"29\"" . $arr_selected[29] . ">" . $tradutor[$language]['tp_scatter_horiz'] . "</option>";
?>
<html<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<head>
 <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html']; ?>" />
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
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $_SESSION['scriptcase']['css_popup'] ?>" />
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $_SESSION['scriptcase']['css_popup_dir'] ?>" />
 <link rel="stylesheet" type="text/css" href="../_lib/buttons/<?php echo $_SESSION['scriptcase']['css_btn_popup'] ?>" />
</head>
<body class="scGridPage" style="margin: 0px; overflow-x: hidden">

<script language="javascript" type="text/javascript" src="<?php echo $_SESSION['sc_session']['path_third'] ?>/jquery/js/jquery.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo $_SESSION['sc_session']['path_third'] ?>/tigra_color_picker/picker.js"></script>

<form name="config_graf" method="post">
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
<tr>
 <td class="scGridTabelaTd">
  <table class="scGridTabela">
   <tr class="scGridLabelVert">
    <td align="middle" nowrap>
      <b><?php echo $tradutor[$language]['titulo']; ?></b>
    </td>
   </tr>

 <tr><td>
 <table style="border-collapse: collapse; border-width: 0px">


 <tr class="scGridFieldOddVert">
   <td>
     <?php echo $tradutor[$language]['tipo_g']; ?>
   </td>
   <td>
     <select  name="tipo"  size=1 onchange=omite_lin()>
<?php
   foreach ($arr_graf_perm as $cada_sel_tp)
   {
       if (isset($arr_tp_graf[$cada_sel_tp]))
       {
          echo $arr_tp_graf[$cada_sel_tp];
       }
   }
?>
     </select>
   </td>
 </tr>

 <tr id='lin_opc_atual'  class="scGridFieldOddVert">
   <td>
     <?php echo $tradutor[$language]['modo_gera']; ?>
   </td>
   <td>
     <select  name="opc_atual"  size=1>
       <option value="1" <?php if ($opc_atual == "1")  { echo " selected" ;} ?>><?php echo $tradutor[$language]['sintetico']; ?></option>
       <option value="2" <?php if ($opc_atual == "2")  { echo " selected" ;} ?>><?php echo $tradutor[$language]['analitico']; ?></option>
     </select>
   </td>
</tr>

 <tr id='lin_order'  class="scGridFieldOddVert">
   <td>
     <?php echo $tradutor[$language]['order']; ?>
   </td>
   <td>
     <select  name="order"  size=1>
       <option value="" <?php     if ($order == "")      { echo " selected" ;} ?>><?php echo $tradutor[$language]['order_none']; ?></option>
       <option value="asc" <?php  if ($order == "asc")   { echo " selected" ;} ?>><?php echo $tradutor[$language]['order_asc']; ?></option>
       <option value="desc" <?php if ($order == "desc")  { echo " selected" ;} ?>><?php echo $tradutor[$language]['order_desc']; ?></option>
     </select>
   </td>
</tr>

 <tr class="scGridFieldOddVert">
   <td>
     <?php echo $tradutor[$language]['cor_fundo']; ?>
   </td>
   <td>
     <input type="text" name="cor_fundo" value="<?php echo NM_encode_input($cor_fundo); ?>" size=8 maxlength=7>
     <a href="javascript: TCP.popup(document.forms['config_graf'].elements['cor_fundo'], '', '<?php echo $_SESSION['sc_session']['path_third'] ?>/tigra_color_picker/picker.php', 'nm_volta_cor')">
      <img src="<?php echo $_SESSION['sc_session']['path_img'] ?>/color.gif" style="border-width: 0px" /></a>
   </td>
</tr>

 <tr id='lin_exibe_val'  class="scGridFieldOddVert">
   <td>
     <?php echo $tradutor[$language]['exibe_val']; ?>
   </td>
   <td>
     <select  name="exibe_val"  size=1>
       <option value="S" <?php if ($exibe_val == "S")  { echo " selected" ;} ?>><?php echo $tradutor[$language]['sim']; ?></option>
       <option value="N" <?php if ($exibe_val == "N")  { echo " selected" ;} ?>><?php echo $tradutor[$language]['nao']; ?></option>
     </select>
   </td>
</tr>

 <tr id='lin_angulo' class="scGridFieldOddVert">
   <td>
     <?php echo $tradutor[$language]['angulo']; ?>
   </td>
   <td>
     <input type="text" name="angulo" value="<?php echo NM_encode_input($angulo); ?>" size=4 maxlength=2>
   </td>
 </tr>

 <tr class="scGridFieldOddVert">
   <td>
     <?php echo $tradutor[$language]['largura']; ?>
   </td>
   <td>
     <input type="text" name="largura" value="<?php echo NM_encode_input($largura); ?>" size=6 maxlength=4>
   </td>
</tr>
 <tr class="scGridFieldOddVert">
   <td>
     <?php echo $tradutor[$language]['altura']; ?>
   </td>
   <td>
     <input type="text" name="altura" value="<?php echo NM_encode_input($altura); ?>" size=6 maxlength=4>
   </td>
 </tr>
 <tr class="scGridFieldOddVert">
   <td>
     <?php echo $tradutor[$language]['margem']; ?>
   </td>
   <td>
     <input type="text" name="margem" value="<?php echo NM_encode_input($margem); ?>" size=6 maxlength=3>
   </td>
</tr>
 <tr class="scGridFieldOddVert">
   <td>
     <?php echo $tradutor[$language]['aspecto']; ?>
   </td>
   <td>
     <select  name="aspecto"  size=1>
       <option value="S" <?php if ($aspecto == "S")  { echo " selected" ;} ?>><?php echo $tradutor[$language]['sim']; ?></option>
       <option value="N" <?php if ($aspecto == "N")  { echo " selected" ;} ?>><?php echo $tradutor[$language]['nao']; ?></option>
     </select>
   </td>
</tr>

 <tr id='lin_cor_margens' class="scGridFieldOddVert">
   <td>
     <?php echo $tradutor[$language]['cor_margens']; ?>
   </td>
   <td>
     <input type="text" name="cor_margens" value="<?php echo NM_encode_input($cor_margens); ?>" size=8 maxlength=7>
     <a href="javascript: TCP.popup(document.forms['config_graf'].elements['cor_margens'], '', '<?php echo $_SESSION['sc_session']['path_third'] ?>/tigra_color_picker/picker.php', 'nm_volta_cor')">
      <img src="<?php echo $_SESSION['sc_session']['path_img'] ?>/color.gif" style="border-width: 0px" /></a>
   </td>
 </tr>

 <tr id='lin_cor_label' class="scGridFieldOddVert">
   <td>
     <?php echo $tradutor[$language]['cor_label']; ?>
   </td>
   <td>
     <input type="text" name="cor_label" value="<?php echo NM_encode_input($cor_label); ?>" size=8 maxlength=7>
     <a href="javascript: TCP.popup(document.forms['config_graf'].elements['cor_label'], '', '<?php echo $_SESSION['sc_session']['path_third'] ?>/tigra_color_picker/picker.php', 'nm_volta_cor')">
      <img src="<?php echo $_SESSION['sc_session']['path_img'] ?>/color.gif" style="border-width: 0px" /></a>
   </td>
</tr>

  <tr id='lin_cor_valores' class="scGridFieldOddVert">
   <td>
     <?php echo $tradutor[$language]['cor_valores']; ?>
   </td>
   <td>
     <input type="text" name="cor_valores" value="<?php echo NM_encode_input($cor_valores); ?>" size=8 maxlength=7>
     <a href="javascript: TCP.popup(document.forms['config_graf'].elements['cor_valores'], '', '<?php echo $_SESSION['sc_session']['path_third'] ?>/tigra_color_picker/picker.php', 'nm_volta_cor')">
      <img src="<?php echo $_SESSION['sc_session']['path_img'] ?>/color.gif" style="border-width: 0px" /></a>
   </td>
 </tr>

 <tr id='lin_preencher' class="scGridFieldOddVert">
   <td>
     <?php echo $tradutor[$language]['preencher']; ?>
   </td>
   <td>
     <select  name="preencher"  size=1>
       <option value="S" <?php if ($preencher == "S")  { echo " selected" ;} ?>><?php echo $tradutor[$language]['sim']; ?></option>
       <option value="N" <?php if ($preencher == "N")  { echo " selected" ;} ?>><?php echo $tradutor[$language]['nao']; ?></option>
     </select>
   </td>
 </tr>

 <tr id='lin_marcas' class="scGridFieldOddVert">
   <td>
     <?php echo $tradutor[$language]['exibe_marcas']; ?>
   </td>
   <td>
     <select  name="exibe_marcas"  size=1>
       <option value="S" <?php if ($exibe_marcas == "S")  { echo " selected" ;} ?>><?php echo $tradutor[$language]['sim']; ?></option>
       <option value="N" <?php if ($exibe_marcas == "N")  { echo " selected" ;} ?>><?php echo $tradutor[$language]['nao']; ?></option>
     </select>
   </td>
 </tr>

 <tr id='lin_tipo_marcas' class="scGridFieldOddVert">
   <td>
     <?php echo $tradutor[$language]['tipo_marcas']; ?>
   </td>
   <td>
     <select  name="tipo_marcas"  size=1>
       <option value="Q" <?php if ($tipo_marcas == "Q")  { echo " selected" ;} ?>><?php echo $tradutor[$language]['quadrado']; ?></option>
       <option value="C" <?php if ($tipo_marcas == "C")  { echo " selected" ;} ?>><?php echo $tradutor[$language]['circulo']; ?></option>
       <option value="U" <?php if ($tipo_marcas == "U")  { echo " selected" ;} ?>><?php echo $tradutor[$language]['trianguloU']; ?></option>
       <option value="D" <?php if ($tipo_marcas == "D")  { echo " selected" ;} ?>><?php echo $tradutor[$language]['trianguloD']; ?></option>
       <option value="L" <?php if ($tipo_marcas == "L")  { echo " selected" ;} ?>><?php echo $tradutor[$language]['lozangulo']; ?></option>
       <option value="E" <?php if ($tipo_marcas == "E")  { echo " selected" ;} ?>><?php echo $tradutor[$language]['estrela']; ?></option>
     </select>
   </td>
 </tr>

 </table></td></tr>
 <tr class="scGridToolbar">
   <td colspan=1 align="middle">
<?php
echo  $_SESSION['scriptcase']['bg_btn_popup']['bok'] . "\r\n";
echo  "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\r\n";
echo  $_SESSION['scriptcase']['bg_btn_popup']['btbremove'] . "\r\n";

?>
   </td>
 </tr>
</table>

 </td>
 </tr>
</table>

  <input type="hidden" name="nome_apl"  value="<?php echo NM_encode_input($nome_apl); ?>">
  <input type="hidden" name="campo_apl" value="<?php echo NM_encode_input($campo_apl); ?>" >
  <input type="hidden" name="sc_page"   value="<?php echo NM_encode_input($sc_page); ?>" >
  <input type="hidden" name="bok_graf"  value="" >
</form>
<script type="text/javascript">
  omite_lin();
<?php
  if (!$sint_anal)
  {
      echo "document.getElementById('lin_opc_atual').style.display = 'none';";
  }
?>
  function nm_volta_cor()
  {
  }
  function omite_lin()
  {
/*
pizza: 3, 8, 20, 21
barra: 1, 4
linha: 2, 5, 6, 7
impulse: 26, 27
scatter: 28, 29
*/
     ind = document.config_graf.tipo.selectedIndex;
     val = document.config_graf.tipo.options[ind].value;
     mt  = document.getElementById('main_table');
     if (val == 3 || val == 8 || val == 20 || val == 21)
     {
        document.getElementById('lin_cor_margens').style.display = 'none';
        document.getElementById('lin_cor_label').style.display = 'none';
        document.getElementById('lin_cor_valores').style.display = 'none';
        document.getElementById('lin_preencher').style.display = 'none';
        document.getElementById('lin_marcas').style.display = 'none';
        document.getElementById('lin_tipo_marcas').style.display = 'none';
        document.getElementById('lin_exibe_val').style.display = 'none';
        document.getElementById('lin_angulo').style.display = 'none';
     }
     else
     {
        document.getElementById('lin_cor_margens').style.display = '';
        document.getElementById('lin_cor_label').style.display = '';
        document.getElementById('lin_cor_valores').style.display = '';
        document.getElementById('lin_exibe_val').style.display = '';
        document.getElementById('lin_angulo').style.display = '';
        if (val == 1 || val == 4)
        {
           document.getElementById('lin_preencher').style.display = 'none';
           document.getElementById('lin_marcas').style.display = 'none';
           document.getElementById('lin_tipo_marcas').style.display = 'none';
        }
        if (val == 2 || val == 5 || val == 6 || val == 7)
        {
            document.getElementById('lin_preencher').style.display = '';
            document.getElementById('lin_marcas').style.display = '';
            document.getElementById('lin_tipo_marcas').style.display = '';
        }
        if (val == 26 || val == 27)
        {
           document.getElementById('lin_preencher').style.display = 'none';
           document.getElementById('lin_marcas').style.display = 'none';
           document.getElementById('lin_tipo_marcas').style.display = '';
        }
        if (val == 28 || val == 29)
        {
           document.getElementById('lin_preencher').style.display = 'none';
           document.getElementById('lin_marcas').style.display = 'none';
           document.getElementById('lin_tipo_marcas').style.display = '';
        }
     }

/*
     W = document.getElementById('main_table').clientWidth + 12;
     H = document.getElementById('main_table').clientHeight + 40;
     if (navigator.appName == "Netscape")
     {
         H += 45;
     }
     if (navigator.appName.substr(0,9) == "Microsoft")
     {
         H += 40;
     }
     window.resizeTo(W, H);
*/
     var W = mt.clientWidth,
         H = mt.clientHeight;
     if (0 == W || 0 == H)
     {
         setTimeout("omite_lin()", 50);
     }
     else
     {
         self.parent.tb_resize(H + 40, W + 40);
     }
  }
  function processa()
  {
     document.config_graf.bok_graf.value = "OK";
     config_graf.submit();
  }
</script>
</body>
</html>