<?php

class pdfreport_tb_values_rtf
{
   var $Db;
   var $Erro;
   var $Ini;
   var $Lookup;
   var $nm_data;
   var $texto_tag;
   var $arquivo;
   var $tit_doc;
   var $sc_proc_grid; 
   var $NM_cmp_hidden = array();

   //---- 
   function pdfreport_tb_values_rtf()
   {
      $this->nm_data   = new nm_data("el");
      $this->texto_tag = "";
   }

   //---- 
   function monta_rtf()
   {
      $this->inicializa_vars();
      $this->gera_texto_tag();
      $this->grava_arquivo_rtf();
      $this->monta_html();
   }

   //----- 
   function inicializa_vars()
   {
      global $nm_lang;
      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      $this->arquivo    = "sc_rtf";
      $this->arquivo   .= "_" . date("YmdHis") . "_" . rand(0, 1000);
      $this->arquivo   .= "_pdfreport_tb_values";
      $this->arquivo   .= ".rtf";
      $this->tit_doc    = "pdfreport_tb_values.rtf";
   }

   //----- 
   function gera_texto_tag()
   {
     global $nm_lang;
      global
             $nm_nada, $nm_lang;

      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->sc_proc_grid = false; 
      $nm_raiz_img  = ""; 
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_tb_values']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_tb_values']['campos_busca']))
      { 
          $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_tb_values']['campos_busca'];
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
              $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->status = $Busca_temp['status']; 
          $tmp_pos = strpos($this->status, "##@@");
          if ($tmp_pos !== false)
          {
              $this->status = substr($this->status, 0, $tmp_pos);
          }
      } 
      $this->nm_field_dinamico = array();
      $this->nm_order_dinamico = array();
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_tb_values']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_tb_values']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_tb_values']['where_pesq_filtro'];
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_tb_values']['rtf_name']))
      {
          $this->arquivo = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_tb_values']['rtf_name'];
          $this->tit_doc = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_tb_values']['rtf_name'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_tb_values']['rtf_name']);
      }
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
      $nmgp_order_by = $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_tb_values']['order_grid'];
      $nmgp_select .= $nmgp_order_by; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select;
      $rs = $this->Db->Execute($nmgp_select);
      if ($rs === false && !$rs->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1)
      {
         $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
         exit;
      }

      $this->texto_tag .= "<table>\r\n";
      $this->texto_tag .= "<tr>\r\n";
      foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_tb_values']['field_order'] as $Cada_col)
      { 
          $SC_Label = (isset($this->New_label['id'])) ? $this->New_label['id'] : "Id"; 
          if ($Cada_col == "id" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = mb_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['f_manufacturingsetupcost'])) ? $this->New_label['f_manufacturingsetupcost'] : "F Manufacturing Setup Cost"; 
          if ($Cada_col == "f_manufacturingsetupcost" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = mb_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['f_manufacturingcostperitem'])) ? $this->New_label['f_manufacturingcostperitem'] : "F Manufacturing Cost Per Item"; 
          if ($Cada_col == "f_manufacturingcostperitem" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = mb_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['f_holdingcostperitemperday'])) ? $this->New_label['f_holdingcostperitemperday'] : "F Holding Cost Per Item Per Day"; 
          if ($Cada_col == "f_holdingcostperitemperday" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = mb_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['f_shortagecostperitemperday'])) ? $this->New_label['f_shortagecostperitemperday'] : "F Shortage Cost Per Item Per Day"; 
          if ($Cada_col == "f_shortagecostperitemperday" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = mb_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['f_bestparamvalue_s'])) ? $this->New_label['f_bestparamvalue_s'] : "F Best Param Value S"; 
          if ($Cada_col == "f_bestparamvalue_s" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = mb_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['f_bestparamvalue__s'])) ? $this->New_label['f_bestparamvalue__s'] : "F Best Param Value S"; 
          if ($Cada_col == "f_bestparamvalue__s" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = mb_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['r_ordersetupcost'])) ? $this->New_label['r_ordersetupcost'] : "R Order Setup Cost"; 
          if ($Cada_col == "r_ordersetupcost" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = mb_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['r_ordercostperitem'])) ? $this->New_label['r_ordercostperitem'] : "R Order Cost Per Item"; 
          if ($Cada_col == "r_ordercostperitem" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = mb_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['r_holdingcostperitemperday'])) ? $this->New_label['r_holdingcostperitemperday'] : "R Holding Cost Per Item Per Day"; 
          if ($Cada_col == "r_holdingcostperitemperday" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = mb_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['r_shortagecostperitemperday'])) ? $this->New_label['r_shortagecostperitemperday'] : "R Shortage Cost Per Item Per Day"; 
          if ($Cada_col == "r_shortagecostperitemperday" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = mb_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['r_bestparamvalue_s'])) ? $this->New_label['r_bestparamvalue_s'] : "R Best Param Value S"; 
          if ($Cada_col == "r_bestparamvalue_s" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = mb_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['r_bestparamvalue__s'])) ? $this->New_label['r_bestparamvalue__s'] : "R Best Param Value S"; 
          if ($Cada_col == "r_bestparamvalue__s" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = mb_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['w_ordersetupcost'])) ? $this->New_label['w_ordersetupcost'] : "W Order Setup Cost"; 
          if ($Cada_col == "w_ordersetupcost" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = mb_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['w_ordercostperitem'])) ? $this->New_label['w_ordercostperitem'] : "W Order Cost Per Item"; 
          if ($Cada_col == "w_ordercostperitem" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = mb_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['w_holdingcostperitemperday'])) ? $this->New_label['w_holdingcostperitemperday'] : "W Holding Cost Per Item Per Day"; 
          if ($Cada_col == "w_holdingcostperitemperday" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = mb_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['w_shortagecostperitemperday'])) ? $this->New_label['w_shortagecostperitemperday'] : "W Shortage Cost Per Item Per Day"; 
          if ($Cada_col == "w_shortagecostperitemperday" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = mb_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['w_bestparamvalue_s'])) ? $this->New_label['w_bestparamvalue_s'] : "W Best Param Value S"; 
          if ($Cada_col == "w_bestparamvalue_s" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = mb_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['w_bestparamvalue__s'])) ? $this->New_label['w_bestparamvalue__s'] : "W Best Param Value S"; 
          if ($Cada_col == "w_bestparamvalue__s" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = mb_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['status'])) ? $this->New_label['status'] : "Status"; 
          if ($Cada_col == "status" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
             if (!NM_is_utf8($SC_Label))
              {
                  $SC_Label = mb_convert_encoding($SC_Label, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
      } 
      $this->texto_tag .= "</tr>\r\n";
      while (!$rs->EOF)
      {
         $this->texto_tag .= "<tr>\r\n";
         $this->id = $rs->fields[0] ;  
         $this->id = (string)$this->id;
         $this->f_manufacturingsetupcost = $rs->fields[1] ;  
         $this->f_manufacturingsetupcost =  str_replace(",", ".", $this->f_manufacturingsetupcost);
         $this->f_manufacturingsetupcost = (strpos(strtolower($this->f_manufacturingsetupcost), "e")) ? (float)$this->f_manufacturingsetupcost : $this->f_manufacturingsetupcost; 
         $this->f_manufacturingsetupcost = (string)$this->f_manufacturingsetupcost;
         $this->f_manufacturingcostperitem = $rs->fields[2] ;  
         $this->f_manufacturingcostperitem =  str_replace(",", ".", $this->f_manufacturingcostperitem);
         $this->f_manufacturingcostperitem = (strpos(strtolower($this->f_manufacturingcostperitem), "e")) ? (float)$this->f_manufacturingcostperitem : $this->f_manufacturingcostperitem; 
         $this->f_manufacturingcostperitem = (string)$this->f_manufacturingcostperitem;
         $this->f_holdingcostperitemperday = $rs->fields[3] ;  
         $this->f_holdingcostperitemperday =  str_replace(",", ".", $this->f_holdingcostperitemperday);
         $this->f_holdingcostperitemperday = (strpos(strtolower($this->f_holdingcostperitemperday), "e")) ? (float)$this->f_holdingcostperitemperday : $this->f_holdingcostperitemperday; 
         $this->f_holdingcostperitemperday = (string)$this->f_holdingcostperitemperday;
         $this->f_shortagecostperitemperday = $rs->fields[4] ;  
         $this->f_shortagecostperitemperday =  str_replace(",", ".", $this->f_shortagecostperitemperday);
         $this->f_shortagecostperitemperday = (strpos(strtolower($this->f_shortagecostperitemperday), "e")) ? (float)$this->f_shortagecostperitemperday : $this->f_shortagecostperitemperday; 
         $this->f_shortagecostperitemperday = (string)$this->f_shortagecostperitemperday;
         $this->f_bestparamvalue_s = $rs->fields[5] ;  
         $this->f_bestparamvalue_s = (string)$this->f_bestparamvalue_s;
         $this->f_bestparamvalue__s = $rs->fields[6] ;  
         $this->f_bestparamvalue__s = (string)$this->f_bestparamvalue__s;
         $this->r_ordersetupcost = $rs->fields[7] ;  
         $this->r_ordersetupcost =  str_replace(",", ".", $this->r_ordersetupcost);
         $this->r_ordersetupcost = (strpos(strtolower($this->r_ordersetupcost), "e")) ? (float)$this->r_ordersetupcost : $this->r_ordersetupcost; 
         $this->r_ordersetupcost = (string)$this->r_ordersetupcost;
         $this->r_ordercostperitem = $rs->fields[8] ;  
         $this->r_ordercostperitem =  str_replace(",", ".", $this->r_ordercostperitem);
         $this->r_ordercostperitem = (strpos(strtolower($this->r_ordercostperitem), "e")) ? (float)$this->r_ordercostperitem : $this->r_ordercostperitem; 
         $this->r_ordercostperitem = (string)$this->r_ordercostperitem;
         $this->r_holdingcostperitemperday = $rs->fields[9] ;  
         $this->r_holdingcostperitemperday =  str_replace(",", ".", $this->r_holdingcostperitemperday);
         $this->r_holdingcostperitemperday = (strpos(strtolower($this->r_holdingcostperitemperday), "e")) ? (float)$this->r_holdingcostperitemperday : $this->r_holdingcostperitemperday; 
         $this->r_holdingcostperitemperday = (string)$this->r_holdingcostperitemperday;
         $this->r_shortagecostperitemperday = $rs->fields[10] ;  
         $this->r_shortagecostperitemperday =  str_replace(",", ".", $this->r_shortagecostperitemperday);
         $this->r_shortagecostperitemperday = (strpos(strtolower($this->r_shortagecostperitemperday), "e")) ? (float)$this->r_shortagecostperitemperday : $this->r_shortagecostperitemperday; 
         $this->r_shortagecostperitemperday = (string)$this->r_shortagecostperitemperday;
         $this->r_bestparamvalue_s = $rs->fields[11] ;  
         $this->r_bestparamvalue_s = (string)$this->r_bestparamvalue_s;
         $this->r_bestparamvalue__s = $rs->fields[12] ;  
         $this->r_bestparamvalue__s = (string)$this->r_bestparamvalue__s;
         $this->w_ordersetupcost = $rs->fields[13] ;  
         $this->w_ordersetupcost =  str_replace(",", ".", $this->w_ordersetupcost);
         $this->w_ordersetupcost = (strpos(strtolower($this->w_ordersetupcost), "e")) ? (float)$this->w_ordersetupcost : $this->w_ordersetupcost; 
         $this->w_ordersetupcost = (string)$this->w_ordersetupcost;
         $this->w_ordercostperitem = $rs->fields[14] ;  
         $this->w_ordercostperitem =  str_replace(",", ".", $this->w_ordercostperitem);
         $this->w_ordercostperitem = (strpos(strtolower($this->w_ordercostperitem), "e")) ? (float)$this->w_ordercostperitem : $this->w_ordercostperitem; 
         $this->w_ordercostperitem = (string)$this->w_ordercostperitem;
         $this->w_holdingcostperitemperday = $rs->fields[15] ;  
         $this->w_holdingcostperitemperday =  str_replace(",", ".", $this->w_holdingcostperitemperday);
         $this->w_holdingcostperitemperday = (strpos(strtolower($this->w_holdingcostperitemperday), "e")) ? (float)$this->w_holdingcostperitemperday : $this->w_holdingcostperitemperday; 
         $this->w_holdingcostperitemperday = (string)$this->w_holdingcostperitemperday;
         $this->w_shortagecostperitemperday = $rs->fields[16] ;  
         $this->w_shortagecostperitemperday =  str_replace(",", ".", $this->w_shortagecostperitemperday);
         $this->w_shortagecostperitemperday = (strpos(strtolower($this->w_shortagecostperitemperday), "e")) ? (float)$this->w_shortagecostperitemperday : $this->w_shortagecostperitemperday; 
         $this->w_shortagecostperitemperday = (string)$this->w_shortagecostperitemperday;
         $this->w_bestparamvalue_s = $rs->fields[17] ;  
         $this->w_bestparamvalue_s = (string)$this->w_bestparamvalue_s;
         $this->w_bestparamvalue__s = $rs->fields[18] ;  
         $this->w_bestparamvalue__s = (string)$this->w_bestparamvalue__s;
         $this->status = $rs->fields[19] ;  
         $this->status = (string)$this->status;
         $this->sc_proc_grid = true; 
         foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_tb_values']['field_order'] as $Cada_col)
         { 
            if (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off")
            { 
                $NM_func_exp = "NM_export_" . $Cada_col;
                $this->$NM_func_exp();
            } 
         } 
         $this->texto_tag .= "</tr>\r\n";
         $rs->MoveNext();
      }
      $this->texto_tag .= "</table>\r\n";

      $rs->Close();
   }
   //----- id
   function NM_export_id()
   {
         nmgp_Form_Num_Val($this->id, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         if (!NM_is_utf8($this->id))
         {
             $this->id = mb_convert_encoding($this->id, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          $this->id = str_replace('<', '&lt;', $this->id);
          $this->id = str_replace('>', '&gt;', $this->id);
         $this->texto_tag .= "<td>" . $this->id . "</td>\r\n";
   }
   //----- f_manufacturingsetupcost
   function NM_export_f_manufacturingsetupcost()
   {
         nmgp_Form_Num_Val($this->f_manufacturingsetupcost, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         if (!NM_is_utf8($this->f_manufacturingsetupcost))
         {
             $this->f_manufacturingsetupcost = mb_convert_encoding($this->f_manufacturingsetupcost, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          $this->f_manufacturingsetupcost = str_replace('<', '&lt;', $this->f_manufacturingsetupcost);
          $this->f_manufacturingsetupcost = str_replace('>', '&gt;', $this->f_manufacturingsetupcost);
         $this->texto_tag .= "<td>" . $this->f_manufacturingsetupcost . "</td>\r\n";
   }
   //----- f_manufacturingcostperitem
   function NM_export_f_manufacturingcostperitem()
   {
         nmgp_Form_Num_Val($this->f_manufacturingcostperitem, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         if (!NM_is_utf8($this->f_manufacturingcostperitem))
         {
             $this->f_manufacturingcostperitem = mb_convert_encoding($this->f_manufacturingcostperitem, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          $this->f_manufacturingcostperitem = str_replace('<', '&lt;', $this->f_manufacturingcostperitem);
          $this->f_manufacturingcostperitem = str_replace('>', '&gt;', $this->f_manufacturingcostperitem);
         $this->texto_tag .= "<td>" . $this->f_manufacturingcostperitem . "</td>\r\n";
   }
   //----- f_holdingcostperitemperday
   function NM_export_f_holdingcostperitemperday()
   {
         nmgp_Form_Num_Val($this->f_holdingcostperitemperday, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         if (!NM_is_utf8($this->f_holdingcostperitemperday))
         {
             $this->f_holdingcostperitemperday = mb_convert_encoding($this->f_holdingcostperitemperday, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          $this->f_holdingcostperitemperday = str_replace('<', '&lt;', $this->f_holdingcostperitemperday);
          $this->f_holdingcostperitemperday = str_replace('>', '&gt;', $this->f_holdingcostperitemperday);
         $this->texto_tag .= "<td>" . $this->f_holdingcostperitemperday . "</td>\r\n";
   }
   //----- f_shortagecostperitemperday
   function NM_export_f_shortagecostperitemperday()
   {
         nmgp_Form_Num_Val($this->f_shortagecostperitemperday, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         if (!NM_is_utf8($this->f_shortagecostperitemperday))
         {
             $this->f_shortagecostperitemperday = mb_convert_encoding($this->f_shortagecostperitemperday, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          $this->f_shortagecostperitemperday = str_replace('<', '&lt;', $this->f_shortagecostperitemperday);
          $this->f_shortagecostperitemperday = str_replace('>', '&gt;', $this->f_shortagecostperitemperday);
         $this->texto_tag .= "<td>" . $this->f_shortagecostperitemperday . "</td>\r\n";
   }
   //----- f_bestparamvalue_s
   function NM_export_f_bestparamvalue_s()
   {
         nmgp_Form_Num_Val($this->f_bestparamvalue_s, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         if (!NM_is_utf8($this->f_bestparamvalue_s))
         {
             $this->f_bestparamvalue_s = mb_convert_encoding($this->f_bestparamvalue_s, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          $this->f_bestparamvalue_s = str_replace('<', '&lt;', $this->f_bestparamvalue_s);
          $this->f_bestparamvalue_s = str_replace('>', '&gt;', $this->f_bestparamvalue_s);
         $this->texto_tag .= "<td>" . $this->f_bestparamvalue_s . "</td>\r\n";
   }
   //----- f_bestparamvalue__s
   function NM_export_f_bestparamvalue__s()
   {
         nmgp_Form_Num_Val($this->f_bestparamvalue__s, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         if (!NM_is_utf8($this->f_bestparamvalue__s))
         {
             $this->f_bestparamvalue__s = mb_convert_encoding($this->f_bestparamvalue__s, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          $this->f_bestparamvalue__s = str_replace('<', '&lt;', $this->f_bestparamvalue__s);
          $this->f_bestparamvalue__s = str_replace('>', '&gt;', $this->f_bestparamvalue__s);
         $this->texto_tag .= "<td>" . $this->f_bestparamvalue__s . "</td>\r\n";
   }
   //----- r_ordersetupcost
   function NM_export_r_ordersetupcost()
   {
         nmgp_Form_Num_Val($this->r_ordersetupcost, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         if (!NM_is_utf8($this->r_ordersetupcost))
         {
             $this->r_ordersetupcost = mb_convert_encoding($this->r_ordersetupcost, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          $this->r_ordersetupcost = str_replace('<', '&lt;', $this->r_ordersetupcost);
          $this->r_ordersetupcost = str_replace('>', '&gt;', $this->r_ordersetupcost);
         $this->texto_tag .= "<td>" . $this->r_ordersetupcost . "</td>\r\n";
   }
   //----- r_ordercostperitem
   function NM_export_r_ordercostperitem()
   {
         nmgp_Form_Num_Val($this->r_ordercostperitem, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         if (!NM_is_utf8($this->r_ordercostperitem))
         {
             $this->r_ordercostperitem = mb_convert_encoding($this->r_ordercostperitem, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          $this->r_ordercostperitem = str_replace('<', '&lt;', $this->r_ordercostperitem);
          $this->r_ordercostperitem = str_replace('>', '&gt;', $this->r_ordercostperitem);
         $this->texto_tag .= "<td>" . $this->r_ordercostperitem . "</td>\r\n";
   }
   //----- r_holdingcostperitemperday
   function NM_export_r_holdingcostperitemperday()
   {
         nmgp_Form_Num_Val($this->r_holdingcostperitemperday, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         if (!NM_is_utf8($this->r_holdingcostperitemperday))
         {
             $this->r_holdingcostperitemperday = mb_convert_encoding($this->r_holdingcostperitemperday, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          $this->r_holdingcostperitemperday = str_replace('<', '&lt;', $this->r_holdingcostperitemperday);
          $this->r_holdingcostperitemperday = str_replace('>', '&gt;', $this->r_holdingcostperitemperday);
         $this->texto_tag .= "<td>" . $this->r_holdingcostperitemperday . "</td>\r\n";
   }
   //----- r_shortagecostperitemperday
   function NM_export_r_shortagecostperitemperday()
   {
         nmgp_Form_Num_Val($this->r_shortagecostperitemperday, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         if (!NM_is_utf8($this->r_shortagecostperitemperday))
         {
             $this->r_shortagecostperitemperday = mb_convert_encoding($this->r_shortagecostperitemperday, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          $this->r_shortagecostperitemperday = str_replace('<', '&lt;', $this->r_shortagecostperitemperday);
          $this->r_shortagecostperitemperday = str_replace('>', '&gt;', $this->r_shortagecostperitemperday);
         $this->texto_tag .= "<td>" . $this->r_shortagecostperitemperday . "</td>\r\n";
   }
   //----- r_bestparamvalue_s
   function NM_export_r_bestparamvalue_s()
   {
         nmgp_Form_Num_Val($this->r_bestparamvalue_s, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         if (!NM_is_utf8($this->r_bestparamvalue_s))
         {
             $this->r_bestparamvalue_s = mb_convert_encoding($this->r_bestparamvalue_s, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          $this->r_bestparamvalue_s = str_replace('<', '&lt;', $this->r_bestparamvalue_s);
          $this->r_bestparamvalue_s = str_replace('>', '&gt;', $this->r_bestparamvalue_s);
         $this->texto_tag .= "<td>" . $this->r_bestparamvalue_s . "</td>\r\n";
   }
   //----- r_bestparamvalue__s
   function NM_export_r_bestparamvalue__s()
   {
         nmgp_Form_Num_Val($this->r_bestparamvalue__s, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         if (!NM_is_utf8($this->r_bestparamvalue__s))
         {
             $this->r_bestparamvalue__s = mb_convert_encoding($this->r_bestparamvalue__s, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          $this->r_bestparamvalue__s = str_replace('<', '&lt;', $this->r_bestparamvalue__s);
          $this->r_bestparamvalue__s = str_replace('>', '&gt;', $this->r_bestparamvalue__s);
         $this->texto_tag .= "<td>" . $this->r_bestparamvalue__s . "</td>\r\n";
   }
   //----- w_ordersetupcost
   function NM_export_w_ordersetupcost()
   {
         nmgp_Form_Num_Val($this->w_ordersetupcost, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         if (!NM_is_utf8($this->w_ordersetupcost))
         {
             $this->w_ordersetupcost = mb_convert_encoding($this->w_ordersetupcost, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          $this->w_ordersetupcost = str_replace('<', '&lt;', $this->w_ordersetupcost);
          $this->w_ordersetupcost = str_replace('>', '&gt;', $this->w_ordersetupcost);
         $this->texto_tag .= "<td>" . $this->w_ordersetupcost . "</td>\r\n";
   }
   //----- w_ordercostperitem
   function NM_export_w_ordercostperitem()
   {
         nmgp_Form_Num_Val($this->w_ordercostperitem, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         if (!NM_is_utf8($this->w_ordercostperitem))
         {
             $this->w_ordercostperitem = mb_convert_encoding($this->w_ordercostperitem, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          $this->w_ordercostperitem = str_replace('<', '&lt;', $this->w_ordercostperitem);
          $this->w_ordercostperitem = str_replace('>', '&gt;', $this->w_ordercostperitem);
         $this->texto_tag .= "<td>" . $this->w_ordercostperitem . "</td>\r\n";
   }
   //----- w_holdingcostperitemperday
   function NM_export_w_holdingcostperitemperday()
   {
         nmgp_Form_Num_Val($this->w_holdingcostperitemperday, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         if (!NM_is_utf8($this->w_holdingcostperitemperday))
         {
             $this->w_holdingcostperitemperday = mb_convert_encoding($this->w_holdingcostperitemperday, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          $this->w_holdingcostperitemperday = str_replace('<', '&lt;', $this->w_holdingcostperitemperday);
          $this->w_holdingcostperitemperday = str_replace('>', '&gt;', $this->w_holdingcostperitemperday);
         $this->texto_tag .= "<td>" . $this->w_holdingcostperitemperday . "</td>\r\n";
   }
   //----- w_shortagecostperitemperday
   function NM_export_w_shortagecostperitemperday()
   {
         nmgp_Form_Num_Val($this->w_shortagecostperitemperday, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         if (!NM_is_utf8($this->w_shortagecostperitemperday))
         {
             $this->w_shortagecostperitemperday = mb_convert_encoding($this->w_shortagecostperitemperday, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          $this->w_shortagecostperitemperday = str_replace('<', '&lt;', $this->w_shortagecostperitemperday);
          $this->w_shortagecostperitemperday = str_replace('>', '&gt;', $this->w_shortagecostperitemperday);
         $this->texto_tag .= "<td>" . $this->w_shortagecostperitemperday . "</td>\r\n";
   }
   //----- w_bestparamvalue_s
   function NM_export_w_bestparamvalue_s()
   {
         nmgp_Form_Num_Val($this->w_bestparamvalue_s, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         if (!NM_is_utf8($this->w_bestparamvalue_s))
         {
             $this->w_bestparamvalue_s = mb_convert_encoding($this->w_bestparamvalue_s, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          $this->w_bestparamvalue_s = str_replace('<', '&lt;', $this->w_bestparamvalue_s);
          $this->w_bestparamvalue_s = str_replace('>', '&gt;', $this->w_bestparamvalue_s);
         $this->texto_tag .= "<td>" . $this->w_bestparamvalue_s . "</td>\r\n";
   }
   //----- w_bestparamvalue__s
   function NM_export_w_bestparamvalue__s()
   {
         nmgp_Form_Num_Val($this->w_bestparamvalue__s, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         if (!NM_is_utf8($this->w_bestparamvalue__s))
         {
             $this->w_bestparamvalue__s = mb_convert_encoding($this->w_bestparamvalue__s, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          $this->w_bestparamvalue__s = str_replace('<', '&lt;', $this->w_bestparamvalue__s);
          $this->w_bestparamvalue__s = str_replace('>', '&gt;', $this->w_bestparamvalue__s);
         $this->texto_tag .= "<td>" . $this->w_bestparamvalue__s . "</td>\r\n";
   }
   //----- status
   function NM_export_status()
   {
         if (!NM_is_utf8($this->status))
         {
             $this->status = mb_convert_encoding($this->status, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
          $this->status = str_replace('<', '&lt;', $this->status);
          $this->status = str_replace('>', '&gt;', $this->status);
         $this->texto_tag .= "<td>" . $this->status . "</td>\r\n";
   }

   //----- 
   function grava_arquivo_rtf()
   {
      global $nm_lang, $doc_wrap;
      $rtf_f = fopen($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->arquivo, "w");
      require_once($this->Ini->path_third      . "/rtf_new/document_generator/cl_xml2driver.php"); 
      $text_ok  =  "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>\r\n"; 
      $text_ok .=  "<DOC config_file=\"" . $this->Ini->path_third . "/rtf_new/doc_config.inc\" >\r\n"; 
      $text_ok .=  $this->texto_tag; 
      $text_ok .=  "</DOC>\r\n"; 
      $xml = new nDOCGEN($text_ok,"RTF"); 
      fwrite($rtf_f, $xml->get_result_file());
      fclose($rtf_f);
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
   //---- 
   function monta_html()
   {
      global $nm_url_saida, $nm_lang;
      include($this->Ini->path_btn . $this->Ini->Str_btn_grid);
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_tb_values']['rtf_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['pdfreport_tb_values']['rtf_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->arquivo;
      }
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE><?php echo $this->Ini->Nm_lang['lang_othr_grid_titl'] ?> - tb_values :: RTF</TITLE>
 <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
<?php
if ($_SESSION['scriptcase']['proc_mobile'])
{
?>
  <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
<?php
}
?>
  <META http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT"/>
  <META http-equiv="Last-Modified" content="<?php echo gmdate("D, d M Y H:i:s"); ?> GMT"/>
  <META http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate"/>
  <META http-equiv="Cache-Control" content="post-check=0, pre-check=0"/>
  <META http-equiv="Pragma" content="no-cache"/>
  <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_all ?>_export.css" /> 
  <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_all ?>_export<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" /> 
  <link rel="stylesheet" type="text/css" href="../_lib/buttons/<?php echo $this->Ini->Str_btn_css ?>" /> 
</HEAD>
<BODY class="scExportPage">
<?php echo $this->Ini->Ajax_result_set ?>
<table style="border-collapse: collapse; border-width: 0; height: 100%; width: 100%"><tr><td style="padding: 0; text-align: center; vertical-align: middle">
 <table class="scExportTable" align="center">
  <tr>
   <td class="scExportTitle" style="height: 25px">RTF</td>
  </tr>
  <tr>
   <td class="scExportLine" style="width: 100%">
    <table style="border-collapse: collapse; border-width: 0; width: 100%"><tr><td class="scExportLineFont" style="padding: 3px 0 0 0" id="idMessage">
    <?php echo $this->Ini->Nm_lang['lang_othr_file_msge'] ?>
    </td><td class="scExportLineFont" style="text-align:right; padding: 3px 0 0 0">
     <?php echo nmButtonOutput($this->arr_buttons, "bexportview", "document.Fview.submit()", "document.Fview.submit()", "idBtnView", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "");
 ?>
     <?php echo nmButtonOutput($this->arr_buttons, "bdownload", "document.Fdown.submit()", "document.Fdown.submit()", "idBtnDown", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "");
 ?>
     <?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "document.F0.submit()", "document.F0.submit()", "idBtnBack", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "");
 ?>
    </td></tr></table>
   </td>
  </tr>
 </table>
</td></tr></table>
<form name="Fview" method="get" action="<?php echo $this->Ini->path_imag_temp . "/" . $this->arquivo ?>" target="_blank" style="display: none"> 
</form>
<form name="Fdown" method="get" action="pdfreport_tb_values_download.php" target="_blank" style="display: none"> 
<input type="hidden" name="nm_tit_doc" value="<?php echo NM_encode_input($this->tit_doc); ?>"> 
<input type="hidden" name="nm_name_doc" value="<?php echo NM_encode_input($this->Ini->path_imag_temp . "/" . $this->arquivo) ?>"> 
</form>
<FORM name="F0" method=post action="./"> 
<INPUT type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<INPUT type="hidden" name="script_case_session" value="<?php echo NM_encode_input(session_id()); ?>"> 
<INPUT type="hidden" name="nmgp_opcao" value="volta_grid"> 
</FORM> 
</BODY>
</HTML>
<?php
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
