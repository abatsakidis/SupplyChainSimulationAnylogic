/**
 * Abertura de janelas auxiliares.
 *
 * Rotinas de controle das janelas auxiliares do ScriptCase.
 *
 * @package     Biblioteca
 * @subpackage  Javascript
 * @creation    2004/02/14
 * @copyright   NetMake Solucoes em Informatica
 * @author      Diogo Silva Toscano De Brito <diogo@netmake.com.br>
 *
 * $Id: window.js,v 1.5 2011-12-14 21:02:05 diogo Exp $
 */

function nm_popup_status(obj_chk, str_popup)
{
	str_status = obj_chk.checked ? 'on' : 'off';
	getDataAjax(nm_url_iface + "popup_status.php?pop=" + str_popup + "&stat=" + str_status, nm_popup_status_retorno);
}
function nm_popup_status_retorno(str_retorno)
{
}

function nm_window_bg(str_form, str_field, str_cback, str_css, str_cback_params)
{
 str_val = document.forms[str_form].elements[str_field].value;
 if (null == str_cback)
 {
  str_cback = '';
 }
 if (null == str_cback_params)
 {
  str_cback_params = '';
 }
 str_sep = (null == str_css) ? '' : '&css_sep=Y';
 obj_win = window.open(nm_url_compat + "nm_escolhe_fundo.php?form=" + str_form + "&field=" + str_field + "&image=" + str_val + "&cback=" + str_cback + "&cback_params=" + str_cback_params + str_sep, "nmWinBackgroundV7_" + nm_win_name, "toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,width=500,height=420");
 obj_win.focus();
}

function nm_window_button()
{
 obj_win = window.open(nm_url_compat + "nm_button_list.php", "nmWinButtonV7_" + nm_win_name, "toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,width=550,height=500");
 obj_win.focus();
}

function nm_window_color(str_form, str_field, str_cback, str_cback_params)
{
 str_val = document.forms[str_form].elements[str_field].value;
 if (null == str_cback)
 {
  str_cback = '';
 }
 if (null == str_cback_params)
 {
  str_cback_params = '';
 }
 if (7 == str_val.length)
 {
  if (str_val.substring(0, 1) == "#")
  {
   str_val = str_val.substring(1, str_val.length);
  }
 }
 else
 {
  str_val = "";
 }
 obj_win = window.open(nm_url_compat + "nm_cor.php?form=" + str_form + "&field=" + str_field + "&cor=" + str_val + "&cback=" + str_cback + "&cback_params=" + str_cback_params, "nmWinColorV7_" + nm_win_name, "toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no,width=310,height=420");
 obj_win.focus();
}

function nm_window_date_limit(str_form, str_field, str_cback)
{
 str_val = document.forms[str_form].elements[str_field].value;
 if (null == str_cback)
 {
  str_cback = '';
 }
 obj_win = window.open(nm_url_compat + "nm_atualiza_dataatual.php?form=" + str_form + "&field=" + str_field + "&value=" + str_val + "&cback=" + str_cback, "nmWinDateLimitV7_" + nm_win_name, "toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no,width=250,height=200");
 obj_win.focus();
}

function nm_window_font(str_form, str_field, str_cback)
{
 str_val = document.forms[str_form].elements[str_field].value;
 if (null == str_cback)
 {
  str_cback = '';
 }
 obj_win = window.open(nm_url_compat + "nm_atualiza_fontetexto.php?form=" + str_form + "&field=" + str_field + "&value=" + str_val + "&cback=" + str_cback, "nmWinFontV7_" + nm_win_name, "toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no,width=300,height=150");
 obj_win.focus();
}

function nm_window_help_date()
{
 obj_win = window.open(nm_url_iface + "help_date_format.php", "nmWinHelpDateV7_" + nm_win_name, "toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,width=400,height=420");
 obj_win.focus();
}

function nm_window_help_format()
{
 obj_win = window.open(nm_url_iface + "help_db_format.php", "nmWinHelpDateV7_" + nm_win_name, "toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,width=400,height=420");
 obj_win.focus();
}

function nm_window_hint(int_hint)
{
 str_hint = (null == int_hint) ? "" : "?hint_no=" + int_hint;
 obj_win = window.open(nm_url_iface + "popup_hint.php" + str_hint, "nmWinHintV7_" + nm_win_name, "width=320, height=240, directories=no, location=no, menubar=no, status=no, toolbar=no");
 obj_win.focus();
}

function nm_window_icon(str_form, str_field, str_cback)
{
 str_val = document.forms[str_form].elements[str_field].value;
 if (null == str_cback)
 {
  str_cback = '';
 }
 obj_win = window.open(nm_url_compat + "nm_escolhe_icone.php?form=" + str_form + "&field=" + str_field + "&image=" + str_val + "&cback=" + str_cback, "nmWinIconV7_" + nm_win_name, "toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=500,height=420");
 obj_win.focus();
}

function nm_window_aba(str_form, str_field, str_cback)
{
 str_val = document.forms[str_form].elements[str_field].value;
 if (null == str_cback)
 {
  str_cback = '';
 }
 obj_win = window.open(nm_url_compat + "nm_escolhe_aba.php?form=" + str_form + "&field=" + str_field + "&image=" + str_val + "&cback=" + str_cback, "nmWinIconV7_" + nm_win_name, "toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=500,height=420");
 obj_win.focus();
}

