// Title: Tigra Calculator
// URL: http://www.softcomplex.com/products/tigra_calculator/
// Version: 1.0
// Date: 04/14/2003 (mm/dd/yyyy)
// Note: Permission given to use this script in ANY kind of applications if
//    header lines are left unchanged.
// Note: Script consists of two files: calculator.js and calculator.html

var TCR = new Tcalculator();

function Tcalculator() {
	this.oper_old =
	this.oper_old_old =
	this.slag_1 =
	this.slag_2 =
	this.slag_1_old =
	this.out_val =
	this.p_out = '';
	this.t_load = false;
    this.load_value = '';
    this.sep_decimal = '';
    this.sep_milhar = '';
    this.precision = '';
    this.monetary = '';
    this.monetary_pos = '';
    this.thousands_format = 1;
    this.TCRformatCalc = TCRformatCalc;
    this.TCRformatForm = TCRformatForm;
	this.TCRisNumber = TCRisNumber;
	this.TCRisPoint = TCRisPoint;
	this.TCRPopup = TCRPopup;
	this.TCRrezult = TCRrezult;
	this.TCRmntr = TCRmntr;
	this.TCRcleanValue = TCRcleanValue;
	// preloading images
	var a_img = [], i, j;
	for (i = 0; i < 19; i ++) {
		a_img[i] = [];
		for (j = 0; j < 3; j ++) {
			a_img[i][j] = new Image();
			a_img[i][j].src = 'img/' + i + '_' + j + '.gif'
		}
	}
}

function TCRisPoint(tmp,n) {
	var flag = 0;
	if (tmp == '.') {
		var tmp2 = window.win_ch.document.forms[0].elements[0].value;
		for (var i = 0; i < tmp2.length; i ++) {
			thischar = tmp2.substring(i,i + 1);
			if (thischar == '.') flag = 1;
		}
	}
	if (flag == 0) eval('this.slag_' + n + '+=tmp;');
}

function TCRisNumber(data){
	var numStr = "0123456789", thischar, counter = p_counter = err_cod = popr = 0, len=data.length, i;
	for (i = 0; i < len; i ++) {
		thischar = data.substring(i,i + 1);
		if (numStr.indexOf(thischar)!= -1) counter ++;
		if (thischar == '-'){
			if (i != 0) {err_cod = 1; break;}
			else popr ++;
		}
		if (thischar == '.') {
			if ((i == 0 || i == len - 1) || (i == 1 && data.substring(i - 1, i) == '-')) {
				err_cod = 1;
				break;
			}
			else {
				p_counter ++;
				if (p_counter > 1) {
					err_cod = 1;
					break;
				}
				else popr ++;
			}
		}
	}
	if (err_cod != 1 && counter == len - popr) return true;
	else return false;
}

function TCRrezult (slag_1, slag_2, oper) {
	slag_1 = parseFloat(slag_1);
	slag_2 = parseFloat(slag_2);
	eval('out=(' + slag_1 + ')' + oper + '(' + slag_2 + ')');
	return out;
}

function TCRPopup(obj_control, url_calc, par_milhar, par_milhar_fmt, par_decimal, par_precision, par_monetary) {
    if (par_milhar) this.sep_milhar = par_milhar;
    if (par_milhar_fmt) this.thousands_format = par_milhar_fmt;
    if (par_decimal) this.sep_decimal = par_decimal;
    if (par_precision) this.precision = par_precision;
    if (par_monetary) this.monetary = par_monetary;
	var w = 186, h = 122;
	var ua = navigator.userAgent.toLowerCase();
	var v = navigator.appVersion.substring(0,1);
	var n = navigator.appName.toLowerCase();
	if (!obj_control)
		return alert("Form element specified can't be found in the document.");
	this.control_obj = obj_control;
    this.load_value = this.TCRformatCalc(this.control_obj.value);
    if ('' != par_monetary) this.TCRcleanValue();
	if (!this.TCRisNumber(this.load_value)) alert('wrong data');
	else {
		if (ua.indexOf("opera") > 0) {w = 176; h = 135;}
		else if (ua.indexOf("chrome") > 0) {w = 206; h = 128;}
		else if (ua.indexOf("netscape") < 0 && ua.indexOf("msie") < 0
			&& v >= 5 && ua.indexOf("mac") > 0) {
			w = 212; h = 122;
		}
		else if (n == 'netscape') {
			if (v == 4) { w = 216; h = 128;}
			if (v >= 5) { w = 185; h = 126;}
		}

		if (screen) {
			n_left = (screen.width - w) >> 1;
			n_top = (screen.height - h) >> 1;
		}
		tb_show('', url_calc + '?TB_iframe=true&height=' + h + '&width=' + w + '&modal=true', '');
		win_ch = document.getElementById('TB_iframeContent').contentWindow;
		/*win_ch = window.open(url_calc,"win_ch", "width=" + w + ",height=" + h + ",help=no,status=no,scrollbars=no,resizable=no,top=" + n_top + ",left=" + n_left + ",dependent=yes,alwaysRaised=yes", true);
		win_ch.focus();*/
	}
}

