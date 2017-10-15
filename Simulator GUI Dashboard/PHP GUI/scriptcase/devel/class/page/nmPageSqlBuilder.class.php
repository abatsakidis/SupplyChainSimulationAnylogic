<?php
/**
 * Classe PageNome. substituir Nome pelo nome da pagina
 *
 * Descricao da pagina.
 *
 * @package     Classes
 * @subpackage  Page
 * @creation    data de criacao
 * @copyright   NetMake Solucoes em Informatica
 * @author      nome <email>
 *
 * $Id: nmPageVazia.class.php,v 1.1.1.1 2011-05-12 20:30:54 diogo Exp $
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
class nmPageSqlBuilder extends nmPage
{
    /* ----- Construtor e Destrutor ------------------------------------ */

    /**
     * Construtor da classe.
     *
     * Seta o nome da pagina a ser exibida.
     *
     * @access  public
     */
    function nmPageSqlBuilder()
    {
        $this->SetBody('nmPage');
        $this->SetMargin(5);
        $this->SetPage('SqlBuilder');
        $this->CheckLogin();
        $this->nm_ajax();
        //$this->SetPageCode(NM_PAGE_COD_NOMEDAPAGINA);

        $this->SetPageSubtitle('');
        $this->SetScroll('auto');
    } // nmPageApp

    /* ----- Metodos Protegidos ---------------------------------------- */

    function nm_ajax()
    {
        global $nm_config, $nm_template;
		if(!isset($_POST['nm_ajax']) ||  $_POST['nm_ajax'] != 1 || !isset($_POST['nm_option']))
		{
			return;
		}

        nm_load_class('interface', 'Connection');
		switch($_POST['nm_option'])
		{
            case 'database':
                $arr_conn = nmConnection::singleton($_SESSION['nm_session']['user']['cod_grp'])->GetAllConnections();
                //nm_printr($arr_conn);
                $nm_template->SetVar('arr_connections', $arr_conn);
                $nm_template->Display('body_sqlbuilder_db');
            break;

            case 'tables':
                $arr_tables = nm_db_tables($_POST['conn_db'], __FILE__, __LINE__);
				$charset = $this->getCharset();
				foreach($arr_tables as $k => $v)
				{
					$arr_tables[$k] = conv_utf8_all($v, $charset);
				}
				$nm_template->SetVar('arr_tables', $arr_tables );
                $nm_template->Display('body_sqlbuilder_table');
            break;

            case 'fields':
            break;

            case 'run':
            break;

            case 'saved':
            break;
        }
        exit;
    }
    /**
     * Exibe o conteudo.
     *
     * Exibe o conteudo da tela inicial do ScriptCase.
     *
     * @access  protected
     */
    function DisplayContent()
    {
        global $nm_template;

        $nm_template->Display('body_sqlbuilder');
    } // DisplayContent

    /**
     * Define funcoes Javascript da pagina.
     *
     * Define a lista de funcoes Javascript especificos da pagina atual.
     *
     * @access  protected
     */
    function PageJavascript()
    {
        global $nm_config;

        $str_lang_select_database   = "Para continuar se faz necessário selecionar uma conexão";
        $str_lang_select_table      = "Para continuar se faz necessário selecionar ao menos uma tabela";
        $str_js = <<<EOT
            var nm_url = "{$nm_config['url_iface']}sqlbuilder.php";
            $(document).ready(function(){
                $('#content').tabs();
                $("a").click(function(){
                    openTab( $(this).attr('href') );
                });
                openTab('#database');

            });

            function openTab(url)
            {
                nm_open_loading();
                var arr_data;
                var function_afterLoad = function(){ return true; };
                var function_beforeLoad = function(){ return true; };
                switch(url)
                {
                    case '#database':
                        arr_data = {nm_ajax : 1 , nm_option : 'database'};
                        function_afterLoad = function(){
                            $('.listDatabase').hover(function(){
                                $(this).children(".tip").show();
                            },function()
                            {
                                $(this).children(".tip").hide();
                            });

                            if($('input[name=conn_db]').size() == 1)
                            {
                                openTab('#tables');
                            }
                        }
                    break;

                    case '#tables':
                        function_beforeLoad = function()
                        {
                            if($('input[name=conn_db]').val() == '')
                            {
                                alert("{$str_lang_select_database}");
                                $('#database').click();
                                return false;
                            }
                            return true;
                        };
                        arr_data = {nm_ajax : 1 , nm_option : 'tables', conn_db : $('input[name=conn_db]:checked').val() };

                    break;

                    case '#fields':
                        function_beforeLoad = function()
                        {
                            if($('input[name=table]').val() == '')
                            {
                                $('#tables').click();
                                alert("{$str_lang_select_table}");
                                return false;
                            }
                            return true;
                        };

                        arr_data = {nm_ajax : 1 , nm_option : 'fields', tables: $('input[name=table]').val()};
                    break;

                    case '#run':
                        arr_data = {nm_ajax : 1 , nm_option : 'run'};
                    break;

                    case '#saved':
                        arr_data = {nm_ajax : 1 , nm_option : 'saved'};
                    break;

                    default:
                        return;
                    break;
                }
                if(!function_beforeLoad())
                {
                    nm_close_loading();
                    return false;
                }
                $( url ).load(nm_url, arr_data, function(){
                        function_afterLoad();
                        nm_close_loading();
                    });
            }


            function nm_open_loading()
            {
                $('#id_loading').show();
            }


            function nm_close_loading()
            {
                $('#id_loading').fadeOut();
            }


EOT;
        $this->addJavascript($str_js);
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
        $this->AddJs('third', 'jquery/js/jquery-ui.js');
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
        global $nm_config;
        $str_style = <<<EOT
        #id_loading{ display:none; position: fixed; z-index: 3000; top: 0; left: 0; height: 100%; width: 100%; background-color: #000; filter: alpha(opacity=5); -moz-opacity: 0.5; opacity: 0.5; cursor:progress;}
        div.tip {  display:none; z-index: 100; position: absolute; min-width: 40px; padding: 3px 7px 4px 6px; border: 1px solid #336; background-color: #f7f7ee; font: normal 0.9em/1.2em arial, helvetica, sans-serif; text-align: left; color: #000; left:120px;}
EOT;
        $this->AddStyle($str_style);

    } // PageStyle

    /**
     * Define folhas de estilo da pagina.
     *
     * Define a lista de folhas de estilo especificas da pagina atual.
     *
     * @access  protected
     */
    function PageStyleCss()
    {
        $this->AddStyleCss('third', 'jquery/css/smoothness/jquery-ui.css');
    } // PageStyle


    function getCharset()
    {
		nm_load_class('interface', 'Group');
		$obj_grupo = nmGroup::singleton($_SESSION['nm_session']['user']['cod_grp']);
		$arr_lang_charset = get_lang_charset('', '', $obj_grupo->GetData('locale_default'), $obj_grupo->GetData('locales'), $obj_grupo->GetData('locales_charset'));

		return $arr_lang_charset['charset'];
	}
}

?>
