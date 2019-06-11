var employmentList = Drupal.settings.insight.gradVars.employmentList;
var graduateFullList = Drupal.settings.insight.gradVars.graduateFullList;
var defaultNumEmploymentDisplay = 6;
var $btnLoadMoreEmployment = null;
var $employmentDisplayCount = null;
var addedPadding = 0;
var $slidr = null;
var mdlWidth = 0;

var readyFunc = function () {
	var insLazyLoad1 = new LazyLoad({
      elements_selector: "img" 
   });

   var insLazyLoad2 = new LazyLoad({
      elements_selector: ".img-bckgrnd"
   });

	$btnLoadMoreEmployment = $('#btnLoadMoreEmployment');
	$employmentDisplayCount = $('#employmentDisplayCount');
	
	onclickGraduate();
	onclickBtnSeeAllGraduates();
	onclickBtnLoadMoreEmployment();
	initUrlGraduateModal();


	function onclickGraduate() {
		$(document).on('click', '.tchr-img-container', function () {
			var val = $(this).find('.thcr-nme h3').text();
			var res = searchStaffName(val, graduateFullList);  

			//add bottom margin to slider when not toggled 


			shownModalHeaderFix();
			$('#mdl-wrap').html();
		   $.ajax({
			  type: 'GET',
			  url: Drupal.settings.insight.jsVars.ajaxUrl.showGraduateDetails + '?nid=' + $(this).data('nid'),
			  dataType: 'html',
			  success: function(html) {
				 if (html != '') {
					$('#mdl-wrap').html(html);
					$('#ins-mdl').modal('show');
					val = res;
					updateUrlStaff('#'+encodeURI(val).toLowerCase());
					//slick
					var $allP = $('.desc');
			
						$('#ins-mdl').on( 'shown.bs.modal', function() {
                     addPaddingLeft();
                     
							$('.slider-section')
								.on('init', function(e, slick) {
									slick.$prevArrow
										.addClass('hidden');		
									if (slick.activeBreakpoint) {
										slick.$nextArrow
											.addClass('hidden');
									} else {
												
										if (slick.slideCount > 1) {
											slick.$nextArrow
												.removeClass('hidden');
										}
									}
                           
                           if ((slick.slickCurrentSlide()) >= (slick.slideCount - 1)) {
                              slick.$nextArrow
											.addClass('hidden');
										$('.next-slide-btn').css('right', addedPadding + 'px');
									}  else {
                              slick.$nextArrow
											.removeClass('hidden')
											.removeAttr('style');
										$('.next-slide-btn').css('right', addedPadding + 'px');
									}
                           
									$.each(slick.$slides, function(index, element) {
										var $element = $(element);
										$element.css('width', ($element.find('.sldr-img-wrpr').width() + 15) + 'px');
									});

								}).slick({
									cssEase: 'linear',
									lazyLoad: 'progressive',
									slidesToShow: 1,
									slidesToScroll: 1,
									variableWidth: true,
									dots: false,
									infinite: false,
									nextArrow:"<img class='next-slide-btn slick-next hidden-xs' src='" + Drupal.settings.insight.jsVars.imgUrl + "next-arrow-slide.svg'>",
									prevArrow:"<img class='prev-slide-btn slick-prev hidden-xs' src='" + Drupal.settings.insight.jsVars.imgUrl + "prev-arrow-slide.svg'>",
									responsive: [
										{
											breakpoint: 768,
											settings: {
												dots: true,
											}
										}
									]
								}).on('afterChange', function(currentSlide, slick) {
									
									if (slick.slickCurrentSlide() === 0) {
									slick.$prevArrow
											.addClass('hidden');
									} else {
									slick.$prevArrow
											.removeClass('hidden')
											.removeAttr('style');
									}
									
									if ((slick.slickCurrentSlide()) >= (slick.slideCount - 1)) {
                              slick.$nextArrow
											.addClass('hidden');
										$('.next-slide-btn').css('right', addedPadding + 'px');
									}  else {
                              slick.$nextArrow
											.removeClass('hidden')
											.removeAttr('style');
										$('.next-slide-btn').css('right', addedPadding + 'px');
									}
									
								}).on('lazyLoaded', function(e, slick) {
									$.each(slick.$slides, function(index, element) {
										var $element = $(element);
										$element.css('width', ($element.find('.sldr-img-wrpr').width() + 15) + 'px');
									});
								});


							if ($(window).width() < 768) {

								var $desc = $('.desc');
								var $getH = 168;

								if ($(window).width() < 330)  {
									$getH = 194;
								} else if ($(window).width() < 380)  {
									$getH = 203;
								} else if ($(window).width() < 400)  {
									$getH = 176;
								} else if ($(window).width() < 450)  {
									$getH = 193;
								} else if ($(window).width() < 500)  {
									$getH = 200;
								}
								
								if ($desc.attr('data-rm-f')) {
									$desc.readmore({
										speed:75,
										lessLink: '<div class="text-right hidden" style="padding-top:30px;"><a href="#" class="read-more">Read less</a></div>',
										moreLink: '<div class="text-right" style="padding-top:30px;"><a href="#" class="read-more">Read more</a></div>',
										collapsedHeight: $getH,
										afterToggle: function(trigger, element, expanded) {
											$('.toBeToggled').slideToggle("slow");
											$('#grd-mdl-sldr').css('margin-bottom', '0');
										}
									});
								}		
							}
					
						});

						$('#ins-mdl').on( 'hidden.bs.modal', function () {
							removeModalHeaderFix();
							updateUrlStaff('');
						});
					
						$(window).resize(function() {
							$('.slider-section').slick('resize');
							addPaddingLeft();
						});

						//end of slick init
				 }
			  }
		   });
		});
	 }

	function updateUrlStaff(value){
		window.history.pushState({"html": null,"pageTitle":''},"", ('graduates'+value));
	}
	  
	function searchStaffName(value, searched){
		for (var i=0; i < searched.length; i++) {
			fname = (searched[i].firstName).replace(/\s/g, '');
			lname = (searched[i].lastName).replace(/\s/g, '');
			val = (value).replace(/\s/g, ''); 
			if (lname.length > 0) {
				fullname = (fname +''+lname);
				uFullname = (fname +'-'+ lname);
			} else {
				fullname = fname.toLowerCase();
				uFullname = fname.toLowerCase();
			}
			
			if (fullname.toLowerCase() === val.toLowerCase()) {
				return uFullname.toLowerCase();
			} 
		}
	}
	 
	 /*
	 * On click 'See all graduates' link button
	 */
	 function onclickBtnSeeAllGraduates() {
		$('.see-all-link').on('click', function(e) {
		   e.preventDefault();
		   
		   $.ajax({
			  type: 'GET',
			  url: Drupal.settings.insight.jsVars.ajaxUrl.showAllGraduates,
			  dataType: 'html',
			  success: function(html) {
				 $('.tchr-panl').html(html);    
				 $('.see-all').addClass('hidden');
			  }
		   });
		});
	 }
	 
	 /*
	 * On click 'Load more' link button
	 */
	 function onclickBtnLoadMoreEmployment() {
		$btnLoadMoreEmployment.on('click', function(e) {
		   e.preventDefault();         
		   var displayCount = parseInt($employmentDisplayCount.val());
		   var newDisplayCount = displayCount + defaultNumEmploymentDisplay;
		   var list;
		   
		   if (newDisplayCount > employmentList.length) {
			  list = employmentList.slice(displayCount);
			  $btnLoadMoreEmployment.addClass('hidden') // Hide load more button
           $('.grd-std-wrk-lst').css('margin-bottom', '20px');
		   } else {
			  list = employmentList.slice(displayCount, newDisplayCount);
		   }
		   
		   var html = '';
         var ctr = displayCount + 1;
		   for (x in list) {            
			   html += buildEmploymentItem(list[x], ctr);
            ctr++;
		   }
		   
		   $('#mobileEmploymentList .row').append(html);
		   $employmentDisplayCount.val(newDisplayCount);
		});
	 }
	 
	 /*
	 * Builds and returns employment item html block
	 */
	 function buildEmploymentItem(item, ctr) {
		var html =  '<div class="col-xs-6 grd-img">'
						+'<span class="helper"></span>'
						+ '<img class="" src="' + item.image.url + '" alt="' + item.image.alt + '" title="' + item.image.title + '">'
						+ '</div>';
                        
      if ((ctr % 2) == 0) {
         html += '<div class="clearfix"></div>';
      }

      return html;
	 }
};

