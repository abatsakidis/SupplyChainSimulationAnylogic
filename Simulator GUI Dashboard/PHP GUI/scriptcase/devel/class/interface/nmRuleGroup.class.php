<?php
/**
 * Classe RuleGroup.
 *
 * Classe para manipulacao de regras de quebra.
 *
 * @package     Classes
 * @subpackage  Interface
 * @creation    2012/10/08
 * @copyright   NetMake Solucoes em Informatica
 * @author      Diogo Silva Toscano de Brito <diogo@netmake.com.br>
 *
 * $Id: $
 */

/* Protecao contra hacks */
if (!defined('SC_LOCKED_VERSION_8976') || ('CARREGADO4536' != SC_LOCKED_VERSION_8976))
{
    die('<br /><span style="font-weight: bold">Fatal error</span>: ' .
        'invalid access to system file.');
}

nm_load_class('interface','Application');

/* Definicao da classe */
class nmRuleGroup extends nmApplication
{
    /**
     * Construtor da classe.
     *
     * Inicializa objeto.
     *
     * @access  public
     */
    function nmRuleGroup()
    {
      $this->data = "Cod_Prj  ".
				    "Cod_Apl  ".
				    "Versao  ".
      				"nome  ".
      				"label  ".
                    "list_fld  ".
                    "sc_free_group_by_use  ".
                    "sc_free_group_by_openmode  ".
                    "sc_free_group_by_hide_help_line  "
					;

      $this->data = strtolower($this->data);
      $this->data = explode("  ", $this->data);
      $array_dados = array();
      foreach($this->data as $dado)
      {
        $array_dados[$dado] = "";
      }
      $this->data = $array_dados;
    } // nmRuleGroup

