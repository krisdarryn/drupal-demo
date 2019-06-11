var addedPadding = null;

var LongCourse = {
   $staffSlick: null,
   $studSlick: null,
   $gradfSlick: null,
   stickySideMenu: null,
   $studHeader: null,
   $studSlideWrp: null,
   $gradHeader: null,
   $gradSlideWrp: null,
   $cdReadMore: null,
   $rqReadMore: null,
   activeModal: null,
   $studFBSlick: null,
   $studFBItems: null,
   init: function() {
      this.$staffSlick = $('.ins-lc-sf-list');
      this.$studSlick = $('.ins-lc-sw-list');
      this.$gradfSlick = $('.ins-lc-gd-list');
      this.$studHeader = $('.ins-lc-sc-hd.ins-lc-sw');
      this.$studSlideWrp = $('.ins-lc-sc-bd.ins-lc-sw');
      this.$gradHeader = $('.ins-lc-sc-hd.ins-lc-gd');
      this.$gradSlideWrp = $('.ins-lc-sc-bd.ins-lc-gd');
      this.$cdReadMore = $('#ins-lc-sc-cd-rdm');
      this.$rqReadMore = $('#ins-lc-sc-rq-rdm');
      this.activeModal = null;
      this.$studFBSlick = $('.ins-lc-sf-qh-list');
      this.$studFBItems = $('.ins-lc-sf-qh-bd');
      this.stickySideMenu = new Sticky('.ins-lc-sb-mn-wrp');
      
      this.initSlick();
      this.alignSections();
      this.initWindorResizeEvent();
      this.initSideMenuEvent();
      this.initReadMore();
      this.initEvent();
   },
   initEvent: function() {
      
      $('#btn-lc-en-eb').on('click', function(e) {
         e.preventDefault();
         
         $('html, body').stop().animate({
               scrollTop: $('#tuition-fees-section').offset().top - 190
         }, 600, function() {
               //location.hash = target; //attach the hash (#jumptarget) to the pageurl
         });
         
      });
      
      // Show m2 staff details
      $(document).on('click', '.btn-ins-lc-sf-itm', function(e) {
         e.preventDefault();
         
         $.ajax({
            type: 'GET',
            url: Drupal.settings.insight.jsVars.ajaxUrl.showTeacherDetails + '?nid=' + $(this).data('nid'),
            dataType: 'html',
            success: function(html) {
               if (html) {
                  LongCourse.activeModal = 'm2';
                  $('#mdl-wrap').html(html);
                  $('#ins-mdl').modal('show');
               }
            }
         });
         
      });
      
      // Show m1 project details
      $(document).on('click', '.btn-ins-lc-sw-itm', function(e) {
         e.preventDefault();
         
         $.ajax({
            type: 'GET',
            url: Drupal.settings.insight.jsVars.ajaxUrl.showProjectDetails + '?nid=' + $(this).data('nid'),
            dataType: 'html',
            success: function(html) {
               if (html) {
                  LongCourse.activeModal = 'm1';
                  $('#mdl-wrap').html(html);
                  $('#showcaseModal').modal('show');
               }
            }
         });
         
      });
      
      // Show m3 gruadate details
      $(document).on('click', '.btn-ins-lc-gd-itm', function(e) {
         e.preventDefault();
         
         $.ajax({
            type: 'GET',
            url: Drupal.settings.insight.jsVars.ajaxUrl.showGraduateDetails + '?nid=' + $(this).data('nid'),
            dataType: 'html',
            success: function(html) {               
               if (html) {
                  LongCourse.activeModal = 'm3';
                  $('#mdl-wrap').html(html);
                  $('#ins-mdl').modal('show');
               }
            }
		   });
         
      });
      
      $(document).on('shown.bs.modal', '#ins-mdl, #showcaseModal', function() {
         switch (LongCourse.activeModal) {
            case 'm1':
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
            case 'm2':
               if (getViewport().width < 768) {
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
         
               /* $('.grid').masonry({
                  itemSelector: '.grd-itm',
                  columnWidth: '.grd-szr',
                  percentPosition: true
               }); */

               var $grid = $('.grid').imagesLoaded( function() {
                  // init Masonry after all images have loaded
                  $grid.masonry({
                     itemSelector: '.grid-item',
                     columnWidth: 1
                  });
               });
               
               break;
            
            case 'm3':
               if ($(window).width() < 768) {
                  var $desc = $('.desc');
                  if ($desc.attr('data-rm-f')) {
                     $desc.readmore({
                        speed:75,
                        lessLink: '<div class="text-right hidden" style="padding-top:30px;"><a href="#" class="read-more">Read less</a></div>',
                        moreLink: '<div class="text-right" style="padding-top:30px;"><a href="#" class="read-more">Read more</a></div>',
                        collapseHeight: 150
                     });
                  }
               }
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
                  }).slick({
                     cssEase: 'linear',
                     lazyLoad: 'progressive',
                     slidesToShow: 1,
                     slidesToScroll: 1,
                     variableWidth: true,
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
               break;
         }
         
      });
      
      $(document).on('hidden.bs.modal', '#ins-mdl, #showcaseModal', function() {
         LongCourse.activeModal = null;
         $('#ins-mdl').empty();
         $('#showcaseModal').empty();
      }); 
   },
   initSlick: function() {
      LongCourse.$staffSlick
               .on('init', function(e, slick) {
                  slick.$prevArrow
                       .addClass('hidden');
                                
                  if (slick.activeBreakpoint) {
                     slick.$nextArrow
                          .addClass('hidden');
                  } else {
                                
                     if (slick.slideCount > 2) {
                        slick.$nextArrow
                             .removeClass('hidden');
                     }
                     
                  }
               })
               .slick({
                  cssEase: 'linear',
                  slidesToShow: 2,
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
                           slidesToShow: 1,
                           dots: true,
                        }
                     }
                  ]
               }).on('breakpoint', function(event, slick, breakpoint) {
                  
                  if (breakpoint === 768) {
                     slick.$nextArrow
                          .addClass('hidden');
                     slick.$prevArrow
                          .addClass('hidden');
                  } else {
                     slick.$nextArrow
                          .removeClass('hidden');
                     slick.$prevArrow
                          .removeClass('hidden');
                          
                     if ((slick.slickCurrentSlide() + 2) >= slick.slideCount) {
                        slick.$nextArrow
                             .addClass('hidden');
                     } 
                     
                     if (slick.slickCurrentSlide() === 0) {
                        slick.$prevArrow
                             .addClass('hidden');
                     }
                     
                  }
                  
               }).on('afterChange', function(currentSlide, slick) {
                  
                  if (slick.slickCurrentSlide() === 0) {
                     slick.$prevArrow
                          .addClass('hidden');
                  } else {
                     slick.$prevArrow
                          .removeClass('hidden')
                          .removeAttr('style');
                  }
                  
                  if ((slick.slickCurrentSlide() + 2) >= slick.slideCount) {
                     slick.$nextArrow
                          .addClass('hidden');
                  }  else {
                     slick.$nextArrow
                          .removeClass('hidden')
                          .removeAttr('style');
                  }
                  
               });
      
      LongCourse.$studSlick
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
               })
               .slick({
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
                           slidesToShow: 1,
                           dots: true
                        }
                     }
                  ]
               }).on('breakpoint', function(event, slick, breakpoint) {
                  
                  if (breakpoint === 768) {
                     slick.$nextArrow
                          .addClass('hidden');
                     slick.$prevArrow
                          .addClass('hidden');
                  } else {
                     slick.$nextArrow
                          .removeClass('hidden');
                     slick.$prevArrow
                          .removeClass('hidden');
                          
                     if ((slick.slickCurrentSlide()) >= (slick.slideCount - 1)) {
                        slick.$nextArrow
                             .addClass('hidden');
                     } 
                     
                     if (slick.slickCurrentSlide() === 0) {
                        slick.$prevArrow
                             .addClass('hidden');
                     }
                     
                  }
                  
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
                          
                     // Update graduate next arrow
                     slick.$nextArrow.css('left', ($('#student-work-section').width() - slick.$nextArrow.width()) + 'px');
                  }
                  
               }).on('lazyLoaded', function(e, slick) {
                  $.each(slick.$slides, function(index, element) {
                     var $element = $(element);
                     $element.css('width', ($element.find('.ins-lc-sw-img-wrp').width()) + 'px');
                  });
               });
      
      // Graduate slick init event
      LongCourse.$gradfSlick
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
               })
               .slick({
                  cssEase: 'linear',
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
                           slidesToShow: 1,
                           dots: true,
                        }
                     }
                  ]
               }).on('breakpoint', function(event, slick, breakpoint) {
         
                  if (breakpoint === 768) {
                     slick.$nextArrow
                          .addClass('hidden');
                     slick.$prevArrow
                          .addClass('hidden');
                  } else {
                     slick.$nextArrow
                          .removeClass('hidden');
                     slick.$prevArrow
                          .removeClass('hidden');
                          
                     if ((slick.slickCurrentSlide()) >= (slick.slideCount - 1)) {
                        slick.$nextArrow
                             .addClass('hidden');
                     } 
                     
                     if (slick.slickCurrentSlide() === 0) {
                        slick.$prevArrow
                             .addClass('hidden');
                     }
                     
                  }
                  
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
                          
                     // Update graduate next arrow  
                     slick.$nextArrow.css('left', ($('#graduates-section').width() - slick.$nextArrow.width()) + 'px');
                  }
                  
               });
               
      // Student feedback slick init
      LongCourse.resizeStudentFeedbackContainer();
      LongCourse.$studFBSlick
                .on('init', function(e, slick) {
                   
                   slick.$prevArrow
                                .addClass('hidden');
                                
                   if (slick.activeBreakpoint) {

                     } else {
                                
                        if (slick.slideCount > 1) {
                             
                           slick.$nextArrow
                                .removeClass('hidden');
                        }
                        
                     }
                     if (slick.$slides[0].offsetHeight){
                        nextHeight = slick.$slides[0].offsetHeight;
                        $( ".ins-lc-sf-qh-list" ).animate({
                           height: nextHeight
                        }, 300);
                     }
                     
                     
               })
               .slick({
                  cssEase: 'linear',
                  slidesToShow: 1,
                  slidesToScroll: 1,
                  variableWidth: true,
                  infinite: false,
                  nextArrow:"<img class='next-slide-btn slick-next' src='" + Drupal.settings.insight.jsVars.imgUrl + "next-arrow-slide.svg'>",
                  prevArrow:"<img class='prev-slide-btn slick-prev' src='" + Drupal.settings.insight.jsVars.imgUrl + "prev-arrow-slide.svg'>",
                  responsive: [
                     {
                        breakpoint: 768,
                        settings: {
                           slidesToShow: 1
                        }
                     }
                  ]
               }).on('breakpoint', function(event, slick, breakpoint) {
         
                  if (breakpoint === 768) {
                     slick.$nextArrow
                          .addClass('hidden');
                     slick.$prevArrow
                          .addClass('hidden');
                  } else {
                     slick.$nextArrow
                          .removeClass('hidden');
                     slick.$prevArrow
                          .removeClass('hidden');
                          
                     if ((slick.slickCurrentSlide()) >= (slick.slideCount - 1)) {
                        slick.$nextArrow
                             .addClass('hidden');
                     } 
                     
                     if (slick.slickCurrentSlide() === 0) {
                        slick.$prevArrow
                             .addClass('hidden');
                     }
                     
                  }
                  
               }).on('afterChange', function(currentSlide, slick, nextSlide) {
                  
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
               }).on('beforeChange', function(event, slick, currentSlide, nextSlide) {

                     nextHeight = slick.$slides[nextSlide].offsetHeight;
                     if (nextHeight){
                        $( ".ins-lc-sf-qh-list" ).animate({
                           height: nextHeight
                         }, 300);
                     }
                     
                  
               });
               
   },
   alignSections: function() {
      
      if (getViewport().width > 1200) {
         LongCourse.$studSlideWrp
                   .css('padding-left', (LongCourse.$studHeader.offset().left - LongCourse.$studSlideWrp.offset().left) + 'px');
         LongCourse.$gradSlideWrp
                   .css('padding-left', (LongCourse.$gradHeader.offset().left - LongCourse.$gradSlideWrp.offset().left) + 'px');
      } 
      
      if (getViewport().width <= 1200) {
         LongCourse.$studSlideWrp
                   .removeAttr('style');
         LongCourse.$gradSlideWrp
                   .removeAttr('style');
      }
      
      // Update student work next arrow
      var $swNextArrow = LongCourse.$studSlick
                               .slick('getSlick')
                               .$nextArrow;
                               
      $swNextArrow.css('left', ($('#student-work-section').width() - $swNextArrow.width()) + 'px');
      
      // Update student work next arrow
      var $swNextArrow = LongCourse.$studSlick
                               .slick('getSlick')
                               .$nextArrow;
                               
      $swNextArrow.css('left', ($('#student-work-section').width() - $swNextArrow.width()) + 'px');
      
      // Update graduate next arrow
      var $gradNextArrow = LongCourse.$gradfSlick
                                     .slick('getSlick')
                                     .$nextArrow;
                                     
      $gradNextArrow.css('left', ($('#graduates-section').width() - $gradNextArrow.width()) + 'px');
      
   },
   resizeStudentFeedbackContainer: function() {
      LongCourse.$studFBItems
                .css('width', LongCourse.$studFBSlick.width());
   },
   refreshStudentFeedbackSlick: function() {
      LongCourse.$studFBSlick
                .slick('getSlick')
                .refresh();
   },
   initWindorResizeEvent: function() {
      $(window).on('resize', function(e){
         LongCourse.alignSections();
         LongCourse.initReadMore();
         LongCourse.resizeStudentFeedbackContainer();
         LongCourse.refreshStudentFeedbackSlick();
      });
   },
   initSideMenuEvent: function() {
      $('.ins-sd-mn-itm-l').bind('click', function(e) {
         e.preventDefault(); // prevent hard jump, the default behavior
   
         var target = $(this).attr("href"); // Set the target as variable
         var $target = $(target);
         var scrto = 0;
         
         if (target === '#enquire-section') {
            scrto = $(target).offset().top - 170;
         } else {
            scrto = $(target).offset().top - 120;
         }
         
         // perform animated scrolling by getting top-position of target-element and set it as scroll target
         $('html, body').stop().animate({
               scrollTop: (scrto - 60)
         }, 600, function() {
               //location.hash = target; //attach the hash (#jumptarget) to the pageurl
         });
   
         return false;
		});
      
      $(window).scroll(function() {
         var scrollDistance = $(window).scrollTop();
   
         // Assign active class to nav links while scolling
         $('.ins-lc-sc-t').each(function(i) {
            
               if ($(this).offset().top <= (scrollDistance + 240)) {
                  
                     $('.ins-sd-mn-itm').removeClass('active');
                     $('.ins-sd-mn-itm').eq(i).addClass('active');
               }
         });
         
         if($(window).scrollTop() + $(window).height() === $(document).height()) {
            $('.ins-sd-mn-itm').removeClass('active');
            $('.ins-sd-mn-itm').last().addClass('active');
         }   
      }).scroll(); 
   },
   initReadMore: function() {
      
      if (getViewport().width >= 768) {
         LongCourse.$cdReadMore.readmore('destroy');
         LongCourse.$rqReadMore.readmore('destroy');
      } else {
         LongCourse.$cdReadMore.readmore({
            speed: 75,
            moreLink: '<a href="#" class="btn-ins-lc-rdm" style="margin-top: 29px;" title="Read more">Read more...</a>',
            lessLink: '<a href="#" class="btn-ins-lc-rdl hidden" title="Read less">Read less</a>',
            collapsedHeight: 80
         });
         
         LongCourse.$rqReadMore.readmore({
            speed: 75,
            moreLink: '<a href="#" class="btn-ins-lc-rdm ins-lc-rq" title="Read more">Read more...</a>',
            lessLink: '<a href="#" class="btn-ins-lc-rdl ins-lc-rq hidden" title="Read less">Read less</a>',
            collapsedHeight: 110
         });
      }
      
   }
};

$(function(e) {
   LongCourse.init();

   var insLazyLoad1 = new LazyLoad({
      elements_selector: ".ins-lc-sf-img" 
   });
});

function addPaddingLeft () {
   $slidr = $('.slider-container');
   var baseMdlWidth = 0;
   
   if (getViewport().width > 768) {
      baseMdlWidth = $('.grd-inf-det').width();
      addedPadding = (( (baseMdlWidth - (baseMdlWidth * 0.75)) /  2) + 30) - 55;
      $slidr.css('padding-left', addedPadding + 'px');
   } else {
      $slidr.removeAttr('style');
   }
}