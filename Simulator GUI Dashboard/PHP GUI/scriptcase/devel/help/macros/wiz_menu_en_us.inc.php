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
								"Date"	=> array('sc_date', 'sc_date_conv', 'sc_date_dif', 'sc_date_dif_2'),
								"Control"	=> array('sc_alert', 'sc_changed', 'sc_confirm', 'sc_error_message', 'sc_link', 'sc_mail_send', 'sc_make_link'),
								"Security"	=> array('sc_apl_status'),
								"Buttons"	=> array('sc_btn_display'),
								"Menu"	=> array('sc_menu_delete', 'sc_menu_disable'),
								);
		break;

		case "blank_onExecute":
			$arr_wizard	= array(	
								"SQL"	=> array('sc_exec_sql', 'sc_lookup', 'sc_select'),
								"Date"	=> array('sc_date_dif', 'sc_date_dif_2'),
								"Control"	=> array('sc_error_message', 'sc_mail_send', 'sc_make_link'),
								"Security"	=> array('sc_apl_status'),
								);
		break;

		case "consulta_onButtonClick":
			$arr_wizard	= array(	
								"SQL"	=> array('sc_exec_sql', 'sc_lookup', 'sc_select'),
								"Date"	=> array('sc_date', 'sc_date_conv', 'sc_date_dif', 'sc_date_dif_2'),
								"Control"	=> array('sc_confirm', 'sc_mail_send'),
								"Security"	=> array('sc_apl_status'),
								);
		break;

		case "consulta_onFooter":
			$arr_wizard	= array(	
								"SQL"	=> array('sc_lookup', 'sc_select'),
								"Date"	=> array('sc_date', 'sc_date_conv', 'sc_date_dif', 'sc_date_dif_2'),
								);
		break;

		case "consulta_onGroupBy":
			$arr_wizard	= array(	
								"SQL"	=> array('sc_lookup', 'sc_select'),
								"Date"	=> array('sc_date', 'sc_date_conv', 'sc_date_dif', 'sc_date_dif_2'),
								);
		break;

		case "consulta_onHeader":
			$arr_wizard	= array(	
								"SQL"	=> array('sc_lookup', 'sc_select'),
								"Date"	=> array('sc_date', 'sc_date_conv', 'sc_date_dif', 'sc_date_dif_2'),
								);
		break;

		case "consulta_onScriptInit":
			$arr_wizard	= array(	
								"SQL"	=> array('sc_exec_sql', 'sc_lookup', 'sc_select'),
								"Date"	=> array('sc_date', 'sc_date_conv', 'sc_date_dif', 'sc_date_dif_2'),
								"Control"	=> array('sc_mail_send'),
								"Security"	=> array('sc_apl_status'),
								"Buttons"	=> array('sc_btn_display'),
								);
		break;

		case "consulta_onRecord":
			$arr_wizard	= array(	
								"SQL"	=> array('sc_lookup', 'sc_select'),
								"Date"	=> array('sc_date', 'sc_date_conv', 'sc_date_dif', 'sc_date_dif_2'),
								"Control"	=> array('sc_link', 'sc_mail_send', 'sc_make_link'),
								);
		break;

		case "filtro_onScriptInit":
			$arr_wizard	= array(	
								"SQL"	=> array('sc_lookup', 'sc_select'),
								"Date"	=> array('sc_date', 'sc_date_conv', 'sc_date_dif', 'sc_date_dif_2'),
								"Control"	=> array('sc_error_message', 'sc_mail_send'),
								"Security"	=> array('sc_apl_status'),
								);
		break;

		case "filtro_onRefresh":
			$arr_wizard	= array(	
								"SQL"	=> array('sc_lookup', 'sc_select'),
								"Date"	=> array('sc_date', 'sc_date_conv', 'sc_date_dif', 'sc_date_dif_2'),
								"Control"	=> array('sc_error_message'),
								);
		break;

		case "filtro_onSave":
			$arr_wizard	= array(	
								"SQL"	=> array('sc_lookup', 'sc_select'),
								"Date"	=> array('sc_date', 'sc_date_conv', 'sc_date_dif', 'sc_date_dif_2'),
								"Control"	=> array('sc_mail_send'),
								);
		break;

		case "filtro_onValidate":
			$arr_wizard	= array(	
								"SQL"	=> array('sc_lookup', 'sc_select'),
								"Date"	=> array('sc_date', 'sc_date_conv', 'sc_date_dif', 'sc_date_dif_2'),
								"Control"	=> array('sc_error_message', 'sc_mail_send'),
								);
		break;

		case "form_ajaxFieldonBlur":
			$arr_wizard	= array(	
								"SQL"	=> array('sc_lookup', 'sc_select'),
								"Date"	=> array('sc_date', 'sc_date_conv', 'sc_date_dif', 'sc_date_dif_2'),
								"Control"	=> array('sc_error_message'),
								);
		break;

		case "form_ajaxFieldonChange":
			$arr_wizard	= array(	
								"SQL"	=> array('sc_lookup', 'sc_select'),
								"Date"	=> array('sc_date', 'sc_date_conv', 'sc_date_dif', 'sc_date_dif_2'),
								"Control"	=> array('sc_error_message'),
								);
		break;

		case "form_ajaxFieldonClick":
			$arr_wizard	= array(	
								"SQL"	=> array('sc_lookup', 'sc_select'),
								"Date"	=> array('sc_date', 'sc_date_conv', 'sc_date_dif', 'sc_date_dif_2'),
								"Control"	=> array('sc_error_message'),
								);
		break;

		case "form_ajaxFieldonFocus":
			$arr_wizard	= array(	
								"SQL"	=> array('sc_lookup', 'sc_select'),
								"Date"	=> array('sc_date', 'sc_date_conv', 'sc_date_dif', 'sc_date_dif_2'),
								"Control"	=> array('sc_error_message'),
								);
		break;

		case "form_onAfterDelete":
			$arr_wizard	= array(	
								"SQL"	=> array('sc_exec_sql', 'sc_lookup', 'sc_select'),
								"Date"	=> array('sc_date', 'sc_date_conv', 'sc_date_dif', 'sc_date_dif_2'),
								"Control"	=> array('sc_error_message', 'sc_mail_send'),
								"Security"	=> array('sc_apl_status'),
								"Buttons"	=> array('sc_btn_display'),
								);
		break;

		case "form_onAfterDeleteAll":
			$arr_wizard	= array(	
								"SQL"	=> array('sc_exec_sql', 'sc_lookup', 'sc_select'),
								"Date"	=> array('sc_date', 'sc_date_conv', 'sc_date_dif', 'sc_date_dif_2'),
								"Control"	=> array('sc_changed', 'sc_error_message', 'sc_mail_send'),
								"Security"	=> array('sc_apl_status'),
								"Buttons"	=> array('sc_btn_display'),
								);
		break;

		case "form_onAfterInsert":
			$arr_wizard	= array(	
								"SQL"	=> array('sc_exec_sql', 'sc_lookup', 'sc_select'),
								"Date"	=> array('sc_date', 'sc_date_conv', 'sc_date_dif', 'sc_date_dif_2'),
								"Control"	=> array('sc_changed', 'sc_error_message', 'sc_mail_send'),
								"Security"	=> array('sc_apl_status'),
								"Buttons"	=> array('sc_btn_display'),
								);
		break;

		case "form_onAfterInsertAll":
			$arr_wizard	= array(	
								"SQL"	=> array('sc_exec_sql', 'sc_lookup', 'sc_select'),
								"Date"	=> array('sc_date', 'sc_date_conv', 'sc_date_dif', 'sc_date_dif_2'),
								"Control"	=> array('sc_error_message', 'sc_mail_send'),
								"Security"	=> array('sc_apl_status'),
								"Buttons"	=> array('sc_btn_display'),
								);
		break;

		case "form_onAfterUpdate":
			$arr_wizard	= array(	
								"SQL"	=> array('sc_exec_sql', 'sc_lookup', 'sc_select'),
								"Date"	=> array('sc_date', 'sc_date_conv', 'sc_date_dif', 'sc_date_dif_2'),
								"Control"	=> array('sc_changed', 'sc_error_message', 'sc_mail_send'),
								"Security"	=> array('sc_apl_status'),
								"Buttons"	=> array('sc_btn_display'),
								);
		break;

		case "form_onAfterUpdateAll":
			$arr_wizard	= array(	
								"SQL"	=> array('sc_exec_sql', 'sc_lookup', 'sc_select'),
								"Date"	=> array('sc_date', 'sc_date_conv', 'sc_date_dif', 'sc_date_dif_2'),
								"Control"	=> array('sc_error_message', 'sc_mail_send'),
								"Security"	=> array('sc_apl_status'),
								"Buttons"	=> array('sc_btn_display'),
								);
		break;

		case "form_onBeforeDelete":
			$arr_wizard	= array(	
								"SQL"	=> array('sc_exec_sql', 'sc_lookup', 'sc_select'),
								"Date"	=> array('sc_date', 'sc_date_conv', 'sc_date_dif', 'sc_date_dif_2'),
								"Control"	=> array('sc_changed', 'sc_error_message', 'sc_mail_send'),
								"Security"	=> array('sc_apl_status'),
								"Buttons"	=> array('sc_btn_display'),
								);
		break;

		case "form_onBeforeDelete_All":
			$arr_wizard	= array(	
								"SQL"	=> array('sc_exec_sql', 'sc_lookup', 'sc_select'),
								"Date"	=> array('sc_date', 'sc_date_conv', 'sc_date_dif', 'sc_date_dif_2'),
								"Control"	=> array('sc_error_message', 'sc_mail_send'),
								"Security"	=> array('sc_apl_status'),
								"Buttons"	=> array('sc_btn_display'),
								);
		break;

		case "form_onBeforeInsert":
			$arr_wizard	= array(	
								"SQL"	=> array('sc_exec_sql', 'sc_lookup', 'sc_select'),
								"Date"	=> array('sc_date', 'sc_date_conv', 'sc_date_dif', 'sc_date_dif_2'),
								"Control"	=> array('sc_changed', 'sc_error_message', 'sc_mail_send'),
								"Security"	=> array('sc_apl_status'),
								"Buttons"	=> array('sc_btn_display'),
								);
		break;

		case "form_onBeforeInsertAll":
			$arr_wizard	= array(	
								"SQL"	=> array('sc_exec_sql', 'sc_lookup', 'sc_select'),
								"Date"	=> array('sc_date', 'sc_date_conv', 'sc_date_dif', 'sc_date_dif_2'),
								"Control"	=> array('sc_error_message', 'sc_mail_send'),
								"Security"	=> array('sc_apl_status'),
								"Buttons"	=> array('sc_btn_display'),
								);
		break;

		case "form_onBeforeUpdate":
			$arr_wizard	= array(	
								"SQL"	=> array('sc_exec_sql', 'sc_lookup', 'sc_select'),
								"Date"	=> array('sc_date', 'sc_date_conv', 'sc_date_dif', 'sc_date_dif_2'),
								"Control"	=> array('sc_error_message', 'sc_mail_send'),
								"Security"	=> array('sc_apl_status'),
								"Buttons"	=> array('sc_btn_display'),
								);
		break;

		case "form_onBeforeUpdateall":
			$arr_wizard	= array(	
								"SQL"	=> array('sc_exec_sql', 'sc_lookup', 'sc_select'),
								"Date"	=> array('sc_date', 'sc_date_conv', 'sc_date_dif', 'sc_date_dif_2'),
								"Control"	=> array('sc_error_message', 'sc_mail_send'),
								"Security"	=> array('sc_apl_status'),
								"Buttons"	=> array('sc_btn_display'),
								);
		break;

		case "form_onButtonClick":
			$arr_wizard	= array(	
								"SQL"	=> array('sc_exec_sql', 'sc_lookup', 'sc_select'),
								"Date"	=> array('sc_date', 'sc_date_conv', 'sc_date_dif', 'sc_date_dif_2'),
								"Control"	=> array('sc_confirm', 'sc_mail_send'),
								"Security"	=> array('sc_apl_status'),
								);
		break;

		case "form_onScriptInit":
			$arr_wizard	= array(	
								"SQL"	=> array('sc_exec_sql', 'sc_lookup', 'sc_select'),
								"Date"	=> array('sc_date', 'sc_date_conv', 'sc_date_dif', 'sc_date_dif_2'),
								"Control"	=> array('sc_alert', 'sc_error_message', 'sc_mail_send'),
								"Security"	=> array('sc_apl_status'),
								"Buttons"	=> array('sc_btn_display'),
								);
		break;

		case "form_onLoadAll":
			$arr_wizard	= array(	
								"SQL"	=> array('sc_exec_sql', 'sc_lookup', 'sc_select'),
								"Date"	=> array('sc_date', 'sc_date_conv', 'sc_date_dif', 'sc_date_dif_2'),
								"Control"	=> array('sc_alert', 'sc_error_message', 'sc_mail_send'),
								"Security"	=> array('sc_apl_status'),
								"Buttons"	=> array('sc_btn_display'),
								);
		break;

		case "form_onRecord":
			$arr_wizard	= array(	
								"SQL"	=> array('sc_exec_sql', 'sc_lookup', 'sc_select'),
								"Date"	=> array('sc_date', 'sc_date_conv', 'sc_date_dif', 'sc_date_dif_2'),
								"Control"	=> array('sc_alert', 'sc_error_message', 'sc_mail_send'),
								"Security"	=> array('sc_apl_status'),
								"Buttons"	=> array('sc_btn_display'),
								);
		break;

		case "form_onRefresh":
			$arr_wizard	= array(	
								"SQL"	=> array('sc_exec_sql', 'sc_lookup', 'sc_select'),
								"Date"	=> array('sc_date', 'sc_date_conv', 'sc_date_dif', 'sc_date_dif_2'),
								"Control"	=> array('sc_alert', 'sc_changed', 'sc_error_message'),
								"Security"	=> array('sc_apl_status'),
								"Buttons"	=> array('sc_btn_display'),
								);
		break;

		case "form_onValidate":
			$arr_wizard	= array(	
								"SQL"	=> array('sc_exec_sql', 'sc_lookup', 'sc_select'),
								"Date"	=> array('sc_date', 'sc_date_conv', 'sc_date_dif', 'sc_date_dif_2'),
								"Control"	=> array('sc_alert', 'sc_changed', 'sc_error_message', 'sc_mail_send'),
								"Security"	=> array('sc_apl_status'),
								"Buttons"	=> array('sc_btn_display'),
								);
		break;

		case "form_controle_ajaxFieldonBlur":
			$arr_wizard	= array(	
								"SQL"	=> array('sc_lookup', 'sc_select'),
								"Date"	=> array('sc_date', 'sc_date_conv', 'sc_date_dif', 'sc_date_dif_2'),
								"Control"	=> array('sc_error_message'),
								);
		break;

		case "form_controle_ajaxFieldonChange":
			$arr_wizard	= array(	
								"SQL"	=> array('sc_lookup'),
								"Date"	=> array('sc_date', 'sc_date_conv', 'sc_date_dif', 'sc_date_dif_2'),
								"Control"	=> array('sc_error_message'),
								);
		break;

		case "form_controle_ajaxFieldonClick":
			$arr_wizard	= array(	
								"SQL"	=> array('sc_lookup', 'sc_select'),
								"Date"	=> array('sc_date', 'sc_date_conv', 'sc_date_dif', 'sc_date_dif_2'),
								"Control"	=> array('sc_error_message'),
								);
		break;

		case "form_controle_ajaxFieldonFocus":
			$arr_wizard	= array(	
								"SQL"	=> array('sc_lookup', 'sc_select'),
								"Date"	=> array('sc_date', 'sc_date_conv', 'sc_date_dif', 'sc_date_dif_2'),
								"Control"	=> array('sc_error_message', 'sc_link'),
								);
		break;

		case "form_controle_onButtonClick":
			$arr_wizard	= array(	
								"SQL"	=> array('sc_exec_sql', 'sc_lookup', 'sc_select'),
								"Date"	=> array('sc_date', 'sc_date_conv', 'sc_date_dif', 'sc_date_dif_2'),
								"Control"	=> array('sc_confirm', 'sc_mail_send'),
								"Security"	=> array('sc_apl_status'),
								);
		break;

		case "form_controle_onScriptInit":
			$arr_wizard	= array(	
								"SQL"	=> array('sc_exec_sql', 'sc_lookup', 'sc_select'),
								"Date"	=> array('sc_date', 'sc_date_conv', 'sc_date_dif', 'sc_date_dif_2'),
								"Control"	=> array('sc_alert', 'sc_changed', 'sc_error_message', 'sc_mail_send'),
								"Security"	=> array('sc_apl_status'),
								"Buttons"	=> array('sc_btn_display'),
								);
		break;

		case "form_controle_onLoadAll":
			$arr_wizard	= array(	
								"SQL"	=> array('sc_lookup', 'sc_select'),
								"Date"	=> array('sc_date', 'sc_date_conv', 'sc_date_dif', 'sc_date_dif_2'),
								"Control"	=> array('sc_alert', 'sc_error_message', 'sc_mail_send'),
								"Security"	=> array('sc_apl_status'),
								"Buttons"	=> array('sc_btn_display'),
								);
		break;

		case "form_controle_onRefresh":
			$arr_wizard	= array(	
								"SQL"	=> array('sc_lookup', 'sc_select'),
								"Date"	=> array('sc_date', 'sc_date_conv', 'sc_date_dif', 'sc_date_dif_2'),
								"Control"	=> array('sc_changed', 'sc_error_message'),
								);
		break;

		case "form_controle_onValidate":
			$arr_wizard	= array(	
								"SQL"	=> array('sc_exec_sql', 'sc_lookup', 'sc_select'),
								"Date"	=> array('sc_date', 'sc_date_conv', 'sc_date_dif', 'sc_date_dif_2'),
								"Control"	=> array('sc_alert', 'sc_changed', 'sc_error_message', 'sc_mail_send'),
								"Security"	=> array('sc_apl_status'),
								"Buttons"	=> array('sc_btn_display'),
								);
		break;

		case "menu_onExecute":
			$arr_wizard	= array(	
								"SQL"	=> array('sc_lookup', 'sc_select'),
								"Date"	=> array('sc_date', 'sc_date_conv', 'sc_date_dif', 'sc_date_dif_2'),
								);
		break;

		case "menu_onLoad":
			$arr_wizard	= array(	
								"SQL"	=> array('sc_lookup', 'sc_select'),
								"Date"	=> array('sc_date', 'sc_date_conv', 'sc_date_dif', 'sc_date_dif_2'),
								"Control"	=> array('sc_mail_send'),
								"Security"	=> array('sc_apl_status'),
								"Menu"	=> array('sc_menu_delete', 'sc_menu_disable'),
								);
		break;

		case "menutree_onExecute":
			$arr_wizard	= array(	
								"SQL"	=> array('sc_lookup', 'sc_select'),
								"Date"	=> array('sc_date', 'sc_date_conv', 'sc_date_dif', 'sc_date_dif_2'),
								);
		break;

		case "menutree_onLoad":
			$arr_wizard	= array(	
								"SQL"	=> array('sc_lookup', 'sc_select'),
								"Date"	=> array('sc_date', 'sc_date_conv', 'sc_date_dif', 'sc_date_dif_2'),
								"Control"	=> array('sc_mail_send'),
								"Security"	=> array('sc_apl_status'),
								"Menu"	=> array('sc_menu_delete', 'sc_menu_disable'),
								);
		break;

		case "reportpdf_onFooter":
			$arr_wizard	= array(	
								"SQL"	=> array('sc_lookup', 'sc_select'),
								"Date"	=> array('sc_date', 'sc_date_conv', 'sc_date_dif', 'sc_date_dif_2'),
								);
		break;

		case "reportpdf_onHeader":
			$arr_wizard	= array(	
								"SQL"	=> array('sc_lookup', 'sc_select'),
								"Date"	=> array('sc_date', 'sc_date_conv', 'sc_date_dif', 'sc_date_dif_2'),
								);
		break;

		case "reportpdf_onScriptInit":
			$arr_wizard	= array(	
								"SQL"	=> array('sc_exec_sql', 'sc_lookup', 'sc_select'),
								"Date"	=> array('sc_date', 'sc_date_conv', 'sc_date_dif', 'sc_date_dif_2'),
								"Control"	=> array('sc_mail_send'),
								"Security"	=> array('sc_apl_status'),
								);
		break;

		case "reportpdf_onRecord":
			$arr_wizard	= array(	
								"SQL"	=> array('sc_lookup', 'sc_select'),
								"Date"	=> array('sc_date', 'sc_date_conv', 'sc_date_dif', 'sc_date_dif_2'),
								"Control"	=> array('sc_link', 'sc_mail_send', 'sc_make_link'),
								);
		break;
	}


	return $arr_wizard;

}
function nm_mceditorautocomplete_array($app, $evento) {
    $arr_wizard	= "";


	switch (conv_app_name($app)."_".$evento) {

		case "todas_allMacros":
			$arr_wizard	= array('sc_begin_trans_@#AC@#_sc_begin_trans(&quot;connection&quot;)', 'sc_commit_trans_@#AC@#_sc_commit_trans(&quot;connection&quot;)', 'sc_error_continue_@#AC@#_sc_error_continue(&quot;event&quot;)', 'sc_error_delete_@#AC@#_{sc_error_delete}', 'sc_error_insert_@#AC@#_{sc_error_insert}', 'sc_error_update_@#AC@#_{sc_error_update}', 'sc_exec_sql_@#AC@#_sc_exec_sql(&quot;sql command&quot;, &quot;connection&quot;)', 'sc_lookup_@#AC@#_sc_lookup(dataset, &quot;sql command&quot;, &quot;connection&quot;)', 'sc_rollback_trans_@#AC@#_sc_rollback_trans(&quot;connection&quot;)', 'sc_select_@#AC@#_sc_select(dataset, &quot;sql command&quot;, &quot;connection&quot;)', 'sc_select_field_@#AC@#_sc_select_field({field})', 'sc_select_order_@#AC@#_sc_select_order(field)', 'sc_select_where_@#AC@#_sc_select_where(add)', 'sc_sql_injection_@#AC@#_sc_sql_injection(field/variable)', 'sc_where_current_@#AC@#_{sc_where_current}', 'sc_where_orig_@#AC@#_{sc_where_orig}', 'sc_date_@#AC@#_sc_date(date, format, operator, D,M,Y)', 'sc_date_conv_@#AC@#_sc_date_conv({field_date}, &quot;fmt_input&quot;, &quot;fmt_output&quot;)', 'sc_date_dif_@#AC@#_sc_date_dif(date1, format date1, date2, format date 2)', 'sc_date_dif_2_@#AC@#_sc_date_dif_2(date1, format date1, date2, format date 2, option)', 'sc_date_empty_@#AC@#_sc_date_empty({field_date})', 'sc_alert_@#AC@#_sc_alert(&quot;message&quot;)', 'sc_apl_conf_@#AC@#_sc_apl_conf(Application, Property, value)', 'sc_calc_dv_@#AC@#_sc_calc_dv(dv, rest, value, module, weights,type)', 'sc_changed_@#AC@#_sc_changed({field})', 'sc_confirm_@#AC@#_sc_confirm(&quot;message&quot;)', 'sc_decode_@#AC@#_sc_decode(field/variable)', 'sc_encode_@#AC@#_sc_encode(field/variable)', 'sc_error_exit_@#AC@#_sc_error_exit(URL/Application, target)', 'sc_error_message_@#AC@#_sc_error_message(&quot;text&quot;)', 'sc_exit_@#AC@#_sc_exit(Option)', 'sc_groupby_label_@#AC@#_sc_groupby_label(field)', 'sc_image_@#AC@#_sc_image(img1.jpg,img2.gif,...)', 'sc_include_@#AC@#_sc_include(file, source)', 'sc_label_@#AC@#_sc_label(field)', 'sc_link_@#AC@#_sc_link(column, application, parameters, hint, target)', 'sc_mail_send_@#AC@#_sc_mail_send(smtp, usr, pw, de, para, assunto, mensagem, tipo_mens, c&oacute;pias, tp_c&oacute;pias, porta, tp_conexao, attachment)', 'sc_make_link_@#AC@#_sc_make_link(application, parameters)', 'sc_redir_@#AC@#_sc_redir(apl, parm1; parm2; ..., target)', 'sc_reset_global_@#AC@#_sc_reset_global([var_glo1], [var_glo2] ...)', 'sc_seq_register_@#AC@#_{sc_seq_register}', 'sc_set_global_@#AC@#_sc_set_global($var_1, {field_x}, ...)', 'sc_site_ssl_@#AC@#_sc_site_ssl', 'sc_trunc_num_@#AC@#_sc_trunc_num(field,  qt_dec)', 'sc_url_exit_@#AC@#_sc_url_exit(url)', 'sc_warning_@#AC@#_sc_warning = \'on\'/\'off\'', 'sc_zip_file_@#AC@#_sc_zip_file(files, zip)', 'sc_where_filter_@#AC@#_{sc_where_filter}', 'sc_apl_status_@#AC@#_sc_apl_status(application, status)', 'sc_reset_apl_conf_@#AC@#_sc_reset_apl_conf(Application, Property)', 'sc_reset_apl_status_@#AC@#_sc_reset_apl_status()', 'sc_reset_menu_delete_@#AC@#_sc_reset_menu_delete()', 'sc_reset_menu_disable_@#AC@#_sc_reset_menu_disable()', 'sc_block_display_@#AC@#_sc_block_display(&quot;block&quot;,&quot;on/off&quot;)', 'sc_field_color_@#AC@#_sc_field_color(&quot;field&quot;, &quot;color&quot;)', 'sc_field_display_@#AC@#_sc_field_display({field}, on/off)', 'sc_field_readonly_@#AC@#_sc_field_readonly({field})', 'sc_format_num_@#AC@#_sc_format_num(field, group_symb,  dec_symb, amount_dec, fill_zeros,   side_neg,  currency_symb, side_currency_symb)', 'sc_form_show_@#AC@#_sc_form_show = \'on\'/\'off\'', 'sc_btn_delete_@#AC@#_sc_btn_delete', 'sc_btn_display_@#AC@#_sc_btn_display(&quot;button&quot;,&quot;on/off&quot;)', 'sc_btn_insert_@#AC@#_sc_btn_insert', 'sc_btn_new_@#AC@#_sc_btn_new', 'sc_btn_update_@#AC@#_sc_btn_update', 'sc_menu_delete_@#AC@#_sc_menu_deleteid_item1,id_item2,...', 'sc_menu_disable_@#AC@#_sc_menu_disableid_item1,id_item2,...', 'sc_script_name_@#AC@#_{sc_script_name}');
		break;

		case "blank_onExecute":
			$arr_wizard	= array('sc_exec_sql_@#AC@#_sc_exec_sql(&quot;sql command&quot;, &quot;connection&quot;)', 'sc_lookup_@#AC@#_sc_lookup(dataset, &quot;sql command&quot;, &quot;connection&quot;)', 'sc_select_@#AC@#_sc_select(dataset, &quot;sql command&quot;, &quot;connection&quot;)', 'sc_sql_injection_@#AC@#_sc_sql_injection(field/variable)', 'sc_date_dif_@#AC@#_sc_date_dif(date1, format date1, date2, format date 2)', 'sc_date_dif_2_@#AC@#_sc_date_dif_2(date1, format date1, date2, format date 2, option)', 'sc_apl_conf_@#AC@#_sc_apl_conf(Application, Property, value)', 'sc_calc_dv_@#AC@#_sc_calc_dv(dv, rest, value, module, weights,type)', 'sc_decode_@#AC@#_sc_decode(field/variable)', 'sc_encode_@#AC@#_sc_encode(field/variable)', 'sc_error_exit_@#AC@#_sc_error_exit(URL/Application, target)', 'sc_error_message_@#AC@#_sc_error_message(&quot;text&quot;)', 'sc_image_@#AC@#_sc_image(img1.jpg,img2.gif,...)', 'sc_include_@#AC@#_sc_include(file, source)', 'sc_mail_send_@#AC@#_sc_mail_send(smtp, usr, pw, de, para, assunto, mensagem, tipo_mens, c&oacute;pias, tp_c&oacute;pias, porta, tp_conexao, attachment)', 'sc_make_link_@#AC@#_sc_make_link(application, parameters)', 'sc_redir_@#AC@#_sc_redir(apl, parm1; parm2; ..., target)', 'sc_site_ssl_@#AC@#_sc_site_ssl', 'sc_zip_file_@#AC@#_sc_zip_file(files, zip)', 'sc_apl_status_@#AC@#_sc_apl_status(application, status)');
		break;

		case "consulta_onButtonClick":
			$arr_wizard	= array('sc_begin_trans_@#AC@#_sc_begin_trans(&quot;connection&quot;)', 'sc_commit_trans_@#AC@#_sc_commit_trans(&quot;connection&quot;)', 'sc_exec_sql_@#AC@#_sc_exec_sql(&quot;sql command&quot;, &quot;connection&quot;)', 'sc_lookup_@#AC@#_sc_lookup(dataset, &quot;sql command&quot;, &quot;connection&quot;)', 'sc_rollback_trans_@#AC@#_sc_rollback_trans(&quot;connection&quot;)', 'sc_select_@#AC@#_sc_select(dataset, &quot;sql command&quot;, &quot;connection&quot;)', 'sc_date_@#AC@#_sc_date(date, format, operator, D,M,Y)', 'sc_date_conv_@#AC@#_sc_date_conv({field_date}, &quot;fmt_input&quot;, &quot;fmt_output&quot;)', 'sc_date_dif_@#AC@#_sc_date_dif(date1, format date1, date2, format date 2)', 'sc_date_dif_2_@#AC@#_sc_date_dif_2(date1, format date1, date2, format date 2, option)', 'sc_apl_conf_@#AC@#_sc_apl_conf(Application, Property, value)', 'sc_calc_dv_@#AC@#_sc_calc_dv(dv, rest, value, module, weights,type)', 'sc_confirm_@#AC@#_sc_confirm(&quot;message&quot;)', 'sc_exit_@#AC@#_sc_exit(Option)', 'sc_include_@#AC@#_sc_include(file, source)', 'sc_mail_send_@#AC@#_sc_mail_send(smtp, usr, pw, de, para, assunto, mensagem, tipo_mens, c&oacute;pias, tp_c&oacute;pias, porta, tp_conexao, attachment)', 'sc_redir_@#AC@#_sc_redir(apl, parm1; parm2; ..., target)', 'sc_reset_global_@#AC@#_sc_reset_global([var_glo1], [var_glo2] ...)', 'sc_set_global_@#AC@#_sc_set_global($var_1, {field_x}, ...)', 'sc_trunc_num_@#AC@#_sc_trunc_num(field,  qt_dec)', 'sc_warning_@#AC@#_sc_warning = \'on\'/\'off\'', 'sc_zip_file_@#AC@#_sc_zip_file(files, zip)', 'sc_apl_status_@#AC@#_sc_apl_status(application, status)', 'sc_reset_apl_conf_@#AC@#_sc_reset_apl_conf(Application, Property)', 'sc_reset_apl_status_@#AC@#_sc_reset_apl_status()', 'sc_format_num_@#AC@#_sc_format_num(field, group_symb,  dec_symb, amount_dec, fill_zeros,   side_neg,  currency_symb, side_currency_symb)');
		break;

		case "consulta_onFooter":
			$arr_wizard	= array('sc_lookup_@#AC@#_sc_lookup(dataset, &quot;sql command&quot;, &quot;connection&quot;)', 'sc_select_@#AC@#_sc_select(dataset, &quot;sql command&quot;, &quot;connection&quot;)', 'sc_date_@#AC@#_sc_date(date, format, operator, D,M,Y)', 'sc_date_conv_@#AC@#_sc_date_conv({field_date}, &quot;fmt_input&quot;, &quot;fmt_output&quot;)', 'sc_date_dif_@#AC@#_sc_date_dif(date1, format date1, date2, format date 2)', 'sc_date_dif_2_@#AC@#_sc_date_dif_2(date1, format date1, date2, format date 2, option)', 'sc_calc_dv_@#AC@#_sc_calc_dv(dv, rest, value, module, weights,type)', 'sc_include_@#AC@#_sc_include(file, source)', 'sc_reset_global_@#AC@#_sc_reset_global([var_glo1], [var_glo2] ...)', 'sc_set_global_@#AC@#_sc_set_global($var_1, {field_x}, ...)', 'sc_trunc_num_@#AC@#_sc_trunc_num(field,  qt_dec)', 'sc_warning_@#AC@#_sc_warning = \'on\'/\'off\'', 'sc_format_num_@#AC@#_sc_format_num(field, group_symb,  dec_symb, amount_dec, fill_zeros,   side_neg,  currency_symb, side_currency_symb)');
		break;

		case "consulta_onGroupBy":
			$arr_wizard	= array('sc_lookup_@#AC@#_sc_lookup(dataset, &quot;sql command&quot;, &quot;connection&quot;)', 'sc_select_@#AC@#_sc_select(dataset, &quot;sql command&quot;, &quot;connection&quot;)', 'sc_date_@#AC@#_sc_date(date, format, operator, D,M,Y)', 'sc_date_conv_@#AC@#_sc_date_conv({field_date}, &quot;fmt_input&quot;, &quot;fmt_output&quot;)', 'sc_date_dif_@#AC@#_sc_date_dif(date1, format date1, date2, format date 2)', 'sc_date_dif_2_@#AC@#_sc_date_dif_2(date1, format date1, date2, format date 2, option)', 'sc_calc_dv_@#AC@#_sc_calc_dv(dv, rest, value, module, weights,type)', 'sc_groupby_label_@#AC@#_sc_groupby_label(field)', 'sc_include_@#AC@#_sc_include(file, source)', 'sc_reset_global_@#AC@#_sc_reset_global([var_glo1], [var_glo2] ...)', 'sc_set_global_@#AC@#_sc_set_global($var_1, {field_x}, ...)', 'sc_trunc_num_@#AC@#_sc_trunc_num(field,  qt_dec)', 'sc_warning_@#AC@#_sc_warning = \'on\'/\'off\'', 'sc_format_num_@#AC@#_sc_format_num(field, group_symb,  dec_symb, amount_dec, fill_zeros,   side_neg,  currency_symb, side_currency_symb)');
		break;

		case "consulta_onHeader":
			$arr_wizard	= array('sc_lookup_@#AC@#_sc_lookup(dataset, &quot;sql command&quot;, &quot;connection&quot;)', 'sc_select_@#AC@#_sc_select(dataset, &quot;sql command&quot;, &quot;connection&quot;)', 'sc_date_@#AC@#_sc_date(date, format, operator, D,M,Y)', 'sc_date_conv_@#AC@#_sc_date_conv({field_date}, &quot;fmt_input&quot;, &quot;fmt_output&quot;)', 'sc_date_dif_@#AC@#_sc_date_dif(date1, format date1, date2, format date 2)', 'sc_date_dif_2_@#AC@#_sc_date_dif_2(date1, format date1, date2, format date 2, option)', 'sc_calc_dv_@#AC@#_sc_calc_dv(dv, rest, value, module, weights,type)', 'sc_include_@#AC@#_sc_include(file, source)', 'sc_reset_global_@#AC@#_sc_reset_global([var_glo1], [var_glo2] ...)', 'sc_set_global_@#AC@#_sc_set_global($var_1, {field_x}, ...)', 'sc_trunc_num_@#AC@#_sc_trunc_num(field,  qt_dec)', 'sc_warning_@#AC@#_sc_warning = \'on\'/\'off\'', 'sc_format_num_@#AC@#_sc_format_num(field, group_symb,  dec_symb, amount_dec, fill_zeros,   side_neg,  currency_symb, side_currency_symb)');
		break;

		case "consulta_onScriptInit":
			$arr_wizard	= array('sc_exec_sql_@#AC@#_sc_exec_sql(&quot;sql command&quot;, &quot;connection&quot;)', 'sc_lookup_@#AC@#_sc_lookup(dataset, &quot;sql command&quot;, &quot;connection&quot;)', 'sc_select_@#AC@#_sc_select(dataset, &quot;sql command&quot;, &quot;connection&quot;)', 'sc_select_field_@#AC@#_sc_select_field({field})', 'sc_select_order_@#AC@#_sc_select_order(field)', 'sc_select_where_@#AC@#_sc_select_where(add)', 'sc_where_current_@#AC@#_{sc_where_current}', 'sc_where_orig_@#AC@#_{sc_where_orig}', 'sc_date_@#AC@#_sc_date(date, format, operator, D,M,Y)', 'sc_date_conv_@#AC@#_sc_date_conv({field_date}, &quot;fmt_input&quot;, &quot;fmt_output&quot;)', 'sc_date_dif_@#AC@#_sc_date_dif(date1, format date1, date2, format date 2)', 'sc_date_dif_2_@#AC@#_sc_date_dif_2(date1, format date1, date2, format date 2, option)', 'sc_apl_conf_@#AC@#_sc_apl_conf(Application, Property, value)', 'sc_calc_dv_@#AC@#_sc_calc_dv(dv, rest, value, module, weights,type)', 'sc_decode_@#AC@#_sc_decode(field/variable)', 'sc_encode_@#AC@#_sc_encode(field/variable)', 'sc_image_@#AC@#_sc_image(img1.jpg,img2.gif,...)', 'sc_include_@#AC@#_sc_include(file, source)', 'sc_label_@#AC@#_sc_label(field)', 'sc_mail_send_@#AC@#_sc_mail_send(smtp, usr, pw, de, para, assunto, mensagem, tipo_mens, c&oacute;pias, tp_c&oacute;pias, porta, tp_conexao, attachment)', 'sc_redir_@#AC@#_sc_redir(apl, parm1; parm2; ..., target)', 'sc_reset_global_@#AC@#_sc_reset_global([var_glo1], [var_glo2] ...)', 'sc_set_global_@#AC@#_sc_set_global($var_1, {field_x}, ...)', 'sc_site_ssl_@#AC@#_sc_site_ssl', 'sc_trunc_num_@#AC@#_sc_trunc_num(field,  qt_dec)', 'sc_url_exit_@#AC@#_sc_url_exit(url)', 'sc_warning_@#AC@#_sc_warning = \'on\'/\'off\'', 'sc_zip_file_@#AC@#_sc_zip_file(files, zip)', 'sc_where_filter_@#AC@#_{sc_where_filter}', 'sc_apl_status_@#AC@#_sc_apl_status(application, status)', 'sc_reset_apl_conf_@#AC@#_sc_reset_apl_conf(Application, Property)', 'sc_reset_apl_status_@#AC@#_sc_reset_apl_status()', 'sc_block_display_@#AC@#_sc_block_display(&quot;block&quot;,&quot;on/off&quot;)', 'sc_field_color_@#AC@#_sc_field_color(&quot;field&quot;, &quot;color&quot;)', 'sc_field_display_@#AC@#_sc_field_display({field}, on/off)', 'sc_format_num_@#AC@#_sc_format_num(field, group_symb,  dec_symb, amount_dec, fill_zeros,   side_neg,  currency_symb, side_currency_symb)', 'sc_btn_display_@#AC@#_sc_btn_display(&quot;button&quot;,&quot;on/off&quot;)');
		break;

		case "consulta_onRecord":
			$arr_wizard	= array('sc_lookup_@#AC@#_sc_lookup(dataset, &quot;sql command&quot;, &quot;connection&quot;)', 'sc_select_@#AC@#_sc_select(dataset, &quot;sql command&quot;, &quot;connection&quot;)', 'sc_where_current_@#AC@#_{sc_where_current}', 'sc_where_orig_@#AC@#_{sc_where_orig}', 'sc_date_@#AC@#_sc_date(date, format, operator, D,M,Y)', 'sc_date_conv_@#AC@#_sc_date_conv({field_date}, &quot;fmt_input&quot;, &quot;fmt_output&quot;)', 'sc_date_dif_@#AC@#_sc_date_dif(date1, format date1, date2, format date 2)', 'sc_date_dif_2_@#AC@#_sc_date_dif_2(date1, format date1, date2, format date 2, option)', 'sc_calc_dv_@#AC@#_sc_calc_dv(dv, rest, value, module, weights,type)', 'sc_include_@#AC@#_sc_include(file, source)', 'sc_link_@#AC@#_sc_link(column, application, parameters, hint, target)', 'sc_mail_send_@#AC@#_sc_mail_send(smtp, usr, pw, de, para, assunto, mensagem, tipo_mens, c&oacute;pias, tp_c&oacute;pias, porta, tp_conexao, attachment)', 'sc_make_link_@#AC@#_sc_make_link(application, parameters)', 'sc_reset_global_@#AC@#_sc_reset_global([var_glo1], [var_glo2] ...)', 'sc_seq_register_@#AC@#_{sc_seq_register}', 'sc_set_global_@#AC@#_sc_set_global($var_1, {field_x}, ...)', 'sc_trunc_num_@#AC@#_sc_trunc_num(field,  qt_dec)', 'sc_warning_@#AC@#_sc_warning = \'on\'/\'off\'', 'sc_zip_file_@#AC@#_sc_zip_file(files, zip)', 'sc_where_filter_@#AC@#_{sc_where_filter}', 'sc_field_color_@#AC@#_sc_field_color(&quot;field&quot;, &quot;color&quot;)', 'sc_format_num_@#AC@#_sc_format_num(field, group_symb,  dec_symb, amount_dec, fill_zeros,   side_neg,  currency_symb, side_currency_symb)');
		break;

		case "filtro_onScriptInit":
			$arr_wizard	= array('sc_lookup_@#AC@#_sc_lookup(dataset, &quot;sql command&quot;, &quot;connection&quot;)', 'sc_select_@#AC@#_sc_select(dataset, &quot;sql command&quot;, &quot;connection&quot;)', 'sc_date_@#AC@#_sc_date(date, format, operator, D,M,Y)', 'sc_date_conv_@#AC@#_sc_date_conv({field_date}, &quot;fmt_input&quot;, &quot;fmt_output&quot;)', 'sc_date_dif_@#AC@#_sc_date_dif(date1, format date1, date2, format date 2)', 'sc_date_dif_2_@#AC@#_sc_date_dif_2(date1, format date1, date2, format date 2, option)', 'sc_apl_conf_@#AC@#_sc_apl_conf(Application, Property, value)', 'sc_calc_dv_@#AC@#_sc_calc_dv(dv, rest, value, module, weights,type)', 'sc_error_message_@#AC@#_sc_error_message(&quot;text&quot;)', 'sc_image_@#AC@#_sc_image(img1.jpg,img2.gif,...)', 'sc_include_@#AC@#_sc_include(file, source)', 'sc_mail_send_@#AC@#_sc_mail_send(smtp, usr, pw, de, para, assunto, mensagem, tipo_mens, c&oacute;pias, tp_c&oacute;pias, porta, tp_conexao, attachment)', 'sc_redir_@#AC@#_sc_redir(apl, parm1; parm2; ..., target)', 'sc_reset_global_@#AC@#_sc_reset_global([var_glo1], [var_glo2] ...)', 'sc_set_global_@#AC@#_sc_set_global($var_1, {field_x}, ...)', 'sc_trunc_num_@#AC@#_sc_trunc_num(field,  qt_dec)', 'sc_warning_@#AC@#_sc_warning = \'on\'/\'off\'', 'sc_zip_file_@#AC@#_sc_zip_file(files, zip)', 'sc_apl_status_@#AC@#_sc_apl_status(application, status)', 'sc_reset_apl_conf_@#AC@#_sc_reset_apl_conf(Application, Property)', 'sc_reset_apl_status_@#AC@#_sc_reset_apl_status()', 'sc_format_num_@#AC@#_sc_format_num(field, group_symb,  dec_symb, amount_dec, fill_zeros,   side_neg,  currency_symb, side_currency_symb)');
		break;

		case "filtro_onRefresh":
			$arr_wizard	= array('sc_lookup_@#AC@#_sc_lookup(dataset, &quot;sql command&quot;, &quot;connection&quot;)', 'sc_select_@#AC@#_sc_select(dataset, &quot;sql command&quot;, &quot;connection&quot;)', 'sc_date_@#AC@#_sc_date(date, format, operator, D,M,Y)', 'sc_date_conv_@#AC@#_sc_date_conv({field_date}, &quot;fmt_input&quot;, &quot;fmt_output&quot;)', 'sc_date_dif_@#AC@#_sc_date_dif(date1, format date1, date2, format date 2)', 'sc_date_dif_2_@#AC@#_sc_date_dif_2(date1, format date1, date2, format date 2, option)', 'sc_date_empty_@#AC@#_sc_date_empty({field_date})', 'sc_calc_dv_@#AC@#_sc_calc_dv(dv, rest, value, module, weights,type)', 'sc_error_message_@#AC@#_sc_error_message(&quot;text&quot;)', 'sc_include_@#AC@#_sc_include(file, source)', 'sc_reset_global_@#AC@#_sc_reset_global([var_glo1], [var_glo2] ...)', 'sc_set_global_@#AC@#_sc_set_global($var_1, {field_x}, ...)', 'sc_trunc_num_@#AC@#_sc_trunc_num(field,  qt_dec)', 'sc_warning_@#AC@#_sc_warning = \'on\'/\'off\'', 'sc_format_num_@#AC@#_sc_format_num(field, group_symb,  dec_symb, amount_dec, fill_zeros,   side_neg,  currency_symb, side_currency_symb)');
		break;

		case "filtro_onSave":
			$arr_wizard	= array('sc_lookup_@#AC@#_sc_lookup(dataset, &quot;sql command&quot;, &quot;connection&quot;)', 'sc_select_@#AC@#_sc_select(dataset, &quot;sql command&quot;, &quot;connection&quot;)', 'sc_date_@#AC@#_sc_date(date, format, operator, D,M,Y)', 'sc_date_conv_@#AC@#_sc_date_conv({field_date}, &quot;fmt_input&quot;, &quot;fmt_output&quot;)', 'sc_date_dif_@#AC@#_sc_date_dif(date1, format date1, date2, format date 2)', 'sc_date_dif_2_@#AC@#_sc_date_dif_2(date1, format date1, date2, format date 2, option)', 'sc_calc_dv_@#AC@#_sc_calc_dv(dv, rest, value, module, weights,type)', 'sc_include_@#AC@#_sc_include(file, source)', 'sc_mail_send_@#AC@#_sc_mail_send(smtp, usr, pw, de, para, assunto, mensagem, tipo_mens, c&oacute;pias, tp_c&oacute;pias, porta, tp_conexao, attachment)', 'sc_reset_global_@#AC@#_sc_reset_global([var_glo1], [var_glo2] ...)', 'sc_set_global_@#AC@#_sc_set_global($var_1, {field_x}, ...)', 'sc_trunc_num_@#AC@#_sc_trunc_num(field,  qt_dec)', 'sc_warning_@#AC@#_sc_warning = \'on\'/\'off\'', 'sc_zip_file_@#AC@#_sc_zip_file(files, zip)', 'sc_format_num_@#AC@#_sc_format_num(field, group_symb,  dec_symb, amount_dec, fill_zeros,   side_neg,  currency_symb, side_currency_symb)');
		break;

		case "filtro_onValidate":
			$arr_wizard	= array('sc_lookup_@#AC@#_sc_lookup(dataset, &quot;sql command&quot;, &quot;connection&quot;)', 'sc_select_@#AC@#_sc_select(dataset, &quot;sql command&quot;, &quot;connection&quot;)', 'sc_date_@#AC@#_sc_date(date, format, operator, D,M,Y)', 'sc_date_conv_@#AC@#_sc_date_conv({field_date}, &quot;fmt_input&quot;, &quot;fmt_output&quot;)', 'sc_date_dif_@#AC@#_sc_date_dif(date1, format date1, date2, format date 2)', 'sc_date_dif_2_@#AC@#_sc_date_dif_2(date1, format date1, date2, format date 2, option)', 'sc_date_empty_@#AC@#_sc_date_empty({field_date})', 'sc_calc_dv_@#AC@#_sc_calc_dv(dv, rest, value, module, weights,type)', 'sc_error_message_@#AC@#_sc_error_message(&quot;text&quot;)', 'sc_include_@#AC@#_sc_include(file, source)', 'sc_mail_send_@#AC@#_sc_mail_send(smtp, usr, pw, de, para, assunto, mensagem, tipo_mens, c&oacute;pias, tp_c&oacute;pias, porta, tp_conexao, attachment)', 'sc_reset_global_@#AC@#_sc_reset_global([var_glo1], [var_glo2] ...)', 'sc_set_global_@#AC@#_sc_set_global($var_1, {field_x}, ...)', 'sc_trunc_num_@#AC@#_sc_trunc_num(field,  qt_dec)', 'sc_warning_@#AC@#_sc_warning = \'on\'/\'off\'', 'sc_zip_file_@#AC@#_sc_zip_file(files, zip)', 'sc_format_num_@#AC@#_sc_format_num(field, group_symb,  dec_symb, amount_dec, fill_zeros,   side_neg,  currency_symb, side_currency_symb)');
		break;

		case "form_ajaxFieldonBlur":
			$arr_wizard	= array('sc_lookup_@#AC@#_sc_lookup(dataset, &quot;sql command&quot;, &quot;connection&quot;)', 'sc_select_@#AC@#_sc_select(dataset, &quot;sql command&quot;, &quot;connection&quot;)', 'sc_sql_injection_@#AC@#_sc_sql_injection(field/variable)', 'sc_date_@#AC@#_sc_date(date, format, operator, D,M,Y)', 'sc_date_conv_@#AC@#_sc_date_conv({field_date}, &quot;fmt_input&quot;, &quot;fmt_output&quot;)', 'sc_date_dif_@#AC@#_sc_date_dif(date1, format date1, date2, format date 2)', 'sc_date_dif_2_@#AC@#_sc_date_dif_2(date1, format date1, date2, format date 2, option)', 'sc_date_empty_@#AC@#_sc_date_empty({field_date})', 'sc_calc_dv_@#AC@#_sc_calc_dv(dv, rest, value, module, weights,type)', 'sc_decode_@#AC@#_sc_decode(field/variable)', 'sc_encode_@#AC@#_sc_encode(field/variable)', 'sc_error_exit_@#AC@#_sc_error_exit(URL/Application, target)', 'sc_error_message_@#AC@#_sc_error_message(&quot;text&quot;)', 'sc_include_@#AC@#_sc_include(file, source)', 'sc_label_@#AC@#_sc_label(field)', 'sc_master_value_@#AC@#_sc_master_value(\'object\', value)', 'sc_trunc_num_@#AC@#_sc_trunc_num(field,  qt_dec)', 'sc_warning_@#AC@#_sc_warning = \'on\'/\'off\'', 'sc_block_display_@#AC@#_sc_block_display(&quot;block&quot;,&quot;on/off&quot;)', 'sc_field_display_@#AC@#_sc_field_display({field}, on/off)', 'sc_field_readonly_@#AC@#_sc_field_readonly({field})', 'sc_format_num_@#AC@#_sc_format_num(field, group_symb,  dec_symb, amount_dec, fill_zeros,   side_neg,  currency_symb, side_currency_symb)', 'sc_set_focus_@#AC@#_sc_set_focus(\'Field\')');
		break;

		case "form_ajaxFieldonChange":
			$arr_wizard	= array('sc_lookup_@#AC@#_sc_lookup(dataset, &quot;sql command&quot;, &quot;connection&quot;)', 'sc_select_@#AC@#_sc_select(dataset, &quot;sql command&quot;, &quot;connection&quot;)', 'sc_sql_injection_@#AC@#_sc_sql_injection(field/variable)', 'sc_date_@#AC@#_sc_date(date, format, operator, D,M,Y)', 'sc_date_conv_@#AC@#_sc_date_conv({field_date}, &quot;fmt_input&quot;, &quot;fmt_output&quot;)', 'sc_date_dif_@#AC@#_sc_date_dif(date1, format date1, date2, format date 2)', 'sc_date_dif_2_@#AC@#_sc_date_dif_2(date1, format date1, date2, format date 2, option)', 'sc_date_empty_@#AC@#_sc_date_empty({field_date})', 'sc_calc_dv_@#AC@#_sc_calc_dv(dv, rest, value, module, weights,type)', 'sc_decode_@#AC@#_sc_decode(field/variable)', 'sc_encode_@#AC@#_sc_encode(field/variable)', 'sc_error_exit_@#AC@#_sc_error_exit(URL/Application, target)', 'sc_error_message_@#AC@#_sc_error_message(&quot;text&quot;)', 'sc_include_@#AC@#_sc_include(file, source)', 'sc_label_@#AC@#_sc_label(field)', 'sc_master_value_@#AC@#_sc_master_value(\'object\', value)', 'sc_trunc_num_@#AC@#_sc_trunc_num(field,  qt_dec)', 'sc_warning_@#AC@#_sc_warning = \'on\'/\'off\'', 'sc_block_display_@#AC@#_sc_block_display(&quot;block&quot;,&quot;on/off&quot;)', 'sc_field_display_@#AC@#_sc_field_display({field}, on/off)', 'sc_field_readonly_@#AC@#_sc_field_readonly({field})', 'sc_format_num_@#AC@#_sc_format_num(field, group_symb,  dec_symb, amount_dec, fill_zeros,   side_neg,  currency_symb, side_currency_symb)', 'sc_set_focus_@#AC@#_sc_set_focus(\'Field\')');
		break;

		case "form_ajaxFieldonClick":
			$arr_wizard	= array('sc_lookup_@#AC@#_sc_lookup(dataset, &quot;sql command&quot;, &quot;connection&quot;)', 'sc_select_@#AC@#_sc_select(dataset, &quot;sql command&quot;, &quot;connection&quot;)', 'sc_sql_injection_@#AC@#_sc_sql_injection(field/variable)', 'sc_date_@#AC@#_sc_date(date, format, operator, D,M,Y)', 'sc_date_conv_@#AC@#_sc_date_conv({field_date}, &quot;fmt_input&quot;, &quot;fmt_output&quot;)', 'sc_date_dif_@#AC@#_sc_date_dif(date1, format date1, date2, format date 2)', 'sc_date_dif_2_@#AC@#_sc_date_dif_2(date1, format date1, date2, format date 2, option)', 'sc_date_empty_@#AC@#_sc_date_empty({field_date})', 'sc_calc_dv_@#AC@#_sc_calc_dv(dv, rest, value, module, weights,type)', 'sc_decode_@#AC@#_sc_decode(field/variable)', 'sc_encode_@#AC@#_sc_encode(field/variable)', 'sc_error_exit_@#AC@#_sc_error_exit(URL/Application, target)', 'sc_error_message_@#AC@#_sc_error_message(&quot;text&quot;)', 'sc_include_@#AC@#_sc_include(file, source)', 'sc_label_@#AC@#_sc_label(field)', 'sc_master_value_@#AC@#_sc_master_value(\'object\', value)', 'sc_trunc_num_@#AC@#_sc_trunc_num(field,  qt_dec)', 'sc_warning_@#AC@#_sc_warning = \'on\'/\'off\'', 'sc_block_display_@#AC@#_sc_block_display(&quot;block&quot;,&quot;on/off&quot;)', 'sc_field_display_@#AC@#_sc_field_display({field}, on/off)', 'sc_field_readonly_@#AC@#_sc_field_readonly({field})', 'sc_format_num_@#AC@#_sc_format_num(field, group_symb,  dec_symb, amount_dec, fill_zeros,   side_neg,  currency_symb, side_currency_symb)', 'sc_set_focus_@#AC@#_sc_set_focus(\'Field\')');
		break;

		case "form_ajaxFieldonFocus":
			$arr_wizard	= array('sc_lookup_@#AC@#_sc_lookup(dataset, &quot;sql command&quot;, &quot;connection&quot;)', 'sc_select_@#AC@#_sc_select(dataset, &quot;sql command&quot;, &quot;connection&quot;)', 'sc_sql_injection_@#AC@#_sc_sql_injection(field/variable)', 'sc_date_@#AC@#_sc_date(date, format, operator, D,M,Y)', 'sc_date_conv_@#AC@#_sc_date_conv({field_date}, &quot;fmt_input&quot;, &quot;fmt_output&quot;)', 'sc_date_dif_@#AC@#_sc_date_dif(date1, format date1, date2, format date 2)', 'sc_date_dif_2_@#AC@#_sc_date_dif_2(date1, format date1, date2, format date 2, option)', 'sc_date_empty_@#AC@#_sc_date_empty({field_date})', 'sc_calc_dv_@#AC@#_sc_calc_dv(dv, rest, value, module, weights,type)', 'sc_decode_@#AC@#_sc_decode(field/variable)', 'sc_encode_@#AC@#_sc_encode(field/variable)', 'sc_error_exit_@#AC@#_sc_error_exit(URL/Application, target)', 'sc_error_message_@#AC@#_sc_error_message(&quot;text&quot;)', 'sc_include_@#AC@#_sc_include(file, source)', 'sc_label_@#AC@#_sc_label(field)', 'sc_master_value_@#AC@#_sc_master_value(\'object\', value)', 'sc_trunc_num_@#AC@#_sc_trunc_num(field,  qt_dec)', 'sc_warning_@#AC@#_sc_warning = \'on\'/\'off\'', 'sc_block_display_@#AC@#_sc_block_display(&quot;block&quot;,&quot;on/off&quot;)', 'sc_field_display_@#AC@#_sc_field_display({field}, on/off)', 'sc_field_readonly_@#AC@#_sc_field_readonly({field})', 'sc_format_num_@#AC@#_sc_format_num(field, group_symb,  dec_symb, amount_dec, fill_zeros,   side_neg,  currency_symb, side_currency_symb)', 'sc_set_focus_@#AC@#_sc_set_focus(\'Field\')');
		break;

		case "form_onAfterDelete":
			$arr_wizard	= array('sc_commit_trans_@#AC@#_sc_commit_trans(&quot;connection&quot;)', 'sc_error_continue_@#AC@#_sc_error_continue(&quot;event&quot;)', 'sc_error_delete_@#AC@#_{sc_error_delete}', 'sc_exec_sql_@#AC@#_sc_exec_sql(&quot;sql command&quot;, &quot;connection&quot;)', 'sc_lookup_@#AC@#_sc_lookup(dataset, &quot;sql command&quot;, &quot;connection&quot;)', 'sc_rollback_trans_@#AC@#_sc_rollback_trans(&quot;connection&quot;)', 'sc_select_@#AC@#_sc_select(dataset, &quot;sql command&quot;, &quot;connection&quot;)', 'sc_date_@#AC@#_sc_date(date, format, operator, D,M,Y)', 'sc_date_conv_@#AC@#_sc_date_conv({field_date}, &quot;fmt_input&quot;, &quot;fmt_output&quot;)', 'sc_date_dif_@#AC@#_sc_date_dif(date1, format date1, date2, format date 2)', 'sc_date_dif_2_@#AC@#_sc_date_dif_2(date1, format date1, date2, format date 2, option)', 'sc_apl_conf_@#AC@#_sc_apl_conf(Application, Property, value)', 'sc_calc_dv_@#AC@#_sc_calc_dv(dv, rest, value, module, weights,type)', 'sc_decode_@#AC@#_sc_decode(field/variable)', 'sc_encode_@#AC@#_sc_encode(field/variable)', 'sc_error_exit_@#AC@#_sc_error_exit(URL/Application, target)', 'sc_error_message_@#AC@#_sc_error_message(&quot;text&quot;)', 'sc_exit_@#AC@#_sc_exit(Option)', 'sc_include_@#AC@#_sc_include(file, source)', 'sc_mail_send_@#AC@#_sc_mail_send(smtp, usr, pw, de, para, assunto, mensagem, tipo_mens, c&oacute;pias, tp_c&oacute;pias, porta, tp_conexao, attachment)', 'sc_master_value_@#AC@#_sc_master_value(\'object\', value)', 'sc_redir_@#AC@#_sc_redir(apl, parm1; parm2; ..., target)', 'sc_reset_global_@#AC@#_sc_reset_global([var_glo1], [var_glo2] ...)', 'sc_set_global_@#AC@#_sc_set_global($var_1, {field_x}, ...)', 'sc_site_ssl_@#AC@#_sc_site_ssl', 'sc_trunc_num_@#AC@#_sc_trunc_num(field,  qt_dec)', 'sc_url_exit_@#AC@#_sc_url_exit(url)', 'sc_warning_@#AC@#_sc_warning = \'on\'/\'off\'', 'sc_zip_file_@#AC@#_sc_zip_file(files, zip)', 'sc_apl_status_@#AC@#_sc_apl_status(application, status)', 'sc_reset_apl_conf_@#AC@#_sc_reset_apl_conf(Application, Property)', 'sc_reset_apl_status_@#AC@#_sc_reset_apl_status()', 'sc_block_display_@#AC@#_sc_block_display(&quot;block&quot;,&quot;on/off&quot;)', 'sc_field_display_@#AC@#_sc_field_display({field}, on/off)', 'sc_field_readonly_@#AC@#_sc_field_readonly({field})', 'sc_format_num_@#AC@#_sc_format_num(field, group_symb,  dec_symb, amount_dec, fill_zeros,   side_neg,  currency_symb, side_currency_symb)', 'sc_form_show_@#AC@#_sc_form_show = \'on\'/\'off\'', 'sc_btn_display_@#AC@#_sc_btn_display(&quot;button&quot;,&quot;on/off&quot;)');
		break;

		case "form_onAfterDeleteAll":
			$arr_wizard	= array('sc_commit_trans_@#AC@#_sc_commit_trans(&quot;connection&quot;)', 'sc_exec_sql_@#AC@#_sc_exec_sql(&quot;sql command&quot;, &quot;connection&quot;)', 'sc_lookup_@#AC@#_sc_lookup(dataset, &quot;sql command&quot;, &quot;connection&quot;)', 'sc_rollback_trans_@#AC@#_sc_rollback_trans(&quot;connection&quot;)', 'sc_select_@#AC@#_sc_select(dataset, &quot;sql command&quot;, &quot;connection&quot;)', 'sc_date_@#AC@#_sc_date(date, format, operator, D,M,Y)', 'sc_date_conv_@#AC@#_sc_date_conv({field_date}, &quot;fmt_input&quot;, &quot;fmt_output&quot;)', 'sc_date_dif_@#AC@#_sc_date_dif(date1, format date1, date2, format date 2)', 'sc_date_dif_2_@#AC@#_sc_date_dif_2(date1, format date1, date2, format date 2, option)', 'sc_apl_conf_@#AC@#_sc_apl_conf(Application, Property, value)', 'sc_calc_dv_@#AC@#_sc_calc_dv(dv, rest, value, module, weights,type)', 'sc_changed_@#AC@#_sc_changed({field})', 'sc_decode_@#AC@#_sc_decode(field/variable)', 'sc_encode_@#AC@#_sc_encode(field/variable)', 'sc_error_exit_@#AC@#_sc_error_exit(URL/Application, target)', 'sc_error_message_@#AC@#_sc_error_message(&quot;text&quot;)', 'sc_exit_@#AC@#_sc_exit(Option)', 'sc_image_@#AC@#_sc_image(img1.jpg,img2.gif,...)', 'sc_include_@#AC@#_sc_include(file, source)', 'sc_mail_send_@#AC@#_sc_mail_send(smtp, usr, pw, de, para, assunto, mensagem, tipo_mens, c&oacute;pias, tp_c&oacute;pias, porta, tp_conexao, attachment)', 'sc_redir_@#AC@#_sc_redir(apl, parm1; parm2; ..., target)', 'sc_reset_global_@#AC@#_sc_reset_global([var_glo1], [var_glo2] ...)', 'sc_set_global_@#AC@#_sc_set_global($var_1, {field_x}, ...)', 'sc_site_ssl_@#AC@#_sc_site_ssl', 'sc_trunc_num_@#AC@#_sc_trunc_num(field,  qt_dec)', 'sc_url_exit_@#AC@#_sc_url_exit(url)', 'sc_warning_@#AC@#_sc_warning = \'on\'/\'off\'', 'sc_zip_file_@#AC@#_sc_zip_file(files, zip)', 'sc_apl_status_@#AC@#_sc_apl_status(application, status)', 'sc_reset_apl_conf_@#AC@#_sc_reset_apl_conf(Application, Property)', 'sc_reset_apl_status_@#AC@#_sc_reset_apl_status()', 'sc_block_display_@#AC@#_sc_block_display(&quot;block&quot;,&quot;on/off&quot;)', 'sc_field_display_@#AC@#_sc_field_display({field}, on/off)', 'sc_field_readonly_@#AC@#_sc_field_readonly({field})', 'sc_format_num_@#AC@#_sc_format_num(field, group_symb,  dec_symb, amount_dec, fill_zeros,   side_neg,  currency_symb, side_currency_symb)', 'sc_form_show_@#AC@#_sc_form_show = \'on\'/\'off\'', 'sc_btn_display_@#AC@#_sc_btn_display(&quot;button&quot;,&quot;on/off&quot;)');
		break;

		case "form_onAfterInsert":
			$arr_wizard	= array('sc_commit_trans_@#AC@#_sc_commit_trans(&quot;connection&quot;)', 'sc_error_continue_@#AC@#_sc_error_continue(&quot;event&quot;)', 'sc_error_insert_@#AC@#_{sc_error_insert}', 'sc_exec_sql_@#AC@#_sc_exec_sql(&quot;sql command&quot;, &quot;connection&quot;)', 'sc_lookup_@#AC@#_sc_lookup(dataset, &quot;sql command&quot;, &quot;connection&quot;)', 'sc_rollback_trans_@#AC@#_sc_rollback_trans(&quot;connection&quot;)', 'sc_select_@#AC@#_sc_select(dataset, &quot;sql command&quot;, &quot;connection&quot;)', 'sc_date_@#AC@#_sc_date(date, format, operator, D,M,Y)', 'sc_date_conv_@#AC@#_sc_date_conv({field_date}, &quot;fmt_input&quot;, &quot;fmt_output&quot;)', 'sc_date_dif_@#AC@#_sc_date_dif(date1, format date1, date2, format date 2)', 'sc_date_dif_2_@#AC@#_sc_date_dif_2(date1, format date1, date2, format date 2, option)', 'sc_apl_conf_@#AC@#_sc_apl_conf(Application, Property, value)', 'sc_calc_dv_@#AC@#_sc_calc_dv(dv, rest, value, module, weights,type)', 'sc_changed_@#AC@#_sc_changed({field})', 'sc_decode_@#AC@#_sc_decode(field/variable)', 'sc_encode_@#AC@#_sc_encode(field/variable)', 'sc_error_exit_@#AC@#_sc_error_exit(URL/Application, target)', 'sc_error_message_@#AC@#_sc_error_message(&quot;text&quot;)', 'sc_exit_@#AC@#_sc_exit(Option)', 'sc_include_@#AC@#_sc_include(file, source)', 'sc_mail_send_@#AC@#_sc_mail_send(smtp, usr, pw, de, para, assunto, mensagem, tipo_mens, c&oacute;pias, tp_c&oacute;pias, porta, tp_conexao, attachment)', 'sc_master_value_@#AC@#_sc_master_value(\'object\', value)', 'sc_redir_@#AC@#_sc_redir(apl, parm1; parm2; ..., target)', 'sc_reset_global_@#AC@#_sc_reset_global([var_glo1], [var_glo2] ...)', 'sc_set_global_@#AC@#_sc_set_global($var_1, {field_x}, ...)', 'sc_site_ssl_@#AC@#_sc_site_ssl', 'sc_trunc_num_@#AC@#_sc_trunc_num(field,  qt_dec)', 'sc_url_exit_@#AC@#_sc_url_exit(url)', 'sc_warning_@#AC@#_sc_warning = \'on\'/\'off\'', 'sc_zip_file_@#AC@#_sc_zip_file(files, zip)', 'sc_apl_status_@#AC@#_sc_apl_status(application, status)', 'sc_reset_apl_conf_@#AC@#_sc_reset_apl_conf(Application, Property)', 'sc_reset_apl_status_@#AC@#_sc_reset_apl_status()', 'sc_block_display_@#AC@#_sc_block_display(&quot;block&quot;,&quot;on/off&quot;)', 'sc_field_display_@#AC@#_sc_field_display({field}, on/off)', 'sc_field_readonly_@#AC@#_sc_field_readonly({field})', 'sc_format_num_@#AC@#_sc_format_num(field, group_symb,  dec_symb, amount_dec, fill_zeros,   side_neg,  currency_symb, side_currency_symb)', 'sc_form_show_@#AC@#_sc_form_show = \'on\'/\'off\'', 'sc_btn_display_@#AC@#_sc_btn_display(&quot;button&quot;,&quot;on/off&quot;)');
		break;

		case "form_onAfterInsertAll":
			$arr_wizard	= array('sc_commit_trans_@#AC@#_sc_commit_trans(&quot;connection&quot;)', 'sc_exec_sql_@#AC@#_sc_exec_sql(&quot;sql command&quot;, &quot;connection&quot;)', 'sc_lookup_@#AC@#_sc_lookup(dataset, &quot;sql command&quot;, &quot;connection&quot;)', 'sc_rollback_trans_@#AC@#_sc_rollback_trans(&quot;connection&quot;)', 'sc_select_@#AC@#_sc_select(dataset, &quot;sql command&quot;, &quot;connection&quot;)', 'sc_date_@#AC@#_sc_date(date, format, operator, D,M,Y)', 'sc_date_conv_@#AC@#_sc_date_conv({field_date}, &quot;fmt_input&quot;, &quot;fmt_output&quot;)', 'sc_date_dif_@#AC@#_sc_date_dif(date1, format date1, date2, format date 2)', 'sc_date_dif_2_@#AC@#_sc_date_dif_2(date1, format date1, date2, format date 2, option)', 'sc_apl_conf_@#AC@#_sc_apl_conf(Application, Property, value)', 'sc_calc_dv_@#AC@#_sc_calc_dv(dv, rest, value, module, weights,type)', 'sc_decode_@#AC@#_sc_decode(field/variable)', 'sc_encode_@#AC@#_sc_encode(field/variable)', 'sc_error_exit_@#AC@#_sc_error_exit(URL/Application, target)', 'sc_error_message_@#AC@#_sc_error_message(&quot;text&quot;)', 'sc_exit_@#AC@#_sc_exit(Option)', 'sc_include_@#AC@#_sc_include(file, source)', 'sc_mail_send_@#AC@#_sc_mail_send(smtp, usr, pw, de, para, assunto, mensagem, tipo_mens, c&oacute;pias, tp_c&oacute;pias, porta, tp_conexao, attachment)', 'sc_redir_@#AC@#_sc_redir(apl, parm1; parm2; ..., target)', 'sc_reset_global_@#AC@#_sc_reset_global([var_glo1], [var_glo2] ...)', 'sc_set_global_@#AC@#_sc_set_global($var_1, {field_x}, ...)', 'sc_site_ssl_@#AC@#_sc_site_ssl', 'sc_trunc_num_@#AC@#_sc_trunc_num(field,  qt_dec)', 'sc_url_exit_@#AC@#_sc_url_exit(url)', 'sc_warning_@#AC@#_sc_warning = \'on\'/\'off\'', 'sc_zip_file_@#AC@#_sc_zip_file(files, zip)', 'sc_apl_status_@#AC@#_sc_apl_status(application, status)', 'sc_reset_apl_conf_@#AC@#_sc_reset_apl_conf(Application, Property)', 'sc_reset_apl_status_@#AC@#_sc_reset_apl_status()', 'sc_block_display_@#AC@#_sc_block_display(&quot;block&quot;,&quot;on/off&quot;)', 'sc_field_display_@#AC@#_sc_field_display({field}, on/off)', 'sc_field_readonly_@#AC@#_sc_field_readonly({field})', 'sc_format_num_@#AC@#_sc_format_num(field, group_symb,  dec_symb, amount_dec, fill_zeros,   side_neg,  currency_symb, side_currency_symb)', 'sc_form_show_@#AC@#_sc_form_show = \'on\'/\'off\'', 'sc_btn_display_@#AC@#_sc_btn_display(&quot;button&quot;,&quot;on/off&quot;)');
		break;

		case "form_onAfterUpdate":
			$arr_wizard	= array('sc_commit_trans_@#AC@#_sc_commit_trans(&quot;connection&quot;)', 'sc_error_continue_@#AC@#_sc_error_continue(&quot;event&quot;)', 'sc_error_update_@#AC@#_{sc_error_update}', 'sc_exec_sql_@#AC@#_sc_exec_sql(&quot;sql command&quot;, &quot;connection&quot;)', 'sc_lookup_@#AC@#_sc_lookup(dataset, &quot;sql command&quot;, &quot;connection&quot;)', 'sc_rollback_trans_@#AC@#_sc_rollback_trans(&quot;connection&quot;)', 'sc_select_@#AC@#_sc_select(dataset, &quot;sql command&quot;, &quot;connection&quot;)', 'sc_date_@#AC@#_sc_date(date, format, operator, D,M,Y)', 'sc_date_conv_@#AC@#_sc_date_conv({field_date}, &quot;fmt_input&quot;, &quot;fmt_output&quot;)', 'sc_date_dif_@#AC@#_sc_date_dif(date1, format date1, date2, format date 2)', 'sc_date_dif_2_@#AC@#_sc_date_dif_2(date1, format date1, date2, format date 2, option)', 'sc_apl_conf_@#AC@#_sc_apl_conf(Application, Property, value)', 'sc_calc_dv_@#AC@#_sc_calc_dv(dv, rest, value, module, weights,type)', 'sc_changed_@#AC@#_sc_changed({field})', 'sc_decode_@#AC@#_sc_decode(field/variable)', 'sc_encode_@#AC@#_sc_encode(field/variable)', 'sc_error_exit_@#AC@#_sc_error_exit(URL/Application, target)', 'sc_error_message_@#AC@#_sc_error_message(&quot;text&quot;)', 'sc_exit_@#AC@#_sc_exit(Option)', 'sc_include_@#AC@#_sc_include(file, source)', 'sc_mail_send_@#AC@#_sc_mail_send(smtp, usr, pw, de, para, assunto, mensagem, tipo_mens, c&oacute;pias, tp_c&oacute;pias, porta, tp_conexao, attachment)', 'sc_master_value_@#AC@#_sc_master_value(\'object\', value)', 'sc_redir_@#AC@#_sc_redir(apl, parm1; parm2; ..., target)', 'sc_reset_global_@#AC@#_sc_reset_global([var_glo1], [var_glo2] ...)', 'sc_set_global_@#AC@#_sc_set_global($var_1, {field_x}, ...)', 'sc_site_ssl_@#AC@#_sc_site_ssl', 'sc_trunc_num_@#AC@#_sc_trunc_num(field,  qt_dec)', 'sc_url_exit_@#AC@#_sc_url_exit(url)', 'sc_warning_@#AC@#_sc_warning = \'on\'/\'off\'', 'sc_zip_file_@#AC@#_sc_zip_file(files, zip)', 'sc_apl_status_@#AC@#_sc_apl_status(application, status)', 'sc_reset_apl_conf_@#AC@#_sc_reset_apl_conf(Application, Property)', 'sc_reset_apl_status_@#AC@#_sc_reset_apl_status()', 'sc_block_display_@#AC@#_sc_block_display(&quot;block&quot;,&quot;on/off&quot;)', 'sc_field_display_@#AC@#_sc_field_display({field}, on/off)', 'sc_field_readonly_@#AC@#_sc_field_readonly({field})', 'sc_format_num_@#AC@#_sc_format_num(field, group_symb,  dec_symb, amount_dec, fill_zeros,   side_neg,  currency_symb, side_currency_symb)', 'sc_form_show_@#AC@#_sc_form_show = \'on\'/\'off\'', 'sc_btn_display_@#AC@#_sc_btn_display(&quot;button&quot;,&quot;on/off&quot;)');
		break;

		case "form_onAfterUpdateAll":
			$arr_wizard	= array('sc_begin_trans_@#AC@#_sc_begin_trans(&quot;connection&quot;)', 'sc_commit_trans_@#AC@#_sc_commit_trans(&quot;connection&quot;)', 'sc_exec_sql_@#AC@#_sc_exec_sql(&quot;sql command&quot;, &quot;connection&quot;)', 'sc_lookup_@#AC@#_sc_lookup(dataset, &quot;sql command&quot;, &quot;connection&quot;)', 'sc_rollback_trans_@#AC@#_sc_rollback_trans(&quot;connection&quot;)', 'sc_select_@#AC@#_sc_select(dataset, &quot;sql command&quot;, &quot;connection&quot;)', 'sc_date_@#AC@#_sc_date(date, format, operator, D,M,Y)', 'sc_date_conv_@#AC@#_sc_date_conv({field_date}, &quot;fmt_input&quot;, &quot;fmt_output&quot;)', 'sc_date_dif_@#AC@#_sc_date_dif(date1, format date1, date2, format date 2)', 'sc_date_dif_2_@#AC@#_sc_date_dif_2(date1, format date1, date2, format date 2, option)', 'sc_apl_conf_@#AC@#_sc_apl_conf(Application, Property, value)', 'sc_calc_dv_@#AC@#_sc_calc_dv(dv, rest, value, module, weights,type)', 'sc_decode_@#AC@#_sc_decode(field/variable)', 'sc_encode_@#AC@#_sc_encode(field/variable)', 'sc_error_exit_@#AC@#_sc_error_exit(URL/Application, target)', 'sc_error_message_@#AC@#_sc_error_message(&quot;text&quot;)', 'sc_exit_@#AC@#_sc_exit(Option)', 'sc_include_@#AC@#_sc_include(file, source)', 'sc_mail_send_@#AC@#_sc_mail_send(smtp, usr, pw, de, para, assunto, mensagem, tipo_mens, c&oacute;pias, tp_c&oacute;pias, porta, tp_conexao, attachment)', 'sc_redir_@#AC@#_sc_redir(apl, parm1; parm2; ..., target)', 'sc_reset_global_@#AC@#_sc_reset_global([var_glo1], [var_glo2] ...)', 'sc_set_global_@#AC@#_sc_set_global($var_1, {field_x}, ...)', 'sc_site_ssl_@#AC@#_sc_site_ssl', 'sc_trunc_num_@#AC@#_sc_trunc_num(field,  qt_dec)', 'sc_url_exit_@#AC@#_sc_url_exit(url)', 'sc_warning_@#AC@#_sc_warning = \'on\'/\'off\'', 'sc_zip_file_@#AC@#_sc_zip_file(files, zip)', 'sc_apl_status_@#AC@#_sc_apl_status(application, status)', 'sc_reset_apl_conf_@#AC@#_sc_reset_apl_conf(Application, Property)', 'sc_reset_apl_status_@#AC@#_sc_reset_apl_status()', 'sc_block_display_@#AC@#_sc_block_display(&quot;block&quot;,&quot;on/off&quot;)', 'sc_field_display_@#AC@#_sc_field_display({field}, on/off)', 'sc_field_readonly_@#AC@#_sc_field_readonly({field})', 'sc_format_num_@#AC@#_sc_format_num(field, group_symb,  dec_symb, amount_dec, fill_zeros,   side_neg,  currency_symb, side_currency_symb)', 'sc_form_show_@#AC@#_sc_form_show = \'on\'/\'off\'', 'sc_btn_display_@#AC@#_sc_btn_display(&quot;button&quot;,&quot;on/off&quot;)');
		break;

		case "form_onBeforeDelete":
			$arr_wizard	= array('sc_error_continue_@#AC@#_sc_error_continue(&quot;event&quot;)', 'sc_error_delete_@#AC@#_{sc_error_delete}', 'sc_exec_sql_@#AC@#_sc_exec_sql(&quot;sql command&quot;, &quot;connection&quot;)', 'sc_lookup_@#AC@#_sc_lookup(dataset, &quot;sql command&quot;, &quot;connection&quot;)', 'sc_select_@#AC@#_sc_select(dataset, &quot;sql command&quot;, &quot;connection&quot;)', 'sc_sql_injection_@#AC@#_sc_sql_injection(field/variable)', 'sc_date_@#AC@#_sc_date(date, format, operator, D,M,Y)', 'sc_date_conv_@#AC@#_sc_date_conv({field_date}, &quot;fmt_input&quot;, &quot;fmt_output&quot;)', 'sc_date_dif_@#AC@#_sc_date_dif(date1, format date1, date2, format date 2)', 'sc_date_dif_2_@#AC@#_sc_date_dif_2(date1, format date1, date2, format date 2, option)', 'sc_apl_conf_@#AC@#_sc_apl_conf(Application, Property, value)', 'sc_calc_dv_@#AC@#_sc_calc_dv(dv, rest, value, module, weights,type)', 'sc_changed_@#AC@#_sc_changed({field})', 'sc_decode_@#AC@#_sc_decode(field/variable)', 'sc_encode_@#AC@#_sc_encode(field/variable)', 'sc_error_exit_@#AC@#_sc_error_exit(URL/Application, target)', 'sc_error_message_@#AC@#_sc_error_message(&quot;text&quot;)', 'sc_exit_@#AC@#_sc_exit(Option)', 'sc_include_@#AC@#_sc_include(file, source)', 'sc_mail_send_@#AC@#_sc_mail_send(smtp, usr, pw, de, para, assunto, mensagem, tipo_mens, c&oacute;pias, tp_c&oacute;pias, porta, tp_conexao, attachment)', 'sc_master_value_@#AC@#_sc_master_value(\'object\', value)', 'sc_redir_@#AC@#_sc_redir(apl, parm1; parm2; ..., target)', 'sc_reset_global_@#AC@#_sc_reset_global([var_glo1], [var_glo2] ...)', 'sc_set_global_@#AC@#_sc_set_global($var_1, {field_x}, ...)', 'sc_site_ssl_@#AC@#_sc_site_ssl', 'sc_trunc_num_@#AC@#_sc_trunc_num(field,  qt_dec)', 'sc_url_exit_@#AC@#_sc_url_exit(url)', 'sc_warning_@#AC@#_sc_warning = \'on\'/\'off\'', 'sc_zip_file_@#AC@#_sc_zip_file(files, zip)', 'sc_apl_status_@#AC@#_sc_apl_status(application, status)', 'sc_reset_apl_conf_@#AC@#_sc_reset_apl_conf(Application, Property)', 'sc_reset_apl_status_@#AC@#_sc_reset_apl_status()', 'sc_block_display_@#AC@#_sc_block_display(&quot;block&quot;,&quot;on/off&quot;)', 'sc_field_display_@#AC@#_sc_field_display({field}, on/off)', 'sc_field_readonly_@#AC@#_sc_field_readonly({field})', 'sc_format_num_@#AC@#_sc_format_num(field, group_symb,  dec_symb, amount_dec, fill_zeros,   side_neg,  currency_symb, side_currency_symb)', 'sc_form_show_@#AC@#_sc_form_show = \'on\'/\'off\'', 'sc_btn_display_@#AC@#_sc_btn_display(&quot;button&quot;,&quot;on/off&quot;)');
		break;

		case "form_onBeforeDelete_All":
			$arr_wizard	= array('sc_exec_sql_@#AC@#_sc_exec_sql(&quot;sql command&quot;, &quot;connection&quot;)', 'sc_lookup_@#AC@#_sc_lookup(dataset, &quot;sql command&quot;, &quot;connection&quot;)', 'sc_select_@#AC@#_sc_select(dataset, &quot;sql command&quot;, &quot;connection&quot;)', 'sc_date_@#AC@#_sc_date(date, format, operator, D,M,Y)', 'sc_date_conv_@#AC@#_sc_date_conv({field_date}, &quot;fmt_input&quot;, &quot;fmt_output&quot;)', 'sc_date_dif_@#AC@#_sc_date_dif(date1, format date1, date2, format date 2)', 'sc_date_dif_2_@#AC@#_sc_date_dif_2(date1, format date1, date2, format date 2, option)', 'sc_apl_conf_@#AC@#_sc_apl_conf(Application, Property, value)', 'sc_calc_dv_@#AC@#_sc_calc_dv(dv, rest, value, module, weights,type)', 'sc_decode_@#AC@#_sc_decode(field/variable)', 'sc_encode_@#AC@#_sc_encode(field/variable)', 'sc_error_exit_@#AC@#_sc_error_exit(URL/Application, target)', 'sc_error_message_@#AC@#_sc_error_message(&quot;text&quot;)', 'sc_exit_@#AC@#_sc_exit(Option)', 'sc_include_@#AC@#_sc_include(file, source)', 'sc_mail_send_@#AC@#_sc_mail_send(smtp, usr, pw, de, para, assunto, mensagem, tipo_mens, c&oacute;pias, tp_c&oacute;pias, porta, tp_conexao, attachment)', 'sc_redir_@#AC@#_sc_redir(apl, parm1; parm2; ..., target)', 'sc_reset_global_@#AC@#_sc_reset_global([var_glo1], [var_glo2] ...)', 'sc_set_global_@#AC@#_sc_set_global($var_1, {field_x}, ...)', 'sc_site_ssl_@#AC@#_sc_site_ssl', 'sc_trunc_num_@#AC@#_sc_trunc_num(field,  qt_dec)', 'sc_url_exit_@#AC@#_sc_url_exit(url)', 'sc_warning_@#AC@#_sc_warning = \'on\'/\'off\'', 'sc_zip_file_@#AC@#_sc_zip_file(files, zip)', 'sc_apl_status_@#AC@#_sc_apl_status(application, status)', 'sc_reset_apl_conf_@#AC@#_sc_reset_apl_conf(Application, Property)', 'sc_reset_apl_status_@#AC@#_sc_reset_apl_status()', 'sc_block_display_@#AC@#_sc_block_display(&quot;block&quot;,&quot;on/off&quot;)', 'sc_field_display_@#AC@#_sc_field_display({field}, on/off)', 'sc_field_readonly_@#AC@#_sc_field_readonly({field})', 'sc_format_num_@#AC@#_sc_format_num(field, group_symb,  dec_symb, amount_dec, fill_zeros,   side_neg,  currency_symb, side_currency_symb)', 'sc_form_show_@#AC@#_sc_form_show = \'on\'/\'off\'', 'sc_btn_display_@#AC@#_sc_btn_display(&quot;button&quot;,&quot;on/off&quot;)');
		break;

		case "form_onBeforeInsert":
			$arr_wizard	= array('sc_error_continue_@#AC@#_sc_error_continue(&quot;event&quot;)', 'sc_error_insert_@#AC@#_{sc_error_insert}', 'sc_exec_sql_@#AC@#_sc_exec_sql(&quot;sql command&quot;, &quot;connection&quot;)', 'sc_lookup_@#AC@#_sc_lookup(dataset, &quot;sql command&quot;, &quot;connection&quot;)', 'sc_select_@#AC@#_sc_select(dataset, &quot;sql command&quot;, &quot;connection&quot;)', 'sc_date_@#AC@#_sc_date(date, format, operator, D,M,Y)', 'sc_date_conv_@#AC@#_sc_date_conv({field_date}, &quot;fmt_input&quot;, &quot;fmt_output&quot;)', 'sc_date_dif_@#AC@#_sc_date_dif(date1, format date1, date2, format date 2)', 'sc_date_dif_2_@#AC@#_sc_date_dif_2(date1, format date1, date2, format date 2, option)', 'sc_apl_conf_@#AC@#_sc_apl_conf(Application, Property, value)', 'sc_calc_dv_@#AC@#_sc_calc_dv(dv, rest, value, module, weights,type)', 'sc_changed_@#AC@#_sc_changed({field})', 'sc_decode_@#AC@#_sc_decode(field/variable)', 'sc_encode_@#AC@#_sc_encode(field/variable)', 'sc_error_exit_@#AC@#_sc_error_exit(URL/Application, target)', 'sc_error_message_@#AC@#_sc_error_message(&quot;text&quot;)', 'sc_exit_@#AC@#_sc_exit(Option)', 'sc_include_@#AC@#_sc_include(file, source)', 'sc_mail_send_@#AC@#_sc_mail_send(smtp, usr, pw, de, para, assunto, mensagem, tipo_mens, c&oacute;pias, tp_c&oacute;pias, porta, tp_conexao, attachment)', 'sc_master_value_@#AC@#_sc_master_value(\'object\', value)', 'sc_redir_@#AC@#_sc_redir(apl, parm1; parm2; ..., target)', 'sc_reset_global_@#AC@#_sc_reset_global([var_glo1], [var_glo2] ...)', 'sc_set_global_@#AC@#_sc_set_global($var_1, {field_x}, ...)', 'sc_site_ssl_@#AC@#_sc_site_ssl', 'sc_trunc_num_@#AC@#_sc_trunc_num(field,  qt_dec)', 'sc_url_exit_@#AC@#_sc_url_exit(url)', 'sc_warning_@#AC@#_sc_warning = \'on\'/\'off\'', 'sc_zip_file_@#AC@#_sc_zip_file(files, zip)', 'sc_apl_status_@#AC@#_sc_apl_status(application, status)', 'sc_reset_apl_conf_@#AC@#_sc_reset_apl_conf(Application, Property)', 'sc_reset_apl_status_@#AC@#_sc_reset_apl_status()', 'sc_block_display_@#AC@#_sc_block_display(&quot;block&quot;,&quot;on/off&quot;)', 'sc_field_display_@#AC@#_sc_field_display({field}, on/off)', 'sc_field_readonly_@#AC@#_sc_field_readonly({field})', 'sc_format_num_@#AC@#_sc_format_num(field, group_symb,  dec_symb, amount_dec, fill_zeros,   side_neg,  currency_symb, side_currency_symb)', 'sc_form_show_@#AC@#_sc_form_show = \'on\'/\'off\'', 'sc_btn_display_@#AC@#_sc_btn_display(&quot;button&quot;,&quot;on/off&quot;)');
		break;

		case "form_onBeforeInsertAll":
			$arr_wizard	= array('sc_begin_trans_@#AC@#_sc_begin_trans(&quot;connection&quot;)', 'sc_exec_sql_@#AC@#_sc_exec_sql(&quot;sql command&quot;, &quot;connection&quot;)', 'sc_lookup_@#AC@#_sc_lookup(dataset, &quot;sql command&quot;, &quot;connection&quot;)', 'sc_select_@#AC@#_sc_select(dataset, &quot;sql command&quot;, &quot;connection&quot;)', 'sc_date_@#AC@#_sc_date(date, format, operator, D,M,Y)', 'sc_date_conv_@#AC@#_sc_date_conv({field_date}, &quot;fmt_input&quot;, &quot;fmt_output&quot;)', 'sc_date_dif_@#AC@#_sc_date_dif(date1, format date1, date2, format date 2)', 'sc_date_dif_2_@#AC@#_sc_date_dif_2(date1, format date1, date2, format date 2, option)', 'sc_apl_conf_@#AC@#_sc_apl_conf(Application, Property, value)', 'sc_calc_dv_@#AC@#_sc_calc_dv(dv, rest, value, module, weights,type)', 'sc_decode_@#AC@#_sc_decode(field/variable)', 'sc_encode_@#AC@#_sc_encode(field/variable)', 'sc_error_exit_@#AC@#_sc_error_exit(URL/Application, target)', 'sc_error_message_@#AC@#_sc_error_message(&quot;text&quot;)', 'sc_exit_@#AC@#_sc_exit(Option)', 'sc_include_@#AC@#_sc_include(file, source)', 'sc_mail_send_@#AC@#_sc_mail_send(smtp, usr, pw, de, para, assunto, mensagem, tipo_mens, c&oacute;pias, tp_c&oacute;pias, porta, tp_conexao, attachment)', 'sc_redir_@#AC@#_sc_redir(apl, parm1; parm2; ..., target)', 'sc_reset_global_@#AC@#_sc_reset_global([var_glo1], [var_glo2] ...)', 'sc_set_global_@#AC@#_sc_set_global($var_1, {field_x}, ...)', 'sc_site_ssl_@#AC@#_sc_site_ssl', 'sc_trunc_num_@#AC@#_sc_trunc_num(field,  qt_dec)', 'sc_url_exit_@#AC@#_sc_url_exit(url)', 'sc_warning_@#AC@#_sc_warning = \'on\'/\'off\'', 'sc_zip_file_@#AC@#_sc_zip_file(files, zip)', 'sc_apl_status_@#AC@#_sc_apl_status(application, status)', 'sc_reset_apl_conf_@#AC@#_sc_reset_apl_conf(Application, Property)', 'sc_reset_apl_status_@#AC@#_sc_reset_apl_status()', 'sc_block_display_@#AC@#_sc_block_display(&quot;block&quot;,&quot;on/off&quot;)', 'sc_field_display_@#AC@#_sc_field_display({field}, on/off)', 'sc_field_readonly_@#AC@#_sc_field_readonly({field})', 'sc_format_num_@#AC@#_sc_format_num(field, group_symb,  dec_symb, amount_dec, fill_zeros,   side_neg,  currency_symb, side_currency_symb)', 'sc_form_show_@#AC@#_sc_form_show = \'on\'/\'off\'', 'sc_btn_display_@#AC@#_sc_btn_display(&quot;button&quot;,&quot;on/off&quot;)');
		break;

		case "form_onBeforeUpdate":
			$arr_wizard	= array('sc_error_continue_@#AC@#_sc_error_continue(&quot;event&quot;)', 'sc_error_update_@#AC@#_{sc_error_update}', 'sc_exec_sql_@#AC@#_sc_exec_sql(&quot;sql command&quot;, &quot;connection&quot;)', 'sc_lookup_@#AC@#_sc_lookup(dataset, &quot;sql command&quot;, &quot;connection&quot;)', 'sc_select_@#AC@#_sc_select(dataset, &quot;sql command&quot;, &quot;connection&quot;)', 'sc_date_@#AC@#_sc_date(date, format, operator, D,M,Y)', 'sc_date_conv_@#AC@#_sc_date_conv({field_date}, &quot;fmt_input&quot;, &quot;fmt_output&quot;)', 'sc_date_dif_@#AC@#_sc_date_dif(date1, format date1, date2, format date 2)', 'sc_date_dif_2_@#AC@#_sc_date_dif_2(date1, format date1, date2, format date 2, option)', 'sc_apl_conf_@#AC@#_sc_apl_conf(Application, Property, value)', 'sc_calc_dv_@#AC@#_sc_calc_dv(dv, rest, value, module, weights,type)', 'sc_decode_@#AC@#_sc_decode(field/variable)', 'sc_encode_@#AC@#_sc_encode(field/variable)', 'sc_error_exit_@#AC@#_sc_error_exit(URL/Application, target)', 'sc_error_message_@#AC@#_sc_error_message(&quot;text&quot;)', 'sc_exit_@#AC@#_sc_exit(Option)', 'sc_include_@#AC@#_sc_include(file, source)', 'sc_mail_send_@#AC@#_sc_mail_send(smtp, usr, pw, de, para, assunto, mensagem, tipo_mens, c&oacute;pias, tp_c&oacute;pias, porta, tp_conexao, attachment)', 'sc_master_value_@#AC@#_sc_master_value(\'object\', value)', 'sc_redir_@#AC@#_sc_redir(apl, parm1; parm2; ..., target)', 'sc_reset_global_@#AC@#_sc_reset_global([var_glo1], [var_glo2] ...)', 'sc_set_global_@#AC@#_sc_set_global($var_1, {field_x}, ...)', 'sc_site_ssl_@#AC@#_sc_site_ssl', 'sc_trunc_num_@#AC@#_sc_trunc_num(field,  qt_dec)', 'sc_url_exit_@#AC@#_sc_url_exit(url)', 'sc_warning_@#AC@#_sc_warning = \'on\'/\'off\'', 'sc_zip_file_@#AC@#_sc_zip_file(files, zip)', 'sc_apl_status_@#AC@#_sc_apl_status(application, status)', 'sc_reset_apl_conf_@#AC@#_sc_reset_apl_conf(Application, Property)', 'sc_reset_apl_status_@#AC@#_sc_reset_apl_status()', 'sc_block_display_@#AC@#_sc_block_display(&quot;block&quot;,&quot;on/off&quot;)', 'sc_field_display_@#AC@#_sc_field_display({field}, on/off)', 'sc_field_readonly_@#AC@#_sc_field_readonly({field})', 'sc_format_num_@#AC@#_sc_format_num(field, group_symb,  dec_symb, amount_dec, fill_zeros,   side_neg,  currency_symb, side_currency_symb)', 'sc_form_show_@#AC@#_sc_form_show = \'on\'/\'off\'', 'sc_btn_display_@#AC@#_sc_btn_display(&quot;button&quot;,&quot;on/off&quot;)');
		break;

		case "form_onBeforeUpdateall":
			$arr_wizard	= array('sc_begin_trans_@#AC@#_sc_begin_trans(&quot;connection&quot;)', 'sc_exec_sql_@#AC@#_sc_exec_sql(&quot;sql command&quot;, &quot;connection&quot;)', 'sc_lookup_@#AC@#_sc_lookup(dataset, &quot;sql command&quot;, &quot;connection&quot;)', 'sc_select_@#AC@#_sc_select(dataset, &quot;sql command&quot;, &quot;connection&quot;)', 'sc_date_@#AC@#_sc_date(date, format, operator, D,M,Y)', 'sc_date_conv_@#AC@#_sc_date_conv({field_date}, &quot;fmt_input&quot;, &quot;fmt_output&quot;)', 'sc_date_dif_@#AC@#_sc_date_dif(date1, format date1, date2, format date 2)', 'sc_date_dif_2_@#AC@#_sc_date_dif_2(date1, format date1, date2, format date 2, option)', 'sc_apl_conf_@#AC@#_sc_apl_conf(Application, Property, value)', 'sc_calc_dv_@#AC@#_sc_calc_dv(dv, rest, value, module, weights,type)', 'sc_decode_@#AC@#_sc_decode(field/variable)', 'sc_encode_@#AC@#_sc_encode(field/variable)', 'sc_error_exit_@#AC@#_sc_error_exit(URL/Application, target)', 'sc_error_message_@#AC@#_sc_error_message(&quot;text&quot;)', 'sc_exit_@#AC@#_sc_exit(Option)', 'sc_include_@#AC@#_sc_include(file, source)', 'sc_mail_send_@#AC@#_sc_mail_send(smtp, usr, pw, de, para, assunto, mensagem, tipo_mens, c&oacute;pias, tp_c&oacute;pias, porta, tp_conexao, attachment)', 'sc_redir_@#AC@#_sc_redir(apl, parm1; parm2; ..., target)', 'sc_reset_global_@#AC@#_sc_reset_global([var_glo1], [var_glo2] ...)', 'sc_set_global_@#AC@#_sc_set_global($var_1, {field_x}, ...)', 'sc_site_ssl_@#AC@#_sc_site_ssl', 'sc_trunc_num_@#AC@#_sc_trunc_num(field,  qt_dec)', 'sc_url_exit_@#AC@#_sc_url_exit(url)', 'sc_warning_@#AC@#_sc_warning = \'on\'/\'off\'', 'sc_zip_file_@#AC@#_sc_zip_file(files, zip)', 'sc_apl_status_@#AC@#_sc_apl_status(application, status)', 'sc_reset_apl_conf_@#AC@#_sc_reset_apl_conf(Application, Property)', 'sc_reset_apl_status_@#AC@#_sc_reset_apl_status()', 'sc_block_display_@#AC@#_sc_block_display(&quot;block&quot;,&quot;on/off&quot;)', 'sc_field_display_@#AC@#_sc_field_display({field}, on/off)', 'sc_field_readonly_@#AC@#_sc_field_readonly({field})', 'sc_format_num_@#AC@#_sc_format_num(field, group_symb,  dec_symb, amount_dec, fill_zeros,   side_neg,  currency_symb, side_currency_symb)', 'sc_form_show_@#AC@#_sc_form_show = \'on\'/\'off\'', 'sc_btn_display_@#AC@#_sc_btn_display(&quot;button&quot;,&quot;on/off&quot;)');
		break;

		case "form_onButtonClick":
			$arr_wizard	= array('sc_begin_trans_@#AC@#_sc_begin_trans(&quot;connection&quot;)', 'sc_commit_trans_@#AC@#_sc_commit_trans(&quot;connection&quot;)', 'sc_exec_sql_@#AC@#_sc_exec_sql(&quot;sql command&quot;, &quot;connection&quot;)', 'sc_lookup_@#AC@#_sc_lookup(dataset, &quot;sql command&quot;, &quot;connection&quot;)', 'sc_rollback_trans_@#AC@#_sc_rollback_trans(&quot;connection&quot;)', 'sc_select_@#AC@#_sc_select(dataset, &quot;sql command&quot;, &quot;connection&quot;)', 'sc_date_@#AC@#_sc_date(date, format, operator, D,M,Y)', 'sc_date_conv_@#AC@#_sc_date_conv({field_date}, &quot;fmt_input&quot;, &quot;fmt_output&quot;)', 'sc_date_dif_@#AC@#_sc_date_dif(date1, format date1, date2, format date 2)', 'sc_date_dif_2_@#AC@#_sc_date_dif_2(date1, format date1, date2, format date 2, option)', 'sc_apl_conf_@#AC@#_sc_apl_conf(Application, Property, value)', 'sc_calc_dv_@#AC@#_sc_calc_dv(dv, rest, value, module, weights,type)', 'sc_confirm_@#AC@#_sc_confirm(&quot;message&quot;)', 'sc_decode_@#AC@#_sc_decode(field/variable)', 'sc_encode_@#AC@#_sc_encode(field/variable)', 'sc_error_exit_@#AC@#_sc_error_exit(URL/Application, target)', 'sc_exit_@#AC@#_sc_exit(Option)', 'sc_include_@#AC@#_sc_include(file, source)', 'sc_mail_send_@#AC@#_sc_mail_send(smtp, usr, pw, de, para, assunto, mensagem, tipo_mens, c&oacute;pias, tp_c&oacute;pias, porta, tp_conexao, attachment)', 'sc_master_value_@#AC@#_sc_master_value(\'object\', value)', 'sc_redir_@#AC@#_sc_redir(apl, parm1; parm2; ..., target)', 'sc_reset_global_@#AC@#_sc_reset_global([var_glo1], [var_glo2] ...)', 'sc_set_global_@#AC@#_sc_set_global($var_1, {field_x}, ...)', 'sc_site_ssl_@#AC@#_sc_site_ssl', 'sc_trunc_num_@#AC@#_sc_trunc_num(field,  qt_dec)', 'sc_url_exit_@#AC@#_sc_url_exit(url)', 'sc_warning_@#AC@#_sc_warning = \'on\'/\'off\'', 'sc_zip_file_@#AC@#_sc_zip_file(files, zip)', 'sc_apl_status_@#AC@#_sc_apl_status(application, status)', 'sc_reset_apl_conf_@#AC@#_sc_reset_apl_conf(Application, Property)', 'sc_reset_apl_status_@#AC@#_sc_reset_apl_status()', 'sc_format_num_@#AC@#_sc_format_num(field, group_symb,  dec_symb, amount_dec, fill_zeros,   side_neg,  currency_symb, side_currency_symb)');
		break;

		case "form_onScriptInit":
			$arr_wizard	= array('sc_begin_trans_@#AC@#_sc_begin_trans(&quot;connection&quot;)', 'sc_commit_trans_@#AC@#_sc_commit_trans(&quot;connection&quot;)', 'sc_exec_sql_@#AC@#_sc_exec_sql(&quot;sql command&quot;, &quot;connection&quot;)', 'sc_lookup_@#AC@#_sc_lookup(dataset, &quot;sql command&quot;, &quot;connection&quot;)', 'sc_rollback_trans_@#AC@#_sc_rollback_trans(&quot;connection&quot;)', 'sc_select_@#AC@#_sc_select(dataset, &quot;sql command&quot;, &quot;connection&quot;)', 'sc_date_@#AC@#_sc_date(date, format, operator, D,M,Y)', 'sc_date_conv_@#AC@#_sc_date_conv({field_date}, &quot;fmt_input&quot;, &quot;fmt_output&quot;)', 'sc_date_dif_@#AC@#_sc_date_dif(date1, format date1, date2, format date 2)', 'sc_date_dif_2_@#AC@#_sc_date_dif_2(date1, format date1, date2, format date 2, option)', 'sc_date_empty_@#AC@#_sc_date_empty({field_date})', 'sc_alert_@#AC@#_sc_alert(&quot;message&quot;)', 'sc_apl_conf_@#AC@#_sc_apl_conf(Application, Property, value)', 'sc_calc_dv_@#AC@#_sc_calc_dv(dv, rest, value, module, weights,type)', 'sc_decode_@#AC@#_sc_decode(field/variable)', 'sc_encode_@#AC@#_sc_encode(field/variable)', 'sc_error_exit_@#AC@#_sc_error_exit(URL/Application, target)', 'sc_error_message_@#AC@#_sc_error_message(&quot;text&quot;)', 'sc_exit_@#AC@#_sc_exit(Option)', 'sc_image_@#AC@#_sc_image(img1.jpg,img2.gif,...)', 'sc_include_@#AC@#_sc_include(file, source)', 'sc_label_@#AC@#_sc_label(field)', 'sc_mail_send_@#AC@#_sc_mail_send(smtp, usr, pw, de, para, assunto, mensagem, tipo_mens, c&oacute;pias, tp_c&oacute;pias, porta, tp_conexao, attachment)', 'sc_master_value_@#AC@#_sc_master_value(\'object\', value)', 'sc_redir_@#AC@#_sc_redir(apl, parm1; parm2; ..., target)', 'sc_reset_global_@#AC@#_sc_reset_global([var_glo1], [var_glo2] ...)', 'sc_set_global_@#AC@#_sc_set_global($var_1, {field_x}, ...)', 'sc_site_ssl_@#AC@#_sc_site_ssl', 'sc_trunc_num_@#AC@#_sc_trunc_num(field,  qt_dec)', 'sc_url_exit_@#AC@#_sc_url_exit(url)', 'sc_warning_@#AC@#_sc_warning = \'on\'/\'off\'', 'sc_zip_file_@#AC@#_sc_zip_file(files, zip)', 'sc_apl_status_@#AC@#_sc_apl_status(application, status)', 'sc_reset_apl_conf_@#AC@#_sc_reset_apl_conf(Application, Property)', 'sc_reset_apl_status_@#AC@#_sc_reset_apl_status()', 'sc_block_display_@#AC@#_sc_block_display(&quot;block&quot;,&quot;on/off&quot;)', 'sc_field_display_@#AC@#_sc_field_display({field}, on/off)', 'sc_field_readonly_@#AC@#_sc_field_readonly({field})', 'sc_format_num_@#AC@#_sc_format_num(field, group_symb,  dec_symb, amount_dec, fill_zeros,   side_neg,  currency_symb, side_currency_symb)', 'sc_form_show_@#AC@#_sc_form_show = \'on\'/\'off\'', 'sc_btn_delete_@#AC@#_sc_btn_delete', 'sc_btn_display_@#AC@#_sc_btn_display(&quot;button&quot;,&quot;on/off&quot;)', 'sc_btn_insert_@#AC@#_sc_btn_insert', 'sc_btn_new_@#AC@#_sc_btn_new', 'sc_btn_update_@#AC@#_sc_btn_update');
		break;

		case "form_onLoadAll":
			$arr_wizard	= array('sc_begin_trans_@#AC@#_sc_begin_trans(&quot;connection&quot;)', 'sc_commit_trans_@#AC@#_sc_commit_trans(&quot;connection&quot;)', 'sc_exec_sql_@#AC@#_sc_exec_sql(&quot;sql command&quot;, &quot;connection&quot;)', 'sc_lookup_@#AC@#_sc_lookup(dataset, &quot;sql command&quot;, &quot;connection&quot;)', 'sc_rollback_trans_@#AC@#_sc_rollback_trans(&quot;connection&quot;)', 'sc_select_@#AC@#_sc_select(dataset, &quot;sql command&quot;, &quot;connection&quot;)', 'sc_date_@#AC@#_sc_date(date, format, operator, D,M,Y)', 'sc_date_conv_@#AC@#_sc_date_conv({field_date}, &quot;fmt_input&quot;, &quot;fmt_output&quot;)', 'sc_date_dif_@#AC@#_sc_date_dif(date1, format date1, date2, format date 2)', 'sc_date_dif_2_@#AC@#_sc_date_dif_2(date1, format date1, date2, format date 2, option)', 'sc_alert_@#AC@#_sc_alert(&quot;message&quot;)', 'sc_apl_conf_@#AC@#_sc_apl_conf(Application, Property, value)', 'sc_calc_dv_@#AC@#_sc_calc_dv(dv, rest, value, module, weights,type)', 'sc_decode_@#AC@#_sc_decode(field/variable)', 'sc_encode_@#AC@#_sc_encode(field/variable)', 'sc_error_exit_@#AC@#_sc_error_exit(URL/Application, target)', 'sc_error_message_@#AC@#_sc_error_message(&quot;text&quot;)', 'sc_exit_@#AC@#_sc_exit(Option)', 'sc_image_@#AC@#_sc_image(img1.jpg,img2.gif,...)', 'sc_include_@#AC@#_sc_include(file, source)', 'sc_label_@#AC@#_sc_label(field)', 'sc_mail_send_@#AC@#_sc_mail_send(smtp, usr, pw, de, para, assunto, mensagem, tipo_mens, c&oacute;pias, tp_c&oacute;pias, porta, tp_conexao, attachment)', 'sc_redir_@#AC@#_sc_redir(apl, parm1; parm2; ..., target)', 'sc_reset_global_@#AC@#_sc_reset_global([var_glo1], [var_glo2] ...)', 'sc_set_global_@#AC@#_sc_set_global($var_1, {field_x}, ...)', 'sc_site_ssl_@#AC@#_sc_site_ssl', 'sc_trunc_num_@#AC@#_sc_trunc_num(field,  qt_dec)', 'sc_url_exit_@#AC@#_sc_url_exit(url)', 'sc_warning_@#AC@#_sc_warning = \'on\'/\'off\'', 'sc_zip_file_@#AC@#_sc_zip_file(files, zip)', 'sc_apl_status_@#AC@#_sc_apl_status(application, status)', 'sc_reset_apl_conf_@#AC@#_sc_reset_apl_conf(Application, Property)', 'sc_reset_apl_status_@#AC@#_sc_reset_apl_status()', 'sc_block_display_@#AC@#_sc_block_display(&quot;block&quot;,&quot;on/off&quot;)', 'sc_field_display_@#AC@#_sc_field_display({field}, on/off)', 'sc_field_readonly_@#AC@#_sc_field_readonly({field})', 'sc_format_num_@#AC@#_sc_format_num(field, group_symb,  dec_symb, amount_dec, fill_zeros,   side_neg,  currency_symb, side_currency_symb)', 'sc_form_show_@#AC@#_sc_form_show = \'on\'/\'off\'', 'sc_btn_display_@#AC@#_sc_btn_display(&quot;button&quot;,&quot;on/off&quot;)');
		break;

		case "form_onRecord":
			$arr_wizard	= array('sc_begin_trans_@#AC@#_sc_begin_trans(&quot;connection&quot;)', 'sc_commit_trans_@#AC@#_sc_commit_trans(&quot;connection&quot;)', 'sc_exec_sql_@#AC@#_sc_exec_sql(&quot;sql command&quot;, &quot;connection&quot;)', 'sc_lookup_@#AC@#_sc_lookup(dataset, &quot;sql command&quot;, &quot;connection&quot;)', 'sc_rollback_trans_@#AC@#_sc_rollback_trans(&quot;connection&quot;)', 'sc_select_@#AC@#_sc_select(dataset, &quot;sql command&quot;, &quot;connection&quot;)', 'sc_date_@#AC@#_sc_date(date, format, operator, D,M,Y)', 'sc_date_conv_@#AC@#_sc_date_conv({field_date}, &quot;fmt_input&quot;, &quot;fmt_output&quot;)', 'sc_date_dif_@#AC@#_sc_date_dif(date1, format date1, date2, format date 2)', 'sc_date_dif_2_@#AC@#_sc_date_dif_2(date1, format date1, date2, format date 2, option)', 'sc_alert_@#AC@#_sc_alert(&quot;message&quot;)', 'sc_apl_conf_@#AC@#_sc_apl_conf(Application, Property, value)', 'sc_calc_dv_@#AC@#_sc_calc_dv(dv, rest, value, module, weights,type)', 'sc_decode_@#AC@#_sc_decode(field/variable)', 'sc_encode_@#AC@#_sc_encode(field/variable)', 'sc_error_exit_@#AC@#_sc_error_exit(URL/Application, target)', 'sc_error_message_@#AC@#_sc_error_message(&quot;text&quot;)', 'sc_exit_@#AC@#_sc_exit(Option)', 'sc_image_@#AC@#_sc_image(img1.jpg,img2.gif,...)', 'sc_include_@#AC@#_sc_include(file, source)', 'sc_label_@#AC@#_sc_label(field)', 'sc_mail_send_@#AC@#_sc_mail_send(smtp, usr, pw, de, para, assunto, mensagem, tipo_mens, c&oacute;pias, tp_c&oacute;pias, porta, tp_conexao, attachment)', 'sc_master_value_@#AC@#_sc_master_value(\'object\', value)', 'sc_redir_@#AC@#_sc_redir(apl, parm1; parm2; ..., target)', 'sc_reset_global_@#AC@#_sc_reset_global([var_glo1], [var_glo2] ...)', 'sc_set_global_@#AC@#_sc_set_global($var_1, {field_x}, ...)', 'sc_site_ssl_@#AC@#_sc_site_ssl', 'sc_trunc_num_@#AC@#_sc_trunc_num(field,  qt_dec)', 'sc_url_exit_@#AC@#_sc_url_exit(url)', 'sc_warning_@#AC@#_sc_warning = \'on\'/\'off\'', 'sc_zip_file_@#AC@#_sc_zip_file(files, zip)', 'sc_apl_status_@#AC@#_sc_apl_status(application, status)', 'sc_reset_apl_conf_@#AC@#_sc_reset_apl_conf(Application, Property)', 'sc_reset_apl_status_@#AC@#_sc_reset_apl_status()', 'sc_block_display_@#AC@#_sc_block_display(&quot;block&quot;,&quot;on/off&quot;)', 'sc_field_display_@#AC@#_sc_field_display({field}, on/off)', 'sc_field_readonly_@#AC@#_sc_field_readonly({field})', 'sc_format_num_@#AC@#_sc_format_num(field, group_symb,  dec_symb, amount_dec, fill_zeros,   side_neg,  currency_symb, side_currency_symb)', 'sc_form_show_@#AC@#_sc_form_show = \'on\'/\'off\'', 'sc_btn_display_@#AC@#_sc_btn_display(&quot;button&quot;,&quot;on/off&quot;)');
		break;

		case "form_onRefresh":
			$arr_wizard	= array('sc_begin_trans_@#AC@#_sc_begin_trans(&quot;connection&quot;)', 'sc_commit_trans_@#AC@#_sc_commit_trans(&quot;connection&quot;)', 'sc_exec_sql_@#AC@#_sc_exec_sql(&quot;sql command&quot;, &quot;connection&quot;)', 'sc_lookup_@#AC@#_sc_lookup(dataset, &quot;sql command&quot;, &quot;connection&quot;)', 'sc_rollback_trans_@#AC@#_sc_rollback_trans(&quot;connection&quot;)', 'sc_select_@#AC@#_sc_select(dataset, &quot;sql command&quot;, &quot;connection&quot;)', 'sc_sql_injection_@#AC@#_sc_sql_injection(field/variable)', 'sc_date_@#AC@#_sc_date(date, format, operator, D,M,Y)', 'sc_date_conv_@#AC@#_sc_date_conv({field_date}, &quot;fmt_input&quot;, &quot;fmt_output&quot;)', 'sc_date_dif_@#AC@#_sc_date_dif(date1, format date1, date2, format date 2)', 'sc_date_dif_2_@#AC@#_sc_date_dif_2(date1, format date1, date2, format date 2, option)', 'sc_date_empty_@#AC@#_sc_date_empty({field_date})', 'sc_alert_@#AC@#_sc_alert(&quot;message&quot;)', 'sc_apl_conf_@#AC@#_sc_apl_conf(Application, Property, value)', 'sc_calc_dv_@#AC@#_sc_calc_dv(dv, rest, value, module, weights,type)', 'sc_changed_@#AC@#_sc_changed({field})', 'sc_decode_@#AC@#_sc_decode(field/variable)', 'sc_encode_@#AC@#_sc_encode(field/variable)', 'sc_error_exit_@#AC@#_sc_error_exit(URL/Application, target)', 'sc_error_message_@#AC@#_sc_error_message(&quot;text&quot;)', 'sc_exit_@#AC@#_sc_exit(Option)', 'sc_include_@#AC@#_sc_include(file, source)', 'sc_label_@#AC@#_sc_label(field)', 'sc_master_value_@#AC@#_sc_master_value(\'object\', value)', 'sc_reset_global_@#AC@#_sc_reset_global([var_glo1], [var_glo2] ...)', 'sc_set_global_@#AC@#_sc_set_global($var_1, {field_x}, ...)', 'sc_site_ssl_@#AC@#_sc_site_ssl', 'sc_trunc_num_@#AC@#_sc_trunc_num(field,  qt_dec)', 'sc_url_exit_@#AC@#_sc_url_exit(url)', 'sc_warning_@#AC@#_sc_warning = \'on\'/\'off\'', 'sc_zip_file_@#AC@#_sc_zip_file(files, zip)', 'sc_apl_status_@#AC@#_sc_apl_status(application, status)', 'sc_reset_apl_conf_@#AC@#_sc_reset_apl_conf(Application, Property)', 'sc_reset_apl_status_@#AC@#_sc_reset_apl_status()', 'sc_block_display_@#AC@#_sc_block_display(&quot;block&quot;,&quot;on/off&quot;)', 'sc_field_display_@#AC@#_sc_field_display({field}, on/off)', 'sc_field_readonly_@#AC@#_sc_field_readonly({field})', 'sc_format_num_@#AC@#_sc_format_num(field, group_symb,  dec_symb, amount_dec, fill_zeros,   side_neg,  currency_symb, side_currency_symb)', 'sc_btn_display_@#AC@#_sc_btn_display(&quot;button&quot;,&quot;on/off&quot;)');
		break;

		case "form_onValidate":
			$arr_wizard	= array('sc_begin_trans_@#AC@#_sc_begin_trans(&quot;connection&quot;)', 'sc_commit_trans_@#AC@#_sc_commit_trans(&quot;connection&quot;)', 'sc_exec_sql_@#AC@#_sc_exec_sql(&quot;sql command&quot;, &quot;connection&quot;)', 'sc_lookup_@#AC@#_sc_lookup(dataset, &quot;sql command&quot;, &quot;connection&quot;)', 'sc_rollback_trans_@#AC@#_sc_rollback_trans(&quot;connection&quot;)', 'sc_select_@#AC@#_sc_select(dataset, &quot;sql command&quot;, &quot;connection&quot;)', 'sc_sql_injection_@#AC@#_sc_sql_injection(field/variable)', 'sc_date_@#AC@#_sc_date(date, format, operator, D,M,Y)', 'sc_date_conv_@#AC@#_sc_date_conv({field_date}, &quot;fmt_input&quot;, &quot;fmt_output&quot;)', 'sc_date_dif_@#AC@#_sc_date_dif(date1, format date1, date2, format date 2)', 'sc_date_dif_2_@#AC@#_sc_date_dif_2(date1, format date1, date2, format date 2, option)', 'sc_date_empty_@#AC@#_sc_date_empty({field_date})', 'sc_alert_@#AC@#_sc_alert(&quot;message&quot;)', 'sc_apl_conf_@#AC@#_sc_apl_conf(Application, Property, value)', 'sc_calc_dv_@#AC@#_sc_calc_dv(dv, rest, value, module, weights,type)', 'sc_changed_@#AC@#_sc_changed({field})', 'sc_decode_@#AC@#_sc_decode(field/variable)', 'sc_encode_@#AC@#_sc_encode(field/variable)', 'sc_error_exit_@#AC@#_sc_error_exit(URL/Application, target)', 'sc_error_message_@#AC@#_sc_error_message(&quot;text&quot;)', 'sc_exit_@#AC@#_sc_exit(Option)', 'sc_image_@#AC@#_sc_image(img1.jpg,img2.gif,...)', 'sc_include_@#AC@#_sc_include(file, source)', 'sc_mail_send_@#AC@#_sc_mail_send(smtp, usr, pw, de, para, assunto, mensagem, tipo_mens, c&oacute;pias, tp_c&oacute;pias, porta, tp_conexao, attachment)', 'sc_master_value_@#AC@#_sc_master_value(\'object\', value)', 'sc_redir_@#AC@#_sc_redir(apl, parm1; parm2; ..., target)', 'sc_reset_global_@#AC@#_sc_reset_global([var_glo1], [var_glo2] ...)', 'sc_set_global_@#AC@#_sc_set_global($var_1, {field_x}, ...)', 'sc_site_ssl_@#AC@#_sc_site_ssl', 'sc_trunc_num_@#AC@#_sc_trunc_num(field,  qt_dec)', 'sc_url_exit_@#AC@#_sc_url_exit(url)', 'sc_warning_@#AC@#_sc_warning = \'on\'/\'off\'', 'sc_zip_file_@#AC@#_sc_zip_file(files, zip)', 'sc_apl_status_@#AC@#_sc_apl_status(application, status)', 'sc_reset_apl_conf_@#AC@#_sc_reset_apl_conf(Application, Property)', 'sc_reset_apl_status_@#AC@#_sc_reset_apl_status()', 'sc_block_display_@#AC@#_sc_block_display(&quot;block&quot;,&quot;on/off&quot;)', 'sc_field_display_@#AC@#_sc_field_display({field}, on/off)', 'sc_field_readonly_@#AC@#_sc_field_readonly({field})', 'sc_format_num_@#AC@#_sc_format_num(field, group_symb,  dec_symb, amount_dec, fill_zeros,   side_neg,  currency_symb, side_currency_symb)', 'sc_form_show_@#AC@#_sc_form_show = \'on\'/\'off\'', 'sc_btn_delete_@#AC@#_sc_btn_delete', 'sc_btn_display_@#AC@#_sc_btn_display(&quot;button&quot;,&quot;on/off&quot;)', 'sc_btn_insert_@#AC@#_sc_btn_insert', 'sc_btn_new_@#AC@#_sc_btn_new', 'sc_btn_update_@#AC@#_sc_btn_update');
		break;

		case "form_controle_ajaxFieldonBlur":
			$arr_wizard	= array('sc_lookup_@#AC@#_sc_lookup(dataset, &quot;sql command&quot;, &quot;connection&quot;)', 'sc_select_@#AC@#_sc_select(dataset, &quot;sql command&quot;, &quot;connection&quot;)', 'sc_sql_injection_@#AC@#_sc_sql_injection(field/variable)', 'sc_date_@#AC@#_sc_date(date, format, operator, D,M,Y)', 'sc_date_conv_@#AC@#_sc_date_conv({field_date}, &quot;fmt_input&quot;, &quot;fmt_output&quot;)', 'sc_date_dif_@#AC@#_sc_date_dif(date1, format date1, date2, format date 2)', 'sc_date_dif_2_@#AC@#_sc_date_dif_2(date1, format date1, date2, format date 2, option)', 'sc_date_empty_@#AC@#_sc_date_empty({field_date})', 'sc_calc_dv_@#AC@#_sc_calc_dv(dv, rest, value, module, weights,type)', 'sc_decode_@#AC@#_sc_decode(field/variable)', 'sc_encode_@#AC@#_sc_encode(field/variable)', 'sc_error_exit_@#AC@#_sc_error_exit(URL/Application, target)', 'sc_error_message_@#AC@#_sc_error_message(&quot;text&quot;)', 'sc_include_@#AC@#_sc_include(file, source)', 'sc_label_@#AC@#_sc_label(field)', 'sc_site_ssl_@#AC@#_sc_site_ssl', 'sc_trunc_num_@#AC@#_sc_trunc_num(field,  qt_dec)', 'sc_warning_@#AC@#_sc_warning = \'on\'/\'off\'', 'sc_block_display_@#AC@#_sc_block_display(&quot;block&quot;,&quot;on/off&quot;)', 'sc_field_display_@#AC@#_sc_field_display({field}, on/off)', 'sc_field_readonly_@#AC@#_sc_field_readonly({field})', 'sc_format_num_@#AC@#_sc_format_num(field, group_symb,  dec_symb, amount_dec, fill_zeros,   side_neg,  currency_symb, side_currency_symb)', 'sc_set_focus_@#AC@#_sc_set_focus(\'Field\')');
		break;

		case "form_controle_ajaxFieldonChange":
			$arr_wizard	= array('sc_lookup_@#AC@#_sc_lookup(dataset, &quot;sql command&quot;, &quot;connection&quot;)', 'sc_sql_injection_@#AC@#_sc_sql_injection(field/variable)', 'sc_date_@#AC@#_sc_date(date, format, operator, D,M,Y)', 'sc_date_conv_@#AC@#_sc_date_conv({field_date}, &quot;fmt_input&quot;, &quot;fmt_output&quot;)', 'sc_date_dif_@#AC@#_sc_date_dif(date1, format date1, date2, format date 2)', 'sc_date_dif_2_@#AC@#_sc_date_dif_2(date1, format date1, date2, format date 2, option)', 'sc_date_empty_@#AC@#_sc_date_empty({field_date})', 'sc_calc_dv_@#AC@#_sc_calc_dv(dv, rest, value, module, weights,type)', 'sc_decode_@#AC@#_sc_decode(field/variable)', 'sc_encode_@#AC@#_sc_encode(field/variable)', 'sc_error_exit_@#AC@#_sc_error_exit(URL/Application, target)', 'sc_error_message_@#AC@#_sc_error_message(&quot;text&quot;)', 'sc_include_@#AC@#_sc_include(file, source)', 'sc_label_@#AC@#_sc_label(field)', 'sc_trunc_num_@#AC@#_sc_trunc_num(field,  qt_dec)', 'sc_warning_@#AC@#_sc_warning = \'on\'/\'off\'', 'sc_block_display_@#AC@#_sc_block_display(&quot;block&quot;,&quot;on/off&quot;)', 'sc_field_display_@#AC@#_sc_field_display({field}, on/off)', 'sc_field_readonly_@#AC@#_sc_field_readonly({field})', 'sc_format_num_@#AC@#_sc_format_num(field, group_symb,  dec_symb, amount_dec, fill_zeros,   side_neg,  currency_symb, side_currency_symb)', 'sc_set_focus_@#AC@#_sc_set_focus(\'Field\')');
		break;

		case "form_controle_ajaxFieldonClick":
			$arr_wizard	= array('sc_lookup_@#AC@#_sc_lookup(dataset, &quot;sql command&quot;, &quot;connection&quot;)', 'sc_select_@#AC@#_sc_select(dataset, &quot;sql command&quot;, &quot;connection&quot;)', 'sc_sql_injection_@#AC@#_sc_sql_injection(field/variable)', 'sc_date_@#AC@#_sc_date(date, format, operator, D,M,Y)', 'sc_date_conv_@#AC@#_sc_date_conv({field_date}, &quot;fmt_input&quot;, &quot;fmt_output&quot;)', 'sc_date_dif_@#AC@#_sc_date_dif(date1, format date1, date2, format date 2)', 'sc_date_dif_2_@#AC@#_sc_date_dif_2(date1, format date1, date2, format date 2, option)', 'sc_date_empty_@#AC@#_sc_date_empty({field_date})', 'sc_calc_dv_@#AC@#_sc_calc_dv(dv, rest, value, module, weights,type)', 'sc_decode_@#AC@#_sc_decode(field/variable)', 'sc_encode_@#AC@#_sc_encode(field/variable)', 'sc_error_exit_@#AC@#_sc_error_exit(URL/Application, target)', 'sc_error_message_@#AC@#_sc_error_message(&quot;text&quot;)', 'sc_include_@#AC@#_sc_include(file, source)', 'sc_label_@#AC@#_sc_label(field)', 'sc_trunc_num_@#AC@#_sc_trunc_num(field,  qt_dec)', 'sc_warning_@#AC@#_sc_warning = \'on\'/\'off\'', 'sc_block_display_@#AC@#_sc_block_display(&quot;block&quot;,&quot;on/off&quot;)', 'sc_field_display_@#AC@#_sc_field_display({field}, on/off)', 'sc_field_readonly_@#AC@#_sc_field_readonly({field})', 'sc_format_num_@#AC@#_sc_format_num(field, group_symb,  dec_symb, amount_dec, fill_zeros,   side_neg,  currency_symb, side_currency_symb)', 'sc_set_focus_@#AC@#_sc_set_focus(\'Field\')');
		break;

		case "form_controle_ajaxFieldonFocus":
			$arr_wizard	= array('sc_lookup_@#AC@#_sc_lookup(dataset, &quot;sql command&quot;, &quot;connection&quot;)', 'sc_select_@#AC@#_sc_select(dataset, &quot;sql command&quot;, &quot;connection&quot;)', 'sc_sql_injection_@#AC@#_sc_sql_injection(field/variable)', 'sc_date_@#AC@#_sc_date(date, format, operator, D,M,Y)', 'sc_date_conv_@#AC@#_sc_date_conv({field_date}, &quot;fmt_input&quot;, &quot;fmt_output&quot;)', 'sc_date_dif_@#AC@#_sc_date_dif(date1, format date1, date2, format date 2)', 'sc_date_dif_2_@#AC@#_sc_date_dif_2(date1, format date1, date2, format date 2, option)', 'sc_date_empty_@#AC@#_sc_date_empty({field_date})', 'sc_calc_dv_@#AC@#_sc_calc_dv(dv, rest, value, module, weights,type)', 'sc_decode_@#AC@#_sc_decode(field/variable)', 'sc_encode_@#AC@#_sc_encode(field/variable)', 'sc_error_exit_@#AC@#_sc_error_exit(URL/Application, target)', 'sc_error_message_@#AC@#_sc_error_message(&quot;text&quot;)', 'sc_groupby_label_@#AC@#_sc_groupby_label(field)', 'sc_include_@#AC@#_sc_include(file, source)', 'sc_label_@#AC@#_sc_label(field)', 'sc_link_@#AC@#_sc_link(column, application, parameters, hint, target)', 'sc_trunc_num_@#AC@#_sc_trunc_num(field,  qt_dec)', 'sc_warning_@#AC@#_sc_warning = \'on\'/\'off\'', 'sc_block_display_@#AC@#_sc_block_display(&quot;block&quot;,&quot;on/off&quot;)', 'sc_field_display_@#AC@#_sc_field_display({field}, on/off)', 'sc_field_readonly_@#AC@#_sc_field_readonly({field})', 'sc_format_num_@#AC@#_sc_format_num(field, group_symb,  dec_symb, amount_dec, fill_zeros,   side_neg,  currency_symb, side_currency_symb)', 'sc_form_show_@#AC@#_sc_form_show = \'on\'/\'off\'', 'sc_set_focus_@#AC@#_sc_set_focus(\'Field\')');
		break;

		case "form_controle_onButtonClick":
			$arr_wizard	= array('sc_begin_trans_@#AC@#_sc_begin_trans(&quot;connection&quot;)', 'sc_commit_trans_@#AC@#_sc_commit_trans(&quot;connection&quot;)', 'sc_exec_sql_@#AC@#_sc_exec_sql(&quot;sql command&quot;, &quot;connection&quot;)', 'sc_lookup_@#AC@#_sc_lookup(dataset, &quot;sql command&quot;, &quot;connection&quot;)', 'sc_rollback_trans_@#AC@#_sc_rollback_trans(&quot;connection&quot;)', 'sc_select_@#AC@#_sc_select(dataset, &quot;sql command&quot;, &quot;connection&quot;)', 'sc_date_@#AC@#_sc_date(date, format, operator, D,M,Y)', 'sc_date_conv_@#AC@#_sc_date_conv({field_date}, &quot;fmt_input&quot;, &quot;fmt_output&quot;)', 'sc_date_dif_@#AC@#_sc_date_dif(date1, format date1, date2, format date 2)', 'sc_date_dif_2_@#AC@#_sc_date_dif_2(date1, format date1, date2, format date 2, option)', 'sc_apl_conf_@#AC@#_sc_apl_conf(Application, Property, value)', 'sc_calc_dv_@#AC@#_sc_calc_dv(dv, rest, value, module, weights,type)', 'sc_confirm_@#AC@#_sc_confirm(&quot;message&quot;)', 'sc_exit_@#AC@#_sc_exit(Option)', 'sc_include_@#AC@#_sc_include(file, source)', 'sc_mail_send_@#AC@#_sc_mail_send(smtp, usr, pw, de, para, assunto, mensagem, tipo_mens, c&oacute;pias, tp_c&oacute;pias, porta, tp_conexao, attachment)', 'sc_redir_@#AC@#_sc_redir(apl, parm1; parm2; ..., target)', 'sc_reset_global_@#AC@#_sc_reset_global([var_glo1], [var_glo2] ...)', 'sc_set_global_@#AC@#_sc_set_global($var_1, {field_x}, ...)', 'sc_trunc_num_@#AC@#_sc_trunc_num(field,  qt_dec)', 'sc_warning_@#AC@#_sc_warning = \'on\'/\'off\'', 'sc_zip_file_@#AC@#_sc_zip_file(files, zip)', 'sc_apl_status_@#AC@#_sc_apl_status(application, status)', 'sc_reset_apl_conf_@#AC@#_sc_reset_apl_conf(Application, Property)', 'sc_reset_apl_status_@#AC@#_sc_reset_apl_status()', 'sc_format_num_@#AC@#_sc_format_num(field, group_symb,  dec_symb, amount_dec, fill_zeros,   side_neg,  currency_symb, side_currency_symb)');
		break;

		case "form_controle_onScriptInit":
			$arr_wizard	= array('sc_begin_trans_@#AC@#_sc_begin_trans(&quot;connection&quot;)', 'sc_commit_trans_@#AC@#_sc_commit_trans(&quot;connection&quot;)', 'sc_exec_sql_@#AC@#_sc_exec_sql(&quot;sql command&quot;, &quot;connection&quot;)', 'sc_lookup_@#AC@#_sc_lookup(dataset, &quot;sql command&quot;, &quot;connection&quot;)', 'sc_rollback_trans_@#AC@#_sc_rollback_trans(&quot;connection&quot;)', 'sc_select_@#AC@#_sc_select(dataset, &quot;sql command&quot;, &quot;connection&quot;)', 'sc_sql_injection_@#AC@#_sc_sql_injection(field/variable)', 'sc_date_@#AC@#_sc_date(date, format, operator, D,M,Y)', 'sc_date_conv_@#AC@#_sc_date_conv({field_date}, &quot;fmt_input&quot;, &quot;fmt_output&quot;)', 'sc_date_dif_@#AC@#_sc_date_dif(date1, format date1, date2, format date 2)', 'sc_date_dif_2_@#AC@#_sc_date_dif_2(date1, format date1, date2, format date 2, option)', 'sc_date_empty_@#AC@#_sc_date_empty({field_date})', 'sc_alert_@#AC@#_sc_alert(&quot;message&quot;)', 'sc_apl_conf_@#AC@#_sc_apl_conf(Application, Property, value)', 'sc_calc_dv_@#AC@#_sc_calc_dv(dv, rest, value, module, weights,type)', 'sc_changed_@#AC@#_sc_changed({field})', 'sc_decode_@#AC@#_sc_decode(field/variable)', 'sc_encode_@#AC@#_sc_encode(field/variable)', 'sc_error_exit_@#AC@#_sc_error_exit(URL/Application, target)', 'sc_error_message_@#AC@#_sc_error_message(&quot;text&quot;)', 'sc_exit_@#AC@#_sc_exit(Option)', 'sc_image_@#AC@#_sc_image(img1.jpg,img2.gif,...)', 'sc_include_@#AC@#_sc_include(file, source)', 'sc_label_@#AC@#_sc_label(field)', 'sc_mail_send_@#AC@#_sc_mail_send(smtp, usr, pw, de, para, assunto, mensagem, tipo_mens, c&oacute;pias, tp_c&oacute;pias, porta, tp_conexao, attachment)', 'sc_redir_@#AC@#_sc_redir(apl, parm1; parm2; ..., target)', 'sc_reset_global_@#AC@#_sc_reset_global([var_glo1], [var_glo2] ...)', 'sc_set_global_@#AC@#_sc_set_global($var_1, {field_x}, ...)', 'sc_site_ssl_@#AC@#_sc_site_ssl', 'sc_trunc_num_@#AC@#_sc_trunc_num(field,  qt_dec)', 'sc_url_exit_@#AC@#_sc_url_exit(url)', 'sc_warning_@#AC@#_sc_warning = \'on\'/\'off\'', 'sc_zip_file_@#AC@#_sc_zip_file(files, zip)', 'sc_apl_status_@#AC@#_sc_apl_status(application, status)', 'sc_reset_apl_conf_@#AC@#_sc_reset_apl_conf(Application, Property)', 'sc_reset_apl_status_@#AC@#_sc_reset_apl_status()', 'sc_block_display_@#AC@#_sc_block_display(&quot;block&quot;,&quot;on/off&quot;)', 'sc_field_display_@#AC@#_sc_field_display({field}, on/off)', 'sc_field_readonly_@#AC@#_sc_field_readonly({field})', 'sc_format_num_@#AC@#_sc_format_num(field, group_symb,  dec_symb, amount_dec, fill_zeros,   side_neg,  currency_symb, side_currency_symb)', 'sc_form_show_@#AC@#_sc_form_show = \'on\'/\'off\'', 'sc_btn_display_@#AC@#_sc_btn_display(&quot;button&quot;,&quot;on/off&quot;)');
		break;

		case "form_controle_onLoadAll":
			$arr_wizard	= array('sc_lookup_@#AC@#_sc_lookup(dataset, &quot;sql command&quot;, &quot;connection&quot;)', 'sc_rollback_trans_@#AC@#_sc_rollback_trans(&quot;connection&quot;)', 'sc_select_@#AC@#_sc_select(dataset, &quot;sql command&quot;, &quot;connection&quot;)', 'sc_date_@#AC@#_sc_date(date, format, operator, D,M,Y)', 'sc_date_conv_@#AC@#_sc_date_conv({field_date}, &quot;fmt_input&quot;, &quot;fmt_output&quot;)', 'sc_date_dif_@#AC@#_sc_date_dif(date1, format date1, date2, format date 2)', 'sc_date_dif_2_@#AC@#_sc_date_dif_2(date1, format date1, date2, format date 2, option)', 'sc_alert_@#AC@#_sc_alert(&quot;message&quot;)', 'sc_apl_conf_@#AC@#_sc_apl_conf(Application, Property, value)', 'sc_calc_dv_@#AC@#_sc_calc_dv(dv, rest, value, module, weights,type)', 'sc_decode_@#AC@#_sc_decode(field/variable)', 'sc_encode_@#AC@#_sc_encode(field/variable)', 'sc_error_exit_@#AC@#_sc_error_exit(URL/Application, target)', 'sc_error_message_@#AC@#_sc_error_message(&quot;text&quot;)', 'sc_exit_@#AC@#_sc_exit(Option)', 'sc_image_@#AC@#_sc_image(img1.jpg,img2.gif,...)', 'sc_include_@#AC@#_sc_include(file, source)', 'sc_label_@#AC@#_sc_label(field)', 'sc_mail_send_@#AC@#_sc_mail_send(smtp, usr, pw, de, para, assunto, mensagem, tipo_mens, c&oacute;pias, tp_c&oacute;pias, porta, tp_conexao, attachment)', 'sc_redir_@#AC@#_sc_redir(apl, parm1; parm2; ..., target)', 'sc_reset_global_@#AC@#_sc_reset_global([var_glo1], [var_glo2] ...)', 'sc_set_global_@#AC@#_sc_set_global($var_1, {field_x}, ...)', 'sc_site_ssl_@#AC@#_sc_site_ssl', 'sc_trunc_num_@#AC@#_sc_trunc_num(field,  qt_dec)', 'sc_url_exit_@#AC@#_sc_url_exit(url)', 'sc_warning_@#AC@#_sc_warning = \'on\'/\'off\'', 'sc_zip_file_@#AC@#_sc_zip_file(files, zip)', 'sc_apl_status_@#AC@#_sc_apl_status(application, status)', 'sc_reset_apl_conf_@#AC@#_sc_reset_apl_conf(Application, Property)', 'sc_reset_apl_status_@#AC@#_sc_reset_apl_status()', 'sc_block_display_@#AC@#_sc_block_display(&quot;block&quot;,&quot;on/off&quot;)', 'sc_field_display_@#AC@#_sc_field_display({field}, on/off)', 'sc_field_readonly_@#AC@#_sc_field_readonly({field})', 'sc_format_num_@#AC@#_sc_format_num(field, group_symb,  dec_symb, amount_dec, fill_zeros,   side_neg,  currency_symb, side_currency_symb)', 'sc_form_show_@#AC@#_sc_form_show = \'on\'/\'off\'', 'sc_btn_display_@#AC@#_sc_btn_display(&quot;button&quot;,&quot;on/off&quot;)');
		break;

		case "form_controle_onRefresh":
			$arr_wizard	= array('sc_lookup_@#AC@#_sc_lookup(dataset, &quot;sql command&quot;, &quot;connection&quot;)', 'sc_select_@#AC@#_sc_select(dataset, &quot;sql command&quot;, &quot;connection&quot;)', 'sc_date_@#AC@#_sc_date(date, format, operator, D,M,Y)', 'sc_date_conv_@#AC@#_sc_date_conv({field_date}, &quot;fmt_input&quot;, &quot;fmt_output&quot;)', 'sc_date_dif_@#AC@#_sc_date_dif(date1, format date1, date2, format date 2)', 'sc_date_dif_2_@#AC@#_sc_date_dif_2(date1, format date1, date2, format date 2, option)', 'sc_date_empty_@#AC@#_sc_date_empty({field_date})', 'sc_calc_dv_@#AC@#_sc_calc_dv(dv, rest, value, module, weights,type)', 'sc_changed_@#AC@#_sc_changed({field})', 'sc_decode_@#AC@#_sc_decode(field/variable)', 'sc_encode_@#AC@#_sc_encode(field/variable)', 'sc_error_exit_@#AC@#_sc_error_exit(URL/Application, target)', 'sc_error_message_@#AC@#_sc_error_message(&quot;text&quot;)', 'sc_include_@#AC@#_sc_include(file, source)', 'sc_trunc_num_@#AC@#_sc_trunc_num(field,  qt_dec)', 'sc_warning_@#AC@#_sc_warning = \'on\'/\'off\'', 'sc_format_num_@#AC@#_sc_format_num(field, group_symb,  dec_symb, amount_dec, fill_zeros,   side_neg,  currency_symb, side_currency_symb)');
		break;

		case "form_controle_onValidate":
			$arr_wizard	= array('sc_begin_trans_@#AC@#_sc_begin_trans(&quot;connection&quot;)', 'sc_commit_trans_@#AC@#_sc_commit_trans(&quot;connection&quot;)', 'sc_exec_sql_@#AC@#_sc_exec_sql(&quot;sql command&quot;, &quot;connection&quot;)', 'sc_lookup_@#AC@#_sc_lookup(dataset, &quot;sql command&quot;, &quot;connection&quot;)', 'sc_rollback_trans_@#AC@#_sc_rollback_trans(&quot;connection&quot;)', 'sc_select_@#AC@#_sc_select(dataset, &quot;sql command&quot;, &quot;connection&quot;)', 'sc_sql_injection_@#AC@#_sc_sql_injection(field/variable)', 'sc_date_@#AC@#_sc_date(date, format, operator, D,M,Y)', 'sc_date_conv_@#AC@#_sc_date_conv({field_date}, &quot;fmt_input&quot;, &quot;fmt_output&quot;)', 'sc_date_dif_@#AC@#_sc_date_dif(date1, format date1, date2, format date 2)', 'sc_date_dif_2_@#AC@#_sc_date_dif_2(date1, format date1, date2, format date 2, option)', 'sc_date_empty_@#AC@#_sc_date_empty({field_date})', 'sc_alert_@#AC@#_sc_alert(&quot;message&quot;)', 'sc_apl_conf_@#AC@#_sc_apl_conf(Application, Property, value)', 'sc_calc_dv_@#AC@#_sc_calc_dv(dv, rest, value, module, weights,type)', 'sc_changed_@#AC@#_sc_changed({field})', 'sc_decode_@#AC@#_sc_decode(field/variable)', 'sc_encode_@#AC@#_sc_encode(field/variable)', 'sc_error_exit_@#AC@#_sc_error_exit(URL/Application, target)', 'sc_error_message_@#AC@#_sc_error_message(&quot;text&quot;)', 'sc_exit_@#AC@#_sc_exit(Option)', 'sc_image_@#AC@#_sc_image(img1.jpg,img2.gif,...)', 'sc_include_@#AC@#_sc_include(file, source)', 'sc_mail_send_@#AC@#_sc_mail_send(smtp, usr, pw, de, para, assunto, mensagem, tipo_mens, c&oacute;pias, tp_c&oacute;pias, porta, tp_conexao, attachment)', 'sc_redir_@#AC@#_sc_redir(apl, parm1; parm2; ..., target)', 'sc_reset_global_@#AC@#_sc_reset_global([var_glo1], [var_glo2] ...)', 'sc_set_global_@#AC@#_sc_set_global($var_1, {field_x}, ...)', 'sc_site_ssl_@#AC@#_sc_site_ssl', 'sc_trunc_num_@#AC@#_sc_trunc_num(field,  qt_dec)', 'sc_url_exit_@#AC@#_sc_url_exit(url)', 'sc_warning_@#AC@#_sc_warning = \'on\'/\'off\'', 'sc_zip_file_@#AC@#_sc_zip_file(files, zip)', 'sc_apl_status_@#AC@#_sc_apl_status(application, status)', 'sc_reset_apl_conf_@#AC@#_sc_reset_apl_conf(Application, Property)', 'sc_reset_apl_status_@#AC@#_sc_reset_apl_status()', 'sc_block_display_@#AC@#_sc_block_display(&quot;block&quot;,&quot;on/off&quot;)', 'sc_field_display_@#AC@#_sc_field_display({field}, on/off)', 'sc_field_readonly_@#AC@#_sc_field_readonly({field})', 'sc_format_num_@#AC@#_sc_format_num(field, group_symb,  dec_symb, amount_dec, fill_zeros,   side_neg,  currency_symb, side_currency_symb)', 'sc_form_show_@#AC@#_sc_form_show = \'on\'/\'off\'', 'sc_btn_display_@#AC@#_sc_btn_display(&quot;button&quot;,&quot;on/off&quot;)');
		break;

		case "menu_onExecute":
			$arr_wizard	= array('sc_lookup_@#AC@#_sc_lookup(dataset, &quot;sql command&quot;, &quot;connection&quot;)', 'sc_select_@#AC@#_sc_select(dataset, &quot;sql command&quot;, &quot;connection&quot;)', 'sc_date_@#AC@#_sc_date(date, format, operator, D,M,Y)', 'sc_date_conv_@#AC@#_sc_date_conv({field_date}, &quot;fmt_input&quot;, &quot;fmt_output&quot;)', 'sc_date_dif_@#AC@#_sc_date_dif(date1, format date1, date2, format date 2)', 'sc_date_dif_2_@#AC@#_sc_date_dif_2(date1, format date1, date2, format date 2, option)', 'sc_calc_dv_@#AC@#_sc_calc_dv(dv, rest, value, module, weights,type)', 'sc_include_@#AC@#_sc_include(file, source)', 'sc_redir_@#AC@#_sc_redir(apl, parm1; parm2; ..., target)', 'sc_reset_global_@#AC@#_sc_reset_global([var_glo1], [var_glo2] ...)', 'sc_set_global_@#AC@#_sc_set_global($var_1, {field_x}, ...)', 'sc_trunc_num_@#AC@#_sc_trunc_num(field,  qt_dec)', 'sc_warning_@#AC@#_sc_warning = \'on\'/\'off\'', 'sc_reset_menu_delete_@#AC@#_sc_reset_menu_delete()', 'sc_reset_menu_disable_@#AC@#_sc_reset_menu_disable()', 'sc_format_num_@#AC@#_sc_format_num(field, group_symb,  dec_symb, amount_dec, fill_zeros,   side_neg,  currency_symb, side_currency_symb)', 'sc_menu_item_@#AC@#_{sc_menu_item}', 'sc_script_name_@#AC@#_{sc_script_name}');
		break;

		case "menu_onLoad":
			$arr_wizard	= array('sc_lookup_@#AC@#_sc_lookup(dataset, &quot;sql command&quot;, &quot;connection&quot;)', 'sc_select_@#AC@#_sc_select(dataset, &quot;sql command&quot;, &quot;connection&quot;)', 'sc_date_@#AC@#_sc_date(date, format, operator, D,M,Y)', 'sc_date_conv_@#AC@#_sc_date_conv({field_date}, &quot;fmt_input&quot;, &quot;fmt_output&quot;)', 'sc_date_dif_@#AC@#_sc_date_dif(date1, format date1, date2, format date 2)', 'sc_date_dif_2_@#AC@#_sc_date_dif_2(date1, format date1, date2, format date 2, option)', 'sc_apl_conf_@#AC@#_sc_apl_conf(Application, Property, value)', 'sc_calc_dv_@#AC@#_sc_calc_dv(dv, rest, value, module, weights,type)', 'sc_image_@#AC@#_sc_image(img1.jpg,img2.gif,...)', 'sc_include_@#AC@#_sc_include(file, source)', 'sc_mail_send_@#AC@#_sc_mail_send(smtp, usr, pw, de, para, assunto, mensagem, tipo_mens, c&oacute;pias, tp_c&oacute;pias, porta, tp_conexao, attachment)', 'sc_reset_global_@#AC@#_sc_reset_global([var_glo1], [var_glo2] ...)', 'sc_set_global_@#AC@#_sc_set_global($var_1, {field_x}, ...)', 'sc_trunc_num_@#AC@#_sc_trunc_num(field,  qt_dec)', 'sc_warning_@#AC@#_sc_warning = \'on\'/\'off\'', 'sc_apl_status_@#AC@#_sc_apl_status(application, status)', 'sc_reset_apl_conf_@#AC@#_sc_reset_apl_conf(Application, Property)', 'sc_reset_apl_status_@#AC@#_sc_reset_apl_status()', 'sc_reset_menu_delete_@#AC@#_sc_reset_menu_delete()', 'sc_reset_menu_disable_@#AC@#_sc_reset_menu_disable()', 'sc_format_num_@#AC@#_sc_format_num(field, group_symb,  dec_symb, amount_dec, fill_zeros,   side_neg,  currency_symb, side_currency_symb)', 'sc_menu_delete_@#AC@#_sc_menu_deleteid_item1,id_item2,...', 'sc_menu_disable_@#AC@#_sc_menu_disableid_item1,id_item2,...');
		break;

		case "menutree_onExecute":
			$arr_wizard	= array('sc_lookup_@#AC@#_sc_lookup(dataset, &quot;sql command&quot;, &quot;connection&quot;)', 'sc_select_@#AC@#_sc_select(dataset, &quot;sql command&quot;, &quot;connection&quot;)', 'sc_date_@#AC@#_sc_date(date, format, operator, D,M,Y)', 'sc_date_conv_@#AC@#_sc_date_conv({field_date}, &quot;fmt_input&quot;, &quot;fmt_output&quot;)', 'sc_date_dif_@#AC@#_sc_date_dif(date1, format date1, date2, format date 2)', 'sc_date_dif_2_@#AC@#_sc_date_dif_2(date1, format date1, date2, format date 2, option)', 'sc_calc_dv_@#AC@#_sc_calc_dv(dv, rest, value, module, weights,type)', 'sc_include_@#AC@#_sc_include(file, source)', 'sc_redir_@#AC@#_sc_redir(apl, parm1; parm2; ..., target)', 'sc_reset_global_@#AC@#_sc_reset_global([var_glo1], [var_glo2] ...)', 'sc_set_global_@#AC@#_sc_set_global($var_1, {field_x}, ...)', 'sc_trunc_num_@#AC@#_sc_trunc_num(field,  qt_dec)', 'sc_warning_@#AC@#_sc_warning = \'on\'/\'off\'', 'sc_reset_menu_delete_@#AC@#_sc_reset_menu_delete()', 'sc_reset_menu_disable_@#AC@#_sc_reset_menu_disable()', 'sc_format_num_@#AC@#_sc_format_num(field, group_symb,  dec_symb, amount_dec, fill_zeros,   side_neg,  currency_symb, side_currency_symb)', 'sc_menu_item_@#AC@#_{sc_menu_item}', 'sc_script_name_@#AC@#_{sc_script_name}');
		break;

		case "menutree_onLoad":
			$arr_wizard	= array('sc_lookup_@#AC@#_sc_lookup(dataset, &quot;sql command&quot;, &quot;connection&quot;)', 'sc_select_@#AC@#_sc_select(dataset, &quot;sql command&quot;, &quot;connection&quot;)', 'sc_date_@#AC@#_sc_date(date, format, operator, D,M,Y)', 'sc_date_conv_@#AC@#_sc_date_conv({field_date}, &quot;fmt_input&quot;, &quot;fmt_output&quot;)', 'sc_date_dif_@#AC@#_sc_date_dif(date1, format date1, date2, format date 2)', 'sc_date_dif_2_@#AC@#_sc_date_dif_2(date1, format date1, date2, format date 2, option)', 'sc_apl_conf_@#AC@#_sc_apl_conf(Application, Property, value)', 'sc_calc_dv_@#AC@#_sc_calc_dv(dv, rest, value, module, weights,type)', 'sc_image_@#AC@#_sc_image(img1.jpg,img2.gif,...)', 'sc_include_@#AC@#_sc_include(file, source)', 'sc_mail_send_@#AC@#_sc_mail_send(smtp, usr, pw, de, para, assunto, mensagem, tipo_mens, c&oacute;pias, tp_c&oacute;pias, porta, tp_conexao, attachment)', 'sc_reset_global_@#AC@#_sc_reset_global([var_glo1], [var_glo2] ...)', 'sc_set_global_@#AC@#_sc_set_global($var_1, {field_x}, ...)', 'sc_trunc_num_@#AC@#_sc_trunc_num(field,  qt_dec)', 'sc_warning_@#AC@#_sc_warning = \'on\'/\'off\'', 'sc_apl_status_@#AC@#_sc_apl_status(application, status)', 'sc_reset_apl_conf_@#AC@#_sc_reset_apl_conf(Application, Property)', 'sc_reset_apl_status_@#AC@#_sc_reset_apl_status()', 'sc_reset_menu_delete_@#AC@#_sc_reset_menu_delete()', 'sc_reset_menu_disable_@#AC@#_sc_reset_menu_disable()', 'sc_format_num_@#AC@#_sc_format_num(field, group_symb,  dec_symb, amount_dec, fill_zeros,   side_neg,  currency_symb, side_currency_symb)', 'sc_menu_delete_@#AC@#_sc_menu_deleteid_item1,id_item2,...', 'sc_menu_disable_@#AC@#_sc_menu_disableid_item1,id_item2,...');
		break;

		case "reportpdf_onFooter":
			$arr_wizard	= array('sc_lookup_@#AC@#_sc_lookup(dataset, &quot;sql command&quot;, &quot;connection&quot;)', 'sc_select_@#AC@#_sc_select(dataset, &quot;sql command&quot;, &quot;connection&quot;)', 'sc_date_@#AC@#_sc_date(date, format, operator, D,M,Y)', 'sc_date_conv_@#AC@#_sc_date_conv({field_date}, &quot;fmt_input&quot;, &quot;fmt_output&quot;)', 'sc_date_dif_@#AC@#_sc_date_dif(date1, format date1, date2, format date 2)', 'sc_date_dif_2_@#AC@#_sc_date_dif_2(date1, format date1, date2, format date 2, option)', 'sc_calc_dv_@#AC@#_sc_calc_dv(dv, rest, value, module, weights,type)', 'sc_include_@#AC@#_sc_include(file, source)', 'sc_reset_global_@#AC@#_sc_reset_global([var_glo1], [var_glo2] ...)', 'sc_set_global_@#AC@#_sc_set_global($var_1, {field_x}, ...)', 'sc_trunc_num_@#AC@#_sc_trunc_num(field,  qt_dec)', 'sc_warning_@#AC@#_sc_warning = \'on\'/\'off\'', 'sc_format_num_@#AC@#_sc_format_num(field, group_symb,  dec_symb, amount_dec, fill_zeros,   side_neg,  currency_symb, side_currency_symb)');
		break;

		case "reportpdf_onHeader":
			$arr_wizard	= array('sc_lookup_@#AC@#_sc_lookup(dataset, &quot;sql command&quot;, &quot;connection&quot;)', 'sc_select_@#AC@#_sc_select(dataset, &quot;sql command&quot;, &quot;connection&quot;)', 'sc_date_@#AC@#_sc_date(date, format, operator, D,M,Y)', 'sc_date_conv_@#AC@#_sc_date_conv({field_date}, &quot;fmt_input&quot;, &quot;fmt_output&quot;)', 'sc_date_dif_@#AC@#_sc_date_dif(date1, format date1, date2, format date 2)', 'sc_date_dif_2_@#AC@#_sc_date_dif_2(date1, format date1, date2, format date 2, option)', 'sc_calc_dv_@#AC@#_sc_calc_dv(dv, rest, value, module, weights,type)', 'sc_include_@#AC@#_sc_include(file, source)', 'sc_reset_global_@#AC@#_sc_reset_global([var_glo1], [var_glo2] ...)', 'sc_set_global_@#AC@#_sc_set_global($var_1, {field_x}, ...)', 'sc_trunc_num_@#AC@#_sc_trunc_num(field,  qt_dec)', 'sc_warning_@#AC@#_sc_warning = \'on\'/\'off\'', 'sc_format_num_@#AC@#_sc_format_num(field, group_symb,  dec_symb, amount_dec, fill_zeros,   side_neg,  currency_symb, side_currency_symb)');
		break;

		case "reportpdf_onScriptInit":
			$arr_wizard	= array('sc_exec_sql_@#AC@#_sc_exec_sql(&quot;sql command&quot;, &quot;connection&quot;)', 'sc_lookup_@#AC@#_sc_lookup(dataset, &quot;sql command&quot;, &quot;connection&quot;)', 'sc_select_@#AC@#_sc_select(dataset, &quot;sql command&quot;, &quot;connection&quot;)', 'sc_select_field_@#AC@#_sc_select_field({field})', 'sc_select_order_@#AC@#_sc_select_order(field)', 'sc_select_where_@#AC@#_sc_select_where(add)', 'sc_where_current_@#AC@#_{sc_where_current}', 'sc_where_orig_@#AC@#_{sc_where_orig}', 'sc_date_@#AC@#_sc_date(date, format, operator, D,M,Y)', 'sc_date_conv_@#AC@#_sc_date_conv({field_date}, &quot;fmt_input&quot;, &quot;fmt_output&quot;)', 'sc_date_dif_@#AC@#_sc_date_dif(date1, format date1, date2, format date 2)', 'sc_date_dif_2_@#AC@#_sc_date_dif_2(date1, format date1, date2, format date 2, option)', 'sc_apl_conf_@#AC@#_sc_apl_conf(Application, Property, value)', 'sc_calc_dv_@#AC@#_sc_calc_dv(dv, rest, value, module, weights,type)', 'sc_decode_@#AC@#_sc_decode(field/variable)', 'sc_encode_@#AC@#_sc_encode(field/variable)', 'sc_label_@#AC@#_sc_label(field)', 'sc_mail_send_@#AC@#_sc_mail_send(smtp, usr, pw, de, para, assunto, mensagem, tipo_mens, c&oacute;pias, tp_c&oacute;pias, porta, tp_conexao, attachment)', 'sc_redir_@#AC@#_sc_redir(apl, parm1; parm2; ..., target)', 'sc_reset_global_@#AC@#_sc_reset_global([var_glo1], [var_glo2] ...)', 'sc_set_global_@#AC@#_sc_set_global($var_1, {field_x}, ...)', 'sc_site_ssl_@#AC@#_sc_site_ssl', 'sc_trunc_num_@#AC@#_sc_trunc_num(field,  qt_dec)', 'sc_url_exit_@#AC@#_sc_url_exit(url)', 'sc_warning_@#AC@#_sc_warning = \'on\'/\'off\'', 'sc_zip_file_@#AC@#_sc_zip_file(files, zip)', 'sc_where_filter_@#AC@#_{sc_where_filter}', 'sc_apl_status_@#AC@#_sc_apl_status(application, status)', 'sc_reset_apl_conf_@#AC@#_sc_reset_apl_conf(Application, Property)', 'sc_reset_apl_status_@#AC@#_sc_reset_apl_status()', 'sc_block_display_@#AC@#_sc_block_display(&quot;block&quot;,&quot;on/off&quot;)', 'sc_field_color_@#AC@#_sc_field_color(&quot;field&quot;, &quot;color&quot;)', 'sc_field_display_@#AC@#_sc_field_display({field}, on/off)', 'sc_format_num_@#AC@#_sc_format_num(field, group_symb,  dec_symb, amount_dec, fill_zeros,   side_neg,  currency_symb, side_currency_symb)');
		break;

		case "reportpdf_onRecord":
			$arr_wizard	= array('sc_lookup_@#AC@#_sc_lookup(dataset, &quot;sql command&quot;, &quot;connection&quot;)', 'sc_select_@#AC@#_sc_select(dataset, &quot;sql command&quot;, &quot;connection&quot;)', 'sc_where_current_@#AC@#_{sc_where_current}', 'sc_where_orig_@#AC@#_{sc_where_orig}', 'sc_date_@#AC@#_sc_date(date, format, operator, D,M,Y)', 'sc_date_conv_@#AC@#_sc_date_conv({field_date}, &quot;fmt_input&quot;, &quot;fmt_output&quot;)', 'sc_date_dif_@#AC@#_sc_date_dif(date1, format date1, date2, format date 2)', 'sc_date_dif_2_@#AC@#_sc_date_dif_2(date1, format date1, date2, format date 2, option)', 'sc_calc_dv_@#AC@#_sc_calc_dv(dv, rest, value, module, weights,type)', 'sc_include_@#AC@#_sc_include(file, source)', 'sc_link_@#AC@#_sc_link(column, application, parameters, hint, target)', 'sc_mail_send_@#AC@#_sc_mail_send(smtp, usr, pw, de, para, assunto, mensagem, tipo_mens, c&oacute;pias, tp_c&oacute;pias, porta, tp_conexao, attachment)', 'sc_make_link_@#AC@#_sc_make_link(application, parameters)', 'sc_reset_global_@#AC@#_sc_reset_global([var_glo1], [var_glo2] ...)', 'sc_seq_register_@#AC@#_{sc_seq_register}', 'sc_set_global_@#AC@#_sc_set_global($var_1, {field_x}, ...)', 'sc_trunc_num_@#AC@#_sc_trunc_num(field,  qt_dec)', 'sc_warning_@#AC@#_sc_warning = \'on\'/\'off\'', 'sc_zip_file_@#AC@#_sc_zip_file(files, zip)', 'sc_where_filter_@#AC@#_{sc_where_filter}', 'sc_field_color_@#AC@#_sc_field_color(&quot;field&quot;, &quot;color&quot;)', 'sc_format_num_@#AC@#_sc_format_num(field, group_symb,  dec_symb, amount_dec, fill_zeros,   side_neg,  currency_symb, side_currency_symb)');
		break;
	}


	return $arr_wizard;

}

?>