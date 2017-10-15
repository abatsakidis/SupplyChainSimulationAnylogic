/**
 * Selecao de campos.
 *
 * Rotinas de controle de selecao de itens em combobox.
 *
 * @package     Biblioteca
 * @subpackage  Javascript
 * @creation    2003/12/04
 * @copyright   NetMake Solucoes em Informatica
 * @author      Luis Humberto Roman <romanlh@netmake.com.br>
 *
 * $Id: select.js,v 1.1.1.1 2011-05-12 20:31:10 diogo Exp $
 */

/**
 * Exibe o filtro.
 *
 * Exibe os dados do filtro para um campo.
 *
 * @access  public
 * @param   string  v_str_form   Formulario do combobox.
 * @param   string  v_str_field  Campo do combobox.
 * @param   string  v_str_data   Campo do filtro.
 * @param   object  v_obj_str    Objeto com as strings do filtro.
 */
function nm_filter_display(v_str_form, v_str_field, v_str_data, v_obj_str)
{
 selchar = (nm_is_firefox() || nm_is_chrome()) ? "." : " ";
 obj_sel = document.forms[v_str_form].elements[v_str_field];
 obj_flt = document.forms[v_str_form].elements[v_str_data];
 int_sel = obj_sel.selectedIndex;
 
 str_filter = "";
 if($('#'+v_str_field) && $('#'+v_str_field+' option:selected').attr('str_filter') && $('#'+v_str_field+' option:selected').attr('str_filter') != '')
 {
	//espaco para evitar indice 0 em indexOf
	str_filter = " " + $('#'+v_str_field+' option:selected').attr('str_filter');
 }
 
 if (-1 != int_sel)
 {
  arr_fld = obj_sel.options[int_sel].value.split("_#flt#_");
  arr_dat = arr_fld[1].split(";");
  for (i = 0; i < arr_dat.length; i++)
  {
   arr_opc                  = arr_dat[i].split(",");
   str_mark                 = ("N" == arr_opc[1]) ? selchar : "*";
   obj_flt.options[i].text  = str_mark + v_obj_str[arr_opc[0]];
   obj_flt.options[i].value = str_mark + arr_opc[0];
   
   if(str_filter != '' && str_filter.indexOf(arr_opc[0]) > 0)
   {
	$('#' + v_str_data + ' option[value="'+ str_mark + arr_opc[0] +'"]').hide();
   }
   else
   {
	$('#' + v_str_data + ' option[value="'+ str_mark + arr_opc[0] +'"]').show();
   }
  }
  
  obj_flt.selectedIndex = -1
 }
} // nm_filter_display

/**
 * Reseta o filtro.
 *
 * Reseta os dados do filtro de um campo.
 *
 * @access  public
 * @param   object   v_obj_sel  Objeto do campo.
 * @param   integer  v_int_pos  Posicao do item.
 */
function nm_filter_reset(v_obj_sel, v_int_pos)
{
 arr_fld = v_obj_sel.options[v_int_pos].value.split("_#flt#_");
 str_flt = ("*" == arr_fld[0].substr(0, 1))
         ? "eq,S;ii,S;qp,S;df,S;np,N;gt,N;ge,N;lt,N;le,N;bw,N;in,N"
         : "eq,N;ii,N;qp,N;df,N;np,N;gt,N;ge,N;lt,N;le,N;bw,N;in,N";
 v_obj_sel.options[v_int_pos].value = arr_fld[0] + "_#flt#_" + str_flt;
} // nm_filter_reset

/**
 * Reseta todos os itens.
 *
 * Reseta o valor do filtro de todos os campos.
 *
 * @access  public
 * @param   string  v_str_form   Formulario do combobox.
 * @param   string  v_str_field  Campo do combobox.
 * @param   string  v_str_data   Campo do filtro.
 * @param   object  v_obj_str    Objeto com as strings do filtro.
 */
function nm_filter_reset_all(v_str_form, v_str_field, v_str_data, v_obj_str)
{
 obj_fld = document.forms[v_str_form].elements[v_str_field];
 for (i = 0; i < obj_fld.length; i++)
 {
  nm_filter_reset(obj_fld, i);
  if (obj_fld.options[i].selected)
  {
   nm_filter_display(v_str_form, v_str_field, v_str_data, v_obj_str);
  }
 }
} // nm_filter_reset_all

