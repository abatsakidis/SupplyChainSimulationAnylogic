<?php
/**
 * Classe DbInterface.
 *
 * Classe para manipulacao de interface com o banco Access.
 *
 * @package     Classes
 * @subpackage  Interface
 * @creation    2011/04/28
 * @copyright   NetMake Solucoes em Informatica
 * @author      Diogo Silva Toscano de Brito <diogo@netmake.com.br>
 *
 * $Id: nmDbInterface.access.class.php,v 1.1 2011-05-18 19:24:25 diogo Exp $
 */

/* Protecao contra hacks */
if (!defined('SC_LOCKED_VERSION_8976') || ('CARREGADO4536' != SC_LOCKED_VERSION_8976))
{
    die('<br /><span style="font-weight: bold">Fatal error</span>: ' .
        'invalid access to system file.');
}

/* Definicao da classe */
class nmDbInterfaceBanco
{
	/**
     * Conexao do banco
     *
     * Objeto para manipulacao dos dados no banco
     *
     * @access  protected
     * @var     object
     */
    var $nm_db_usu;

    /**
     * Construtor da classe.
     *
     * Inicializa objeto.
     *
     * @access  public
     */
    function nmDbInterfaceBanco($nm_db_usu)
    {
		$this->nm_db_usu = $nm_db_usu;
    }

	function getForeignKeys($arr_conn)
	{
		global $nm_config;

		$arr_retorno = array();

		$str_arq = nm_odbc_access(nm_crypt_decode($arr_conn['host']), nm_crypt_decode($arr_conn['user']), nm_crypt_decode($arr_conn['pass']), "get_relations");
		$arr_flds = explode($nm_config['access_separator'][1], $str_arq);

		if(is_array($arr_flds) && !empty($arr_flds))
		{
			foreach ($arr_flds as $fld)
			{
				if(!empty($fld))
				{
					$arr_fld_props = explode($nm_config['access_separator'][2], $fld);
					if(is_array($arr_fld_props) && !empty($arr_fld_props))
					{
						$arr_props = array();
						foreach ($arr_fld_props as $prop)
						{
							$arr_pro_val = explode($nm_config['access_separator'][3], $prop);

							if(isset($arr_pro_val[1]))
							{
								$arr_props[$arr_pro_val[0]] = $arr_pro_val[1];
							}
						}

						//se for tabela de sistema cai fora
						if(substr(strtolower($arr_props['table']), 0, 4) == "msys")
						{
							continue;
						}

						$fk = array();
						if(isset($arr_props['fields']) && strpos($arr_props['fields'], $nm_config['access_separator'][5]) !== false)
						{
							$arr_flds_fk = explode($nm_config['access_separator'][5], $arr_props['fields']);

							//so entra se tiver pelo menos 2 campos (a que liga com b)
							if(count($arr_flds_fk) > 1)
							{
								foreach($arr_flds_fk as $arr_fld_fk)
								{
									if(strpos($arr_fld_fk, $nm_config['access_separator'][6]))
									{
										$arr_fld_fk = explode($nm_config['access_separator'][6], $arr_fld_fk);

										if(isset($arr_fld_fk[0]) && !empty($arr_fld_fk[0]))
										{
											if($arr_fld_fk[0] == "name")
											{
												$fk['target_column']   = $arr_fld_fk[1];
											}
											elseif($arr_fld_fk[0] == "foreign_name")
											{
												$fk['base_column']   = $arr_fld_fk[1];
											}
										}
									}
								}
							}
						}

						if(!empty($arr_props['table']))
						{
							$fk['target_table']  = $arr_props['table'];

							$arr_retorno[$arr_props['foreign_table']][$arr_props['name']][] = $fk;
						}
					}
				}
			}
		}

		return $arr_retorno;
	}
}

?>