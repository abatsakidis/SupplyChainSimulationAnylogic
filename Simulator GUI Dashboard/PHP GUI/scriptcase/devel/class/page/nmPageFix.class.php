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
class nmPageFix extends nmPage
{
    /* ----- Construtor e Destrutor ------------------------------------ */

    var $arr_files_fixed;
    var $arr_files_fix;
    var $str_last_version;
    /**
     * Construtor da classe.
     *
     * Seta o nome da pagina a ser exibida.
     *
     * @access  public
     */
    function nmPageFix()
    {
        global $nm_config;
        $this->arr_files_fix = (array_diff(scandir($nm_config['path_lib'] . "fixs/"), array('.', '..')));
        $this->getFixed();
        if(count($this->arr_files_fix) == 0 || count(array_diff($this->arr_files_fix, $this->arr_files_fixed)) == 0)
        {
            $this->writeFixed();
        }
        $this->SetBody('nmPage');
        $this->SetMargin(5);
        $this->SetPage('fix');
        $this->SetPageCode(NM_PAGE_COD_FIX);
        //$this->CheckLogin();
        $this->SetPageSubtitle('');
        $this->SetScroll('auto');
    } // nmPageApp

    /* ----- Metodos Protegidos ---------------------------------------- */

    function writeFixed($arr_files_fixed = '')
    {
        global $nm_config;

        if($arr_files_fixed == '')
        {
            $this->getFixed();
            $arr_files_fixed = $this->arr_files_fixed;
        }
        $arr_files_fixed = serialize($arr_files_fixed);
        $str_last_version = nm_scriptcase_version();
        $content = <<<EOT
<?php
    \$str_last_version      = '{$str_last_version}';
    \$arr_files_fixed   = '{$arr_files_fixed}';
?>
EOT;
        file_put_contents($nm_config['path_scriptcase']. "fixs.php", $content);
    }

    function getFixed()
    {
        global $nm_config;
        if(is_file($nm_config['path_scriptcase']. "fixs.php"))
        {
            include($nm_config['path_scriptcase']. "fixs.php");
            $this->arr_files_fixed  =  unserialize($arr_files_fixed);
            $this->str_last_version     =  $str_last_version;
        }
        else
        {
	        $str_last_version = nm_scriptcase_version();
	        $arr_files_fixed = serialize(array());
	        $content = <<<EOT
	        <?php
	            \$str_last_version      = '{$str_last_version}';
	            \$arr_files_fixed   = '{$arr_files_fixed}';
	        ?>
EOT;
	        file_put_contents($nm_config['path_scriptcase']. "fixs.php", $content);
	        $this->arr_files_fixed  =  array();
	        $this->str_last_version     =  '';
        }
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
        global $nm_config, $arr_files_fix, $nm_template;

        $arr_files_fix = array_diff($this->arr_files_fix, $this->arr_files_fixed);
        $total_patches = count($arr_files_fix);
        $nm_template->SetVar('old_version', $this->str_last_version);
        $nm_template->SetVar('new_version', nm_scriptcase_version());

	    $num_versao_atual = intval(implode("",explode('.',$this->str_last_version)));
        $nm_template->SetVar('total_patches', $total_patches);
        $nm_template->Display('body_fix');
	    nm_print_flush('');
		if($total_patches > 0)
		{
	        foreach($arr_files_fix as $k => $v)
	        {
	            require_once($nm_config['path_lib']. "fixs/". $v);
	            if(!$return)
	            {
	                unset($arr_files_fix[$k]);
	            }
	            elseif(!$nm_config['em_desenv'])
	            {
	                unlink($nm_config['path_lib']. "fixs/". $v);
	            }
	            if($total_patches -1 != $k)
	            {
	                $this->UpdateScreen('mais_um');
	            }
	        }
			$this->writeFixed( array_merge( $this->arr_files_fixed, $arr_files_fix) );
		}

        $this->UpdateScreen('fim');
    } // DisplayContent

    function UpdateScreen($action)
    {
        if($action == 'fim')
        {
            $str_action =  "<script>nm_end_fix();</script>";
        }
        else
        {
            $str_action = "<script>nm_increment_patch();</script>";
        }
        nm_print_flush($str_action);
    }
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
	    $url_scase = nm_url_rand($nm_config['url_iface'] . 'main.php');;
        $str_js = <<<EOT
                function nm_end_fix()
                {
                    $('#id_loading').hide();
                    $('#id_end').show();
                    window.parent.$('#nmFrmScase').load
				    (
				        function()
				        {
				            window.parent.$("#nmFrmScase").show();
                            window.parent.$('#nmFrmScase_fix').slideUp(
                            {
                                complete:function()
                                {
                                    window.parent.$('#nmFrmScase_fix').remove();
                                }
                            });

				        }
				    );

				    window.parent.$('#nmFrmScase').attr('src','{$url_scase}');


                }

                function nm_increment_patch()
                {
                    $('#id_path_now').text( parseInt( $('#id_path_now').text() ) + 1);
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
	    $this->AddStyle("#id_end{display:none;}");
	    $this->AddStyle("#id_overlay_metal{z-index:2002;margin:0px;padding:0px;background-color:#000000;filter: alpha(opacity=80); -khtml-opacity: 0.80; -moz-opacity: 0.80; opacity: 0.80;position: absolute;top:0px;left:0px;width:100%;height:100%;}");
	    $this->AddStyle("#id_loading, #id_end{text-align:center;width:500px; height:200px;z-index:2003; margin: 0 auto;padding:3px;border:1px solid #CECECE; filter: alpha(opacity=100); -khtml-opacity: 1; -moz-opacity: 1; opacity: 1;top:30%;position:absolute;left:38%;background-color: #FFFFFF}");
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
    } // PageStyle
}

?>
