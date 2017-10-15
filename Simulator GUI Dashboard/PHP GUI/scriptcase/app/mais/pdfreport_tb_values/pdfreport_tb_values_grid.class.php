<?php
class pdfreport_tb_values_grid
{
   var $Ini;
   var $Erro;
   var $Pdf;
   var $Db;
   var $rs_grid;
   var $nm_grid_sem_reg;
   var $SC_seq_register;
   var $nm_location;
   var $nm_data;
   var $nm_cod_barra;
   var $sc_proc_grid; 
   var $nmgp_botoes = array();
   var $Campos_Mens_erro;
   var $NM_raiz_img; 
   var $Font_ttf; 
   var $id = array();
   var $f_manufacturingsetupcost = array();
   var $f_manufacturingcostperitem = array();
   var $f_holdingcostperitemperday = array();
   var $f_shortagecostperitemperday = array();
   var $f_bestparamvalue_s = array();
   var $f_bestparamvalue__s = array();
   var $r_ordersetupcost = array();
   var $r_ordercostperitem = array();
   var $r_holdingcostperitemperday = array();
   var $r_shortagecostperitemperday = array();
   var $r_bestparamvalue_s = array();
   var $r_bestparamvalue__s = array();
   var $w_ordersetupcost = array();
   var $w_ordercostperitem = array();
   var $w_holdingcostperitemperday = array();
   var $w_shortagecostperitemperday = array();
   var $w_bestparamvalue_s = array();
   var $w_bestparamvalue__s = array();
   var $status = array();
//--- 
 function monta_grid($linhas = 0)
 {

   clearstatcache();
   $this->inicializa();
   $this->grid();
 }
//--- 
 function inicializa()
 {
   global $nm_saida, 
   $rec, $nmgp_chave, $nmgp_opcao, $nmgp_ordem, $nmgp_chave_det, 
   $nmgp_quant_linhas, $nmgp_quant_colunas, $nmgp_url_saida, $nmgp_parms;
//
   $this->nm_data = new nm_data("el");
   include_once("../_lib/lib/php/nm_font_tcpdf.php");
   $this->default_font = 'Helvetica';
   $this->default_font_sr  = '';
   $this->default_style    = '';
   $this->default_style_sr = 'B';
   $Tp_papel = "A4";
   $old_dir = getcwd();
   $File_font_ttf     = "";
   $temp_font_ttf     = "";
   $this->Font_ttf    = false;
   $this->Font_ttf_sr = false;
   if (empty($this->default_font) && isset($arr_font_tcpdf[$this->Ini->str_lang]))
   {
       $this->default_font = $arr_font_tcpdf[$this->Ini->str_lang];
   }
   else
   {
       $this->default_font = "Times";
   }
   if (empty($this->default_font_sr) && isset($arr_font_tcpdf[$this->Ini->str_lang]))
   {
       $this->default_font_sr = $arr_font_tcpdf[$this->Ini->str_lang];
   }
   else
   {
       $this->default_font_sr = "Times";
   }
   chdir($this->Ini->path_third . "/tcpdf/");
   include_once("tcpdf.php");
   chdir($old_dir);
   $this->Pdf = new TCPDF('P', 'mm', $Tp_papel, true, 'UTF-8', false);
   $this->Pdf->setPrintHeader(false);
   $this->Pdf->setPrintFooter(false);
   if (!empty($File_font_ttf))
   {
       $this->Pdf->addTTFfont($File_font_ttf, "", "", 32, $_SESSION['scriptcase']['dir_temp'] . "/");
   }
   $this->Pdf->SetDisplayMode('real');
   $this->aba_iframe = false;
   if (isset($_SESSION['scriptcase']['sc_aba_iframe']))
   {
       foreach ($_SESSION['scriptcase']['sc_aba_iframe'] as $aba => $apls_aba)
       {
           if (in_array("pdfreport_tb_values", $apls_aba))
           {
               $this->aba_iframe = true;
               break;
           }
       }
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_tb_values']['iframe_menu'] && (!isset($_SESSION['scriptcase']['menu_mobile']) || empty($_SESSION['scriptcase']['menu_mobile'])))
   {
       $this->aba_iframe = true;
   }
   $this->nmgp_botoes['exit'] = "on";
   $this->sc_proc_grid = false; 
   $this->NM_raiz_img = $this->Ini->root;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
   $this->nm_where_dinamico = "";
   $this->nm_grid_colunas = 0;
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_tb_values']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_tb_values']['campos_busca']))
   { 
       $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_tb_values']['campos_busca'];
       if ($_SESSION['scriptcase']['charset'] != "UTF-8")
       {
           $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
       }
       $this->status[0] = $Busca_temp['status']; 
       $tmp_pos = strpos($this->status[0], "##@@");
       if ($tmp_pos !== false)
       {
           $this->status[0] = substr($this->status[0], 0, $tmp_pos);
       }
   } 
   $this->nm_field_dinamico = array();
   $this->nm_order_dinamico = array();
   $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_tb_values']['where_orig'];
   $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_tb_values']['where_pesq'];
   $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_tb_values']['where_pesq_filtro'];
   $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
   $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
   $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
   $_SESSION['scriptcase']['contr_link_emb'] = $this->nm_location;
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_tb_values']['qt_col_grid'] = 1 ;  
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['pdfreport_tb_values']['cols']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['pdfreport_tb_values']['cols']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_tb_values']['qt_col_grid'] = $_SESSION['scriptcase']['sc_apl_conf']['pdfreport_tb_values']['cols'];  
       unset($_SESSION['scriptcase']['sc_apl_conf']['pdfreport_tb_values']['cols']);
   }
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_tb_values']['ordem_select']))  
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_tb_values']['ordem_select'] = array(); 
   } 
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_tb_values']['ordem_quebra']))  
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_tb_values']['ordem_grid'] = "" ; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_tb_values']['ordem_ant']  = ""; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_tb_values']['ordem_desc'] = "" ; 
   }   
   if (!empty($nmgp_parms) && $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_tb_values']['opcao'] != "pdf")   
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_tb_values']['opcao'] = "igual";
       $rec = "ini";
   }
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_tb_values']['where_orig']) || $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_tb_values']['prim_cons'] || !empty($nmgp_parms))  
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_tb_values']['prim_cons'] = false;  
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_tb_values']['where_orig'] = "";  
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_tb_values']['where_pesq']        = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_tb_values']['where_orig'];  
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_tb_values']['where_pesq_ant']    = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_tb_values']['where_orig'];  
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_tb_values']['cond_pesq']         = ""; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_tb_values']['where_pesq_filtro'] = "";
   }   
   if  (!empty($this->nm_where_dinamico)) 
   {   
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_tb_values']['where_pesq'] .= $this->nm_where_dinamico;
   }   
   $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_tb_values']['where_orig'];
   $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_tb_values']['where_pesq'];
   $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_tb_values']['where_pesq_filtro'];