function nm_window_image(str_form, str_field, str_cback, int_index, not_exib, sc_subfolder)
{
 str_index = (null == int_index || '' == int_index)
           ? '' : '&index=' + int_index;
 if ('' == str_index)
 {
  str_val = document.forms[str_form].elements[str_field].value;
 }
 else
 {
  str_val = document.forms[str_form].elements[str_field + "[" + int_index + "]"].value;
 }
 if (null == str_cback)
 {
  str_cback = '';
 }
 if (null == sc_subfolder)
 {
  sc_subfolder = '';
 }

 str_not_exib = (not_exib != null) ? ('&notexib=' + not_exib) : '';

	nm_window_inside('choice_img', nm_url_compat + "nm_escolhe_imagem.php?form=" + str_form + "&field=" + str_field + "&image=" + str_val + "&cback=" + str_cback + str_index + str_not_exib + "&sc_subfolder=" + sc_subfolder, 546, 600);
 //obj_win = window.open(nm_url_compat + "nm_escolhe_imagem.php?form=" + str_form + "&field=" + str_field + "&image=" + str_val + "&cback=" + str_cback + str_index + str_not_exib + "&sc_subfolder=" + sc_subfolder, "nmWinImageV7_" + nm_win_name, "toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=500,height=420");
 //obj_win.focus();
}

function nm_window_image_new(str_folder, str_form, str_field, str_cback, int_index, not_exib, sc_subfolder, isChild)
{
    str_index = (null == int_index || '' == int_index) ? '' : '&index=' + int_index;
	if ('' == str_index)
	{
		str_val = document.forms[str_form].elements[str_field].value;
	}
	else
	{
		str_val = document.forms[str_form].elements[str_field + "[" + int_index + "]"].value;
	}
	if (null == str_cback)
	{
		str_cback = '';
	}
	if (null == sc_subfolder)
	{
		sc_subfolder = '';
	}

 str_not_exib = (not_exib != null) ? ('&notexib=' + not_exib) : '';

    if (isChild === undefined) { isChild = true; }	
    blockUiAppForImage(str_folder, str_form, str_field, str_val, str_cback, str_index, str_not_exib, sc_subfolder, isChild);
}

function nm_window_image_toolbar(id_field, str_cback)
{
    str_index = str_not_exib = sc_subfolder = isChild = "";
    str_val = $('#id_toolbar_group_icon').val();
    blockUiAppForImage("ico", "toolbar", id_field, str_val, str_cback, str_index, str_not_exib, sc_subfolder, isChild);
}

function nm_window_image_button(nivel_button, button_schema, button_name, rtl) 
{
    if(rtl === undefined) { rtl = false; }
    blockUiAppForButtonImage(nivel_button, button_schema, button_name, rtl);    
}

function nm_window_import(str_field)
{
 window.open(nm_url_iface + 'app_import.php?option=radio&field=' + str_field, 'app_import', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,width=650,height=500');
}

function nm_window_manual(str_url)
{
 if(str_url != '#')
 {
   obj_win = window.open(str_url, "nmWinWebhelpV7_" + nm_win_name);
   obj_win.focus();
 }
}

function nm_window_sql_script(str_script)
{
 obj_win = window.open(nm_url_iface + "popup_sql_script.php?sql_script=" + str_script, "nmWinSqlScriptV7_" + nm_win_name, "width=250, height=200, directories=no, location=no, menubar=no, status=no, toolbar=no");
 obj_win.focus();
}

function nm_window_upload(str_mod, not_exib, str_refresh)
{
	str_not_exib = (not_exib != null) ? ('&notexib=' + not_exib) : '';
	str_refresh = (str_refresh != null) ? ('&str_refresh=ok') : '';
	nm_window_inside('upload', nm_url_iface + "upload.php?mod=" + str_mod + str_not_exib + str_refresh);


 //obj_win = window.open(nm_url_iface + "upload.php?mod=" + str_mod + str_not_exib, "nmWinUploadV7_" + nm_win_name, "toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=320,height=240");
 //obj_win.focus();
}

function nm_window_inside(str_mod, url, height, width)
{
	height = (height == null)? 326 : height;
	width = (width == null)? 400 : width;
	if($('#id_window' +str_mod).is(':visible'))
	{
		return;
	}

	$('body').append("<div id='id_window"+str_mod+"' style='left:40%;top:3px;position:absolute;width:" +width+"px;height:"+ height +"px;border:2px solid #D0D0D0;background-color:#FFF;'>"
						+"<div class='nmTitle'>"
							+"<span style='text-align:left;position:relative;top:5px;'></span>"
							+"<img style='float:right;' src='../../devel/conf/scriptcase/img/btnnew/crystal/toolbar_logout.png'/>"
						+"</div>"
						+"<iframe style='width:100%;height:"+ (height-26) +"px; border:0px solid #FFF;'name='nmWinUploadV7_" + nm_win_name+ "' src='"+ url +"'></iframe>"
					+"</div>");

	$('#id_window'+str_mod+' > div > img').css('cursor', 'pointer').click(function(){ $('#id_window'+str_mod).remove(); });

	$('#id_window'+str_mod+' > iframe').load(function(){
		$('#id_window'+str_mod+' > div > span').text( $('#id_window'+str_mod+' > iframe').contents().find('title').text().split('::')[1] );
	});

	try
	{
		$('#id_window'+str_mod).draggable();
	}
	catch(err)
	{
	}
}
function nm_window_warning(str_warn)
{
	nm_window_inside('warn', nm_url_iface + "popup_warning.php?warn=" + str_warn)
 //obj_win = window.open(nm_url_iface + "popup_warning.php?warn=" + str_warn, "nmWinWarningV7_" + nm_win_name, "width=320, height=240, directories=no, location=no, menubar=no, status=no, toolbar=no");
 //obj_win.focus();
}
function nm_window_error()
{
	obj_win = window.open(nm_url_iface + 'errorhandler.php','ERROR', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no,width=497,height=230')
	obj_win.focus();
}