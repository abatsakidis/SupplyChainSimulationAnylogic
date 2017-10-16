<?php

class nmConnection
{

    function nmConnection()
    {
    } // nmConnection


    function TestConn($arr_conn)
    {
    	global $nm_config;

    	$bol_conn   = FALSE;
    	$str_db_err = '';

        $str_dbms                  = isset($arr_conn['dbms']) ? $arr_conn['dbms'] : "";
        $str_host                  = isset($arr_conn['host']) ? $arr_conn['host'] : "";
        $str_user                  = isset($arr_conn['user']) ? $arr_conn['user'] : "";
        $str_pass                  = isset($arr_conn['pass']) ? $arr_conn['pass'] : "";
        $str_base                  = isset($arr_conn['base']) ? $arr_conn['base'] : "";
        $postgres_encoding         = isset($arr_conn['postgres_encoding']) ? $arr_conn['postgres_encoding'] : "";
        $oracle_encoding           = isset($arr_conn['oracle_encoding']) ? $arr_conn['oracle_encoding'] : "";
        $mysql_encoding            = isset($arr_conn['mysql_encoding']) ? $arr_conn['mysql_encoding'] : "";
        $str_db2_autocommit        = isset($arr_conn['db2_autocommit']) ? $arr_conn['db2_autocommit'] : "";
        $str_db2_i5_lib            = isset($arr_conn['db2_i5_lib']) ? $arr_conn['db2_i5_lib'] : "";
        $str_db2_i5_naming         = isset($arr_conn['db2_i5_naming']) ? $arr_conn['db2_i5_naming'] : "";
        $str_db2_i5_commit         = isset($arr_conn['db2_i5_commit']) ? $arr_conn['db2_i5_commit'] : "";
        $str_db2_i5_query_optimize = isset($arr_conn['db2_i5_query_optimize']) ? $arr_conn['db2_i5_query_optimize'] : "";
        $str_use_persistent        = isset($arr_conn['use_persistent']) ? $arr_conn['use_persistent'] : "";


        if (!extension_loaded($this->DbModule($str_dbms)))
        {
            $str_db_err = 'error_profile_test_module';
        }
        else
        {
            include_once $nm_config['path_prod'] . '../../third/adodb/adodb.inc.php';
            $arrExtraArgs              = "";
            $str_execute_after_connect = "";
			$str_charset               = "";

            $bol_persistent = false;
            if($str_use_persistent == "Y")
            {
            	$bol_persistent = true;
            }

            $obj_db = ADONewConnection($this->DbAdodbModule($str_dbms));

            if ('ado_mssql' == $str_dbms)
            {
                $str_host = 'PROVIDER=MSDASQL;DRIVER={SQL Server};'
                          . 'SERVER='   . $str_host . ';'
                          . 'UID='      . $str_user . ';'
                          . 'PWD='      . $str_pass . ';'
                          . 'DATABASE=' . $str_base . ';';
                $str_user = '';
                $str_pass = '';
                $str_base = '';
            }
            elseif ('db2' == $str_dbms)
            {
            	$arrExtraArgs = array();
            	if(!empty($str_db2_autocommit))
            	{
            		$arrExtraArgs['autocommit']        = (int) $str_db2_autocommit;
            	}
            	if(!empty($str_db2_i5_lib))
            	{
            		$arrExtraArgs['i5_lib']            = $str_db2_i5_lib;
            	}
            	if(!empty($str_db2_i5_naming))
            	{
            		$arrExtraArgs['i5_naming']         = (int) $str_db2_i5_naming;
            	}
            	if(!empty($str_db2_i5_commit))
            	{
            		$arrExtraArgs['i5_commit']         = (int) $str_db2_i5_commit;
            	}
            	if(!empty($str_db2_i5_query_optimize))
            	{
            		$arrExtraArgs['i5_query_optimize'] = (int) $str_db2_i5_query_optimize;
            	}

		        $str_host  = $str_host;
		    	$str_user  = $str_user;
		        $str_pass  = $str_pass;
		        $str_base  = $str_base;
            }
            elseif ('postgres' == $str_dbms || 'postgres7' == $str_dbms || 'postgres8' == $str_dbms || 'postgres64' == $str_dbms)
			{
				if(!empty($postgres_encoding))
            	{
            		$str_execute_after_connect = "SET CLIENT_ENCODING TO '". $postgres_encoding ."'";
            		$str_charset = $postgres_encoding;
            	}

				$str_host  = $str_host;
		    	$str_user  = $str_user;
		        $str_pass  = $str_pass;
		        $str_base  = $str_base;
			}
            elseif ('oracle' == $str_dbms || 'oci' == $str_dbms || 'oci8' == $str_dbms || 'oci805' == $str_dbms || 'oci8po' == $str_dbms)
			{
				if(!empty($oracle_encoding))
            	{
            		$obj_db->charSet = $oracle_encoding;
            	}

				$str_host  = $str_host;
		    	$str_user  = $str_user;
		        $str_pass  = $str_pass;
		        $str_base  = $str_base;
			}
            elseif ('pdosqlite' == $str_dbms)
            {
                $str_host = "sqlite:" . $str_host;
            }
            elseif ('pdo_informix' == $str_dbms)
            {
            	$str_host  = $str_host;
		    	$str_user  = $str_user;
		        $str_pass  = $str_pass;
		        $str_base  = $str_base;

		        if(empty($str_host) && !empty($str_base))
		        {
		        	$str_host = "informix:DSN=" . $str_host;
		        	$str_base = "";
		        }else
		        {
		        	$str_port   = "9088";
			    	$str_server = "";
			    	if(strpos($str_host, ":") !== false)
			    	{
			    		$arr_tmp_list_change = explode(":", $str_host);
			    		list($str_host, $str_port) = $arr_tmp_list_change;
			    	}
		        	if(strpos($str_host, "\\") !== false)
			    	{
			    		$arr_tmp_list_change = explode("\\", $str_host);
			    		list($str_host, $str_server) = $arr_tmp_list_change;
			    	}
		        	$str_host = "informix:host=". $str_host ."; service=". $str_port ."; database=". $str_base ."; server=". $str_server ."; protocol=onsoctcp; EnableScrollableCursors=1";
		        }
            }
            elseif ('pdo_mysql' == $str_dbms)
            {
            	if(!empty($mysql_encoding))
            	{
            		$str_execute_after_connect = "SET NAMES '". $mysql_encoding ."'";
					$str_charset = $mysql_encoding;
            	}

            	//$str_host = $servidor;
		    	$port = "";
				if(strpos($str_host, ":") !== false)
				{
					$arr_tmp_list_change = explode(":", $str_host);
					list($str_host, $port) = $arr_tmp_list_change;
				}

			    $str_host = "mysql:host=" . $str_host;
			    if(!empty($port))
			    {
			    	$str_host .= ";port=" . $port;
			    }

            	$str_user  = $str_user;
		        $str_pass  = $str_pass;
		        $str_base  = $str_base;
            }
            elseif ('pdo_pgsql' == $str_dbms)
            {
            	if(!empty($postgres_encoding))
            	{
            		$str_execute_after_connect = "SET CLIENT_ENCODING TO '". $postgres_encoding ."'";
					$str_charset = $postgres_encoding;
            	}

            	//$str_host = $servidor;
		    	$port = "";
				if(strpos($str_host, ":") !== false)
				{
					$arr_tmp_list_change = explode(":", $str_host);
					list($str_host, $port) = $arr_tmp_list_change;
				}

			    $str_host = "pgsql:host=" . $str_host;
			    if(!empty($port))
			    {
			    	$str_host .= ";port=" . $port;
			    }

            	$str_user  = $str_user;
		        $str_pass  = $str_pass;
		        $str_base  = $str_base;
            }
            elseif ('pdo_sqlsrv' == $str_dbms)
            {
	           $port = "";
               if(strpos($str_host, ":") !== false)
               {
                   $arr_tmp_list_change = explode(":", $str_host);
                   list($str_host, $port) = $arr_tmp_list_change;
               }

               $str_host = "sqlsrv:Server=" . $str_host;
               if(!empty($port))
               {
                   $str_host .= ",port=" . $port;
               }
               if(!empty($str_base))
               {
                   $str_host .= ";Database=" . $str_base;
               }

               $str_base  = "";

            }
            elseif ('mysql' == $str_dbms || 'mysqli' == $str_dbms || 'mysqlt' == $str_dbms)
			{
				if(!empty($mysql_encoding))
            	{
            		$str_execute_after_connect = "SET NAMES '". $mysql_encoding ."'";
					$str_charset = $mysql_encoding;
            	}

				$str_host  = $str_host;
		    	$str_user  = $str_user;
		        $str_pass  = $str_pass;
		        $str_base  = $str_base;
			}

            /* Cria nova conexao ADOdb */
            set_error_handler('nm_prod_error_handler');

            if($bol_persistent)
		    {
		    	$obj_db->PConnect($str_host, $str_user, $str_pass, $str_base, $arrExtraArgs, $str_charset);
		    }else
		    {
		    	$obj_db->Connect($str_host, $str_user, $str_pass, $str_base, false, $arrExtraArgs, $str_charset);
		    }

		    if(!empty($str_execute_after_connect))
		    {
		    	$obj_db->Execute($str_execute_after_connect);
		    }

            /* Verifica sucesso da conexao */
            if (FALSE != $obj_db->_connectionID)
            {
                if ('interbase' == $this->DbType($str_dbms))
                {
                    if (function_exists('ibase_timefmt'))
                	{
                		ibase_timefmt('%Y-%m-%d %H:%M:%S');
                	}else
                	{
                		ini_set("ibase.dateformat"     , '%Y-%m-%d %H:%M:%S');
                		ini_set("ibase.timestampformat", '%Y-%m-%d %H:%M:%S');
						ini_set("ibase.timeformat"     , '%H:%M:%S');
                	}
                }
                elseif ('sybase' == $this->DbType($str_dbms))
                {
                    sybase_min_client_severity(100);
                    sybase_min_server_severity(100);
                }

                if (nm_prod_error_filter($obj_db->ErrorMsg()))
                {
                    $str_db_err = $obj_db->ErrorMsg();
                }
                else
                {
                    $bol_conn = TRUE;
                }
            }
            else
            {
                $str_db_err = "Unable to connect: " . $obj_db->ErrorMsg();
            }
		}

		return ($bol_conn ? "" : $str_db_err);

    }//TestConn

