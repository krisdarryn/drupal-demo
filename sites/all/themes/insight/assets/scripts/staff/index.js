var readyStateFunc = function () {

	var insLazyLoad1 = new LazyLoad({
      elements_selector: "img" 
   });

   var insLazyLoad2 = new LazyLoad({
      elements_selector: ".img-bckgrnd"
	});
	
	var insLazyLoad3 = new LazyLoad({
      elements_selector: ".banner-center-text"
   });

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
			nextArrow:"<img class='next-slide-btn slick-next' src='" + Drupal.settings.insight.jsVars.imgUrl + "next-arrow-slide.svg'>",
			prevArrow:"<img class='prev-slide-btn slick-prev' src='" + Drupal.settings.insight.jsVars.imgUrl + "prev-arrow-slide.svg'>",
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
			}  else {
			   slick.$nextArrow
					.removeClass('hidden')
					.removeAttr('style');
			}
			
		 }).on('lazyLoaded', function(e, slick) {
			$.each(slick.$slides, function(index, element) {
				var $element = $(element);
				$element.css('width', ($element.find('.sldr-img-wrpr').width() + 15) + 'px');
			});
		});

	onclickSeeAllTeacher();
	onclickTeacher();

	 /*
	  * Clicking on button 'See all teachers'
	  */
	  function onclickSeeAllTeacher() {
		  $('.see-all-link').on('click', function(e) {
		  e.preventDefault();
		  
		  $('.tchr-panl').addClass('show-all-expand');
		  $.ajax({
			  type: 'GET',
			  url: Drupal.settings.insight.jsVars.ajaxUrl.showAllTeachers,
			  dataType: 'html',
			  success: function(html) {
				  $('.tchr-panl').html(html);    
				  $('.see-all').addClass('hidden');
			  }
		  });
		  });
	  }

	/*
	  * Clicking on teacher item
	  */
	  function onclickTeacher() {
		$(document).on('click', '.tchr-img-container', function(e) {    
			var val = $(this).find('.thcr-nme h3').text();
			var staffList = Drupal.settings.insight.staffVars.staffList;
			var res = searchStaffName(val, staffList);  
			$.ajax({
				type: 'GET',
				url: Drupal.settings.insight.jsVars.ajaxUrl.showTeacherDetails + '?nid=' + $(this).data('nid'),
				dataType: 'html',
				success: function(html) {
					if (html != '') {
						$('#mdl-wrap').html(html);
						var $mdl = $(document).find('#ins-mdl');
						$mdl.modal('show');
						val = res;
						updateUrlStaff('#'+encodeURI(val).toLowerCase());
					}
				}
			});
		});
	}

	function updateUrlStaff(value){
		window.history.pushState({"html": null,"pageTitle":''},"", ('staff'+value));
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


	$(document).on('shown.bs.modal', '#ins-mdl', function(){
		var winWidth = $(this).width();
		if (winWidth < 768) {
			if ($('.desc').attr('data-rm-f')) {
				$('.desc').readmore({
					speed:75,
					collapsedHeight: 100,
					lessLink: '<div><a href="javascript:" class="read-more hidden" style="padding-top:30px;font-weight:bold">Read Less...</a></div>',
					moreLink: '<div><a href="javascript:" class="read-more" style="padding-top:30px;font-weight:bold">Keep reading...</a></div>',
					afterToggle: function(trigger, element, expanded) {
						$('.ins-mdl-q-sec').slideToggle();
					}
				});
	
				$('.ins-mdl-q-sec').hide();
			}
		}

		var $grid = $('.grid').imagesLoaded( function() {
			// init Masonry after all images have loaded
			$grid.masonry({
				itemSelector: '.grid-item',
				columnWidth: 1,
			});
		 });

		/*var $grid = $('.grid').masonry({
			itemSelector: '.grid-item',
			columnWidth: 1,
			// disable initial layout
			initLayout: false,
		});

		// add event listener for initial layout
		$grid.on( 'layoutComplete', function( event, items ) {
			console.log( items.length );
		});
		// trigger initial layout
		$grid.masonry();*/
	});

	$(document).on('hidden.bs.modal', '#ins-mdl', function() {
		updateUrlStaff('');
  	})

	$(document).on('click', '#keep-reading', function() {
		if ($('#kp-rd-ext').hasClass('hidden-xs hidden-sm')) {
			$('#kp-rd-ext').removeClass('hidden-xs hidden-sm');
		} else {
			$('#kp-rd-ext').addClass('hidden-xs hidden-sm');
		}
	});
	

	$(window).on('resize', function(){
		var winWidth = $(this).width();
		var $grid = $('.grid');
		if (winWidth > 768) {

			if ($grid.height() > 1000) {
				$grid.css('height', '792px');
			}
		}
	});
	  
};

$(readyStateFunc);

$(document).ready(function(){
	
	var staffList = Drupal.settings.insight.staffVars.staffList;
	initUrlStaffModal();

	function initUrlStaffModal() {
		var staffName = window.location.hash.substr(1);
		
		if (staffName && staffList.length){
			var resultObject = searchStaff(staffName, staffList);

			if (resultObject){
				$.ajax({
					type: 'GET',
					url: Drupal.settings.insight.jsVars.ajaxUrl.showTeacherDetails + '?nid=' + resultObject.nid,
					dataType: 'html',
					success: function(html) {
						if (html != '') {
							$('#mdl-wrap').html(html);
							var $mdl = $(document).find('#ins-mdl');
							$mdl.modal('show');
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

});

