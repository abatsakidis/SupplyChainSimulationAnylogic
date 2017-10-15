<?php  
  include_once('pdfreport_factory_session.php');
  session_start() ;
  class pdfreport_factory_form_teste
  {
  function pdfreport_factory_teste()
  {
    include("../_lib/lang/el.lang.php");
    $_SESSION['scriptcase']['charset'] = (isset($this->Nm_lang['Nm_charset']) && !empty($this->Nm_lang['Nm_charset'])) ? $this->Nm_lang['Nm_charset'] : "UTF-8";
    $sc_charset['UTF-8'] = 'utf-8';
    $sc_charset['ISO-8859-1'] = 'iso-8859-1';
    $sc_charset['SJIS'] = 'shift-jis';
    $sc_charset['ISO-8859-14'] = 'iso-8859-14';
    $sc_charset['ISO-8859-7'] = 'iso-8859-7';
    $sc_charset['ISO-8859-10'] = 'iso-8859-10';
    $sc_charset['ISO-8859-3'] = 'iso-8859-3';
    $sc_charset['ISO-8859-15'] = 'iso-8859-15';
    $sc_charset['WINDOWS-1252'] = 'windows-1252';
    $sc_charset['ISO-8859-13'] = 'iso-8859-13';
    $sc_charset['ISO-8859-4'] = 'iso-8859-4';
    $sc_charset['ISO-8859-2'] = 'iso-8859-2';
    $sc_charset['ISO-8859-5'] = 'iso-8859-5';
    $sc_charset['KOI8-R'] = 'koi8-r';
    $sc_charset['WINDOWS-1251'] = 'windows-1251';
    $sc_charset['BIG-5'] = 'big5';
    $sc_charset['EUC-CN'] = 'EUC-CN';
    $sc_charset['EUC-JP'] = 'euc-jp';
    $sc_charset['ISO-2022-JP'] = 'iso-2022-jp';
    $sc_charset['EUC-KR'] = 'euc-kr';
    $sc_charset['ISO-2022-KR'] = 'iso-2022-kr';
    $sc_charset['ISO-8859-9'] = 'iso-8859-9';
    $sc_charset['ISO-8859-6'] = 'iso-8859-6';
    $sc_charset['ISO-8859-8'] = 'iso-8859-8';
    $sc_charset['ISO-8859-8-I'] = 'iso-8859-8-i';
    $_SESSION['scriptcase']['charset_html']  = (isset($sc_charset[$_SESSION['scriptcase']['charset']])) ? $sc_charset[$_SESSION['scriptcase']['charset']] : $_SESSION['scriptcase']['charset'];
?> 
<html> 
<HEAD>
 <title>pdfreport_factory</title> 
 <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
 <META http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT"/>
 <META http-equiv="Last-Modified" content="<?php echo gmdate("D, d M Y H:i:s"); ?> GMT"/>
 <META http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate"/>
 <META http-equiv="Cache-Control" content="post-check=0, pre-check=0"/>
 <META http-equiv="Pragma" content="no-cache"/>
</HEAD>
<body> 
<?php  
  $str_path_web = $_SERVER['PHP_SELF'];
  $str_path_web = str_replace("\\", '/', $str_path_web);
  $str_path_web = str_replace('//', '/', $str_path_web);
  $path_img     = substr($str_path_web, 0, strrpos($str_path_web, '/'));
  $path_img     = substr($path_img, 0, strrpos($path_img, '/')) . '/';
  $path_img     = $path_img . "_lib/img";
  if (isset($_SESSION['scriptcase']['sc_outra_jan']) && $_SESSION['scriptcase']['sc_outra_jan'] == 'pdfreport_factory')
  {
      echo "<a href='" . $_SESSION['scriptcase']['nm_sc_retorno'] . "' target='_self' onclick='javascript:window.close();'>" . $this->Nm_lang['lang_btns_rtrn_scrp_hint'] . "</a> \n" ; 
  }
  elseif (isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])) 
  {
      echo "<a href='" . $_SERVER['HTTP_REFERER'] . "' target='_self'>" . $this->Nm_lang['lang_btns_exit_appl_hint'] . "</a> \n" ; 
  }
?> 
<br> 
<br> 
<br> 
<form name="FCons" method=post 
               action="./" 
               target="_self"> 
<input type="hidden" name="script_case_session" value="<?php echo session_id() ?>"/>
<input type="hidden" name="nmgp_outra_jan" value="true"/>
<input type="hidden" name="nmgp_start" value="SC"/>
<input type=hidden name="NM_contr_var_session" value="Yes"> 
<input type=submit value="pdfreport_factory"> 
</form> 
<script language=javascript> 
</script> 
</body> 
</html> 
<?php
  }
 }
  $frm_teste = new pdfreport_factory_form_teste();
  $frm_teste->pdfreport_factory_teste();
?>
