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
 * @author      Vin&iacute;cius Muniz<vinicius@netmake.com.br>
 *
 * $Id: body_proj_new_step1.tpl.php,v 1.17 2012-01-23 18:46:22 diogo Exp $
 */

/* Protecao contra hacks */
if (!defined('SC_LOCKED_VERSION_8976') || ('CARREGADO4536' != SC_LOCKED_VERSION_8976))
{
    die('<br /><span style="font-weight: bold">Fatal error</span>: ' .
        'invalid access to system file.');
}
$arr_data				=	$this->GetVar('arr_data');
$_arr_locales			=	$this->GetVar('arr_locales');
$arr_locales			=	$_arr_locales['arr_locales'];
$config_region			=	$_arr_locales['config_region'];
$locales_charset		=	$_arr_locales['locales_charset'];
$loc_default			=	($arr_data['default']) ? $arr_data['default'] : $_arr_locales['locale_default'];
$prj_locales			=	$_arr_locales['prj_locales'];
$lang_ini				=	$_arr_locales['lang_ini'];
$arr_directions     = array();
$arr_directions['LTR'] = "||";
$arr_directions['RTL'] = "||";
$lang_direction = (isset($arr_data['lang_direction']) ? $arr_data['lang_direction'] : 'LTR');
$str_li_html_charset = '';

$locales = '';
if(isset($arr_data['charset']))
{
    foreach($arr_data['charset'] as $k => $charset)
    {
        $lang_ini[ $k ]['charset'] = $charset;
    }
}
$str_regions_option = '';
$_arr = array();
foreach($config_region as $k => $data){
    $_arr[$k] = nm_get_text_lang("['locale']['". $k . "']");
}
asort($_arr);
foreach($_arr as $k => $__lang)
{
    $str_regions_option .= <<<EOT
<option value='{$k}'>{$__lang}</option>
EOT;
}
$str_charset_options = "";
foreach ($nm_config['charset_html_new'] as $str_region => $arr_charsets)
{
    if(!empty($str_region))
    {
        $str_charset_options .= "<optgroup label='".$str_region."'>";
    }
    foreach ($arr_charsets as $id_charset => $str_charset)
    {
        if(!empty($str_charset))
        {
            $str_charset .= " (". $id_charset .")";
        }
        else{ continue;}
        $str_charset_options .= <<<EOT
            <option value='{$id_charset}'>{$str_charset}</option>
EOT;

    }
    if(!empty($str_region))
    {
        $str_charset_options .= "</optgroup>";
    }

}
//nm_printr($_SESSION['nm_session']['proj_edit']);
$arr_defaults = array();
$arr_defaults_charset = array();
if(isset($_SESSION['nm_session']['proj']['data']['locales']))
{
    $_arr = explode('__NM__', $_SESSION['nm_session']['proj']['data']['locales']);
    foreach($_arr as $_data)
    {
        $__arr = explode(';', $_data);
        $arr_defaults[] = $__arr[0];
        $arr_defaults_charset[ $__arr[0] ][] = $__arr[1];
    }
}
elseif(isset($_SESSION['nm_session']['proj_edit']['prj_locales']))
{
    foreach($_SESSION['nm_session']['proj_edit']['prj_locales'][0]['locales'] as $_data => $trash)
    {
        $__arr = explode(';', $_data);
        $arr_defaults[] = $__arr[0];
        $arr_defaults_charset[ $__arr[0] ][] = $__arr[1];
    }
}
else{
    foreach($prj_locales[0]['locales'] as $locale => $data )
    {
        $_arr = explode(";", $locale);
        $arr_defaults[] = $_arr[0];
        $arr_defaults_charset[ $_arr[0] ][] = $_arr[1];
    }
}
if(is_ver_en() && isset($arr_defaults_charset['pt_br']))
{
    unset($arr_defaults_charset['pt_br']);
}
global $nm_lang
?>
<script type="text/javascript">
    var str_regions_options	= "<?php echo $str_regions_option; ?>";
    var str_charset_options	= "<?php echo $str_charset_options; ?>";
    var arr_data_locales = <?php echo json_encode($_arr_locales, JSON_UNESCAPED_UNICODE); ?>;
    var arr_lang = <?php echo json_encode($nm_lang['locale'], JSON_UNESCAPED_UNICODE); ?>;
