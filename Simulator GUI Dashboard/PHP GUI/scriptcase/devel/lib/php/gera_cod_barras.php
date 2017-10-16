<?php

/*novo cod barras */

/* tipos de barras gerados

site: http://www.barcodephp.com

   CODABAR  = Codabar
   CODE11   = Code 11
   CODE39   = Code 39  (Checksum)
   CODE39EXTENDED = Code 39 Extended  (Checksum)
   CODE93   = Code 93
   CODE128  = Code 128 (Auto, A, B ou C)
   NEAN8    = EAN-8
   NEAN13   = EAN-13
   GS1128   = GS1-128 (EAN-128)  (A, B ou C)
   ISBN     = ISBN-10 / ISBN-13
   I25      = Interleaved 2 of 5  (Checksum)
   S25      = Standard 2 of 5   (Checksum)
   MSI      = MSI Plessey  (Checksum)
   UPCA     = UPC-A
   UPCE     = UPC-E
   UPCEXT2  = UPC Extension 2 Digits
   UPCEXT5  =  UPC Extension 5 Digits
   POSTNET  = PostNet

Parâmetros:
   $nome_campo   - variavel ou string  com os dados de entrada
   $out_campo    - variavel para obter os dados de saida  (endereço da imagem gerada)
   $tp_cod_barra - Tipo do código de barras (tabela acima)
   $label        - Imprimir label S/N (default = S)
   $thickness    - Altura da imagem (default 30)
   $escala       - Fator de multiplicação da largura básica das barras (default 1)
   $angulo       - angulo em gráus para rotação (default 0)
   $dpi          - Resolução da imagem (default 72)
   $tp_imagem    - Tipo da imagem a ser gerada: Png , Jpeg ou Gif (defalt Png)
   $fonte        - Tipo da fonte (defaly Arial)
   $fontesize    - Tamanho da fonte  (default 8)
   $usa_checksun - Se vai gerar checksun: S/N  (defalt = N)  Apenas para: CODE39, CODE39EXTENDED, I25, S25 e MSI


*/
/* Protecao contra hacks */
if (!defined('SC_LOCKED_VERSION_8976') || ('CARREGADO4536' != SC_LOCKED_VERSION_8976))
{
    die('<br /><span style="font-weight: bold">Fatal error</span>: ' .
        'invalid access to system file.');
}