function initUrlGraduateModal(){
	var gradName = window.location.hash.substr(1);

	if (gradName && graduateFullList.length){
		var resultObject = searchStaff(gradName, graduateFullList);

		if (resultObject){
			shownModalHeaderFix();
			$('#mdl-wrap').html();
		   $.ajax({
			  type: 'GET',
			  url: Drupal.settings.insight.jsVars.ajaxUrl.showGraduateDetails + '?nid=' + resultObject.nid,
			  dataType: 'html',
			  success: function(html) {
				 if (html != '') {
					$('#mdl-wrap').html(html);
					$('#ins-mdl').modal('show');

					//slick
					var $allP = $('.desc');
			
						$('#ins-mdl').on( 'shown.bs.modal', function() {
                     addPaddingLeft();
                     
							$('.slider-section')
								.on('init', function(e, slick) {
									slick.$prevArrow
										.addClass('hidden');		
									if (slick.activeBreakpoint) {
										slick.$nextArrow
											.addClass('hidden');
									} else {
												
										if (slick.slideCount > 1) {
											slick.$nextArrow
												.removeClass('hidden');
										}
									}
                           
                           if ((slick.slickCurrentSlide()) >= (slick.slideCount - 1)) {
                              slick.$nextArrow
											.addClass('hidden');
										$('.next-slide-btn').css('right', addedPadding + 'px');
									}  else {
                              slick.$nextArrow
											.removeClass('hidden')
											.removeAttr('style');
										$('.next-slide-btn').css('right', addedPadding + 'px');
									}
                           
									$.each(slick.$slides, function(index, element) {
										var $element = $(element);
										$element.css('width', ($element.find('.sldr-img-wrpr').width() + 15) + 'px');
									});

								}).slick({
									cssEase: 'linear',
									lazyLoad: 'progressive',
									slidesToShow: 1,
									slidesToScroll: 1,
									variableWidth: true,
									dots: false,
									infinite: false,
									nextArrow:"<img class='next-slide-btn slick-next hidden-xs' src='" + Drupal.settings.insight.jsVars.imgUrl + "next-arrow-slide.svg'>",
									prevArrow:"<img class='prev-slide-btn slick-prev hidden-xs' src='" + Drupal.settings.insight.jsVars.imgUrl + "prev-arrow-slide.svg'>",
									responsive: [
										{
											breakpoint: 768,
											settings: {
												dots: true,
											}
										}
									]
								}).on('afterChange', function(currentSlide, slick) {
									
									if (slick.slickCurrentSlide() === 0) {
									slick.$prevArrow
											.addClass('hidden');
									} else {
									slick.$prevArrow
											.removeClass('hidden')
											.removeAttr('style');
									}
									
									if ((slick.slickCurrentSlide()) >= (slick.slideCount - 1)) {
                              slick.$nextArrow
											.addClass('hidden');
										$('.next-slide-btn').css('right', addedPadding + 'px');
									}  else {
                              slick.$nextArrow
											.removeClass('hidden')
											.removeAttr('style');
										$('.next-slide-btn').css('right', addedPadding + 'px');
									}
									
								}).on('lazyLoaded', function(e, slick) {
									$.each(slick.$slides, function(index, element) {
										var $element = $(element);
										$element.css('width', ($element.find('.sldr-img-wrpr').width() + 15) + 'px');
									});
								});


							if ($(window).width() < 768) {

								var $desc = $('.desc');
								var $getH = 168;

								if ($(window).width() < 330)  {
									$getH = 194;
								} else if ($(window).width() < 380)  {
									$getH = 203;
								} else if ($(window).width() < 400)  {
									$getH = 176;
								} else if ($(window).width() < 450)  {
									$getH = 193;
								} else if ($(window).width() < 500)  {
									$getH = 200;
								}
								
								if ($desc.attr('data-rm-f')) {
									$desc.readmore({
										speed:75,
										lessLink: '<div class="text-right hidden" style="padding-top:30px;"><a href="#" class="read-more">Read less</a></div>',
										moreLink: '<div class="text-right" style="padding-top:30px;"><a href="#" class="read-more">Read more</a></div>',
										collapsedHeight: $getH,
										afterToggle: function(trigger, element, expanded) {
											$('.toBeToggled').slideToggle("slow");
											$('#grd-mdl-sldr').css('margin-bottom', '0');
										}
									});
								}		
							}
					
						});

						$('#ins-mdl').on( 'hidden.bs.modal', function () {
							removeModalHeaderFix();
						});
					
						$(window).resize(function() {
							$('.slider-section').slick('resize');
							addPaddingLeft();
						});

						//end of slick init
				 }
			  }
		   });
		}
	}
}