    function SaveConn($arr_ini)
    {
    	global $nm_config;

		$prod_ini_file = $nm_config['path_conf'] . 'prod.config.php';

	    if (!is_dir($nm_config['path_conf']))
	    {
	        nm_dir_create($nm_config['path_conf']);
	    }

		$_SESSION['nm_session']['cache']['prod_v8'] = $arr_ini;

		file_put_contents($prod_ini_file, "<?php /*" . serialize($arr_ini) . "*/ ?>");
    }//SaveConn

	function DbModule($v_str_dbms)
	{
	    switch ($v_str_dbms)
	    {
	        /* ADO */
	        case 'ado':
	        case 'ado_access':
	        case 'ado_mssql':
	            if (5 == nm_php_version())
	            {
	                return 'com_dotnet';
	            }
	            else
	            {
	                return 'com';
	            }
	        break;
	        /* Frontbase */
	        case 'fbsql':
	            return 'fbsql';
	        break;
	        /* IBM Db2 */
	        case 'db2':
	        case 'db2_odbc':
	            return 'ibm_db2';
	        break;
	        /* Informix */
	        case 'informix':
	        case 'informix72':
	            return 'informix';
	        break;
	        /* Interbase */
	        case 'borland_ibase':
	        case 'firebird':
	        case 'ibase':
	            return 'interbase';
	        break;
	        /* MS SQL Server */
	        case 'mssql':
	        case 'mssqlpo':
	            return 'mssql';
	        break;
	        /* MS SQL Server Nativo SRV */
	        case 'mssqlnative':
	            return 'sqlsrv';
	        break;
	        /* MySQL */
	        case 'maxsql':
	        case 'mysql':
	        case 'mysqlt':
	            return 'mysql';
	        break;
	        /* ODBC */
	        case 'access':
	        case 'odbc_db2':
	        case 'odbc_db2v6':
	        case 'odbc':
	        case 'odbc_access':
	        case 'odbc_mssql':
	        case 'odbc_oracle':
	        case 'sapdb':
	        case 'sqlanywhere':
	        case 'vfp':
	            return 'odbc';
	        break;
	        /* Oracle */
	        case 'oci8':
	        case 'oci805':
	        case 'oci8po':
	            return 'oci8';
	        break;
	        case 'oracle':
	            return 'oracle';
	        break;
	        /* PostGreSQL */
	        case 'postgres':
	        case 'postgres64':
	        case 'postgres7':
	            return 'pgsql';
	        break;
	        /* case 'pdosqlite': */
	        case 'pdosqlite':
	        case 'pdo_informix':
	        case 'pdo_mysql':
	        case 'pdo_pgsql':
	        case 'pdo_sqlsrv':
	            return 'pdo';
	        break;
	        /* SQLite */
	        case 'sqlite':
	            return 'sqlite';
	        break;
	        /* SQLite */
	        case 'sqlite3':
	            return 'sqlite3';
	        break;
	        /* Sybase */
	        case 'sybase':
	            return 'sybase_ct';
	        break;
	        /* Outros */
	        default:
	            return FALSE;
	        break;
	    }
	} // nm_prod_db_module

