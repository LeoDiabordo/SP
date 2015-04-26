(function(){
	$('.component-staff td').mouseover(function(){
		$('#dept-title div').hide();
		$('#dept-title div').html($(this).data('office'));
		$('#dept-title div').fadeIn(100);
	}).mouseleave(function(){
		$('#dept-title div').hide();
		$('#dept-title div').html('OSA Staff');
		$('#dept-title div').fadeIn(100);
	});
})();