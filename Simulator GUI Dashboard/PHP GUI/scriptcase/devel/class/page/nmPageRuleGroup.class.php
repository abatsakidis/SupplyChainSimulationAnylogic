<?php
/**
 * Classe PageRuleGroup.
 *
 * Classe para geracao de regras de ordenacao.
 *
 * @package     Classes
 * @subpackage  Page
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

/* Classes ancestrais */
nm_load_class('page', 'Page');

/* Definicao da classe */
class nmPageRuleGroup extends nmPage
{

    /**
     * Erros do formulario.
     *
     * Lista de erros encontrados na validacao do formulario.
     *
     * @access  protected
     * @var     array
     */
    var $errors;

    /**
     * Classe Botoes.
     *
     * Objeto com a referencia da classe de botoes.
     *
     * @access  protected
     * @var     object
     */
     var $rule_group;

    /* ----- Construtor e Destrutor ------------------------------------ */

    /**
     * Construtor da classe.
     *
     * Seta o nome da pagina a ser exibida.
     *
     * @access  public
     */
    function nmPageRuleGroup()
    {
        global $nm_config;

        nm_load_class('interface', 'RuleGroup');
		$this->rule_group = new nmRuleGroup();

        $nm_config['page_info'] = NM_PAGE_INFO_NONE;
        $this->SetBody('nmPage');
        $this->SetMargin(10);
        $this->SetPage('RuleGroup');
        $this->SetPageCode(NM_PAGE_RULE_GROUP);
        $this->CheckLogin();
        $this->SetPageSubtitle('');
    } // nmPageApp

    /**
     * Inicializa lista de erros.
     *
     * Reseta o array com a lista de erros dos campos validados.
     *
     * @access  protected
     */
    function InitErrorList()
    {
        $this->errors = array();
    } // InitErrorList

    /**
     * Retorna os erro do formulario.
     *
     * Recupera a lista de codigos do erros dos campos de um formulario.
     *
     * @access  public
     * @return  array   $arr_result  Lista de codigos do erros.
     */
    function GetErrors()
    {
        return $this->errors;
    } // GetErrors

    /**
     * Seta o erro de um campo.
     *
     * Armazena o codigo do erro de um campo retornado na validacao.
     *
     * @access  public
     * @param   string  $v_str_field  Campo do formulario.
     * @param   string  $v_str_error  Codigo do erro.
     */
    function SetError($v_str_field, $v_str_error)
    {
        $this->errors[$v_str_field] = $v_str_error;
    } // SetError

    /**
     * Valida um campo da regra.
     *
     * Verifica se o valor de um campo recebido pelo formulario e valido.
     *
     * @access  protected
     *
     */
    function ValidateFieldsRuleGroup($rule_group_nome, $rule_group_fields)
    {
    	global $nm_validator;

    	/* Inicializa variavel de erros */
		$this->InitErrorList();

		$erros_msg = array();

		if (!$nm_validator->IsCode($rule_group_nome,1))
		{
			$rule_group_nome = nm_get_text_lang("['text']['addbtn_name']");
			$erros_msg[] = nm_get_text_lang("['" . $nm_validator->GetError() . "']");
		}
		else if($_REQUEST['form_option'] != 'save')
		{
			if ($this->rule_group->RuleGroupExist($rule_group_nome))
			{
				$erros_msg[] = nm_get_text_lang("['error']['rule_group_invalid_name']");
			}
		}
		
		if (!isset($rule_group_fields) || !is_array($rule_group_fields) || empty($rule_group_fields))
		{
			$rule_group_nome = nm_get_text_lang("['text']['addbtn_fields']");
			$erros_msg[] = nm_get_text_lang("['save_group_list_empty']");
		}

		if (count($erros_msg) > 0)
		{
			$this->SetError($rule_group_nome, $erros_msg);
		}

	}// ValidateFieldsRuleGroup

