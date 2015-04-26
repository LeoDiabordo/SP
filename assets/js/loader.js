(function(){
	var box = document.getElementById('content-box');
	var trigger = document.getElementById('trigger');
	var hideFlag = false;

	toggleBox = function(){
		if(!hideFlag) {
			box.style.height = "0";
			box.style.display = "none";
			hideFlag = true;
		}
		else {
			box.style.display = "initial";
			box.style.height = "initial";
			hideFlag = false;
		}
	}

	trigger.addEventListener('click', toggleBox);
})();