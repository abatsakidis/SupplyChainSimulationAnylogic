<?php

$arq23 = fopen($patch . $arquivo23, 'w');

// tipos de campos não permitidos para recuperar/setar valor
$tipos_nao_permitidos = array(
        'PERCENT_CALC',
        'YOUTUBE',
        'GOOGLEMAPS',
        'IMAGEM',
        'ARQUIVO',
        'DOCUMENTO_DB',
        'DOCUMENTO',
        'BAR_CODE',
        'QRCODE',
);

if (!empty($nm_ajaxevt_codigo))
{
    // funcoes de acesso aos dados do campo
    $campos_usados_ajax = array();
    $linhas             = 0;
    while ($nmgp_quant > $linhas)
    {
        $seq        = $dados_cons[$linhas];
        $nmgp_campo = $tab_cmp[$seq]['nmgp_campo'];
        $nmgp_label = $tab_cmp[$seq]['nmgp_label'];

        $e_tipo_nao_permitido = in_array($tab_cmp[$seq]['nmgp_tipo_dado'], $tipos_nao_permitidos);

        if ($tab_cmp[$seq]['nmgp_entra_cons'] == "S" || $tab_cmp[$seq]['nmgp_grupa_col'] == "S")
        {
                fwrite($arq23, "function " . $nome_classe . "_" . $nmgp_campo . "_getValue(seqRow) {\r\n");

                if (!$e_tipo_nao_permitido)
                {
                        fwrite($arq23, "  seqRow = scSeqNormalize(seqRow);\r\n");
                        if ('FORM_IMAGE_HTML' == $tab_cmp[$seq]['nmgp_tipo_dado'])
                        {
                                fwrite($arq23, "  return \$(\"#id_sc_field_" . $nmgp_campo . "\" + seqRow).find(\"img\").attr(\"src\");\r\n");
                        }
                        elseif (isset($var_format_ajax[$nmgp_campo]))
                        {
                                fwrite($arq23, "  return \$(\"#id_sc_field_Hidden_" . $nmgp_campo . "\" + seqRow).html();\r\n");
                        }
                        else
                        {
                                fwrite($arq23, "  return \$(\"#id_sc_field_" . $nmgp_campo . "\" + seqRow).html();\r\n");
                        }
                }
                fwrite($arq23, "}\r\n");

                fwrite($arq23, "\r\n");

                fwrite($arq23, "function " . $nome_classe . "_" . $nmgp_campo . "_setValue(newValue, seqRow) {\r\n");
                if (!$e_tipo_nao_permitido)
                {
                        fwrite($arq23, "  seqRow = scSeqNormalize(seqRow);\r\n");
                        if ('FORM_IMAGE_HTML' == $tab_cmp[$seq]['nmgp_tipo_dado'])
                        {
                            fwrite($arq23, "  \$(\"#id_sc_field_" . $nmgp_campo . "\" + seqRow).find(\"img\").attr(\"src\", newValue);\r\n");
                        }
                        else
                        {
                            fwrite($arq23, "  \$(\"#id_sc_field_" . $nmgp_campo . "\" + seqRow).html(newValue);\r\n");
                        }
                }
                fwrite($arq23, "}\r\n");
                if (isset($var_format_ajax[$nmgp_campo]))
                {
                    fwrite($arq23, "function " . $nome_classe . "_" . $nmgp_campo . "_Hidden_setValue(newValue, seqRow) {\r\n");
                    fwrite($arq23, "  seqRow = scSeqNormalize(seqRow);\r\n");
                    fwrite($arq23, "  \$(\"#id_sc_field_Hidden_" . $nmgp_campo . "\" + seqRow).html(newValue);\r\n");
                    fwrite($arq23, "}\r\n");
                }
                fwrite($arq23, "\r\n");
                $campos_usados_ajax[] = $nmgp_campo;
        }
        $linhas++;
    }

    if (!empty($campos_usados_ajax))
    {
        fwrite($arq23, "function " . $nome_classe . "_getValue(field, seqRow) {\r\n");
        fwrite($arq23, "  seqRow = scSeqNormalize(seqRow);\r\n");
        foreach ($campos_usados_ajax as $campo_usado_ajax)
        {
                fwrite($arq23, "  if (\"" . $campo_usado_ajax . "\" == field) {\r\n");
                fwrite($arq23, "    return " . $nome_classe . "_" . $campo_usado_ajax . "_getValue(seqRow);\r\n");
                fwrite($arq23, "  }\r\n");
        }
        fwrite($arq23, "}\r\n");

        fwrite($arq23, "\r\n");

        fwrite($arq23, "function " . $nome_classe . "_setValue(field, newValue, seqRow) {\r\n");
        fwrite($arq23, "  seqRow = scSeqNormalize(seqRow);\r\n");
        foreach ($campos_usados_ajax as $campo_usado_ajax)
        {
                fwrite($arq23, "  if (\"" . $campo_usado_ajax . "\" == field) {\r\n");
                fwrite($arq23, "    " . $nome_classe . "_" . $campo_usado_ajax . "_setValue(newValue, seqRow);\r\n");
                fwrite($arq23, "  }\r\n");
        }
        foreach ($var_format_ajax as $nmgp_campo => $seq)
        {
                fwrite($arq23, "  if (\"" . $nmgp_campo . "_Hidden\" == field) {\r\n");
                fwrite($arq23, "    " . $nome_classe . "_" . $nmgp_campo . "_Hidden_setValue(newValue, seqRow);\r\n");
                fwrite($arq23, "  }\r\n");
        }
        fwrite($arq23, "}\r\n");

        fwrite($arq23, "\r\n");
    }

    // eventos ajax
    fwrite($arq23, "function scJQAddEvents(seqRow) {\r\n");
    fwrite($arq23, "  seqRow = scSeqNormalize(seqRow);\r\n");
    foreach ($nm_ajaxevt_codigo as $ajax_evento_info)
    {
        $evento_campo  = substr($ajax_evento_info['evento'], 0, -8);
        $evento_funcao = substr($ajax_evento_info['evento'], -7);

        if ('onClick' == $evento_funcao)
        {
                $cmp_evt  = "";
                $evento_params = array();

                if (isset($arr_campos_label2seq[$evento_campo]))
                {
                    $cmp_evt       = $arr_campos_label2seq[$evento_campo];
                }
                foreach ($var_local_ajax[$ajax_evento_info['evento']] as $cada_parm)
                {
                    $evento_params[] = $cada_parm . '=" + ' . $nome_classe . '_getValue("' . $cada_parm . '", seqRow) + "';
                }

                fwrite($arq23, "  \$(\"#id_sc_field_" . $tab_cmp[$cmp_evt]['nmgp_campo'] . "\" + seqRow).click(function () {\r\n");
                fwrite($arq23, "    \$.ajax({\r\n");
                fwrite($arq23, "      type: \"POST\",\r\n");
                fwrite($arq23, "      url: \"" . $arquivo3 . "\",\r\n");
                fwrite($arq23, "      data: \"nmgp_opcao=ajax_event&nmgp_event=" . $tab_cmp[$cmp_evt]['nmgp_campo'] . "_" . $evento_funcao . "&script_case_init=\" + document.F3.script_case_init.value + \"&script_case_session=\" + document.F3.script_case_session.value + \"&" . implode('&', $evento_params) . "\",\r\n");
                fwrite($arq23, "      success: function(jsonReturn) {\r\n");
                fwrite($arq23, "        var i, fieldDisplay, oResp;\r\n");
                fwrite($arq23, "        eval(\"oResp = \" + jsonReturn);\r\n");
                fwrite($arq23, "        if (oResp[\"setValue\"]) {\r\n");
                fwrite($arq23, "          for (i = 0; i < oResp[\"setValue\"].length; i++) {\r\n");
                fwrite($arq23, "            " . $nome_classe . "_setValue(oResp[\"setValue\"][i][\"field\"], oResp[\"setValue\"][i][\"value\"], seqRow);\r\n");
                fwrite($arq23, "          }\r\n");
                fwrite($arq23, "        }\r\n");
                fwrite($arq23, "        if (oResp[\"fieldDisplay\"]) {\r\n");
                fwrite($arq23, "          for (i = 0; i < oResp[\"fieldDisplay\"].length; i++) {\r\n");
                fwrite($arq23, "            if (\"off\" == oResp[\"fieldDisplay\"][i][\"status\"]) {\r\n");
                fwrite($arq23, "              \$(\"#id_sc_field_\" + oResp[\"fieldDisplay\"][i][\"field\"] + seqRow).hide();\r\n");
                fwrite($arq23, "            }\r\n");
                fwrite($arq23, "            else {\r\n");
                fwrite($arq23, "              \$(\"#id_sc_field_\" + oResp[\"fieldDisplay\"][i][\"field\"] + seqRow).show();\r\n");
                fwrite($arq23, "            }\r\n");
                fwrite($arq23, "          }\r\n");
                fwrite($arq23, "        }\r\n");
                fwrite($arq23, "        if (oResp[\"Refresh\"]) {\r\n");
                fwrite($arq23, "           nm_gp_move('igual');\r\n");
                fwrite($arq23, "        }\r\n");
                fwrite($arq23, "        if (oResp[\"redirInfo\"]) {\r\n");
                fwrite($arq23, "           nmAjaxRedir(oResp);\r\n");
                fwrite($arq23, "        }\r\n");
                if ($apl_tem_jan_output)
                {
                    fwrite($arq23, "        if (oResp[\"htmOutput\"]) {\r\n");
                    fwrite($arq23, "           nmAjaxShowDebug(oResp);\r\n");
                    fwrite($arq23, "        }\r\n");
                }
                if ($apl_tem_ajax_message)
                {
                    fwrite($arq23, "        if (oResp[\"ajaxMessage\"]) {\r\n");
                    fwrite($arq23, "           nmAjaxMessage(oResp);\r\n");
                    fwrite($arq23, "        }\r\n");
                }
                fwrite($arq23, "      }\r\n");
                fwrite($arq23, "    });\r\n");
                fwrite($arq23, "  }).mouseover(function() { \$(this).css(\"cursor\", \"pointer\"); })\r\n");
                fwrite($arq23, "    .mouseout(function() { \$(this).css(\"cursor\", \"pointer\"); })\r\n");
                fwrite($arq23, "    .addClass((\$(\"#id_sc_field_" . $evento_campo . "\" + seqRow).parent().hasClass(\"scGridFieldOddFont\") ? \"scGridFieldOddLink\" : \"scGridFieldEvenLink\"));\r\n");
                fwrite($arq23, "\r\n");
        }
    }
    fwrite($arq23, "}\r\n");

    fwrite($arq23, "\r\n");

    fwrite($arq23, "function scSeqNormalize(seqRow) {\r\n");
    fwrite($arq23, "  var newSeqRow = seqRow.toString();\r\n");
    fwrite($arq23, "  if (\"\" == newSeqRow) {\r\n");
    fwrite($arq23, "    return \"\";\r\n");
    fwrite($arq23, "  }\r\n");
    fwrite($arq23, "  if (\"_\" != newSeqRow.substr(0, 1)) {\r\n");
    fwrite($arq23, "    return \"_\" + newSeqRow;\r\n");
    fwrite($arq23, "  }\r\n");
    fwrite($arq23, "  return newSeqRow;\r\n");
    fwrite($arq23, "}\r\n");
}

    if ($apl_tem_ajax_message)
    {
        fwrite($arq23, "  function nmAjaxMessage(oTemp)\r\n");
        fwrite($arq23, "  {\r\n");
        fwrite($arq23, "    if (oTemp && oTemp != null) {\r\n");
        fwrite($arq23, "        oResp = oTemp;\r\n");
        fwrite($arq23, "    }\r\n");
        fwrite($arq23, "    if (oResp[\"ajaxMessage\"] && oResp[\"ajaxMessage\"][\"message\"] && \"\" != oResp[\"ajaxMessage\"][\"message\"])\r\n");
        fwrite($arq23, "    {\r\n");
        fwrite($arq23, "      var sTitle    = (oResp[\"ajaxMessage\"] && oResp[\"ajaxMessage\"][\"title\"])        ? oResp[\"ajaxMessage\"][\"title\"]               : scMsgDefTitle,\r\n");
        fwrite($arq23, "          bModal    = (oResp[\"ajaxMessage\"] && oResp[\"ajaxMessage\"][\"modal\"])        ? (\"Y\" == oResp[\"ajaxMessage\"][\"modal\"])      : false,\r\n");
        fwrite($arq23, "          iTimeout  = (oResp[\"ajaxMessage\"] && oResp[\"ajaxMessage\"][\"timeout\"])      ? parseInt(oResp[\"ajaxMessage\"][\"timeout\"])   : 0,\r\n");
        fwrite($arq23, "          bButton   = (oResp[\"ajaxMessage\"] && oResp[\"ajaxMessage\"][\"button\"])       ? (\"Y\" == oResp[\"ajaxMessage\"][\"button\"])     : false,\r\n");
        fwrite($arq23, "          sButton   = (oResp[\"ajaxMessage\"] && oResp[\"ajaxMessage\"][\"button_label\"]) ? oResp[\"ajaxMessage\"][\"button_label\"]        : \"Ok\",\r\n");
        fwrite($arq23, "          iTop      = (oResp[\"ajaxMessage\"] && oResp[\"ajaxMessage\"][\"top\"])          ? parseInt(oResp[\"ajaxMessage\"][\"top\"])       : 0,\r\n");
        fwrite($arq23, "          iLeft     = (oResp[\"ajaxMessage\"] && oResp[\"ajaxMessage\"][\"left\"])         ? parseInt(oResp[\"ajaxMessage\"][\"left\"])      : 0,\r\n");
        fwrite($arq23, "          iWidth    = (oResp[\"ajaxMessage\"] && oResp[\"ajaxMessage\"][\"width\"])        ? parseInt(oResp[\"ajaxMessage\"][\"width\"])     : 0,\r\n");
        fwrite($arq23, "          iHeight   = (oResp[\"ajaxMessage\"] && oResp[\"ajaxMessage\"][\"height\"])       ? parseInt(oResp[\"ajaxMessage\"][\"height\"])    : 0,\r\n");
        fwrite($arq23, "          bClose    = (oResp[\"ajaxMessage\"] && oResp[\"ajaxMessage\"][\"show_close\"])   ? (\"Y\" == oResp[\"ajaxMessage\"][\"show_close\"]) : true,\r\n");
        fwrite($arq23, "          bBodyIcon = (oResp[\"ajaxMessage\"] && oResp[\"ajaxMessage\"][\"body_icon\"])    ? (\"Y\" == oResp[\"ajaxMessage\"][\"body_icon\"])  : true,\r\n");
        fwrite($arq23, "          sRedir    = (oResp[\"ajaxMessage\"] && oResp[\"ajaxMessage\"][\"redir\"])        ? oResp[\"ajaxMessage\"][\"redir\"]               : \"\",\r\n");
        fwrite($arq23, "          sTarget   = (oResp[\"ajaxMessage\"] && oResp[\"ajaxMessage\"][\"redir_target\"]) ? oResp[\"ajaxMessage\"][\"redir_target\"]        : \"\",\r\n");
        fwrite($arq23, "          sParam    = (oResp[\"ajaxMessage\"] && oResp[\"ajaxMessage\"][\"redir_par\"])    ? oResp[\"ajaxMessage\"][\"redir_par\"]           : \"\";\r\n");
        fwrite($arq23, "      _nmAjaxShowMessage(sTitle, oResp[\"ajaxMessage\"][\"message\"], bModal, iTimeout, bButton, sButton, iTop, iLeft, iWidth, iHeight, sRedir, sTarget, sParam, bClose, bBodyIcon);\r\n");
        fwrite($arq23, "    }\r\n");
        fwrite($arq23, "  }\r\n");

        fwrite($arq23, "  function _nmAjaxShowMessage(sTitle, sMessage, bModal, iTimeout, bButton, sButton, iTop, iLeft, iWidth, iHeight, sRedir, sTarget, sParam, bClose, bBodyIcon) {\r\n");
        fwrite($arq23, "    if (\"\" == sMessage) {\r\n");
        fwrite($arq23, "      if (bModal) {\r\n");
        fwrite($arq23, "        scMsgDefClick = \"close_modal\";\r\n");
        fwrite($arq23, "      }\r\n");
        fwrite($arq23, "      else {\r\n");
        fwrite($arq23, "        scMsgDefClick = \"close\";\r\n");
        fwrite($arq23, "      }\r\n");
        fwrite($arq23, "      _nmAjaxMessageBtnClick();\r\n");
        fwrite($arq23, "      document.getElementById(\"id_message_display_title\").innerHTML = scMsgDefTitle;\r\n");
        fwrite($arq23, "      document.getElementById(\"id_message_display_text\").innerHTML = \"\";\r\n");
        fwrite($arq23, "      document.getElementById(\"id_message_display_buttone\").value = scMsgDefButton;\r\n");
        fwrite($arq23, "      document.getElementById(\"id_message_display_buttond\").style.display = \"none\";\r\n");
        fwrite($arq23, "    }\r\n");
        fwrite($arq23, "    else {\r\n");
        fwrite($arq23, "      document.getElementById(\"id_message_display_title\").innerHTML = nmAjaxSpecCharParser(sTitle);\r\n");
        fwrite($arq23, "      document.getElementById(\"id_message_display_text\").innerHTML = nmAjaxSpecCharParser(sMessage);\r\n");
        fwrite($arq23, "      document.getElementById(\"id_message_display_buttone\").value = sButton;\r\n");
        fwrite($arq23, "      document.getElementById(\"id_message_display_buttond\").style.display = bButton ? \"\" : \"none\";\r\n");
        fwrite($arq23, "      document.getElementById(\"id_message_display_buttond\").style.display = bButton ? \"\" : \"none\";\r\n");
        fwrite($arq23, "      document.getElementById(\"id_message_display_title_line\").style.display = (bClose || \"\" != sTitle) ? \"\" : \"none\";\r\n");
        fwrite($arq23, "      document.getElementById(\"id_message_display_close_icon\").style.display = bClose ? \"\" : \"none\";\r\n");
        fwrite($arq23, "      if (document.getElementById(\"id_message_display_body_icon\")) {\r\n");
        fwrite($arq23, "        document.getElementById(\"id_message_display_body_icon\").style.display = bBodyIcon ? \"\" : \"none\";\r\n");
        fwrite($arq23, "      }\r\n");
        fwrite($arq23, "      $(\"#id_message_display_content\").css('width', (0 < iWidth ? iWidth + 'px' : ''));\r\n");
        fwrite($arq23, "      $(\"#id_message_display_content\").css('height', (0 < iHeight ? iHeight + 'px' : ''));\r\n");
        fwrite($arq23, "      if (bModal) {\r\n");
        fwrite($arq23, "        iWidth = iWidth || 250;\r\n");
        fwrite($arq23, "        iHeight = iHeight || 200;\r\n");
        fwrite($arq23, "        scMsgDefClose = \"close_modal\";\r\n");
        fwrite($arq23, "        tb_show('', '#TB_inline?height=' + (iHeight + 6) + '&width=' + (iWidth + 4) + '&inlineId=id_message_display_frame&modal=true', '');\r\n");
        fwrite($arq23, "        if (bButton) {\r\n");
        fwrite($arq23, "          if (\"\" != sRedir && \"\" != sTarget) {\r\n");
        fwrite($arq23, "            scMsgDefClick = \"redir2_modal\";\r\n");
        fwrite($arq23, "            document.form_ajax_redir_2.action = sRedir;\r\n");
        fwrite($arq23, "            document.form_ajax_redir_2.target = sTarget;\r\n");
        fwrite($arq23, "            document.form_ajax_redir_2.nmgp_parms.value = sParam;\r\n");
        fwrite($arq23, "            document.form_ajax_redir_2.script_case_init.value = scMsgDefScInit;\r\n");
        fwrite($arq23, "          }\r\n");
        fwrite($arq23, "          else if (\"\" != sRedir && \"\" == sTarget) {\r\n");
        fwrite($arq23, "            scMsgDefClick = \"redir1\";\r\n");
        fwrite($arq23, "            document.form_ajax_redir_1.action = sRedir;\r\n");
        fwrite($arq23, "            document.form_ajax_redir_1.nmgp_parms.value = sParam;\r\n");
        fwrite($arq23, "          }\r\n");
        fwrite($arq23, "          else {\r\n");
        fwrite($arq23, "            scMsgDefClick = \"close_modal\";\r\n");
        fwrite($arq23, "          }\r\n");
        fwrite($arq23, "        }\r\n");
        fwrite($arq23, "        else if (null != iTimeout && 0 < iTimeout) {\r\n");
        fwrite($arq23, "          scMsgDefClick = \"close_modal\";\r\n");
        fwrite($arq23, "          setTimeout(\"_nmAjaxMessageBtnClick()\", iTimeout * 1000);\r\n");
        fwrite($arq23, "        }\r\n");
        fwrite($arq23, "      }\r\n");
        fwrite($arq23, "      else\r\n");
        fwrite($arq23, "      {\r\n");
        fwrite($arq23, "        scMsgDefClose = \"close\";\r\n");
        fwrite($arq23, "        $(\"#id_message_display_frame\").css('top', (0 < iTop ? iTop + 'px' : ''));\r\n");
        fwrite($arq23, "        $(\"#id_message_display_frame\").css('left', (0 < iLeft ? iLeft + 'px' : ''));\r\n");
        fwrite($arq23, "        document.getElementById(\"id_message_display_frame\").style.display = \"\";\r\n");
        fwrite($arq23, "        if (0 == iTop && 0 == iLeft) {\r\n");
        fwrite($arq23, "          nmCenterElement(document.getElementById(\"id_message_display_frame\"));\r\n");
        fwrite($arq23, "        }\r\n");
        fwrite($arq23, "        if (bButton) {\r\n");
        fwrite($arq23, "          if (\"\" != sRedir && \"\" != sTarget) {\r\n");
        fwrite($arq23, "            scMsgDefClick = \"redir2\";\r\n");
        fwrite($arq23, "            document.form_ajax_redir_2.action = sRedir;\r\n");
        fwrite($arq23, "            document.form_ajax_redir_2.target = sTarget;\r\n");
        fwrite($arq23, "            document.form_ajax_redir_2.nmgp_parms.value = sParam;\r\n");
        fwrite($arq23, "            document.form_ajax_redir_2.script_case_init.value = scMsgDefScInit;\r\n");
        fwrite($arq23, "          }\r\n");
        fwrite($arq23, "          else if (\"\" != sRedir && \"\" == sTarget) {\r\n");
        fwrite($arq23, "            scMsgDefClick = \"redir1\";\r\n");
        fwrite($arq23, "            document.form_ajax_redir_1.action = sRedir;\r\n");
        fwrite($arq23, "            document.form_ajax_redir_1.nmgp_parms.value = sParam;\r\n");
        fwrite($arq23, "          }\r\n");
        fwrite($arq23, "          else {\r\n");
        fwrite($arq23, "            scMsgDefClick = \"close\";\r\n");
        fwrite($arq23, "          }\r\n");
        fwrite($arq23, "        }\r\n");
        fwrite($arq23, "        else if (null != iTimeout && 0 < iTimeout) {\r\n");
        fwrite($arq23, "          scMsgDefClick = \"close\";\r\n");
        fwrite($arq23, "          setTimeout(\"_nmAjaxMessageBtnClick()\", iTimeout * 1000);\r\n");
        fwrite($arq23, "        }\r\n");
        fwrite($arq23, "      }\r\n");
        fwrite($arq23, "    }\r\n");
        fwrite($arq23, "  }\r\n");

        fwrite($arq23, "  function _nmAjaxMessageBtnClick() {\r\n");
        fwrite($arq23, "    switch (scMsgDefClick) {\r\n");
        fwrite($arq23, "      case \"close\":\r\n");
        fwrite($arq23, "        document.getElementById(\"id_message_display_frame\").style.display = \"none\";\r\n");
        fwrite($arq23, "        break;\r\n");
        fwrite($arq23, "      case \"close_modal\":\r\n");
        fwrite($arq23, "        tb_remove();\r\n");
        fwrite($arq23, "        break;\r\n");
        fwrite($arq23, "      case \"redir1\":\r\n");
        fwrite($arq23, "        document.form_ajax_redir_1.submit();\r\n");
        fwrite($arq23, "        break;\r\n");
        fwrite($arq23, "      case \"redir2\":\r\n");
        fwrite($arq23, "        document.form_ajax_redir_2.submit();\r\n");
        fwrite($arq23, "        document.getElementById(\"id_message_display_frame\").style.display = \"none\";\r\n");
        fwrite($arq23, "        break;\r\n");
        fwrite($arq23, "      case \"redir2_modal\":\r\n");
        fwrite($arq23, "        document.form_ajax_redir_2.submit();\r\n");
        fwrite($arq23, "        tb_remove();\r\n");
        fwrite($arq23, "        break;\r\n");
        fwrite($arq23, "    }\r\n");
        fwrite($arq23, "  }\r\n");

        fwrite($arq23, "  function _nmAjaxMessageBtnClose() {\r\n");
        fwrite($arq23, "    switch (scMsgDefClose) {\r\n");
        fwrite($arq23, "      case \"close\":\r\n");
        fwrite($arq23, "        document.getElementById(\"id_message_display_frame\").style.display = \"none\";\r\n");
        fwrite($arq23, "        break;\r\n");
        fwrite($arq23, "      case \"close_modal\":\r\n");
        fwrite($arq23, "        tb_remove();\r\n");
        fwrite($arq23, "        break;\r\n");
        fwrite($arq23, "    }\r\n");
        fwrite($arq23, "  }\r\n");
    }

    fwrite($arq23, "  function nmAjaxRedir(oTemp)\r\n");
    fwrite($arq23, "  {\r\n");
    fwrite($arq23, "    if (oTemp && oTemp != null) {\r\n");
    fwrite($arq23, "        oResp = oTemp;\r\n");
    fwrite($arq23, "    }\r\n");
    fwrite($arq23, "    if (!oResp[\"redirInfo\"]) {\r\n");
    fwrite($arq23, "      return;\r\n");
    fwrite($arq23, "    }\r\n");
    fwrite($arq23, "    sMetodo = oResp[\"redirInfo\"][\"metodo\"];\r\n");
    fwrite($arq23, "    sAction = oResp[\"redirInfo\"][\"action\"];\r\n");
    fwrite($arq23, "    if (\"location\" == sMetodo) {\r\n");
    fwrite($arq23, "      if (\"parent.parent\" == oResp[\"redirInfo\"][\"target\"]) {\r\n");
    fwrite($arq23, "        parent.parent.location = sAction;\r\n");
    fwrite($arq23, "      }\r\n");
    fwrite($arq23, "      else if (\"parent\" == oResp[\"redirInfo\"][\"target\"]) {\r\n");
    fwrite($arq23, "        parent.location = sAction;\r\n");
    fwrite($arq23, "      }\r\n");
    fwrite($arq23, "      else if (\"_blank\" == oResp[\"redirInfo\"][\"target\"]) {\r\n");
    fwrite($arq23, "        window.open(sAction, \"_blank\");\r\n");
    fwrite($arq23, "      }\r\n");
    fwrite($arq23, "      else {\r\n");
    fwrite($arq23, "        document.location = sAction;\r\n");
    fwrite($arq23, "      }\r\n");
    fwrite($arq23, "    }\r\n");
    fwrite($arq23, "    else if (\"html\" == sMetodo) {\r\n");
    fwrite($arq23, "        document.write(nmAjaxSpecCharParser(oResp[\"redirInfo\"][\"action\"]));\r\n");
    fwrite($arq23, "    }\r\n");
    fwrite($arq23, "    else {\r\n");
    fwrite($arq23, "      if (oResp[\"redirInfo\"][\"target\"] == \"modal\") {\r\n");
    fwrite($arq23, "          tb_show('', sAction + '?script_case_init=' +  oResp[\"redirInfo\"][\"script_case_init\"] + '&script_case_session=<?php echo session_id() ?>&nmgp_parms=' + oResp[\"redirInfo\"][\"nmgp_parms\"] + '&nmgp_outra_jan=true&nmgp_url_saida=modal&NMSC_modal=ok&TB_iframe=true&modal=true&height=' +  oResp[\"redirInfo\"][\"h_modal\"] + '&width=' + oResp[\"redirInfo\"][\"w_modal\"], '');\r\n");
    fwrite($arq23, "          return;\r\n");
    fwrite($arq23, "      }\r\n");
    fwrite($arq23, "      sFormRedir = (oResp[\"redirInfo\"][\"nmgp_outra_jan\"]) ? \"form_ajax_redir_1\" : \"form_ajax_redir_2\";\r\n");
    fwrite($arq23, "      document.forms[sFormRedir].action           = sAction;\r\n");
    fwrite($arq23, "      document.forms[sFormRedir].target           = oResp[\"redirInfo\"][\"target\"];\r\n");
    fwrite($arq23, "      document.forms[sFormRedir].nmgp_parms.value = oResp[\"redirInfo\"][\"nmgp_parms\"];\r\n");
    fwrite($arq23, "      if (\"form_ajax_redir_1\" == sFormRedir) {\r\n");
    fwrite($arq23, "        document.forms[sFormRedir].nmgp_outra_jan.value = oResp[\"redirInfo\"][\"nmgp_outra_jan\"];\r\n");
    fwrite($arq23, "      }\r\n");
    fwrite($arq23, "      else {\r\n");
    fwrite($arq23, "        document.forms[sFormRedir].nmgp_url_saida.value   = oResp[\"redirInfo\"][\"nmgp_url_saida\"];\r\n");
    fwrite($arq23, "        document.forms[sFormRedir].script_case_init.value = oResp[\"redirInfo\"][\"script_case_init\"];\r\n");
    fwrite($arq23, "      }\r\n");
    fwrite($arq23, "      document.forms[sFormRedir].submit();\r\n");
    fwrite($arq23, "    }\r\n");
    fwrite($arq23, "  }\r\n");