//
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_tb_values']['tot_geral'][1])) 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_tb_values']['total'] = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_tb_values']['tot_geral'][1] ;  
   }
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_tb_values']['where_pesq_ant'] = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_tb_values']['where_pesq'];  
//----- 
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
   { 
       $nmgp_select = "SELECT id, f_ManufacturingSetupCost, f_ManufacturingCostPerItem, f_HoldingCostPerItemPerDay, f_ShortageCostPerItemPerDay, f_BestParamValue_s, f_BestParamValue__S, r_OrderSetupCost, r_OrderCostPerItem, r_HoldingCostPerItemPerDay, r_ShortageCostPerItemPerDay, r_BestParamValue_s, r_BestParamValue__S, w_OrderSetupCost, w_OrderCostPerItem, w_HoldingCostPerItemPerDay, w_ShortageCostPerItemPerDay, w_BestParamValue_s, w_BestParamValue__S, Status from " . $this->Ini->nm_tabela; 
   } 
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
   { 
       $nmgp_select = "SELECT id, f_ManufacturingSetupCost, f_ManufacturingCostPerItem, f_HoldingCostPerItemPerDay, f_ShortageCostPerItemPerDay, f_BestParamValue_s, f_BestParamValue__S, r_OrderSetupCost, r_OrderCostPerItem, r_HoldingCostPerItemPerDay, r_ShortageCostPerItemPerDay, r_BestParamValue_s, r_BestParamValue__S, w_OrderSetupCost, w_OrderCostPerItem, w_HoldingCostPerItemPerDay, w_ShortageCostPerItemPerDay, w_BestParamValue_s, w_BestParamValue__S, Status from " . $this->Ini->nm_tabela; 
   } 
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
   { 
       $nmgp_select = "SELECT id, f_ManufacturingSetupCost, f_ManufacturingCostPerItem, f_HoldingCostPerItemPerDay, f_ShortageCostPerItemPerDay, f_BestParamValue_s, f_BestParamValue__S, r_OrderSetupCost, r_OrderCostPerItem, r_HoldingCostPerItemPerDay, r_ShortageCostPerItemPerDay, r_BestParamValue_s, r_BestParamValue__S, w_OrderSetupCost, w_OrderCostPerItem, w_HoldingCostPerItemPerDay, w_ShortageCostPerItemPerDay, w_BestParamValue_s, w_BestParamValue__S, Status from " . $this->Ini->nm_tabela; 
   } 
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
   { 
       $nmgp_select = "SELECT id, f_ManufacturingSetupCost, f_ManufacturingCostPerItem, f_HoldingCostPerItemPerDay, f_ShortageCostPerItemPerDay, f_BestParamValue_s, f_BestParamValue__S, r_OrderSetupCost, r_OrderCostPerItem, r_HoldingCostPerItemPerDay, r_ShortageCostPerItemPerDay, r_BestParamValue_s, r_BestParamValue__S, w_OrderSetupCost, w_OrderCostPerItem, w_HoldingCostPerItemPerDay, w_ShortageCostPerItemPerDay, w_BestParamValue_s, w_BestParamValue__S, Status from " . $this->Ini->nm_tabela; 
   } 
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
   { 
       $nmgp_select = "SELECT id, f_ManufacturingSetupCost, f_ManufacturingCostPerItem, f_HoldingCostPerItemPerDay, f_ShortageCostPerItemPerDay, f_BestParamValue_s, f_BestParamValue__S, r_OrderSetupCost, r_OrderCostPerItem, r_HoldingCostPerItemPerDay, r_ShortageCostPerItemPerDay, r_BestParamValue_s, r_BestParamValue__S, w_OrderSetupCost, w_OrderCostPerItem, w_HoldingCostPerItemPerDay, w_ShortageCostPerItemPerDay, w_BestParamValue_s, w_BestParamValue__S, Status from " . $this->Ini->nm_tabela; 
   } 
   else 
   { 
       $nmgp_select = "SELECT id, f_ManufacturingSetupCost, f_ManufacturingCostPerItem, f_HoldingCostPerItemPerDay, f_ShortageCostPerItemPerDay, f_BestParamValue_s, f_BestParamValue__S, r_OrderSetupCost, r_OrderCostPerItem, r_HoldingCostPerItemPerDay, r_ShortageCostPerItemPerDay, r_BestParamValue_s, r_BestParamValue__S, w_OrderSetupCost, w_OrderCostPerItem, w_HoldingCostPerItemPerDay, w_ShortageCostPerItemPerDay, w_BestParamValue_s, w_BestParamValue__S, Status from " . $this->Ini->nm_tabela; 
   } 
   $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_tb_values']['where_pesq']; 
   $nmgp_order_by = ""; 
   $campos_order_select = "";
   foreach($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_tb_values']['ordem_select'] as $campo => $ordem) 
   {
        if ($campo != $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_tb_values']['ordem_grid']) 
        {
           if (!empty($campos_order_select)) 
           {
               $campos_order_select .= ", ";
           }
           $campos_order_select .= $campo . " " . $ordem;
        }
   }
   if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_tb_values']['ordem_grid'])) 
   { 
       $nmgp_order_by = " order by " . $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_tb_values']['ordem_grid'] . $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_tb_values']['ordem_desc']; 
   } 
   if (!empty($campos_order_select)) 
   { 
       if (!empty($nmgp_order_by)) 
       { 
          $nmgp_order_by .= ", " . $campos_order_select; 
       } 
       else 
       { 
          $nmgp_order_by = " order by $campos_order_select"; 
       } 
   } 
   $nmgp_select .= $nmgp_order_by; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_tb_values']['order_grid'] = $nmgp_order_by;
   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
   $this->rs_grid = $this->Db->Execute($nmgp_select) ; 
   if ($this->rs_grid === false && !$this->rs_grid->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
   { 
       $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
       exit ; 
   }  
   if ($this->rs_grid->EOF || ($this->rs_grid === false && $GLOBALS["NM_ERRO_IBASE"] == 1)) 
   { 
       $this->nm_grid_sem_reg = $this->Ini->Nm_lang['lang_errm_empt']; 
   }  
// 
 }  
// 
 function Pdf_init()
 {
     if ($_SESSION['scriptcase']['reg_conf']['css_dir'] == "RTL")
     {
         $this->Pdf->setRTL(true);
     }
     $this->Pdf->setHeaderMargin(0);
     $this->Pdf->setFooterMargin(0);
     if ($this->Font_ttf)
     {
         $this->Pdf->SetFont($this->default_font, $this->default_style, 12, $this->def_TTF);
     }
     else
     {
         $this->Pdf->SetFont($this->default_font, $this->default_style, 12);
     }
     $this->Pdf->SetTextColor(255, 0, 0);
 }
// 
 function Pdf_image()
 {
   $this->Pdf->Image($this->NM_raiz_img . $this->Ini->path_img_global . "/usr__NM__bg__NM__anylogic_background.jpg", 1, 1, 0, 0);
 }
// 
//----- 
 function grid($linhas = 0)
 {
    global 
           $nm_saida, $nm_url_saida;
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_tb_values']['labels']['id'] = "Id";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_tb_values']['labels']['f_manufacturingsetupcost'] = "F Manufacturing Setup Cost";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_tb_values']['labels']['f_manufacturingcostperitem'] = "F Manufacturing Cost Per Item";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_tb_values']['labels']['f_holdingcostperitemperday'] = "F Holding Cost Per Item Per Day";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_tb_values']['labels']['f_shortagecostperitemperday'] = "F Shortage Cost Per Item Per Day";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_tb_values']['labels']['f_bestparamvalue_s'] = "F Best Param Value S";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_tb_values']['labels']['f_bestparamvalue__s'] = "F Best Param Value S";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_tb_values']['labels']['r_ordersetupcost'] = "R Order Setup Cost";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_tb_values']['labels']['r_ordercostperitem'] = "R Order Cost Per Item";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_tb_values']['labels']['r_holdingcostperitemperday'] = "R Holding Cost Per Item Per Day";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_tb_values']['labels']['r_shortagecostperitemperday'] = "R Shortage Cost Per Item Per Day";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_tb_values']['labels']['r_bestparamvalue_s'] = "R Best Param Value S";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_tb_values']['labels']['r_bestparamvalue__s'] = "R Best Param Value S";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_tb_values']['labels']['w_ordersetupcost'] = "W Order Setup Cost";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_tb_values']['labels']['w_ordercostperitem'] = "W Order Cost Per Item";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_tb_values']['labels']['w_holdingcostperitemperday'] = "W Holding Cost Per Item Per Day";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_tb_values']['labels']['w_shortagecostperitemperday'] = "W Shortage Cost Per Item Per Day";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_tb_values']['labels']['w_bestparamvalue_s'] = "W Best Param Value S";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_tb_values']['labels']['w_bestparamvalue__s'] = "W Best Param Value S";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_tb_values']['labels']['status'] = "Status";
   $HTTP_REFERER = (isset($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : ""; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_tb_values']['seq_dir'] = 0; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_tb_values']['sub_dir'] = array(); 
   $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_tb_values']['where_orig'];
   $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_tb_values']['where_pesq'];
   $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_tb_values']['where_pesq_filtro'];
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['pdfreport_tb_values']['lig_edit']) && $_SESSION['scriptcase']['sc_apl_conf']['pdfreport_tb_values']['lig_edit'] != '')
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_tb_values']['mostra_edit'] = $_SESSION['scriptcase']['sc_apl_conf']['pdfreport_tb_values']['lig_edit'];
   }
   if (!empty($this->nm_grid_sem_reg))
   {
       $this->Pdf_init();
       $this->Pdf->AddPage();
       if ($this->Font_ttf_sr)
       {
           $this->Pdf->SetFont($this->default_font_sr, 'B', 12, $this->def_TTF);
       }
       else
       {
           $this->Pdf->SetFont($this->default_font_sr, 'B', 12);
       }
       $this->Pdf->SetTextColor(0, 0, 0);
       $this->Pdf->Text(10, 10, html_entity_decode($this->nm_grid_sem_reg));
       $this->Pdf->Output($this->Ini->root . $this->Ini->nm_path_pdf, 'F');
       return;
   }
