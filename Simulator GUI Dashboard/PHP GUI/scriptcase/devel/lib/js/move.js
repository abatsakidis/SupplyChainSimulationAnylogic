/**
 * Movimentacao de campos.
 *
 * Rotinas de controle de movimentacao de itens em combobox.
 *
 * @package     Biblioteca
 * @subpackage  Javascript
 * @creation    2003/12/04
 * @copyright   NetMake Solucoes em Informatica
 * @author      Luis Humberto Roman <romanlh@netmake.com.br>
 *
 * $Id: move.js,v 1.3 2011-06-15 19:09:10 diogo Exp $
 */

var nmFldLabel = 0;
var nmFldLink  = 1;
var nmFldDef   = 2;
var nmFldIcon  = 3;

/**
 * Move um item para baixo.
 *
 * Realiza a movimentacao para baixo de um item do combobox.
 *
 * @access  public
 * @param   string  v_str_form   Formulario do combobox.
 * @param   string  v_str_field  Campo do combobox.
 * @param   string  v_str_cback  Funcao callback.
 */
function nm_field_move_down(v_str_form, v_str_field, v_str_cback)
{
 bol_mod = false;
 obj_sel = document.forms[v_str_form].elements[v_str_field];
 nm_field_release_blocks(obj_sel);
 if (1 < obj_sel.length)
 {
  for (i = (obj_sel.length - 2); i >= 0; i--)
  {
   if ((null != obj_sel.options[i]) && obj_sel.options[i].selected &&
       !obj_sel.options[i + 1].selected &&
       ("__blc__" != obj_sel.options[i].value.substr(0, 7)))
   {
    bol_mod                                   = true;
    bol_sel                                   = obj_sel.options[i + 1].selected;
    str_txt                                   = obj_sel.options[i].text;
    str_val                                   = obj_sel.options[i].value;
    str_color                                 = obj_sel.options[i].style.color;
    str_bgcolor                               = obj_sel.options[i].style.backgroundColor;
    obj_sel.options[i].text                   = obj_sel.options[i + 1].text;
    obj_sel.options[i].value                  = obj_sel.options[i + 1].value;
    obj_sel.options[i].style.color            = obj_sel.options[i + 1].style.color;
    obj_sel.options[i].style.backgroundColor  = obj_sel.options[i + 1].style.backgroundColor;
    obj_sel.options[i + 1].text                  = str_txt;
    obj_sel.options[i + 1].value                 = str_val;
    obj_sel.options[i + 1].style.color           = str_color;
    obj_sel.options[i + 1].style.backgroundColor = str_bgcolor;
    obj_sel.options[i].selected     = bol_sel;
    obj_sel.options[i + 1].selected = true;
   }
  }
 }
 if (bol_mod && (null != v_str_cback))
 {
  v_str_cback();
 }
} // nm_field_move_down

/**
 * Move um item para baixo.
 *
 * Realiza a movimentacao para baixo de um item do combobox.
 *
 * @access  public
 * @param   string  v_str_form   Formulario do combobox.
 * @param   string  v_str_field  Campo do combobox.
 * @param   string  v_str_cback  Funcao callback.
 */
function nm_field_move_down2(v_str_form, v_str_field, v_str_cback)
{
 bol_mod = false;
 obj_sel = document.forms[v_str_form].elements[v_str_field];
 if (1 < obj_sel.length && obj_sel.selectedIndex >= 0)
 {
  for (i = (obj_sel.length - 2); i >= 0; i--)
  {
   if ((null != obj_sel.options[i]) && obj_sel.options[i].selected &&
       !obj_sel.options[i + 1].selected)
   {
    bol_mod                                   = true;
    bol_sel                                   = obj_sel.options[i + 1].selected;
    str_txt                                   = obj_sel.options[i].text;
    str_val                                   = obj_sel.options[i].value;
    str_color                                 = obj_sel.options[i].style.color;
    str_bgcolor                               = obj_sel.options[i].style.backgroundColor;
    obj_sel.options[i].text                   = obj_sel.options[i + 1].text;
    obj_sel.options[i].value                  = obj_sel.options[i + 1].value;
    obj_sel.options[i].style.color            = obj_sel.options[i + 1].style.color;
    obj_sel.options[i].style.backgroundColor  = obj_sel.options[i + 1].style.backgroundColor;
    obj_sel.options[i + 1].text                  = str_txt;
    obj_sel.options[i + 1].value                 = str_val;
    obj_sel.options[i + 1].style.color           = str_color;
    obj_sel.options[i + 1].style.backgroundColor = str_bgcolor;
    obj_sel.options[i].selected     = bol_sel;
    obj_sel.options[i + 1].selected = true;
   }
  }
 }
 if (bol_mod && (null != v_str_cback))
 {
  v_str_cback();
 }
} // nm_field_move_down2