	function DbAdodbModule($v_str_dbms)
	{
	    switch ($v_str_dbms)
	    {
	        /* DB2 */
	        case 'db2_odbc':
	            return 'db2';
	        break;
	        /* DB2 */
	        case 'odbc_db2v6':
	            return 'odbc_db2';
	        break;
	        /* SQLite PDO */
	        case 'pdosqlite':
	        case 'pdo_informix':
	        case 'pdo_mysql':
	        case 'pdo_pgsql':
	        case 'pdo_sqlsrv':
	            return 'pdo';
	        break;
	        /* Outros */
	        default:
	            return $v_str_dbms;
	        break;
	    }
	} // nm_prod_db_module

	function DbType($v_str_dbms)
	{
		switch ($v_str_dbms)
	    {
	        /* Access  */
	        case 'access':
	        case 'ado_access':
	            return 'access';
	        break;
	        /* ADO */
	        case 'ado':
	            return 'ado';
	        break;
	        /* DB2 */
	        case 'db2':
	        case 'db2_odbc':
	        case 'odbc_db2':
	        case 'odbc_db2v6':
	            return 'db2';
	        break;
	        /* Frontbase */
	        case 'fbsql':
	            return 'fbsql';
	        break;
	        /* Informix */
	        case 'informix':
	        case 'pdo_informix':
	        case 'informix72':
	            return 'informix';
	        break;
	        /* Interbase */
	        case 'borland_ibase':
	        case 'firebird':
	        case 'ibase':
	            return 'interbase';
	        break;
	        /* MS-SQL Server */
	        case 'ado_mssql':
	        case 'mssql':
	        case 'mssqlnative':
	        case 'mssqlpo':
	        case 'pdo_sqlsrv':
	        case 'odbc_mssql':
	            return 'mssql';
	        break;
	        /* MySQL */
	        case 'mysql':
	        case 'mysqlt':
	        case 'pdo_mysql':
	            return 'mysql';
	        break;
	        /* ODBC */
	        case 'odbc':
	            return 'odbc';
	        break;
	        /* Oracle */
	        case 'oci8':
	        case 'oci805':
	        case 'oci8po':
	        case 'odbc_oracle':
	        case 'oracle':
	            return 'oracle';
	        break;
	        /* PostGreSQL */
	        case 'postgres':
	        case 'postgres64':
	        case 'postgres7':
	        case 'pdo_pgsql':
	            return 'postgres';
	        break;
	        /* SQLite */
	        case 'pdosqlite':
	        case 'sqlite':
	            return 'sqlite';
	        break;
	        /* Sybase */
	        case 'sqlanywhere':
	        case 'sybase':
	            return 'sybase';
	        break;
	        /* Visual Fox Pro */
	        case 'vfp':
	            return 'vfp';
	        break;
	        /* Outros */
	        default:
	            return FALSE;
	        break;
	    }
	} // DbType


