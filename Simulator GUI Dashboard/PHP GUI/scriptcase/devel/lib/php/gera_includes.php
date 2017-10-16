<?php
/* Includes PHP para todas as aplicações */
function gera_includes_libs_php($arr_includes, $num_espacos, $tp_apl)
{
   global $data_venc_upgrade;

   $saida = "";
   $arr_includes = array_unique($arr_includes);
   $espacos = str_repeat(" ", $num_espacos);
   foreach ($arr_includes as $cada_lib)
   {
       if (strtolower(substr($cada_lib, 0, 7)) == "barcode")
       {
           $saida .= $espacos . "include_once(\$this->Ini->path_third . \"/barcodegen/class/BCGFont.php\");\r\n";
           $saida .= $espacos . "include_once(\$this->Ini->path_third . \"/barcodegen/class/BCGColor.php\");\r\n";
           $saida .= $espacos . "include_once(\$this->Ini->path_third . \"/barcodegen/class/BCGDrawing.php\");\r\n";
           break;
       }
   }
   $b128   = false;
   $bgs128 = false;
   foreach ($arr_includes as $cada_lib)
   {
       if (strtolower($cada_lib) == "barcode_abar")
       {
           $saida .= $espacos . "include_once(\$this->Ini->path_third . \"/barcodegen/class/BCGcodabar.barcode.php\");\r\n";
       }
       if (strtolower($cada_lib) == "barcode_11")
       {
           $saida .= $espacos . "include_once(\$this->Ini->path_third . \"/barcodegen/class/BCGcode11.barcode.php\");\r\n";
       }
       if (strtolower($cada_lib) == "barcode_39")
       {
           $saida .= $espacos . "include_once(\$this->Ini->path_third . \"/barcodegen/class/BCGcode39.barcode.php\");\r\n";
       }
       if (strtolower($cada_lib) == "barcode_39extended")
       {
            $saida .= $espacos . "include_once(\$this->Ini->path_third . \"/barcodegen/class/BCGcode39extended.barcode.php\");\r\n";
       }
       if (strtolower($cada_lib) == "barcode_93")
       {
            $saida .= $espacos . "include_once(\$this->Ini->path_third . \"/barcodegen/class/BCGcode93.barcode.php\");\r\n";
       }
       if (!$b128 && (strtolower($cada_lib) == "barcode_128" || strtolower($cada_lib) == "barcode_128a" ||strtolower($cada_lib) == "barcode_128b" ||strtolower($cada_lib) == "barcode_128c"))
       {
            $saida .= $espacos . "include_once(\$this->Ini->path_third . \"/barcodegen/class/BCGcode128.barcode.php\");\r\n";
            $b128 = true;
       }
       if (strtolower($cada_lib) == "barcode_ean8")
       {
            $saida .= $espacos . "include_once(\$this->Ini->path_third . \"/barcodegen/class/BCGean8.barcode.php\");\r\n";
       }
       if (strtolower($cada_lib) == "barcode_ean13")
       {
            $saida .= $espacos . "include_once(\$this->Ini->path_third . \"/barcodegen/class/BCGean13.barcode.php\");\r\n";
       }
       if (!$bgs128 && (strtolower($cada_lib) == "barcode_gs1128a" ||strtolower($cada_lib) == "barcode_gs1128b" ||strtolower($cada_lib) == "barcode_gs1128c"))
       {
            $saida .= $espacos . "include_once(\$this->Ini->path_third . \"/barcodegen/class/BCGgs1128.barcode.php\");\r\n";
            $bgs128 = true;
       }
       if (strtolower($cada_lib) == "barcode_ibsn")
       {
            $saida .= $espacos . "include_once(\$this->Ini->path_third . \"/barcodegen/class/BCGisbn.barcode.php\");\r\n";
       }
       if (strtolower($cada_lib) == "barcode_i25")
       {
            $saida .= $espacos . "include_once(\$this->Ini->path_third . \"/barcodegen/class/BCGi25.barcode.php\");\r\n";
       }
       if (strtolower($cada_lib) == "barcode_s25")
       {
            $saida .= $espacos . "include_once(\$this->Ini->path_third . \"/barcodegen/class/BCGs25.barcode.php\");\r\n";
       }
       if (strtolower($cada_lib) == "barcode_msi")
       {
            $saida .= $espacos .  $espacos . "include_once(\$this->Ini->path_third . \"/barcodegen/class/BCGmsi.barcode.php\");\r\n";
       }
       if (strtolower($cada_lib) == "barcode_upca")
       {
            $saida .= $espacos . "include_once(\$this->Ini->path_third . \"/barcodegen/class/BCGupca.barcode.php\");\r\n";
       }
       if (strtolower($cada_lib) == "barcode_upce")
       {
            $saida .= $espacos . "include_once(\$this->Ini->path_third . \"/barcodegen/class/BCGupce.barcode.php\");\r\n";
       }
       if (strtolower($cada_lib) == "barcode_upcext2")
       {
            $saida .= $espacos . "include_once(\$this->Ini->path_third . \"/barcodegen/class/BCGupcext2.barcode.php\");\r\n";
       }
       if (strtolower($cada_lib) == "barcode_upcext5")
       {
            $saida .= $espacos . "include_once(\$this->Ini->path_third . \"/barcodegen/class/BCGupcext5.barcode.php\");\r\n";
       }
       if (strtolower($cada_lib) == "barcode_postnet")
       {
            $saida .= $espacos . "include_once(\$this->Ini->path_third . \"/barcodegen/class/BCGpostnet.barcode.php\");\r\n";
       }

       if ((strtolower($cada_lib) == "fpdf" || strtolower($cada_lib) == "fpdf_html" || strtolower($cada_lib) == "tcpdf") && $tp_apl != "reportpdf")
       {
            $saida .= $espacos . "\$old_dir = getcwd();\r\n";
/*
            $saida .= $espacos . "chdir(\$this->Ini->path_third . \"/fpdf/\");\r\n";
            $saida .= $espacos . "include_once(\"visibility.php\");\r\n";
*/
            $saida .= $espacos . "chdir(\$this->Ini->path_third . \"/tcpdf/\");\r\n";
            $saida .= $espacos . "include_once(\"tcpdf.php\");\r\n";
            $saida .= $espacos . "chdir(\$old_dir);\r\n";
       }
/*
       if (strtolower($cada_lib) == "fpdf_html" && $tp_apl != "reportpdf")
       {
            $saida .= $espacos . "\$old_dir = getcwd();\r\n";
            $saida .= $espacos . "chdir(\$this->Ini->path_third . \"/fpdf_html/\");\r\n";
            $saida .= $espacos . "include_once(\"visibility.php\");\r\n";
            $saida .= $espacos . "chdir(\$old_dir);\r\n";
       }
*/
       if (strtolower($cada_lib) == "excel")
       {
            $saida .= $espacos . "include_once \$this->Ini->path_third . '/phpexcel/PHPExcel.php';\r\n";
            $saida .= $espacos . "include_once \$this->Ini->path_third . '/phpexcel/PHPExcel/IOFactory.php';\r\n";
       }
       if (strtolower($cada_lib) == "rtf")
       {
            $saida .= $espacos . "include_once \$this->Ini->path_third . '/rtf_new/document_generator/cl_xml2driver.php';\r\n";
       }
   }
   return $saida;
}