// 
   $Init_Pdf = true;
   $this->SC_seq_register = 0; 
   while (!$this->rs_grid->EOF) 
   {  
      $this->nm_grid_colunas = 0; 
      $nm_quant_linhas = 0;
      $this->Pdf->AddPage();
      $this->Pdf_init();
      $this->Pdf_image();
      while (!$this->rs_grid->EOF && $nm_quant_linhas < $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_tb_values']['qt_col_grid']) 
      {  
          $this->sc_proc_grid = true;
          $this->SC_seq_register++; 
          $this->id[$this->nm_grid_colunas] = $this->rs_grid->fields[0] ;  
          $this->id[$this->nm_grid_colunas] = (string)$this->id[$this->nm_grid_colunas];
          $this->f_manufacturingsetupcost[$this->nm_grid_colunas] = $this->rs_grid->fields[1] ;  
          $this->f_manufacturingsetupcost[$this->nm_grid_colunas] =  str_replace(",", ".", $this->f_manufacturingsetupcost[$this->nm_grid_colunas]);
          $this->f_manufacturingsetupcost[$this->nm_grid_colunas] = (strpos(strtolower($this->f_manufacturingsetupcost[$this->nm_grid_colunas]), "e")) ? (float)$this->f_manufacturingsetupcost[$this->nm_grid_colunas] : $this->f_manufacturingsetupcost[$this->nm_grid_colunas]; 
          $this->f_manufacturingsetupcost[$this->nm_grid_colunas] = (string)$this->f_manufacturingsetupcost[$this->nm_grid_colunas];
          $this->f_manufacturingcostperitem[$this->nm_grid_colunas] = $this->rs_grid->fields[2] ;  
          $this->f_manufacturingcostperitem[$this->nm_grid_colunas] =  str_replace(",", ".", $this->f_manufacturingcostperitem[$this->nm_grid_colunas]);
          $this->f_manufacturingcostperitem[$this->nm_grid_colunas] = (strpos(strtolower($this->f_manufacturingcostperitem[$this->nm_grid_colunas]), "e")) ? (float)$this->f_manufacturingcostperitem[$this->nm_grid_colunas] : $this->f_manufacturingcostperitem[$this->nm_grid_colunas]; 
          $this->f_manufacturingcostperitem[$this->nm_grid_colunas] = (string)$this->f_manufacturingcostperitem[$this->nm_grid_colunas];
          $this->f_holdingcostperitemperday[$this->nm_grid_colunas] = $this->rs_grid->fields[3] ;  
          $this->f_holdingcostperitemperday[$this->nm_grid_colunas] =  str_replace(",", ".", $this->f_holdingcostperitemperday[$this->nm_grid_colunas]);
          $this->f_holdingcostperitemperday[$this->nm_grid_colunas] = (strpos(strtolower($this->f_holdingcostperitemperday[$this->nm_grid_colunas]), "e")) ? (float)$this->f_holdingcostperitemperday[$this->nm_grid_colunas] : $this->f_holdingcostperitemperday[$this->nm_grid_colunas]; 
          $this->f_holdingcostperitemperday[$this->nm_grid_colunas] = (string)$this->f_holdingcostperitemperday[$this->nm_grid_colunas];
          $this->f_shortagecostperitemperday[$this->nm_grid_colunas] = $this->rs_grid->fields[4] ;  
          $this->f_shortagecostperitemperday[$this->nm_grid_colunas] =  str_replace(",", ".", $this->f_shortagecostperitemperday[$this->nm_grid_colunas]);
          $this->f_shortagecostperitemperday[$this->nm_grid_colunas] = (strpos(strtolower($this->f_shortagecostperitemperday[$this->nm_grid_colunas]), "e")) ? (float)$this->f_shortagecostperitemperday[$this->nm_grid_colunas] : $this->f_shortagecostperitemperday[$this->nm_grid_colunas]; 
          $this->f_shortagecostperitemperday[$this->nm_grid_colunas] = (string)$this->f_shortagecostperitemperday[$this->nm_grid_colunas];
          $this->f_bestparamvalue_s[$this->nm_grid_colunas] = $this->rs_grid->fields[5] ;  
          $this->f_bestparamvalue_s[$this->nm_grid_colunas] = (string)$this->f_bestparamvalue_s[$this->nm_grid_colunas];
          $this->f_bestparamvalue__s[$this->nm_grid_colunas] = $this->rs_grid->fields[6] ;  
          $this->f_bestparamvalue__s[$this->nm_grid_colunas] = (string)$this->f_bestparamvalue__s[$this->nm_grid_colunas];
          $this->r_ordersetupcost[$this->nm_grid_colunas] = $this->rs_grid->fields[7] ;  
          $this->r_ordersetupcost[$this->nm_grid_colunas] =  str_replace(",", ".", $this->r_ordersetupcost[$this->nm_grid_colunas]);
          $this->r_ordersetupcost[$this->nm_grid_colunas] = (strpos(strtolower($this->r_ordersetupcost[$this->nm_grid_colunas]), "e")) ? (float)$this->r_ordersetupcost[$this->nm_grid_colunas] : $this->r_ordersetupcost[$this->nm_grid_colunas]; 
          $this->r_ordersetupcost[$this->nm_grid_colunas] = (string)$this->r_ordersetupcost[$this->nm_grid_colunas];
          $this->r_ordercostperitem[$this->nm_grid_colunas] = $this->rs_grid->fields[8] ;  
          $this->r_ordercostperitem[$this->nm_grid_colunas] =  str_replace(",", ".", $this->r_ordercostperitem[$this->nm_grid_colunas]);
          $this->r_ordercostperitem[$this->nm_grid_colunas] = (strpos(strtolower($this->r_ordercostperitem[$this->nm_grid_colunas]), "e")) ? (float)$this->r_ordercostperitem[$this->nm_grid_colunas] : $this->r_ordercostperitem[$this->nm_grid_colunas]; 
          $this->r_ordercostperitem[$this->nm_grid_colunas] = (string)$this->r_ordercostperitem[$this->nm_grid_colunas];
          $this->r_holdingcostperitemperday[$this->nm_grid_colunas] = $this->rs_grid->fields[9] ;  
          $this->r_holdingcostperitemperday[$this->nm_grid_colunas] =  str_replace(",", ".", $this->r_holdingcostperitemperday[$this->nm_grid_colunas]);
          $this->r_holdingcostperitemperday[$this->nm_grid_colunas] = (strpos(strtolower($this->r_holdingcostperitemperday[$this->nm_grid_colunas]), "e")) ? (float)$this->r_holdingcostperitemperday[$this->nm_grid_colunas] : $this->r_holdingcostperitemperday[$this->nm_grid_colunas]; 
          $this->r_holdingcostperitemperday[$this->nm_grid_colunas] = (string)$this->r_holdingcostperitemperday[$this->nm_grid_colunas];
          $this->r_shortagecostperitemperday[$this->nm_grid_colunas] = $this->rs_grid->fields[10] ;  
          $this->r_shortagecostperitemperday[$this->nm_grid_colunas] =  str_replace(",", ".", $this->r_shortagecostperitemperday[$this->nm_grid_colunas]);
          $this->r_shortagecostperitemperday[$this->nm_grid_colunas] = (strpos(strtolower($this->r_shortagecostperitemperday[$this->nm_grid_colunas]), "e")) ? (float)$this->r_shortagecostperitemperday[$this->nm_grid_colunas] : $this->r_shortagecostperitemperday[$this->nm_grid_colunas]; 
          $this->r_shortagecostperitemperday[$this->nm_grid_colunas] = (string)$this->r_shortagecostperitemperday[$this->nm_grid_colunas];
          $this->r_bestparamvalue_s[$this->nm_grid_colunas] = $this->rs_grid->fields[11] ;  
          $this->r_bestparamvalue_s[$this->nm_grid_colunas] = (string)$this->r_bestparamvalue_s[$this->nm_grid_colunas];
          $this->r_bestparamvalue__s[$this->nm_grid_colunas] = $this->rs_grid->fields[12] ;  
          $this->r_bestparamvalue__s[$this->nm_grid_colunas] = (string)$this->r_bestparamvalue__s[$this->nm_grid_colunas];
          $this->w_ordersetupcost[$this->nm_grid_colunas] = $this->rs_grid->fields[13] ;  
          $this->w_ordersetupcost[$this->nm_grid_colunas] =  str_replace(",", ".", $this->w_ordersetupcost[$this->nm_grid_colunas]);
          $this->w_ordersetupcost[$this->nm_grid_colunas] = (strpos(strtolower($this->w_ordersetupcost[$this->nm_grid_colunas]), "e")) ? (float)$this->w_ordersetupcost[$this->nm_grid_colunas] : $this->w_ordersetupcost[$this->nm_grid_colunas]; 
          $this->w_ordersetupcost[$this->nm_grid_colunas] = (string)$this->w_ordersetupcost[$this->nm_grid_colunas];
          $this->w_ordercostperitem[$this->nm_grid_colunas] = $this->rs_grid->fields[14] ;  
          $this->w_ordercostperitem[$this->nm_grid_colunas] =  str_replace(",", ".", $this->w_ordercostperitem[$this->nm_grid_colunas]);
          $this->w_ordercostperitem[$this->nm_grid_colunas] = (strpos(strtolower($this->w_ordercostperitem[$this->nm_grid_colunas]), "e")) ? (float)$this->w_ordercostperitem[$this->nm_grid_colunas] : $this->w_ordercostperitem[$this->nm_grid_colunas]; 
          $this->w_ordercostperitem[$this->nm_grid_colunas] = (string)$this->w_ordercostperitem[$this->nm_grid_colunas];
          $this->w_holdingcostperitemperday[$this->nm_grid_colunas] = $this->rs_grid->fields[15] ;  
          $this->w_holdingcostperitemperday[$this->nm_grid_colunas] =  str_replace(",", ".", $this->w_holdingcostperitemperday[$this->nm_grid_colunas]);
          $this->w_holdingcostperitemperday[$this->nm_grid_colunas] = (strpos(strtolower($this->w_holdingcostperitemperday[$this->nm_grid_colunas]), "e")) ? (float)$this->w_holdingcostperitemperday[$this->nm_grid_colunas] : $this->w_holdingcostperitemperday[$this->nm_grid_colunas]; 
          $this->w_holdingcostperitemperday[$this->nm_grid_colunas] = (string)$this->w_holdingcostperitemperday[$this->nm_grid_colunas];
          $this->w_shortagecostperitemperday[$this->nm_grid_colunas] = $this->rs_grid->fields[16] ;  
          $this->w_shortagecostperitemperday[$this->nm_grid_colunas] =  str_replace(",", ".", $this->w_shortagecostperitemperday[$this->nm_grid_colunas]);
          $this->w_shortagecostperitemperday[$this->nm_grid_colunas] = (strpos(strtolower($this->w_shortagecostperitemperday[$this->nm_grid_colunas]), "e")) ? (float)$this->w_shortagecostperitemperday[$this->nm_grid_colunas] : $this->w_shortagecostperitemperday[$this->nm_grid_colunas]; 
          $this->w_shortagecostperitemperday[$this->nm_grid_colunas] = (string)$this->w_shortagecostperitemperday[$this->nm_grid_colunas];
          $this->w_bestparamvalue_s[$this->nm_grid_colunas] = $this->rs_grid->fields[17] ;  
          $this->w_bestparamvalue_s[$this->nm_grid_colunas] = (string)$this->w_bestparamvalue_s[$this->nm_grid_colunas];
          $this->w_bestparamvalue__s[$this->nm_grid_colunas] = $this->rs_grid->fields[18] ;  
          $this->w_bestparamvalue__s[$this->nm_grid_colunas] = (string)$this->w_bestparamvalue__s[$this->nm_grid_colunas];
          $this->status[$this->nm_grid_colunas] = $this->rs_grid->fields[19] ;  
          $this->status[$this->nm_grid_colunas] = (string)$this->status[$this->nm_grid_colunas];
          $this->id[$this->nm_grid_colunas] = $this->id[$this->nm_grid_colunas];
          if ($this->id[$this->nm_grid_colunas] === "") 
          { 
              $this->id[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->id[$this->nm_grid_colunas], $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
          $this->id[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->id[$this->nm_grid_colunas]);
          $this->f_manufacturingsetupcost[$this->nm_grid_colunas] = $this->f_manufacturingsetupcost[$this->nm_grid_colunas];
          if ($this->f_manufacturingsetupcost[$this->nm_grid_colunas] === "") 
          { 
              $this->f_manufacturingsetupcost[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->f_manufacturingsetupcost[$this->nm_grid_colunas], $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          } 
          $this->f_manufacturingsetupcost[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->f_manufacturingsetupcost[$this->nm_grid_colunas]);
          $this->f_manufacturingcostperitem[$this->nm_grid_colunas] = $this->f_manufacturingcostperitem[$this->nm_grid_colunas];
          if ($this->f_manufacturingcostperitem[$this->nm_grid_colunas] === "") 
          { 
              $this->f_manufacturingcostperitem[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->f_manufacturingcostperitem[$this->nm_grid_colunas], $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          } 
          $this->f_manufacturingcostperitem[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->f_manufacturingcostperitem[$this->nm_grid_colunas]);
          $this->f_holdingcostperitemperday[$this->nm_grid_colunas] = $this->f_holdingcostperitemperday[$this->nm_grid_colunas];
          if ($this->f_holdingcostperitemperday[$this->nm_grid_colunas] === "") 
          { 
              $this->f_holdingcostperitemperday[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->f_holdingcostperitemperday[$this->nm_grid_colunas], $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          } 
          $this->f_holdingcostperitemperday[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->f_holdingcostperitemperday[$this->nm_grid_colunas]);
          $this->f_shortagecostperitemperday[$this->nm_grid_colunas] = $this->f_shortagecostperitemperday[$this->nm_grid_colunas];
          if ($this->f_shortagecostperitemperday[$this->nm_grid_colunas] === "") 
          { 
              $this->f_shortagecostperitemperday[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->f_shortagecostperitemperday[$this->nm_grid_colunas], $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          } 
          $this->f_shortagecostperitemperday[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->f_shortagecostperitemperday[$this->nm_grid_colunas]);
          $this->f_bestparamvalue_s[$this->nm_grid_colunas] = $this->f_bestparamvalue_s[$this->nm_grid_colunas];
          if ($this->f_bestparamvalue_s[$this->nm_grid_colunas] === "") 
          { 
              $this->f_bestparamvalue_s[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->f_bestparamvalue_s[$this->nm_grid_colunas], $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
          $this->f_bestparamvalue_s[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->f_bestparamvalue_s[$this->nm_grid_colunas]);
          $this->f_bestparamvalue__s[$this->nm_grid_colunas] = $this->f_bestparamvalue__s[$this->nm_grid_colunas];
          if ($this->f_bestparamvalue__s[$this->nm_grid_colunas] === "") 
          { 
              $this->f_bestparamvalue__s[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->f_bestparamvalue__s[$this->nm_grid_colunas], $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
          $this->f_bestparamvalue__s[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->f_bestparamvalue__s[$this->nm_grid_colunas]);
          $this->r_ordersetupcost[$this->nm_grid_colunas] = $this->r_ordersetupcost[$this->nm_grid_colunas];
          if ($this->r_ordersetupcost[$this->nm_grid_colunas] === "") 
          { 
              $this->r_ordersetupcost[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->r_ordersetupcost[$this->nm_grid_colunas], $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          } 
          $this->r_ordersetupcost[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->r_ordersetupcost[$this->nm_grid_colunas]);
          $this->r_ordercostperitem[$this->nm_grid_colunas] = $this->r_ordercostperitem[$this->nm_grid_colunas];
          if ($this->r_ordercostperitem[$this->nm_grid_colunas] === "") 
          { 
              $this->r_ordercostperitem[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->r_ordercostperitem[$this->nm_grid_colunas], $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          } 
          $this->r_ordercostperitem[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->r_ordercostperitem[$this->nm_grid_colunas]);
          $this->r_holdingcostperitemperday[$this->nm_grid_colunas] = $this->r_holdingcostperitemperday[$this->nm_grid_colunas];
          if ($this->r_holdingcostperitemperday[$this->nm_grid_colunas] === "") 
          { 
              $this->r_holdingcostperitemperday[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->r_holdingcostperitemperday[$this->nm_grid_colunas], $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          } 
          $this->r_holdingcostperitemperday[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->r_holdingcostperitemperday[$this->nm_grid_colunas]);
          $this->r_shortagecostperitemperday[$this->nm_grid_colunas] = $this->r_shortagecostperitemperday[$this->nm_grid_colunas];
          if ($this->r_shortagecostperitemperday[$this->nm_grid_colunas] === "") 
          { 
              $this->r_shortagecostperitemperday[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->r_shortagecostperitemperday[$this->nm_grid_colunas], $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          } 
          $this->r_shortagecostperitemperday[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->r_shortagecostperitemperday[$this->nm_grid_colunas]);
          $this->r_bestparamvalue_s[$this->nm_grid_colunas] = $this->r_bestparamvalue_s[$this->nm_grid_colunas];
          if ($this->r_bestparamvalue_s[$this->nm_grid_colunas] === "") 
          { 
              $this->r_bestparamvalue_s[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->r_bestparamvalue_s[$this->nm_grid_colunas], $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
          $this->r_bestparamvalue_s[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->r_bestparamvalue_s[$this->nm_grid_colunas]);
          $this->r_bestparamvalue__s[$this->nm_grid_colunas] = $this->r_bestparamvalue__s[$this->nm_grid_colunas];
          if ($this->r_bestparamvalue__s[$this->nm_grid_colunas] === "") 
          { 
              $this->r_bestparamvalue__s[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->r_bestparamvalue__s[$this->nm_grid_colunas], $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
          $this->r_bestparamvalue__s[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->r_bestparamvalue__s[$this->nm_grid_colunas]);
          $this->w_ordersetupcost[$this->nm_grid_colunas] = $this->w_ordersetupcost[$this->nm_grid_colunas];
          if ($this->w_ordersetupcost[$this->nm_grid_colunas] === "") 
          { 
              $this->w_ordersetupcost[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->w_ordersetupcost[$this->nm_grid_colunas], $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          } 
          $this->w_ordersetupcost[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->w_ordersetupcost[$this->nm_grid_colunas]);
          $this->w_ordercostperitem[$this->nm_grid_colunas] = $this->w_ordercostperitem[$this->nm_grid_colunas];
          if ($this->w_ordercostperitem[$this->nm_grid_colunas] === "") 
          { 
              $this->w_ordercostperitem[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->w_ordercostperitem[$this->nm_grid_colunas], $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          } 
          $this->w_ordercostperitem[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->w_ordercostperitem[$this->nm_grid_colunas]);
          $this->w_holdingcostperitemperday[$this->nm_grid_colunas] = $this->w_holdingcostperitemperday[$this->nm_grid_colunas];
          if ($this->w_holdingcostperitemperday[$this->nm_grid_colunas] === "") 
          { 
              $this->w_holdingcostperitemperday[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->w_holdingcostperitemperday[$this->nm_grid_colunas], $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          } 
          $this->w_holdingcostperitemperday[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->w_holdingcostperitemperday[$this->nm_grid_colunas]);
          $this->w_shortagecostperitemperday[$this->nm_grid_colunas] = $this->w_shortagecostperitemperday[$this->nm_grid_colunas];
          if ($this->w_shortagecostperitemperday[$this->nm_grid_colunas] === "") 
          { 
              $this->w_shortagecostperitemperday[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->w_shortagecostperitemperday[$this->nm_grid_colunas], $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          } 
          $this->w_shortagecostperitemperday[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->w_shortagecostperitemperday[$this->nm_grid_colunas]);
          $this->w_bestparamvalue_s[$this->nm_grid_colunas] = $this->w_bestparamvalue_s[$this->nm_grid_colunas];
          if ($this->w_bestparamvalue_s[$this->nm_grid_colunas] === "") 
          { 
              $this->w_bestparamvalue_s[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->w_bestparamvalue_s[$this->nm_grid_colunas], $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
          $this->w_bestparamvalue_s[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->w_bestparamvalue_s[$this->nm_grid_colunas]);
          $this->w_bestparamvalue__s[$this->nm_grid_colunas] = $this->w_bestparamvalue__s[$this->nm_grid_colunas];
          if ($this->w_bestparamvalue__s[$this->nm_grid_colunas] === "") 
          { 
              $this->w_bestparamvalue__s[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->w_bestparamvalue__s[$this->nm_grid_colunas], $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
          $this->w_bestparamvalue__s[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->w_bestparamvalue__s[$this->nm_grid_colunas]);
          $this->status[$this->nm_grid_colunas] = $this->status[$this->nm_grid_colunas];
          if ($this->status[$this->nm_grid_colunas] === "") 
          { 
              $this->status[$this->nm_grid_colunas] = "" ;  
          } 
          $this->status[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->status[$this->nm_grid_colunas]);
            $cell_f_ManufacturingSetupCost = array('posx' => 71, 'posy' => 57, 'data' => $this->f_manufacturingsetupcost[$this->nm_grid_colunas], 'width'      => 0, 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => 12, 'color_r'    => '255', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_f_ManufacturingCostPerItem = array('posx' => 75, 'posy' => 62, 'data' => $this->f_manufacturingcostperitem[$this->nm_grid_colunas], 'width'      => 0, 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => 12, 'color_r'    => '255', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_f_HoldingCostPerItemPerDay = array('posx' => 80, 'posy' => 66, 'data' => $this->f_holdingcostperitemperday[$this->nm_grid_colunas], 'width'      => 0, 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => 12, 'color_r'    => '255', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_f_ShortageCostPerItemPerDay = array('posx' => 80, 'posy' => 71, 'data' => $this->f_shortagecostperitemperday[$this->nm_grid_colunas], 'width'      => 0, 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => 12, 'color_r'    => '255', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_f_BestParamValue_s = array('posx' => 147, 'posy' => 102, 'data' => $this->f_bestparamvalue_s[$this->nm_grid_colunas], 'width'      => 0, 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => 12, 'color_r'    => '255', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_f_BestParamValue__S = array('posx' => 147, 'posy' => 97, 'data' => $this->f_bestparamvalue__s[$this->nm_grid_colunas], 'width'      => 0, 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => 12, 'color_r'    => '255', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_r_OrderSetupCost = array('posx' => 60, 'posy' => 33, 'data' => $this->r_ordersetupcost[$this->nm_grid_colunas], 'width'      => 0, 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => 12, 'color_r'    => '255', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_r_OrderCostPerItem = array('posx' => 64, 'posy' => 38, 'data' => $this->r_ordercostperitem[$this->nm_grid_colunas], 'width'      => 0, 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => 12, 'color_r'    => '255', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_r_HoldingCostPerItemPerDay = array('posx' => 78, 'posy' => 42, 'data' => $this->r_holdingcostperitemperday[$this->nm_grid_colunas], 'width'      => 0, 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => 12, 'color_r'    => '255', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_r_ShortageCostPerItemPerDay = array('posx' => 80, 'posy' => 47, 'data' => $this->r_shortagecostperitemperday[$this->nm_grid_colunas], 'width'      => 0, 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => 12, 'color_r'    => '255', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_r_BestParamValue_s = array('posx' => 96, 'posy' => 102, 'data' => $this->r_bestparamvalue_s[$this->nm_grid_colunas], 'width'      => 0, 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => 12, 'color_r'    => '255', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_r_BestParamValue__S = array('posx' => 96, 'posy' => 97, 'data' => $this->r_bestparamvalue__s[$this->nm_grid_colunas], 'width'      => 0, 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => 12, 'color_r'    => '255', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_w_OrderSetupCost = array('posx' => 140, 'posy' => 32, 'data' => $this->w_ordersetupcost[$this->nm_grid_colunas], 'width'      => 0, 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => 12, 'color_r'    => '255', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_w_OrderCostPerItem = array('posx' => 145, 'posy' => 37, 'data' => $this->w_ordercostperitem[$this->nm_grid_colunas], 'width'      => 0, 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => 12, 'color_r'    => '255', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_w_HoldingCostPerItemPerDay = array('posx' => 159, 'posy' => 41, 'data' => $this->w_holdingcostperitemperday[$this->nm_grid_colunas], 'width'      => 0, 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => 12, 'color_r'    => '255', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_w_ShortageCostPerItemPerDay = array('posx' => 162, 'posy' => 46, 'data' => $this->w_shortagecostperitemperday[$this->nm_grid_colunas], 'width'      => 0, 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => 12, 'color_r'    => '255', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_w_BestParamValue_s = array('posx' => 42, 'posy' => 102, 'data' => $this->w_bestparamvalue_s[$this->nm_grid_colunas], 'width'      => 0, 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => 12, 'color_r'    => '255', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_w_BestParamValue__S = array('posx' => 42, 'posy' => 97, 'data' => $this->w_bestparamvalue__s[$this->nm_grid_colunas], 'width'      => 0, 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => 12, 'color_r'    => '255', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);


            $this->Pdf->SetFont($cell_f_ManufacturingSetupCost['font_type'], $cell_f_ManufacturingSetupCost['font_style'], $cell_f_ManufacturingSetupCost['font_size']);
            $this->Pdf->SetTextColor($cell_f_ManufacturingSetupCost['color_r'], $cell_f_ManufacturingSetupCost['color_g'], $cell_f_ManufacturingSetupCost['color_b']);
            if (!empty($cell_f_ManufacturingSetupCost['posx']) && !empty($cell_f_ManufacturingSetupCost['posy']))
            {
                $this->Pdf->SetXY($cell_f_ManufacturingSetupCost['posx'], $cell_f_ManufacturingSetupCost['posy']);
            }
            elseif (!empty($cell_f_ManufacturingSetupCost['posx']))
            {
                $this->Pdf->SetX($cell_f_ManufacturingSetupCost['posx']);
            }
            elseif (!empty($cell_f_ManufacturingSetupCost['posy']))
            {
                $this->Pdf->SetY($cell_f_ManufacturingSetupCost['posy']);
            }
            $this->Pdf->Cell($cell_f_ManufacturingSetupCost['width'], 0, $cell_f_ManufacturingSetupCost['data'], 0, 0, $cell_f_ManufacturingSetupCost['align']);

            $this->Pdf->SetFont($cell_f_ManufacturingCostPerItem['font_type'], $cell_f_ManufacturingCostPerItem['font_style'], $cell_f_ManufacturingCostPerItem['font_size']);
            $this->Pdf->SetTextColor($cell_f_ManufacturingCostPerItem['color_r'], $cell_f_ManufacturingCostPerItem['color_g'], $cell_f_ManufacturingCostPerItem['color_b']);
            if (!empty($cell_f_ManufacturingCostPerItem['posx']) && !empty($cell_f_ManufacturingCostPerItem['posy']))
            {
                $this->Pdf->SetXY($cell_f_ManufacturingCostPerItem['posx'], $cell_f_ManufacturingCostPerItem['posy']);
            }
            elseif (!empty($cell_f_ManufacturingCostPerItem['posx']))
            {
                $this->Pdf->SetX($cell_f_ManufacturingCostPerItem['posx']);
            }
            elseif (!empty($cell_f_ManufacturingCostPerItem['posy']))
            {
                $this->Pdf->SetY($cell_f_ManufacturingCostPerItem['posy']);
            }
            $this->Pdf->Cell($cell_f_ManufacturingCostPerItem['width'], 0, $cell_f_ManufacturingCostPerItem['data'], 0, 0, $cell_f_ManufacturingCostPerItem['align']);

            $this->Pdf->SetFont($cell_f_HoldingCostPerItemPerDay['font_type'], $cell_f_HoldingCostPerItemPerDay['font_style'], $cell_f_HoldingCostPerItemPerDay['font_size']);
            $this->Pdf->SetTextColor($cell_f_HoldingCostPerItemPerDay['color_r'], $cell_f_HoldingCostPerItemPerDay['color_g'], $cell_f_HoldingCostPerItemPerDay['color_b']);
            if (!empty($cell_f_HoldingCostPerItemPerDay['posx']) && !empty($cell_f_HoldingCostPerItemPerDay['posy']))
            {
                $this->Pdf->SetXY($cell_f_HoldingCostPerItemPerDay['posx'], $cell_f_HoldingCostPerItemPerDay['posy']);
            }
            elseif (!empty($cell_f_HoldingCostPerItemPerDay['posx']))
            {
                $this->Pdf->SetX($cell_f_HoldingCostPerItemPerDay['posx']);
            }
            elseif (!empty($cell_f_HoldingCostPerItemPerDay['posy']))
            {
                $this->Pdf->SetY($cell_f_HoldingCostPerItemPerDay['posy']);
            }
            $this->Pdf->Cell($cell_f_HoldingCostPerItemPerDay['width'], 0, $cell_f_HoldingCostPerItemPerDay['data'], 0, 0, $cell_f_HoldingCostPerItemPerDay['align']);

            $this->Pdf->SetFont($cell_f_ShortageCostPerItemPerDay['font_type'], $cell_f_ShortageCostPerItemPerDay['font_style'], $cell_f_ShortageCostPerItemPerDay['font_size']);
            $this->Pdf->SetTextColor($cell_f_ShortageCostPerItemPerDay['color_r'], $cell_f_ShortageCostPerItemPerDay['color_g'], $cell_f_ShortageCostPerItemPerDay['color_b']);
            if (!empty($cell_f_ShortageCostPerItemPerDay['posx']) && !empty($cell_f_ShortageCostPerItemPerDay['posy']))
            {
                $this->Pdf->SetXY($cell_f_ShortageCostPerItemPerDay['posx'], $cell_f_ShortageCostPerItemPerDay['posy']);
            }
            elseif (!empty($cell_f_ShortageCostPerItemPerDay['posx']))
            {
                $this->Pdf->SetX($cell_f_ShortageCostPerItemPerDay['posx']);
            }
            elseif (!empty($cell_f_ShortageCostPerItemPerDay['posy']))
            {
                $this->Pdf->SetY($cell_f_ShortageCostPerItemPerDay['posy']);
            }
            $this->Pdf->Cell($cell_f_ShortageCostPerItemPerDay['width'], 0, $cell_f_ShortageCostPerItemPerDay['data'], 0, 0, $cell_f_ShortageCostPerItemPerDay['align']);

            $this->Pdf->SetFont($cell_f_BestParamValue_s['font_type'], $cell_f_BestParamValue_s['font_style'], $cell_f_BestParamValue_s['font_size']);
            $this->Pdf->SetTextColor($cell_f_BestParamValue_s['color_r'], $cell_f_BestParamValue_s['color_g'], $cell_f_BestParamValue_s['color_b']);
            if (!empty($cell_f_BestParamValue_s['posx']) && !empty($cell_f_BestParamValue_s['posy']))
            {
                $this->Pdf->SetXY($cell_f_BestParamValue_s['posx'], $cell_f_BestParamValue_s['posy']);
            }
            elseif (!empty($cell_f_BestParamValue_s['posx']))
            {
                $this->Pdf->SetX($cell_f_BestParamValue_s['posx']);
            }
            elseif (!empty($cell_f_BestParamValue_s['posy']))
            {
                $this->Pdf->SetY($cell_f_BestParamValue_s['posy']);
            }
            $this->Pdf->Cell($cell_f_BestParamValue_s['width'], 0, $cell_f_BestParamValue_s['data'], 0, 0, $cell_f_BestParamValue_s['align']);

            $this->Pdf->SetFont($cell_f_BestParamValue__S['font_type'], $cell_f_BestParamValue__S['font_style'], $cell_f_BestParamValue__S['font_size']);
            $this->Pdf->SetTextColor($cell_f_BestParamValue__S['color_r'], $cell_f_BestParamValue__S['color_g'], $cell_f_BestParamValue__S['color_b']);
            if (!empty($cell_f_BestParamValue__S['posx']) && !empty($cell_f_BestParamValue__S['posy']))
            {
                $this->Pdf->SetXY($cell_f_BestParamValue__S['posx'], $cell_f_BestParamValue__S['posy']);
            }
            elseif (!empty($cell_f_BestParamValue__S['posx']))
            {
                $this->Pdf->SetX($cell_f_BestParamValue__S['posx']);
            }
            elseif (!empty($cell_f_BestParamValue__S['posy']))
            {
                $this->Pdf->SetY($cell_f_BestParamValue__S['posy']);
            }
            $this->Pdf->Cell($cell_f_BestParamValue__S['width'], 0, $cell_f_BestParamValue__S['data'], 0, 0, $cell_f_BestParamValue__S['align']);

            $this->Pdf->SetFont($cell_r_OrderSetupCost['font_type'], $cell_r_OrderSetupCost['font_style'], $cell_r_OrderSetupCost['font_size']);
            $this->Pdf->SetTextColor($cell_r_OrderSetupCost['color_r'], $cell_r_OrderSetupCost['color_g'], $cell_r_OrderSetupCost['color_b']);
            if (!empty($cell_r_OrderSetupCost['posx']) && !empty($cell_r_OrderSetupCost['posy']))
            {
                $this->Pdf->SetXY($cell_r_OrderSetupCost['posx'], $cell_r_OrderSetupCost['posy']);
            }
            elseif (!empty($cell_r_OrderSetupCost['posx']))
            {
                $this->Pdf->SetX($cell_r_OrderSetupCost['posx']);
            }
            elseif (!empty($cell_r_OrderSetupCost['posy']))
            {
                $this->Pdf->SetY($cell_r_OrderSetupCost['posy']);
            }
            $this->Pdf->Cell($cell_r_OrderSetupCost['width'], 0, $cell_r_OrderSetupCost['data'], 0, 0, $cell_r_OrderSetupCost['align']);

            $this->Pdf->SetFont($cell_r_OrderCostPerItem['font_type'], $cell_r_OrderCostPerItem['font_style'], $cell_r_OrderCostPerItem['font_size']);
            $this->Pdf->SetTextColor($cell_r_OrderCostPerItem['color_r'], $cell_r_OrderCostPerItem['color_g'], $cell_r_OrderCostPerItem['color_b']);
            if (!empty($cell_r_OrderCostPerItem['posx']) && !empty($cell_r_OrderCostPerItem['posy']))
            {
                $this->Pdf->SetXY($cell_r_OrderCostPerItem['posx'], $cell_r_OrderCostPerItem['posy']);
            }
            elseif (!empty($cell_r_OrderCostPerItem['posx']))
            {
                $this->Pdf->SetX($cell_r_OrderCostPerItem['posx']);
            }
            elseif (!empty($cell_r_OrderCostPerItem['posy']))
            {
                $this->Pdf->SetY($cell_r_OrderCostPerItem['posy']);
            }
            $this->Pdf->Cell($cell_r_OrderCostPerItem['width'], 0, $cell_r_OrderCostPerItem['data'], 0, 0, $cell_r_OrderCostPerItem['align']);

            $this->Pdf->SetFont($cell_r_HoldingCostPerItemPerDay['font_type'], $cell_r_HoldingCostPerItemPerDay['font_style'], $cell_r_HoldingCostPerItemPerDay['font_size']);
            $this->Pdf->SetTextColor($cell_r_HoldingCostPerItemPerDay['color_r'], $cell_r_HoldingCostPerItemPerDay['color_g'], $cell_r_HoldingCostPerItemPerDay['color_b']);
            if (!empty($cell_r_HoldingCostPerItemPerDay['posx']) && !empty($cell_r_HoldingCostPerItemPerDay['posy']))
            {
                $this->Pdf->SetXY($cell_r_HoldingCostPerItemPerDay['posx'], $cell_r_HoldingCostPerItemPerDay['posy']);
            }
            elseif (!empty($cell_r_HoldingCostPerItemPerDay['posx']))
            {
                $this->Pdf->SetX($cell_r_HoldingCostPerItemPerDay['posx']);
            }
            elseif (!empty($cell_r_HoldingCostPerItemPerDay['posy']))
            {
                $this->Pdf->SetY($cell_r_HoldingCostPerItemPerDay['posy']);
            }
            $this->Pdf->Cell($cell_r_HoldingCostPerItemPerDay['width'], 0, $cell_r_HoldingCostPerItemPerDay['data'], 0, 0, $cell_r_HoldingCostPerItemPerDay['align']);

            $this->Pdf->SetFont($cell_r_ShortageCostPerItemPerDay['font_type'], $cell_r_ShortageCostPerItemPerDay['font_style'], $cell_r_ShortageCostPerItemPerDay['font_size']);
            $this->Pdf->SetTextColor($cell_r_ShortageCostPerItemPerDay['color_r'], $cell_r_ShortageCostPerItemPerDay['color_g'], $cell_r_ShortageCostPerItemPerDay['color_b']);
            if (!empty($cell_r_ShortageCostPerItemPerDay['posx']) && !empty($cell_r_ShortageCostPerItemPerDay['posy']))
            {
                $this->Pdf->SetXY($cell_r_ShortageCostPerItemPerDay['posx'], $cell_r_ShortageCostPerItemPerDay['posy']);
            }
            elseif (!empty($cell_r_ShortageCostPerItemPerDay['posx']))
            {
                $this->Pdf->SetX($cell_r_ShortageCostPerItemPerDay['posx']);
            }
            elseif (!empty($cell_r_ShortageCostPerItemPerDay['posy']))
            {
                $this->Pdf->SetY($cell_r_ShortageCostPerItemPerDay['posy']);
            }
            $this->Pdf->Cell($cell_r_ShortageCostPerItemPerDay['width'], 0, $cell_r_ShortageCostPerItemPerDay['data'], 0, 0, $cell_r_ShortageCostPerItemPerDay['align']);

            $this->Pdf->SetFont($cell_r_BestParamValue_s['font_type'], $cell_r_BestParamValue_s['font_style'], $cell_r_BestParamValue_s['font_size']);
            $this->Pdf->SetTextColor($cell_r_BestParamValue_s['color_r'], $cell_r_BestParamValue_s['color_g'], $cell_r_BestParamValue_s['color_b']);
            if (!empty($cell_r_BestParamValue_s['posx']) && !empty($cell_r_BestParamValue_s['posy']))
            {
                $this->Pdf->SetXY($cell_r_BestParamValue_s['posx'], $cell_r_BestParamValue_s['posy']);
            }
            elseif (!empty($cell_r_BestParamValue_s['posx']))
            {
                $this->Pdf->SetX($cell_r_BestParamValue_s['posx']);
            }
            elseif (!empty($cell_r_BestParamValue_s['posy']))
            {
                $this->Pdf->SetY($cell_r_BestParamValue_s['posy']);
            }
            $this->Pdf->Cell($cell_r_BestParamValue_s['width'], 0, $cell_r_BestParamValue_s['data'], 0, 0, $cell_r_BestParamValue_s['align']);

            $this->Pdf->SetFont($cell_r_BestParamValue__S['font_type'], $cell_r_BestParamValue__S['font_style'], $cell_r_BestParamValue__S['font_size']);
            $this->Pdf->SetTextColor($cell_r_BestParamValue__S['color_r'], $cell_r_BestParamValue__S['color_g'], $cell_r_BestParamValue__S['color_b']);
            if (!empty($cell_r_BestParamValue__S['posx']) && !empty($cell_r_BestParamValue__S['posy']))
            {
                $this->Pdf->SetXY($cell_r_BestParamValue__S['posx'], $cell_r_BestParamValue__S['posy']);
            }
            elseif (!empty($cell_r_BestParamValue__S['posx']))
            {
                $this->Pdf->SetX($cell_r_BestParamValue__S['posx']);
            }
            elseif (!empty($cell_r_BestParamValue__S['posy']))
            {
                $this->Pdf->SetY($cell_r_BestParamValue__S['posy']);
            }
            $this->Pdf->Cell($cell_r_BestParamValue__S['width'], 0, $cell_r_BestParamValue__S['data'], 0, 0, $cell_r_BestParamValue__S['align']);

            $this->Pdf->SetFont($cell_w_OrderSetupCost['font_type'], $cell_w_OrderSetupCost['font_style'], $cell_w_OrderSetupCost['font_size']);
            $this->Pdf->SetTextColor($cell_w_OrderSetupCost['color_r'], $cell_w_OrderSetupCost['color_g'], $cell_w_OrderSetupCost['color_b']);
            if (!empty($cell_w_OrderSetupCost['posx']) && !empty($cell_w_OrderSetupCost['posy']))
            {
                $this->Pdf->SetXY($cell_w_OrderSetupCost['posx'], $cell_w_OrderSetupCost['posy']);
            }
            elseif (!empty($cell_w_OrderSetupCost['posx']))
            {
                $this->Pdf->SetX($cell_w_OrderSetupCost['posx']);
            }
            elseif (!empty($cell_w_OrderSetupCost['posy']))
            {
                $this->Pdf->SetY($cell_w_OrderSetupCost['posy']);
            }
            $this->Pdf->Cell($cell_w_OrderSetupCost['width'], 0, $cell_w_OrderSetupCost['data'], 0, 0, $cell_w_OrderSetupCost['align']);

            $this->Pdf->SetFont($cell_w_OrderCostPerItem['font_type'], $cell_w_OrderCostPerItem['font_style'], $cell_w_OrderCostPerItem['font_size']);
            $this->Pdf->SetTextColor($cell_w_OrderCostPerItem['color_r'], $cell_w_OrderCostPerItem['color_g'], $cell_w_OrderCostPerItem['color_b']);
            if (!empty($cell_w_OrderCostPerItem['posx']) && !empty($cell_w_OrderCostPerItem['posy']))
            {
                $this->Pdf->SetXY($cell_w_OrderCostPerItem['posx'], $cell_w_OrderCostPerItem['posy']);
            }
            elseif (!empty($cell_w_OrderCostPerItem['posx']))
            {
                $this->Pdf->SetX($cell_w_OrderCostPerItem['posx']);
            }
            elseif (!empty($cell_w_OrderCostPerItem['posy']))
            {
                $this->Pdf->SetY($cell_w_OrderCostPerItem['posy']);
            }
            $this->Pdf->Cell($cell_w_OrderCostPerItem['width'], 0, $cell_w_OrderCostPerItem['data'], 0, 0, $cell_w_OrderCostPerItem['align']);

            $this->Pdf->SetFont($cell_w_HoldingCostPerItemPerDay['font_type'], $cell_w_HoldingCostPerItemPerDay['font_style'], $cell_w_HoldingCostPerItemPerDay['font_size']);
            $this->Pdf->SetTextColor($cell_w_HoldingCostPerItemPerDay['color_r'], $cell_w_HoldingCostPerItemPerDay['color_g'], $cell_w_HoldingCostPerItemPerDay['color_b']);
            if (!empty($cell_w_HoldingCostPerItemPerDay['posx']) && !empty($cell_w_HoldingCostPerItemPerDay['posy']))
            {
                $this->Pdf->SetXY($cell_w_HoldingCostPerItemPerDay['posx'], $cell_w_HoldingCostPerItemPerDay['posy']);
            }
            elseif (!empty($cell_w_HoldingCostPerItemPerDay['posx']))
            {
                $this->Pdf->SetX($cell_w_HoldingCostPerItemPerDay['posx']);
            }
            elseif (!empty($cell_w_HoldingCostPerItemPerDay['posy']))
            {
                $this->Pdf->SetY($cell_w_HoldingCostPerItemPerDay['posy']);
            }
            $this->Pdf->Cell($cell_w_HoldingCostPerItemPerDay['width'], 0, $cell_w_HoldingCostPerItemPerDay['data'], 0, 0, $cell_w_HoldingCostPerItemPerDay['align']);

            $this->Pdf->SetFont($cell_w_ShortageCostPerItemPerDay['font_type'], $cell_w_ShortageCostPerItemPerDay['font_style'], $cell_w_ShortageCostPerItemPerDay['font_size']);
            $this->Pdf->SetTextColor($cell_w_ShortageCostPerItemPerDay['color_r'], $cell_w_ShortageCostPerItemPerDay['color_g'], $cell_w_ShortageCostPerItemPerDay['color_b']);
            if (!empty($cell_w_ShortageCostPerItemPerDay['posx']) && !empty($cell_w_ShortageCostPerItemPerDay['posy']))
            {
                $this->Pdf->SetXY($cell_w_ShortageCostPerItemPerDay['posx'], $cell_w_ShortageCostPerItemPerDay['posy']);
            }
            elseif (!empty($cell_w_ShortageCostPerItemPerDay['posx']))
            {
                $this->Pdf->SetX($cell_w_ShortageCostPerItemPerDay['posx']);
            }
            elseif (!empty($cell_w_ShortageCostPerItemPerDay['posy']))
            {
                $this->Pdf->SetY($cell_w_ShortageCostPerItemPerDay['posy']);
            }
            $this->Pdf->Cell($cell_w_ShortageCostPerItemPerDay['width'], 0, $cell_w_ShortageCostPerItemPerDay['data'], 0, 0, $cell_w_ShortageCostPerItemPerDay['align']);

            $this->Pdf->SetFont($cell_w_BestParamValue_s['font_type'], $cell_w_BestParamValue_s['font_style'], $cell_w_BestParamValue_s['font_size']);
            $this->Pdf->SetTextColor($cell_w_BestParamValue_s['color_r'], $cell_w_BestParamValue_s['color_g'], $cell_w_BestParamValue_s['color_b']);
            if (!empty($cell_w_BestParamValue_s['posx']) && !empty($cell_w_BestParamValue_s['posy']))
            {
                $this->Pdf->SetXY($cell_w_BestParamValue_s['posx'], $cell_w_BestParamValue_s['posy']);
            }
            elseif (!empty($cell_w_BestParamValue_s['posx']))
            {
                $this->Pdf->SetX($cell_w_BestParamValue_s['posx']);
            }
            elseif (!empty($cell_w_BestParamValue_s['posy']))
            {
                $this->Pdf->SetY($cell_w_BestParamValue_s['posy']);
            }
            $this->Pdf->Cell($cell_w_BestParamValue_s['width'], 0, $cell_w_BestParamValue_s['data'], 0, 0, $cell_w_BestParamValue_s['align']);

            $this->Pdf->SetFont($cell_w_BestParamValue__S['font_type'], $cell_w_BestParamValue__S['font_style'], $cell_w_BestParamValue__S['font_size']);
            $this->Pdf->SetTextColor($cell_w_BestParamValue__S['color_r'], $cell_w_BestParamValue__S['color_g'], $cell_w_BestParamValue__S['color_b']);
            if (!empty($cell_w_BestParamValue__S['posx']) && !empty($cell_w_BestParamValue__S['posy']))
            {
                $this->Pdf->SetXY($cell_w_BestParamValue__S['posx'], $cell_w_BestParamValue__S['posy']);
            }
            elseif (!empty($cell_w_BestParamValue__S['posx']))
            {
                $this->Pdf->SetX($cell_w_BestParamValue__S['posx']);
            }
            elseif (!empty($cell_w_BestParamValue__S['posy']))
            {
                $this->Pdf->SetY($cell_w_BestParamValue__S['posy']);
            }
            $this->Pdf->Cell($cell_w_BestParamValue__S['width'], 0, $cell_w_BestParamValue__S['data'], 0, 0, $cell_w_BestParamValue__S['align']);

          $max_Y = 0;
          $this->rs_grid->MoveNext();
          $this->sc_proc_grid = false;
          $nm_quant_linhas++ ;
      }  
   }  
   $this->rs_grid->Close();
   $this->Pdf->Output($this->Ini->root . $this->Ini->nm_path_pdf, 'F');
 }
 function SC_conv_utf8($input)
 {
     if ($_SESSION['scriptcase']['charset'] != "UTF-8" && !NM_is_utf8($input))
     {
         $input = mb_convert_encoding($input, "UTF-8", $_SESSION['scriptcase']['charset']);
     }
     return $input;
 }
   function nm_conv_data_db($dt_in, $form_in, $form_out)
   {
       $dt_out = $dt_in;
       if (strtoupper($form_in) == "DB_FORMAT")
       {
           if ($dt_out == "null" || $dt_out == "")
           {
               $dt_out = "";
               return $dt_out;
           }
           $form_in = "AAAA-MM-DD";
       }
       if (strtoupper($form_out) == "DB_FORMAT")
       {
           if (empty($dt_out))
           {
               $dt_out = "null";
               return $dt_out;
           }
           $form_out = "AAAA-MM-DD";
       }
       nm_conv_form_data($dt_out, $form_in, $form_out);
       return $dt_out;
   }
   function nm_gera_mask(&$nm_campo, $nm_mask)
   { 
      $trab_campo = $nm_campo;
      $trab_mask  = $nm_mask;
      $tam_campo  = strlen($nm_campo);
      $trab_saida = "";
      $mask_num = false;
      for ($x=0; $x < strlen($trab_mask); $x++)
      {
          if (substr($trab_mask, $x, 1) == "#")
          {
              $mask_num = true;
              break;
          }
      }
      if ($mask_num )
      {
          $ver_duas = explode(";", $trab_mask);
          if (isset($ver_duas[1]) && !empty($ver_duas[1]))
          {
              $cont1 = count(explode("#", $ver_duas[0])) - 1;
              $cont2 = count(explode("#", $ver_duas[1])) - 1;
              if ($cont2 >= $tam_campo)
              {
                  $trab_mask = $ver_duas[1];
              }
              else
              {
                  $trab_mask = $ver_duas[0];
              }
          }
          $tam_mask = strlen($trab_mask);
          $xdados = 0;
          for ($x=0; $x < $tam_mask; $x++)
          {
              if (substr($trab_mask, $x, 1) == "#" && $xdados < $tam_campo)
              {
                  $trab_saida .= substr($trab_campo, $xdados, 1);
                  $xdados++;
              }
              elseif ($xdados < $tam_campo)
              {
                  $trab_saida .= substr($trab_mask, $x, 1);
              }
          }
          if ($xdados < $tam_campo)
          {
              $trab_saida .= substr($trab_campo, $xdados);
          }
          $nm_campo = $trab_saida;
          return;
      }
      for ($ix = strlen($trab_mask); $ix > 0; $ix--)
      {
           $char_mask = substr($trab_mask, $ix - 1, 1);
           if ($char_mask != "x" && $char_mask != "z")
           {
               $trab_saida = $char_mask . $trab_saida;
           }
           else
           {
               if ($tam_campo != 0)
               {
                   $trab_saida = substr($trab_campo, $tam_campo - 1, 1) . $trab_saida;
                   $tam_campo--;
               }
               else
               {
                   $trab_saida = "0" . $trab_saida;
               }
           }
      }
      if ($tam_campo != 0)
      {
          $trab_saida = substr($trab_campo, 0, $tam_campo) . $trab_saida;
          $trab_mask  = str_repeat("z", $tam_campo) . $trab_mask;
      }
   
      $iz = 0; 
      for ($ix = 0; $ix < strlen($trab_mask); $ix++)
      {
           $char_mask = substr($trab_mask, $ix, 1);
           if ($char_mask != "x" && $char_mask != "z")
           {
               if ($char_mask == "." || $char_mask == ",")
               {
                   $trab_saida = substr($trab_saida, 0, $iz) . substr($trab_saida, $iz + 1);
               }
               else
               {
                   $iz++;
               }
           }
           elseif ($char_mask == "x" || substr($trab_saida, $iz, 1) != "0")
           {
               $ix = strlen($trab_mask) + 1;
           }
           else
           {
               $trab_saida = substr($trab_saida, 0, $iz) . substr($trab_saida, $iz + 1);
           }
      }
      $nm_campo = $trab_saida;
   } 
}
?>
