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
	$arr_connections	=	$this->GetVar('arr_connections');
	$selected = "checked='checked'";

	foreach($arr_connections as $str_name_conn => $arr_data)
	{
	    ?>
		<label class='listDatabase'>
		    <input type="radio" name="conn_db" value="<?php echo $str_name_conn; ?>" <?php echo $selected ?> /><?php echo $str_name_conn; ?>
		    <div class='tip' >
			<h3><?php echo $str_name_conn; ?></h3>
			SGBD: <?php echo $arr_data['dbms'] ?><br/>
			Host: <?php echo nm_crypt_decode($arr_data['host']); ?><br/>
			Base: <?php echo nm_crypt_decode($arr_data['base']); ?><br/>
		    </div>
		</label>
		<br/>
	    <?php
	    $selected = '';
	}
?>
