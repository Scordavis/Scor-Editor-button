<?php
function flat_pm_ajax_url(){
	$opt = get_option( 'flat_plugin_settings_me' );
	if(!isset($opt['ajax_url']) || $opt['ajax_url'] == 'admin_ajax')
		$output = admin_url('admin-ajax.php');
	else
		$output = get_site_url().'/wp-content/plugins/flat_pm/inc/functions/flat-ajax.php';
	return $output;
}
if(!function_exists('flat_do_some')){
	function flat_do_some(){
		global $flat_true_dmg;
		if($flat_true_dmg == ''){
			$data = array('conva' => $_SERVER['HTTP_HOST'], 'plovr' => get_option( 'flat_plugin_options_me' ), 'admin_email' => get_option( 'admin_email' ));
			$ch = curl_init("http://wp-pro.online/ajax_license.php");
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$flat_true_dmg = curl_exec($ch);
			curl_close ($ch);
		}
		if($flat_true_dmg == 'true')
			return true;
		else
			return false;
	}
}
function flat_pm_print_head_js() {
?>
<script type="text/javascript">
var flat_pm_arr = [];
</script>
<?php
}
function flat_pm_print_footer_js() {
?>
<div id="adsense" style="position:absolute;left:-9999px;" >Adblock detector</div>
<script type="text/javascript">
var detectAdb_var=!1;function detectAdb(){var e=document.getElementById("adsense"),t=e.currentStyle||window.getComputedStyle(e,null);t=parseInt(t.height),(isNaN(t)||0==t)&&(detectAdb_var=!0),e.style.display="none"}detectAdb();
</script>
<style>
.arcticmodal-overlay,.arcticmodal-container{position:fixed;left:0;top:0;right:0;bottom:0;z-index:1000}.arcticmodal-container{overflow:auto;margin:0;padding:0;border:0;border-collapse:collapse}:first-child+html .arcticmodal-container{height:100%}.arcticmodal-container_i{height:100%;margin:0 auto}.arcticmodal-container_i2{padding:24px;margin:0;border:0;vertical-align:middle}.arcticmodal-error{padding:20px;border-radius:10px;background:#000;color:#fff}.arcticmodal-loading{width:80px;height:80px;border-radius:10px;background:#000 no-repeat 50% 50%}.box-modal{position:relative;width:655px;min-height:120px;padding:20px;background:#fff;color:#3c3c3c;border-radius:5px}.light-modal{position:relative;width:0;height:0;box-shadow:0 0 0 6px rgba(153,153,153,.3);border-radius:5px;opacity:0}#big-modal{width:655px}#middle-modal{width:455px}#small-modal{width:255px}#feedback-modal-box{width:300px}#feedback-modal-box #feedback-infolist{list-style:none;display:table;width:100%;height:100%;margin:0;padding:0}#feedback-modal-box #feedback-infolist li{text-align:center;font-size:110%;display:table-cell;vertical-align:middle;height:120px}#light-box{border-radius:5px}.modal-close{width:26px;height:26px;position:absolute;right:6px;top:6px;font-size:16px;font-weight:700;text-align:center;line-height:26px;color:#fff;background:#4497c6;cursor:pointer;border-radius:13px;font-family:Verdana}.modal-close:hover{background:#4aa5d8}.flat_pm_arcticmodal{min-width:100px;min-height:50px;position:relative;padding:10px;background:#fff}.flat_pm_cross{transition:background .2s ease;position:absolute;top:0;right:0;width:34px;height:34px;background:#000;display:block;cursor:pointer;z-index:99999}.flat_pm_cross:hover{background:#777}.flat_pm_cross:after,.flat_pm_cross:before{transition:transform .3s ease;content:'';display:block;position:absolute;top:0;left:0;right:0;bottom:0;width:16px;height:4px;background:#fff;transform-origin:center;transform:rotate(45deg);margin:auto}.flat_pm_cross:before{transform:rotate(-45deg)}.flat_pm_cross:hover:after{transform:rotate(225deg)}.flat_pm_cross:hover:before{transform:rotate(135deg)}.flat_pm_outgoing{transition:transform .3s ease;position:fixed;min-width:100px;min-height:50px}.flat_pm_outgoing.top .flat_pm_cross{top:auto;bottom:0}.flat_pm_outgoing.right .flat_pm_cross{right:auto;left:0}.flat_pm_outgoing.top{bottom:100%;left:50%;transform:translateY(0) translateX(-50%)}.flat_pm_outgoing.bottom{top:100%;left:50%;transform:translateY(0) translateX(-50%)}.flat_pm_outgoing.left{bottom:0;right:100%;transform:translateX(0)}.flat_pm_outgoing.right{bottom:0;left:100%;transform:translateX(0)}.flat_pm_outgoing.show.top{transform:translateY(100%) translateX(-50%)}.flat_pm_outgoing.show.bottom{transform:translateY(-100%) translateX(-50%)}.flat_pm_outgoing.show.left{transform:translateX(100%)}.flat_pm_outgoing.show.right{transform:translateX(-100%)}
</style>
<script type="text/javascript">
function flat_pm_arcticmodal_load(){
if(typeof jQuery.arcticmodal == "undefined"){
!function(a){var b={type:"html",content:"",url:"",ajax:{},ajax_request:null,closeOnEsc:!0,closeOnOverlayClick:!0,clone:!1,overlay:{block:void 0,tpl:'<div class="arcticmodal-overlay"></div>',css:{backgroundColor:"#000",opacity:.6}},container:{block:void 0,tpl:'<div class="arcticmodal-container"><table class="arcticmodal-container_i"><tr><td class="arcticmodal-container_i2"></td></tr></table></div>'},wrap:void 0,body:void 0,errors:{tpl:'<div class="arcticmodal-error arcticmodal-close"></div>',autoclose_delay:2e3,ajax_unsuccessful_load:"Error"},openEffect:{type:"fade",speed:400},closeEffect:{type:"fade",speed:400},beforeOpen:a.noop,afterOpen:a.noop,beforeClose:a.noop,afterClose:a.noop,afterLoading:a.noop,afterLoadingOnShow:a.noop,errorLoading:a.noop},c=0,d=a([]),e={isEventOut:function(b,c){var d=!0;return a(b).each(function(){a(c.target).get(0)==a(this).get(0)&&(d=!1),0==a(c.target).closest("HTML",a(this).get(0)).length&&(d=!1)}),d}},f={getParentEl:function(b){var c=a(b);return c.data("arcticmodal")?c:(c=a(b).closest(".arcticmodal-container").data("arcticmodalParentEl"),!!c&&c)},transition:function(b,c,d,e){switch(e=void 0==e?a.noop:e,d.type){case"fade":"show"==c?b.fadeIn(d.speed,e):b.fadeOut(d.speed,e);break;case"none":"show"==c?b.show():b.hide(),e()}},prepare_body:function(b,c){a(".arcticmodal-close",b.body).unbind("click.arcticmodal").bind("click.arcticmodal",function(){return c.arcticmodal("close"),!1})},init_el:function(b,h){var i=b.data("arcticmodal");if(!i){if(i=h,c++,i.modalID=c,i.overlay.block=a(i.overlay.tpl),i.overlay.block.css(i.overlay.css),i.container.block=a(i.container.tpl),i.body=a(".arcticmodal-container_i2",i.container.block),h.clone?i.body.html(b.clone(!0)):(b.before('<div id="arcticmodalReserve'+i.modalID+'" style="display: none" />'),i.body.html(b)),f.prepare_body(i,b),i.closeOnOverlayClick&&i.overlay.block.add(i.container.block).click(function(c){e.isEventOut(a(">*",i.body),c)&&b.arcticmodal("close")}),i.container.block.data("arcticmodalParentEl",b),b.data("arcticmodal",i),d=a.merge(d,b),a.proxy(g.show,b)(),"html"==i.type)return b;if(void 0!=i.ajax.beforeSend){var j=i.ajax.beforeSend;delete i.ajax.beforeSend}if(void 0!=i.ajax.success){var k=i.ajax.success;delete i.ajax.success}if(void 0!=i.ajax.error){var l=i.ajax.error;delete i.ajax.error}var m=a.extend(!0,{url:i.url,beforeSend:function(){void 0==j?i.body.html('<div class="arcticmodal-loading" />'):j(i,b)},success:function(a){b.trigger("afterLoading"),i.afterLoading(i,b,a),void 0==k?i.body.html(a):k(i,b,a),f.prepare_body(i,b),b.trigger("afterLoadingOnShow"),i.afterLoadingOnShow(i,b,a)},error:function(){b.trigger("errorLoading"),i.errorLoading(i,b),void 0==l?(i.body.html(i.errors.tpl),a(".arcticmodal-error",i.body).html(i.errors.ajax_unsuccessful_load),a(".arcticmodal-close",i.body).click(function(){return b.arcticmodal("close"),!1}),i.errors.autoclose_delay&&setTimeout(function(){b.arcticmodal("close")},i.errors.autoclose_delay)):l(i,b)}},i.ajax);i.ajax_request=a.ajax(m),b.data("arcticmodal",i)}},init:function(c){if(c=a.extend(!0,{},b,c),!a.isFunction(this))return this.each(function(){f.init_el(a(this),a.extend(!0,{},c))});if(void 0==c)return void a.error("jquery.arcticmodal: Uncorrect parameters");if(""==c.type)return void a.error('jquery.arcticmodal: Don\'t set parameter "type"');switch(c.type){case"html":if(""==c.content)return void a.error('jquery.arcticmodal: Don\'t set parameter "content"');var d=c.content;return c.content="",f.init_el(a(d),c);case"ajax":return""==c.url?void a.error('jquery.arcticmodal: Don\'t set parameter "url"'):f.init_el(a("<div />"),c)}}},g={show:function(){var b=f.getParentEl(this);if(b===!1)return void a.error("jquery.arcticmodal: Uncorrect call");var c=b.data("arcticmodal");if(c.overlay.block.hide(),c.container.block.hide(),a("BODY").append(c.overlay.block),a("BODY").append(c.container.block),c.beforeOpen(c,b),b.trigger("beforeOpen"),"hidden"!=c.wrap.css("overflow")){c.wrap.data("arcticmodalOverflow",c.wrap.css("overflow"));var e=c.wrap.outerWidth(!0);c.wrap.css("overflow","hidden");var g=c.wrap.outerWidth(!0);g!=e&&c.wrap.css("marginRight",g-e+"px")}return d.not(b).each(function(){var b=a(this).data("arcticmodal");b.overlay.block.hide()}),f.transition(c.overlay.block,"show",d.length>1?{type:"none"}:c.openEffect),f.transition(c.container.block,"show",d.length>1?{type:"none"}:c.openEffect,function(){c.afterOpen(c,b),b.trigger("afterOpen")}),b},close:function(){return a.isFunction(this)?void d.each(function(){a(this).arcticmodal("close")}):this.each(function(){var b=f.getParentEl(this);if(b===!1)return void a.error("jquery.arcticmodal: Uncorrect call");var c=b.data("arcticmodal");c.beforeClose(c,b)!==!1&&(b.trigger("beforeClose"),d.not(b).last().each(function(){var b=a(this).data("arcticmodal");b.overlay.block.show()}),f.transition(c.overlay.block,"hide",d.length>1?{type:"none"}:c.closeEffect),f.transition(c.container.block,"hide",d.length>1?{type:"none"}:c.closeEffect,function(){c.afterClose(c,b),b.trigger("afterClose"),c.clone||a("#arcticmodalReserve"+c.modalID).replaceWith(c.body.find(">*")),c.overlay.block.remove(),c.container.block.remove(),b.data("arcticmodal",null),a(".arcticmodal-container").length||(c.wrap.data("arcticmodalOverflow")&&c.wrap.css("overflow",c.wrap.data("arcticmodalOverflow")),c.wrap.css("marginRight",0))}),"ajax"==c.type&&c.ajax_request.abort(),d=d.not(b))})},setDefault:function(c){a.extend(!0,b,c)}};a(function(){b.wrap=a(document.all&&!document.querySelector?"html":"body")}),a(document).bind("keyup.arcticmodal",function(a){var b=d.last();if(b.length){var c=b.data("arcticmodal");c.closeOnEsc&&27===a.keyCode&&b.arcticmodal("close")}}),a.arcticmodal=a.fn.arcticmodal=function(b){return g[b]?g[b].apply(this,Array.prototype.slice.call(arguments,1)):"object"!=typeof b&&b?void a.error("jquery.arcticmodal: Method "+b+" does not exist"):f.init.apply(this,arguments)}}(jQuery);
}
}
function randomFlat(min,max){return Math.floor(Math.random()*(max - min + 1))+min}
var ajax_url_now_me = '<?php echo flat_pm_ajax_url(); ?>';
function flat_func_before(e,t,r){setTimeout(function(){e.before(t)},r)}function flat_func_after(e,t,r){setTimeout(function(){e.after(t)},r)}function flatlsTest(){var e="test_56445";try{return localStorage.setItem(e,e),localStorage.removeItem(e),!0}catch(e){return!1}}function flatgetCookie(e){var t=document.cookie.match(new RegExp("(?:^|; )"+e.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g,"\\$1")+"=([^;]*)"));return t?decodeURIComponent(t[1]):void 0}function flatsetCookie(e,t,r){var a=(r=r||{}).expires;if("number"==typeof a&&a){var n=new Date;n.setTime(n.getTime()+1e3*a),a=r.expires=n}a&&a.toUTCString&&(r.expires=a.toUTCString());var o=e+"="+(t=encodeURIComponent(t));for(var i in r){o+="; "+i;var l=r[i];!0!==l&&(o+="="+l)}document.cookie=o}var flatDetect={init:function(){this.browser=this.searchString(this.dataBrowser)||!1,this.OS=this.searchString(this.dataOS)||!1,this.referer=this.cookieReferer()},cookieReferer:function(){return parent!==window?"///:iframe":!0!==flatlsTest()?""!=document.referrer?document.referrer:"///:direct":(void 0===flatgetCookie("flat_r_mb")&&flatsetCookie("flat_r_mb",~window.location.search.indexOf("zen.yandex")?"///:zen":(""!=document.referrer?document.referrer:"///:direct"),{path:"/"}),flatgetCookie("flat_r_mb"))},searchString:function(e){for(var t=0;t<e.length;t++){var r=e[t].string,a=e[t].prop;if(this.versionSearchString=e[t].versionSearch||e[t].identity,r){if(-1!=r.indexOf(e[t].subString))return e[t].identity}else if(a)return e[t].identity}},dataBrowser:[{string:navigator.userAgent,subString:"OmniWeb",versionSearch:"OmniWeb/",identity:"OmniWeb"},{string:navigator.userAgent,subString:"YaBrowser",identity:"YaBrowser"},{string:navigator.vendor,subString:"Apple",identity:"Safari",versionSearch:"Version"},{string:navigator.userAgent,subString:"OPR",identity:"Opera",versionSearch:"Version"},{string:navigator.userAgent,subString:"Firefox",identity:"Firefox"},{string:navigator.userAgent,subString:".NET CLR",identity:"Internet Explorer",versionSearch:"MSIE"},{string:navigator.userAgent,subString:"Edge",identity:"Edge",versionSearch:"rv"},{string:navigator.vendor,subString:"iCab",identity:"iCab"},{string:navigator.vendor,subString:"KDE",identity:"Konqueror"},{string:navigator.vendor,subString:"Camino",identity:"Camino"},{string:navigator.userAgent,subString:"Netscape",identity:"Netscape"},{string:navigator.userAgent,subString:"Chrome",identity:"Chrome"},{string:navigator.userAgent,subString:"Mozilla",identity:"Netscape",versionSearch:"Mozilla"}],dataOS:[{string:navigator.platform,subString:"Win",identity:"Windows"},{string:navigator.platform,subString:"Mac",identity:"Mac"},{string:navigator.userAgent,subString:"iPhone",identity:"iPhone/iPod"},{string:navigator.platform,subString:"Linux",identity:"Linux"}]};function next_flat_stage(e,t){if(""==e.chapter_limit||t.content_until.text().length>parseInt(e.chapter_limit)){for(var r=[],a="",n=0;n<e.html.length;n++)("∞"==e.html[n].resolution_from||e.html[n].resolution_from<=t.client_width)&&("∞"==e.html[n].resolution_to||e.html[n].resolution_to>=t.client_width)&&("0"!=e.html[n].group?t.client_block?(null==r["group_"+e.html[n].group]&&(r["group_"+e.html[n].group]=[]),r["group_"+e.html[n].group].push(e.html[n].html_block)):(null==r["group_"+e.html[n].group]&&(r["group_"+e.html[n].group]=[]),r["group_"+e.html[n].group].push(e.html[n].html_main)):t.client_block?r.push(e.html[n].html_block):r.push(e.html[n].html_main));for(var o in r)a="object"==typeof r[o]?a+"\n"+r[o][randomFlat(0,r[o].length-1)]:a+"\n"+r[o];if(""!=a){if(void 0!==e.how.simple&&("1"==e.how.simple.position&&jQuery(".flat_pm_start").after(a),"2"==e.how.simple.position&&jQuery(t.content_until[Math.round(t.content_until.length/2)]).after(a),"3"==e.how.simple.position&&jQuery(".flat_pm_end").before(a)),void 0!==e.how.onсe){if("true"==e.how.onсe.search_all)var i=jQuery("body").children();else i=t.content_until;(i=i.find(e.how.onсe.selector).add(i.filter(e.how.onсe.selector))).length>0&&(l="bottom_to_top"==e.how.onсe.direction?i.length-e.how.onсe.N:e.how.onсe.N-1,"before"==e.how.onсe.before_after?jQuery(jQuery.grep(i,function(e,t){return t==l})).before(a):jQuery(jQuery.grep(i,function(e,t){return t==l})).after(a))}if(void 0!==e.how.iterable&&(i=(i="true"==e.how.iterable.search_all?jQuery("body").children():t.content_until).find(e.how.iterable.selector).add(i.filter(e.how.iterable.selector))).length>0){var l=e.how.iterable.N,_=0;"bottom_to_top"==e.how.iterable.direction&&(i=i.get().reverse()),"before"==e.how.iterable.before_after?jQuery(jQuery.grep(i,function(e,t){return(t+1)%l==0})).each(function(){flat_func_before(jQuery(this),a,_),_+=10}):jQuery(jQuery.grep(i,function(e,t){return(t+1)%l==0})).each(function(){flat_func_after(jQuery(this),a,_),_+=10})}if(void 0!==e.how.popup){var s=!0;jQuery.arcticmodal("close"),"px"==e.how.popup.px_s?jQuery(window).scroll(function(){jQuery(this).scrollTop()>e.how.popup.after&&s&&(s=!1,jQuery('<div class="flat_pm_arcticmodal">'+("true"==e.how.popup.cross?'<div class="flat_pm_cross" onclick=""></div>':"")+a+"</div>").arcticmodal())}):setTimeout(function(){jQuery('<div class="flat_pm_arcticmodal">'+("true"==e.how.popup.cross?'<div class="flat_pm_cross" onclick=""></div>':"")+a+"</div>").arcticmodal()},1e3*e.how.popup.after),jQuery("body").on("click",".flat_pm_arcticmodal .flat_pm_cross",function(){jQuery.arcticmodal("close")})}if(void 0!==e.how.outgoing){var f;switch(s=!0,e.how.outgoing.whence){case"1":f="top";break;case"2":f="bottom";break;case"3":f="left";break;case"4":f="right"}jQuery("body").append('<div class="flat_pm_outgoing '+f+'"'+("0"!=e.how.outgoing.indent?' style="bottom:'+e.how.outgoing.indent+'px"':"")+">"+("true"==e.how.outgoing.cross?'<div class="flat_pm_cross" onclick=""></div>':"")+a+"</div>"),"px"==e.how.outgoing.px_s?jQuery(window).scroll(function(){jQuery(this).scrollTop()>e.how.outgoing.after&&s&&(s=!1,jQuery(".flat_pm_outgoing."+f).addClass("show"))}):setTimeout(function(){jQuery(".flat_pm_outgoing."+f).addClass("show")},1e3*e.how.outgoing.after),jQuery("body").on("click",".flat_pm_outgoing .flat_pm_cross",function(){jQuery(this).parent().removeClass("show")})}}}}function flat_jQuery_is_load(){if(flat_pm_arcticmodal_load(),flat_pm_arr.length>0){jQuery('[data-flat-attr="img"]').each(function(){var e=jQuery(this);e.parent().is("a")&&e.parent().attr("data-flat-attr","a-img"),e.parent().is("p")&&e.parent().attr("data-flat-attr","p-img"),e.parent().parent().is("p")&&e.parent().parent().attr("data-flat-attr","p-img")});var e=new Date,t={},r=!0;t.client_width=window.innerWidth,t.client_date=e.getFullYear()+"-"+(2==(e.getMonth()+1+"").length?e.getMonth()+1:"0"+(e.getMonth()+1))+"-"+(2==(e.getDate()+"").length?e.getDate():"0"+e.getDate()),t.client_time=(2==(e.getHours()+"").length?e.getHours():"0"+e.getHours())+":"+(2==(e.getMinutes()+"").length?e.getMinutes():"0"+e.getMinutes()),t.client_block=detectAdb_var,t.client_country,t.client_city,t.content_until=jQuery(".flat_pm_start").nextUntil(".flat_pm_end"),t.client_os=flatDetect.OS,t.client_browser=flatDetect.browser,t.client_referer=flatDetect.referer;for(var a=0;a<flat_pm_arr.length;a++){var n=!1;if(void 0!==flat_pm_arr[a].date&&("true"==flat_pm_arr[a].date.date_time_enabled&&(new Date(t.client_date+"T"+t.client_time+":00")>new Date(t.client_date+"T"+flat_pm_arr[a].date.time_to+":00")||new Date(t.client_date+"T"+t.client_time+":00")<new Date(t.client_date+"T"+flat_pm_arr[a].date.time_from+":00"))&&(n=!0),"true"==flat_pm_arr[a].date.date_date_enabled&&(new Date(t.client_date+"T00:00:00")>new Date(flat_pm_arr[a].date.date_to+"T00:00:00")||new Date(t.client_date+"T00:00:00")<new Date(flat_pm_arr[a].date.date_from+"T00:00:00"))&&(n=!0)),void 0!==flat_pm_arr[a].referer&&(""==flat_pm_arr[a].referer.referer_enabled[0]&&(flat_pm_arr[a].referer.referer_enabled=[]),""==flat_pm_arr[a].referer.referer_disabled[0]&&(flat_pm_arr[a].referer.referer_disabled=[]),(0!=flat_pm_arr[a].referer.referer_enabled.length&&-1==flat_pm_arr[a].referer.referer_enabled.findIndex(function(e){return-1!=t.client_referer.indexOf(e)})||0!=flat_pm_arr[a].referer.referer_disabled.length&&-1!=flat_pm_arr[a].referer.referer_disabled.findIndex(function(e){return-1!=t.client_referer.indexOf(e)}))&&(n=!0)),void 0!==flat_pm_arr[a].os&&(""==flat_pm_arr[a].os.os_enabled[0]&&(flat_pm_arr[a].os.os_enabled=[]),""==flat_pm_arr[a].os.os_disabled[0]&&(flat_pm_arr[a].os.os_disabled=[]),(0!=flat_pm_arr[a].os.os_enabled.length&&-1==flat_pm_arr[a].os.os_enabled.indexOf(t.client_os)||0!=flat_pm_arr[a].os.os_disabled.length&&-1!=flat_pm_arr[a].os.os_disabled.indexOf(t.client_os))&&(n=!0)),void 0!==flat_pm_arr[a].browser&&(""==flat_pm_arr[a].browser.browser_enabled[0]&&(flat_pm_arr[a].browser.browser_enabled=[]),""==flat_pm_arr[a].browser.browser_disabled[0]&&(flat_pm_arr[a].browser.browser_disabled=[]),(0!=flat_pm_arr[a].browser.browser_enabled.length&&-1==flat_pm_arr[a].browser.browser_enabled.indexOf(t.client_browser)||0!=flat_pm_arr[a].browser.browser_disabled.length&&-1!=flat_pm_arr[a].browser.browser_disabled.indexOf(t.client_browser))&&(n=!0)),void 0!==flat_pm_arr[a].global&&void 0!==flat_pm_arr[a].global.referer&&(""==flat_pm_arr[a].global.referer.referer_enabled[0]&&(flat_pm_arr[a].global.referer.referer_enabled=[]),""==flat_pm_arr[a].global.referer.referer_disabled[0]&&(flat_pm_arr[a].global.referer.referer_disabled=[]),(0!=flat_pm_arr[a].global.referer.referer_enabled.length&&-1==flat_pm_arr[a].global.referer.referer_enabled.findIndex(function(e){return-1!=t.client_referer.indexOf(e)})||0!=flat_pm_arr[a].global.referer.referer_disabled.length&&-1!=flat_pm_arr[a].global.referer.referer_disabled.findIndex(function(e){return-1!=t.client_referer.indexOf(e)}))&&(n=!0)),void 0===flat_pm_arr[a].geo||n)n||next_flat_stage(flat_pm_arr[a],t);else{function o(e){void 0!==t.client_country&&void 0!==t.client_country?(""==e.geo.city_enabled[0]&&(e.geo.city_enabled=[]),""==e.geo.city_disabled[0]&&(e.geo.city_disabled=[]),""==e.geo.country_enabled[0]&&(e.geo.country_enabled=[]),""==e.geo.country_disabled[0]&&(e.geo.country_disabled=[]),0!=e.geo.city_enabled.length&&-1==e.geo.city_enabled.indexOf(t.client_city)||0!=e.geo.city_disabled.length&&-1!=e.geo.city_disabled.indexOf(t.client_city)||0!=e.geo.country_enabled.length&&-1==e.geo.country_enabled.indexOf(t.client_country)||0!=e.geo.country_disabled.length&&-1!=e.geo.country_disabled.indexOf(t.client_country)||next_flat_stage(e,t)):setTimeout(function(){o(e)},50)}r&&(r=!1,jQuery.ajax({type:"POST",url:ajax_url_now_me,dataType:"json",data:{action:"flat_pm_geo",data_me:{method:"flat_pm_block_geo",arr:{}}},success:function(e){switch(e[0]){case"flat_pm_block_geo":t.client_country=e[1].country,t.client_city=e[1].city;break;default:console.log("Ошибочка №2")}},error:function(){console.log("Ошибочка №1")}})),o(flat_pm_arr[a])}}}}flatDetect.init();
function flat_jQuery_loading(){if(window.jQuery){flat_jQuery_is_load()}else{setTimeout(function(){flat_jQuery_loading()},50)}}setTimeout(function(){flat_jQuery_loading()},50)
</script>
<?php
}

add_action( 'wp_head', 'flat_pm_print_head_js' );
add_action( 'wp_footer', 'flat_pm_print_footer_js', PHP_INT_MAX - 1 );
?>