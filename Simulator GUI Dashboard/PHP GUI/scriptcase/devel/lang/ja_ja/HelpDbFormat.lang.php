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
 
$nm_lang['int_format_ex1_desc'] = '例１：日付のバリューがchar(8)としてSQL fieldに保存され、1から４は年とし、5と６は月とし、7と8は日として保存されます。その場合はインターナルフォーマットがこの通り：||HelpDbFormat||115370';
$nm_lang['int_format_ex1_form'] = 'YYYYMMDD または yyyymmdd||HelpDbFormat||115371';
$nm_lang['int_format_ex2_desc'] = '例２：時間のバリューがchar(6)としてSQL fieldに保存され、1から2は時間とし、5と６は分とし、7と8は秒として保存されます。その場合はインターナルフォーマットがこの通り：||HelpDbFormat||115372';
$nm_lang['int_format_ex2_form'] = 'HHIISS または hhiiss||HelpDbFormat||115373';
$nm_lang['int_format_ex3_desc'] = '例３：秒の数のSQL numeric fieldに日または時間または分で表示したい時。その場合はインターナルフォーマットがこの通り：||HelpDbFormat||115374';
$nm_lang['int_format_ex3_form'] = 'SEC または sec||HelpDbFormat||115375';
$nm_lang['int_format_ex4_desc'] = '例４：分の数のSQL numeric fieldに日または時間または分で表示したい時。その場合はインターナルフォーマットがこの通り：||HelpDbFormat||115376';
$nm_lang['int_format_ex4_form'] = 'MIN または min||HelpDbFormat||115377';
$nm_lang['int_format_ex5_desc'] = '例５：時間の数のSQL numeric fieldに日または時間または分で表示したい時。その場合はインターナルフォーマットがこの通り：||HelpDbFormat||115378';
$nm_lang['int_format_ex5_form'] = 'HOR または hor||HelpDbFormat||115379';
$nm_lang['int_format_explain'] = 'Dateまたはtimeまたはdatetimeのフィールドタイプの時に利用するバリューフォーマットの情報で違うSQLデータタイプでデータベースを利用してる場合。||HelpDbFormat||115380';
$nm_lang['int_format_ex_other'] = '他のフォーマットを使用できません。例を見る:||HelpDbFormat||115362';
$nm_lang['int_format_ex_other_1'] = 'DDMMYYYY||HelpDbFormat||115363';
$nm_lang['int_format_ex_other_2'] = 'HHII||HelpDbFormat||115364';
$nm_lang['int_format_ex_other_3'] = 'MMYYYY||HelpDbFormat||115365';
$nm_lang['int_format_ex_other_4'] = 'YYYY||HelpDbFormat||115366';
$nm_lang['int_format_ex_other_5'] = 'MMDD||HelpDbFormat||115367';
$nm_lang['int_format_ex_other_6'] = 'DD||HelpDbFormat||115368';
$nm_lang['int_format_ex_other_7'] = 'HH||HelpDbFormat||115369';
$nm_lang['page_title'] = '内部フォーマット||HelpDbFormat||115361';

?>