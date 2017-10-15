/**
 * funcoes de ajax
 *
 * rotinas de controle de ajax
 *
 * @package     Biblioteca
 * @subpackage  Javascript
 * @creation    2006/05/03
 * @copyright   NetMake Solucoes em Informatica
 * @author      Diogo Silva Toscano De Brito <diogo@netmake.com.br>
 * @author      Eloy Cavadinha <eloy@netmake.com.br>
 *
 * $Id: ajax.js,v 1.1.1.1 2011-05-12 20:31:10 diogo Exp $
 */


/**
 * Faz uma solicitação ajax do tipo POST para o servidor
 *
 * Envia o ajax para o servidor de acordo com os parametros repassados
 * podendo executar funçãoo de callback ou retornar a resposta.
 *
 * PARAMETROS:
 * @url -  String com a url alvo do ajax
 * @parametros - String contendo os parametros (formato requisição get)
 * @str_func_retorno - String contendo o nome da função de retorno. (opcional)
 * @isSync - Boolean informando se o ajax é sincrono ou assincrono. 
 *           Deve ser true caso o front-end precise do retorno para executar algo. (opcional)
 * @debug - Boolean informando se deseja visualizar no console / tela um print da string de retorno.
 * 
 * RETORNO:
 * @return - retorna os dados da requisição se não tiver função de callback registrada.
 */
function doAjaxServer(url, parametros, str_func_retorno, isAsync, debug)
{
//    callReloadModalPanel();
//    debug   = (typeof(debug) != "undefined"   || str_func_retorno === null)   ? false :  true;
//    isSync  = (typeof(isSync) != "undefined"  || str_func_retorno === null)   ? true  : false;
//    str_func_retorno  = (typeof(str_func_retorno) != "undefined" || str_func_retorno === null)   ? false  : str_func_retorno;
    debug   = true;
    isAsync  = (typeof(isAsync) === "undefined") ? true  : false;
        
    $.ajax
    ({
        type: 'POST',
        url:  url,
        async: isAsync,
        data: parametros,
        success: function(str_return) 
        {
//            removeReloadModalPanel();
//            if (debug)
//            {
//                console.log(str_return);
//                $('body').append("<pre>" + str_return + "</pre>");
//            }
            if (str_func_retorno instanceof Function)
            {
                if (str_return.indexOf('<!-- SESSAO INSPIROU -->') > -1)
      	  	{
      	  		var form_logout = getFormLogout(window);
      	  		console.log('Expired Session.');
      	  		if (form_logout)
      	  		{
      	  			form_logout.submit();
      	  		}
      	  	} 
                else
                {
                    str_func_retorno(str_return);
                }
            }
//            if (str_func_retorno === false)
//            {
//                return str_return;
//            }
//            else
//            {
//                str_func_retorno(str_return);
//            }
        },error: function(XMLHttpRequest, textStatus, errorThrown) {
//            alert('SC Ajax Error: Check your console!');
            console.log(errorThrown);
//            removeReloadModalPanel();
        }
    });
}

function callReloadModalPanel(type)
{
    type = (typeof(type) != "undefined") ? "gear" :  type;
    type = "gear";
    var background_color = {black:"background-color:#000;", gray:"background-color: #444;", white:"background-color: #FFF;", gear:"background-color: #FFF;", party:"background-color: #000;"};
    var image = {black:"page_loader_white.gif", gray:"page_loader_white.gif", white:"page_loader_black.gif", gear:"page_loader_gears.gif", party:"party_loader.gif"};
    
    var style = 'style="position:fixed;top:0px;height:100%;width:100%;opacity:0.75;overflow:hidden;'+background_color[type]+'"';
    var modal_html  = '<div id="sc-ajax-modal" ' + style + '>';
        modal_html +=  '<div style="position:relative;top:30%;left:45%">';
        modal_html +=  '<img width="150px" src="../conf/scriptcase/img/ico/'+image[type]+'" />';
//        modal_html +=  '<p style="cursor:default;text-align:center;font-family:inherit;font-size:2em;margin-left:1em;">Loading...</p>';
        modal_html +=  '</div></div>';
        
    $('body').append(modal_html);
}