    /**
     * Valida o formulario da regra.
     *
     * Verifica se o formulario nao contem erros.
     *
     * @access  protect
     */
    function ValidateFormRuleGroup($rule_group_nome, $rule_group_fields)
    {
    	$this->ValidateFieldsRuleGroup($rule_group_nome, $rule_group_fields);

    } // ValidateFormRuleGroup

    /**
     * Verifica erros.
     *
     * Checa se ocorreu algum de validacao nos campos do formulario
     *
     * @access  protected
     * @return  boolean    $bol_result  TRUE se ocorreu algum erro, FALSE em
     *                                  caso contrario.
     */
     function IsValid()
     {
     	return empty($this->errors);
     } // IsValid

	function displayPageDependency()
	{
		global $nm_template;
		
		$str_tipo_app = $_SESSION['nm_session']['app']['type'];
		
		nm_load_class('interface', 'Application');
		$app = new nmApplication();
		$app->SetApplication($_SESSION['nm_session']['user']['cod_grp'],
							 	   $_SESSION['nm_session']['app']['cod'],
							       $_SESSION['nm_session']['user']['cod_ver']);

		$app->SetCodField('Cod_Apl');
		$app->SetFields(array('form' => array('GridOrientacao')));
		$app->RetrieveData();
		
		$str_msg_dependency = "";
		if(in_array($str_tipo_app, array(NM_APP_TYPE_GRID, NM_APP_TYPE_PROC)) && $app->GetData('GridOrientacao') != '' && $app->GetData('GridOrientacao') == 5)
		{
			$str_msg_dependency = nm_get_text_lang("['app_mensagens']['help']['grid_group']");
		}


		if(!empty($str_msg_dependency))
		{

			$nm_template->SetVar('str_msg_dependency' , $str_msg_dependency);
			$nm_template->Display('body_form_app_msg_dependency');
		}
	}
	 
