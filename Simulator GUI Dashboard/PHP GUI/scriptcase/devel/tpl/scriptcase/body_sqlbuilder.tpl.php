<?php
/**
 * Template scriptcase.
 *
 * Criar novo projeto
 *
 * @package     Template
 * @subpackage  Scriptcase
 * @creation    2006/03/07
 * @copyright   NetMake Solucoes em Informatica
 * @author      Vinicius Muniz <vinicius@netmake.com.br>
 *
 * $Id: body_proj_new_step1.tpl.php,v 1.17 2012-01-23 18:46:22 diogo Exp $
 */

/* Protecao contra hacks */
if (!defined('SC_LOCKED_VERSION_8976') || ('CARREGADO4536' != SC_LOCKED_VERSION_8976))
{
    die('<br /><span style="font-weight: bold">Fatal error</span>: ' .
        'invalid access to system file.');
}
?>
<div id='id_loading'>
	<img src="<?php echo $nm_config['url_img']; ?>ajax-loader.gif" alt="Loading..." title="Loading..."  style='position:absolute; margin:0 auto; top: 45%; left: 49%'/>
</div>
<div id='content'>
	<ul>
		<li><a href="#database">Database</a></li>
		<li><a href="#tables">Tables</a></li>
		<li><a href="#fields">Fields</a></li>
		<li><a href="#run">Run</a></li>
		<li><a href="#saved">Saved</a></li>
	</ul>
	<div id='database'></div>
	<div id='tables'></div>
	<div id='fields'></div>
	<div id='run'></div>
	<div id='saved'></div>

</div>
