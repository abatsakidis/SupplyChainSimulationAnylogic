/*
Copyright DHTMLX LTD. http://www.dhtmlx.com
This version of Software is free for using in non-commercial applications. For commercial use please contact sales@dhtmlx.com to obtain license
*/
		/**
          *     @desc: context menu object
          *     @type: public
		  *     @param: width - menu width
		  *     @param: height - menu height
		  *     @param: gfxPath - path to gfx (must be specified in https mode)
          *     @param: httpsdummy - dummy html page, which will be used for invisible iframes (necessary only for https mode)
	      *     @topic: 0
          */
function dhtmlXContextMenuObject(width,height,gfxPath,httpsdummy){
	this.menu=new dhtmlXMenuBarObject(document.body,width,height,"",1,gfxPath,httpsdummy);
	this.menu.setMenuMode("popup");
	this.menu.hideBar();
	this.menu.contextMenu=this;
	this.menu.enableWindowOpenMode(false);
	this.menu.setOnClickHandler(this._innerOnClick);
    this.aframes=new Array();
    this.registerFrame(window);

    return this;
};

dhtmlXContextMenuObject.prototype.registerFrame=function(awin){
    this.aframes[this.aframes.length]=awin;
}



		/**
          *     @desc: set onClick context menu handler
          *     @type: public
		  *     @param: func - user defined function
	      *     @topic: 0
          */
dhtmlXContextMenuObject.prototype.setContextMenuHandler=function(func){
  if (typeof(func)=="function") this.onClickHandler=func; else this.onClickHandler=eval(func);
}
		/**
          *     @desc: open menu at specified position
          *     @type: public
		  *     @param: x - x position
		  *     @param: y - y position		  
		  *     @param: id - context id
		  *     @param: smartPosition - enable/disable correction of position
	      *     @topic: 0
          */
dhtmlXContextMenuObject.prototype.openAt=function(x,y,id,smartPosition){
    this.espc=convertStringToBoolean(smartPosition);
	var f=new Object;
	f.button=2;
	f.clientX=x;
	f.clientY=y;
  	var start=new Object;
	start.contextMenuId=id;
	start.contextMenu=this;
	start.a=this._contextStart;
  	start.a(document.body,f);
    this.espc=null;
}


		/**
          *     @desc: disable/enable context menu
          *     @type: public
		  *     @param: mode  - true/false as disable/enable
	      *     @topic: 0
          */
dhtmlXContextMenuObject.prototype.disableMenu=function(mode){
    this._dsbd=convertStringToBoolean(mode);
  }
  
		/**
          *     @desc: set onShow context menu handler
          *     @type: public
		  *     @param: func - user defined function
	      *     @topic: 0
          */
dhtmlXContextMenuObject.prototype.setOnShowMenuHandler=function(func){
  if (typeof(func)=="function") this.onShowHandler=func; else this.onShowHandler=eval(func);
  }


/**
*     @desc: set zIndex value for menu object
*     @param: left - (integer) left position shift
*     @param: top - (integer) top position shift
*     @type: public
*     @topic: 0
*/
dhtmlXContextMenuObject.prototype.setContextMenuPosition=function(left,top){
	this._msTop=parseInt(top);
	this._msLeft=parseInt(left);
}

/**
*     @desc: default menu onclick precessor
*     @type: private
*     @param: id - clicked node id
*     @topic: 0
*/
dhtmlXContextMenuObject.prototype._innerOnClick=function(id){
	//debugger;
	var that=document.body.contextMenu;
	if (that.contextZone.ownerDocument){
		if (that.contextZone.ownerDocument.body.onclick) that.contextZone.ownerDocument.body.onclick();
	} else if (document.body.onclick) document.body.onclick();
	if (that.onClickHandler) return that.onClickHandler(id,that.zoneId,that.contextZone);
	return true;
}

		/**
          *     @desc: set context zones
          *     @type: public
		  *     @param: htmlObject - id of html tag or html object
		  *     @param: zoneId - id of zone
	      *     @topic: 0  
          */
dhtmlXContextMenuObject.prototype.setContextZone=function(htmlObject,zoneId){
	if (typeof(htmlObject)!="object") 
		htmlObject=document.getElementById(htmlObject);

    if (!htmlObject.contextMenu)
    	htmlObject.contextOnclick=htmlObject.onmouseup;
	htmlObject.selfobj = this;//nb
	htmlObject[_isMacOS?"oncontextmenu":"onmouseup"]= function(e){ this.selfobj._contextStart(this,e); };//nb
//	htmlObject.onmousedown= this._contextStart;
	htmlObject.contextMenu=this;
	htmlObject.contextMenuId=zoneId;
}
		/**
          *     @desc: open context menu
          *     @type: private
		  *     @param: e - event object
	      *     @topic: 0
          */
