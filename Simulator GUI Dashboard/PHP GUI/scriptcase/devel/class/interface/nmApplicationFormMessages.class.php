<?php
/**
 * Classe ApplicationFormNavigation.
 *
 * Classe para manipulacao da navegacao de um formulario.
 *
 * @package     Classes
 * @subpackage  Interface
 * @creation    2006/03/20
 * @copyright   NetMake Solucoes em Informatica
 * @author      Juliano Mesquita dos Santos <juliano@netmake.com.br>
 *
 * $Id: nmApplicationFormNavigation.class.php,v 1.1.1.1 2011-05-12 20:30:48 diogo Exp $
 */

/* Protecao contra hacks */
if (!defined('SC_LOCKED_VERSION_8976') || ('CARREGADO4536' != SC_LOCKED_VERSION_8976))
{
    die('<br /><span style="font-weight: bold">Fatal error</span>: ' .
        'invalid access to system file.');
}

/* Classes ancestrais */
nm_load_class('interface', 'Application');

/* Definicao da classe */
class nmApplicationFormMessages extends nmApplication
{
    /* ----- Construtor e Destrutor ------------------------------------ */

    /**
     * Construtor da classe.
     *
     * Inicializa objeto.
     *
     * @access  public
     */
    function nmApplicationFormMessages()
    {
        $this->SetTable('tab_apl');
        $this->SetCodField('Cod_Apl');
        $this->SetFields(array('messages' =>
                               array(
                                     'msg_rs_vazio',
                                     'msg_pk_violation',
                                     'msg_uk_violation',
                                    ),
							   'messages_insert' =>
                               array(
                                     'redir_msg_ins',
                                     'confirm_msg_ins',
                                    ),
                              'messages_update' =>
                               array(
                                     'redir_msg_upd',
                                     'confirm_msg_upd',
                                    ),
                              'messages_delete' =>
                               array(
                                     'redir_msg_del',
                                     'confirm_msg_del',
                                    )
                              )
                        );
    } // nmApplicationFormMessages
}

?>