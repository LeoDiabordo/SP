$(document).ready(function(){
	if(window.home){
		resizeFunc();
	}
});
$(window).resize(function(){
	if(window.home){
		resizeFunc();
	}
});
var resizeFunc = function(){
	var $wrapper = $('.fb-wrapper');
	var $iframe = $wrapper.find('iframe');
	var height = $wrapper.height();
	$iframe.attr('src',$iframe.attr('src').replace(/height=[0-9]+/gi,'height='+escape(height)));
}