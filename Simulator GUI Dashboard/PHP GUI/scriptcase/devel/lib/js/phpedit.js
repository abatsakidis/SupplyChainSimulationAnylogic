/**
 * Edicao de formula PHP.
 *
 * Rotinas de controle da manipulacao do editor de codigo PHP.
 *
 * @package     Biblioteca
 * @subpackage  Javascript
 * @creation    2004/02/03
 * @copyright   NetMake Solucoes em Informatica
 * @author      Luis Humberto Roman <romanlh@netmake.com.br>
 *
 * $Id: phpedit.js,v 1.1.1.1 2011-05-12 20:31:10 diogo Exp $
 */

/* Recupera informacoes do browser */
var clientPC  = navigator.userAgent.toLowerCase(); 
var clientVer = parseInt(navigator.appVersion); 
var is_ie     = ((clientPC.indexOf('msie') != -1) && (clientPC.indexOf('opera') == -1));
var is_nav    = ((clientPC.indexOf('mozilla')    != -1) && (clientPC.indexOf('spoofer') == -1) &&
                 (clientPC.indexOf('compatible') == -1) && (clientPC.indexOf('opera')   == -1) &&
                 (clientPC.indexOf('webtv')      == -1) && (clientPC.indexOf('hotjava') == -1));
var is_moz    = 0;
var is_win    = ((clientPC.indexOf('win')!=-1) || (clientPC.indexOf('16bit') != -1));
var is_mac    = (clientPC.indexOf('mac')!=-1);
var nm_is_ie  = (clientVer >= 4) && is_ie && is_win;

/* Inicializa variaveis */
var int_tab = 4;
var str_tab = '    ';

