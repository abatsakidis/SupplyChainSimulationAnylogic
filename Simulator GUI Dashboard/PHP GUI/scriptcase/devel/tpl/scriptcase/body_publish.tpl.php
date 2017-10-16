<?php
/**
 * Template scriptcase.
 *
 * Tela com os botoes de navegacao
 *
 * @package     Template
 * @subpackage  Scriptcase
 * @creation    2008/12/01
 * @copyright   NetMake Solucoes em Informatica
 * @author      Diogo Silva Toscano De Brito <diogo@netmake.com.br>
 *
 * $Id: body_publish_wizard_header.tpl.php,v 1.2 2012-01-25 18:41:50 vinicius Exp $
 */

/* Protecao contra hacks */
if (!defined('SC_LOCKED_VERSION_8976') || ('CARREGADO4536' != SC_LOCKED_VERSION_8976))
{
    die('<br /><span style="font-weight: bold">Fatal error</span>: ' .
        'invalid access to system file.');
}

$arr_apps_js = $this->GetVar('arr_apps_js');
?>
<style>
	.pagePublish{ margin: 0 auto; width:40%; display:none;padding:20px; height:300px}
	.pagePublish:first-child{display:block;}
	.pagePublish:nth-child(2){width:60%;}
	.nmHelp { text-align:right;padding:0px 3px; }
	.normalButtons{position:relative;top:-45px;width:180px; margin:0 auto; text-align:center;}
	.appButtons{position: fixed; height:20px; width:100%;  bottom:0; background-color:#F0F2F5; text-align:center; padding:3px;border-top:1px solid #959595;}
	#id_back {display:none;}
	#pub_advanced, #id_pub_usar{ display:none; padding:10px; }
	#id_table_apps{padding:20px;}
	#id_table_apps tr td{border-bottom:1px solid #F0F2F5; cursor:pointer}
	#id_table_apps:nth-child(1){width:4px;}
	#id_folder{display:none; padding:10px;}
	#id_ftp{display:none; padding:10px;}
</style>
<script type="text/javascript">var arr_apps = <?php echo $this->GetVar('arr_apps_js'); ?></script>
<form name="form_edit" action="<?php echo $nm_config['url_iface']; ?>publishwizard.php" method="post" target="_self">

	<div id='page_1' class='pagePublish'>
		<table class="nmTable" width='100%' height='100%'>
			<tr>
				<td class="nmTitle"><?php echo nm_get_text_lang("['page_title']"); ?></td>
				<td class="nmTitle nmHelp"><?php echo $this->GetVar('block_image_help'); ?></td>
			</tr>
			<tr>
				<td colspan='2'>
					<table align='center' style='padding:20px 0px;'>
						<tr>
							<td><input id='id_all_apps' type="radio" name="mode_apps" value="all" checked='checked'/></td>
							<td><label for='id_all_apps'>All Applications</label></td>
						</tr>
						<tr>
							<td><input id='id_selected_apps' type="radio" name="mode_apps" value="selected" /></td>
							<td><label for='id_selected_apps'>Selected Applications</label></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</div>

	<div id='page_2' class='pagePublish'></div>

	<div id='page_3' class='pagePublish'>
		<table class="nmTable" width='100%' height='100%'>
			<tr>
				<td class="nmTitle"><?php echo nm_get_text_lang("['page_title']"); ?></td>
				<td class="nmTitle nmHelp"><?php echo $this->GetVar('block_image_help'); ?></td>
			</tr>
			<tr>
				<td colspan='2'>
					<p class="nmText">What type of deployment would you like to use?</p>

					<div class="nmText">
						<label><input type="radio" name="pub_type" value="T" checked='checked' > Typical (recommended)</label><br/>
						<label><input type="radio" name="pub_type" value="A" > Advanced</label>
					</div>

					<div id='pub_advanced'>
						<label><input name="pub_usar" value="S" checked="checked" type="radio" onclick="toggleDiv('#id_pub_usar', true);">Use an existent Template</label>

						<div id="id_pub_usar">
							Template &nbsp;
							<select name="pub_esquema" class="nmInput">

							</select>&nbsp;
							<a href="javascript:ajax_del_schema('pub_esquema')">
								<img src="<?php echo $nm_config['url_img']; ?>trash.png" title="Delete select Template" align="middle" border="0">
							</a>
							<a href="javascript:setPublishDirec('dir_dados');">
								<img src="<?php echo $nm_config['url_img']; ?>publish.gif" title="Instantly Deployment" align="middle" border="0">
							</a>
						</div>
					  <br/><label><input name="pub_usar" value="N" type="radio" onclick="toggleDiv('#id_pub_usar', false);"> Create new deployment template</label>
					</div>
				</td>
			</tr>
			<tr><td colspan='2'>&nbsp;</td></tr>
		</table>
	</div>
<div id='page_4' class='pagePublish'>
		<table class="nmTable" width='100%' height='100%'>
			<tr>
				<td class="nmTitle"><?php echo nm_get_text_lang("['page_title']"); ?></td>
				<td class="nmTitle nmHelp"><?php echo $this->GetVar('block_image_help'); ?></td>
			</tr>
			<tr>
				<td colspan='2'>
					<p class="nmText">Deploy type</p>
					<label><input id='id_type_pub_zip' class='nmInput' type="checkbox" name="type_pub[]" value="zip" checked='checked'/>Zip</label><br/>
					<label><input id='id_type_pub_folder' class='nmInput' type="checkbox" name="type_pub[]" value="folder" />Folder</label><br/>
						<div id='id_folder'>
							<table>
								<tr>
									<td>Folder</td>
									<td><input class='nmInput' type="text" name="folder" value="" id="" /></td>
								</tr>
							</table>
						</div>
					<label><input id='id_type_pub_ftp'  class='nmInput' type="checkbox" name="type_pub[]" value="ftp" />FTP</label>
						<div id='id_ftp'>
							<table>
								<tbody>
									<tr>
										<td>Server</td>
										<td><input class='nmInput' type="text" name="ftp_server" value="" id="" /></td>
									</tr>
									<tr>
										<td>User</td>
										<td><input class='nmInput' type="text" name="ftp_user" value="" id="" /></td>
									</tr>
									<tr>
										<td>Password</td>
										<td><input class='nmInput' type="password" name="ftp_password" value="" id="" /></td>
									</tr>
									<tr>
										<td>Folder</td>
										<td><input class='nmInput' type="text" name="ftp_folder" value="" id="" /></td>
									</tr>
								</tbody>
							</table>
						</div>
				</td>
			</tr>
			<tr><td colspan='2'>&nbsp;</td></tr>
		</table>
	</div>
	<div id='id_buttons' class='normalButtons'>
		<input type="button" class='nmButton' name="back" value="<?php echo nm_get_text_lang("['button_back']"); ?>" id="id_back" onclick="nm_page('back');"/>
		<input type="button" class='nmButton' name="next" value="<?php echo nm_get_text_lang("['button_proceed']"); ?>" id="id_next" onclick="nm_page('next');"/>
	</div>

</form>