/**
 * Reseta um item.
 *
 * Reseta o valor do filtro de um campo.
 *
 * @access  public
 * @param   string  v_str_form   Formulario do combobox.
 * @param   string  v_str_field  Campo do combobox.
 * @param   string  v_str_data   Campo do filtro.
 * @param   object  v_obj_str    Objeto com as strings do filtro.
 */
function nm_filter_reset_item(v_str_form, v_str_field, v_str_data, v_obj_str)
{
 obj_fld = document.forms[v_str_form].elements[v_str_field];
 int_pos = obj_sel.selectedIndex;
 if (-1 != int_pos)
 {
  nm_filter_reset(obj_fld, int_pos);
  nm_filter_display(v_str_form, v_str_field, v_str_data, v_obj_str);
 }
} // nm_filter_reset_item

/**
 * Atualiza o filtro.
 *
 * Atualiza os dados do filtro para um campo.
 *
 * @access  public
 * @param   string   v_str_form   Formulario do combobox.
 * @param   string   v_str_field  Campo do combobox.
 * @param   string   v_str_data   Campo do filtro.
 * @param   boolean  v_bol_check  Flag para checar item atual.
 * @param   string   v_str_cback  Funcao callback.
 */
function nm_filter_select(v_str_form, v_str_field, v_str_data, v_bol_check, v_str_cback)
{
 obj_sel = document.forms[v_str_form].elements[v_str_field];
 int_sel = obj_sel.selectedIndex;
 if (-1 != int_sel && "*" != obj_sel.options[int_sel].value.substr(0, 1))
 {
  if (v_bol_check)
  {
   obj_flt = document.forms[v_str_form].elements[v_str_data];
   int_flt = obj_flt.selectedIndex;
   bol_on  = "*" == obj_flt.options[int_flt].value.substr(0, 1);
  }
  else
  {
   bol_on = true;
  }
  if (bol_on)
  {
   str_text  = "*" + obj_sel.options[int_sel].text.substr(1);
   str_value = "*" + obj_sel.options[int_sel].value.substr(1);
   obj_sel.options[int_sel].text  = str_text;
   obj_sel.options[int_sel].value = str_value;
   if (null != v_str_cback)
   {
    v_str_cback();
   }
  }
 }
} // nm_filter_update

/**
 * Atualiza o filtro.
 *
 * Atualiza os dados do filtro para um campo.
 *
 * @access  public
 * @param   string  v_str_form   Formulario do combobox.
 * @param   string  v_str_field  Campo do combobox.
 * @param   string  v_str_data   Campo do filtro.
 * @param   string  v_str_cback  Funcao callback.
 */
function nm_filter_update(v_str_form, v_str_field, v_str_data, v_str_cback)
{
 obj_sel = document.forms[v_str_form].elements[v_str_field];
 obj_flt = document.forms[v_str_form].elements[v_str_data];
 int_sel = obj_sel.selectedIndex;
 if (-1 != int_sel)
 {
  str_data = "";
  for (i = 0; i < obj_flt.length; i++)
  {
   if ("" != str_data)
   {
    str_data += ";";
   }
   str_data += obj_flt.options[i].value.substr(1) + ",";
   str_data += ("*" == obj_flt.options[i].value.substr(0, 1)) ? "S" : "N";
  }
  arr_fld = obj_sel.options[int_sel].value.split("_#flt#_");
  obj_sel.options[int_sel].value = arr_fld[0] + "_#flt#_" + str_data;
  if (null != v_str_cback)
  {
   v_str_cback();
  }
 }
} // nm_filter_update

/**
 * Seleciona todos os itens.
 *
 * Marca todos os itens do combobox como selecionados.
 *
 * @access  public
 * @param   string  v_str_form   Formulario do combobox.
 * @param   string  v_str_field  Campo do combobox.
 * @param   string  v_str_cback  Funcao callback.
 */
function nm_select_all(v_str_form, v_str_field, v_str_cback)
{
 obj_sel = document.forms[v_str_form].elements[v_str_field];
 for (i = 0; i < obj_sel.length; i++)
 {
  nm_select_change(obj_sel, i, "*");
 }
 if ((0 < obj_sel.length) && (null != v_str_cback))
 {
  v_str_cback();
 }
} // nm_select_all

