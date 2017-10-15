  function nmAjaxShowDebug(oTemp)
  {
    if (!document.getElementById("id_debug_window")) {
      return;
    }
    if (oTemp && oTemp != null) {
        oResp = oTemp;
    }
    if (oResp["htmOutput"] && "" != oResp["htmOutput"]) {
      document.getElementById("id_debug_window").style.display = "";
      document.getElementById("id_debug_text").innerHTML = nmAjaxFormatDebug(oResp["htmOutput"]) + document.getElementById("id_debug_text").innerHTML;
      nmCenterElement(document.getElementById("id_debug_window"));
    }
  }
  function nmAjaxFormatDebug(sDebugMsg)
  {
    return "<table class=\"scFormMessageTable\" style=\"margin: 1px; width: 100%\"><tr><td class=\"scFormMessageMessage\">" + nmAjaxSpecCharParser(sDebugMsg) + "</td></tr></table>";
  }
  function nmAjaxHideDebug()
  {
    if (document.getElementById("id_debug_window")) {
      document.getElementById("id_debug_window").style.display = "none";
      document.getElementById("id_debug_text").innerHTML = "";
    }
  }
  function nmCenterElement(oElem)
  {
    var $oElem    = $(oElem),
        $oWindow  = $(this),
        iElemTop  = Math.round(($oWindow.height() - $oElem.height()) / 2),
        iElemLeft = Math.round(($oWindow.width()  - $oElem.width())  / 2);
    $oElem.offset({top: iElemTop, left: iElemLeft});
  }
  function nmAjaxShowAutocomp(sFrameId)
  {
    if (document.getElementById("id_ac_frame_" + sFrameId)) {
      document.getElementById("id_ac_frame_" + sFrameId).style.display = "";
      document.getElementById("id_ac_" + sFrameId).focus();
    }
  }
  function nmAjaxHideAutocomp(sFrameId)
  {
    if (document.getElementById("id_ac_frame_" + sFrameId)) {
      document.getElementById("id_ac_frame_" + sFrameId).style.display = "none";
    }
  }
  function nmAjaxSpecCharParser(sParseString)
  {
    var ta = document.createElement("textarea");
    ta.innerHTML = sParseString.replace(/</g, "&lt;").replace(/>/g, "&gt;");
    return ta.value;
    var div = document.createElement('div');
    div.innerHTML = sParseString;
    return div.childNodes[0] ? div.childNodes[0].nodeValue : '';
  } 
  function nmAjaxProcOn()
  {
    if (document.getElementById("id_div_process")) {
      if ($ && $.blockUI) {
        $.blockUI({
          message: $("#id_div_process_block"),
          overlayCSS: { backgroundColor: sc_ajaxBg },
          css: {
            borderColor: sc_ajaxBordC,
            borderStyle: sc_ajaxBordS,
            borderWidth: sc_ajaxBordW
          }
        });
      }
      else {
        document.getElementById("id_div_process").style.display = "";
        document.getElementById("id_fatal_error").style.display = "none";
      }
    }
  }
  function nmAjaxProcOff()
  {
    if (document.getElementById("id_div_process")) {
      if ($ && $.unblockUI) {
        $.unblockUI();
      }
      else {
        document.getElementById("id_div_process").style.display = "none";
      }
    }
  }
