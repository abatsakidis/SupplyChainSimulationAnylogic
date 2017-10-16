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
 * @author      Diogo Silva Toscano De Brito <diogo@netmake.com.br>
 * @author      Juliano Mesquita dos Santos <juliano@netmake.com.br>
 *
 * $Id: body_proj_new_step1.tpl.php,v 1.17 2012-01-23 18:46:22 diogo Exp $
 */

/* Protecao contra hacks */
if (!defined('SC_LOCKED_VERSION_8976') || ('CARREGADO4536' != SC_LOCKED_VERSION_8976))
{
    die('<br /><span style="font-weight: bold">Fatal error</span>: ' .
        'invalid access to system file.');
}
//$arr_data			=	$this->GetVar('arr_data');
$old_version				=	$this->GetVar('old_version');
$new_version				=	$this->GetVar('new_version');
$total_patches				=	$this->GetVar('total_patches');

?>
<div id='id_overlay_metal'></div>
<div id='id_loading'>
	<img src="<?php echo $nm_config['url_img']; ?>ajax-loader.gif" alt="Loading..." title="Loading..."  /><br/>
	<span>Executando patches de corre&ccedil;&otilde;es da vers&atilde;o <?php echo $old_version;?> para a vers&atilde;o <?php echo $new_version; ?></span>
	<p> <span id='id_path_now'>1</span>/<?php echo $total_patches; ?> patches	</p>
</div>
<div id='id_end'>
	Finalizado!
</div>