function searchStaff(value, searched){
	for (var i=0; i < searched.length; i++) {
		fname = (searched[i].firstName).replace(/\s/g, '');
		lname = (searched[i].lastName).replace(/\s/g, '');
		if (lname.length > 0) {
			fullname = (fname +'-'+lname).toLowerCase();
		} else {
			fullname = fname.toLowerCase();
		}
		if (encodeURI(fullname).toLowerCase() === value.toLowerCase()) {
			return searched[i];
		} 
	}
}

function shownModalHeaderFix(){
	var headerW = $('.mn-hdr-bg').width();
	var bannerW = $('.banner-center-text').width();
	var menuW = $('.desk-menu-navbar').width();

	$('.mn-hdr-bg').css("max-width", headerW);
	$('.banner-center-text').css("max-width", bannerW);
	$('.desk-menu-navbar').css("max-width", menuW);
}

function removeModalHeaderFix(){
  $('.mn-hdr-bg').css("max-width", "none");
  $('.banner-center-text').css("max-width", "none");
  $('.desk-menu-navbar').css("max-width", "none");
}

function addPaddingLeft () {
   $slidr = $('.slider-container');
   if ($(window).width() > 768) {
      baseMdlWidth = $('.grd-inf-det').width();
      addedPadding = (( (baseMdlWidth - (baseMdlWidth * 0.75)) /  2) + 30) - 55;
      $slidr.css('padding-left', addedPadding + 'px');
   } else {
      $slidr.removeAttr('style');
   }
}
                  
$(readyFunc);