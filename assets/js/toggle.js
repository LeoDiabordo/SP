$(document).ready(function() {
	var target = 'do';
	var animationEnd = getAnimationEndFn();
	showStaff();
	function getAnimationEndFn(){
		switch(Modernizr.prefixed('animation')) {
			case 'WebkitAnimation' :
				return 'webkitAnimationEnd';
			case 'OAnimation' :
				return 'oAnimationEnd';
			case 'msAnimation' :
				return 'MSAnimationEnd';
			case 'animation' :
				return 'animationend';
		}
	}
	function showStaff(){
		var title = getTitle();
		$('.office-header .office-header-content').html(title);
		$('.component-staff .staff-whole-wrapper.active').removeClass('active').css('display','none');
		$('.component-staff #'+target).css('display','block').addClass('toggling').on(animationEnd,function(){
			$(this).removeClass('toggling').addClass('active');
		});
	}
	function getTitle(){
		switch(target){
			case 'do': return "Director's Office";
			case 'execom': return "Executive Committee";
			case 'commit': return "Communication and Information Technology";
			case 'ctd': return "Counseling and Testing Division";
			case 'iss': return "International Student Services";
			case 'sfad': return "Scholarship and Financial Assistance Division"
			case 'sdt': return "Student Disciplinary Tribunal";
			case 'soad': return "Student Organization and Activities Division";
		}
	}
	$('.staff-link').click(function(ev){
		ev.preventDefault();
		target = $(this).data('value');
		showStaff();
	});
});