/**
 * Remove um campo.
 *
 * Remove um campo na lista de blocos.
 *
 * @access  public
 * @param   object   v_obj_fld  Campos da aplicacao.
 * @param   integer  v_int_seq  Sequencial do campo.
 */
function nm_field_move_left(v_obj_fld, v_int_seq)
{
 for (j = 0; j < v_obj_fld.length; j++)
 {
  if (v_int_seq == v_obj_fld.options[j].value)
  {
   v_obj_fld.options[j].disabled    = false;
   v_obj_fld.options[j].style.color = "";
  }
 }
} // nm_field_move_left

/**
 * Move um campo.
 *
 * Adiciona um campo na lista de blocos.
 *
 * @access  public
 * @param   array   v_arr_sel    Itens selecionados.
 * @param   string  v_str_form   Formulario do combobox.
 * @param   string  v_str_block  Blocos da aplicacao.
 */
function nm_field_move_right(v_arr_sel, v_str_form, v_str_block)
{
 obj_blc = document.forms[v_str_form].elements[v_str_block];
 int_blc = obj_blc.selectedIndex;
 arr_mov = new Array();
 int_mov = 0;
 if (-1 == int_blc)
 {
  int_blc = obj_blc.length;
 }
 else
 {
  int_blc++;
  int_len = obj_blc.length;
  for (i = int_blc; i < int_len; i++)
  {
   if(obj_blc.options[i].value != "")
   {
	arr_mov[int_mov] = new Array(obj_blc.options[i].text,
								 obj_blc.options[i].value, 
                                 obj_blc.options[i].style.color,
                                 obj_blc.options[i].style.backgroundColor
								 );
	}
   int_mov++;
  }
 }
 int_mov = int_blc;

 for (i = 0; i < v_arr_sel.length; i++)
 {
  if(v_arr_sel[i] && v_arr_sel[i][0] != '')
  {
      int_mov = int_blc + i;
	  if (null == obj_blc.options[int_mov])
	  {
	   obj_blc.options[int_mov] = new Option();
	  }
	  obj_blc.options[int_mov].innerHTML  = "&nbsp;&nbsp;&nbsp;" + v_arr_sel[i][1];
	  obj_blc.options[int_mov].value = v_arr_sel[i][0] + "_#fld#_" + v_arr_sel[i][1];
	  obj_blc.options[int_mov].style.color = v_arr_sel[i][2];
	  obj_blc.options[int_mov].style.backgroundColor = v_arr_sel[i][3];
  }
 }

 for (i = 0; i < arr_mov.length; i++)
 {
  if(arr_mov[i] && arr_mov[i][1]!= '')
  {
      int_mov++;
	  if (null == obj_blc.options[int_mov])
	  {
	   obj_blc.options[int_mov] = new Option();
	  }
	  obj_blc.options[int_mov].text  = arr_mov[i][0];
	  obj_blc.options[int_mov].value = arr_mov[i][1];
	  obj_blc.options[int_mov].style.color = arr_mov[i][2];
	  obj_blc.options[int_mov].style.backgroundColor = arr_mov[i][3];
	 }
 }
} // nm_field_move_right

/**
 * Move um campo.
 *
 * Adiciona um campo na lista de blocos, que agora tbm tem nivel de pagina
 *
 * @access  public
 * @param   array   v_arr_sel    Itens selecionados.
 * @param   string  v_str_form   Formulario do combobox.
 * @param   string  v_str_block  Blocos da aplicacao.
 */