/**
 * Muda status de um item.
 *
 * Muda o status de selecao de um item do combobox.
 *
 * @access  public
 * @param   object   v_obj_sel   Objeto do combobox.
 * @param   integer  v_int_pos   Posicao do item no combobox.
 * @param   string   v_str_stat  Nova situacao do item.
 */
function nm_select_change(v_obj_sel, v_int_pos, v_str_stat)
{
 bol_sel = v_obj_sel.options[v_int_pos].selected;
 v_obj_sel.options[v_int_pos].text  = v_str_stat
    + v_obj_sel.options[v_int_pos].text.substr(1);
 v_obj_sel.options[v_int_pos].value = v_str_stat
    + v_obj_sel.options[v_int_pos].value.substr(1);
 v_obj_sel.options[v_int_pos].selected = bol_sel;
}  // nm_select_change

/**
 * Seleciona um item.
 *
 * Marca um item do combobox como selecionado.
 *
 * @access  public
 * @param   string  v_str_form   Formulario do combobox.
 * @param   string  v_str_field  Campo do combobox.
 * @param   string  v_str_cback  Funcao callback.
 */
function nm_select_item(v_str_form, v_str_field, v_str_cback)
{
 selchar = (nm_is_firefox() || nm_is_chrome()) ? "." : " ";		
	
 bol_mod = false;
 obj_sel = document.forms[v_str_form].elements[v_str_field];
 for (i = 0; i < obj_sel.length; i++)
 {
  if ((null != obj_sel.options[i]) && obj_sel.options[i].selected)
  {
   bol_mod  = true;
   str_stat = ("*" == obj_sel.options[i].text.substr(0, 1)) ? selchar : "*";
   nm_select_change(obj_sel, i, str_stat);
  }
 }
 if (bol_mod && (null != v_str_cback))
 {
  v_str_cback();
 }
} // nm_select_item

/**
 * De-seleciona todos os itens.
 *
 * Marca todos os itens do combobox como nao selecionados.
 *
 * @access  public
 * @param   string  v_str_form   Formulario do combobox.
 * @param   string  v_str_field  Campo do combobox.
 * @param   string  v_str_cback  Funcao callback.
 */
function nm_select_none(v_str_form, v_str_field, v_str_cback)
{
 selchar = (nm_is_firefox() || nm_is_chrome()) ? "." : " ";
 obj_sel = document.forms[v_str_form].elements[v_str_field];
 for (i = 0; i < obj_sel.length; i++)
 {
  nm_select_change(obj_sel, i, selchar);
 }
 if ((0 < obj_sel.length) && (null != v_str_cback))
 {
  v_str_cback();
 }
} // nm_select_none

/**
 * Prepara os itens.
 *
 * Prepara os itens para envio do formulario.
 *
 * @access  public
 * @param   string  v_str_form  Formulario do combobox.
 * @param   string  v_str_orig  Campo do combobox.
 * @param   string  v_str_dest  Campo para armazenar o valor dos itens.
 * @param   string  v_str_sep   Separador de valores de itens.
 */
function nm_select_prepare(v_str_form, v_str_orig, v_str_dest, v_str_sep)
{
 obj_sel = document.forms[v_str_form].elements[v_str_orig];
 str_val = "";
 for (i = 0; i < obj_sel.length; i++)
 {
  if ("" != str_val)
  {
   str_val += v_str_sep;
  }
  str_val += obj_sel.options[i].value;
 }
 document.forms[v_str_form].elements[v_str_dest].value = str_val;
} // nm_select_prepare

/**
 * Atualiza dados do grafico.
 *
 * Atualiza os dados de criacao de grafico para o campo selecionado.
 *
 * @access  public
 * @param   string  v_str_form   Formulario do combobox.
 * @param   string  v_str_field  Campo do combobox.
 * @param   string  v_str_graph  Dados do grafico.
 * @param   string  v_str_cback  Funcao callback.
 */
function nm_sum_chart(v_str_form, v_str_field, v_str_graph, v_str_cback)
{
 obj_sel  = document.forms[v_str_form].elements[v_str_field];
 obj_grph = document.forms[v_str_form].elements[v_str_graph];
 int_sel  = obj_sel.selectedIndex;
 if (-1 != int_sel)
 {
  str_graph = (obj_grph[0].checked) ? "S" : "N";
  if (str_graph != obj_sel.options[int_sel].value.substr(1, 1))
  {
   obj_sel.options[int_sel].value = obj_sel.options[int_sel].value.substr(0, 1)
                                  + str_graph
                                  + obj_sel.options[int_sel].value.substr(2);
   if (null != v_str_cback)
   {
    v_str_cback();
   }
  }
 }
} // nm_sum_chart

