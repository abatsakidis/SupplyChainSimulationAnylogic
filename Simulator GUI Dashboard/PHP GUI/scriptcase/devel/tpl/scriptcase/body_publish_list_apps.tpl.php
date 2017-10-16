<?php
/**
 * Template scriptcase.
 *
 * Tela com os botoes de navegacao
 *
 * @package     Template
 * @subpackage  Scriptcase
 * @creation    2012/07/10
 * @copyright   NetMake Solucoes em Informatica
 * @author      Vinicius Muniz<vinicius@netmake.com.br>
 *
 * $Id: body_publish_wizard_header.tpl.php,v 1.2 2012-01-25 18:41:50 vinicius Exp $
 */

/* Protecao contra hacks */
if (!defined('SC_LOCKED_VERSION_8976') || ('CARREGADO4536' != SC_LOCKED_VERSION_8976))
{
    die('<br /><span style="font-weight: bold">Fatal error</span>: ' .
        'invalid access to system file.');
}

$arr_apps = $this->GetVar('arr_apps');
?>
		<table class="nmTable" width='100%' height='100%'>
			<tr>
				<td class="nmTitle"><?php echo nm_get_text_lang("['page_title']"); ?></td>
				<td class="nmTitle nmHelp"><?php echo $this->GetVar('block_image_help'); ?></td>
			</tr>
			<tr>
				<td colspan='2'>
						<style>
							#id_table_apps tr:hover{background-color:#E5E5E5}
						</style>
						<table class='nmTable tablesorter' width='100%' id='id_table_apps' id='id_table_apps'>
							<thead>
								<tr>
									<th><input type="checkbox" onclick="mark('.chkApps', (this.checked? 'all': ''))"  /></th>
									<th></th>
									<th style='width:140px'>Application</th>
									<th style='width:140px;white-space:pre-wrap;'>Description</th>
									<th>Folder</th>
									<th>Status</th>
									<th>Connection</th>
									<th>Update Date</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($arr_apps as $k => $app): ?>
								<tr>
									<td><input type="checkbox" name="<?php echo $k ?>" value="S"  class='chkApps <?php echo ($app['outdated'] == 'S' ? 'outdated' : ''); ?>' data-rel='<?php echo $app['Tipo_Apl']; ?>' /></td>
									<td><img src="<?php echo $nm_config['url_img']. 'app_'. $app['Tipo_Apl']; ?>.png" /></td>
									<td><?php echo $app['Cod_Apl']; ?></td>
									<td><?php echo $app['Descricao']; ?></td>
									<td><?php echo $app['Folder']; ?></td>
									<td><?php echo ($app['outdated'] == 'S'? "<span style='color:red;'>outdated</span>" : 'updated'); ?></td>
									<td><?php echo $app['NomeConexao']; ?></td>
									<td><?php echo (!empty($app['Data_Uacc']) ? nm_format_date_by_lang($app['Data_Uacc'], $_SESSION['nm_session']['status']['lang']) : ''); ?></td>
								</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
				</td>
			</tr>
			<tr><td colspan='2'>&nbsp;</td></tr>
		</table>
		<div id='id_compile'></div>
