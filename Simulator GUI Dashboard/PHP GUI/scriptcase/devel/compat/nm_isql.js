/**
 * $Id: nm_isql.js,v 1.2 2012-01-10 19:38:03 diogo Exp $
 */
function isql_modificado()
{
 document.isql_form.isql_form_changed.value = "S";
}

function isql_fecha()
{
 window.close();
}

function isql_base_confirma()
{
 document.isql_form.isql_form_action.value = "base_confirma";
 document.isql_form.submit();
}

function isql_tabela_confirma(delim)
{
 string  = "";
 tamanho = document.isql_form.isql_tabelas_sim.length;
 for (i = 0; i < tamanho; i++)
 {
  if ("" != string)
  {
   string += delim;
  }
  string += document.isql_form.isql_tabelas_sim.options[i].value;
 }
 document.isql_form.isql_tabela_string.value = string;
 document.isql_form.isql_form_action.value   = "tabela_confirma";
 document.isql_form.submit();
}

function isql_tabela_seldes(isql_acao, isql_origem, isql_destino)
{
 origem_qtd = document.isql_form[isql_origem].length;
 mod        = false;
 for (i = 0; i < origem_qtd; i++)
 {
  destino_qtd = document.isql_form[isql_destino].length;
  if (document.isql_form[isql_origem].options[i] != null)
  {
   item_nul  = false;
   item_sel  = document.isql_form[isql_origem].options[i].selected;
   item_val  = document.isql_form[isql_origem].options[i].value;
   item_text = document.isql_form[isql_origem].options[i].text;
  }
  else
  {
   item_nul = true;
   item_sel = false;
   item_val = "";
  }
  if (("ALL" == isql_acao) && (!item_nul) && ("" != item_val))
  {
   document.isql_form[isql_destino].options[destino_qtd] = new Option(item_text, item_val);
   document.isql_form[isql_origem].options[i]            = null;
   mod                                                   = true;
   i--;
  }
  else if (("SEL" == isql_acao) && (!item_nul) && (item_sel) && ("" != item_val))
  {
   document.isql_form[isql_destino].options[destino_qtd] = new Option(item_text, item_val);
   document.isql_form[isql_origem].options[i]            = null;
   mod                                                   = true;
   i--;
  }
 }
 if (mod)
 {
  isql_modificado();
 }
}

function isql_tabela_move(isql_acao)
{
 item_pos = document.isql_form.isql_tabelas_sim.selectedIndex;
 if ((item_pos != -1) && (document.isql_form.isql_tabelas_sim.options[item_pos].value != ''))
 {
  item_texto = document.isql_form.isql_tabelas_sim.options[item_pos].text;
  item_valor = document.isql_form.isql_tabelas_sim.options[item_pos].value;
  if ((isql_acao == 'DESCE') && (item_pos < (document.isql_form.isql_tabelas_sim.length - 1)))
  {
   document.isql_form.isql_tabelas_sim.options[item_pos].text      = document.isql_form.isql_tabelas_sim.options[item_pos + 1].text;
   document.isql_form.isql_tabelas_sim.options[item_pos].value     = document.isql_form.isql_tabelas_sim.options[item_pos + 1].value;
   document.isql_form.isql_tabelas_sim.options[item_pos + 1].text  = item_texto;
   document.isql_form.isql_tabelas_sim.options[item_pos + 1].value = item_valor;
   document.isql_form.isql_tabelas_sim.selectedIndex               = item_pos + 1;
  }
  else if ((isql_acao == 'SOBE') && (item_pos > 0))
  {
   document.isql_form.isql_tabelas_sim.options[item_pos].text      = document.isql_form.isql_tabelas_sim.options[item_pos - 1].text;
   document.isql_form.isql_tabelas_sim.options[item_pos].value     = document.isql_form.isql_tabelas_sim.options[item_pos - 1].value;
   document.isql_form.isql_tabelas_sim.options[item_pos - 1].text  = item_texto;
   document.isql_form.isql_tabelas_sim.options[item_pos - 1].value = item_valor;
   document.isql_form.isql_tabelas_sim.selectedIndex               = item_pos - 1;
  }
 }
 isql_modificado();
}

function isql_campo_confirma(delim)
{
 itens_qtd = 0;
 if(document.isql_form.isql_campos_sim)
 {
 	itens_qtd = document.isql_form.isql_campos_sim.length;
 }

 itens_str = "";
 for (i = 0; i < itens_qtd; i++)
 {
  if ("" != itens_str)
  {
   itens_str += delim;
  }
  itens_str += document.isql_form.isql_campos_sim.options[i].value;
 }
 if(document.isql_form.isql_campo_string)
 {
 	document.isql_form.isql_campo_string.value = itens_str;
 }
 document.isql_form.isql_form_action.value  = "campo_confirma";
 document.isql_form.submit();
}

