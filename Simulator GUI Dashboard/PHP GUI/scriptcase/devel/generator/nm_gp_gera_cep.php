<?php
   @session_start() ;
/**
 * $Id: nm_gp_gera_cep.php,v 1.5 2011-10-06 15:56:00 sergio Exp $
 */
/*******************************************************************
 * Script Case
 *------------------------------------------------------------------
 * Arquivo  : nm_cep.php
 * Modulo   : CEP
 * Criacao  : 18.12.2001
 * Alteracao: 19.12.2001
 *------------------------------------------------------------------
 * Busca de CEPs
 *------------------------------------------------------------------
 * © NetMake Solucoes em Informatica Ltda
 *******************************************************************/

$cep_localidades = array();
$cep_especiais   = array();
$cep_quant_loc   = 0;
$cep_quant_esp   = 0;
$arq_logr        = "";
$achou_logr      = "";
$achou_cep       = "";
$local_cep       = "";
$Opcao           = "";
$Est             = "";
$Localidade      = "";
$Tipo            = "";
$Logradouro      = "";
$form_origem     = "";
$cep_path = $_SESSION['scriptcase']['nm_root_cep'] . $_SESSION['scriptcase']['nm_path_cep'];

$_SESSION['scriptcase']['nm_charset_cep'] = "ISO-8859-1";
if (isset($_SESSION['scriptcase']['charset']) && !empty($_SESSION['scriptcase']['charset']))
{
    $_SESSION['scriptcase']['nm_charset_cep'] = $_SESSION['scriptcase']['charset'];
}

// Dados do formulario de origem
if (!empty($_POST))
{
    foreach ($_POST as $nmgp_var => $nmgp_val)
    {
        if ($_SESSION['scriptcase']['nm_charset_cep'] != "ISO-8859-1")
        {
            $nmgp_val = mb_convert_encoding($nmgp_val, "ISO-8859-1", $_SESSION['scriptcase']['nm_charset_cep']);
        }
        $$nmgp_var = $nmgp_val;
    }
}
if (!empty($_GET))
{
    foreach ($_GET as $nmgp_var => $nmgp_val)
    {
        if ($_SESSION['scriptcase']['nm_charset_cep'] != "ISO-8859-1")
        {
            $nmgp_val = mb_convert_encoding($nmgp_val, "ISO-8859-1", $_SESSION['scriptcase']['nm_charset_cep']);
        }
        $$nmgp_var = $nmgp_val;
    }
}

$mens_erro = "";
// Verifica integridade dos arquivos do CEP
if (is_file($cep_path . "/arquivos/cep_contrl_arq.txt"))
{
    $raq_contrl = file($cep_path . "/arquivos/cep_contrl_arq.txt");
    foreach ($raq_contrl as $cada_contrl)
    {
       $dados_contrl = explode("@#@", $cada_contrl);
       if (isset($dados_contrl[1]) && !empty($dados_contrl[0]))
       {
           if (md5_file($cep_path . "/arquivos/cep_logradouros_" . $dados_contrl[0] . ".txt") != $dados_contrl[1])
           {
               $mens_erro .= "Os arquivos de acesso ao CEP est&atilde;o corrompidos. <br>";
               break;
           }
       }
    }
}

// Verifica existencia dos arquivos do CEP
if (!is_file($cep_path . "/arquivos/cep_faixas_estados.txt"))
{
    $mens_erro .= "N&atilde;o foram encontrados os arquivos de acesso ao CEP. <br>";
}

if (!empty($mens_erro))
{
    $mens_erro .= "Estes arquivos podem ser baixados do site do Scriprcase e copiados para o diret&oacute;rio onde foi instalado o PROD, <br>";
    $mens_erro .= "dentro da seguinte estrutura: ../prod/cep/arquivos.<br>";
    if (isset($_GET["onchange"]) && $_GET["onchange"] == "s")
    {
        $mens_erro = str_replace("<br>", "", $mens_erro);
        CEP_retorna_rpc("scep" . $mens_erro);
        exit;
    }
    echo "<html>";
    echo "<body>";
    echo "<table width=\"100%\" border=\"1\" height=\"100\">";
    echo "<tr>";
    echo "   <td bgcolor=\"#E4E8F0\"><b><font size=\"4\">";
    echo $mens_erro;
    echo "   </font></b></td>";
    echo " </tr>";
    echo "</table>";
    echo "</body>";
    echo "</html>";
    exit;
}

// Busca por CEP
$onchange = false;
if (isset($volta_pesq))
{
    $cep_opcao = "form_log";
}
elseif (isset($_GET["cep"]) && !empty($_GET["cep"]))
{
    $cep_opcao = "busca_cep";
    $CEP       = str_replace(".", "", str_replace("-", "", $_GET["cep"]));
    if (isset($_GET["onchange"]) && $_GET["onchange"] == "s")
    {
        $onchange = true;
    }
}
// Busca por Logradouro
elseif (!isset($_GET["BUSCAR"]))
{
    $cep_opcao = "form_log";
}
// Resultado da Busca por Logradouro
else
{
    $cep_opcao = "busca_log";
}