    /**
     * Exibe o formulario
     *
     * Exibe o formulario da secao sendo editada atualmente.
     *
     * @access  protected
     * @global  object     $nm_browser   Objeto para manipulacao de browsers.
     * @global  array      $nm_config    Array de configuracao do ScriptCase.
     * @global  object     $nm_template  Objeto para exibicao de templates.
     * @param   string 	   $nome 		 Nome da regra
     */
    function DisplayForm($rule_group_nome, $rule_group_label, $rule_group_fields, $rule_group_sc_free_group_by_use, $rule_group_sc_free_group_by_openmode, $rule_group_sc_free_group_by_hide_help_line)
    {
        global $nm_template, $nm_browser;

		$this->displayPageDependency();
		
		$arr_rule_group = $this->GetRuleGroup($rule_group_nome);
		$arr_list_flds  = array();

		//se existir, fica o do banco, se nao, pega o do submit
		if (!isset($arr_rule_group['nome']))
		{
			$arr_rule_group['nome']                      = $rule_group_nome;
			$arr_rule_group['label']                     = $rule_group_label;
			$arr_rule_group['list_fld']                  = $rule_group_fields;
			$arr_rule_group['sc_free_group_by_use']      = $rule_group_sc_free_group_by_use;
			$arr_rule_group['sc_free_group_by_openmode'] = $rule_group_sc_free_group_by_openmode;
			$arr_rule_group['sc_free_group_by_hide_help_line'] = $rule_group_sc_free_group_by_hide_help_line;
		}

		$arr_fields_app = $_SESSION['nm_session']['menu_tree_fld_app'];
		$arr_fld_tp_sql = array();
		$arr_fld_value  = array();
		$arr_fld_value['sel']  = $arr_rule_group['list_fld'];
		$arr_fld_value['des']  = array();

		ksort($arr_fields_app);
		foreach ($arr_fields_app as $int_fld_type => $arr_fld_list)
        {		
		    foreach ($arr_fld_list as $arr_fld_data)
            {
				if($arr_fld_data['Categ'] == NM_FLD_CAT_TABLE)
				{
					$arr_fld_tp_sql[$arr_fld_data['Seq']] = strtoupper($arr_fld_data['Tipo_Sql']);
					if(
						(!isset($arr_fld_value['sel'][ $arr_fld_data['Seq'] ]) || $arr_fld_data['Campo'] != $arr_fld_value['sel'][ $arr_fld_data['Seq'] ]['field']) &&
						!in_array(strtoupper($arr_fld_data['Tipo']), array('EMBUTIDA', 'SUBSELECT', 'IMAGEM', 'FORM_IMAGE_HTML', 'CARTAO', 'IMAGEM', 'ARQUIVO', 'DOCUMENTO_DB', 'DOCUMENTO', 'BAR_CODE', 'QRCODE'))
					   )
					{
						$arr_fld_value['des']['.' . $arr_fld_data['Seq']] = '.' . $arr_fld_data['Campo'];
					}
				}
            }
        }

		//para o tpl body_form_ext_cons_flds_group
		//se passa por nmPageApp
		/* fico por causa da v3 */
        $arr_data['class'] = "nmLineV3";
        /* fim fico por causa da v3 */
        $arr_data['cod']          = $_SESSION['nm_session']['app']['cod'];
        $arr_data['title']        = nm_get_text_lang("['text']['sel_flds_rule_group']");
        $arr_data['desc']         = "";
        $arr_data['error']        = "";
        $arr_data['file_ok']      = TRUE;
        $arr_data['link_icon']    = '';
        $arr_data['name']         = "new_rule_group";
        $arr_data['on_change']    = '';
        $arr_data['on_click']     = '';
        $arr_data['tr_style']     = '';
        $arr_data['tr_display']   = '';
        $arr_data['tr_obs']       = '';
        $arr_data['use_modified'] = TRUE;
		$arr_data['value']        = $arr_fld_value;
		$arr_data['height_div']   = 240;
		$arr_data['allow_move']   = 1;
		$arr_data['ctl_pos']      = 1;
		$arr_data['ctl_stat']     = 1;
		$arr_data['ctl_edit']     = 1;
		$arr_data['arr_fld_tp_sql'] = $arr_fld_tp_sql;
		$nm_template->SetVar('field_data', $arr_data);
		//fim para o tpl body_form_ext_cons_flds_group

        $nm_template->SetVar('arr_rule_group', $arr_rule_group);
        $nm_template->Display('body_rule_group');

        /* Status do menu */
        $nm_template->SetVar('toolbar_object', 'parent.parent');
        $nm_template->SetVar('toolbar_grpcod', $_SESSION['nm_session']['user']['cod_grp']);
        $nm_template->SetVar('toolbar_appcod', $_SESSION['nm_session']['app']['cod']);
        $nm_template->SetVar('toolbar_appfriendly_name', $_SESSION['nm_session']['app']['friendly_name']);
        $nm_template->SetVar('toolbar_apptyp', $_SESSION['nm_session']['app']['type']);
        $nm_template->SetVar('toolbar_appseq', '');
        $nm_template->SetVar('toolbar_appcal', '');
        $nm_template->SetVar('toolbar_other' , '');
        $nm_template->SetVar('toolbar_rlo'   , $rule_group_nome);
        $nm_template->SetVar('toolbar_atz_fld' , 'app');
		$nm_template->Display('body_toolbar_data');

    }// DisplayForm

    /**
     * Retorna botoes.
     *
     * Retorna a lista de botoes da aplicacao
     *
     * @param   string   $nome    nome da regra
     * @access  protected
     */
    function GetRuleGroup($nome)
    {
        return $this->rule_group->RetrieveList($nome);

    }// GetRuleGroup

