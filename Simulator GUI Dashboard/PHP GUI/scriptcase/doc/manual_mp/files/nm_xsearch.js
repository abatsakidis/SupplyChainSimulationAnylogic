/* XSearch Engine version5.2		*/
/* Développé by P.Bestebroer		*/
/* http://www.dynamic-core.net	 	*/
/* Traduction française Vincent Vaudey - xseditor@free.fr */

function trecords()
{
	this.index=(trecords.count++)
	//this.link=''
	this.pages=''
	this.keywords=''
	//this.description=''
	return this
}
trecords.prototype.set=function(pages,keywords)
{
	//this.link=link
	this.pages=pages
	this.keywords=keywords
	//this.description=description
}
trecords.prototype.searchstring=function() { return this.keywords }
trecords.prototype.count=0

function add(pages,keywords)
{
	al=records.length
	records[al]=new trecords()
	records[al].set(pages,keywords)
}

records = new Array()
finds=0
sites=0
version="5.2"
andresult=false
SortResults=true
display_start=0
displast=10
function qsort(f, l)
{  // non utilisé, provoque un dépassement de pile dans les grandes bases de données
// Qsort function by Rob B.
	var a=f
	var b=l
	var s
	var m = results[(a+b)>>1].val
   	while (a<=b)
	{
		while (results[a].val>m) {a++}
		while (m>results[b].val) {b--}

		if (a<=b)
		{
            s=results[a]
			results[a]=results[b]
			results[b]=s
            	a++
            	b--
        	}
	} 
	if (f<b) this.qsort(f, b)
	if (a<l) this.qsort(a, l)
}
function bsort()
{
	for (var i=results.length-1; i>=0; i--)
	{
		for (var j=i; j>=0; j--)
		{
			if (results[i].val>results[j].val)
			{
				s=results[i]
				results[i]=results[j]
				results[j]=s
			}
		}	
	}
}

function searchAll(keyword)
{
	var strResultContent = '';
	
	var timeA=new Date()
	var nw=0
	finds=0
	sites=0

	var x = parseIt(keyword)
	if(x == -1) return
	total_keywords=x

	
	if (keyword.length>50) keyword=keyword.substring(0,60)+"..."

	results=new Array()
	for (q=0; q<records.length; q++)
	{
		results[q]=new Array()
		results[q].rec=q
		results[q].val=0
	}

	for (nw=0; nw<keywords.length; nw+=1) search(keywords[nw])
	if (andresult)
	{
		for (a=0; a<results.length; a+=1)
		{
			if (results[a].val>0)
			{
				if (results[a].val<=(total_keywords-1)<<1)
				{
					results[a].val=0
					sites-=1
				}
			}
		}
	}
	
	results_new=new Array()
	i=0;
	for (q=0; q<results.length; q++)
	{
		if (results[q] != undefined)
		{
			results_new[i] = results[q];
			i++;
		}
	}
	results = results_new;
	delete results_new;

	if (SortResults && keywords!='[all]') bsort()

	// Now we build the output page
	displast=display_start
	displast+=10
	if (displast>sites) displast=sites

	var timeB=new Date()

	if (finds==0) { display_start=-1; displast=0 }
	strResultContent += sprintf(lang_results, (display_start+1), (displast), sites, keyword);
	//strResultContent += '<h5>Tempo de execução: <b>'+((timeB-timeA)/1000)+'</b> segundos.</h5>';

	if (displast>sites && finds!=0) displast=sites+1


	if (finds==0) {
		strResultContent += sprintf(lang_notfound, keyword, keyword);
	}
	else
	{
		q2=display_start
		q3=displast
		for (q=display_start; q<q3; q+=1)
		{
			if (results[q] == undefined)
				continue
			
			if (results[q].val>0)
			{
				rc=results[q].rec
				strResultContent += "<span class='xtitle'>"+records[rc].keywords+"</span><br>";
				/*
				x1=records[rc].link.indexOf('http://')
				if (x1==-1) x1=records[rc].link.indexOf('href=')+5
				else x1+=7
				x2=records[rc].link.indexOf('>')
				if (x1>0 && x2>0) {
					tmp=records[rc].link.substring(x1,x2)
					x2=tmp.indexOf(' ')
					if (x2>0) tmp=tmp.substring(0,x2)
					if (tmp.substring(0,1)=="'") tmp=tmp.substring(1,tmp.length-1)
					if (tmp.substring(0,1)=='"') tmp=tmp.substring(1,tmp.length-1)
					document.write("<table border=0 width=500><tr><td><span class='xresult'>"+records[rc].description+"</span></td></tr></table><span class='xlocation'>"+tmp+"</span><br><br>")
				}
				*/
				for (p in records[rc].pages)
				{
					aLink = indices[records[rc].pages[p]].split("|");
					link = aLink[0];
					desc = aLink[1];
					strResultContent += "&nbsp;<span class='xresult'><a href='#"+random(100000, 999999)+"' onClick='openPage("+records[rc].pages[p]+")'>"+desc+"</a></span><br>";
				}			
	
				q2++
	   		}
	   		strResultContent += "<br>";
		}
	
	
		if (finds>10)
		{
			strResultContent += "<BR>";
			pages=Math.round(finds/10)
			if (finds%10<6)	pages++
	
			// Créé la chaîme de paramètres
			paramstring=searchname+"#keywords="+keyword+"&and="+andresult+"&sort="+SortResults
	
			strResultContent += "<span class='xsmall'>";
			if (display_start>0) strResultContent += "<a href='#"+random(100000, 999999)+"' onClick='navPage(\""+paramstring+"&disp="+(display_start-10)+"\")'>"+lang_prevpage+"</a>";
			strResultContent += "&nbsp;&nbsp;&nbsp;";
	
			for (i=1; i<=pages; i+=1)
			{
				if ((((i-1)*10)+1)<=sites) strResultContent += "<a href='#"+random(100000, 999999)+"' onClick='navPage(\""+paramstring+"&disp="+(((i-1)*10))+"\")'>"+i+"</a>&nbsp&nbsp ";
			}
			strResultContent += "&nbsp;&nbsp;&nbsp;";
			if (displast<=sites) strResultContent += "<a href='#"+random(100000, 999999)+"' onClick='navPage(\""+paramstring+"&disp="+(displast)+"\")'>"+lang_nextpage+"</a>";
			strResultContent += "</span>";
		}
	}
	document.getElementById('pageContent').innerHTML = strResultContent;
}