dhtmlXContextMenuObject.prototype._contextStart=function(obj,e){
   if ((_isIE)&&(window.event))
        event.srcElement.oncontextmenu = function(){ event.cancelBubble=true; return false; };
    if (e && e.preventDefault) e.preventDefault();
    

	if(!this.contextMenu)//nb
		this.contextMenu = this;
	var win = obj.ownerDocument?obj.ownerDocument.parentWindow:window;
	if(!win){
		win = obj.ownerDocument.defaultView;
	}

	var a=this.contextMenu.menu.topNod;
	a.style.position="absolute";
	
	if (!e){
		e=win.event;
	}
   	if (document.body.onclick) document.body.onclick();

	if ((!_isMacOS)&&((!e)||(e.button!=2)))
	{
		if (obj.contextOnclick) obj.contextOnclick();
		return true;
	}
     	else {
        if (this.contextMenu._dsbd) return true;
		if (this.contextMenu.onShowHandler){
			var z=this.contextMenu.onShowHandler(obj.contextMenuId);
			if ((typeof(z)=="boolean")&&(!z)) return;
		}

		this.contextMenu.menu.showBar();
	}

	var winScreenTop = window.screenTop;
	if ((!winScreenTop)&&(winScreenTop!=0)){
		winScreenTop = window.screenY+window.outerHeight-window.innerHeight;//-(window.statusbar.visible?20:0);
		//nb
		//winScreenTop = top.screenY+top.outerHeight-top.innerHeight;//-(window.statusbar.visible?20:0);
		
		//alert(window.screenY+"+"+window.outerHeight+"-"+window.innerHeight)
	}
	var winScreenLeft = window.screenLeft;
	if((!winScreenLeft)&&(winScreenLeft!=0)){
		winScreenLeft = window.screenX+window.outerWidth-window.innerWidth-4;
		//nb
		//alert(window.pageXOffset)
		//winScreenLeft = top.screenX+top.outerWidth-top.innerWidth-4;
	}
	var dEl0=window.document.documentElement;
	var dEl1=window.document.body;
	if(e.screenY-winScreenTop+a.offsetHeight-(dEl0.scrollTop||dEl1.scrollTop) > (dEl0.clientHeight||dEl1.clientHeight)){//-e.offsetY
		var verCor = a.offsetHeight
	}else
		var verCor = ((this.contextMenu._msTop*(-1))||0);

	var corrector = new Array((dEl0.scrollLeft||dEl1.scrollLeft)+(this.contextMenu._msLeft||0),verCor-(dEl0.scrollTop||dEl1.scrollTop));
	

        //	a.style.left=e.clientX*1+document.body.scrollLeft;
        //	a.style.top=e.clientY*1+document.body.scrollTop;
        //  this.contextMenu.menu.showBar();
    	//  alert(a.style.left);



    if ((!e.screenY)&&(e.clientX))
    {
	a.style.top = e.clientY+"px";
	a.style.left = e.clientX+"px";
    }   else
    {
	a.style.top = e.screenY-winScreenTop-corrector[1]+"px";//-e.offsetY
	a.style.left = e.screenX-winScreenLeft+corrector[0]+"px";//-e.offsetX
    }

	//nb: (to work correctly in frames in mozilla)
	if(!_isIE){
		a.style.top = e.clientY-corrector[1]+"px";
		a.style.left = e.clientX+corrector[0]+"px";
	}
	this.contextMenu.correctMenuPosition(a);

    if (a.ieFix){
	a.ieFix.style.top=a.style.top;
	a.ieFix.style.left=a.style.left;
    }

	win.document.body.oncontextmenu=new Function("document.body.oncontextmenu=new Function('if (document.body.onclick) document.body.onclick(); return false;'); return false; ");

    for (var i=0; i<this.contextMenu.aframes.length; i++){
        if (this.contextMenu.aframes[i].document)
            this.contextMenu.aframes[i].document.body.selfobj = this;
	        this.contextMenu.aframes[i].document.body.onclick=function(e){this.selfobj.contextMenu._contextEnd(e)};
        }

	document.body.contextMenu=this.contextMenu;
	this.contextMenu.contextZone=obj;
	this.contextMenu.zoneId=obj.contextMenuId;//this.contextMenu.zoneId=this.contextMenuId;
	return false;
}

/**  
*     @desc: correct context menu position
*     @type: private
*     @param: panel - html menu object
*     @param: panel - recurse flag
*     @topic: 0  
*/
dhtmlXContextMenuObject.prototype.correctMenuPosition=function(panel,mode){ 
			var xs=document.body.offsetWidth+document.body.scrollLeft;
			var ys=document.body.offsetHeight-15+document.body.scrollTop;
			//now check is panel real visible
			if ((panel.offsetWidth+parseInt(panel.style.left))>xs)
			{
					var z=parseInt(panel.style.left)-panel.offsetWidth;
					if ((z<0)||(this.espc))
						z=xs-panel.offsetWidth;
					if (z<0) z=0;
					panel.style.left=z+"px";
					if (panel.ieFix) panel.ieFix.style.left=z+"px";
			}

			if ((panel.offsetHeight+parseInt(panel.style.top))>ys)
			{
					var z=parseInt(panel.style.top) - panel.offsetHeight;
					if ((z<0)||(this.espc))
    					z=ys-panel.offsetHeight;
					if (z<0) z=0;
					panel.style.top=z+"px";
					if (panel.ieFix) panel.ieFix.style.top=z+"px";
			}
			
			if (!mode) this.correctMenuPosition(panel,1);
		}
/**  
          *     @desc: correct context menu position
          *     @type: public
	      *     @topic: 0
          */		
dhtmlXMenuBarObject.prototype.correctMenuPosition=dhtmlXContextMenuObject.prototype.correctMenuPosition;

		
		/**  
          *     @desc: close context menu
          *     @type: private
		  *     @param: e - event object
	      *     @topic: 0  
          */
dhtmlXContextMenuObject.prototype._contextEnd=function(e){
	var menu=this.menu;
	menu._closePanel(menu);
	menu.lastOpenedPanel="";
	menu.lastSelectedItem=0;
	menu.hideBar();
    for (var i=0; i<this.aframes.length; i++)
       if (this.aframes[i].document){
	        this.aframes[i].document.body.onclick=null;
	        this.aframes[i].document.body.oncontextmenu=null;
            }
	return false;	
}



