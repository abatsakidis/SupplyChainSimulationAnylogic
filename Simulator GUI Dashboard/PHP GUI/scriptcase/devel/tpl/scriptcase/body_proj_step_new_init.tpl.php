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
if (!defined('SC_LOCKED_VERSION_8976') || ('CARREGADO4536' != SC_LOCKED_VERSION_8976)) {
    die('<br /><span style="font-weight: bold">Fatal error</span>: ' .
        'invalid access to system file.');
}
$arr_data = $this->GetVar('arr_data');

$url_logomarca = explode('__NM__', $arr_data['logomarca']);

switch ($url_logomarca[0]) {
    case 'scriptcase':
        $url_logomarca = $nm_config['url_scriptcase'] . 'img/img/' . $url_logomarca[1];
        break;
    case 'sys':
        $url_logomarca = $nm_config['url_sys'] . 'img/img/' . $url_logomarca[1];
        break;
    case 'grp':
        $url_logomarca = $nm_config['url_grp'] . $_SESSION['nm_session']['user']['cod_grp'] . '/img/img/' . $url_logomarca[1];
        break;
    case 'usr':
        $url_logomarca = $nm_config['url_usr'] . $_SESSION['nm_session']['user']['login'] . '/img/img/' . $url_logomarca[1];
        break;
    default:
        $url_logomarca = $nm_config['url_img'] . "prj_icon_default.gif";
        break;
}

/*                              ---   Encoding   ---                                */

$pg_client_encoding = nm_db_encoding_list('postgres');

$oracle_client_encoding = nm_db_encoding_list('oracle');

$mysql_client_encoding = nm_db_encoding_list('mysql');
//nm_printr($arr_data);
?>
<input type="hidden" name="imported" value="<?php echo (isset($_SESSION['nm_session']['prj']['data']['imported']) ? $_SESSION['nm_session']['prj']['data']['imported'] : ''); ?>" id=""/>
<input type="hidden" name="base" value="" id="base"/>
<input type="hidden" name="friendly_url" value="S"/>
<table border="0" cellpadding="0" cellspacing="2" id="id_new_project">
    <tr>
        <td valign="top" height="100%" class="nmTable" style="border:0px;margin-top:16px;">
            <table id='id_table_content' style="width: 100%" cellpadding="0" cellspacing="0" border="0">
                <tr>
                    <td style="text-align: center;height: 26px;padding: 0px;border-radius: 3px 3px 0px;" class="nmTitle"
                        colspan='3'>
                        <?php echo nm_get_text_lang("['page_title']"); ?>
                        <span style="float:right;padding:0px 3px;"><?php echo $this->GetVar('block_image_help'); ?></span>
                    </td>
                </tr>
                <tr>
                    <td class="nmTitle td_description" colspan='3'>
                        <div style="width: 50%;margin: 0 auto;padding: 6px;">
                            <?php echo nm_get_text_lang("['step_description']['new_init']");?>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td id="id_prj_carrousel" valign="top" width="65%">
                        <?php $this->Display('body_proj_examples'); ?>
                    </td>
                    <td style="vertical-align: top;border-right:1px solid #d8d8d8;border-bottom:1px solid #d8d8d8;border-top:1px solid #d8d8d8">
                        <table style="border-radius: 5px;border:1px solid #d8d8d8;margin-top:16px">
                            <td rowspan="4" height="170" style='margin: 0 auto; text-align:center; vertical-align:top;padding: 6px'>
                                <div id='img_logomarca'>
                                    <img id='img_prj' src="<?php echo $url_logomarca; ?>"
                                         style="border-width: 0px; vertical-align: middle; padding-top:16px; max-width:77px;max-height:165px;"
                                         title="<?php echo $arr_data['logomarca']; ?>"
                                         alt='<?php echo $arr_data['logomarca']; ?>'/>
                                </div>

                                <input type="hidden" class="nmInput" name="logomarca"
                                       value="<?php echo $arr_data['logomarca']; ?>">
                                <br/>
						<span class="nmText" style="white-space: nowrap;margin:5px;">
							<a href="#"
                               onclick="nm_window_image_new('img','form_proj_step', 'logomarca', 'nm_change_img', null, 'grp9usr', 'projetos', false)">
                                <img src="<?php echo $nm_config['url_img']; ?>background.png"
                                     style="border-width: 0px; vertical-align: middle"
                                     title="<?php echo nm_get_text_lang("['hint_icon_img']"); ?>" alt=''/>
                            </a>&nbsp;
							<span id='spn_cancel' style="display:none;">
								<a href="#" onclick="nm_img_default()">
                                    <img src="<?php echo $nm_config['url_img']; ?>button_cancel.gif"
                                         style="border-width: 0px; vertical-align: middle"
                                         title="<?php echo nm_get_text_lang("['hint_img_default']"); ?>" alt=''/>
                                </a>
							</span>
						</span>
                            </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php echo nm_get_text_lang("['prj_lbl_proj']"); ?><br/>
                                    <input type="text" class="nmInput" name="Cod_Prj"
                                           value="<?php echo $arr_data['Cod_Prj']; ?>" size="40" maxlength="32">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php echo nm_get_text_lang("['prj_lbl_desc']"); ?><br/>
                                    <input type="text" class="nmInput" name="Descricao"
                                           value="<?php echo $arr_data['Descricao']; ?>" size="40" maxlength="64">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php echo nm_get_text_lang("['prj_lbl_ver']"); ?><br/>
                                    <input type="text" class="nmInput" name="ver_major"
                                           value="<?php echo $arr_data['ver_major']; ?>" size="3"
                                           style="text-align: right">&nbsp;
                                    <input type="text" class="nmInput" name="ver_minor"
                                           value="<?php echo $arr_data['ver_minor']; ?>" size="3"
                                           style="text-align: right">
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 100%;border-top:1px solid #d8d8d8" colspan="2">
                                    <div id="id_description">
                                        <h1 id="title_desc"><?php echo nm_get_text_lang("['prj_new']"); ?></h1>
                                        <p id="longdesc">
                                            <?php echo nm_get_text_lang("['prj_new_desc']"); ?>
                                        </p>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>