function nm_field_move_right2(v_arr_sel, v_str_form, v_str_block)
{
 obj_blc = document.forms[v_str_form].elements[v_str_block];
 int_blc = obj_blc.selectedIndex;
 arr_mov = new Array();
 int_mov = 0;
 if (-1 == int_blc)
 {
  int_blc = obj_blc.length;
 }
 else
 {
  int_blc++;
  int_len = obj_blc.length;
  for (i = int_blc; i < int_len; i++)
  {
   if(obj_blc.options[i].value != "")
   {
	arr_mov[int_mov] = new Array(obj_blc.options[i].text,
								 obj_blc.options[i].value, 
                                 obj_blc.options[i].style.color,
                                 obj_blc.options[i].style.backgroundColor
								 );
	}
   int_mov++;
  }
 }
 int_mov = int_blc;

 for (i = 0; i < v_arr_sel.length; i++)
 {
  if(v_arr_sel[i] && v_arr_sel[i][0] != '')
  {
      int_mov = int_blc + i;
	  if (null == obj_blc.options[int_mov])
	  {
	   obj_blc.options[int_mov] = new Option();
	  }
	  
	  obj_blc.options[int_mov].innerHTML             = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" + v_arr_sel[i][1];
	  obj_blc.options[int_mov].value                 = v_arr_sel[i][0] + "_#fld#_" + v_arr_sel[i][1];
	  obj_blc.options[int_mov].style.color           = v_arr_sel[i][2];
	  obj_blc.options[int_mov].style.backgroundColor = v_arr_sel[i][3];
  }
 }

 for (i = 0; i < arr_mov.length; i++)
 {
  if(arr_mov[i] && arr_mov[i][1]!= '')
  {
      int_mov++;
	  if (null == obj_blc.options[int_mov])
	  {
	   obj_blc.options[int_mov] = new Option();
	  }
	  obj_blc.options[int_mov].text                  = arr_mov[i][0];
	  obj_blc.options[int_mov].value                 = arr_mov[i][1];
	  obj_blc.options[int_mov].style.color           = arr_mov[i][2];
	  obj_blc.options[int_mov].style.backgroundColor = arr_mov[i][3];
	 }
 }
} // nm_field_move_right2
 
/**
 * Move um item para cima.
 *
 * Realiza a movimentacao para cima de um item do combobox.
 *
 * @access  public
 * @param   string   v_str_form   Formulario do combobox.
 * @param   string   v_str_field  Blocos da aplicacao.
 * @param   string   v_str_cback  Funcao callback.
 * @param   boolean  v_bol_first  Flag para movimentacao do primeiro item.
 */
function nm_field_move_up(v_str_form, v_str_field, v_str_cback, v_bol_first)
{
 if (null == v_bol_first)
 {
  v_bol_first = false;
 }
 v_int_bound = (v_bol_first) ? 1 : 2;
 bol_mod = false;
 obj_sel = document.forms[v_str_form].elements[v_str_field];
 nm_field_release_blocks(obj_sel);
 if (v_int_bound < obj_sel.length)
 {
  for (i = v_int_bound; i < obj_sel.length; i++)
  {
   if ((null != obj_sel.options[i]) && obj_sel.options[i].selected &&
       !obj_sel.options[i - 1].selected &&
       ("__blc__" != obj_sel.options[i].value.substr(0, 7)))
   {
    bol_mod                                   = true;
    bol_sel                                   = obj_sel.options[i - 1].selected;
    str_txt                                   = obj_sel.options[i].text;
    str_val                                   = obj_sel.options[i].value;
    str_color                                 = obj_sel.options[i].style.color;
    str_bgcolor                               = obj_sel.options[i].style.backgroundColor;
    obj_sel.options[i].text                   = obj_sel.options[i - 1].text;
    obj_sel.options[i].value                  = obj_sel.options[i - 1].value;
    obj_sel.options[i].style.color            = obj_sel.options[i - 1].style.color;
    obj_sel.options[i].style.backgroundColor  = obj_sel.options[i - 1].style.backgroundColor;
    obj_sel.options[i - 1].text                   = str_txt;
    obj_sel.options[i - 1].value                  = str_val;
    obj_sel.options[i - 1].style.color            = str_color;
    obj_sel.options[i - 1].style.backgroundColor  = str_bgcolor;
    obj_sel.options[i].selected     = bol_sel;
    obj_sel.options[i - 1].selected = true;
   }
  }
 }
 if (bol_mod && (null != v_str_cback))
 {
  v_str_cback();
 }
} // nm_field_move_up

/**
 * Move um item para cima.
 *
 * Realiza a movimentacao para cima de um item do combobox.
 *
 * @access  public
 * @param   string   v_str_form   Formulario do combobox.
 * @param   string   v_str_field  Blocos da aplicacao.
 * @param   string   v_str_cback  Funcao callback.
 * @param   boolean  v_bol_first  Flag para movimentacao do primeiro item.
 */
