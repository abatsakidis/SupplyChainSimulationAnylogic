<?php
/**
 * $Id: nm_serialize.php,v 1.4 2011-11-17 17:58:18 diogo Exp $
 */

if (!defined('NM_INC_PROD_XML'))
{
    define('NM_INC_PROD_XML', TRUE);
}

function nm_unserialize_ini($ini_file)
{
        if(!isset($_SESSION['nm_session']['cache']['prod_v8'][$ini_file]) || empty($_SESSION['nm_session']['cache']['prod_v8'][$ini_file]))
        {
                global $nm_config;

                $arr_prod_ini = getProdDefault();

                if(is_file($ini_file))
                {
                        $str_prod = file_get_contents($ini_file);
                        if(substr($str_prod, 0, 8) == '<?php /*')
                        {
                                $str_prod = substr($str_prod, 8, -5);
                        }

                        $arr_prod_tmp = unserialize($str_prod);
                        foreach($arr_prod_tmp as $tag=>$val)
                        {
                                $arr_prod_ini[$tag] = $val;
                        }
                }

                $_SESSION['nm_session']['cache']['prod_v8'][$ini_file] = $arr_prod_ini;
        }

    return $_SESSION['nm_session']['cache']['prod_v8'][$ini_file];
}

function getProdDefault()
{
        $arr_prod_ini            = array();
        $arr_prod_ini["PROFILE"] = array();
    $arr_prod_ini["GLOBAL"]  = array();
    $arr_prod_ini["GLOBAL"]["GC_DIR"] = dirname(dirname(dirname(dirname(__FILE__)))) . '/tmp';
    $arr_prod_ini["GLOBAL"]["GC_MIN"] = '30';
    $arr_prod_ini["GLOBAL"]["PDF_SERVER_WKHTML"] = '';
    $arr_prod_ini["GLOBAL"]["JAVA_PATH"] = '';
    $arr_prod_ini["GLOBAL"]["JAVA_BIN"] = '';
        $arr_prod_ini["GLOBAL"]["JAVA_PROTOCOL"] = '';
    $arr_prod_ini["GLOBAL"]["SEC_TYPE"] = '';
    $arr_prod_ini["GLOBAL"]["SEC_HOST"] = '';
    $arr_prod_ini["GLOBAL"]["SEC_USER"] = '';
    $arr_prod_ini["GLOBAL"]["SEC_PASS"] = '';
    $arr_prod_ini["GLOBAL"]["SEC_BASE"] = '';
    $arr_prod_ini["GLOBAL"]["SEC_PATH"] = '';
    $arr_prod_ini["GLOBAL"]["GOOGLEMAPS_API_KEY"] = '';
    $arr_prod_ini["GLOBAL"]["PHP_TIMEZONE"] = '';
    $arr_prod_ini["GLOBAL"]["SEC_USAR"] = "N";
    $arr_prod_ini["GLOBAL"]["PASSWORD"] = '';
    $arr_prod_ini["GLOBAL"]["LANGUAGE"] = '';

        return $arr_prod_ini;
}


function nm_serialize_ini($arr_ini)
{
    return "<?php /*" . serialize($arr_ini) . "*/ ?>";
}

?>