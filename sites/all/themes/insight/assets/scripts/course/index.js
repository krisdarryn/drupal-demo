var readyFunc = function () {

	var insLazyLoad1 = new LazyLoad({
      elements_selector: "img" 
   });

   var insLazyLoad2 = new LazyLoad({
      elements_selector: ".banner-center-text"
	});
	
	var insLazyLoad2 = new LazyLoad({
      elements_selector: ".course-image-container"
   });

	if (getViewport().width > 768) {
		$textHeight = $('.text-col').outerHeight();
		$mediaHeight = $('.media-col').outerHeight();
	
		if ($mediaHeight >= $textHeight) {
			$('#intro-cnt').addClass('eq-row');
			$('.a-wrp').addClass('eq-a-wrp');
		}

		if ($mediaHeight < $textHeight) {
			$('#intro-cnt').removeClass('eq-row');
			$('.a-wrp').removeClass('eq-a-wrp');
		}
	} 
};



$(window).on('resize', function(e){

	if (getViewport().width > 768) {
		$(readyFunc);	
	} else {
		if ($('#intro-cnt').hasClass('eq-row')) {
			$('#intro-cnt').removeClass('eq-row');
			$('.a-wrp').removeClass('eq-a-wrp');
	  }
	}
});


$(readyFunc);	