function isql_campo_sel(isql_acao, delim)
{
 origem_qtd = document.isql_form.isql_campos_nao.length;
 mod        = false;
 tab        = false;
 for (i = 0; i < origem_qtd; i++)
 {
  destino_qtd = document.isql_form.isql_campos_sim.length;
  if (document.isql_form.isql_campos_nao.options[i] != null)
  {
   item_nul  = false;
   item_sel  = document.isql_form.isql_campos_nao.options[i].selected;
   item_val  = document.isql_form.isql_campos_nao.options[i].value;
   item_tmp  = document.isql_form.isql_campos_nao.options[i].value;
   item_tmp  = item_tmp.split(".");

   if (item_tmp.length == 3)
   {
		item_text = item_tmp[0]+ '.' + item_tmp[1] + '.' + item_tmp[2];
   }
   else
   {
		item_text = item_tmp[0] +"."+ item_tmp[1];
   }

   item_tab  = (item_val.substr(0, 6) == ("tab" + delim));
  }
  else
  {
   item_nul  = true;
   item_sel  = false;
   item_val  = "";
   item_text = "";
   item_tab  = false;
  }
  if (false == tab)
  {
   if (item_tab && item_sel)
   {
    tab = true;
   }
  }
  else
  {
   if (item_tab || "" == item_val)
   {
    tab = false;
   }
  }
  if (tab && ("" != item_val) && (!item_tab))
  {
   document.isql_form.isql_campos_sim.options[destino_qtd] = new Option(item_text, item_val);
   mod                                                     = true;
  }
  else
  {
   if (("ALL" == isql_acao) && (!item_nul) && ("" != item_val) && (!item_tab))
   {
    document.isql_form.isql_campos_sim.options[destino_qtd] = new Option(item_text, item_val);
    mod                                                     = true;
   }
   else if (("SEL" == isql_acao) && (!item_nul) && (item_sel) && ("" != item_val) && (!item_tab))
   {
    document.isql_form.isql_campos_sim.options[destino_qtd] = new Option(item_text, item_val);
    mod                                                     = true;
   }
  }
 }
 if (mod)
 {
  isql_modificado();
 }
}

function isql_campo_des(isql_acao)
{
 origem_qtd = document.isql_form.isql_campos_sim.length;
 mod        = false;
 for (i = 0; i < origem_qtd; i++)
 {
  if ((isql_acao == 'ALL') && (document.isql_form.isql_campos_sim.options[i] != null))
  {
   document.isql_form.isql_campos_sim.options[i] = null;
   mod                                           = true;
   i--;
  }
  else if ((isql_acao == 'SEL') && (document.isql_form.isql_campos_sim.options[i] != null) && (document.isql_form.isql_campos_sim.options[i].selected == true))
  {
   document.isql_form.isql_campos_sim.options[i] = null;
   mod                                           = true;
   i--;
  }
 }
 if (mod)
 {
  isql_modificado();
 }
}

function isql_campo_move(isql_coluna, isql_acao)
{
 item_pos = document.isql_form[isql_coluna].selectedIndex;
 if ((item_pos != -1) && (document.isql_form[isql_coluna].options[item_pos].value != ''))
 {
  item_texto = document.isql_form[isql_coluna].options[item_pos].text;
  item_valor = document.isql_form[isql_coluna].options[item_pos].value;
  if ((isql_acao == 'DESCE') && (item_pos < (document.isql_form[isql_coluna].length - 1)))
  {
   document.isql_form[isql_coluna].options[item_pos].text      = document.isql_form[isql_coluna].options[item_pos + 1].text;
   document.isql_form[isql_coluna].options[item_pos].value     = document.isql_form[isql_coluna].options[item_pos + 1].value;
   document.isql_form[isql_coluna].options[item_pos + 1].text  = item_texto;
   document.isql_form[isql_coluna].options[item_pos + 1].value = item_valor;
   document.isql_form[isql_coluna].selectedIndex               = item_pos + 1;
  }
  else if ((isql_acao == 'SOBE') && (item_pos > 0))
  {
   document.isql_form[isql_coluna].options[item_pos].text      = document.isql_form[isql_coluna].options[item_pos - 1].text;
   document.isql_form[isql_coluna].options[item_pos].value     = document.isql_form[isql_coluna].options[item_pos - 1].value;
   document.isql_form[isql_coluna].options[item_pos - 1].text  = item_texto;
   document.isql_form[isql_coluna].options[item_pos - 1].value = item_valor;
   document.isql_form[isql_coluna].selectedIndex               = item_pos - 1;
  }
 }
 isql_modificado();
}