    function GetSGBDVersions()
    {
		return Array
				(
				    'access' => Array
				        (
				            'ado_access' => 'MS Access ADO',
				            'access' => 'MS Access ODBC'
				        ),

				    'db2' => Array
				        (
				            'db2' => 'DB2',
				            'db2_odbc' => 'DB2 Native ODBC',
				            'odbc_db2' => 'DB2 Generic ODBC',
				            'odbc_db2v6' => 'DB2 Generic ODBC 6 or Lower'
				        ),

				    'firebird' => Array
				        (
				            'firebird' => 'Firebird'
				        ),

				    'ibase' => Array
				        (
				            'borland_ibase' => 'Interbase 6.5 or Higher',
				            'ibase' => 'Interbase'
				        ),

				    'informix' => Array
				        (
				            'informix' => 'Informix',
				            'pdo_informix' => 'Informix PDO',
				            'informix72' => 'Informix 7.2 or Lower'
				        ),

				    'maxsql' => Array
				        (
				            'maxsql' => 'MaxSQL'
				        ),

				    'mssql' => Array
				        (
				            'ado_mssql' => 'MSSQL Server ADO',
				            'mssql' => 'MSSQL Server',
				            'pdo_sqlsrv' => 'MSSQL Server NATIVE SRV PDO',
				            'mssqlnative' => 'MSSQL Server NATIVE SRV',
				            'odbc_mssql' => 'MSSQL Server ODBC'
				        ),

				    'mysql' => Array
				        (
                            'pdo_mysql' => 'MySQL PDO',
					        'mysqlt' => 'MySQL (Transaction)',
				            'mysql' => 'MySQL'
				        ),

				    'odbc' => Array
				        (
				            'odbc' => 'Generic ODBC'
				        ),

				    'oracle' => Array
				        (
				            'oci805' => 'Oracle 8.0.5 or Higher',
				            'oci8' => 'Oracle 8',
				            'oci8po' => 'Oracle 8 Portable',
				            'oracle' => 'Oracle',
				            'odbc_oracle' => 'Oracle ODBC'
				        ),

				    'postgres' => Array
				        (
				            'postgres7'  => 'PostgreSQL 7 or Higher',
				            'postgres'   => 'PostgreSQL',
				            'pdo_pgsql'  => 'PostgreSQL PDO',
				            'postgres64' => 'PostgreSQL 6.4'
				        ),

				    'sqlite' => Array
				        (
				            'pdosqlite' => 'SQLite PDO',
				            //'sqlite3' => 'SQLite 3',
				            'sqlite' => 'SQLite',
				        ),

				    'sybase' => Array
				        (
				            'sybase' => 'Sybase'
				        )/*,

				    'vfp' => Array
				        (
				            'vfp' => 'Visual FoxPro'
				        )*/

				);

    } // GetSGBDVersions


