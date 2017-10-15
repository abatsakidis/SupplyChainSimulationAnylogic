/**
 * Edicao de lookup.
 *
 * Funcoes para criacao, edicao e remocao de itens de lookup manual.
 *
 * @package     Biblioteca
 * @subpackage  Javascript
 * @creation    2003/01/12
 * @copyright   NetMake Solucoes em Informatica
 * @author      Luis Humberto Roman <romanlh@netmake.com.br>
 *
 * $Id: lookup.js,v 1.4 2011-11-24 19:14:04 vinicius Exp $
 */

/* Indices do array */
var fLabel  = 0;
var fValue  = 1;
var fNegat  = 2;
var fSelect = 3;
var fLocal  = 4;

/**
 * Limpa lista de itens.
 *
 * Remove todos os elementos da lista de itens do lookup.
 *
 * @access  public
 * @param   string  v_str_mod  Modulo do lookup.
 */
function nm_lkp_clear(v_str_mod)
{
 var obj_type = document.form_edit.elements["def_" + v_str_mod + "_type"];
 var str_type = obj_type.options[obj_type.selectedIndex].value;
 var obj_list = document.form_edit.elements["def_" + v_str_mod + "_js_list"];
 var obj_lab  = document.form_edit.elements["def_" + v_str_mod + "_js_label"];
 if ("BINARIO" != str_type)
 {
  var obj_val = document.form_edit.elements["def_" + v_str_mod + "_js_valor"];
 }
 if ("POSICAO" == str_type || str_type == "SIMPLES")
 {
  var obj_des = document.form_edit.elements["def_" + v_str_mod + "_js_desl"];
  var obj_ini = document.form_edit.elements["def_" + v_str_mod + "_js_ini"];
  var obj_tam = document.form_edit.elements["def_" + v_str_mod + "_js_tam"];
 }
 var bol_def = false;
 if (document.form_edit.elements["def_" + v_str_mod + "_js_def"])
 {
  bol_def     = true;
  var obj_def = document.form_edit.elements["def_" + v_str_mod + "_js_def"];
 }
 while (obj_list.length != 0)
 {
  obj_list.options[0] = null;
  obj_lab.value       = "";
  if ("BINARIO" != str_type)
  {
   obj_val.value = "";
  }
  if ("POSICAO" == str_type || str_type == "SIMPLES")
  {
   if(obj_des) obj_des.value = "";
   if(obj_ini) obj_ini.value = "";
   if(obj_tam) obj_tam.value = "";
  }
  if (bol_def)
  {
   obj_def[1].checked = true;
  }
 }
}

/**
 * Limpa um item da lista.
 *
 * Remove o elemento selecionado da lista de itens do lookup.
 *
 * @access  public
 * @param   string  v_str_mod  Modulo do lookup.
 */
function nm_lkp_delete(v_str_mod)
{
 var obj_type = document.form_edit.elements["def_" + v_str_mod + "_type"];
 var str_type = obj_type.options[obj_type.selectedIndex].value;
 var obj_list = document.form_edit.elements["def_" + v_str_mod + "_js_list"];
 var int_sel  = obj_list.selectedIndex;
 var obj_lab  = document.form_edit.elements["def_" + v_str_mod + "_js_label"];
 if ("BINARIO" != str_type)
 {
  var obj_val = document.form_edit.elements["def_" + v_str_mod + "_js_valor"];
 }
 if ("POSICAO" == str_type || str_type == "SIMPLES")
 {
  var obj_des = document.form_edit.elements["def_" + v_str_mod + "_js_desl"];
  var obj_ini = document.form_edit.elements["def_" + v_str_mod + "_js_ini"];
  var obj_tam = document.form_edit.elements["def_" + v_str_mod + "_js_tam"];
 }
 var bol_def = false;
 if (document.form_edit.elements["def_" + v_str_mod + "_js_def"])
 {
  bol_def     = true;
  var obj_def = document.form_edit.elements["def_" + v_str_mod + "_js_def"];
 }
 if (-1 != int_sel)
 {
  obj_list.options[int_sel] = null;
  obj_lab.value             = "";
  if ("BINARIO" != str_type)
  {
   obj_val.value = "";
  }
  if ("POSICAO" == str_type || str_type == "SIMPLES")
  {
   if(obj_des) obj_des.value = "";
   if(obj_ini) obj_ini.value = "";
   if(obj_tam) obj_tam.value = "";
  }
  if (bol_def)
  {
   obj_def[1].checked = true;
  }
 }
}