function isql_join_confirma(tipo, delim)
{
 if ("tabelas" == tipo)
 {
  join_qtd    = document.isql_form.isql_join_info.length;
  join_string = "";
  for (i = 0; i < join_qtd; i++)
  {
   if ("" != join_string)
   {
    join_string += delim;
   }
   join_string += document.isql_form.isql_join_info.options[i].value;
  }
  document.isql_form.isql_join_string.value = join_string;
 }
 document.isql_form.isql_form_action.value = "join_confirma";
 document.isql_form.submit();
}

function isql_join_adiciona()
{
 document.isql_form.isql_form_action.value = "join_adiciona";
 document.isql_form.submit();
}

function isql_join_inclui(delim, erro_tab_1, erro_tab_2, erro_tab_igual, erro_tipo, erro_existe, erro_ciclo)
{
 join_tab_1_sel = document.isql_form.isql_join_tabelas_1.selectedIndex;
 join_tab_2_sel = document.isql_form.isql_join_tabelas_2.selectedIndex;
 join_tipo_sel  = document.isql_form.isql_join_tipos.selectedIndex;
 if (-1 == join_tab_1_sel)
 {
  alert(erro_tab_1);
 }
 else if (-1 == join_tab_2_sel)
 {
  alert(erro_tab_2);
 }
 else if (join_tab_1_sel == join_tab_2_sel)
 {
  alert(erro_tab_igual);
 }
 else if (0 >= join_tipo_sel)
 {
  alert(erro_tipo);
 }
 else
 {
  join_tab_1      = document.isql_form.isql_join_tabelas_1.options[join_tab_1_sel].value;
  join_tab_1_text = document.isql_form.isql_join_tabelas_1.options[join_tab_1_sel].text;
  join_tab_2      = document.isql_form.isql_join_tabelas_2.options[join_tab_2_sel].value;
  join_tab_2_text = document.isql_form.isql_join_tabelas_2.options[join_tab_2_sel].text;
  join_tipo       = document.isql_form.isql_join_tipos.options[join_tipo_sel].value;
  join_text       = document.isql_form.isql_join_tipos.options[join_tipo_sel].text;
  join_qtd        = document.isql_form.isql_join_info.length;
  join_erro       = false;
  for (i = 0; i < join_qtd; i++)
  {
   if (null != document.isql_form.isql_join_info.options[i] && !join_erro)
   {
    join_info_full = document.isql_form.isql_join_info.options[i].value;
    join_info_tipo = join_info_full.substr(0, 2);
    join_info_tabs = join_info_full.substr(2 + delim.length);
    tmp_pos_delim  = join_info_tabs.indexOf(delim);
    join_info_tab1 = join_info_tabs.substr(0, tmp_pos_delim);
    join_info_tabs = join_info_tabs.substr(tmp_pos_delim + delim.length);
    tmp_pos_delim  = join_info_tabs.indexOf(delim);
    join_info_tab2 = join_info_tabs.substr(0, tmp_pos_delim);
    if (join_info_tab1 == join_tab_1 && join_info_tab2 == join_tab_2)
    {
     join_erro = true;
     alert(erro_existe);
    }
    else if (join_info_tab1 == join_tab_2 && join_info_tab2 == join_tab_1)
    {
     join_erro = true;
     alert(erro_ciclo);
    }
   }
  }
  if (!join_erro)
  {
   op_val                                              = join_tipo + delim + join_tab_1 + delim + join_tab_2 + delim + "";
   op_txt                                              = join_tab_1_text + " " + join_text + " " + join_tab_2_text;
   document.isql_form.isql_join_info.options[join_qtd] = new Option(op_txt, op_val);
   isql_modificado();
  }
  document.isql_form.isql_join_tabelas_1.selectedIndex = -1;
  document.isql_form.isql_join_tabelas_2.selectedIndex = -1;
  document.isql_form.isql_join_tipos.selectedIndex     = 0;
  document.isql_form.isql_join_info.selectedIndex      = -1;
 }
}