if ($apl_tem_ajax_navigate)
{
    fwrite($arq23, "function ajax_navigate(opc, parm)\r\n");
    fwrite($arq23, "{\r\n");
    fwrite($arq23, "    nmAjaxProcOn();\r\n");
    fwrite($arq23, "    \$.ajax({\r\n");
    fwrite($arq23, "      type: \"POST\",\r\n");
    fwrite($arq23, "      url: \"" . $arquivo3 . "\",\r\n");
    fwrite($arq23, "      data: \"nmgp_opcao=ajax_navigate&script_case_init=\" + document.F4.script_case_init.value + \"&script_case_session=\" + document.F4.script_case_session.value + \"&opc=\" + opc  + \"&parm=\" + parm,\r\n");
    fwrite($arq23, "      success: function(jsonNavigate) {\r\n");
    fwrite($arq23, "        var i, oResp;\r\n");
    fwrite($arq23, "        Tst_integrid = jsonNavigate.trim();\r\n");
    fwrite($arq23, "        if (\"{\" != Tst_integrid.substr(0, 1)) {\r\n");
    fwrite($arq23, "            nmAjaxProcOff();\r\n");
    fwrite($arq23, "            alert (jsonNavigate);\r\n");
    fwrite($arq23, "            return;\r\n");
    fwrite($arq23, "        }\r\n");
    fwrite($arq23, "        eval(\"oResp = \" + jsonNavigate);\r\n");

    if ($nmgp_tem_lig == 1 && $tbapl_grid_orientacao != 5)
    {
        fwrite($arq23, "        document.getElementById('nmsc_iframe_liga_A_" . $nome_aplicacao . "').src = 'NM_Blank_Page.htm';\r\n");
        fwrite($arq23, "        document.getElementById('nmsc_iframe_liga_E_" . $nome_aplicacao . "').src = 'NM_Blank_Page.htm';\r\n");
        fwrite($arq23, "        document.getElementById('nmsc_iframe_liga_D_" . $nome_aplicacao . "').src = 'NM_Blank_Page.htm';\r\n");
        fwrite($arq23, "        document.getElementById('nmsc_iframe_liga_B_" . $nome_aplicacao . "').src = 'NM_Blank_Page.htm';\r\n");

        fwrite($arq23, "        document.getElementById('nmsc_iframe_liga_A_" . $nome_aplicacao . "').style.height = '0px';\r\n");
        fwrite($arq23, "        document.getElementById('nmsc_iframe_liga_E_" . $nome_aplicacao . "').style.height = '0px';\r\n");
        fwrite($arq23, "        document.getElementById('nmsc_iframe_liga_D_" . $nome_aplicacao . "').style.height = '0px';\r\n");
        fwrite($arq23, "        document.getElementById('nmsc_iframe_liga_B_" . $nome_aplicacao . "').style.height = '0px';\r\n");

        fwrite($arq23, "        document.getElementById('nmsc_iframe_liga_A_" . $nome_aplicacao . "').style.width  = '0px';\r\n");
        fwrite($arq23, "        document.getElementById('nmsc_iframe_liga_E_" . $nome_aplicacao . "').style.width  = '0px';\r\n");
        fwrite($arq23, "        document.getElementById('nmsc_iframe_liga_D_" . $nome_aplicacao . "').style.width  = '0px';\r\n");
        fwrite($arq23, "        document.getElementById('nmsc_iframe_liga_B_" . $nome_aplicacao . "').style.width  = '0px';\r\n");
    }
    fwrite($arq23, "        if (oResp[\"redirInfo\"]) {\r\n");
    fwrite($arq23, "           nmAjaxRedir(oResp);\r\n");
    fwrite($arq23, "        }\r\n");
    if ($apl_tem_ajax_message)
    {
        fwrite($arq23, "        if (oResp[\"ajaxMessage\"]) {\r\n");
        fwrite($arq23, "           nmAjaxMessage(oResp);\r\n");
        fwrite($arq23, "        }\r\n");
    }
    fwrite($arq23, "        if (oResp[\"setValue\"]) {\r\n");
    fwrite($arq23, "          for (i = 0; i < oResp[\"setValue\"].length; i++) {\r\n");
    fwrite($arq23, "               \$(\"#\" + oResp[\"setValue\"][i][\"field\"]).html(oResp[\"setValue\"][i][\"value\"]);\r\n");
    fwrite($arq23, "          }\r\n");
    fwrite($arq23, "        }\r\n");

    fwrite($arq23, "        if (oResp[\"setArr\"]) {\r\n");
    fwrite($arq23, "          for (i = 0; i < oResp[\"setArr\"].length; i++) {\r\n");
    fwrite($arq23, "               eval (oResp[\"setArr\"][i][\"var\"] + ' = new Array()');\r\n");
    fwrite($arq23, "          }\r\n");
    fwrite($arq23, "        }\r\n");


    fwrite($arq23, "        if (oResp[\"setVar\"]) {\r\n");
    fwrite($arq23, "          for (i = 0; i < oResp[\"setVar\"].length; i++) {\r\n");
    fwrite($arq23, "               eval (oResp[\"setVar\"][i][\"var\"] + ' = \\\"' + oResp[\"setVar\"][i][\"value\"] + '\\\"');\r\n");
    fwrite($arq23, "          }\r\n");
    fwrite($arq23, "        }\r\n");

    fwrite($arq23, "        if (oResp[\"setDisplay\"]) {\r\n");
    fwrite($arq23, "          for (i = 0; i < oResp[\"setDisplay\"].length; i++) {\r\n");
    fwrite($arq23, "               document.getElementById(oResp[\"setDisplay\"][i][\"field\"]).style.display = oResp[\"setDisplay\"][i][\"value\"];\r\n");
    fwrite($arq23, "          }\r\n");
    fwrite($arq23, "        }\r\n");

    fwrite($arq23, "        if (oResp[\"setDisabled\"]) {\r\n");
    fwrite($arq23, "          for (i = 0; i < oResp[\"setDisabled\"].length; i++) {\r\n");
    fwrite($arq23, "               document.getElementById(oResp[\"setDisabled\"][i][\"field\"]).disabled = oResp[\"setDisabled\"][i][\"value\"];\r\n");
    fwrite($arq23, "          }\r\n");
    fwrite($arq23, "        }\r\n");

    fwrite($arq23, "        if (oResp[\"setClass\"]) {\r\n");
    fwrite($arq23, "          for (i = 0; i < oResp[\"setClass\"].length; i++) {\r\n");
    fwrite($arq23, "               document.getElementById(oResp[\"setClass\"][i][\"field\"]).className = oResp[\"setClass\"][i][\"value\"];\r\n");
    fwrite($arq23, "          }\r\n");
    fwrite($arq23, "        }\r\n");

    fwrite($arq23, "        if (oResp[\"setSrc\"]) {\r\n");
    fwrite($arq23, "          for (i = 0; i < oResp[\"setSrc\"].length; i++) {\r\n");
    fwrite($arq23, "               document.getElementById(oResp[\"setSrc\"][i][\"field\"]).src = oResp[\"setSrc\"][i][\"value\"];\r\n");
    fwrite($arq23, "          }\r\n");
    fwrite($arq23, "        }\r\n");

    fwrite($arq23, "        if (oResp[\"redirInfo\"]) {\r\n");
    fwrite($arq23, "           nmAjaxRedir(oResp);\r\n");
    fwrite($arq23, "        }\r\n");
    if ($apl_tem_jan_output)
    {
        fwrite($arq23, "        if (oResp[\"htmOutput\"]) {\r\n");
        fwrite($arq23, "           nmAjaxShowDebug(oResp);\r\n");
        fwrite($arq23, "        }\r\n");
    }
    if ($apl_tem_ajax_message)
    {
        fwrite($arq23, "        if (oResp[\"ajaxMessage\"]) {\r\n");
        fwrite($arq23, "           nmAjaxMessage(oResp);\r\n");
        fwrite($arq23, "        }\r\n");
    }

    fwrite($arq23, "        if (!SC_Link_View)\r\n");
    fwrite($arq23, "        {\r\n");

    if ($tem_quicksearch)
    {
        fwrite($arq23, "            if (Qsearch_ok)\r\n");
        fwrite($arq23, "            {\r\n");
        if (in_array('sys_format_qks', $tbapl_toolbars['top']))
        {
            fwrite($arq23, "                scQSInitVal = \$(\"#SC_fast_search_top\").val();\r\n");
        }
        elseif (in_array('sys_format_qks', $tbapl_toolbars['bottom']))
        {
            fwrite($arq23, "                scQSInitVal = \$(\"#SC_fast_search_bot\").val();\r\n");
        }
        fwrite($arq23, "                scQSInit = true;\r\n");
        fwrite($arq23, "                scQuickSearchInit(false, '');\r\n");
        if ('' != $parms_tbapl_attr1['quicksearch_watermark'])
        {
            foreach ($quicksearch_pos as $tmp_qs_pos)
            {
                fwrite($arq23, "                \$('#SC_fast_search_" . $tmp_qs_pos . "').listen();\r\n");
            }
        }
        foreach ($quicksearch_pos as $tmp_qs_pos)
        {
            fwrite($arq23, "                scQuickSearchKeyUp('" . $tmp_qs_pos . "', null);\r\n");
        }
        fwrite($arq23, "                scQSInit = false;\r\n");
        fwrite($arq23, "            }\r\n");
    }

    if ($liga_edit_iframe == "S")
    {
        fwrite($arq23, "            if (oResp[\"setEdit\"]) {\r\n");
        fwrite($arq23, "                nm_gp_submit4(oResp[\"setEdit\"][\"link\"]);\r\n");
        fwrite($arq23, "            }\r\n");

    }

    if ($tem_dynamic_search)
    {
        fwrite($arq23, "            if (parm == \"save_grid\") {\r\n");
        fwrite($arq23, "                Dyn_Ini = true;\r\n");
        fwrite($arq23, "            }\r\n");
    }

    fwrite($arq23, "            SC_init_jquery();\r\n");
    fwrite($arq23, "            tb_init('a.thickbox, area.thickbox, input.thickbox');\r\n");

    fwrite($arq23, "        }\r\n");
    fwrite($arq23, "        nmAjaxProcOff();\r\n");
    fwrite($arq23, "      }\r\n");
    fwrite($arq23, "    });\r\n");
    fwrite($arq23, "}\r\n");
}

