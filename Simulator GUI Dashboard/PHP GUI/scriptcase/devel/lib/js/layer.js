<!-- Copyright 2006 Bontrager Connection, LLC //-->

var cX = 0; 
var cY = 0;
var maxPass = 0;

function UpdateCursorPosition(e){ 
	cX = e.pageX; 
	cY = e.pageY;
}

function UpdateCursorPositionDocAll(e){ 
	cX = event.clientX; 
	cY = event.clientY;
	
	//alert(cX + ' - ' + cY);
}

//if(document.all) { 
//	document.onmousemove = UpdateCursorPositionDocAll; 
//}
//else { 
//	document.onmousemove = UpdateCursorPosition; 
//}

function AssignPosition(d, pre_x, pre_y) {
	newX = cX+20;
	newY = cY+10;
    
    if(document.body.offsetHeight && maxPass>0)
    {
    	if(document.body.offsetHeight-newY<maxPass)
    	{
    		newY = newY-maxPass;
    	}
    }  
    
    if (pre_x != null)
    {
    	newX = pre_x;
    }
    
    if (pre_y != null)
    {
    	newY = pre_y;
    }    
    
    d.style.left = newX + "px";
    d.style.top = newY + "px";
}

function HideContent(d) {
    if(d.length < 1) { 
    	return; 
    }
    document.getElementById(d).style.display = "none";
}

function ShowContent(d, pre_x, pre_y) {
    if(d.length < 1) { 
    	return; 
    }
    var dd = document.getElementById(d);
    AssignPosition(dd, pre_x, pre_y);
    dd.style.display = "";
}

function ReverseContentDisplay(d) {
    if(d.length < 1) { 
    	return; 
    }
    var dd = document.getElementById(d);
    AssignPosition(dd);
    if(dd.style.display == "none") { 
    	dd.style.display = ""; 
    }else { 
    	dd.style.display = "none"; 
    }
}