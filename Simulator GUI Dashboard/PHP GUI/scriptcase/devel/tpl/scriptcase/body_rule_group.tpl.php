<?php
/**
 * Regras Ordenacoes.
 *
 * Formulario de manipulacao das regras de ordenacoes da aplicacao.
 *
 * @package     Template
 * @subpackage  Scriptcase
 * @creation    2012/10/08
 * @copyright   NetMake Solucoes em Informatica
 * @author      Diogo Silva Toscano de Brito <diogo@netmake.com.br>
 *
 * $Id: $
 */

/* Protecao contra hacks */
if (!defined('SC_LOCKED_VERSION_8976') || ('CARREGADO4536' != SC_LOCKED_VERSION_8976))
{
    die('<br /><span style="font-weight: bold">Fatal error</span>: ' .
        'invalid access to system file.');
}
$field_data      = $this->GetVar('field_data');
$arr_rule_group  = $this->GetVar('arr_rule_group');
$form_option 	 = $this->GetVar('form_option');
$arr_erros   	 = $this->GetVar('arr_erros');
$str_form_modif  = ('' == $nm_config['form_modif']) ? 'null' : $nm_config['form_modif'];
?>

<form name="form_edit" method="post" action="<?php echo nm_url_rand($nm_config['url_iface'] . 'rule_group.php'); ?>">

	<center>
	<br />
	<br />

	<?php
	if (count($arr_erros) > 0)
	{
		?>
			<br /><br />
			<table class="nmTable">
			  <tr>
					<td class="nmErrorTitle">Erros</td>
					<td class="nmErrorTitle"></td>
			  </tr>
		<?php
			foreach ($arr_erros as $str_field => $arr_err)
			{
		?>
				<tr>
					<td class="nmErrorMsg"><?php echo $str_field; ?></td>
					<td class="nmErrorMsg">
		<?php
					for ($i=0; $i < count($arr_err); $i++)
					{
						echo $arr_err[$i]."<br />\n";
					}
		?>
					</td>
				</tr>
		<?php
			}
		?>
			</table>
			<br />
		<?php
	}

	$btn_lang   = nm_get_text_lang("['button_create']");
	$title_lang = nm_get_text_lang("['text']['add_rule_group']");
	if($form_option == 'edit_rule_group')
	{
		$title_lang = nm_get_text_lang("['page_title']");
		$btn_lang   = nm_get_text_lang("['button_save']");

		$form_option = "save";
	}
	?>

	<?php
	if(isset($arr_rule_group['nome']) && $arr_rule_group['nome'] == 'sc_free_group_by')
	{
		?>
		<input type="hidden" name="rule_group_nome"  value="sc_free_group_by" />
		<?php
	}
	?>
	<br />
	<table cellpadding=10 cellspaing=4>
		<tr>
			<td valign='top' align="center">
				<table class="nmTable">
				 <tr>
				  <td class="nmTitle" colspan="2"><?php echo $title_lang; ?></td>
				 </tr>
				 <?php
				if(isset($arr_rule_group['nome']) && $arr_rule_group['nome'] != 'sc_free_group_by')
				{
				?>
				 <tr>
				  <td class="nmGroup" style="padding:4px;border-bottom-color: #63afd1;"><?php echo nm_get_text_lang("['text']['addbtn_name']"); ?></td>
				  <td class="nmGroup" style="padding:4px;border-bottom-color: #63afd1;">
					<?php
					if($form_option == 'save' && !empty($arr_rule_group['nome']))
					{
						echo $arr_rule_group['nome'];
						?>
						<input type="hidden" name="rule_group_nome"  value="<?php echo $arr_rule_group['nome']; ?>" />
						<?php
					}
					else
					{
						?>
						<input type="text" name="rule_group_nome"  value="<?php echo $arr_rule_group['nome']; ?>" size="15" maxlength="20" class="nmInput" />
						<?php
					}
					?>
				  </td>
				 </tr>
				 <?php
				}
				?>
				 <tr style="display:<?php if(isset($arr_rule_group['nome']) && $arr_rule_group['nome'] == 'sc_free_group_by'){ echo "none"; } ?>">
				  <td class="nmGroup" style="padding:4px;border-bottom-color: #63afd1;"><?php echo nm_get_text_lang("['text']['addbtn_label']"); ?></td>
				  <td class="nmGroup" style="padding:4px;border-bottom-color: #63afd1;"><input type="text" name="rule_group_label" value="<?php echo $arr_rule_group['label']; ?>" size="40" maxlength="48" class="nmInput" /></td>
				 </tr>
				  <?php
					if(isset($arr_rule_group['nome']) && $arr_rule_group['nome'] == 'sc_free_group_by')
					{
					?>
					 <tr>
					  <td class="nmGroup" style="padding:4px;border-bottom-color: #63afd1;"><?php echo nm_get_text_lang("['text']['sc_free_group_by_use']"); ?></td>
					  <td class="nmGroup" style="padding:4px;border-bottom-color: #63afd1;"><input type="checkbox" name="rule_group_sc_free_group_by_use" value="Y" <?php if($arr_rule_group['sc_free_group_by_use'] == 'Y'){ echo 'checked'; } ?> class="nmInput" /></td>
					 </tr>
					 <tr>
					  <td class="nmGroup" style="padding:4px;border-bottom-color: #63afd1;"><?php echo nm_get_text_lang("['text']['sc_free_group_by_hide_help_line']"); ?></td>
					  <td class="nmGroup" style="padding:4px;border-bottom-color: #63afd1;"><input type="checkbox" name="rule_group_sc_free_group_by_hide_help_line" value="Y" <?php if($arr_rule_group['sc_free_group_by_hide_help_line'] == 'Y'){ echo 'checked'; } ?> class="nmInput" /></td>
					 </tr>
					 <tr style="display:none">
					  <td class="nmGroup" style="padding:4px;border-bottom-color: #63afd1;"><?php echo nm_get_text_lang("['text']['sc_free_group_by_openmode']"); ?></td>
					  <td class="nmGroup" style="padding:4px;border-bottom-color: #63afd1;">
						<select name="rule_group_sc_free_group_by_openmode" class="nmInput">
							<option value='dragndrop' <?php if($arr_rule_group['sc_free_group_by_openmode']=='dragndrop'){ echo "selected"; }  ?>><?php echo nm_get_text_lang("['text']['sc_free_group_by_openmode_dragndrop']"); ?></option>
							<option value='popup' <?php if($arr_rule_group['sc_free_group_by_openmode']=='popup'){ echo "selected"; }  ?>><?php echo nm_get_text_lang("['text']['sc_free_group_by_openmode_popup']"); ?></option>
							<option value='dragndrop_popup' <?php if($arr_rule_group['sc_free_group_by_openmode']=='dragndrop_popup'){ echo "selected"; }  ?>><?php echo nm_get_text_lang("['text']['sc_free_group_by_openmode_dragndrop_n_popup']"); ?></option>
						</select>
					  </td>
					 </tr>
					<?php
					}
					?>
				</table>

				<br />
				<br />

				<input type="button" value="<?php echo $btn_lang; ?>" class="nmButton" onclick="nm_send_form();" />
				<input type="hidden" name="form_option" value="<?php echo $form_option; ?>" />

			</td>
			<td valign='top'>
				<table cellspacing=0 cellpadding=0 border=0 class="nmTable">
				<?php
					global $nm_template;
					$nm_template->SetVar('field_data', $field_data);
					$nm_template->Display('body_form_ext_cons_flds_group');
				?>
				</table>
			</td>
		</tr>
	</table>
	</center>

<input type="hidden" name="field_fld_section"	    value="" />
<input type="hidden" name="redirect_to" 		    value="" />
<input type="hidden" name="redirect_param" 		    value="" />
<input type="hidden" name="field_xml_fld_tag_redir" value="" />
<input type="hidden" name="field_xml_fld_campo_redir" value="" />
<input type="hidden" name="form_modified" 		    value="" />
<input type="hidden" name="form_edit" 			    value="<?php echo $nm_config['form_valid']; ?>" />

</form>