function isql_join_recupera(delim)
{
 join_sel = document.isql_form.isql_join_info.selectedIndex;
 if (null != document.isql_form.isql_join_info.options[join_sel])
 {
  join_info_full = document.isql_form.isql_join_info.options[join_sel].value;
  join_info_tipo = join_info_full.substr(0, 2);
  join_info_tabs = join_info_full.substr(2 + delim.length);
  tmp_pos_delim  = join_info_tabs.indexOf(delim);
  join_info_tab1 = join_info_tabs.substr(0, tmp_pos_delim);
  join_info_tabs = join_info_tabs.substr(tmp_pos_delim + delim.length);
  tmp_pos_delim  = join_info_tabs.indexOf(delim);
  join_info_tab2 = join_info_tabs.substr(0, tmp_pos_delim);
  join_info_cmps = join_info_tabs.substr(tmp_pos_delim + delim.length);
  tab_lista_qtd  = document.isql_form.isql_join_tabelas_1.length;
  for (i = 0; i < tab_lista_qtd; i++)
  {
   if (join_info_tab1 == document.isql_form.isql_join_tabelas_1.options[i].value)
   {
    document.isql_form.isql_join_tabelas_1.selectedIndex = i;
   }
   if (join_info_tab2 == document.isql_form.isql_join_tabelas_2.options[i].value)
   {
    document.isql_form.isql_join_tabelas_2.selectedIndex = i;
   }
  }
  tipo_join_qtd = document.isql_form.isql_join_tipos.length;
  for (i = 0; i < tipo_join_qtd; i++)
  {
   if (join_info_tipo == document.isql_form.isql_join_tipos.options[i].value)
   {
    document.isql_form.isql_join_tipos.selectedIndex = i;
   }
  }
  document.isql_form.isql_join_campos.value = join_info_cmps;
 }
}

function isql_join_atualiza(delim, erro_tab_1, erro_tab_2, erro_tab_igual, erro_tipo, erro_existe, erro_ciclo)
{
  join_sel = document.isql_form.isql_join_info.selectedIndex;

  if (-1 < join_sel)
  {
    join_val = document.isql_form.isql_join_info.options[join_sel].value;

    join_tab_1_sel = document.isql_form.isql_join_tabelas_1.selectedIndex;
    join_tab_2_sel = document.isql_form.isql_join_tabelas_2.selectedIndex;
    join_tipo_sel  = document.isql_form.isql_join_tipos.selectedIndex;

    if (-1 == join_tab_1_sel)
    {
        alert(erro_tab_1);
    }
    else if (-1 == join_tab_2_sel)
    {
        alert(erro_tab_2);
    }
    else if (join_tab_1_sel == join_tab_2_sel)
    {
        alert(erro_tab_igual);
    }
    else if (0 >= join_tipo_sel)
    {
        alert(erro_tipo);
    }
    else
    {
        join_tab_1 = document.isql_form.isql_join_tabelas_1.options[join_tab_1_sel].value;
        join_tab_2 = document.isql_form.isql_join_tabelas_2.options[join_tab_2_sel].value;
        join_tipo  = document.isql_form.isql_join_tipos.options[join_tipo_sel].value;
        join_text  = document.isql_form.isql_join_tipos.options[join_tipo_sel].text;

        posicao = join_val.lastIndexOf("?#?")+3;
        campos = join_val.substring(posicao, join_val.length);

        op_val = join_tipo + delim + join_tab_1 + delim + join_tab_2 + delim + campos;
        op_txt = join_tab_1 + " " + join_text + " " + join_tab_2;
        document.isql_form.isql_join_info.options[join_sel].value = op_val;
        document.isql_form.isql_join_info.options[join_sel].text  = op_txt;
        isql_modificado();

        document.isql_form.isql_join_tabelas_1.selectedIndex = -1;
        document.isql_form.isql_join_tabelas_2.selectedIndex = -1;
        document.isql_form.isql_join_tipos.selectedIndex     = 0;
        document.isql_form.isql_join_info.selectedIndex      = join_sel;
    }
  }
}

function isql_join_limpa()
{
 join_qtd = document.isql_form.isql_join_info.length;
 for (i = 0; i < join_qtd; i++)
 {
  document.isql_form.isql_join_info.options[0] = null;
 }
 document.isql_form.isql_join_tabelas_1.selectedIndex = -1;
 document.isql_form.isql_join_tabelas_2.selectedIndex = -1;
 document.isql_form.isql_join_tipos.selectedIndex     = 0;
 document.isql_form.isql_join_info.selectedIndex      = -1;
 isql_modificado();
}

