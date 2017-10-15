<?php
class pdfreport_factory_grid
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
   var $manufacturingsetupcost = array();
   var $manufacturingcostperitem = array();
   var $holdingcostperitemperday = array();
   var $shortagecostperitemperday = array();
   var $bestparamvalue_s = array();
   var $bestparamvalue__s = array();
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
   $this->default_font = '';
   $this->default_font_sr  = '';
   $this->default_style    = '';
   $this->default_style_sr = 'B';
   $Tp_papel = "LETTER";
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
           if (in_array("pdfreport_factory", $apls_aba))
           {
               $this->aba_iframe = true;
               break;
           }
       }
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_factory']['iframe_menu'] && (!isset($_SESSION['scriptcase']['menu_mobile']) || empty($_SESSION['scriptcase']['menu_mobile'])))
   {
       $this->aba_iframe = true;
   }
   $this->nmgp_botoes['exit'] = "on";
   $this->sc_proc_grid = false; 
   $this->NM_raiz_img = $this->Ini->root;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
   $this->nm_where_dinamico = "";
   $this->nm_grid_colunas = 0;
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_factory']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_factory']['campos_busca']))
   { 
       $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_factory']['campos_busca'];
       if ($_SESSION['scriptcase']['charset'] != "UTF-8")
       {
           $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
       }
       $this->id[0] = $Busca_temp['id']; 
       $tmp_pos = strpos($this->id[0], "##@@");
       if ($tmp_pos !== false)
       {
           $this->id[0] = substr($this->id[0], 0, $tmp_pos);
       }
       $id_2 = $Busca_temp['id_input_2']; 
       $this->id_2 = $Busca_temp['id_input_2']; 
       $this->manufacturingsetupcost[0] = $Busca_temp['manufacturingsetupcost']; 
       $tmp_pos = strpos($this->manufacturingsetupcost[0], "##@@");
       if ($tmp_pos !== false)
       {
           $this->manufacturingsetupcost[0] = substr($this->manufacturingsetupcost[0], 0, $tmp_pos);
       }
       $manufacturingsetupcost_2 = $Busca_temp['manufacturingsetupcost_input_2']; 
       $this->manufacturingsetupcost_2 = $Busca_temp['manufacturingsetupcost_input_2']; 
       $this->manufacturingcostperitem[0] = $Busca_temp['manufacturingcostperitem']; 
       $tmp_pos = strpos($this->manufacturingcostperitem[0], "##@@");
       if ($tmp_pos !== false)
       {
           $this->manufacturingcostperitem[0] = substr($this->manufacturingcostperitem[0], 0, $tmp_pos);
       }
       $manufacturingcostperitem_2 = $Busca_temp['manufacturingcostperitem_input_2']; 
       $this->manufacturingcostperitem_2 = $Busca_temp['manufacturingcostperitem_input_2']; 
       $this->holdingcostperitemperday[0] = $Busca_temp['holdingcostperitemperday']; 
       $tmp_pos = strpos($this->holdingcostperitemperday[0], "##@@");
       if ($tmp_pos !== false)
       {
           $this->holdingcostperitemperday[0] = substr($this->holdingcostperitemperday[0], 0, $tmp_pos);
       }
       $holdingcostperitemperday_2 = $Busca_temp['holdingcostperitemperday_input_2']; 
       $this->holdingcostperitemperday_2 = $Busca_temp['holdingcostperitemperday_input_2']; 
       $this->status[0] = $Busca_temp['status']; 
       $tmp_pos = strpos($this->status[0], "##@@");
       if ($tmp_pos !== false)
       {
           $this->status[0] = substr($this->status[0], 0, $tmp_pos);
       }
   } 
   $this->nm_field_dinamico = array();
   $this->nm_order_dinamico = array();
   $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_factory']['where_orig'];
   $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_factory']['where_pesq'];
   $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_factory']['where_pesq_filtro'];
   $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
   $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
   $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
   $_SESSION['scriptcase']['contr_link_emb'] = $this->nm_location;
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_factory']['qt_col_grid'] = 1 ;  
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['pdfreport_factory']['cols']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['pdfreport_factory']['cols']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_factory']['qt_col_grid'] = $_SESSION['scriptcase']['sc_apl_conf']['pdfreport_factory']['cols'];  
       unset($_SESSION['scriptcase']['sc_apl_conf']['pdfreport_factory']['cols']);
   }
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_factory']['ordem_select']))  
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_factory']['ordem_select'] = array(); 
   } 
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_factory']['ordem_quebra']))  
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_factory']['ordem_grid'] = "" ; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_factory']['ordem_ant']  = ""; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_factory']['ordem_desc'] = "" ; 
   }   
   if (!empty($nmgp_parms) && $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_factory']['opcao'] != "pdf")   
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_factory']['opcao'] = "igual";
       $rec = "ini";
   }
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_factory']['where_orig']) || $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_factory']['prim_cons'] || !empty($nmgp_parms))  
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_factory']['prim_cons'] = false;  
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_factory']['where_orig'] = "";  
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_factory']['where_pesq']        = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_factory']['where_orig'];  
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_factory']['where_pesq_ant']    = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_factory']['where_orig'];  
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_factory']['cond_pesq']         = ""; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_factory']['where_pesq_filtro'] = "";
   }   
   if  (!empty($this->nm_where_dinamico)) 
   {   
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_factory']['where_pesq'] .= $this->nm_where_dinamico;
   }   
   $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_factory']['where_orig'];
   $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_factory']['where_pesq'];
   $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_factory']['where_pesq_filtro'];