// Decide qual acao sera executada
switch ($cep_opcao)
{
    case "busca_cep":
        // Localiza UF
        $UF = "";
        $estados  = file($cep_path . "/arquivos/cep_faixas_estados.txt");
        foreach ($estados as $cada_faixa)
        {
            $est_dados = explode("@nm@", $cada_faixa);
            if ( ($CEP >= $est_dados[1]) && ($CEP <= $est_dados[2]) )
            {
                $UF = $est_dados[0];
                break;
            }
        }
        if ("" == $UF)
        {
            CEP_nao_encontrado();
        }
        // Busca por Localidade
        nm_cep_ler_localidades(strtolower($UF));
        $registros = 0;
        while ($registros < $cep_quant_loc)
        {
               $cada_loc = explode("@nm@", $cep_localidades[$registros]);
               if ($cada_loc[0] == $UF && $cada_loc[2] == $CEP)
               {
                   $CIDADE = $cada_loc[1];
                   $CEP8   = $CEP;
                   $registros = $cep_quant_loc;
                   CEP_imprime_loc();
               }
               $registros++;
        }
        // Busca por Logradouro
        nm_cep_ler_faixas_cep_localidades(strtolower($UF), $CEP);
        $registros = 0;
        if ($achou_cep == "S")
        {
            while ($registros == 0)
            {
               $cada_logradouro = fgets($arq_logr, 1024);
               $cada_loc = explode("@nm@", $cada_logradouro);
               if (isset($cada_loc[3]) && $cada_loc[3] == $CEP)
               {
                   $UF      = $cada_loc[0];
                   $NOME    = $cada_loc[2];
                   $CEP8    = $cada_loc[3];
                   $CIDADE  = $cada_loc[4];
                   $BAIRRO  = $cada_loc[5];
                   $TIPOEXT = $cada_loc[6];
                   if (!empty($cada_loc[1]))
                   {
/*                       $TIPOEXT .= " " . $cada_loc[1]; */
                       $NOME  =  trim($cada_loc[1]) . " " . $NOME;
                   }
                   $COMPLE  = $cada_loc[7];
                   $registros = 1;
                   CEP_imprime_log();
               }
               else
               {
                   if (!isset($cada_loc[4]) || $local_cep != $cada_loc[4])
                   {
                       $registros = 1;
                   }
               }
            }
            fclose($arq_logr);
        }
        // Busca por Logradouro Especial
        nm_cep_ler_especiais(strtolower($UF));
        $registros = 0;
        while ($registros < $cep_quant_esp)
        {
               $cada_loc = explode("@nm@", $cep_especiais[$registros]);
               if ($cada_loc[1] == $CEP)
               {
                   $UF      = $cada_loc[2];
                   $NOME    = $cada_loc[0];
                   $CEP8    = $cada_loc[1];
                   $CIDADE  = $cada_loc[4];
                   $BAIRRO  = $cada_loc[5];
                   $RUA     = $cada_loc[7];
                   $TIPOEXT = $cada_loc[6];
                   if (!empty($cada_loc[8]))
                   {
                       $RUA  =  trim($cada_loc[8]) . " " . $RUA;
                   }
                   if (!empty($cada_loc[3]))
                   {
                       $RUA .= ", " . $cada_loc[3];
                   }
                   $COMPLE = "";
                   $registros = $cep_quant_esp;
                   CEP_imprime_esp();
               }
               $registros++;
        }
        CEP_nao_encontrado();
    break;
    case "form_log":
        include("SC_cep_log.php");
    break;
    case "busca_log":
        $existe        = "nao";
        $cep_cor_linha = "";
        $local_arq     = "";
        $cep_cor_impar = "#E8E8E8";
        $cep_cor_par   = "#F0F0F0";
        $local_pesq    = RetiraAcentos($Localidade);
        $logr_pesq     = RetiraAcentos($Logradouro);
        // Busca por Localidade
        nm_cep_ler_localidades(strtolower($UF));
        $registros = 0;
        while ($registros < $cep_quant_loc && $local_arq != $local_pesq)
        {
               $cada_loc = explode("@nm@", $cep_localidades[$registros]);
               $local_arq  = RetiraAcentos($cada_loc[1]);
               if ($local_arq == $local_pesq && !empty($cada_loc[2]))
               {
                   $CIDADE = $cada_loc[1];
                   $CEP8   = $cada_loc[2];
                   $registros = $cep_quant_loc;
                   CEP_imprime_loc();
               }
               $registros++;
        }
        // Busca por Logradouro
        nm_cep_ler_pointer_logradouros(strtolower($UF), $Localidade);
        $registros = 0;
        $list_logradouros = array();
        if ($achou_logr == "S")
        {
            $local_orig  = "";
            $local_arq   = "";
            while ($registros == 0)
            {
               $cada_logradouro = fgets($arq_logr, 1024);
               $cada_loc = explode("@nm@", $cada_logradouro);
               $var_teste_logr  = (isset($cada_loc[1] ) && $cada_loc[1] != "") ? trim($cada_loc[1]) . " " : "";
               $var_teste_logr .= (isset($cada_loc[2] ) && $cada_loc[2] != "") ? $cada_loc[2]  : "";
               $var_teste_logr  = RetiraAcentos($var_teste_logr);
               if (isset($cada_loc[4]) && $cada_loc[4] != $local_orig)
               {
                   $local_orig = $cada_loc[4];
                   $local_arq  = RetiraAcentos($cada_loc[4]);
               }
               if ($local_arq == $local_pesq && isset($cada_loc[4]))
               {
                   if ("Exatamente" == $Opcao)
                   {
                       if ($var_teste_logr == $logr_pesq)
                       {
                           $list_logradouros[] = $cada_logradouro;
                       }
                   }
                   if ("Comecando" == $Opcao)
                   {
                       $quant = strlen(trim($logr_pesq));
                       if (substr($var_teste_logr, 0, $quant) == substr($logr_pesq, 0, $quant))
                       {
                           $list_logradouros[] = $cada_logradouro;
                       }
                   }
                   if ("Contenha" == $Opcao)
                   {
                       $trab  = trim($logr_pesq);
                       $trab1 = " " . $var_teste_logr;
                       if (strpos($trab1, $trab) != FALSE)
                       {
                           $list_logradouros[] = $cada_logradouro;
                       }
                   }
                   if ("Terminando" == $Opcao)
                   {
                       $trab  = trim($logr_pesq);
                       $trab1 = substr($var_teste_logr, strlen($var_teste_logr) - strlen($trab));
                       if ($trab == $trab1)
                       {
                           $list_logradouros[] = $cada_logradouro;
                       }
                   }
               }
               else
               {
                   $registros = 1;
               }
            }
            fclose($arq_logr);
        }
        if (!empty($list_logradouros))
        {
            $existe = "sim";
            CEP_imprime_header();
            CEP_imprime_loglist();
        }
        // Busca por Logradouro Especial
        nm_cep_ler_especiais(strtolower($UF));
        $registros = 0;
        $list_especiais = array();
        $local_orig  = "";
        $local_arq   = "";
        while ($registros < $cep_quant_esp)
        {
               $cada_loc = explode("@nm@", $cep_especiais[$registros]);
               $var_teste_logr  = ($cada_loc[8] != "") ? trim($cada_loc[8]) . " " : "";
               $var_teste_logr .= $cada_loc[7];
               $var_teste_logr  = RetiraAcentos($var_teste_logr);
               if ($cada_loc[4] != $local_orig)
               {
                   $local_orig = $cada_loc[4];
                   $local_arq  = RetiraAcentos($cada_loc[4]);
               }
               if ("Exatamente" == $Opcao)
               {
                   if ($var_teste_logr == $logr_pesq && $local_arq == $local_pesq && $cada_loc[2] == $UF)
                   {
                       $list_especiais[] = $cep_especiais[$registros];
                   }
               }
               if ("Comecando" == $Opcao)
               {
                   if ($local_arq == $local_pesq && $cada_loc[2] == $UF)
                   {
                       $quant = strlen(trim($logr_pesq));
                       if (substr($var_teste_logr, 0, $quant) == substr($logr_pesq, 0, $quant))
                       {
                           $list_especiais[] = $cep_especiais[$registros];
                       }
                   }
               }
               if ("Contenha" == $Opcao)
               {
                   if ($local_arq == $local_pesq && $cada_loc[2] == $UF)
                   {
                       $trab = trim($logr_pesq);
                       $trab1 = " " . $var_teste_logr;
                       if (strpos($trab1, $trab) != FALSE)
                       {
                           $list_especiais[] = $cep_especiais[$registros];
                       }
                   }
               }
               if ("Terminando" == $Opcao)
               {
                   if ($local_arq == $local_pesq && $cada_loc[2] == $UF)
                   {
                       $trab  = trim($logr_pesq);
                       $trab1 = substr($var_teste_logr, strlen($var_teste_logr) - strlen($trab));
                       if ($trab == $trab1)
                       {
                           $list_especiais[] = $cep_especiais[$registros];
                       }
                   }
               }
               $registros++;
        }
        if (!empty($list_especiais))
        {
            if ("nao" == $existe)
            {
                $existe = "sim";
                CEP_imprime_header();
            }
            CEP_imprime_esplist();
        }
        if ("nao" == $existe)
        {
            CEP_nao_encontrado();
        }
        else
        {
            CEP_imprime_footer();
        }
    break;
}

function CEP_formata($cep)
{
    if (8 != strlen($cep))
    {
        return ($cep);
    }
    else
    {
        return (substr($cep, 0, 5) . "-" . substr($cep, 5));
    }
}