function nm_field_move_up2(v_str_form, v_str_field, v_str_cback, v_bol_first)
{
 if (null == v_bol_first)
 {
  v_bol_first = false;
 }
 
 bol_mod = false;
 obj_sel = document.forms[v_str_form].elements[v_str_field];
 
 v_int_bound = 1;
 if(obj_sel.selectedIndex >= 0)
 {
	//pagina pode ir pro topo, bloco nao pode ir pro topo, campo tem q ficar abaixo de bloco
	switch(obj_sel.options[obj_sel.selectedIndex].value.substr(0, 7))
	{
		case '__page_':
			v_int_bound = 1;
		break;
		case '__blc__':
			v_int_bound = 2;
		break;
		default:
			v_int_bound = 3;
		break;
	}	
 }
 
 if (v_int_bound < obj_sel.length && obj_sel.selectedIndex >= 0)
 {
  for (i = v_int_bound; i < obj_sel.length; i++)
  {
	keyOrigem = i;
	keyTarget = i - 1;
   if ((null != obj_sel.options[keyOrigem]) && obj_sel.options[keyOrigem].selected &&
       !obj_sel.options[keyTarget].selected)
   {
   
    bol_mod                         = true;
    bol_sel                         = obj_sel.options[keyTarget].selected;
    str_txt                         = obj_sel.options[keyOrigem].text;
    str_val                         = obj_sel.options[keyOrigem].value;
    str_color                       = obj_sel.options[keyOrigem].style.color;
    str_bgcolor                     = obj_sel.options[keyOrigem].style.backgroundColor;
    obj_sel.options[keyOrigem].text                   = obj_sel.options[keyTarget].text;
    obj_sel.options[keyOrigem].value                  = obj_sel.options[keyTarget].value;
    obj_sel.options[keyOrigem].style.color            = obj_sel.options[keyTarget].style.color;
    obj_sel.options[keyOrigem].style.backgroundColor  = obj_sel.options[keyTarget].style.backgroundColor;
    obj_sel.options[keyTarget].text                   = str_txt;
    obj_sel.options[keyTarget].value                  = str_val;
    obj_sel.options[keyTarget].style.color            = str_color;
    obj_sel.options[keyTarget].style.backgroundColor  = str_bgcolor;
    obj_sel.options[i].selected     = bol_sel;
    obj_sel.options[keyTarget].selected = true;
   }
  }
 }
 if (bol_mod && (null != v_str_cback))
 {
  v_str_cback();
 }
} // nm_field_move_up2

/**
 * Libera os blocos.
 *
 * Deseleciona os blocos da lista.
 *
 * @access  public
 * @param   object  v_obj_sel  Objeto da lista de blocos.
 */
function nm_field_release_blocks(v_obj_sel)
{
 for (i = 0; i < v_obj_sel.length; i++)
 {
  if ((null != v_obj_sel.options[i]) &&
      ("__blc__" == v_obj_sel.options[i].value.substr(0, 7)) &&
      (v_obj_sel.options[i].selected))
  {
   v_obj_sel.options[i].selected = false;
  }
 }
} // nm_field_release_blocks

/**
 * Remove um campo.
 *
 * Remove um campo da a caixa de blocos da aplicacao.
 *
 * @access  public
 * @param   string  v_str_form   Formulario do combobox.
 * @param   string  v_str_field  Campos da aplicacao.
 * @param   string  v_str_block  Blocos da aplicacao.
 * @param   string  v_str_cback  Funcao callback.
 */
function nm_field_remove(v_str_form, v_str_field, v_str_block, v_str_cback)
{
 bol_mod = false;
 obj_fld = document.forms[v_str_form].elements[v_str_field];
 obj_blc = document.forms[v_str_form].elements[v_str_block];
 for (i = (obj_blc.length - 1); i >= 0; i--)
 {
  if ((null != obj_blc.options[i]) && obj_blc.options[i].selected &&
      ("__blc__" != obj_blc.options[i].value.substr(0, 7) && "__page__" != obj_blc.options[i].value.substr(0, 8)))
  {
   bol_mod  = true;
      if(obj_blc.options[i].value.substr(0, 7) == '__SUB__')
      {
          obj_blc.options[i].value = obj_blc.options[i].value.substr(7);
      }
   arr_data = obj_blc.options[i].value.split("_#fld#_");
   nm_field_move_left(obj_fld, arr_data[0]);
   obj_blc.options[i] = null;
  }
  else
  {
   obj_blc.options[i].selected = false;
  }
 }
 if (bol_mod && (null != v_str_cback))
 {
  v_str_cback();
 }
} // nm_field_remove