function isql_join_remove()
{
 join_sel = document.isql_form.isql_join_info.selectedIndex;
 if (null != document.isql_form.isql_join_info.options[join_sel])
 {
  document.isql_form.isql_join_info.options[join_sel]  = null;
  document.isql_form.isql_join_tabelas_1.selectedIndex = -1;
  document.isql_form.isql_join_tabelas_2.selectedIndex = -1;
  document.isql_form.isql_join_tipos.selectedIndex     = 0;
  isql_modificado();
 }
}

function isql_join_marca(cmp_1, cmp_2, chk)
{
 if ((0 < document.isql_form[cmp_1].selectedIndex) && (0 < document.isql_form[cmp_2].selectedIndex))
 {
  document.isql_form[chk].checked = true;
 }
 isql_modificado();
}

function isql_where_confirma()
{
 document.isql_form.isql_form_action.value = "where_confirma";
 document.isql_form.submit();
}

function isql_where_adiciona()
{
 document.isql_form.isql_form_action.value = "where_adiciona";
 document.isql_form.submit();
}

function isql_where_remove(isql_condicao)
{
 document.isql_form.isql_form_action.value = "where_remove";
 document.isql_form.isql_where_rem.value   = isql_condicao;
 document.isql_form.submit();
}

function isql_order_confirma()
{
 document.isql_form.isql_form_action.value = "order_confirma";
 document.isql_form.submit();
}
function isql_exec_confirma()
{
 document.isql_form.isql_form_action.value = "exec_confirma";
 document.isql_form.submit();
}
function isql_dir_confirma()
{
 document.isql_form.isql_form_action.value = "dir_confirma";
 document.isql_form.submit();
}
function isql_order_adiciona()
{
 document.isql_form.isql_form_action.value = "order_adiciona";
 document.isql_form.submit();
}

function isql_order_remove(isql_ordem)
{
 document.isql_form.isql_form_action.value = "order_remove";
 document.isql_form.isql_order_rem.value   = isql_ordem;
 document.isql_form.submit();
}

function isql_exec_executa()
{
 document.isql_form.isql_form_action.value = "exec_executa";
 document.isql_form.submit();
}

function isql_exec_move(isql_direcao)
{
 if ("A" == isql_direcao)
 {
  document.isql_form.isql_form_action.value = "exec_avanca";
 }
 else
 {
  document.isql_form.isql_form_action.value = "exec_retorna";
 }
 document.isql_form.submit();
}

function isql_dir_salva()
{
 document.isql_form.isql_form_action.value = "dir_salva";
 document.isql_form.submit();
}

function isql_dir_confirma(muda)
{
	document.isql_form.isql_form_action.value = "dir_confirma";
	if (muda && muda == 'muda')
	{
		document.isql_form.isql_form_action.value = "";
	}
 
 	document.isql_form.submit();
}

function isql_dir_cancela()
{
 document.isql_form.isql_form_action.value = "dir_cancela";
 document.isql_form.submit();
}

function isql_dir_abre(isql_arq_nome)
{
 document.isql_form.isql_form_action.value = "dir_abre";
 document.isql_form.isql_arquivo.value     = isql_arq_nome;
 document.isql_form.submit();
}

function isql_dir_remove(isql_arq_nome)
{
 document.isql_form.isql_form_action.value = "dir_remove";
 document.isql_form.isql_arquivo.value     = isql_arq_nome;
 document.isql_form.submit();
}

function isql_dir_apaga(isql_arq_nome)
{
 document.isql_form.isql_form_action.value = "dir_apaga";
 document.isql_form.isql_arquivo.value     = isql_arq_nome;
 document.isql_form.submit();
}
function nmImport(str_form, str_field)
{
  if (opener.editAreaLoader && editAreaLoader)
  {
	opener.editAreaLoader.setValue('Formula_id', editAreaLoader.getValue('Formula_id'));
	opener.document.forms[str_form].elements[str_field].value = editAreaLoader.getValue('Formula_id');
  } 
  else
  {	
  	opener.document.forms[str_form].elements[str_field].value = document.isql_form.isql_command.value;
  }	
  self.close();
}
function isql_checkall(obj_sel, seq, str_checkbox)
{
   item_sel = obj_sel.selectedIndex;

   if(item_sel)
   {
       if(item_sel>1)
       {
           document.isql_form.elements[str_checkbox+"["+seq+"]"].checked = true;
       }else
       {
           document.isql_form.elements[str_checkbox+"["+seq+"]"].checked = false;
       }
   }else
   {
       document.isql_form.elements[str_checkbox+"["+seq+"]"].checked = false;
   }
}