function CEP_erro_bd($db_err)
{
?>
<HTML>
<HEAD>
 <TITLE>NetMake :: Erro de acesso ao banco de dados</TITLE>
 <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['nm_charset_cep'] ?>" />
 <STYLE TYPE="text/css">
 <!--
 .nm_botao {font-family: Tahoma, Arial, sans-serif; font-size: 12px; color: #000000}
 -->
 </STYLE>
 <SCRIPT LANGUAGE="Javascript">
 function nm_fecha_janela()
 {
  if (self.parent && self.parent.$)
  {
   self.parent.tb_remove();
  }
  else
  {
   window.close();
  }
 }
 </SCRIPT>
</HEAD>
<BODY BGCOLOR="#FFFFFF" MARGINWIDTH="0px" LEFTMARGIN="0px" RIGHTMARGIN="0px" MARGINHEIGHT="0px" TOPMARGIN="0px">
<TABLE BORDER="0" CELLPADDING="0" CELLSPACING="0" WIDTH="100%">
 <TR BGCOLOR="#000000">
  <TD>
   <TABLE BORDER="0" CELLPADDING="0" CELLSPACING="0" WIDTH="100%">
    <TR>
     <TD WIDTH="35" ALIGN="center"><IMG SRC="<?php echo $_SESSION['scriptcase']['nm_path_cep']; ?>/images/nm_logo.gif" BORDER="0" WIDTH="30" HEIGHT="30" ALIGN="absmiddle"></TD>
     <TD ALIGN="left"><FONT FACE="Verdana, Arial, sans-serif" SIZE="5" COLOR="#FFFFFF">&nbsp;<B><I>CEP</I></B>&nbsp;</FONT></TD>
    </TR>
   </TABLE>
  </TD>
 </TR>
</TABLE>
<TABLE BORDER="0" CELLPADDING="0" CELLSPACING="0" WIDTH="100%">
 <TR>
  <TD>
   <FONT FACE="Tahoma, Arial, sans-serif" SIZE="2">
   Ocorreu um erro no acesso ao banco de dados.
   <BR>
   <?php echo $db_err; ?>
   <BR>
   <INPUT TYPE="button" VALUE="Sair" onClick="nm_fecha_janela()" CLASS="nm_botao">
   </FONT>
  </TD>
 </TR>
</TABLE>
</BODY>
</HTML>
<?php
    exit;
}

function CEP_nao_encontrado()
{
    global $CEP, $UF, $Localidade, $Tipo, $Logradouro, $Opcao, $form_origem, $onchange;

    if ($onchange)
    {
        CEP_retorna_rpc("nao");
        exit;
    }
?>
<HTML>
<HEAD>
 <TITLE>NetMake :: CEP não encontrado</TITLE>
 <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['nm_charset_cep'] ?>" />
 <STYLE TYPE="text/css">
 <!--
 .nm_botao {font-family: Tahoma, Arial, sans-serif; font-size: 12px; color: #000000}
 -->
 </STYLE>
 <SCRIPT LANGUAGE="Javascript">
 function nm_fecha_janela()
 {
  if (self.parent && self.parent.$)
  {
   self.parent.tb_remove();
  }
  else
  {
   window.close();
  }
 }
 </SCRIPT>
</HEAD>
<BODY BGCOLOR="#FFFFFF" MARGINWIDTH="0px" LEFTMARGIN="0px" RIGHTMARGIN="0px" MARGINHEIGHT="0px" TOPMARGIN="0px">
<?php
    if ($_SESSION['scriptcase']['nm_charset_cep'] != "ISO-8859-1")
    {
        nm_decode_ISO($Localidade);
        nm_decode_ISO($Tipo);
        nm_decode_ISO($Logradouro);
        nm_decode_ISO($Opcao);
    }
?>
</BODY>
<form name="naotem" method="post">
<input type=hidden name="Est" value="<?php echo $UF ?>">
<input type=hidden name="Localidade" value="<?php echo $Localidade ?>">
<input type=hidden name="Tipo" value="<?php echo $Tipo ?>">
<input type=hidden name="Logradouro" value="<?php echo $Logradouro ?>">
<input type=hidden name="Opcao" value="<?php echo $Opcao ?>">
<input type=hidden name="form_origem" value="<?php echo $form_origem ?>">
<input type=hidden name="volta_pesq" value="yes">

<TABLE BORDER="0" CELLPADDING="0" CELLSPACING="0" WIDTH="100%">
 <TR BGCOLOR="#000000">
  <TD>
   <TABLE BORDER="0" CELLPADDING="0" CELLSPACING="0" WIDTH="100%">
    <TR>
     <TD WIDTH="35" ALIGN="center"><IMG SRC="<?php echo $_SESSION['scriptcase']['nm_path_cep']; ?>/images/nm_logo.gif" BORDER="0" WIDTH="30" HEIGHT="30" ALIGN="absmiddle"></TD>
     <TD ALIGN="left"><FONT FACE="Verdana, Arial, sans-serif" SIZE="5" COLOR="#FFFFFF">&nbsp;<B><I>CEP</I></B>&nbsp;</FONT></TD>
    </TR>
   </TABLE>
  </TD>
 </TR>
</TABLE>
<TABLE BORDER="0" CELLPADDING="0" CELLSPACING="0" WIDTH="100%">
 <TR>
  <TD>
   <FONT FACE="Tahoma, Arial, sans-serif" SIZE="2">
   O CEP <?php echo CEP_formata($CEP); ?> n&atilde;o foi localizado na base de dados.
   <BR>
   <INPUT TYPE="submit" VALUE="Pesquisar" CLASS="nm_botao">
   <INPUT TYPE="button" VALUE="Sair" onClick="nm_fecha_janela()" CLASS="nm_botao">
   </FONT>
  </TD>
 </TR>
</TABLE>
</form>
</BODY>
</HTML>
<?php
    exit;
}

function CEP_imprime_loc()
{
    global $CIDADE, $CEP8, $UF, $onchange;

    if ($onchange)
    {
        if ($_SESSION['scriptcase']['nm_charset_cep'] != "ISO-8859-1")
        {
            nm_decode_ISO($CIDADE);
        }
        $string = $CEP8 . "#;#" . "#;#" . "#;#" . "#;#" . "#;#" . $CIDADE . "#;#" . $UF . "#;#";
        CEP_retorna_rpc($string);
        exit;
    }

?>
<HTML>
<HEAD>
 <TITLE>NetMake :: CEP</TITLE>
 <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['nm_charset_cep'] ?>" />
 <STYLE TYPE="text/css">
 <!--
 .nm_botao {font-family: Tahoma, Arial, sans-serif; font-size: 12px; color: #000000}
 -->
 </STYLE>
 <SCRIPT LANGUAGE="Javascript">
 function nm_fecha_janela()
 {
  if (self.parent && self.parent.$)
  {
   self.parent.tb_remove();
  }
  else
  {
   window.close();
  }
 }
<?php
    CEP_form_loc();
?>
 </SCRIPT>
</HEAD>
<BODY BGCOLOR="#FFFFFF" MARGINWIDTH="0px" LEFTMARGIN="0px" RIGHTMARGIN="0px" MARGINHEIGHT="0px" TOPMARGIN="0px">
<TABLE BORDER="0" CELLPADDING="0" CELLSPACING="0" WIDTH="100%">
 <TR BGCOLOR="#000000">
  <TD>
   <TABLE BORDER="0" CELLPADDING="0" CELLSPACING="0" WIDTH="100%">
    <TR>
     <TD WIDTH="35" ALIGN="center"><IMG SRC="<?php echo $_SESSION['scriptcase']['nm_path_cep']; ?>/images/nm_logo.gif" BORDER="0" WIDTH="30" HEIGHT="30" ALIGN="absmiddle"></TD>
     <TD ALIGN="left"><FONT FACE="Verdana, Arial, sans-serif" SIZE="5" COLOR="#FFFFFF">&nbsp;<B><I>CEP</I></B>&nbsp;</FONT></TD>
    </TR>
   </TABLE>
  </TD>
 </TR>
</TABLE>
<?php
    if ($_SESSION['scriptcase']['nm_charset_cep'] != "ISO-8859-1")
    {
        nm_decode_ISO($CIDADE);
    }
?>
<TABLE BORDER="0" CELLPADDING="0" CELLSPACING="0" WIDTH="100%">
 <TR>
  <TD>
   <FONT FACE="Tahoma, Arial, sans-serif" SIZE="2">
   Resultado da busca:
   <TABLE>
    <TR>
     <TD><FONT FACE="Tahoma, Arial, sans-serif" SIZE="2"><B>Cidade</B>:</FONT></TD>
     <TD><FONT FACE="Tahoma, Arial, sans-serif" SIZE="2"><?php echo $CIDADE; ?></FONT></TD>
    </TR>
    <TR>
     <TD><FONT FACE="Tahoma, Arial, sans-serif" SIZE="2"><B>CEP</B>:</FONT></TD>
     <TD><FONT FACE="Tahoma, Arial, sans-serif" SIZE="2"><?php echo CEP_formata($CEP8); ?></FONT></TD>
    </TR>
    <TR>
     <TD><FONT FACE="Tahoma, Arial, sans-serif" SIZE="2"><B>UF</B>:</FONT></TD>
     <TD><FONT FACE="Tahoma, Arial, sans-serif" SIZE="2"><?php echo $UF; ?></FONT></TD>
    </TR>
   </TABLE>
   <BR>
   <INPUT TYPE="button" VALUE="Confirmar" onClick="nm_confirma()" CLASS="nm_botao">
   <INPUT TYPE="button" VALUE="Cancelar" onClick="nm_fecha_janela()" CLASS="nm_botao">
   </FONT>
  </TD>
 </TR>
</TABLE>

</BODY>
</HTML>
<?php
    exit;
}

function CEP_imprime_log()
{
    global $NOME, $BAIRRO, $CIDADE, $CEP8, $UF, $TIPOEXT, $COMPLE, $onchange;

    if ($onchange)
    {
        if ($_SESSION['scriptcase']['nm_charset_cep'] != "ISO-8859-1")
        {
            nm_decode_ISO($TIPOEXT);
            nm_decode_ISO($NOME);
            nm_decode_ISO($BAIRRO);
            nm_decode_ISO($CIDADE);
        }
        $string = $CEP8 . "#;#" . trim($TIPOEXT) . " " . $NOME . "#;#" . $TIPOEXT . "#;#" . $NOME . "#;#" . $BAIRRO . "#;#" . $CIDADE . "#;#" . $UF . "#;#";
        CEP_retorna_rpc($string);
        exit;
    }

?>
<HTML>
<HEAD>
 <TITLE>NetMake :: CEP</TITLE>
 <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['nm_charset_cep'] ?>" />
 <STYLE TYPE="text/css">
 <!--
 .nm_botao {font-family: Tahoma, Arial, sans-serif; font-size: 12px; color: #000000}
 -->
 </STYLE>
 <SCRIPT LANGUAGE="Javascript">
 function nm_fecha_janela()
 {
  if (self.parent && self.parent.$)
  {
   self.parent.tb_remove();
  }
  else
  {
   window.close();
  }
 }
<?php
    CEP_form_log();
?>
 </SCRIPT>
</HEAD>
<BODY BGCOLOR="#FFFFFF" MARGINWIDTH="0px" LEFTMARGIN="0px" RIGHTMARGIN="0px" MARGINHEIGHT="0px" TOPMARGIN="0px">
<TABLE BORDER="0" CELLPADDING="0" CELLSPACING="0" WIDTH="100%">
 <TR BGCOLOR="#000000">
  <TD>
   <TABLE BORDER="0" CELLPADDING="0" CELLSPACING="0" WIDTH="100%">
    <TR>
     <TD WIDTH="35" ALIGN="center"><IMG SRC="<?php echo $_SESSION['scriptcase']['nm_path_cep']; ?>/images/nm_logo.gif" BORDER="0" WIDTH="30" HEIGHT="30" ALIGN="absmiddle"></TD>
     <TD ALIGN="left"><FONT FACE="Verdana, Arial, sans-serif" SIZE="5" COLOR="#FFFFFF">&nbsp;<B><I>CEP</I></B>&nbsp;</FONT></TD>
    </TR>
   </TABLE>
  </TD>
 </TR>
</TABLE>
<TABLE BORDER="0" CELLPADDING="0" CELLSPACING="0" WIDTH="100%">
 <TR>
  <TD>
   <FONT FACE="Tahoma, Arial, sans-serif" SIZE="2">
   Resultado da busca:
   <BR>
<?php
    if ($_SESSION['scriptcase']['nm_charset_cep'] != "ISO-8859-1")
    {
        nm_decode_ISO($TIPOEXT);
        nm_decode_ISO($NOME);
        nm_decode_ISO($COMPLE);
        nm_decode_ISO($BAIRRO);
        nm_decode_ISO($CIDADE);
    }
?>
   <TABLE>
    <TR>
     <TD><FONT FACE="Tahoma, Arial, sans-serif" SIZE="2"><B>Logradouro</B>:</FONT></TD>
     <TD><FONT FACE="Tahoma, Arial, sans-serif" SIZE="2"><?php echo trim($TIPOEXT) . " " . $NOME . " - " . $COMPLE; ?></FONT></TD>
    </TR>
    <TR>
     <TD><FONT FACE="Tahoma, Arial, sans-serif" SIZE="2"><B>Bairro</B>:</FONT></TD>
     <TD><FONT FACE="Tahoma, Arial, sans-serif" SIZE="2"><?php echo $BAIRRO; ?></FONT></TD>
    </TR>
    <TR>
     <TD><FONT FACE="Tahoma, Arial, sans-serif" SIZE="2"><B>Cidade</B>:</FONT></TD>
     <TD><FONT FACE="Tahoma, Arial, sans-serif" SIZE="2"><?php echo $CIDADE; ?></FONT></TD>
    </TR>
    <TR>
     <TD><FONT FACE="Tahoma, Arial, sans-serif" SIZE="2"><B>CEP</B>:</FONT></TD>
     <TD><FONT FACE="Tahoma, Arial, sans-serif" SIZE="2"><?php echo CEP_formata($CEP8); ?></FONT></TD>
    </TR>
    <TR>
     <TD><FONT FACE="Tahoma, Arial, sans-serif" SIZE="2"><B>UF</B>:</FONT></TD>
     <TD><FONT FACE="Tahoma, Arial, sans-serif" SIZE="2"><?php echo $UF; ?></FONT></TD>
    </TR>
   </TABLE>
   <BR>
   <INPUT TYPE="button" VALUE="Confirmar" onClick="nm_confirma()" CLASS="nm_botao">
   <INPUT TYPE="button" VALUE="Cancelar" onClick="nm_fecha_janela()" CLASS="nm_botao">
   </FONT>
  </TD>
 </TR>
</TABLE>
</BODY>
</HTML>
<?php
    exit;
}

function CEP_imprime_esp()
{
    global $NOME, $BAIRRO, $CIDADE, $CEP8, $UF, $RUA, $COMPLE, $TIPOEXT, $onchange;

    if ($onchange)
    {
        if ($_SESSION['scriptcase']['nm_charset_cep'] != "ISO-8859-1")
        {
            nm_decode_ISO($TIPOEXT);
            nm_decode_ISO($RUA);
            nm_decode_ISO($BAIRRO);
            nm_decode_ISO($CIDADE);
        }
        $string = $CEP8 . "#;#" . trim($TIPOEXT) . " " . $RUA . "#;#" . $TIPOEXT . "#;#" . $RUA . "#;#" . $BAIRRO . "#;#" . $CIDADE . "#;#" . $UF . "#;#";
        CEP_retorna_rpc($string);
        exit;
    }
?>
<HTML>
<HEAD>
 <TITLE>NetMake :: CEP</TITLE>
 <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['nm_charset_cep'] ?>" />
 <STYLE TYPE="text/css">
 <!--
 .nm_botao {font-family: Tahoma, Arial, sans-serif; font-size: 12px; color: #000000}
 -->
 </STYLE>
 <SCRIPT LANGUAGE="Javascript">
 function nm_fecha_janela()
 {
  if (self.parent && self.parent.$)
  {
   self.parent.tb_remove();
  }
  else
  {
   window.close();
  }
 }
<?php
    CEP_form_esp();
?>
 </SCRIPT>
</HEAD>
<BODY BGCOLOR="#FFFFFF" MARGINWIDTH="0px" LEFTMARGIN="0px" RIGHTMARGIN="0px" MARGINHEIGHT="0px" TOPMARGIN="0px">
<TABLE BORDER="0" CELLPADDING="0" CELLSPACING="0" WIDTH="100%">
 <TR BGCOLOR="#000000">
  <TD>
   <TABLE BORDER="0" CELLPADDING="0" CELLSPACING="0" WIDTH="100%">
    <TR>
     <TD WIDTH="35" ALIGN="center"><IMG SRC="<?php echo $_SESSION['scriptcase']['nm_path_cep']; ?>/images/nm_logo.gif" BORDER="0" WIDTH="30" HEIGHT="30" ALIGN="absmiddle"></TD>
     <TD ALIGN="left"><FONT FACE="Verdana, Arial, sans-serif" SIZE="5" COLOR="#FFFFFF">&nbsp;<B><I>CEP</I></B>&nbsp;</FONT></TD>
    </TR>
   </TABLE>
  </TD>
 </TR>
</TABLE>
<?php
    if ($_SESSION['scriptcase']['nm_charset_cep'] != "ISO-8859-1")
    {
        nm_decode_ISO($NOME);
        nm_decode_ISO($TIPOEXT);
        nm_decode_ISO($RUA);
        nm_decode_ISO($COMPLE);
        nm_decode_ISO($BAIRRO);
        nm_decode_ISO($CIDADE);
    }
?>
<TABLE BORDER="0" CELLPADDING="0" CELLSPACING="0" WIDTH="100%">
 <TR>
  <TD>
   <FONT FACE="Tahoma, Arial, sans-serif" SIZE="2">
   Resultado da busca:
   <BR>
   <TABLE>
    <TR>
     <TD><FONT FACE="Tahoma, Arial, sans-serif" SIZE="2"><B>Logradouro</B>:</FONT></TD>
     <TD><FONT FACE="Tahoma, Arial, sans-serif" SIZE="2"><?php echo $NOME . " - " . trim($TIPOEXT) . " " . $RUA . " - " . $COMPLE; ?></FONT></TD>
    </TR>
    <TR>
     <TD><FONT FACE="Tahoma, Arial, sans-serif" SIZE="2"><B>Bairro</B>:</FONT></TD>
     <TD><FONT FACE="Tahoma, Arial, sans-serif" SIZE="2"><?php echo $BAIRRO; ?></FONT></TD>
    </TR>
    <TR>
     <TD><FONT FACE="Tahoma, Arial, sans-serif" SIZE="2"><B>Cidade</B>:</FONT></TD>
     <TD><FONT FACE="Tahoma, Arial, sans-serif" SIZE="2"><?php echo $CIDADE; ?></FONT></TD>
    </TR>
    <TR>
     <TD><FONT FACE="Tahoma, Arial, sans-serif" SIZE="2"><B>CEP</B>:</FONT></TD>
     <TD><FONT FACE="Tahoma, Arial, sans-serif" SIZE="2"><?php echo CEP_formata($CEP8); ?></FONT></TD>
    </TR>
    <TR>
     <TD><FONT FACE="Tahoma, Arial, sans-serif" SIZE="2"><B>UF</B>:</FONT></TD>
     <TD><FONT FACE="Tahoma, Arial, sans-serif" SIZE="2"><?php echo $UF; ?></FONT></TD>
    </TR>
   </TABLE>
   <BR>
   <INPUT TYPE="button" VALUE="Confirmar" onClick="nm_confirma()" CLASS="nm_botao">
   <INPUT TYPE="button" VALUE="Cancelar" onClick="nm_fecha_janela()" CLASS="nm_botao">
   </FONT>
  </TD>
 </TR>
</TABLE>
</BODY>
</HTML>
<?php
    exit;
}

function CEP_imprime_loglist()
{
    global $list_logradouros, $cep_cor_linha, $cep_cor_impar, $cep_cor_par;
    foreach ($list_logradouros as $cada_log)
    {
        $cada_loc = explode("@nm@", $cada_log);
        $UF      = $cada_loc[0];
        $NOME    = $cada_loc[2];
        $CEP8    = $cada_loc[3];
        $CIDADE  = $cada_loc[4];
        $BAIRRO  = $cada_loc[5];
        $TIPOEXT = $cada_loc[6];
        if (!empty($cada_loc[1]))
        {
/*            $TIPOEXT .= " " . $cada_loc[1]; */
              $NOME  =  trim($cada_loc[1]) . " " . $NOME;
        }
        $COMPLE  = $cada_loc[7];
        $cep_cor_linha = ($cep_cor_linha == $cep_cor_impar) ? $cep_cor_par : $cep_cor_impar;

        if ($_SESSION['scriptcase']['nm_charset_cep'] != "ISO-8859-1")
        {
            nm_decode_ISO($NOME);
            nm_decode_ISO($TIPOEXT);
            nm_decode_ISO($COMPLE);
            nm_decode_ISO($BAIRRO);
            nm_decode_ISO($CIDADE);
        }
?>
 <TR BGCOLOR="<?php echo $cep_cor_linha; ?>">
  <TD><INPUT TYPE="radio" NAME="cep_check" onClick="nm_atualiza('<?php echo $CEP8; ?>', '<?php echo $UF; ?>', '<?php echo $CIDADE; ?>', '<?php echo $BAIRRO; ?>', '<?php echo $NOME; ?>', '<?php echo $TIPOEXT; ?>', '<?php echo $COMPLE; ?>', '')"></TD>
  <TD><FONT FACE="Tahoma, Arial, sans-serif" SIZE="1"><?php echo CEP_formata($CEP8); ?></FONT></TD>
  <TD><FONT FACE="Tahoma, Arial, sans-serif" SIZE="1"><?php echo trim($TIPOEXT) . " " . $NOME . " - " . $COMPLE; ?></FONT></TD>
  <TD><FONT FACE="Tahoma, Arial, sans-serif" SIZE="1"><?php echo $BAIRRO; ?></FONT></TD>
  <TD><FONT FACE="Tahoma, Arial, sans-serif" SIZE="1"><?php echo $CIDADE; ?></FONT></TD>
  <TD><FONT FACE="Tahoma, Arial, sans-serif" SIZE="1"><?php echo $UF; ?></FONT></TD>
 </TR>
<?php
    }
}

function CEP_imprime_esplist()
{
    global $list_especiais, $cep_cor_linha, $cep_cor_impar, $cep_cor_par;
    foreach ($list_especiais as $cada_esp)
    {
        $cada_loc = explode("@nm@", $cada_esp);
        $UF      = $cada_loc[2];
        $NOME    = $cada_loc[0];
        $CEP8    = $cada_loc[1];
        $CIDADE  = $cada_loc[4];
        $BAIRRO  = $cada_loc[5];
        $RUA     = $cada_loc[7];
        $TIPOEXT = $cada_loc[6];
        if (!empty($cada_loc[8]))
        {
            $RUA  =  trim($cada_loc[8]) . " " . $RUA;
        }
        if (!empty($cada_loc[3]))
        {
            $RUA .= ", " . $cada_loc[3];
        }
        $COMPLE = "";
        $cep_cor_linha = ($cep_cor_linha == $cep_cor_impar) ? $cep_cor_par : $cep_cor_impar;

        if ($_SESSION['scriptcase']['nm_charset_cep'] != "ISO-8859-1")
        {
            nm_decode_ISO($NOME);
            nm_decode_ISO($TIPOEXT);
            nm_decode_ISO($COMPLE);
            nm_decode_ISO($BAIRRO);
            nm_decode_ISO($CIDADE);
            nm_decode_ISO($RUA);
        }
?>

 <TR BGCOLOR="<?php echo $cep_cor_linha; ?>">
  <TD><INPUT TYPE="radio" NAME="cep_check" onClick="nm_atualiza('<?php echo $CEP8; ?>', '<?php echo $UF; ?>', '<?php echo $CIDADE; ?>', '<?php echo $BAIRRO; ?>', '<?php echo $RUA; ?>', '<?php echo $TIPOEXT; ?>', '<?php echo $NOME; ?>')"></TD>
  <TD><FONT FACE="Tahoma, Arial, sans-serif" SIZE="1"><?php echo CEP_formata($CEP8); ?></FONT></TD>
  <TD><FONT FACE="Tahoma, Arial, sans-serif" SIZE="1"><?php echo $NOME . " - " . trim($TIPOEXT) . " " . $RUA . " - " . $COMPLE; ?></FONT></TD>
  <TD><FONT FACE="Tahoma, Arial, sans-serif" SIZE="1"><?php echo $BAIRRO; ?></FONT></TD>
  <TD><FONT FACE="Tahoma, Arial, sans-serif" SIZE="1"><?php echo $CIDADE; ?></FONT></TD>
  <TD><FONT FACE="Tahoma, Arial, sans-serif" SIZE="1"><?php echo $UF; ?></FONT></TD>
 </TR>
<?php
    }
}

function CEP_imprime_header()
{
    global $CEP, $UF, $Localidade, $Tipo, $Logradouro, $Opcao, $form_origem;
?>
<HTML>
<HEAD>
 <TITLE>NetMake :: CEP</TITLE>
 <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['nm_charset_cep'] ?>" />
 <STYLE TYPE="text/css">
 <!--
 .nm_botao {font-family: Tahoma, Arial, sans-serif; font-size: 12px; color: #000000}
 -->
 </STYLE>
 <SCRIPT LANGUAGE="Javascript">
 function nm_fecha_janela()
 {
  if (self.parent && self.parent.$)
  {
   self.parent.tb_remove();
  }
  else
  {
   window.close();
  }
 }
 function nm_atualiza(cep, uf, cidade, bairro, rua, tipoext, comple, especial)
 {
  document.cep_busca.CEP.value      = cep;
  document.cep_busca.UF.value       = uf;
  document.cep_busca.CIDADE.value   = cidade;
  document.cep_busca.BAIRRO.value   = bairro;
  document.cep_busca.RUA.value      = tipoext + " " + rua;
  document.cep_busca.TIPOEXT.value  = tipoext;
  document.cep_busca.COMPLE.value   = comple;
  document.cep_busca.ESPECIAL.value = especial;
  document.cep_busca.LOGRAD.value   = rua;
 }
<?php
    CEP_form_lista();
?>
 </SCRIPT>
</HEAD>
<BODY BGCOLOR="#FFFFFF" MARGINWIDTH="0px" LEFTMARGIN="0px" RIGHTMARGIN="0px" MARGINHEIGHT="0px" TOPMARGIN="0px">
<TABLE BORDER="0" CELLPADDING="0" CELLSPACING="0" WIDTH="100%">
 <TR BGCOLOR="#000000">
  <TD>
   <TABLE BORDER="0" CELLPADDING="0" CELLSPACING="0" WIDTH="100%">
    <TR>
     <TD WIDTH="35" ALIGN="center"><IMG SRC="<?php echo $_SESSION['scriptcase']['nm_path_cep']; ?>/images/nm_logo.gif" BORDER="0" WIDTH="30" HEIGHT="30" ALIGN="absmiddle"></TD>
     <TD ALIGN="left"><FONT FACE="Verdana, Arial, sans-serif" SIZE="5" COLOR="#FFFFFF">&nbsp;<B><I>CEP</I></B>&nbsp;</FONT></TD>
    </TR>
   </TABLE>
  </TD>
 </TR>
</TABLE>
<FORM NAME="cep_busca"  method="post">
<?php
    if ($_SESSION['scriptcase']['nm_charset_cep'] != "ISO-8859-1")
    {
        nm_decode_ISO($Localidade);
        nm_decode_ISO($Logradouro);
        nm_decode_ISO($Opcao);
    }
?>
<TABLE BORDER="0" CELLPADDING="0" CELLSPACING="0" WIDTH="100%">
 <TR>
  <TD>
   <INPUT TYPE="hidden" NAME="CEP">
   <INPUT TYPE="hidden" NAME="UF">
   <INPUT TYPE="hidden" NAME="CIDADE">
   <INPUT TYPE="hidden" NAME="BAIRRO">
   <INPUT TYPE="hidden" NAME="RUA">
   <INPUT TYPE="hidden" NAME="TIPOEXT">
   <INPUT TYPE="hidden" NAME="COMPLE">
   <INPUT TYPE="hidden" NAME="ESPECIAL">
   <INPUT TYPE="hidden" NAME="LOGRAD">
   <input type=hidden name="Est" value="<?php echo $UF ?>">
   <input type=hidden name="Localidade" value="<?php echo $Localidade ?>">
   <input type=hidden name="Tipo" value="<?php echo $Tipo ?>">
   <input type=hidden name="Logradouro" value="<?php echo $Logradouro ?>">
   <input type=hidden name="Opcao" value="<?php echo $Opcao ?>">
   <input type=hidden name="form_origem" value="<?php echo $form_origem ?>">
   <input type=hidden name="volta_pesq" value="yes">
   <FONT FACE="Tahoma, Arial, sans-serif" SIZE="2">
   Escolha o CEP desejado:
   <BR><BR>
   <TABLE BORDER="0" CELLPADDING="0" CELLSPACING="1">
<?php
}

function CEP_imprime_footer()
{
?>
   </TABLE>
   <BR>
   <INPUT TYPE="button" VALUE="Confirmar" onClick="nm_confirma()" CLASS="nm_botao">
   <INPUT TYPE="submit" VALUE="Cancelar" CLASS="nm_botao">
   </FONT>
  </TD>
 </TR>
</TABLE>
</FORM>
</BODY>
</HTML>
<?php
}

function CEP_form_origem()
{
    global $form_origem;
    $partes     = explode(";", $form_origem);
    $form_nome  = $partes[0];
    $form_dados = array();
    for ($i = 1; $i < sizeof($partes); $i++)
    {
        $arr_tmp_list_change = explode(",", $partes[$i]);
        list($form_valor, $form_campo) = $arr_tmp_list_change;
        $form_dados[$form_valor] = $form_campo;
    }
    return (array("form" => $form_nome, "dados" => $form_dados));
}

function CEP_form_loc()
{
    global $CIDADE, $UF, $CEP8;
    $form_dados = CEP_form_origem();
?>
 function nm_confirma()
 {
<?php
    $aReturnValues = array();
    foreach ($form_dados["dados"] as $form_valor => $form_campo)
    {
        switch ($form_valor)
        {
            case "CIDADE":
                $form_dado = $CIDADE;
            break;
            case "UF":
                $form_dado = $UF;
            break;
            case "CEP":
                $form_dado = $CEP8;
            break;
            default:
                $form_dado = "";
            break;
        }

        $aReturnValues[] = '"' . $form_campo . '": {"type": "' . $form_valor . '", "value": "' . $form_dado . '"}';

        if ($_SESSION['scriptcase']['nm_charset_cep'] != "ISO-8859-1")
        {
            nm_decode_ISO($form_dado);
        }
?>
  objParent = self.parent && self.parent.$ ? self.parent : opener;
  if (objParent.document.getElementById('id_read_on_<?php echo $form_campo?>') )
  {
      objParent.document.getElementById('id_read_on_<?php echo $form_campo?>').innerHTML = "<?php echo $form_dado?>";
  }
  if (objParent.document.getElementById('id_ajax_label_<?php echo $form_campo?>') )
  {
      objParent.document.getElementById('id_ajax_label_<?php echo $form_campo?>').innerHTML = "<?php echo $form_dado?>";
  }
  tipo = objParent.document.<?php echo $form_dados["form"]; ?>.<?php echo $form_campo?>.type;
  if ("text" == tipo || "hidden" == tipo || "textarea" == tipo)
  {
   objParent.document.<?php echo $form_dados["form"]; ?>.<?php echo $form_campo?>.value = "<?php echo $form_dado; ?>";
  }
  else
  {
     if ("select" == tipo || "select-one" == tipo)
     {
        tam = objParent.document.<?php echo $form_dados["form"]; ?>.<?php echo $form_campo?>.length;
        for (i = 0; i < tam; i++)
        {
          if ("<?php echo $form_dado; ?>" == objParent.document.<?php echo $form_dados["form"]; ?>.<?php echo $form_campo?>.options[i].value)
          {
             objParent.document.<?php echo $form_dados["form"]; ?>.<?php echo $form_campo?>.options[i].selected = true;
          }
        }
     }
     else
     {
       tam = objParent.document.<?php echo $form_dados["form"]; ?>.<?php echo $form_campo?>.length;
       for (i = 0; i < tam; i++)
       {
         if ("<?php echo $form_dado; ?>" == objParent.document.<?php echo $form_dados["form"]; ?>.<?php echo $form_campo?>[i].value)
         {
            objParent.document.<?php echo $form_dados["form"]; ?>.<?php echo $form_campo?>[i].checked = true;
         }
       }
     }
  }
<?php
/*
  Obj_Form = objParent.document.<?php echo $form_dados["form"]; ?>.<?php echo $form_campo?>;
  if (Obj_Form.onfocus && Obj_Form.onfocus != '')
  {
      Obj_Form.onfocus();
  }
  if (Obj_Form.onblur && Obj_Form.onblur != '')
  {
      Obj_Form.onblur();
  }
*/
    }
?>
  if (objParent.cepReturnValues)
  {
    var returnValues = {<?php echo implode(', ', $aReturnValues); ?>};
    objParent.cepReturnValues(returnValues);
  }
  Obj_Form = objParent.document.<?php echo $form_dados["form"]; ?>.<?php echo $form_dados["dados"]["CEP"]?>;
  if (Obj_Form.onchange && Obj_Form.onchange != '')
  {
      Obj_Form.onchange();
  }
  if (self.parent && self.parent.$)
  {
   self.parent.tb_remove();
  }
  else
  {
   window.close();
  }
 }
<?php
}

function CEP_form_log()
{
    global $NOME, $BAIRRO, $CIDADE, $CEP8, $UF, $TIPOEXT, $COMPLE;
    $form_dados = CEP_form_origem();
    $nome_lograd = $NOME;
// CEP's do distrito federal'
    if ($CEP8 > 69999999 && $CEP8 < 73000000)
    {
        $nome_lograd .= " " .  $COMPLE;
    }
?>
 function nm_confirma()
 {
<?php
    $aReturnValues = array();
    foreach ($form_dados["dados"] as $form_valor => $form_campo)
    {
        switch ($form_valor)
        {
            case "TIPOEXT":
                $form_dado = $TIPOEXT;
            break;
            case "LOGRAD":
                $form_dado = $nome_lograd;
            break;
            case "RUA":
                $form_dado = trim($TIPOEXT) . " " . $nome_lograd;
            break;
            case "COMPLE":
                $form_dado = ""; // $COMPLE;
            break;
            case "BAIRRO":
                $form_dado = $BAIRRO;
            break;
            case "CIDADE":
                $form_dado = $CIDADE;
            break;
            case "UF":
                $form_dado = $UF;
            break;
            case "CEP":
                $form_dado = $CEP8;
            break;
            default:
                $form_dado = "";
            break;
        }

        $aReturnValues[] = '"' . $form_campo . '": {"type": "' . $form_valor . '", "value": "' . $form_dado . '"}';

        if ($_SESSION['scriptcase']['nm_charset_cep'] != "ISO-8859-1")
        {
            nm_decode_ISO($form_dado);
        }
?>
  objParent = self.parent && self.parent.$ ? self.parent : opener;
  if (objParent.document.getElementById('id_read_on_<?php echo $form_campo?>') )
  {
      objParent.document.getElementById('id_read_on_<?php echo $form_campo?>').innerHTML = "<?php echo $form_dado?>";
  }
  if (objParent.document.getElementById('id_ajax_label_<?php echo $form_campo?>') )
  {
      objParent.document.getElementById('id_ajax_label_<?php echo $form_campo?>').innerHTML = "<?php echo $form_dado?>";
  }
  tipo = objParent.document.<?php echo $form_dados["form"]; ?>.<?php echo $form_campo?>.type;
  if ("text" == tipo || "hidden" == tipo || "textarea" == tipo)
  {
     objParent.document.<?php echo $form_dados["form"]; ?>.<?php echo $form_campo?>.value = "<?php echo $form_dado; ?>";
  }
  else
  {
     if ("select" == tipo || "select-one" == tipo)
     {
        tam = objParent.document.<?php echo $form_dados["form"]; ?>.<?php echo $form_campo?>.length;
        for (i = 0; i < tam; i++)
        {
          if ("<?php echo $form_dado; ?>" == objParent.document.<?php echo $form_dados["form"]; ?>.<?php echo $form_campo?>.options[i].value)
          {
             objParent.document.<?php echo $form_dados["form"]; ?>.<?php echo $form_campo?>.options[i].selected = true;
          }
        }
     }
     else
     {
        tam = objParent.document.<?php echo $form_dados["form"]; ?>.<?php echo $form_campo?>.length;
        for (i = 0; i < tam; i++)
        {
          if ("<?php echo $form_dado; ?>" == objParent.document.<?php echo $form_dados["form"]; ?>.<?php echo $form_campo?>[i].value)
          {
             objParent.document.<?php echo $form_dados["form"]; ?>.<?php echo $form_campo?>[i].checked = true;
          }
        }
     }
  }
<?php
    }
?>
  if (objParent.cepReturnValues)
  {
    var returnValues = {<?php echo implode(', ', $aReturnValues); ?>};
    objParent.cepReturnValues(returnValues);
  }
  Obj_Form = objParent.document.<?php echo $form_dados["form"]; ?>.<?php echo $form_dados["dados"]["CEP"]?>;
  if (Obj_Form.onchange && Obj_Form.onchange != '')
  {
      Obj_Form.onchange();
  }
  if (self.parent && self.parent.$)
  {
   self.parent.tb_remove();
  }
  else
  {
   window.close();
  }
 }
<?php
}

function CEP_form_esp()
{
    global $NOME, $BAIRRO, $CIDADE, $CEP8, $UF, $RUA, $COMPLE, $TIPOEXT;
    $form_dados = CEP_form_origem();
?>
 function nm_confirma()
 {
<?php
    $aReturnValues = array();
    foreach ($form_dados["dados"] as $form_valor => $form_campo)
    {
        switch ($form_valor)
        {
            case "RUA":
                $form_dado = trim($TIPOEXT) . " " . $RUA;
            break;
            case "LOGRAD":
                $form_dado = $RUA;
            break;
            case "COMPLE":
                $form_dado = $COMPLE;
            break;
            case "ESPECIAL":
                $form_dado = $NOME;
            break;
            case "BAIRRO":
                $form_dado = $BAIRRO;
            break;
            case "CIDADE":
                $form_dado = $CIDADE;
            break;
            case "UF":
                $form_dado = $UF;
            break;
            case "CEP":
                $form_dado = $CEP8;
            break;
            case "TIPOEXT":
                $form_dado = $TIPOEXT;
            break;
            default:
                $form_dado = "";
            break;
        }

        $aReturnValues[] = '"' . $form_campo . '": {"type": "' . $form_valor . '", "value": "' . $form_dado . '"}';

        if ($_SESSION['scriptcase']['nm_charset_cep'] != "ISO-8859-1")
        {
            nm_decode_ISO($form_dado);
        }
?>
  objParent = self.parent && self.parent.$ ? self.parent : opener;
  if (objParent.document.getElementById('id_read_on_<?php echo $form_campo?>') )
  {
      objParent.document.getElementById('id_read_on_<?php echo $form_campo?>').innerHTML = "<?php echo $form_dado?>";
  }
  if (objParent.document.getElementById('id_ajax_label_<?php echo $form_campo?>') )
  {
      objParent.document.getElementById('id_ajax_label_<?php echo $form_campo?>').innerHTML = "<?php echo $form_dado?>";
  }
  tipo = objParent.document.<?php echo $form_dados["form"]; ?>.<?php echo $form_campo?>.type;
  if ("text" == tipo || "hidden" == tipo || "textarea" == tipo)
  {
   objParent.document.<?php echo $form_dados["form"]; ?>.<?php echo $form_campo?>.value = "<?php echo $form_dado; ?>";
  }
  else
  {
     if ("select" == tipo || "select-one" == tipo)
     {
        tam = objParent.document.<?php echo $form_dados["form"]; ?>.<?php echo $form_campo?>.length;
        for (i = 0; i < tam; i++)
        {
          if ("<?php echo $form_dado; ?>" == objParent.document.<?php echo $form_dados["form"]; ?>.<?php echo $form_campo?>.options[i].value)
          {
             objParent.document.<?php echo $form_dados["form"]; ?>.<?php echo $form_campo?>.options[i].selected = true;
          }
        }
     }
     else
     {
        tam = objParent.document.<?php echo $form_dados["form"]; ?>.<?php echo $form_campo?>.length;
        for (i = 0; i < tam; i++)
        {
          if ("<?php echo $form_dado; ?>" == objParent.document.<?php echo $form_dados["form"]; ?>.<?php echo $form_campo?>[i].value)
          {
             objParent.document.<?php echo $form_dados["form"]; ?>.<?php echo $form_campo?>[i].checked = true;
          }
        }
     }
  }
<?php
    }
?>
  if (objParent.cepReturnValues)
  {
    var returnValues = {<?php echo implode(', ', $aReturnValues); ?>};
    objParent.cepReturnValues(returnValues);
  }
  Obj_Form = objParent.document.<?php echo $form_dados["form"]; ?>.<?php echo $form_dados["dados"]["CEP"]?>;
  if (Obj_Form.onchange && Obj_Form.onchange != '')
  {
      Obj_Form.onchange();
  }
  if (self.parent && self.parent.$)
  {
   self.parent.tb_remove();
  }
  else
  {
   window.close();
  }
 }
<?php
}

function CEP_form_lista()
{
    global $Localidade, $UF;

    $form_dados = CEP_form_origem();
?>
 function nm_confirma()
 {
<?php
    $aReturnValues = array();
    foreach ($form_dados["dados"] as $form_valor => $form_campo)
    {
        switch ($form_valor)
        {
            case "TIPOEXT":
                $form_dado = "document.cep_busca.TIPOEXT.value";
            break;
            case "LOGRAD":
                $form_dado = "document.cep_busca.LOGRAD.value";
            break;
            case "RUA":
                $form_dado = "document.cep_busca.RUA.value";
            break;
            case "COMPLE":
                $form_dado = "document.cep_busca.COMPLE.value";
            break;
            case "ESPECIAL":
                $form_dado = "document.cep_busca.ESPECIAL.value";
            break;
            case "BAIRRO":
                $form_dado = "document.cep_busca.BAIRRO.value";
            break;
            case "CIDADE":
                $form_dado = "document.cep_busca.CIDADE.value";
                $_SESSION['scriptcase']['cep_ult_cidade'] = $Localidade;
            break;
            case "UF":
                $form_dado = "document.cep_busca.UF.value";
                $_SESSION['scriptcase']['cep_ult_estado'] = $UF;
            break;
            case "CEP":
                $form_dado = "document.cep_busca.CEP.value";
            break;
            default:
                $form_dado = "";
            break;
        }

        $aReturnValues[] = '"' . $form_campo . '": {"type": "' . $form_valor . '", "value": "' . $form_dado . '"}';

        if ($_SESSION['scriptcase']['nm_charset_cep'] != "ISO-8859-1")
        {
            nm_decode_ISO($form_dado);
        }
?>
  objParent = self.parent && self.parent.$ ? self.parent : opener;
  if (objParent.document.getElementById('id_read_on_<?php echo $form_campo?>') )
  {
      objParent.document.getElementById('id_read_on_<?php echo $form_campo?>').innerHTML = <?php echo $form_dado?>;
  }
  if (objParent.document.getElementById('id_ajax_label_<?php echo $form_campo?>') )
  {
      objParent.document.getElementById('id_ajax_label_<?php echo $form_campo?>').innerHTML = <?php echo $form_dado?>;
  }
  tipo = objParent.document.<?php echo $form_dados["form"]; ?>.<?php echo $form_campo?>.type;
  if ("text" == tipo || "hidden" == tipo || "textarea" == tipo)
  {
   objParent.document.<?php echo $form_dados["form"]; ?>.<?php echo $form_campo?>.value = <?php echo $form_dado; ?>;
  }
  else
  {
     if ("select" == tipo || "select-one" == tipo)
     {
        tam = objParent.document.<?php echo $form_dados["form"]; ?>.<?php echo $form_campo?>.length;
        for (i = 0; i < tam; i++)
        {
          if (<?php echo $form_dado; ?> == objParent.document.<?php echo $form_dados["form"]; ?>.<?php echo $form_campo?>.options[i].value)
          {
             objParent.document.<?php echo $form_dados["form"]; ?>.<?php echo $form_campo?>.options[i].selected = true;
          }
        }
     }
     else
     {
        tam = objParent.document.<?php echo $form_dados["form"]; ?>.<?php echo $form_campo?>.length;
        for (i = 0; i < tam; i++)
        {
          if (<?php echo $form_dado; ?> == objParent.document.<?php echo $form_dados["form"]; ?>.<?php echo $form_campo?>[i].value)
          {
             objParent.document.<?php echo $form_dados["form"]; ?>.<?php echo $form_campo?>[i].checked = true;
          }
        }
     }
  }
<?php
    }
?>
  if (objParent.cepReturnValues)
  {
    var returnValues = {<?php echo implode(', ', $aReturnValues); ?>};
    objParent.cepReturnValues(returnValues);
  }
  Obj_Form = objParent.document.<?php echo $form_dados["form"]; ?>.<?php echo $form_dados["dados"]["CEP"]?>;
  if (Obj_Form.onchange && Obj_Form.onchange != '')
  {
      Obj_Form.onchange();
  }
  if (self.parent && self.parent.$)
  {
   self.parent.tb_remove();
  }
  else
  {
   window.close();
  }
 }
<?php
}

function nm_cep_ler_localidades($estado)
{
    global $cep_path, $cep_localidades, $cep_quant_loc;
    if (!empty($cep_localidades))
    {
        return;
    }
    $cep_localidades  = file($cep_path . "/arquivos/cep_localidades_" . $estado . ".txt");
    $cep_quant_loc   = count($cep_localidades);
}

function nm_cep_ler_especiais($estado)
{
    global $cep_path, $cep_especiais, $cep_quant_esp;
    if (!empty($cep_especiais))
    {
        return;
    }
    $cep_especiais  = file($cep_path . "/arquivos/cep_grandes_usuarios_" . $estado . ".txt");
    $cep_quant_esp   = count($cep_especiais);
}

function nm_cep_ler_faixas_cep_localidades($estado, $cep)
{
    global $cep_path, $achou_cep, $achou_logr, $local_cep;

    $achou_cep = "N";
    $cep_faixas  = file($cep_path . "/arquivos/cep_faixas_localidades.txt");
    foreach ($cep_faixas as $cada_faixa)
    {
        $cada_loc = explode("@nm@", $cada_faixa);
        if ($cada_loc[0] == strtoupper($estado) && ($cep >= $cada_loc[2] && $cep <= $cada_loc[3]))
        {
            $achou_cep = "S";
            break;
        }
    }
    if ($achou_cep == "S")
    {
        $local_cep = $cada_loc[1];
        nm_cep_ler_pointer_logradouros($estado, $cada_loc[1]);
        if ($achou_logr == "N")
        {
            $achou_cep = "N";
        }
    }
}

function nm_cep_ler_pointer_logradouros($estado, $cidade)
{
    global $cep_path, $arq_logr, $achou_logr;

    $achou_logr = "N";
    $arq_point = file($cep_path . "/arquivos/cep_pointer_log_" . $estado . ".txt");
    $cid_pesq  = RetiraAcentos($cidade);
    foreach ($arq_point as $cada_point)
    {
        $cada_loc = explode("@nm@", $cada_point);
        $cid_pt   = RetiraAcentos($cada_loc[0]);
        if ($cid_pt == $cid_pesq)
        {
            $achou_logr = "S";
            break;
        }
    }
    if ($achou_logr == "N")
    {
        return;
    }
    $arq_logr  = fopen($cep_path . "/arquivos/cep_logradouros_" .  strtolower($estado) . ".txt", 'r');
    fseek($arq_logr, $cada_loc[1]);
}
function CEP_retorna_rpc($string)
{
     echo "<html><head></head>";
     echo " <body onload=\"p=document.layers?parentLayer:window.parent;p.jsrsLoaded('" . $GLOBALS['C'] . "');\">";
     echo "  jsrsPayload:";
     echo "  <br>";
     echo "  <form name=\"jsrs_Form\"><textarea name=\"jsrs_Payload\">";
     echo "$string";
     echo " </textarea></form></body></html>";
}
function RetiraAcentos($Campo)
{
   $Campo = strtolower($Campo);
   $Campo = str_replace("á", "a", $Campo);
   $Campo = str_replace("à", "a", $Campo);
   $Campo = str_replace("ã", "a", $Campo);
   $Campo = str_replace("â", "a", $Campo);
   $Campo = str_replace("é", "e", $Campo);
   $Campo = str_replace("ê", "e", $Campo);
   $Campo = str_replace("í", "i", $Campo);
   $Campo = str_replace("ó", "o", $Campo);
   $Campo = str_replace("õ", "o", $Campo);
   $Campo = str_replace("ô", "o", $Campo);
   $Campo = str_replace("ú", "u", $Campo);
   $Campo = str_replace("ü", "u", $Campo);
   $Campo = str_replace("ç", "c", $Campo);
   return $Campo;
}

function nm_decode_ISO(&$val)
{
    $val = mb_convert_encoding($val, $_SESSION['scriptcase']['nm_charset_cep'], "ISO-8859-1");
}

?>