/**
 * Remove todos os campos.
 *
 * Remove todos os campos da a caixa de blocos da aplicacao.
 *
 * @access  public
 * @param   string  v_str_form   Formulario do combobox.
 * @param   string  v_str_field  Campos da aplicacao.
 * @param   string  v_str_block  Blocos da aplicacao.
 * @param   string  v_str_cback  Funcao callback.
 */
function nm_field_remove_all(v_str_form, v_str_field, v_str_block, v_str_cback)
{
 bol_mod = false;
 obj_fld = document.forms[v_str_form].elements[v_str_field];
 obj_blc = document.forms[v_str_form].elements[v_str_block];
 for (i = (obj_blc.length - 1); i >= 0; i--)
 {
  if ((null != obj_blc.options[i]) &&
      ("__blc__" != obj_blc.options[i].value.substr(0, 7) && "__page__" != obj_blc.options[i].value.substr(0, 8)))
  {
   bol_mod  = true;
  if(obj_blc.options[i].value.substr(0, 7) == '__SUB__')
  {
      obj_blc.options[i].value = obj_blc.options[i].value.substr(7);
  }
   arr_data = obj_blc.options[i].value.split("_#fld#_");
   nm_field_move_left(obj_fld, arr_data[0]);
   obj_blc.options[i] = null;
  }
  else
  {
   obj_blc.options[i].selected = false;
  }
 }
 if (bol_mod && (null != v_str_cback))
 {
  v_str_cback();
 }
} // nm_field_remove_all

/**
 * Seleciona um campo.
 *
 * Seleciona um campo para a caixa de blocos da aplicacao.
 *
 * @access  public
 * @param   string  v_str_form   Formulario do combobox.
 * @param   string  v_str_field  Campos da aplicacao.
 * @param   string  v_str_block  Blocos da aplicacao.
 * @param   string  v_str_cback  Funcao callback.
 */
function nm_field_select(v_str_form, v_str_field, v_str_block, v_str_cback)
{
 bol_mod = false;
 obj_fld = document.forms[v_str_form].elements[v_str_field];
 arr_sel = new Array();
 int_cnt = 0;
 for (i = 0; i < obj_fld.length; i++)
 {
  if ((null != obj_fld.options[i]) && obj_fld.options[i].selected &&
      !obj_fld.options[i].disabled)
  {
   arr_sel[int_cnt] = new Array(obj_fld.options[i].value,
                                obj_fld.options[i].text, 
                                obj_fld.options[i].style.color,
								obj_fld.options[i].style.backgroundColor
								);
   if (obj_fld.options[i].value != 'sys_separator' && obj_fld.name != 'quebras_new_list')
   {                                
       obj_fld.options[i].disabled    = true;
       obj_fld.options[i].style.color = "#C0C0C0";
   }
   int_cnt++;
  }
  obj_fld.options[i].selected = false;
 }
 if (0 < arr_sel.length)
 {
  nm_field_move_right(arr_sel, v_str_form, v_str_block);
  bol_mod = true;
 }
 if (bol_mod && (null != v_str_cback))
 {
  v_str_cback();
 }
} // nm_field_select

/**
 * Seleciona um campo.
 *
 * Seleciona um campo para a caixa de blocos da aplicacao.
 *
 * @access  public
 * @param   string  v_str_form   Formulario do combobox.
 * @param   string  v_str_field  Campos da aplicacao.
 * @param   string  v_str_block  Blocos da aplicacao.
 * @param   string  v_str_cback  Funcao callback.
 */
