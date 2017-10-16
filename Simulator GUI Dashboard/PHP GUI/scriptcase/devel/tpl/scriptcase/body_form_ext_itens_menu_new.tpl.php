<?php
/**
 * Template scriptcase.
 *
 * Cabecalho do template scriptcase.
 *
 * @package     Template
 * @subpackage  Scriptcase
 * @creation    2004/01/28
 * @copyright   NetMake Solucoes em Informatica
 * @author      Diogo Silva Toscano De Brito <diogo@ipadnet.com.br>
 *
 * $Id: body_form_ext_itens_menu_new.tpl.php,v 1.13 2012-01-24 14:11:28 luis Exp $
 */

/* Protecao contra hacks */
if (!defined('SC_LOCKED_VERSION_8976') || ('CARREGADO4536' != SC_LOCKED_VERSION_8976))
{
    die('<br /><span style="font-weight: bold">Fatal error</span>: ' .
        'invalid access to system file.');
}

$str_form_modif = ('' == $nm_config['form_modif']) ? 'null' : $nm_config['form_modif'];
?>

<tr>
<td colspan="3">

<?php

$sMenuEditorName = '__nm_fld__menus';
$iUltimoId       = 0;
function preparaItensEditorMenu(&$aMenu, $aItens, $iNivel, &$iUltId)
{
    if (is_array($aItens))
    {
        foreach ($aItens as $aItemDados)
        {
            if (isset($aItemDados['label']))
            {
                $aMenu[] = array(
                    'label'  => $aItemDados['label'],
                    'level'  => $iNivel,
                    'link'   => $aItemDados['link'],
                    'hint'   => $aItemDados['hint'],
                    'id'     => '',
                    'icon'   => $aItemDados['icon_on'],
                    'target' => $aItemDados['target'],
                    'sc_id'  => $aItemDados['id'],
                );
                if (isset($aItemDados['menu_itens']) && !empty($aItemDados['menu_itens']))
                {
                    preparaItensEditorMenu($aMenu, $aItemDados['menu_itens'], $iNivel + 1, $iUltId);
                }

                $iThisId = substr($aItemDados['id'], 5);
                $iUltId  = max($iUltId, $iThisId);
            }
        }
    }
}

$arr_data  = $this->GetVar('field_data');
$array_menus = $arr_data['value'];