if ($apl_tem_link_grid)
{
    fwrite($arq23, "function ajax_save_link(parm)\r\n");
    fwrite($arq23, "{\r\n");
    fwrite($arq23, "    nmAjaxProcOn();\r\n");
    fwrite($arq23, "    \$.ajax({\r\n");
    fwrite($arq23, "      type: \"POST\",\r\n");
    fwrite($arq23, "      url: \"" . $arquivo3 . "\",\r\n");
    fwrite($arq23, "      data: \"nmgp_opcao=ajax_link&script_case_init=\" + document.F4.script_case_init.value + \"&script_case_session=\" + document.F4.script_case_session.value + \"&parm=\" + parm,\r\n");
    fwrite($arq23, "      success: function(jsonSavelink) {\r\n");
    fwrite($arq23, "        var i, oResp;\r\n");
    fwrite($arq23, "        eval(\"oResp = \" + jsonSavelink);\r\n");
    fwrite($arq23, "        if (oResp[\"setHtml\"]) {\r\n");
    fwrite($arq23, "          for (i = 0; i < oResp[\"setHtml\"].length; i++) {\r\n");
    fwrite($arq23, "               \$(\"#\" + oResp[\"setHtml\"][i][\"field\"]).html(oResp[\"setHtml\"][i][\"value\"]);\r\n");
    fwrite($arq23, "          }\r\n");
    fwrite($arq23, "        }\r\n");
    fwrite($arq23, "        if (oResp[\"setDisplay\"]) {\r\n");
    fwrite($arq23, "          for (i = 0; i < oResp[\"setDisplay\"].length; i++) {\r\n");
    fwrite($arq23, "               document.getElementById(oResp[\"setDisplay\"][i][\"field\"]).style.display = oResp[\"setDisplay\"][i][\"value\"];\r\n");
    fwrite($arq23, "          }\r\n");
    fwrite($arq23, "        }\r\n");
    fwrite($arq23, "        nmAjaxProcOff();\r\n");
    fwrite($arq23, "      }\r\n");
    fwrite($arq23, "    });\r\n");
    fwrite($arq23, "}\r\n");
}