function nm_field_select2(v_str_form, v_str_field, v_str_block, v_str_cback)
{
 bol_mod = false;
 obj_fld = document.forms[v_str_form].elements[v_str_field];
 arr_sel = new Array();
 int_cnt = 0;
 for (i = 0; i < obj_fld.length; i++)
 {
  if ((null != obj_fld.options[i]) && obj_fld.options[i].selected &&
      !obj_fld.options[i].disabled)
  {
   arr_sel[int_cnt] = new Array(obj_fld.options[i].value,
                                obj_fld.options[i].text, 
                                obj_fld.options[i].style.color,
                                obj_fld.options[i].style.backgroundColor
								);
   if (obj_fld.options[i].value != 'sys_separator' && obj_fld.name != 'quebras_new_list')
   {                                
       obj_fld.options[i].disabled    = true;
       obj_fld.options[i].style.color = "#C0C0C0";
   }
   int_cnt++;
  }
  obj_fld.options[i].selected = false;
 }
 if (0 < arr_sel.length)
 {
  nm_field_move_right2(arr_sel, v_str_form, v_str_block);
  bol_mod = true;
 }
 if (bol_mod && (null != v_str_cback))
 {
  v_str_cback();
 }
} // nm_field_select

/**
 * Seleciona todos os campos.
 *
 * Seleciona todos os campos para a caixa de blocos da aplicacao.
 * com um determinado filtro.
 *
 * @access  public
 * @param   string  v_str_form   Formulario do combobox.
 * @param   string  v_str_field  Campos da aplicacao.
 * @param   string  v_str_block  Blocos da aplicacao.
 * @param   string  v_str_cback  Funcao callback.
 */
function nm_field_select_all_filtro(v_str_form, v_str_field, v_str_block, v_str_cback, str_string, splitstring)
{
 bol_mod = false;
 obj_fld = document.forms[v_str_form].elements[v_str_field];
 arr_sel = new Array();
 int_cnt = 0;
 for (i = 0; i < obj_fld.length; i++)
 {
   if ((null != obj_fld.options[i]) && !obj_fld.options[i].disabled)
  {
   value = obj_fld.options[i].value;
   if(splitstring)
   {
     value = value.split(splitstring);
	 value = value[1];
   }
   if(str_string.indexOf(value) > 0)
   {
        arr_sel[int_cnt] = new Array(obj_fld.options[i].value,
								obj_fld.options[i].text, 
								obj_fld.options[i].style.color,
								obj_fld.options[i].style.backgroundColor
								);

		if (obj_fld.options[i].value != 'sys_separator' && obj_fld.name != 'quebras_new_list')
		{                                           
			obj_fld.options[i].disabled    = true;
			obj_fld.options[i].style.color = "#C0C0C0";
		}
		int_cnt++;
   }
  }
  obj_fld.options[i].selected = false;
 }
 if (0 < arr_sel.length)
 {
  nm_field_move_right(arr_sel, v_str_form, v_str_block);
  bol_mod = true;
 }
 if (bol_mod && (null != v_str_cback))
 {
  v_str_cback();
 }
} // nm_field_select_all

/**
 * Seleciona todos os campos.
 *
 * Seleciona todos os campos para a caixa de blocos da aplicacao.
 *
 * @access  public
 * @param   string  v_str_form   Formulario do combobox.
 * @param   string  v_str_field  Campos da aplicacao.
 * @param   string  v_str_block  Blocos da aplicacao.
 * @param   string  v_str_cback  Funcao callback.
 */
function nm_field_select_all(v_str_form, v_str_field, v_str_block, v_str_cback)
{
 bol_mod = false;
 obj_fld = document.forms[v_str_form].elements[v_str_field];
 arr_sel = new Array();
 int_cnt = 0;
 for (i = 0; i < obj_fld.length; i++)
 {
  if ((null != obj_fld.options[i]) && !obj_fld.options[i].disabled)
  {
   arr_sel[int_cnt] = new Array(obj_fld.options[i].value,
                                obj_fld.options[i].text, 
                                obj_fld.options[i].style.color,
                                obj_fld.options[i].style.backgroundColor
								);

   if (obj_fld.options[i].value != 'sys_separator' && obj_fld.name != 'quebras_new_list')
   {
       obj_fld.options[i].disabled    = true;
       obj_fld.options[i].style.color = "#C0C0C0";
   }
   int_cnt++;
  }
  obj_fld.options[i].selected = false;
 }
 if (0 < arr_sel.length)
 {
  nm_field_move_right(arr_sel, v_str_form, v_str_block);
  bol_mod = true;
 }
 if (bol_mod && (null != v_str_cback))
 {
  v_str_cback();
 }
} // nm_field_select_all

/**
 * Seleciona todos os campos.
 *
 * Seleciona todos os campos para a caixa de blocos da aplicacao.
 *
 * @access  public
 * @param   string  v_str_form   Formulario do combobox.
 * @param   string  v_str_field  Campos da aplicacao.
 * @param   string  v_str_block  Blocos da aplicacao.
 * @param   string  v_str_cback  Funcao callback.
 */
