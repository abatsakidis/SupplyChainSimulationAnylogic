<?php
/**
 * Classe MenuAppVisual.
 *
 * Classe para manipulacao de dados gerais do menu.
 *
 * @package     Classes
 * @subpackage  Interface
 * @creation    2004/01/26
 * @copyright   NetMake Solucoes em Informatica
 * @author      Diogo Silva Toscano De Brito <diogo@netmake.com.br>
 *
 * $Id: nmMenuAppToolbarMenu.class.php,v 1.4 2011-10-25 18:39:36 luis Exp $
 */


/* Protecao contra hacks */
if (!defined('SC_LOCKED_VERSION_8976') || ('CARREGADO4536' != SC_LOCKED_VERSION_8976))
{
    die('<br /><span style="font-weight: bold">Fatal error</span>: ' .
        'invalid access to system file.');
}

/* Classes ancestrais */
nm_load_class('interface', 'MenuApp');

/* Definicao da classe */
class nmMenuAppToolbarMenu extends nmMenuApp
{
    /* ----- Construtor e Destrutor ------------------------------------ */

    /**
     * Construtor da classe.
     *
     * Inicializa objeto.
     *
     * @access  public
     */
    function nmMenuAppToolbarMenu()
    {
        $this->SetTable('tab_apl');
        $this->SetCodField('Cod_Apl');
        $this->SetFields(array('toolbarMenu' =>
                               array(
                                      'toolbarmenu',
                                      'SchemaAll'
                                    )
                              )
                        );
    } //
}

?>