    /**
     * Salva as mudancas nas regras.
     *
     * Verifica se ocorreu alguma modificacao nas regras e atualiza as
     * informacoes.
     *
     * @access  procted
     * @global  array   $nm_config  Array de configuracao do ScriptCase.
     * @global  object  $nm_db      Objeto para acesso a banco de dados.
     */
    function SaveData($bol_delete = false)
    {
        global $nm_config, $nm_db;

		//abre serializes
    	$this->CheckAttrN(true, array(1, 2, 3));

        $arr_xml        = $this->attr2->GetTag('rules_group');
        $arr_rule_order = $this->GetDataAll();

        $n_ind = -1;
        foreach($arr_xml as $ind => $data)
        {
        	if ($arr_rule_order['nome'] == $data['nome'])
        	{
        		$n_ind = $ind;
        		break;
        	}
        }

		$arr_campos_change = array();
        /* Regra nova */
        if ($n_ind == -1)
        {
			if(!$bol_delete)
			{
				$arr_xml[] = array('nome' 	                   => $arr_rule_order['nome'],
								   'label' 	                   => $arr_rule_order['label'],
								   'list_fld'                  => $arr_rule_order['list_fld'],
								   'sc_free_group_by_use'      => $arr_rule_order['sc_free_group_by_use'],
								   'sc_free_group_by_openmode' => $arr_rule_order['sc_free_group_by_openmode'],
								   'sc_free_group_by_hide_help_line' => $arr_rule_order['sc_free_group_by_hide_help_line'],
								   );
			}
			if(isset($arr_rule_order['list_fld']) && is_array($arr_rule_order['list_fld']) && !empty($arr_rule_order['list_fld']))
			{
				foreach($arr_rule_order['list_fld'] as $seq => $campo)
				{
					$arr_campos_change[$seq]['rules_group'][ $arr_rule_order['nome'] ] = 'add';
					$arr_campos_change[$seq]['campo'] = $campo;
				}
			}
        }
        /* Atualizacao */
        else
        {
			//checa campos novos
			if (isset($arr_rule_order['list_fld']) && is_array($arr_rule_order['list_fld']) && !empty($arr_rule_order['list_fld']))
			{
				foreach($arr_rule_order['list_fld'] as $seq => $campo)
				{
					if(!isset($arr_xml[$n_ind]['list_fld'][$seq]))
					{
						$arr_campos_change[$seq]['rules_group'][ $arr_rule_order['nome'] ] = 'add';
						$arr_campos_change[$seq]['campo'] = $campo;
					}
				}
			}

			//campos que saem
            if (isset($arr_xml[$n_ind]['list_fld']) && is_array($arr_xml[$n_ind]['list_fld']) && !empty($arr_xml[$n_ind]['list_fld']))
            {
                foreach($arr_xml[$n_ind]['list_fld'] as $seq => $campo)
                {
                    if(!isset($arr_rule_order['list_fld'][$seq]))
                    {
                        $arr_campos_change[$seq]['rules_group'][ $arr_rule_order['nome'] ] = 'del';
                        $arr_campos_change[$seq]['campo'] = $campo;
                    }
                }
            }

			if($bol_delete)
			{
				if(isset($arr_xml[$n_ind]))
				{
					unset($arr_xml[$n_ind]);
				}
			}
			else
			{
				$arr_xml[$n_ind]['nome'] 		              = $arr_rule_order['nome'];
				$arr_xml[$n_ind]['label'] 		              = $arr_rule_order['label'];
				$arr_xml[$n_ind]['list_fld'] 	              = $arr_rule_order['list_fld'];
				$arr_xml[$n_ind]['sc_free_group_by_use'] 	  = $arr_rule_order['sc_free_group_by_use'];
				$arr_xml[$n_ind]['sc_free_group_by_openmode'] = $arr_rule_order['sc_free_group_by_openmode'];
				$arr_xml[$n_ind]['sc_free_group_by_hide_help_line'] = $arr_rule_order['sc_free_group_by_hide_help_line'];
			}
        }
		$this->attr2->SetTag('rules_group', $arr_xml);

		//campos
		$tot_fields_res  = $this->attr3->GetTag('tot_fields_res');

		//campos de sorting da attr1 ord_fld_tot_res_reg, ord_fld_tot_res_def, ord_fld_tot_res_type, ord_fld_tot_res_start
		$ord_fld_tot_res_reg   = $this->attr1->GetTag('ord_fld_tot_res_reg');
		$ord_fld_tot_res_def   = $this->attr1->GetTag('ord_fld_tot_res_def');
		$ord_fld_tot_res_type  = $this->attr1->GetTag('ord_fld_tot_res_type');
		$ord_fld_tot_res_start = $this->attr1->GetTag('ord_fld_tot_res_start');
		$ord_fld_tot_res_reg_new   = array();
		$ord_fld_tot_res_def_new   = array();
		$ord_fld_tot_res_type_new  = array();
		$ord_fld_tot_res_start_new = array();
		$arr_group = nm_prepare_fld_group($this->attr2->GetTag('rules_group'));
		foreach ($arr_group as $n => $arr_groups)
		{
			if(isset($ord_fld_tot_res_reg[$n]))
			{
				$ord_fld_tot_res_reg_new[$n] = $ord_fld_tot_res_reg[$n];
			}
			else
			{
				$ord_fld_tot_res_reg_new[$n] = array();

				$ord_fld_tot_res_reg_new[$n][] = '__record_count__';
				foreach($tot_fields_res as $field_res => $arr_field_res)
				{
					$ord_fld_tot_res_reg_new[$n][] = $field_res;
				}
			}

			if(isset($ord_fld_tot_res_def[$n]))
			{
				$ord_fld_tot_res_def_new[$n] = $ord_fld_tot_res_def[$n];
			}
			else
			{
				$ord_fld_tot_res_def_new[$n] = "";
			}

			if(isset($ord_fld_tot_res_type[$n]))
			{
				$ord_fld_tot_res_type_new[$n] = $ord_fld_tot_res_type[$n];
			}
			else
			{
				$ord_fld_tot_res_type_new[$n] = "";
			}

			if(isset($ord_fld_tot_res_start[$n]))
			{
				$ord_fld_tot_res_start_new[$n] = $ord_fld_tot_res_start[$n];
			}
			else
			{
				$ord_fld_tot_res_start_new[$n] = 1;
			}
		}

		$this->attr1->SetTag('ord_fld_tot_res_reg', $ord_fld_tot_res_reg_new);
		$this->attr1->SetTag('ord_fld_tot_res_def', $ord_fld_tot_res_def_new);
		$this->attr1->SetTag('ord_fld_tot_res_type', $ord_fld_tot_res_type_new);
		$this->attr1->SetTag('ord_fld_tot_res_start', $ord_fld_tot_res_start_new);
		//fim campos de sorting da attr1 ord_fld_tot_res_reg, ord_fld_tot_res_def, ord_fld_tot_res_type, ord_fld_tot_res_start

		//layout_resume
		$mix_val = $this->attr3->GetTag('layout_resume');

		$arr_flds_group = array();
		$arr_group = nm_prepare_fld_group($this->attr2->GetTag('rules_group'));
		foreach ($arr_group as $n => $arr_groups)
		{
			$arr_flds_group[$n] = array('fields' => array(),'format_tab' => '');
			if (!isset($mix_val[$n]['fields']))
			{
				$mix_val[$n]['fields'] = array();
			}
			if (!isset($mix_val[$n]['format_tab']))
			{
				$mix_val[$n]['format_tab'] = 'S';
			}

			foreach ($arr_groups as $str_field)
			{
				$arr_flds_group[$n]['format_tab'] = $mix_val[$n]['format_tab'];

				if (isset($mix_val[$n]['fields'][$str_field]))
				{
					$arr_flds_group[$n]['fields'][$str_field] = $mix_val[$n]['fields'][$str_field];
				}
				else
				{
					//default
					$arr_flds_group[$n]['fields'][$str_field] = array(
																		'position'   => 'Y',
																		'order'      => 'E',
																		'show_empty' => 'S',
																		'link_grid'  => 'S',
																		'align'      => ''
																		);
				}
			}
		}

		foreach ($arr_flds_group as $n => $arr_flds_groups)
		{
			$n_cont = 0;
			$b_achou_y = false;
			foreach ($arr_flds_groups['fields'] as $name_fld => $dados_fld)
			{
				if (++$n_cont == count($arr_flds_group[$n]['fields']))
				{
					$arr_flds_group[$n]['fields'][$name_fld]['position'] = '';
				}
				elseif ($b_achou_y)
				{
					$arr_flds_group[$n]['fields'][$name_fld]['position'] = 'Y';
				}
				elseif ($dados_fld['position'] == '')
				{
					$arr_flds_group[$n]['fields'][$name_fld]['position'] = 'Y';
					$b_achou_y = true;
				}
				elseif ($dados_fld['position'] == 'Y')
				{
					$b_achou_y = true;
				}
			}
		}

		$this->attr3->SetTag('layout_resume', $arr_flds_group);

		//layout_total
		$arr_flds_group = array();
		$mix_val = $this->attr3->GetTag('layout_total');
		$arr_groups = nm_prepare_fld_group($this->attr2->GetTag('rules_group'));
		foreach ($arr_groups as $n => $arr_group)
		{
			if(!isset($mix_val[$n]['fields']))
			{
				$mix_val[$n]['fields'] = array();
			}
			$arr_flds_group[$n] = array('fields' => array());

			foreach ($arr_group as $str_field)
			{
				if (isset($mix_val[$n]['fields'][$str_field]))
				{
					$arr_flds_group[$n]['fields'][$str_field] = $mix_val[$n]['fields'][$str_field];
				}
				else
				{
					$arr_flds_group[$n]['fields'][$str_field] = array( 'label' => '', 'show' => 'S');
				}
			}
		}
		$this->attr3->SetTag('layout_total', $arr_flds_group);

		//config_graf_resume
		$this->attr3->SetTag('config_graf_resume', GetArrGrafGer($this->attr3->GetTag('config_graf_resume'), nm_prepare_fld_group($this->attr2->GetTag('rules_group')), $this->attr3->GetTag('tot_fields_res')));

		//config_graf_res_tot
		$this->attr3->SetTag('config_graf_res_tot', nm_get_arr_graf_ger_tot($this->attr3->GetTag('config_graf_resume'), $this->attr2->GetTag('rules_group'), $this->attr3->GetTag('tot_fields_res')));


		//salva mudanca
		$this->saveAttrN(array(1 => '', 2 => '', 3 => ''));

		//agora atualiza os campos
		$arr_fields_delete = array();
		if(!empty($arr_campos_change))
		{
			nm_load_class('interface', 'Field');
			$obj_fld = new nmField();
			$obj_fld->SetApplication($_SESSION['nm_session']['user']['cod_grp'],
									 $_SESSION['nm_session']['app']['cod'],
									 $_SESSION['nm_session']['user']['cod_ver']);
			foreach($arr_campos_change as $seq => $arr_rules)
			{
				if(isset($arr_rules['rules_group']) && is_array($arr_rules['rules_group']) && !empty($arr_rules['rules_group']))
				{
					$obj_fld->CheckAttrN($seq, true, array(1, 4));

					$quebra_exibe                         = $obj_fld->attr4->GetTag('quebra_exibe');
					$quebra_sumariza                      = $obj_fld->attr4->GetTag('quebra_sumariza');
					$quebra_count                         = $obj_fld->attr4->GetTag('quebra_count');
					$graf_quebra                          = $obj_fld->attr4->GetTag('graf_quebra');
					$quebra_pagina                        = $obj_fld->attr4->GetTag('quebra_pagina');
					$fld_group_org_campos                 = $obj_fld->attr4->GetTag('fld_group_org_campos');
					$fld_group_cols                       = $obj_fld->attr4->GetTag('fld_group_cols');
					$fld_group_exibe_label                = $obj_fld->attr4->GetTag('fld_group_exibe_label');
					$fld_group_linha_sum_res              = $obj_fld->attr4->GetTag('fld_group_linha_sum_res');
					$fld_group_quebra_pag_pdf_res         = $obj_fld->attr4->GetTag('fld_group_quebra_pag_pdf_res');
					$fld_group_quebra_pag_html_cons       = $obj_fld->attr4->GetTag('fld_group_quebra_pag_html_cons');
					$fld_group_quebra_pag_html_res        = $obj_fld->attr4->GetTag('fld_group_quebra_pag_html_res');
					$fld_group_graf_group_title_show_val  = $obj_fld->attr4->GetTag('fld_group_graf_group_title_show_val');
					$fld_group_campos                     = $obj_fld->attr4->GetTag('fld_group_campos');

					$group_usar_config_regional           = $obj_fld->attr1->GetTag('group_usar_config_regional');
					$group_format_data_config_reg         = $obj_fld->attr1->GetTag('group_format_data_config_reg');
					$group_mascara_grid_detalhe           = $obj_fld->attr1->GetTag('group_mascara_grid_detalhe');
					$group_formato_data_outro             = $obj_fld->attr1->GetTag('group_formato_data_outro');

					foreach($arr_rules['rules_group'] as $quebra => $type)
					{
						if($type == 'add')
						{
							$quebra_exibe[$quebra]                        = "S";
							$quebra_sumariza[$quebra]                     = "S";
							$quebra_count[$quebra]                        = "N";
							$graf_quebra[$quebra]                         = "S";
							$quebra_pagina[$quebra]                       = "S";
							$fld_group_org_campos[$quebra]                = 1;
							$fld_group_cols[$quebra]                      = 1;
							$fld_group_exibe_label[$quebra]               = "S";
							$fld_group_linha_sum_res[$quebra]             = "S";
							$fld_group_quebra_pag_pdf_res[$quebra]        = "N";
							$fld_group_quebra_pag_html_cons[$quebra]      = "N";
							$fld_group_quebra_pag_html_res[$quebra]       = "N";
							$fld_group_graf_group_title_show_val[$quebra] = "S";
							$fld_group_campos[$quebra]                    = array($seq => 'V' . $arr_rules['campo']['field']);

							$group_usar_config_regional[$quebra]          = "S";
							$group_format_data_config_reg[$quebra]        = $obj_fld->attr1->GetTag('format_data_config_reg');
							$group_mascara_grid_detalhe[$quebra]          = $obj_fld->attr4->GetTag('mascaragriddetalhe');
							$group_formato_data_outro[$quebra]            = "";
						}
						else
						{
							if(isset($quebra_exibe[$quebra]))                        unset($quebra_exibe[$quebra]);
							if(isset($quebra_sumariza[$quebra]))                     unset($quebra_sumariza[$quebra]);
							if(isset($quebra_count[$quebra]))                        unset($quebra_count[$quebra]);
							if(isset($graf_quebra[$quebra]))                         unset($graf_quebra[$quebra]);
							if(isset($quebra_pagina[$quebra]))                       unset($quebra_pagina[$quebra]);
							if(isset($fld_group_org_campos[$quebra]))                unset($fld_group_org_campos[$quebra]);
							if(isset($fld_group_cols[$quebra]))                      unset($fld_group_cols[$quebra]);
							if(isset($fld_group_exibe_label[$quebra]))               unset($fld_group_exibe_label[$quebra]);
							if(isset($fld_group_linha_sum_res[$quebra]))             unset($fld_group_linha_sum_res[$quebra]);
							if(isset($fld_group_quebra_pag_pdf_res[$quebra]))        unset($fld_group_quebra_pag_pdf_res[$quebra]);
							if(isset($fld_group_quebra_pag_html_cons[$quebra]))      unset($fld_group_quebra_pag_html_cons[$quebra]);
							if(isset($fld_group_quebra_pag_html_res[$quebra]))       unset($fld_group_quebra_pag_html_res[$quebra]);
							if(isset($fld_group_graf_group_title_show_val[$quebra])) unset($fld_group_graf_group_title_show_val[$quebra]);
							if(isset($fld_group_campos[$quebra]))                    unset($fld_group_campos[$quebra]);

							if(isset($group_usar_config_regional[$quebra]))          unset($group_usar_config_regional[$quebra]);
							if(isset($group_format_data_config_reg[$quebra]))        unset($group_format_data_config_reg[$quebra]);
							if(isset($group_mascara_grid_detalhe[$quebra]))          unset($group_mascara_grid_detalhe[$quebra]);
							if(isset($group_formato_data_outro[$quebra]))            unset($group_formato_data_outro[$quebra]);

							if(!in_array($arr_rules['campo']['field'], $arr_fields_delete))
							{
								$arr_fields_delete[] = $arr_rules['campo']['field'];
							}
						}
					}
					$obj_fld->attr4->SetTag('quebra_exibe',                        $quebra_exibe);
					$obj_fld->attr4->SetTag('quebra_sumariza',                     $quebra_sumariza);
					$obj_fld->attr4->SetTag('quebra_count',                        $quebra_count);
					$obj_fld->attr4->SetTag('graf_quebra',                         $graf_quebra);
					$obj_fld->attr4->SetTag('quebra_pagina',                       $quebra_pagina);
					$obj_fld->attr4->SetTag('fld_group_org_campos',                $fld_group_org_campos);
					$obj_fld->attr4->SetTag('fld_group_cols',                      $fld_group_cols);
					$obj_fld->attr4->SetTag('fld_group_exibe_label',               $fld_group_exibe_label);
					$obj_fld->attr4->SetTag('fld_group_linha_sum_res',             $fld_group_linha_sum_res);
					$obj_fld->attr4->SetTag('fld_group_quebra_pag_pdf_res',        $fld_group_quebra_pag_pdf_res);
					$obj_fld->attr4->SetTag('fld_group_quebra_pag_html_cons',      $fld_group_quebra_pag_html_cons);
					$obj_fld->attr4->SetTag('fld_group_quebra_pag_html_res',       $fld_group_quebra_pag_html_res);
					$obj_fld->attr4->SetTag('fld_group_graf_group_title_show_val', $fld_group_graf_group_title_show_val);
					$obj_fld->attr4->SetTag('fld_group_campos',                    $fld_group_campos);

					$obj_fld->attr1->SetTag('group_usar_config_regional',          $group_usar_config_regional);
					$obj_fld->attr1->SetTag('group_format_data_config_reg',        $group_format_data_config_reg);
					$obj_fld->attr1->SetTag('group_mascara_grid_detalhe',          $group_mascara_grid_detalhe);
					$obj_fld->attr1->SetTag('group_formato_data_outro',            $group_formato_data_outro);

					$obj_fld->saveAttrN(1, $seq);
					$obj_fld->saveAttrN(4, $seq);
				}
			}
		}

		//remove eventos da quebra
		if(!empty($arr_fields_delete))
		{
			nm_load_class('interface', 'Event');
			$obj_evt = new nmEvent();
			$obj_evt->SetApplication($_SESSION['nm_session']['user']['cod_grp'],
									 $_SESSION['nm_session']['app']['cod'],
									 $_SESSION['nm_session']['user']['cod_ver']);
			foreach($arr_fields_delete as $str_field)
			{
				$obj_evt->Remove($str_field . '_onGroupBy', 'E');
			}
		}
    } // SaveData