/* Executa acao do editor */
function nm_editor(str_op, str_form, str_field)
{

 /* Quando existir mais de 1 textarea */	
 if (document.getElementById('hid_txt_ativ') != null)
 {
	str_field = document.getElementById('hid_txt_ativ').value;
 }
	
	
 txtarea = document.forms[str_form].elements[str_field];
 str_ins = '';
 /* Indentacao */
 if ('ind_inc' == str_op || 'ind_dec' == str_op)
 {
  if (nm_is_ie)
  {
   str_sel = document.selection.createRange().text;
   txtarea.focus();
   if ('' != str_sel)
   {
    nm_indent_ie(str_op);
   }
  }
  else if (txtarea.selectionEnd && txtarea.selectionEnd >= txtarea.selectionStart)
  {
   nm_indent_mozilla(str_op, txtarea.selectionStart, txtarea.selectionEnd);
  }
 }
 /* sc_btn_insert, sc_btn_update, sc_btn_delete, sc_btn_new,
    sc_before_insert, sc_before_update, sc_before_delete,
    sc_after_insert, sc_after_update, sc_after_delete
    -------------------------------------------------- */
 if ('sc_btn_insert'    == str_op || 'sc_btn_update'    == str_op || 'sc_btn_delete'    == str_op || 'sc_btn_new' == str_op ||
     'sc_before_insert' == str_op || 'sc_before_update' == str_op || 'sc_before_delete' == str_op ||
     'sc_after_insert'  == str_op || 'sc_after_update'  == str_op || 'sc_after_delete'  == str_op)
 {
  str_ins = str_op;
 }
 /* sc_btn_display
    -------------------------------------------------- */
 else if ('sc_btn_display' == str_op)
 {
  str_btn = prompt(var_msg_btndisplay_1, var_ex_botao);
  if (str_btn)
  {
   str_act = prompt(var_msg_btndisplay_2, var_ex_acao);
   if (str_act)
   {
    str_act = ('off' == str_act.toLowerCase()) ? 'off' : 'on';
    str_ins = 'sc_btn_display("' + str_btn + '", "' + str_act + '");';
   } // str_act
  } // str_btn
 }
 /* sc_changed
    -------------------------------------------------- */
 else if ('sc_changed' == str_op)
 {
  str_cmp = prompt(var_msg_changed, var_ex_campo);
  if (str_cmp)
  {
   str_ins = 'sc_changed({' + str_cmp + '})';
  }
 }
 /* sc_confirm
    -------------------------------------------------- */
 else if ('sc_confirm' == str_op)
 {
  str_msg = prompt(var_msg_confirm, var_ex_msg);
  if (str_msg)
  {
   str_ins = 'sc_confirm("' + str_msg + '");';
  }
 }
 /* sc_data
    -------------------------------------------------- */
 else if ('sc_data' == str_op)
 {
  str_cmp = prompt(var_msg_data_1, var_ex_campo);
  if (str_cmp)
  {
   str_fmt = prompt(var_msg_data_2, var_ex_formato);
   if (str_fmt)
   {
    str_opd = prompt(var_msg_data_3, var_ex_operador);
    if (str_opd)
    {
     str_dia = prompt(var_msg_data_4, var_ex_dias);
     if (str_dia)
     {
      str_mes = prompt(var_msg_data_5, var_ex_meses);
      if (str_mes)
      {
       str_ano = prompt(var_msg_data_6, var_ex_anos);
       if (str_ano)
       {
        str_ins = var_macro_data + '({' + str_cmp + '}, "' + str_fmt + '", "' + str_opd + '", ' + str_dia + ', ' + str_mes + ', ' + str_ano + ');';
       } // str_ano
      } // str_mes
     } // str_dia
    } // str_opd
   } // str_fmt
  } // str_cmp
 }
 /* sc_date_conv
    -------------------------------------------------- */
 else if ('sc_date_conv' == str_op)
 {
  str_cmp = prompt(var_msg_dateconv_1, var_ex_campo);
  if (str_cmp)
  {
   str_in  = prompt(var_msg_dateconv_2, var_ex_formato);
   if (str_in)
   {
    str_out = prompt(var_msg_dateconv_2, var_ex_formato);
    if (str_out)
    {
     str_ins = 'sc_date_conv({' + str_cmp + '}, "' + str_in + '", "' + str_out + '");';
    } // str_out
   } // str_in
  } // str_cmp
 }
 /* sc_date_empty
    -------------------------------------------------- */
 else if ('sc_date_empty' == str_op)
 {
  str_cmp = prompt(var_msg_dateconv_1, var_ex_campo);
  if (str_cmp)
  {
   str_ins = 'sc_date_empty({' + str_cmp + '})';
  }
 }
 /* sc_erro_mensagem
    -------------------------------------------------- */
 else if ('sc_erro_mensagem' == str_op)
 {
  str_msg = prompt(var_msg_erromensagem, var_ex_msg);
  if (str_msg)
  {
   str_ins = var_macro_erro_msg + '("' + str_msg + '");';
  }
 }
 /* sc_exec_sql
    -------------------------------------------------- */
 else if ('sc_exec_sql' == str_op)
 {
  str_sql = prompt(var_msg_execsql, var_ex_sql);
  if (str_sql)
  {
   str_ins = 'sc_exec_sql("' + str_sql + '");';
  }
 }
 /* sc_exit
    -------------------------------------------------- */
 else if ('sc_exit' == str_op)
 {
  str_act = prompt(var_msg_exit_2, var_ex_exit_act);
  if (str_act)
  {
   str_act = ('R' == str_act.toUpperCase() || 'S' == str_act.toUpperCase()) ? str_act.toUpperCase() : 'V';
   str_ok  = prompt(var_msg_exit_1, var_ex_ok);
   if (str_ok)
   {
    str_ok  = ('N' == str_ok.toUpperCase()) ? 'N' : 'S';
    str_ins = 'sc_exit(';
    if ('R' == str_act)
    {
     str_ins += 'ref';
    }
    else if ('S' == str_act)
    {
     str_ins += 'sel';
    }
    else
    {
     str_ins += 'exit';
    }
    if ('S' == str_ok)
    {
     str_ins += ',ok';
    }
    str_ins += ');';
   }
  }
 }
 /* sc_image
    -------------------------------------------------- */
 else if ('sc_image' == str_op)
 {
  str_cnt = prompt(var_msg_image_1, var_ex_quantidade);
  if (str_cnt)
  {
   if (!nm_is_int(str_cnt) || 0 == str_cnt)
   {
    str_cnt = 1;
   }
   bol_imagem = true;
   for (i = 0; i < str_cnt && bol_imagem; i++)
   {
    str_img = prompt(var_msg_image_2 + (i + 1), var_ex_img);
    if (str_img)
    {
     if ('' != str_ins)
     {
      str_ins += ',';
     }
     str_ins += str_img;
    }
    else
    {
     bol_imagem = false;
    }
   }
   if (bol_imagem)
   {
    str_ins = 'sc_image(' + str_ins + ');';
   }
   else
   {
    str_ins = '';
   }
  }
 }
 /* sc_lookup
    -------------------------------------------------- */
 else if ('sc_lookup' == str_op)
 {
  str_ti = nm_tab_init();
  str_ds = prompt(var_msg_lookup_1, var_ex_dataset);
  if (str_ds)
  {
   str_sql = prompt(var_msg_lookup_2, var_ex_sql);
   if (str_sql)
   {
    str_errf = prompt(var_msg_lookup_3, var_ex_ok);
    if (str_errf)
    {
     bol_show = true;
     str_errf = ('N' == str_errf.toUpperCase()) ? 'N' : 'S';
     if ('S' == str_errf)
     {
      str_errm = prompt(var_msg_lookup_4, var_ex_msg);
      if (str_errm)
      {
       str_errb = prompt(var_msg_lookup_5, var_ex_ok);
       if (str_errb)
       {
        str_errb = ('N' == str_errb.toUpperCase()) ? 'N' : 'S';
       }
       else
       {
        bol_show = false;
       } // str_errb
      }
      else
      {
       bol_show = false;
      } // str_errm
     }
     if (bol_show)
     {
      str_eoff = prompt(var_msg_lookup_6, var_ex_ok);
      if (str_eoff)
      {
       str_eoff = ('N' == str_eoff.toUpperCase()) ? 'N' : 'S';
       if ('S' == str_eoff)
       {
        str_eofm = prompt(var_msg_lookup_7, var_ex_msg);
        if (!str_eofm)
        {
         bol_show = false;
        }
       }
      }
      else
      {
       bol_show = false;
      } // str_eoff
      if (bol_show)
      {
       str_ins = 'sc_lookup(' + str_ds + ', "' + str_sql + '");';
       if ('S' == str_errf)
       {
        str_ins += '\n';
        str_ins += str_ti + 'if (FALSE === {' + str_ds + '}) ' + var_msg_lookup_8 + '\n';
        str_ins += str_ti + '{\n';
        str_ins += str_ti + '    sc_erro_mensagem("' + str_errm;
        if ('S' == str_errb)
        {
         str_ins += '<BR>" . {' + str_ds + '_erro});\n';
        }
        else
        {
         str_ins += '");\n';
        }
        str_ins += str_ti + '}';
       } // erro
       if ('S' == str_eoff)
       {
        str_ins += '\n' + str_ti;
        if ('S' == str_errf)
        {
         str_ins += 'else';
        }
        str_ins += 'if (empty({' + str_ds + '})) ' + var_msg_lookup_9 + '\n';
        str_ins += str_ti + '{\n';
        str_ins += str_ti + '    sc_erro_mensagem("' + str_eofm + '");\n';
        str_ins += str_ti + '}';
       } // eof
       if ('S' == str_errf || 'S' == str_eoff)
       {
        str_ins += '\n';
        str_ins += str_ti + 'else ' + var_msg_lookup_10 + '\n';
        str_ins += str_ti + '{\n';
        str_ins += str_ti + '    \n';
        str_ins += str_ti + '}';
       }
      } // bol_show
     } // bol_show
    } // str_errf
   } // str_sql
  } // str_ds
 }
 /* sc_reset_global
    -------------------------------------------------- */
 else if ('sc_reset_global' == str_op)
 {
  str_cnt = prompt(var_msg_resetglobal_1, var_ex_quantidade);
  if (str_cnt)
  {
   if (!nm_is_int(str_cnt) || 0 == str_cnt)
   {
    str_cnt = 1;
   }
   bol_var = true;
   for (i = 0; i < str_cnt && bol_var; i++)
   {
    str_var = prompt(var_msg_resetglobal_2 + (i + 1), var_ex_var);
    if (str_var)
    {
     if ('' != str_ins)
     {
      str_ins += ',';
     }
     str_ins += '[' + str_var + ']';
    }
    else
    {
     bol_var = false;
    }
   }
   if (bol_var)
   {
    str_ins = 'sc_reset_global(' + str_ins + ');';
   }
   else
   {
    str_ins = '';
   }
  }
 }
 /* php: if
    -------------------------------------------------- */
 else if ('if' == str_op)
 {
  str_ti  = nm_tab_init();
  str_cnd = prompt(var_msg_phpif_1, var_ex_condicao);
  if (str_cnd)
  {
   str_els = prompt(var_msg_phpif_2, var_ex_ok);
   if (str_els)
   {
    str_els = ('N' == str_els.toUpperCase()) ? 'N' : 'S';
    str_eif = prompt(var_msg_phpif_3, var_ex_elseif);
    if (str_eif)
    {
     if (!nm_is_int(str_eif))
     {
      str_eif = 0;
     }
     bol_show = true;
     str_ins  = 'if (' + str_cnd + ')\n';
     str_ins += str_ti + '{\n';
     str_ins += str_ti + '    \n';
     str_ins += str_ti + '}';
     for (i = 0; i < str_eif && bol_show; i++)
     {
      str_cnde = prompt(var_msg_phpif_4 + (i + 1), var_ex_condicao);
      if (str_cnde)
      {
       str_ins += '\n';
       str_ins += str_ti + 'elseif (' + str_cnde + ')\n';
       str_ins += str_ti + '{\n';
       str_ins += str_ti + '    \n';
       str_ins += str_ti + '}';
      }
      else
      {
       bol_show = false;
      }
     }
     if (bol_show)
     {
      if ('S' == str_els)
      {
       str_ins += '\n';
       str_ins += str_ti + 'else\n';
       str_ins += str_ti + '{\n';
       str_ins += str_ti + '    \n';
       str_ins += str_ti + '}';
      }
     }
     else
     {
      str_ins = '';
     } // bol_show
    } // str_eif
   } // str_els
  } // str_cnd
 }
 /* Insere comando */
 if ('' != str_ins)
 {
  if (nm_is_ie)
  {
   str_sel = document.selection.createRange().text;
   txtarea.focus();
   document.selection.createRange().text = str_ins;
  }
  else if (txtarea.selectionEnd && txtarea.selectionEnd >= txtarea.selectionStart)
  {
   str_bef = txtarea.value.substr(0, txtarea.selectionStart);
   str_sel = txtarea.value.substr(txtarea.selectionStart, txtarea.selectionEnd - txtarea.selectionStart);
   str_aft = txtarea.value.substr(txtarea.selectionEnd);
   txtarea.value = str_bef + str_ins + str_aft;
  }
 }
}