function removeReloadModalPanel()
{
    $('#sc-ajax-modal').remove();
}

function getDataAjax(url, str_func_retorno)
{
    doAjaxServer(url, "", str_func_retorno);
}

function postDataAjax(url, str, str_func_retorno, str_html)
{
    doAjaxServer(url, str, str_func_retorno);
}

function getDataAjax_OLD(url, str_func_retorno)
{
    url_ok = url.replace(/[#]/g, "%23");

    xmlhttp = getXmlHttp(); 
    xmlhttp.open('GET', url_ok, true);  
    xmlhttp.onreadystatechange=function() { 
      if (xmlhttp.readyState==4){  
      	  if(str_func_retorno)
      	  {
      	  	retornoText = xmlhttp.responseText;
      	  	
      	  	if (retornoText.indexOf('<!-- SESSAO INSPIROU -->') > -1)
      	  	{
      	  		form_logout = getFormLogout(window);
      	  		
      	  		if (form_logout)
      	  		{
      	  			form_logout.submit();
      	  		}
      	  	}
      	  	else
      	  	{
      	  		str_func_retorno(retornoText);
      	  	}	
      	  }      	  
      } 
    }
    xmlhttp.send(null); 
}

function postDataAjax_OLD(url, str, str_func_retorno, str_html)
{
	//protege caracteres especiais
	if(str_html && str_html == 'S')
	{
		str_param = str;
	}else
	{
		str_param = "";
		if(str.indexOf('&'))
		{
			arr_param = str.split('&');
			
			for(it=0; it<arr_param.length; it++)
			{
				if(arr_param[it].indexOf('='))
				{
					arr_valor = arr_param[it].split('=');
					
					str_variavel = "";
					if(arr_valor[0])
					{
						str_variavel = arr_valor[0];
					}
					
					str_valor = "";
					if(arr_valor[1])
					{
						str_valor = arr_valor[1];
					}
					
					if(str_param != '')
					{
						str_param += '&';
					}
					
					str_param += str_variavel + '=' + escape(str_valor);
				}
			}
		}else
		{
			arr_valor = str.split('=');
					
			if(str_param != '')
			{
				str_param += '&';
			}
			
			str_param += arr_valor[0] + '=' + escape(arr_valor[1]);
		}
	}
	
	xmlhttp = getXmlHttp(); 
	xmlhttp.open('POST', url, true);
	//xmlhttp.setRequestHeader("Referer"     , document.referrer);
	xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	//xmlhttp.setRequestHeader("User-Agent"  , "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)");
	//xmlhttp.setRequestHeader("Pragma"      , "no-cache");
	xmlhttp.send(str_param);
	xmlhttp.onreadystatechange=function() { 
      if (xmlhttp.readyState==4){  
      	  if(str_func_retorno)
      	  {
      	  	str_func_retorno(xmlhttp.responseText);
      	  }      	  
      } 
    }
}


function getXmlHttp() {  
    try {  
        xmlhttp = new XMLHttpRequest();  
    } catch(e1) { 
        try { 
    	    xmlhttp = new ActiveXObject('Msxml2.XMLHTTP'); 
            }catch(e2) { 
    	try {  
    	    xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');  
    	}catch(e3){ 
                xmlhttp = false;  
    	}  
       } 
    }  
    return xmlhttp; 
} 


function getFormLogout(win)
{
	frm = null;
	
	if (win && win.document && win.document.frames)
	{	
		for (ifr = 0;  ifr < win.document.frames.length; ifr++)
		{
			
			if (win.document.frames.item(ifr).name == "nmFrmBot")
			{	
				frm = win.document.form_logout;
				break;
			}
		}
	}
		
	if (frm == null && win.parent)
	{
		return getFormLogout(win.parent);		
	}
	else
	{
		return frm;
	}
}