/**
 * Exibe um item.
 *
 * Exibe os dados do elemento selecionado na lista de itens do lookup.
 *
 * @access  public
 * @param   string  v_str_mod    Modulo do lookup.
 * @param   string  v_str_delim  Delimitador dos dados do item.
 */
function nm_lkp_display(v_str_mod, v_str_delim)
{
 var obj_type = document.form_edit.elements["def_" + v_str_mod + "_type"];
 var str_type = obj_type.options[obj_type.selectedIndex].value;
 var obj_list = document.form_edit.elements["def_" + v_str_mod + "_js_list"];
 var int_sel  = obj_list.selectedIndex;
 var obj_lab  = document.form_edit.elements["def_" + v_str_mod + "_js_label"];
 if ("BINARIO" != str_type)
 {
  var obj_val = document.form_edit.elements["def_" + v_str_mod + "_js_valor"];
 }
 if ("POSICAO" == str_type || str_type == "SIMPLES")
 {
  var obj_des = document.form_edit.elements["def_" + v_str_mod + "_js_desl"];
  var obj_ini = document.form_edit.elements["def_" + v_str_mod + "_js_ini"];
  var obj_tam = document.form_edit.elements["def_" + v_str_mod + "_js_tam"];
 }
 var bol_def = false;
 if (document.form_edit.elements["def_" + v_str_mod + "_js_def"])
 {
  bol_def     = true;
  var obj_def = document.form_edit.elements["def_" + v_str_mod + "_js_def"];
 }
 if (-1 != int_sel)
 {
  var arr_data  = obj_list.options[int_sel].value.split(v_str_delim);
  obj_lab.value = arr_data[fLabel];
  if ("BINARIO" != str_type)
  {
   obj_val.value = arr_data[fValue];
  }
  if ("POSICAO" == str_type || str_type == "SIMPLES")
  {
   if(obj_des) obj_des.value = arr_data[fNegat];
   if (-1 == arr_data[fLocal].indexOf(","))
   {
    if(obj_ini) obj_ini.value = "";
    if(obj_tam) obj_tam.value = "";
   }
   else
   {
    arr_local     = arr_data[fLocal].split(",");
    if(obj_ini) obj_ini.value = arr_local[0];
    if(obj_tam) obj_tam.value = arr_local[1];
   }
  }
  if (bol_def)
  {
   if ("S" == arr_data[fSelect])
   {
    obj_def[0].checked = true;
   }
   else
   {
    obj_def[1].checked = true;
   }
  }
 }
}

/**
 * Insere um item.
 *
 * Insere os dados do elemento selecionado na lista de itens do lookup.
 *
 * @access  public
 * @param   string  v_str_mod    Modulo do lookup.
 * @param   string  v_str_delim  Delimitador dos dados do item.
 */
function nm_lkp_insert(v_str_mod, v_str_delim)
{
 var obj_type = document.form_edit.elements["def_" + v_str_mod + "_type"];
 var str_type = obj_type.options[obj_type.selectedIndex].value;
 var obj_list = document.form_edit.elements["def_" + v_str_mod + "_js_list"];
 var int_pos  = obj_list.length;
 var obj_lab  = document.form_edit.elements["def_" + v_str_mod + "_js_label"];
 if ("BINARIO" != str_type)
 {
  var obj_val = document.form_edit.elements["def_" + v_str_mod + "_js_valor"];
 }
 if ("POSICAO" == str_type || str_type == "SIMPLES")
 {
  var obj_des = document.form_edit.elements["def_" + v_str_mod + "_js_desl"];
  var obj_ini = document.form_edit.elements["def_" + v_str_mod + "_js_ini"];
  var obj_tam = document.form_edit.elements["def_" + v_str_mod + "_js_tam"];
 }
 var bol_def = false;
 if (document.form_edit.elements["def_" + v_str_mod + "_js_def"])
 {
  bol_def     = true;
  var obj_def = document.form_edit.elements["def_" + v_str_mod + "_js_def"];
 }
 str_txt = obj_lab.value;
 str_val = obj_lab.value + v_str_delim;
 if ("BINARIO" != str_type)
 {
  str_txt += " (" + obj_val.value + ")";
  str_val += obj_val.value;
 }
 str_val += v_str_delim;
 if ("POSICAO" == str_type || str_type == "SIMPLES" )
 {
  if(obj_des) str_val += obj_des.value;
 }
 str_val += v_str_delim;
 if (bol_def)
 {
  str_val += (obj_def[0].checked) ? "S" : "N";
 }
 str_val += v_str_delim;
 if ("POSICAO" == str_type)
 {
  str_val += obj_ini.value + "," + obj_tam.value;
 }
 obj_list.options[int_pos] = new Option(str_txt, str_val);
 obj_lab.value             = "";
 if ("BINARIO" != str_type)
 {
  obj_val.value = "";
 }
 if ("POSICAO" == str_type || str_type == "SIMPLES")
 {
  if(obj_des) obj_des.value = "";
  if(obj_ini) obj_ini.value = "";
  if(obj_tam) obj_tam.value = "";
 }
 if (bol_def)
 {
  obj_def[1].checked = true;
 }
 obj_list.selectedIndex = -1;
}

