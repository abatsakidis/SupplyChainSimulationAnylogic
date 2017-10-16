var EA_keys = {8:"Retour arriere",9:"Tabulation",12:"Milieu (pave numerique)",13:"Entrer",16:"Shift",17:"Ctrl",18:"Alt",19:"Pause",20:"Verr Maj",27:"Esc",32:"Space",33:"Page up",34:"Page down",35:"End",36:"Begin",37:"Left",38:"Up",39:"Right",40:"Down",44:"Impr ecran",45:"Inser",46:"Suppr",91:"Menu Demarrer Windows / touche pomme Mac",92:"Menu Demarrer Windows",93:"Menu contextuel Windows",112:"F1",113:"F2",114:"F3",115:"F4",116:"F5",117:"F6",118:"F7",119:"F8",120:"F9",121:"F10",122:"F11",123:"F12",144:"Verr Num",145:"Arret defil"};



function keyDown(e){
	
	// ----------------------------------scriptcase-------------------------------------------------------------------------------------------------
	if (!editArea.isIE && parent.nm_form_modified) parent.nm_form_modified();
	// ----------------------------------scriptcase-------------------------------------------------------------------------------------------------
	
	if(!e){	// if IE
		e=event;
	}
	
	// send the event to the plugins
	for(var i in editArea.plugins){
		if(typeof(editArea.plugins[i].onkeydown)=="function"){
			if(editArea.plugins[i].onkeydown(e)===false){ // stop propaging
				if(editArea.isIE)
					e.keyCode=0;
				return false;
			}
		}
	}

	var target_id=(e.target || e.srcElement).id;
	var use=false;
	if (EA_keys[e.keyCode])
		letter=EA_keys[e.keyCode];
	else
		letter=String.fromCharCode(e.keyCode);
	
	var low_letter= letter.toLowerCase();
			
	if(letter=="Page up" && !AltPressed(e) && !editArea.isOpera){
		editArea.execCommand("scroll_page", {"dir": "up", "shift": ShiftPressed(e)});
		use=true;
	}else if(letter=="Page down" && !AltPressed(e) && !editArea.isOpera){
		editArea.execCommand("scroll_page", {"dir": "down", "shift": ShiftPressed(e)});
		use=true;
	}else if(editArea.is_editable==false){
		// do nothing but also do nothing else (allow to navigate with page up and page down)
		return true;
	}else if(letter=="Tabulation" && target_id=="textarea" && !CtrlPressed(e) && !AltPressed(e)){	
		if(ShiftPressed(e))
			editArea.execCommand("invert_tab_selection");
		else
			editArea.execCommand("tab_selection");
		
		use=true;
		if(editArea.isOpera || (editArea.isFirefox && editArea.isMac) )	// opera && firefox mac can't cancel tabulation events...
			setTimeout("editArea.execCommand('focus');", 1);
	}else if(letter=="Entrer" && target_id=="textarea"){
		// ----------------------------------scriptcase-------------------------------------------------------------------------------------------------		
		  if (IsMacroComplete()) {
		   use=true; InsertMacroTextarea(); 
		  } else { 
		   if(editArea.press_enter()) 
			 use=true; 
		  } 		
		// ----------------------------------scriptcase-------------------------------------------------------------------------------------------------	
	}else if(letter=="Entrer" && target_id=="area_search"){
		editArea.execCommand("area_search");
		use=true;
	}else  if(letter=="Esc"){
		// ----------------------------------scriptcase-------------------------------------------------------------------------------------------------	
		 document.getElementById('div_macro_complete').style.display = 'none';
		// ----------------------------------scriptcase-------------------------------------------------------------------------------------------------							
		editArea.execCommand("close_all_inline_popup", e);
		use=true;
		
	// ----------------------------------scriptcase-------------------------------------------------------------------------------------------------	
	}else if(low_letter=="up"){
		if (IsMacroComplete()) { 
			if (document.getElementById("sel_macro_complete").selectedIndex > 0) 
				document.getElementById("sel_macro_complete").selectedIndex = document.getElementById("sel_macro_complete").selectedIndex - 1; 
			else 
				document.getElementById("sel_macro_complete").selectedIndex = (document.getElementById("sel_macro_complete").options.length - 1);			
			use=true;			
		}
	}
	else if(low_letter=="down"){
		if (IsMacroComplete()) { 
			if (document.getElementById("sel_macro_complete").selectedIndex < (document.getElementById("sel_macro_complete").options.length - 1)) 
				document.getElementById("sel_macro_complete").selectedIndex = document.getElementById("sel_macro_complete").selectedIndex + 1; 
			else 
				document.getElementById("sel_macro_complete").selectedIndex = 0;			
			use=true;			
		}			
	}else if(low_letter == "left" || low_letter=="right"){	
		if (IsMacroComplete()) {
			document.getElementById("div_macro_complete").style.display = "none";
		} 
	}else if(low_letter=="retour arriere" && IsMacroComplete()){	
		if (textarea.selectionStart <= document.getElementById("n_chr_macro_complete").value) {
			document.getElementById("div_macro_complete").style.display = "none";} 
		else { 			
			document.getElementById("n_col_macro_complete").value = parseInt(document.getElementById("n_col_macro_complete").value) - 1;
		}		
	// ----------------------------------scriptcase-------------------------------------------------------------------------------------------------	
	}else if(CtrlPressed(e) && !AltPressed(e) && !ShiftPressed(e)){
		switch(low_letter){
			case "f":				
				editArea.execCommand("area_search");
				use=true;
				break;
			case "r":
				editArea.execCommand("area_replace");
				use=true;
				break;
			case "q":
				editArea.execCommand("close_all_inline_popup", e);
				use=true;
				break;
			case "h":
				editArea.execCommand("change_highlight");			
				use=true;
				break;
			case "g":
				setTimeout("editArea.execCommand('go_to_line');", 5);	// the prompt stop the return false otherwise
				use=true;
				break;
			case "e":
				editArea.execCommand("show_help");
				use=true;
				break;
			case "z":
				use=true;
				editArea.execCommand("undo");
				break;
			case "y":
				use=true;
				editArea.execCommand("redo");
				break;
		    // ----------------------------------scriptcase-------------------------------------------------------------------------------------------------	
			case "espace": 
			case "space":
				 ShowMacroComplete(-1);						
				 use=true;
				break;					
			// ----------------------------------scriptcase-------------------------------------------------------------------------------------------------												
			default:
				break;			
		}		
	}		
    // ----------------------------------scriptcase-------------------------------------------------------------------------------------------------		
	else if(low_letter=="espace" || low_letter== "space"){	
	     if (IsMacroComplete()) {
	     	document.getElementById("div_macro_complete").style.display = "none";
	     } 
	}		
	// ----------------------------------scriptcase-------------------------------------------------------------------------------------------------
	
	// check to disable the redo possibility if the textarea content change
	if(editArea.next.length > 0){
		setTimeout("editArea.check_redo();", 10);
	}
	
	setTimeout("editArea.check_file_changes();", 10);
	
	
	if(use){
		// in case of a control that sould'nt be used by IE but that is used => THROW a javascript error that will stop key action
		if(editArea.isIE)
			e.keyCode=0;
		return false;
	}
	//alert("Test: "+ letter + " ("+e.keyCode+") ALT: "+ AltPressed(e) + " CTRL "+ CtrlPressed(e) + " SHIFT "+ ShiftPressed(e));
	
	// ----------------------------------scriptcase-------------------------------------------------------------------------------------------------
    SelIndexMacro(low_letter, e.keyCode); 
    CallShowMacroComplete(low_letter, e.keyCode); 	
	// ----------------------------------scriptcase-------------------------------------------------------------------------------------------------
	
	return true;
	
};


