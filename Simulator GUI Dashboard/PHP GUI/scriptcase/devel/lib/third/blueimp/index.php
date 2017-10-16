<?php
/*
 * jQuery File Upload Plugin PHP Example 5.6
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */

   // scriptcase
   include_once('@@@SC_APL@@@_session.php');
   @session_start();
   // ----------

error_reporting(E_ALL | E_STRICT);

if (!function_exists('array_replace_recursive'))
{
    function array_replace_recursive($array, $array1)
    {
        function recurse($array, $array1)
        {
            foreach ($array1 as $key => $value)
            {
                // create new key in $array, if it is empty or not an array
                if (!isset($array[$key]) || (isset($array[$key]) && !is_array($array[$key])))
                {
                    $array[$key] = array();
                }

                // overwrite the value in the base array
                if (is_array($value))
                {
                    $value = recurse($array[$key], $value);
                }
                $array[$key] = $value;
            }
            return $array;
        }

        // handle the arguments, merge one by one
        $args = func_get_args();
        $array = $args[0];
        if (!is_array($array))
        {
            return $array;
        }
        for ($i = 1; $i < count($args); $i++)
        {
            if (is_array($args[$i]))
            {
                $array = recurse($array, $args[$i]);
            }
        }
        return $array;
    }
}

require('../_lib/lib/php/upload.class.php');

$upload_handler = new UploadHandler(array(
        'upload_dir'         => $_POST['upload_dir'],
        'upload_url'         => scUploadGetHost() . $_POST['upload_url'],
        'param_name'         => $_POST['param_name'],
        'upload_file_height' => $_POST['upload_file_height'],
        'upload_file_width'  => $_POST['upload_file_width'],
        'upload_file_aspect' => $_POST['upload_file_aspect'],
        'upload_file_type'   => $_POST['upload_file_type'],
));

require($_POST['app_dir'] . $_POST['app_name'] . '_nmutf8.php');

header('Pragma: no-cache');
header('Cache-Control: private, no-cache');
header('Content-Disposition: inline; filename="files.json"');
header('X-Content-Type-Options: nosniff');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: OPTIONS, HEAD, GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: X-File-Name, X-File-Type, X-File-Size');

switch ($_SERVER['REQUEST_METHOD']) {
    case 'OPTIONS':
        break;
    case 'HEAD':
    case 'GET':
        $upload_handler->get();
        break;
    case 'POST':
        $upload_handler->post();
        break;
    case 'DELETE':
        $upload_handler->delete();
        break;
    default:
        header('HTTP/1.1 405 Method Not Allowed');
}

function scUploadGetHost() {
        return
                        (isset($_SERVER['HTTPS']) ? 'https://' : 'http://').
                        (isset($_SERVER['REMOTE_USER']) ? $_SERVER['REMOTE_USER'].'@' : '').
                        (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : ($_SERVER['SERVER_NAME'].
                        (isset($_SERVER['HTTPS']) && $_SERVER['SERVER_PORT'] === 443 ||
                        $_SERVER['SERVER_PORT'] === 80 ? '' : ':'.$_SERVER['SERVER_PORT'])));
}

?>
