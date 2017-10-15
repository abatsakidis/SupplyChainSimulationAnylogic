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
 
$nm_lang['btn_list_db'] = 'リストデータベース||AdminSysAllConectionsCreateWizard||116522';
$nm_lang['cant_create_conn_scprj'] = 'ScriptCaseプロジェクトの例は、デモンストレーションとしてのみ動作します。<br> このタイプのプロジェクトでは接続の作成、編集はできません。||AdminSysAllConectionsCreateWizard||118215';
$nm_lang['create_conn_wizard']['btnavancar'] = '次へ||AdminSysAllConectionsCreateWizard||109543';
$nm_lang['create_conn_wizard']['btnconcluir'] = '保存||AdminSysAllConectionsCreateWizard||109544';
$nm_lang['create_conn_wizard']['btnhelp'] = 'ヘルプ||AdminSysAllConectionsCreateWizard||109547';
$nm_lang['create_conn_wizard']['btnsair'] = 'キャンセル||AdminSysAllConectionsCreateWizard||109546';
$nm_lang['create_conn_wizard']['btntestar'] = 'テスト接続||AdminSysAllConectionsCreateWizard||109545';
$nm_lang['create_conn_wizard']['btnvoltar'] = '戻る||AdminSysAllConectionsCreateWizard||109542';
$nm_lang['create_conn_wizard']['descricoes']['access'] = 'アクセスデータベースファイルへのパス||AdminSysAllConectionsCreateWizard||109565';
$nm_lang['create_conn_wizard']['descricoes']['base'] = 'テーブルの存在するデータベース名||AdminSysAllConectionsCreateWizard||109558';
$nm_lang['create_conn_wizard']['descricoes']['conn'] = '作成される接続を識別するために名前を付ける。アプリケーション作成を開始しますと、選べる接続がこの接続になります。||AdminSysAllConectionsCreateWizard||109553';
$nm_lang['create_conn_wizard']['descricoes']['dbms'] = '接続しようとしているデーターベース種類||AdminSysAllConectionsCreateWizard||109554';
$nm_lang['create_conn_wizard']['descricoes']['decimal'] = 'DBMS小数点。アプリケーションによるinsertとupdateで利用される。<br><br>例として’.’の小数点を利用する場合：UPDATE TB_EXAMPLE SET Salary = 1500.00 WHERE CLIENTID = 1<br><br><br>または例として’,’ の小数点を利用する場合：UPDATE TB_EXAMPLE SET Salary = ‘1500.00’ WHERE CLIENTID = 1||AdminSysAllConectionsCreateWizard||109556';
$nm_lang['create_conn_wizard']['descricoes']['ibase'] = 'To connect to Interbase, you must inform the machine address (IP, DNS or name), colon and the database file path.<BR ><BR >Eg: 192.168.254.254:c:ibasedatabase.gdb!||AdminSysAllConectionsCreateWizard||109564';
$nm_lang['create_conn_wizard']['descricoes']['odbc'] = 'データベースにアクセスするために作成されたODBC名||AdminSysAllConectionsCreateWizard||109561';
$nm_lang['create_conn_wizard']['descricoes']['oracle'] = 'データベースにアクセスするためのOracle TSNAME||AdminSysAllConectionsCreateWizard||109563';
$nm_lang['create_conn_wizard']['descricoes']['retrieve_schema'] = 'テーブル名の前にスキーマ名を使用したい場合は選択してください。 例：public.table_name. <br> <br>　分からない場合は、デフォルト値のままにしておいてください。||AdminSysAllConectionsCreateWizard||109570';
$nm_lang['create_conn_wizard']['descricoes']['schema'] = 'テーブルの存在するスキーマ||AdminSysAllConectionsCreateWizard||109559';
$nm_lang['create_conn_wizard']['descricoes']['server'] = 'データベースが記録されるサーバーアドレス。ローカルまたは遠隔マシンである必要があります。マシン名とIPまたはDNSを知らせてください||AdminSysAllConectionsCreateWizard||109557';
$nm_lang['create_conn_wizard']['descricoes']['sgdb'] = 'DBMSへの接続方法。具体的なデータベースバージョンを使用して接続、またはADOかODBCで接続||AdminSysAllConectionsCreateWizard||109555';
$nm_lang['create_conn_wizard']['descricoes']['sqlite'] = 'SQLiteデータベースファイルへのパス||AdminSysAllConectionsCreateWizard||109562';
$nm_lang['create_conn_wizard']['descricoes']['use_persistent'] = '持続的の接続。つまり接続を閉じても接続のプールに残る。新しい接続を開く場合は接続プールを確認し、ある場合はハンドルを取得する。<br><br>基本的にこのやり方の方が速い（新しい接続を開始しないから）。<br><br>しかし全てのデータベースに対応してるわけではない（または速くない場合もありえる）。<br><br>あるデータベースにキャッシュ残す場合がある。この場合は新しい接続を開いたほうが良い。||AdminSysAllConectionsCreateWizard||109569';
$nm_lang['create_conn_wizard']['erro']['conn_e'] = 'This connection name already exists!||AdminSysAllConectionsCreateWizard||109551';
$nm_lang['create_conn_wizard']['erro']['pass_confirm'] = 'パスワードとパスワードの確認は同じものを入力してください||AdminSysAllConectionsCreateWizard||109552';
$nm_lang['create_conn_wizard']['erro']['title'] = 'エラー||AdminSysAllConectionsCreateWizard||109548';
$nm_lang['database_watermaark'] = 'データベース名を入力するかリストしてください||AdminSysAllConectionsCreateWizard||118644';
$nm_lang['error_extension_disabled'] = '拡張子は、php.iniファイルにロードされていません。 <br>より多くの情報のためのヘルプアイコンをクリックします。||AdminSysAllConectionsCreateWizard||152661';
$nm_lang['form_db2_warning'] = '注意：下記の設定はネイティブ ibm_db2 ドライブへの細かい設定です。<br>意味が分かる場合のみ変更してください。詳細はこちら: <br>http://br2.php.net/manual/pt_BR/function.db2-connect.php||AdminSysAllConectionsCreateWizard||109573';
$nm_lang['label']['access'] = 'パス||AdminSysAllConectionsCreateWizard||109536';
$nm_lang['label']['base'] = 'データベース名||AdminSysAllConectionsCreateWizard||109522';
$nm_lang['label']['conn'] = '接続名||AdminSysAllConectionsCreateWizard||109528';
$nm_lang['label']['dbms'] = 'DBMS||AdminSysAllConectionsCreateWizard||109517';
$nm_lang['label']['db_adv'] = '高度な||AdminSysAllConectionsCreateWizard||151835';
$nm_lang['label']['db_conn'] = '接続||AdminSysAllConectionsCreateWizard||151815';
$nm_lang['label']['db_filter'] = 'フィルター||AdminSysAllConectionsCreateWizard||151825';
$nm_lang['label']['decimal'] = '十進数||AdminSysAllConectionsCreateWizard||109529';
$nm_lang['label']['ibase'] = 'IP:PATH||AdminSysAllConectionsCreateWizard||109535';
$nm_lang['label']['odbc'] = 'ODBC名||AdminSysAllConectionsCreateWizard||109520';
$nm_lang['label']['oracle'] = 'ボツワナ||AdminSysAllConectionsCreateWizard||109521';
$nm_lang['label']['pass'] = 'パスワード||AdminSysAllConectionsCreateWizard||109526';
$nm_lang['label']['php_charset_conn'] = 'データベースのcharset||AdminSysAllConectionsCreateWizard||137881';
$nm_lang['label']['port'] = 'ポート||AdminSysAllConectionsCreateWizard||117739';
$nm_lang['label']['retrieve_schema'] = 'テーブル名の前にスキーマを使用する||AdminSysAllConectionsCreateWizard||109539';
$nm_lang['label']['schema'] = 'スキーマ||AdminSysAllConectionsCreateWizard||109523';
$nm_lang['label']['server'] = 'サーバー/ホスト (名前 or IP)||AdminSysAllConectionsCreateWizard||109519';
$nm_lang['label']['sgdb'] = 'DBMSの種類||AdminSysAllConectionsCreateWizard||109518';
$nm_lang['label']['sqlite'] = 'パス||AdminSysAllConectionsCreateWizard||109537';
$nm_lang['label']['user'] = 'ユーザー名||AdminSysAllConectionsCreateWizard||109525';
$nm_lang['label']['use_persistent'] = '常時接続||AdminSysAllConectionsCreateWizard||109538';
$nm_lang['lbl_hide_filter'] = 'フィルターを隠す||AdminSysAllConectionsCreateWizard||117726';
$nm_lang['lic_new_error_pr_'] = 'Your license Professiona Edition only allow to create 5 connections.<BR>Please, contact sales@scriptcase.net to migrate to another license type.||AdminSysAllConectionsCreateWizard||109572';
$nm_lang['mainmenu_new_conn'] = '新しい接続||AdminSysAllConectionsCreateWizard||118084';
$nm_lang['msg_cancel_create_conn'] = 'キャンセルしますか？||AdminSysAllConectionsCreateWizard||109574';
$nm_lang['msg_conn_erro'] = '接続エラー||AdminSysAllConectionsCreateWizard||117740';
$nm_lang['msg_empty_lst_conn'] = '接続のリストが空です。||AdminSysAllConectionsCreateWizard||117771';
$nm_lang['msg_err_base_empty'] = 'データベースを選択してください.この種類のデーターベースに接続するため、Oracle Instant Clientをインストールする必要があります。||AdminSysAllConectionsCreateWizard||118178';
$nm_lang['msg_err_charset_prj'] = 'データベースcharset　<b>%s</b>　は、プロジェクト（<b>%s</b>）の他のcharsetと互換性がありません。以下のcharsetを自動的に<b>%s</b>にを変更してもよろしいですか？||AdminSysAllConectionsCreateWizard||144516';
$nm_lang['msg_err_charset_prj_title'] = '警告：互換性のない文字セットエンコーディング||AdminSysAllConectionsCreateWizard||144526';
$nm_lang['msg_err_server_empty'] = 'サーバー/ホスト (名またはIP）が設定されていません||AdminSysAllConectionsCreateWizard||117744';
$nm_lang['msg_err_user_empty'] = 'ユーザーが供給されていません||AdminSysAllConectionsCreateWizard||117745';
$nm_lang['new_denied'] = 'Access Denied||AdminSysAllConectionsCreateWizard||109571';
$nm_lang['page_title'] = 'アイコンをクリックして接続するDBMSを選択||AdminSysAllConectionsCreateWizard||109515';
$nm_lang['step_description']['db'] = 'プロジェクトに利用したいデータベースタイプを選択してください。次に、ユーザー名やパスワードなどの選択したデータベースへのアクセス情報を入力してください。||AdminSysAllConectionsCreateWizard||147486';
$nm_lang['tip']['access'] = 'MS Accessバージョン2007/2010より古いもので作業するには、&quot;Microsoft Access Database Engine&quot;をインストールしてください。||AdminSysAllConectionsCreateWizard||118193';
$nm_lang['tip']['ado_mssql'] = 'COMオプションが有効になってる場合は診断(メインメニュー: ヘルプ| 診断)を確認してください。<br>COMオプションに問題がある場合は、MDACが正確にコンピューターにインストールされているか確認してください。バージョン2.6以上を推奨しています。 ||AdminSysAllConectionsCreateWizard||117989';
$nm_lang['tip']['borland_ibase'] = 'php.ini内のExtension/module php_interbase.dllを有効にしてください。||AdminSysAllConectionsCreateWizard||117392';
$nm_lang['tip']['db2'] = 'このタイプのデータベースに接続するには、IBM DB2 Universal clientをインストールしてください。<br>php.ini内のExtension/module db2.dllを有効にしてください。||AdminSysAllConectionsCreateWizard||116519';
$nm_lang['tip']['firebird'] = 'php.ini内のExtension/module php_interbase.dllを有効にしてください。<br>Windowsサービスファイルを編集して3050/tcpポートのgds_dbを追加 (ラインを追加: gds_db 3050/tcp # Firebird)してください||AdminSysAllConectionsCreateWizard||118170';
$nm_lang['tip']['ibase'] = 'php.ini内のExtension/module php_interbase.dllを有効にしてください||AdminSysAllConectionsCreateWizard||116518';
$nm_lang['tip']['informix'] = 'php.ini内のExtension/module ifx.dllを有効にしてください。 <br>このタイプのデータベースに接続するにはInformix client (IBM Informix Connect)をインストールしてください||AdminSysAllConectionsCreateWizard||118172';
$nm_lang['tip']['mssql'] = 'php.ini 内のExtension/module mssql.dll を有効にしてください。<br>同じサーバーにMS-SQLサーバーもインストールしてください。||AdminSysAllConectionsCreateWizard||117377';
$nm_lang['tip']['mssqlnative'] = 'Microsoft SQL Server Native Clientをインストールしてください(sqlncli)||AdminSysAllConectionsCreateWizard||116521';
$nm_lang['tip']['oci8'] = 'この種類のデータベースに接続するため、Oracleインスタントクライアントをインストールする必要があります。 <br>oci8.dllという拡張・モジュールをphp.iniの中で有効する必要があります。 <br />接続を行うため、<a href=https://suporte.scriptcase.com.br/index.php?/Knowledgebase/Article/View/519/0/oracle-connection---scriptcase-8 target=blank>このチュートリアル</a>を参考してください。||AdminSysAllConectionsCreateWizard||150545';
$nm_lang['tip']['oci805'] = 'このタイプのデータベースに接続するには、Oracle Instant Client がインストールされていなければなりません<br> php.ini内のExtension/module oci8.dll を有効にしてください <br /> 接続を実行するには、 <a href=https://suporte.scriptcase.com.br/index.php?/Knowledgebase/Article/View/519/0/oracle-connection---scriptcase-8 target=blank>チュートリアルに従う</a>||AdminSysAllConectionsCreateWizard||118177';
$nm_lang['tip']['oci8po'] = 'この種類のデータベースに接続するため、Oracleインスタントクライアントをインストールする必要があります。 <br>oci8.dllという拡張・モジュールをphp.iniの中で有効する必要があります。 <br />接続を行うため、<a href=https://suporte.scriptcase.com.br/index.php?/Knowledgebase/Article/View/519/0/oracle-connection---scriptcase-8 target=blank>このチュートリアル</a>を参考してください。||AdminSysAllConectionsCreateWizard||150555';
$nm_lang['tip']['odbc_mssql'] = ' ODBC接続を作成する必要があります。スタート > 設定 > コントロールパネル > 管理ツール > データソース (ODBCはScriptCaseがインストールされている場所と同じホストに作成してください)　<br>* Windows 64ビット環境をご使用の場合は、 &quot;../windows/syswow64/&quot; フォルダー内の &quot;odbcad32.exe&quot; アプリケーションからODBCを作成する必要があります||AdminSysAllConectionsCreateWizard||113925';
$nm_lang['tip']['odbc_oracle'] = 'この種類のデータベースに接続するため、Oracleインスタントクライアントをインストールする必要があります。 <br>oci8.dllという拡張・モジュールをphp.iniの中で有効する必要があります。 <br />接続を行うため、<a href=https://suporte.scriptcase.com.br/index.php?/Knowledgebase/Article/View/3/0/oracle-connection---oci8 target=blank>このチュートリアル</a>を参考してください。||AdminSysAllConectionsCreateWizard||150535';
$nm_lang['tip']['oracle'] = 'このタイプのデータベースに接続するにはOracle Instant Clientをインストールしてください。<br>php.ini内のExtension/module oci8.dllを有効にしてください。 <br /> 接続を実行するには、 <a href=https://suporte.scriptcase.com.br/index.php?/Knowledgebase/Article/View/3/0/oracle-connection---oci8 target=blank>チュートリアルに従う</a>||AdminSysAllConectionsCreateWizard||116520';
$nm_lang['tip']['pdo_informix'] = 'IBM Informix Client-SDKをインストールしてください<br>php.ini内の次のExtension/moduleをこの順番で有効にしてください:  php_pdo.dll、 php_pdo_ibm.dll、 php_pdo_informix.dll.||AdminSysAllConectionsCreateWizard||118173';
$nm_lang['tip']['pdo_sqlsrv'] = 'ドライバーのネイティブSRV PDOを利用するため、SQL Server 2012 Native Client*をインストールする必要があります。<br>php_pdo_sqlsrv_54_nts.dlllという拡張をphp.iniの中で有効する必要があります。<br>SQLSRV　PDOというモジュールを有効するため、php.iniの中でphp_pdo_sqlsrv_54_nts.dllというDLLを探して、「；」（セミコロン）を削除してください。||AdminSysAllConectionsCreateWizard||150565';
$nm_lang['tip']['sybase'] = 'SyBaseクライアントをインストールしてください。<br>php.ini内のExtension/module php_sybase_ct.dll を有効にする必要があります。||AdminSysAllConectionsCreateWizard||118171';
$nm_lang['values']['nao'] = 'いいえ||AdminSysAllConectionsCreateWizard||109541';
$nm_lang['values']['sim'] = 'はい||AdminSysAllConectionsCreateWizard||109540';

?>