// ----------------------------------scriptcase-------------------------------------------------------------------------------------------------
    function CallShowMacroComplete(par_low_letter, e_keycode){  	
	  if (!(IsMacroComplete() || par_low_letter.length > 1 || !document.getElementById('sel_macro_complete'))) { 
	   sel_macro = document.getElementById('sel_macro_complete'); 
	   for(i_macro = 0; i_macro < sel_macro.options.length; i_macro++) { 
	     if (par_low_letter ==  sel_macro.options[i_macro].text.substr(0, 1)) {
	        ShowMacroCompleteDig(i_macro, false); break; 
	     }	
	   }	
	  }	
	  if (document.getElementById('sel_macro_complete') && e_keycode != 16) {
	   document.getElementById('s_dig_macro_complete').value += (e_keycode == 189 ? '_' : par_low_letter);	
	   if (document.getElementById('s_dig_macro_complete').value == 'sc_') 	
	   {  	
	     document.getElementById('s_dig_macro_complete').value = ''; 
	     ShowMacroCompleteDig(-1, true); 
	   }  	
	  } 	
	};  
	function ShowMacroCompleteDig(index_macro, vis){
	 if(NavMacroCompleteOk() && document.getElementById('n_row_macro_complete')) {				
	 if(vis) {				
       document.getElementById('div_macro_complete').style.left = document.getElementById('n_lft_macro_complete').value;
	   document.getElementById('div_macro_complete').style.top = document.getElementById('n_top_macro_complete').value;		
	 }else{
       var caretPos = document.selection.createRange(); 	
       document.getElementById('div_macro_complete').style.left = -2000;
	   document.getElementById('div_macro_complete').style.top  = -2000;	
	   document.getElementById('n_lft_macro_complete').value = caretPos.boundingLeft;
	   document.getElementById('n_top_macro_complete').value = caretPos.boundingTop + 18;
	   document.getElementById('sel_macro_complete').selectedIndex = index_macro; 	
	   document.getElementById('n_row_macro_complete').value = document.getElementById("linePos").innerHTML;
	   document.getElementById('n_col_macro_complete').value = document.getElementById("currPos").innerHTML;
	   document.getElementById('n_chr_macro_complete').value = textarea.selectionStart;
	   document.getElementById('div_macro_complete').style.display = '';	
	   document.getElementById('s_dig_macro_complete').value = ''; 	
	 }
	}	
	}; 
	function ShowMacroComplete(index_macro){
	 if(NavMacroCompleteOk() && document.getElementById('n_row_macro_complete')) {				
       var caretPos = document.selection.createRange(); 	
       document.getElementById('div_macro_complete').style.left = caretPos.boundingLeft;
	   document.getElementById('div_macro_complete').style.top  = caretPos.boundingTop + 18;;	
	   document.getElementById('sel_macro_complete').selectedIndex = index_macro; 	
	   document.getElementById('n_row_macro_complete').value = document.getElementById("linePos").innerHTML;
	   document.getElementById('n_col_macro_complete').value = document.getElementById("currPos").innerHTML;
	   document.getElementById('n_chr_macro_complete').value = textarea.selectionStart;
	   document.getElementById('div_macro_complete').style.display = '';		
	}	
	}; 	
	function SelIndexMacro(par_low_letter, e_keycode){
	  if (!IsMacroComplete()) return;	
	  
	  sel_macro = document.getElementById('sel_macro_complete'); 	
	  chr_ini   = document.getElementById('n_chr_macro_complete').value; 
	  if (par_low_letter == 'retour arriere') { 
	    dig_chr   = textarea.value.substr(chr_ini, (parseInt(textarea.selectionStart) - chr_ini -1));	
	  } else if (par_low_letter.length > 1) { 
	    return; 	
	  }else { 	
	    if (e_keycode == 189) par_low_letter = '_'; 
	    dig_chr   = textarea.value.substr(chr_ini, (parseInt(textarea.selectionStart) - chr_ini)) + par_low_letter; 	
	  } 			
	  b_achou = false; 	
	  for(i_macro = 0; i_macro < sel_macro.options.length; i_macro++) { 
	    if (dig_chr == sel_macro.options[i_macro].text.substr(0, dig_chr.length)) {
	       sel_macro.selectedIndex = i_macro; b_achou = true; break; 
	    }	
	  }
	 if (!b_achou) sel_macro.selectedIndex = -1; 	
	};
	function InsertMacroTextarea(){
	 sel_macro = document.getElementById('sel_macro_complete'); 
	 if (sel_macro.selectedIndex > -1) {
	  sel_macro = document.getElementById('sel_macro_complete'); 	
	  chr_ini   = document.getElementById('n_chr_macro_complete').value; 
	  dig_chr   = textarea.value.substr(chr_ini, (parseInt(textarea.selectionStart) - chr_ini));	
	  macro = sel_macro.options[sel_macro.selectedIndex].value; 
	  parent.editAreaLoader.setSelectionRange('Formula_id', chr_ini, parseInt(chr_ini) + dig_chr.length); 
	  parent.editAreaLoader.setSelectedText('Formula_id', macro); 	
	 };
	 document.getElementById('div_macro_complete').style.display = 'none';
	};
	function IsMacroComplete(){	
	 return document.getElementById('div_macro_complete').style.display == '';
	};
	
	function NavMacroCompleteOk()
	{
		return editArea.isIE;
	}
// ----------------------------------scriptcase-------------------------------------------------------------------------------------------------


// return true if Alt key is pressed
function AltPressed(e) {
	if (window.event) {
		return (window.event.altKey);
	} else {
		if(e.modifiers)
			return (e.altKey || (e.modifiers % 2));
		else
			return e.altKey;
	}
};

// return true if Ctrl key is pressed
function CtrlPressed(e) {
	if (window.event) {
		return (window.event.ctrlKey);
	} else {
		return (e.ctrlKey || (e.modifiers==2) || (e.modifiers==3) || (e.modifiers>5));
	}
};

// return true if Shift key is pressed
function ShiftPressed(e) {
	if (window.event) {
		return (window.event.shiftKey);
	} else {
		return (e.shiftKey || (e.modifiers>3));
	}
};
