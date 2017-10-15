function nmChangeFormatGraf(tp_formato_graf)
{
	if (tp_formato_graf == 'image')
	{
		$("#idChart_jpgraph").show();
		$("#idChart_flash").hide();
		
		
		$("#idChart_jpgraph").html(tit_graf_image);
	}
	else
	{
		$("#idChart_jpgraph").hide();
		$("#idChart_flash").show();
		
		$("#idChart_jpgraph").html(tit_graf_flash);
	}
	
	$("#id_tr_graf_option_tr_cima").show();
	$("#id_tr_graf_option").show();
	$("#id_tr_graf_show_vals_tr_cima").show();
	$("#id_tr_graf_show_vals").show();
	$("#id_tr_Graf_Largura_tr_cima").show();
	$("#id_tr_Graf_Largura").show();
	$("#id_tr_Graf_Altura_tr_cima").show();
	$("#id_tr_Graf_Altura").show();
	$("#id_tr_graf_nov_pag_tr_cima").show();
	$("#span_tit_config_graf").show();
}

function nm_toggle_graf_nov_pag(obj_sel)
{
	if(document.getElementById("id_tr_graf_qtd_cols"))
	{
		document.getElementById("id_tr_graf_qtd_cols").style.display  = "none";
		document.getElementById("id_tr_graf_only_res").style.display  = "none";
		document.getElementById("id_tr_graf_margin").style.display    = "none";
		document.getElementById("id_tr_graf_align").style.display     = "none";
		document.getElementById("id_tr_graf_valign").style.display    = "none";
		document.getElementById("id_tr_graf_antes_res").style.display = "none";
		document.getElementById("id_tr_flash_chart_standalone_config").style.display = "";
		document.getElementById("id_tr_graf_qtd_cols_tr_cima").style.display  = "none";
		document.getElementById("id_tr_graf_only_res_tr_cima").style.display  = "none";
		document.getElementById("id_tr_graf_margin_tr_cima").style.display    = "none";
		document.getElementById("id_tr_graf_align_tr_cima").style.display     = "none";
		document.getElementById("id_tr_graf_valign_tr_cima").style.display    = "none";
		document.getElementById("id_tr_graf_antes_res_tr_cima").style.display = "none";
		document.getElementById("id_tr_flash_chart_standalone_config_tr_cima").style.display = "";
	}
	if(obj_sel.value == 'X')
	{
		if(document.getElementById("id_tr_graf_qtd_cols"))
		{
			document.getElementById("id_tr_graf_qtd_cols").style.display  = "";
			document.getElementById("id_tr_graf_only_res").style.display  = "none";
			document.getElementById("id_tr_graf_margin").style.display    = "";
			document.getElementById("id_tr_graf_align").style.display     = "";
			document.getElementById("id_tr_graf_valign").style.display    = "";
			document.getElementById("id_tr_graf_antes_res").style.display = "";
			document.getElementById("id_tr_flash_chart_standalone_config").style.display = "none";

			document.getElementById("id_tr_graf_qtd_cols_tr_cima").style.display  = "";
			document.getElementById("id_tr_graf_only_res_tr_cima").style.display  = "none";
			document.getElementById("id_tr_graf_margin_tr_cima").style.display    = "";
			document.getElementById("id_tr_graf_align_tr_cima").style.display     = "";
			document.getElementById("id_tr_graf_valign_tr_cima").style.display    = "";
			document.getElementById("id_tr_graf_antes_res_tr_cima").style.display = "";
			document.getElementById("id_tr_flash_chart_standalone_config_tr_cima").style.display = "none";
		}
	}
}

function nm_schema_view_chart()
{
	if ($("#id_chartpallet").val() !== undefined){
	
		if ($("#id_chartpallet").val() != '' && $("#id_chartpallet").val() != '0' ){
			
			$("#id_grid_chart_type").val('');	
			$.ajax({
			  type: 'POST',
			  async: false,
			  url: nm_url_iface + 'app.php',
			  data: 'ajax=S&option=view_chart&chartpallet=' + document.form_edit.chartpallet.value + '&schemachart=' + document.form_edit.schemachart.value + '&grid_chart_type=' + document.form_edit.grid_chart_type.value,
			  success: function(html_retorno)
			  {
				  chart.setXMLData(html_retorno);
				  chart.render("id_div_chart");
			  }
			});
		}
	}
}

function nm_view_chart_type()
{
	if ($("#id_grid_chart_type").val() != ''){
		
		$("#id_chartpallet").val('');
		$("#id_schemachart").val(''); 
	}
		$.ajax({
			  type: 'POST',
			  async: false,
			  url: nm_url_iface + 'app.php',
			  data: 'ajax=S&option=view_chart_type&chartpallet=&schemachart=&grid_chart_type=' + document.form_edit.grid_chart_type.value,
			  success: function(html_retorno)
			  {
				  chart.setXMLData(html_retorno);
				  chart.render("id_div_chart");
			  }
		});
}

function viewChart(str_chart, str_editor)
{
	if(str_chart != '__NEW__')
	{
		param = 'ajax=S&';
		param = param + 'option=view_chart_type&';
		param = param + 'str_chart=' + str_chart + '&';
		param = param + 'str_editor=' + str_editor;
		$.ajax({
			type: 'POST',
			url:  nm_url_iface + 'app.php',
			data: param,
			success: function(msg)
			{
				setViewChart(msg);
			},
			error: function(XMLHttpRequest, textStatus, errorThrown)
			{
				setViewChart(errorThrown);
			}
		});
	}else
	{
		setViewChart('_@NM@_' + str_chart + '_@NM@_'  + str_editor);
	}
}

function setViewChart(str_return)
{
	str_return = str_return.split('_@NM@_');
	arr_schema = str_return[3].split('_#NM#_');
}

function nm_edit_confirm(str_section, mix_param, str_fld_section)
{
	var str_status = "N";
	if ("Y" == document.form_edit.form_modified.value)
	{
		if(auto_save == 'Y' || confirm(lang_edit_confirm))
		{
			nm_edit_save(str_section, mix_param, str_fld_section);
			str_status = "Y";
		}

		document.form_edit.form_modified.value = str_status;

	}
	return str_status;
}