function nm_field_select_all2(v_str_form, v_str_field, v_str_block, v_str_cback)
{
 bol_mod = false;
 obj_fld = document.forms[v_str_form].elements[v_str_field];
 arr_sel = new Array();
 int_cnt = 0;
 for (i = 0; i < obj_fld.length; i++)
 {
  if ((null != obj_fld.options[i]) && !obj_fld.options[i].disabled)
  {
   arr_sel[int_cnt] = new Array(obj_fld.options[i].value,
                                obj_fld.options[i].text, 
                                obj_fld.options[i].style.color,
                                obj_fld.options[i].style.backgroundColor
								);

   if (obj_fld.options[i].value != 'sys_separator' && obj_fld.name != 'quebras_new_list')
   {                                           
       obj_fld.options[i].disabled    = true;
       obj_fld.options[i].style.color = "#C0C0C0";
   }
   int_cnt++;
  }
  obj_fld.options[i].selected = false;
 }
 if (0 < arr_sel.length)
 {
  nm_field_move_right2(arr_sel, v_str_form, v_str_block);
  bol_mod = true;
 }
 if (bol_mod && (null != v_str_cback))
 {
  v_str_cback();
 }
} // nm_field_select_all

function nm_menulink_clear()
{
 obj_sel = document.form_edit.menulink_itens;
 while (0 < obj_sel.length)
 {
  obj_sel.options[0] = null;
 }
 nm_form_modified();
}

function nm_menulink_delete()
{
 obj_sel = document.form_edit.menulink_itens;
 int_sel = obj_sel.selectedIndex;
 if (-1 < int_sel)
 {
  obj_sel.options[int_sel] = null;
  nm_menulink_reset();
  nm_form_modified();
 }
}

function nm_menulink_display(v_str_delim)
{
 obj_sel = document.form_edit.menulink_itens;
 int_sel = obj_sel.selectedIndex;
 if (-1 < int_sel)
 {
  arr_info = obj_sel.options[int_sel].value.split(v_str_delim);
  document.form_edit.menulink_label.value = arr_info[nmFldLabel];
  document.form_edit.menulink_link.value  = arr_info[nmFldLink];
  document.form_edit.menulink_icon.value  = arr_info[nmFldIcon];
  if ("S" == arr_info[nmFldDef])
  {
   document.form_edit.menulink_def[0].checked = true;
  }
  else
  {
   document.form_edit.menulink_def[1].checked = true;
  }
 }
}

function nm_menulink_insert(v_str_delim)
{
 str_val  = document.form_edit.menulink_label.value + v_str_delim
          + document.form_edit.menulink_link.value  + v_str_delim;
 str_val += (document.form_edit.menulink_def[0].checked) ? "S" : "N";
 str_val += v_str_delim + document.form_edit.menulink_icon.value;
 obj_sel  = document.form_edit.menulink_itens;
 if (document.form_edit.menulink_def[0].checked)
 {
  nm_menulink_unset_def(obj_sel, v_str_delim);
  str_text = "*" + document.form_edit.menulink_label.value;
 }
 else
 {
  str_text = " " + document.form_edit.menulink_label.value;
 }
 obj_sel.options[obj_sel.length] = new Option(str_text, str_val);
 nm_menulink_reset();
 nm_form_modified();
}

function nm_menulink_reset()
{
 document.form_edit.menulink_label.value    = "";
 document.form_edit.menulink_link.value     = "";
 document.form_edit.menulink_icon.value     = "";
 document.form_edit.menulink_def[1].checked = true;
 document.form_edit.menulink_itens.selectedIndex = -1;
}

function nm_menulink_pack(v_str_delim)
{
 if (document.form_edit && document.form_edit.menulink_itens)
 {
  obj_sel = document.form_edit.menulink_itens;
  str_val = "";
  for (i = 0; i < obj_sel.length; i++)
  {
   if ("" != str_val)
   {
    str_val += v_str_delim;
   }
   str_val += obj_sel.options[i].value;
  }
  document.form_edit.menulink_list.value = str_val;
 }
}

