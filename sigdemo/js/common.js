// JavaScript Document

if($.browser.msie && parseInt($.browser.version) == 6){
	document.write('<script type="text/javascript" src="/js/DD_belatedPNG_0.0.8a.js" charset="utf-8"></script>');
}


$(function () {
	jQuery.curCSS = jQuery.css;

	if($.browser.msie && parseInt($.browser.version) == 6){
		DD_belatedPNG.fix('img, .png_bg, #pagetop'); //ie6 Script for transparent png
	}

	/*	Scroll to Page TOP  */
	$('a.scroll').click(scroll_func);


});


/* Scroll to Page TOP */
var scroll_func = function () {
	$('html,body').animate({ scrollTop: $($(this).attr("href")).offset().top }, 'slow','swing');
	return false;
}
/* /Scroll to Page TOP */
