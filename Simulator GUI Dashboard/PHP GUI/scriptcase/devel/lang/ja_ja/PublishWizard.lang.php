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
 
$nm_lang['page_title'] = 'アプリケーション配置||PublishWizard||116409';
$nm_lang['publishwizard']['apl'] = 'アプリケーション||PublishWizard||116435';
$nm_lang['publishwizard']['botoes']['avancar'] = '次||PublishWizard||116411';
$nm_lang['publishwizard']['botoes']['criar'] = '作る||PublishWizard||116414';
$nm_lang['publishwizard']['botoes']['help'] = 'ヘルプ||PublishWizard||116412';
$nm_lang['publishwizard']['botoes']['publish'] = 'Deploy||PublishWizard||116410';
$nm_lang['publishwizard']['botoes']['retornar'] = '戻る||PublishWizard||116413';
$nm_lang['publishwizard']['confirm']['delete'] = '選択したテンプレートを削除しますか？||PublishWizard||116471';
$nm_lang['publishwizard']['connections'] = 'Connection names||PublishWizard||116481';
$nm_lang['publishwizard']['connections_devel'] = 'Development||PublishWizard||116482';
$nm_lang['publishwizard']['connections_prod'] = 'Production Environment||PublishWizard||116483';
$nm_lang['publishwizard']['criar_esquemas'] = 'Create new deployment template||PublishWizard||116417';
$nm_lang['publishwizard']['erro']['ftp_connect'] = 'Erro connecting to FTP Server||PublishWizard||116453';
$nm_lang['publishwizard']['erro']['ftp_create_dir'] = 'It was not possible to create the new folder: ||PublishWizard||116456';
$nm_lang['publishwizard']['erro']['ftp_error'] = 'FTP Error||PublishWizard||116454';
$nm_lang['publishwizard']['erro']['ftp_error_msg'] = 'It was not possible to connect to the FTP Server. Please check the server address, the user and password!||PublishWizard||116457';
$nm_lang['publishwizard']['erro']['novo_esquema'] = 'Invalid Template Name||PublishWizard||116445';
$nm_lang['publishwizard']['erro']['novo_esquema_exist'] = 'Already exists a deployment template with this name.||PublishWizard||116446';
$nm_lang['publishwizard']['erro']['pub_dir_empty'] = 'Please, inform a valid folder.||PublishWizard||116448';
$nm_lang['publishwizard']['erro']['pub_dir_invalid'] = 'Please, inform a valid folder.||PublishWizard||116449';
$nm_lang['publishwizard']['erro']['pub_dir_n_existe'] = 'The informed folder does not exist. Dir:||PublishWizard||116447';
$nm_lang['publishwizard']['erro']['pub_ftp_server'] = 'Please, inform a valid FTP Server.||PublishWizard||116450';
$nm_lang['publishwizard']['erro']['pub_perfil'] = 'A valid profile  is needed||PublishWizard||116455';
$nm_lang['publishwizard']['erro']['pub_prod_dir'] = 'Please, inform a valid folder.||PublishWizard||116451';
$nm_lang['publishwizard']['erro']['pub_temp_dir'] = 'Please, inform a valid folder.||PublishWizard||116452';
$nm_lang['publishwizard']['erro']['sftp_connect'] = 'SFTPサーバとの接続エラー||PublishWizard||153111';
$nm_lang['publishwizard']['erro']['sftp_error_msg'] = 'これは、SFTPサーバに接続することはできませんでした。サーバアドレス、ユーザー名とパスワードを確認してください。||PublishWizard||153121';
$nm_lang['publishwizard']['erro_permission'] = 'Error copying the file||PublishWizard||116476';
$nm_lang['publishwizard']['erro_title'] = 'ERROR||PublishWizard||116444';
$nm_lang['publishwizard']['esquema'] = 'テーマ||PublishWizard||116434';
$nm_lang['publishwizard']['esquemas'] = 'Template||PublishWizard||116415';
$nm_lang['publishwizard']['ftp']['ftp_ok'] = 'Applications sucessefully sent to FTP Server||PublishWizard||116443';
$nm_lang['publishwizard']['ftp']['ftp_title'] = 'FTP||PublishWizard||116442';
$nm_lang['publishwizard']['gauge']['final'] = '展開が終了しました||PublishWizard||116487';
$nm_lang['publishwizard']['gauge']['init'] = '展開の準備をしています||PublishWizard||116484';
$nm_lang['publishwizard']['gauge']['pub'] = '展開中||PublishWizard||116485';
$nm_lang['publishwizard']['gauge']['zip'] = 'ＺＩＰを作成中||PublishWizard||116486';
$nm_lang['publishwizard']['help']['help_pub_conf_dir']['msg'] = 'Directory where the &#39;conf&#39; folder from production environment is located<BR>Warning: The folder address must be full<BR><BR>Ex: c:\\inetpub\\wwwroot\\documents||PublishWizard||116465';
$nm_lang['publishwizard']['help']['help_pub_dir']['msg'] = 'Directory where the applications that are being deployed will be created!<br><br>Ex Windows: <BR> c:\\inetpub\\wwwroot\\example_sys<BR>or<BR>/inetpub/wwwroot/example_sys<BR><BR>Ex Linux: /var/www/html/example_sys<BR><BR>||PublishWizard||116463';
$nm_lang['publishwizard']['help']['help_pub_dir_flag']['msg'] = 'Create the applications on a server folder(where ScriptCase is installed)!||PublishWizard||116461';
$nm_lang['publishwizard']['help']['help_pub_doc_dir']['msg'] = 'Directory where the documents are located<BR>Warning: The folder address must be full<BR><BR>Ex: c:inetpub\\wwwroot\\documents||PublishWizard||116468';
$nm_lang['publishwizard']['help']['help_pub_ftp_flag']['msg'] = 'Deploy the applications on a FTP Server||PublishWizard||116462';
$nm_lang['publishwizard']['help']['help_pub_imag_dir']['msg'] = 'Directory where the images are located<BR>Warning: The folder must be on your web documents directory<BR><BR>Ex: If you use IIS as your web server and its root folder is c:\\inetpub\\wwwroot and the images folder  is located at c:\\inetpub\\wwwroot\\images<br><BR>the relative address will be  <i>/images</i>||PublishWizard||116466';
$nm_lang['publishwizard']['help']['help_pub_prod_dir']['msg'] = 'Directory where the ScriptCase Common libraries is located<BR>Warning: The folder must be on your web documents directory<BR><BR>Ex: If you use IIS as your web server and its root folder is c:inetpubwwwroot and the Prod is located at c:inetpubwwwrootprod<br><BR>the relative address will be  <i>/prod</i>||PublishWizard||116464';
$nm_lang['publishwizard']['help']['help_pub_temp_dir']['msg'] = 'Directory where the ScriptCase will create its temporary files<BR>Warning: The folder must be on your web documents directory<BR><BR>Ex: If you use IIS as your web server and its root folder is c:inetpubwwwroot and the temporary files folder is located at c:\\inetpub\\wwwroot\\tmp<br><BR>the relative address will be  <i>/tmp</i>||PublishWizard||116467';
$nm_lang['publishwizard']['help']['help_pub_usar']['msg'] = 'Its necessary to use a deployment template!||PublishWizard||116458';
$nm_lang['publishwizard']['help']['help_pub_usar1']['msg'] = 'Create a new deployment template!||PublishWizard||116459';
$nm_lang['publishwizard']['help']['help_pub_zip_flag']['msg'] = 'Create a ZIP file at the end of deployment with all applications!||PublishWizard||116460';
$nm_lang['publishwizard']['help']['pub_helpcase']['msg'] = 'Only check this option if you are an expert user and know what are you doing.<br /> PHP usually stores the session in a file on the web server, check this option to change how PHP handles the session to store in a database.||PublishWizard||116470';
$nm_lang['publishwizard']['msg_cep'] = 'The published files get slightly larger.||PublishWizard||117675';
$nm_lang['publishwizard']['nao'] = 'No||PublishWizard||116440';
$nm_lang['publishwizard']['not_compiled'] = 'アプリケーションをコンパイルしてください||PublishWizard||116475';
$nm_lang['publishwizard']['novo_esquema'] = 'Template Name||PublishWizard||116418';
$nm_lang['publishwizard']['ok'] = 'OK||PublishWizard||116474';
$nm_lang['publishwizard']['prod'] = '共通ライブラリ||PublishWizard||116497';
$nm_lang['publishwizard']['pub_app_session'] = 'Store the session in a database.||PublishWizard||116490';
$nm_lang['publishwizard']['pub_app_session_con'] = 'Connection(Deployment Environment)||PublishWizard||116491';
$nm_lang['publishwizard']['pub_app_session_sch'] = 'Theme name||PublishWizard||116493';
$nm_lang['publishwizard']['pub_app_session_tab'] = 'Table name||PublishWizard||116492';
$nm_lang['publishwizard']['pub_arr_manuais'] = 'Manuals||PublishWizard||116489';
$nm_lang['publishwizard']['pub_conf_dir'] = 'Conf Folder||PublishWizard||116428';
$nm_lang['publishwizard']['pub_create_index_file'] = '最初のアプリケーションを選択||PublishWizard||116496';
$nm_lang['publishwizard']['pub_dir'] = 'フォルダ||PublishWizard||116422';
$nm_lang['publishwizard']['pub_dir_create'] = 'The deployment folder <b>{dir}</b>  does not exist, would you like to create?||PublishWizard||116441';
$nm_lang['publishwizard']['pub_dir_flag'] = 'サーバーディレクトリに展開する||PublishWizard||116419';
$nm_lang['publishwizard']['pub_doc_dir'] = 'ドキュメントフォルダ||PublishWizard||116431';
$nm_lang['publishwizard']['pub_ftp_dir'] = 'FTPフォルダー||PublishWizard||116426';
$nm_lang['publishwizard']['pub_ftp_flag'] = 'FTPサーバーに展開する||PublishWizard||116421';
$nm_lang['publishwizard']['pub_ftp_pass'] = 'パスワード||PublishWizard||116425';
$nm_lang['publishwizard']['pub_ftp_server'] = 'FTPサーバー||PublishWizard||116423';
$nm_lang['publishwizard']['pub_ftp_user'] = 'ユーザー||PublishWizard||116424';
$nm_lang['publishwizard']['pub_helpcase'] = 'Deploy manuals created with helpcase.||PublishWizard||116488';
$nm_lang['publishwizard']['pub_imag_dir'] = '画像フォルダ||PublishWizard||116429';
$nm_lang['publishwizard']['pub_perfil'] = 'Profile||PublishWizard||116433';
$nm_lang['publishwizard']['pub_perfil_flag'] = 'Use Profile||PublishWizard||116432';
$nm_lang['publishwizard']['pub_prod_dir'] = '共通ライブラリフォルダ||PublishWizard||116427';
$nm_lang['publishwizard']['pub_sftp_dir'] = 'SFTPパス（フルパス）||PublishWizard||153101';
$nm_lang['publishwizard']['pub_sftp_flag'] = 'SFTP||PublishWizard||153061';
$nm_lang['publishwizard']['pub_sftp_pass'] = 'SFTPパスワード||PublishWizard||153091';
$nm_lang['publishwizard']['pub_sftp_server'] = 'SFTPサーバ||PublishWizard||153071';
$nm_lang['publishwizard']['pub_sftp_user'] = 'SFTPユーザー||PublishWizard||153081';
$nm_lang['publishwizard']['pub_temp_dir'] = 'Tempフォルダ||PublishWizard||116430';
$nm_lang['publishwizard']['pub_with_cep'] = 'Publish the CEP||PublishWizard||117672';
$nm_lang['publishwizard']['pub_with_lib'] = '共通ファイルで展開する(CSS, buttons, images, messages)||PublishWizard||116494';
$nm_lang['publishwizard']['pub_with_prod'] = '共通ライブラリで展開する||PublishWizard||116495';
$nm_lang['publishwizard']['pub_zip_flag'] = 'アプリケーションでZIPを作成||PublishWizard||116420';
$nm_lang['publishwizard']['result'] = '結果||PublishWizard||116436';
$nm_lang['publishwizard']['sem_esquemas'] = 'Your Project does not have a deployment Template, it is necessary create one!||PublishWizard||116438';
$nm_lang['publishwizard']['sftp']['sftp_ok'] = 'SFTPサーバに正常に送信されたアプリケーション||PublishWizard||153131';
$nm_lang['publishwizard']['sftp']['sftp_title'] = 'SFTP!||PublishWizard||153141';
$nm_lang['publishwizard']['sim'] = 'Yes||PublishWizard||116439';
$nm_lang['publishwizard']['time'] = '処理時間||PublishWizard||116437';
$nm_lang['publishwizard']['tipo_publicacao'] = 'どのタイプのデプロイを使用しますか？||PublishWizard||116499';
$nm_lang['publishwizard']['tipo_template_A'] = 'advanced_pub||PublishWizard||116503';
$nm_lang['publishwizard']['tipo_template_T'] = 'typical_pub||PublishWizard||116502';
$nm_lang['publishwizard']['title']['delete'] = 'Delete select Template||PublishWizard||116472';
$nm_lang['publishwizard']['title']['publish'] = '迅速な導入||PublishWizard||116473';
$nm_lang['publishwizard']['total_time'] = '処理時間||PublishWizard||116480';
$nm_lang['publishwizard']['usar_esquemas'] = 'Use an existent Template||PublishWizard||116416';
$nm_lang['publishwizard']['usar_pub_adv'] = '上級||PublishWizard||116501';
$nm_lang['publishwizard']['usar_pub_tip'] = '標準 (おすすめ)||PublishWizard||116500';
$nm_lang['publishwizard']['zip'] = 'ZIP||PublishWizard||116498';
$nm_lang['publishwizard']['zipped_ok'] = 'クリックしてアプリケーションをダウンロードする||PublishWizard||116479';
$nm_lang['publishwizard']['zip_not_enabled'] = 'ZIP not enabled||PublishWizard||117683';
$nm_lang['publishwizard']['zip_prod'] = '共通ライブラリをダウンロードする||PublishWizard||116477';
$nm_lang['publishwizard']['zip_prod_wait'] = 'ZIPファイルが作成されている間、しばらくお待ちください||PublishWizard||116478';

?>