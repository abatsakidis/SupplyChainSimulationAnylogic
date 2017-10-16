<?php
/**
 * Template scriptcase.
 *
 * Criar novo projeto
 *
 * @package     Template
 * @subpackage  Scriptcase
 * @creation    2012/04/23
 * @copyright   NetMake Solucoes em Informatica
 * @author      Vinícius Muniz Macêdo <vinicius@netmake.com.br>
 *
 * $Id: body_proj_new_step1.tpl.php,v 1.17 2012-01-23 18:46:22 diogo Exp $
 */

/* Protecao contra hacks */
if (!defined('SC_LOCKED_VERSION_8976') || ('CARREGADO4536' != SC_LOCKED_VERSION_8976))
{
    die('<br /><span style="font-weight: bold">Fatal error</span>: invalid access to system file.');
}
	$arr_systems = $this->GetVar('arr_systems');
	nm_load_class('interface', 'Group');
	$obj_grp = nmGroup::singleton();
	$next_prj = $obj_grp->GetNextProjectName('project');
    $new_project_lang = nm_get_text_lang("['prj_new']");
    $new_project_desc_lang = nm_get_text_lang("['prj_new_desc']");
	$str_arr_systems = <<<EOT
	var arr_systems = { '__NEWPROJECT__' :
	{
		display_name	: '{$new_project_lang}',
		description		: '{$new_project_desc_lang}',
		next_prj		: '{$next_prj}',
		image			: ''
	}
EOT;
?>
<table border="0" cellpadding=0 cellspacing=0 class="nmTable" width="100%" height="100%" style="border:0px">
    		<tr style="display:none" id="id_update_msg">
    			<td height="135" align="center" class="nmTextTitle" valign="top">
					<?php echo nm_get_text_lang("['templates_update_msg']"); ?> &nbsp;&nbsp; <img src="<?php echo $nm_config['url_img']; ?>ajax_load1.gif" border="0" />
    			</td>
    		</tr>
    		<tr>
    			<td height="135" id="id_all_systems" valign="top">
							<div id="is___NEWPROJECT__" class="bgSystems">
								<a href="javascript: nm_new_project('__NEWPROJECT__');">
									<img src="<?php echo $nm_config['url_img'] . 'prj_icon_new_project.png'; ?>" border="0" alt="<?php echo nm_get_text_lang("['prj_new']"); ?>" title="<?php echo nm_get_text_lang("['prj_new']"); ?>">
									<br />
									<div class="nmText"><?php echo nm_get_text_lang("['prj_new']"); ?></div>
								</a>
							</div>
					    <?php
					    if(is_array($arr_systems) && !empty($arr_systems)):

							foreach ($arr_systems as $order => $arr_sys):

								foreach ($arr_sys as $dir_sys => $system):
									$str_style_image = empty($system['image_style'])?"":"style=\"". $system['image_style'] ."\"";
									$str_style_title = empty($system['display_name_style'])?"":"style=\"". $system['display_name_style'] ."\"";
									$next_prj = $obj_grp->GetNextProjectName($system['cod_grp']);
									$sql = strtr(implode(',',$system['sql']), array('.zip' => ''));
									$str_arr_systems .= <<<EOT
,
'{$dir_sys}' :
{
	display_name	: '{$system['display_name']}',
	description	: '{$system['description']}',
	next_prj	: '{$next_prj}',
	image		: '{$system['image']}',
	sql		: '{$sql}'
}
EOT;
									?>
							    		<div id="is_<?php echo $dir_sys; ?>" class="bgSystems">
							    			<a href="javascript: nm_new_project('<?php echo $dir_sys; ?>');" style="top: 5px; ">
												<img src="<?php echo $nm_config['url_ex_systems'] . $dir_sys . '/' . $system['image']; ?>" border="0" alt="<?php echo $system['description']; ?>" title="<?php echo $system['description']; ?>" <?php echo $str_style_image; ?>>
												<br />
												<div class="nmText" <?php echo $str_style_title; ?>><?php echo $system['display_name']; ?> - <?php echo $system['version']; ?></div>
											</a>
										</div>
									<?php
							    endforeach;
						    endforeach;
					    endif;
					    ?>
    			</td>
    		</tr>
    	</table>
    	<script>
			<?php echo $str_arr_systems . "};"; ?>
    	</script>