//
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_factory']['tot_geral'][1])) 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_factory']['total'] = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_factory']['tot_geral'][1] ;  
   }
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_factory']['where_pesq_ant'] = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_factory']['where_pesq'];  
//----- 
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
   { 
       $nmgp_select = "SELECT id, ManufacturingSetupCost, ManufacturingCostPerItem, HoldingCostPerItemPerDay, ShortageCostPerItemPerDay, BestParamValue_s, BestParamValue__S, Status from " . $this->Ini->nm_tabela; 
   } 
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
   { 
       $nmgp_select = "SELECT id, ManufacturingSetupCost, ManufacturingCostPerItem, HoldingCostPerItemPerDay, ShortageCostPerItemPerDay, BestParamValue_s, BestParamValue__S, Status from " . $this->Ini->nm_tabela; 
   } 
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
   { 
       $nmgp_select = "SELECT id, ManufacturingSetupCost, ManufacturingCostPerItem, HoldingCostPerItemPerDay, ShortageCostPerItemPerDay, BestParamValue_s, BestParamValue__S, Status from " . $this->Ini->nm_tabela; 
   } 
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
   { 
       $nmgp_select = "SELECT id, ManufacturingSetupCost, ManufacturingCostPerItem, HoldingCostPerItemPerDay, ShortageCostPerItemPerDay, BestParamValue_s, BestParamValue__S, Status from " . $this->Ini->nm_tabela; 
   } 
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
   { 
       $nmgp_select = "SELECT id, ManufacturingSetupCost, ManufacturingCostPerItem, HoldingCostPerItemPerDay, ShortageCostPerItemPerDay, BestParamValue_s, BestParamValue__S, Status from " . $this->Ini->nm_tabela; 
   } 
   else 
   { 
       $nmgp_select = "SELECT id, ManufacturingSetupCost, ManufacturingCostPerItem, HoldingCostPerItemPerDay, ShortageCostPerItemPerDay, BestParamValue_s, BestParamValue__S, Status from " . $this->Ini->nm_tabela; 
   } 
   $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_factory']['where_pesq']; 
   $nmgp_order_by = ""; 
   $campos_order_select = "";
   foreach($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_factory']['ordem_select'] as $campo => $ordem) 
   {
        if ($campo != $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_factory']['ordem_grid']) 
        {
           if (!empty($campos_order_select)) 
           {
               $campos_order_select .= ", ";
           }
           $campos_order_select .= $campo . " " . $ordem;
        }
   }
   if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_factory']['ordem_grid'])) 
   { 
       $nmgp_order_by = " order by " . $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_factory']['ordem_grid'] . $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_factory']['ordem_desc']; 
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
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_factory']['order_grid'] = $nmgp_order_by;
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
     $this->Pdf->SetTextColor(0, 0, 0);
 }
// 
//----- 
 function grid($linhas = 0)
 {
    global 
           $nm_saida, $nm_url_saida;
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_factory']['labels']['id'] = "Id";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_factory']['labels']['manufacturingsetupcost'] = "Manufacturing Setup Cost";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_factory']['labels']['manufacturingcostperitem'] = "Manufacturing Cost Per Item";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_factory']['labels']['holdingcostperitemperday'] = "Holding Cost Per Item Per Day";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_factory']['labels']['shortagecostperitemperday'] = "Shortage Cost Per Item Per Day";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_factory']['labels']['bestparamvalue_s'] = "Best Param Value S";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_factory']['labels']['bestparamvalue__s'] = "Best Param Value S";
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_factory']['labels']['status'] = "Status";
   $HTTP_REFERER = (isset($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : ""; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_factory']['seq_dir'] = 0; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_factory']['sub_dir'] = array(); 
   $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_factory']['where_orig'];
   $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_factory']['where_pesq'];
   $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_factory']['where_pesq_filtro'];
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['pdfreport_factory']['lig_edit']) && $_SESSION['scriptcase']['sc_apl_conf']['pdfreport_factory']['lig_edit'] != '')
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_factory']['mostra_edit'] = $_SESSION['scriptcase']['sc_apl_conf']['pdfreport_factory']['lig_edit'];
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
      while (!$this->rs_grid->EOF && $nm_quant_linhas < $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_factory']['qt_col_grid']) 
      {  
          $this->sc_proc_grid = true;
          $this->SC_seq_register++; 
          $this->id[$this->nm_grid_colunas] = $this->rs_grid->fields[0] ;  
          $this->id[$this->nm_grid_colunas] = (string)$this->id[$this->nm_grid_colunas];
          $this->manufacturingsetupcost[$this->nm_grid_colunas] = $this->rs_grid->fields[1] ;  
          $this->manufacturingsetupcost[$this->nm_grid_colunas] =  str_replace(",", ".", $this->manufacturingsetupcost[$this->nm_grid_colunas]);
          $this->manufacturingsetupcost[$this->nm_grid_colunas] = (strpos(strtolower($this->manufacturingsetupcost[$this->nm_grid_colunas]), "e")) ? (float)$this->manufacturingsetupcost[$this->nm_grid_colunas] : $this->manufacturingsetupcost[$this->nm_grid_colunas]; 
          $this->manufacturingsetupcost[$this->nm_grid_colunas] = (string)$this->manufacturingsetupcost[$this->nm_grid_colunas];
          $this->manufacturingcostperitem[$this->nm_grid_colunas] = $this->rs_grid->fields[2] ;  
          $this->manufacturingcostperitem[$this->nm_grid_colunas] =  str_replace(",", ".", $this->manufacturingcostperitem[$this->nm_grid_colunas]);
          $this->manufacturingcostperitem[$this->nm_grid_colunas] = (strpos(strtolower($this->manufacturingcostperitem[$this->nm_grid_colunas]), "e")) ? (float)$this->manufacturingcostperitem[$this->nm_grid_colunas] : $this->manufacturingcostperitem[$this->nm_grid_colunas]; 
          $this->manufacturingcostperitem[$this->nm_grid_colunas] = (string)$this->manufacturingcostperitem[$this->nm_grid_colunas];
          $this->holdingcostperitemperday[$this->nm_grid_colunas] = $this->rs_grid->fields[3] ;  
          $this->holdingcostperitemperday[$this->nm_grid_colunas] =  str_replace(",", ".", $this->holdingcostperitemperday[$this->nm_grid_colunas]);
          $this->holdingcostperitemperday[$this->nm_grid_colunas] = (strpos(strtolower($this->holdingcostperitemperday[$this->nm_grid_colunas]), "e")) ? (float)$this->holdingcostperitemperday[$this->nm_grid_colunas] : $this->holdingcostperitemperday[$this->nm_grid_colunas]; 
          $this->holdingcostperitemperday[$this->nm_grid_colunas] = (string)$this->holdingcostperitemperday[$this->nm_grid_colunas];
          $this->shortagecostperitemperday[$this->nm_grid_colunas] = $this->rs_grid->fields[4] ;  
          $this->shortagecostperitemperday[$this->nm_grid_colunas] =  str_replace(",", ".", $this->shortagecostperitemperday[$this->nm_grid_colunas]);
          $this->shortagecostperitemperday[$this->nm_grid_colunas] = (strpos(strtolower($this->shortagecostperitemperday[$this->nm_grid_colunas]), "e")) ? (float)$this->shortagecostperitemperday[$this->nm_grid_colunas] : $this->shortagecostperitemperday[$this->nm_grid_colunas]; 
          $this->shortagecostperitemperday[$this->nm_grid_colunas] = (string)$this->shortagecostperitemperday[$this->nm_grid_colunas];
          $this->bestparamvalue_s[$this->nm_grid_colunas] = $this->rs_grid->fields[5] ;  
          $this->bestparamvalue_s[$this->nm_grid_colunas] = (string)$this->bestparamvalue_s[$this->nm_grid_colunas];
          $this->bestparamvalue__s[$this->nm_grid_colunas] = $this->rs_grid->fields[6] ;  
          $this->bestparamvalue__s[$this->nm_grid_colunas] = (string)$this->bestparamvalue__s[$this->nm_grid_colunas];
          $this->status[$this->nm_grid_colunas] = $this->rs_grid->fields[7] ;  
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
          $this->manufacturingsetupcost[$this->nm_grid_colunas] = $this->manufacturingsetupcost[$this->nm_grid_colunas];
          if ($this->manufacturingsetupcost[$this->nm_grid_colunas] === "") 
          { 
              $this->manufacturingsetupcost[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->manufacturingsetupcost[$this->nm_grid_colunas], $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          } 
          $this->manufacturingsetupcost[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->manufacturingsetupcost[$this->nm_grid_colunas]);
          $this->manufacturingcostperitem[$this->nm_grid_colunas] = $this->manufacturingcostperitem[$this->nm_grid_colunas];
          if ($this->manufacturingcostperitem[$this->nm_grid_colunas] === "") 
          { 
              $this->manufacturingcostperitem[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->manufacturingcostperitem[$this->nm_grid_colunas], $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          } 
          $this->manufacturingcostperitem[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->manufacturingcostperitem[$this->nm_grid_colunas]);
          $this->holdingcostperitemperday[$this->nm_grid_colunas] = $this->holdingcostperitemperday[$this->nm_grid_colunas];
          if ($this->holdingcostperitemperday[$this->nm_grid_colunas] === "") 
          { 
              $this->holdingcostperitemperday[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->holdingcostperitemperday[$this->nm_grid_colunas], $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          } 
          $this->holdingcostperitemperday[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->holdingcostperitemperday[$this->nm_grid_colunas]);
          $this->shortagecostperitemperday[$this->nm_grid_colunas] = $this->shortagecostperitemperday[$this->nm_grid_colunas];
          if ($this->shortagecostperitemperday[$this->nm_grid_colunas] === "") 
          { 
              $this->shortagecostperitemperday[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->shortagecostperitemperday[$this->nm_grid_colunas], $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          } 
          $this->shortagecostperitemperday[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->shortagecostperitemperday[$this->nm_grid_colunas]);
          $this->bestparamvalue_s[$this->nm_grid_colunas] = $this->bestparamvalue_s[$this->nm_grid_colunas];
          if ($this->bestparamvalue_s[$this->nm_grid_colunas] === "") 
          { 
              $this->bestparamvalue_s[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->bestparamvalue_s[$this->nm_grid_colunas], $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
          $this->bestparamvalue_s[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->bestparamvalue_s[$this->nm_grid_colunas]);
          $this->bestparamvalue__s[$this->nm_grid_colunas] = $this->bestparamvalue__s[$this->nm_grid_colunas];
          if ($this->bestparamvalue__s[$this->nm_grid_colunas] === "") 
          { 
              $this->bestparamvalue__s[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->bestparamvalue__s[$this->nm_grid_colunas], $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
          $this->bestparamvalue__s[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->bestparamvalue__s[$this->nm_grid_colunas]);
          $this->status[$this->nm_grid_colunas] = $this->status[$this->nm_grid_colunas];
          if ($this->status[$this->nm_grid_colunas] === "") 
          { 
              $this->status[$this->nm_grid_colunas] = "" ;  
          } 
          $this->status[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->status[$this->nm_grid_colunas]);
            $cell_id = array('posx' => 10, 'posy' => 10, 'data' => $this->id[$this->nm_grid_colunas], 'width'      => 0, 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => 12, 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_ManufacturingSetupCost = array('posx' => 10, 'posy' => 20, 'data' => $this->manufacturingsetupcost[$this->nm_grid_colunas], 'width'      => 0, 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => 12, 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_ManufacturingCostPerItem = array('posx' => 10, 'posy' => 30, 'data' => $this->manufacturingcostperitem[$this->nm_grid_colunas], 'width'      => 0, 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => 12, 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_HoldingCostPerItemPerDay = array('posx' => 10, 'posy' => 40, 'data' => $this->holdingcostperitemperday[$this->nm_grid_colunas], 'width'      => 0, 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => 12, 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_ShortageCostPerItemPerDay = array('posx' => 10, 'posy' => 50, 'data' => $this->shortagecostperitemperday[$this->nm_grid_colunas], 'width'      => 0, 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => 12, 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_BestParamValue_s = array('posx' => 10, 'posy' => 60, 'data' => $this->bestparamvalue_s[$this->nm_grid_colunas], 'width'      => 0, 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => 12, 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_BestParamValue__S = array('posx' => 10, 'posy' => 70, 'data' => $this->bestparamvalue__s[$this->nm_grid_colunas], 'width'      => 0, 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => 12, 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_Status = array('posx' => 10, 'posy' => 80, 'data' => $this->status[$this->nm_grid_colunas], 'width'      => 0, 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => 12, 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);


            $this->Pdf->SetFont($cell_id['font_type'], $cell_id['font_style'], $cell_id['font_size']);
            $this->Pdf->SetTextColor($cell_id['color_r'], $cell_id['color_g'], $cell_id['color_b']);
            if (!empty($cell_id['posx']) && !empty($cell_id['posy']))
            {
                $this->Pdf->SetXY($cell_id['posx'], $cell_id['posy']);
            }
            elseif (!empty($cell_id['posx']))
            {
                $this->Pdf->SetX($cell_id['posx']);
            }
            elseif (!empty($cell_id['posy']))
            {
                $this->Pdf->SetY($cell_id['posy']);
            }
            $this->Pdf->Cell($cell_id['width'], 0, $cell_id['data'], 0, 0, $cell_id['align']);

            $this->Pdf->SetFont($cell_ManufacturingSetupCost['font_type'], $cell_ManufacturingSetupCost['font_style'], $cell_ManufacturingSetupCost['font_size']);
            $this->Pdf->SetTextColor($cell_ManufacturingSetupCost['color_r'], $cell_ManufacturingSetupCost['color_g'], $cell_ManufacturingSetupCost['color_b']);
            if (!empty($cell_ManufacturingSetupCost['posx']) && !empty($cell_ManufacturingSetupCost['posy']))
            {
                $this->Pdf->SetXY($cell_ManufacturingSetupCost['posx'], $cell_ManufacturingSetupCost['posy']);
            }
            elseif (!empty($cell_ManufacturingSetupCost['posx']))
            {
                $this->Pdf->SetX($cell_ManufacturingSetupCost['posx']);
            }
            elseif (!empty($cell_ManufacturingSetupCost['posy']))
            {
                $this->Pdf->SetY($cell_ManufacturingSetupCost['posy']);
            }
            $this->Pdf->Cell($cell_ManufacturingSetupCost['width'], 0, $cell_ManufacturingSetupCost['data'], 0, 0, $cell_ManufacturingSetupCost['align']);

            $this->Pdf->SetFont($cell_ManufacturingCostPerItem['font_type'], $cell_ManufacturingCostPerItem['font_style'], $cell_ManufacturingCostPerItem['font_size']);
            $this->Pdf->SetTextColor($cell_ManufacturingCostPerItem['color_r'], $cell_ManufacturingCostPerItem['color_g'], $cell_ManufacturingCostPerItem['color_b']);
            if (!empty($cell_ManufacturingCostPerItem['posx']) && !empty($cell_ManufacturingCostPerItem['posy']))
            {
                $this->Pdf->SetXY($cell_ManufacturingCostPerItem['posx'], $cell_ManufacturingCostPerItem['posy']);
            }
            elseif (!empty($cell_ManufacturingCostPerItem['posx']))
            {
                $this->Pdf->SetX($cell_ManufacturingCostPerItem['posx']);
            }
            elseif (!empty($cell_ManufacturingCostPerItem['posy']))
            {
                $this->Pdf->SetY($cell_ManufacturingCostPerItem['posy']);
            }
            $this->Pdf->Cell($cell_ManufacturingCostPerItem['width'], 0, $cell_ManufacturingCostPerItem['data'], 0, 0, $cell_ManufacturingCostPerItem['align']);

            $this->Pdf->SetFont($cell_HoldingCostPerItemPerDay['font_type'], $cell_HoldingCostPerItemPerDay['font_style'], $cell_HoldingCostPerItemPerDay['font_size']);
            $this->Pdf->SetTextColor($cell_HoldingCostPerItemPerDay['color_r'], $cell_HoldingCostPerItemPerDay['color_g'], $cell_HoldingCostPerItemPerDay['color_b']);
            if (!empty($cell_HoldingCostPerItemPerDay['posx']) && !empty($cell_HoldingCostPerItemPerDay['posy']))
            {
                $this->Pdf->SetXY($cell_HoldingCostPerItemPerDay['posx'], $cell_HoldingCostPerItemPerDay['posy']);
            }
            elseif (!empty($cell_HoldingCostPerItemPerDay['posx']))
            {
                $this->Pdf->SetX($cell_HoldingCostPerItemPerDay['posx']);
            }
            elseif (!empty($cell_HoldingCostPerItemPerDay['posy']))
            {
                $this->Pdf->SetY($cell_HoldingCostPerItemPerDay['posy']);
            }
            $this->Pdf->Cell($cell_HoldingCostPerItemPerDay['width'], 0, $cell_HoldingCostPerItemPerDay['data'], 0, 0, $cell_HoldingCostPerItemPerDay['align']);

            $this->Pdf->SetFont($cell_ShortageCostPerItemPerDay['font_type'], $cell_ShortageCostPerItemPerDay['font_style'], $cell_ShortageCostPerItemPerDay['font_size']);
            $this->Pdf->SetTextColor($cell_ShortageCostPerItemPerDay['color_r'], $cell_ShortageCostPerItemPerDay['color_g'], $cell_ShortageCostPerItemPerDay['color_b']);
            if (!empty($cell_ShortageCostPerItemPerDay['posx']) && !empty($cell_ShortageCostPerItemPerDay['posy']))
            {
                $this->Pdf->SetXY($cell_ShortageCostPerItemPerDay['posx'], $cell_ShortageCostPerItemPerDay['posy']);
            }
            elseif (!empty($cell_ShortageCostPerItemPerDay['posx']))
            {
                $this->Pdf->SetX($cell_ShortageCostPerItemPerDay['posx']);
            }
            elseif (!empty($cell_ShortageCostPerItemPerDay['posy']))
            {
                $this->Pdf->SetY($cell_ShortageCostPerItemPerDay['posy']);
            }
            $this->Pdf->Cell($cell_ShortageCostPerItemPerDay['width'], 0, $cell_ShortageCostPerItemPerDay['data'], 0, 0, $cell_ShortageCostPerItemPerDay['align']);

            $this->Pdf->SetFont($cell_BestParamValue_s['font_type'], $cell_BestParamValue_s['font_style'], $cell_BestParamValue_s['font_size']);
            $this->Pdf->SetTextColor($cell_BestParamValue_s['color_r'], $cell_BestParamValue_s['color_g'], $cell_BestParamValue_s['color_b']);
            if (!empty($cell_BestParamValue_s['posx']) && !empty($cell_BestParamValue_s['posy']))
            {
                $this->Pdf->SetXY($cell_BestParamValue_s['posx'], $cell_BestParamValue_s['posy']);
            }
            elseif (!empty($cell_BestParamValue_s['posx']))
            {
                $this->Pdf->SetX($cell_BestParamValue_s['posx']);
            }
            elseif (!empty($cell_BestParamValue_s['posy']))
            {
                $this->Pdf->SetY($cell_BestParamValue_s['posy']);
            }
            $this->Pdf->Cell($cell_BestParamValue_s['width'], 0, $cell_BestParamValue_s['data'], 0, 0, $cell_BestParamValue_s['align']);

            $this->Pdf->SetFont($cell_BestParamValue__S['font_type'], $cell_BestParamValue__S['font_style'], $cell_BestParamValue__S['font_size']);
            $this->Pdf->SetTextColor($cell_BestParamValue__S['color_r'], $cell_BestParamValue__S['color_g'], $cell_BestParamValue__S['color_b']);
            if (!empty($cell_BestParamValue__S['posx']) && !empty($cell_BestParamValue__S['posy']))
            {
                $this->Pdf->SetXY($cell_BestParamValue__S['posx'], $cell_BestParamValue__S['posy']);
            }
            elseif (!empty($cell_BestParamValue__S['posx']))
            {
                $this->Pdf->SetX($cell_BestParamValue__S['posx']);
            }
            elseif (!empty($cell_BestParamValue__S['posy']))
            {
                $this->Pdf->SetY($cell_BestParamValue__S['posy']);
            }
            $this->Pdf->Cell($cell_BestParamValue__S['width'], 0, $cell_BestParamValue__S['data'], 0, 0, $cell_BestParamValue__S['align']);

            $this->Pdf->SetFont($cell_Status['font_type'], $cell_Status['font_style'], $cell_Status['font_size']);
            $this->Pdf->SetTextColor($cell_Status['color_r'], $cell_Status['color_g'], $cell_Status['color_b']);
            if (!empty($cell_Status['posx']) && !empty($cell_Status['posy']))
            {
                $this->Pdf->SetXY($cell_Status['posx'], $cell_Status['posy']);
            }
            elseif (!empty($cell_Status['posx']))
            {
                $this->Pdf->SetX($cell_Status['posx']);
            }
            elseif (!empty($cell_Status['posy']))
            {
                $this->Pdf->SetY($cell_Status['posy']);
            }
            $this->Pdf->Cell($cell_Status['width'], 0, $cell_Status['data'], 0, 0, $cell_Status['align']);

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