<div id='id_new_db' style='display:none'>
    <div style='text-align:center;'>
        <span style='padding:8px;'><?php echo nm_get_text_lang("['conn']['new_name']"); ?>: <input type="text"
                                                                                                   name="name_create_database"
                                                                                                   value=""
                                                                                                   id="id_name_create_database"/></span>
        <br/><br/>
		<span style='padding:8px;'>
			<input type="button" class='nmButton' name="" value="<?php echo nm_get_text_lang("['conn']['cancel']"); ?>"
                   id="" onclick='$.colorbox.close();'/>&nbsp;
			<input type="button" class='nmButton' name="" value="<?php echo nm_get_text_lang("['conn']['create']"); ?>"
                   id="" onclick='nm_create_database();'/>
		</span>
    </div>
</div>
<script>
    $(document).ready(function () {
        <?php
        if(!$this->GetVar('project_name'))
        {
            if(count($arr_data) == 1)
            {
                echo " nm_new_project('__NEWPROJECT__');";
            }
            elseif(!empty($arr_data['imported']))
            {
                echo "nm_new_project('". $arr_data['imported'] ."');";
            }
            elseif(empty($arr_data['imported']))
            {
                echo " nm_new_project('__NEWPROJECT__');";
            }
            else
            {
                echo "$('.ButtonsBottom').hide(); $('input[name=next]').show();$('input[name=next_step]').val('locales');$('.proj_example').hide();";

            }
        }
        else{
            echo "$('.ButtonsBottom').hide(); $('input[name=next]').show();$('input[name=next_step]').val('locales');$('.proj_example').hide();";
        }
        ?>
    });
</script>
<div id="div_choose_image_<?php echo $_SESSION['nm_session']['control_abas']['frm_atual']; ?>" style="height: 100%; display:none">
	<iframe id="iframe_choose_image_<?php echo $_SESSION['nm_session']['control_abas']['frm_atual']; ?>" frameborder="0" style="border-style: none; border-width: 0px; height: 100%; width:100%;border-radius:5px;" src="index.html"></iframe>
</div>