    /**
     * Salva regra.
     *
     * Salva definicao da regra.
	 *
     * @access  protected
     */
    function SaveRuleGroup($rule_group_nome, $rule_group_label, $rule_group_fields, $rule_group_sc_free_group_by_use, $rule_group_sc_free_group_by_openmode, $rule_group_sc_free_group_by_hide_help_line)
    {
		$this->rule_group->SetData('nome', 		                $rule_group_nome);
        $this->rule_group->SetData('label', 	                $rule_group_label);
    	$this->rule_group->SetData('list_fld', 	                $rule_group_fields);
    	$this->rule_group->SetData('sc_free_group_by_use',      $rule_group_sc_free_group_by_use);
    	$this->rule_group->SetData('sc_free_group_by_openmode', $rule_group_sc_free_group_by_openmode);
    	$this->rule_group->SetData('sc_free_group_by_hide_help_line', $rule_group_sc_free_group_by_hide_help_line);

    	/* Salva dados da regra */
	    if(!empty($rule_group_nome))
	    {
			$this->rule_group->SaveData();
	    }

    }// SaveRuleGroup

   /**
     * Deleta regra.
     *
     * Deleta a regra da base.
     *
     * @param   string 		$nome  Nome da regra
     * @access  protected
     */
    function DelRuleGroup($nome)
    {
    	$this->rule_group->Remove($nome);

    }// DelRuleGroup

    /* ----- Metodos Protegidos ---------------------------------------- */

