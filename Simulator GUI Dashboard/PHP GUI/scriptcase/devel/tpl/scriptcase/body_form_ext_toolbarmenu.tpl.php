<?php
/**
 * Template scriptcase.
 *
 * Cabecalho do template scriptcase.
 *
 * @package     Template
 * @subpackage  Scriptcase
 * @creation    2012/09/28
 * @copyright   NetMake Solucoes em Informatica
 * @author      Diogo Silva Toscano De Brito <diogo@ipadnet.com.br>
 *
 * $Id: $
 */

/* Protecao contra hacks */
if (!defined('SC_LOCKED_VERSION_8976') || ('CARREGADO4536' != SC_LOCKED_VERSION_8976))
{
    die('<br /><span style="font-weight: bold">Fatal error</span>: ' .
        'invalid access to system file.');
}

$str_form_modif = ('' == $nm_config['form_modif']) ? 'null' : $nm_config['form_modif'];
$arr_schemas  = $this->GetVar('arr_schemas');
$schema       = $this->GetVar('schema');
$arr_data     = $this->GetVar('field_data');
?>
<tr>
<td colspan="3">


<?php

function colocaNivel($var_n_nivel)
{
    $str_nivel = "";

    for($it=1; $it<$var_n_nivel; $it++)
    {
        $str_nivel .= "-&nbsp;";
    }

    return $str_nivel;
}

function menuGeraOptions($menu_array_list, $posicao)
{
    $separador = "_!NM!_";
    if(is_array($menu_array_list))
    {
        foreach($menu_array_list as $options)
        {
            if(isset($options['label']))
            {
            ?>
                <option VALUE="<?php echo $options['id'] . $separador . $options['label'] . $separador . $options['link'] . $separador . $options['target'] . $separador . $options['icon_on'] . $separador . $options['hint'] . $separador . $posicao . $separador . $options['display'] . $separador . $options['display_position']. $separador . $options['type'];?>"><?php echo colocaNivel($posicao).$options['label']; ?></option>
            <?php
                if(isset($options['menu_itens']) && is_array($options['menu_itens']))
                {
                    $posicao++;
                    menuGeraOptions($options['menu_itens'], $posicao);
                    $posicao--;
                }
            }
        }
    }
}

$qtd_itens_menu  = 0;
function menuCountOptions($menu_array_list, $posicao, &$qtd_itens_menu)
{
   if(is_array($menu_array_list))
    {
        foreach($menu_array_list as $options)
        {
            if(isset($options['label']))
            {
            	$qtd_itens_menu++;
                if(isset($options['menu_itens']) && is_array($options['menu_itens']))
                {
                    $posicao++;
                    menuCountOptions($options['menu_itens'], $posicao, $qtd_itens_menu);
                    $posicao--;
                }
            }
        }
    }
}

$array_menus = $arr_data['value'];

menuCountOptions($array_menus, 1, $qtd_itens_menu);

if ($qtd_itens_menu < 21)
{
	$qtd_select_itens = 21;
}
elseif ($qtd_itens_menu > 30)
{
	$qtd_select_itens = 30;
}
else
{
	$qtd_select_itens = $qtd_itens_menu;
}
?>

