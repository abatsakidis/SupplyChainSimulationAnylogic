<?php

//---  Gera��o do arquivo de controle de sess�o em base de dados
//
    $tit_apl = (isset($oDados->apl['nome_aplicacao'])) ? $oDados->apl['nome_aplicacao'] : $nome_aplicacao;
    $arq_ss = fopen ($patch . $tit_apl . "_session.php", 'w') ;
    fwrite($arq_ss,"<?php\r\n") ;
    fwrite($arq_ss,"   \$NM_session_db = false;\r\n") ;
    fwrite($arq_ss,"   \$NM_session_prod  = \"\";\r\n") ;
    fwrite($arq_ss,"   \$NM_session_conf  = \"\";\r\n") ;
    fwrite($arq_ss,"   \$NM_session_conex = \"\";\r\n") ;
    fwrite($arq_ss,"   \$NM_session_tab   = \"\";\r\n") ;
    fwrite($arq_ss,"   \$NM_session_sch   = \"\";\r\n") ;

    if ($session_passinurl == "Y")
    {
        fwrite($arq_ss,"   if (!\$NM_session_db)\r\n") ;
        fwrite($arq_ss,"   {\r\n") ;
        fwrite($arq_ss,"       if (isset(\$_GET['script_case_session']) && !empty(\$_GET['script_case_session']))\r\n") ;
        fwrite($arq_ss,"       {\r\n") ;
        fwrite($arq_ss,"           session_id(\$_GET['script_case_session']);\r\n") ;
        fwrite($arq_ss,"       }\r\n") ;
        fwrite($arq_ss,"       if (isset(\$_POST['script_case_session']) && !empty(\$_POST['script_case_session']))\r\n") ;
        fwrite($arq_ss,"       {\r\n") ;
        fwrite($arq_ss,"           session_id(\$_POST['script_case_session']);\r\n") ;
        fwrite($arq_ss,"       }\r\n") ;
        fwrite($arq_ss,"   }\r\n") ;
    }

    fwrite($arq_ss,"   if (\$NM_session_db && !defined('NM_CONTR_SESS_DB'))\r\n") ;
    fwrite($arq_ss,"   {\r\n") ;
    fwrite($arq_ss,"       \$NM_dir_atual = getcwd();\r\n");
    fwrite($arq_ss,"       if (empty(\$NM_dir_atual))\r\n");
    fwrite($arq_ss,"       {\r\n");
    fwrite($arq_ss,"           \$str_path_sys = (isset(\$_SERVER['SCRIPT_FILENAME'])) ? \$_SERVER['SCRIPT_FILENAME'] : \$_SERVER['ORIG_PATH_TRANSLATED'];\r\n");
    fwrite($arq_ss,"           \$str_path_sys = str_replace(\"\\\\\", '/', \$str_path_sys);\r\n");
    fwrite($arq_ss,"       }\r\n");
    fwrite($arq_ss,"       else\r\n");
    fwrite($arq_ss,"       {\r\n");
    fwrite($arq_ss,"           \$sc_nm_arquivo = explode(\"/\", \$_SERVER['PHP_SELF']);\r\n");
    fwrite($arq_ss,"           \$str_path_sys  = str_replace(\"\\\\\", \"/\", getcwd()) . \"/\" . \$sc_nm_arquivo[count(\$sc_nm_arquivo)-1];\r\n");
    fwrite($arq_ss,"       }\r\n");
        fwrite($arq_ss,"       //check publication with the prod\r\n");
        fwrite($arq_ss,"       \$str_path_apl_url = \$_SERVER['PHP_SELF'];\r\n");
        fwrite($arq_ss,"       \$str_path_apl_url = str_replace(\"\\\\\", '/', \$str_path_apl_url);\r\n");
        fwrite($arq_ss,"       \$str_path_apl_url = substr(\$str_path_apl_url, 0, strrpos(\$str_path_apl_url, \"/\"));\r\n");
        fwrite($arq_ss,"       \$str_path_apl_url = substr(\$str_path_apl_url, 0, strrpos(\$str_path_apl_url, \"/\")+1);\r\n");
        fwrite($arq_ss,"       \$str_path_apl_dir = substr(\$str_path_sys, 0, strrpos(\$str_path_sys, \"/\"));\r\n");
        fwrite($arq_ss,"       \$str_path_apl_dir = substr(\$str_path_apl_dir, 0, strrpos(\$str_path_apl_dir, \"/\")+1);\r\n");
        fwrite($arq_ss,"       //check prod\r\n");
        fwrite($arq_ss,"       if(empty(\$NM_session_prod))\r\n");
        fwrite($arq_ss,"       {\r\n");
        fwrite($arq_ss,"               /*check prod*/\$NM_session_prod = \$str_path_apl_url . \"_lib/prod/\";\r\n");
        fwrite($arq_ss,"       }\r\n");
        fwrite($arq_ss,"       //end check publication with the prod\r\n");
    fwrite($arq_ss,"       \$str_path_web = \$_SERVER['PHP_SELF'];\r\n");
    fwrite($arq_ss,"       \$str_path_web = str_replace(\"\\\\\", '/', \$str_path_web);\r\n");
    fwrite($arq_ss,"       \$str_path_web = str_replace('//', '/', \$str_path_web);\r\n");
    fwrite($arq_ss,"       \$root         = substr(\$str_path_sys, 0, -1 * strlen(\$str_path_web));\r\n");
    fwrite($arq_ss,"       \$NM_session_prod = \$root . \$NM_session_prod;\r\n") ;
    fwrite($arq_ss,"       if (empty(\$NM_session_conf))\r\n") ;
    fwrite($arq_ss,"       {\r\n");
    fwrite($arq_ss,"           \$NM_session_conf = substr(\$NM_session_prod, 0, strrpos(\$NM_session_prod, '/'));\r\n");
    fwrite($arq_ss,"           \$NM_session_conf = substr(\$NM_session_conf, 0, strrpos(\$NM_session_conf, '/')) . \"/conf\";\r\n");
    fwrite($arq_ss,"       }\r\n");
    fwrite($arq_ss,"       include_once(\$NM_session_prod . \"/lib/php/nm_session.php\");\r\n") ;
    fwrite($arq_ss,"       \$sc_session  = new sc_session();\r\n") ;
    fwrite($arq_ss,"       \$sc_sess_sch = \$NM_session_sch;\r\n") ;
    fwrite($arq_ss,"       \$sc_sess_tab = \$NM_session_tab;\r\n") ;
    fwrite($arq_ss,"       \$sc_sess_db  = \$sc_session->conect(\$NM_session_conex, \$sc_sess_tab, \$NM_session_prod, \$NM_session_conf);\r\n") ;
    fwrite($arq_ss,"       if (\$sc_session->testTable(\$sc_sess_db, \$sc_sess_tab, \$sc_sess_sch))\r\n") ;
    fwrite($arq_ss,"       {\r\n") ;
    fwrite($arq_ss,"           \$mDbSessResult = ini_set('session.save_handler', 'user');\r\n") ;
    fwrite($arq_ss,"           if (false !== \$mDbSessResult)\r\n") ;
    fwrite($arq_ss,"           {\r\n") ;
    fwrite($arq_ss,"               session_set_save_handler(array(\$sc_session, 'open'),\r\n") ;
    fwrite($arq_ss,"                                        array(\$sc_session, 'close'),\r\n") ;
    fwrite($arq_ss,"                                        array(\$sc_session, 'read'),\r\n") ;
    fwrite($arq_ss,"                                        array(\$sc_session, 'write'),\r\n") ;
    fwrite($arq_ss,"                                        array(\$sc_session, 'destroy'),\r\n") ;
    fwrite($arq_ss,"                                        array(\$sc_session, 'gc')\r\n") ;
    fwrite($arq_ss,"                                       );\r\n") ;
    fwrite($arq_ss,"           }\r\n") ;
    fwrite($arq_ss,"       }\r\n") ;
    fwrite($arq_ss,"       define('NM_CONTR_SESS_DB', TRUE);\r\n") ;
    fwrite($arq_ss,"   }\r\n") ;
    fwrite($arq_ss,"?>\r\n") ;
    fclose($arq_ss);
?>