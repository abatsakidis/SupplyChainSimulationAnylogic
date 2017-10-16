<?php
/**
 * Template scriptcase.
 *
 * Criar novo projeto
 *
 * @package     Template
 * @subpackage  Scriptcase
 * @creation    2006/03/07
 * @copyright   NetMake Solucoes em Informatica
 * @author      Diogo Silva Toscano De Brito <diogo@netmake.com.br>
 * @author      Juliano Mesquita dos Santos <juliano@netmake.com.br>
 *
 * $Id: body_proj_new_step1.tpl.php,v 1.17 2012-01-23 18:46:22 diogo Exp $
 */

/* Protecao contra hacks */
if (!defined('SC_LOCKED_VERSION_8976') || ('CARREGADO4536' != SC_LOCKED_VERSION_8976))
{
    die('<br /><span style="font-weight: bold">Fatal error</span>: ' .
        'invalid access to system file.');
}
$arr_data				=	$this->GetVar('arr_data');
$_arr_schemas			=	$this->GetVar('arr_schemas');
$lang_direction			=	$this->GetVar('lang_direction');
$_str_default 			=   '';
$arr_all_mod_schemas	=	array();
		$arr_schemas_all = $_arr_schemas['arr_schemas'];
		if(isset($arr_data['default_schema']))
		{
			$str_default = explode('_#fld#_', $arr_data['default_schema']);
			$str_default = $str_default[0];
		}
		else
		{
			$str_default = $_arr_schemas['sch_default'];
		}
		$str_schemas = '';

		$str_schema_list   = '<select name="schemas_list" size="26" multiple="multiple" class="nmInput"  style="font-size: 14px;min-width:240px;" onDblClick="nm_field_select(\'form_proj_step\', \'schemas_list\', \'schemas_block\', null)" >';
		$str_schema_block  = '<select name="schemas_block" size="26" multiple="multiple" class="nmInput" style="font-size: 14px;min-width:240px;" onDblClick="nm_field_remove(\'form_proj_step\', \'schemas_list\', \'schemas_block\', null)" onchange="nm_change_schema(this.value);">';
		$str_schema_block .= '  <optgroup label="'. nm_get_text_lang("['str_schemas']") .'"></optgroup>';


		foreach($arr_schemas_all as $mod => $arr_schemas)
		{
		    $str_schema_list .= '<optgroup label="'. nm_get_text_lang("['mod_" . $mod . "']") .'">';
            arsort($arr_schemas);
			foreach($arr_schemas as $sch=>$arr_schema)
			{
				$str_disabled = '';
				if($arr_schema['show'] == TRUE)
				{
					$str_disabled = ' disabled="disabled" style="color: #C0C0C0"';

					$str_sch_def = "";
					$str_selected = "";
					if($mod . '__NM__' . $sch == $str_default)
					{
						$str_sch_def = "&nbsp;(" . nm_get_text_lang("['str_default']") . ")";
						$str_selected = "class='default' selected='selected'";
					}
					$arr_all_mod_schemas[] = $mod . '__NM__' . $sch;
					$str_schema_block .= '<option '.$str_selected.' value="'. $mod . '__NM__' . $sch . '_#fld#_' . $sch . '">&nbsp;&nbsp;&nbsp;' . $sch . $str_sch_def . '</option>';
					$str_schemas .= $mod . '__NM__' . $sch . '__#NM#__';
				}
				$str_schema_list .= '<option value="'. $mod . "__NM__" . $sch .'" '. $str_disabled .'>'. $sch .'</option>';

			}
			$str_schema_list .= '</optgroup>';
		}
		$str_schema_list  .= '</select>';
		$str_schema_block .= '</select>';


$str_default = explode('_#fld#_', $str_default);
$str_default = explode('__NM__', $str_default[0]);
$str_default = $str_default[0] . '__NM__'. $str_default[1] . '_#fld#_' . $str_default[1];

?>
<input type='hidden' name='default_schema' value='<?php echo $str_default; ?>' />
<input type="hidden" name="schemas" value="<?php echo $str_schemas; ?>" />
<table cellpadding="2" cellspacing="0" border="0" class ='nmTable' style='width:100%;height:100%;margin: 0 auto;'>
	<tr>
		<td colspan='5' class='nmTitle' style='text-align:center;'>
			<?php echo nm_get_text_lang("['page_title']") . " - ". nm_get_text_lang("['str_schemas']"); ?>
		</td>
	</tr>
    <tr>
        <td
            class="nmTitle td_description" colspan='5'>
            <div style="width: 50%;margin: 0 auto;">
                <?php echo nm_get_text_lang("['step_description']['schema']");?>
            </div>
        </td>
	</tr>
	<tr>
		<td valign="top">
			<div id="id_schemas_list"><br/>
				<?php echo $str_schema_list; ?>
			</div>
		</td>
		<td width="32" align="center" valign="middle">
			<a href="javascript: nm_field_select_all('form_proj_step', 'schemas_list', 'schemas_block', null);"><img src="<?php echo $nm_config['url_scriptcase_img']; ?>img_move_right_all.png" style="border-width: 0px" /></a>
			<br />
			<a href="javascript: nm_field_select('form_proj_step', 'schemas_list', 'schemas_block', null);"><img src="<?php echo $nm_config['url_scriptcase_img']; ?>img_move_right.png" style="border-width: 0px" /></a>
			<br />
			<a href="javascript: nm_field_remove('form_proj_step', 'schemas_list', 'schemas_block', null);"><img src="<?php echo $nm_config['url_scriptcase_img']; ?>img_move_left.png" style="border-width: 0px" /></a>
			<br />
			<a href="javascript: nm_field_remove_all('form_proj_step', 'schemas_list', 'schemas_block', null);"><img src="<?php echo $nm_config['url_scriptcase_img']; ?>img_move_left_all.png" style="border-width: 0px" /></a>
		</td>
		<td valign="top">
			<div id="id_schemas_block"><br/>
				<?php echo $str_schema_block; ?>
			</div>
			<input type="button" value="<?php echo nm_get_text_lang("['bt_set_default_schema']"); ?>" class="nmButton"  onclick="nm_set_default('<?php echo nm_get_text_lang("['str_default']"); ?>');"/>
		</td>
		<td align="left" valign="middle" style="padding: 10px;">
			<br />
			<br />
			<a href="javascript: nm_field_move_up('form_proj_step', 'schemas_block', null, 1);"><img src="<?php echo $nm_config['url_scriptcase_img']; ?>img_move_up.png" style="border-width: 0px" /></a>
			<span style="font-size: 3px"><br /></span>
			<a href="javascript: nm_field_move_down('form_proj_step', 'schemas_block', null, 1);"><img src="<?php echo $nm_config['url_scriptcase_img']; ?>img_move_down.png" style="border-width: 0px" /></a>
		</td>
		<td width="470" height="100%" nowrap style='vertical-align:top;'>
			<iframe src="index.html" style="width: 100%; height: 100%; border: 0px solid #c3c3c3;" SCROLLING=NO id="id_schema_img"></iframe>
		</td>
	</tr>
</table>
