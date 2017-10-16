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
 * @author      Vinicius Muniz <vinicius@netmake.com.br>
 *
 * $Id: body_proj_new_step1.tpl.php,v 1.17 2012-01-23 18:46:22 diogo Exp $
 */

/* Protecao contra hacks */
if (!defined('SC_LOCKED_VERSION_8976') || ('CARREGADO4536' != SC_LOCKED_VERSION_8976))
{
    die('<br /><span style="font-weight: bold">Fatal error</span>: ' .
        'invalid access to system file.');
}
	$arr_tables	=	$this->GetVar('arr_tables');

?>
<table class='nmTable'>
<tr>
  <td style="text-align: left; vertical-align: top; white-space: nowrap; padding:5px;">
   <select style='min-width:90px; ' name="sel_fields" size="10" multiple="multiple" class="nmInput" onDblClick="nm_add_item('id_options_select_', 'id_values_select_', 'table');" id='id_options_select_table'>
    <?php
	$html = '';
	foreach($arr_tables as $str_value)
	{
		$html .= <<<EOT
		<option value="{$str_value}" >{$str_value}</option>
EOT;
	}
	echo $html;
    ?>
    </select>
  </td>
  <td style="text-align: center; vertical-align: middle; width:10px;" align="center" valign="middle">
	<input type="button" value="<?php echo nm_get_text_lang("['tabbed_application_add']"); ?> >>" class="nmButton"  onclick="nm_add_item('id_options_select_', 'id_values_select_', 'table'); " style="width:110px">
	<br /><div style="font-size:5px">&nbsp;</div>
	<input type="button" value="<?php echo nm_get_text_lang("['tabbed_application_del']"); ?>  <<" class="nmButton" onclick="nm_add_item('id_values_select_', 'id_options_select_','table');" style="width:110px">
    </td>
  <td style='padding:5px;'>
      <select style='min-width:90px;' id='id_values_select_table' size="10" multiple="multiple" class="nmInput retorno_fields_table" onDblClick="nm_add_item('id_values_select_', 'id_options_select_', 'table');">
      </select>
  </td>
</table>
    <input type='hidden' name='table' class='hid_field_table' value=''>
<script>
function nm_add_item(id1, id2, name, all)
{
	id1 += name;
	id2 += name;
	if(all)
	{
		$('#'+id1+' > option').clone().appendTo($('#'+id2));
		$('#'+id1+' > option').remove();
		nm_update_hid(name);
		return;
	}
	var id1 = $('#'+id1+' >option:selected');
	var tem = false;
	$('#'+id2+' >option').each(function(k,v){
			if($(v).val() == id1.val())
			{
				tem = true;
				return;
			}
		});
	if(!tem)
	{
		id1.clone().appendTo( $('#'+id2) );
		id1.remove();
	}
	nm_update_hid(name);
}

function nm_update_hid(name)
{
    var valor = '';
    $(".retorno_fields_" +name +" >option").each(function(k,v)
    {
	if(valor == '')
	    valor += $(v).val();
	else
	    valor += '_||NM||_'+$(v).val();
    });
    $('.hid_field_'+name).val(valor);
}
</script>