/* Indenta texto no ie */
function nm_indent_ie(str_op)
{
 /* Indenta */
 arr_sel = str_sel.split('\n');
 str_fim = '';
 for (i = 0; i < arr_sel.length; i++)
 {
  if ('ind_inc' == str_op)
  {
   str_fim += nm_indent_inc(arr_sel[i], 'F');
  }
  else
  {
   str_fim += nm_indent_dec(arr_sel[i], 'F');
  }
 }
 document.selection.createRange().text = str_fim;
}

/* Indenta texto no mozilla*/
function nm_indent_mozilla(str_op, int_ini, int_end)
{
 /* Recupera pedacos da selecao */
 str_bef = txtarea.value.substr(0, int_ini);
 str_sel = txtarea.value.substr(int_ini, int_end - int_ini);
 str_aft = txtarea.value.substr(int_end);
 /* Corrige inicio */
 int_pos = str_bef.lastIndexOf('\n');
 if (-1 < int_pos)
 {
  str_sel = str_bef.substr(int_pos + 1) + str_sel;
  str_bef = str_bef.substr(0, int_pos);
 }
 /* Corrige final */
 int_pos = str_aft.indexOf('\n');
 if (-1 < int_pos)
 {
  str_sel += str_aft.substr(0, int_pos);
  str_aft  = str_aft.substr(int_pos);
 }
 /* Indenta */
 arr_sel = str_sel.split('\n');
 str_fim = str_bef;
 for (i = 0; i < arr_sel.length; i++)
 {
  if ('ind_inc' == str_op)
  {
   str_fim += nm_indent_inc(arr_sel[i], 'I');
  }
  else
  {
   str_fim += nm_indent_dec(arr_sel[i], 'I');
  }
 }
 int_len  = str_fim.length;
 str_fim += str_aft;
 /* Seta caixa de texto */
 txtarea.value          = str_fim;
 txtarea.selectionStart = str_bef.length + 1;
 txtarea.selectionEnd   = int_len;
}

