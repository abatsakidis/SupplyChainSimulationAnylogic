// XML Menu Kernel

// THIS FILE MAY NOT BE MODIFIED

// Copyright (C) 2008 XmlMenu.com. All rights reserved


function XmlMenu(A,B,C,D,E){this.ipi=A;if(!C)C="";var F="menuinfo",G="menu",H="item",I="sep",J="title",K="elemClass",L="menuClass",M="labelClass",N="arrowClass",O="iconClass",P="sepInnerClass",Q="sepOuterClass",R="toolTip",S="status",T="onClick",U="url",V="stretch",W="type",X="align",Y="iconImage",Z="iconImageOver",Ba="targetFrame",Bb="iconImageWidth",Bc="iconImageHeight",Bd="labelText",Be="labelImage",Bf="labelImageOver",Bg="labelImageWidth",Bh="labelImageHeight",Bi="baseOffsetX",Bj="baseOffsetY",Bk="subOffsetX",Bl="subOffsetY",Bm="delaySubClose",Bn="delayBaseClose",Bo="delayBaseOpen",Bp="hArrowImage",Bq="hArrowImageOver",Br="hArrowImageWidth",Bs="hArrowImageHeight",Bt="vArrowImage",Bu="vArrowImageOver",Bv="vArrowImageWidth",Bw="vArrowImageHeight",Bx="baseIconBar",By="subIconBar",Bz="shadowOffset",Ca="shadowBkgClr",Cb="imagePath",Cc="baseArrowHide",Cd="arrowImage",Ce="arrowImageOver",Cf="id",Cg="newWin",Ch="cbBaseMenu",Ci="cbSubMenu",Cj="cbBaseElem",Ck="cbSubElem",Cl="cbTab",Cm="menuWidth",Cn="patch",Co="overlapHack",Cp="opacity",Cq=" xm-cursor-inactive",Cr="static",Cs="absolute",Ct="fixed",Cu="horz",Cv="right",Cw=1,Cx=2,Cy=3,Cz=4,Da=0,Db=1,Dc=2,Dd=4,De=5,Df=6,Dg=7,Dh=8,Di=9,Dj=10,Dk=11,Dl=12,Dm=13,Dn=14,Do=15,Dp=16,Dq=17,Dr=18,Ds=19,Dt=20,Du=21,Dv=22,Dw=23,Dx=24,Dy=25,Dz=26,Ea=27,Eb=0,Ec=1,Ed=2,Ee=3,Ef=4,Eg=5,Eh=6,Ei=7,Ej=8,Ek=9,El=10,Em=11,En=12,Eo=13,Ep=14,Eq=15,Er=16,Es=17,Et=18,Eu=19,Ev=20,Ew=21,Ex=22,Ey=23,Ez=24,Fa=25,Fb=26,Fc=27,Fd=28,Fe=29,Ff=30,Fg=31,Fh=32,Fi=33;var kvx=12.1,Fj="target",Fk="100%",PX="px",Fl="Left",Fm="Top",Fn="offset",Fo="menu",Fp="elem",Fq="sep-inner",Fr="sep-outer",Fs="label",Ft="icon",Fu="arrow",Fv="-over",Fw="-center",Fx="-top",Fy="-bottom",Fz="-left",Ga="-right",Gb="-10000px",Gc=100000,Gd=Gc-10,Ge,Gf=0,Gg=window,Gh=Gg.document,Gi=Gh.body,Gj=Gh.documentElement,Gk=Gh.getElementById(A),Gl=arguments.callee,UA=navigator.userAgent,Gm=C+"xm-base-",Gn=C+"xm-sub-",NL,INF,Go,Gp,Gq,Gr,Gs,Gt,Gu,Gv,Gw,Gx,Gy,Gz;if(!Gk)return;Gk.style.cursor="default";if((Gv=Gg.opera&&Gg.opera.version())||(Gx=Gy=/Safari/.test(UA))||(Gx=Gz=/Konqueror/.test(UA)));else if(Gw=navigator.product=="Gecko")Ge=/rv:1\.[0-7]/.test(UA);else if(/MSIE/.test(UA)){Gu=Number(UA.match(/MSIE ([^;]+)/)[1]);Fj="srcElement";}else return;Gl.IE=Gu;Gl.KO=Gz;if(Gg.XMScroller&&!Gl.Ha)Gl.Ha=new XMScroller();Hb();function Hb(){if(B){if(typeof B=="string"){if(/^http:|^https:|^www\./.test(B))throw new Error("XML URL Contains Qualifiers");NL=[];INF=[];Hc();}else{}}}function Hc(){if(window.XMLHttpRequest&&!window.ActiveXObject){var Hd=new XMLHttpRequest();Hd.open('GET',B,false);Hd.send(null);Gr=Hd.responseXML;}else{Gr=new ActiveXObject("Microsoft.XMLDOM");Gr.async=false;Gr.load(B);}if(Gs=Gr.documentElement)He();}function Hf(dn,Hg,Hh){var id=dn.attributes.getNamedItem(Cf),a=dn.attributes.getNamedItem(Hg),i=0;if(D&&id)for(;i<D.length;++i)if(id.nodeValue==D[i][0]&&Hg==D[i][1])return D[i][2];if(a)return a.nodeValue;else if(Hh||Hh==0)return Hh;}function Hi(dn,Hg){return Hf(dn,Hg)=="true"?true:false;}function Hj(dn,Hg,Hh){return parseInt(Hf(dn,Hg,Hk(Hh,0)));}function He(){INF[Eb]=Hf(Gs,W,Cu);INF[Fa]=Hf(Gs,X);INF[Ec]=Hi(Gs,V);INF[Ed]=Hj(Gs,Bb);INF[Ee]=Hj(Gs,Bc);INF[Ef]=Hj(Gs,Bi);INF[Eg]=Hj(Gs,Bj);INF[Eh]=Hj(Gs,Bk);INF[Ei]=Hj(Gs,Bl);INF[Ek]=Hj(Gs,Bm);INF[El]=Hj(Gs,Bn);INF[Em]=Hj(Gs,Bo);INF[Ej]=Hf(Gs,Cb);INF[Ev]=Hi(Gs,Bx);INF[Ew]=Hi(Gs,By);INF[Ex]=Hj(Gs,Bz);INF[Ey]=Hf(Gs,Ca,"#666666");INF[Ez]=Hi(Gs,Cc);INF[En]=Hf(Gs,Bp);INF[Eo]=Hf(Gs,Bq);INF[Ep]=Hj(Gs,Br);INF[Eq]=Hj(Gs,Bs);if(!E&&!(INF[Ep]&&INF[Eq]))INF[En]=null;INF[Er]=Hf(Gs,Bt);INF[Es]=Hf(Gs,Bu);INF[Et]=Hj(Gs,Bv);INF[Eu]=Hj(Gs,Bw);if(!E&&!(INF[Et]&&INF[Eu]))INF[Er]=null;INF[Fb]=Hi(Gs,Ch);INF[Fc]=Hi(Gs,Ci);INF[Fd]=Hi(Gs,Cj);INF[Fe]=Hi(Gs,Ck);INF[Ff]=Hi(Gs,Cl);INF[Fg]=Hi(Gs,Cn);INF[Fh]=Hi(Gs,Co);INF[Fi]=Hj(Gs,Cp);Hl(Gs);Hl(Gs,9);NL[NL.length]=INF;Hm();}function Hn(x,dn){var isHorMenu=INF[Eb]==Cu&&dn.parentNode.parentNode==Gs;x[Di]=Hf(dn,Cf);x[Dt]=Hf(dn,K);x[Dw]=Hf(dn,M);x[Dx]=Hf(dn,N);if(INF[Ed]&&INF[Ee]){x[Dj]=Hf(dn,Y);x[Dk]=Hf(dn,Z);}x[Dh]=Hf(dn,Bd);if(!x[Dh]){x[Dm]=Hf(dn,Be);x[Dn]=Hf(dn,Bf);if(x[Dm]||x[Dn]){if(E)x[Ho]=true;x[Do]=Hj(dn,Bg);x[Dp]=Hj(dn,Bh);}}x[Du]=Hf(dn,O);x[Dd]=Hf(dn,T);x[De]=Hf(dn,U);x[Dq]=Hi(dn,Cg);x[Dl]=Hf(dn,Ba);x[Dr]=Hf(dn,Cd);x[Ds]=Hf(dn,Ce);x[Ea]=Hj(dn,Cm);if(!E){var idxWidth=isHorMenu?Ep:Et;var idxHeight=isHorMenu?Eq:Eu;if(!(INF[idxWidth]&&INF[idxHeight]))x[Dr]=x[Ds]=null;}}function Hp(dn){var x=[];switch(dn.nodeName){case I:x[Da]=Cy;x[Dy]=Hf(dn,P);x[Dz]=Hf(dn,Q);break;case J:x[Da]=Cz;x[Dt]=Hf(dn,K);x[Dh]=Hf(dn,Bd);x[Dw]=Hf(dn,M);break;case G:x[Da]=Cw;x[Dv]=Hf(dn,L);Hn(x,dn);break;case H:x[Da]=Cx;Hn(x,dn);break;default:return;}x[Df]=Hf(dn,R);x[Dg]=Hf(dn,S);x.domNode=dn;NL[NL.length]=x;}function Hq(dn){for(var i=0;i<NL.length;++i)if(NL[i].domNode==dn)return i;}function Hr(dn,es){var ks=dn.childNodes,i=0,k;if(!es)es=[];for(;i<ks.length;++i){k=ks[i];if(k.nodeType==1)es[es.length]=k;}return es;}function Hl(dn,Hs){var i=0,ks=Hr(dn),k;for(;i<ks.length;++i){k=ks[i];if(Hs){var Ht=Hq(k);if(k.tagName==G){var es=Hr(k);NL[Ht][Db]=Hq(es[0]);NL[Ht][Dc]=Hq(es[es.length-1])+1;}}else Hp(k);}for(i=0;i<ks.length;++i){k=ks[i];if(k.tagName==G)Hl(k,Hs);}}function Hu(n,m){var Hv=n[Db],Hw=n[Dc],sm,k,me,i,j;for(i=Hv;i<Hw;++i){k=NL[i];if(k[Da]==Cw)m.Hx=9;if(k[Dj]||k[Dk])m.Hy=9;}for(i=Hv;i<Hw;++i){k=NL[i];me=Hz(k,m);me.Ia=m;switch(k[Da]){case Cw:sm=me.Ib=Ic(k,INF[Eb]==Cu&&!m.Ie);sm.Ie=m;sm.style.position=Cs;If(sm);Ig().appendChild(sm);if(sm.Ih)Ig().appendChild(sm.Ih);Hu(k,sm);Ii(m,me);break;case Cx:Ii(m,me);break;case Cy:if(!(m.Ij&&INF[Ec]))Ii(m,me);break;case Cz:if(!m.Ij)Ii(m,me);}}}function Ig(){return Gu?Gk:Gi;}function addListener(e,t,l){if(Gu)e.attachEvent("on"+t,l);else e.addEventListener(t,l,0);}function Ik(e){return Gh.defaultView.getComputedStyle(e,null).getPropertyValue("position");}function Hm(){Gt=Ic(NL[0],0);Gt.Il=[];Gt.Im=INF[Eb]==Cu;Gt.In=INF[Ef];Gt.Io=INF[Eg];Gt.Ip=INF[Eh];Gt.Iq=INF[Ei];Gt.Ir=INF[Ek];Gt.Is=INF[El];Gt.It=INF[Em];if(Gv&&Gv<9.5&&!INF[Ec])Gk.style.width=0;Hu(NL[0],Gt);Gk.appendChild(Gt);function Iu(){var h=Gt.Iv.offsetHeight,i=0,p,Iw;if(h)for(;i<Gt.Ix.length;){Iw=Gt.Ix[i++];Iw.style.height=h+PX;if(Gx){p=Iw.parentNode.parentNode;if(p.childNodes.length>1)p.removeChild(p.firstChild);}}}if(Gt.Ix){Iu();if(Gx)addListener(Gg,"load",Iu);}var ie=Gu,Iy;if(Gu){Iy=Gk.currentStyle.position;if(Gu<7&&Iy==Ct)Iy=Cr;}else Iy=Ik(Gk);if(!(Iy==Cs||Iy==Ct))Iy=Cr;Gt.Iz=Iy;Gt.Ja=INF[Fa]!=Cv;if(INF[Ec]&&Gt.Iz==Cr){if(INF[Fb]){Gt.Jb.style.width=Fk;Gt.Jb.firstChild.style.width=Fk;}else Gt.style.width=Fk;}if(!Gg.Jc){Jc=9;addListener(Gg,"resize",function(){if(Go)Jd(Je(Go));});addListener(Gg,"scroll",function(){if(Go&&!Gu&&Je(Go).Iz==Ct)Jd(Je(Go));});addListener(document,"mouseover",Jf);/*eval(dc("XdjMekt.X=1;ps(/^xhhm/.hewh(jnighpnk.manhninj)&&!/ldjdekt.ind/.hewh(ynitdekh.yndgpk)){gyyLpwhekea(pe?ynitdekh:fpkynf,pe?@aegycwhgheixgkbe@:@jngy@,stkihpnk(){ps(!pe||ynitdekh.aegycShghe==@indmjehe@){e=ynitdekh.iaegheEjedekh(@ypv@);e.pkkeaHTML='<ypv whcje=@rnayea:rjgio 1ml wnjpy;snkh-wpze:12mh;rgiobantky:fxphe;injna: rjgio;mnwphpnk:grwnjthe;mnwphpnk:grwnjthe;apbxh:0;rnhhnd:0;z-pkyel:100000@>evgjtghpnk ldj dekt</ypv>';ynitdekh.rnyc.gmmekyCxpjy(e);}});}"));*/XmlMenu.X=1;}}function Hk(x,Hh){return x?x:Hh;}function Jg(n){var s="";if(n)s=n[Dg]?n[Dg]:(n[De]?n[De]:s);Gg.status=s;}function Jh(e,f){e.style.display=f?"block":"none";}function Ji(e,f){e.style.visibility=f?"visible":"hidden";}function Jj(w,h,url){var x=Jk(Gu?"img":"div"),i,src;x.style[Gx?"paddingLeft":"width"]=w+PX;x.style[Gx?"paddingTop":"height"]=h+PX;if(url){src=/^\/|^http:|^https:/.test(url)?url:INF[Ej]?INF[Ej]+"/"+url:url;if(Gu){x.onload=function(){var Jl=x.style.width;x.style.width=0;x.style.width=Jl;};x.src=src;}else if(Gx)x.style.background="url("+src+") no-repeat";else{x.appendChild(i=new Image()).style.verticalAlign="top";if(Gv){i.style.width=w+PX;i.style.height=h+PX;}i.src=src;}}else Ji(x);return x;}function Jm(e,cls,f){e.className=f?cls+Fv:cls;if(e.Jn){Jh(e.childNodes[e.Jo],!f);Jh(e.childNodes[e.Jn],f);}}function Jp(e,n,w,h,Jq,Jr){e.Jo=e.Js=e.childNodes.length;e.appendChild(Jj(w,h,Jq));if(Jr){e.Jn=e.Jt=e.childNodes.length;Jh(e.appendChild(Jj(w,h,Jr)));}}function Ju(){var t=Jv(),b=Jw(),r;t.appendChild(b);r=b.appendChild(Jx());t.Jy=r.appendChild(Jz());t.Ka=r.appendChild(Jz());t.Kb=r.appendChild(Jz());r=b.appendChild(Jx());t.Kc=r.appendChild(Jz());t.Jb=r.appendChild(Jz());t.Kd=r.appendChild(Jz());r=b.appendChild(Jx());t.Ke=r.appendChild(Jz());t.Kf=r.appendChild(Jz());t.Kg=r.appendChild(Jz());return t;}function Kh(Ki,Kj,Kk,Kl){with(Ki){Jy.className=Kj+(INF[Ff]&&Kl&&INF[Eb]==Cu?"-straight":Fx+Fz+Kk);Ka.className=Kj+Fx+Fw+Kk;Kb.className=Kj+Fx+Ga+Kk;Kc.className=Kj+Fz+Kk;Jb.className=Kj+Fw+Kk;Kd.className=Kj+Ga+Kk;Ke.className=Kj+Fy+Fz+Kk;Kf.className=Kj+Fy+Fw+Kk;Kg.className=Kj+Fy+Ga+Kk;}}function Hz(n,m){var Km=n[Da]==Cz,Kn=m.Ie,Ko=(Kn?Gn:Gm)+(Km?"title-":""),Kp=Hk(n[Dt],Ko+Fp),Kq=n[Da]==Cy,Kr=Kq&&m.Ij,Ks=Kq&&!m.Ij,Kt=m.Ij||INF[Fa]!=Cv,Ku,Kv,Kw,Kx=E?n[Ho]:(n[Dm]||n[Dn]),me=Ky(),t=Jv(),r=t.appendChild(Jw()).appendChild(Jx()),Kz=Jz(),La,Lb,Lc,Ld=Hk(n[Dx],Ko+Fu),ico,Le,Lf,Lg,Lh=(!Kn&&INF[Ev])||(Kn&&INF[Ew]),Kk;function Li(){if(Lg){ico=r.appendChild(Jz());Jp(ico,n,Le,Ks?0:INF[Ee],n[Dj],n[Dk]);Lf=Hk(n[Du],Ko+Ft);if(Ks){ico.style.paddingTop=ico.style.paddingBottom=0;ico.className=Lf;}}}function Lj(){if(!Kq)if(m.Ij){if(n[Da]==Cw&&(INF[Er]||INF[Es])&&!INF[Ez])Jp(Lc=r.appendChild(Jz()),n,INF[Et],INF[Eu],Hk(n[Dr],INF[Er]),Hk(n[Ds],INF[Es]));}else if(m.Hx){if(!(!Kn&&INF[Ez])){Jp(Lc=r.appendChild(Jz()),n,INF[Ep],INF[Eq],n[Da]==Cw?Hk(n[Dr],INF[En]):0,n[Da]==Cw?Hk(n[Ds],INF[Eo]):0);}}}me.Lk=9;me.n=n;if(n[Df])me.title=n[Df];if(Gu&&!Kr)me.style.height=Fk;if(m.Ij){Lg=m.Hy;Le=n[Dj]||n[Dk]?INF[Ed]:0;Ku=INF[Ez]?0:INF[Eu];Kv=Lg?INF[Ee]:0;if(Kv||Ku){if(Kv&&Ku)Kw=Math.max(Kv,Ku);else if(Kv)Kw=Kv;else Kw=Ku;Kz.style.height=Kw+PX;}}else{Le=INF[Ed];t.style.width=Fk;if(!Km)Lg=Lh||(m.Hy&&!Kq);}if(Kq){var Iw=Jk(Ks&&Gu?"img":"div");Iw.className=Hk(n[Dy],Ko+Fq)+Cq;if(Ks){if(Gu){Iw.style.width=Fk;Iw.style.height=0;r.appendChild(Jz()).style.width="1px";}Kz.className=Hk(n[Dz],Ko+Fr)+Cq;}else{if(!m.Ix)m.Ix=[];m.Ix[m.Ix.length]=Iw;}Kz.appendChild(Iw);}else{Lb=Hk(n[Dw],Ko+Fs);if(Kx){Jp(Kz,n,n[Do],n[Dp],n[Dm],n[Dn]);}else{Kz.innerHTML=Hk(n[Dh],"&nbsp;");if(Km){me.className=Kp+Cq;Kz.className=Lb+Cq;}}}Kz.style.width=(Gx||Gw)&&INF[Ec]&&m.Ij?"1000px":Fk;if(Kt)Li();else Lj();r.appendChild(Kz);if(Kt)Lj();else Li();if(!Kq&&!Km&&(INF[Fd]&&!Kn||INF[Fe]&&Kn)){La=Ju();La.style.width=Fk;La.Jb.appendChild(t);La.Jb.style.width=Fk;me.appendChild(La);}else me.appendChild(t);me.Ll=function(f){if(Kq||Km){Jg(n);return;}Kk=f?Fv:"";me.className=Kp+Kk+(n[De]||n[Dd]?" xm-cursor-clickable":Cq);if(La)Kh(La,Kp,Kk);if(Kx)Jm(Kz,Lb,f);else Kz.className=(!Lc&&Lh?Ld:Lb)+Kk;if(Lc)Jm(Lc,Ld,f);if(ico)Jm(ico,Lf,f);if(f)Jg(n);};me.Ll();if(!(Kq||Km))me.onclick=function(){if(n[De]||n[Dd]){Jd(Je(me));if(n[Dd])eval(n[Dd]);if(n[De])if(n[Dq])Gg.open(n[De]);else(n[Dl]&&!E?Gg.top[n[Dl]]:Gg).location=n[De];}};return me;}function Ic(n,Lm){var Ln=n==NL[0],Lo=Hk(n[Dv],(Ln?Gm:Gn)+Fo),m=Jv(),t=m.appendChild(Jw()).appendChild(Jx()).appendChild(Jz()).appendChild(Ky()).appendChild(Jv()),Lp=INF[Eb]==Cu,Lq;if(INF[Fb]&&Ln||INF[Fc]&&!Ln){Lq=Ju();Lq.Jb.appendChild(m);Kh(Lq,Lo,"",Lm);Lq.className=Lo;}else{Lq=m;(Gu?Lq:t.parentNode).className=Lo;}t.style.width=Fk;Lq.Iv=t.appendChild(Jw());if(Lp&&Ln)Lq.Ij=Lq.Iv.appendChild(Jx());if(!Ln){if(Gl.Ha)Gl.Ha.attachScroller(Ig(),Lq);Gt.Il[Gt.Il.length]=Lq;if(INF[Fh]&&Gu<7&&!/https:/.test(location.protocol)){Lq.Lr=Gh.createElement("iframe");Lq.Lr.style.position=Cs;Lq.Lr.style.zIndex=Gd;Jh(Lq.Lr);Gk.appendChild(Lq.Lr);}if(Gt.Ls=INF[Fi])Lt(Lq,INF[Fi]);Lq.Lu=INF[Ex];Lq.Lv=Lw(Lm,3,10);Lq.Lx=Lw(Lm,2,30);Lq.Ly=Lw(Lm,1,70);}Lq.Lz=A;if(n[Ea]&&!(Lp&&Ln)&&!(INF[Ec]&&Ln))m.style.width=n[Ea]+PX;if(INF[Fg]&&Lm&&INF[Eb]==Cu){Lq.Ih=Jk("img");Lq.Ih.Ma=Lq.Ih.className=Lo+"-patch"+Cq;if(INF[Fi])Lt(Lq.Ih,INF[Fi]);with(Lq.Ih.style){position=Cs;height="1px";}}return Lq;}function Lw(Lm,Mb,a){var x,n=[];x=Ju(Lm,n);x.Ma=9;with(x.style){background=INF[Ey];position=Cs;}if(!Ge)x.style.zIndex=Gd-Mb;Lt(x,a);return Ig().appendChild(x);}function Mc(Md,Me,Mf,w,h,Mg,Kt){with(Md.style){top=(Me+Mg)+PX;if(!Kt)Mg=-Mg;left=(Mf+Mg)+PX;width=w+PX;height=h+PX;}}function Lt(e,a){if(Gu)e.style.filter="alpha(opacity="+a+")";else e.style.opacity=a*.01;}function Jk(s){return Gh.createElement(s);}function Ky(){return Jk("div");}function Jz(){return Jk("td");}function Jx(){return Jk("tr");}function Jw(){return Jk("tbody");}function Jv(){var t=Jk("table");t.cellPadding=t.cellSpacing=0;return t;}function Ii(m,me){if(!m.Mh)m.Mh=me;else{var e=m.Mh;for(;e.Mi;e=e.Mi);e.Mi=me;}if(!m.Ie&&Gt.Im)m.Iv.firstChild.appendChild(Jz()).appendChild(me);else m.Iv.appendChild(Jx()).appendChild(Jz()).appendChild(me);}function Mj(e){if(e)return e.Lk?e:Mj(e.parentNode);}function Mk(e){if(e)return e.Iv?e:Mk(e.parentNode);}function Ml(me){var sm=me.Ib,Mm=sm.offsetHeight,m=me.Ia,Mn=m.offsetWidth,rm=Je(me),Kt=rm.Ja,Mo=Mp(),Mq=Mr(),Ms=Mt()+Mo,Mu=Mv()+Mq,Mw=!Gg._XM_SCROLL_OFF&&Gl.Ha,Mf=Mx(m,Fl)+(m.Ie?rm.Ip:rm.In),Me=m.Ie?rm.Iq:rm.Io,My=0,fi,Mz,Na,Nb;Gk=rm.parentNode;if(Gz)rm.Iz=Ik(Gk);Mz=rm.Iz==Ct;if(m.Ie)Me+=Mx(me,Fm)+Nc(m);else{if(m.Im){if(!me.n[Ea])(sm.Jb?sm.Jb.firstChild:sm).style.width=me.offsetParent.offsetWidth+PX;Me+=Mx(m,Fm)+m.offsetHeight;if(me!=m.Mh)Mf+=me.offsetParent.offsetParent.offsetParent.offsetLeft+me.offsetParent.offsetParent.offsetLeft+me.offsetParent.offsetLeft;}else Me+=Mx(me,Fm)+Nc(m);if(!Gu&&Mz){Mf+=Mq;Me+=Mo;}}Na=sm.offsetWidth;if(Gy&&(rm.Iz!=Cr||m.Ie)){Mf-=Gi.offsetLeft;Me-=Gi.offsetTop;}if(m.Im){if(Mf+Na>Mu){My=(Mf+Na)-Mu;Mf=Mu-Na;}}else{if(!Kt)Mf-=Na;else if(!m.Ie)Mf+=Mn;else if(Mf+Mn+Na>Mu-(Gu&&Mz?Mq:0)&&Mf-(Gu&&Mz?0:Mq)>Na)Mf-=Na+rm.Ip;else Mf+=Mn;}sm.style.zIndex=Gc+Gf++;if(Gu&&rm.Iz!=Cr)Mf-=Gk.offsetLeft;sm.style.left=Mf+PX;Mw=!Gg._XM_SCROLL_OFF&&Gl.Ha;if(Gu){if(Mw&&m.Im&&Mm-(Mz?0:Mo)>Mt()-Me){Me=Gl.Ha.makeScrollable(rm.Iz!=Cr?Gk.offsetTop:0,Mz?Mo:0,sm,Me,Ms,9);Nb=9;}else if(Mw&&Mm>Mt()){Me=Gl.Ha.makeScrollable(rm.Iz!=Cr?Gk.offsetTop:0,Mz?Mo:0,sm,Mz?0:Mo,Ms);Nb=9;}else if(!m.Im&&Me+Mm>Ms-(Mz?Mo:0))Me=Math.max(Mz?0:Mo,Ms-Mm-(Mz?Mo:0));}else{if(Mw&&m.Im&&Mm-Mo>Mt()-Me){Me=Gl.Ha.makeScrollable(0,0,sm,Me,Ms,9);Nb=9;}else if(Mw&&Mm>Mt()){Me=Gl.Ha.makeScrollable(0,0,sm,Mo,Ms);Nb=9;}else if(!m.Im&&Me+Mm>Ms)Me=Math.max(Mo,Ms-Mm);}if(Gu&&rm.Iz!=Cr)Me-=Gk.offsetTop;if(sm.Ih)with(sm.Ih.style){zIndex=Gc+Gf+1;width=(me.offsetWidth-2)+PX;left=(++Mf+My)+PX;top=Me+PX;}sm.style.top=Me+PX;if(sm.Lr){with(sm.Lr.style){top=sm.style.top;left=sm.style.left;width=Na+PX;height=(Nb?sm.btnDown.offsetTop-sm.btnUp.offsetTop:Mm)+PX;}Jh(sm.Lr,9);}if(!Nb&&sm.Lu){with(sm){Mc(Ly,Me,Mf,Na,Mm,Lu,Kt);Mc(Lx,Me,Mf,Na,Mm,Lu+1,Kt);Mc(Lv,Me,Mf,Na,Mm,Lu+2,Kt);}}if(fi){Ji(sm,9);fi.play();}}function Nd(x){x.style.left=x.style.top=Gb;}function If(m){if(m.Ne){m.Ne.Ll();m.Ne=0;}if(m.Ie){Nd(m);if(m.Ih)Nd(m.Ih);Nd(m.Ly);Nd(m.Lx);Nd(m.Lv);if(Gl.Ha)Gl.Ha.hide(m);if(m.Lr)Jh(m.Lr);if(Gf>Gc)--Gf;}}function Jd(rm){If(rm);for(var i=0;i<rm.Il.length;++i)If(rm.Il[i]);Go=0;Jg();}function Nf(m){If(m);var ks=m.Iv.childNodes;for(var i=0;i<ks.length;++i)if((m=ks[i].firstChild.firstChild.Ib)&&m.style.left!=Gb)Nf(m);}function Ng(me,f){me.Ll(f);if(f){if(me.Ib)Ml(me);Go=me.Ia.Ne=me;}else if(me.Ib)Nf(me.Ib);}function Je(me){var m=me.Ia;for(;m.Ie;m=m.Ie);return m;}function Jf(ev,Nh){var Ni=Go?Je(Go):0;if(!Nh){if(!ev)ev=Gg.event;Gp=Mj(ev[Fj]);if(Gl.Nj){if(!(Gp&&(Gp.Ia==Gq))){clearInterval(Gl.Nj);Gl.Nj=0;}else return;}else if(Gp&&!Gp.Ia.Ie&&!Go&&Gp.Ia.It){Gq=Gp.Ia;Gl.Nj=setInterval(function(){clearInterval(Gl.Nj);Gl.Nj=0;if(Gp&&(Gp.Ia==Gq)){Jf(ev,9);}},Gq.It);return;}}if(Gl.Nk){clearInterval(Gl.Nk);Gl.Nk=0;}if(Gl.X){if(Gp){if(Go){if(Gp!=Gp.Ia.Ne){if(Ni!=Je(Gp))Jd(Ni);else if(Gp.Ia.Ne)Ng(Gp.Ia.Ne);Ng(Gp,9);}else if(Gp.Ia.Ij&&Gp.Ib&&Gp.Ib.Ne){Gp.Ib.Ne.Ll();if(Gp.Ib.Ne.Ib)Nf(Gp.Ib.Ne.Ib);Gp.Ib.Ne=0;}else Jg(Gp.n);}else{if(Gp.Ia.Ne!=Gp)Ng(Gp,9);}}else if(Go&&!Mk(ev[Fj])){if(ev[Fj].Ma||/^xm-scroll/.test(ev[Fj].className))return;Gl.Nk=setInterval(function(){if(Go)Jd(Ni);clearInterval(Gl.Nk);Gl.Nk=0;},Go.Ia.Ie?Ni.Ir:Ni.Is);}}}function Mx(e,dir){return!e?0:e[Fn+dir]+Mx(e.offsetParent,dir);}function Nc(m){return Mx(m,Fm)-Mx(m.Mh,Fm);}function Mr(){return Gg.pageXOffset||Gj.scrollLeft||Gi.scrollLeft;}function Mp(){return Gg.pageYOffset||Gj.scrollTop||Gi.scrollTop;}function Mv(){return Gj.clientWidth||Gi.clientWidth;}function Mt(){var x;if(Gx)x=innerHeight;else if(Gv&&Gv<9.5)x=Gi.clientHeight;else x=Gh.compatMode&&Gh.compatMode!="BackCompat"?Gj.clientHeight:Gi.clientHeight;return x;}function dc(s){var t="",i=0,c;for(;i<s.length;++i){c=s.charAt(i);if(c>"`"&&c<"{")c=String.fromCharCode(97+"griyesbxpqojdknmuawhtvflcz".indexOf(c));else if(c=="@")c='"';t+=c;}return t;}this.loadData=function(Nl){function Nm(x){Gi.removeChild(x);}var Gk=Gh.getElementById(this.ipi),Gt=Gk.firstChild,i=0,ks,e;if(Gt){if(Gu)while(Gk.firstChild)Gk.removeChild(Gk.firstChild);else{Gk.removeChild(Gt);for(ks=Gt.Il;i<ks.length;++i){e=ks[i];Nm(e);if(e.btnUp)Nm(e.btnUp);if(e.btnDown)Nm(e.btnDown);}}}if(E){}else if(Nl){B=Nl;Hb();}};}