<table border="0" cellpadding="0" cellspacing="0" align="center" class="nmTable" style="min-width: 600px;">
 <tr valign="middle">
  <td align="center">
	<div class="genericTitleBackground" style="text-align: left;">
		<a href="#" onClick="nmInsertItem(); showToolbarMenu(); <?php echo $str_form_modif; ?>();">
			<img src="<?php echo $nm_config['url_scriptcase_img'];?>me_add.png" border=0 title="<?php echo nm_get_text_lang("['menu_application_add_item']"); ?>" />
		</a>
		<a href="#" onClick="nmInsertItem(1); showToolbarMenu(); <?php echo $str_form_modif; ?>();">
			<img src="<?php echo $nm_config['url_scriptcase_img'];?>me_separator.png" border=0 title="<?php echo nm_get_text_lang("['menu_application_add_separator']"); ?>" />
		</a>
		<a href="#" onClick="nmRemoveItem(); showToolbarMenu(); <?php echo $str_form_modif; ?>();">
			<img src="<?php echo $nm_config['url_scriptcase_img'];?>me_delete.png" border=0 title="<?php echo nm_get_text_lang("['menu_application_delete']"); ?>" />
		</a>
	</div>
	<div>
		<select name="__nm_fld__menus_list" size="<?php echo $qtd_select_itens; ?>" class="nmInput" onChange="nmDisplayItem();" onClick="nmDisplayItem();" multiple style="width: 100%;">
	   <?php
		  menuGeraOptions($array_menus, 1);
	   ?>
	   </select>
	</div>
  </td>
  <td style='padding:5px'>
    <table align='center'>
      <tr>
        <td></td>
        <td>
           <a href="javascript:nm_move_up('form_edit', '__nm_fld__menus_list', <?php echo $str_form_modif; ?>); nmUpdateItem(); showToolbarMenu(); <?php echo $nm_config['form_modif2']; ?>"><img src="<?php echo $nm_config['url_scriptcase_img']; ?>img_move_up.png" border="0"></a>
        </td>
        <td></td>
      </tr>
      <tr>
        <td>
           <a href="javascript:nmShiftLeft(); nmUpdateItem(); showToolbarMenu(); <?php echo $nm_config['form_modif2']; ?>"><img src="<?php echo $nm_config['url_scriptcase_img']; ?>img_move_left.png" border="0"></a>
        </td>
        <td></td>
        <td>
            <a href="javascript:nmShiftRight(2); nmUpdateItem(); showToolbarMenu(); <?php echo $nm_config['form_modif2']; ?>"><img src="<?php echo $nm_config['url_scriptcase_img']; ?>img_move_right.png" border="0"></a>
        </td>
      </tr>
      <tr>
        <td></td>
        <td>
            <a href="javascript:nm_move_down('form_edit', '__nm_fld__menus_list', <?php echo $str_form_modif; ?>); nmUpdateItem(); showToolbarMenu(); <?php echo $nm_config['form_modif2']; ?>"><img src="<?php echo $nm_config['url_scriptcase_img']; ?>img_move_down.png" border="0"></a>
        </td>
        <td></td>
      </tr>
    </table>
  <td align="center" nowrap>
  </td>
  <td nowrap>
	<table>
	<tr>
		<td class="nmText" height="17" colspan=2><span id='id_field_id'></span></td>
	</tr>
	<tr>
		<td class="nmText" colspan=2>
	   <?php echo nm_get_text_lang("['type']"); ?>   <br />
	   <select id="field_type" name="field_type" class="nmInput" onchange="nmUpdateItem(); showToolbarMenu(); <?php echo $nm_config['form_modif2']; ?>">
	       <option value="image"><?php echo nm_get_text_lang("['btn_type']['image']"); ?></option>
	       <option value="button" selected><?php echo nm_get_text_lang("['btn_type']['button']"); ?></option>
	       <option value="link"><?php echo nm_get_text_lang("['btn_type']['link']"); ?></option>
	   </select>
	   </td>
	</tr>
	<tr>
		<td class="nmText" colspan=2>
	   <?php echo nm_get_text_lang("['menu_application_label_label']"); ?>   <br />
	   <input type="text" name="field_label" value="" class="nmInput" onchange="nmUpdateItem(); showToolbarMenu(); <?php echo $nm_config['form_modif2']; ?>">
	   </td>
	</tr>
	<tr>
		<td class="nmText">
		   <?php echo nm_get_text_lang("['menu_application_label_link']"); ?>   <br />
		   <input type="text" name="field_link" value="" class="nmInput" onchange="nmUpdateItem(); showToolbarMenu(); <?php echo $nm_config['form_modif2']; ?>">
	    </td>
	    <td valign="bottom">
		   <a href="javascript:nmImportApp('radio', 'field_link'); <?php echo $nm_config['form_modif2']; ?>"><img src="<?php echo $nm_config['url_img']; ?>link.gif" border='0'style="height: 16px; width: 16px; vertical-align: middle" /></a>
		</td>
	   </td>
	</tr>
	<tr>
            <td class="nmText" colspan=2>
	   <?php echo nm_get_text_lang("['menu_application_label_hint']"); ?>   <br />
	   <input type="text" name="field_hint" value="" class="nmInput" onchange="nmUpdateItem(); showToolbarMenu();<?php echo $nm_config['form_modif2']; ?>">
	   </td>
	</tr>
	<tr>
		<td class="nmText" colspan=2>
	   <?php echo nm_get_text_lang("['display']"); ?>   <br />
	   <select id="field_display" name="field_display" class="nmInput" onchange="nmUpdateItem(); showToolbarMenu();<?php echo $nm_config['form_modif2']; ?>">
	       <option value="only_text" selected><?php echo nm_get_text_lang("['display_only_text']"); ?></option>
	       <option value="only_img"><?php echo nm_get_text_lang("['display_only_img']"); ?></option>
	       <option value="text_img"><?php echo nm_get_text_lang("['display_both']"); ?></option>
	   </select>
	   </td>
	</tr>
	<tr>
            <td class="nmText">
	   <?php echo nm_get_text_lang("['menu_application_label_icon']"); ?>   <br />
	   <input type="text" id="field_icon_on" name="field_icon_on" value="" class="nmInput" onchange="nmUpdateItem(); showToolbarMenu();<?php echo $nm_config['form_modif2']; ?>" disabled>
	   </td>
	   <td  valign="bottom" id="td_image_button" hidden>
                <a href="javascript: nm_window_image_new('ico','form_edit', 'field_icon_on', 'nmUpdateItem');"><img src="<?php echo $nm_config['url_img']; ?>background.png" style="border-width: 0px" /></a>	   			
	   </td>
	</tr>
	<tr>
		<td class="nmText" colspan=2>
	   <?php echo nm_get_text_lang("['display_position']"); ?>   <br />
	   <select id="field_display_position" name="field_display_position" class="nmInput" onchange="nmUpdateItem(); showToolbarMenu();<?php echo $nm_config['form_modif2']; ?>" disabled>
	       <option value="img_right"><?php echo nm_get_text_lang("['display_position_img_right']"); ?></option>
	       <option value="text_right"><?php echo nm_get_text_lang("['display_position_text_right']"); ?></option>
	   </select>
	   </td>
	</tr>
	<tr>
		<td class="nmText" colspan=2>
	   <?php echo nm_get_text_lang("['menu_application_label_target']"); ?>   <br />
	   <select name="field_target" class="nmInput" onchange="nmUpdateItem(); showToolbarMenu(); <?php echo $nm_config['form_modif2']; ?>">
	       <option value="_self"><?php echo nm_get_text_lang("['menu_application_label_target_self']"); ?></option>
	       <option value="_blank"><?php echo nm_get_text_lang("['menu_application_label_target_blank']"); ?></option>
	       <option value="_parent"><?php echo nm_get_text_lang("['menu_application_label_target_parente']"); ?></option>
	   </select>
	   </td>
	</tr>
	</table>
  </td>
  <td nowrap valign='top'>
   schemas <br />
   <select name="field_schema" class="nmInput" onchange="changeToolbarMenuSchema(this.value);<?php echo $nm_config['form_modif2']; ?>" onkeyup="changeToolbarMenuSchema(this.value);<?php echo $nm_config['form_modif2']; ?>" onmouseup="changeToolbarMenuSchema(this.value);<?php echo $nm_config['form_modif2']; ?>">
	<?php
	$tmp_default = explode('__NM__', $schema);
	list($grp_default, $schm_default) = $tmp_default;
	foreach($arr_schemas as $str_grp => $ar_schema)
	{
		?>
		<optgroup label="<?php echo nm_get_text_lang("['module_" . $str_grp . "']"); ?>">
		<?php
		foreach($ar_schema as $schm)
		{
			$str_selected = "";
			if($str_grp == $grp_default && $schm_default == $schm)
			{
				$str_selected = " selected";
			}
			?>
			<option value='<?php echo $str_grp . '__NM__' . $schm; ?>' <?php echo $str_selected; ?>><?php echo $schm; ?></option>
			<?php
		}
		?>
		</optgroup>
		<?php
	}
	?>
   </select>
  </td>
 </tr>
</table>
<br />
<br />
<br />
<script>
	$(document).ready(function() {
	  showToolbarMenu();
	});
</script>
<span><?php echo nm_get_text_lang("['bt_toolbar_editor_html']['preview']"); ?>:</span>
<hr />
<div id="id_show_toolbarmenu" class="scMenuToolbar" style="-moz-border-radius: 8px; -webkit-border-radius: 8px;"></div>
</td>
</tr>