    function GetSGBDS()
    {

        $arr_ret = Array
						(
					    'access' => Array
					        (
					            'access' => 'MS Access'
					        ),

					    'db2' => Array
					        (
					            'db2' => 'DB2'
					        ),

					    'firebird' => Array
					        (
					            'firebird' => 'Firebird'
					        ),

					    'ibase' => Array
					        (
					            'ibase' => 'Interbase'
					        ),

					    'informix' => Array
					        (
					            'informix' => 'Informix'
					        ),

					    'maxsql' => Array
					        (
					            'maxsql' => 'MaxSQL'
					        ),

					    'mssql' => Array
					        (
					            'mssql' => 'MSSQL Server'
					        ),

					    'mysql' => Array
					        (
					            'mysql' => 'MySQL'
					        ),

					    'odbc' => Array
					        (
					            'odbc' => 'Generic ODBC'
					        ),

					    'oracle' => Array
					        (
					            'oracle' => 'Oracle'
					        ),

					    'postgres' => Array
					        (
					            'postgres' => 'PostgreSQL'
					        ),

					    'sqlite' => Array
					        (
					            'pdosqlite' => 'SQLite PDO',
								//'sqlite3' => 'SQLite 3',
								'sqlite' => 'SQLite',
					        ),

					    'sybase' => Array
					        (
					            'sybase' => 'Sybase'
					        )/*,

					    'vfp' => Array
					        (
					            'vfp' => 'Visual FoxPro'
					        )	*/
					);

        return $arr_ret;

    } // GetSGBDS
}
?>
