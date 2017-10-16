/*
Copyright Scand LLC http://www.scbr.com
This version of Software is free for using in non-commercial applications. For commercial use please contact info@scbr.com to obtain license
*/
document.write("<style>\
	.debugHeader{ cursor:pointer;  color:white; font-weight:bold; background-color:navy; text-align:center; -moz-user-select: none; }\
	.debugStringInput { border:1px solid silver; height:100%; width:100%; font-face-Tahoma; font-weight:bold; font-size:10pt; background-color:transparent;} \
	.debugTable{ border:1 solid blue; position:absolute;  background-color:#D4D0C8; font-weight:bold; width:600px; height:400px;  } \
	.debugButton{ width:100%;} .debugValue{background-color: #f5f5f5; padding-left:5px; font-weight:bold; cursor:pointer; }\
	.debugData{ background-color:#f0f8ff; }\
	.debugString{  position:absolute;   height:45px; width:300px; overflow:hidden; } \
</style>");


function dhtmlXDebugerObject(){
	this.debugWindowX=0;
	this.alfaDragger=0;
	this.debugWindowY=0;
	this._topDebugDiv="";
	
	if (window.dhtmlXDebuger) return window.dhtmlXDebuger;		
	
	this._createSelf();
	this.extensions=new Array;
	window.dhtmlXDebuger=this;
	return this;
}

dhtmlXDebugerObject.prototype._createSelf=function(){
		var div=document.createElement("div");
		div.className="debugString";
		div.innerHTML="<form style='padding:0 0 0 0;'><div  unselectable='yes' style='width:50%;' class='debugHeader'>Command string</div><div  style='width:100%;'><input id='debugCommandStringInput' class='debugStringInput'></div><input type='submit' style='width:0; visibility:hidden;'></form>"
		div.childNodes[0].onsubmit=this.parseDebugCommand;
		
		div.style.bottom=0;div.style.left=0;
		document.body.appendChild(div);
		new jsDragger(div,div.childNodes[0].childNodes[0]);
		div.childNodes[0].childNodes[0].ondblclick=this.debugShowHideSibling;
		div.onclick=this.bringToFront;	
		div.debuger=this;	
}


dhtmlXDebugerObject.prototype.debugShowHideSibling=function(){
		var a=this.nextSibling;
		if (a.tagName=="DIV") 
			if (a.style.display=="") { this.parentNode.style.height="20px"; a.style.display="none";} else { this.parentNode.style.height="400px"; a.style.display=""; }		
		else
			if (a.style.display=="") { this.parentNode.parentNode.style.height="20px"; a.style.display="none";} else { this.parentNode.parentNode.style.height="45px"; a.style.display=""; }
	};

dhtmlXDebugerObject.prototype.bringToFront=function(e,that){
		if (!that) that=this;
		that.style.zIndex="2";
		if((that.debuger._topDebugDiv)&&(that.debuger._topDebugDiv!=that)) that.debuger._topDebugDiv.style.zIndex="1";
		that.debuger._topDebugDiv=that;
	};
	
dhtmlXDebugerObject.prototype.parseDebugCommand=function(){
		var z=document.getElementById('debugCommandStringInput').value;
		var s=z.split(' ');
		var s_c="";
		var s_d="";
		for (var i=0; i<s.length; i++)
			{
				if ((s_c=="")&&(s[i]!=" ")) s_c=s[i];
				else
				if (((s_d=="")&&(s[i]!=" "))||(s_d!="")) s_d+=s[i];	
			};
			try{
		switch(s_c){
			case "dump": 
					if (s_d!="") eval("dhtmlXDebuger.jsDump("+s_d+",'"+s_d+"')");
					break;
			case "run": 
					if (s_d!="") eval(s_d);
					break;
			default:
					var f=false;
					if(dhtmlXDebuger.dhtmlXDebugerObjectEx1) f=dhtmlXDebuger.dhtmlXDebugerObjectEx1(s_c,s_d,dhtmlXDebuger); 
					if (!f) alert('Command not supported');
				 break;
		};
			} catch(e) { alert('incorrect command'); };
		return false;
	};
	
	
	dhtmlXDebugerObject.prototype.jsExtraDump=function(node){
		var e=node.onclick.arguments[0];
		if (!e) e=event;
		e.cancelBubble=true;
		dnode=node.parentNode.parentNode.parentNode.parentNode.parentNode;
		dhtmlXDebuger.jsDump(dnode.explainNode[node.innerHTML],dnode.explainName+"."+node.innerHTML);
	};
	dhtmlXDebugerObject.prototype.jsDebugRefresh=function(node)
	{
		dnode=node.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode;
		dhtmlXDebuger.jsDump(dnode.explainNode,dnode.explainName,dnode);
	};
	
	dhtmlXDebugerObject.prototype.jsCloseDumpWin=function(node){
		document.body.removeChild(node.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode);
		dhtmlXDebuger.debugWindowX-=15;
		dhtmlXDebuger.debugWindowY-=15;		
	};
	
	dhtmlXDebugerObject.prototype.jsUpdate=function(node){
		var e=node.onclick.arguments[0];
		if (!e) e=event;
		e.cancelBubble=true;
		dnode=node.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode;
		var z=dnode.explainName.toString().replace(/\.([0-9]+)\./gi,"[$1].");
		if (typeof(dnode.explainNode)!="function")
			eval(z+"='"+node.parentNode.parentNode.previousSibling.childNodes[0].childNodes[0].value+"'");
		else 
			eval(z+"="+node.parentNode.parentNode.previousSibling.childNodes[0].childNodes[0].value);
		document.body.removeChild(dnode);
		dhtmlXDebuger.debugWindowX-=15;
		dhtmlXDebuger.debugWindowY-=15;
	};

