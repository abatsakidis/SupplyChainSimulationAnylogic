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
 
$nm_lang['app_mensagens']['help']['form_evento_generic_multiplos'] = '方向は「複数レコード」に設定されている時のみにフォームアプリケーションに有効になってます。<br />このオプションを設定するため、「フォーム方式」のメニューにアクセスして、「方向」の設定を変更してください。||Event||149722';
$nm_lang['app_mensagens']['help']['form_evento_onloadall'] = '「OnLoad」イベントは、「方向」は「シングルレコード」として定義さらている時に無効になります。<br />このオプションを設定するため、「フォーム方式」のメニューにアクセスして、「方向」設定を変更してください。||Event||149702';
$nm_lang['app_mensagens']['help']['form_evento_onrecord'] = 'OnRecordイベントは、「方向」は「シングルレコード」として定義さらている時のみに有効になります。<br />このオプションを設定するため、「フォーム方式」のメニューにアクセスして、「方向」設定を変更してください。||Event||149692';
$nm_lang['button']['new_parms'] = 'パラメーターを定義する||Event||113230';
$nm_lang['error']['method_invalid_name'] = '名前が無効であるか、この名前が付いてるメソドがすでに存在してます。||Event||113249';
$nm_lang['err_db_non_transactional'] = 'トランザクションアルではない接続と一緒にトランザクションのマクロをご使用してます。||Event||138679';
$nm_lang['evt_msg_help_ctr_onapplicationinit'] = 'アプリケーションのロード中に発生（一回目）||Event||117963';
$nm_lang['evt_msg_help_ctr_oninit'] = 'アプリケーションのロード中に発生||Event||117968';
$nm_lang['evt_msg_help_ctr_onload'] = 'このイベントはフォームが表示される前に発生します||Event||117954';
$nm_lang['evt_msg_help_ctr_onrefresh'] = 'このイベントはフィールドがフォーム再読み込みを強制した時に発生します||Event||117955';
$nm_lang['evt_msg_help_ctr_onvalidate'] = 'データ確認の際に発生する||Event||118011';
$nm_lang['evt_msg_help_ctr_onvalidatefailure'] = '確認の失敗が見つかった際に発生する||Event||117964';
$nm_lang['evt_msg_help_ctr_onvalidatesucess'] = '確認が成功した際に発生する||Event||117966';
$nm_lang['evt_msg_help_fil_onapplicationinit'] = 'アプリケーションがロードされる時に一回発生する（一回目）||Event||117959';
$nm_lang['evt_msg_help_frm_onafterdelete'] = 'こにイベントは各行削除後に発生します||Event||117986';
$nm_lang['evt_msg_help_frm_onafterdeleteall'] = 'こにイベントは全ての行を削除してから発生します||Event||117987';
$nm_lang['evt_msg_help_frm_onafterinsert'] = 'このイベントはフォームアプリケーション上に行が挿入された後に発生します||Event||117978';
$nm_lang['evt_msg_help_frm_onafterinsertall'] = 'このイベントは全ての行を挿入する後に発生します||Event||117979';
$nm_lang['evt_msg_help_frm_onafterupdate'] = 'このイベントはフォームアプリケーション上に行が更新された後に発生します||Event||117982';
$nm_lang['evt_msg_help_frm_onafterupdateall'] = 'このイベントは全ての行を更新する後に発生します||Event||117983';
$nm_lang['evt_msg_help_frm_onapplicationinit'] = 'アプリケーションのロード中に発生（一回目）||Event||117962';
$nm_lang['evt_msg_help_frm_onbeforedelete'] = 'このイベントは各行が削除される前に発生します||Event||117984';
$nm_lang['evt_msg_help_frm_onbeforeinsert'] = 'このイベントは行を挿入する前に発生します||Event||117976';
$nm_lang['evt_msg_help_frm_onbeforeinsertall'] = 'このイベントは全ての行を挿入する前ね発生する||Event||117977';
$nm_lang['evt_msg_help_frm_onbeforeupdate'] = 'このイベントは各行が更新される前に発生します||Event||117980';
$nm_lang['evt_msg_help_frm_onbeforeupdateall'] = 'このイベントは全ての行を更新する前に発生します||Event||117981';
$nm_lang['evt_msg_help_frm_oninit'] = 'アプリケーションのロード中に発生（毎回）||Event||117969';
$nm_lang['evt_msg_help_frm_onload'] = 'このイベントは全てのレコードを読み込んだ際に発生します||Event||117971';
$nm_lang['evt_msg_help_frm_onloadrecord'] = 'このイベントは各レコードを読み込んだ際に発生します||Event||117970';
$nm_lang['evt_msg_help_frm_onnavigate'] = 'レコード間をナビゲーティング中に発生する||Event||118004';
$nm_lang['evt_msg_help_frm_onrefresh'] = 'このイベントはフィールドがフォーム再読み込みを強制した時に発生します||Event||117972';
$nm_lang['evt_msg_help_frm_onvalidate'] = 'このイベントはフォームが提出された際に発生します||Event||117975';
$nm_lang['evt_msg_help_frm_onvalidatefailure'] = '確認の失敗が見つかった際に発生する||Event||117965';
$nm_lang['evt_msg_help_frm_onvalidatesucess'] = '確認が成功した際に発生する||Event||117967';
$nm_lang['evt_msg_help_grd_onapplicationinit'] = 'アプリケーションのロード中に発生（一回目のみ）||Event||118005';
$nm_lang['evt_msg_help_grd_oninit'] = 'このイベントはアプリケーションがロードされる時に発生します||Event||117946';
$nm_lang['evt_msg_help_grd_onnavigate'] = 'グリッドページ間をナビゲーティング中に発生する||Event||118003';
$nm_lang['evt_msg_help_grd_onrecord'] = 'このイベントは各レコードに発生します||Event||117988';
$nm_lang['evt_msg_help_mnu_onapplicationinit'] = 'アプリケーションのロード中に発生（一回目）||Event||117961';
$nm_lang['evt_msg_help_mnu_onexecute'] = 'メニューアイテムが選択されたときに発生します||Event||117957';
$nm_lang['evt_msg_help_mnu_onload'] = 'メニューがロードされたときに発生します||Event||117956';
$nm_lang['evt_msg_help_pdf_onapplicationinit'] = 'アプリケーションがロードされる時に一回発生する（一回目）||Event||117960';
$nm_lang['fld']['param'] = 'パラメーター||Event||113223';
$nm_lang['lnk']['check_all'] = '全てチェックする||Event||113245';
$nm_lang['lnk']['param_drop'] = 'パラメーターを削除||Event||113248';
$nm_lang['lnk']['param_edit'] = 'パラメータを編集||Event||113247';
$nm_lang['lnk']['un_check_all'] = 'すべてのチェックをはずす||Event||113246';
$nm_lang['page_title'] = 'イベント||Event||118088';
$nm_lang['param']['byref'] = '元レファレンス||Event||113229';
$nm_lang['param']['byval'] = '元バリュー||Event||113228';
$nm_lang['param']['default'] = '標準値||Event||113227';
$nm_lang['param']['name'] = '名前||Event||113225';
$nm_lang['param']['type'] = 'タイプ||Event||113226';
$nm_lang['text']['add'] = '追加||Event||113236';
$nm_lang['text']['addevt_name'] = '名前||Event||113242';
$nm_lang['text']['add_method'] = '新しいメソッド||Event||113241';
$nm_lang['text']['campos_param'] = 'パラメータとして渡すフィールド <br> チェックをつけるにはダブルクリックしてください。||Event||113244';
$nm_lang['text']['msg_del_param'] = 'パラメーターの削除を確認しますか？||Event||113240';
$nm_lang['text']['parms'] = 'パラメーター||Event||113237';
$nm_lang['text']['sem_parms'] = 'パラメーターが定義されていない||Event||113235';
$nm_lang['text']['title_add'] = 'パラメーターの挿入||Event||113238';
$nm_lang['text']['title_def_par'] = 'メソッドのパラメーター定義||Event||113234';
$nm_lang['text']['title_edit'] = 'パラメーターを編集中||Event||113239';
$nm_lang['text']['title_par_ajax'] = 'パラメータ（フィールド）||Event||113243';

?>