$aMenuEditorItens = array();
preparaItensEditorMenu($aMenuEditorItens, $array_menus, 0, $iUltimoId);
//print_r("<pre>"); print_r($arr_data['icon_list']); print_r("</pre>"); exit;
?>
    
  <script type="text/javascript">
   function scFinalizaMenu()
   {
   }
   function scReceiveIcon()
   {
    if ($.scMenuEditorData)
    {
     $.scMenuEditorData.menu._updateItem();
     return;
    }
   }
  </script>
  <script type="text/javascript" src="<?php echo $nm_config['url_js_devel']; ?>jquery.scMenuEditor.js"></script>
  <link id="sc-js-menu-rel" rel="stylesheet" href="<?php echo $arr_data['css_theme']; ?>" type="text/css" />
  <style type="text/css">
   * {
    font-size:100%;
    font-family: inherit;
   }
   input, select, .sc-ui-menu-text, .sc-ui-menu-item {
    font-family: Tahoma, Arial, sans-serif;
    font-size: 12px;
   }
   .sc-ui-menu-icon-link:hover {
    cursor: pointer;
   }
   .sc-ui-menu-hr {
    border-style: dotted;
    border-width: 1px 0 0 0;
   }
   .sc-ui-menu-leftpanel {
    float: left;
    width: 264px;
   }
   .sc-ui-menu-header {
    font-size: 13px;
    font-weight: bold;
   }
   .sc-ui-menu-toolbar {
    list-style: none;
    height: 30px;
    margin: 0 1px;
    padding: 2px 2px 0 2px;
    border-style: solid;
    border-width: 1px;
   }
   .sc-ui-menu-toolbar li {
    display: block;
    float: left;
    height: 24px;
    width: 24px;
    margin: 1px;
    padding: 2px 0;
   }
   .sc-ui-menu-toolbar-button {
    border: 0;
   }
   .sc-ui-menu-toolbar-button:hover {
    cursor: pointer;
   }
   .sc-ui-menu-itemtree {
    overflow: scroll;
    height: 190px;
    width: 260px;
    margin: 0 1px;
    border-style: solid;
    border-width: 0 1px 1px 1px;
   }
   .sc-ui-menu-itemtree ul {
    list-style: none;
    margin: 0;
    padding: 0;
   }
   .sc-ui-menu-item {
    border-color: #ffffff #fbfbfb #e8e8e8 #f4f4f4;
    border-style: solid;
    border-width: 1px 0;
    background-color: #f8f8f8;
    white-space: nowrap;
   }
   .sc-ui-menu-itemsel {
    background-color: #406050;
    color: #fff;
   }
   .sc-ui-menu-centerpanel {
    margin: 0 1px;
    float: left;
   }
   .sc-ui-menu-itemdata {
    margin: 0;
    float: left;
    width: 175px;
    padding: 4px;
    border-style: solid;
    border-width: 1px;
   }
   .sc-ui-menu-rightpanel {
    margin: 0 1px;
    float: left;
   }
   .sc-ui-menu-style {
    margin: 0;
    float: left;
    padding: 4px;
    min-width: 200px;
    border-style: solid;
    border-width: 1px;
   }
   .sc-ui-menu-templates {
    overflow: auto;
    float: right;
   }
   .sc-ui-menu-template-list {
    display: none;
   }
   .sc-ui-menu-preview {
    clear: both;
    padding: 6px 3px 3px 3px;
    font-size: 13px;
    font-weight: bold;
   }
   .sc-ui-menu-example {
    clear: both;
    padding: 6px 3px 3px 3px;
    font-size: 13px;
    font-weight: bold;
   }
   .sc-ui-menu-view {
    clear: both;
    height: 350px;
    overflow: auto;
    padding: 3px;
   }
   .sc-ui-menu-icons-list {
    display: none;
    position: absolute;
    top: 125px;
    left: 175px;
    padding: 4px;
    border-style: solid;
    border-width: 1px;
    -moz-border-radius: 3px;
    -webkit-border-radius: 3px;
    border-radius: 3px;
    -moz-box-shadow: 3.5px 3.5px 5px #888;
    -webkit-box-shadow: 3.5px 3.5px 5px #888;
    box-shadow: 3.5px 3.5px 5px #888;
   }
   .sc-ui-menu-icons-display {
    background-color: #fff;
    border-color: #404040 #808080 #A0A0A0 #606060;
    border-style: solid;
    border-width: 2px;
    padding: 1px;
    width: 322px;
    height: 200px;
    overflow: auto;
   }
   .sc-ui-menu-icons-img {
    border-color: #fff;
    border-style: solid;
    border-width: 2px;
    margin: 1px;
   }
   .sc-ui-selected-icon {
    background-color: #E7D5D3;
    border-color: #993123;
    border-style: solid;
    border-width: 2px;
   }
   .clearfix:after {
    content: ".";
    display: block;
    clear: both;
    visibility : hidden;
    line-height: 0;
    height: 0;
   }
   .clearfix {
    display: inline-block;
   }
   html[xmlns] .clearfix {
    display: block;
   }
   * html .clearfix {
    height: 1%;
   }
  </style>
  <table align="center" style="border-collapse: collapse; border-width: 0"><tr><td style="padding: 5px">
  <div id="sc-js-menu-editor"></div>
  </td></tr></table>
  <script type="text/javascript">
   $(function() {
    $("#sc-js-menu-editor").editMenu({
     langNewItem: "<?php echo nm_get_text_lang("['menu_application_add_item']"); ?>",
     langNewSub: "<?php echo nm_get_text_lang("['menu_application_add_sub_item']"); ?>",
     langRemove: "<?php echo nm_get_text_lang("['menu_application_delete']"); ?>",
     langImport: "<?php echo nm_get_text_lang("['menu_application_import_apl']"); ?>",
     langUp: "<?php echo nm_get_text_lang("['menu_editor_move_up']"); ?>",
     langDown: "<?php echo nm_get_text_lang("['menu_editor_move_down']"); ?>",
     langLeft: "<?php echo nm_get_text_lang("['menu_editor_move_left']"); ?>",
     langRight: "<?php echo nm_get_text_lang("['menu_editor_move_right']"); ?>",
     langLabel: "<?php echo nm_get_text_lang("['menu_editor_label']"); ?>",
     langLink: "<?php echo nm_get_text_lang("['menu_editor_link']"); ?>",
     langHint: "<?php echo nm_get_text_lang("['menu_editor_hint']"); ?>",
     langIcon: "<?php echo nm_get_text_lang("['menu_editor_icon']"); ?>",
     langTarget: "<?php echo nm_get_text_lang("['menu_editor_target']"); ?>",
     langSelf: "<?php echo nm_get_text_lang("['menu_editor_self']"); ?>",
     langBlank: "<?php echo nm_get_text_lang("['menu_editor_blank']"); ?>",
     langParent: "<?php echo nm_get_text_lang("['menu_editor_parent']"); ?>",
     langProperties: "<?php echo nm_get_text_lang("['menu_editor_properties']"); ?>",
     langTheme: "<?php echo nm_get_text_lang("['menu_editor_theme']"); ?>",
     langIconList: "<?php echo nm_get_text_lang("['menu_editor_icon_list']"); ?>",
     langIconSize: "<?php echo nm_get_text_lang("['menu_editor_icon_size']"); ?>",
     langButtonOk: "<?php echo nm_get_text_lang("['button_ok']"); ?>",
     langButtonCancel: "<?php echo nm_get_text_lang("['button_cancel']"); ?>",
     langExampleMenu: "<?php echo nm_get_text_lang("['menu_theme_example']"); ?>:",
     langCheckUncheck: "<?php echo nm_get_text_lang("['menu_application_check_all']"); ?>",
     langIcon1: "<?php echo nm_get_text_lang("['menu_application_old_icons']"); ?>",
     langIcon2: "<?php echo nm_get_text_lang("['menu_application_new_icons']"); ?>",
     langThemes: {
      "scriptcase": "<?php echo nm_get_text_lang("['module_scriptcase']"); ?>",
      "sys": "<?php echo nm_get_text_lang("['module_sys']"); ?>",
      "grp": "<?php echo nm_get_text_lang("['module_grp']"); ?>",
      "usr": "<?php echo nm_get_text_lang("['module_usr']"); ?>"
     },
     urlThemes: {
      "scriptcase": "<?php echo $nm_config['url_scriptcase'] . 'menu/'; ?>",
      "sys": "<?php echo $nm_config['url_sys'] . 'menu/'; ?>",
      "grp": "<?php echo $nm_config['url_grp'] . $_SESSION['nm_session']['user']['cod_grp'] . '/menu/'; ?>",
      "usr": "<?php echo $nm_config['url_usr'] . $_SESSION['nm_session']['user']['login']   . '/menu/'; ?>"
     },
     imagePath: {scriptcase:'<?=$nm_config['url_scriptcase']?>img/', sys:'<?=$nm_config['url_sys']?>img/', grp:'<?php echo $nm_config['url_grp'] . $_SESSION['nm_session']['user']['cod_grp']?>/img/', usr:'<?php echo $nm_config['url_usr'] . $_SESSION['nm_session']['user']['login']?>/img/'},
     iconList: new Array("<?php echo implode('", "', $arr_data['icon_list']); ?>"),
     iconUrl: "<?php echo $nm_config['url_scase']; ?>devel/conf/",
     barUrl: "<?php echo $nm_config['url_scase']; ?>devel/conf/scriptcase/img/sys/",     
<?php
if (!empty($aMenuEditorItens))
{
?>
     itemList: new Array(
<?php
    foreach ($aMenuEditorItens as $i => $aItemDados)
    {
?>
      {"id": "sc-js-menu-<?php echo $sMenuEditorName; ?>-item<?php echo ($i + 1); ?>", "sc_id": "<?php echo $aItemDados['sc_id']; ?>", "label": "<?php echo str_replace('"', '\"', $aItemDados['label']); ?>", "link": "<?php echo str_replace('"', '\"', $aItemDados['link']); ?>", "hint": "<?php echo str_replace('"', '\"', $aItemDados['hint']); ?>", "icon": "<?php echo $aItemDados['icon']; ?>", "target": "<?php echo $aItemDados['target']; ?>", "level": "<?php echo $aItemDados['level']; ?>"}<?php if ($i < sizeof($aMenuEditorItens) - 1) { echo ','; } ?>
<?php
    }
?>
     ),
<?php
}

$aTemas = array();
foreach ($arr_data['temas'] as $sTemaModulo => $aTemaTipos)
{
    if (!empty($aTemaTipos))
    {
        $aTemasPorTipo = array();
        foreach ($aTemaTipos as $sTemaTipo => $aTemaArquivos)
        {
            if (!empty($aTemaArquivos))
            {
                foreach ($aTemaArquivos as $sTemaNome)
                {
                    $aTemasPorTipo[] = '"' . $sTemaModulo . '__NM__' . $sTemaTipo . '/' . $sTemaNome . '"';
                }
            }
        }
        $aTemas[] = '"' . $sTemaModulo . '": new Array(' . implode(', ', $aTemasPorTipo) . ')';
    }
}
?>
     themeList: {<?php echo implode(', ', $aTemas); ?>},
     iconLink: "<?php echo $nm_config['url_img']; ?>link.gif",
     iconIcon1: "<?php echo $nm_config['url_img']; ?>background.png",
     iconIcon2: "<?php echo $nm_config['url_img']; ?>background.png",
     lastItem: <?php echo $iUltimoId; ?>,
     field: "<?php echo $sMenuEditorName; ?>",
     fieldTheme: "menu_theme",
     user: "<?php echo $_SESSION['nm_session']['user']['login']; ?>",
     project: "<?php echo $_SESSION['nm_session']['user']['cod_grp']; ?>"
    });
   });
  </script>

</td>
</tr>

<?php
	if (0 && count($array_menus) == 0 )
	{
?>
<script language="javascript">

	show_msg_help_app("<?php echo nm_get_text_lang("['msg_start_app_menu']"); ?>", false);

</script>

<?php
	}
?>