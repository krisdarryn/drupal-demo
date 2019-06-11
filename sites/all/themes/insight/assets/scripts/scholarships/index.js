var fallBack = function () {

   var insLazyLoad1 = new LazyLoad({
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
               $('.next-slide-btn').css('right', addedLftPdd + 'px');
         }  else {
            slick.$nextArrow
                     .removeClass('hidden')
                     .removeAttr('style');
               $('.next-slide-btn').css('right', addedLftPdd + 'px');
         }
         
      }).on('lazyLoaded', function(e, slick) {
         $.each(slick.$slides, function(index, element) {
            var $element = $(element);
            $element.css('width', ($element.find('.sldr-img-wrpr').width() + 15) + 'px');
         });
      });
   
         var $slidr = $('.slider-container');
         var baseSldrWidth = 1200;
         var dim = null;
         var currScrWidth = 0;
         var addedLftPdd = 0;
   
   
         var $iframe = $("iframe");
   
   
         function addPaddingLeft () {
               dim = getViewport();
               currScrWidth = dim.width;
               if (currScrWidth <= 1200) {
                     $slidr.removeAttr('style');
               } else {
                     addedLftPdd = ((currScrWidth - baseSldrWidth) / 2) + 5;
                     $slidr.css('padding-left', addedLftPdd + 'px');
               }
   
               $('.next-slide-btn').css('right', addedLftPdd + 'px');
         }
   
   
         $(window).bind('load', function(){
               addPaddingLeft();
               slideCount = $('.slick-slide').length;
         });
   
         $(window).resize(function() {
               currScrWidth = $(window).width();
               addPaddingLeft();
         });

         if ($(window).width() < 768) {
            var $readMore = $('.addReadMore');

            var $getH = 233;

             if ($(window).width() < 500)  {
               $getH = 251;
            }

            $readMore.readmore({
               speed:75,
               collapsedHeight: $getH,
               embedCSS: false,
               lessLink: '<div class="clearfix read-more-container schl-shp-rm-wrp col-xs-12 hidden-sm hidden-md hidden-lg hidden"><a href="#" class="read-more">Read less</a></div>',
               moreLink: '<div class="clearfix read-more-container schl-shp-rm-wrp col-xs-12 hidden-sm hidden-md hidden-lg"><a href="#" class="read-more">Read more</a></div>',
         
               afterToggle: function(trigger, element, expanded) {
                  $('.toBeToggled').slideToggle("slow");
               }
         
            });
         }
      };
      
      $(fallBack);