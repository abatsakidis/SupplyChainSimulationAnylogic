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
 
$nm_lang['error_db_connection'] = 'データベース接続中にエラーが発生しました||Install||115423';
$nm_lang['error_db_mysql_auth'] = 'お使いのＰＨＰバージョンはMySQLサーバーの認証プロトコルとの相互性がありません。詳しくはこちらへ:||Install||115426';
$nm_lang['error_user_pass_empty'] = 'The password of the user cannot be empty.||Install||115433';
$nm_lang['install_change_phpini'] = '必要な拡張機能を追加する手動でphp.iniを変更したり、あなたのための拡張機能を有効にしようとするScriptcaseを有効にするには、有効リンクをクリックしてください。||Install||139271';
$nm_lang['install_custom_desc'] = 'あなたはそれにアクセスするためにScriptCaseおよびデフォルトのユーザ名とパスワードをインストールしたいデータベースに選択することができます。||Install||139301';
$nm_lang['install_custom_title'] = 'カスタマインストール：||Install||139291';
$nm_lang['install_db_base'] = 'データベース||Install||115476';
$nm_lang['install_db_change_database'] = 'データベースを変更||Install||117649';
$nm_lang['install_db_dbms'] = 'DBMS||Install||115477';
$nm_lang['install_db_esquema'] = 'スキーマ||Install||115481';
$nm_lang['install_db_host'] = 'サーバー||Install||115478';
$nm_lang['install_db_msg'] = 'ScriptCaseはアプリケーションデータをデータベースに記録します。ScriptCaseがデータベースに接続できるよう、接続パラメーターを選択する必要があります||Install||115475';
$nm_lang['install_db_pass'] = 'パスワード||Install||115479';
$nm_lang['install_db_sqlite_recommended'] = 'メインScriptCaseデータベースにSQLiteを使用することをお勧めします。 <br> SQLiteを使用されますと、アプリケーションの <b>自動バックアップ</b>などのScriptCaseの機能があり信頼性があります。  <br> 別のデータベースにScriptCaseをインストールされる場合は、 <br>プロジェクトやそれに関するデータの自動バックアップScriptCaseは実行されませんのでご注意ください。||Install||117646';
$nm_lang['install_db_user'] = 'ユーザー||Install||115480';
$nm_lang['install_dir_msg'] = 'ScriptCaseはファイルで様々なオペレーションを行う。そのため、書き込み可能のパーミッションを設定する必要があるフォルダもある。そのフォルダは書き込み可能のパーミッションで設定してるかどうかを確認してください。||Install||115474';
$nm_lang['install_end_msg'] = 'ScriptCaseの設定が完了、開始準備ができました||Install||115509';
$nm_lang['install_end_warn_msg'] = 'ScriptCaseがあなたのwebサーバーにインストールされました。次ボタンを押して、ログインページへ進んでください||Install||115510';
$nm_lang['install_end_warn_tit'] = 'インストール完了||Install||115511';
$nm_lang['install_ext_com_dotnet_desc'] = 'この拡張機能は ADO (Oracle, MS SQL Server, MS Access)を通してデータベースにアクセスするために使用されます||Install||115442';
$nm_lang['install_ext_com_dotnet_title'] = 'COM||Install||115443';
$nm_lang['install_ext_gd_desc'] = 'この拡張子はグラフ作成と画像処理の際に使用されます ||Install||115444';
$nm_lang['install_ext_gd_title'] = 'GD||Install||115445';
$nm_lang['install_ext_ibm_db2_desc'] = 'DB2データベースアクセスに使用される拡張機能||Install||115448';
$nm_lang['install_ext_ibm_db2_title'] = 'DB2||Install||115449';
$nm_lang['install_ext_interbase_desc'] = 'この拡張機能は Interbase、Firebird データベースにアクセスするために使用されます||Install||115446';
$nm_lang['install_ext_interbase_title'] = 'Interbase||Install||115447';
$nm_lang['install_ext_json_desc'] = 'この拡張機能は、データ交換形式のJavaScript Object Notation（JSON）を実装しています。||Install||152259';
$nm_lang['install_ext_json_title'] = 'JSON||Install||152249';
$nm_lang['install_ext_mbstring_desc'] = 'この拡張機能は特別な文字を変換するために使用されます||Install||115470';
$nm_lang['install_ext_mbstring_title'] = 'MBSTRING||Install||115471';
$nm_lang['install_ext_msg'] = '必要なPHP拡張モジュールがロードされているかどうかをチェックします。||Install||139160';
$nm_lang['install_ext_mssql_desc'] = 'この拡張子はMySQLサーバーデータベースにアクセスする際に使用されます||Install||115450';
$nm_lang['install_ext_mssql_title'] = 'MS SQLサーバー||Install||115451';
$nm_lang['install_ext_mysql_desc'] = 'この拡張子はMySQLデータベースにアクセスする際に使用されます||Install||115452';
$nm_lang['install_ext_mysql_title'] = 'MySQL||Install||115453';
$nm_lang['install_ext_not_loading'] = '拡張はすでにphp.iniで有効になっていますが、PHPはそれを読み込むことができません。あなたのPHPが正しくインストールされていればextesion任意の依存関係が必要か、どうかを確認してください。||Install||139200';
$nm_lang['install_ext_oci8_desc'] = 'この拡張子はOracle 8データベースにアクセスする際に使用されます||Install||115460';
$nm_lang['install_ext_oci8_title'] = 'oracle 8||Install||115461';
$nm_lang['install_ext_odbc_desc'] = 'この拡張機能はODBC (Oracle, DB2, MS SQL Server, MS Access)を通してデータベースにアクセスするために使用されます||Install||115462';
$nm_lang['install_ext_odbc_title'] = 'ODBC||Install||115463';
$nm_lang['install_ext_oracle_desc'] = 'この拡張子はOracle 7データベースにアクセスする際に使用されます||Install||115464';
$nm_lang['install_ext_oracle_title'] = 'Oracle 7||Install||115465';
$nm_lang['install_ext_pdo_sqlite_desc'] = 'この拡張子はSQLite3データベースにアクセスする際に使用されます||Install||117647';
$nm_lang['install_ext_pdo_sqlite_title'] = 'SQLite PDO / SQLite3||Install||117648';
$nm_lang['install_ext_pgsql_desc'] = 'この拡張子はPostGreSQLデータベースにアクセスする際に使用されます||Install||115454';
$nm_lang['install_ext_pgsql_title'] = 'PostGreSQL||Install||115455';
$nm_lang['install_ext_simplexml_desc'] = 'SimpleXML拡張モジュールは、通常のプロパティセレクタや配列反復子で処理することができるオブジェクトにXMLを変換するために非常にシンプルで簡単に利用可能なツールセットを提供します。||Install||139140';
$nm_lang['install_ext_simplexml_title'] = 'SimpleXMLを||Install||139131';
$nm_lang['install_ext_sqlite_desc'] = 'この拡張子はSQLiteデータベースにアクセスする際に使用されます||Install||115456';
$nm_lang['install_ext_sqlite_title'] = 'SQLite||Install||115457';
$nm_lang['install_ext_sybase_ct_desc'] = 'この拡張子はSybase データベースにアクセスする際に使用されます||Install||115458';
$nm_lang['install_ext_sybase_ct_title'] = 'Sybase||Install||115459';
$nm_lang['install_ext_title_action'] = 'アクション||Install||139251';
$nm_lang['install_ext_title_db'] = 'データベースの拡張||Install||139241';
$nm_lang['install_ext_title_enable'] = '有効にする||Install||139261';
$nm_lang['install_ext_title_mandatory'] = '必要なエクステンション||Install||139231';
$nm_lang['install_ext_xml_desc'] = 'この拡張子はXMLコンテンツ操作のために使用されます||Install||115466';
$nm_lang['install_ext_xml_title'] = 'XML||Install||115467';
$nm_lang['install_ext_zip_desc'] = 'この拡張子はZIPアーカイブからファイルを抽出、作成する際に使用されます||Install||115472';
$nm_lang['install_ext_zip_title'] = 'ZIP||Install||115473';
$nm_lang['install_ext_zlib_desc'] = 'この拡張子はZIPアーカイブからファイルを抽出する際に使用されます||Install||115468';
$nm_lang['install_ext_zlib_title'] = 'ZLIB||Install||115469';
$nm_lang['install_init_lang'] = 'インストール時に使用される言語の選択||Install||115435';
$nm_lang['install_init_msg_1'] = 'ScriptCaseへようこそ||Install||115436';
$nm_lang['install_init_msg_2'] = 'このウィザードはScriptCaseのインストール、構成手順を説明します。 ツールを起動するための環境調整など、ステージごとに説明していきます。||Install||115437';
$nm_lang['install_lic_msg'] = '登録するにはScriptCaseコピーのシリアルナンバーを入力してください。コピーを調べる場合は、テキストボックスに何も入力しないでください||Install||115438';
$nm_lang['install_missing_mandatory'] = 'すべての必要な拡張機能がロードされたときだけ、進むことができます。 <br /><br />行方不明の拡張子<b>：％sです</b> 。||Install||139170';
$nm_lang['install_missing_phpini_empty'] = 'これは、php.iniにパスを識別することができませんでした。||Install||139180';
$nm_lang['install_missing_phpini_file'] = 'パス<i>％s</i>にphp.iniを見つけることができませんでした。||Install||139190';
$nm_lang['install_missing_phpini_perm'] = '<i>％sは</i>ドン &#39;トンに位置してphp.iniとは、必要な変更を保存するための書き込み権限を持っている。||Install||139210';
$nm_lang['install_missing_sc_db'] = '使用した標準的なインストールを続行するには、PDO_SQLITE拡張を有効にする必要があります。||Install||139331';
$nm_lang['install_mode'] = 'インストールモード：||Install||139281';
$nm_lang['install_phpini_error'] = 'php.iniを変更できませんでした。||Install||139221';
$nm_lang['install_step'] = 'ステップ||Install||115413';
$nm_lang['install_step_db'] = 'データベース||Install||115414';
$nm_lang['install_step_dir'] = 'システムフォルダー||Install||115415';
$nm_lang['install_step_end'] = '終了中||Install||115416';
$nm_lang['install_step_ext'] = 'PHP機能拡張||Install||115419';
$nm_lang['install_step_init'] = '起動中||Install||115417';
$nm_lang['install_step_lic'] = 'ライセンス登録||Install||115418';
$nm_lang['install_step_table'] = 'ScriptCaseテーブル||Install||115420';
$nm_lang['install_step_user'] = 'ユーザー||Install||115421';
$nm_lang['install_tab_msg'] = 'ScriptCaseはアプリケーション開発データを記録するために、データベース上のテーブルを使用します||Install||115482';
$nm_lang['install_tab_ok'] = '全てのScriptCaseテーブルは作成済みです||Install||115484';
$nm_lang['install_tab_sc_tbapl'] = 'アプリケーションテーブル||Install||115488';
$nm_lang['install_tab_sc_tbati'] = 'ユーザーステータステーブル||Install||115487';
$nm_lang['install_tab_sc_tbcmp'] = 'フィールドテーブル||Install||115489';
$nm_lang['install_tab_sc_tbconex'] = '接続テーブル||Install||115495';
$nm_lang['install_tab_sc_tbevt'] = 'イベントテーブル||Install||115497';
$nm_lang['install_tab_sc_tblog'] = 'ログスキームのテーブル||Install||118300';
$nm_lang['install_tab_sc_tblog_apl'] = 'アプリケーションバックアップテーブル||Install||115490';
$nm_lang['install_tab_sc_tblog_cmp'] = 'フィールドのテーブルをバックアップ||Install||115491';
$nm_lang['install_tab_sc_tblog_evt'] = 'イベントバックアップテーブル||Install||115498';
$nm_lang['install_tab_sc_tbmsg'] = 'ユーザ間のメッセージの表||Install||149572';
$nm_lang['install_tab_sc_tbprj'] = 'テーブルで分ける||Install||115485';
$nm_lang['install_tab_sc_tbrep'] = 'データディクショナリテーブル||Install||115492';
$nm_lang['install_tab_sc_tbrep_fields'] = 'データ辞書(フィールド) テーブル&#39;;||Install||115494';
$nm_lang['install_tab_sc_tbrep_tables'] = 'データ辞書(テーブル) テーブル&#39;;||Install||115493';
$nm_lang['install_tab_sc_tbsess'] = 'セッションテーブル||Install||117450';
$nm_lang['install_tab_sc_tbtodo'] = 'タスク一覧の表||Install||149562';
$nm_lang['install_tab_sc_tbtrans'] = 'トランザクションテーブル||Install||115499';
$nm_lang['install_tab_sc_tbusu'] = 'ユーザーテーブル||Install||115486';
$nm_lang['install_tab_sc_tbversao'] = 'プロジェクトバージョンテーブル||Install||115496';
$nm_lang['install_tipica_desc'] = 'Scriptcaseは、すべてを自動的にインストールします。||Install||139321';
$nm_lang['install_tipica_title'] = '標準インストール：||Install||139311';
$nm_lang['install_user_conf'] = '確認||Install||115501';
$nm_lang['install_user_login'] = 'ログイン||Install||115502';
$nm_lang['install_user_msg'] = 'ScriptCaseへのアクセスは、ユーザー/パスワードシステムを通して行われます。最初のアクセスの際、ユーザーは管理権限と共に作成されます。これはシステムへのログオンと新しいユーザー作成が許可されます。||Install||115500';
$nm_lang['install_user_pass'] = 'パスワード||Install||115503';
$nm_lang['odbc_name'] = 'ODBC名||Install||144349';
$nm_lang['oracle_tsname'] = 'TSNAME名||Install||144359';
$nm_lang['page_title'] = 'インストール||Install||115412';

?>