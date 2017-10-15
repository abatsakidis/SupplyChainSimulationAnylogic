<?php

  $arr_buttons = array();
  if(isset($this->Ini->Nm_lang))
  {
      $Nm_lang = $this->Ini->Nm_lang;
  }
  else
  {
      $Nm_lang = $this->Nm_lang;
  }
  $this->arr_buttons['bcons_inicio']['hint']             = $Nm_lang['lang_btns_frst_hint'];
  $this->arr_buttons['bcons_inicio']['type']             = 'button';
  $this->arr_buttons['bcons_inicio']['value']            = $Nm_lang['lang_btns_frst'];
  $this->arr_buttons['bcons_inicio']['display']          = 'only_img';
  $this->arr_buttons['bcons_inicio']['display_position'] = 'img_right';
  $this->arr_buttons['bcons_inicio']['style'] = 'default';
  $this->arr_buttons['bcons_inicio']['image'] = 'scriptcase__NM__nm_scriptcase8_citrine_bcons_final.gif';

  $this->arr_buttons['bcons_retorna']['hint']             = $Nm_lang['lang_btns_prev_hint'];
  $this->arr_buttons['bcons_retorna']['type']             = 'button';
  $this->arr_buttons['bcons_retorna']['value']            = $Nm_lang['lang_btns_prev'];
  $this->arr_buttons['bcons_retorna']['display']          = 'only_img';
  $this->arr_buttons['bcons_retorna']['display_position'] = 'img_right';
  $this->arr_buttons['bcons_retorna']['style'] = 'default';
  $this->arr_buttons['bcons_retorna']['image'] = 'scriptcase__NM__nm_scriptcase8_citrine_bavanca.gif';

  $this->arr_buttons['bcons_avanca']['hint']             = $Nm_lang['lang_btns_next_hint'];
  $this->arr_buttons['bcons_avanca']['type']             = 'button';
  $this->arr_buttons['bcons_avanca']['value']            = $Nm_lang['lang_btns_next'];
  $this->arr_buttons['bcons_avanca']['display']          = 'only_img';
  $this->arr_buttons['bcons_avanca']['display_position'] = 'img_right';
  $this->arr_buttons['bcons_avanca']['style'] = 'default';
  $this->arr_buttons['bcons_avanca']['image'] = 'scriptcase__NM__nm_scriptcase8_citrine_bcons_retorna.gif';

  $this->arr_buttons['bcons_final']['hint']             = $Nm_lang['lang_btns_last_hint'];
  $this->arr_buttons['bcons_final']['type']             = 'button';
  $this->arr_buttons['bcons_final']['value']            = $Nm_lang['lang_btns_last'];
  $this->arr_buttons['bcons_final']['display']          = 'only_img';
  $this->arr_buttons['bcons_final']['display_position'] = 'img_right';
  $this->arr_buttons['bcons_final']['style'] = 'default';
  $this->arr_buttons['bcons_final']['image'] = 'scriptcase__NM__nm_scriptcase8_citrine_bcons_inicio.gif';

  $this->arr_buttons['birpara']['hint']             = $Nm_lang['lang_btns_jump_hint'];
  $this->arr_buttons['birpara']['type']             = 'button';
  $this->arr_buttons['birpara']['value']            = $Nm_lang['lang_btns_jump'];
  $this->arr_buttons['birpara']['display']          = 'only_text';
  $this->arr_buttons['birpara']['display_position'] = 'img_right';
  $this->arr_buttons['birpara']['style'] = 'default';
  $this->arr_buttons['birpara']['image'] = 'sys__NM__nm_teste_birpara.gif';

  $this->arr_buttons['bprint']['hint']             = $Nm_lang['lang_btns_prnt_hint'];
  $this->arr_buttons['bprint']['type']             = 'button';
  $this->arr_buttons['bprint']['value']            = $Nm_lang['lang_btns_prnt'];
  $this->arr_buttons['bprint']['display']          = 'only_text';
  $this->arr_buttons['bprint']['display_position'] = 'img_right';
  $this->arr_buttons['bprint']['style'] = 'default';
  $this->arr_buttons['bprint']['image'] = 'grp__NM__printer2.png';

  $this->arr_buttons['bresumo']['hint']             = $Nm_lang['lang_btns_smry_hint'];
  $this->arr_buttons['bresumo']['type']             = 'button';
  $this->arr_buttons['bresumo']['value']            = $Nm_lang['lang_btns_smry'];
  $this->arr_buttons['bresumo']['display']          = 'only_text';
  $this->arr_buttons['bresumo']['display_position'] = 'img_right';
  $this->arr_buttons['bresumo']['style'] = 'default';
  $this->arr_buttons['bresumo']['image'] = 'sys__NM__nm_teste_bresumo.gif';

  $this->arr_buttons['bsort']['hint']             = $Nm_lang['lang_btns_sort_hint'];
  $this->arr_buttons['bsort']['type']             = 'button';
  $this->arr_buttons['bsort']['value']            = $Nm_lang['lang_btns_sort'];
  $this->arr_buttons['bsort']['display']          = 'only_text';
  $this->arr_buttons['bsort']['display_position'] = 'img_right';
  $this->arr_buttons['bsort']['style'] = 'default';
  $this->arr_buttons['bsort']['image'] = 'scriptcase__NM__sorting.png';

  $this->arr_buttons['bcolumns']['hint']             = $Nm_lang['lang_btns_clmn_hint'];
  $this->arr_buttons['bcolumns']['type']             = 'button';
  $this->arr_buttons['bcolumns']['value']            = $Nm_lang['lang_btns_clmn'];
  $this->arr_buttons['bcolumns']['display']          = 'only_text';
  $this->arr_buttons['bcolumns']['display_position'] = 'img_right';
  $this->arr_buttons['bcolumns']['style'] = 'default';
  $this->arr_buttons['bcolumns']['image'] = 'sys__NM__nm_teste_bcolumns.gif';

  $this->arr_buttons['bdynamicsearch']['hint']             = $Nm_lang['lang_btns_dynamicsearch_hint'];
  $this->arr_buttons['bdynamicsearch']['type']             = 'button';
  $this->arr_buttons['bdynamicsearch']['value']            = $Nm_lang['lang_btns_dynamicsearch'];
  $this->arr_buttons['bdynamicsearch']['display']          = 'only_text';
  $this->arr_buttons['bdynamicsearch']['display_position'] = 'img_right';
  $this->arr_buttons['bdynamicsearch']['style'] = 'default';
  $this->arr_buttons['bdynamicsearch']['image'] = 'sys__NM__nm_teste_bdynamicsearch.gif';

  $this->arr_buttons['bgridsave']['hint']             = $Nm_lang['lang_btns_gridsave_hint'];
  $this->arr_buttons['bgridsave']['type']             = 'button';
  $this->arr_buttons['bgridsave']['value']            = $Nm_lang['lang_btns_gridsave'];
  $this->arr_buttons['bgridsave']['display']          = 'only_text';
  $this->arr_buttons['bgridsave']['display_position'] = 'img_right';
  $this->arr_buttons['bgridsave']['style'] = 'default';
  $this->arr_buttons['bgridsave']['image'] = 'sys__NM__nm_teste_bgridsave.gif';

  $this->arr_buttons['bgroupby']['hint']             = $Nm_lang['lang_btns_gbrl_hint'];
  $this->arr_buttons['bgroupby']['type']             = 'button';
  $this->arr_buttons['bgroupby']['value']            = $Nm_lang['lang_btns_gbrl'];
  $this->arr_buttons['bgroupby']['display']          = 'only_text';
  $this->arr_buttons['bgroupby']['display_position'] = 'img_right';
  $this->arr_buttons['bgroupby']['style'] = 'default';
  $this->arr_buttons['bgroupby']['image'] = 'sys__NM__nm_teste_bgroupby.gif';

  $this->arr_buttons['bcons_detalhes']['hint']             = $Nm_lang['lang_btns_lens_hint'];
  $this->arr_buttons['bcons_detalhes']['type']             = 'image';
  $this->arr_buttons['bcons_detalhes']['value']            = $Nm_lang['lang_btns_lens'];
  $this->arr_buttons['bcons_detalhes']['display']          = 'only_img';
  $this->arr_buttons['bcons_detalhes']['display_position'] = 'img_right';
  $this->arr_buttons['bcons_detalhes']['style'] = '';
  $this->arr_buttons['bcons_detalhes']['image'] = 'scriptcase__NM__scriptacase8_citrino_search.png';

  $this->arr_buttons['bqt_linhas']['hint']             = $Nm_lang['lang_btns_rows_hint'];
  $this->arr_buttons['bqt_linhas']['type']             = 'button';
  $this->arr_buttons['bqt_linhas']['value']            = $Nm_lang['lang_btns_rows'];
  $this->arr_buttons['bqt_linhas']['display']          = 'only_text';
  $this->arr_buttons['bqt_linhas']['display_position'] = 'img_right';
  $this->arr_buttons['bqt_linhas']['style'] = 'default';
  $this->arr_buttons['bqt_linhas']['image'] = 'sys__NM__nm_teste_bqt_linhas.gif';

  $this->arr_buttons['bgraf']['hint']             = $Nm_lang['lang_btns_chrt_hint'];
  $this->arr_buttons['bgraf']['type']             = 'image';
  $this->arr_buttons['bgraf']['value']            = $Nm_lang['lang_btns_chrt'];
  $this->arr_buttons['bgraf']['display']          = 'only_img';
  $this->arr_buttons['bgraf']['display_position'] = 'img_right';
  $this->arr_buttons['bgraf']['style'] = '';
  $this->arr_buttons['bgraf']['image'] = 'scriptcase__NM__bgraf.png';

  $this->arr_buttons['bconf_graf']['hint']             = $Nm_lang['lang_btns_chrt_stng_hint'];
  $this->arr_buttons['bconf_graf']['type']             = 'button';
  $this->arr_buttons['bconf_graf']['value']            = $Nm_lang['lang_btns_chrt_stng'];
  $this->arr_buttons['bconf_graf']['display']          = 'only_img';
  $this->arr_buttons['bconf_graf']['display_position'] = 'img_right';
  $this->arr_buttons['bconf_graf']['style'] = 'default';
  $this->arr_buttons['bconf_graf']['image'] = 'scriptcase__NM__nm_scriptcase8_citrine_bconf_graf.gif';

  $this->arr_buttons['bqtd_bytes']['hint']             = '';
  $this->arr_buttons['bqtd_bytes']['type']             = 'button';
  $this->arr_buttons['bqtd_bytes']['value']            = $Nm_lang['lang_btns_qtch'];
  $this->arr_buttons['bqtd_bytes']['display']          = 'only_text';
  $this->arr_buttons['bqtd_bytes']['display_position'] = 'img_right';
  $this->arr_buttons['bqtd_bytes']['style'] = 'default';
  $this->arr_buttons['bqtd_bytes']['image'] = 'sys__NM__nm_teste_bqtd_bytes.gif';

  $this->arr_buttons['blink_resumogrid']['hint']             = $Nm_lang['lang_btns_smry_drll_hint'];
  $this->arr_buttons['blink_resumogrid']['type']             = 'button';
  $this->arr_buttons['blink_resumogrid']['value']            = $Nm_lang['lang_btns_smry_drll'];
  $this->arr_buttons['blink_resumogrid']['display']          = 'only_text';
  $this->arr_buttons['blink_resumogrid']['display_position'] = 'img_right';
  $this->arr_buttons['blink_resumogrid']['style'] = 'default';
  $this->arr_buttons['blink_resumogrid']['image'] = 'sys__NM__nm_teste_blink_resumogrid.gif';

  $this->arr_buttons['brot_resumo']['hint']             = $Nm_lang['lang_btns_smry_rtte_hint'];
  $this->arr_buttons['brot_resumo']['type']             = 'button';
  $this->arr_buttons['brot_resumo']['value']            = $Nm_lang['lang_btns_smry_rtte'];
  $this->arr_buttons['brot_resumo']['display']          = 'only_text';
  $this->arr_buttons['brot_resumo']['display_position'] = 'img_right';
  $this->arr_buttons['brot_resumo']['style'] = 'default';
  $this->arr_buttons['brot_resumo']['image'] = 'sys__NM__nm_teste_brot_resumo.gif';

  $this->arr_buttons['smry_conf']['hint']             = $Nm_lang['lang_btns_smry_conf_hint'];
  $this->arr_buttons['smry_conf']['type']             = 'button';
  $this->arr_buttons['smry_conf']['value']            = $Nm_lang['lang_btns_smry_conf'];
  $this->arr_buttons['smry_conf']['display']          = 'only_text';
  $this->arr_buttons['smry_conf']['display_position'] = 'img_right';
  $this->arr_buttons['smry_conf']['style'] = 'default';
  $this->arr_buttons['smry_conf']['image'] = 'sys__NM__nm_teste_smry_conf.gif';

  $this->arr_buttons['gantt_chart']['hint']             = $Nm_lang['lang_btns_chrt_gantt_hint'];
  $this->arr_buttons['gantt_chart']['type']             = 'button';
  $this->arr_buttons['gantt_chart']['value']            = $Nm_lang['lang_btns_chrt_gantt'];
  $this->arr_buttons['gantt_chart']['display']          = 'only_text';
  $this->arr_buttons['gantt_chart']['display_position'] = 'img_right';
  $this->arr_buttons['gantt_chart']['style'] = 'default';
  $this->arr_buttons['gantt_chart']['image'] = 'sys__NM__nm_teste_gantt_chart.gif';

  $this->arr_buttons['bcons_inicio_off']['hint']             = $Nm_lang['lang_btns_frst_hint'];
  $this->arr_buttons['bcons_inicio_off']['type']             = 'button';
  $this->arr_buttons['bcons_inicio_off']['value']            = $Nm_lang['lang_btns_frst'];
  $this->arr_buttons['bcons_inicio_off']['display']          = 'only_img';
  $this->arr_buttons['bcons_inicio_off']['display_position'] = 'img_right';
  $this->arr_buttons['bcons_inicio_off']['style'] = 'disabled';
  $this->arr_buttons['bcons_inicio_off']['image'] = 'scriptcase__NM__nm_scriptcase8_citrine_bcons_final_off.gif';

  $this->arr_buttons['bcons_retorna_off']['hint']             = $Nm_lang['lang_btns_prev_hint'];
  $this->arr_buttons['bcons_retorna_off']['type']             = 'button';
  $this->arr_buttons['bcons_retorna_off']['value']            = $Nm_lang['lang_btns_prev'];
  $this->arr_buttons['bcons_retorna_off']['display']          = 'only_img';
  $this->arr_buttons['bcons_retorna_off']['display_position'] = 'img_right';
  $this->arr_buttons['bcons_retorna_off']['style'] = 'disabled';
  $this->arr_buttons['bcons_retorna_off']['image'] = 'scriptcase__NM__nm_scriptcase8_citrine_bavanca_off.gif';

  $this->arr_buttons['bcons_avanca_off']['hint']             = $Nm_lang['lang_btns_next_hint'];
  $this->arr_buttons['bcons_avanca_off']['type']             = 'button';
  $this->arr_buttons['bcons_avanca_off']['value']            = $Nm_lang['lang_btns_next'];
  $this->arr_buttons['bcons_avanca_off']['display']          = 'only_img';
  $this->arr_buttons['bcons_avanca_off']['display_position'] = 'img_right';
  $this->arr_buttons['bcons_avanca_off']['style'] = 'disabled';
  $this->arr_buttons['bcons_avanca_off']['image'] = 'scriptcase__NM__nm_scriptcase8_citrine_bcons_retorna_off.gif';

  $this->arr_buttons['bcons_final_off']['hint']             = $Nm_lang['lang_btns_last_hint'];
  $this->arr_buttons['bcons_final_off']['type']             = 'button';
  $this->arr_buttons['bcons_final_off']['value']            = $Nm_lang['lang_btns_last'];
  $this->arr_buttons['bcons_final_off']['display']          = 'only_img';
  $this->arr_buttons['bcons_final_off']['display_position'] = 'img_right';
  $this->arr_buttons['bcons_final_off']['style'] = 'disabled';
  $this->arr_buttons['bcons_final_off']['image'] = 'scriptcase__NM__nm_scriptcase8_citrine_bcons_inicio_off.gif';

  $this->arr_buttons['bpdf']['hint']             = $Nm_lang['lang_btns_pdfc_hint'];
  $this->arr_buttons['bpdf']['type']             = 'button';
  $this->arr_buttons['bpdf']['value']            = $Nm_lang['lang_btns_pdfc'];
  $this->arr_buttons['bpdf']['display']          = 'only_text';
  $this->arr_buttons['bpdf']['display_position'] = 'img_right';
  $this->arr_buttons['bpdf']['style'] = 'default';
  $this->arr_buttons['bpdf']['image'] = 'sys__NM__nm_teste_bpdf.gif';

  $this->arr_buttons['brtf']['hint']             = $Nm_lang['lang_btns_rtff_hint'];
  $this->arr_buttons['brtf']['type']             = 'button';
  $this->arr_buttons['brtf']['value']            = $Nm_lang['lang_btns_rtff'];
  $this->arr_buttons['brtf']['display']          = 'only_text';
  $this->arr_buttons['brtf']['display_position'] = 'img_right';
  $this->arr_buttons['brtf']['style'] = 'default';
  $this->arr_buttons['brtf']['image'] = 'sys__NM__nm_teste_brtf.gif';

  $this->arr_buttons['bexcel']['hint']             = $Nm_lang['lang_btns_xlsf_hint'];
  $this->arr_buttons['bexcel']['type']             = 'button';
  $this->arr_buttons['bexcel']['value']            = $Nm_lang['lang_btns_xlsf'];
  $this->arr_buttons['bexcel']['display']          = 'only_text';
  $this->arr_buttons['bexcel']['display_position'] = 'img_right';
  $this->arr_buttons['bexcel']['style'] = 'default';
  $this->arr_buttons['bexcel']['image'] = 'sys__NM__nm_teste_bexcel.gif';

  $this->arr_buttons['bxml']['hint']             = $Nm_lang['lang_btns_xmlf_hint'];
  $this->arr_buttons['bxml']['type']             = 'button';
  $this->arr_buttons['bxml']['value']            = $Nm_lang['lang_btns_xmlf'];
  $this->arr_buttons['bxml']['display']          = 'only_text';
  $this->arr_buttons['bxml']['display_position'] = 'img_right';
  $this->arr_buttons['bxml']['style'] = 'default';
  $this->arr_buttons['bxml']['image'] = 'sys__NM__nm_teste_bxml.gif';

  $this->arr_buttons['bcsv']['hint']             = $Nm_lang['lang_btns_csvf_hint'];
  $this->arr_buttons['bcsv']['type']             = 'button';
  $this->arr_buttons['bcsv']['value']            = $Nm_lang['lang_btns_csvf'];
  $this->arr_buttons['bcsv']['display']          = 'only_text';
  $this->arr_buttons['bcsv']['display_position'] = 'img_right';
  $this->arr_buttons['bcsv']['style'] = 'default';
  $this->arr_buttons['bcsv']['image'] = 'sys__NM__nm_teste_bcsv.gif';

  $this->arr_buttons['bword']['hint']             = $Nm_lang['lang_btns_word_hint'];
  $this->arr_buttons['bword']['type']             = 'button';
  $this->arr_buttons['bword']['value']            = $Nm_lang['lang_btns_word'];
  $this->arr_buttons['bword']['display']          = 'only_text';
  $this->arr_buttons['bword']['display_position'] = 'img_right';
  $this->arr_buttons['bword']['style'] = 'default';
  $this->arr_buttons['bword']['image'] = 'sys__NM__nm_teste_bword.gif';

  $this->arr_buttons['bexport']['hint']             = $Nm_lang['lang_btns_expo_hint'];
  $this->arr_buttons['bexport']['type']             = 'button';
  $this->arr_buttons['bexport']['value']            = $Nm_lang['lang_btns_expo'];
  $this->arr_buttons['bexport']['display']          = 'only_text';
  $this->arr_buttons['bexport']['display_position'] = 'img_right';
  $this->arr_buttons['bexport']['style'] = 'default';
  $this->arr_buttons['bexport']['image'] = 'sys__NM__nm_teste_bexport.gif';

  $this->arr_buttons['bexportview']['hint']             = $Nm_lang['lang_btns_expv_hint'];
  $this->arr_buttons['bexportview']['type']             = 'button';
  $this->arr_buttons['bexportview']['value']            = $Nm_lang['lang_btns_expv'];
  $this->arr_buttons['bexportview']['display']          = 'only_text';
  $this->arr_buttons['bexportview']['display_position'] = 'img_right';
  $this->arr_buttons['bexportview']['style'] = 'default';
  $this->arr_buttons['bexportview']['image'] = 'sys__NM__nm_teste_bexportview.gif';

  $this->arr_buttons['bdownload']['hint']             = $Nm_lang['lang_btns_down_hint'];
  $this->arr_buttons['bdownload']['type']             = 'button';
  $this->arr_buttons['bdownload']['value']            = $Nm_lang['lang_btns_down'];
  $this->arr_buttons['bdownload']['display']          = 'only_text';
  $this->arr_buttons['bdownload']['display_position'] = 'img_right';
  $this->arr_buttons['bdownload']['style'] = 'default';
  $this->arr_buttons['bdownload']['image'] = 'sys__NM__nm_teste_bdownload.gif';

  $this->arr_buttons['binicio']['hint']             = $Nm_lang['lang_btns_frst_hint'];
  $this->arr_buttons['binicio']['type']             = 'button';
  $this->arr_buttons['binicio']['value']            = $Nm_lang['lang_btns_frst'];
  $this->arr_buttons['binicio']['display']          = 'only_img';
  $this->arr_buttons['binicio']['display_position'] = 'img_right';
  $this->arr_buttons['binicio']['style'] = 'default';
  $this->arr_buttons['binicio']['image'] = 'scriptcase__NM__nm_scriptcase8_citrine_bfinal.gif';

  $this->arr_buttons['bretorna']['hint']             = $Nm_lang['lang_btns_prev_hint'];
  $this->arr_buttons['bretorna']['type']             = 'button';
  $this->arr_buttons['bretorna']['value']            = $Nm_lang['lang_btns_prev'];
  $this->arr_buttons['bretorna']['display']          = 'only_img';
  $this->arr_buttons['bretorna']['display_position'] = 'img_right';
  $this->arr_buttons['bretorna']['style'] = 'default';
  $this->arr_buttons['bretorna']['image'] = 'scriptcase__NM__nm_scriptcase8_citrine_bcons_avanca.gif';

  $this->arr_buttons['bavanca']['hint']             = $Nm_lang['lang_btns_next_hint'];
  $this->arr_buttons['bavanca']['type']             = 'button';
  $this->arr_buttons['bavanca']['value']            = $Nm_lang['lang_btns_next'];
  $this->arr_buttons['bavanca']['display']          = 'only_img';
  $this->arr_buttons['bavanca']['display_position'] = 'img_right';
  $this->arr_buttons['bavanca']['style'] = 'default';
  $this->arr_buttons['bavanca']['image'] = 'scriptcase__NM__nm_scriptcase8_citrine_bretorna.gif';

  $this->arr_buttons['bfinal']['hint']             = $Nm_lang['lang_btns_last_hint'];
  $this->arr_buttons['bfinal']['type']             = 'button';
  $this->arr_buttons['bfinal']['value']            = $Nm_lang['lang_btns_last'];
  $this->arr_buttons['bfinal']['display']          = 'only_img';
  $this->arr_buttons['bfinal']['display_position'] = 'img_right';
  $this->arr_buttons['bfinal']['style'] = 'default';
  $this->arr_buttons['bfinal']['image'] = 'scriptcase__NM__nm_scriptcase8_citrine_binicio.gif';

  $this->arr_buttons['bincluir']['hint']             = $Nm_lang['lang_btns_inst_hint'];
  $this->arr_buttons['bincluir']['type']             = 'button';
  $this->arr_buttons['bincluir']['value']            = $Nm_lang['lang_btns_inst'];
  $this->arr_buttons['bincluir']['display']          = 'only_text';
  $this->arr_buttons['bincluir']['display_position'] = 'img_right';
  $this->arr_buttons['bincluir']['style'] = 'default';
  $this->arr_buttons['bincluir']['image'] = 'sys__NM__nm_teste_bincluir.gif';

  $this->arr_buttons['bexcluir']['hint']             = $Nm_lang['lang_btns_dele_hint'];
  $this->arr_buttons['bexcluir']['type']             = 'button';
  $this->arr_buttons['bexcluir']['value']            = $Nm_lang['lang_btns_dele'];
  $this->arr_buttons['bexcluir']['display']          = 'only_text';
  $this->arr_buttons['bexcluir']['display_position'] = 'img_right';
  $this->arr_buttons['bexcluir']['style'] = 'default';
  $this->arr_buttons['bexcluir']['image'] = 'sys__NM__nm_teste_bexcluir.gif';

  $this->arr_buttons['balterar']['hint']             = $Nm_lang['lang_btns_updt_hint'];
  $this->arr_buttons['balterar']['type']             = 'button';
  $this->arr_buttons['balterar']['value']            = $Nm_lang['lang_btns_updt'];
  $this->arr_buttons['balterar']['display']          = 'only_text';
  $this->arr_buttons['balterar']['display_position'] = 'img_right';
  $this->arr_buttons['balterar']['style'] = 'default';
  $this->arr_buttons['balterar']['image'] = 'sys__NM__nm_teste_balterar.gif';

  $this->arr_buttons['bexcluirsel']['hint']             = $Nm_lang['lang_btns_dl_sel_hint'];
  $this->arr_buttons['bexcluirsel']['type']             = 'button';
  $this->arr_buttons['bexcluirsel']['value']            = $Nm_lang['lang_btns_dl_sel'];
  $this->arr_buttons['bexcluirsel']['display']          = 'only_text';
  $this->arr_buttons['bexcluirsel']['display_position'] = 'img_right';
  $this->arr_buttons['bexcluirsel']['style'] = 'default';
  $this->arr_buttons['bexcluirsel']['image'] = 'sys__NM__nm_teste_bexcluirsel.gif';

  $this->arr_buttons['balterarsel']['hint']             = $Nm_lang['lang_btns_sv_sel_hint'];
  $this->arr_buttons['balterarsel']['type']             = 'button';
  $this->arr_buttons['balterarsel']['value']            = $Nm_lang['lang_btns_sv_sel'];
  $this->arr_buttons['balterarsel']['display']          = 'only_text';
  $this->arr_buttons['balterarsel']['display_position'] = 'img_right';
  $this->arr_buttons['balterarsel']['style'] = 'default';
  $this->arr_buttons['balterarsel']['image'] = 'sys__NM__nm_teste_balterarsel.gif';

  $this->arr_buttons['bnovo']['hint']             = $Nm_lang['lang_btns_neww_hint'];
  $this->arr_buttons['bnovo']['type']             = 'button';
  $this->arr_buttons['bnovo']['value']            = $Nm_lang['lang_btns_neww'];
  $this->arr_buttons['bnovo']['display']          = 'only_text';
  $this->arr_buttons['bnovo']['display_position'] = 'img_right';
  $this->arr_buttons['bnovo']['style'] = 'default';
  $this->arr_buttons['bnovo']['image'] = 'sys__NM__nm_teste_bnovo.gif';

  $this->arr_buttons['bform_editar']['hint']             = $Nm_lang['lang_btns_pncl_hint'];
  $this->arr_buttons['bform_editar']['type']             = 'image';
  $this->arr_buttons['bform_editar']['value']            = $Nm_lang['lang_btns_pncl'];
  $this->arr_buttons['bform_editar']['display']          = 'only_text';
  $this->arr_buttons['bform_editar']['display_position'] = 'img_right';
  $this->arr_buttons['bform_editar']['style'] = '';
  $this->arr_buttons['bform_editar']['image'] = 'scriptcase__NM__edit_form_citrine.png';

  $this->arr_buttons['bform_captura']['hint']             = $Nm_lang['lang_btns_rtrv_grid_hint'];
  $this->arr_buttons['bform_captura']['type']             = 'image';
  $this->arr_buttons['bform_captura']['value']            = $Nm_lang['lang_btns_rtrv_grid'];
  $this->arr_buttons['bform_captura']['display']          = 'only_text';
  $this->arr_buttons['bform_captura']['display_position'] = 'img_right';
  $this->arr_buttons['bform_captura']['style'] = '';
  $this->arr_buttons['bform_captura']['image'] = 'scriptcase__NM__captura_citrine.png';

  $this->arr_buttons['bform_lookuplink']['hint']             = $Nm_lang['lang_btns_rtrv_form_hint'];
  $this->arr_buttons['bform_lookuplink']['type']             = 'button';
  $this->arr_buttons['bform_lookuplink']['value']            = $Nm_lang['lang_btns_rtrv_form'];
  $this->arr_buttons['bform_lookuplink']['display']          = 'only_text';
  $this->arr_buttons['bform_lookuplink']['display_position'] = 'img_right';
  $this->arr_buttons['bform_lookuplink']['style'] = 'default';
  $this->arr_buttons['bform_lookuplink']['image'] = 'sys__NM__nm_teste_bform_lookuplink.gif';

  $this->arr_buttons['bok']['hint']             = $Nm_lang['lang_btns_cfrm_hint'];
  $this->arr_buttons['bok']['type']             = 'button';
  $this->arr_buttons['bok']['value']            = $Nm_lang['lang_btns_cfrm'];
  $this->arr_buttons['bok']['display']          = 'only_text';
  $this->arr_buttons['bok']['display_position'] = 'img_right';
  $this->arr_buttons['bok']['style'] = 'default';
  $this->arr_buttons['bok']['image'] = 'sys__NM__nm_teste_bok.gif';

  $this->arr_buttons['bcalendario']['hint']             = $Nm_lang['lang_btns_cldr_hint'];
  $this->arr_buttons['bcalendario']['type']             = 'image';
  $this->arr_buttons['bcalendario']['value']            = $Nm_lang['lang_btns_cldr'];
  $this->arr_buttons['bcalendario']['display']          = 'only_img';
  $this->arr_buttons['bcalendario']['display_position'] = 'img_right';
  $this->arr_buttons['bcalendario']['style'] = '';
  $this->arr_buttons['bcalendario']['image'] = 'scriptcase__NM__minimalist_calendar.png';

  $this->arr_buttons['bcalculadora']['hint']             = $Nm_lang['lang_btns_calc_hint'];
  $this->arr_buttons['bcalculadora']['type']             = 'image';
  $this->arr_buttons['bcalculadora']['value']            = $Nm_lang['lang_btns_calc'];
  $this->arr_buttons['bcalculadora']['display']          = 'only_img';
  $this->arr_buttons['bcalculadora']['display_position'] = 'img_right';
  $this->arr_buttons['bcalculadora']['style'] = '';
  $this->arr_buttons['bcalculadora']['image'] = 'scriptcase__NM__calculator.png';

  $this->arr_buttons['bajaxcapt']['hint']             = $Nm_lang['lang_btns_ajax_hint'];
  $this->arr_buttons['bajaxcapt']['type']             = 'image';
  $this->arr_buttons['bajaxcapt']['value']            = $Nm_lang['lang_btns_ajax'];
  $this->arr_buttons['bajaxcapt']['display']          = 'only_text';
  $this->arr_buttons['bajaxcapt']['display_position'] = 'img_right';
  $this->arr_buttons['bajaxcapt']['style'] = '';
  $this->arr_buttons['bajaxcapt']['image'] = 'scriptcase__NM__captura_citrine.png';

  $this->arr_buttons['bajaxclose']['hint']             = $Nm_lang['lang_btns_ajax_close_hint'];
  $this->arr_buttons['bajaxclose']['type']             = 'image';
  $this->arr_buttons['bajaxclose']['value']            = $Nm_lang['lang_btns_ajax_close'];
  $this->arr_buttons['bajaxclose']['display']          = 'only_text';
  $this->arr_buttons['bajaxclose']['display_position'] = 'img_right';
  $this->arr_buttons['bajaxclose']['style'] = '';
  $this->arr_buttons['bajaxclose']['image'] = 'scriptcase__NM__escape_geral.png';

  $this->arr_buttons['bcaptchareload']['hint']             = $Nm_lang['lang_btns_cptc_rfim_hint'];
  $this->arr_buttons['bcaptchareload']['type']             = 'button';
  $this->arr_buttons['bcaptchareload']['value']            = $Nm_lang['lang_btns_cptc_rfim'];
  $this->arr_buttons['bcaptchareload']['display']          = 'only_text';
  $this->arr_buttons['bcaptchareload']['display_position'] = 'img_right';
  $this->arr_buttons['bcaptchareload']['style'] = 'default';
  $this->arr_buttons['bcaptchareload']['image'] = 'sys__NM__nm_teste_bcaptchareload.gif';

  $this->arr_buttons['bsrch_mtmf']['hint']             = $Nm_lang['lang_btns_srch_mtmf_hint'];
  $this->arr_buttons['bsrch_mtmf']['type']             = 'button';
  $this->arr_buttons['bsrch_mtmf']['value']            = $Nm_lang['lang_btns_srch_mtmf'];
  $this->arr_buttons['bsrch_mtmf']['display']          = 'only_text';
  $this->arr_buttons['bsrch_mtmf']['display_position'] = 'img_right';
  $this->arr_buttons['bsrch_mtmf']['style'] = 'default';
  $this->arr_buttons['bsrch_mtmf']['image'] = 'sys__NM__nm_teste_bsrch_mtmf.gif';

  $this->arr_buttons['bcopy']['hint']             = $Nm_lang['lang_btns_copy_hint'];
  $this->arr_buttons['bcopy']['type']             = 'button';
  $this->arr_buttons['bcopy']['value']            = $Nm_lang['lang_btns_copy'];
  $this->arr_buttons['bcopy']['display']          = 'only_text';
  $this->arr_buttons['bcopy']['display_position'] = 'img_right';
  $this->arr_buttons['bcopy']['style'] = 'default';
  $this->arr_buttons['bcopy']['image'] = 'sys__NM__nm_teste_bcopy.gif';

  $this->arr_buttons['binicio_off']['hint']             = $Nm_lang['lang_btns_frst_hint'];
  $this->arr_buttons['binicio_off']['type']             = 'button';
  $this->arr_buttons['binicio_off']['value']            = $Nm_lang['lang_btns_frst'];
  $this->arr_buttons['binicio_off']['display']          = 'only_img';
  $this->arr_buttons['binicio_off']['display_position'] = 'img_right';
  $this->arr_buttons['binicio_off']['style'] = 'disabled';
  $this->arr_buttons['binicio_off']['image'] = 'scriptcase__NM__nm_scriptcase8_citrine_bfinal_off.gif';

  $this->arr_buttons['bretorna_off']['hint']             = $Nm_lang['lang_btns_prev_hint'];
  $this->arr_buttons['bretorna_off']['type']             = 'button';
  $this->arr_buttons['bretorna_off']['value']            = $Nm_lang['lang_btns_prev'];
  $this->arr_buttons['bretorna_off']['display']          = 'only_img';
  $this->arr_buttons['bretorna_off']['display_position'] = 'img_right';
  $this->arr_buttons['bretorna_off']['style'] = 'disabled';
  $this->arr_buttons['bretorna_off']['image'] = 'scriptcase__NM__nm_scriptcase8_citrine_bcons_avanca_off.gif';

  $this->arr_buttons['bavanca_off']['hint']             = $Nm_lang['lang_btns_next_hint'];
  $this->arr_buttons['bavanca_off']['type']             = 'button';
  $this->arr_buttons['bavanca_off']['value']            = $Nm_lang['lang_btns_next'];
  $this->arr_buttons['bavanca_off']['display']          = 'only_img';
  $this->arr_buttons['bavanca_off']['display_position'] = 'img_right';
  $this->arr_buttons['bavanca_off']['style'] = 'disabled';
  $this->arr_buttons['bavanca_off']['image'] = 'scriptcase__NM__nm_scriptcase8_citrine_bretorna_off.gif';

  $this->arr_buttons['bfinal_off']['hint']             = $Nm_lang['lang_btns_last_hint'];
  $this->arr_buttons['bfinal_off']['type']             = 'button';
  $this->arr_buttons['bfinal_off']['value']            = $Nm_lang['lang_btns_last'];
  $this->arr_buttons['bfinal_off']['display']          = 'only_img';
  $this->arr_buttons['bfinal_off']['display_position'] = 'img_right';
  $this->arr_buttons['bfinal_off']['style'] = 'disabled';
  $this->arr_buttons['bfinal_off']['image'] = 'scriptcase__NM__nm_scriptcase8_citrine_binicio_off.gif';

  $this->arr_buttons['bpesquisa']['hint']             = $Nm_lang['lang_btns_srch_hint'];
  $this->arr_buttons['bpesquisa']['type']             = 'button';
  $this->arr_buttons['bpesquisa']['value']            = $Nm_lang['lang_btns_srch'];
  $this->arr_buttons['bpesquisa']['display']          = 'only_text';
  $this->arr_buttons['bpesquisa']['display_position'] = 'img_right';
  $this->arr_buttons['bpesquisa']['style'] = 'default';
  $this->arr_buttons['bpesquisa']['image'] = 'sys__NM__nm_teste_bpesquisa.gif';

  $this->arr_buttons['blimpar']['hint']             = $Nm_lang['lang_btns_clea_hint'];
  $this->arr_buttons['blimpar']['type']             = 'button';
  $this->arr_buttons['blimpar']['value']            = $Nm_lang['lang_btns_clea'];
  $this->arr_buttons['blimpar']['display']          = 'only_text';
  $this->arr_buttons['blimpar']['display_position'] = 'img_right';
  $this->arr_buttons['blimpar']['style'] = 'default';
  $this->arr_buttons['blimpar']['image'] = 'sys__NM__nm_teste_blimpar.gif';

  $this->arr_buttons['bsalvar']['hint']             = $Nm_lang['lang_btns_save_hint'];
  $this->arr_buttons['bsalvar']['type']             = 'button';
  $this->arr_buttons['bsalvar']['value']            = $Nm_lang['lang_btns_save'];
  $this->arr_buttons['bsalvar']['display']          = 'only_text';
  $this->arr_buttons['bsalvar']['display_position'] = 'img_right';
  $this->arr_buttons['bsalvar']['style'] = 'default';
  $this->arr_buttons['bsalvar']['image'] = 'sys__NM__nm_teste_bsalvar.gif';

  $this->arr_buttons['bedit_filter']['hint']             = $Nm_lang['lang_btns_srch_edit_hint'];
  $this->arr_buttons['bedit_filter']['type']             = 'button';
  $this->arr_buttons['bedit_filter']['value']            = $Nm_lang['lang_btns_srch_edit'];
  $this->arr_buttons['bedit_filter']['display']          = 'only_text';
  $this->arr_buttons['bedit_filter']['display_position'] = 'img_right';
  $this->arr_buttons['bedit_filter']['style'] = 'default';
  $this->arr_buttons['bedit_filter']['image'] = 'sys__NM__nm_teste_bedit_filter.gif';

  $this->arr_buttons['bquick_search']['hint']             = $Nm_lang['lang_btns_quck_srch_hint'];
  $this->arr_buttons['bquick_search']['type']             = 'button';
  $this->arr_buttons['bquick_search']['value']            = $Nm_lang['lang_btns_quck_srch'];
  $this->arr_buttons['bquick_search']['display']          = 'only_img';
  $this->arr_buttons['bquick_search']['display_position'] = 'img_right';
  $this->arr_buttons['bquick_search']['style'] = 'default';
  $this->arr_buttons['bquick_search']['image'] = 'scriptcase__NM__search.png';

  $this->arr_buttons['bmd_incluir']['hint']             = $Nm_lang['lang_btns_mdtl_inst_hint'];
  $this->arr_buttons['bmd_incluir']['type']             = 'image';
  $this->arr_buttons['bmd_incluir']['value']            = $Nm_lang['lang_btns_mdtl_inst'];
  $this->arr_buttons['bmd_incluir']['display']          = 'only_text';
  $this->arr_buttons['bmd_incluir']['display_position'] = 'img_right';
  $this->arr_buttons['bmd_incluir']['style'] = '';
  $this->arr_buttons['bmd_incluir']['image'] = 'scriptcase__NM__save_citrine.png';

  $this->arr_buttons['bmd_excluir']['hint']             = $Nm_lang['lang_btns_mdtl_dele_hint'];
  $this->arr_buttons['bmd_excluir']['type']             = 'image';
  $this->arr_buttons['bmd_excluir']['value']            = $Nm_lang['lang_btns_mdtl_dele'];
  $this->arr_buttons['bmd_excluir']['display']          = 'only_text';
  $this->arr_buttons['bmd_excluir']['display_position'] = 'img_right';
  $this->arr_buttons['bmd_excluir']['style'] = '';
  $this->arr_buttons['bmd_excluir']['image'] = 'scriptcase__NM__delete_geral.png';

  $this->arr_buttons['bmd_alterar']['hint']             = $Nm_lang['lang_btns_mdtl_updt_hint'];
  $this->arr_buttons['bmd_alterar']['type']             = 'image';
  $this->arr_buttons['bmd_alterar']['value']            = $Nm_lang['lang_btns_mdtl_updt'];
  $this->arr_buttons['bmd_alterar']['display']          = 'only_text';
  $this->arr_buttons['bmd_alterar']['display_position'] = 'img_right';
  $this->arr_buttons['bmd_alterar']['style'] = '';
  $this->arr_buttons['bmd_alterar']['image'] = 'scriptcase__NM__update_citrine.png';

  $this->arr_buttons['bmd_novo']['hint']             = $Nm_lang['lang_btns_copy_hint'];
  $this->arr_buttons['bmd_novo']['type']             = 'button';
  $this->arr_buttons['bmd_novo']['value']            = $Nm_lang['lang_btns_copy'];
  $this->arr_buttons['bmd_novo']['display']          = 'only_text';
  $this->arr_buttons['bmd_novo']['display_position'] = 'img_right';
  $this->arr_buttons['bmd_novo']['style'] = 'default';
  $this->arr_buttons['bmd_novo']['image'] = 'sys__NM__nm_teste_bmd_novo.gif';

  $this->arr_buttons['bmd_cancelar']['hint']             = $Nm_lang['lang_btns_mdtl_cncl_hint'];
  $this->arr_buttons['bmd_cancelar']['type']             = 'image';
  $this->arr_buttons['bmd_cancelar']['value']            = $Nm_lang['lang_btns_mdtl_cncl'];
  $this->arr_buttons['bmd_cancelar']['display']          = 'only_text';
  $this->arr_buttons['bmd_cancelar']['display_position'] = 'img_right';
  $this->arr_buttons['bmd_cancelar']['style'] = '';
  $this->arr_buttons['bmd_cancelar']['image'] = 'scriptcase__NM__cancel_geral.png';

  $this->arr_buttons['bmd_edit']['hint']             = $Nm_lang['lang_btns_mdtl_edit_hint'];
  $this->arr_buttons['bmd_edit']['type']             = 'image';
  $this->arr_buttons['bmd_edit']['value']            = $Nm_lang['lang_btns_mdtl_edit'];
  $this->arr_buttons['bmd_edit']['display']          = 'only_text';
  $this->arr_buttons['bmd_edit']['display_position'] = 'img_right';
  $this->arr_buttons['bmd_edit']['style'] = '';
  $this->arr_buttons['bmd_edit']['image'] = 'scriptcase__NM__edit_form_citrine.png';

  $this->arr_buttons['bfacebook']['hint']             = '{Facebook_hint}';
  $this->arr_buttons['bfacebook']['type']             = 'image';
  $this->arr_buttons['bfacebook']['value']            = '{Facebook}';
  $this->arr_buttons['bfacebook']['display']          = 'only_text';
  $this->arr_buttons['bfacebook']['display_position'] = 'img_right';
  $this->arr_buttons['bfacebook']['style'] = '';
  $this->arr_buttons['bfacebook']['image'] = 'scriptcase__NM__scriptacase8_citrino_facebook.png';

  $this->arr_buttons['bgoogle']['hint']             = '{Google_hint}';
  $this->arr_buttons['bgoogle']['type']             = 'image';
  $this->arr_buttons['bgoogle']['value']            = '{Google}';
  $this->arr_buttons['bgoogle']['display']          = 'only_text';
  $this->arr_buttons['bgoogle']['display_position'] = 'img_right';
  $this->arr_buttons['bgoogle']['style'] = '';
  $this->arr_buttons['bgoogle']['image'] = 'scriptcase__NM__scriptacase8_citrino_google.png';

  $this->arr_buttons['bpaypal']['hint']             = '{Paypal_hint}';
  $this->arr_buttons['bpaypal']['type']             = 'image';
  $this->arr_buttons['bpaypal']['value']            = '{Paypal}';
  $this->arr_buttons['bpaypal']['display']          = 'only_text';
  $this->arr_buttons['bpaypal']['display_position'] = 'img_right';
  $this->arr_buttons['bpaypal']['style'] = '';
  $this->arr_buttons['bpaypal']['image'] = 'scriptcase__NM__scriptacase8_citrino_paypal.png';

  $this->arr_buttons['btwitter']['hint']             = '{Twitter_hint}';
  $this->arr_buttons['btwitter']['type']             = 'image';
  $this->arr_buttons['btwitter']['value']            = '{Twitter}';
  $this->arr_buttons['btwitter']['display']          = 'only_text';
  $this->arr_buttons['btwitter']['display_position'] = 'img_right';
  $this->arr_buttons['btwitter']['style'] = '';
  $this->arr_buttons['btwitter']['image'] = 'scriptcase__NM__scriptacase8_citrino_twitter.png';

  $this->arr_buttons['bmenu']['hint']             = '{Menu_hint}';
  $this->arr_buttons['bmenu']['type']             = 'image';
  $this->arr_buttons['bmenu']['value']            = '{Menu}';
  $this->arr_buttons['bmenu']['display']          = 'only_img';
  $this->arr_buttons['bmenu']['display_position'] = 'text_right';
  $this->arr_buttons['bmenu']['style'] = '';
  $this->arr_buttons['bmenu']['image'] = 'scriptcase__NM__btn_menu.png';

  $this->arr_buttons['bhelp']['hint']             = $Nm_lang['lang_btns_help_hint'];
  $this->arr_buttons['bhelp']['type']             = 'button';
  $this->arr_buttons['bhelp']['value']            = $Nm_lang['lang_btns_help'];
  $this->arr_buttons['bhelp']['display']          = 'only_text';
  $this->arr_buttons['bhelp']['display_position'] = 'img_right';
  $this->arr_buttons['bhelp']['style'] = 'default';
  $this->arr_buttons['bhelp']['image'] = 'sys__NM__nm_teste_bhelp.gif';

  $this->arr_buttons['bsair']['hint']             = $Nm_lang['lang_btns_exit_hint'];
  $this->arr_buttons['bsair']['type']             = 'button';
  $this->arr_buttons['bsair']['value']            = $Nm_lang['lang_btns_exit'];
  $this->arr_buttons['bsair']['display']          = 'only_text';
  $this->arr_buttons['bsair']['display_position'] = 'img_right';
  $this->arr_buttons['bsair']['style'] = 'default';
  $this->arr_buttons['bsair']['image'] = 'sys__NM__nm_teste_bsair.gif';

  $this->arr_buttons['bvoltar']['hint']             = $Nm_lang['lang_btns_back_hint'];
  $this->arr_buttons['bvoltar']['type']             = 'button';
  $this->arr_buttons['bvoltar']['value']            = $Nm_lang['lang_btns_back'];
  $this->arr_buttons['bvoltar']['display']          = 'only_text';
  $this->arr_buttons['bvoltar']['display_position'] = 'img_right';
  $this->arr_buttons['bvoltar']['style'] = 'default';
  $this->arr_buttons['bvoltar']['image'] = 'sys__NM__nm_teste_bvoltar.gif';

  $this->arr_buttons['bcancelar']['hint']             = $Nm_lang['lang_btns_cncl_hint'];
  $this->arr_buttons['bcancelar']['type']             = 'button';
  $this->arr_buttons['bcancelar']['value']            = $Nm_lang['lang_btns_cncl'];
  $this->arr_buttons['bcancelar']['display']          = 'only_text';
  $this->arr_buttons['bcancelar']['display_position'] = 'img_right';
  $this->arr_buttons['bcancelar']['style'] = 'default';
  $this->arr_buttons['bcancelar']['image'] = 'sys__NM__nm_teste_bcancelar.gif';

  $this->arr_buttons['bapply']['hint']             = $Nm_lang['lang_btns_apply_hint'];
  $this->arr_buttons['bapply']['type']             = 'button';
  $this->arr_buttons['bapply']['value']            = $Nm_lang['lang_btns_apply'];
  $this->arr_buttons['bapply']['display']          = 'only_text';
  $this->arr_buttons['bapply']['display_position'] = 'img_right';
  $this->arr_buttons['bapply']['style'] = 'default';
  $this->arr_buttons['bapply']['image'] = 'sys__NM__nm_teste_bapply.gif';

  $this->arr_buttons['brestore']['hint']             = $Nm_lang['lang_btns_restore_hint'];
  $this->arr_buttons['brestore']['type']             = 'button';
  $this->arr_buttons['brestore']['value']            = $Nm_lang['lang_btns_restore'];
  $this->arr_buttons['brestore']['display']          = 'only_text';
  $this->arr_buttons['brestore']['display_position'] = 'img_right';
  $this->arr_buttons['brestore']['style'] = 'default';
  $this->arr_buttons['brestore']['image'] = 'sys__NM__nm_teste_brestore.gif';

  $this->arr_buttons['bzipcode']['hint']             = $Nm_lang['lang_btns_zpcd_hint'];
  $this->arr_buttons['bzipcode']['type']             = 'button';
  $this->arr_buttons['bzipcode']['value']            = $Nm_lang['lang_btns_zpcd'];
  $this->arr_buttons['bzipcode']['display']          = 'only_text';
  $this->arr_buttons['bzipcode']['display_position'] = 'text_right';
  $this->arr_buttons['bzipcode']['style'] = 'default';
  $this->arr_buttons['bzipcode']['image'] = 'scriptcase__NM__nm_scriptcase8_citrine_bzipcode.gif';

  $this->arr_buttons['blink']['hint']             = $Nm_lang['lang_btns_iurl_hint'];
  $this->arr_buttons['blink']['type']             = 'button';
  $this->arr_buttons['blink']['value']            = $Nm_lang['lang_btns_iurl'];
  $this->arr_buttons['blink']['display']          = 'only_text';
  $this->arr_buttons['blink']['display_position'] = 'img_right';
  $this->arr_buttons['blink']['style'] = 'default';
  $this->arr_buttons['blink']['image'] = 'sys__NM__nm_teste_blink.gif';

  $this->arr_buttons['blanguage']['hint']             = $Nm_lang['lang_btns_lang_hint'];
  $this->arr_buttons['blanguage']['type']             = 'button';
  $this->arr_buttons['blanguage']['value']            = $Nm_lang['lang_btns_lang'];
  $this->arr_buttons['blanguage']['display']          = 'only_text';
  $this->arr_buttons['blanguage']['display_position'] = 'img_right';
  $this->arr_buttons['blanguage']['style'] = 'default';
  $this->arr_buttons['blanguage']['image'] = 'sys__NM__nm_teste_blanguage.gif';

  $this->arr_buttons['bfieldhelp']['hint']             = $Nm_lang['lang_btns_hlpf_hint'];
  $this->arr_buttons['bfieldhelp']['type']             = 'image';
  $this->arr_buttons['bfieldhelp']['value']            = $Nm_lang['lang_btns_hlpf'];
  $this->arr_buttons['bfieldhelp']['display']          = 'only_text';
  $this->arr_buttons['bfieldhelp']['display_position'] = 'img_right';
  $this->arr_buttons['bfieldhelp']['style'] = '';
  $this->arr_buttons['bfieldhelp']['image'] = 'scriptcase__NM__citrine_help.png';

  $this->arr_buttons['bsrgb']['hint']             = $Nm_lang['lang_btns_srgb_hint'];
  $this->arr_buttons['bsrgb']['type']             = 'image';
  $this->arr_buttons['bsrgb']['value']            = $Nm_lang['lang_btns_srgb'];
  $this->arr_buttons['bsrgb']['display']          = 'only_text';
  $this->arr_buttons['bsrgb']['display_position'] = 'img_right';
  $this->arr_buttons['bsrgb']['style'] = '';
  $this->arr_buttons['bsrgb']['image'] = 'scriptcase__NM__color.png';

  $this->arr_buttons['berrm_clse']['hint']             = $Nm_lang['lang_btns_errm_clse_hint'];
  $this->arr_buttons['berrm_clse']['type']             = 'button';
  $this->arr_buttons['berrm_clse']['value']            = $Nm_lang['lang_btns_errm_clse'];
  $this->arr_buttons['berrm_clse']['display']          = 'only_text';
  $this->arr_buttons['berrm_clse']['display_position'] = 'img_right';
  $this->arr_buttons['berrm_clse']['style'] = 'default';
  $this->arr_buttons['berrm_clse']['image'] = 'sys__NM__nm_teste_berrm_clse.gif';

  $this->arr_buttons['bemail']['hint']             = $Nm_lang['lang_btns_emai_hint'];
  $this->arr_buttons['bemail']['type']             = 'button';
  $this->arr_buttons['bemail']['value']            = $Nm_lang['lang_btns_emai'];
  $this->arr_buttons['bemail']['display']          = 'only_text';
  $this->arr_buttons['bemail']['display_position'] = 'img_right';
  $this->arr_buttons['bemail']['style'] = 'default';
  $this->arr_buttons['bemail']['image'] = 'sys__NM__nm_teste_bemail.gif';

  $this->arr_buttons['bcapture']['hint']             = $Nm_lang['lang_btns_pick_hint'];
  $this->arr_buttons['bcapture']['type']             = 'button';
  $this->arr_buttons['bcapture']['value']            = $Nm_lang['lang_btns_pick'];
  $this->arr_buttons['bcapture']['display']          = 'only_text';
  $this->arr_buttons['bcapture']['display_position'] = 'img_right';
  $this->arr_buttons['bcapture']['style'] = 'default';
  $this->arr_buttons['bcapture']['image'] = 'sys__NM__nm_teste_bcapture.gif';

  $this->arr_buttons['bmessageclose']['hint']             = $Nm_lang['lang_btns_mess_clse_hint'];
  $this->arr_buttons['bmessageclose']['type']             = 'button';
  $this->arr_buttons['bmessageclose']['value']            = $Nm_lang['lang_btns_mess_clse'];
  $this->arr_buttons['bmessageclose']['display']          = 'only_text';
  $this->arr_buttons['bmessageclose']['display_position'] = 'img_right';
  $this->arr_buttons['bmessageclose']['style'] = 'default';
  $this->arr_buttons['bmessageclose']['image'] = 'sys__NM__nm_teste_bmessageclose.gif';

  $this->arr_buttons['bgooglemaps']['hint']             = $Nm_lang['lang_btns_maps_hint'];
  $this->arr_buttons['bgooglemaps']['type']             = 'button';
  $this->arr_buttons['bgooglemaps']['value']            = $Nm_lang['lang_btns_maps'];
  $this->arr_buttons['bgooglemaps']['display']          = 'only_text';
  $this->arr_buttons['bgooglemaps']['display_position'] = 'img_right';
  $this->arr_buttons['bgooglemaps']['style'] = 'default';
  $this->arr_buttons['bgooglemaps']['image'] = 'sys__NM__nm_teste_bgooglemaps.gif';

  $this->arr_buttons['byoutube']['hint']             = $Nm_lang['lang_btns_yutb_hint'];
  $this->arr_buttons['byoutube']['type']             = 'button';
  $this->arr_buttons['byoutube']['value']            = $Nm_lang['lang_btns_yutb'];
  $this->arr_buttons['byoutube']['display']          = 'only_text';
  $this->arr_buttons['byoutube']['display_position'] = 'img_right';
  $this->arr_buttons['byoutube']['style'] = 'default';
  $this->arr_buttons['byoutube']['image'] = 'sys__NM__nm_teste_byoutube.gif';

  $this->arr_buttons['bpassfld_up']['hint']             = $Nm_lang['lang_btns_bpassfld_up_hint'];
  $this->arr_buttons['bpassfld_up']['type']             = 'image';
  $this->arr_buttons['bpassfld_up']['value']            = $Nm_lang['lang_btns_bpassfld_up'];
  $this->arr_buttons['bpassfld_up']['display']          = 'text_img';
  $this->arr_buttons['bpassfld_up']['display_position'] = 'text_right';
  $this->arr_buttons['bpassfld_up']['style'] = '';
  $this->arr_buttons['bpassfld_up']['image'] = 'scriptcase__NM__scriptacase8_citrino_up.png';

  $this->arr_buttons['bpassfld_down']['hint']             = $Nm_lang['lang_btns_bpassfld_down_hint'];
  $this->arr_buttons['bpassfld_down']['type']             = 'image';
  $this->arr_buttons['bpassfld_down']['value']            = $Nm_lang['lang_btns_bpassfld_down'];
  $this->arr_buttons['bpassfld_down']['display']          = 'only_img';
  $this->arr_buttons['bpassfld_down']['display_position'] = 'text_right';
  $this->arr_buttons['bpassfld_down']['style'] = '';
  $this->arr_buttons['bpassfld_down']['image'] = 'scriptcase__NM__scriptacase8_citrino_down.png';

  $this->arr_buttons['bpassfld_rightall']['hint']             = $Nm_lang['lang_btns_bpassfld_rightall_hint'];
  $this->arr_buttons['bpassfld_rightall']['type']             = 'image';
  $this->arr_buttons['bpassfld_rightall']['value']            = $Nm_lang['lang_btns_bpassfld_rightall'];
  $this->arr_buttons['bpassfld_rightall']['display']          = 'only_img';
  $this->arr_buttons['bpassfld_rightall']['display_position'] = 'text_right';
  $this->arr_buttons['bpassfld_rightall']['style'] = '';
  $this->arr_buttons['bpassfld_rightall']['image'] = 'scriptcase__NM__scriptacase8_citrino_all_left.png';

  $this->arr_buttons['bpassfld_right']['hint']             = $Nm_lang['lang_btns_bpassfld_right_hint'];
  $this->arr_buttons['bpassfld_right']['type']             = 'image';
  $this->arr_buttons['bpassfld_right']['value']            = $Nm_lang['lang_btns_bpassfld_right'];
  $this->arr_buttons['bpassfld_right']['display']          = 'only_img';
  $this->arr_buttons['bpassfld_right']['display_position'] = 'text_right';
  $this->arr_buttons['bpassfld_right']['style'] = '';
  $this->arr_buttons['bpassfld_right']['image'] = 'scriptcase__NM__scriptacase8_citrino_one_left.png';

  $this->arr_buttons['bpassfld_leftall']['hint']             = $Nm_lang['lang_btns_bpassfld_leftall_hint'];
  $this->arr_buttons['bpassfld_leftall']['type']             = 'image';
  $this->arr_buttons['bpassfld_leftall']['value']            = $Nm_lang['lang_btns_bpassfld_leftall'];
  $this->arr_buttons['bpassfld_leftall']['display']          = 'only_img';
  $this->arr_buttons['bpassfld_leftall']['display_position'] = 'text_right';
  $this->arr_buttons['bpassfld_leftall']['style'] = '';
  $this->arr_buttons['bpassfld_leftall']['image'] = 'scriptcase__NM__scriptacase8_citrino_all_right.png';

  $this->arr_buttons['bpassfld_left']['hint']             = $Nm_lang['lang_btns_bpassfld_left_hint'];
  $this->arr_buttons['bpassfld_left']['type']             = 'image';
  $this->arr_buttons['bpassfld_left']['value']            = $Nm_lang['lang_btns_bpassfld_left'];
  $this->arr_buttons['bpassfld_left']['display']          = 'only_img';
  $this->arr_buttons['bpassfld_left']['display_position'] = 'text_right';
  $this->arr_buttons['bpassfld_left']['style'] = '';
  $this->arr_buttons['bpassfld_left']['image'] = 'scriptcase__NM__scriptacase8_citrino_one_right.png';

?>