    /**
     * Exibe o conteudo.
     *
     * Exibe o conteudo da tela inicial do ScriptCase.
     *
     * @access  protected
     * @global  object     $nm_config
     * @global  object     $nm_template
     */
    function DisplayContent()
    {
        global $nm_config, $nm_template, $nm_browser;

        /* Includes */
        include_once $nm_config['path_lib'] . 'php_edit.inc.php';

        /* Seta variaveis com valores da sessao */
        $this->rule_group->SetApplication($_SESSION['nm_session']['user']['cod_grp'],
                                          $_SESSION['nm_session']['app']['cod'],
                                          $_SESSION['nm_session']['user']['cod_ver']);

        /* Inicializa lista de erros */
        $this->InitErrorList();

        /* Dados do formulario */
		$rule_group_nome                       = $this->GetArg('rule_group_nome');
		$rule_group_label                      = $this->GetArg('rule_group_label');
		$rule_group_fields                     = $this->getRuleFields();
		$rule_group_sc_free_group_by_use       = $this->GetArg('rule_group_sc_free_group_by_use');
		$rule_group_sc_free_group_by_openmode  = $this->GetArg('rule_group_sc_free_group_by_openmode');
		$rule_group_sc_free_group_by_hide_help_line  = $this->GetArg('rule_group_sc_free_group_by_hide_help_line');
		

		/* Modo de abertura da pagina */
        $nm_template->SetVar('form_option', $this->GetArg('form_option'));

        /* Valida formulario enviado */
        if ($this->FormSent('edit') || $this->GetArg('form_option') == 'delete_rule_group')
        {
			switch ($this->GetArg('form_option'))
        	{
        		case 'save'; //Salva regra
        		case 'generate';
        		case 'run';
        		case 'build';
					$this->ValidateFormRuleGroup($rule_group_nome, $rule_group_fields);
                    if ($this->IsValid())
                    {
	                    $this->SaveRuleGroup($rule_group_nome, $rule_group_label, $rule_group_fields, $rule_group_sc_free_group_by_use, $rule_group_sc_free_group_by_openmode, $rule_group_sc_free_group_by_hide_help_line);
						$nm_template->SetVar('form_option', 'edit_rule_group');
	                    $this->CheckRedirect();
						$this->MenuReload($rule_group_nome, 'save');
                    }
        		break;

        		case 'add_rule_group':
        		case 'inc_rule_group':
					$this->ValidateFormRuleGroup($rule_group_nome, $rule_group_fields);
        			if ($this->IsValid())
            		{
            			$this->SaveRuleGroup($rule_group_nome, $rule_group_label, $rule_group_fields, $rule_group_sc_free_group_by_use, $rule_group_sc_free_group_by_openmode, $rule_group_sc_free_group_by_hide_help_line);
	        			$this->MenuReload($rule_group_nome, 'add');
			            $this->CheckRedirect();
						$rule_group_nome                      = "";
						$rule_group_label                     = "";
						$rule_group_fields                    = array();
						$rule_group_sc_free_group_by_use      = "";
						$rule_group_sc_free_group_by_openmode = "";
						$rule_group_sc_free_group_by_hide_help_line = "";
        				$nm_template->SetVar('form_option', 'add_rule_group');
            		}
            		/* Exibe criticas */
		            else
		            {
						$nm_template->SetVar('arr_erros',    $this->GetErrors());
	        			$nm_template->SetVar('form_option', 'add_rule_group');
		            }
        		break;
				
				case 'delete_rule_group':
					$this->DelRuleGroup($_GET['rule_group_nome']);
					$nm_template->SetVar('form_option', 'add_rule_group');
					$this->MenuReload($_GET['rule_group_nome'], '', '', 'delete');
					
					$rule_group_nome                      = "";
					$rule_group_label                     = "";
					$rule_group_fields                    = array();
					$rule_group_sc_free_group_by_use      = "";
					$rule_group_sc_free_group_by_openmode = "";
					$rule_group_sc_free_group_by_hide_help_line = "";
					$nm_template->SetVar('form_option', 'add_rule_group');
				break;
        	}
        }
		
		$this->DisplayForm($rule_group_nome, $rule_group_label, $rule_group_fields, $rule_group_sc_free_group_by_use, $rule_group_sc_free_group_by_openmode, $rule_group_sc_free_group_by_hide_help_line);

        /* Gera aplicacao */
		if ('generate' == $this->GetArg('form_option'))
        {
        	$_SESSION['nm_session']['compile_apps_ajax'] = protectAjaxChar($_SESSION['nm_session']['app']['cod']) . '#@#' .
        												   $_SESSION['nm_session']['app']['type'] . '#@#' .
        												   protectAjaxChar($_SESSION['nm_session']['app']['friendly_name']);
        	$nm_template->Display('body_generate_app');
        }
        elseif (('run'   == $this->GetArg('form_option')) ||
                ('build' == $this->GetArg('form_option')))
        {

        	if ($nm_browser->GetAgent() == 'CHROME')
			{
	        	$nm_template->Display('body_popup_test');
			}

			$nm_template->SetVar('cod_app', $_SESSION['nm_session']['app']['cod']);
			$nm_template->SetVar('type',  	$_SESSION['nm_session']['app']['type']);
			$nm_template->SetVar('target',  'nmWinGenExecV7_'  . $nm_config['win_name']);
	        $nm_template->SetVar('friendly_name', $_SESSION['nm_session']['app']['friendly_name']);
			$nm_template->Display('body_generate_code');
        }
    } // DisplayContent