if ($tem_dynamic_search)
{
    fwrite($arq23, "function ajax_add_dyn_search(str_field, str_origem)\r\n");
    fwrite($arq23, "{\r\n");
    fwrite($arq23, "    var parm = str_field;\r\n");
    fwrite($arq23, "    if (parm == \"\")\r\n");
    fwrite($arq23, "    {\r\n");
    fwrite($arq23, "        return;\r\n");
    fwrite($arq23, "    }\r\n");
    fwrite($arq23, "    \$('#table_dyn_search_criteria').show();\r\n");
    fwrite($arq23, "    nmAjaxProcOn();\r\n");
    fwrite($arq23, "    Tot_obj_dyn_search++;\r\n");
    fwrite($arq23, "    Tab_obj_dyn_search[Tot_obj_dyn_search] = parm;\r\n");
    fwrite($arq23, "    \$.ajax({\r\n");
    fwrite($arq23, "      type: \"POST\",\r\n");
    fwrite($arq23, "      url: \"" . $arquivo3 . "\",\r\n");
    fwrite($arq23, "      data: \"nmgp_opcao=ajax_add_dyn_search&script_case_init=\" + document.Fdyn_search.script_case_init.value + \"&script_case_session=\" + document.Fdyn_search.script_case_session.value + \"&parm=\" + parm + \"&seq=\" + Tot_obj_dyn_search + \"&origem=\" + str_origem,\r\n");
    fwrite($arq23, "      success: function(jsonDyn_add) {\r\n");
    fwrite($arq23, "        var i, oResp;\r\n");
    fwrite($arq23, "        Tst_integrid = jsonDyn_add.trim();\r\n");
    fwrite($arq23, "        if (\"{\" != Tst_integrid.substr(0, 1)) {\r\n");
    fwrite($arq23, "            nmAjaxProcOff();\r\n");
    fwrite($arq23, "            alert (jsonDyn_add);\r\n");
    fwrite($arq23, "            return;\r\n");
    fwrite($arq23, "        }\r\n");
    fwrite($arq23, "        eval(\"oResp = \" + jsonDyn_add);\r\n");
    fwrite($arq23, "        if (oResp[\"dyn_add\"]) {\r\n");
    fwrite($arq23, "          for (i = 0; i < oResp[\"dyn_add\"].length; i++) {\r\n");
    fwrite($arq23, "               \$('#table_dyn_search').append(oResp[\"dyn_add\"][i]);\r\n");
    fwrite($arq23, "          }\r\n");
    fwrite($arq23, "        }\r\n");
    if ($apl_tem_jan_output)
    {
        fwrite($arq23, "        if (oResp[\"htmOutput\"]) {\r\n");
        fwrite($arq23, "           nmAjaxShowDebug(oResp);\r\n");
        fwrite($arq23, "        }\r\n");
    }
    fwrite($arq23, "        SC_carga_evt_jquery(Tot_obj_dyn_search);\r\n");
    fwrite($arq23, "        \$('#dyn_search_' + parm + '_' + Tot_obj_dyn_search + ' input:text.sc-js-input').listen();\r\n");
    if (isset($parms_tbapl_attr1['change_tab_enter']) && ($parms_tbapl_attr1['change_tab_enter'] == "S" || $parms_tbapl_attr1['change_tab_enter'] == "U"))
    {
        fwrite($arq23, "        \$('#dyn_search_' + parm + '_' + Tot_obj_dyn_search + ' select.sc-js-input').listen();\r\n");
    }

    fwrite($arq23, "        nmAjaxProcOff();\r\n");
    fwrite($arq23, "      }\r\n");
    fwrite($arq23, "    });\r\n");
    fwrite($arq23, "}\r\n");

    if ($dyn_tem_bi)
    {
        fwrite($arq23, "function ajax_ch_bi_dyn_search(field, ind, parm, str_origem)\r\n");
        fwrite($arq23, "{\r\n");
        fwrite($arq23, "    nmAjaxProcOn();\r\n");
        fwrite($arq23, "    \$.ajax({\r\n");
        fwrite($arq23, "      type: \"POST\",\r\n");
        fwrite($arq23, "      url: \"" . $arquivo3 . "\",\r\n");
        fwrite($arq23, "      data: \"nmgp_opcao=ajax_ch_bi_dyn_search&script_case_init=\" + document.Fdyn_search.script_case_init.value + \"&script_case_session=\" + document.Fdyn_search.script_case_session.value + \"&field=\" + field + \"&parm=\" + parm + \"&origem=\" + str_origem,\r\n");
        fwrite($arq23, "      success: function(jsonDyn_ch_bi) {\r\n");
        fwrite($arq23, "        var i, oResp;\r\n");
        fwrite($arq23, "        Tst_integrid = jsonDyn_ch_bi.trim();\r\n");
        fwrite($arq23, "        if (\"{\" != Tst_integrid.substr(0, 1)) {\r\n");
        fwrite($arq23, "            nmAjaxProcOff();\r\n");
        fwrite($arq23, "            alert (jsonDyn_ch_bi);\r\n");
        fwrite($arq23, "            return;\r\n");
        fwrite($arq23, "        }\r\n");
        fwrite($arq23, "        eval(\"oResp = \" + jsonDyn_ch_bi);\r\n");
        fwrite($arq23, "        if (oResp[\"dyn_ch_bi\"]) {\r\n");
        fwrite($arq23, "          for (i = 0; i < oResp[\"dyn_ch_bi\"].length; i++) {\r\n");
        fwrite($arq23, "               \$('#ID_bi_dados_' + field + '_' + ind).html(oResp[\"dyn_ch_bi\"][i]);\r\n");
        fwrite($arq23, "          }\r\n");
        fwrite($arq23, "        }\r\n");
        fwrite($arq23, "        \$('#ID_bi_dados_' + field + '_' + ind).css('display','');\r\n");
        fwrite($arq23, "        \$('#ID_nm_dados_' + field + '_' + ind).css('display','none');\r\n");
        fwrite($arq23, "        nmAjaxProcOff();\r\n");
        fwrite($arq23, "      }\r\n");
        fwrite($arq23, "    });\r\n");
        fwrite($arq23, "}\r\n");
    }

}

fclose($arq23);

?>