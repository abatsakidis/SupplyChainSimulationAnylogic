<?php
/**
 * Regra de Ordenação.
 *
 * Gerenciador de regras de ordenações.
 *
 * @package     Sistema
 * @subpackage  Interface
 * @creation    2006/05/08
 * @copyright   NetMake Solucoes em Informatica
 * @author      Juliano Mesquita dos Santos <juliano@netmake.com.br>
 *
 * $Id: rule_order.php,v 1.1.1.1 2011-05-12 20:31:07 diogo Exp $
 */

/* Protecao contra hacks */
define('NM_SCASE_LEVEL',  2);
define('NM_SCASE_MODE',   'GUI');
define('SC_LOCKED_VERSION_8976',  'CARREGADO4536');

/* Definicao da pagina a ser exibida */
$str_page = 'RuleGroup';

/* Processo de exibicao da pagina */
include_once('../lib/php/base_ini.inc.php');
include_once('../lib/php/base_end.inc.php');

?>