/**
 * Seleciona sumarizacao.
 *
 * Define o metodo de sumarizacao do campo.
 *
 * @access  public
 * @param   string  v_str_form   Formulario do combobox.
 * @param   string  v_str_field  Campo do combobox.
 * @param   string  v_str_func   Funcao de sumarizacao.
 * @param   string  v_str_graph  Dados do grafico.
 * @param   string  v_str_cback  Funcao callback.
 */
function nm_sum_function(v_str_form, v_str_field, v_str_func, v_str_graph,
                         v_str_cback)
{
 selchar  = (nm_is_firefox() || nm_is_chrome()) ? "." : " ";
 obj_sel  = document.forms[v_str_form].elements[v_str_field];
 obj_grph = document.forms[v_str_form].elements[v_str_graph];
 int_sel  = obj_sel.selectedIndex;
 if (-1 != int_sel)
 {
  str_func = obj_sel.options[int_sel].value.substr(0, 1);
  if (v_str_func != str_func)
  {
   if ("N" == v_str_func)
   {
    str_graph           = "N";
    str_text            = selchar;
    obj_grph[1].checked = true;
   }
   else if ("N" == str_func)
   {
    str_graph           = "S";
    str_text            = v_str_func;
    obj_grph[0].checked = true;
   }
   else
   {
    str_graph = obj_sel.options[int_sel].value.substr(1, 1);
    str_text  = v_str_func;
   }
   obj_sel.options[int_sel].text  = str_text + selchar
       + obj_sel.options[int_sel].text.substr(2);
   obj_sel.options[int_sel].value = v_str_func + str_graph
       + obj_sel.options[int_sel].value.substr(2);
   if (null != v_str_cback)
   {
    v_str_cback();
   }
  }
 }
} // nm_sum_function

/**
 * Atualiza visualizacao.
 *
 * Atualiza campo de criacao de grafico para o campo selecionado.
 *
 * @access  public
 * @param   string  v_str_form   Formulario do combobox.
 * @param   string  v_str_field  Campo do combobox.
 * @param   string  v_str_graph  Dados do grafico.
 */
function nm_sum_update(v_str_form, v_str_field, v_str_graph)
{
 obj_sel  = document.forms[v_str_form].elements[v_str_field];
 obj_grph = document.forms[v_str_form].elements[v_str_graph];
 int_sel  = obj_sel.selectedIndex;
 if (-1 != int_sel)
 {
  str_graph = obj_sel.options[int_sel].value.substr(1, 1);
  if ("S" == str_graph)
  {
   obj_grph[0].checked = true;
  }
  else
  {
   obj_grph[1].checked = true;
  }
 }
} // nm_sum_onclick

/**
 * limpa select
 *
 * apaga todos os options de um select
 *
 * @access  public
 * @param   object  objeto  Objeto Combobox
 */
function nm_clear_select(objeto)
{ 
	for (var i=(objeto.options.length-1); i>=0; i--) 
	{ 
		objeto.options[i] = null; 
	} 
	objeto.selectedIndex = -1; 
}

function nm_add_option(objeto,text,value,selected)
{
	if(text!="")
	{
		if (objeto!=null && objeto.options!=null)
		{
			objeto.options[objeto.options.length] = new Option(text, value, false, selected);
		}
	}
}
function nm_rem_option(objeto)
{
	var selIndex = objeto.selectedIndex;
	if (selIndex != -1) {
		for(i=objeto.length-1; i>=0; i--)
		{
			if(objeto.options[i].selected)
			{
				objeto.options[i] = null;
			}
		}
		if (objeto.length > 0) {
			objeto.selectedIndex = selIndex == 0 ? 0 : selIndex - 1;
		}
	}
}

function nm_is_firefox()
{
	nav = navigator.userAgent.toLowerCase();
	return  nav.indexOf('firefox') > 0;
}

function nm_is_chrome()
{
	nav = navigator.userAgent.toLowerCase();
	return  nav.indexOf('chrome') > 0;
}
