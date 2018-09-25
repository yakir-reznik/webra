// returns what view is currently active, returns string definitions are in sass/0-tools/1-mixins.sass
function getView(){
	if ($("#size_checker").css("float") == "right"){
		return "desktop";
	}else if ($("#size_checker").css("float") == "left"){
		return "tablet";
	}else if ($("#size_checker").css("float") == "none"){
		return "mobile";
	}
}

// Checks if current view is Desktop, returns true or false
function isDesktop(){
	if (getView() == "desktop"){
		return true;
	} else {
		return false;
	}
}

// Checks if current view is Tablet, returns true or false
function isTablet(){
	if (getView() == "tablet"){
		return true;
	} else {
		return false;
	}
}

// Checks if current view is Mobile, returns true or false
function isMobile(){
	if (getView() == "mobile"){
		return true;
	} else {
		return false;
	}
}

// Send Events to Google Analytics
function sendTag(c, a, l){
	if($('body').hasClass('dev')){
		console.log('------------------------');
		console.log('Category: ' + c);
		console.log('Action: ' + a);
		console.log('Label: ' + l);	
	} else {
		dataLayer.push({'Category': c,'Action': a, 'Label': l, 'event': 'auto_event'});
	}
}

function sendVirtualPageView(the_path, the_title){
	if($('body').hasClass('dev')){
		console.log('------------------------');
		console.log('Virtual PageView: ' + the_path);
		console.log('Virtual PageView: ' + the_title);
	} else {
		dataLayer.push({'virtual_page': the_path, 'event': 'virtual_page'});
	}
}

function isIE(){
	return !!navigator.userAgent.match(/Trident/g) || !!navigator.userAgent.match(/MSIE/g);
}

function isAndroid(){
	return !!navigator.userAgent.match(/Android/g) || !!navigator.userAgent.match(/Android/g);
}

function isFacebookInAppBrowser(){
	var ua = navigator.userAgent || navigator.vendor || window.opera;
	return (ua.indexOf("FBAN") > -1) || (ua.indexOf("FBAV") > -1);
}

function isInViewport(o) {
	//special bonus for those using jQuery
	if (typeof jQuery === "function" && o instanceof jQuery) {
		o = o[0];
	}

	var rect = o.getBoundingClientRect();

	return (
		rect.top >= 0 &&
		rect.left >= 0 &&
		rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) && /*or $(window).height() */
		rect.right <= (window.innerWidth || document.documentElement.clientWidth) /*or $(window).width() */
	);
}

function getURLParameter(name) {
  return decodeURIComponent((new RegExp('[?|&]' + name + '=' + '([^&;]+?)(&|#|;|$)').exec(location.search) || [null, ''])[1].replace(/\+/g, '%20')) || null;
}

function isEmail(email) {
	var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	return regex.test(email);
}

function getCookie(name) {
	var nameEQ = name + "=";
	var ca = document.cookie.split(';');
	for(var i=0;i < ca.length;i++) {
		var c = ca[i];
		while (c.charAt(0)==' ') c = c.substring(1,c.length);
		if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
	}
	return null;
}

function setCookie(key, value, hoursExpire) {
	var theDate = new Date();
	var expireTime = theDate.getTime() + (hoursExpire * 60 * 60 * 1000);
	theDate.setTime(expireTime);
	document.cookie = key + "=" + value + "; domain=.stingtv.co.il; path=/; expires=" + theDate.toGMTString();
}

function eraseCookie(name) {
	document.cookie =  name + '=; path=/; domain=.stingtv.co.il; expires=Thu, 01 Jan 1970 00:00:01 GMT;';
	location.reload();
}

