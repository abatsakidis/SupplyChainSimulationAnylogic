<?php
/**
 * Menu das macros com Wizard para editor PHP.
 *
 * Menu gerado externamente pelo mesmo gerador do help das macros.
 *
 * @package     Biblioteca
 * @subpackage  PHP
 * @creation    2006/06/16
 * @copyright   NetMake Solucoes em Informatica
 * @author      Marcos Souza Filho <marcos@netmake.com.br>
 *
 */
 
/* ARQUIVO GERADO AUTOMATICAMENTE */

/* Protecao contra hacks */
if (!defined("NM_SCASE_STATUS") || ("LOADED" != NM_SCASE_STATUS))
{
    die('<br /><span style="font-weight: bold">Fatal error</span>: ' .
        'Invalid access to system file.');
}

function conv_app_name($app) {
	$conv = array(	"cons"		=> "consulta",
					"contr"		=> "form_controle",
					"form"		=> "form",
					"menu"		=> "menu",
					"menutree"	=> "menutree",
					"filter"	=> "filtro"					
					);
	foreach ($conv as $from_sc => $from_banco) {
		if ($app == $from_sc) $app = $from_banco;
	}
	return $app;
}


function nm_menu_wiz_eventos($app, $tipo, $evento) {
    global $nm_lang, $nm_config;
	//if ($tipo != "E" && $tipo != "M") return "";


    $arr_wizards = nm_mcwizards_array($app, $evento);
    
    if (is_array($arr_wizards)) {

	    $menu_str = "<select onChange='parent.nm_macro_ajuda(parent.nm_url_rand(\""
								.$nm_config['url_iface']."wizard_macros.php?macro="
								."\" + this.value)); this.selectedIndex=0;'>\r\n";
	    $menu_str .= " <option value=''>-- Wizard Macros --</option>\r\n";
	    
	
	    foreach ($arr_wizards as $grupo => $arr_macros) {
	      
	        $menu_str .= " <optgroup label='".$grupo."'></optgroup>\r\n";

	        foreach ($arr_macros as $macro)
	        {
	            $menu_str .= "<option value='".$macro."'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$macro."</option>\r\n";
	        }
	    }

	    $menu_str .= " </select>\r\n";

	    return $menu_str;
	} else {
		return "";
	}
}