function Cat()
{
	
	document.open()
	document.clear()
	
	AddBody()
	
	DisplayXSearch()
	document.close()
}

function stripInput(key)
{
	while(key.substring(0,1) == ","  || key.substring(0,1) == " " ) key = key.substring(1,key.length)
	while(key.substring(key.length-1,key.length) == "," || key.substring(key.length-1,key.length) == " ") key = key.substring(0,key.length-1)
	return key
}

function parseIt(key)
{
	key=stripInput(key)+" "
	var y=0

	while(key.indexOf(" ") > 0)
	{
		if (key.substring(0,1)=='"')
		{
			var pos=key.indexOf('"',2)
			keywords[y]=key.substring(1,pos)
			keywords[y]=stripInput(keywords[y])
			y++
			key=key.substring(pos+1,key.length)
		} else
		{
			var pos=key.indexOf(' AND ')
			if ((pos>0) && (key.indexOf(' ')>=pos))
			{
				pos=key.indexOf(' ',pos+5)
				keywords[y]=key.substring(0,pos)
				keywords[y]=stripInput(keywords[y])
				y++
				key=key.substring(pos+1,key.length)
				if (key.substring(0,4)=='AND ') {
					pos=keywords[y-1].indexOf(' ')+5
					key=keywords[y-1].substring(pos,keywords[y-1].length)+' '+key
				}
			} else
			{
		  		var pos=key.indexOf(' OR ')
		  		if ((pos>0) && (key.indexOf(' ')>=pos))
				{
					pos=key.indexOf(' ')
					keywords[y]=key.substring(0,pos)
					keywords[y]=stripInput(keywords[y])
					if (keywords[y]!=keywords[y-1])	y++
					key=key.substring(pos+1,key.length)
					pos=key.indexOf('OR ')
					key=key.substring(pos+3,key.length)
					pos=key.indexOf(' ')
					keywords[y]=key.substring(0,pos)
					keywords[y]=stripInput(keywords[y])
					y++
					key=key.substring(pos+1,key.length)
					if (key.substring(0,3)=='OR ') key=keywords[y-1]+' '+key
				} else
				{
					var pos = key.indexOf(" ")
					keywords[y]=key.substring(0,pos)
					keywords[y] = stripInput(keywords[y])
					y++
					if(y > 50) return -1
					key=key.substring(pos+1,key.length)
				}
			}
		}
	}
	return y-1
}

var keywords = new Array()
var results

function AddBody()
{
	templateBody();

	var keytext='"'+searchname+'#keywords="+'
	var andtext='"&and="+'
	
	document.write('<script>function doSearch(){'+
						'	searchwords=document.searchform.searchwords.value; '+
						'	while (searchwords.indexOf(" ")>-1){ pos=searchwords.indexOf(" ");'+
						'		searchwords=searchwords.substring(0,pos)+"+"+searchwords.substring(pos+1);'+
						'	}'+
						'	readParams();'+
						'	searchAll(searchwords);'+
						'}'+
						'function navPage(location){'+
						'	document.location=location;'+
						'	readParams();'+
						'	searchAll(searchwords);'+
						'}'+
						'<'+'/'+'script>'						
						)
	
	
	document.write("<form name='searchform' method='post' onSubmit='doSearch(); return false;'><table border='0' width='10%'><tr><td align='left' nowrap><font face='Arial, Helvetica, sans-serif' size='2'>"+lang_searchfor+"<br><input name='searchwords' type='text' size='25'><br><div style='text-align: center'><a href='javascript:doSearch()' style='font-size: 12px'>"+lang_searchbtn+"</a></div></font></td></tr></table></form><div id='pageContent'></div>")
	
	if (usebannercode) bannerCode()
}

