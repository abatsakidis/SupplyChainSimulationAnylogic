<?php
function gera_sel_quebras()
{
   global  $arq22, $nome_aplicacao, $nmgp_lang, $tbapl_idioma, $apl_charset, $charset_especifico, $tbapl_titulo_grid, $tbapl_schema, $apl_usa_schema_session,
           $tbapl_cod_apl, $nm_totaliza_php, $tbapl_arr_quebras, $nome_classe, $apl_tem_ajax_navigate, $tem_free_groupby, $tem_static_groupby, $campos_free_groupby,
           $tab_cmp, $arquivo22, $tbapl_button_esp, $parms_tbapl_attr2;

   nm_imprime_2($arq22, "<?php\r\n");
   nm_imprime_2($arq22, "   include_once('" . $nome_aplicacao . "_session.php');\r\n") ;
   nm_imprime_2($arq22, "   session_start();\r\n");
   nm_imprime_2($arq22, "   \$Sel_Groupby = new " . $nome_classe . "_sel_Groupby(); \r\n") ;
   nm_imprime_2($arq22, "   \$Sel_Groupby->Sel_Groupby_init();\r\n");
   nm_imprime_2($arq22, "   \r\n");

   nm_imprime_2($arq22,"class " . $nome_classe . "_sel_Groupby\r\n") ;
   nm_imprime_2($arq22,"{\r\n") ;

   nm_imprime_2($arq22, "function Sel_Groupby_init()\r\n");
   nm_imprime_2($arq22, "{\r\n");
   nm_imprime_2($arq22, "   global \$opc_ret, \$sc_init, \$path_img, \$path_btn, \$groupby_atual, \$embbed, \$tbar_pos, \$_POST, \$_GET;\r\n");

   nm_imprime_2($arq22, "   if (isset(\$_POST['script_case_init']))\r\n");
   nm_imprime_2($arq22, "   {\r\n");
   nm_imprime_2($arq22, "       \$opc_ret  = \$_POST['opc_ret'];\r\n");
   nm_imprime_2($arq22, "       \$sc_init  = \$_POST['script_case_init'];\r\n");
   nm_imprime_2($arq22, "       \$path_img = \$_POST['path_img'];\r\n");
   nm_imprime_2($arq22, "       \$path_btn = \$_POST['path_btn'];\r\n");
   nm_imprime_2($arq22, "       \$embbed   = isset(\$_POST['embbed_groupby']) && 'Y' == \$_POST['embbed_groupby'];\r\n");
   nm_imprime_2($arq22, "       \$tbar_pos = isset(\$_POST['toolbar_pos']) ? \$_POST['toolbar_pos'] : '';\r\n");
   nm_imprime_2($arq22, "   }\r\n");
   nm_imprime_2($arq22, "   elseif (isset(\$_GET['script_case_init']))\r\n");
   nm_imprime_2($arq22, "   {\r\n");
   nm_imprime_2($arq22, "       \$opc_ret  = \$_GET['opc_ret'];\r\n");
   nm_imprime_2($arq22, "       \$sc_init  = \$_GET['script_case_init'];\r\n");
   nm_imprime_2($arq22, "       \$path_img = \$_GET['path_img'];\r\n");
   nm_imprime_2($arq22, "       \$path_btn = \$_GET['path_btn'];\r\n");
   nm_imprime_2($arq22, "       \$embbed   = isset(\$_GET['embbed_groupby']) && 'Y' == \$_GET['embbed_groupby'];\r\n");
   nm_imprime_2($arq22, "       \$tbar_pos = isset(\$_GET['toolbar_pos']) ? \$_GET['toolbar_pos'] : '';\r\n");
   nm_imprime_2($arq22, "   }\r\n");

   nm_imprime_2($arq22, "   \r\n");
   nm_imprime_2($arq22, "   \$groupby_atual = \$_SESSION['sc_session'][\$sc_init]['" . $nome_aplicacao . "']['SC_Ind_Groupby'];\r\n");
   nm_imprime_2($arq22, "   if (isset(\$_POST['fsel_ok']) && \$_POST['fsel_ok'] == \"OK\" && isset(\$_POST['sel_groupby']))\r\n");
   nm_imprime_2($arq22, "   {\r\n");
   nm_imprime_2($arq22, "       \$this->campos_sel   = isset(\$_POST['campos_sel'])   ? \$_POST['campos_sel']   : \"\";\r\n");
   nm_imprime_2($arq22, "       \$this->xaxys_fields = isset(\$_POST['xaxys_fields']) ? \$_POST['xaxys_fields'] : \"\";\r\n");
   nm_imprime_2($arq22, "       \$this->summ_fields  = isset(\$_POST['summ_fields'])  ? \$_POST['summ_fields']  : \"\";\r\n");
   nm_imprime_2($arq22, "       \$this->Sel_processa_out(\$_POST['sel_groupby']);\r\n");
   nm_imprime_2($arq22, "   }\r\n");
   nm_imprime_2($arq22, "   else\r\n");
   nm_imprime_2($arq22, "   {\r\n");
   nm_imprime_2($arq22, "       if (\$embbed)\r\n");
   nm_imprime_2($arq22, "       {\r\n");
   nm_imprime_2($arq22, "           ob_start();\r\n");
   nm_imprime_2($arq22, "           \$this->Sel_processa_form();\r\n");
   nm_imprime_2($arq22, "           \$Temp = ob_get_clean();\r\n");
   nm_imprime_2($arq22, "           echo NM_charset_to_utf8(\$Temp);\r\n");
   nm_imprime_2($arq22, "       }\r\n");
   nm_imprime_2($arq22, "       else\r\n");
   nm_imprime_2($arq22, "       {\r\n");
   nm_imprime_2($arq22, "           \$this->Sel_processa_form();\r\n");
   nm_imprime_2($arq22, "       }\r\n");
   nm_imprime_2($arq22, "   }\r\n");
   nm_imprime_2($arq22, "   exit;\r\n");
   nm_imprime_2($arq22, "   \r\n");
   nm_imprime_2($arq22, "}\r\n");

   nm_imprime_2($arq22, "function Sel_processa_out(\$sel_groupby)\r\n");
   nm_imprime_2($arq22, "{\r\n");
   nm_imprime_2($arq22, "   global \$sc_init, \$groupby_atual, \$opc_ret, \$embbed;\r\n");

   if ($tem_free_groupby)
   {
       nm_imprime_2($arq22, "   \$Change_free_groupby = false;\r\n");
       nm_imprime_2($arq22, "   \$campos_sel = explode(\"@?@\", \$this->campos_sel);\r\n");
       nm_imprime_2($arq22, "   if (\$sel_groupby == \"sc_free_group_by\")\r\n");
       nm_imprime_2($arq22, "   {\r\n");
       nm_imprime_2($arq22, "       if (count(\$campos_sel) != count(\$_SESSION['sc_session'][\$sc_init]['" . $nome_aplicacao . "']['SC_Gb_Free_cmp']))\r\n");
       nm_imprime_2($arq22, "       {\r\n");
       nm_imprime_2($arq22, "           \$Change_free_groupby = true;\r\n");
       nm_imprime_2($arq22, "       }\r\n");
       nm_imprime_2($arq22, "       else\r\n");
       nm_imprime_2($arq22, "       {\r\n");
       nm_imprime_2($arq22, "          \$Arr_temp = array();\r\n");
       nm_imprime_2($arq22, "           foreach (\$_SESSION['sc_session'][\$sc_init]['" . $nome_aplicacao . "']['SC_Gb_Free_cmp'] as \$Cada_cmp => \$Resto)\r\n");
       nm_imprime_2($arq22, "           {\r\n");
       nm_imprime_2($arq22, "               \$Arr_temp[] = \$Cada_cmp;\r\n");
       nm_imprime_2($arq22, "           }\r\n");
       nm_imprime_2($arq22, "           foreach (\$campos_sel as \$ind => \$cada_cmp)\r\n");
       nm_imprime_2($arq22, "           {\r\n");
       nm_imprime_2($arq22, "               if (\$Arr_temp[\$ind] != \$cada_cmp)\r\n");
       nm_imprime_2($arq22, "               {\r\n");
       nm_imprime_2($arq22, "                   \$Change_free_groupby = true;\r\n");
       nm_imprime_2($arq22, "                   break;\r\n");
       nm_imprime_2($arq22, "               }\r\n");
       nm_imprime_2($arq22, "           }\r\n");
       nm_imprime_2($arq22, "       }\r\n");
       nm_imprime_2($arq22, "   }\r\n");
       nm_imprime_2($arq22, "   if (\$sel_groupby == \"sc_free_group_by\" && \$opc_ret == \"resumo\" && empty(\$this->campos_sel))\r\n");
       nm_imprime_2($arq22, "   { }\r\n");
       nm_imprime_2($arq22, "   elseif (\$sel_groupby != \$groupby_atual || \$Change_free_groupby)\r\n");
   }
   else
   {
       nm_imprime_2($arq22, "   if (\$sel_groupby != \$groupby_atual)\r\n");
   }
   nm_imprime_2($arq22, "   {\r\n");
   nm_imprime_2($arq22, "       \$_SESSION['sc_session'][\$sc_init]['" . $nome_aplicacao . "']['SC_Ind_Groupby']     = \$sel_groupby;\r\n");
   nm_imprime_2($arq22, "       \$_SESSION['sc_session'][\$sc_init]['" . $nome_aplicacao . "']['contr_array_resumo'] = \"NAO\";\r\n");
   nm_imprime_2($arq22, "       \$_SESSION['sc_session'][\$sc_init]['" . $nome_aplicacao . "']['contr_total_geral']  = \"NAO\";\r\n");
   nm_imprime_2($arq22, "       unset(\$_SESSION['sc_session'][\$sc_init]['" . $nome_aplicacao . "']['ordem_quebra']);\r\n");
   nm_imprime_2($arq22, "       unset(\$_SESSION['sc_session'][\$sc_init]['" . $nome_aplicacao . "']['ordem_select']);\r\n");
   nm_imprime_2($arq22, "       unset(\$_SESSION['sc_session'][\$sc_init]['" . $nome_aplicacao . "']['tot_geral']);\r\n");
   if ($nm_totaliza_php)
   {
       nm_imprime_2($arq22, "       unset(\$_SESSION['sc_session'][\$sc_init]['" . $nome_aplicacao . "']['arr_total']);\r\n");
   }
   nm_imprime_2($arq22, "       unset(\$_SESSION['sc_session'][\$sc_init]['" . $nome_aplicacao . "']['pivot_group_by']);\r\n");
   nm_imprime_2($arq22, "       unset(\$_SESSION['sc_session'][\$sc_init]['" . $nome_aplicacao . "']['pivot_x_axys']);\r\n");
   nm_imprime_2($arq22, "       unset(\$_SESSION['sc_session'][\$sc_init]['" . $nome_aplicacao . "']['pivot_y_axys']);\r\n");
   nm_imprime_2($arq22, "       unset(\$_SESSION['sc_session'][\$sc_init]['" . $nome_aplicacao . "']['pivot_fill']);\r\n");
   nm_imprime_2($arq22, "       unset(\$_SESSION['sc_session'][\$sc_init]['" . $nome_aplicacao . "']['pivot_order']);\r\n");
   nm_imprime_2($arq22, "       unset(\$_SESSION['sc_session'][\$sc_init]['" . $nome_aplicacao . "']['pivot_order_col']);\r\n");
   nm_imprime_2($arq22, "       unset(\$_SESSION['sc_session'][\$sc_init]['" . $nome_aplicacao . "']['pivot_order_level']);\r\n");
   nm_imprime_2($arq22, "       unset(\$_SESSION['sc_session'][\$sc_init]['" . $nome_aplicacao . "']['pivot_order_sort']);\r\n");
   nm_imprime_2($arq22, "       unset(\$_SESSION['sc_session'][\$sc_init]['" . $nome_aplicacao . "']['pivot_tabular']);\r\n");

   if ($tem_free_groupby)
   {
       nm_imprime_2($arq22, "       if (\$sel_groupby == \"sc_free_group_by\")\r\n");
       nm_imprime_2($arq22, "       {\r\n");
       nm_imprime_2($arq22, "           \$tab_arr_groubby_cmp = array();\r\n");
       nm_imprime_2($arq22, "           \$tab_arr_groubby_sql = array();\r\n");
       foreach ($tbapl_arr_quebras as $ind_qb => $resto)
       {
           if ($ind_qb == "sc_free_group_by")
           {
               $x = 0;
               foreach ($resto['ordem_quebra'] as $ind => $cmp)
               {
                   nm_imprime_2($arq22, "           \$tab_arr_groubby_cmp['" . $cmp . "'] = array('cmp' => \"" . $resto['ordem_quebra_def'][$ind] . "\", 'ind' => " . $x . ");\r\n");
                   $x++;
               }
               $x = 0;
               foreach ($resto['ordem_sql_quebra'] as $cmp => $ord)
               {
                   nm_imprime_2($arq22, "           \$tab_arr_groubby_sql[" . $x . "] = array('cmp' => \"" . $cmp . "\", 'ord' => '" . $ord . "');\r\n");
                   $x++;
               }
           }
       }
       nm_imprime_2($arq22, "           \$_SESSION['sc_session'][\$sc_init]['" . $nome_aplicacao . "']['SC_Gb_Free_cmp'] = array();\r\n");
       nm_imprime_2($arq22, "           \$_SESSION['sc_session'][\$sc_init]['" . $nome_aplicacao . "']['SC_Gb_Free_sql'] = array();\r\n");
       nm_imprime_2($arq22, "           foreach (\$campos_sel as \$cada_cmp)\r\n");
       nm_imprime_2($arq22, "           {\r\n");
       nm_imprime_2($arq22, "               if (!empty(\$cada_cmp))\r\n");
       nm_imprime_2($arq22, "               {\r\n");
       nm_imprime_2($arq22, "                   \$ind = \$tab_arr_groubby_cmp[\$cada_cmp]['ind'];\r\n");
       nm_imprime_2($arq22, "                   \$_SESSION['sc_session'][\$sc_init]['" . $nome_aplicacao . "']['SC_Gb_Free_cmp'][\$cada_cmp] = \$tab_arr_groubby_cmp[\$cada_cmp]['cmp'];\r\n");
       nm_imprime_2($arq22, "                   \$_SESSION['sc_session'][\$sc_init]['" . $nome_aplicacao . "']['SC_Gb_Free_sql'][\$tab_arr_groubby_sql[\$ind]['cmp']] = \$tab_arr_groubby_sql[\$ind]['ord'];\r\n");
       nm_imprime_2($arq22, "               }\r\n");
       nm_imprime_2($arq22, "           }\r\n");
       nm_imprime_2($arq22, "       }\r\n");
   }
   nm_imprime_2($arq22, "   }\r\n");

   if ($tem_free_groupby)
   {
       nm_imprime_2($arq22, "   if (\$sel_groupby == \"sc_free_group_by\")\r\n");
       nm_imprime_2($arq22, "   {\r\n");
       nm_imprime_2($arq22, "       \$groupby_this  = 0;\r\n");
       nm_imprime_2($arq22, "       \$groupby_count = sizeof(\$campos_sel);\r\n");
       nm_imprime_2($arq22, "       \$xaxys_count   = '' == \$this->xaxys_fields ? 0 : sizeof(explode(\"@?@\", \$this->xaxys_fields));\r\n");
       nm_imprime_2($arq22, "       \$xaxys_list    = array();\r\n");
       nm_imprime_2($arq22, "       \$yaxys_list    = array();\r\n");
       nm_imprime_2($arq22, "       for (\$i = 0; \$i < \$groupby_count; \$i++)\r\n");
       nm_imprime_2($arq22, "       {\r\n");
       nm_imprime_2($arq22, "           if (0 == \$xaxys_count)\r\n");
       nm_imprime_2($arq22, "           {\r\n");
       nm_imprime_2($arq22, "               \$yaxys_list[\$groupby_this] = \$groupby_this;\r\n");
       nm_imprime_2($arq22, "           }\r\n");
       nm_imprime_2($arq22, "           else\r\n");
       nm_imprime_2($arq22, "           {\r\n");
       nm_imprime_2($arq22, "               \$xaxys_list[\$groupby_this] = \$groupby_this;\r\n");
       nm_imprime_2($arq22, "               \$xaxys_count--;\r\n");
       nm_imprime_2($arq22, "           }\r\n");
       nm_imprime_2($arq22, "           \$groupby_this++;\r\n");
       nm_imprime_2($arq22, "       }\r\n");
       nm_imprime_2($arq22, "       \$_SESSION['sc_session'][\$sc_init]['" . $nome_aplicacao . "']['pivot_x_axys'] = \$xaxys_list;\r\n");
       nm_imprime_2($arq22, "       \$_SESSION['sc_session'][\$sc_init]['" . $nome_aplicacao . "']['pivot_y_axys'] = \$yaxys_list;\r\n");
       nm_imprime_2($arq22, "   }\r\n");
   }

   if ($tem_free_groupby || 'S' == $parms_tbapl_attr2['use_this_groupby_dynamic_total'])
   {
       nm_imprime_2($arq22, "   if (\$opc_ret == \"resumo\")\r\n");
       nm_imprime_2($arq22, "   {\r\n");
       nm_imprime_2($arq22, "       \$summ_fields = explode(\"@?@\", \$this->summ_fields);\r\n");
       nm_imprime_2($arq22, "       foreach (\$_SESSION['sc_session'][\$sc_init]['" . $nome_aplicacao . "']['summarizing_fields_display'] as \$i_sum => \$d_sum)\r\n");
       nm_imprime_2($arq22, "       {\r\n");
       nm_imprime_2($arq22, "           \$_SESSION['sc_session'][\$sc_init]['" . $nome_aplicacao . "']['summarizing_fields_display'][\$i_sum]['display'] = in_array(\$i_sum, \$summ_fields);\r\n");
       nm_imprime_2($arq22, "       }\r\n");
       nm_imprime_2($arq22, "       \$_SESSION['sc_session'][\$sc_init]['" . $nome_aplicacao . "']['summarizing_fields_order'] = \$summ_fields;\r\n");
       nm_imprime_2($arq22, "   }\r\n");
   }

   nm_imprime_2($arq22, "?>\r\n");
   nm_imprime_2($arq22,"    <script language=\"javascript\"> \r\n" ) ;

   nm_imprime_2($arq22, "<?php\r\n");
   nm_imprime_2($arq22,"   if (!\$embbed)\r\n");
   nm_imprime_2($arq22,"   {\r\n");
   nm_imprime_2($arq22, "?>\r\n");

   nm_imprime_2($arq22, "      self.parent.tb_remove(); \r\n");

   nm_imprime_2($arq22, "<?php\r\n");
   nm_imprime_2($arq22,"   }\r\n");
   nm_imprime_2($arq22, "?>\r\n");
   if ($apl_tem_ajax_navigate)
   {
       nm_imprime_2($arq22, "<?php\r\n");
       nm_imprime_2($arq22, "   \$sParent = \$embbed ? '' : 'parent.';\r\n");
       nm_imprime_2($arq22, "   if (\$opc_ret != \"resumo\")\r\n");
       nm_imprime_2($arq22, "   {\r\n");
       nm_imprime_2($arq22, "      echo \$sParent . \"nm_gp_submit_ajax('\" . \$opc_ret . \"', '')\"; \r\n");
       nm_imprime_2($arq22, "   }\r\n");
       nm_imprime_2($arq22, "   else\r\n");
       nm_imprime_2($arq22, "   {\r\n");
       nm_imprime_2($arq22, "      echo \$sParent . \"nm_gp_move('\" . \$opc_ret . \"', '0')\"; \r\n");
       nm_imprime_2($arq22, "   }\r\n");
       nm_imprime_2($arq22, "?>\r\n");
   }
   else
   {
/*       nm_imprime_2($arq22, "      parent.nm_gp_move('<?php echo \$opc_ret ?>', '0'); \r\n"); */
       nm_imprime_2($arq22, "      nm_gp_move('<?php echo \$opc_ret ?>', '0'); \r\n");
   }
   nm_imprime_2($arq22, "   </script>\r\n");
   nm_imprime_2($arq22, "<?php\r\n");
   nm_imprime_2($arq22, "}\r\n");
   nm_imprime_2($arq22, "   \r\n");

   nm_imprime_2($arq22, "function Sel_processa_form()\r\n");
   nm_imprime_2($arq22, "{\r\n");
   nm_imprime_2($arq22, "   global \$sc_init, \$path_img, \$path_btn, \$groupby_atual, \$opc_ret, \$embbed, \$tbar_pos;\r\n");
   nm_imprime_2($arq22,"   \$STR_lang    = (isset(\$_SESSION['scriptcase']['str_lang']) && !empty(\$_SESSION['scriptcase']['str_lang'])) ? \$_SESSION['scriptcase']['str_lang'] : \"$tbapl_idioma\";\r\n");
   nm_imprime_2($arq22,"   \$NM_arq_lang = \"../_lib/lang/\" . \$STR_lang . \".lang.php\";\r\n") ;

   nm_imprime_2($arq22,"   if (!function_exists(\"NM_is_utf8\"))\r\n");
   nm_imprime_2($arq22,"   {\r\n");
   nm_imprime_2($arq22,"       include_once(\"" . $nome_aplicacao . "_nmutf8.php\");\r\n") ;
   nm_imprime_2($arq22,"   }\r\n");

   nm_imprime_2($arq22,"   \$this->Nm_lang = array();\r\n") ;
   nm_imprime_2($arq22,"   if (is_file(\$NM_arq_lang))\r\n") ;
   nm_imprime_2($arq22,"   {\r\n") ;
   nm_imprime_2($arq22,"       include_once(\$NM_arq_lang);\r\n") ;
   nm_imprime_2($arq22,"   }\r\n") ;
   if ($charset_especifico)
   {
       nm_imprime_2($arq22,"   \$_SESSION['scriptcase']['charset']  = \"$apl_charset\";\r\n") ;
   }
   else
   {
       nm_imprime_2($arq22,"   \$_SESSION['scriptcase']['charset']  = (isset(\$this->Nm_lang['Nm_charset']) && !empty(\$this->Nm_lang['Nm_charset'])) ? \$this->Nm_lang['Nm_charset'] : \"$apl_charset\";\r\n") ;
   }
   nm_imprime_2($arq22,"   foreach (\$this->Nm_lang as \$ind => \$dados)\r\n") ;
   nm_imprime_2($arq22,"   {\r\n") ;
   nm_imprime_2($arq22,"      if (\$_SESSION['scriptcase']['charset'] != \"UTF-8\" && NM_is_utf8(\$ind))\r\n") ;
   nm_imprime_2($arq22,"      {\r\n") ;
   nm_imprime_2($arq22,"          \$ind = mb_convert_encoding(\$ind, \$_SESSION['scriptcase']['charset'], \"UTF-8\");\r\n") ;
   nm_imprime_2($arq22,"          \$this->Nm_lang[\$ind] = \$dados;\r\n") ;
   nm_imprime_2($arq22,"      }\r\n") ;
   nm_imprime_2($arq22,"      if (\$_SESSION['scriptcase']['charset'] != \"UTF-8\" && NM_is_utf8(\$dados))\r\n") ;
   nm_imprime_2($arq22,"      {\r\n") ;
   nm_imprime_2($arq22,"          \$this->Nm_lang[\$ind] = mb_convert_encoding(\$dados, \$_SESSION['scriptcase']['charset'], \"UTF-8\");\r\n") ;
   nm_imprime_2($arq22,"      }\r\n") ;
   nm_imprime_2($arq22,"   }\r\n") ;

   nm_imprime_2($arq22,"   \$display_free_gb  = false;\r\n") ;
   nm_imprime_2($arq22,"   \$arr_campos_free  = array();\r\n") ;
   if ($tem_free_groupby)
   {
       foreach ($campos_free_groupby as $cmp => $label)
       {
           $label = str_replace("this->Ini->", "this->", $label);
           $label = (substr($label, 0, 1) == '"') ? substr($label, 1, -1) : $label;
           nm_imprime_2($arq22,"   \$arr_campos_free['" . $cmp . "']  = (isset(\$_SESSION['sc_session'][\$sc_init]['" . $nome_aplicacao . "']['labels']['" . $cmp . "'])) ? \$_SESSION['sc_session'][\$sc_init]['" . $nome_aplicacao . "']['labels']['" . $cmp . "'] : \"" . $label . "\";\r\n") ;
       }
   }

   $arr_tmp_list_change = explode('__NM__', $tbapl_schema);
   list($str_sch_mod, $str_sch_all) = $arr_tmp_list_change;
   if ($apl_usa_schema_session == "S")
   {
       nm_imprime_2($arq22,"   \$str_schema_all = (isset(\$_SESSION['scriptcase']['str_schema_all']) && !empty(\$_SESSION['scriptcase']['str_schema_all'])) ? \$_SESSION['scriptcase']['str_schema_all'] : \"" . $str_sch_all . "/" . $str_sch_all . "\";\r\n");
   }
   else
   {
       nm_imprime_2($arq22,"   \$str_schema_all = (isset(\$_SESSION['sc_session'][\$sc_init]['$tbapl_cod_apl']['str_schema_all']) && !empty(\$_SESSION['sc_session'][\$sc_init]['$tbapl_cod_apl']['str_schema_all'])) ? \$_SESSION['sc_session'][\$sc_init]['$tbapl_cod_apl']['str_schema_all'] : \"" . $str_sch_all . "/" . $str_sch_all . "\";\r\n");
   }
   nm_imprime_2($arq22,"   include(\"../_lib/css/\" . \$str_schema_all . \"_grid.php\");\r\n") ;

   if (!empty($tbapl_button_esp))
   {
       if ($apl_usa_schema_session == "S")
       {
           nm_imprime_2($arq22,"   \$str_button = (isset(\$_SESSION['scriptcase']['str_button_all'])) ? \$_SESSION['scriptcase']['str_button_all'] : \"" . $tbapl_button_esp . "\";\r\n");
       }
       else
       {
           nm_imprime_2($arq22,"   \$str_button = \"" . $tbapl_button_esp . "\";\r\n");
       }
   }
   nm_imprime_2($arq22,"   \$Str_btn_grid = trim(\$str_button) . \"/\" . trim(\$str_button) . \$_SESSION['scriptcase']['reg_conf']['css_dir'] . \".php\";\r\n");

   nm_imprime_2($arq22,"   include(\"../_lib/buttons/\" . \$Str_btn_grid);\r\n") ;
   nm_imprime_2($arq22,"   if (!function_exists(\"nmButtonOutput\"))\r\n");
   nm_imprime_2($arq22,"   {\r\n");
   nm_imprime_2($arq22,"       include_once(\"../_lib/lib/php/nm_gp_config_btn.php\");\r\n") ;
   nm_imprime_2($arq22,"   }\r\n");

   nm_imprime_2($arq22,"   \$bStartFree   = true;\r\n");
   nm_imprime_2($arq22,"   \$bSummaryPage = isset(\$_GET['opc_ret']) && 'resumo' == \$_GET['opc_ret'];\r\n");

   $var_val = strip_tags($tbapl_titulo_grid);
   sc_preg_match_local($var_val, $var_local, $tbapl_idioma, $apl_charset);
   if (!empty($var_local[0]))
   {
       $var_local = $var_local[0];
       foreach ($var_local as $cada_var_loc)
       {
           $nome_var = substr($cada_var_loc, 1, strlen($cada_var_loc) - 2);
           if (substr($nome_var, 0, 5) == "lang_")
           {
                $cmp_troca = "<?php echo \$this->Nm_lang['" . $nome_var . "'] ?>";
                $var_val = str_replace($cada_var_loc, $cmp_troca, $var_val) ;
           }
       }
   }
   sc_preg_match_global($var_val, $var_local, $tbapl_idioma, $apl_charset);
   if (!empty($var_local[0]))
   {
       $var_local = $var_local[0];
       foreach ($var_local as $cada_var_loc)
       {
           $cmp_troca = "<?php echo \$_SESSION['" . substr($cada_var_loc, 1, strlen($cada_var_loc) - 2) . "'] ?>";
           $var_val = str_replace($cada_var_loc, $cmp_troca, $var_val) ;
       }
   }

   // incorporacao do group by na consulta
   nm_imprime_2($arq22,"   if (!\$embbed)\r\n");
   nm_imprime_2($arq22,"   {\r\n");

   nm_imprime_2($arq22, "?>\r\n");
   nm_imprime_2($arq22, $_SESSION['nm_session']['doctype'] . "\r\n");
   nm_imprime_2($arq22, "<HTML<?php echo \$_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>\r\n");
   nm_imprime_2($arq22, "<HEAD>\r\n") ;
   nm_imprime_2($arq22, " <TITLE>" . $var_val . "</TITLE>\r\n") ;
   nm_imprime_2($arq22, " " . $_SESSION['nm_session']['charset'] . "\r\n");

   nm_imprime_2($arq22,"<?php\r\n");
   nm_imprime_2($arq22, "if (\$_SESSION['scriptcase']['proc_mobile'])\r\n");
   nm_imprime_2($arq22, "{\r\n");
   nm_imprime_2($arq22, "?>\r\n");
   nm_imprime_2($arq22, "   <meta name=\"viewport\" content=\"width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;\" />\r\n", 7);
   nm_imprime_2($arq22,"<?php\r\n");
   nm_imprime_2($arq22, "}\r\n");
   nm_imprime_2($arq22, "?>\r\n");

   nm_imprime_2($arq22, " <META http-equiv=\"Expires\" content=\"Fri, Jan 01 1900 00:00:00 GMT\"/>\r\n");
   nm_imprime_2($arq22, " <META http-equiv=\"Last-Modified\" content=\"<?php echo gmdate(\"D, d M Y H:i:s\"); ?> GMT\"/>\r\n");
   nm_imprime_2($arq22, " <META http-equiv=\"Cache-Control\" content=\"no-store, no-cache, must-revalidate\"/>\r\n");
   nm_imprime_2($arq22, " <META http-equiv=\"Cache-Control\" content=\"post-check=0, pre-check=0\"/>\r\n");
   nm_imprime_2($arq22, " <META http-equiv=\"Pragma\" content=\"no-cache\"/>\r\n");
   nm_imprime_2($arq22, " <link rel=\"stylesheet\" type=\"text/css\" href=\"../_lib/css/<?php echo \$_SESSION['scriptcase']['css_popup'] ?>\" /> \r\n") ;
   nm_imprime_2($arq22, " <link rel=\"stylesheet\" type=\"text/css\" href=\"../_lib/css/<?php echo \$_SESSION['scriptcase']['css_popup_dir'] ?>\" /> \r\n") ;
   nm_imprime_2($arq22, " <link rel=\"stylesheet\" type=\"text/css\" href=\"../_lib/css/<?php echo \$_SESSION['scriptcase']['css_popup_tab'] ?>\" /> \r\n") ;
   nm_imprime_2($arq22, " <link rel=\"stylesheet\" type=\"text/css\" href=\"../_lib/css/<?php echo \$_SESSION['scriptcase']['css_popup_tab_dir'] ?>\" /> \r\n") ;
   nm_imprime_2($arq22, " <link rel=\"stylesheet\" type=\"text/css\" href=\"../_lib/css/<?php echo \$_SESSION['scriptcase']['css_popup_div'] ?>\" /> \r\n") ;
   nm_imprime_2($arq22, " <link rel=\"stylesheet\" type=\"text/css\" href=\"../_lib/css/<?php echo \$_SESSION['scriptcase']['css_popup_div_dir'] ?>\" /> \r\n") ;
   nm_imprime_2($arq22, " <link rel=\"stylesheet\" type=\"text/css\" href=\"../_lib/buttons/<?php echo \$_SESSION['scriptcase']['css_btn_popup'] ?>\" /> \r\n") ;
   nm_imprime_2($arq22, " <script language=\"javascript\" type=\"text/javascript\" src=\"<?php echo \$_SESSION['sc_session']['path_third'] ?>/jquery/js/jquery.js\"></script>\r\n") ;
   nm_imprime_2($arq22, " <script language=\"javascript\" type=\"text/javascript\" src=\"<?php echo \$_SESSION['sc_session']['path_third'] ?>/jquery/js/jquery-ui.js\"></script>\r\n") ;
   nm_imprime_2($arq22, " <script language=\"javascript\" type=\"text/javascript\" src=\"<?php echo \$_SESSION['sc_session']['path_third'] ?>/jquery_plugin/touch_punch/jquery.ui.touch-punch.min.js\"></script>\r\n", 11) ;
   nm_imprime_2($arq22, " <script language=\"javascript\" type=\"text/javascript\" src=\"<?php echo \$_SESSION['sc_session']['path_third'] ?>/tigra_color_picker/picker.js\"></script>\r\n") ;

   // incorporacao do group by na consulta
   nm_imprime_2($arq22,"<?php\r\n");
   nm_imprime_2($arq22,"   }\r\n");
   nm_imprime_2($arq22, "?>\r\n");

   nm_imprime_2($arq22, "<?php\r\n");
   nm_imprime_2($arq22, "if (\$embbed)\r\n");
   nm_imprime_2($arq22, "{\r\n");
   nm_imprime_2($arq22, "?>\r\n");
   nm_imprime_2($arq22, " <script language=\"javascript\" type=\"text/javascript\">\r\n");
   nm_imprime_2($arq22, "  function scSubmitGroupBy(sPos) {\r\n");
   nm_imprime_2($arq22, "   \$.ajax({\r\n");
   nm_imprime_2($arq22, "    type: \"POST\",\r\n");
   nm_imprime_2($arq22, "    url: \"" . $arquivo22 . "\",\r\n");
   nm_imprime_2($arq22, "    data: {\r\n");
   nm_imprime_2($arq22, "     script_case_init: \$(\"#sc_id_gby_script_case_init\").val(),\r\n");
   nm_imprime_2($arq22, "     script_case_session: \$(\"#sc_id_gby_script_case_session\").val(),\r\n");
   nm_imprime_2($arq22, "     path_img: \$(\"#sc_id_gby_path_img\").val(),\r\n");
   nm_imprime_2($arq22, "     path_btn: \$(\"#sc_id_gby_path_btn\").val(),\r\n");
   nm_imprime_2($arq22, "     opc_ret: \$(\"#sc_id_gby_opc_ret\").val(),\r\n");
   nm_imprime_2($arq22, "     campos_sel: \$(\"#sc_id_gby_campos_sel\").val(),\r\n");
   nm_imprime_2($arq22, "     xaxys_fields: \$(\"#sc_id_gby_xaxys_fields\").val(),\r\n");
   nm_imprime_2($arq22, "     summ_fields: \$(\"#sc_id_gby_summ_fields\").val(),\r\n");
   nm_imprime_2($arq22, "     fsel_ok: \$(\"#sc_id_gby_fsel_ok\").val(),\r\n");
   nm_imprime_2($arq22, "     sel_groupby: $(\".sc_ui_gby_selected:checked\").val(),\r\n");
   nm_imprime_2($arq22, "     embbed_groupby: 'Y'\r\n");
   nm_imprime_2($arq22, "    }\r\n");
   nm_imprime_2($arq22, "   }).success(function(data) {\r\n");
   nm_imprime_2($arq22, "    \$(\"#sc_id_groupby_placeholder_\" + sPos).find(\"td\").html(data);\r\n");
   nm_imprime_2($arq22, "    scBtnGroupByHide(sPos);\r\n");
   nm_imprime_2($arq22, "   });\r\n");
   nm_imprime_2($arq22, "  }\r\n");
   nm_imprime_2($arq22, "  </script>\r\n");
   nm_imprime_2($arq22, "<?php\r\n");
   nm_imprime_2($arq22, "}\r\n");
   nm_imprime_2($arq22, "?>\r\n");
   nm_imprime_2($arq22, " <script language=\"javascript\" type=\"text/javascript\">\r\n");
   nm_imprime_2($arq22, "<?php\r\n");
   nm_imprime_2($arq22, "if (\$bSummaryPage)\r\n");
   nm_imprime_2($arq22, "{\r\n");
   nm_imprime_2($arq22, "    \$aOptions = array();\r\n");
   nm_imprime_2($arq22, "    foreach (\$_SESSION['sc_session'][\$sc_init]['" . $nome_aplicacao . "']['summarizing_fields_control'] as \$l_field => \$d_field)\r\n");
   nm_imprime_2($arq22, "    {\r\n");
   nm_imprime_2($arq22, "        \$aOptions[] = \"sc_id_item_summ_\" . \$l_field . \": \\\"\" . str_replace('\"', '\\\"', \$d_field['select']) . \"\\\"\";\r\n");
   nm_imprime_2($arq22, "    }\r\n");
   nm_imprime_2($arq22, "?>\r\n");
   nm_imprime_2($arq22, "  var scTotalOptions = {<?php echo implode(', ', \$aOptions); ?>};\r\n");
   nm_imprime_2($arq22, "<?php\r\n");
   nm_imprime_2($arq22, "}\r\n");
   nm_imprime_2($arq22, "?>\r\n");
   nm_imprime_2($arq22, "  $(function() {\r\n");
   nm_imprime_2($arq22, "   $(\".scAppDivTabLine\").find(\"li\").mouseover(function() {\r\n");
   nm_imprime_2($arq22, "    \$(this).css(\"cursor\", \"pointer\");\r\n");
   nm_imprime_2($arq22, "   });\r\n");
   nm_imprime_2($arq22, "   $(\".sc_ui_litem\").mouseover(function() {\r\n");
   nm_imprime_2($arq22, "    \$(this).css(\"cursor\", \"all-scroll\");\r\n");
   nm_imprime_2($arq22, "   });\r\n");
   nm_imprime_2($arq22, "   $(\"#sc_id_available\").sortable({\r\n");
   nm_imprime_2($arq22, "    connectWith: \".sc_ui_sort_groupby\",\r\n");
   nm_imprime_2($arq22, "    placeholder: \"scAppDivSelectFieldsPlaceholder\"\r\n");
   nm_imprime_2($arq22, "   }).disableSelection();\r\n");
   nm_imprime_2($arq22, "   $(\"#sc_id_yaxys\").sortable({\r\n");
   nm_imprime_2($arq22, "    connectWith: \".sc_ui_sort_groupby\",\r\n");
   nm_imprime_2($arq22, "    placeholder: \"scAppDivSelectFieldsPlaceholder\",\r\n");
   nm_imprime_2($arq22, "    update: function(event, ui) {\r\n");
   nm_imprime_2($arq22, "     \$(\"#sc_id_sel_groupby_sc_free_group_by\").prop(\"checked\", true);\r\n");
   nm_imprime_2($arq22, "    }\r\n");
   nm_imprime_2($arq22, "   }).disableSelection();\r\n");
   nm_imprime_2($arq22, "<?php\r\n");
   nm_imprime_2($arq22, "if (\$bSummaryPage)\r\n");
   nm_imprime_2($arq22, "{\r\n");
   nm_imprime_2($arq22, "?>\r\n");
   nm_imprime_2($arq22, "   $(\"#sc_id_xaxys\").sortable({\r\n");
   nm_imprime_2($arq22, "    connectWith: \".sc_ui_sort_groupby\",\r\n");
   nm_imprime_2($arq22, "    placeholder: \"scAppDivSelectFieldsPlaceholder\",\r\n");
   nm_imprime_2($arq22, "    update: function(event, ui) {\r\n");
   nm_imprime_2($arq22, "     \$(\"#sc_id_sel_groupby_sc_free_group_by\").prop(\"checked\", true);\r\n");
   nm_imprime_2($arq22, "    }\r\n");
   nm_imprime_2($arq22, "   }).disableSelection();\r\n");
   nm_imprime_2($arq22, "   $(\"#sc_id_summ_available\").sortable({\r\n");
   nm_imprime_2($arq22, "    helper: \"clone\",\r\n");
   nm_imprime_2($arq22, "    connectWith: \".sc_ui_sort_summ\",\r\n");
   nm_imprime_2($arq22, "    placeholder: \"scAppDivSelectFieldsPlaceholder\",\r\n");
   nm_imprime_2($arq22, "    remove: function(event, ui) {\r\n");
   nm_imprime_2($arq22, "     var idx, elm, eid, nid, fieldName, opName;\r\n");
   nm_imprime_2($arq22, "     fieldName = \$(ui.item[0]).attr(\"id\").substr(16);\r\n");
   nm_imprime_2($arq22, "     opName = scSummFirstAvailable(fieldName);\r\n");
   nm_imprime_2($arq22, "     if (false == opName) {\r\n");
   nm_imprime_2($arq22, "      \$(this).sortable(\"cancel\");\r\n");
   nm_imprime_2($arq22, "      return;\r\n");
   nm_imprime_2($arq22, "     }\r\n");
   nm_imprime_2($arq22, "     idx = \$(\"#sc_id_summ_selected\").children().index(\$(ui.item[0]));\r\n");
   nm_imprime_2($arq22, "     if (idx == -1) return;\r\n");
   nm_imprime_2($arq22, "     elm = \$(ui.item[0]).clone(true).removeClass(\"box ui-draggable ui-draggable-dragging\").addClass(\"box-clone\");\r\n");
   nm_imprime_2($arq22, "     eid = elm.attr(\"id\");\r\n");
   nm_imprime_2($arq22, "     nid = eid.substr(0, 16) + scSummItemCount.toString();\r\n");
   nm_imprime_2($arq22, "     scSummItemCount++;\r\n");
   nm_imprime_2($arq22, "     elm.attr(\"id\", nid).find(\".sc-ui-total-options\").html(scTotalOptions[eid]);\r\n");
   nm_imprime_2($arq22, "     \$(\"#sc_id_summ_selected\").children(\":eq(\" + idx + \")\").after(elm);\r\n");
   nm_imprime_2($arq22, "     \$(this).sortable(\"cancel\");\r\n");
   nm_imprime_2($arq22, "     scSummOptionsSetNew(\$(\"#sc_id_summ_selected\").children(\":eq(\" + idx + \")\").find(\"select\"), fieldName, opName);\r\n");
   nm_imprime_2($arq22, "     scSummOptionsSet(fieldName, opName, false);\r\n");
   nm_imprime_2($arq22, "     ajusta_window();\r\n");
   nm_imprime_2($arq22, "    }\r\n");
   nm_imprime_2($arq22, "   }).disableSelection();\r\n");
   nm_imprime_2($arq22, "   $(\"#sc_id_summ_selected\").sortable({\r\n");
   nm_imprime_2($arq22, "    connectWith: \".sc_ui_sort_summ\",\r\n");
   nm_imprime_2($arq22, "    placeholder: \"scAppDivSelectFieldsPlaceholder\",\r\n");
   nm_imprime_2($arq22, "    remove: function(event, ui) {\r\n");
   nm_imprime_2($arq22, "     var fieldName, opName;\r\n");
   nm_imprime_2($arq22, "     fieldName = \$(ui.item[0]).find(\"select\").attr(\"class\").substr(13);\r\n");
   nm_imprime_2($arq22, "     opName = \$(ui.item[0]).find(\"select\").find(\":selected\").attr(\"class\").substr(20);\r\n");
   nm_imprime_2($arq22, "     \$(this).sortable(\"cancel\");\r\n");
   nm_imprime_2($arq22, "     \$(ui.item[0]).remove();\r\n");
   nm_imprime_2($arq22, "     scSummOptionsSet(fieldName, opName, true);\r\n");
   nm_imprime_2($arq22, "     ajusta_window();\r\n");
   nm_imprime_2($arq22, "    }\r\n");
   nm_imprime_2($arq22, "   });\r\n");
   nm_imprime_2($arq22, "<?php\r\n");
   nm_imprime_2($arq22, "}\r\n");
   nm_imprime_2($arq22, "?>\r\n");
   nm_imprime_2($arq22, "   $(\"#sc_id_show_static\").click(function() {\r\n");
   nm_imprime_2($arq22, "    scShowStatic();\r\n");
   nm_imprime_2($arq22, "   });\r\n");
   nm_imprime_2($arq22, "   $(\"#sc_id_show_free\").click(function() {\r\n");
   nm_imprime_2($arq22, "    scShowFree();\r\n");
   nm_imprime_2($arq22, "   });\r\n");
   nm_imprime_2($arq22, "   $(\"#sc_id_show_total\").click(function() {\r\n");
   nm_imprime_2($arq22, "    scShowTotal();\r\n");
   nm_imprime_2($arq22, "   });\r\n");
   nm_imprime_2($arq22, "   scUpdateListHeight();\r\n");
   nm_imprime_2($arq22, "  });\r\n");
   nm_imprime_2($arq22, "  function scUpdateListHeight() {\r\n");
   nm_imprime_2($arq22, "   $(\"#sc_id_available\").css(\"min-height\", \"<?php echo sizeof(\$arr_campos_free) * 29 ?>px\");\r\n");
   nm_imprime_2($arq22, "   $(\"#sc_id_yaxys\").css(\"min-height\", \"<?php echo sizeof(\$arr_campos_free) * 29 ?>px\");\r\n");
   nm_imprime_2($arq22, "   $(\"#sc_id_xaxys\").css(\"min-height\", \"29px\");\r\n");
   nm_imprime_2($arq22, "<?php\r\n");
   nm_imprime_2($arq22, "if (\$bSummaryPage)\r\n");
   nm_imprime_2($arq22, "{\r\n");
   nm_imprime_2($arq22, "?>\r\n");
   nm_imprime_2($arq22, "   $(\"#sc_id_summ_available\").css(\"min-height\", \"<?php echo sizeof(\$_SESSION['sc_session'][\$sc_init]['" . $nome_aplicacao . "']['summarizing_fields_display']) * 29 ?>px\");\r\n");
   nm_imprime_2($arq22, "   $(\"#sc_id_summ_selected\").css(\"min-height\", \"<?php echo sizeof(\$_SESSION['sc_session'][\$sc_init]['" . $nome_aplicacao . "']['summarizing_fields_display']) * 29 ?>px\");\r\n");
   nm_imprime_2($arq22, "<?php\r\n");
   nm_imprime_2($arq22, "}\r\n");
   nm_imprime_2($arq22, "?>\r\n");
   nm_imprime_2($arq22, "  }\r\n");
   nm_imprime_2($arq22, "  function scPackGroupBy() {\r\n");
   nm_imprime_2($arq22, "   var fieldList, i, fieldName, selectedFields = new Array, xaxysFields = new Array, summFields = new Array;\r\n");
   nm_imprime_2($arq22, "<?php\r\n");
   nm_imprime_2($arq22, "if (\$bSummaryPage)\r\n");
   nm_imprime_2($arq22, "{\r\n");
   nm_imprime_2($arq22, "?>\r\n");
   nm_imprime_2($arq22, "   fieldList = $(\"#sc_id_xaxys\").sortable(\"toArray\");\r\n");
   nm_imprime_2($arq22, "   for (i = 0; i < fieldList.length; i++) {\r\n");
   nm_imprime_2($arq22, "    fieldName = fieldList[i].substr(11);\r\n");
   nm_imprime_2($arq22, "    selectedFields.push(fieldName);\r\n");
   nm_imprime_2($arq22, "    xaxysFields.push(fieldName);\r\n");
   nm_imprime_2($arq22, "   }\r\n");
   nm_imprime_2($arq22, "   \$(\"#sc_id_gby_xaxys_fields\").val(xaxysFields.join(\"@?@\"));\r\n");
   nm_imprime_2($arq22, "   fieldList = $(\"#sc_id_summ_selected\").sortable(\"toArray\");\r\n");
   nm_imprime_2($arq22, "   for (i = 0; i < fieldList.length; i++) {\r\n");
   nm_imprime_2($arq22, "    fieldName = \$(\"#\" + fieldList[i]).find(\"select\").val();\r\n");
   nm_imprime_2($arq22, "    summFields.push(fieldName);\r\n");
   nm_imprime_2($arq22, "   }\r\n");
   nm_imprime_2($arq22, "   \$(\"#sc_id_gby_summ_fields\").val(summFields.join(\"@?@\"));\r\n");
   nm_imprime_2($arq22, "<?php\r\n");
   nm_imprime_2($arq22, "}\r\n");
   nm_imprime_2($arq22, "?>\r\n");
   nm_imprime_2($arq22, "   fieldList = $(\"#sc_id_yaxys\").sortable(\"toArray\");\r\n");
   nm_imprime_2($arq22, "   for (i = 0; i < fieldList.length; i++) {\r\n");
   nm_imprime_2($arq22, "    fieldName = fieldList[i].substr(11);\r\n");
   nm_imprime_2($arq22, "    selectedFields.push(fieldName);\r\n");
   nm_imprime_2($arq22, "   }\r\n");
   nm_imprime_2($arq22, "   \$(\"#sc_id_gby_campos_sel\").val(selectedFields.join(\"@?@\"));\r\n");
   nm_imprime_2($arq22, "  }\r\n");
   nm_imprime_2($arq22, "  function scShowStatic() {\r\n");
   nm_imprime_2($arq22,"    \$(\"#sc_id_static_groupby\").show();\r\n");
   nm_imprime_2($arq22,"    \$(\"#sc_id_free_groupby\").hide();\r\n");
   nm_imprime_2($arq22,"    \$(\"#sc_id_summary\").hide();\r\n");
   nm_imprime_2($arq22,"    \$(\"#sc_id_show_static\").addClass(\"scTabActive\").removeClass(\"scTabInactive\");\r\n");
   nm_imprime_2($arq22,"    \$(\"#sc_id_show_free\").addClass(\"scTabInactive\").removeClass(\"scTabActive\");\r\n");
   nm_imprime_2($arq22,"    \$(\"#sc_id_show_total\").addClass(\"scTabInactive\").removeClass(\"scTabActive\");\r\n");

   // incorporacao do group by na consulta
   nm_imprime_2($arq22,"<?php\r\n");
   nm_imprime_2($arq22,"   if (!\$embbed)\r\n");
   nm_imprime_2($arq22,"   {\r\n");
   nm_imprime_2($arq22, "?>\r\n");

   nm_imprime_2($arq22, "   ajusta_window();\r\n");

   // incorporacao do group by na consulta
   nm_imprime_2($arq22,"<?php\r\n");
   nm_imprime_2($arq22,"   }\r\n");
   nm_imprime_2($arq22, "?>\r\n");

   nm_imprime_2($arq22, "  }\r\n");
   nm_imprime_2($arq22, "  function scShowFree() {\r\n");
   nm_imprime_2($arq22,"    \$(\"#sc_id_static_groupby\").hide();\r\n");
   nm_imprime_2($arq22,"    \$(\"#sc_id_free_groupby\").show();\r\n");
   nm_imprime_2($arq22,"    \$(\"#sc_id_summary\").hide();\r\n");
   nm_imprime_2($arq22,"    \$(\"#sc_id_show_static\").addClass(\"scTabInactive\").removeClass(\"scTabActive\");\r\n");
   nm_imprime_2($arq22,"    \$(\"#sc_id_show_free\").addClass(\"scTabActive\").removeClass(\"scTabInactive\");\r\n");
   nm_imprime_2($arq22,"    \$(\"#sc_id_show_total\").addClass(\"scTabInactive\").removeClass(\"scTabActive\");\r\n");

   // incorporacao do group by na consulta
   nm_imprime_2($arq22,"<?php\r\n");
   nm_imprime_2($arq22,"   if (!\$embbed)\r\n");
   nm_imprime_2($arq22,"   {\r\n");
   nm_imprime_2($arq22, "?>\r\n");

   nm_imprime_2($arq22, "   ajusta_window();\r\n");

   // incorporacao do group by na consulta
   nm_imprime_2($arq22,"<?php\r\n");
   nm_imprime_2($arq22,"   }\r\n");
   nm_imprime_2($arq22, "?>\r\n");

   nm_imprime_2($arq22, "  }\r\n");
   nm_imprime_2($arq22, "  function scShowTotal() {\r\n");
   nm_imprime_2($arq22,"    \$(\"#sc_id_static_groupby\").hide();\r\n");
   nm_imprime_2($arq22,"    \$(\"#sc_id_free_groupby\").hide();\r\n");
   nm_imprime_2($arq22,"    \$(\"#sc_id_summary\").show();\r\n");
   nm_imprime_2($arq22,"    \$(\"#sc_id_show_static\").addClass(\"scTabInactive\").removeClass(\"scTabActive\");\r\n");
   nm_imprime_2($arq22,"    \$(\"#sc_id_show_free\").addClass(\"scTabInactive\").removeClass(\"scTabActive\");\r\n");
   nm_imprime_2($arq22,"    \$(\"#sc_id_show_total\").addClass(\"scTabActive\").removeClass(\"scTabInactive\");\r\n");

   // incorporacao do group by na consulta
   nm_imprime_2($arq22,"<?php\r\n");
   nm_imprime_2($arq22,"   if (!\$embbed)\r\n");
   nm_imprime_2($arq22,"   {\r\n");
   nm_imprime_2($arq22, "?>\r\n");

   nm_imprime_2($arq22, "   ajusta_window();\r\n");

   // incorporacao do group by na consulta
   nm_imprime_2($arq22,"<?php\r\n");
   nm_imprime_2($arq22,"   }\r\n");
   nm_imprime_2($arq22, "?>\r\n");

   nm_imprime_2($arq22, "  }\r\n");

   nm_imprime_2($arq22, "  function scSummOptionsInit() {\r\n");
   nm_imprime_2($arq22, "   var fieldList, fieldObject, fieldName, fieldOption, i;\r\n");
   nm_imprime_2($arq22, "   fieldList = $(\"#sc_id_summ_selected\").sortable(\"toArray\");\r\n");
   nm_imprime_2($arq22, "   for (i = 0; i < fieldList.length; i++) {\r\n");
   nm_imprime_2($arq22, "    fieldObject = \$(\"#\" + fieldList[i]).find(\"select\");\r\n");
   nm_imprime_2($arq22, "    fieldName = fieldObject.attr(\"class\").substr(13);\r\n");
   nm_imprime_2($arq22, "    fieldOption = fieldObject.find(\":selected\").attr(\"class\").substr(20);\r\n");
   nm_imprime_2($arq22, "    scSummStatus[fieldName][fieldOption] = false;\r\n");
   nm_imprime_2($arq22, "   }\r\n");
   nm_imprime_2($arq22, "   scSummOptionsDraw();\r\n");
   nm_imprime_2($arq22, "  }\r\n");

   nm_imprime_2($arq22, "  function scSummOptionsSet(fieldName, opName, opValue) {\r\n");
   nm_imprime_2($arq22, "   scSummStatus[fieldName][opName] = opValue;\r\n");
   nm_imprime_2($arq22, "   if (opValue) {\r\n");
   nm_imprime_2($arq22, "    \$(\"#sc_id_item_summ_\" + fieldName).find(\".sc-ui-select-available-\" + opName).removeClass(\"scAppDivSelectBoxDisabled\");\r\n");
   nm_imprime_2($arq22, "    \$(\".sc-ui-select-\" + fieldName).find(\".sc-ui-select-option-\" + opName).prop(\"disabled\", false);\r\n");
   nm_imprime_2($arq22, "   }\r\n");
   nm_imprime_2($arq22, "   else {\r\n");
   nm_imprime_2($arq22, "    \$(\"#sc_id_item_summ_\" + fieldName).find(\".sc-ui-select-available-\" + opName).addClass(\"scAppDivSelectBoxDisabled\");\r\n");
   nm_imprime_2($arq22, "    \$(\".sc-ui-select-\" + fieldName).find(\".sc-ui-select-option-\" + opName).filter(\":not(:selected)\").prop(\"disabled\", true);\r\n");
   nm_imprime_2($arq22, "   }\r\n");
   nm_imprime_2($arq22, "   scSummFieldStatus(fieldName);\r\n");
   nm_imprime_2($arq22, "  }\r\n");

   nm_imprime_2($arq22, "  function scSummOptionsSetNew(fieldObj, fieldName, opSelected) {\r\n");
   nm_imprime_2($arq22, "   fieldObj.find(\".sc-ui-select-option-\" + opSelected).prop(\"selected\", true);\r\n");
   nm_imprime_2($arq22, "   for (opName in scSummStatus[fieldName]) {\r\n");
   nm_imprime_2($arq22, "    if (opName != opSelected && !scSummStatus[fieldName][opName]) {\r\n");
   nm_imprime_2($arq22, "     fieldObj.find(\".sc-ui-select-option-\" + opName).prop(\"disabled\", true);\r\n");
   nm_imprime_2($arq22, "    }\r\n");
   nm_imprime_2($arq22, "   }\r\n");
   nm_imprime_2($arq22, "   scSummFieldStatus(fieldName);\r\n");
   nm_imprime_2($arq22, "  }\r\n");

   nm_imprime_2($arq22, "  function scSummChange(fieldObj) {\r\n");
   nm_imprime_2($arq22, "   var fieldName, opName, fieldList, i;\r\n");
   nm_imprime_2($arq22, "   fieldName = fieldObj.attr(\"class\").substr(13);\r\n");
   nm_imprime_2($arq22, "   for (opName in scSummStatus[fieldName]) {\r\n");
   nm_imprime_2($arq22, "    scSummStatus[fieldName][opName] = true;\r\n");
   nm_imprime_2($arq22, "    \$(\"#sc_id_item_summ_\" + fieldName).find(\".sc-ui-select-available-\" + opName).removeClass(\"scAppDivSelectBoxDisabled\");\r\n");
   nm_imprime_2($arq22, "    \$(\".sc-ui-select-\" + fieldName).find(\".sc-ui-select-option-\" + opName).prop(\"disabled\", false);\r\n");
   nm_imprime_2($arq22, "   }\r\n");
   nm_imprime_2($arq22, "   fieldList = \$(\".\" + fieldObj.attr(\"class\"));\r\n");
   nm_imprime_2($arq22, "   for (i = 0; i < fieldList.length; i++) {\r\n");
   nm_imprime_2($arq22, "    opName = \$(fieldList[i]).find(\":selected\").attr(\"class\").substr(20);\r\n");
   nm_imprime_2($arq22, "    scSummStatus[fieldName][opName] = false;\r\n");
   nm_imprime_2($arq22, "    \$(\"#sc_id_item_summ_\" + fieldName).find(\".sc-ui-select-available-\" + opName).addClass(\"scAppDivSelectBoxDisabled\");\r\n");
   nm_imprime_2($arq22, "    \$(\".sc-ui-select-\" + fieldName).find(\".sc-ui-select-option-\" + opName).filter(\":not(:selected)\").prop(\"disabled\", true);\r\n");
   nm_imprime_2($arq22, "   }\r\n");
   nm_imprime_2($arq22, "  }\r\n");

   nm_imprime_2($arq22, "  function scSummOptionsDraw() {\r\n");
   nm_imprime_2($arq22, "   var fieldName, opName;\r\n");
   nm_imprime_2($arq22, "   for (fieldName in scSummStatus) {\r\n");
   nm_imprime_2($arq22, "    for (opName in scSummStatus[fieldName]) {\r\n");
   nm_imprime_2($arq22, "     if (scSummStatus[fieldName][opName]) {\r\n");
   nm_imprime_2($arq22, "      \$(\"#sc_id_item_summ_\" + fieldName).find(\".sc-ui-select-available-\" + opName).removeClass(\"scAppDivSelectBoxDisabled\");\r\n");
   nm_imprime_2($arq22, "      \$(\".sc-ui-select-\" + fieldName).find(\".sc-ui-select-option-\" + opName).filter(\":selected\").prop(\"disabled\", false);\r\n");
   nm_imprime_2($arq22, "     }\r\n");
   nm_imprime_2($arq22, "     else {\r\n");
   nm_imprime_2($arq22, "      \$(\"#sc_id_item_summ_\" + fieldName).find(\".sc-ui-select-available-\" + opName).addClass(\"scAppDivSelectBoxDisabled\");\r\n");
   nm_imprime_2($arq22, "      \$(\".sc-ui-select-\" + fieldName).find(\".sc-ui-select-option-\" + opName).filter(\":not(:selected)\").prop(\"disabled\", true);\r\n");
   nm_imprime_2($arq22, "     }\r\n");
   nm_imprime_2($arq22, "    }\r\n");
   nm_imprime_2($arq22, "    scSummFieldStatus(fieldName);\r\n");
   nm_imprime_2($arq22, "   }\r\n");
   nm_imprime_2($arq22, "  }\r\n");

   nm_imprime_2($arq22, "  function scSummFieldStatus(fieldName) {\r\n");
   nm_imprime_2($arq22, "   if (false == scSummFirstAvailable(fieldName)) {\r\n");
   nm_imprime_2($arq22, "    \$(\"#sc_id_item_summ_\" + fieldName).addClass(\"scAppDivSelectFieldsDisabled\");\r\n");
   nm_imprime_2($arq22, "   }\r\n");
   nm_imprime_2($arq22, "   else {\r\n");
   nm_imprime_2($arq22, "    \$(\"#sc_id_item_summ_\" + fieldName).removeClass(\"scAppDivSelectFieldsDisabled\");\r\n");
   nm_imprime_2($arq22, "   }\r\n");
   nm_imprime_2($arq22, "  }\r\n");

   nm_imprime_2($arq22, "  function scSummFirstAvailable(fieldName) {\r\n");
   nm_imprime_2($arq22, "   for (opName in scSummStatus[fieldName]) {\r\n");
   nm_imprime_2($arq22, "    if (scSummStatus[fieldName][opName]) {\r\n");
   nm_imprime_2($arq22, "     return opName;\r\n");
   nm_imprime_2($arq22, "    }\r\n");
   nm_imprime_2($arq22, "   }\r\n");
   nm_imprime_2($arq22, "   return false;\r\n");
   nm_imprime_2($arq22, "  }\r\n");

   nm_imprime_2($arq22, " </script>\r\n");
   nm_imprime_2($arq22, " <style type=\"text/css\">\r\n");
   nm_imprime_2($arq22, "  .sc_ui_sortable {\r\n");
   nm_imprime_2($arq22, "   list-style-type: none;\r\n");
   nm_imprime_2($arq22, "   margin: 0;\r\n");
   nm_imprime_2($arq22, "  }\r\n");
   nm_imprime_2($arq22, "  .sc_ui_sortable li {\r\n");
   nm_imprime_2($arq22, "   margin: 0 3px 3px 3px;\r\n");
   nm_imprime_2($arq22, "   padding: 3px 3px 3px 15px;\r\n");
   nm_imprime_2($arq22, "   height: 18px;\r\n");
   nm_imprime_2($arq22, "  }\r\n");
   nm_imprime_2($arq22, "  .sc_ui_sortable li span {\r\n");
   nm_imprime_2($arq22, "   position: absolute;\r\n");
   nm_imprime_2($arq22, "   margin-left: -1.3em;\r\n");
   nm_imprime_2($arq22, "  }\r\n");
   nm_imprime_2($arq22, "  .sc_ui_ulist {\r\n");
   nm_imprime_2($arq22, "   width: 150px;\r\n");
   nm_imprime_2($arq22, "  }\r\n");
   nm_imprime_2($arq22, "  .sc_ui_ulist_total {\r\n");
   nm_imprime_2($arq22, "   width: 250px;\r\n");
   nm_imprime_2($arq22, "  }\r\n");
   nm_imprime_2($arq22, "  .sc_ui_litem {\r\n");
   nm_imprime_2($arq22, "  }\r\n");
   nm_imprime_2($arq22, "  .sc_ui_litem_total {\r\n");
   nm_imprime_2($arq22, "   height: 25px !important;\r\n");
   nm_imprime_2($arq22, "  }\r\n");
   nm_imprime_2($arq22, " </style>\r\n");

   // incorporacao do group by na consulta
   nm_imprime_2($arq22,"<?php\r\n");
   nm_imprime_2($arq22,"   if (!\$embbed)\r\n");
   nm_imprime_2($arq22,"   {\r\n");
   nm_imprime_2($arq22, "?>\r\n");

   nm_imprime_2($arq22, "</HEAD>\r\n") ;
   nm_imprime_2($arq22, "<BODY class=\"scGridPage\" style=\"margin: 0px; overflow-x: hidden\">\r\n") ;

   // incorporacao do group by na consulta
   nm_imprime_2($arq22,"<?php\r\n");
   nm_imprime_2($arq22,"   }\r\n");
   nm_imprime_2($arq22, "?>\r\n");

   nm_imprime_2($arq22, "<FORM name=\"Fsel_quebras\" method=\"POST\">\r\n");
   nm_imprime_2($arq22, "  <INPUT type=\"hidden\" name=\"script_case_init\" id=\"sc_id_gby_script_case_init\" value=\"<?php echo NM_encode_input(\$sc_init); ?>\"> \r\n") ;
   nm_imprime_2($arq22, "  <INPUT type=\"hidden\" name=\"script_case_session\" id=\"sc_id_gby_script_case_session\" value=\"<?php echo NM_encode_input(session_id()); ?>\"> \r\n") ;
   nm_imprime_2($arq22, "  <INPUT type=\"hidden\" name=\"path_img\" id=\"sc_id_gby_path_img\" value=\"<?php echo NM_encode_input(\$path_img); ?>\"> \r\n") ;
   nm_imprime_2($arq22, "  <INPUT type=\"hidden\" name=\"path_btn\" id=\"sc_id_gby_path_btn\" value=\"<?php echo NM_encode_input(\$path_btn); ?>\"> \r\n") ;
   nm_imprime_2($arq22, "  <INPUT type=\"hidden\" name=\"opc_ret\" id=\"sc_id_gby_opc_ret\" value=\"<?php echo NM_encode_input(\$opc_ret); ?>\"> \r\n") ;
   nm_imprime_2($arq22, "  <INPUT type=\"hidden\" name=\"campos_sel\" id=\"sc_id_gby_campos_sel\" value=\"\">\r\n");
   nm_imprime_2($arq22, "  <INPUT type=\"hidden\" name=\"xaxys_fields\" id=\"sc_id_gby_xaxys_fields\" value=\"\">\r\n");
   nm_imprime_2($arq22, "  <INPUT type=\"hidden\" name=\"summ_fields\" id=\"sc_id_gby_summ_fields\" value=\"\">\r\n");
   nm_imprime_2($arq22, "  <INPUT type=\"hidden\" name=\"fsel_ok\" id=\"sc_id_gby_fsel_ok\" value=\"OK\"> \r\n") ;

   nm_imprime_2($arq22, "<?php\r\n") ;

   // incorporacao do group by na consulta
   nm_imprime_2($arq22, "if (\$embbed)\r\n");
   nm_imprime_2($arq22, "{\r\n");
   nm_imprime_2($arq22, "    echo \"<div class='scAppDivMoldura'>\";\r\n") ;
   nm_imprime_2($arq22, "    echo \"<table id=\\\"main_table\\\" style=\\\"width: 100%\\\" cellspacing=0 cellpadding=0>\";\r\n") ;
   nm_imprime_2($arq22, "}\r\n");

   nm_imprime_2($arq22, "elseif (\$_SESSION['scriptcase']['reg_conf']['html_dir'] == \" DIR='RTL'\")\r\n") ;
   nm_imprime_2($arq22, "{\r\n") ;
   nm_imprime_2($arq22, "    echo \"<table class=\\\"scGridBorder\\\" id=\\\"main_table\\\" style=\\\"position: relative; top: 20px; right: 20px; min-width: 500px\\\">\";\r\n") ;
   nm_imprime_2($arq22, "}\r\n") ;
   nm_imprime_2($arq22, "else\r\n") ;
   nm_imprime_2($arq22, "{\r\n") ;
   nm_imprime_2($arq22, "    echo \"<table class=\\\"scGridBorder\\\" id=\\\"main_table\\\" style=\\\"position: relative; top: 20px; left: 20px; min-width: 500px\\\">\";\r\n") ;
   nm_imprime_2($arq22, "}\r\n") ;
   nm_imprime_2($arq22, "?>\r\n") ;

    nm_imprime_2($arq22, " <tr>\r\n");
    nm_imprime_2($arq22, "  <td class=\"<?php echo (\$embbed)? 'scAppDivHeader scAppDivHeaderText':'scGridLabelVert'; ?>\">\r\n");
    nm_imprime_2($arq22, "   <?php echo \$this->Nm_lang['lang_btns_grpby_hint']; ?>\r\n") ;
    nm_imprime_2($arq22, "  </td>\r\n");
    nm_imprime_2($arq22, " </tr>\r\n");

    nm_imprime_2($arq22, " <tr>\r\n") ;
    nm_imprime_2($arq22, "  <td class=\"<?php echo (\$embbed)? 'scAppDivContent css_scAppDivContentText':'scGridTabelaTd'; ?>\">\r\n") ;
    nm_imprime_2($arq22, "   <table class=\"<?php echo (\$embbed)? '':'scGridTabela'; ?>\" style=\"border-width: 0; border-collapse: collapse; width:100%;\" cellspacing=0 cellpadding=0>\r\n");
    nm_imprime_2($arq22, "    <tr class=\"<?php echo (\$embbed)? '':'scGridFieldOddVert'; ?>\">\r\n");
    nm_imprime_2($arq22, "     <td style=\"vertical-align: top\">\r\n"); ;
    nm_imprime_2($arq22, "      <table cellspacing=0 cellpadding=0 style=\"width: 100%\">\r\n");

    nm_imprime_2($arq22, "<?php\r\n");
    nm_imprime_2($arq22, "    \$has_group_by_static  = false;\r\n");
    // quebra dinamica
    if ($tem_free_groupby)
    {
        nm_imprime_2($arq22, "    \$has_group_by_dynamic = true;\r\n");
        nm_imprime_2($arq22, "    \$has_total_dynamic    = true && \$opc_ret == \"resumo\";\r\n");
        nm_imprime_2($arq22, "    \$iTabCount            = 1;\r\n");
    }
    else
    {
        nm_imprime_2($arq22, "    \$has_group_by_dynamic = false;\r\n");
        nm_imprime_2($arq22, "    \$has_total_dynamic    = false;\r\n");
        nm_imprime_2($arq22, "    \$iTabCount            = 0;\r\n");
    }
    // quebra estatica
    if ($tem_static_groupby)
    {
        nm_imprime_2($arq22, "    foreach (\$_SESSION['sc_session'][\$sc_init]['" . $nome_aplicacao . "']['SC_All_Groupby'] as \$QB => \$Tp)\r\n");
        nm_imprime_2($arq22, "    {\r\n");
        nm_imprime_2($arq22, "        if (!in_array(\$QB, \$_SESSION['sc_session'][\$sc_init]['" . $nome_aplicacao . "']['SC_Groupby_hide']))\r\n");
        nm_imprime_2($arq22, "        {\r\n");
        nm_imprime_2($arq22, "            if (\$QB != \"sc_free_group_by\")\r\n");
        nm_imprime_2($arq22, "            {\r\n");
        nm_imprime_2($arq22, "                \$has_group_by_static = true;\r\n");
        nm_imprime_2($arq22, "                \$iTabCount++;\r\n");
        nm_imprime_2($arq22, "                break;\r\n");
        nm_imprime_2($arq22, "            }\r\n");
        nm_imprime_2($arq22, "        }\r\n");
        nm_imprime_2($arq22, "    }\r\n");
    }
    // totalizacao
    if ('S' == $parms_tbapl_attr2['use_this_groupby_dynamic_total'])
    {
        nm_imprime_2($arq22, "    if (\$opc_ret == \"resumo\")\r\n");
        nm_imprime_2($arq22, "    {\r\n");
        nm_imprime_2($arq22, "        \$has_total_dynamic = true;\r\n");
        nm_imprime_2($arq22, "        \$iTabCount++;\r\n");
        nm_imprime_2($arq22, "    }\r\n");
    }

    nm_imprime_2($arq22, "    if (1 < \$iTabCount)\r\n");
    nm_imprime_2($arq22, "    {\r\n");
    nm_imprime_2($arq22, "?>\r\n");

    nm_imprime_2($arq22, " <tr>\r\n");
    nm_imprime_2($arq22, "  <td>\r\n");
    nm_imprime_2($arq22, "   <ul class=\"scAppDivTabLine\">\r\n");
    nm_imprime_2($arq22, "<?php\r\n");
    nm_imprime_2($arq22, "        if (\$has_group_by_static)\r\n");
    nm_imprime_2($arq22, "        {\r\n");
    nm_imprime_2($arq22, "            \$sTabClass = ('sc_free_group_by' == \$groupby_atual) ? 'scTabInactive' : 'scTabActive';\r\n");
    nm_imprime_2($arq22, "?>\r\n");
    nm_imprime_2($arq22, "    <li id=\"sc_id_show_static\" class=\"<?php echo \$sTabClass; ?>\"><a><?php echo \$this->Nm_lang['lang_othr_groupby_static']; ?></a></li>\r\n") ;
    nm_imprime_2($arq22, "<?php\r\n");
    nm_imprime_2($arq22, "        }\r\n");
    nm_imprime_2($arq22, "        if (\$has_group_by_dynamic)\r\n");
    nm_imprime_2($arq22, "        {\r\n");
    nm_imprime_2($arq22, "            \$sTabClass = ('sc_free_group_by' == \$groupby_atual) ? 'scTabActive' : 'scTabInactive';\r\n");
    nm_imprime_2($arq22, "?>\r\n");
    nm_imprime_2($arq22, "    <li id=\"sc_id_show_free\" class=\"<?php echo \$sTabClass; ?>\"><a><?php echo \$this->Nm_lang['lang_othr_groupby_dynamic']; ?></a></li>\r\n") ;
    nm_imprime_2($arq22, "<?php\r\n");
    nm_imprime_2($arq22, "        }\r\n");
    nm_imprime_2($arq22, "        if (\$has_total_dynamic)\r\n");
    nm_imprime_2($arq22, "        {\r\n");
    nm_imprime_2($arq22, "?>\r\n");
    nm_imprime_2($arq22, "    <li id=\"sc_id_show_total\" class=\"scTabInactive\"><a><?php echo \$this->Nm_lang['lang_othr_totals']; ?></a></li>\r\n") ;
    nm_imprime_2($arq22, "<?php\r\n") ;
    nm_imprime_2($arq22, "        }\r\n");
    nm_imprime_2($arq22, "?>\r\n");
    nm_imprime_2($arq22, "   </ul>\r\n");
    nm_imprime_2($arq22, "  </td>\r\n");
    nm_imprime_2($arq22, " </tr>\r\n");

    nm_imprime_2($arq22, "<?php\r\n");
    nm_imprime_2($arq22, "    }\r\n");
    nm_imprime_2($arq22, "?>\r\n");

    if ($tem_static_groupby)
    {
        nm_imprime_2($arq22, " <tr id=\"sc_id_static_groupby\">\r\n");
        nm_imprime_2($arq22, "  <td>\r\n");
        foreach ($tbapl_arr_quebras as $ind_qb => $resto)
        {
            if ($ind_qb != "sc_free_group_by")
            {

            $var_val = $resto['titulo'];
                sc_preg_match_local($var_val, $var_local, $tbapl_idioma, $apl_charset);
                if (!empty($var_local[0]))
                {
                    $var_local = $var_local[0];
                    foreach ($var_local as $cada_var_loc)
                    {
                        $nome_var = substr($cada_var_loc, 1, strlen($cada_var_loc) - 2);
                        if (substr($nome_var, 0, 5) == "lang_")
                        {
                            $cmp_troca = "<?php echo \$this->Nm_lang['" . $nome_var . "'] ?>";
                            $var_val = str_replace($cada_var_loc, $cmp_troca, $var_val) ;
                        }
                    }
                }
                sc_preg_match_global($var_val, $var_local, $tbapl_idioma, $apl_charset);
                if (!empty($var_local[0]))
                {
                    $var_local = $var_local[0];
                    foreach ($var_local as $cada_var_loc)
                    {
                        $cmp_troca = "<?php echo \$_SESSION['" . substr($cada_var_loc, 1, strlen($cada_var_loc) - 2) . "'] ?>";
                        $var_val = str_replace($cada_var_loc, $cmp_troca, $var_val) ;
                    }
                }
                nm_imprime_2($arq22, "<?php\r\n");
                nm_imprime_2($arq22, "     if (!in_array(\"" . $ind_qb . "\", \$_SESSION['sc_session'][\$sc_init]['" . $nome_aplicacao . "']['SC_Groupby_hide']))\r\n");
                nm_imprime_2($arq22, "     {\r\n");
                if (empty($resto['quebras']))
                {
                    nm_imprime_2($arq22, "        if (\$opc_ret != \"resumo\")\r\n");
                    nm_imprime_2($arq22, "        {\r\n");
                }
                nm_imprime_2($arq22, "        if (\$groupby_atual == \"" . $ind_qb . "\")\r\n");
                nm_imprime_2($arq22, "        {\r\n");
                nm_imprime_2($arq22, "            \$check = \" checked\";\r\n");
                nm_imprime_2($arq22, "            \$bStartFree = false;\r\n");
                nm_imprime_2($arq22, "        }\r\n");
                nm_imprime_2($arq22, "        else\r\n");
                nm_imprime_2($arq22, "        {\r\n");
                nm_imprime_2($arq22, "            \$check = \"\";\r\n");
                nm_imprime_2($arq22, "        }\r\n");
                nm_imprime_2($arq22, "?>\r\n");
                nm_imprime_2($arq22, "      <input type=\"radio\" class=\"scAppDivToolbarInput sc_ui_gby_selected\" name=\"sel_groupby\" value=\"" . $ind_qb . "\" id=\"sc_id_sel_groupby_" . $ind_qb . "\"<?php echo \$check ?> /><label for=\"sc_id_sel_groupby_" . $ind_qb . "\" style=\"font-weight: bold\">" . $var_val . "</label>\r\n");
                nm_imprime_2($arq22, "      <br />\r\n");
                $tmp_campos_quebra = array();
                foreach ($resto['quebras'] as $tmp_quebra_dados)
                {
                    $var_val = $tab_cmp[ $tmp_quebra_dados['seq'] ]['nmgp_label'];
                    sc_preg_match_local($var_val, $var_local, $tbapl_idioma, $apl_charset);
                    if (!empty($var_local[0]))
                    {
                        $var_local = $var_local[0];
                        foreach ($var_local as $cada_var_loc)
                        {
                            $nome_var = substr($cada_var_loc, 1, strlen($cada_var_loc) - 2);
                            if (substr($nome_var, 0, 5) == "lang_")
                            {
                                $cmp_troca = "<?php echo \$this->Nm_lang['" . $nome_var . "'] ?>";
                                $var_val = str_replace($cada_var_loc, $cmp_troca, $var_val) ;
                            }
                        }
                    }
                    sc_preg_match_global($var_val, $var_local, $tbapl_idioma, $apl_charset);
                    if (!empty($var_local[0]))
                    {
                        $var_local = $var_local[0];
                        foreach ($var_local as $cada_var_loc)
                        {
                            $cmp_troca = "<?php echo \$_SESSION['" . substr($cada_var_loc, 1, strlen($cada_var_loc) - 2) . "'] ?>";
                            $var_val = str_replace($cada_var_loc, $cmp_troca, $var_val) ;
                        }
                    }
                    $tmp_campos_quebra[] = $var_val;
                }
                nm_imprime_2($arq22, "      <span style=\"padding-left: 30px\">" . implode($tmp_campos_quebra, ', ') . "</span>\r\n");
                nm_imprime_2($arq22, "      <br /><br />\r\n");
                nm_imprime_2($arq22, "<?php\r\n");
                if (empty($resto['quebras']))
                {
                    nm_imprime_2($arq22, "        }\r\n");
                }
                nm_imprime_2($arq22, "     }\r\n");
                nm_imprime_2($arq22, "?>\r\n");
            }
        }
        nm_imprime_2($arq22, "  </td>\r\n");
        nm_imprime_2($arq22, " </tr>\r\n");
    }

    if ($tem_free_groupby)
    {
        nm_imprime_2($arq22, " <tr id=\"sc_id_free_groupby\">\r\n");
        nm_imprime_2($arq22, "  <td>\r\n");
        foreach ($tbapl_arr_quebras as $ind_qb => $resto)
        {
            if ($ind_qb == "sc_free_group_by")
            {
                nm_imprime_2($arq22, "<?php\r\n");
                nm_imprime_2($arq22, "     if (!in_array(\"" . $ind_qb . "\", \$_SESSION['sc_session'][\$sc_init]['" . $nome_aplicacao . "']['SC_Groupby_hide']))\r\n");
                nm_imprime_2($arq22, "     {\r\n");
                if (empty($resto['quebras']))
                {
                    nm_imprime_2($arq22, "        if (\$opc_ret != \"resumo\")\r\n");
                    nm_imprime_2($arq22, "        {\r\n");
                }
                nm_imprime_2($arq22, "        \$check = (\$groupby_atual == \"" . $ind_qb . "\") ? \" checked\" : \"\";\r\n");
                nm_imprime_2($arq22, "?>\r\n");
                $sSpanHelpDisplay = '';
                foreach ($parms_tbapl_attr2['rules_group'] as $aRuleGroup)
                {
                    if ('sc_free_group_by' == $aRuleGroup['nome'] && 'Y' == $aRuleGroup['sc_free_group_by_hide_help_line'])
                    {
                        $sSpanHelpDisplay = ' style="display: none"';
                    }
                }
                nm_imprime_2($arq22, "      <span" . $sSpanHelpDisplay . ">\r\n");
                nm_imprime_2($arq22, "       <input type=\"radio\" class=\"scAppDivToolbarInput sc_ui_gby_selected\" name=\"sel_groupby\" value=\"" . $ind_qb . "\" id=\"sc_id_sel_groupby_" . $ind_qb . "\"<?php echo \$check ?> /><label for=\"sc_id_sel_groupby_" . $ind_qb . "\" style=\"font-weight: bold\"><?php echo \$this->Nm_lang['lang_othr_groupby_free']; ?></label>\r\n");
                nm_imprime_2($arq22, "       <br /><br />\r\n");
                nm_imprime_2($arq22, "      </span>\r\n");
                nm_imprime_2($arq22, "<?php\r\n");
                nm_imprime_2($arq22, "        if (\$bSummaryPage)\r\n");
                nm_imprime_2($arq22, "        {\r\n");
                nm_imprime_2($arq22, "?>\r\n");
                nm_imprime_2($arq22, "      <?php echo \$this->Nm_lang['lang_othr_groupby_required']; ?><br />\r\n");
                nm_imprime_2($arq22, "<?php\r\n");
                nm_imprime_2($arq22, "        }\r\n");
                nm_imprime_2($arq22, "?>\r\n");

                nm_imprime_2($arq22, "      <table>\r\n");
                nm_imprime_2($arq22, "<?php\r\n");
                nm_imprime_2($arq22, "        \$aYAxysFields = array();\r\n");
                nm_imprime_2($arq22, "        \$aXAxysFields = array();\r\n");
                nm_imprime_2($arq22, "        \$sYAxysLabel  = \$this->Nm_lang['lang_othr_groupby_selected_fld'];\r\n");
                nm_imprime_2($arq22, "        foreach (\$_SESSION['sc_session'][\$sc_init]['" . $nome_aplicacao . "']['SC_Gb_Free_cmp'] as \$NM_cada_field => \$resto)\r\n");
                nm_imprime_2($arq22, "        {\r\n");
                nm_imprime_2($arq22, "            \$aYAxysFields[\$NM_cada_field] = \$resto;\r\n");
                nm_imprime_2($arq22, "        }\r\n");
                nm_imprime_2($arq22, "        if (\$bSummaryPage)\r\n");
                nm_imprime_2($arq22, "        {\r\n");
                nm_imprime_2($arq22, "            \$aTmpGroupBy = \$aYAxysFields;\r\n");
                nm_imprime_2($arq22, "            foreach (\$_SESSION['sc_session'][\$sc_init]['" . $nome_aplicacao . "']['pivot_x_axys'] as \$temp)\r\n");
                nm_imprime_2($arq22, "            {\r\n");
                nm_imprime_2($arq22, "                reset(\$aTmpGroupBy);\r\n");
                nm_imprime_2($arq22, "                \$temp_key                 = key(\$aTmpGroupBy);\r\n");
                nm_imprime_2($arq22, "                \$aXAxysFields[\$temp_key] = \$aTmpGroupBy[\$temp_key];\r\n");
                nm_imprime_2($arq22, "                unset(\$aYAxysFields[\$temp_key]);\r\n");
                nm_imprime_2($arq22, "            }\r\n");
                nm_imprime_2($arq22, "            \$sYAxysLabel = \$this->Nm_lang['lang_othr_groupby_axis_y'];\r\n");
                nm_imprime_2($arq22, "?>\r\n");
                nm_imprime_2($arq22, "       <tr>\r\n");
                nm_imprime_2($arq22, "        <td colspan=\"2\" style=\"height: 35px\">&nbsp;</td>\r\n");
                nm_imprime_2($arq22, "        <td rowspan=\"2\" style=\"vertical-align: top\">\r\n");
                nm_imprime_2($arq22, "         <?php echo \$this->Nm_lang['lang_othr_groupby_axis_x']; ?>\r\n");

                nm_imprime_2($arq22, "         <ul class=\"sc_ui_sort_groupby sc_ui_sortable sc_ui_ulist scAppDivSelectFields\" id=\"sc_id_xaxys\">\r\n");
                nm_imprime_2($arq22, "<?php\r\n");
                nm_imprime_2($arq22, "            foreach (\$aXAxysFields as \$NM_cada_field => \$resto)\r\n");
                nm_imprime_2($arq22, "            {\r\n");
                nm_imprime_2($arq22, "?>\r\n");
                nm_imprime_2($arq22, "          <li class=\"sc_ui_litem scAppDivSelectFieldsEnabled\" id=\"sc_id_item_<?php echo NM_encode_input(\$NM_cada_field); ?>\"><?php echo \$arr_campos_free[\$NM_cada_field]; ?></li>\r\n");
                nm_imprime_2($arq22, "<?php\r\n");
                nm_imprime_2($arq22, "            }\r\n");
                nm_imprime_2($arq22, "?>\r\n");
                nm_imprime_2($arq22, "         </ul>\r\n");

                nm_imprime_2($arq22, "        </td>\r\n");
                nm_imprime_2($arq22, "       </tr>\r\n");
                nm_imprime_2($arq22, "<?php\r\n");
                nm_imprime_2($arq22, "        }\r\n");
                nm_imprime_2($arq22, "?>\r\n");
                nm_imprime_2($arq22, "       <tr>\r\n");
                nm_imprime_2($arq22, "        <td style=\"vertical-align: top\">\r\n");
                nm_imprime_2($arq22, "         <?php echo \$this->Nm_lang['lang_othr_groupby_available_fld']; ?>\r\n");

                nm_imprime_2($arq22, "         <ul class=\"sc_ui_sort_groupby sc_ui_sortable sc_ui_ulist scAppDivSelectFields\" id=\"sc_id_available\">\r\n");
                nm_imprime_2($arq22, "<?php\r\n");
                nm_imprime_2($arq22, "        foreach (\$arr_campos_free as \$NM_cada_field => \$NM_cada_label)\r\n");
                nm_imprime_2($arq22, "        {\r\n");
                nm_imprime_2($arq22, "           if (!isset(\$_SESSION['sc_session'][\$sc_init]['" . $nome_aplicacao . "']['SC_Gb_Free_cmp'][\$NM_cada_field]))\r\n");
                nm_imprime_2($arq22, "           {\r\n");
                nm_imprime_2($arq22, "?>\r\n");
                nm_imprime_2($arq22, "          <li class=\"sc_ui_litem scAppDivSelectFieldsEnabled\" id=\"sc_id_item_<?php echo NM_encode_input(\$NM_cada_field); ?>\"><?php echo \$NM_cada_label; ?></li>\r\n");
                nm_imprime_2($arq22, "<?php\r\n");
                nm_imprime_2($arq22, "           }\r\n");
                nm_imprime_2($arq22, "        }\r\n");
                nm_imprime_2($arq22, "?>\r\n");
                nm_imprime_2($arq22, "         </ul>\r\n");

                nm_imprime_2($arq22, "        </td>\r\n");
                nm_imprime_2($arq22, "        <td style=\"vertical-align: top\">\r\n");
                nm_imprime_2($arq22, "         <?php echo \$sYAxysLabel; ?>\r\n");

                nm_imprime_2($arq22, "         <ul class=\"sc_ui_sort_groupby sc_ui_sortable sc_ui_ulist scAppDivSelectFields\" id=\"sc_id_yaxys\">\r\n");
                nm_imprime_2($arq22, "<?php\r\n");
                nm_imprime_2($arq22, "        foreach (\$aYAxysFields as \$NM_cada_field => \$resto)\r\n");
                nm_imprime_2($arq22, "        {\r\n");
                nm_imprime_2($arq22, "?>\r\n");
                nm_imprime_2($arq22, "          <li class=\"sc_ui_litem scAppDivSelectFieldsEnabled\" id=\"sc_id_item_<?php echo NM_encode_input(\$NM_cada_field); ?>\"><?php echo \$arr_campos_free[\$NM_cada_field]; ?></li>\r\n");
                nm_imprime_2($arq22, "<?php\r\n");
                nm_imprime_2($arq22, "        }\r\n");
                nm_imprime_2($arq22, "?>\r\n");
                nm_imprime_2($arq22, "         </ul>\r\n");

                nm_imprime_2($arq22, "        </td>\r\n");
                nm_imprime_2($arq22, "<?php\r\n");
                nm_imprime_2($arq22, "        if (isset(\$_GET['opc_ret']) && 'resumo' == \$_GET['opc_ret'])\r\n");
                nm_imprime_2($arq22, "        {\r\n");
                nm_imprime_2($arq22, "?>\r\n");
                nm_imprime_2($arq22, "        <td>&nbsp;</td>\r\n");
                nm_imprime_2($arq22, "       </tr>\r\n");
                nm_imprime_2($arq22, "<?php\r\n");
                nm_imprime_2($arq22, "        }\r\n");
                nm_imprime_2($arq22, "?>\r\n");
                nm_imprime_2($arq22, "       </tr>\r\n");
                nm_imprime_2($arq22, "      </table>\r\n");

                nm_imprime_2($arq22, "<?php\r\n");
                if (empty($resto['quebras']))
                {
                    nm_imprime_2($arq22, "        }\r\n");
                }
                nm_imprime_2($arq22, "     }\r\n");
                nm_imprime_2($arq22, "?>\r\n");
            }
        }
        nm_imprime_2($arq22, "  </td>\r\n");
        nm_imprime_2($arq22, " </tr>\r\n");
    }

    // selecao dos campos da totalizacao
    nm_imprime_2($arq22, "<?php\r\n");
    nm_imprime_2($arq22, "   \$iItemCount = 0;\r\n");
    nm_imprime_2($arq22, "   if (\$bSummaryPage)\r\n");
    nm_imprime_2($arq22, "   {\r\n");
    nm_imprime_2($arq22, "       \$aSummStatus = array();\r\n");
    nm_imprime_2($arq22, "?>\r\n");
    nm_imprime_2($arq22, " <tr id=\"sc_id_summary\">\r\n");
    nm_imprime_2($arq22, "  <td>\r\n");
    nm_imprime_2($arq22, "      <table>\r\n");
    nm_imprime_2($arq22, "       <tr>\r\n");
    nm_imprime_2($arq22, "        <td style=\"vertical-align: top\">\r\n");
    nm_imprime_2($arq22, "         <?php echo \$this->Nm_lang['lang_othr_groupby_totals_fld']; ?>\r\n");
    nm_imprime_2($arq22, "         <ul class=\"sc_ui_sort_summ sc_ui_sortable sc_ui_ulist sc_ui_ulist_total scAppDivSelectFields\" id=\"sc_id_summ_available\">\r\n");
    nm_imprime_2($arq22, "<?php\r\n");
    nm_imprime_2($arq22, "        foreach (\$_SESSION['sc_session'][\$sc_init]['" . $nome_aplicacao . "']['summarizing_fields_control'] as \$l_field => \$d_field)\r\n");
    nm_imprime_2($arq22, "        {\r\n");
    nm_imprime_2($arq22, "            \$aSummStatus[\$l_field] = array();\r\n");
    nm_imprime_2($arq22, "            \$sOpDisplay            = 'NM_Count' == \$l_field ? '; display: none' : '';\r\n");
    nm_imprime_2($arq22, "?>\r\n");
    nm_imprime_2($arq22, "          <li class=\"sc_ui_litem sc_ui_litem_total scAppDivSelectFieldsEnabled\" id=\"sc_id_item_summ_<?php echo NM_encode_input(\$l_field); ?>\"><table style=\"width: 100%\"><tr><td><?php echo NM_encode_input(\$d_field['label']); ?></td><td style=\"text-align: right\" class=\"sc-ui-total-options\">");
    nm_imprime_2($arq22, "<?php\r\n");
    nm_imprime_2($arq22, "            foreach (\$d_field['options'] as \$d_sum)\r\n");
    nm_imprime_2($arq22, "            {\r\n");
    nm_imprime_2($arq22, "                \$aSummStatus[\$l_field][] = \$d_sum['op'];\r\n");
    nm_imprime_2($arq22, "?>\r\n");
    nm_imprime_2($arq22, "&nbsp;<span style=\"position: relative; margin-left: 0<?php echo \$sOpDisplay; ?>\" class=\"scAppDivSelectBoxEnabled sc-ui-select-available-<?php echo NM_encode_input(\$d_sum['op']); ?>\"><?php echo NM_encode_input(\$d_sum['abbrev']); ?></span>");
    nm_imprime_2($arq22, "<?php\r\n");
    nm_imprime_2($arq22, "            }\r\n");
    nm_imprime_2($arq22, "?>\r\n");
    nm_imprime_2($arq22, "</td></tr></table></li>\r\n");
    nm_imprime_2($arq22, "<?php\r\n");
    nm_imprime_2($arq22, "        }\r\n");
    nm_imprime_2($arq22, "?>\r\n");
    nm_imprime_2($arq22, "         </ul>\r\n");
    nm_imprime_2($arq22, "        </td>\r\n");
    nm_imprime_2($arq22, "        <td style=\"vertical-align: top\">\r\n");
    nm_imprime_2($arq22, "         <?php echo \$this->Nm_lang['lang_othr_groupby_selected_fld']; ?>\r\n");
    nm_imprime_2($arq22, "         <ul class=\"sc_ui_sort_summ sc_ui_sortable sc_ui_ulist sc_ui_ulist_total scAppDivSelectFields\" id=\"sc_id_summ_selected\">\r\n");
    nm_imprime_2($arq22, "<?php\r\n");
    nm_imprime_2($arq22, "        foreach (\$_SESSION['sc_session'][\$sc_init]['" . $nome_aplicacao . "']['summarizing_fields_order'] as \$i_sum)\r\n");
    nm_imprime_2($arq22, "        {\r\n");
    nm_imprime_2($arq22, "            if ('' != \$i_sum && isset(\$_SESSION['sc_session'][\$sc_init]['" . $nome_aplicacao . "']['summarizing_fields_display'][\$i_sum]))\r\n");
    nm_imprime_2($arq22, "            {\r\n");
    nm_imprime_2($arq22, "                \$d_sum = \$_SESSION['sc_session'][\$sc_init]['" . $nome_aplicacao . "']['summarizing_fields_display'][\$i_sum];\r\n");
    nm_imprime_2($arq22, "                if (\$d_sum['display'])\r\n");
    nm_imprime_2($arq22, "                {\r\n");
    nm_imprime_2($arq22, "                    \$sLabel = \$d_sum['label'];\r\n");
    nm_imprime_2($arq22, "                    \$sId    = '';\r\n");
    nm_imprime_2($arq22, "                    \$bFound = false;\r\n");
    nm_imprime_2($arq22, "                    foreach (\$_SESSION['sc_session'][\$sc_init]['" . $nome_aplicacao . "']['summarizing_fields_control'] as \$l_field => \$d_field)\r\n");
    nm_imprime_2($arq22, "                    {\r\n");
    nm_imprime_2($arq22, "                        foreach (\$d_field['options'] as \$d_option)\r\n");
    nm_imprime_2($arq22, "                        {\r\n");
    nm_imprime_2($arq22, "                            if (\$d_option['index'] == \$i_sum)\r\n");
    nm_imprime_2($arq22, "                            {\r\n");
    nm_imprime_2($arq22, "                                \$sLabel = \$d_field['label'];\r\n");
    nm_imprime_2($arq22, "                                \$sId    = \$l_field;\r\n");
    nm_imprime_2($arq22, "                                \$bFound = true;\r\n");
    nm_imprime_2($arq22, "                            }\r\n");
    nm_imprime_2($arq22, "                        }\r\n");
    nm_imprime_2($arq22, "                        if (\$bFound)\r\n");
    nm_imprime_2($arq22, "                        {\r\n");
    nm_imprime_2($arq22, "                            break;\r\n");
    nm_imprime_2($arq22, "                        }\r\n");
    nm_imprime_2($arq22, "                    }\r\n");
    nm_imprime_2($arq22, "                    \$sSelDisplay = 'NM_Count' == \$sId ? ' style=\"display: none\"' : '';\r\n");
    nm_imprime_2($arq22, "?>\r\n");
    nm_imprime_2($arq22, "          <li class=\"sc_ui_litem sc_ui_litem_total scAppDivSelectFieldsEnabled\" id=\"sc_id_item_summ_<?php echo NM_encode_input(\$iItemCount); ?>\"><table style=\"width: 100%\"><tr><td><?php echo NM_encode_input(\$sLabel); ?></td><td style=\"text-align: right\" class=\"sc-ui-total-options\"><select class=\"sc-ui-select-<?php echo \$sId; ?>\"<?php echo \$sSelDisplay; ?> onChange=\"scSummChange(\$(this))\">");
    nm_imprime_2($arq22, "<?php\r\n");
    nm_imprime_2($arq22, "                    foreach (\$d_field['options'] as \$d_option)\r\n");
    nm_imprime_2($arq22, "                    {\r\n");
    nm_imprime_2($arq22, "                        \$sSelected = \$i_sum == \$d_option['index'] ? ' selected' : '';\r\n");
    nm_imprime_2($arq22, "?>\r\n");
    nm_imprime_2($arq22, "<option value=\"<?php echo \$d_option['index']; ?>\" class=\"sc-ui-select-option-<?php echo \$d_option['op']; ?>\"<?php echo \$sSelected; ?>><?php echo NM_encode_input(\$d_option['label']); ?></option>");
    nm_imprime_2($arq22, "<?php\r\n");
    nm_imprime_2($arq22, "                    }\r\n");
    nm_imprime_2($arq22, "?>\r\n");
    nm_imprime_2($arq22, "</select></td></tr></table></li>\r\n");
    nm_imprime_2($arq22, "<?php\r\n");
    nm_imprime_2($arq22, "                    \$iItemCount++;\r\n");
    nm_imprime_2($arq22, "                }\r\n");
    nm_imprime_2($arq22, "           }\r\n");
    nm_imprime_2($arq22, "       }\r\n");
    nm_imprime_2($arq22, "?>\r\n");
    nm_imprime_2($arq22, "         </ul>\r\n");
    nm_imprime_2($arq22, "        </td>\r\n");
    nm_imprime_2($arq22, "       </tr>\r\n");
    nm_imprime_2($arq22, "      </table>\r\n");
    nm_imprime_2($arq22, "  </td>\r\n");
    nm_imprime_2($arq22, " </tr>\r\n");
    nm_imprime_2($arq22,"<?php\r\n");
    nm_imprime_2($arq22,"   }\r\n");
    nm_imprime_2($arq22, "?>\r\n");

    nm_imprime_2($arq22, "      </table>\r\n");
    nm_imprime_2($arq22, "<script type=\"text/javascript\">\r\n");
    nm_imprime_2($arq22, " var scSummItemCount, scSummStatus;\r\n");
    nm_imprime_2($arq22, " $(function() {\r\n");
    nm_imprime_2($arq22, "  scSummItemCount = <?php echo \$iItemCount; ?>;\r\n");
    nm_imprime_2($arq22, "<?php\r\n");
    nm_imprime_2($arq22, "   if (\$bSummaryPage)\r\n");
    nm_imprime_2($arq22, "   {\r\n");
    nm_imprime_2($arq22, "?>\r\n");
    nm_imprime_2($arq22, "  scSummStatus = {\r\n");
    nm_imprime_2($arq22, "<?php\r\n");
    nm_imprime_2($arq22, "       foreach (\$aSummStatus as \$sSummId => \$aSummData)\r\n");
    nm_imprime_2($arq22, "       {\r\n");
    nm_imprime_2($arq22, "?>\r\n");
    nm_imprime_2($arq22, "   <?php echo \$sSummId; ?>: {\r\n");
    nm_imprime_2($arq22, "<?php\r\n");
    nm_imprime_2($arq22, "           foreach (\$aSummData as \$sSummOp)\r\n");
    nm_imprime_2($arq22, "           {\r\n");
    nm_imprime_2($arq22, "?>\r\n");
    nm_imprime_2($arq22, "     <?php echo \$sSummOp; ?>: true,\r\n");
    nm_imprime_2($arq22, "<?php\r\n");
    nm_imprime_2($arq22, "           }\r\n");
    nm_imprime_2($arq22, "?>\r\n");
    nm_imprime_2($arq22, "   },\r\n");
    nm_imprime_2($arq22, "<?php\r\n");
    nm_imprime_2($arq22, "       }\r\n");
    nm_imprime_2($arq22, "?>\r\n");
    nm_imprime_2($arq22, "  };\r\n");
    nm_imprime_2($arq22, "<?php\r\n");
    nm_imprime_2($arq22, "   }\r\n");
    nm_imprime_2($arq22, "?>\r\n");
    nm_imprime_2($arq22, "  scSummOptionsInit();\r\n");
    nm_imprime_2($arq22, " });\r\n");
    nm_imprime_2($arq22, "</script>\r\n");
    nm_imprime_2($arq22, "   </td>\r\n");
    nm_imprime_2($arq22, "  </table>\r\n");
    nm_imprime_2($arq22, "  </td>\r\n");
    nm_imprime_2($arq22, "  </tr>\r\n");

   nm_imprime_2($arq22, "   <tr>\r\n");
   if ($tem_free_groupby)
   {
       nm_imprime_2($arq22, "  <td class=\"<?php echo (\$embbed)? 'scAppDivToolbar':'scGridToolbar'; ?>\" colspan=2>\r\n") ;
   }
   else
   {
       nm_imprime_2($arq22, "  <td class=\"<?php echo (\$embbed)? 'scAppDivToolbar':'scGridToolbar'; ?>\">\r\n") ;
   }

   //----------- botao ok

   // incorporacao do group by na consulta
   nm_imprime_2($arq22,"<?php\r\n");
   nm_imprime_2($arq22,"   if (!\$embbed)\r\n");
   nm_imprime_2($arq22,"   {\r\n");
   nm_imprime_2($arq22, "?>\r\n");

   $parm_btn = array();
   $parm_btn['id']     = "f_sel_sub";
   if ($tem_free_groupby || 'S' == $parms_tbapl_attr2['use_this_groupby_dynamic_total'])
   {
       $parm_btn['click']  = "scPackGroupBy();document.Fsel_quebras.submit()";
   }
   else
   {
       $parm_btn['click']  = "document.Fsel_quebras.submit()";
   }
   $parm_btn['path']   = "\$path_btn";
   $parm_btn['align']  = "absmiddle";
   $parm_btn['border'] = "0";
   $prep_btn =  new_gera_cod_botoes("bok", $parm_btn);
   nm_imprime_2($arq22, "   <?php echo " . $prep_btn . "?>\r\n") ;

   nm_imprime_2($arq22,"<?php\r\n");
   nm_imprime_2($arq22,"   }\r\n");
   nm_imprime_2($arq22,"   else\r\n");
   nm_imprime_2($arq22,"   {\r\n");
   nm_imprime_2($arq22, "?>\r\n");

   $parm_btn = array();
   $parm_btn['id']     = "f_sel_sub";
   if ($tem_free_groupby || 'S' == $parms_tbapl_attr2['use_this_groupby_dynamic_total'])
   {
       $parm_btn['click']  = "scPackGroupBy();scSubmitGroupBy('\" . \$tbar_pos . \"')";
   }
   else
   {
       $parm_btn['click']  = "scSubmitGroupBy('\" . \$tbar_pos . \"')";
   }
   $parm_btn['path']   = "\$path_btn";
   $parm_btn['align']  = "absmiddle";
   $parm_btn['border'] = "0";
   $prep_btn =  new_gera_cod_botoes("bapply", $parm_btn);
   nm_imprime_2($arq22, "   <?php echo " . $prep_btn . "?>\r\n") ;

   nm_imprime_2($arq22,"<?php\r\n");
   nm_imprime_2($arq22,"   }\r\n");
   nm_imprime_2($arq22, "?>\r\n");

   nm_imprime_2($arq22,"  &nbsp;&nbsp;&nbsp;\r\n") ;

   // incorporacao do group by na consulta
   nm_imprime_2($arq22,"<?php\r\n");
   nm_imprime_2($arq22,"   if (!\$embbed)\r\n");
   nm_imprime_2($arq22,"   {\r\n");
   nm_imprime_2($arq22, "?>\r\n");

   $parm_btn = array();
   $parm_btn['id']     = "Bsair";
   $parm_btn['click']  = "self.parent.tb_remove()";
   $parm_btn['path']   = "\$path_btn";
   $parm_btn['align']  = "absmiddle";
   $parm_btn['border'] = "0";
   $prep_btn =  new_gera_cod_botoes("bsair", $parm_btn);
   nm_imprime_2($arq22, "   <?php echo " . $prep_btn . "?>\r\n") ;

   nm_imprime_2($arq22,"<?php\r\n");
   nm_imprime_2($arq22,"   }\r\n");
   nm_imprime_2($arq22,"   else\r\n");
   nm_imprime_2($arq22,"   {\r\n");
   nm_imprime_2($arq22, "?>\r\n");

   $parm_btn = array();
   $parm_btn['id']     = "Bsair";
   $parm_btn['click']  = "scBtnGroupByHide('\" . \$tbar_pos . \"')";
   $parm_btn['path']   = "\$path_btn";
   $parm_btn['align']  = "absmiddle";
   $parm_btn['border'] = "0";
   $prep_btn =  new_gera_cod_botoes("bcancelar", $parm_btn);
   nm_imprime_2($arq22, "   <?php echo " . $prep_btn . "?>\r\n") ;

   nm_imprime_2($arq22,"<?php\r\n");
   nm_imprime_2($arq22,"   }\r\n");
   nm_imprime_2($arq22, "?>\r\n");

   nm_imprime_2($arq22, "   </td></tr>\r\n");
   nm_imprime_2($arq22, "  </table>\r\n");
   nm_imprime_2($arq22, "<?php\r\n");
   nm_imprime_2($arq22, "if (\$embbed)\r\n");
   nm_imprime_2($arq22, "{\r\n");
   nm_imprime_2($arq22, "?>\r\n");
   nm_imprime_2($arq22, "    </div>\r\n") ;
   nm_imprime_2($arq22, "<?php\r\n");
   nm_imprime_2($arq22, "}\r\n");
   nm_imprime_2($arq22, "?>\r\n");
   nm_imprime_2($arq22, "</FORM>\r\n");

   nm_imprime_2($arq22,"<script language=\"javascript\">\r\n");
   nm_imprime_2($arq22, "$(function() {\r\n");
   nm_imprime_2($arq22, "<?php\r\n");
   nm_imprime_2($arq22, "   if (\$bStartFree)\r\n");
   nm_imprime_2($arq22, "   {\r\n");
   nm_imprime_2($arq22, "?>\r\n");
   nm_imprime_2($arq22,"       scShowFree();\r\n");
   nm_imprime_2($arq22, "<?php\r\n");
   nm_imprime_2($arq22, "   }\r\n");
   nm_imprime_2($arq22, "   else\r\n");
   nm_imprime_2($arq22, "   {\r\n");
   nm_imprime_2($arq22, "?>\r\n");
   nm_imprime_2($arq22,"       scShowStatic();\r\n");
   nm_imprime_2($arq22, "<?php\r\n");
   nm_imprime_2($arq22, "   }\r\n");
   nm_imprime_2($arq22, "?>\r\n");
   nm_imprime_2($arq22, "});\r\n");
   nm_imprime_2($arq22,"</script>\r\n");

   // incorporacao do group by na consulta
   nm_imprime_2($arq22,"<?php\r\n");
   nm_imprime_2($arq22,"   if (!\$embbed)\r\n");
   nm_imprime_2($arq22,"   {\r\n");
   nm_imprime_2($arq22, "?>\r\n");

   nm_imprime_2($arq22,"<script language=\"javascript\"> \r\n" );
   nm_imprime_2($arq22, "var bFixed = false;\r\n");
   nm_imprime_2($arq22, "function ajusta_window()\r\n");
   nm_imprime_2($arq22, "{\r\n");
   nm_imprime_2($arq22, "  var mt = $(document.getElementById(\"main_table\"));\r\n");
   nm_imprime_2($arq22, "  if (0 == mt.width() || 0 == mt.height())\r\n");
   nm_imprime_2($arq22, "  {\r\n");
   nm_imprime_2($arq22, "    setTimeout(\"ajusta_window()\", 50);\r\n");
   nm_imprime_2($arq22, "    return;\r\n");
   nm_imprime_2($arq22, "  }\r\n");
   nm_imprime_2($arq22, "  else if(!bFixed)\r\n");
   nm_imprime_2($arq22, "  {\r\n");
   nm_imprime_2($arq22, "    var oOrig = $(document.Fsel_quebras.sel_groupby),\r\n");
   nm_imprime_2($arq22, "        mHeight = oOrig.height(),\r\n");
   nm_imprime_2($arq22, "        mWidth  = oOrig.width() + 5;\r\n");
   nm_imprime_2($arq22, "    oOrig.height(mHeight);\r\n");
   nm_imprime_2($arq22, "    oOrig.width(mWidth);\r\n");
   nm_imprime_2($arq22, "    bFixed = true;\r\n");
   nm_imprime_2($arq22, "    if (navigator.userAgent.indexOf(\"Chrome/\") > 0)\r\n");
   nm_imprime_2($arq22, "    {\r\n");
   nm_imprime_2($arq22, "      strMaxHeight = Math.min(($(window.parent).height()-80), mt.height());\r\n");
   nm_imprime_2($arq22, "      self.parent.tb_resize(strMaxHeight + 40, mt.width() + 40);\r\n");
   nm_imprime_2($arq22, "      setTimeout(\"ajusta_window()\", 50);\r\n");
   nm_imprime_2($arq22, "      return;\r\n");
   nm_imprime_2($arq22, "    }\r\n");
   nm_imprime_2($arq22, "  }\r\n");
   nm_imprime_2($arq22, "  strMaxHeight = Math.min(($(window.parent).height()-80), mt.height());\r\n");
   nm_imprime_2($arq22, "  self.parent.tb_resize(strMaxHeight + 40, mt.width() + 40);\r\n");
   nm_imprime_2($arq22, "}\r\n");
   nm_imprime_2($arq22, "\$( document ).ready(function() {\r\n");
   nm_imprime_2($arq22, "  ajusta_window();\r\n");
   nm_imprime_2($arq22, "});\r\n");
   nm_imprime_2($arq22, "</script>\r\n");
   //colocado aqui devido a execução modal não executar o ready do jquery
   nm_imprime_2($arq22, "<script>\r\n");
   nm_imprime_2($arq22, "  ajusta_window();\r\n");
   nm_imprime_2($arq22, "</script>\r\n");
   nm_imprime_2($arq22, "</BODY>\r\n");
   nm_imprime_2($arq22, "</HTML>\r\n");
   nm_imprime_2($arq22, "<?php\r\n");

   // incorporacao do group by na consulta
   nm_imprime_2($arq22,"   }\r\n");

   nm_imprime_2($arq22, "}\r\n");
   nm_imprime_2($arq22, "}\r\n");
   nm_finaliza($arq22);
   fclose($arq22);
}
function gera_java_script_free($arq)
{
   nm_imprime_2($arq,"<script language=\"javascript\"> \r\n" ) ;
   include_once('nm_gp_duplo_sel_js.php');
   gera_js_duplo_sel($arq, '_sel_gb', 'Fsel_quebras', 'nm_imprime_2');
   nm_imprime_2($arq," // move elementos para baixo\r\n");
   nm_imprime_2($arq," //--------------------------\r\n");
   nm_imprime_2($arq," function nm_move_down(v_str_field)\r\n");
   nm_imprime_2($arq," {\r\n");
   nm_imprime_2($arq,"  obj_sel = document.Fsel_quebras.elements[v_str_field];\r\n");
   nm_imprime_2($arq,"  if (1 < obj_sel.length)\r\n");
   nm_imprime_2($arq,"  {\r\n");
   nm_imprime_2($arq,"   for (i = (obj_sel.length - 2); i >= 0; i--)\r\n");
   nm_imprime_2($arq,"   {\r\n");
   nm_imprime_2($arq,"    if ((null != obj_sel.options[i]) && obj_sel.options[i].selected &&\r\n");
   nm_imprime_2($arq,"        !obj_sel.options[i + 1].selected)\r\n");
   nm_imprime_2($arq,"    {\r\n");
   nm_imprime_2($arq,"     bol_sel                         = obj_sel.options[i + 1].selected;\r\n");
   nm_imprime_2($arq,"     str_txt                         = obj_sel.options[i].text;\r\n");
   nm_imprime_2($arq,"     str_val                         = obj_sel.options[i].value;\r\n");
   nm_imprime_2($arq,"     obj_sel.options[i].text         = obj_sel.options[i + 1].text;\r\n");
   nm_imprime_2($arq,"     obj_sel.options[i].value        = obj_sel.options[i + 1].value;\r\n");
   nm_imprime_2($arq,"     obj_sel.options[i + 1].text     = str_txt;\r\n");
   nm_imprime_2($arq,"     obj_sel.options[i + 1].value    = str_val;\r\n");
   nm_imprime_2($arq,"     obj_sel.options[i].selected     = bol_sel;\r\n");
   nm_imprime_2($arq,"     obj_sel.options[i + 1].selected = true;\r\n");
   nm_imprime_2($arq,"    }\r\n");
   nm_imprime_2($arq,"   }\r\n");
   nm_imprime_2($arq,"  }\r\n");
   nm_imprime_2($arq," }\r\n");

   nm_imprime_2($arq," // move elementos para cima\r\n");
   nm_imprime_2($arq," //-------------------------\r\n");
   nm_imprime_2($arq," function nm_move_up(v_str_field)\r\n");
   nm_imprime_2($arq," {\r\n");
   nm_imprime_2($arq,"  obj_sel = document.Fsel_quebras.elements[v_str_field];\r\n");
   nm_imprime_2($arq,"  if (1 < obj_sel.length)\r\n");
   nm_imprime_2($arq,"  {\r\n");
   nm_imprime_2($arq,"   for (i = 1; i < obj_sel.length; i++)\r\n");
   nm_imprime_2($arq,"   {\r\n");
   nm_imprime_2($arq,"    if ((null != obj_sel.options[i]) && obj_sel.options[i].selected &&\r\n");
   nm_imprime_2($arq,"        !obj_sel.options[i - 1].selected)\r\n");
   nm_imprime_2($arq,"    {\r\n");
   nm_imprime_2($arq,"     bol_sel                         = obj_sel.options[i - 1].selected;\r\n");
   nm_imprime_2($arq,"     str_txt                         = obj_sel.options[i].text;\r\n");
   nm_imprime_2($arq,"     str_val                         = obj_sel.options[i].value;\r\n");
   nm_imprime_2($arq,"     obj_sel.options[i].text         = obj_sel.options[i - 1].text;\r\n");
   nm_imprime_2($arq,"     obj_sel.options[i].value        = obj_sel.options[i - 1].value;\r\n");
   nm_imprime_2($arq,"     obj_sel.options[i - 1].text     = str_txt;\r\n");
   nm_imprime_2($arq,"     obj_sel.options[i - 1].value    = str_val;\r\n");
   nm_imprime_2($arq,"     obj_sel.options[i].selected     = bol_sel;\r\n");
   nm_imprime_2($arq,"     obj_sel.options[i - 1].selected = true;\r\n");
   nm_imprime_2($arq,"    }\r\n");
   nm_imprime_2($arq,"   }\r\n");
   nm_imprime_2($arq,"  }\r\n");
   nm_imprime_2($arq," }\r\n");
   nm_imprime_2($arq," </script>\r\n");
}
?>