function TCRmntr(num) {
	var flag = 0;
	if (this.t_load) tmp = window.win_ch.document.forms[0].elements[0].value;
	if (num == 'C') {
		this.out_val = '0';
		this.oper_old = this.oper_old_old = this.slag_1 = this.slag_2 = '';
	}
	else if (tmp != 'NaN' && tmp != 'Infinity')
		switch (num) {
			case '-':
			case '+':
			case '/':
			case '*':
				if (this.slag_1 != '' && this.slag_2 != '') {
					this.out_val = this.slag_1 = this.TCRrezult(this.slag_1, this.slag_2, this.oper_old);
					this.slag_2 = '';
				}
				else if(this.slag_1 == '' && this.slag_2 == '') this.out_val = this.slag_1 = tmp;
				this.oper_old = num;
				break;
			case 'sqr':
				this.slag_1 = tmp;
				this.slag_2 = '';
				this.slag_1 = parseFloat(this.slag_1);
				this.slag_1 = Math.sqrt(this.slag_1);
				this.oper_old =this.oper_old_old ='';
				this.out_val = this.slag_1;
				//this.control_obj.value = this.TCRformatForm(this.out_val);
				var val_antigo = this.control_obj.value;
				this.control_obj.value = this.TCRformatForm(this.out_val);
				if (this.control_obj.value != val_antigo && this.control_obj.onchange && '' != this.control_obj.onchange) {
				    this.control_obj.onchange();
				}
				break;
			case '=':
				if (this.oper_old != '') {
					if (this.slag_1 != '' && this.slag_2 != '') {
						this.out_val = this.TCRrezult(this.slag_1, this.slag_2, this.oper_old);
						this.slag_1 = this.slag_1_old = this.slag_2;
					}
					else if (this.slag_1 != '' && this.slag_2 == '') {
						this.out_val = this.TCRrezult(this.slag_1,this.slag_1,this.oper_old);
						this.slag_1_old = this.slag_1;
					}
					this.oper_old_old = this.oper_old;
					this.slag_2 = '';
					this.slag_1 = '';
					this.oper_old = '';
				}
				else if(this.oper_old_old != ''){
					this.slag_2_old = tmp;
					this.out_val = this.TCRrezult(this.slag_2_old, this.slag_1_old, this.oper_old_old);
				}
				else if (this.slag_1 == '' && this.slag_2 == '') {
				    if (tmp != '') this.out_val = tmp;
				    else this.out_val = '0';
				}
				else this.out_val = this.slag_1;
				//this.control_obj.value = this.TCRformatForm(this.out_val);
				var val_antigo = this.control_obj.value;
				this.control_obj.value = this.TCRformatForm(this.out_val);
				if (this.control_obj.value != val_antigo && this.control_obj.onchange && '' != this.control_obj.onchange) {
				    this.control_obj.onchange();
				}
				break;
			case 'z':
				tmp = parseFloat(tmp);
				this.out_val = tmp * -1;
				if (this.slag_1 != '' && this.slag_2 == '') this.slag_1 = this.out_val;
				else if (this.slag_2 != '') this.slag_2 = this.out_val;
				break;
			default:
				if (this.oper_old == '') {
					if (num == '0' && tmp == '0') this.slag_1 = tmp;
					else if (num == '.' && tmp == '0') this.slag_1 = tmp + num;
					else if(num == '.' && this.slag_1 == '') this.slag_1 = '0' + num;
					else if (num == '.' || this.slag_1 != '') this.TCRisPoint(num, '1');
					else this.slag_1 = num;
					this.out_val = this.slag_1;
				}
				else {
					if (num == '0' && tmp == '0') this.slag_2 = tmp;
					else if(num == '.' && this.slag_2 == '') this.slag_2 = '0' + num;
					else if (num == '.' || this.slag_2 != '') this.TCRisPoint(num,'2');
					else this.slag_2 = num;
					this.out_val = this.slag_2;
				}
	}
	if (this.t_load) window.win_ch.document.forms[0].elements[0].value = this.out_val;
}