dhtmlXDebugerObject.prototype.jsDump=function(node,nodeName,dnode)
	{
		var a="<div style='width:100%; height:20px; cursor:pointer;'><table width='100%' cellpadding='0' cellspacing='0'><tr><td style='cursor:pointer; color:white; font-weight:bold;background-color:navy; text-align:center;'>Debug info : "+nodeName+"</td><td align='right' style='color:white; font-weight:bold;background-color:navy;'><input type='button' value='R' onclick='dhtmlXDebuger.jsDebugRefresh(this); return false; '><input type='button' value='X' onclick='dhtmlXDebuger.jsCloseDumpWin(this); return false; '></td></tr></table></div><div style='overflow:scroll; width:600px; height:380px;'><table width='100%' bgcolor='#ffffff' cellpadding=1 cellspacing=1>"
		if (typeof(node)=="object")
		{
		for (params in node) {
			a=a+"<tr><td class='debugValue' onclick='dhtmlXDebuger.jsExtraDump(this); return false;'>"+params+"</td><td class='debugData'><div style='height:20px; overflow:hidden;'>"+node[params]+"</div></td></tr>";
			}
		}
		else 
		{
		a=a+"<tr><td width='100%' height='330px'><textarea style='width:100%; height:100%;'>"+node+"</textarea></td></tr>";
		a=a+"<tr><td width='100%' align='right'><input type='button' value='Update' onclick='dhtmlXDebuger.jsUpdate(this)'></td></tr>";		
		}
		a+="</table></div>";
		if (dnode) var div=dnode;
		else {
		var div=document.createElement("div");
		div.className="debugTable";
		div.style.top=this.debugWindowY; this.debugWindowY+=15;  
		div.style.right=this.debugWindowX;	this.debugWindowX+=15;	
		div.onclick=this.bringToFront;
		div.debuger=this;
		document.body.appendChild(div);
		div.explainNode=node;
		div.explainName=nodeName;		
			};
		div.innerHTML=a;
		if (!dnode){
		new jsDragger(div,div.childNodes[0]);
		this.bringToFront(0,div);
		div.childNodes[0].ondblclick=this.debugShowHideSibling;	
		};

	};


/*	
<!--- +------------------------------------------------------------------------------------- --->
<!--- [  system code  ]--->
<!--- +------------------------------------------------------------------------------------- --->
*/
function jsDragger(dragNode, pointerZone){
	this.old1f="";
	this.old2f="";	
	this.x=0;
	this.y=0;
	this.x2=0;
	this.y2=0;	
	this.mx=0;
	this.my=0;	
	this.callerFunction=function(funcObject,dhtmlObject){
		this.handler=function(e){
			if (!e) e=event;
			funcObject(e,dhtmlObject);
			return true;
		}
		return this.handler;
	}
	this.startDrag=function(e) {
			if (!e) e=event;
			that=this.dragger;
				that.x=parseInt(dragNode.style.left);
				that.y=parseInt(dragNode.style.top);
				that.x2=parseInt(dragNode.style.right);
				that.y2=parseInt(dragNode.style.bottom);
				that.mx=e.clientX;
				that.my=e.clientY;

			dragNode.style.position="absolute";		
			that.old1f=	document.onmousemove;
			that.old2f=	document.onmouseup;	
			document.onmousemove=new that.callerFunction(that.moveDrag,that);
			document.onmouseup=new that.callerFunction(that.stopDrag,that);	
		};
	this.stopDrag=function(e,that){
			if (that.old1f) document.onmousemove=that.old1f; else document.onmousemove=null;
			if (that.old2f) document.onmouseup=that.old2f; else document.onmouseup=null;			
			return true;
		};
	this.moveDrag=function(e,that){
			if (!e) e=event;
			if ((that.x)||(that.x==0)) dragNode.style.left=that.x*1+e.clientX*1-that.mx*1;	
			else 	dragNode.style.right=that.x2*1-e.clientX*1+that.mx*1;
			if ((that.y)||(that.y==0))  dragNode.style.top=that.y*1+e.clientY*1-that.my*1;	
			else 	dragNode.style.bottom=that.y2*1-e.clientY*1+that.my*1;	
			return true;
		};
		
		pointerZone.onmousedown=this.startDrag;
		pointerZone.dragger=this;
		return this;
	};
	
	
dxd=function(a,b){
	window.dhtmlXDebuger.jsDump(a,b);
}
