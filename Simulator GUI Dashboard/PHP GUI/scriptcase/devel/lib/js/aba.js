/**
 * Movimentacao de select da aba.
 *
 * Rotinas de controle dos objetos selects da aba
 *
 * @package     Biblioteca
 * @subpackage  Javascript
 * @creation    2004/01/13
 * @copyright   NetMake Solucoes em Informatica
 * @author      Diogo Silva Toscano De Brito <diogo@netmake.com.br>
 *
 * $Id: aba.js,v 1.1.1.1 2011-05-12 20:31:10 diogo Exp $
 */

function nm_select_removeOption(v_str_form, v_str_block)
{

  obj_blc = document.forms[v_str_form].elements[v_str_block];
  int_blc = obj_blc.selectedIndex;

  if(-1==int_blc)
  {
    return 0;
  }else
  {
    if(int_blc==obj_blc.length-1)
    {
      obj_blc.length= obj_blc.length-1;
    }else
    {
      for(it=int_blc; it<obj_blc.length-1; it++)
      {
        obj_blc.options[it].text  = obj_blc.options[1+it].text;
        obj_blc.options[it].value = obj_blc.options[1+it].value;
      }
      obj_blc.length = obj_blc.length-1;
    }
  }


} // nm_select_removeOption

function nm_select_addOption(v_str_value, v_str_text, v_str_form, v_str_block)
{

  obj_blc = document.forms[v_str_form].elements[v_str_block];
  int_blc = obj_blc.length;

  obj_blc.options[int_blc] = new Option();

  obj_blc.options[int_blc].text  = v_str_text;
  obj_blc.options[int_blc].value = v_str_value;

} // nm_select_addOption



function nm_select_updateOption(v_str_value, v_str_text, v_str_form, v_str_block)
{

  obj_blc = document.forms[v_str_form].elements[v_str_block];
  int_blc = obj_blc.selectedIndex;

  if(-1==int_blc)
  {
    return 0;
  }else
  {
    obj_blc.options[int_blc].text  = v_str_text;
    obj_blc.options[int_blc].value = v_str_value;
  }


} // nm_select_updateOption
