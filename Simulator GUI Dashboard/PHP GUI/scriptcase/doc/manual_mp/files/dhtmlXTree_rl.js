/*
Copyright Scand LLC http://www.scbr.com
To use this component please contact info@scbr.com to obtain license*/
 
 

 
dhtmlXTreeObject.prototype.enableRTL=function(mode){var z=convertStringToBoolean(mode);if (((z)&&(!this.rtlMode))||((!z)&&(this.rtlMode)))
 {this.rtlMode=z;this._switchToRTL(this.rtlMode);};};dhtmlXTreeObject.prototype._switchToRTL=function(mode) {if (mode){this.allTree.className=
 this._ltr_line=this.lineArray;this._ltr_min=this.minusArray;this._ltr_plus=this.plusArray;this.lineArray=new Array("line2_rtl.png","line3_rtl.png","line4_rtl.png","blank.png","blank.png","line1_rtl.png");this.minusArray=new Array("minus2_rtl.png","minus3_rtl.png","minus4_rtl.png","minus.png","minus5_rtl.png");this.plusArray=new Array("plus2_rtl.png","plus3_rtl.png","plus4_rtl.png","plus.png","plus5_rtl.png");this.allTree.className="containerTableStyleRTL";}else
 {this.allTree.className="containerTableStyle";this.lineArray=this._ltr_line;this.minusArray=this._ltr_min;this.plusArray=this._ltr_plus;};if (this.htmlNode.childsCount)this._redrawFrom(this,this.htmlNode);};