    /**
     * Define funcoes Javascript da pagina.
     *
     * Define a lista de funcoes Javascript especificos da pagina atual.
     *
     * @global  array      $nm_config
     * @access  protected
     */
    function PageJavascript()
    {
    	global $nm_config;

		$str_js = "function nm_form_modified()\n";
		$str_js .= "{\n";
		$str_js .= "    document.form_edit.form_modified.value = 'Y';\n";
		$str_js .= "}\n";
	    $this->AddJavascript($str_js);

        $str_js  = "  function nm_send_form()\n";
        $str_js .= "  {\n";
        $str_js .= "    total = document.forms['form_edit'].elements['chk_fld[]'].length;\n";
        $str_js .= "    has_checked = false;\n";
        $str_js .= "    if(total > 0)\n";
        $str_js .= "    {\n";
        $str_js .= "        for(it=0; it<total; it++)\n";
        $str_js .= "        {\n";
        $str_js .= "            if(document.forms['form_edit'].elements['chk_fld[]'][it].checked)\n";
        $str_js .= "            {\n";
        $str_js .= "                has_checked = true;\n";
        $str_js .= "                break;\n";
        $str_js .= "            }\n";
        $str_js .= "        }\n";
        $str_js .= "    }\n";
        $str_js .= "    if(has_checked)\n";
        $str_js .= "    {\n";
        $str_js .= "        document.form_edit.submit();\n";
        $str_js .= "    }\n";
        $str_js .= "    else\n";
        $str_js .= "    {\n";
        $str_js .= "        alert('". conv_utf8_all(html_entity_decode(nm_get_text_lang("['save_group_list_empty']"))) ."')\n";
        $str_js .= "    }\n";
        $str_js .= "  }\n";
        $this->AddJavascript($str_js);

		$str_js  = "  function nm_edit_save(str_section, mix_param, str_fld_section, str_xml_fld_tag, str_xml_fld_campo)\n";
        $str_js .= "  {\n";
        $str_js .= "   document.form_edit.field_fld_section.value = str_fld_section;\n";
        $str_js .= "   document.form_edit.redirect_to.value      = str_section;\n";
        $str_js .= "   document.form_edit.redirect_param.value   = mix_param;\n";
        $str_js .= "   if (str_xml_fld_tag != null) document.form_edit.field_xml_fld_tag_redir.value   = str_xml_fld_tag;\n";
        $str_js .= "   if (str_xml_fld_campo != null) document.form_edit.field_xml_fld_campo_redir.value = str_xml_fld_campo;\n";
        $str_js .= "   document.form_edit.form_modified.value = \"N\";\n";
        $str_js .= "   document.form_edit.submit();\n";
        $str_js .= "  }\n";
        $this->AddJavascript($str_js);
    }

    /**
     * Define arquivos JS da pagina.
     *
     * Define a lista de arquivos JS especificos da pagina atual.
     *
     * @access  protected
     */
    function PageJs()
    {
        $this->AddJs('thirddevel', 'coolmenupro/coolmenupro.js');
        $this->AddJs('devel', 'ajax.js');
    } // PageJs

    /**
     * Define folhas de estilo da pagina.
     *
     * Define a lista de folhas de estilo especificas da pagina atual.
     *
     * @access  protected
     */
    function PageStyle()
    {
    } // PageStyle

	function getRuleFields()
	{
		$rule_group_fields = $this->GetArg('chk_fld');

		$arr_fields = array();

		if(is_array($rule_group_fields) && !empty($rule_group_fields))
		{
			foreach($rule_group_fields as $key=>$seq)
			{
				$arr_seq = explode('__NM__', $seq);
				list($seq, $campo) = $arr_seq;

				$arr_fields[$seq]['field'] = $campo;
				if($this->IsArg('rad_' . $seq))
				{
					$arr_fields[$seq]['prop'] = $this->GetArg('rad_' . $seq);
				}
			}
		}
		return $arr_fields;
	}

    /**
     * Recarga do menu.
     *
     * @access  protected
     */
    function MenuReload($rule_group_nome, $type)
    {
		$_SESSION['nm_session']['menu']['reload']['open'] = 1;
		
		if($type == 'add' || $type == 'delete')
		{
			$_SESSION['nm_session']['menu']['reload']['node'] = "javascript: nm_add_rule_group()";
		}
		else
		{
			$_SESSION['nm_session']['menu']['reload']['node'] = $rule_group_nome . "&nbsp;<span style='display:none'>". $rule_group_nome ."</span><a title='".nm_get_text_lang("['button_delete']")."' href=\\\"javascript: nm_delete_rule_group('";//ele procura por pedaco da string tambem, n precisa por completo
		}
		
    	echo "<script>";
		echo "parent.id_ifr_left_". $_SESSION['nm_session']['control_abas']['frm_atual'] .".src = parent.id_ifr_left_". $_SESSION['nm_session']['control_abas']['frm_atual'] .".src;";
		echo "</script>";
    }// MenuReload
}
?>