/* Includes javascript para aplicações de consulta */
function gera_includes_libs_js_cons($nome_arq, $arr_includes, $num_espacos, $espacos_js, $tp_func, $tem_jqyery=false)
{
   $arr_includes = array_unique($arr_includes);
   $espacos = str_repeat(" ", $num_espacos);
   $function = ($tp_func == 2) ? "nm_imprime_2" : "nm_imprime";

   foreach ($arr_includes as $cada_lib)
   {
       if (strtolower(substr($cada_lib, 0, 6)) == "jquery" && !$tem_jqyery)
       {
           $function($nome_arq, $espacos . "<script type=\"text/javascript\" src=\"<?php echo \$this->Ini->path_prod ?>/third/jquery/js/jquery.js\"></script>\r\n", $espacos_js);
           break;
       }
   }
   foreach ($arr_includes as $cada_lib)
   {
       if (strtolower(substr($cada_lib, 0, 9)) == "jquery-ui")
       {
           $function($nome_arq, $espacos . "<script type=\"text/javascript\" src=\"<?php echo \$this->Ini->path_prod ?>/third/jquery/js/jquery-ui.js\"></script>\r\n", $espacos_js);
           $function($nome_arq, $espacos . "<link rel=\"stylesheet\" href=\"<?php echo \$this->Ini->path_prod ?>/third/jquery/css/smoothness/jquery-ui.css\" type=\"text/css\" media=\"screen\" />\r\n", $espacos_js);
           break;
       }
   }
   foreach ($arr_includes as $cada_lib)
   {
       if (strtolower($cada_lib) == "jquery_thickbox")
       {
           $function($nome_arq, $espacos . "<script type=\"text/javascript\">var sc_pathToTB = '<?php echo \$this->Ini->path_prod ?>/third/jquery_plugin/thickbox/';</script>\r\n", $espacos_js);
           $function($nome_arq, $espacos . "<script type=\"text/javascript\" src=\"<?php echo \$this->Ini->path_prod ?>/third/jquery_plugin/thickbox/thickbox-compressed.js\"></script>\r\n", $espacos_js);
           $function($nome_arq, $espacos . "<link rel=\"stylesheet\" href=\"<?php echo \$this->Ini->path_prod ?>/third/jquery_plugin/thickbox/thickbox.css\" type=\"text/css\" media=\"screen\" />\r\n", $espacos_js);
       }
       if (strtolower($cada_lib) == "jquery_blockui")
       {
           $function($nome_arq, $espacos . "<script type=\"text/javascript\" src=\"<?php echo \$this->Ini->path_prod ?>/third/jquery_plugin/malsup-blockui/jquery.blockui.js\"></script>\r\n", $espacos_js);
       }
       if (strtolower($cada_lib) == "tiny_mce")
       {
           $function($nome_arq, $espacos . "<script type=\"text/javascript\" src=\"<?php echo \$this->Ini->path_prod ?>/third/tiny_mce/tiny_mce.js\"></script>\r\n", $espacos_js);
       }
   }
}