//scrollTo external function | https://github.com/flesler/jquery.scrollTo
;(function(f){"use strict";"function"===typeof define&&define.amd?define(["jquery"],f):"undefined"!==typeof module&&module.exports?module.exports=f(require("jquery")):f(jQuery)})(function($){"use strict";function n(a){return!a.nodeName||-1!==$.inArray(a.nodeName.toLowerCase(),["iframe","#document","html","body"])}function h(a){return $.isFunction(a)||$.isPlainObject(a)?a:{top:a,left:a}}var p=$.scrollTo=function(a,d,b){return $(window).scrollTo(a,d,b)};p.defaults={axis:"xy",duration:0,limit:!0};$.fn.scrollTo=function(a,d,b){"object"=== typeof d&&(b=d,d=0);"function"===typeof b&&(b={onAfter:b});"max"===a&&(a=9E9);b=$.extend({},p.defaults,b);d=d||b.duration;var u=b.queue&&1<b.axis.length;u&&(d/=2);b.offset=h(b.offset);b.over=h(b.over);return this.each(function(){function k(a){var k=$.extend({},b,{queue:!0,duration:d,complete:a&&function(){a.call(q,e,b)}});r.animate(f,k)}if(null!==a){var l=n(this),q=l?this.contentWindow||window:this,r=$(q),e=a,f={},t;switch(typeof e){case "number":case "string":if(/^([+-]=?)?\d+(\.\d+)?(px|%)?$/.test(e)){e= h(e);break}e=l?$(e):$(e,q);case "object":if(e.length===0)return;if(e.is||e.style)t=(e=$(e)).offset()}var v=$.isFunction(b.offset)&&b.offset(q,e)||b.offset;$.each(b.axis.split(""),function(a,c){var d="x"===c?"Left":"Top",m=d.toLowerCase(),g="scroll"+d,h=r[g](),n=p.max(q,c);t?(f[g]=t[m]+(l?0:h-r.offset()[m]),b.margin&&(f[g]-=parseInt(e.css("margin"+d),10)||0,f[g]-=parseInt(e.css("border"+d+"Width"),10)||0),f[g]+=v[m]||0,b.over[m]&&(f[g]+=e["x"===c?"width":"height"]()*b.over[m])):(d=e[m],f[g]=d.slice&& "%"===d.slice(-1)?parseFloat(d)/100*n:d);b.limit&&/^\d+$/.test(f[g])&&(f[g]=0>=f[g]?0:Math.min(f[g],n));!a&&1<b.axis.length&&(h===f[g]?f={}:u&&(k(b.onAfterFirst),f={}))});k(b.onAfter)}})};p.max=function(a,d){var b="x"===d?"Width":"Height",h="scroll"+b;if(!n(a))return a[h]-$(a)[b.toLowerCase()]();var b="client"+b,k=a.ownerDocument||a.document,l=k.documentElement,k=k.body;return Math.max(l[h],k[h])-Math.min(l[b],k[b])};$.Tween.propHooks.scrollLeft=$.Tween.propHooks.scrollTop={get:function(a){return $(a.elem)[a.prop]()}, set:function(a){var d=this.get(a);if(a.options.interrupt&&a._last&&a._last!==d)return $(a.elem).stop();var b=Math.round(a.now);d!==b&&($(a.elem)[a.prop](b),a._last=this.get(a))}};return p});

// Extend jQuery - add trunc function coded by Yakir Reznik
$.fn.trunc = function(){
	this.each(function(){
		var height = parseInt($(this).css("height"));
		var max_height = parseInt($(this).css("max-height"));
		if ($.isNumeric(max_height)){
			height = max_height;
		} 
		$(this).attr('title', $(this).text());
		while (this.scrollHeight > height) {
			lastWordIndex =  $(this).html().lastIndexOf(" ");
			$(this).html( $(this).html().substring(0, lastWordIndex) + '...' );
		}
	});
}

$.fn.clickAndEnter = function(f){
	this.each(function(){
		console.log($(this));
		$(this).click(f);
		$(this).keyup(function(e){
			e.keyCode == 32 ? $(this).click() : false;
		});	
	});
}