function DisplayXSearch()
{
	// Cette ligne peut être effacée, mais, s'il vous plaît, n'ajoutez rien comme 
	// copyright <votre nom> parce que c'est interdit, et
	// si vous enlevez ou changez cette ligne, assurez vous qu'il y ait une mention
	// et un lien à www.dynamic-core.net de sorte que d'autre personnes puissent également
	// se faire la main sur ce moteur de recherche GRATUIT.. Merci.
	//document.write("<h3><center>Réalisé par <a href=http://www.dynamic-core.net>XSearch "+version+"</a> - Moteur de recherche JavaScript gratuit<h4>Traduction française Vincent Vaudey - <a href=mailto:xseditor@free.fr>xseditor@free.fr</a></h4></center></h3>")
	templateEnd()
}

function search(keyword)
{
	var hit=0
	var addcomplete=0

	for (q=0; q<records.length; q++)
	{
		addcomplete=0
		search_parm=" "+records[q].searchstring()+" "
		search_parm=search_parm.toLowerCase()

		if (keyword.indexOf(' AND ')>0)
		{
			firstword=keyword.substring(0,keyword.indexOf(' ')).toLowerCase()
			lastword=keyword.substring(keyword.indexOf(' AND ')+5,keyword.length).toLowerCase()
			if ((search_parm.indexOf(" "+firstword+" ") != -1) && (search_parm.indexOf(" "+lastword+" ")!= -1 ))
			{
				hit++
				finds++
				if(hit<2) { 
					if (results[q].val==0) sites++
					results[q].val +=2
				} 
			}
		} else
		{
			keyword=keyword.toLowerCase()
			if ((search_parm.indexOf(" "+keyword+" ") != -1) ||(keyword=="[all]"))
			{
				hit++
				finds++
				if(hit<2) { 
					if (results[q].val==0) sites++
					results[q].val+=2
				} 
			} else
			{
				// recherche sur des moitiés de résultats (par exemple recherche:java trouve:javascript)
				if (search_parm.indexOf(keyword) != -1)
				{
					hit++
					finds++
					if(hit < 2)
					{
						if (results[q].val==0) sites++
						results[q].val+=1
						x=search_parm.indexOf(keyword)+keyword.length
						pos=search_parm.substring(1,x-keyword.length)
						while (pos.indexOf(" ")!=-1)
						{
							y=pos.indexOf(" ")
							pos=pos.substring(y+1,pos.length)
						}
						if (pos.length<=2) addcomplete++
	
						pos=search_parm.substring(x,search_parm.length)
						fullresult=search_parm.substring(x,x+pos.indexOf(" "))
						
						if (fullresult.length<=2) addcomplete++
						if (addcomplete>1) results[q].val+=1
					}
				}
				else
				{
					delete results[q];
				}
			}
		}
		hit=0
	} 
}                                       

var searchwords = ''
var newload = true

function initXsearch()
{
	Cat();
			
	if (searchwords!='') searchAll(searchwords)
	//else if (newload) Cat()
}

function tparams()
{
	parameters=document.location.hash
	parameters=unescape(parameters.substring(1,parameters.length)+'&')

	this.params=new Array()
	i=0
	while (parameters.indexOf('&',0)!=-1)
	{
		al=this.params.length
		this.params[al]=new Array()
	
		tmp=parameters.substring(0,parameters.indexOf('&',0))
		parameters=parameters.substring(parameters.indexOf('&',0)+1)

		if (tmp.indexOf('=')!=-1)
		{
			this.params[al].command=tmp.substring(0,tmp.indexOf('='))
			this.params[al].value=tmp.substring(tmp.indexOf('=')+1)
		} else
		{
			this.params[al].command=tmp
			this.params[al].value=''
		}
	}

	return this
}
tparams.prototype.getValue=function(param)
{
	value=''
	param=param.toLowerCase()
	al=this.params.length
	for (var i=0; i<al; i+=1) if (this.params[i].command==param) value=this.params[i].value
	return value
}

function readParams()
{
	params=new tparams()
	if (params.getValue('keywords')!='')
	{
		searchwords=params.getValue('keywords')
		origsearchwords=searchwords
		while (searchwords.indexOf('+')>-1)
		{
			pos=searchwords.indexOf('+')
			searchwords=searchwords.substring(0,pos)+' '+searchwords.substring(pos+1)
		}
	}
	if (params.getValue('sort')!='')
		if (params.getValue('sort')=='0' || params.getValue('sort')=='false') SortResults=false
		else SortResults=true
	if (params.getValue('and')!='')
		if (params.getValue('and')=='0' || params.getValue('and')=='false') andresult=false
		else andresult=true
	if (params.getValue('disp')!='') display_start=parseInt(params.getValue('disp'))
}
readParams();

function openPage(page)
{
	aLink = indices[page].split("|");
	link = aLink[0];
	window.open(link, "bodyContent");
}
function random(inferior,superior){
    numPossibilidades = superior - inferior
    aleat = Math.random() * numPossibilidades
    aleat = Math.floor(aleat)
    return parseInt(inferior) + aleat
}