/* Includes javascript para aplicações blank */
function gera_includes_libs_js_blank($arq_include)
{
   global $nm_incl_js_blank;

   $result = "";
   if (strtolower(substr($arq_include, 0, 6)) == "jquery" && !in_array("jquery", $nm_incl_js_blank))
   {
       $result .= "<script type=\"text/javascript\" src=\"<?php echo \$this->Ini->path_prod ?>/third/jquery/js/jquery.js\"></script>\r\n";
       $nm_incl_js_blank[] = "jquery";
   }
   if ((in_array("jquery", $nm_incl_js_blank) || strtolower(substr($arq_include, 0, 9)) == "jquery-ui") && !in_array("jquery-ui", $nm_incl_js_blank))
   {
       $result .= "<script type=\"text/javascript\" src=\"<?php echo \$this->Ini->path_prod ?>/third/jquery/js/jquery-ui.js\"></script>\r\n";
       $result .= "<link rel=\"stylesheet\" href=\"<?php echo \$this->Ini->path_prod ?>/third/jquery/css/smoothness/jquery-ui.css\" type=\"text/css\" media=\"screen\" />\r\n";
       $nm_incl_js_blank[] = "jquery-ui";
   }
   if (strtolower($arq_include) == "jquery_thickbox" && !in_array("jquery_thickbox", $nm_incl_js_blank))
   {
       $result .= "<script type=\"text/javascript\">var sc_pathToTB = '<?php echo \$this->Ini->path_prod ?>/third/jquery_plugin/thickbox/';</script>\r\n";
       $result .= "<script type=\"text/javascript\" src=\"<?php echo \$this->Ini->path_prod ?>/third/jquery_plugin/thickbox/thickbox-compressed.js\"></script>\r\n";
       $result .= "<link rel=\"stylesheet\" href=\"<?php echo \$this->Ini->path_prod ?>/third/jquery_plugin/thickbox/thickbox.css\" type=\"text/css\" media=\"screen\" />\r\n";
       $nm_incl_js_blank[] = "jquery_thickbox";
   }
   if (strtolower($arq_include) == "jquery_blockui" && !in_array("jquery_blockui", $nm_incl_js_blank))
   {
       $result .="<script type=\"text/javascript\" src=\"<?php echo \$this->Ini->path_prod ?>/third/jquery_plugin/malsup-blockui/jquery.blockui.js\"></script>\r\n";
       $nm_incl_js_blank[] = "jquery_blockui";
   }

   if (strtolower($arq_include) == "jquery_touch_punch" && !in_array("jquery_touch_punch", $nm_incl_js_blank))
   {
       $result .="<script type=\"text/javascript\" src=\"<?php echo \$this->Ini->path_prod ?>/third/jquery_plugin/touch_punch/jquery.ui.touch-punch.min.js\"></script>\r\n";
       $nm_incl_js_blank[] = "jquery_touch_punch";
   }
   if (strtolower($arq_include) == "tiny_mce" && !in_array("tiny_mce", $nm_incl_js_blank))
   {
       $result .= "<script type=\"text/javascript\" src=\"<?php echo \$this->Ini->path_prod ?>/third/tiny_mce/tiny_mce.js\"></script>\r\n";
       $nm_incl_js_blank[] = "tiny_mce";
   }
   return $result;
}

