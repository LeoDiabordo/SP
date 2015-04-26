
var count=0;
var prev="";
var prevTab = "about-orgs";

$('.org-info nav ul li').each(function(){
	if($(this).hasClass('tab-current')){
			prevTab=$(this).prop('id');	
	}
});
	  
function hide_div(name) {
	if(prev!=name){
		$(':checkbox:checked').each(function(){
  			var id = $(this).attr('id')
  	
  			if(id != name){
  				document.getElementById(id).checked = false;
  			}	
  			else{
				$("#ac_"+name).addClass("toggled");
				$("#label_"+name).addClass("color");
				$(".ac").fadeIn(1000);
				if(prev!=""){
					$("#ac_"+prev).removeClass("toggled");
					$("#label_"+prev).removeClass("color");					
				}
				prev=name;
			}
		}); 
	}else{
 		$("#ac_"+name).removeClass("toggled");
		$("#label_"+name).removeClass("color");
		prev="";
  	}
}

function show_member_info(){
	$(".details-mem").hide();
	$(".mem_info").addClass('overlay');
	$(".mem_info").css('height', '100%');
	$(".details-mem").fadeIn(1000);
}

$('#icon-close').click(function(){
		$(".details-mem").fadeOut(1000);
		 setTimeout(function () {   
         $(".mem_info").removeClass("overlay"); 
         $(".mem_info").css("height",'0');        
		}, 1000);
	})

$(document).ready(function() {


	if(count==0){
		$('.main-component-org').html($('.component-orgs').html());
		count+=1;
	}

		$('#mail_list').click(function(){
		$('.main-component-org').hide();
		$('.main-component-org').html($('.component-mail').html());
		$('.main-component-org').fadeIn(1000);
	})
	$('#stud-org').click(function(){
		$('.main-component-org').hide();
		$('.main-component-org').html($('.component-orgs').html());
		$('.main-component-org').fadeIn(1000);
	})
	$('#recog_guide').click(function(){
		$('.main-component-org').hide();
		$('.main-component-org').html($('.component-guide').html());
		$('.main-component-org').fadeIn(1000);
	})
	$('#app_recog').click(function(){
		$('.main-component-org').hide();
		$('.main-component-org').html($('.component-application').html());
		$('.main-component-org').fadeIn(1000);
	})
	$('#reminder').click(function(){
		$('.main-component-org').hide();
		$('.main-component-org').html($('.component-reminder').html());
		$('.main-component-org').fadeIn(1000);
	})
	$('#my-org').click(function(){
		$('.main-component-org').hide();
		$('.main-component-org').html($('.component-my-org').html());
		$('.main-component-org').fadeIn(1000);
	})

	$('.org-info nav ul li').click(function(){	
		if(prevTab != $(this).prop('class')){
			/*$('.content-current').fadeOut(1000);*/
			$('#c-'+prevTab).addClass('org-matters');
			$('#'+prevTab).removeClass('tab-current');
			$('#c-'+prevTab).removeClass('content-current');
		
		}

		prevTab = $(this).prop('class');
		$(this).addClass('tab-current');
		
		$('.contents article').each(function(){
		
			if($(this).hasClass(prevTab)){			
				$(this).removeClass('org-matters');
				$(this).addClass('content-current');				
			}
		});
	});
});

(function() {
	var support = { animations : Modernizr.cssanimations },
		animEndEventNames = {
			'WebkitAnimation' : 'webkitAnimationEnd',
			'OAnimation' : 'oAnimationEnd',
			'msAnimation' : 'MSAnimationEnd',
			'animation' : 'animationend'
		},
		// animation end event name
		animEndEventName = animEndEventNames[ Modernizr.prefixed( 'animation' ) ],
		component = document.getElementById( 'slide-component' ),
		items = component.querySelector( 'ul.slides' ).children,
		current = 0,
		itemsCount = items.length,
		isAnimating = false;

	function init() {
		clearTimeout(slideEvent);
		var slideEvent = setTimeout(function(){
			var next = current + 1;
			navigate(next);
			init();
		}, 5000);
	}

	function navigate(next) {
		if( isAnimating ) return false;
		isAnimating = true;
		var cntAnims = 0;
		var dir = 'next';

		var currentItem = items[ current ];

		if( next > current ) {
			current = current < itemsCount - 1 ? current + 1 : 0;
		}
		else if( next < current ) {
			current = current > 0 ? current - 1 : itemsCount - 1;
		}

		var nextItem = items[next%itemsCount];
		var nextnextItem = items[(next+1)%itemsCount];

		var onEndAnimationCurrentItem = function() {
			this.removeEventListener( animEndEventName, onEndAnimationCurrentItem );
			this.classList.remove('curr');
			this.classList.remove('slide-out');
			nextItem.classList.remove('next');
			nextItem.classList.remove('slide-in');
			nextItem.classList.add('curr');
			nextnextItem.classList.add('next');
			++cntAnims;
			if( cntAnims === 1 ) {
				isAnimating = false;
			}
		}

		if( support.animations ) {
			currentItem.addEventListener( animEndEventName, onEndAnimationCurrentItem );
		}
		else {
			onEndAnimationCurrentItem();
		}

		currentItem.classList.add('slide-out');
		nextItem.classList.add('slide-in');
	}

	init();
})();