</script>

<input type="hidden" name="locales" value="<?php echo $locales; ?>" />
<input type="hidden" name="default" value="<?php echo $locales; ?>" />
<input type="hidden" name="lang_direction" value="<?php echo $lang_direction; ?>" />

<table border="0" class='nmTable' style='width:100%;margin: 0 auto;'>
    <tr class='nmTitle' style='text-align:center;'>
        <td>
            <?php echo nm_get_text_lang("['page_title']") .  ' - ' . nm_get_text_lang("['str_locales']"); ?>
            <span style="float:right;padding:0 3px;"><?php echo $this->GetVar('block_image_help'); ?></span>
        </td>
    </tr>
    <tr style='text-align:center;'>
        <td class="nmTitle td_description">
            <div style="width: 50%;margin: 0 auto;padding: 6px;" >
                <?php echo nm_get_text_lang("['step_description']['locales']");?>
            </div>
        </td>
    </tr>
    <tr>
        <td style="vertical-align: top">
            <div class="item_grid_languages" style="background-color: #D7EAF8;border-radius: 3px;border:1px dashed #333;">
                <strong>&nbsp;&nbsp;<?php echo nm_get_text_lang("['table_language']"); ?>: </strong>
                <select  id="id_langs" class='nmInput'>
                <?php asort($lang_ini); foreach($lang_ini as $lang => $data): ?>
                    <option value="<?php echo $lang; ?>" >
                        <?php echo $data['idioma']; ?>
                    </option>
                <?php endforeach; ?>
                </select>
                <strong>&nbsp;&nbsp;&nbsp;&nbsp; <?php echo nm_get_text_lang("['table_regional']"); ?>: </strong>
                <select id="id_regions" class='nmInput'><?php echo $str_regions_option;?></select>
                <input type="button" class='nmButton' id='add_lang' value="<?php echo nm_get_text_lang("['button_add']"); ?>"/>
            </div>
            <div style=" background-color: #FAEBD7;border: 1px solid #333;border-radius: 0px;font-weight: bold;margin: 0;width: 1045px;" class="item_grid_languages fix_width">
                <span></span>
                <span><?php echo nm_get_text_lang("['table_language']"); ?></span>
                <span><?php echo nm_get_text_lang("['table_regional']"); ?></span>
                <span><?php echo nm_get_text_lang("['table_charset']"); ?></span>
                <span><?php echo nm_get_text_lang("['table_default']"); ?></span>
                <span></span>
            </div>
            <div id="grid_languages">

            </div>
        </td>
    </tr>
</table>

<script type="text/javascript">
    <?php
        foreach($arr_defaults_charset as $lang => $data)
        {
            foreach($data as $regions)
            {
                echo "$('#grid_languages').append(create_item_language('".$lang."', '". $regions ."'));";
                echo "$('#id_langs').val('".$lang."');$('#id_regions').val('". $regions ."');";
            }
            $charset = (isset($_SESSION['nm_session']['proj']['data']['charset'])? $_SESSION['nm_session']['proj']['data']['charset'][$lang] : $_SESSION['nm_session']['proj_edit']['locales_charset'][$lang]);
            if(empty($charset))
            {
                $charset = $lang_ini[$lang]['charset'];
            }
            echo "$('.charset_lang_". $lang ."').val('".$charset."');";
        }
        if(isset($_SESSION['nm_session']['proj']['data']['default']))
        {
            ?>
                $('input[name=default]').each(function(i,t){
                   if($(t).val() == '<?php echo $_SESSION['nm_session']['proj']['data']['default']; ?>')
                   {
                       $(t).attr('checked','checked');
                   }
                });
            <?php
        }
        elseif(isset($_SESSION['nm_session']['proj_edit']['loc_default']))
        {
            ?>
                $('input[name=default]').each(function(i,t){
                    if($(t).val() == '<?php echo $_SESSION['nm_session']['proj_edit']['loc_default']; ?>')
                    {
                        $(t).attr('checked','checked');
                    }
                });
    <?php
        }
?>

    if($('input[name=default]:checked').val() == undefined)
    {
        $('input[name=default]').click();
    }
</script>