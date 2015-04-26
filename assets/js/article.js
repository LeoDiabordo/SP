$(document).ready(function(){
	$(".article").click(function(){
		$(".component-article .articles li.open").removeClass("open");
		$(".nav ul li.open").removeClass("open");
		$(this).addClass("open");
		$(".component-article .articles #art"+$(this).val()).addClass("open");
	});
});