/**
 * Prepara dados do lookup.
 *
 * Agrupa os dados do lookup em um campo para envio do formulario.
 *
 * @access  public
 * @param   string  v_str_mod    Modulo do lookup.
 * @param   string  v_str_delim  Delimitador dos itens do lookup.
 */
function nm_lkp_pack(v_str_mod, v_str_delim)
{
 if (document.form_edit.elements["def_" + v_str_mod + "_type"])
 {
  str_nome = "def_" + v_str_mod + "_type";
  var obj_type   = document.form_edit.elements[str_nome];
  var str_type   = obj_type.options[obj_type.selectedIndex].value;
  var obj_list   = document.form_edit.elements["def_" + v_str_mod + "_js_list"];
  var obj_pack   = document.form_edit.elements["def_" + v_str_mod + "_js_pack"];
  obj_pack.value = "";
  for (i = 0; i < obj_list.length; i++)
  {
   if ("" != obj_pack.value)
   {
    obj_pack.value += v_str_delim;
   }
   obj_pack.value += obj_list.options[i].value;
  }
 }
}

/**
 * Atualiza um item.
 *
 * Atualiza os dados do elemento selecionado na lista de itens do lookup.
 *
 * @access  public
 * @param   string  v_str_mod    Modulo do lookup.
 * @param   string  v_str_delim  Delimitador dos dados do item.
 */
function nm_lkp_update(v_str_mod, v_str_delim)
{
 var obj_type = document.form_edit.elements["def_" + v_str_mod + "_type"];
 var str_type = obj_type.options[obj_type.selectedIndex].value;
 var obj_list = document.form_edit.elements["def_" + v_str_mod + "_js_list"];
 var int_sel  = obj_list.selectedIndex;
 var obj_lab  = document.form_edit.elements["def_" + v_str_mod + "_js_label"];
 if ("BINARIO" != str_type)
 {
  var obj_val = document.form_edit.elements["def_" + v_str_mod + "_js_valor"];
 }
 if ("POSICAO" == str_type || str_type == "SIMPLES")
 {
  var obj_des = document.form_edit.elements["def_" + v_str_mod + "_js_desl"];
  var obj_ini = document.form_edit.elements["def_" + v_str_mod + "_js_ini"];
  var obj_tam = document.form_edit.elements["def_" + v_str_mod + "_js_tam"];
 }
 var bol_def = false;
 if (document.form_edit.elements["def_" + v_str_mod + "_js_def"])
 {
  bol_def     = true;
  var obj_def = document.form_edit.elements["def_" + v_str_mod + "_js_def"];
 }
 if (-1 != int_sel)
 {
  str_txt = obj_lab.value;
  str_val = obj_lab.value + v_str_delim;
  if ("BINARIO" != str_type)
  {
   str_txt += " (" + obj_val.value + ")";
   str_val += obj_val.value;
  }
  str_val += v_str_delim;
  if ("POSICAO" == str_type || str_type == "SIMPLES")
  {
   if(obj_des) str_val += obj_des.value;
  }
  str_val += v_str_delim;
  if (bol_def)
  {
   str_val += (obj_def[0].checked) ? "S" : "N";
  }
  str_val += v_str_delim;
  if ("POSICAO" == str_type)
  {
   str_val += obj_ini.value + "," + obj_tam.value;
  }
  obj_list.options[int_sel].text  = str_txt;
  obj_list.options[int_sel].value = str_val;
  obj_lab.value                   = "";
  if ("BINARIO" != str_type)
  {
   obj_val.value = "";
  }
  if ("POSICAO" == str_type || str_type == "SIMPLES")
  {
   if(obj_des) obj_des.value = "";
   if(obj_ini) obj_ini.value = "";
   if(obj_tam) obj_tam.value = "";
  }
  if (bol_def)
  {
   obj_def[1].checked = true;
  }
  obj_list.selectedIndex = -1;
 }
}