   /**
    * Remove regra
    *
    * Remove regra selecionada
    *
    * @access  public
    * @param   string    $nome         Nome do metodo
    * @global  array     $nm_config    Array de configuracao do ScriptCase.
    * @global  object    $nm_db        Objeto para acesso a banco de dados.
    * @return  array     $arr_Str      Array com os dados
    */
    function Remove($nome)
    {
		$this->SetData('nome',                      $nome);
		$this->SetData('label',                     '');
		$this->SetData('list_fld',                  array());
		$this->SetData('sc_free_group_by_use',      '');
		$this->SetData('sc_free_group_by_openmode', '');
		$this->SetData('sc_free_group_by_hide_help_line', '');

		$this->SaveData(true);
    }// Remove

   /**
    * Recupera Regras
    *
    * Le os regras da aplicacao
    *
    * @access  public
    * @param   string    $nome              Nome da Regra
    * @return  array     $arr_rules_orders  Array com os dados
    */
    function RetrieveList($nome = "")
    {
     	$this->CheckAttr2();
        $arr_xml = $this->attr2->GetTag('rules_group');

        $arr_rules_orders = array();

        if ($nome == "")
        {
        	$arr_rules_orders = $arr_xml;
        }
        else
        {
        	foreach($arr_xml as $ind => $data)
        	{
        		if ($data['nome'] == $nome)
        		{
        			$arr_rules_orders = $data;
        			break;
        		}
        	}
        }

        return $arr_rules_orders;

    }// RetrieveList

    /**
    * Regra existe ou nao
    *
    * Verifica se regra existe na base de dados
    *
    * @access  public
    * @param   string    $nome         Nome da regra
    * @return  boolean   $return       Retorna verdadeiro se a regra existir
    */
    function RuleGroupExist($nome)
    {
        $return = false;

    	$this->CheckAttr2();
        $arr_xml = $this->attr2->GetTag('rules_group');

        foreach($arr_xml as $ind => $data)
        {
        	if (strtolower($nome) == strtolower($data['nome']))
        	{
        		$return = true;
        		break;
        	}
        }

        return $return;

    }// RuleGroupExist
}

?>