/* Includes javascript para aplicações de formulário e controle */
function gera_includes_libs_js_form($arr_includes, $num_espacos, $tem_jqyery=false)
{
   $result = "";
   $arr_includes = array_unique($arr_includes);
   $espacos = str_repeat(" ", $num_espacos);

   foreach ($arr_includes as $cada_lib)
   {
       if (strtolower(substr($cada_lib, 0, 6)) == "jquery" && !$tem_jqyery)
       {
           $result .= $espacos . "<script type=\"text/javascript\" src=\"<?php echo \$this->Ini->path_prod ?>/third/jquery/js/jquery.js\"></script>\r\n";
           break;
       }
   }
   foreach ($arr_includes as $cada_lib)
   {
       if (strtolower(substr($cada_lib, 0, 9)) == "jquery-ui" && !$tem_jqyery)
       {
           $result .= $espacos . "<script type=\"text/javascript\" src=\"<?php echo \$this->Ini->path_prod ?>/third/jquery/js/jquery-ui.js\"></script>\r\n";
           $result .= $espacos . "<link rel=\"stylesheet\" href=\"<?php echo \$this->Ini->path_prod ?>/third/jquery/css/smoothness/jquery-ui.css\" type=\"text/css\" media=\"screen\" />\r\n";
           break;
       }
   }

   foreach ($arr_includes as $cada_lib)
   {
       if (strtolower($cada_lib) == "jquery_thickbox")
       {
           $result .= $espacos . "<script type=\"text/javascript\">var sc_pathToTB = '<?php echo \$this->Ini->path_prod ?>/third/jquery_plugin/thickbox/';</script>\r\n";
           $result .= $espacos . "<script type=\"text/javascript\" src=\"<?php echo \$this->Ini->path_prod ?>/third/jquery_plugin/thickbox/thickbox-compressed.js\"></script>\r\n";
           $result .= $espacos . "<link rel=\"stylesheet\" href=\"<?php echo \$this->Ini->path_prod ?>/third/jquery_plugin/thickbox/thickbox.css\" type=\"text/css\" media=\"screen\" />\r\n";
       }
       if (strtolower($cada_lib) == "jquery_blockui")
       {
           $result .= $espacos . "<script type=\"text/javascript\" src=\"<?php echo \$this->Ini->path_prod ?>/third/jquery_plugin/malsup-blockui/jquery.blockui.js\"></script>\r\n";
       }
       if (strtolower($cada_lib) == "tiny_mce")
       {
           $result .= $espacos . "<script type=\"text/javascript\" src=\"<?php echo \$this->Ini->path_prod ?>/third/tiny_mce/tiny_mce.js\"></script>\r\n";
       }
   }
   return $result;
}

?>