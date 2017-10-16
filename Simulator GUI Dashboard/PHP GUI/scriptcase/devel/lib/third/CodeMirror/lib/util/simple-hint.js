(function() {
  CodeMirror.simpleHint = function(editor, getHints) {
    // We want a single cursor position.
    if (editor.somethingSelected()) return;
    var result = getHints(editor);
    if (!result || !result.list.length) return;
    var completions = result.list;
    function searchMacrosCode(str)
    {
		for(var i =0; i < macros_code.length; i++)
		{
			if(str == macros[i])
				return macros_code[i];
		}
		return false;
	}
    function insert(str) {
      var str2 = '';

		if(typeof(macros_code[str]) == 'undefined' )
		{
			var macros_code_searched = searchMacrosCode(str);
			if(macros_code_searched != false)
				str2 = macros_code_searched;
			else
				str2 = macros[str];
		}
		else
			str2 = macros_code[str];

		if( typeof(sel) != 'undefined' && sel.options[str].text != macros_code[str].substr(0, sel.options[str].text.length))
		{
			var mySelected = sel.options[str].text;
			var tam = mySelected.length;
			for(var i =0; i < macros_code.length; i++)
			{
				if( mySelected == macros_code[i].substr(0,tam) )
				{
					str2 = macros_code[i];
					break;
				}
			}
		}
      editor.replaceRange(str2, result.from, result.to);
    }
    // When there is only one completion, use it directly.
    if (completions.length == 1) {insert(completions[0]); return true;}

    // Build the select widget
    var complete = document.createElement("div");
    complete.className = "CodeMirror-completions";
    var sel = complete.appendChild(document.createElement("select"));
    // Opera doesn't move the selection when pressing up/down in a
    // multi-select, but it does properly support the size property on
    // single-selects, so no multi-select is necessary.
    if (!window.opera) sel.multiple = true;
    for (var i = 0; i < completions.length; ++i) {
      var opt = sel.appendChild(document.createElement("option"));
      opt.appendChild(document.createTextNode(completions[i]));
    }
    sel.firstChild.selected = true;
    sel.size = Math.min(10, completions.length);
    var pos = editor.cursorCoords();
    complete.style.left = pos.x + "px";
    complete.style.top = pos.yBot + "px";
    document.body.appendChild(complete);
    // If we're at the edge of the screen, then we want the menu to appear on the left of the cursor.
    var winW = window.innerWidth || Math.max(document.body.offsetWidth, document.documentElement.offsetWidth);
    if(winW - pos.x < sel.clientWidth)
      complete.style.left = (pos.x - sel.clientWidth) + "px";
    // Hack to hide the scrollbar.
    if (completions.length <= 10)
      complete.style.width = (sel.clientWidth - 1) + "px";

    var done = false;
    function close() {
      if (done) return;
      done = true;
      complete.parentNode.removeChild(complete);
    }
    function pick() {
      insert(sel.selectedIndex);
      close();
      setTimeout(function(){editor.focus();}, 50);
    }
    CodeMirror.connect(sel, "blur", close);
    CodeMirror.connect(sel, "keydown", function(event) {
      var code = event.keyCode;
      // Enter
      if (code == 13) {CodeMirror.e_stop(event); pick();}
      // Escape
      else if (code == 27) {CodeMirror.e_stop(event); close(); editor.focus();}
      else if (code != 38 && code != 40) {
        close(); editor.focus();
        // Pass the event to the CodeMirror instance so that it can handle things like backspace properly.
        editor.triggerOnKeyDown(event);
        setTimeout(function(){CodeMirror.simpleHint(editor, getHints);}, 50);
      }
    });
    CodeMirror.connect(sel, "dblclick", pick);

    sel.focus();
    // Opera sometimes ignores focusing a freshly created node
    if (window.opera) setTimeout(function(){if (!done) sel.focus();}, 100);
    return true;
  };
})();
