<?php
function nmButtonOutput($arr_buttons, $sBtn, $sClick, $sHref, $sId, $sName, $sValue, $sStyle, $sAlign, $sKey, $sBorder, $spath, $sAlt, $sHint, $sClassJ, $AltJ, $sGrupo = '', $str_display = 'only_text', $str_display_position = 'text_right', $bol_link = false, $str_target = '')
{
    $sCodigo  = '';

    if ('' != $sGrupo && '__sc_grp__' !=$sGrupo)
    {
        $arr_buttons[$sBtn]['type'] = 'link';
    }

    // Parametros
	$sTarget    = '';
	if($bol_link)
	{
		$sClick        = '';
		$sHref         = ' href="' . $sHref   . '"';
		if(!empty($str_target))
		{
			$sTarget    = ' target="'. $str_target .'"';
		}
	}
	else
	{
		$sClick        = ('' != $sClick)  ? ' onClick="'          . $sClick  . '; return false;"' : '';
		$sHref         = ('' != $sHref)   ? ' href="javascript: ' . $sHref   . '"'               : '';
	}
	if(isset($arr_buttons[$sBtn]['disabled']) && strtolower($arr_buttons[$sBtn]['disabled']) == 'off')
	{
		$arr_buttons[$sBtn]['style'] = "disabled";
		$sHref = "";
	}

	$sIdImg        = ('' != $sId)     ? ' id="id_img_'        . $sId     . '"'               : '';
    $sId           = ('' != $sId)     ? ' id="'               . $sId     . '"'               : '';
    $sName         = ('' != $sName)   ? ' name="'             . $sName   . '"'               : '';
    $sStyle        = ('' != $sStyle)  ? ' style="'            . $sStyle  . '"'               : '';
    $sAlign        = ('' != $sAlign)  ? ' align="'            . $sAlign  . '"'               : '';
    $sKey          = ('' != $sKey)    ? ' accesskey="'        . $sKey    . '"'               : '';
    $sBorder       = ('' != $sBorder) ? ' border="'           . $sBorder . '"'               : '';
    $spath         = ('' != $spath)   ? $spath                                               : "\$this->Ini->path_botoes";
    $sAlt          = '';
    $sClassB       = ('' != $arr_buttons[$sBtn]['style']) ? ' class="scButton_' . $arr_buttons[$sBtn]['style'] . '"' : '';
    $sClassOver    = ('' != $arr_buttons[$sBtn]['style']) ? ' class="scButton_onmouseover"' : '';
    $sClassDown    = ('' != $arr_buttons[$sBtn]['style']) ? ' class="scButton_onmousedown"' : '';
    $sClassL       = ('' != $arr_buttons[$sBtn]['style']) ? ' class="scLink_'   . $arr_buttons[$sBtn]['style'] . '"' : '';
    $sClassI       = '';
	$sonMouseOver  = " onMouseOver=\"if(this.disabled){ return false; }else{ main_style = this.className; this.className = 'scButton_onmouseover'; }\"";
    $sonMouseOut   = " onMouseOut=\"if(this.disabled){ return false;  }else{ this.className = main_style; }\"";
    $sonMouseDown  = " onMouseDown=\"if(this.disabled){ return false; }else{ this.className = 'scButton_onmousedown'; }\"";
    $sonMouseUp    = " onMouseUp=\"if(this.disabled){ return false;   }else{ this.className = 'scButton_onmouseover'; }\"";

    if ('' != $sGrupo)
    {
        $sClassL = ' class="scBtnGrpLink"';
    }
    if (empty($sValue))
    {
        $sValue  = ('' != $arr_buttons[$sBtn]['value']) ? $arr_buttons[$sBtn]['value'] : '';
    }

    if (!empty($sHint))
    {
        $sHint   = ' title="' . $sHint  . '"';
    }
    else
    {
        $sHint   = (isset($arr_buttons[$sBtn]['hint'])  && '' != $arr_buttons[$sBtn]['hint'])  ? ' title="'          . $arr_buttons[$sBtn]['hint']  . '"' : '';
    }

    if (isset($_SESSION['scriptcase']['charset']))
    {
        if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($sValue))
        {
            $sValue = mb_convert_encoding($sValue, $_SESSION['scriptcase']['charset'], "UTF-8");
        }
        if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($sHint))
        {
            $sHint = mb_convert_encoding($sHint, $_SESSION['scriptcase']['charset'], "UTF-8");
        }
        if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($sAlt))
        {
            $sAlt = mb_convert_encoding($sAlt, $_SESSION['scriptcase']['charset'], "UTF-8");
        }
        if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($AltJ))
        {
            $AltJ = mb_convert_encoding($AltJ, $_SESSION['scriptcase']['charset'], "UTF-8");
        }
    }

    if ('' != $AltJ)
    {
        //se onclick tiver vazio e hint preenchido e for botao, eh pq eh thickbox
         if ($sClassJ == "colorbox")
         {
             $sClick = " onClick=\"javascript:SC_colorbox('". $AltJ ."')\" ";
         }
         elseif(empty($sClick) && 'button' == $arr_buttons[$sBtn]['type'])
         {
             $sClick = ' onClick="tb_show(\'\', \''. $AltJ .'\')" ';
         }
         else
         {
              $sAlt  = ' alt="'  . $AltJ . '"';
              $sHref = ' href="' . $AltJ . '"';
         }
    }
    if ('' != $sClassJ)
    {
        $sClassB = str_replace('class="', 'class="' . $sClassJ . ' ', $sClassB);
        $sClassL = str_replace('class="', 'class="' . $sClassJ . ' ', $sClassL);
        $sClassI = ' class="' . $sClassJ . '"';
    }

    // Vertical align
    if ('' == $sStyle)
    {
        $sStyle = ' style="vertical-align: middle; display:inline-block;"';
    }
    else
    {
        $sStyle = str_replace('style="', 'style="vertical-align: middle; display:inline-block;', $sStyle);
    }

	//novos botoes
	if(!isset($arr_buttons[$sBtn]['display']))
	{
		$arr_buttons[$sBtn]['display'] = $str_display;
	}
	if(!isset($arr_buttons[$sBtn]['display_position']))
	{
		$arr_buttons[$sBtn]['display_position'] = $str_display_position;
	}

    // Codigo do botao
	if ('button' == $arr_buttons[$sBtn]['type'])
    {
		$sCodigo .= "<a ". $sHref . $sTarget . $sAlt . $sId . $sClick . $sKey . $sClassB . $sHint . $sStyle .  $sonMouseOver .  $sonMouseOut .  $sonMouseDown .  $sonMouseUp . ">";
		switch($arr_buttons[$sBtn]['display'])
		{
			case 'only_text':
					$sCodigo .= $sValue;
			break;
			case 'only_img':
					$sCodigo .= "<img src=\"" . $spath . "/" . $arr_buttons[$sBtn]['image'] . "\" ". $sIdImg ." align='absmiddle' border='0'>\r\n";
			break;
			case 'text_img':
				if($arr_buttons[$sBtn]['display_position'] == 'img_right')
				{
					$sCodigo .= $sValue;
					$sCodigo .= "&nbsp;&nbsp;<img src=\"" . $spath . "/" . $arr_buttons[$sBtn]['image'] . "\" ". $sIdImg ." align='absmiddle' border='0'>\r\n";
				}
				else
				{
					$sCodigo .= "<img src=\"" . $spath . "/" . $arr_buttons[$sBtn]['image'] . "\" ". $sIdImg ." align='absmiddle' border='0'>\r\n";
					$sCodigo .= "&nbsp;&nbsp;" . $sValue;
				}
			break;
		}

		if('__sc_grp__' ==$sGrupo)
		{
				$sCodigo .= "&nbsp;&nbsp;<img src=\"" . $spath . "/scriptcase__NM__ico__NM__group_expand.png\" align='absmiddle' border='0'>\r\n";
		}

        $sCodigo .= "</a>\r\n";
    }
    elseif ('image' == $arr_buttons[$sBtn]['type'])
    {
        if (isset($arr_buttons[$sBtn]['image']) && !empty($arr_buttons[$sBtn]['image']))
        {
            $sSrc = $arr_buttons[$sBtn]['image'];
        }
        else
        {
            $sSrc = "nm_" . $tbapl_template_botao . "_" . $sBtn . ".gif";
        }
        if (empty($sClick))
        {
            $sClick = $sHref;
        }
        $sCodigo .= "<a " . $sId . $sKey . $sTarget . $sBorder. $sHint . $sStyle . $sAlign . $sClassI . $sClick . "><img " . $sIdImg . " src=\"" . $spath . "/" . $sSrc . "\" style=\"border-width: 0; cursor: pointer\" /></a>\r\n";
    }
    else
    {
        $sCodigo .= "<a" . $sId . $sHref . $sTarget . $sClassL . $sHint . $sStyle . ">" . $arr_buttons[$sBtn]['value'] . "</a>\r\n";
    }
    return $sCodigo;
}
?>