function nm_mcwizards_array($app, $evento) {
    $arr_wizard	= "";


	switch (conv_app_name($app)."_".$evento) {

		case "todas_allMacros":
			$arr_wizard	= array(	
								"SQL"	=> array('sc_exec_sql', 'sc_lookup', 'sc_select'),
								"Data"	=> array('sc_date', 'sc_date_conv', 'sc_date_dif', 'sc_date_dif_2'),
								"Controle"	=> array('sc_alert', 'sc_changed', 'sc_confirm', 'sc_error_message', 'sc_link', 'sc_mail_send', 'sc_make_link'),
								"Codigo Barra"	=> array('sc_lin_cod_barra_banco'),
								"Seguran&ccedil;a"	=> array('sc_apl_status'),
								"Bot&otilde;es"	=> array('sc_btn_display'),
								"Menu"	=> array('sc_menu_delete', 'sc_menu_disable'),
								);
		break;

		case "blank_onExecute":
			$arr_wizard	= array(	
								"SQL"	=> array('sc_exec_sql', 'sc_lookup', 'sc_select'),
								"Data"	=> array('sc_date_dif', 'sc_date_dif_2'),
								"Controle"	=> array('sc_error_message', 'sc_mail_send', 'sc_make_link'),
								"Seguran&ccedil;a"	=> array('sc_apl_status'),
								);
		break;

		case "consulta_onButtonClick":
			$arr_wizard	= array(	
								"SQL"	=> array('sc_exec_sql', 'sc_lookup', 'sc_select'),
								"Data"	=> array('sc_date', 'sc_date_conv', 'sc_date_dif', 'sc_date_dif_2'),
								"Controle"	=> array('sc_confirm', 'sc_mail_send'),
								"Seguran&ccedil;a"	=> array('sc_apl_status'),
								);
		break;

		case "consulta_onFooter":
			$arr_wizard	= array(	
								"SQL"	=> array('sc_lookup', 'sc_select'),
								"Data"	=> array('sc_date', 'sc_date_conv', 'sc_date_dif', 'sc_date_dif_2'),
								"Codigo Barra"	=> array('sc_lin_cod_barra_banco'),
								);
		break;

		case "consulta_onGroupBy":
			$arr_wizard	= array(	
								"SQL"	=> array('sc_lookup', 'sc_select'),
								"Data"	=> array('sc_date', 'sc_date_conv', 'sc_date_dif', 'sc_date_dif_2'),
								);
		break;

		case "consulta_onHeader":
			$arr_wizard	= array(	
								"SQL"	=> array('sc_lookup', 'sc_select'),
								"Data"	=> array('sc_date', 'sc_date_conv', 'sc_date_dif', 'sc_date_dif_2'),
								);
		break;

		case "consulta_onScriptInit":
			$arr_wizard	= array(	
								"SQL"	=> array('sc_exec_sql', 'sc_lookup', 'sc_select'),
								"Data"	=> array('sc_date', 'sc_date_conv', 'sc_date_dif', 'sc_date_dif_2'),
								"Controle"	=> array('sc_mail_send'),
								"Seguran&ccedil;a"	=> array('sc_apl_status'),
								"Bot&otilde;es"	=> array('sc_btn_display'),
								);
		break;

		case "consulta_onRecord":
			$arr_wizard	= array(	
								"SQL"	=> array('sc_lookup', 'sc_select'),
								"Data"	=> array('sc_date', 'sc_date_conv', 'sc_date_dif', 'sc_date_dif_2'),
								"Controle"	=> array('sc_link', 'sc_mail_send', 'sc_make_link'),
								"Codigo Barra"	=> array('sc_lin_cod_barra_banco'),
								);
		break;

		case "filtro_onScriptInit":
			$arr_wizard	= array(	
								"SQL"	=> array('sc_lookup', 'sc_select'),
								"Data"	=> array('sc_date', 'sc_date_conv', 'sc_date_dif', 'sc_date_dif_2'),
								"Controle"	=> array('sc_error_message', 'sc_mail_send'),
								"Seguran&ccedil;a"	=> array('sc_apl_status'),
								);
		break;

		case "filtro_onRefresh":
			$arr_wizard	= array(	
								"SQL"	=> array('sc_lookup', 'sc_select'),
								"Data"	=> array('sc_date', 'sc_date_conv', 'sc_date_dif', 'sc_date_dif_2'),
								"Controle"	=> array('sc_error_message'),
								);
		break;

		case "filtro_onSave":
			$arr_wizard	= array(	
								"SQL"	=> array('sc_lookup', 'sc_select'),
								"Data"	=> array('sc_date', 'sc_date_conv', 'sc_date_dif', 'sc_date_dif_2'),
								"Controle"	=> array('sc_mail_send'),
								);
		break;

		case "filtro_onValidate":
			$arr_wizard	= array(	
								"SQL"	=> array('sc_lookup', 'sc_select'),
								"Data"	=> array('sc_date', 'sc_date_conv', 'sc_date_dif', 'sc_date_dif_2'),
								"Controle"	=> array('sc_error_message', 'sc_mail_send'),
								);
		break;

		case "form_ajaxFieldonBlur":
			$arr_wizard	= array(	
								"SQL"	=> array('sc_lookup', 'sc_select'),
								"Data"	=> array('sc_date', 'sc_date_conv', 'sc_date_dif', 'sc_date_dif_2'),
								"Controle"	=> array('sc_error_message'),
								);
		break;

		case "form_ajaxFieldonChange":
			$arr_wizard	= array(	
								"SQL"	=> array('sc_lookup', 'sc_select'),
								"Data"	=> array('sc_date', 'sc_date_conv', 'sc_date_dif', 'sc_date_dif_2'),
								"Controle"	=> array('sc_error_message'),
								);
		break;

		case "form_ajaxFieldonClick":
			$arr_wizard	= array(	
								"SQL"	=> array('sc_lookup', 'sc_select'),
								"Data"	=> array('sc_date', 'sc_date_conv', 'sc_date_dif', 'sc_date_dif_2'),
								"Controle"	=> array('sc_error_message'),
								);
		break;

		case "form_ajaxFieldonFocus":
			$arr_wizard	= array(	
								"SQL"	=> array('sc_lookup', 'sc_select'),
								"Data"	=> array('sc_date', 'sc_date_conv', 'sc_date_dif', 'sc_date_dif_2'),
								"Controle"	=> array('sc_error_message'),
								);
		break;

		case "form_onAfterDelete":
			$arr_wizard	= array(	
								"SQL"	=> array('sc_exec_sql', 'sc_lookup', 'sc_select'),
								"Data"	=> array('sc_date', 'sc_date_conv', 'sc_date_dif', 'sc_date_dif_2'),
								"Controle"	=> array('sc_error_message', 'sc_mail_send'),
								"Seguran&ccedil;a"	=> array('sc_apl_status'),
								"Bot&otilde;es"	=> array('sc_btn_display'),
								);
		break;

		case "form_onAfterDeleteAll":
			$arr_wizard	= array(	
								"SQL"	=> array('sc_exec_sql', 'sc_lookup', 'sc_select'),
								"Data"	=> array('sc_date', 'sc_date_conv', 'sc_date_dif', 'sc_date_dif_2'),
								"Controle"	=> array('sc_changed', 'sc_error_message', 'sc_mail_send'),
								"Seguran&ccedil;a"	=> array('sc_apl_status'),
								"Bot&otilde;es"	=> array('sc_btn_display'),
								);
		break;

		case "form_onAfterInsert":
			$arr_wizard	= array(	
								"SQL"	=> array('sc_exec_sql', 'sc_lookup', 'sc_select'),
								"Data"	=> array('sc_date', 'sc_date_conv', 'sc_date_dif', 'sc_date_dif_2'),
								"Controle"	=> array('sc_changed', 'sc_error_message', 'sc_mail_send'),
								"Seguran&ccedil;a"	=> array('sc_apl_status'),
								"Bot&otilde;es"	=> array('sc_btn_display'),
								);
		break;

		case "form_onAfterInsertAll":
			$arr_wizard	= array(	
								"SQL"	=> array('sc_exec_sql', 'sc_lookup', 'sc_select'),
								"Data"	=> array('sc_date', 'sc_date_conv', 'sc_date_dif', 'sc_date_dif_2'),
								"Controle"	=> array('sc_error_message', 'sc_mail_send'),
								"Seguran&ccedil;a"	=> array('sc_apl_status'),
								"Bot&otilde;es"	=> array('sc_btn_display'),
								);
		break;

		case "form_onAfterUpdate":
			$arr_wizard	= array(	
								"SQL"	=> array('sc_exec_sql', 'sc_lookup', 'sc_select'),
								"Data"	=> array('sc_date', 'sc_date_conv', 'sc_date_dif', 'sc_date_dif_2'),
								"Controle"	=> array('sc_changed', 'sc_error_message', 'sc_mail_send'),
								"Seguran&ccedil;a"	=> array('sc_apl_status'),
								"Bot&otilde;es"	=> array('sc_btn_display'),
								);
		break;

		case "form_onAfterUpdateAll":
			$arr_wizard	= array(	
								"SQL"	=> array('sc_exec_sql', 'sc_lookup', 'sc_select'),
								"Data"	=> array('sc_date', 'sc_date_conv', 'sc_date_dif', 'sc_date_dif_2'),
								"Controle"	=> array('sc_error_message', 'sc_mail_send'),
								"Seguran&ccedil;a"	=> array('sc_apl_status'),
								"Bot&otilde;es"	=> array('sc_btn_display'),
								);
		break;

		case "form_onBeforeDelete":
			$arr_wizard	= array(	
								"SQL"	=> array('sc_exec_sql', 'sc_lookup', 'sc_select'),
								"Data"	=> array('sc_date', 'sc_date_conv', 'sc_date_dif', 'sc_date_dif_2'),
								"Controle"	=> array('sc_changed', 'sc_error_message', 'sc_mail_send'),
								"Seguran&ccedil;a"	=> array('sc_apl_status'),
								"Bot&otilde;es"	=> array('sc_btn_display'),
								);
		break;

		case "form_onBeforeDelete_All":
			$arr_wizard	= array(	
								"SQL"	=> array('sc_exec_sql', 'sc_lookup', 'sc_select'),
								"Data"	=> array('sc_date', 'sc_date_conv', 'sc_date_dif', 'sc_date_dif_2'),
								"Controle"	=> array('sc_error_message', 'sc_mail_send'),
								"Seguran&ccedil;a"	=> array('sc_apl_status'),
								"Bot&otilde;es"	=> array('sc_btn_display'),
								);
		break;

		case "form_onBeforeInsert":
			$arr_wizard	= array(	
								"SQL"	=> array('sc_exec_sql', 'sc_lookup', 'sc_select'),
								"Data"	=> array('sc_date', 'sc_date_conv', 'sc_date_dif', 'sc_date_dif_2'),
								"Controle"	=> array('sc_changed', 'sc_error_message', 'sc_mail_send'),
								"Seguran&ccedil;a"	=> array('sc_apl_status'),
								"Bot&otilde;es"	=> array('sc_btn_display'),
								);
		break;

		case "form_onBeforeInsertAll":
			$arr_wizard	= array(	
								"SQL"	=> array('sc_exec_sql', 'sc_lookup', 'sc_select'),
								"Data"	=> array('sc_date', 'sc_date_conv', 'sc_date_dif', 'sc_date_dif_2'),
								"Controle"	=> array('sc_error_message', 'sc_mail_send'),
								"Seguran&ccedil;a"	=> array('sc_apl_status'),
								"Bot&otilde;es"	=> array('sc_btn_display'),
								);
		break;

		case "form_onBeforeUpdate":
			$arr_wizard	= array(	
								"SQL"	=> array('sc_exec_sql', 'sc_lookup', 'sc_select'),
								"Data"	=> array('sc_date', 'sc_date_conv', 'sc_date_dif', 'sc_date_dif_2'),
								"Controle"	=> array('sc_error_message', 'sc_mail_send'),
								"Seguran&ccedil;a"	=> array('sc_apl_status'),
								"Bot&otilde;es"	=> array('sc_btn_display'),
								);
		break;

		case "form_onBeforeUpdateall":
			$arr_wizard	= array(	
								"SQL"	=> array('sc_exec_sql', 'sc_lookup', 'sc_select'),
								"Data"	=> array('sc_date', 'sc_date_conv', 'sc_date_dif', 'sc_date_dif_2'),
								"Controle"	=> array('sc_error_message', 'sc_mail_send'),
								"Seguran&ccedil;a"	=> array('sc_apl_status'),
								"Bot&otilde;es"	=> array('sc_btn_display'),
								);
		break;

		case "form_onButtonClick":
			$arr_wizard	= array(	
								"SQL"	=> array('sc_exec_sql', 'sc_lookup', 'sc_select'),
								"Data"	=> array('sc_date', 'sc_date_conv', 'sc_date_dif', 'sc_date_dif_2'),
								"Controle"	=> array('sc_confirm', 'sc_mail_send'),
								"Seguran&ccedil;a"	=> array('sc_apl_status'),
								);
		break;

		case "form_onScriptInit":
			$arr_wizard	= array(	
								"SQL"	=> array('sc_exec_sql', 'sc_lookup', 'sc_select'),
								"Data"	=> array('sc_date', 'sc_date_conv', 'sc_date_dif', 'sc_date_dif_2'),
								"Controle"	=> array('sc_alert', 'sc_error_message', 'sc_mail_send'),
								"Seguran&ccedil;a"	=> array('sc_apl_status'),
								"Bot&otilde;es"	=> array('sc_btn_display'),
								);
		break;

		case "form_onLoadAll":
			$arr_wizard	= array(	
								"SQL"	=> array('sc_exec_sql', 'sc_lookup', 'sc_select'),
								"Data"	=> array('sc_date', 'sc_date_conv', 'sc_date_dif', 'sc_date_dif_2'),
								"Controle"	=> array('sc_alert', 'sc_error_message', 'sc_mail_send'),
								"Seguran&ccedil;a"	=> array('sc_apl_status'),
								"Bot&otilde;es"	=> array('sc_btn_display'),
								);
		break;

		case "form_onRecord":
			$arr_wizard	= array(	
								"SQL"	=> array('sc_exec_sql', 'sc_lookup', 'sc_select'),
								"Data"	=> array('sc_date', 'sc_date_conv', 'sc_date_dif', 'sc_date_dif_2'),
								"Controle"	=> array('sc_alert', 'sc_error_message', 'sc_mail_send'),
								"Seguran&ccedil;a"	=> array('sc_apl_status'),
								"Bot&otilde;es"	=> array('sc_btn_display'),
								);
		break;

		case "form_onRefresh":
			$arr_wizard	= array(	
								"SQL"	=> array('sc_exec_sql', 'sc_lookup', 'sc_select'),
								"Data"	=> array('sc_date', 'sc_date_conv', 'sc_date_dif', 'sc_date_dif_2'),
								"Controle"	=> array('sc_alert', 'sc_changed', 'sc_error_message'),
								"Seguran&ccedil;a"	=> array('sc_apl_status'),
								"Bot&otilde;es"	=> array('sc_btn_display'),
								);
		break;

		case "form_onValidate":
			$arr_wizard	= array(	
								"SQL"	=> array('sc_exec_sql', 'sc_lookup', 'sc_select'),
								"Data"	=> array('sc_date', 'sc_date_conv', 'sc_date_dif', 'sc_date_dif_2'),
								"Controle"	=> array('sc_alert', 'sc_changed', 'sc_error_message', 'sc_mail_send'),
								"Seguran&ccedil;a"	=> array('sc_apl_status'),
								"Bot&otilde;es"	=> array('sc_btn_display'),
								);
		break;

		case "form_controle_ajaxFieldonBlur":
			$arr_wizard	= array(	
								"SQL"	=> array('sc_lookup', 'sc_select'),
								"Data"	=> array('sc_date', 'sc_date_conv', 'sc_date_dif', 'sc_date_dif_2'),
								"Controle"	=> array('sc_error_message'),
								);
		break;

		case "form_controle_ajaxFieldonChange":
			$arr_wizard	= array(	
								"SQL"	=> array('sc_lookup'),
								"Data"	=> array('sc_date', 'sc_date_conv', 'sc_date_dif', 'sc_date_dif_2'),
								"Controle"	=> array('sc_error_message'),
								);
		break;

		case "form_controle_ajaxFieldonClick":
			$arr_wizard	= array(	
								"SQL"	=> array('sc_lookup', 'sc_select'),
								"Data"	=> array('sc_date', 'sc_date_conv', 'sc_date_dif', 'sc_date_dif_2'),
								"Controle"	=> array('sc_error_message'),
								);
		break;

		case "form_controle_ajaxFieldonFocus":
			$arr_wizard	= array(	
								"SQL"	=> array('sc_lookup', 'sc_select'),
								"Data"	=> array('sc_date', 'sc_date_conv', 'sc_date_dif', 'sc_date_dif_2'),
								"Controle"	=> array('sc_error_message', 'sc_link'),
								);
		break;

		case "form_controle_onButtonClick":
			$arr_wizard	= array(	
								"SQL"	=> array('sc_exec_sql', 'sc_lookup', 'sc_select'),
								"Data"	=> array('sc_date', 'sc_date_conv', 'sc_date_dif', 'sc_date_dif_2'),
								"Controle"	=> array('sc_confirm', 'sc_mail_send'),
								"Seguran&ccedil;a"	=> array('sc_apl_status'),
								);
		break;

		case "form_controle_onScriptInit":
			$arr_wizard	= array(	
								"SQL"	=> array('sc_exec_sql', 'sc_lookup', 'sc_select'),
								"Data"	=> array('sc_date', 'sc_date_conv', 'sc_date_dif', 'sc_date_dif_2'),
								"Controle"	=> array('sc_alert', 'sc_changed', 'sc_error_message', 'sc_mail_send'),
								"Seguran&ccedil;a"	=> array('sc_apl_status'),
								"Bot&otilde;es"	=> array('sc_btn_display'),
								);
		break;

		case "form_controle_onLoadAll":
			$arr_wizard	= array(	
								"SQL"	=> array('sc_lookup', 'sc_select'),
								"Data"	=> array('sc_date', 'sc_date_conv', 'sc_date_dif', 'sc_date_dif_2'),
								"Controle"	=> array('sc_alert', 'sc_error_message', 'sc_mail_send'),
								"Seguran&ccedil;a"	=> array('sc_apl_status'),
								"Bot&otilde;es"	=> array('sc_btn_display'),
								);
		break;

		case "form_controle_onRefresh":
			$arr_wizard	= array(	
								"SQL"	=> array('sc_lookup', 'sc_select'),
								"Data"	=> array('sc_date', 'sc_date_conv', 'sc_date_dif', 'sc_date_dif_2'),
								"Controle"	=> array('sc_changed', 'sc_error_message'),
								);
		break;

		case "form_controle_onValidate":
			$arr_wizard	= array(	
								"SQL"	=> array('sc_exec_sql', 'sc_lookup', 'sc_select'),
								"Data"	=> array('sc_date', 'sc_date_conv', 'sc_date_dif', 'sc_date_dif_2'),
								"Controle"	=> array('sc_alert', 'sc_changed', 'sc_error_message', 'sc_mail_send'),
								"Seguran&ccedil;a"	=> array('sc_apl_status'),
								"Bot&otilde;es"	=> array('sc_btn_display'),
								);
		break;

		case "menu_onExecute":
			$arr_wizard	= array(	
								"SQL"	=> array('sc_lookup', 'sc_select'),
								"Data"	=> array('sc_date', 'sc_date_conv', 'sc_date_dif', 'sc_date_dif_2'),
								);
		break;

		case "menu_onLoad":
			$arr_wizard	= array(	
								"SQL"	=> array('sc_lookup', 'sc_select'),
								"Data"	=> array('sc_date', 'sc_date_conv', 'sc_date_dif', 'sc_date_dif_2'),
								"Controle"	=> array('sc_mail_send'),
								"Seguran&ccedil;a"	=> array('sc_apl_status'),
								"Menu"	=> array('sc_menu_delete', 'sc_menu_disable'),
								);
		break;

		case "menutree_onExecute":
			$arr_wizard	= array(	
								"SQL"	=> array('sc_lookup', 'sc_select'),
								"Data"	=> array('sc_date', 'sc_date_conv', 'sc_date_dif', 'sc_date_dif_2'),
								);
		break;

		case "menutree_onLoad":
			$arr_wizard	= array(	
								"SQL"	=> array('sc_lookup', 'sc_select'),
								"Data"	=> array('sc_date', 'sc_date_conv', 'sc_date_dif', 'sc_date_dif_2'),
								"Controle"	=> array('sc_mail_send'),
								"Seguran&ccedil;a"	=> array('sc_apl_status'),
								"Menu"	=> array('sc_menu_delete', 'sc_menu_disable'),
								);
		break;

		case "reportpdf_onFooter":
			$arr_wizard	= array(	
								"SQL"	=> array('sc_lookup', 'sc_select'),
								"Data"	=> array('sc_date', 'sc_date_conv', 'sc_date_dif', 'sc_date_dif_2'),
								"Codigo Barra"	=> array('sc_lin_cod_barra_banco'),
								);
		break;

		case "reportpdf_onHeader":
			$arr_wizard	= array(	
								"SQL"	=> array('sc_lookup', 'sc_select'),
								"Data"	=> array('sc_date', 'sc_date_conv', 'sc_date_dif', 'sc_date_dif_2'),
								);
		break;

		case "reportpdf_onScriptInit":
			$arr_wizard	= array(	
								"SQL"	=> array('sc_exec_sql', 'sc_lookup', 'sc_select'),
								"Data"	=> array('sc_date', 'sc_date_conv', 'sc_date_dif', 'sc_date_dif_2'),
								"Controle"	=> array('sc_mail_send'),
								"Seguran&ccedil;a"	=> array('sc_apl_status'),
								);
		break;

		case "reportpdf_onRecord":
			$arr_wizard	= array(	
								"SQL"	=> array('sc_lookup', 'sc_select'),
								"Data"	=> array('sc_date', 'sc_date_conv', 'sc_date_dif', 'sc_date_dif_2'),
								"Controle"	=> array('sc_link', 'sc_mail_send', 'sc_make_link'),
								"Codigo Barra"	=> array('sc_lin_cod_barra_banco'),
								);
		break;
	}


	return $arr_wizard;

}
function nm_mceditorautocomplete_array($app, $evento) {
    $arr_wizard	= "";


	switch (conv_app_name($app)."_".$evento) {

		case "todas_allMacros":
			$arr_wizard	= array('sc_begin_trans_@#AC@#_sc_begin_trans(&quot;conex&atilde;o&quot;)', 'sc_commit_trans_@#AC@#_sc_commit_trans(&quot;conex&atilde;o&quot;)', 'sc_error_continue_@#AC@#_sc_error_continue(&quot;evento&quot;)', 'sc_error_delete_@#AC@#_{sc_error_delete}', 'sc_error_insert_@#AC@#_{sc_error_insert}', 'sc_error_update_@#AC@#_{sc_error_update}', 'sc_exec_sql_@#AC@#_sc_exec_sql(&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_lookup_@#AC@#_sc_lookup(dataset,&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_rollback_trans_@#AC@#_sc_rollback_trans(&quot;conex&atilde;o&quot;)', 'sc_select_@#AC@#_sc_select(dataset,&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_select_field_@#AC@#_sc_select_field({campo})', 'sc_select_order_@#AC@#_sc_select_order(campo)', 'sc_select_where_@#AC@#_sc_select_where(add)', 'sc_sql_injection_@#AC@#_sc_sql_injection(campo/vari&aacute;vel)', 'sc_where_current_@#AC@#_{sc_where_current}', 'sc_where_orig_@#AC@#_{sc_where_orig}', 'sc_date_@#AC@#_sc_date(data, formato, operador, D, M, A)', 'sc_date_conv_@#AC@#_sc_date_conv({cmp_data}, &quot;fmt_entrada&quot;, &quot;fmt_sa&iacute;da&quot;)', 'sc_date_dif_@#AC@#_sc_date_dif(data1, formato data1, data2, formato data2)', 'sc_date_dif_2_@#AC@#_sc_date_dif_2(data1, formato data1, data2, formato data2, op&ccedil;&atilde;o)', 'sc_date_empty_@#AC@#_sc_date_empty({campo_data})', 'sc_alert_@#AC@#_sc_alert(&quot;mensagem&quot;)', 'sc_apl_conf_@#AC@#_sc_apl_conf(Aplica&ccedil;&atilde;o, Propriedade, valor)', 'sc_calc_dv_@#AC@#_sc_calc_dv(dig, resto, valor, m&oacute;dulo, pesos, tipo)', 'sc_changed_@#AC@#_sc_changed({campo})', 'sc_confirm_@#AC@#_sc_confirm(&quot;mensagem&quot;)', 'sc_decode_@#AC@#_sc_decode(campo/vari&aacute;vel)', 'sc_encode_@#AC@#_sc_encode(campo/vari&aacute;vel)', 'sc_error_exit_@#AC@#_sc_error_exit(URL/Aplica&ccedil;&atilde;o)', 'sc_error_message_@#AC@#_sc_error_message(&quot;texto&quot;)', 'sc_exit_@#AC@#_sc_exit(op&ccedil;&atilde;o)', 'sc_groupby_label_@#AC@#_sc_groupby_label(campo)', 'sc_image_@#AC@#_sc_image(img1.jpg,img2.gif,...)', 'sc_include_@#AC@#_sc_include(arquivo, origem)', 'sc_label_@#AC@#_sc_label(campo)', 'sc_link_@#AC@#_sc_link(coluna, aplica&ccedil;&atilde;o, par&acirc;metros, hint, target)', 'sc_mail_send_@#AC@#_sc_mail_send(smtp, usr, pw, de, para, assunto, mensagem, tipo_mens, c&oacute;pias, tp_c&oacute;pias, porta, tp_conexao, attachment)', 'sc_make_link_@#AC@#_sc_make_link(aplica&ccedil;&atilde;o, par&acirc;metros)', 'sc_redir_@#AC@#_sc_redir(apl, parm1; parm2; ..., target)', 'sc_reset_global_@#AC@#_sc_reset_global([var_glo1], [var_glo2] ...)', 'sc_seq_register_@#AC@#_{sc_seq_register}', 'sc_set_global_@#AC@#_sc_set_global($var_1, {cmp_x}, ...)', 'sc_site_ssl_@#AC@#_sc_site_ssl', 'sc_trunc_num_@#AC@#_sc_trunc_num(campo,  qt_dec)', 'sc_url_exit_@#AC@#_sc_url_exit(url)', 'sc_warning_@#AC@#_sc_warning = \'on\'/\'off\'', 'sc_zip_file_@#AC@#_sc_zip_file(arquivos, zip)', 'sc_lin_cod_barra_arrecadacao_@#AC@#_sc_lin_cod_barra_arrecadacao(cod_barra, cod_seguimento, cod_moeda, valor, livre)', 'sc_lin_cod_barra_banco_@#AC@#_sc_lin_cod_barra_banco(cod_barra, cod_banco, cod_moeda, valor, livre, dt_venc)', 'sc_lin_digitavel_arrecadacao_@#AC@#_sc_lin_digitavel_arrecadacao(lin_digitavel, cod_barras)', 'sc_lin_digitavel_banco_@#AC@#_sc_lin_digitavel_banco(lin_digitavel, cod_barras)', 'sc_where_filter_@#AC@#_{sc_where_filter}', 'sc_apl_status_@#AC@#_sc_apl_status(aplica&ccedil;&atilde;o, status)', 'sc_reset_apl_conf_@#AC@#_sc_reset_apl_conf(Aplica&ccedil;&atilde;o, Propriedade)', 'sc_reset_apl_status_@#AC@#_sc_reset_apl_status()', 'sc_reset_menu_delete_@#AC@#_sc_reset_menu_delete()', 'sc_reset_menu_disable_@#AC@#_sc_reset_menu_disable()', 'sc_block_display_@#AC@#_sc_block_display(nome do bloco, on/off)', 'sc_field_color_@#AC@#_sc_field_color(&quot;campo&quot;, &quot;cor&quot;)', 'sc_field_display_@#AC@#_sc_field_display({campo}, on/off)', 'sc_field_readonly_@#AC@#_sc_field_readonly({campo})', 'sc_format_num_@#AC@#_sc_format_num(campo, simb_agrup,  simb_dec, qt_dec, enche_zeros=,   lado_neg,  simb_monetario, lado_simb_monetario)', 'sc_form_show_@#AC@#_sc_form_show = \'on\'/\'off\'', 'sc_vl_extenso_@#AC@#_sc_vl_extenso(valor, tam_linha, tipo)', 'sc_btn_delete_@#AC@#_sc_btn_delete', 'sc_btn_display_@#AC@#_sc_btn_display(&quot;nomebotao&quot;,&quot;on/off&quot;)', 'sc_btn_insert_@#AC@#_sc_btn_insert', 'sc_btn_new_@#AC@#_sc_btn_new', 'sc_btn_update_@#AC@#_sc_btn_update', 'sc_menu_delete_@#AC@#_sc_menu_deleteid_item1,id_item2,...', 'sc_menu_disable_@#AC@#_sc_menu_disableid_item1,id_item2,...', 'sc_script_name_@#AC@#_{sc_script_name}');
		break;

		case "blank_onExecute":
			$arr_wizard	= array('sc_exec_sql_@#AC@#_sc_exec_sql(&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_lookup_@#AC@#_sc_lookup(dataset,&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_select_@#AC@#_sc_select(dataset,&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_sql_injection_@#AC@#_sc_sql_injection(campo/vari&aacute;vel)', 'sc_date_dif_@#AC@#_sc_date_dif(data1, formato data1, data2, formato data2)', 'sc_date_dif_2_@#AC@#_sc_date_dif_2(data1, formato data1, data2, formato data2, op&ccedil;&atilde;o)', 'sc_apl_conf_@#AC@#_sc_apl_conf(Aplica&ccedil;&atilde;o, Propriedade, valor)', 'sc_calc_dv_@#AC@#_sc_calc_dv(dig, resto, valor, m&oacute;dulo, pesos, tipo)', 'sc_decode_@#AC@#_sc_decode(campo/vari&aacute;vel)', 'sc_encode_@#AC@#_sc_encode(campo/vari&aacute;vel)', 'sc_error_exit_@#AC@#_sc_error_exit(URL/Aplica&ccedil;&atilde;o)', 'sc_error_message_@#AC@#_sc_error_message(&quot;texto&quot;)', 'sc_image_@#AC@#_sc_image(img1.jpg,img2.gif,...)', 'sc_include_@#AC@#_sc_include(arquivo, origem)', 'sc_mail_send_@#AC@#_sc_mail_send(smtp, usr, pw, de, para, assunto, mensagem, tipo_mens, c&oacute;pias, tp_c&oacute;pias, porta, tp_conexao, attachment)', 'sc_make_link_@#AC@#_sc_make_link(aplica&ccedil;&atilde;o, par&acirc;metros)', 'sc_redir_@#AC@#_sc_redir(apl, parm1; parm2; ..., target)', 'sc_site_ssl_@#AC@#_sc_site_ssl', 'sc_zip_file_@#AC@#_sc_zip_file(arquivos, zip)', 'sc_apl_status_@#AC@#_sc_apl_status(aplica&ccedil;&atilde;o, status)');
		break;

		case "consulta_onButtonClick":
			$arr_wizard	= array('sc_begin_trans_@#AC@#_sc_begin_trans(&quot;conex&atilde;o&quot;)', 'sc_commit_trans_@#AC@#_sc_commit_trans(&quot;conex&atilde;o&quot;)', 'sc_exec_sql_@#AC@#_sc_exec_sql(&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_lookup_@#AC@#_sc_lookup(dataset,&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_rollback_trans_@#AC@#_sc_rollback_trans(&quot;conex&atilde;o&quot;)', 'sc_select_@#AC@#_sc_select(dataset,&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_date_@#AC@#_sc_date(data, formato, operador, D, M, A)', 'sc_date_conv_@#AC@#_sc_date_conv({cmp_data}, &quot;fmt_entrada&quot;, &quot;fmt_sa&iacute;da&quot;)', 'sc_date_dif_@#AC@#_sc_date_dif(data1, formato data1, data2, formato data2)', 'sc_date_dif_2_@#AC@#_sc_date_dif_2(data1, formato data1, data2, formato data2, op&ccedil;&atilde;o)', 'sc_apl_conf_@#AC@#_sc_apl_conf(Aplica&ccedil;&atilde;o, Propriedade, valor)', 'sc_calc_dv_@#AC@#_sc_calc_dv(dig, resto, valor, m&oacute;dulo, pesos, tipo)', 'sc_confirm_@#AC@#_sc_confirm(&quot;mensagem&quot;)', 'sc_exit_@#AC@#_sc_exit(op&ccedil;&atilde;o)', 'sc_include_@#AC@#_sc_include(arquivo, origem)', 'sc_mail_send_@#AC@#_sc_mail_send(smtp, usr, pw, de, para, assunto, mensagem, tipo_mens, c&oacute;pias, tp_c&oacute;pias, porta, tp_conexao, attachment)', 'sc_redir_@#AC@#_sc_redir(apl, parm1; parm2; ..., target)', 'sc_reset_global_@#AC@#_sc_reset_global([var_glo1], [var_glo2] ...)', 'sc_set_global_@#AC@#_sc_set_global($var_1, {cmp_x}, ...)', 'sc_trunc_num_@#AC@#_sc_trunc_num(campo,  qt_dec)', 'sc_warning_@#AC@#_sc_warning = \'on\'/\'off\'', 'sc_zip_file_@#AC@#_sc_zip_file(arquivos, zip)', 'sc_apl_status_@#AC@#_sc_apl_status(aplica&ccedil;&atilde;o, status)', 'sc_reset_apl_conf_@#AC@#_sc_reset_apl_conf(Aplica&ccedil;&atilde;o, Propriedade)', 'sc_reset_apl_status_@#AC@#_sc_reset_apl_status()', 'sc_format_num_@#AC@#_sc_format_num(campo, simb_agrup,  simb_dec, qt_dec, enche_zeros=,   lado_neg,  simb_monetario, lado_simb_monetario)', 'sc_vl_extenso_@#AC@#_sc_vl_extenso(valor, tam_linha, tipo)');
		break;

		case "consulta_onFooter":
			$arr_wizard	= array('sc_lookup_@#AC@#_sc_lookup(dataset,&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_select_@#AC@#_sc_select(dataset,&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_date_@#AC@#_sc_date(data, formato, operador, D, M, A)', 'sc_date_conv_@#AC@#_sc_date_conv({cmp_data}, &quot;fmt_entrada&quot;, &quot;fmt_sa&iacute;da&quot;)', 'sc_date_dif_@#AC@#_sc_date_dif(data1, formato data1, data2, formato data2)', 'sc_date_dif_2_@#AC@#_sc_date_dif_2(data1, formato data1, data2, formato data2, op&ccedil;&atilde;o)', 'sc_calc_dv_@#AC@#_sc_calc_dv(dig, resto, valor, m&oacute;dulo, pesos, tipo)', 'sc_include_@#AC@#_sc_include(arquivo, origem)', 'sc_reset_global_@#AC@#_sc_reset_global([var_glo1], [var_glo2] ...)', 'sc_set_global_@#AC@#_sc_set_global($var_1, {cmp_x}, ...)', 'sc_trunc_num_@#AC@#_sc_trunc_num(campo,  qt_dec)', 'sc_warning_@#AC@#_sc_warning = \'on\'/\'off\'', 'sc_lin_cod_barra_arrecadacao_@#AC@#_sc_lin_cod_barra_arrecadacao(cod_barra, cod_seguimento, cod_moeda, valor, livre)', 'sc_lin_cod_barra_banco_@#AC@#_sc_lin_cod_barra_banco(cod_barra, cod_banco, cod_moeda, valor, livre, dt_venc)', 'sc_lin_digitavel_arrecadacao_@#AC@#_sc_lin_digitavel_arrecadacao(lin_digitavel, cod_barras)', 'sc_lin_digitavel_banco_@#AC@#_sc_lin_digitavel_banco(lin_digitavel, cod_barras)', 'sc_format_num_@#AC@#_sc_format_num(campo, simb_agrup,  simb_dec, qt_dec, enche_zeros=,   lado_neg,  simb_monetario, lado_simb_monetario)', 'sc_vl_extenso_@#AC@#_sc_vl_extenso(valor, tam_linha, tipo)');
		break;

		case "consulta_onGroupBy":
			$arr_wizard	= array('sc_lookup_@#AC@#_sc_lookup(dataset,&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_select_@#AC@#_sc_select(dataset,&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_date_@#AC@#_sc_date(data, formato, operador, D, M, A)', 'sc_date_conv_@#AC@#_sc_date_conv({cmp_data}, &quot;fmt_entrada&quot;, &quot;fmt_sa&iacute;da&quot;)', 'sc_date_dif_@#AC@#_sc_date_dif(data1, formato data1, data2, formato data2)', 'sc_date_dif_2_@#AC@#_sc_date_dif_2(data1, formato data1, data2, formato data2, op&ccedil;&atilde;o)', 'sc_calc_dv_@#AC@#_sc_calc_dv(dig, resto, valor, m&oacute;dulo, pesos, tipo)', 'sc_groupby_label_@#AC@#_sc_groupby_label(campo)', 'sc_include_@#AC@#_sc_include(arquivo, origem)', 'sc_reset_global_@#AC@#_sc_reset_global([var_glo1], [var_glo2] ...)', 'sc_set_global_@#AC@#_sc_set_global($var_1, {cmp_x}, ...)', 'sc_trunc_num_@#AC@#_sc_trunc_num(campo,  qt_dec)', 'sc_warning_@#AC@#_sc_warning = \'on\'/\'off\'', 'sc_format_num_@#AC@#_sc_format_num(campo, simb_agrup,  simb_dec, qt_dec, enche_zeros=,   lado_neg,  simb_monetario, lado_simb_monetario)');
		break;

		case "consulta_onHeader":
			$arr_wizard	= array('sc_lookup_@#AC@#_sc_lookup(dataset,&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_select_@#AC@#_sc_select(dataset,&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_date_@#AC@#_sc_date(data, formato, operador, D, M, A)', 'sc_date_conv_@#AC@#_sc_date_conv({cmp_data}, &quot;fmt_entrada&quot;, &quot;fmt_sa&iacute;da&quot;)', 'sc_date_dif_@#AC@#_sc_date_dif(data1, formato data1, data2, formato data2)', 'sc_date_dif_2_@#AC@#_sc_date_dif_2(data1, formato data1, data2, formato data2, op&ccedil;&atilde;o)', 'sc_calc_dv_@#AC@#_sc_calc_dv(dig, resto, valor, m&oacute;dulo, pesos, tipo)', 'sc_include_@#AC@#_sc_include(arquivo, origem)', 'sc_reset_global_@#AC@#_sc_reset_global([var_glo1], [var_glo2] ...)', 'sc_set_global_@#AC@#_sc_set_global($var_1, {cmp_x}, ...)', 'sc_trunc_num_@#AC@#_sc_trunc_num(campo,  qt_dec)', 'sc_warning_@#AC@#_sc_warning = \'on\'/\'off\'', 'sc_format_num_@#AC@#_sc_format_num(campo, simb_agrup,  simb_dec, qt_dec, enche_zeros=,   lado_neg,  simb_monetario, lado_simb_monetario)', 'sc_vl_extenso_@#AC@#_sc_vl_extenso(valor, tam_linha, tipo)');
		break;

		case "consulta_onScriptInit":
			$arr_wizard	= array('sc_exec_sql_@#AC@#_sc_exec_sql(&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_lookup_@#AC@#_sc_lookup(dataset,&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_select_@#AC@#_sc_select(dataset,&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_select_field_@#AC@#_sc_select_field({campo})', 'sc_select_order_@#AC@#_sc_select_order(campo)', 'sc_select_where_@#AC@#_sc_select_where(add)', 'sc_where_current_@#AC@#_{sc_where_current}', 'sc_where_orig_@#AC@#_{sc_where_orig}', 'sc_date_@#AC@#_sc_date(data, formato, operador, D, M, A)', 'sc_date_conv_@#AC@#_sc_date_conv({cmp_data}, &quot;fmt_entrada&quot;, &quot;fmt_sa&iacute;da&quot;)', 'sc_date_dif_@#AC@#_sc_date_dif(data1, formato data1, data2, formato data2)', 'sc_date_dif_2_@#AC@#_sc_date_dif_2(data1, formato data1, data2, formato data2, op&ccedil;&atilde;o)', 'sc_apl_conf_@#AC@#_sc_apl_conf(Aplica&ccedil;&atilde;o, Propriedade, valor)', 'sc_calc_dv_@#AC@#_sc_calc_dv(dig, resto, valor, m&oacute;dulo, pesos, tipo)', 'sc_decode_@#AC@#_sc_decode(campo/vari&aacute;vel)', 'sc_encode_@#AC@#_sc_encode(campo/vari&aacute;vel)', 'sc_image_@#AC@#_sc_image(img1.jpg,img2.gif,...)', 'sc_include_@#AC@#_sc_include(arquivo, origem)', 'sc_label_@#AC@#_sc_label(campo)', 'sc_mail_send_@#AC@#_sc_mail_send(smtp, usr, pw, de, para, assunto, mensagem, tipo_mens, c&oacute;pias, tp_c&oacute;pias, porta, tp_conexao, attachment)', 'sc_redir_@#AC@#_sc_redir(apl, parm1; parm2; ..., target)', 'sc_reset_global_@#AC@#_sc_reset_global([var_glo1], [var_glo2] ...)', 'sc_set_global_@#AC@#_sc_set_global($var_1, {cmp_x}, ...)', 'sc_site_ssl_@#AC@#_sc_site_ssl', 'sc_trunc_num_@#AC@#_sc_trunc_num(campo,  qt_dec)', 'sc_url_exit_@#AC@#_sc_url_exit(url)', 'sc_warning_@#AC@#_sc_warning = \'on\'/\'off\'', 'sc_zip_file_@#AC@#_sc_zip_file(arquivos, zip)', 'sc_where_filter_@#AC@#_{sc_where_filter}', 'sc_apl_status_@#AC@#_sc_apl_status(aplica&ccedil;&atilde;o, status)', 'sc_reset_apl_conf_@#AC@#_sc_reset_apl_conf(Aplica&ccedil;&atilde;o, Propriedade)', 'sc_reset_apl_status_@#AC@#_sc_reset_apl_status()', 'sc_block_display_@#AC@#_sc_block_display(nome do bloco, on/off)', 'sc_field_color_@#AC@#_sc_field_color(&quot;campo&quot;, &quot;cor&quot;)', 'sc_field_display_@#AC@#_sc_field_display({campo}, on/off)', 'sc_format_num_@#AC@#_sc_format_num(campo, simb_agrup,  simb_dec, qt_dec, enche_zeros=,   lado_neg,  simb_monetario, lado_simb_monetario)', 'sc_vl_extenso_@#AC@#_sc_vl_extenso(valor, tam_linha, tipo)', 'sc_btn_display_@#AC@#_sc_btn_display(&quot;nomebotao&quot;,&quot;on/off&quot;)');
		break;

		case "consulta_onRecord":
			$arr_wizard	= array('sc_lookup_@#AC@#_sc_lookup(dataset,&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_select_@#AC@#_sc_select(dataset,&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_where_current_@#AC@#_{sc_where_current}', 'sc_where_orig_@#AC@#_{sc_where_orig}', 'sc_date_@#AC@#_sc_date(data, formato, operador, D, M, A)', 'sc_date_conv_@#AC@#_sc_date_conv({cmp_data}, &quot;fmt_entrada&quot;, &quot;fmt_sa&iacute;da&quot;)', 'sc_date_dif_@#AC@#_sc_date_dif(data1, formato data1, data2, formato data2)', 'sc_date_dif_2_@#AC@#_sc_date_dif_2(data1, formato data1, data2, formato data2, op&ccedil;&atilde;o)', 'sc_calc_dv_@#AC@#_sc_calc_dv(dig, resto, valor, m&oacute;dulo, pesos, tipo)', 'sc_include_@#AC@#_sc_include(arquivo, origem)', 'sc_link_@#AC@#_sc_link(coluna, aplica&ccedil;&atilde;o, par&acirc;metros, hint, target)', 'sc_mail_send_@#AC@#_sc_mail_send(smtp, usr, pw, de, para, assunto, mensagem, tipo_mens, c&oacute;pias, tp_c&oacute;pias, porta, tp_conexao, attachment)', 'sc_make_link_@#AC@#_sc_make_link(aplica&ccedil;&atilde;o, par&acirc;metros)', 'sc_reset_global_@#AC@#_sc_reset_global([var_glo1], [var_glo2] ...)', 'sc_seq_register_@#AC@#_{sc_seq_register}', 'sc_set_global_@#AC@#_sc_set_global($var_1, {cmp_x}, ...)', 'sc_trunc_num_@#AC@#_sc_trunc_num(campo,  qt_dec)', 'sc_warning_@#AC@#_sc_warning = \'on\'/\'off\'', 'sc_zip_file_@#AC@#_sc_zip_file(arquivos, zip)', 'sc_lin_cod_barra_arrecadacao_@#AC@#_sc_lin_cod_barra_arrecadacao(cod_barra, cod_seguimento, cod_moeda, valor, livre)', 'sc_lin_cod_barra_banco_@#AC@#_sc_lin_cod_barra_banco(cod_barra, cod_banco, cod_moeda, valor, livre, dt_venc)', 'sc_lin_digitavel_arrecadacao_@#AC@#_sc_lin_digitavel_arrecadacao(lin_digitavel, cod_barras)', 'sc_lin_digitavel_banco_@#AC@#_sc_lin_digitavel_banco(lin_digitavel, cod_barras)', 'sc_where_filter_@#AC@#_{sc_where_filter}', 'sc_field_color_@#AC@#_sc_field_color(&quot;campo&quot;, &quot;cor&quot;)', 'sc_format_num_@#AC@#_sc_format_num(campo, simb_agrup,  simb_dec, qt_dec, enche_zeros=,   lado_neg,  simb_monetario, lado_simb_monetario)', 'sc_vl_extenso_@#AC@#_sc_vl_extenso(valor, tam_linha, tipo)');
		break;

		case "filtro_onScriptInit":
			$arr_wizard	= array('sc_lookup_@#AC@#_sc_lookup(dataset,&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_select_@#AC@#_sc_select(dataset,&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_date_@#AC@#_sc_date(data, formato, operador, D, M, A)', 'sc_date_conv_@#AC@#_sc_date_conv({cmp_data}, &quot;fmt_entrada&quot;, &quot;fmt_sa&iacute;da&quot;)', 'sc_date_dif_@#AC@#_sc_date_dif(data1, formato data1, data2, formato data2)', 'sc_date_dif_2_@#AC@#_sc_date_dif_2(data1, formato data1, data2, formato data2, op&ccedil;&atilde;o)', 'sc_apl_conf_@#AC@#_sc_apl_conf(Aplica&ccedil;&atilde;o, Propriedade, valor)', 'sc_calc_dv_@#AC@#_sc_calc_dv(dig, resto, valor, m&oacute;dulo, pesos, tipo)', 'sc_error_message_@#AC@#_sc_error_message(&quot;texto&quot;)', 'sc_image_@#AC@#_sc_image(img1.jpg,img2.gif,...)', 'sc_include_@#AC@#_sc_include(arquivo, origem)', 'sc_mail_send_@#AC@#_sc_mail_send(smtp, usr, pw, de, para, assunto, mensagem, tipo_mens, c&oacute;pias, tp_c&oacute;pias, porta, tp_conexao, attachment)', 'sc_redir_@#AC@#_sc_redir(apl, parm1; parm2; ..., target)', 'sc_reset_global_@#AC@#_sc_reset_global([var_glo1], [var_glo2] ...)', 'sc_set_global_@#AC@#_sc_set_global($var_1, {cmp_x}, ...)', 'sc_trunc_num_@#AC@#_sc_trunc_num(campo,  qt_dec)', 'sc_warning_@#AC@#_sc_warning = \'on\'/\'off\'', 'sc_zip_file_@#AC@#_sc_zip_file(arquivos, zip)', 'sc_apl_status_@#AC@#_sc_apl_status(aplica&ccedil;&atilde;o, status)', 'sc_reset_apl_conf_@#AC@#_sc_reset_apl_conf(Aplica&ccedil;&atilde;o, Propriedade)', 'sc_reset_apl_status_@#AC@#_sc_reset_apl_status()', 'sc_format_num_@#AC@#_sc_format_num(campo, simb_agrup,  simb_dec, qt_dec, enche_zeros=,   lado_neg,  simb_monetario, lado_simb_monetario)');
		break;

		case "filtro_onRefresh":
			$arr_wizard	= array('sc_lookup_@#AC@#_sc_lookup(dataset,&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_select_@#AC@#_sc_select(dataset,&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_date_@#AC@#_sc_date(data, formato, operador, D, M, A)', 'sc_date_conv_@#AC@#_sc_date_conv({cmp_data}, &quot;fmt_entrada&quot;, &quot;fmt_sa&iacute;da&quot;)', 'sc_date_dif_@#AC@#_sc_date_dif(data1, formato data1, data2, formato data2)', 'sc_date_dif_2_@#AC@#_sc_date_dif_2(data1, formato data1, data2, formato data2, op&ccedil;&atilde;o)', 'sc_date_empty_@#AC@#_sc_date_empty({campo_data})', 'sc_calc_dv_@#AC@#_sc_calc_dv(dig, resto, valor, m&oacute;dulo, pesos, tipo)', 'sc_error_message_@#AC@#_sc_error_message(&quot;texto&quot;)', 'sc_include_@#AC@#_sc_include(arquivo, origem)', 'sc_reset_global_@#AC@#_sc_reset_global([var_glo1], [var_glo2] ...)', 'sc_set_global_@#AC@#_sc_set_global($var_1, {cmp_x}, ...)', 'sc_trunc_num_@#AC@#_sc_trunc_num(campo,  qt_dec)', 'sc_warning_@#AC@#_sc_warning = \'on\'/\'off\'', 'sc_format_num_@#AC@#_sc_format_num(campo, simb_agrup,  simb_dec, qt_dec, enche_zeros=,   lado_neg,  simb_monetario, lado_simb_monetario)');
		break;

		case "filtro_onSave":
			$arr_wizard	= array('sc_lookup_@#AC@#_sc_lookup(dataset,&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_select_@#AC@#_sc_select(dataset,&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_date_@#AC@#_sc_date(data, formato, operador, D, M, A)', 'sc_date_conv_@#AC@#_sc_date_conv({cmp_data}, &quot;fmt_entrada&quot;, &quot;fmt_sa&iacute;da&quot;)', 'sc_date_dif_@#AC@#_sc_date_dif(data1, formato data1, data2, formato data2)', 'sc_date_dif_2_@#AC@#_sc_date_dif_2(data1, formato data1, data2, formato data2, op&ccedil;&atilde;o)', 'sc_calc_dv_@#AC@#_sc_calc_dv(dig, resto, valor, m&oacute;dulo, pesos, tipo)', 'sc_include_@#AC@#_sc_include(arquivo, origem)', 'sc_mail_send_@#AC@#_sc_mail_send(smtp, usr, pw, de, para, assunto, mensagem, tipo_mens, c&oacute;pias, tp_c&oacute;pias, porta, tp_conexao, attachment)', 'sc_reset_global_@#AC@#_sc_reset_global([var_glo1], [var_glo2] ...)', 'sc_set_global_@#AC@#_sc_set_global($var_1, {cmp_x}, ...)', 'sc_trunc_num_@#AC@#_sc_trunc_num(campo,  qt_dec)', 'sc_warning_@#AC@#_sc_warning = \'on\'/\'off\'', 'sc_zip_file_@#AC@#_sc_zip_file(arquivos, zip)', 'sc_format_num_@#AC@#_sc_format_num(campo, simb_agrup,  simb_dec, qt_dec, enche_zeros=,   lado_neg,  simb_monetario, lado_simb_monetario)');
		break;

		case "filtro_onValidate":
			$arr_wizard	= array('sc_lookup_@#AC@#_sc_lookup(dataset,&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_select_@#AC@#_sc_select(dataset,&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_date_@#AC@#_sc_date(data, formato, operador, D, M, A)', 'sc_date_conv_@#AC@#_sc_date_conv({cmp_data}, &quot;fmt_entrada&quot;, &quot;fmt_sa&iacute;da&quot;)', 'sc_date_dif_@#AC@#_sc_date_dif(data1, formato data1, data2, formato data2)', 'sc_date_dif_2_@#AC@#_sc_date_dif_2(data1, formato data1, data2, formato data2, op&ccedil;&atilde;o)', 'sc_date_empty_@#AC@#_sc_date_empty({campo_data})', 'sc_calc_dv_@#AC@#_sc_calc_dv(dig, resto, valor, m&oacute;dulo, pesos, tipo)', 'sc_error_message_@#AC@#_sc_error_message(&quot;texto&quot;)', 'sc_include_@#AC@#_sc_include(arquivo, origem)', 'sc_mail_send_@#AC@#_sc_mail_send(smtp, usr, pw, de, para, assunto, mensagem, tipo_mens, c&oacute;pias, tp_c&oacute;pias, porta, tp_conexao, attachment)', 'sc_reset_global_@#AC@#_sc_reset_global([var_glo1], [var_glo2] ...)', 'sc_set_global_@#AC@#_sc_set_global($var_1, {cmp_x}, ...)', 'sc_trunc_num_@#AC@#_sc_trunc_num(campo,  qt_dec)', 'sc_warning_@#AC@#_sc_warning = \'on\'/\'off\'', 'sc_zip_file_@#AC@#_sc_zip_file(arquivos, zip)', 'sc_format_num_@#AC@#_sc_format_num(campo, simb_agrup,  simb_dec, qt_dec, enche_zeros=,   lado_neg,  simb_monetario, lado_simb_monetario)');
		break;

		case "form_ajaxFieldonBlur":
			$arr_wizard	= array('sc_lookup_@#AC@#_sc_lookup(dataset,&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_select_@#AC@#_sc_select(dataset,&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_sql_injection_@#AC@#_sc_sql_injection(campo/vari&aacute;vel)', 'sc_date_@#AC@#_sc_date(data, formato, operador, D, M, A)', 'sc_date_conv_@#AC@#_sc_date_conv({cmp_data}, &quot;fmt_entrada&quot;, &quot;fmt_sa&iacute;da&quot;)', 'sc_date_dif_@#AC@#_sc_date_dif(data1, formato data1, data2, formato data2)', 'sc_date_dif_2_@#AC@#_sc_date_dif_2(data1, formato data1, data2, formato data2, op&ccedil;&atilde;o)', 'sc_date_empty_@#AC@#_sc_date_empty({campo_data})', 'sc_calc_dv_@#AC@#_sc_calc_dv(dig, resto, valor, m&oacute;dulo, pesos, tipo)', 'sc_decode_@#AC@#_sc_decode(campo/vari&aacute;vel)', 'sc_encode_@#AC@#_sc_encode(campo/vari&aacute;vel)', 'sc_error_exit_@#AC@#_sc_error_exit(URL/Aplica&ccedil;&atilde;o)', 'sc_error_message_@#AC@#_sc_error_message(&quot;texto&quot;)', 'sc_include_@#AC@#_sc_include(arquivo, origem)', 'sc_label_@#AC@#_sc_label(campo)', 'sc_master_value_@#AC@#_sc_master_value(\'objeto\', valor)', 'sc_trunc_num_@#AC@#_sc_trunc_num(campo,  qt_dec)', 'sc_warning_@#AC@#_sc_warning = \'on\'/\'off\'', 'sc_block_display_@#AC@#_sc_block_display(nome do bloco, on/off)', 'sc_field_display_@#AC@#_sc_field_display({campo}, on/off)', 'sc_field_readonly_@#AC@#_sc_field_readonly({campo})', 'sc_format_num_@#AC@#_sc_format_num(campo, simb_agrup,  simb_dec, qt_dec, enche_zeros=,   lado_neg,  simb_monetario, lado_simb_monetario)', 'sc_set_focus_@#AC@#_sc_set_focus(\'campo\')');
		break;

		case "form_ajaxFieldonChange":
			$arr_wizard	= array('sc_lookup_@#AC@#_sc_lookup(dataset,&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_select_@#AC@#_sc_select(dataset,&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_sql_injection_@#AC@#_sc_sql_injection(campo/vari&aacute;vel)', 'sc_date_@#AC@#_sc_date(data, formato, operador, D, M, A)', 'sc_date_conv_@#AC@#_sc_date_conv({cmp_data}, &quot;fmt_entrada&quot;, &quot;fmt_sa&iacute;da&quot;)', 'sc_date_dif_@#AC@#_sc_date_dif(data1, formato data1, data2, formato data2)', 'sc_date_dif_2_@#AC@#_sc_date_dif_2(data1, formato data1, data2, formato data2, op&ccedil;&atilde;o)', 'sc_date_empty_@#AC@#_sc_date_empty({campo_data})', 'sc_calc_dv_@#AC@#_sc_calc_dv(dig, resto, valor, m&oacute;dulo, pesos, tipo)', 'sc_decode_@#AC@#_sc_decode(campo/vari&aacute;vel)', 'sc_encode_@#AC@#_sc_encode(campo/vari&aacute;vel)', 'sc_error_exit_@#AC@#_sc_error_exit(URL/Aplica&ccedil;&atilde;o)', 'sc_error_message_@#AC@#_sc_error_message(&quot;texto&quot;)', 'sc_include_@#AC@#_sc_include(arquivo, origem)', 'sc_label_@#AC@#_sc_label(campo)', 'sc_master_value_@#AC@#_sc_master_value(\'objeto\', valor)', 'sc_trunc_num_@#AC@#_sc_trunc_num(campo,  qt_dec)', 'sc_warning_@#AC@#_sc_warning = \'on\'/\'off\'', 'sc_block_display_@#AC@#_sc_block_display(nome do bloco, on/off)', 'sc_field_display_@#AC@#_sc_field_display({campo}, on/off)', 'sc_field_readonly_@#AC@#_sc_field_readonly({campo})', 'sc_format_num_@#AC@#_sc_format_num(campo, simb_agrup,  simb_dec, qt_dec, enche_zeros=,   lado_neg,  simb_monetario, lado_simb_monetario)', 'sc_set_focus_@#AC@#_sc_set_focus(\'campo\')');
		break;

		case "form_ajaxFieldonClick":
			$arr_wizard	= array('sc_lookup_@#AC@#_sc_lookup(dataset,&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_select_@#AC@#_sc_select(dataset,&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_sql_injection_@#AC@#_sc_sql_injection(campo/vari&aacute;vel)', 'sc_date_@#AC@#_sc_date(data, formato, operador, D, M, A)', 'sc_date_conv_@#AC@#_sc_date_conv({cmp_data}, &quot;fmt_entrada&quot;, &quot;fmt_sa&iacute;da&quot;)', 'sc_date_dif_@#AC@#_sc_date_dif(data1, formato data1, data2, formato data2)', 'sc_date_dif_2_@#AC@#_sc_date_dif_2(data1, formato data1, data2, formato data2, op&ccedil;&atilde;o)', 'sc_date_empty_@#AC@#_sc_date_empty({campo_data})', 'sc_calc_dv_@#AC@#_sc_calc_dv(dig, resto, valor, m&oacute;dulo, pesos, tipo)', 'sc_decode_@#AC@#_sc_decode(campo/vari&aacute;vel)', 'sc_encode_@#AC@#_sc_encode(campo/vari&aacute;vel)', 'sc_error_exit_@#AC@#_sc_error_exit(URL/Aplica&ccedil;&atilde;o)', 'sc_error_message_@#AC@#_sc_error_message(&quot;texto&quot;)', 'sc_include_@#AC@#_sc_include(arquivo, origem)', 'sc_label_@#AC@#_sc_label(campo)', 'sc_master_value_@#AC@#_sc_master_value(\'objeto\', valor)', 'sc_trunc_num_@#AC@#_sc_trunc_num(campo,  qt_dec)', 'sc_warning_@#AC@#_sc_warning = \'on\'/\'off\'', 'sc_block_display_@#AC@#_sc_block_display(nome do bloco, on/off)', 'sc_field_display_@#AC@#_sc_field_display({campo}, on/off)', 'sc_field_readonly_@#AC@#_sc_field_readonly({campo})', 'sc_format_num_@#AC@#_sc_format_num(campo, simb_agrup,  simb_dec, qt_dec, enche_zeros=,   lado_neg,  simb_monetario, lado_simb_monetario)', 'sc_set_focus_@#AC@#_sc_set_focus(\'campo\')');
		break;

		case "form_ajaxFieldonFocus":
			$arr_wizard	= array('sc_lookup_@#AC@#_sc_lookup(dataset,&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_select_@#AC@#_sc_select(dataset,&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_sql_injection_@#AC@#_sc_sql_injection(campo/vari&aacute;vel)', 'sc_date_@#AC@#_sc_date(data, formato, operador, D, M, A)', 'sc_date_conv_@#AC@#_sc_date_conv({cmp_data}, &quot;fmt_entrada&quot;, &quot;fmt_sa&iacute;da&quot;)', 'sc_date_dif_@#AC@#_sc_date_dif(data1, formato data1, data2, formato data2)', 'sc_date_dif_2_@#AC@#_sc_date_dif_2(data1, formato data1, data2, formato data2, op&ccedil;&atilde;o)', 'sc_date_empty_@#AC@#_sc_date_empty({campo_data})', 'sc_calc_dv_@#AC@#_sc_calc_dv(dig, resto, valor, m&oacute;dulo, pesos, tipo)', 'sc_decode_@#AC@#_sc_decode(campo/vari&aacute;vel)', 'sc_encode_@#AC@#_sc_encode(campo/vari&aacute;vel)', 'sc_error_exit_@#AC@#_sc_error_exit(URL/Aplica&ccedil;&atilde;o)', 'sc_error_message_@#AC@#_sc_error_message(&quot;texto&quot;)', 'sc_include_@#AC@#_sc_include(arquivo, origem)', 'sc_label_@#AC@#_sc_label(campo)', 'sc_master_value_@#AC@#_sc_master_value(\'objeto\', valor)', 'sc_trunc_num_@#AC@#_sc_trunc_num(campo,  qt_dec)', 'sc_warning_@#AC@#_sc_warning = \'on\'/\'off\'', 'sc_block_display_@#AC@#_sc_block_display(nome do bloco, on/off)', 'sc_field_display_@#AC@#_sc_field_display({campo}, on/off)', 'sc_field_readonly_@#AC@#_sc_field_readonly({campo})', 'sc_format_num_@#AC@#_sc_format_num(campo, simb_agrup,  simb_dec, qt_dec, enche_zeros=,   lado_neg,  simb_monetario, lado_simb_monetario)', 'sc_set_focus_@#AC@#_sc_set_focus(\'campo\')');
		break;

		case "form_onAfterDelete":
			$arr_wizard	= array('sc_commit_trans_@#AC@#_sc_commit_trans(&quot;conex&atilde;o&quot;)', 'sc_error_continue_@#AC@#_sc_error_continue(&quot;evento&quot;)', 'sc_error_delete_@#AC@#_{sc_error_delete}', 'sc_exec_sql_@#AC@#_sc_exec_sql(&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_lookup_@#AC@#_sc_lookup(dataset,&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_rollback_trans_@#AC@#_sc_rollback_trans(&quot;conex&atilde;o&quot;)', 'sc_select_@#AC@#_sc_select(dataset,&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_date_@#AC@#_sc_date(data, formato, operador, D, M, A)', 'sc_date_conv_@#AC@#_sc_date_conv({cmp_data}, &quot;fmt_entrada&quot;, &quot;fmt_sa&iacute;da&quot;)', 'sc_date_dif_@#AC@#_sc_date_dif(data1, formato data1, data2, formato data2)', 'sc_date_dif_2_@#AC@#_sc_date_dif_2(data1, formato data1, data2, formato data2, op&ccedil;&atilde;o)', 'sc_apl_conf_@#AC@#_sc_apl_conf(Aplica&ccedil;&atilde;o, Propriedade, valor)', 'sc_calc_dv_@#AC@#_sc_calc_dv(dig, resto, valor, m&oacute;dulo, pesos, tipo)', 'sc_decode_@#AC@#_sc_decode(campo/vari&aacute;vel)', 'sc_encode_@#AC@#_sc_encode(campo/vari&aacute;vel)', 'sc_error_exit_@#AC@#_sc_error_exit(URL/Aplica&ccedil;&atilde;o)', 'sc_error_message_@#AC@#_sc_error_message(&quot;texto&quot;)', 'sc_exit_@#AC@#_sc_exit(op&ccedil;&atilde;o)', 'sc_include_@#AC@#_sc_include(arquivo, origem)', 'sc_mail_send_@#AC@#_sc_mail_send(smtp, usr, pw, de, para, assunto, mensagem, tipo_mens, c&oacute;pias, tp_c&oacute;pias, porta, tp_conexao, attachment)', 'sc_master_value_@#AC@#_sc_master_value(\'objeto\', valor)', 'sc_redir_@#AC@#_sc_redir(apl, parm1; parm2; ..., target)', 'sc_reset_global_@#AC@#_sc_reset_global([var_glo1], [var_glo2] ...)', 'sc_set_global_@#AC@#_sc_set_global($var_1, {cmp_x}, ...)', 'sc_site_ssl_@#AC@#_sc_site_ssl', 'sc_trunc_num_@#AC@#_sc_trunc_num(campo,  qt_dec)', 'sc_url_exit_@#AC@#_sc_url_exit(url)', 'sc_warning_@#AC@#_sc_warning = \'on\'/\'off\'', 'sc_zip_file_@#AC@#_sc_zip_file(arquivos, zip)', 'sc_apl_status_@#AC@#_sc_apl_status(aplica&ccedil;&atilde;o, status)', 'sc_reset_apl_conf_@#AC@#_sc_reset_apl_conf(Aplica&ccedil;&atilde;o, Propriedade)', 'sc_reset_apl_status_@#AC@#_sc_reset_apl_status()', 'sc_block_display_@#AC@#_sc_block_display(nome do bloco, on/off)', 'sc_field_display_@#AC@#_sc_field_display({campo}, on/off)', 'sc_field_readonly_@#AC@#_sc_field_readonly({campo})', 'sc_format_num_@#AC@#_sc_format_num(campo, simb_agrup,  simb_dec, qt_dec, enche_zeros=,   lado_neg,  simb_monetario, lado_simb_monetario)', 'sc_form_show_@#AC@#_sc_form_show = \'on\'/\'off\'', 'sc_btn_display_@#AC@#_sc_btn_display(&quot;nomebotao&quot;,&quot;on/off&quot;)');
		break;

		case "form_onAfterDeleteAll":
			$arr_wizard	= array('sc_commit_trans_@#AC@#_sc_commit_trans(&quot;conex&atilde;o&quot;)', 'sc_exec_sql_@#AC@#_sc_exec_sql(&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_lookup_@#AC@#_sc_lookup(dataset,&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_rollback_trans_@#AC@#_sc_rollback_trans(&quot;conex&atilde;o&quot;)', 'sc_select_@#AC@#_sc_select(dataset,&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_date_@#AC@#_sc_date(data, formato, operador, D, M, A)', 'sc_date_conv_@#AC@#_sc_date_conv({cmp_data}, &quot;fmt_entrada&quot;, &quot;fmt_sa&iacute;da&quot;)', 'sc_date_dif_@#AC@#_sc_date_dif(data1, formato data1, data2, formato data2)', 'sc_date_dif_2_@#AC@#_sc_date_dif_2(data1, formato data1, data2, formato data2, op&ccedil;&atilde;o)', 'sc_apl_conf_@#AC@#_sc_apl_conf(Aplica&ccedil;&atilde;o, Propriedade, valor)', 'sc_calc_dv_@#AC@#_sc_calc_dv(dig, resto, valor, m&oacute;dulo, pesos, tipo)', 'sc_changed_@#AC@#_sc_changed({campo})', 'sc_decode_@#AC@#_sc_decode(campo/vari&aacute;vel)', 'sc_encode_@#AC@#_sc_encode(campo/vari&aacute;vel)', 'sc_error_exit_@#AC@#_sc_error_exit(URL/Aplica&ccedil;&atilde;o)', 'sc_error_message_@#AC@#_sc_error_message(&quot;texto&quot;)', 'sc_exit_@#AC@#_sc_exit(op&ccedil;&atilde;o)', 'sc_image_@#AC@#_sc_image(img1.jpg,img2.gif,...)', 'sc_include_@#AC@#_sc_include(arquivo, origem)', 'sc_mail_send_@#AC@#_sc_mail_send(smtp, usr, pw, de, para, assunto, mensagem, tipo_mens, c&oacute;pias, tp_c&oacute;pias, porta, tp_conexao, attachment)', 'sc_redir_@#AC@#_sc_redir(apl, parm1; parm2; ..., target)', 'sc_reset_global_@#AC@#_sc_reset_global([var_glo1], [var_glo2] ...)', 'sc_set_global_@#AC@#_sc_set_global($var_1, {cmp_x}, ...)', 'sc_site_ssl_@#AC@#_sc_site_ssl', 'sc_trunc_num_@#AC@#_sc_trunc_num(campo,  qt_dec)', 'sc_url_exit_@#AC@#_sc_url_exit(url)', 'sc_warning_@#AC@#_sc_warning = \'on\'/\'off\'', 'sc_zip_file_@#AC@#_sc_zip_file(arquivos, zip)', 'sc_apl_status_@#AC@#_sc_apl_status(aplica&ccedil;&atilde;o, status)', 'sc_reset_apl_conf_@#AC@#_sc_reset_apl_conf(Aplica&ccedil;&atilde;o, Propriedade)', 'sc_reset_apl_status_@#AC@#_sc_reset_apl_status()', 'sc_block_display_@#AC@#_sc_block_display(nome do bloco, on/off)', 'sc_field_display_@#AC@#_sc_field_display({campo}, on/off)', 'sc_field_readonly_@#AC@#_sc_field_readonly({campo})', 'sc_format_num_@#AC@#_sc_format_num(campo, simb_agrup,  simb_dec, qt_dec, enche_zeros=,   lado_neg,  simb_monetario, lado_simb_monetario)', 'sc_form_show_@#AC@#_sc_form_show = \'on\'/\'off\'', 'sc_btn_display_@#AC@#_sc_btn_display(&quot;nomebotao&quot;,&quot;on/off&quot;)');
		break;

		case "form_onAfterInsert":
			$arr_wizard	= array('sc_commit_trans_@#AC@#_sc_commit_trans(&quot;conex&atilde;o&quot;)', 'sc_error_continue_@#AC@#_sc_error_continue(&quot;evento&quot;)', 'sc_error_insert_@#AC@#_{sc_error_insert}', 'sc_exec_sql_@#AC@#_sc_exec_sql(&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_lookup_@#AC@#_sc_lookup(dataset,&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_rollback_trans_@#AC@#_sc_rollback_trans(&quot;conex&atilde;o&quot;)', 'sc_select_@#AC@#_sc_select(dataset,&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_date_@#AC@#_sc_date(data, formato, operador, D, M, A)', 'sc_date_conv_@#AC@#_sc_date_conv({cmp_data}, &quot;fmt_entrada&quot;, &quot;fmt_sa&iacute;da&quot;)', 'sc_date_dif_@#AC@#_sc_date_dif(data1, formato data1, data2, formato data2)', 'sc_date_dif_2_@#AC@#_sc_date_dif_2(data1, formato data1, data2, formato data2, op&ccedil;&atilde;o)', 'sc_apl_conf_@#AC@#_sc_apl_conf(Aplica&ccedil;&atilde;o, Propriedade, valor)', 'sc_calc_dv_@#AC@#_sc_calc_dv(dig, resto, valor, m&oacute;dulo, pesos, tipo)', 'sc_changed_@#AC@#_sc_changed({campo})', 'sc_decode_@#AC@#_sc_decode(campo/vari&aacute;vel)', 'sc_encode_@#AC@#_sc_encode(campo/vari&aacute;vel)', 'sc_error_exit_@#AC@#_sc_error_exit(URL/Aplica&ccedil;&atilde;o)', 'sc_error_message_@#AC@#_sc_error_message(&quot;texto&quot;)', 'sc_exit_@#AC@#_sc_exit(op&ccedil;&atilde;o)', 'sc_include_@#AC@#_sc_include(arquivo, origem)', 'sc_mail_send_@#AC@#_sc_mail_send(smtp, usr, pw, de, para, assunto, mensagem, tipo_mens, c&oacute;pias, tp_c&oacute;pias, porta, tp_conexao, attachment)', 'sc_master_value_@#AC@#_sc_master_value(\'objeto\', valor)', 'sc_redir_@#AC@#_sc_redir(apl, parm1; parm2; ..., target)', 'sc_reset_global_@#AC@#_sc_reset_global([var_glo1], [var_glo2] ...)', 'sc_set_global_@#AC@#_sc_set_global($var_1, {cmp_x}, ...)', 'sc_site_ssl_@#AC@#_sc_site_ssl', 'sc_trunc_num_@#AC@#_sc_trunc_num(campo,  qt_dec)', 'sc_url_exit_@#AC@#_sc_url_exit(url)', 'sc_warning_@#AC@#_sc_warning = \'on\'/\'off\'', 'sc_zip_file_@#AC@#_sc_zip_file(arquivos, zip)', 'sc_apl_status_@#AC@#_sc_apl_status(aplica&ccedil;&atilde;o, status)', 'sc_reset_apl_conf_@#AC@#_sc_reset_apl_conf(Aplica&ccedil;&atilde;o, Propriedade)', 'sc_reset_apl_status_@#AC@#_sc_reset_apl_status()', 'sc_block_display_@#AC@#_sc_block_display(nome do bloco, on/off)', 'sc_field_display_@#AC@#_sc_field_display({campo}, on/off)', 'sc_field_readonly_@#AC@#_sc_field_readonly({campo})', 'sc_format_num_@#AC@#_sc_format_num(campo, simb_agrup,  simb_dec, qt_dec, enche_zeros=,   lado_neg,  simb_monetario, lado_simb_monetario)', 'sc_form_show_@#AC@#_sc_form_show = \'on\'/\'off\'', 'sc_btn_display_@#AC@#_sc_btn_display(&quot;nomebotao&quot;,&quot;on/off&quot;)');
		break;

		case "form_onAfterInsertAll":
			$arr_wizard	= array('sc_commit_trans_@#AC@#_sc_commit_trans(&quot;conex&atilde;o&quot;)', 'sc_exec_sql_@#AC@#_sc_exec_sql(&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_lookup_@#AC@#_sc_lookup(dataset,&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_rollback_trans_@#AC@#_sc_rollback_trans(&quot;conex&atilde;o&quot;)', 'sc_select_@#AC@#_sc_select(dataset,&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_date_@#AC@#_sc_date(data, formato, operador, D, M, A)', 'sc_date_conv_@#AC@#_sc_date_conv({cmp_data}, &quot;fmt_entrada&quot;, &quot;fmt_sa&iacute;da&quot;)', 'sc_date_dif_@#AC@#_sc_date_dif(data1, formato data1, data2, formato data2)', 'sc_date_dif_2_@#AC@#_sc_date_dif_2(data1, formato data1, data2, formato data2, op&ccedil;&atilde;o)', 'sc_apl_conf_@#AC@#_sc_apl_conf(Aplica&ccedil;&atilde;o, Propriedade, valor)', 'sc_calc_dv_@#AC@#_sc_calc_dv(dig, resto, valor, m&oacute;dulo, pesos, tipo)', 'sc_decode_@#AC@#_sc_decode(campo/vari&aacute;vel)', 'sc_encode_@#AC@#_sc_encode(campo/vari&aacute;vel)', 'sc_error_exit_@#AC@#_sc_error_exit(URL/Aplica&ccedil;&atilde;o)', 'sc_error_message_@#AC@#_sc_error_message(&quot;texto&quot;)', 'sc_exit_@#AC@#_sc_exit(op&ccedil;&atilde;o)', 'sc_include_@#AC@#_sc_include(arquivo, origem)', 'sc_mail_send_@#AC@#_sc_mail_send(smtp, usr, pw, de, para, assunto, mensagem, tipo_mens, c&oacute;pias, tp_c&oacute;pias, porta, tp_conexao, attachment)', 'sc_redir_@#AC@#_sc_redir(apl, parm1; parm2; ..., target)', 'sc_reset_global_@#AC@#_sc_reset_global([var_glo1], [var_glo2] ...)', 'sc_set_global_@#AC@#_sc_set_global($var_1, {cmp_x}, ...)', 'sc_site_ssl_@#AC@#_sc_site_ssl', 'sc_trunc_num_@#AC@#_sc_trunc_num(campo,  qt_dec)', 'sc_url_exit_@#AC@#_sc_url_exit(url)', 'sc_warning_@#AC@#_sc_warning = \'on\'/\'off\'', 'sc_zip_file_@#AC@#_sc_zip_file(arquivos, zip)', 'sc_apl_status_@#AC@#_sc_apl_status(aplica&ccedil;&atilde;o, status)', 'sc_reset_apl_conf_@#AC@#_sc_reset_apl_conf(Aplica&ccedil;&atilde;o, Propriedade)', 'sc_reset_apl_status_@#AC@#_sc_reset_apl_status()', 'sc_block_display_@#AC@#_sc_block_display(nome do bloco, on/off)', 'sc_field_display_@#AC@#_sc_field_display({campo}, on/off)', 'sc_field_readonly_@#AC@#_sc_field_readonly({campo})', 'sc_format_num_@#AC@#_sc_format_num(campo, simb_agrup,  simb_dec, qt_dec, enche_zeros=,   lado_neg,  simb_monetario, lado_simb_monetario)', 'sc_form_show_@#AC@#_sc_form_show = \'on\'/\'off\'', 'sc_btn_display_@#AC@#_sc_btn_display(&quot;nomebotao&quot;,&quot;on/off&quot;)');
		break;

		case "form_onAfterUpdate":
			$arr_wizard	= array('sc_commit_trans_@#AC@#_sc_commit_trans(&quot;conex&atilde;o&quot;)', 'sc_error_continue_@#AC@#_sc_error_continue(&quot;evento&quot;)', 'sc_error_update_@#AC@#_{sc_error_update}', 'sc_exec_sql_@#AC@#_sc_exec_sql(&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_lookup_@#AC@#_sc_lookup(dataset,&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_rollback_trans_@#AC@#_sc_rollback_trans(&quot;conex&atilde;o&quot;)', 'sc_select_@#AC@#_sc_select(dataset,&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_date_@#AC@#_sc_date(data, formato, operador, D, M, A)', 'sc_date_conv_@#AC@#_sc_date_conv({cmp_data}, &quot;fmt_entrada&quot;, &quot;fmt_sa&iacute;da&quot;)', 'sc_date_dif_@#AC@#_sc_date_dif(data1, formato data1, data2, formato data2)', 'sc_date_dif_2_@#AC@#_sc_date_dif_2(data1, formato data1, data2, formato data2, op&ccedil;&atilde;o)', 'sc_apl_conf_@#AC@#_sc_apl_conf(Aplica&ccedil;&atilde;o, Propriedade, valor)', 'sc_calc_dv_@#AC@#_sc_calc_dv(dig, resto, valor, m&oacute;dulo, pesos, tipo)', 'sc_changed_@#AC@#_sc_changed({campo})', 'sc_decode_@#AC@#_sc_decode(campo/vari&aacute;vel)', 'sc_encode_@#AC@#_sc_encode(campo/vari&aacute;vel)', 'sc_error_exit_@#AC@#_sc_error_exit(URL/Aplica&ccedil;&atilde;o)', 'sc_error_message_@#AC@#_sc_error_message(&quot;texto&quot;)', 'sc_exit_@#AC@#_sc_exit(op&ccedil;&atilde;o)', 'sc_include_@#AC@#_sc_include(arquivo, origem)', 'sc_mail_send_@#AC@#_sc_mail_send(smtp, usr, pw, de, para, assunto, mensagem, tipo_mens, c&oacute;pias, tp_c&oacute;pias, porta, tp_conexao, attachment)', 'sc_master_value_@#AC@#_sc_master_value(\'objeto\', valor)', 'sc_redir_@#AC@#_sc_redir(apl, parm1; parm2; ..., target)', 'sc_reset_global_@#AC@#_sc_reset_global([var_glo1], [var_glo2] ...)', 'sc_set_global_@#AC@#_sc_set_global($var_1, {cmp_x}, ...)', 'sc_site_ssl_@#AC@#_sc_site_ssl', 'sc_trunc_num_@#AC@#_sc_trunc_num(campo,  qt_dec)', 'sc_url_exit_@#AC@#_sc_url_exit(url)', 'sc_warning_@#AC@#_sc_warning = \'on\'/\'off\'', 'sc_zip_file_@#AC@#_sc_zip_file(arquivos, zip)', 'sc_apl_status_@#AC@#_sc_apl_status(aplica&ccedil;&atilde;o, status)', 'sc_reset_apl_conf_@#AC@#_sc_reset_apl_conf(Aplica&ccedil;&atilde;o, Propriedade)', 'sc_reset_apl_status_@#AC@#_sc_reset_apl_status()', 'sc_block_display_@#AC@#_sc_block_display(nome do bloco, on/off)', 'sc_field_display_@#AC@#_sc_field_display({campo}, on/off)', 'sc_field_readonly_@#AC@#_sc_field_readonly({campo})', 'sc_format_num_@#AC@#_sc_format_num(campo, simb_agrup,  simb_dec, qt_dec, enche_zeros=,   lado_neg,  simb_monetario, lado_simb_monetario)', 'sc_form_show_@#AC@#_sc_form_show = \'on\'/\'off\'', 'sc_btn_display_@#AC@#_sc_btn_display(&quot;nomebotao&quot;,&quot;on/off&quot;)');
		break;

		case "form_onAfterUpdateAll":
			$arr_wizard	= array('sc_begin_trans_@#AC@#_sc_begin_trans(&quot;conex&atilde;o&quot;)', 'sc_commit_trans_@#AC@#_sc_commit_trans(&quot;conex&atilde;o&quot;)', 'sc_exec_sql_@#AC@#_sc_exec_sql(&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_lookup_@#AC@#_sc_lookup(dataset,&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_rollback_trans_@#AC@#_sc_rollback_trans(&quot;conex&atilde;o&quot;)', 'sc_select_@#AC@#_sc_select(dataset,&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_date_@#AC@#_sc_date(data, formato, operador, D, M, A)', 'sc_date_conv_@#AC@#_sc_date_conv({cmp_data}, &quot;fmt_entrada&quot;, &quot;fmt_sa&iacute;da&quot;)', 'sc_date_dif_@#AC@#_sc_date_dif(data1, formato data1, data2, formato data2)', 'sc_date_dif_2_@#AC@#_sc_date_dif_2(data1, formato data1, data2, formato data2, op&ccedil;&atilde;o)', 'sc_apl_conf_@#AC@#_sc_apl_conf(Aplica&ccedil;&atilde;o, Propriedade, valor)', 'sc_calc_dv_@#AC@#_sc_calc_dv(dig, resto, valor, m&oacute;dulo, pesos, tipo)', 'sc_decode_@#AC@#_sc_decode(campo/vari&aacute;vel)', 'sc_encode_@#AC@#_sc_encode(campo/vari&aacute;vel)', 'sc_error_exit_@#AC@#_sc_error_exit(URL/Aplica&ccedil;&atilde;o)', 'sc_error_message_@#AC@#_sc_error_message(&quot;texto&quot;)', 'sc_exit_@#AC@#_sc_exit(op&ccedil;&atilde;o)', 'sc_include_@#AC@#_sc_include(arquivo, origem)', 'sc_mail_send_@#AC@#_sc_mail_send(smtp, usr, pw, de, para, assunto, mensagem, tipo_mens, c&oacute;pias, tp_c&oacute;pias, porta, tp_conexao, attachment)', 'sc_redir_@#AC@#_sc_redir(apl, parm1; parm2; ..., target)', 'sc_reset_global_@#AC@#_sc_reset_global([var_glo1], [var_glo2] ...)', 'sc_set_global_@#AC@#_sc_set_global($var_1, {cmp_x}, ...)', 'sc_site_ssl_@#AC@#_sc_site_ssl', 'sc_trunc_num_@#AC@#_sc_trunc_num(campo,  qt_dec)', 'sc_url_exit_@#AC@#_sc_url_exit(url)', 'sc_warning_@#AC@#_sc_warning = \'on\'/\'off\'', 'sc_zip_file_@#AC@#_sc_zip_file(arquivos, zip)', 'sc_apl_status_@#AC@#_sc_apl_status(aplica&ccedil;&atilde;o, status)', 'sc_reset_apl_conf_@#AC@#_sc_reset_apl_conf(Aplica&ccedil;&atilde;o, Propriedade)', 'sc_reset_apl_status_@#AC@#_sc_reset_apl_status()', 'sc_block_display_@#AC@#_sc_block_display(nome do bloco, on/off)', 'sc_field_display_@#AC@#_sc_field_display({campo}, on/off)', 'sc_field_readonly_@#AC@#_sc_field_readonly({campo})', 'sc_format_num_@#AC@#_sc_format_num(campo, simb_agrup,  simb_dec, qt_dec, enche_zeros=,   lado_neg,  simb_monetario, lado_simb_monetario)', 'sc_form_show_@#AC@#_sc_form_show = \'on\'/\'off\'', 'sc_btn_display_@#AC@#_sc_btn_display(&quot;nomebotao&quot;,&quot;on/off&quot;)');
		break;

		case "form_onBeforeDelete":
			$arr_wizard	= array('sc_error_continue_@#AC@#_sc_error_continue(&quot;evento&quot;)', 'sc_error_delete_@#AC@#_{sc_error_delete}', 'sc_exec_sql_@#AC@#_sc_exec_sql(&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_lookup_@#AC@#_sc_lookup(dataset,&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_select_@#AC@#_sc_select(dataset,&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_sql_injection_@#AC@#_sc_sql_injection(campo/vari&aacute;vel)', 'sc_date_@#AC@#_sc_date(data, formato, operador, D, M, A)', 'sc_date_conv_@#AC@#_sc_date_conv({cmp_data}, &quot;fmt_entrada&quot;, &quot;fmt_sa&iacute;da&quot;)', 'sc_date_dif_@#AC@#_sc_date_dif(data1, formato data1, data2, formato data2)', 'sc_date_dif_2_@#AC@#_sc_date_dif_2(data1, formato data1, data2, formato data2, op&ccedil;&atilde;o)', 'sc_apl_conf_@#AC@#_sc_apl_conf(Aplica&ccedil;&atilde;o, Propriedade, valor)', 'sc_calc_dv_@#AC@#_sc_calc_dv(dig, resto, valor, m&oacute;dulo, pesos, tipo)', 'sc_changed_@#AC@#_sc_changed({campo})', 'sc_decode_@#AC@#_sc_decode(campo/vari&aacute;vel)', 'sc_encode_@#AC@#_sc_encode(campo/vari&aacute;vel)', 'sc_error_exit_@#AC@#_sc_error_exit(URL/Aplica&ccedil;&atilde;o)', 'sc_error_message_@#AC@#_sc_error_message(&quot;texto&quot;)', 'sc_exit_@#AC@#_sc_exit(op&ccedil;&atilde;o)', 'sc_include_@#AC@#_sc_include(arquivo, origem)', 'sc_mail_send_@#AC@#_sc_mail_send(smtp, usr, pw, de, para, assunto, mensagem, tipo_mens, c&oacute;pias, tp_c&oacute;pias, porta, tp_conexao, attachment)', 'sc_master_value_@#AC@#_sc_master_value(\'objeto\', valor)', 'sc_redir_@#AC@#_sc_redir(apl, parm1; parm2; ..., target)', 'sc_reset_global_@#AC@#_sc_reset_global([var_glo1], [var_glo2] ...)', 'sc_set_global_@#AC@#_sc_set_global($var_1, {cmp_x}, ...)', 'sc_site_ssl_@#AC@#_sc_site_ssl', 'sc_trunc_num_@#AC@#_sc_trunc_num(campo,  qt_dec)', 'sc_url_exit_@#AC@#_sc_url_exit(url)', 'sc_warning_@#AC@#_sc_warning = \'on\'/\'off\'', 'sc_zip_file_@#AC@#_sc_zip_file(arquivos, zip)', 'sc_apl_status_@#AC@#_sc_apl_status(aplica&ccedil;&atilde;o, status)', 'sc_reset_apl_conf_@#AC@#_sc_reset_apl_conf(Aplica&ccedil;&atilde;o, Propriedade)', 'sc_reset_apl_status_@#AC@#_sc_reset_apl_status()', 'sc_block_display_@#AC@#_sc_block_display(nome do bloco, on/off)', 'sc_field_display_@#AC@#_sc_field_display({campo}, on/off)', 'sc_field_readonly_@#AC@#_sc_field_readonly({campo})', 'sc_format_num_@#AC@#_sc_format_num(campo, simb_agrup,  simb_dec, qt_dec, enche_zeros=,   lado_neg,  simb_monetario, lado_simb_monetario)', 'sc_form_show_@#AC@#_sc_form_show = \'on\'/\'off\'', 'sc_btn_display_@#AC@#_sc_btn_display(&quot;nomebotao&quot;,&quot;on/off&quot;)');
		break;

		case "form_onBeforeDelete_All":
			$arr_wizard	= array('sc_exec_sql_@#AC@#_sc_exec_sql(&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_lookup_@#AC@#_sc_lookup(dataset,&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_select_@#AC@#_sc_select(dataset,&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_date_@#AC@#_sc_date(data, formato, operador, D, M, A)', 'sc_date_conv_@#AC@#_sc_date_conv({cmp_data}, &quot;fmt_entrada&quot;, &quot;fmt_sa&iacute;da&quot;)', 'sc_date_dif_@#AC@#_sc_date_dif(data1, formato data1, data2, formato data2)', 'sc_date_dif_2_@#AC@#_sc_date_dif_2(data1, formato data1, data2, formato data2, op&ccedil;&atilde;o)', 'sc_apl_conf_@#AC@#_sc_apl_conf(Aplica&ccedil;&atilde;o, Propriedade, valor)', 'sc_calc_dv_@#AC@#_sc_calc_dv(dig, resto, valor, m&oacute;dulo, pesos, tipo)', 'sc_decode_@#AC@#_sc_decode(campo/vari&aacute;vel)', 'sc_encode_@#AC@#_sc_encode(campo/vari&aacute;vel)', 'sc_error_exit_@#AC@#_sc_error_exit(URL/Aplica&ccedil;&atilde;o)', 'sc_error_message_@#AC@#_sc_error_message(&quot;texto&quot;)', 'sc_exit_@#AC@#_sc_exit(op&ccedil;&atilde;o)', 'sc_include_@#AC@#_sc_include(arquivo, origem)', 'sc_mail_send_@#AC@#_sc_mail_send(smtp, usr, pw, de, para, assunto, mensagem, tipo_mens, c&oacute;pias, tp_c&oacute;pias, porta, tp_conexao, attachment)', 'sc_redir_@#AC@#_sc_redir(apl, parm1; parm2; ..., target)', 'sc_reset_global_@#AC@#_sc_reset_global([var_glo1], [var_glo2] ...)', 'sc_set_global_@#AC@#_sc_set_global($var_1, {cmp_x}, ...)', 'sc_site_ssl_@#AC@#_sc_site_ssl', 'sc_trunc_num_@#AC@#_sc_trunc_num(campo,  qt_dec)', 'sc_url_exit_@#AC@#_sc_url_exit(url)', 'sc_warning_@#AC@#_sc_warning = \'on\'/\'off\'', 'sc_zip_file_@#AC@#_sc_zip_file(arquivos, zip)', 'sc_apl_status_@#AC@#_sc_apl_status(aplica&ccedil;&atilde;o, status)', 'sc_reset_apl_conf_@#AC@#_sc_reset_apl_conf(Aplica&ccedil;&atilde;o, Propriedade)', 'sc_reset_apl_status_@#AC@#_sc_reset_apl_status()', 'sc_block_display_@#AC@#_sc_block_display(nome do bloco, on/off)', 'sc_field_display_@#AC@#_sc_field_display({campo}, on/off)', 'sc_field_readonly_@#AC@#_sc_field_readonly({campo})', 'sc_format_num_@#AC@#_sc_format_num(campo, simb_agrup,  simb_dec, qt_dec, enche_zeros=,   lado_neg,  simb_monetario, lado_simb_monetario)', 'sc_form_show_@#AC@#_sc_form_show = \'on\'/\'off\'', 'sc_btn_display_@#AC@#_sc_btn_display(&quot;nomebotao&quot;,&quot;on/off&quot;)');
		break;

		case "form_onBeforeInsert":
			$arr_wizard	= array('sc_error_continue_@#AC@#_sc_error_continue(&quot;evento&quot;)', 'sc_error_insert_@#AC@#_{sc_error_insert}', 'sc_exec_sql_@#AC@#_sc_exec_sql(&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_lookup_@#AC@#_sc_lookup(dataset,&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_select_@#AC@#_sc_select(dataset,&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_date_@#AC@#_sc_date(data, formato, operador, D, M, A)', 'sc_date_conv_@#AC@#_sc_date_conv({cmp_data}, &quot;fmt_entrada&quot;, &quot;fmt_sa&iacute;da&quot;)', 'sc_date_dif_@#AC@#_sc_date_dif(data1, formato data1, data2, formato data2)', 'sc_date_dif_2_@#AC@#_sc_date_dif_2(data1, formato data1, data2, formato data2, op&ccedil;&atilde;o)', 'sc_apl_conf_@#AC@#_sc_apl_conf(Aplica&ccedil;&atilde;o, Propriedade, valor)', 'sc_calc_dv_@#AC@#_sc_calc_dv(dig, resto, valor, m&oacute;dulo, pesos, tipo)', 'sc_changed_@#AC@#_sc_changed({campo})', 'sc_decode_@#AC@#_sc_decode(campo/vari&aacute;vel)', 'sc_encode_@#AC@#_sc_encode(campo/vari&aacute;vel)', 'sc_error_exit_@#AC@#_sc_error_exit(URL/Aplica&ccedil;&atilde;o)', 'sc_error_message_@#AC@#_sc_error_message(&quot;texto&quot;)', 'sc_exit_@#AC@#_sc_exit(op&ccedil;&atilde;o)', 'sc_include_@#AC@#_sc_include(arquivo, origem)', 'sc_mail_send_@#AC@#_sc_mail_send(smtp, usr, pw, de, para, assunto, mensagem, tipo_mens, c&oacute;pias, tp_c&oacute;pias, porta, tp_conexao, attachment)', 'sc_master_value_@#AC@#_sc_master_value(\'objeto\', valor)', 'sc_redir_@#AC@#_sc_redir(apl, parm1; parm2; ..., target)', 'sc_reset_global_@#AC@#_sc_reset_global([var_glo1], [var_glo2] ...)', 'sc_set_global_@#AC@#_sc_set_global($var_1, {cmp_x}, ...)', 'sc_site_ssl_@#AC@#_sc_site_ssl', 'sc_trunc_num_@#AC@#_sc_trunc_num(campo,  qt_dec)', 'sc_url_exit_@#AC@#_sc_url_exit(url)', 'sc_warning_@#AC@#_sc_warning = \'on\'/\'off\'', 'sc_zip_file_@#AC@#_sc_zip_file(arquivos, zip)', 'sc_apl_status_@#AC@#_sc_apl_status(aplica&ccedil;&atilde;o, status)', 'sc_reset_apl_conf_@#AC@#_sc_reset_apl_conf(Aplica&ccedil;&atilde;o, Propriedade)', 'sc_reset_apl_status_@#AC@#_sc_reset_apl_status()', 'sc_block_display_@#AC@#_sc_block_display(nome do bloco, on/off)', 'sc_field_display_@#AC@#_sc_field_display({campo}, on/off)', 'sc_field_readonly_@#AC@#_sc_field_readonly({campo})', 'sc_format_num_@#AC@#_sc_format_num(campo, simb_agrup,  simb_dec, qt_dec, enche_zeros=,   lado_neg,  simb_monetario, lado_simb_monetario)', 'sc_form_show_@#AC@#_sc_form_show = \'on\'/\'off\'', 'sc_btn_display_@#AC@#_sc_btn_display(&quot;nomebotao&quot;,&quot;on/off&quot;)');
		break;

		case "form_onBeforeInsertAll":
			$arr_wizard	= array('sc_begin_trans_@#AC@#_sc_begin_trans(&quot;conex&atilde;o&quot;)', 'sc_exec_sql_@#AC@#_sc_exec_sql(&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_lookup_@#AC@#_sc_lookup(dataset,&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_select_@#AC@#_sc_select(dataset,&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_date_@#AC@#_sc_date(data, formato, operador, D, M, A)', 'sc_date_conv_@#AC@#_sc_date_conv({cmp_data}, &quot;fmt_entrada&quot;, &quot;fmt_sa&iacute;da&quot;)', 'sc_date_dif_@#AC@#_sc_date_dif(data1, formato data1, data2, formato data2)', 'sc_date_dif_2_@#AC@#_sc_date_dif_2(data1, formato data1, data2, formato data2, op&ccedil;&atilde;o)', 'sc_apl_conf_@#AC@#_sc_apl_conf(Aplica&ccedil;&atilde;o, Propriedade, valor)', 'sc_calc_dv_@#AC@#_sc_calc_dv(dig, resto, valor, m&oacute;dulo, pesos, tipo)', 'sc_decode_@#AC@#_sc_decode(campo/vari&aacute;vel)', 'sc_encode_@#AC@#_sc_encode(campo/vari&aacute;vel)', 'sc_error_exit_@#AC@#_sc_error_exit(URL/Aplica&ccedil;&atilde;o)', 'sc_error_message_@#AC@#_sc_error_message(&quot;texto&quot;)', 'sc_exit_@#AC@#_sc_exit(op&ccedil;&atilde;o)', 'sc_include_@#AC@#_sc_include(arquivo, origem)', 'sc_mail_send_@#AC@#_sc_mail_send(smtp, usr, pw, de, para, assunto, mensagem, tipo_mens, c&oacute;pias, tp_c&oacute;pias, porta, tp_conexao, attachment)', 'sc_redir_@#AC@#_sc_redir(apl, parm1; parm2; ..., target)', 'sc_reset_global_@#AC@#_sc_reset_global([var_glo1], [var_glo2] ...)', 'sc_set_global_@#AC@#_sc_set_global($var_1, {cmp_x}, ...)', 'sc_site_ssl_@#AC@#_sc_site_ssl', 'sc_trunc_num_@#AC@#_sc_trunc_num(campo,  qt_dec)', 'sc_url_exit_@#AC@#_sc_url_exit(url)', 'sc_warning_@#AC@#_sc_warning = \'on\'/\'off\'', 'sc_zip_file_@#AC@#_sc_zip_file(arquivos, zip)', 'sc_apl_status_@#AC@#_sc_apl_status(aplica&ccedil;&atilde;o, status)', 'sc_reset_apl_conf_@#AC@#_sc_reset_apl_conf(Aplica&ccedil;&atilde;o, Propriedade)', 'sc_reset_apl_status_@#AC@#_sc_reset_apl_status()', 'sc_block_display_@#AC@#_sc_block_display(nome do bloco, on/off)', 'sc_field_display_@#AC@#_sc_field_display({campo}, on/off)', 'sc_field_readonly_@#AC@#_sc_field_readonly({campo})', 'sc_format_num_@#AC@#_sc_format_num(campo, simb_agrup,  simb_dec, qt_dec, enche_zeros=,   lado_neg,  simb_monetario, lado_simb_monetario)', 'sc_form_show_@#AC@#_sc_form_show = \'on\'/\'off\'', 'sc_btn_display_@#AC@#_sc_btn_display(&quot;nomebotao&quot;,&quot;on/off&quot;)');
		break;

		case "form_onBeforeUpdate":
			$arr_wizard	= array('sc_error_continue_@#AC@#_sc_error_continue(&quot;evento&quot;)', 'sc_error_update_@#AC@#_{sc_error_update}', 'sc_exec_sql_@#AC@#_sc_exec_sql(&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_lookup_@#AC@#_sc_lookup(dataset,&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_select_@#AC@#_sc_select(dataset,&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_date_@#AC@#_sc_date(data, formato, operador, D, M, A)', 'sc_date_conv_@#AC@#_sc_date_conv({cmp_data}, &quot;fmt_entrada&quot;, &quot;fmt_sa&iacute;da&quot;)', 'sc_date_dif_@#AC@#_sc_date_dif(data1, formato data1, data2, formato data2)', 'sc_date_dif_2_@#AC@#_sc_date_dif_2(data1, formato data1, data2, formato data2, op&ccedil;&atilde;o)', 'sc_apl_conf_@#AC@#_sc_apl_conf(Aplica&ccedil;&atilde;o, Propriedade, valor)', 'sc_calc_dv_@#AC@#_sc_calc_dv(dig, resto, valor, m&oacute;dulo, pesos, tipo)', 'sc_decode_@#AC@#_sc_decode(campo/vari&aacute;vel)', 'sc_encode_@#AC@#_sc_encode(campo/vari&aacute;vel)', 'sc_error_exit_@#AC@#_sc_error_exit(URL/Aplica&ccedil;&atilde;o)', 'sc_error_message_@#AC@#_sc_error_message(&quot;texto&quot;)', 'sc_exit_@#AC@#_sc_exit(op&ccedil;&atilde;o)', 'sc_include_@#AC@#_sc_include(arquivo, origem)', 'sc_mail_send_@#AC@#_sc_mail_send(smtp, usr, pw, de, para, assunto, mensagem, tipo_mens, c&oacute;pias, tp_c&oacute;pias, porta, tp_conexao, attachment)', 'sc_master_value_@#AC@#_sc_master_value(\'objeto\', valor)', 'sc_redir_@#AC@#_sc_redir(apl, parm1; parm2; ..., target)', 'sc_reset_global_@#AC@#_sc_reset_global([var_glo1], [var_glo2] ...)', 'sc_set_global_@#AC@#_sc_set_global($var_1, {cmp_x}, ...)', 'sc_site_ssl_@#AC@#_sc_site_ssl', 'sc_trunc_num_@#AC@#_sc_trunc_num(campo,  qt_dec)', 'sc_url_exit_@#AC@#_sc_url_exit(url)', 'sc_warning_@#AC@#_sc_warning = \'on\'/\'off\'', 'sc_zip_file_@#AC@#_sc_zip_file(arquivos, zip)', 'sc_apl_status_@#AC@#_sc_apl_status(aplica&ccedil;&atilde;o, status)', 'sc_reset_apl_conf_@#AC@#_sc_reset_apl_conf(Aplica&ccedil;&atilde;o, Propriedade)', 'sc_reset_apl_status_@#AC@#_sc_reset_apl_status()', 'sc_block_display_@#AC@#_sc_block_display(nome do bloco, on/off)', 'sc_field_display_@#AC@#_sc_field_display({campo}, on/off)', 'sc_field_readonly_@#AC@#_sc_field_readonly({campo})', 'sc_format_num_@#AC@#_sc_format_num(campo, simb_agrup,  simb_dec, qt_dec, enche_zeros=,   lado_neg,  simb_monetario, lado_simb_monetario)', 'sc_form_show_@#AC@#_sc_form_show = \'on\'/\'off\'', 'sc_btn_display_@#AC@#_sc_btn_display(&quot;nomebotao&quot;,&quot;on/off&quot;)');
		break;

		case "form_onBeforeUpdateall":
			$arr_wizard	= array('sc_begin_trans_@#AC@#_sc_begin_trans(&quot;conex&atilde;o&quot;)', 'sc_exec_sql_@#AC@#_sc_exec_sql(&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_lookup_@#AC@#_sc_lookup(dataset,&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_select_@#AC@#_sc_select(dataset,&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_date_@#AC@#_sc_date(data, formato, operador, D, M, A)', 'sc_date_conv_@#AC@#_sc_date_conv({cmp_data}, &quot;fmt_entrada&quot;, &quot;fmt_sa&iacute;da&quot;)', 'sc_date_dif_@#AC@#_sc_date_dif(data1, formato data1, data2, formato data2)', 'sc_date_dif_2_@#AC@#_sc_date_dif_2(data1, formato data1, data2, formato data2, op&ccedil;&atilde;o)', 'sc_apl_conf_@#AC@#_sc_apl_conf(Aplica&ccedil;&atilde;o, Propriedade, valor)', 'sc_calc_dv_@#AC@#_sc_calc_dv(dig, resto, valor, m&oacute;dulo, pesos, tipo)', 'sc_decode_@#AC@#_sc_decode(campo/vari&aacute;vel)', 'sc_encode_@#AC@#_sc_encode(campo/vari&aacute;vel)', 'sc_error_exit_@#AC@#_sc_error_exit(URL/Aplica&ccedil;&atilde;o)', 'sc_error_message_@#AC@#_sc_error_message(&quot;texto&quot;)', 'sc_exit_@#AC@#_sc_exit(op&ccedil;&atilde;o)', 'sc_include_@#AC@#_sc_include(arquivo, origem)', 'sc_mail_send_@#AC@#_sc_mail_send(smtp, usr, pw, de, para, assunto, mensagem, tipo_mens, c&oacute;pias, tp_c&oacute;pias, porta, tp_conexao, attachment)', 'sc_redir_@#AC@#_sc_redir(apl, parm1; parm2; ..., target)', 'sc_reset_global_@#AC@#_sc_reset_global([var_glo1], [var_glo2] ...)', 'sc_set_global_@#AC@#_sc_set_global($var_1, {cmp_x}, ...)', 'sc_site_ssl_@#AC@#_sc_site_ssl', 'sc_trunc_num_@#AC@#_sc_trunc_num(campo,  qt_dec)', 'sc_url_exit_@#AC@#_sc_url_exit(url)', 'sc_warning_@#AC@#_sc_warning = \'on\'/\'off\'', 'sc_zip_file_@#AC@#_sc_zip_file(arquivos, zip)', 'sc_apl_status_@#AC@#_sc_apl_status(aplica&ccedil;&atilde;o, status)', 'sc_reset_apl_conf_@#AC@#_sc_reset_apl_conf(Aplica&ccedil;&atilde;o, Propriedade)', 'sc_reset_apl_status_@#AC@#_sc_reset_apl_status()', 'sc_block_display_@#AC@#_sc_block_display(nome do bloco, on/off)', 'sc_field_display_@#AC@#_sc_field_display({campo}, on/off)', 'sc_field_readonly_@#AC@#_sc_field_readonly({campo})', 'sc_format_num_@#AC@#_sc_format_num(campo, simb_agrup,  simb_dec, qt_dec, enche_zeros=,   lado_neg,  simb_monetario, lado_simb_monetario)', 'sc_form_show_@#AC@#_sc_form_show = \'on\'/\'off\'', 'sc_btn_display_@#AC@#_sc_btn_display(&quot;nomebotao&quot;,&quot;on/off&quot;)');
		break;

		case "form_onButtonClick":
			$arr_wizard	= array('sc_begin_trans_@#AC@#_sc_begin_trans(&quot;conex&atilde;o&quot;)', 'sc_commit_trans_@#AC@#_sc_commit_trans(&quot;conex&atilde;o&quot;)', 'sc_exec_sql_@#AC@#_sc_exec_sql(&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_lookup_@#AC@#_sc_lookup(dataset,&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_rollback_trans_@#AC@#_sc_rollback_trans(&quot;conex&atilde;o&quot;)', 'sc_select_@#AC@#_sc_select(dataset,&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_date_@#AC@#_sc_date(data, formato, operador, D, M, A)', 'sc_date_conv_@#AC@#_sc_date_conv({cmp_data}, &quot;fmt_entrada&quot;, &quot;fmt_sa&iacute;da&quot;)', 'sc_date_dif_@#AC@#_sc_date_dif(data1, formato data1, data2, formato data2)', 'sc_date_dif_2_@#AC@#_sc_date_dif_2(data1, formato data1, data2, formato data2, op&ccedil;&atilde;o)', 'sc_apl_conf_@#AC@#_sc_apl_conf(Aplica&ccedil;&atilde;o, Propriedade, valor)', 'sc_calc_dv_@#AC@#_sc_calc_dv(dig, resto, valor, m&oacute;dulo, pesos, tipo)', 'sc_confirm_@#AC@#_sc_confirm(&quot;mensagem&quot;)', 'sc_decode_@#AC@#_sc_decode(campo/vari&aacute;vel)', 'sc_encode_@#AC@#_sc_encode(campo/vari&aacute;vel)', 'sc_error_exit_@#AC@#_sc_error_exit(URL/Aplica&ccedil;&atilde;o)', 'sc_exit_@#AC@#_sc_exit(op&ccedil;&atilde;o)', 'sc_include_@#AC@#_sc_include(arquivo, origem)', 'sc_mail_send_@#AC@#_sc_mail_send(smtp, usr, pw, de, para, assunto, mensagem, tipo_mens, c&oacute;pias, tp_c&oacute;pias, porta, tp_conexao, attachment)', 'sc_master_value_@#AC@#_sc_master_value(\'objeto\', valor)', 'sc_redir_@#AC@#_sc_redir(apl, parm1; parm2; ..., target)', 'sc_reset_global_@#AC@#_sc_reset_global([var_glo1], [var_glo2] ...)', 'sc_set_global_@#AC@#_sc_set_global($var_1, {cmp_x}, ...)', 'sc_site_ssl_@#AC@#_sc_site_ssl', 'sc_trunc_num_@#AC@#_sc_trunc_num(campo,  qt_dec)', 'sc_url_exit_@#AC@#_sc_url_exit(url)', 'sc_warning_@#AC@#_sc_warning = \'on\'/\'off\'', 'sc_zip_file_@#AC@#_sc_zip_file(arquivos, zip)', 'sc_apl_status_@#AC@#_sc_apl_status(aplica&ccedil;&atilde;o, status)', 'sc_reset_apl_conf_@#AC@#_sc_reset_apl_conf(Aplica&ccedil;&atilde;o, Propriedade)', 'sc_reset_apl_status_@#AC@#_sc_reset_apl_status()', 'sc_format_num_@#AC@#_sc_format_num(campo, simb_agrup,  simb_dec, qt_dec, enche_zeros=,   lado_neg,  simb_monetario, lado_simb_monetario)');
		break;

		case "form_onScriptInit":
			$arr_wizard	= array('sc_begin_trans_@#AC@#_sc_begin_trans(&quot;conex&atilde;o&quot;)', 'sc_commit_trans_@#AC@#_sc_commit_trans(&quot;conex&atilde;o&quot;)', 'sc_exec_sql_@#AC@#_sc_exec_sql(&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_lookup_@#AC@#_sc_lookup(dataset,&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_rollback_trans_@#AC@#_sc_rollback_trans(&quot;conex&atilde;o&quot;)', 'sc_select_@#AC@#_sc_select(dataset,&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_date_@#AC@#_sc_date(data, formato, operador, D, M, A)', 'sc_date_conv_@#AC@#_sc_date_conv({cmp_data}, &quot;fmt_entrada&quot;, &quot;fmt_sa&iacute;da&quot;)', 'sc_date_dif_@#AC@#_sc_date_dif(data1, formato data1, data2, formato data2)', 'sc_date_dif_2_@#AC@#_sc_date_dif_2(data1, formato data1, data2, formato data2, op&ccedil;&atilde;o)', 'sc_date_empty_@#AC@#_sc_date_empty({campo_data})', 'sc_alert_@#AC@#_sc_alert(&quot;mensagem&quot;)', 'sc_apl_conf_@#AC@#_sc_apl_conf(Aplica&ccedil;&atilde;o, Propriedade, valor)', 'sc_calc_dv_@#AC@#_sc_calc_dv(dig, resto, valor, m&oacute;dulo, pesos, tipo)', 'sc_decode_@#AC@#_sc_decode(campo/vari&aacute;vel)', 'sc_encode_@#AC@#_sc_encode(campo/vari&aacute;vel)', 'sc_error_exit_@#AC@#_sc_error_exit(URL/Aplica&ccedil;&atilde;o)', 'sc_error_message_@#AC@#_sc_error_message(&quot;texto&quot;)', 'sc_exit_@#AC@#_sc_exit(op&ccedil;&atilde;o)', 'sc_image_@#AC@#_sc_image(img1.jpg,img2.gif,...)', 'sc_include_@#AC@#_sc_include(arquivo, origem)', 'sc_label_@#AC@#_sc_label(campo)', 'sc_mail_send_@#AC@#_sc_mail_send(smtp, usr, pw, de, para, assunto, mensagem, tipo_mens, c&oacute;pias, tp_c&oacute;pias, porta, tp_conexao, attachment)', 'sc_master_value_@#AC@#_sc_master_value(\'objeto\', valor)', 'sc_redir_@#AC@#_sc_redir(apl, parm1; parm2; ..., target)', 'sc_reset_global_@#AC@#_sc_reset_global([var_glo1], [var_glo2] ...)', 'sc_set_global_@#AC@#_sc_set_global($var_1, {cmp_x}, ...)', 'sc_site_ssl_@#AC@#_sc_site_ssl', 'sc_trunc_num_@#AC@#_sc_trunc_num(campo,  qt_dec)', 'sc_url_exit_@#AC@#_sc_url_exit(url)', 'sc_warning_@#AC@#_sc_warning = \'on\'/\'off\'', 'sc_zip_file_@#AC@#_sc_zip_file(arquivos, zip)', 'sc_apl_status_@#AC@#_sc_apl_status(aplica&ccedil;&atilde;o, status)', 'sc_reset_apl_conf_@#AC@#_sc_reset_apl_conf(Aplica&ccedil;&atilde;o, Propriedade)', 'sc_reset_apl_status_@#AC@#_sc_reset_apl_status()', 'sc_block_display_@#AC@#_sc_block_display(nome do bloco, on/off)', 'sc_field_display_@#AC@#_sc_field_display({campo}, on/off)', 'sc_field_readonly_@#AC@#_sc_field_readonly({campo})', 'sc_format_num_@#AC@#_sc_format_num(campo, simb_agrup,  simb_dec, qt_dec, enche_zeros=,   lado_neg,  simb_monetario, lado_simb_monetario)', 'sc_form_show_@#AC@#_sc_form_show = \'on\'/\'off\'', 'sc_btn_delete_@#AC@#_sc_btn_delete', 'sc_btn_display_@#AC@#_sc_btn_display(&quot;nomebotao&quot;,&quot;on/off&quot;)', 'sc_btn_insert_@#AC@#_sc_btn_insert', 'sc_btn_new_@#AC@#_sc_btn_new', 'sc_btn_update_@#AC@#_sc_btn_update');
		break;

		case "form_onLoadAll":
			$arr_wizard	= array('sc_begin_trans_@#AC@#_sc_begin_trans(&quot;conex&atilde;o&quot;)', 'sc_commit_trans_@#AC@#_sc_commit_trans(&quot;conex&atilde;o&quot;)', 'sc_exec_sql_@#AC@#_sc_exec_sql(&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_lookup_@#AC@#_sc_lookup(dataset,&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_rollback_trans_@#AC@#_sc_rollback_trans(&quot;conex&atilde;o&quot;)', 'sc_select_@#AC@#_sc_select(dataset,&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_date_@#AC@#_sc_date(data, formato, operador, D, M, A)', 'sc_date_conv_@#AC@#_sc_date_conv({cmp_data}, &quot;fmt_entrada&quot;, &quot;fmt_sa&iacute;da&quot;)', 'sc_date_dif_@#AC@#_sc_date_dif(data1, formato data1, data2, formato data2)', 'sc_date_dif_2_@#AC@#_sc_date_dif_2(data1, formato data1, data2, formato data2, op&ccedil;&atilde;o)', 'sc_alert_@#AC@#_sc_alert(&quot;mensagem&quot;)', 'sc_apl_conf_@#AC@#_sc_apl_conf(Aplica&ccedil;&atilde;o, Propriedade, valor)', 'sc_calc_dv_@#AC@#_sc_calc_dv(dig, resto, valor, m&oacute;dulo, pesos, tipo)', 'sc_decode_@#AC@#_sc_decode(campo/vari&aacute;vel)', 'sc_encode_@#AC@#_sc_encode(campo/vari&aacute;vel)', 'sc_error_exit_@#AC@#_sc_error_exit(URL/Aplica&ccedil;&atilde;o)', 'sc_error_message_@#AC@#_sc_error_message(&quot;texto&quot;)', 'sc_exit_@#AC@#_sc_exit(op&ccedil;&atilde;o)', 'sc_image_@#AC@#_sc_image(img1.jpg,img2.gif,...)', 'sc_include_@#AC@#_sc_include(arquivo, origem)', 'sc_label_@#AC@#_sc_label(campo)', 'sc_mail_send_@#AC@#_sc_mail_send(smtp, usr, pw, de, para, assunto, mensagem, tipo_mens, c&oacute;pias, tp_c&oacute;pias, porta, tp_conexao, attachment)', 'sc_redir_@#AC@#_sc_redir(apl, parm1; parm2; ..., target)', 'sc_reset_global_@#AC@#_sc_reset_global([var_glo1], [var_glo2] ...)', 'sc_set_global_@#AC@#_sc_set_global($var_1, {cmp_x}, ...)', 'sc_site_ssl_@#AC@#_sc_site_ssl', 'sc_trunc_num_@#AC@#_sc_trunc_num(campo,  qt_dec)', 'sc_url_exit_@#AC@#_sc_url_exit(url)', 'sc_warning_@#AC@#_sc_warning = \'on\'/\'off\'', 'sc_zip_file_@#AC@#_sc_zip_file(arquivos, zip)', 'sc_apl_status_@#AC@#_sc_apl_status(aplica&ccedil;&atilde;o, status)', 'sc_reset_apl_conf_@#AC@#_sc_reset_apl_conf(Aplica&ccedil;&atilde;o, Propriedade)', 'sc_reset_apl_status_@#AC@#_sc_reset_apl_status()', 'sc_block_display_@#AC@#_sc_block_display(nome do bloco, on/off)', 'sc_field_display_@#AC@#_sc_field_display({campo}, on/off)', 'sc_field_readonly_@#AC@#_sc_field_readonly({campo})', 'sc_format_num_@#AC@#_sc_format_num(campo, simb_agrup,  simb_dec, qt_dec, enche_zeros=,   lado_neg,  simb_monetario, lado_simb_monetario)', 'sc_form_show_@#AC@#_sc_form_show = \'on\'/\'off\'', 'sc_vl_extenso_@#AC@#_sc_vl_extenso(valor, tam_linha, tipo)', 'sc_btn_display_@#AC@#_sc_btn_display(&quot;nomebotao&quot;,&quot;on/off&quot;)');
		break;

		case "form_onRecord":
			$arr_wizard	= array('sc_begin_trans_@#AC@#_sc_begin_trans(&quot;conex&atilde;o&quot;)', 'sc_commit_trans_@#AC@#_sc_commit_trans(&quot;conex&atilde;o&quot;)', 'sc_exec_sql_@#AC@#_sc_exec_sql(&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_lookup_@#AC@#_sc_lookup(dataset,&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_rollback_trans_@#AC@#_sc_rollback_trans(&quot;conex&atilde;o&quot;)', 'sc_select_@#AC@#_sc_select(dataset,&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_date_@#AC@#_sc_date(data, formato, operador, D, M, A)', 'sc_date_conv_@#AC@#_sc_date_conv({cmp_data}, &quot;fmt_entrada&quot;, &quot;fmt_sa&iacute;da&quot;)', 'sc_date_dif_@#AC@#_sc_date_dif(data1, formato data1, data2, formato data2)', 'sc_date_dif_2_@#AC@#_sc_date_dif_2(data1, formato data1, data2, formato data2, op&ccedil;&atilde;o)', 'sc_alert_@#AC@#_sc_alert(&quot;mensagem&quot;)', 'sc_apl_conf_@#AC@#_sc_apl_conf(Aplica&ccedil;&atilde;o, Propriedade, valor)', 'sc_calc_dv_@#AC@#_sc_calc_dv(dig, resto, valor, m&oacute;dulo, pesos, tipo)', 'sc_decode_@#AC@#_sc_decode(campo/vari&aacute;vel)', 'sc_encode_@#AC@#_sc_encode(campo/vari&aacute;vel)', 'sc_error_exit_@#AC@#_sc_error_exit(URL/Aplica&ccedil;&atilde;o)', 'sc_error_message_@#AC@#_sc_error_message(&quot;texto&quot;)', 'sc_exit_@#AC@#_sc_exit(op&ccedil;&atilde;o)', 'sc_image_@#AC@#_sc_image(img1.jpg,img2.gif,...)', 'sc_include_@#AC@#_sc_include(arquivo, origem)', 'sc_label_@#AC@#_sc_label(campo)', 'sc_mail_send_@#AC@#_sc_mail_send(smtp, usr, pw, de, para, assunto, mensagem, tipo_mens, c&oacute;pias, tp_c&oacute;pias, porta, tp_conexao, attachment)', 'sc_master_value_@#AC@#_sc_master_value(\'objeto\', valor)', 'sc_redir_@#AC@#_sc_redir(apl, parm1; parm2; ..., target)', 'sc_reset_global_@#AC@#_sc_reset_global([var_glo1], [var_glo2] ...)', 'sc_set_global_@#AC@#_sc_set_global($var_1, {cmp_x}, ...)', 'sc_site_ssl_@#AC@#_sc_site_ssl', 'sc_trunc_num_@#AC@#_sc_trunc_num(campo,  qt_dec)', 'sc_url_exit_@#AC@#_sc_url_exit(url)', 'sc_warning_@#AC@#_sc_warning = \'on\'/\'off\'', 'sc_zip_file_@#AC@#_sc_zip_file(arquivos, zip)', 'sc_apl_status_@#AC@#_sc_apl_status(aplica&ccedil;&atilde;o, status)', 'sc_reset_apl_conf_@#AC@#_sc_reset_apl_conf(Aplica&ccedil;&atilde;o, Propriedade)', 'sc_reset_apl_status_@#AC@#_sc_reset_apl_status()', 'sc_block_display_@#AC@#_sc_block_display(nome do bloco, on/off)', 'sc_field_display_@#AC@#_sc_field_display({campo}, on/off)', 'sc_field_readonly_@#AC@#_sc_field_readonly({campo})', 'sc_format_num_@#AC@#_sc_format_num(campo, simb_agrup,  simb_dec, qt_dec, enche_zeros=,   lado_neg,  simb_monetario, lado_simb_monetario)', 'sc_form_show_@#AC@#_sc_form_show = \'on\'/\'off\'', 'sc_vl_extenso_@#AC@#_sc_vl_extenso(valor, tam_linha, tipo)', 'sc_btn_display_@#AC@#_sc_btn_display(&quot;nomebotao&quot;,&quot;on/off&quot;)');
		break;

		case "form_onRefresh":
			$arr_wizard	= array('sc_begin_trans_@#AC@#_sc_begin_trans(&quot;conex&atilde;o&quot;)', 'sc_commit_trans_@#AC@#_sc_commit_trans(&quot;conex&atilde;o&quot;)', 'sc_exec_sql_@#AC@#_sc_exec_sql(&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_lookup_@#AC@#_sc_lookup(dataset,&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_rollback_trans_@#AC@#_sc_rollback_trans(&quot;conex&atilde;o&quot;)', 'sc_select_@#AC@#_sc_select(dataset,&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_sql_injection_@#AC@#_sc_sql_injection(campo/vari&aacute;vel)', 'sc_date_@#AC@#_sc_date(data, formato, operador, D, M, A)', 'sc_date_conv_@#AC@#_sc_date_conv({cmp_data}, &quot;fmt_entrada&quot;, &quot;fmt_sa&iacute;da&quot;)', 'sc_date_dif_@#AC@#_sc_date_dif(data1, formato data1, data2, formato data2)', 'sc_date_dif_2_@#AC@#_sc_date_dif_2(data1, formato data1, data2, formato data2, op&ccedil;&atilde;o)', 'sc_date_empty_@#AC@#_sc_date_empty({campo_data})', 'sc_alert_@#AC@#_sc_alert(&quot;mensagem&quot;)', 'sc_apl_conf_@#AC@#_sc_apl_conf(Aplica&ccedil;&atilde;o, Propriedade, valor)', 'sc_calc_dv_@#AC@#_sc_calc_dv(dig, resto, valor, m&oacute;dulo, pesos, tipo)', 'sc_changed_@#AC@#_sc_changed({campo})', 'sc_decode_@#AC@#_sc_decode(campo/vari&aacute;vel)', 'sc_encode_@#AC@#_sc_encode(campo/vari&aacute;vel)', 'sc_error_exit_@#AC@#_sc_error_exit(URL/Aplica&ccedil;&atilde;o)', 'sc_error_message_@#AC@#_sc_error_message(&quot;texto&quot;)', 'sc_exit_@#AC@#_sc_exit(op&ccedil;&atilde;o)', 'sc_include_@#AC@#_sc_include(arquivo, origem)', 'sc_label_@#AC@#_sc_label(campo)', 'sc_master_value_@#AC@#_sc_master_value(\'objeto\', valor)', 'sc_reset_global_@#AC@#_sc_reset_global([var_glo1], [var_glo2] ...)', 'sc_set_global_@#AC@#_sc_set_global($var_1, {cmp_x}, ...)', 'sc_site_ssl_@#AC@#_sc_site_ssl', 'sc_trunc_num_@#AC@#_sc_trunc_num(campo,  qt_dec)', 'sc_url_exit_@#AC@#_sc_url_exit(url)', 'sc_warning_@#AC@#_sc_warning = \'on\'/\'off\'', 'sc_zip_file_@#AC@#_sc_zip_file(arquivos, zip)', 'sc_apl_status_@#AC@#_sc_apl_status(aplica&ccedil;&atilde;o, status)', 'sc_reset_apl_conf_@#AC@#_sc_reset_apl_conf(Aplica&ccedil;&atilde;o, Propriedade)', 'sc_reset_apl_status_@#AC@#_sc_reset_apl_status()', 'sc_block_display_@#AC@#_sc_block_display(nome do bloco, on/off)', 'sc_field_display_@#AC@#_sc_field_display({campo}, on/off)', 'sc_field_readonly_@#AC@#_sc_field_readonly({campo})', 'sc_format_num_@#AC@#_sc_format_num(campo, simb_agrup,  simb_dec, qt_dec, enche_zeros=,   lado_neg,  simb_monetario, lado_simb_monetario)', 'sc_btn_display_@#AC@#_sc_btn_display(&quot;nomebotao&quot;,&quot;on/off&quot;)');
		break;

		case "form_onValidate":
			$arr_wizard	= array('sc_begin_trans_@#AC@#_sc_begin_trans(&quot;conex&atilde;o&quot;)', 'sc_commit_trans_@#AC@#_sc_commit_trans(&quot;conex&atilde;o&quot;)', 'sc_exec_sql_@#AC@#_sc_exec_sql(&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_lookup_@#AC@#_sc_lookup(dataset,&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_rollback_trans_@#AC@#_sc_rollback_trans(&quot;conex&atilde;o&quot;)', 'sc_select_@#AC@#_sc_select(dataset,&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_sql_injection_@#AC@#_sc_sql_injection(campo/vari&aacute;vel)', 'sc_date_@#AC@#_sc_date(data, formato, operador, D, M, A)', 'sc_date_conv_@#AC@#_sc_date_conv({cmp_data}, &quot;fmt_entrada&quot;, &quot;fmt_sa&iacute;da&quot;)', 'sc_date_dif_@#AC@#_sc_date_dif(data1, formato data1, data2, formato data2)', 'sc_date_dif_2_@#AC@#_sc_date_dif_2(data1, formato data1, data2, formato data2, op&ccedil;&atilde;o)', 'sc_date_empty_@#AC@#_sc_date_empty({campo_data})', 'sc_alert_@#AC@#_sc_alert(&quot;mensagem&quot;)', 'sc_apl_conf_@#AC@#_sc_apl_conf(Aplica&ccedil;&atilde;o, Propriedade, valor)', 'sc_calc_dv_@#AC@#_sc_calc_dv(dig, resto, valor, m&oacute;dulo, pesos, tipo)', 'sc_changed_@#AC@#_sc_changed({campo})', 'sc_decode_@#AC@#_sc_decode(campo/vari&aacute;vel)', 'sc_encode_@#AC@#_sc_encode(campo/vari&aacute;vel)', 'sc_error_exit_@#AC@#_sc_error_exit(URL/Aplica&ccedil;&atilde;o)', 'sc_error_message_@#AC@#_sc_error_message(&quot;texto&quot;)', 'sc_exit_@#AC@#_sc_exit(op&ccedil;&atilde;o)', 'sc_image_@#AC@#_sc_image(img1.jpg,img2.gif,...)', 'sc_include_@#AC@#_sc_include(arquivo, origem)', 'sc_mail_send_@#AC@#_sc_mail_send(smtp, usr, pw, de, para, assunto, mensagem, tipo_mens, c&oacute;pias, tp_c&oacute;pias, porta, tp_conexao, attachment)', 'sc_master_value_@#AC@#_sc_master_value(\'objeto\', valor)', 'sc_redir_@#AC@#_sc_redir(apl, parm1; parm2; ..., target)', 'sc_reset_global_@#AC@#_sc_reset_global([var_glo1], [var_glo2] ...)', 'sc_set_global_@#AC@#_sc_set_global($var_1, {cmp_x}, ...)', 'sc_site_ssl_@#AC@#_sc_site_ssl', 'sc_trunc_num_@#AC@#_sc_trunc_num(campo,  qt_dec)', 'sc_url_exit_@#AC@#_sc_url_exit(url)', 'sc_warning_@#AC@#_sc_warning = \'on\'/\'off\'', 'sc_zip_file_@#AC@#_sc_zip_file(arquivos, zip)', 'sc_apl_status_@#AC@#_sc_apl_status(aplica&ccedil;&atilde;o, status)', 'sc_reset_apl_conf_@#AC@#_sc_reset_apl_conf(Aplica&ccedil;&atilde;o, Propriedade)', 'sc_reset_apl_status_@#AC@#_sc_reset_apl_status()', 'sc_block_display_@#AC@#_sc_block_display(nome do bloco, on/off)', 'sc_field_display_@#AC@#_sc_field_display({campo}, on/off)', 'sc_field_readonly_@#AC@#_sc_field_readonly({campo})', 'sc_format_num_@#AC@#_sc_format_num(campo, simb_agrup,  simb_dec, qt_dec, enche_zeros=,   lado_neg,  simb_monetario, lado_simb_monetario)', 'sc_form_show_@#AC@#_sc_form_show = \'on\'/\'off\'', 'sc_vl_extenso_@#AC@#_sc_vl_extenso(valor, tam_linha, tipo)', 'sc_btn_delete_@#AC@#_sc_btn_delete', 'sc_btn_display_@#AC@#_sc_btn_display(&quot;nomebotao&quot;,&quot;on/off&quot;)', 'sc_btn_insert_@#AC@#_sc_btn_insert', 'sc_btn_new_@#AC@#_sc_btn_new', 'sc_btn_update_@#AC@#_sc_btn_update');
		break;

		case "form_controle_ajaxFieldonBlur":
			$arr_wizard	= array('sc_lookup_@#AC@#_sc_lookup(dataset,&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_select_@#AC@#_sc_select(dataset,&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_sql_injection_@#AC@#_sc_sql_injection(campo/vari&aacute;vel)', 'sc_date_@#AC@#_sc_date(data, formato, operador, D, M, A)', 'sc_date_conv_@#AC@#_sc_date_conv({cmp_data}, &quot;fmt_entrada&quot;, &quot;fmt_sa&iacute;da&quot;)', 'sc_date_dif_@#AC@#_sc_date_dif(data1, formato data1, data2, formato data2)', 'sc_date_dif_2_@#AC@#_sc_date_dif_2(data1, formato data1, data2, formato data2, op&ccedil;&atilde;o)', 'sc_date_empty_@#AC@#_sc_date_empty({campo_data})', 'sc_calc_dv_@#AC@#_sc_calc_dv(dig, resto, valor, m&oacute;dulo, pesos, tipo)', 'sc_decode_@#AC@#_sc_decode(campo/vari&aacute;vel)', 'sc_encode_@#AC@#_sc_encode(campo/vari&aacute;vel)', 'sc_error_exit_@#AC@#_sc_error_exit(URL/Aplica&ccedil;&atilde;o)', 'sc_error_message_@#AC@#_sc_error_message(&quot;texto&quot;)', 'sc_include_@#AC@#_sc_include(arquivo, origem)', 'sc_label_@#AC@#_sc_label(campo)', 'sc_site_ssl_@#AC@#_sc_site_ssl', 'sc_trunc_num_@#AC@#_sc_trunc_num(campo,  qt_dec)', 'sc_warning_@#AC@#_sc_warning = \'on\'/\'off\'', 'sc_block_display_@#AC@#_sc_block_display(nome do bloco, on/off)', 'sc_field_display_@#AC@#_sc_field_display({campo}, on/off)', 'sc_field_readonly_@#AC@#_sc_field_readonly({campo})', 'sc_format_num_@#AC@#_sc_format_num(campo, simb_agrup,  simb_dec, qt_dec, enche_zeros=,   lado_neg,  simb_monetario, lado_simb_monetario)', 'sc_set_focus_@#AC@#_sc_set_focus(\'campo\')');
		break;

		case "form_controle_ajaxFieldonChange":
			$arr_wizard	= array('sc_lookup_@#AC@#_sc_lookup(dataset,&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_sql_injection_@#AC@#_sc_sql_injection(campo/vari&aacute;vel)', 'sc_date_@#AC@#_sc_date(data, formato, operador, D, M, A)', 'sc_date_conv_@#AC@#_sc_date_conv({cmp_data}, &quot;fmt_entrada&quot;, &quot;fmt_sa&iacute;da&quot;)', 'sc_date_dif_@#AC@#_sc_date_dif(data1, formato data1, data2, formato data2)', 'sc_date_dif_2_@#AC@#_sc_date_dif_2(data1, formato data1, data2, formato data2, op&ccedil;&atilde;o)', 'sc_date_empty_@#AC@#_sc_date_empty({campo_data})', 'sc_calc_dv_@#AC@#_sc_calc_dv(dig, resto, valor, m&oacute;dulo, pesos, tipo)', 'sc_decode_@#AC@#_sc_decode(campo/vari&aacute;vel)', 'sc_encode_@#AC@#_sc_encode(campo/vari&aacute;vel)', 'sc_error_exit_@#AC@#_sc_error_exit(URL/Aplica&ccedil;&atilde;o)', 'sc_error_message_@#AC@#_sc_error_message(&quot;texto&quot;)', 'sc_include_@#AC@#_sc_include(arquivo, origem)', 'sc_label_@#AC@#_sc_label(campo)', 'sc_trunc_num_@#AC@#_sc_trunc_num(campo,  qt_dec)', 'sc_warning_@#AC@#_sc_warning = \'on\'/\'off\'', 'sc_block_display_@#AC@#_sc_block_display(nome do bloco, on/off)', 'sc_field_display_@#AC@#_sc_field_display({campo}, on/off)', 'sc_field_readonly_@#AC@#_sc_field_readonly({campo})', 'sc_format_num_@#AC@#_sc_format_num(campo, simb_agrup,  simb_dec, qt_dec, enche_zeros=,   lado_neg,  simb_monetario, lado_simb_monetario)', 'sc_set_focus_@#AC@#_sc_set_focus(\'campo\')');
		break;

		case "form_controle_ajaxFieldonClick":
			$arr_wizard	= array('sc_lookup_@#AC@#_sc_lookup(dataset,&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_select_@#AC@#_sc_select(dataset,&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_sql_injection_@#AC@#_sc_sql_injection(campo/vari&aacute;vel)', 'sc_date_@#AC@#_sc_date(data, formato, operador, D, M, A)', 'sc_date_conv_@#AC@#_sc_date_conv({cmp_data}, &quot;fmt_entrada&quot;, &quot;fmt_sa&iacute;da&quot;)', 'sc_date_dif_@#AC@#_sc_date_dif(data1, formato data1, data2, formato data2)', 'sc_date_dif_2_@#AC@#_sc_date_dif_2(data1, formato data1, data2, formato data2, op&ccedil;&atilde;o)', 'sc_date_empty_@#AC@#_sc_date_empty({campo_data})', 'sc_calc_dv_@#AC@#_sc_calc_dv(dig, resto, valor, m&oacute;dulo, pesos, tipo)', 'sc_decode_@#AC@#_sc_decode(campo/vari&aacute;vel)', 'sc_encode_@#AC@#_sc_encode(campo/vari&aacute;vel)', 'sc_error_exit_@#AC@#_sc_error_exit(URL/Aplica&ccedil;&atilde;o)', 'sc_error_message_@#AC@#_sc_error_message(&quot;texto&quot;)', 'sc_include_@#AC@#_sc_include(arquivo, origem)', 'sc_label_@#AC@#_sc_label(campo)', 'sc_trunc_num_@#AC@#_sc_trunc_num(campo,  qt_dec)', 'sc_warning_@#AC@#_sc_warning = \'on\'/\'off\'', 'sc_block_display_@#AC@#_sc_block_display(nome do bloco, on/off)', 'sc_field_display_@#AC@#_sc_field_display({campo}, on/off)', 'sc_field_readonly_@#AC@#_sc_field_readonly({campo})', 'sc_format_num_@#AC@#_sc_format_num(campo, simb_agrup,  simb_dec, qt_dec, enche_zeros=,   lado_neg,  simb_monetario, lado_simb_monetario)', 'sc_set_focus_@#AC@#_sc_set_focus(\'campo\')');
		break;

		case "form_controle_ajaxFieldonFocus":
			$arr_wizard	= array('sc_lookup_@#AC@#_sc_lookup(dataset,&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_select_@#AC@#_sc_select(dataset,&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_sql_injection_@#AC@#_sc_sql_injection(campo/vari&aacute;vel)', 'sc_date_@#AC@#_sc_date(data, formato, operador, D, M, A)', 'sc_date_conv_@#AC@#_sc_date_conv({cmp_data}, &quot;fmt_entrada&quot;, &quot;fmt_sa&iacute;da&quot;)', 'sc_date_dif_@#AC@#_sc_date_dif(data1, formato data1, data2, formato data2)', 'sc_date_dif_2_@#AC@#_sc_date_dif_2(data1, formato data1, data2, formato data2, op&ccedil;&atilde;o)', 'sc_date_empty_@#AC@#_sc_date_empty({campo_data})', 'sc_calc_dv_@#AC@#_sc_calc_dv(dig, resto, valor, m&oacute;dulo, pesos, tipo)', 'sc_decode_@#AC@#_sc_decode(campo/vari&aacute;vel)', 'sc_encode_@#AC@#_sc_encode(campo/vari&aacute;vel)', 'sc_error_exit_@#AC@#_sc_error_exit(URL/Aplica&ccedil;&atilde;o)', 'sc_error_message_@#AC@#_sc_error_message(&quot;texto&quot;)', 'sc_groupby_label_@#AC@#_sc_groupby_label(campo)', 'sc_include_@#AC@#_sc_include(arquivo, origem)', 'sc_label_@#AC@#_sc_label(campo)', 'sc_link_@#AC@#_sc_link(coluna, aplica&ccedil;&atilde;o, par&acirc;metros, hint, target)', 'sc_trunc_num_@#AC@#_sc_trunc_num(campo,  qt_dec)', 'sc_warning_@#AC@#_sc_warning = \'on\'/\'off\'', 'sc_block_display_@#AC@#_sc_block_display(nome do bloco, on/off)', 'sc_field_display_@#AC@#_sc_field_display({campo}, on/off)', 'sc_field_readonly_@#AC@#_sc_field_readonly({campo})', 'sc_format_num_@#AC@#_sc_format_num(campo, simb_agrup,  simb_dec, qt_dec, enche_zeros=,   lado_neg,  simb_monetario, lado_simb_monetario)', 'sc_form_show_@#AC@#_sc_form_show = \'on\'/\'off\'', 'sc_set_focus_@#AC@#_sc_set_focus(\'campo\')');
		break;

		case "form_controle_onButtonClick":
			$arr_wizard	= array('sc_begin_trans_@#AC@#_sc_begin_trans(&quot;conex&atilde;o&quot;)', 'sc_commit_trans_@#AC@#_sc_commit_trans(&quot;conex&atilde;o&quot;)', 'sc_exec_sql_@#AC@#_sc_exec_sql(&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_lookup_@#AC@#_sc_lookup(dataset,&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_rollback_trans_@#AC@#_sc_rollback_trans(&quot;conex&atilde;o&quot;)', 'sc_select_@#AC@#_sc_select(dataset,&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_date_@#AC@#_sc_date(data, formato, operador, D, M, A)', 'sc_date_conv_@#AC@#_sc_date_conv({cmp_data}, &quot;fmt_entrada&quot;, &quot;fmt_sa&iacute;da&quot;)', 'sc_date_dif_@#AC@#_sc_date_dif(data1, formato data1, data2, formato data2)', 'sc_date_dif_2_@#AC@#_sc_date_dif_2(data1, formato data1, data2, formato data2, op&ccedil;&atilde;o)', 'sc_apl_conf_@#AC@#_sc_apl_conf(Aplica&ccedil;&atilde;o, Propriedade, valor)', 'sc_calc_dv_@#AC@#_sc_calc_dv(dig, resto, valor, m&oacute;dulo, pesos, tipo)', 'sc_confirm_@#AC@#_sc_confirm(&quot;mensagem&quot;)', 'sc_exit_@#AC@#_sc_exit(op&ccedil;&atilde;o)', 'sc_include_@#AC@#_sc_include(arquivo, origem)', 'sc_mail_send_@#AC@#_sc_mail_send(smtp, usr, pw, de, para, assunto, mensagem, tipo_mens, c&oacute;pias, tp_c&oacute;pias, porta, tp_conexao, attachment)', 'sc_redir_@#AC@#_sc_redir(apl, parm1; parm2; ..., target)', 'sc_reset_global_@#AC@#_sc_reset_global([var_glo1], [var_glo2] ...)', 'sc_set_global_@#AC@#_sc_set_global($var_1, {cmp_x}, ...)', 'sc_trunc_num_@#AC@#_sc_trunc_num(campo,  qt_dec)', 'sc_warning_@#AC@#_sc_warning = \'on\'/\'off\'', 'sc_zip_file_@#AC@#_sc_zip_file(arquivos, zip)', 'sc_apl_status_@#AC@#_sc_apl_status(aplica&ccedil;&atilde;o, status)', 'sc_reset_apl_conf_@#AC@#_sc_reset_apl_conf(Aplica&ccedil;&atilde;o, Propriedade)', 'sc_reset_apl_status_@#AC@#_sc_reset_apl_status()', 'sc_format_num_@#AC@#_sc_format_num(campo, simb_agrup,  simb_dec, qt_dec, enche_zeros=,   lado_neg,  simb_monetario, lado_simb_monetario)');
		break;

		case "form_controle_onScriptInit":
			$arr_wizard	= array('sc_begin_trans_@#AC@#_sc_begin_trans(&quot;conex&atilde;o&quot;)', 'sc_commit_trans_@#AC@#_sc_commit_trans(&quot;conex&atilde;o&quot;)', 'sc_exec_sql_@#AC@#_sc_exec_sql(&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_lookup_@#AC@#_sc_lookup(dataset,&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_rollback_trans_@#AC@#_sc_rollback_trans(&quot;conex&atilde;o&quot;)', 'sc_select_@#AC@#_sc_select(dataset,&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_sql_injection_@#AC@#_sc_sql_injection(campo/vari&aacute;vel)', 'sc_date_@#AC@#_sc_date(data, formato, operador, D, M, A)', 'sc_date_conv_@#AC@#_sc_date_conv({cmp_data}, &quot;fmt_entrada&quot;, &quot;fmt_sa&iacute;da&quot;)', 'sc_date_dif_@#AC@#_sc_date_dif(data1, formato data1, data2, formato data2)', 'sc_date_dif_2_@#AC@#_sc_date_dif_2(data1, formato data1, data2, formato data2, op&ccedil;&atilde;o)', 'sc_date_empty_@#AC@#_sc_date_empty({campo_data})', 'sc_alert_@#AC@#_sc_alert(&quot;mensagem&quot;)', 'sc_apl_conf_@#AC@#_sc_apl_conf(Aplica&ccedil;&atilde;o, Propriedade, valor)', 'sc_calc_dv_@#AC@#_sc_calc_dv(dig, resto, valor, m&oacute;dulo, pesos, tipo)', 'sc_changed_@#AC@#_sc_changed({campo})', 'sc_decode_@#AC@#_sc_decode(campo/vari&aacute;vel)', 'sc_encode_@#AC@#_sc_encode(campo/vari&aacute;vel)', 'sc_error_exit_@#AC@#_sc_error_exit(URL/Aplica&ccedil;&atilde;o)', 'sc_error_message_@#AC@#_sc_error_message(&quot;texto&quot;)', 'sc_exit_@#AC@#_sc_exit(op&ccedil;&atilde;o)', 'sc_image_@#AC@#_sc_image(img1.jpg,img2.gif,...)', 'sc_include_@#AC@#_sc_include(arquivo, origem)', 'sc_label_@#AC@#_sc_label(campo)', 'sc_mail_send_@#AC@#_sc_mail_send(smtp, usr, pw, de, para, assunto, mensagem, tipo_mens, c&oacute;pias, tp_c&oacute;pias, porta, tp_conexao, attachment)', 'sc_redir_@#AC@#_sc_redir(apl, parm1; parm2; ..., target)', 'sc_reset_global_@#AC@#_sc_reset_global([var_glo1], [var_glo2] ...)', 'sc_set_global_@#AC@#_sc_set_global($var_1, {cmp_x}, ...)', 'sc_site_ssl_@#AC@#_sc_site_ssl', 'sc_trunc_num_@#AC@#_sc_trunc_num(campo,  qt_dec)', 'sc_url_exit_@#AC@#_sc_url_exit(url)', 'sc_warning_@#AC@#_sc_warning = \'on\'/\'off\'', 'sc_zip_file_@#AC@#_sc_zip_file(arquivos, zip)', 'sc_apl_status_@#AC@#_sc_apl_status(aplica&ccedil;&atilde;o, status)', 'sc_reset_apl_conf_@#AC@#_sc_reset_apl_conf(Aplica&ccedil;&atilde;o, Propriedade)', 'sc_reset_apl_status_@#AC@#_sc_reset_apl_status()', 'sc_block_display_@#AC@#_sc_block_display(nome do bloco, on/off)', 'sc_field_display_@#AC@#_sc_field_display({campo}, on/off)', 'sc_field_readonly_@#AC@#_sc_field_readonly({campo})', 'sc_format_num_@#AC@#_sc_format_num(campo, simb_agrup,  simb_dec, qt_dec, enche_zeros=,   lado_neg,  simb_monetario, lado_simb_monetario)', 'sc_form_show_@#AC@#_sc_form_show = \'on\'/\'off\'', 'sc_vl_extenso_@#AC@#_sc_vl_extenso(valor, tam_linha, tipo)', 'sc_btn_display_@#AC@#_sc_btn_display(&quot;nomebotao&quot;,&quot;on/off&quot;)');
		break;

		case "form_controle_onLoadAll":
			$arr_wizard	= array('sc_lookup_@#AC@#_sc_lookup(dataset,&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_rollback_trans_@#AC@#_sc_rollback_trans(&quot;conex&atilde;o&quot;)', 'sc_select_@#AC@#_sc_select(dataset,&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_date_@#AC@#_sc_date(data, formato, operador, D, M, A)', 'sc_date_conv_@#AC@#_sc_date_conv({cmp_data}, &quot;fmt_entrada&quot;, &quot;fmt_sa&iacute;da&quot;)', 'sc_date_dif_@#AC@#_sc_date_dif(data1, formato data1, data2, formato data2)', 'sc_date_dif_2_@#AC@#_sc_date_dif_2(data1, formato data1, data2, formato data2, op&ccedil;&atilde;o)', 'sc_alert_@#AC@#_sc_alert(&quot;mensagem&quot;)', 'sc_apl_conf_@#AC@#_sc_apl_conf(Aplica&ccedil;&atilde;o, Propriedade, valor)', 'sc_calc_dv_@#AC@#_sc_calc_dv(dig, resto, valor, m&oacute;dulo, pesos, tipo)', 'sc_decode_@#AC@#_sc_decode(campo/vari&aacute;vel)', 'sc_encode_@#AC@#_sc_encode(campo/vari&aacute;vel)', 'sc_error_exit_@#AC@#_sc_error_exit(URL/Aplica&ccedil;&atilde;o)', 'sc_error_message_@#AC@#_sc_error_message(&quot;texto&quot;)', 'sc_exit_@#AC@#_sc_exit(op&ccedil;&atilde;o)', 'sc_image_@#AC@#_sc_image(img1.jpg,img2.gif,...)', 'sc_include_@#AC@#_sc_include(arquivo, origem)', 'sc_label_@#AC@#_sc_label(campo)', 'sc_mail_send_@#AC@#_sc_mail_send(smtp, usr, pw, de, para, assunto, mensagem, tipo_mens, c&oacute;pias, tp_c&oacute;pias, porta, tp_conexao, attachment)', 'sc_redir_@#AC@#_sc_redir(apl, parm1; parm2; ..., target)', 'sc_reset_global_@#AC@#_sc_reset_global([var_glo1], [var_glo2] ...)', 'sc_set_global_@#AC@#_sc_set_global($var_1, {cmp_x}, ...)', 'sc_site_ssl_@#AC@#_sc_site_ssl', 'sc_trunc_num_@#AC@#_sc_trunc_num(campo,  qt_dec)', 'sc_url_exit_@#AC@#_sc_url_exit(url)', 'sc_warning_@#AC@#_sc_warning = \'on\'/\'off\'', 'sc_zip_file_@#AC@#_sc_zip_file(arquivos, zip)', 'sc_apl_status_@#AC@#_sc_apl_status(aplica&ccedil;&atilde;o, status)', 'sc_reset_apl_conf_@#AC@#_sc_reset_apl_conf(Aplica&ccedil;&atilde;o, Propriedade)', 'sc_reset_apl_status_@#AC@#_sc_reset_apl_status()', 'sc_block_display_@#AC@#_sc_block_display(nome do bloco, on/off)', 'sc_field_display_@#AC@#_sc_field_display({campo}, on/off)', 'sc_field_readonly_@#AC@#_sc_field_readonly({campo})', 'sc_format_num_@#AC@#_sc_format_num(campo, simb_agrup,  simb_dec, qt_dec, enche_zeros=,   lado_neg,  simb_monetario, lado_simb_monetario)', 'sc_form_show_@#AC@#_sc_form_show = \'on\'/\'off\'', 'sc_vl_extenso_@#AC@#_sc_vl_extenso(valor, tam_linha, tipo)', 'sc_btn_display_@#AC@#_sc_btn_display(&quot;nomebotao&quot;,&quot;on/off&quot;)');
		break;

		case "form_controle_onRefresh":
			$arr_wizard	= array('sc_lookup_@#AC@#_sc_lookup(dataset,&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_select_@#AC@#_sc_select(dataset,&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_date_@#AC@#_sc_date(data, formato, operador, D, M, A)', 'sc_date_conv_@#AC@#_sc_date_conv({cmp_data}, &quot;fmt_entrada&quot;, &quot;fmt_sa&iacute;da&quot;)', 'sc_date_dif_@#AC@#_sc_date_dif(data1, formato data1, data2, formato data2)', 'sc_date_dif_2_@#AC@#_sc_date_dif_2(data1, formato data1, data2, formato data2, op&ccedil;&atilde;o)', 'sc_date_empty_@#AC@#_sc_date_empty({campo_data})', 'sc_calc_dv_@#AC@#_sc_calc_dv(dig, resto, valor, m&oacute;dulo, pesos, tipo)', 'sc_changed_@#AC@#_sc_changed({campo})', 'sc_decode_@#AC@#_sc_decode(campo/vari&aacute;vel)', 'sc_encode_@#AC@#_sc_encode(campo/vari&aacute;vel)', 'sc_error_exit_@#AC@#_sc_error_exit(URL/Aplica&ccedil;&atilde;o)', 'sc_error_message_@#AC@#_sc_error_message(&quot;texto&quot;)', 'sc_include_@#AC@#_sc_include(arquivo, origem)', 'sc_trunc_num_@#AC@#_sc_trunc_num(campo,  qt_dec)', 'sc_warning_@#AC@#_sc_warning = \'on\'/\'off\'', 'sc_format_num_@#AC@#_sc_format_num(campo, simb_agrup,  simb_dec, qt_dec, enche_zeros=,   lado_neg,  simb_monetario, lado_simb_monetario)');
		break;

		case "form_controle_onValidate":
			$arr_wizard	= array('sc_begin_trans_@#AC@#_sc_begin_trans(&quot;conex&atilde;o&quot;)', 'sc_commit_trans_@#AC@#_sc_commit_trans(&quot;conex&atilde;o&quot;)', 'sc_exec_sql_@#AC@#_sc_exec_sql(&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_lookup_@#AC@#_sc_lookup(dataset,&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_rollback_trans_@#AC@#_sc_rollback_trans(&quot;conex&atilde;o&quot;)', 'sc_select_@#AC@#_sc_select(dataset,&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_sql_injection_@#AC@#_sc_sql_injection(campo/vari&aacute;vel)', 'sc_date_@#AC@#_sc_date(data, formato, operador, D, M, A)', 'sc_date_conv_@#AC@#_sc_date_conv({cmp_data}, &quot;fmt_entrada&quot;, &quot;fmt_sa&iacute;da&quot;)', 'sc_date_dif_@#AC@#_sc_date_dif(data1, formato data1, data2, formato data2)', 'sc_date_dif_2_@#AC@#_sc_date_dif_2(data1, formato data1, data2, formato data2, op&ccedil;&atilde;o)', 'sc_date_empty_@#AC@#_sc_date_empty({campo_data})', 'sc_alert_@#AC@#_sc_alert(&quot;mensagem&quot;)', 'sc_apl_conf_@#AC@#_sc_apl_conf(Aplica&ccedil;&atilde;o, Propriedade, valor)', 'sc_calc_dv_@#AC@#_sc_calc_dv(dig, resto, valor, m&oacute;dulo, pesos, tipo)', 'sc_changed_@#AC@#_sc_changed({campo})', 'sc_decode_@#AC@#_sc_decode(campo/vari&aacute;vel)', 'sc_encode_@#AC@#_sc_encode(campo/vari&aacute;vel)', 'sc_error_exit_@#AC@#_sc_error_exit(URL/Aplica&ccedil;&atilde;o)', 'sc_error_message_@#AC@#_sc_error_message(&quot;texto&quot;)', 'sc_exit_@#AC@#_sc_exit(op&ccedil;&atilde;o)', 'sc_image_@#AC@#_sc_image(img1.jpg,img2.gif,...)', 'sc_include_@#AC@#_sc_include(arquivo, origem)', 'sc_mail_send_@#AC@#_sc_mail_send(smtp, usr, pw, de, para, assunto, mensagem, tipo_mens, c&oacute;pias, tp_c&oacute;pias, porta, tp_conexao, attachment)', 'sc_redir_@#AC@#_sc_redir(apl, parm1; parm2; ..., target)', 'sc_reset_global_@#AC@#_sc_reset_global([var_glo1], [var_glo2] ...)', 'sc_set_global_@#AC@#_sc_set_global($var_1, {cmp_x}, ...)', 'sc_site_ssl_@#AC@#_sc_site_ssl', 'sc_trunc_num_@#AC@#_sc_trunc_num(campo,  qt_dec)', 'sc_url_exit_@#AC@#_sc_url_exit(url)', 'sc_warning_@#AC@#_sc_warning = \'on\'/\'off\'', 'sc_zip_file_@#AC@#_sc_zip_file(arquivos, zip)', 'sc_apl_status_@#AC@#_sc_apl_status(aplica&ccedil;&atilde;o, status)', 'sc_reset_apl_conf_@#AC@#_sc_reset_apl_conf(Aplica&ccedil;&atilde;o, Propriedade)', 'sc_reset_apl_status_@#AC@#_sc_reset_apl_status()', 'sc_block_display_@#AC@#_sc_block_display(nome do bloco, on/off)', 'sc_field_display_@#AC@#_sc_field_display({campo}, on/off)', 'sc_field_readonly_@#AC@#_sc_field_readonly({campo})', 'sc_format_num_@#AC@#_sc_format_num(campo, simb_agrup,  simb_dec, qt_dec, enche_zeros=,   lado_neg,  simb_monetario, lado_simb_monetario)', 'sc_form_show_@#AC@#_sc_form_show = \'on\'/\'off\'', 'sc_vl_extenso_@#AC@#_sc_vl_extenso(valor, tam_linha, tipo)', 'sc_btn_display_@#AC@#_sc_btn_display(&quot;nomebotao&quot;,&quot;on/off&quot;)');
		break;

		case "menu_onExecute":
			$arr_wizard	= array('sc_lookup_@#AC@#_sc_lookup(dataset,&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_select_@#AC@#_sc_select(dataset,&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_date_@#AC@#_sc_date(data, formato, operador, D, M, A)', 'sc_date_conv_@#AC@#_sc_date_conv({cmp_data}, &quot;fmt_entrada&quot;, &quot;fmt_sa&iacute;da&quot;)', 'sc_date_dif_@#AC@#_sc_date_dif(data1, formato data1, data2, formato data2)', 'sc_date_dif_2_@#AC@#_sc_date_dif_2(data1, formato data1, data2, formato data2, op&ccedil;&atilde;o)', 'sc_calc_dv_@#AC@#_sc_calc_dv(dig, resto, valor, m&oacute;dulo, pesos, tipo)', 'sc_include_@#AC@#_sc_include(arquivo, origem)', 'sc_redir_@#AC@#_sc_redir(apl, parm1; parm2; ..., target)', 'sc_reset_global_@#AC@#_sc_reset_global([var_glo1], [var_glo2] ...)', 'sc_set_global_@#AC@#_sc_set_global($var_1, {cmp_x}, ...)', 'sc_trunc_num_@#AC@#_sc_trunc_num(campo,  qt_dec)', 'sc_warning_@#AC@#_sc_warning = \'on\'/\'off\'', 'sc_reset_menu_delete_@#AC@#_sc_reset_menu_delete()', 'sc_reset_menu_disable_@#AC@#_sc_reset_menu_disable()', 'sc_format_num_@#AC@#_sc_format_num(campo, simb_agrup,  simb_dec, qt_dec, enche_zeros=,   lado_neg,  simb_monetario, lado_simb_monetario)', 'sc_menu_item_@#AC@#_{sc_menu_item}', 'sc_script_name_@#AC@#_{sc_script_name}');
		break;

		case "menu_onLoad":
			$arr_wizard	= array('sc_lookup_@#AC@#_sc_lookup(dataset,&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_select_@#AC@#_sc_select(dataset,&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_date_@#AC@#_sc_date(data, formato, operador, D, M, A)', 'sc_date_conv_@#AC@#_sc_date_conv({cmp_data}, &quot;fmt_entrada&quot;, &quot;fmt_sa&iacute;da&quot;)', 'sc_date_dif_@#AC@#_sc_date_dif(data1, formato data1, data2, formato data2)', 'sc_date_dif_2_@#AC@#_sc_date_dif_2(data1, formato data1, data2, formato data2, op&ccedil;&atilde;o)', 'sc_apl_conf_@#AC@#_sc_apl_conf(Aplica&ccedil;&atilde;o, Propriedade, valor)', 'sc_calc_dv_@#AC@#_sc_calc_dv(dig, resto, valor, m&oacute;dulo, pesos, tipo)', 'sc_image_@#AC@#_sc_image(img1.jpg,img2.gif,...)', 'sc_include_@#AC@#_sc_include(arquivo, origem)', 'sc_mail_send_@#AC@#_sc_mail_send(smtp, usr, pw, de, para, assunto, mensagem, tipo_mens, c&oacute;pias, tp_c&oacute;pias, porta, tp_conexao, attachment)', 'sc_reset_global_@#AC@#_sc_reset_global([var_glo1], [var_glo2] ...)', 'sc_set_global_@#AC@#_sc_set_global($var_1, {cmp_x}, ...)', 'sc_trunc_num_@#AC@#_sc_trunc_num(campo,  qt_dec)', 'sc_warning_@#AC@#_sc_warning = \'on\'/\'off\'', 'sc_apl_status_@#AC@#_sc_apl_status(aplica&ccedil;&atilde;o, status)', 'sc_reset_apl_conf_@#AC@#_sc_reset_apl_conf(Aplica&ccedil;&atilde;o, Propriedade)', 'sc_reset_apl_status_@#AC@#_sc_reset_apl_status()', 'sc_reset_menu_delete_@#AC@#_sc_reset_menu_delete()', 'sc_reset_menu_disable_@#AC@#_sc_reset_menu_disable()', 'sc_format_num_@#AC@#_sc_format_num(campo, simb_agrup,  simb_dec, qt_dec, enche_zeros=,   lado_neg,  simb_monetario, lado_simb_monetario)', 'sc_menu_delete_@#AC@#_sc_menu_deleteid_item1,id_item2,...', 'sc_menu_disable_@#AC@#_sc_menu_disableid_item1,id_item2,...');
		break;

		case "menutree_onExecute":
			$arr_wizard	= array('sc_lookup_@#AC@#_sc_lookup(dataset,&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_select_@#AC@#_sc_select(dataset,&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_date_@#AC@#_sc_date(data, formato, operador, D, M, A)', 'sc_date_conv_@#AC@#_sc_date_conv({cmp_data}, &quot;fmt_entrada&quot;, &quot;fmt_sa&iacute;da&quot;)', 'sc_date_dif_@#AC@#_sc_date_dif(data1, formato data1, data2, formato data2)', 'sc_date_dif_2_@#AC@#_sc_date_dif_2(data1, formato data1, data2, formato data2, op&ccedil;&atilde;o)', 'sc_calc_dv_@#AC@#_sc_calc_dv(dig, resto, valor, m&oacute;dulo, pesos, tipo)', 'sc_include_@#AC@#_sc_include(arquivo, origem)', 'sc_redir_@#AC@#_sc_redir(apl, parm1; parm2; ..., target)', 'sc_reset_global_@#AC@#_sc_reset_global([var_glo1], [var_glo2] ...)', 'sc_set_global_@#AC@#_sc_set_global($var_1, {cmp_x}, ...)', 'sc_trunc_num_@#AC@#_sc_trunc_num(campo,  qt_dec)', 'sc_warning_@#AC@#_sc_warning = \'on\'/\'off\'', 'sc_reset_menu_delete_@#AC@#_sc_reset_menu_delete()', 'sc_reset_menu_disable_@#AC@#_sc_reset_menu_disable()', 'sc_format_num_@#AC@#_sc_format_num(campo, simb_agrup,  simb_dec, qt_dec, enche_zeros=,   lado_neg,  simb_monetario, lado_simb_monetario)', 'sc_menu_item_@#AC@#_{sc_menu_item}', 'sc_script_name_@#AC@#_{sc_script_name}');
		break;

		case "menutree_onLoad":
			$arr_wizard	= array('sc_lookup_@#AC@#_sc_lookup(dataset,&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_select_@#AC@#_sc_select(dataset,&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_date_@#AC@#_sc_date(data, formato, operador, D, M, A)', 'sc_date_conv_@#AC@#_sc_date_conv({cmp_data}, &quot;fmt_entrada&quot;, &quot;fmt_sa&iacute;da&quot;)', 'sc_date_dif_@#AC@#_sc_date_dif(data1, formato data1, data2, formato data2)', 'sc_date_dif_2_@#AC@#_sc_date_dif_2(data1, formato data1, data2, formato data2, op&ccedil;&atilde;o)', 'sc_apl_conf_@#AC@#_sc_apl_conf(Aplica&ccedil;&atilde;o, Propriedade, valor)', 'sc_calc_dv_@#AC@#_sc_calc_dv(dig, resto, valor, m&oacute;dulo, pesos, tipo)', 'sc_image_@#AC@#_sc_image(img1.jpg,img2.gif,...)', 'sc_include_@#AC@#_sc_include(arquivo, origem)', 'sc_mail_send_@#AC@#_sc_mail_send(smtp, usr, pw, de, para, assunto, mensagem, tipo_mens, c&oacute;pias, tp_c&oacute;pias, porta, tp_conexao, attachment)', 'sc_reset_global_@#AC@#_sc_reset_global([var_glo1], [var_glo2] ...)', 'sc_set_global_@#AC@#_sc_set_global($var_1, {cmp_x}, ...)', 'sc_trunc_num_@#AC@#_sc_trunc_num(campo,  qt_dec)', 'sc_warning_@#AC@#_sc_warning = \'on\'/\'off\'', 'sc_apl_status_@#AC@#_sc_apl_status(aplica&ccedil;&atilde;o, status)', 'sc_reset_apl_conf_@#AC@#_sc_reset_apl_conf(Aplica&ccedil;&atilde;o, Propriedade)', 'sc_reset_apl_status_@#AC@#_sc_reset_apl_status()', 'sc_reset_menu_delete_@#AC@#_sc_reset_menu_delete()', 'sc_reset_menu_disable_@#AC@#_sc_reset_menu_disable()', 'sc_format_num_@#AC@#_sc_format_num(campo, simb_agrup,  simb_dec, qt_dec, enche_zeros=,   lado_neg,  simb_monetario, lado_simb_monetario)', 'sc_menu_delete_@#AC@#_sc_menu_deleteid_item1,id_item2,...', 'sc_menu_disable_@#AC@#_sc_menu_disableid_item1,id_item2,...');
		break;

		case "reportpdf_onCode":
			$arr_wizard	= array('sc_pdf_print_@#AC@#_sc_pdf_print(array)', 'sc_pdf_print_img_@#AC@#_sc_pdf_print_img( array, largura, altura)', 'sc_pdf_print_sub_sel_@#AC@#_sc_pdf_print_sub_sel(array)');
		break;

		case "reportpdf_onFooter":
			$arr_wizard	= array('sc_lookup_@#AC@#_sc_lookup(dataset,&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_select_@#AC@#_sc_select(dataset,&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_date_@#AC@#_sc_date(data, formato, operador, D, M, A)', 'sc_date_conv_@#AC@#_sc_date_conv({cmp_data}, &quot;fmt_entrada&quot;, &quot;fmt_sa&iacute;da&quot;)', 'sc_date_dif_@#AC@#_sc_date_dif(data1, formato data1, data2, formato data2)', 'sc_date_dif_2_@#AC@#_sc_date_dif_2(data1, formato data1, data2, formato data2, op&ccedil;&atilde;o)', 'sc_calc_dv_@#AC@#_sc_calc_dv(dig, resto, valor, m&oacute;dulo, pesos, tipo)', 'sc_include_@#AC@#_sc_include(arquivo, origem)', 'sc_reset_global_@#AC@#_sc_reset_global([var_glo1], [var_glo2] ...)', 'sc_set_global_@#AC@#_sc_set_global($var_1, {cmp_x}, ...)', 'sc_trunc_num_@#AC@#_sc_trunc_num(campo,  qt_dec)', 'sc_warning_@#AC@#_sc_warning = \'on\'/\'off\'', 'sc_lin_cod_barra_arrecadacao_@#AC@#_sc_lin_cod_barra_arrecadacao(cod_barra, cod_seguimento, cod_moeda, valor, livre)', 'sc_lin_cod_barra_banco_@#AC@#_sc_lin_cod_barra_banco(cod_barra, cod_banco, cod_moeda, valor, livre, dt_venc)', 'sc_lin_digitavel_arrecadacao_@#AC@#_sc_lin_digitavel_arrecadacao(lin_digitavel, cod_barras)', 'sc_lin_digitavel_banco_@#AC@#_sc_lin_digitavel_banco(lin_digitavel, cod_barras)', 'sc_format_num_@#AC@#_sc_format_num(campo, simb_agrup,  simb_dec, qt_dec, enche_zeros=,   lado_neg,  simb_monetario, lado_simb_monetario)', 'sc_vl_extenso_@#AC@#_sc_vl_extenso(valor, tam_linha, tipo)');
		break;

		case "reportpdf_onHeader":
			$arr_wizard	= array('sc_lookup_@#AC@#_sc_lookup(dataset,&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_select_@#AC@#_sc_select(dataset,&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_date_@#AC@#_sc_date(data, formato, operador, D, M, A)', 'sc_date_conv_@#AC@#_sc_date_conv({cmp_data}, &quot;fmt_entrada&quot;, &quot;fmt_sa&iacute;da&quot;)', 'sc_date_dif_@#AC@#_sc_date_dif(data1, formato data1, data2, formato data2)', 'sc_date_dif_2_@#AC@#_sc_date_dif_2(data1, formato data1, data2, formato data2, op&ccedil;&atilde;o)', 'sc_calc_dv_@#AC@#_sc_calc_dv(dig, resto, valor, m&oacute;dulo, pesos, tipo)', 'sc_include_@#AC@#_sc_include(arquivo, origem)', 'sc_reset_global_@#AC@#_sc_reset_global([var_glo1], [var_glo2] ...)', 'sc_set_global_@#AC@#_sc_set_global($var_1, {cmp_x}, ...)', 'sc_trunc_num_@#AC@#_sc_trunc_num(campo,  qt_dec)', 'sc_warning_@#AC@#_sc_warning = \'on\'/\'off\'', 'sc_format_num_@#AC@#_sc_format_num(campo, simb_agrup,  simb_dec, qt_dec, enche_zeros=,   lado_neg,  simb_monetario, lado_simb_monetario)', 'sc_vl_extenso_@#AC@#_sc_vl_extenso(valor, tam_linha, tipo)');
		break;

		case "reportpdf_onScriptInit":
			$arr_wizard	= array('sc_exec_sql_@#AC@#_sc_exec_sql(&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_lookup_@#AC@#_sc_lookup(dataset,&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_select_@#AC@#_sc_select(dataset,&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_select_field_@#AC@#_sc_select_field({campo})', 'sc_select_order_@#AC@#_sc_select_order(campo)', 'sc_select_where_@#AC@#_sc_select_where(add)', 'sc_where_current_@#AC@#_{sc_where_current}', 'sc_where_orig_@#AC@#_{sc_where_orig}', 'sc_date_@#AC@#_sc_date(data, formato, operador, D, M, A)', 'sc_date_conv_@#AC@#_sc_date_conv({cmp_data}, &quot;fmt_entrada&quot;, &quot;fmt_sa&iacute;da&quot;)', 'sc_date_dif_@#AC@#_sc_date_dif(data1, formato data1, data2, formato data2)', 'sc_date_dif_2_@#AC@#_sc_date_dif_2(data1, formato data1, data2, formato data2, op&ccedil;&atilde;o)', 'sc_apl_conf_@#AC@#_sc_apl_conf(Aplica&ccedil;&atilde;o, Propriedade, valor)', 'sc_calc_dv_@#AC@#_sc_calc_dv(dig, resto, valor, m&oacute;dulo, pesos, tipo)', 'sc_decode_@#AC@#_sc_decode(campo/vari&aacute;vel)', 'sc_encode_@#AC@#_sc_encode(campo/vari&aacute;vel)', 'sc_label_@#AC@#_sc_label(campo)', 'sc_mail_send_@#AC@#_sc_mail_send(smtp, usr, pw, de, para, assunto, mensagem, tipo_mens, c&oacute;pias, tp_c&oacute;pias, porta, tp_conexao, attachment)', 'sc_redir_@#AC@#_sc_redir(apl, parm1; parm2; ..., target)', 'sc_reset_global_@#AC@#_sc_reset_global([var_glo1], [var_glo2] ...)', 'sc_set_global_@#AC@#_sc_set_global($var_1, {cmp_x}, ...)', 'sc_site_ssl_@#AC@#_sc_site_ssl', 'sc_trunc_num_@#AC@#_sc_trunc_num(campo,  qt_dec)', 'sc_url_exit_@#AC@#_sc_url_exit(url)', 'sc_warning_@#AC@#_sc_warning = \'on\'/\'off\'', 'sc_zip_file_@#AC@#_sc_zip_file(arquivos, zip)', 'sc_where_filter_@#AC@#_{sc_where_filter}', 'sc_apl_status_@#AC@#_sc_apl_status(aplica&ccedil;&atilde;o, status)', 'sc_reset_apl_conf_@#AC@#_sc_reset_apl_conf(Aplica&ccedil;&atilde;o, Propriedade)', 'sc_reset_apl_status_@#AC@#_sc_reset_apl_status()', 'sc_block_display_@#AC@#_sc_block_display(nome do bloco, on/off)', 'sc_field_color_@#AC@#_sc_field_color(&quot;campo&quot;, &quot;cor&quot;)', 'sc_field_display_@#AC@#_sc_field_display({campo}, on/off)', 'sc_format_num_@#AC@#_sc_format_num(campo, simb_agrup,  simb_dec, qt_dec, enche_zeros=,   lado_neg,  simb_monetario, lado_simb_monetario)', 'sc_vl_extenso_@#AC@#_sc_vl_extenso(valor, tam_linha, tipo)');
		break;

		case "reportpdf_onRecord":
			$arr_wizard	= array('sc_lookup_@#AC@#_sc_lookup(dataset,&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_select_@#AC@#_sc_select(dataset,&quot;comando sql&quot;, &quot;conex&atilde;o&quot;)', 'sc_where_current_@#AC@#_{sc_where_current}', 'sc_where_orig_@#AC@#_{sc_where_orig}', 'sc_date_@#AC@#_sc_date(data, formato, operador, D, M, A)', 'sc_date_conv_@#AC@#_sc_date_conv({cmp_data}, &quot;fmt_entrada&quot;, &quot;fmt_sa&iacute;da&quot;)', 'sc_date_dif_@#AC@#_sc_date_dif(data1, formato data1, data2, formato data2)', 'sc_date_dif_2_@#AC@#_sc_date_dif_2(data1, formato data1, data2, formato data2, op&ccedil;&atilde;o)', 'sc_calc_dv_@#AC@#_sc_calc_dv(dig, resto, valor, m&oacute;dulo, pesos, tipo)', 'sc_include_@#AC@#_sc_include(arquivo, origem)', 'sc_link_@#AC@#_sc_link(coluna, aplica&ccedil;&atilde;o, par&acirc;metros, hint, target)', 'sc_mail_send_@#AC@#_sc_mail_send(smtp, usr, pw, de, para, assunto, mensagem, tipo_mens, c&oacute;pias, tp_c&oacute;pias, porta, tp_conexao, attachment)', 'sc_make_link_@#AC@#_sc_make_link(aplica&ccedil;&atilde;o, par&acirc;metros)', 'sc_reset_global_@#AC@#_sc_reset_global([var_glo1], [var_glo2] ...)', 'sc_seq_register_@#AC@#_{sc_seq_register}', 'sc_set_global_@#AC@#_sc_set_global($var_1, {cmp_x}, ...)', 'sc_trunc_num_@#AC@#_sc_trunc_num(campo,  qt_dec)', 'sc_warning_@#AC@#_sc_warning = \'on\'/\'off\'', 'sc_zip_file_@#AC@#_sc_zip_file(arquivos, zip)', 'sc_lin_cod_barra_arrecadacao_@#AC@#_sc_lin_cod_barra_arrecadacao(cod_barra, cod_seguimento, cod_moeda, valor, livre)', 'sc_lin_cod_barra_banco_@#AC@#_sc_lin_cod_barra_banco(cod_barra, cod_banco, cod_moeda, valor, livre, dt_venc)', 'sc_lin_digitavel_arrecadacao_@#AC@#_sc_lin_digitavel_arrecadacao(lin_digitavel, cod_barras)', 'sc_lin_digitavel_banco_@#AC@#_sc_lin_digitavel_banco(lin_digitavel, cod_barras)', 'sc_where_filter_@#AC@#_{sc_where_filter}', 'sc_field_color_@#AC@#_sc_field_color(&quot;campo&quot;, &quot;cor&quot;)', 'sc_format_num_@#AC@#_sc_format_num(campo, simb_agrup,  simb_dec, qt_dec, enche_zeros=,   lado_neg,  simb_monetario, lado_simb_monetario)', 'sc_vl_extenso_@#AC@#_sc_vl_extenso(valor, tam_linha, tipo)');
		break;
	}


	return $arr_wizard;

}

?>