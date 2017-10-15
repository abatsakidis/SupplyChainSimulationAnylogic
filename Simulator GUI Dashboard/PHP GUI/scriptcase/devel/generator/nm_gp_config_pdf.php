<?php
/**
 * $Id: nm_gp_config_pdf.php,v 1.6 2012-01-31 19:33:19 luis Exp $
 */
    session_start();

    $bookmarks  = (isset($_GET['bookmarks']))  ? $_GET['bookmarks'] : "";
    $fonte      = (isset($_GET['conf_fonte'])) ? $_GET['conf_fonte'] : "0";
    $grafico    = (isset($_GET['grafico']))    ? $_GET['grafico'] : "";
    $largura    = (isset($_GET['largura']))    ? $_GET['largura'] : "";
    $opc        = (isset($_GET['nm_opc']))     ? $_GET['nm_opc'] : "";
    $target     = (isset($_GET['nm_target']))  ? $_GET['nm_target'] : "";
    $language   = (isset($_GET['language']))   ? $_GET['language'] : "en_us";
    $papel      = (isset($_GET['papel']))      ? $_GET['papel'] : "";
    $cor        = (isset($_GET['nm_cor']))     ? $_GET['nm_cor'] : "";
    $orientacao = (isset($_GET['orientacao'])) ? $_GET['orientacao'] : "";
    $conf_larg  = (isset($_GET['conf_larg']))  ? $_GET['conf_larg'] : "N";
    $conf_socor = (isset($_GET['conf_socor'])) ? $_GET['conf_socor'] : "N";
    $apapel     = (isset($_GET['apapel']))     ? $_GET['apapel'] : "";
    $lpapel     = (isset($_GET['lpapel']))     ? $_GET['lpapel'] : "";

    if (!function_exists("NM_is_utf8"))
    {
        include_once($SC_apl_proc . "_nmutf8.php");
    }

    $tradutor = array();
    if (isset($_SESSION['scriptcase']['sc_idioma_pdf']))
    {
        $tradutor = $_SESSION['scriptcase']['sc_idioma_pdf'];
    }
    if (!isset($tradutor[$language]))
    {
         foreach ($tradutor as $language => $resto)
         {
             break;
         }
    }
    if (!isset($tradutor[$language]))
    {
                exit;
    }
    $tp_papel = array();
    if (!isset($_SESSION['scriptcase']['sc_tp_pdf']) || $_SESSION['scriptcase']['sc_tp_pdf'] == "pd4ml")
    {
        $tp_papel[1]  = "LETTER";
        $tp_papel[2]  = "LEGAL";
        $tp_papel[3]  = "LEDGER";
        $tp_papel[4]  = "A0";
        $tp_papel[5]  = "A1";
        $tp_papel[6]  = "A2";
        $tp_papel[7]  = "A3";
        $tp_papel[8]  = "A4";
        $tp_papel[9]  = "A5";
        $tp_papel[10] = "A6";
        $tp_papel[11] = "ISOB5";
        $tp_papel[12] = "TABLOID";
        $tp_papel[13] = "TABLOID ";
        $tp_papel[14] = "A4";
        $tp_papel[15] = "A4";
        $tp_papel[16] = "A7";
        $tp_papel[17] = "A8";
        $tp_papel[18] = "A9";
        $tp_papel[19] = "A10";
        $tp_papel[20] = "ISOB0";
        $tp_papel[21] = "ISOB1";
        $tp_papel[22] = "ISOB2";
        $tp_papel[23] = "ISOB3";
        $tp_papel[24] = "ISOB4";
        $tp_papel[25] = "NOTE";
        $tp_papel[26] = "HALFLETTER";
    }
    else
    {
        $tp_papel[1]  = "Letter";
        $tp_papel[2]  = "Legal";
        $tp_papel[3]  = "Ledger";
        $tp_papel[4]  = "A0";
        $tp_papel[5]  = "A1";
        $tp_papel[6]  = "A2";
        $tp_papel[7]  = "A3";
        $tp_papel[8]  = "A4";
        $tp_papel[9]  = "A5";
        $tp_papel[10] = "A6";
        $tp_papel[11] = "B5";
        $tp_papel[12] = "Tabloid";
        $tp_papel[13] = "Tabloid ";
        $tp_papel[14] = "A4";
        $tp_papel[15] = "A4";
        $tp_papel[16] = "A7";
        $tp_papel[17] = "A8";
        $tp_papel[18] = "A9";
        $tp_papel[19] = "A9";
        $tp_papel[20] = "B0";
        $tp_papel[21] = "B1";
        $tp_papel[22] = "B2";
        $tp_papel[23] = "B3";
        $tp_papel[24] = "B4";
        $tp_papel[25] = "Executive";
        $tp_papel[26] = "A5";
        $tp_papel[27] = "B6";
        $tp_papel[28] = "B7";
        $tp_papel[29] = "B8";
        $tp_papel[30] = "B9";
        $tp_papel[31] = "B10";
        $tp_papel[32] = "C5E";
        $tp_papel[33] = "Comm10E";
        $tp_papel[34] = "DLE";
        $tp_papel[35] = "Folio";
    }

    if (!isset($tp_papel[$papel]))
    {
        $papel = 8;
    }
    if (!isset($tp_papel[$apapel]))
    {
        $apapel = 8;
    }

