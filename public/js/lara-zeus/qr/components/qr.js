var ce=Object.create;var Y=Object.defineProperty;var le=Object.getOwnPropertyDescriptor;var se=Object.getOwnPropertyNames;var fe=Object.getPrototypeOf,he=Object.prototype.hasOwnProperty;var Z=(g,e)=>()=>(e||g((e={exports:{}}).exports,e),e.exports);var de=(g,e,P,w)=>{if(e&&typeof e=="object"||typeof e=="function")for(let v of se(e))!he.call(g,v)&&v!==P&&Y(g,v,{get:()=>e[v],enumerable:!(w=le(e,v))||w.enumerable});return g};var ee=(g,e,P)=>(P=g!=null?ce(fe(g)):{},de(e||!g||!g.__esModule?Y(P,"default",{value:g,enumerable:!0}):P,g));var ne=Z((te,$)=>{(function(g){"use strict";var e=oe(),P=ie(),w=ae(),v=ue(),V={imagePlaceholder:void 0,cacheBust:!1},A={toSvg:s,toPng:S,toJpeg:m,toBlob:b,toPixelData:f,impl:{fontFaces:w,images:v,util:e,inliner:P,options:{}}};typeof $<"u"?$.exports=A:g.domtoimage=A;function s(r,n){return n=n||{},G(n),Promise.resolve(r).then(function(a){return H(a,n.filter,!0)}).then(q).then(N).then(o).then(function(a){return I(a,n.width||e.width(r),n.height||e.height(r))});function o(a){return n.bgcolor&&(a.style.backgroundColor=n.bgcolor),n.width&&(a.style.width=n.width+"px"),n.height&&(a.style.height=n.height+"px"),n.style&&Object.keys(n.style).forEach(function(h){a.style[h]=n.style[h]}),a}}function f(r,n){return D(r,n||{}).then(function(o){return o.getContext("2d").getImageData(0,0,e.width(r),e.height(r)).data})}function S(r,n){return D(r,n||{}).then(function(o){return o.toDataURL()})}function m(r,n){return n=n||{},D(r,n).then(function(o){return o.toDataURL("image/jpeg",n.quality||1)})}function b(r,n){return D(r,n||{}).then(e.canvasToBlob)}function G(r){typeof r.imagePlaceholder>"u"?A.impl.options.imagePlaceholder=V.imagePlaceholder:A.impl.options.imagePlaceholder=r.imagePlaceholder,typeof r.cacheBust>"u"?A.impl.options.cacheBust=V.cacheBust:A.impl.options.cacheBust=r.cacheBust}function D(r,n){return s(r,n).then(e.makeImage).then(e.delay(100)).then(function(a){var h=o(r);return h.getContext("2d").drawImage(a,0,0),h});function o(a){var h=document.createElement("canvas");if(h.width=n.width||e.width(a),h.height=n.height||e.height(a),n.bgcolor){var l=h.getContext("2d");l.fillStyle=n.bgcolor,l.fillRect(0,0,h.width,h.height)}return h}}function H(r,n,o){if(!o&&n&&!n(r))return Promise.resolve();return Promise.resolve(r).then(a).then(function(i){return h(r,i,n)}).then(function(i){return l(r,i)});function a(i){return i instanceof HTMLCanvasElement?e.makeImage(i.toDataURL()):i.cloneNode(!1)}function h(i,u,T){var L=i.childNodes;if(L.length===0)return Promise.resolve(u);return y(u,e.asArray(L),T).then(function(){return u});function y(F,U,E){var R=Promise.resolve();return U.forEach(function(O){R=R.then(function(){return H(O,E)}).then(function(C){C&&F.appendChild(C)})}),R}}function l(i,u){if(!(u instanceof Element))return u;return Promise.resolve().then(T).then(L).then(y).then(F).then(function(){return u});function T(){U(window.getComputedStyle(i),u.style);function U(E,R){E.cssText?R.cssText=E.cssText:O(E,R);function O(C,j){e.asArray(C).forEach(function(t){j.setProperty(t,C.getPropertyValue(t),C.getPropertyPriority(t))})}}}function L(){[":before",":after"].forEach(function(E){U(E)});function U(E){var R=window.getComputedStyle(i,E),O=R.getPropertyValue("content");if(O===""||O==="none")return;var C=e.uid();u.className=u.className+" "+C;var j=document.createElement("style");j.appendChild(t(C,E,R)),u.appendChild(j);function t(c,p,d){var x="."+c+":"+p,B=d.cssText?_(d):W(d);return document.createTextNode(x+"{"+B+"}");function _(k){var M=k.getPropertyValue("content");return k.cssText+" content: "+M+";"}function W(k){return e.asArray(k).map(M).join("; ")+";";function M(X){return X+": "+k.getPropertyValue(X)+(k.getPropertyPriority(X)?" !important":"")}}}}}function y(){i instanceof HTMLTextAreaElement&&(u.innerHTML=i.value),i instanceof HTMLInputElement&&u.setAttribute("value",i.value)}function F(){u instanceof SVGElement&&(u.setAttribute("xmlns","http://www.w3.org/2000/svg"),u instanceof SVGRectElement&&["width","height"].forEach(function(U){var E=u.getAttribute(U);E&&u.style.setProperty(U,E)}))}}}function q(r){return w.resolveAll().then(function(n){var o=document.createElement("style");return r.appendChild(o),o.appendChild(document.createTextNode(n)),r})}function N(r){return v.inlineAll(r).then(function(){return r})}function I(r,n,o){return Promise.resolve(r).then(function(a){return a.setAttribute("xmlns","http://www.w3.org/1999/xhtml"),new XMLSerializer().serializeToString(a)}).then(e.escapeXhtml).then(function(a){return'<foreignObject x="0" y="0" width="100%" height="100%">'+a+"</foreignObject>"}).then(function(a){return'<svg xmlns="http://www.w3.org/2000/svg" width="'+n+'" height="'+o+'">'+a+"</svg>"}).then(function(a){return"data:image/svg+xml;charset=utf-8,"+a})}function oe(){return{escape:F,parseExtension:n,mimeType:o,dataAsUrl:y,isDataUrl:a,canvasToBlob:l,resolveUrl:i,getAndEncode:L,uid:u(),delay:U,asArray:E,escapeXhtml:R,makeImage:T,width:O,height:C};function r(){var t="application/font-woff",c="image/jpeg";return{woff:t,woff2:t,ttf:"application/font-truetype",eot:"application/vnd.ms-fontobject",png:"image/png",jpg:c,jpeg:c,gif:"image/gif",tiff:"image/tiff",svg:"image/svg+xml"}}function n(t){var c=/\.([^\.\/]*?)$/g.exec(t);return c?c[1]:""}function o(t){var c=n(t).toLowerCase();return r()[c]||""}function a(t){return t.search(/^(data:)/)!==-1}function h(t){return new Promise(function(c){for(var p=window.atob(t.toDataURL().split(",")[1]),d=p.length,x=new Uint8Array(d),B=0;B<d;B++)x[B]=p.charCodeAt(B);c(new Blob([x],{type:"image/png"}))})}function l(t){return t.toBlob?new Promise(function(c){t.toBlob(c)}):h(t)}function i(t,c){var p=document.implementation.createHTMLDocument(),d=p.createElement("base");p.head.appendChild(d);var x=p.createElement("a");return p.body.appendChild(x),d.href=c,x.href=t,x.href}function u(){var t=0;return function(){return"u"+c()+t++;function c(){return("0000"+(Math.random()*Math.pow(36,4)<<0).toString(36)).slice(-4)}}}function T(t){return new Promise(function(c,p){var d=new Image;d.onload=function(){c(d)},d.onerror=p,d.src=t})}function L(t){var c=3e4;return A.impl.options.cacheBust&&(t+=(/\?/.test(t)?"&":"?")+new Date().getTime()),new Promise(function(p){var d=new XMLHttpRequest;d.onreadystatechange=_,d.ontimeout=W,d.responseType="blob",d.timeout=c,d.open("GET",t,!0),d.send();var x;if(A.impl.options.imagePlaceholder){var B=A.impl.options.imagePlaceholder.split(/,/);B&&B[1]&&(x=B[1])}function _(){if(d.readyState===4){if(d.status!==200){x?p(x):k("cannot fetch resource: "+t+", status: "+d.status);return}var M=new FileReader;M.onloadend=function(){var X=M.result.split(/,/)[1];p(X)},M.readAsDataURL(d.response)}}function W(){x?p(x):k("timeout of "+c+"ms occured while fetching resource: "+t)}function k(M){console.error(M),p("")}})}function y(t,c){return"data:"+c+";base64,"+t}function F(t){return t.replace(/([.*+?^${}()|\[\]\/\\])/g,"\\$1")}function U(t){return function(c){return new Promise(function(p){setTimeout(function(){p(c)},t)})}}function E(t){for(var c=[],p=t.length,d=0;d<p;d++)c.push(t[d]);return c}function R(t){return t.replace(/#/g,"%23").replace(/\n/g,"%0A")}function O(t){var c=j(t,"border-left-width"),p=j(t,"border-right-width");return t.scrollWidth+c+p}function C(t){var c=j(t,"border-top-width"),p=j(t,"border-bottom-width");return t.scrollHeight+c+p}function j(t,c){var p=window.getComputedStyle(t).getPropertyValue(c);return parseFloat(p.replace("px",""))}}function ie(){var r=/url\(['"]?([^'"]+?)['"]?\)/g;return{inlineAll:h,shouldProcess:n,impl:{readUrls:o,inline:a}};function n(l){return l.search(r)!==-1}function o(l){for(var i=[],u;(u=r.exec(l))!==null;)i.push(u[1]);return i.filter(function(T){return!e.isDataUrl(T)})}function a(l,i,u,T){return Promise.resolve(i).then(function(y){return u?e.resolveUrl(y,u):y}).then(T||e.getAndEncode).then(function(y){return e.dataAsUrl(y,e.mimeType(i))}).then(function(y){return l.replace(L(i),"$1"+y+"$3")});function L(y){return new RegExp(`(url\\(['"]?)(`+e.escape(y)+`)(['"]?\\))`,"g")}}function h(l,i,u){if(T())return Promise.resolve(l);return Promise.resolve(l).then(o).then(function(L){var y=Promise.resolve(l);return L.forEach(function(F){y=y.then(function(U){return a(U,F,i,u)})}),y});function T(){return!n(l)}}}function ae(){return{resolveAll:r,impl:{readAll:n}};function r(){return n(document).then(function(o){return Promise.all(o.map(function(a){return a.resolve()}))}).then(function(o){return o.join(`
`)})}function n(){return Promise.resolve(e.asArray(document.styleSheets)).then(a).then(o).then(function(l){return l.map(h)});function o(l){return l.filter(function(i){return i.type===CSSRule.FONT_FACE_RULE}).filter(function(i){return P.shouldProcess(i.style.getPropertyValue("src"))})}function a(l){var i=[];return l.forEach(function(u){try{e.asArray(u.cssRules||[]).forEach(i.push.bind(i))}catch(T){console.log("Error while reading CSS rules from "+u.href,T.toString())}}),i}function h(l){return{resolve:function(){var u=(l.parentStyleSheet||{}).href;return P.inlineAll(l.cssText,u)},src:function(){return l.style.getPropertyValue("src")}}}}}function ue(){return{inlineAll:n,impl:{newImage:r}};function r(o){return{inline:a};function a(h){return e.isDataUrl(o.src)?Promise.resolve():Promise.resolve(o.src).then(h||e.getAndEncode).then(function(l){return e.dataAsUrl(l,e.mimeType(o.src))}).then(function(l){return new Promise(function(i,u){o.onload=i,o.onerror=u,o.src=l})})}}function n(o){if(!(o instanceof Element))return Promise.resolve(o);return a(o).then(function(){return o instanceof HTMLImageElement?r(o).inline():Promise.all(e.asArray(o.childNodes).map(function(h){return n(h)}))});function a(h){var l=h.style.getPropertyValue("background");return l?P.inlineAll(l).then(function(i){h.style.setProperty("background",i,h.style.getPropertyPriority("background"))}).then(function(){return h}):Promise.resolve(h)}}}})(te)});var re=Z((J,z)=>{(function(g,e){typeof define=="function"&&define.amd?define([],e):typeof J<"u"?e():(e(),g.FileSaver={})})(J,function(){"use strict";function g(s,f){return typeof f>"u"?f={autoBom:!1}:typeof f!="object"&&(console.warn("Deprecated: Expected third argument to be a object"),f={autoBom:!f}),f.autoBom&&/^\s*(?:text\/\S*|application\/xml|\S*\/\S*\+xml)\s*;.*charset\s*=\s*utf-8/i.test(s.type)?new Blob(["\uFEFF",s],{type:s.type}):s}function e(s,f,S){var m=new XMLHttpRequest;m.open("GET",s),m.responseType="blob",m.onload=function(){A(m.response,f,S)},m.onerror=function(){console.error("could not download file")},m.send()}function P(s){var f=new XMLHttpRequest;f.open("HEAD",s,!1);try{f.send()}catch{}return 200<=f.status&&299>=f.status}function w(s){try{s.dispatchEvent(new MouseEvent("click"))}catch{var f=document.createEvent("MouseEvents");f.initMouseEvent("click",!0,!0,window,0,0,0,80,20,!1,!1,!1,!1,0,null),s.dispatchEvent(f)}}var v=typeof window=="object"&&window.window===window?window:typeof self=="object"&&self.self===self?self:typeof global=="object"&&global.global===global?global:void 0,V=v.navigator&&/Macintosh/.test(navigator.userAgent)&&/AppleWebKit/.test(navigator.userAgent)&&!/Safari/.test(navigator.userAgent),A=v.saveAs||(typeof window!="object"||window!==v?function(){}:"download"in HTMLAnchorElement.prototype&&!V?function(s,f,S){var m=v.URL||v.webkitURL,b=document.createElement("a");f=f||s.name||"download",b.download=f,b.rel="noopener",typeof s=="string"?(b.href=s,b.origin===location.origin?w(b):P(b.href)?e(s,f,S):w(b,b.target="_blank")):(b.href=m.createObjectURL(s),setTimeout(function(){m.revokeObjectURL(b.href)},4e4),setTimeout(function(){w(b)},0))}:"msSaveOrOpenBlob"in navigator?function(s,f,S){if(f=f||s.name||"download",typeof s!="string")navigator.msSaveOrOpenBlob(g(s,S),f);else if(P(s))e(s,f,S);else{var m=document.createElement("a");m.href=s,m.target="_blank",setTimeout(function(){w(m)})}}:function(s,f,S,m){if(m=m||open("","_blank"),m&&(m.document.title=m.document.body.innerText="downloading..."),typeof s=="string")return e(s,f,S);var b=s.type==="application/octet-stream",G=/constructor/i.test(v.HTMLElement)||v.safari,D=/CriOS\/[\d]+/.test(navigator.userAgent);if((D||b&&G||V)&&typeof FileReader<"u"){var H=new FileReader;H.onloadend=function(){var I=H.result;I=D?I:I.replace(/^data:[^;]*;/,"data:attachment/file;"),m?m.location.href=I:location=I,m=null},H.readAsDataURL(s)}else{var q=v.URL||v.webkitURL,N=q.createObjectURL(s);m?m.location=N:location.href=N,m=null,setTimeout(function(){q.revokeObjectURL(N)},4e4)}});v.saveAs=A.saveAs=A,typeof z<"u"&&(z.exports=A)})});var K=ee(ne(),1),Q=ee(re(),1);function me({state:g}){return{state:g,init:function(){}}}window.download=function(g,e){var P=document.querySelector("."+g+" svg");e==="svg"?K.default.toSvg(P).then(function(w){(0,Q.saveAs)(w,g+".svg")}).catch(function(w){console.error("oops, something went wrong!",w)}):K.default.toPng(P).then(function(w){(0,Q.saveAs)(w,g+".png")}).catch(function(w){console.error("oops, something went wrong!",w)})};export{me as default};