function TCRformatCalc(data) {
    if ('' != this.sep_milhar) {
        srch = eval('/' + this.sep_milhar + '/g');
        data = data.replace(srch, '');
    }
    if ('.' != this.sep_decimal) {
        srch = eval('/' + this.sep_decimal + '/g');
        data = data.replace(srch, '.');
    }
    if ('.' == data.substr(0, 1) || ',' == data.substr(0, 1)) {
        data = '0' + data;
    }
    return data;
}

function TCRformatForm(data) {
    data = data.toString();
    if (-1 < data.indexOf('.')) {
        parts = data.split('.');
        pref = parts[0];
        suf = parts[1];
    }
    else {
        pref = data;
        suf = '';
    }
    if ('' != this.sep_milhar) {
        if (3 == this.thousands_format) {
            if (4 <= pref.length) {
                pref_rest = pref.substr(0, pref.length - 3);
                pref = this.sep_milhar + pref.substr(pref.length - 3);
                while (2 < pref_rest.length) {
                    pref = this.sep_milhar + pref_rest.substr(pref_rest.length - 2) + pref;
                    pref_rest = pref_rest.substr(0, pref_rest.length - 2);
                }
                if ('' != pref_rest) {
                    pref = pref_rest + pref;
                }
            }
        }
        else if (2 == this.thousands_format) {
            if (4 <= pref.length) {
                pref = pref.substr(0, pref.length - 3) + this.sep_milhar + pref.substr(pref.length - 3);
            }
        }
        else {
            pref_rest = pref;
            pref = '';
            while (3 < pref_rest.length) {
                pref = this.sep_milhar + pref_rest.substr(pref_rest.length - 3) + pref;
                pref_rest = pref_rest.substr(0, pref_rest.length - 3);
            }
            if ('' != pref_rest) {
                pref = pref_rest + pref;
            }
        }
    }
    if ('' != this.precision) {
        if (suf.length > this.precision) {
            suf = '1' + suf.substr(0, this.precision) + '.' + suf.substr(this.precision);
            suf = Math.round(parseFloat(suf)).toString().substr(1);
        }
        else {
            while (suf.length < this.precision) {
                suf += '0';
            }
        }
    }
    if ('' != this.sep_decimal && '' != suf) {
        data = pref + this.sep_decimal + suf;
    }
    else {
        data = pref;
    }
    if ('' != this.monetary) {
        data = 'left' == this.monetary_pos ? this.monetary + ' ' + data : data + ' ' + this.monetary;
    }
    return data;
}

function TCRcleanValue() {
    if (this.monetary + ' ' == this.load_value.substr(0, this.monetary.length + 1)) {
        this.load_value   = this.load_value.substr(this.monetary.length + 1);
        this.monetary_pos = 'left';
    }
    else if (this.monetary == this.load_value.substr(0, this.monetary.length)) {
        this.load_value   = this.load_value.substr(this.monetary.length + 1);
        this.monetary_pos = 'left';
    }
    else if (' ' + this.monetary == this.load_value.substr(this.load_value.length - this.monetary.length - 1)) {
        this.load_value   = this.load_value.substr(0, this.load_value.length - this.monetary.length - 1);
        this.monetary_pos = 'right';
    }
    else if (this.monetary == this.load_value.substr(this.load_value.length - this.monetary.length)) {
        this.load_value   = this.load_value.substr(0, this.load_value.length - this.monetary.length);
        this.monetary_pos = 'right';
    }
}