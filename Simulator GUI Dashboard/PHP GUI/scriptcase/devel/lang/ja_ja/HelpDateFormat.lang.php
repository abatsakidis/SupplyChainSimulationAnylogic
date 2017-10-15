<?php
/**
 * Japanese (Japan) 
 * 
 * @package     Idioma 
 * @copyright   NetMake IT Solutions 
 * @author      Automatic System Lang Files <desenv@netmake.com.br> 
 * 
 
/* Protecao contra hacks */ 
if (!defined('SC_LOCKED_VERSION_8976') || ('CARREGADO4536' != SC_LOCKED_VERSION_8976)) 
{ 
    die('<br /><span style="font-weight: bold">Fatal error</span>: ' . 
        'invalid access to system file.'); 
}  
 
global $nm_lang; 
 
$nm_lang['date_format_ex1_form'] = 'd-m-Y||HelpDateFormat||115308';
$nm_lang['date_format_ex1_out'] = '25-09-2001||HelpDateFormat||115309';
$nm_lang['date_format_ex2_form'] = 'F/Y||HelpDateFormat||115310';
$nm_lang['date_format_ex2_out'] = '９月/2001||HelpDateFormat||115311';
$nm_lang['date_format_ex3_form'] = 'j/n/Y \\a\\t g:i:s A||HelpDateFormat||115312';
$nm_lang['date_format_ex3_out'] = '25/9/2001 at 14:30:11 PM||HelpDateFormat||115313';
$nm_lang['date_format_ex4_form'] = 'l, d o\\f F o\\f Y||HelpDateFormat||115314';
$nm_lang['date_format_ex4_out'] = '2001年1月25日（木）||HelpDateFormat||115315';
$nm_lang['date_format_ex5_form'] = 'h:i:s||HelpDateFormat||115316';
$nm_lang['date_format_ex5_out'] = '11:33:20||HelpDateFormat||115317';
$nm_lang['date_format_ex6_form'] = '#h:i:s||HelpDateFormat||115318';
$nm_lang['date_format_ex6_out'] = '123:43:27 (増え続ける時間)||HelpDateFormat||115319';
$nm_lang['date_format_examples'] = '例||HelpDateFormat||115320';
$nm_lang['date_format_param']['#h']['desc'] = '時間アキュムレータ||HelpDateFormat||115357';
$nm_lang['date_format_param']['#i']['desc'] = '分アキュムレータ||HelpDateFormat||115358';
$nm_lang['date_format_param']['#s']['desc'] = '秒アキュムレータ||HelpDateFormat||115359';
$nm_lang['date_format_param']['/']['desc'] = 'エスケープキャラクター||HelpDateFormat||115360';
$nm_lang['date_format_param']['A']['desc'] = '天底子午線と天底子後線||HelpDateFormat||115355';
$nm_lang['date_format_param']['A']['examp'] = '&quot;AM&quot; と &quot;PM&quot;||HelpDateFormat||115356';
$nm_lang['date_format_param']['a']['desc'] = '天底子午線と天底子後線||HelpDateFormat||115353';
$nm_lang['date_format_param']['a']['examp'] = '&quot;am&quot; と &quot;pm&quot;||HelpDateFormat||115354';
$nm_lang['date_format_param']['D']['desc'] = '３文字の曜日||HelpDateFormat||115337';
$nm_lang['date_format_param']['D']['examp'] = '&quot;Mon&quot;（月）||HelpDateFormat||115338';
$nm_lang['date_format_param']['d']['desc'] = '先行ゼロ付きの日||HelpDateFormat||115323';
$nm_lang['date_format_param']['d']['examp'] = '&quot;01&quot; から &quot;31&quot;||HelpDateFormat||115324';
$nm_lang['date_format_param']['F']['desc'] = '月名||HelpDateFormat||115331';
$nm_lang['date_format_param']['F']['examp'] = '&quot;January&quot;（１月）||HelpDateFormat||115332';
$nm_lang['date_format_param']['G']['desc'] = '２４時間形式の時間||HelpDateFormat||115343';
$nm_lang['date_format_param']['G']['examp'] = '&quot;0&quot; から &quot;23&quot;||HelpDateFormat||115344';
$nm_lang['date_format_param']['g']['desc'] = '１２時間形式の時間||HelpDateFormat||115341';
$nm_lang['date_format_param']['g']['examp'] = '&quot;1&quot; から &quot;12&quot;||HelpDateFormat||115342';
$nm_lang['date_format_param']['H']['desc'] = '先行ゼロ付きの２４時間形式の時間||HelpDateFormat||115347';
$nm_lang['date_format_param']['H']['examp'] = '&quot;00&quot; から &quot;23&quot;||HelpDateFormat||115348';
$nm_lang['date_format_param']['h']['desc'] = '先行ゼロ付きの１２時間形式の時間||HelpDateFormat||115345';
$nm_lang['date_format_param']['h']['examp'] = '&quot;01&quot; から &quot;12&quot;||HelpDateFormat||115346';
$nm_lang['date_format_param']['i']['desc'] = '分||HelpDateFormat||115349';
$nm_lang['date_format_param']['i']['examp'] = '&quot;00&quot; から &quot;59&quot;||HelpDateFormat||115350';
$nm_lang['date_format_param']['j']['desc'] = '日||HelpDateFormat||115321';
$nm_lang['date_format_param']['j']['examp'] = '&quot;1&quot; to &quot;31&quot;||HelpDateFormat||115322';
$nm_lang['date_format_param']['l']['desc'] = '曜日||HelpDateFormat||115339';
$nm_lang['date_format_param']['l']['examp'] = '&quot;Monday&quot;（月曜日）||HelpDateFormat||115340';
$nm_lang['date_format_param']['M']['desc'] = '３文字の月名||HelpDateFormat||115329';
$nm_lang['date_format_param']['M']['examp'] = '&quot;Jan&quot;（１月）||HelpDateFormat||115330';
$nm_lang['date_format_param']['m']['desc'] = '先行ゼロ付きの月||HelpDateFormat||115327';
$nm_lang['date_format_param']['m']['examp'] = '&quot;01&quot; から &quot;12&quot;||HelpDateFormat||115328';
$nm_lang['date_format_param']['n']['desc'] = '月||HelpDateFormat||115325';
$nm_lang['date_format_param']['n']['examp'] = '&quot;1&quot; から &quot;12&quot;||HelpDateFormat||115326';
$nm_lang['date_format_param']['s']['desc'] = '秒||HelpDateFormat||115351';
$nm_lang['date_format_param']['s']['examp'] = '&quot;00&quot; から &quot;59&quot;||HelpDateFormat||115352';
$nm_lang['date_format_param']['Y']['desc'] = '４文字の年形式||HelpDateFormat||115335';
$nm_lang['date_format_param']['Y']['examp'] = '&quot;1999&quot;||HelpDateFormat||115336';
$nm_lang['date_format_param']['y']['desc'] = '２文字の年形式||HelpDateFormat||115333';
$nm_lang['date_format_param']['y']['examp'] = '&quot;99&quot;||HelpDateFormat||115334';
$nm_lang['page_title'] = '日付フォーマット||HelpDateFormat||115307';

?>