?>
<html<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<head>
 <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html']; ?>" />
<?php
/*
$tmp_useragent = $_SERVER['HTTP_USER_AGENT'];
if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$tmp_useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($tmp_useragent,0,4)))
*/
if ((isset($_SESSION['scriptcase']['proc_mobile']) && $_SESSION['scriptcase']['proc_mobile'])  || (isset($_SESSION['scriptcase']['device_mobile']) && $_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile']))
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

<form name="config_pdf" method="post">
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
     <?php echo $tradutor[$language]['tp_imp']; ?>
   </td>
   <td>
     <select  name="cor_imp"  size=1>
       <option value="cor"      <?php if ($cor == "cor")  { echo " selected" ;} ?>><?php echo $tradutor[$language]['color']; ?></option>
       <option value="pb"       <?php if ($cor == "pb")  { echo " selected" ;} ?>><?php echo $tradutor[$language]['econm']; ?></option>
     </select>
   </td>
 </tr>
<?php
if ($conf_socor == "N")
{
?>
 <tr class="scGridFieldOddVert">
   <td>
     <?php echo $tradutor[$language]['tp_pap']; ?>
   </td>
   <td>
<?php
  if (!isset($_SESSION['scriptcase']['sc_tp_pdf']) || $_SESSION['scriptcase']['sc_tp_pdf'] == "pd4ml")
  {
//      echo "     <select  name=\"papel\" size=1 onchange=custom_paper()>\r\n";
      echo "     <select  name=\"papel\" size=1>\r\n";
      echo "       <option value=\"" . $tp_papel[1]  . "\""; if ($papel == "1")   { echo " selected" ;} echo ">" . $tradutor[$language]['carta'] . " (216 x 279 mm)</option>\r\n";
      echo "       <option value=\"" . $tp_papel[2]  . "\""; if ($papel == "2")   { echo " selected" ;} echo ">" . $tradutor[$language]['oficio'] . " (216 x 356 mm)</option>\r\n";
      echo "       <option value=\"" . $tp_papel[3]  . "\""; if ($papel == "3")   { echo " selected" ;} echo ">Ledger (432 x 279 mm)</option>\r\n";
      echo "       <option value=\"" . $tp_papel[4]  . "\""; if ($papel == "4")   { echo " selected" ;} echo ">A0 (841 X 1189 mm)</option>\r\n";
      echo "       <option value=\"" . $tp_papel[5]  . "\""; if ($papel == "5")   { echo " selected" ;} echo ">A1 (594 x 841  mm)</option>\r\n";
      echo "       <option value=\"" . $tp_papel[6]  . "\""; if ($papel == "6")   { echo " selected" ;} echo ">A2 (420 x 594  mm)</option>\r\n";
      echo "       <option value=\"" . $tp_papel[7]  . "\""; if ($papel == "7")   { echo " selected" ;} echo ">A3 (297 x 420  mm)</option>\r\n";
      echo "       <option value=\"" . $tp_papel[8]  . "\""; if ($papel == "8")   { echo " selected" ;} echo ">A4 (210 X 297  mm)</option>\r\n";
      echo "       <option value=\"" . $tp_papel[9]  . "\""; if ($papel == "9")   { echo " selected" ;} echo ">A5 (148 x 210  mm)</option>\r\n";
      echo "       <option value=\"" . $tp_papel[10] . "\""; if ($papel == "10")  { echo " selected" ;} echo ">A6 (105 x 148  mm)</option>\r\n";
      echo "       <option value=\"" . $tp_papel[16] . "\""; if ($papel == "16")  { echo " selected" ;} echo ">A7 (74  x 105  mm)</option>\r\n";
      echo "       <option value=\"" . $tp_papel[17] . "\""; if ($papel == "17")  { echo " selected" ;} echo ">A8 (52  x 74   mm)</option>\r\n";
      echo "       <option value=\"" . $tp_papel[18] . "\""; if ($papel == "18")  { echo " selected" ;} echo ">A9 (37  x 52   mm)</option>\r\n";
      echo "       <option value=\"" . $tp_papel[19] . "\""; if ($papel == "19")  { echo " selected" ;} echo ">A10 (26  x 37  mm)</option>\r\n";
      echo "       <option value=\"" . $tp_papel[20] . "\""; if ($papel == "20")  { echo " selected" ;} echo ">B0 (1000 x 1414 mm)</option>\r\n";
      echo "       <option value=\"" . $tp_papel[21] . "\""; if ($papel == "21")  { echo " selected" ;} echo ">B1 (707  x 1000 mm)</option>\r\n";
      echo "       <option value=\"" . $tp_papel[22] . "\""; if ($papel == "22")  { echo " selected" ;} echo ">B2 (500  x 707  mm)</option>\r\n";
      echo "       <option value=\"" . $tp_papel[23] . "\""; if ($papel == "23")  { echo " selected" ;} echo ">B3 (353  x 500  mm)</option>\r\n";
      echo "       <option value=\"" . $tp_papel[24] . "\""; if ($papel == "24")  { echo " selected" ;} echo ">B4 (250  x 353  mm)</option>\r\n";
      echo "       <option value=\"" . $tp_papel[11] . "\""; if ($papel == "11")  { echo " selected" ;} echo ">B5 (176  x 250  mm)</option>\r\n";
      echo "       <option value=\"" . $tp_papel[13] . "\""; if ($papel == "13")  { echo " selected" ;} echo ">Tabliod (280 x 432 mm)</option>\r\n";
      echo "       <option value=\"" . $tp_papel[25] . "\""; if ($papel == "25")  { echo " selected" ;} echo ">Note (190 x 254 mm)</option>\r\n";
      echo "       <option value=\"" . $tp_papel[26] . "\""; if ($papel == "26")  { echo " selected" ;} echo ">HalfLetter (140 x 216 mm)</option>\r\n";
  }
  else
  {
      echo "     <select  name=\"papel\" size=1>\r\n";
      echo "       <option value=\"" . $tp_papel[1]  . "\""; if ($papel == "1")   { echo " selected" ;} echo ">" . $tradutor[$language]['carta'] . " (216 x 279 mm)</option>\r\n";
      echo "       <option value=\"" . $tp_papel[2]  . "\""; if ($papel == "2")   { echo " selected" ;} echo ">" . $tradutor[$language]['oficio'] . " (216 x 356 mm)</option>\r\n";
      echo "       <option value=\"" . $tp_papel[3]  . "\""; if ($papel == "3")   { echo " selected" ;} echo ">Ledger (432 x 279 mm)</option>\r\n";
      echo "       <option value=\"" . $tp_papel[4]  . "\""; if ($papel == "4")   { echo " selected" ;} echo ">A0 (841 X 1189 mm)</option>\r\n";
      echo "       <option value=\"" . $tp_papel[5]  . "\""; if ($papel == "5")   { echo " selected" ;} echo ">A1 (594 x 841  mm)</option>\r\n";
      echo "       <option value=\"" . $tp_papel[6]  . "\""; if ($papel == "6")   { echo " selected" ;} echo ">A2 (420 x 594  mm)</option>\r\n";
      echo "       <option value=\"" . $tp_papel[7]  . "\""; if ($papel == "7")   { echo " selected" ;} echo ">A3 (297 x 420  mm)</option>\r\n";
      echo "       <option value=\"" . $tp_papel[8]  . "\""; if ($papel == "8")   { echo " selected" ;} echo ">A4 (210 X 297  mm)</option>\r\n";
      echo "       <option value=\"" . $tp_papel[9]  . "\""; if ($papel == "9")   { echo " selected" ;} echo ">A5 (148 x 210  mm)</option>\r\n";
      echo "       <option value=\"" . $tp_papel[10] . "\""; if ($papel == "10")  { echo " selected" ;} echo ">A6 (105 x 148  mm)</option>\r\n";
      echo "       <option value=\"" . $tp_papel[16] . "\""; if ($papel == "16")  { echo " selected" ;} echo ">A7 (74  x 105  mm)</option>\r\n";
      echo "       <option value=\"" . $tp_papel[17] . "\""; if ($papel == "17")  { echo " selected" ;} echo ">A8 (52  x 74   mm)</option>\r\n";
      echo "       <option value=\"" . $tp_papel[18] . "\""; if ($papel == "18")  { echo " selected" ;} echo ">A9 (37  x 52   mm)</option>\r\n";
      echo "       <option value=\"" . $tp_papel[20] . "\""; if ($papel == "20")  { echo " selected" ;} echo ">B0 (1000 x 1414 mm)</option>\r\n";
      echo "       <option value=\"" . $tp_papel[21] . "\""; if ($papel == "21")  { echo " selected" ;} echo ">B1 (707  x 1000 mm)</option>\r\n";
      echo "       <option value=\"" . $tp_papel[22] . "\""; if ($papel == "22")  { echo " selected" ;} echo ">B2 (500  x 707  mm)</option>\r\n";
      echo "       <option value=\"" . $tp_papel[23] . "\""; if ($papel == "23")  { echo " selected" ;} echo ">B3 (353  x 500  mm)</option>\r\n";
      echo "       <option value=\"" . $tp_papel[24] . "\""; if ($papel == "24")  { echo " selected" ;} echo ">B4 (250  x 353  mm)</option>\r\n";
      echo "       <option value=\"" . $tp_papel[11] . "\""; if ($papel == "11")  { echo " selected" ;} echo ">B5 (176  x 250  mm)</option>\r\n";
      echo "       <option value=\"" . $tp_papel[11] . "\""; if ($papel == "27")  { echo " selected" ;} echo ">B6 (125  x 176  mm)</option>\r\n";
      echo "       <option value=\"" . $tp_papel[11] . "\""; if ($papel == "28")  { echo " selected" ;} echo ">B7 (88  x 125  mm)</option>\r\n";
      echo "       <option value=\"" . $tp_papel[11] . "\""; if ($papel == "29")  { echo " selected" ;} echo ">B8 (62  x 88  mm)</option>\r\n";
      echo "       <option value=\"" . $tp_papel[11] . "\""; if ($papel == "30")  { echo " selected" ;} echo ">B9 (33  x 62  mm)</option>\r\n";
      echo "       <option value=\"" . $tp_papel[11] . "\""; if ($papel == "31")  { echo " selected" ;} echo ">B10 (31  x 44  mm)</option>\r\n";
      echo "       <option value=\"" . $tp_papel[13] . "\""; if ($papel == "13")  { echo " selected" ;} echo ">Tabliod (280 x 432 mm)</option>\r\n";
      echo "       <option value=\"" . $tp_papel[25] . "\""; if ($papel == "25")  { echo " selected" ;} echo ">Executive (190 x 254 mm)</option>\r\n";
      echo "       <option value=\"" . $tp_papel[26] . "\""; if ($papel == "32")  { echo " selected" ;} echo ">C5E (163 x 229 mm)</option>\r\n";
      echo "       <option value=\"" . $tp_papel[26] . "\""; if ($papel == "33")  { echo " selected" ;} echo ">Comm10E (105 x 241 mm)</option>\r\n";
      echo "       <option value=\"" . $tp_papel[26] . "\""; if ($papel == "34")  { echo " selected" ;} echo ">DLE (110 x 220 mm)</option>\r\n";
      echo "       <option value=\"" . $tp_papel[26] . "\""; if ($papel == "35")  { echo " selected" ;} echo ">Folio (210 x 330 mm)</option>\r\n";
  }
?>
     </select>
   </td>
</tr>
 <tr class="scGridFieldOddVert" id='customiz_papel' style='display: none'>
   <td align=right>
    <font size="1">
     <?php echo $tradutor[$language]['alt_papel'] . " x " . $tradutor[$language]['larg_papel']; ?>
   </td>
   <td>
     <input type=text name="alt_papel"  size=2 maxlength=4 value="<?php echo NM_encode_input($apapel); ?>">&nbsp;x&nbsp;
     <input type=text name="larg_papel" size=2 maxlength=4 value="<?php echo NM_encode_input($lpapel); ?>">&nbsp;mm
   </td>
</tr>
<?php
}
if ($conf_socor == "N")
{
?>
 <tr class="scGridFieldOddVert">
   <td>
     <?php echo $tradutor[$language]['orient']; ?>
   </td>
   <td>
     <select  name="orientacao"  size=1>
       <option value="portrait" <?php if ($orientacao == "1")  { echo " selected" ;} ?>><?php echo $tradutor[$language]['retrato']; ?></option>
       <option value="landscape"<?php if ($orientacao == "2")  { echo " selected" ;} ?>><?php echo $tradutor[$language]['paisag']; ?></option>
     </select>
   </td>
</tr>
<?php
}
 if ($bookmarks != "XX" && $conf_socor == "N")
 {
?>
 <tr class="scGridFieldOddVert">
   <td>
     <?php echo $tradutor[$language]['book']; ?>
   </td>
   <td>
     <select  name="bookmarks"  size=1>
       <option value="1"<?php if ($bookmarks == "1")  { echo " selected" ;} ?>><?php echo $tradutor[$language]['sim']; ?></option>
       <option value="2"<?php if ($bookmarks == "2")  { echo " selected" ;} ?>><?php echo $tradutor[$language]['nao']; ?></option>
     </select>
   </td>
 </tr>
<?php
 }
 if ($grafico != "XX" && $conf_socor == "N")
 {
?>
 <tr class="scGridFieldOddVert">
   <td>
     <?php echo $tradutor[$language]['grafico']; ?>
   </td>
   <td>
     <select  name="grafico"  size=1>
       <option value="S"<?php if ($grafico == "S")  { echo " selected" ;} ?>><?php echo $tradutor[$language]['sim']; ?></option>
       <option value="N"<?php if ($grafico == "N")  { echo " selected" ;} ?>><?php echo $tradutor[$language]['nao']; ?></option>
     </select>
   </td>
</tr>
<?php
 }

if ($conf_larg == "S" && $conf_socor == "N")
{
  if (isset($_SESSION['scriptcase']['sc_tp_pdf']) && $_SESSION['scriptcase']['sc_tp_pdf'] == "wkhtmltopdf")
  {
?>
     <input type="hidden" name="largura" value="<?php echo NM_encode_input($largura); ?>" size=6 maxlength=4>
     <input type="hidden" name="fonte" value="<?php echo NM_encode_input($fonte); ?>">
<?php
  }
  else
  {
?>
 <tr class="scGridFieldOddVert">
   <td>
     <?php echo $tradutor[$language]['largura']; ?>
   </td>
   <td>
     <input type="text" name="largura" value="<?php echo NM_encode_input($largura); ?>" size=6 maxlength=4>
   </td>
</tr>
     <input type="hidden" name="fonte" value="<?php echo NM_encode_input($fonte); ?>">
<?php
  }
 }
?>
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

<?php
if ($bookmarks == "XX" || $conf_socor == "S")
{
    $book = $bookmarks;
    if ($bookmarks == "XX")
    {
        $book = 2;
    }
?>
    <input type="hidden" name="bookmarks" value="<?php echo NM_encode_input($book); ?>">
<?php
}
if ($conf_larg != "S" || $conf_socor == "S")
{
?>
    <input type="hidden" name="largura" value="<?php echo NM_encode_input($largura); ?>">
    <input type="hidden" name="fonte" value="<?php echo NM_encode_input($fonte); ?>">
<?php
}
if ($grafico == "XX" || $conf_socor == "S")
{
    $graf = $grafico;
    if ($grafico == "XX")
    {
        $graf = 2;
    }
?>
    <input type="hidden" name="grafico" value="<?php echo NM_encode_input($graf); ?>">
<?php
}
if ($conf_socor == "S")
{
    if (!isset($_SESSION['scriptcase']['sc_tp_pdf']) || $_SESSION['scriptcase']['sc_tp_pdf'] == "pd4ml")
    {
        $orient = ($orientacao == "1") ? "portrait" : "landscape";
    }
    else
    {
        $orient = ($orientacao == "1") ? "Portrait" : "Landscape";
    }
    $dim_papel = $tp_papel[$papel];
?>
    <input type="hidden" name="papel" value="<?php echo NM_encode_input($dim_papel); ?>">
    <input type="hidden" name="orientacao" value="<?php echo NM_encode_input($orient); ?>">
<?php
}

?>
</form>
<script language="javascript">
<?php
 if ($conf_socor == "N")
 {
?>
 // custom_paper();
<?php
 }
?>
var bFixed = false;
function ajusta_window()
{
  var mt = $(document.getElementById("main_table"));
  if (0 == mt.width() || 0 == mt.height())
  {
    setTimeout("ajusta_window()", 50);
    return;
  }
  else if(!bFixed)
  {
    bFixed = true;
    if (navigator.userAgent.indexOf("Chrome/") > 0)
    {
      self.parent.tb_resize(mt.height() + 40, mt.width() + 40);
      setTimeout("ajusta_window()", 50);
      return;
    }
  }
  self.parent.tb_resize(mt.height() + 40, mt.width() + 40);
}

$( document ).ready(function() {
   setTimeout("ajusta_window()", 50);
});

  function processa()
  {
     self.parent.tb_remove();
//     self.parent.SC_colorbox_close();
     ind   = document.config_pdf.cor_imp.selectedIndex;
     cor   = document.config_pdf.cor_imp.options[ind].value;
<?php
 if ($conf_socor == "N")
 {
?>
     ind        = document.config_pdf.papel.selectedIndex;
     papel      = document.config_pdf.papel.options[ind].value;
     larg_papel = document.config_pdf.larg_papel.value;
     alt_papel  = document.config_pdf.alt_papel.value;
     ind        = document.config_pdf.orientacao.selectedIndex;
     orientacao = document.config_pdf.orientacao.options[ind].value;
<?php
 }
 else
 {
?>
     papel      = document.config_pdf.papel.value;
     orientacao = document.config_pdf.orientacao.value;
<?php
 }
 if ($bookmarks != "XX" && $conf_socor == "N")
 {
?>
     ind   = document.config_pdf.bookmarks.selectedIndex;
     bookmarks = document.config_pdf.bookmarks.options[ind].value;
<?php
 }
 else
 {
?>
     bookmarks  = document.config_pdf.bookmarks.value;
<?php
 }
 if ($grafico != "XX" && $conf_socor == "N")
 {
?>
     ind   = document.config_pdf.grafico.selectedIndex;
     grafico = document.config_pdf.grafico.options[ind].value;
<?php
 }
 else
 {
?>
     grafico    = document.config_pdf.grafico.value;
<?php
}
?>
     largura    = document.config_pdf.largura.value;
     fonte      = document.config_pdf.fonte.value;
     parms_pdf = " ";
<?php
  if (!isset($_SESSION['scriptcase']['sc_tp_pdf']) || $_SESSION['scriptcase']['sc_tp_pdf'] == "pd4ml")
  {
?>
     if (largura > 0)
     {
         parms_pdf += largura;
     }
     else
     {
         parms_pdf += 800;
     }
     parms_pdf += ' ' + papel;
     parms_pdf += ' -orientation ' + orientacao.toUpperCase();
     if (bookmarks == 1)
     {
         parms_pdf += ' -bookmarks HEADINGS';
     }
<?php
  }
  else
  {
?>
     parms_pdf += ' --page-size ' + papel;
     if (orientacao.toUpperCase() == 'PORTRAIT')
     {
         parms_pdf += ' --orientation Portrait';
     }
     else
     {
         parms_pdf += ' --orientation Landscape';
     }
     if (bookmarks == 2)
     {
         parms_pdf += ' --outline-depth 0';
     }
<?php
  }
?>
     parent.nm_gp_move('<?php echo NM_encode_input($opc); ?>', '<?php echo NM_encode_input($target); ?>', cor, parms_pdf, grafico);return false;
  }
  function custom_paper()
  {
     ind   = document.config_pdf.papel.selectedIndex;
     papel = document.config_pdf.papel.options[ind].value;
     if (papel != 'custom')
     {
         document.getElementById('customiz_papel').style.display = 'none';
     }
     else
     {
         document.getElementById('customiz_papel').style.display = '';
     }
  }
</script>
<script>
        //colocado aqui devido a execução modal não executar o ready do jquery
     setTimeout("ajusta_window()", 50);
</script>
</body>
</html>