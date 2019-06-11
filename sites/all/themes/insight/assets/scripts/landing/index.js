$(function(e) {


   var insLazyLoad1 = new LazyLoad({
      elements_selector: "img" 
   });

   var insLazyLoad2 = new LazyLoad({
      elements_selector: ".slider-image-container"
   });

   
  $('#showcaseModal').on('shown.bs.modal', function () {
    $('.showcase-slider').slick({
      cssEase: 'linear',
      slidesToShow: 1,
      slidesToScroll: 1,
      infinite: false,
      nextArrow:"<img class='next-slide-btn slick-next' src='" + Drupal.settings.insight.jsVars.imgUrl + "next-arrow-slide.svg'>",
      prevArrow:"<img class='prev-slide-btn slick-prev' src='" + Drupal.settings.insight.jsVars.imgUrl + "prev-arrow-slide.svg'>",
    });

    $('.showcase-slider').on('swipe', function(event, slick, direction){
      if (direction === 'right') {
         $('.prev-slide-btn').click();
      } else {
         $('.next-slide-btn').click();
      } 
    });
  });

   

   setTimeout(function() {
      $('.slider-details').css({
         'padding-right' : '1px'
      });
      $('.slider-title').css({
         'padding-right' : '1px'
      });
   }, 50 );



   $('.ins-footer-nav-item a[data-toggle="collapse"]').click(function(e){
      if ($(window).width() >= 768) {  
      e.stopPropagation();
      } 
   });

   /**$('.ins-footer-nav-item a').click(function(e){
      $(this).find('ul').toggle();
   });**/

   $('.landing-slider-section').slick({
      slidesToShow: 4,
      slidesToScroll: 1,
      infinite: false,
      arrows: false,
      draggable: false,
      responsive: [
         {
           breakpoint: 768,
           settings: {
             arrows: false,
             draggable: true,
             infinite: false,
             focusOnSelect: true,
             slidesToShow: 1,
             slidesToScroll: 1,
           }
         }
      ]
    });

    $('.landing-testimonial-slider').slick({
      slidesToShow: 3,
      slidesToScroll: 1,
      infinite: false,
      draggable: false,
      arrows: false,
      responsive: [
        {
          breakpoint: 768,
          settings: {
            arrows: false,
            dots: true,
            draggable: true,
            infinite: false,
            focusOnSelect: false,
            slidesToShow: 1,
            slidesToScroll: 1,
          }
        }
     ]
    });

    var lineHeight = 27;
    var numLines = 5;
    
    $('.testimonial-text p').readmore({
      speed:100,
      collapsedHeight: lineHeight * numLines,
      heightMargin: lineHeight * 1,
      lessLink: '<a href="#" class="read-more read-less">show more</a>',
      moreLink: '<a href="#" class="read-more">show more</a>',
      beforeToggle: function(trigger, element, expanded) {
         element.parent().next().css({
            "margin-bottom" : "20px"
         });
      },
      afterToggle: function(trigger, element, expanded) {
         if(expanded) { 
            element.css({"display": "block", "height": "auto", "text-overflow": "unset", "-webkit-line-clamp": "unset", "-webkit-box-orient": "unset"});
            $('.read-less').css({"display": "none"});
         } 
       }
   });

   $('.testimonial-text p').css({
      'text-overflow': "ellipsis", 
      'display': "-webkit-box", 
      '-webkit-line-clamp': "5",  
      '-webkit-box-orient': "vertical", 
      'margin-bottom': "0"
    });

});