function nm_gera_cod_barras($nome_campo, $out_campo, $tp_cod_barra, $label="S", $thickness=30, $escala=1, $angulo=0, $dpi=72, $tp_imagem="png", $fonte="Arial", $fontesize=8, $usa_checksun="N", $num_espacos=0)
{
   $espacos  = str_repeat(" ", $num_espacos);
   if (empty($label))
   {
       $label = "S";
   }
   if (empty($thickness))
   {
       $thickness = 30;
   }
   if (empty($escala))
   {
       $escala = 1;
   }
   if (empty($angulo))
   {
       $angulo = 0;
   }
   if (empty($dpi))
   {
       $dpi = 72;
   }
   $tipo_img = "IMG_FORMAT_PNG";
   $ext_img  = ".png";
   if (strtolower($tp_imagem) == "jpeg")
   {
       $tipo_img  = "IMG_FORMAT_JPEG";
       $ext_img   = ".jpeg";
   }
   if (strtolower($tp_imagem) == "gif")
   {
       $tipo_img  = "IMG_FORMAT_GIF";
       $ext_img   = ".gif";
   }
   if (strtolower($tp_imagem) == "wbmp")
   {
       $tipo_img  = "IMG_FORMAT_WBMP";
       $ext_img   = ".wbmp";
   }
   if (empty($fonte))
   {
       $fonte = "Arial.ttf";
   }
   if (strpos($fonte, ".") === false)
   {
       $fonte = trim($fonte) . ".ttf";
   }
   if (empty($fontesize))
   {
       $fontesize = 8;
   }
   $checksun  = ($usa_checksun == "S") ? true : false;

   $bar_ok = false;
   $saida = "";

   if ($fonte != "Arial.ttf" && $fonte != "Courier.ttf" && $fonte != "Times.ttf" && $fonte != "Verdana.ttf")
   {
       $saida .= $espacos . "if (file_exists(\$this->Ini->path_third . '/barcodegen/class/font/" . $fonte . "'))\r\n";
       $saida .= $espacos . "{\r\n";
       $saida .= $espacos . "    \$Font_bar = new BCGFont(\$this->Ini->path_third . '/barcodegen/class/font/" . $fonte . "', " . $fontesize . ");\r\n";
       $saida .= $espacos . "}\r\n";
       $saida .= $espacos . "else\r\n";
       $saida .= $espacos . "{\r\n";
       $saida .= $espacos . "    \$Font_bar = new BCGFont(\$this->Ini->path_third . '/barcodegen/class/font/Arial.ttf', " . $fontesize . ");\r\n";
       $saida .= $espacos . "}\r\n";
   }
   else
   {
       $saida .= $espacos . "\$Font_bar = new BCGFont(\$this->Ini->path_third . '/barcodegen/class/font/Arial.ttf', " . $fontesize . ");\r\n";
   }
   $saida .= $espacos . "\$Color_black = new BCGColor(0, 0, 0);\r\n";
   $saida .= $espacos . "\$Color_white = new BCGColor(255, 255, 255);\r\n";
   $saida .= $espacos .  $out_campo . " = \$this->Ini->path_imag_temp . \"/sc_" . strtolower($tp_cod_barra) . "_\" . \$_SESSION['scriptcase']['sc_num_img'] . session_id() . \"$ext_img\";\r\n";
   $saida .= $espacos . "\$_SESSION['scriptcase']['sc_num_img']++ ;\r\n" ;

   $nome_campo = trim($nome_campo);
   if (substr($nome_campo, 0, 1) == "'" || substr($nome_campo, 0, 1) == '"')
   {
       $saida .= $espacos . "\$Nm_temp = (string) " . $nome_campo . ";\r\n" ;
       $nome_campo = "\$Nm_temp";
   }
   else
   {
       $saida .= $espacos . $nome_campo . " = (string) " . $nome_campo . ";\r\n" ;
   }
   if ($tp_cod_barra == "CODABAR")
   {
       $saida .= $espacos . "\$Code_bar = new BCGcodabar();\r\n";
       $saida .= $espacos . "\$Code_bar->setScale(" . $escala . ");\r\n";
       $saida .= $espacos . "\$Code_bar->setThickness(" . $thickness . ");\r\n";
       $saida .= $espacos . "\$Code_bar->setForegroundColor(\$Color_black);\r\n";
       $saida .= $espacos . "\$Code_bar->setBackgroundColor(\$Color_white);\r\n";
       $saida .= $espacos . "\$Code_bar->setFont(\$Font_bar);\r\n";
       if ($label != "S")
       {
           $saida .= $espacos . "\$Code_bar->setLabel('');\r\n";
       }
       $saida .= $espacos . "\$Code_bar->parse(" . $nome_campo . ");\r\n";
       $bar_ok = true;
   }
   if ($tp_cod_barra == "CODE11")
   {
       $saida .= $espacos . "\$Code_bar = new BCGcode11();\r\n";
       $saida .= $espacos . "\$Code_bar->setScale(" . $escala . ");\r\n";
       $saida .= $espacos . "\$Code_bar->setThickness(" . $thickness . ");\r\n";
       $saida .= $espacos . "\$Code_bar->setForegroundColor(\$Color_black);\r\n";
       $saida .= $espacos . "\$Code_bar->setBackgroundColor(\$Color_white);\r\n";
       $saida .= $espacos . "\$Code_bar->setFont(\$Font_bar);\r\n";
       if ($label != "S")
       {
           $saida .= $espacos . "\$Code_bar->setLabel('');\r\n";
       }
       $saida .= $espacos . "\$Code_bar->parse(" . $nome_campo . ");\r\n";
       $bar_ok = true;
   }
   if ($tp_cod_barra == "CODE39")
   {
       $saida .= $espacos . "\$Code_bar = new BCGcode39();\r\n";
       $saida .= $espacos . "\$Code_bar->setScale(" . $escala . ");\r\n";
       $saida .= $espacos . "\$Code_bar->setThickness(" . $thickness . ");\r\n";
       $saida .= $espacos . "\$Code_bar->setForegroundColor(\$Color_black);\r\n";
       $saida .= $espacos . "\$Code_bar->setBackgroundColor(\$Color_white);\r\n";
       $saida .= $espacos . "\$Code_bar->setFont(\$Font_bar);\r\n";
       if ($label != "S")
       {
           $saida .= $espacos . "\$Code_bar->setLabel('');\r\n";
       }
       if ($checksun)
       {
           $saida .= $espacos . "\$Code_bar->setChecksum(true);\r\n";
       }
       else
       {
           $saida .= $espacos . "\$Code_bar->setChecksum(false);\r\n";
       }
       $saida .= $espacos . "\$Code_bar->parse(" . $nome_campo . ");\r\n";
       $bar_ok = true;
   }
   if ($tp_cod_barra == "CODE39EXTENDED")
   {
       $saida .= $espacos . "\$Code_bar = new BCGcode39extended();\r\n";
       $saida .= $espacos . "\$Code_bar->setScale(" . $escala . ");\r\n";
       $saida .= $espacos . "\$Code_bar->setThickness(" . $thickness . ");\r\n";
       $saida .= $espacos . "\$Code_bar->setForegroundColor(\$Color_black);\r\n";
       $saida .= $espacos . "\$Code_bar->setBackgroundColor(\$Color_white);\r\n";
       $saida .= $espacos . "\$Code_bar->setFont(\$Font_bar);\r\n";
       if ($label != "S")
       {
           $saida .= $espacos . "\$Code_bar->setLabel('');\r\n";
       }
       if ($checksun)
       {
           $saida .= $espacos . "\$Code_bar->setChecksum(true);\r\n";
       }
       else
       {
           $saida .= $espacos . "\$Code_bar->setChecksum(false);\r\n";
       }
       $saida .= $espacos . "\$Code_bar->parse(" . $nome_campo . ");\r\n";
       $bar_ok = true;
   }
   if ($tp_cod_barra == "CODE93")
   {
       $saida .= $espacos . "\$Code_bar = new BCGcode93();\r\n";
       $saida .= $espacos . "\$Code_bar->setScale(" . $escala . ");\r\n";
       $saida .= $espacos . "\$Code_bar->setThickness(" . $thickness . ");\r\n";
       $saida .= $espacos . "\$Code_bar->setForegroundColor(\$Color_black);\r\n";
       $saida .= $espacos . "\$Code_bar->setBackgroundColor(\$Color_white);\r\n";
       $saida .= $espacos . "\$Code_bar->setFont(\$Font_bar);\r\n";
       if ($label != "S")
       {
           $saida .= $espacos . "\$Code_bar->setLabel('');\r\n";
       }
       $saida .= $espacos . "\$Code_bar->parse(" . $nome_campo . ");\r\n";
       $bar_ok = true;
   }
   if ($tp_cod_barra == "CODE128" || $tp_cod_barra == "CODE128A" || $tp_cod_barra == "CODE128B" || $tp_cod_barra == "CODE128C")
   {
       $saida .= $espacos . "\$Code_bar = new BCGcode128();\r\n";
       $saida .= $espacos . "\$Code_bar->setScale(" . $escala . ");\r\n";
       $saida .= $espacos . "\$Code_bar->setThickness(" . $thickness . ");\r\n";
       $saida .= $espacos . "\$Code_bar->setForegroundColor(\$Color_black);\r\n";
       $saida .= $espacos . "\$Code_bar->setBackgroundColor(\$Color_white);\r\n";
       $saida .= $espacos . "\$Code_bar->setFont(\$Font_bar);\r\n";
       if ($label != "S")
       {
           $saida .= $espacos . "\$Code_bar->setLabel('');\r\n";
       }
       if ($tp_cod_barra == "CODE128A")
       {
           $saida .= $espacos . "\$Code_bar->setStart('A');\r\n";
       }
       if ($tp_cod_barra == "CODE128B")
       {
           $saida .= $espacos . "\$Code_bar->setStart('B');\r\n";
       }
       if ($tp_cod_barra == "CODE128C")
       {
           $saida .= $espacos . "\$Code_bar->setStart('C');\r\n";
       }
       $saida .= $espacos . "\$Code_bar->setTilde(true);\r\n";
       $saida .= $espacos . "\$Code_bar->parse(" . $nome_campo . ");\r\n";
       $bar_ok = true;
   }
   if ($tp_cod_barra == "NEAN8")
   {
       $saida .= $espacos . "\$Code_bar = new BCGean8();\r\n";
       $saida .= $espacos . "\$Code_bar->setScale(" . $escala . ");\r\n";
       $saida .= $espacos . "\$Code_bar->setThickness(" . $thickness . ");\r\n";
       $saida .= $espacos . "\$Code_bar->setForegroundColor(\$Color_black);\r\n";
       $saida .= $espacos . "\$Code_bar->setBackgroundColor(\$Color_white);\r\n";
       $saida .= $espacos . "\$Code_bar->setFont(\$Font_bar);\r\n";
       if ($label != "S")
       {
           $saida .= $espacos . "\$Code_bar->setLabel('');\r\n";
       }
       $saida .= $espacos . "\$Code_bar->parse(substr(" . $nome_campo . ", 0, 7));\r\n";
       $bar_ok = true;
   }
   if ($tp_cod_barra == "NEAN13")
   {
       $saida .= $espacos . "\$Code_bar = new BCGean13();\r\n";
       $saida .= $espacos . "\$Code_bar->setScale(" . $escala . ");\r\n";
       $saida .= $espacos . "\$Code_bar->setThickness(" . $thickness . ");\r\n";
       $saida .= $espacos . "\$Code_bar->setForegroundColor(\$Color_black);\r\n";
       $saida .= $espacos . "\$Code_bar->setBackgroundColor(\$Color_white);\r\n";
       $saida .= $espacos . "\$Code_bar->setFont(\$Font_bar);\r\n";
       if ($label != "S")
       {
           $saida .= $espacos . "\$Code_bar->setLabel('');\r\n";
       }
       $saida .= $espacos . "\$Code_bar->parse(substr(" . $nome_campo . ", 0, 12));\r\n";
       $bar_ok = true;
   }
   if ($tp_cod_barra == "GS1128A" || $tp_cod_barra == "GS1128B" || $tp_cod_barra == "GS1128C")
   {
       $saida .= $espacos . "\$Code_bar = new BCGgs1128();\r\n";
       $saida .= $espacos . "\$Code_bar->setScale(" . $escala . ");\r\n";
       $saida .= $espacos . "\$Code_bar->setThickness(" . $thickness . ");\r\n";
       $saida .= $espacos . "\$Code_bar->setForegroundColor(\$Color_black);\r\n";
       $saida .= $espacos . "\$Code_bar->setBackgroundColor(\$Color_white);\r\n";
       $saida .= $espacos . "\$Code_bar->setFont(\$Font_bar);\r\n";
       if ($label != "S")
       {
           $saida .= $espacos . "\$Code_bar->setLabel('');\r\n";
       }
       if ($tp_cod_barra == "GS1128A")
       {
           $saida .= $espacos . "\$Code_bar->setStart('A');\r\n";
       }
       if ($tp_cod_barra == "GS1128B")
       {
           $saida .= $espacos . "\$Code_bar->setStart('B');\r\n";
       }
       if ($tp_cod_barra == "GS1128C")
       {
           $saida .= $espacos . "\$Code_bar->setStart('C');\r\n";
       }
       $saida .= $espacos . "\$Code_bar->setTilde(true);\r\n";
       $saida .= $espacos . "\$Code_bar->parse(" . $nome_campo . ");\r\n";
       $bar_ok = true;
   }
   if ($tp_cod_barra == "ISBN")
   {
       $saida .= $espacos . "\$Code_bar = new BCGisbn();\r\n";
       $saida .= $espacos . "\$Code_bar->setScale(" . $escala . ");\r\n";
       $saida .= $espacos . "\$Code_bar->setThickness(" . $thickness . ");\r\n";
       $saida .= $espacos . "\$Code_bar->setForegroundColor(\$Color_black);\r\n";
       $saida .= $espacos . "\$Code_bar->setBackgroundColor(\$Color_white);\r\n";
       $saida .= $espacos . "\$Code_bar->setFont(\$Font_bar);\r\n";
       if ($label != "S")
       {
           $saida .= $espacos . "\$Code_bar->setLabel('');\r\n";
       }
       $saida .= $espacos . "\$Code_bar->parse(substr(" . $nome_campo . ", 0, 12));\r\n";
       $bar_ok = true;
   }
   if ($tp_cod_barra == "I25")
   {
       $saida .= $espacos . "\$Code_bar = new BCGi25();\r\n";
       $saida .= $espacos . "\$Code_bar->setScale(" . $escala . ");\r\n";
       $saida .= $espacos . "\$Code_bar->setThickness(" . $thickness . ");\r\n";
       $saida .= $espacos . "\$Code_bar->setForegroundColor(\$Color_black);\r\n";
       $saida .= $espacos . "\$Code_bar->setBackgroundColor(\$Color_white);\r\n";
       $saida .= $espacos . "\$Code_bar->setFont(\$Font_bar);\r\n";
       if ($label != "S")
       {
           $saida .= $espacos . "\$Code_bar->setLabel('');\r\n";
       }
       if ($checksun)
       {
           $saida .= $espacos . "\$Code_bar->setChecksum(true);\r\n";
       }
       else
       {
           $saida .= $espacos . "\$Code_bar->setChecksum(false);\r\n";
       }
       $saida .= $espacos . "\$Code_bar->parse(" . $nome_campo . ");\r\n";
       $bar_ok = true;
   }
   if ($tp_cod_barra == "S25")
   {
       $saida .= $espacos . "\$Code_bar = new BCGs25();\r\n";
       $saida .= $espacos . "\$Code_bar->setScale(" . $escala . ");\r\n";
       $saida .= $espacos . "\$Code_bar->setThickness(" . $thickness . ");\r\n";
       $saida .= $espacos . "\$Code_bar->setForegroundColor(\$Color_black);\r\n";
       $saida .= $espacos . "\$Code_bar->setBackgroundColor(\$Color_white);\r\n";
       $saida .= $espacos . "\$Code_bar->setFont(\$Font_bar);\r\n";
       if ($label != "S")
       {
           $saida .= $espacos . "\$Code_bar->setLabel('');\r\n";
       }
       if ($checksun)
       {
           $saida .= $espacos . "\$Code_bar->setChecksum(true);\r\n";
       }
       else
       {
           $saida .= $espacos . "\$Code_bar->setChecksum(false);\r\n";
       }
       $saida .= $espacos . "\$Code_bar->parse(" . $nome_campo . ");\r\n";
       $bar_ok = true;
   }
   if ($tp_cod_barra == "MSI")
   {
       $saida .= $espacos . "\$Code_bar = new BCGmsi();\r\n";
       $saida .= $espacos . "\$Code_bar->setScale(" . $escala . ");\r\n";
       $saida .= $espacos . "\$Code_bar->setThickness(" . $thickness . ");\r\n";
       $saida .= $espacos . "\$Code_bar->setForegroundColor(\$Color_black);\r\n";
       $saida .= $espacos . "\$Code_bar->setBackgroundColor(\$Color_white);\r\n";
       $saida .= $espacos . "\$Code_bar->setFont(\$Font_bar);\r\n";
       if ($label != "S")
       {
           $saida .= $espacos . "\$Code_bar->setLabel('');\r\n";
       }
       if ($checksun)
       {
           $saida .= $espacos . "\$Code_bar->setChecksum(true);\r\n";
       }
       else
       {
           $saida .= $espacos . "\$Code_bar->setChecksum(false);\r\n";
       }
       $saida .= $espacos . "\$Code_bar->parse(" . $nome_campo . ");\r\n";
       $bar_ok = true;
   }
   if ($tp_cod_barra == "UPCA")
   {
       $saida .= $espacos . "\$Code_bar = new BCGupca();\r\n";
       $saida .= $espacos . "\$Code_bar->setScale(" . $escala . ");\r\n";
       $saida .= $espacos . "\$Code_bar->setThickness(" . $thickness . ");\r\n";
       $saida .= $espacos . "\$Code_bar->setForegroundColor(\$Color_black);\r\n";
       $saida .= $espacos . "\$Code_bar->setBackgroundColor(\$Color_white);\r\n";
       $saida .= $espacos . "\$Code_bar->setFont(\$Font_bar);\r\n";
       if ($label != "S")
       {
           $saida .= $espacos . "\$Code_bar->setLabel('');\r\n";
       }
       $saida .= $espacos . "\$Code_bar->parse(substr(" . $nome_campo . ", 0, 11));\r\n";
       $bar_ok = true;
   }
   if ($tp_cod_barra == "UPCE")
   {
       $saida .= $espacos . "\$Code_bar = new BCGupce();\r\n";
       $saida .= $espacos . "\$Code_bar->setScale(" . $escala . ");\r\n";
       $saida .= $espacos . "\$Code_bar->setThickness(" . $thickness . ");\r\n";
       $saida .= $espacos . "\$Code_bar->setForegroundColor(\$Color_black);\r\n";
       $saida .= $espacos . "\$Code_bar->setBackgroundColor(\$Color_white);\r\n";
       $saida .= $espacos . "\$Code_bar->setFont(\$Font_bar);\r\n";
       if ($label != "S")
       {
           $saida .= $espacos . "\$Code_bar->setLabel('');\r\n";
       }
       $saida .= $espacos . "if (strlen(" . $nome_campo . ") > 10)\r\n";
       $saida .= $espacos . "{\r\n";
       $saida .= $espacos .     "\$Code_bar->parse(substr(" . $nome_campo . ", 0, 11));\r\n";
       $saida .= $espacos . "}\r\n";
       $saida .= $espacos . "else\r\n";
       $saida .= $espacos . "{\r\n";
       $saida .= $espacos .     "\$Code_bar->parse(substr(" . $nome_campo . ", 0, 6));\r\n";
       $saida .= $espacos . "}\r\n";
       $bar_ok = true;
   }
   if ($tp_cod_barra == "UPCEXT2")
   {
       $saida .= $espacos . "\$Code_bar = new BCGupcext2();\r\n";
       $saida .= $espacos . "\$Code_bar->setScale(" . $escala . ");\r\n";
       $saida .= $espacos . "\$Code_bar->setThickness(" . $thickness . ");\r\n";
       $saida .= $espacos . "\$Code_bar->setForegroundColor(\$Color_black);\r\n";
       $saida .= $espacos . "\$Code_bar->setBackgroundColor(\$Color_white);\r\n";
       $saida .= $espacos . "\$Code_bar->setFont(\$Font_bar);\r\n";
       if ($label != "S")
       {
           $saida .= $espacos . "\$Code_bar->setLabel('');\r\n";
       }
       $saida .= $espacos .     "\$Code_bar->parse(substr(" . $nome_campo . ", 0, 2));\r\n";
       $bar_ok = true;
   }
   if ($tp_cod_barra == "UPCEXT5")
   {
       $saida .= $espacos . "\$Code_bar = new BCGupcext5();\r\n";
       $saida .= $espacos . "\$Code_bar->setScale(" . $escala . ");\r\n";
       $saida .= $espacos . "\$Code_bar->setThickness(" . $thickness . ");\r\n";
       $saida .= $espacos . "\$Code_bar->setForegroundColor(\$Color_black);\r\n";
       $saida .= $espacos . "\$Code_bar->setBackgroundColor(\$Color_white);\r\n";
       $saida .= $espacos . "\$Code_bar->setFont(\$Font_bar);\r\n";
       if ($label != "S")
       {
           $saida .= $espacos . "\$Code_bar->setLabel('');\r\n";
       }
       $saida .= $espacos .     "\$Code_bar->parse(substr(" . $nome_campo . ", 0, 5));\r\n";
       $bar_ok = true;
   }
   if ($tp_cod_barra == "POSTNET")
   {
       $saida .= $espacos . "\$Code_bar = new BCGpostnet();\r\n";
       $saida .= $espacos . "\$Code_bar->setScale(" . $escala . ");\r\n";
       $saida .= $espacos . "\$Code_bar->setThickness(" . $thickness . ");\r\n";
       $saida .= $espacos . "\$Code_bar->setForegroundColor(\$Color_black);\r\n";
       $saida .= $espacos . "\$Code_bar->setBackgroundColor(\$Color_white);\r\n";
       $saida .= $espacos . "\$Code_bar->setFont(\$Font_bar);\r\n";
       if ($label != "S")
       {
           $saida .= $espacos . "\$Code_bar->setLabel('');\r\n";
       }
       $saida .= $espacos . "if (strlen(" . $nome_campo . ") > 10)\r\n";
       $saida .= $espacos . "{\r\n";
       $saida .= $espacos .     "\$Code_bar->parse(substr(" . $nome_campo . ", 0, 11));\r\n";
       $saida .= $espacos . "}\r\n";
       $saida .= $espacos . "elseif (strlen(" . $nome_campo . ") > 8)\r\n";
       $saida .= $espacos . "{\r\n";
       $saida .= $espacos .     "\$Code_bar->parse(substr(" . $nome_campo . ", 0, 9));\r\n";
       $saida .= $espacos . "}\r\n";
       $saida .= $espacos . "else\r\n";
       $saida .= $espacos . "{\r\n";
       $saida .= $espacos .     "\$Code_bar->parse(substr(" . $nome_campo . ", 0, 5));\r\n";
       $saida .= $espacos . "}\r\n";
       $bar_ok = true;
   }

   if ($bar_ok)
   {
       $saida .= $espacos . "\$Drawing_bar = new BCGDrawing(\$this->Ini->root . " . $out_campo . ", \$Color_white);\r\n";
       $saida .= $espacos . "\$Drawing_bar->setBarcode(\$Code_bar);\r\n";
       if (!empty($angulo))
       {
           $saida .= $espacos . "\$Drawing_bar->setRotationAngle($angulo);\r\n";
       }
       if (!empty($dpi))
       {
           $saida .= $espacos . "\$Drawing_bar->setDPI($dpi);\r\n";
       }
       $saida .= $espacos . "\$Drawing_bar->draw();\r\n";
       $saida .= $espacos . "\$Drawing_bar->finish(BCGDrawing::" . $tipo_img. ");\r\n";
   }
   else
   {
       $saida = $espacos .  $out_campo . " = \"\";\r\n";
   }

   return  $saida;
}
?>
