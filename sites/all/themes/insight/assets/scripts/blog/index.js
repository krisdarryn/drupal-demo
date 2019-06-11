
$(function(e) {

   var bodyH = $('#ins-mn-bdy-cntr').height() - 342;
   $('.related-articles').css("height", bodyH + "px");
   var sticky = new Sticky('.sticky');
   if (($('.image-holder').length > 0) && ($(window).width() <= 768)){
      initScrollTo();
   }

   var insLazyLoad1 = new LazyLoad({
      elements_selector: ".banner-center-text" 
   });

   var insLazyLoad2 = new LazyLoad({
      elements_selector: ".blog-image"
   });

   var insLazyLoad3 = new LazyLoad({
      elements_selector: ".blg-mn-img"
   });

   centerAlign();

   $('#ins-blog-det-sld')
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


   function addPaddingLeft () {
      dim = getViewport();
      currScrWidth = dim.width;
      if (currScrWidth <= 1200) {
         $slidr.removeAttr('style');
      } else {
         addedLftPdd = ((currScrWidth - baseSldrWidth) / 2) + 8;
         $slidr.css('padding-left', addedLftPdd + 'px');
      }

      $('.next-slide-btn').css('right', addedLftPdd + 'px');
   }

   if($('#ins-blog-det-sld').length >0 ){
      
      if (getViewport().width <= 768) {
         $('#ins-blog-det-sld')
            .removeAttr('style');
      }
      
      $(window).on('resize', function(e){
         centerAlign();
         $('#prev-btn-blg').css('margin-left', ($('.full-detail').offset().left - $('#ins-blog-det-sld').offset().left + 15) + 'px');
         
         if ($(window).width <= 768) {
            $('#ins-blog-det-sld')
               .removeAttr('style');
         }

      });
   }

   $(window).resize(function() {
      currScrWidth = $(window).width();
      addPaddingLeft();
   });

   $(window).bind('load', function(){
      addPaddingLeft();
      slideCount = $('.slick-slide').length;
      var $desc = $('.desc');
      
      if ($desc.attr('data-rm-f')) {
         $desc.readmore({
            speed:75,
            lessLink: '<a href="#" class="read-more hidden">Read less</a>',
            moreLink: '<a href="#" class="read-more">Read more</a>',
            collapsedHeight: 112
         });
      }
   });
   
   
   var $readMore = $('.mobile-main-detail');
   if ($readMore.attr('data-rm-f')) {
    $readMore.readmore({
      speed:75,
      collapsedHeight: 244,
      embedCSS: false,
      lessLink: '<div class="clearfix read-more-container blg-dtl-rm-wrp col-xs-12 hidden-sm hidden-md hidden-lg hidden"><a href="#" class="read-more">Read less</a></div>',
      moreLink: '<div class="clearfix read-more-container blg-dtl-rm-wrp col-xs-12 hidden-sm hidden-md hidden-lg"><a href="#" class="read-more">Read more</a></div>',
  
      afterToggle: function(trigger, element, expanded) {
        $('.toBeToggled').slideToggle("slow");
      }
  
    });
   }

   if ($(window).width() > 768) {
      $readMore.readmore('destroy');
   }

  
  /*$('.slider-section').slick({
      cssEase: 'linear',
      slidesToShow: 1,
      slidesToScroll: 1,
      variableWidth: true,
      infinite: false,
      nextArrow:"<img class='next-slide-btn slick-next' src='" + Drupal.settings.insight.jsVars.imgUrl + "next-arrow-slide.svg'>",
      prevArrow:"<img class='prev-slide-btn slick-prev' src='" + Drupal.settings.insight.jsVars.imgUrl + "prev-arrow-slide.svg'>",
   });*/

  $('.event-slider-section').slick({
    cssEase: 'linear',
    slidesToShow: 1,
    slidesToScroll: 1,
    infinite: false,
    nextArrow:"<img class='next-slide-btn slick-next' src='" + Drupal.settings.insight.jsVars.imgUrl + "next-arrow-slide.svg'>",
    prevArrow:"<img class='prev-slide-btn slick-prev' src='" + Drupal.settings.insight.jsVars.imgUrl + "prev-arrow-slide.svg'>",
  });
   
   var currPos = 1, slideCount = 0;
   $(window).bind('load', function(){
      slideCount = $('.slick-slide').length / 2;
      $('.prev-slide-btn').hide();
   });
   
   
   $(document).on('click', '.next-slide-btn', function(){

      if ($(this).is(':visible')) {
         currPos++;
      }
      if (slideCount - currPos === 0) {
         $(this).hide();
         $('.prev-slide-btn').show();
      } 
   }).on('click', '.prev-slide-btn', function(){
      if ($(this).is(':visible')) {
         currPos--;
      }
      if (currPos === 1) {
         $(this).hide();
         $('.next-slide-btn').show();
      }
   });
   
   
   $('.slider-section').on('swipe', function(event, slick, direction){
      if (direction === 'right') {
         $('.prev-slide-btn').click();
      } else {
         $('.next-slide-btn').click();
      }
   });

   $('.event-slider-section').on('swipe', function(event, slick, direction){
      if (direction === 'right') {
         $('.prev-slide-btn').click();
      } else {
         $('.next-slide-btn').click();
      }
   });

   /*$('#ins-blog-det-sld').on('swipe', function(event, slick, direction){
      if (direction === 'right') {
         $('.prev-slide-btn').click();
      } else {
         $('.next-slide-btn').click();
      }
   });*/
   
   alignSocialMedia();
   
   $(window).on('resize', function(e) {
      alignSocialMedia();
   });

});

function initScrollTo(){

   $("html, body").animate({
      scrollTop: ($('.image-holder').offset().top - 116)
   }, 'fast');
   
}

function centerAlign() {
   var $boxHeight = $('.right-row').outerHeight();
   var $innerHeight = $('.outer').outerHeight();

   if ($innerHeight < $boxHeight){
      $('.left-row').css("height", $boxHeight);
   } else {
      $('.left-row').css("height", $innerHeight);
   }
}

function onclickNewsLetter() {
   $('.sign-up-modal').on('click', function(e) {
      e.preventDefault();
      $.ajax({
         type: 'GET',
         url:  Drupal.settings.insight.jsVars.ajaxUrl.showNewsletterForm,
         dataType: 'html',
         success: function(html) {
            if (html !== '') {
               $('#mdl-wrap').html(html);
               $('#newsletterModal').modal('show');
            }
         }
      });
   });
}

function alignSocialMedia() {
   
   if (getViewport().width <= 768) {
      if ( $('#bg-share-text').length ) {
         $('#bg-share-text').css('padding-left', ($('#bl-fb-sm-img').offset().left - $('#bl-sm-lst').offset().left) + 'px');
      }
   }
   
}