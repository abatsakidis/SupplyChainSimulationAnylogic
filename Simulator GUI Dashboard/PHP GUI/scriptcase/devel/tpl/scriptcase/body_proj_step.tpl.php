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
$step				=	$this->GetVar('step');
$next_step			=	$this->GetVar('next_step');
$back_step			=	$this->GetVar('back_step');
$arr_steps          =   $this->GetVar('arr_steps');
$str_html_steps = '';
$count = 1;
$ja_passou = true;

foreach($arr_steps as $_step)
{
    $class ='step' . $count;
    $onclick = "";
    if($step == $_step)
    {
        $ja_passou = false;
        $class .= '_active';
    }
    else if($ja_passou)
    {
        $onclick = "$('input[name=back_step]').val('".$_step."'); nm_action('back');";
        $class .= '_pass';
    }
    else{
        $class .= '_disabled';

    }

    if(isset($_SESSION['nm_session']['proj']['data']['imported']) && !empty($_SESSION['nm_session']['proj']['data']['imported']))
    {
        if($count == 2 || $count == 3)
        {
            $class = 'step'.$count.'_disabled';
            $onclick="";
        }
    }

    $__lang = nm_get_text_lang("['step']['". $_step ."']");


    $str_html_steps .= <<<EOT
<li id="id_step_{$_step}" class="step {$class}" onclick="$onclick">
    <a href="#{$_step}" >{$__lang}</a>
</li>
EOT;

    $count++;
}
?>
<div id='id_loading'>
	<img src="<?php echo $nm_config['url_img']; ?>ajax-loader.gif" alt="Loading..." title="Loading..."  style='position:absolute; margin:0 auto; top: 45%; left: 49%'/>
</div>
<div id="steps">
    <ul>
        <?php echo $str_html_steps ?>
    </ul>
</div>
<div style="clear:both;"></div>

<form name='form_proj_step' method='post' action=''>
	<div  id='id_content'>
		<?php $this->Display('body_proj_step_'. $step); ?>
		<div id='id_buttons' style='position:relative;width:170px;text-align:right;left:873px;white-space: nowrap;'>
			<input type="button" name="back" value="<?php echo nm_get_text_lang("['prj_btn_voltar']"); ?>" class="nmButton ButtonsBottom" onclick="nm_action('back');" />
			<input type="button" name="save" value="<?php echo nm_get_text_lang("['button_save']"); ?>" class="nmButton ButtonsBottom" onclick="nm_action('save');" />
			<input type="button" name="next" value="<?php echo nm_get_text_lang("['prj_btn_avancar']"); ?>" class="nmButton ButtonsBottom" onclick="<?php echo ($this->GetVar('project_limit')) ? "return false;" : "nm_action('next');"; ?>" />
		</div>
	</div>
	<?php if($this->GetVar('project_limit')) : ?>
		<script>
			$('input[name=next]').click(function(){
				$.blockUI({message: $('#id_proj_lim_error').html(), css: { top: '150px', position:'fixed'}, timeout: 7000})
				return false;
			});
		</script>
		<div id="id_proj_lim_error" style="display:none;">
		<p>
		  <?php echo nm_get_text_lang("['sc_err_proj_limit']"); ?><br/>
		  <span style='text-align:center;'><input type="button" value='<?php echo nm_get_text_lang("['button_close']"); ?>' onclick='$.unblockUI()'/></span>

		</p>
	</div>
	<?php endif; ?>
	<?php if($this->GetVar('project_name') == 1)
	{
		?>
		<div id='id_msg_error'style='position:absolute; margin:0px auto; left:45%;top:70px;background-color:#FFE0E0; padding:10px;width:320px;border:2px solid #CECECE;'>
			<?php echo nm_get_text_lang("['prj_err_n_code']"); ?>
		</div>
		<script> setTimeout(function(){ $('#id_msg_error').hide(); }, 5000);</script>
		<?php
	}
	?>
	<?php if($this->GetVar('project_name') == 2)
	{
		?>
		<div id='id_msg_error'style='position:absolute; margin:0px auto; left:45%;top:70px;background-color:#FFE0E0; padding:10px;width:320px;border:2px solid #CECECE;'>
			<?php echo nm_get_text_lang("['reserved_word']"); ?>
		</div>
		<script> setTimeout(function(){ $('#id_msg_error').hide(); }, 5000);</script>
		<?php
	}
	?>
		<input type="hidden" name="step" value="<?php echo $step; ?>" />
		<input type="hidden" name="next_step" value="<?php echo $next_step; ?>" />
		<input type="hidden" name="back_step" value="<?php echo $back_step; ?>" />
		<input type="hidden" name="action" value="next" />
		<input type="hidden" name="extra" value="" />
</form>