/* Incrementa indentacao */
function nm_indent_inc(str_line, str_nl)
{
 str_new = '';
 if ('I' == str_nl)
 {
  str_new += '\n';
 }
 str_new += str_tab + str_line;
 if ('F' == str_nl)
 {
  str_new += '\n';
 }
 return str_new;
}

/* Decrementa indentacao */
function nm_indent_dec(str_line, str_nl)
{
 str_new = '';
 if ('I' == str_nl)
 {
  str_new += '\n';
 }
 for (j = 0; j < int_tab; j++)
 {
  if (' ' == str_line.substr(0, 1))
  {
   str_line = str_line.substr(1);
  }
 }
 str_new += str_line;
 if ('F' == str_nl)
 {
  str_new += '\n';
 }
 return str_new;
}

/* Testa um inteiro */
function nm_is_int(int_number)
{
 str_valid = '0123456789';
 bol_valid = true;
 for (i = 0; i < int_number.length && bol_valid; i++)
 {
  int_check = str_valid.indexOf(int_number.charAt(i));
  if (0 > int_check)
  {
   bol_valid = false;
  }
 }
 return bol_valid;
}

/* Retorna a quantidade de espacos iniciais da linha */
function nm_tab_init()
{
 if (nm_is_ie)
 {
  return '';
 }
 else
 {
  return '';
 }
}

/* Muda a quebra de linha */
function nm_word_wrap()
{
 txtarea = document.forms[str_form].elements[str_field];
 if ("off" == txtarea.wrap)
 {
  txtarea.wrap = "soft";
 }
 else
 {
  txtarea.wrap = "off";
 } 
}

/* exibe o span referente ao item clicado no combo na tela de codificacao */
function nm_show_txta(id_spn, qtd_spn)
{
	for(idx = 0; idx < qtd_spn; idx++)
	{ 
		if (document.getElementById('spn_txta_' + idx) != null)
		{
			document.getElementById('spn_txta_' + idx).style.display = 'none';
		}
	}

	if (document.getElementById('spn_txta_' + id_spn) != null)
	{  
		document.getElementById('spn_txta_' + id_spn).style.display = '';
	}
	
	if (document.getElementById('hid_txt_ativ') != null)
	{
		document.getElementById('hid_txt_ativ').value = document.getElementById('txta_' + id_spn).name;
	}
}