function nm_menulink_unset_def(v_obj_sel, v_str_delim)
{
 for (i = 0; i < v_obj_sel.length; i++)
 {
  arr_parts = v_obj_sel.options[i].value.split(v_str_delim);
  if ("S" == arr_parts[nmFldDef])
  {
   v_obj_sel.options[i].text  = " " + arr_parts[nmFldLabel];
   v_obj_sel.options[i].value = arr_parts[nmFldLabel] + v_str_delim
                              + arr_parts[nmFldLink]  + v_str_delim
                              + "N"                   + v_str_delim
                              + arr_parts[nmFldIcon];
  }
 }
}

function nm_menulink_update(v_str_delim)
{
 obj_sel = document.form_edit.menulink_itens;
 int_sel = obj_sel.selectedIndex;
 if (-1 < int_sel)
 {
  str_val  = document.form_edit.menulink_label.value + v_str_delim
           + document.form_edit.menulink_link.value  + v_str_delim;
  str_val += (document.form_edit.menulink_def[0].checked) ? "S" : "N";
  str_val += v_str_delim + document.form_edit.menulink_icon.value;
  if (document.form_edit.menulink_def[0].checked)
  {
   nm_menulink_unset_def(obj_sel, v_str_delim);
   str_text = "*" + document.form_edit.menulink_label.value;
  }
  else
  {
   str_text = " " + document.form_edit.menulink_label.value;
  }
  obj_sel.options[int_sel].text  = str_text;
  obj_sel.options[int_sel].value = str_val;
  nm_menulink_reset();
  nm_form_modified();
 }
}

/**
 * Move um item para baixo.
 *
 * Realiza a movimentacao para baixo de um item do combobox.
 *
 * @access  public
 * @param   string  v_str_form   Formulario do combobox.
 * @param   string  v_str_field  Campo do combobox.
 * @param   string  v_str_cback  Funcao callback.
 */
function nm_move_down(v_str_form, v_str_field, v_str_cback)
{
 bol_mod = false;
 obj_sel = document.forms[v_str_form].elements[v_str_field];
 if (1 < obj_sel.length)
 {
  for (i = (obj_sel.length - 2); i >= 0; i--)
  {
   if ((null != obj_sel.options[i]) && obj_sel.options[i].selected &&
       !obj_sel.options[i + 1].selected)
   {
    bol_mod                         = true;
    bol_sel                         = obj_sel.options[i + 1].selected;
    str_txt                         = obj_sel.options[i].text;
    str_val                         = obj_sel.options[i].value;
    obj_sel.options[i].text         = obj_sel.options[i + 1].text;
    obj_sel.options[i].value        = obj_sel.options[i + 1].value;
    obj_sel.options[i + 1].text     = str_txt;
    obj_sel.options[i + 1].value    = str_val;
    obj_sel.options[i].selected     = bol_sel;
    obj_sel.options[i + 1].selected = true;
   }
  }
 }
 if (bol_mod && (null != v_str_cback))
 {
  v_str_cback();
 }
} // nm_move_down

/**
 * Move um item para cima.
 *
 * Realiza a movimentacao para cima de um item do combobox.
 *
 * @access  public
 * @param   string  v_str_form   Formulario do combobox.
 * @param   string  v_str_field  Campo do combobox.
 * @param   string  v_str_cback  Funcao callback.
 */
function nm_move_up(v_str_form, v_str_field, v_str_cback)
{
 bol_mod = false;
 obj_sel = document.forms[v_str_form].elements[v_str_field];
 if (1 < obj_sel.length)
 {
  for (i = 1; i < obj_sel.length; i++)
  {
   if ((null != obj_sel.options[i]) && obj_sel.options[i].selected &&
       !obj_sel.options[i - 1].selected)
   {
    bol_mod                         = true;
    bol_sel                         = obj_sel.options[i - 1].selected;
    str_txt                         = obj_sel.options[i].text;
    str_val                         = obj_sel.options[i].value;
    obj_sel.options[i].text         = obj_sel.options[i - 1].text;
    obj_sel.options[i].value        = obj_sel.options[i - 1].value;
    obj_sel.options[i - 1].text     = str_txt;
    obj_sel.options[i - 1].value    = str_val;
    obj_sel.options[i].selected     = bol_sel;
    obj_sel.options[i - 1].selected = true;
   }
  }
 }
 if (bol_mod && (null != v_str_cback))
 {
  v_str_cback();
 }
} // nm_move_up

function nm_is_ie()
{
	nav = navigator.userAgent.toLowerCase();	
	return  nav.indexOf('msie') > 0;
}