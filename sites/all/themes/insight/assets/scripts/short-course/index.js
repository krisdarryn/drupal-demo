var ShortCourse = {
   $staffSlick: null,
   stickySideMenu: null,
   $cdReadMore: null,
   $form: null,
   $fname: null,
   $lname: null,
   $email: null,
   $studFBSlick: null,
   $studFBItems: null,
   init: function() {
      this.$staffSlick = $('.ins-lc-sf-list');
      this.$cdReadMore = $('#ins-lc-sc-cd-rdm');
      this.$form = $('#ins-cs-gn-frm');
      this.$fname = $('#gn-first-name');
      this.$lname = $('#gn-last-name');
      this.$email = $('#gn-email');
      this.$studFBSlick = $('.ins-lc-sf-qh-list');
      this.$studFBItems = $('.ins-lc-sf-qh-bd');
      this.stickySideMenu = new Sticky('.ins-lc-sb-mn-wrp');
      
      this.initSlick();
      this.initWindowResizeEvent();
      this.initSideMenuEvent();
      this.initReadMore();
      this.initEvent();
      this.initBookNow();
      
      this.$form.on('submit', function(e) {
         var valid = true;
         $.LoadingOverlay("show");
      
         if (!ShortCourse.$fname.val()) {
            ShortCourse.$fname.addClass('err');
            if (ShortCourse.$fname.siblings('.err-msg').length > 0) {
               ShortCourse.$fname.siblings('.err-msg').remove();
            }
            ShortCourse.$fname.after('<p class="err-msg"><i>First name is required.</i></p>');
            valid = false;
            $.LoadingOverlay("hide");
         }
         
         if (!ShortCourse.$lname.val()) {
            ShortCourse.$lname.addClass('err');
            
            if (ShortCourse.$lname.siblings('.err-msg').length > 0) {
               ShortCourse.$lname.siblings('.err-msg').remove();
            }
            
            ShortCourse.$lname.after('<p class="err-msg"><i>Last name is required.</i></p>');
            valid = false;
            $.LoadingOverlay("hide");
         }
         
         if (!ShortCourse.$email.val()) {
            ShortCourse.$email.addClass('err');
            
            if (ShortCourse.$email.siblings('.err-msg').length > 0) {
               ShortCourse.$email.siblings('.err-msg').remove();
            }
            
            ShortCourse.$email.after('<p class="err-msg"><i>Email is required.</i></p>');
            valid = false;
            $.LoadingOverlay("hide");
         }
         
         if (!valid) {
            e.preventDefault();
         } else {
            e.preventDefault();
            ShortCourse.$form.find('.btn-ing-cs-gn').attr('disabled', 'disabled');
            
            $.post(Drupal.settings.insight.jsVars.baseUrl + Drupal.settings.insight.shortCourseVars.url, ShortCourse.$form.serialize(), function(response) {
               var msg = '';
               
               switch (response.status) {
                  case -1:
                     msg = '<div>' + response.messages.join('<br/') + '</div>';
                     break;
                     
                  case 1:
                     msg = '<p>' + response.messages + '</p>';
                     ShortCourse.$email.val('');
                     ShortCourse.$lname.val('');
                     ShortCourse.$fname.val('');
                     
               }
               
               BootstrapDialog.show({
                  title: response.title,
                  type: BootstrapDialog.TYPE_DEFAULT,
                  message: msg,
                  cssClass: 'ins-prog-modal',
                  buttons: [{
                     label: 'OK',
                     cssClass: 'btn-ins-drk',
                     action: function(dialog) {
                        dialog.close()
                     }
                  }]
               });

            }).done(function() {
               ShortCourse.$form.find('.btn-ing-cs-gn').removeAttr('disabled');
               $.LoadingOverlay("hide");
            });
            
         }
         
      });
   },
   initSlick: function() {
      ShortCourse.$staffSlick
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
                  dots: false,
                  variableWidth: true,
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
               
      // Student feedback slick init
      ShortCourse.resizeStudentFeedbackContainer();
      ShortCourse.$studFBSlick
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
                  
               }).on('beforeChange', function(event, slick, currentSlide, nextSlide) {

                  nextHeight = slick.$slides[nextSlide].offsetHeight;
                  if (nextHeight){
                     $( ".ins-lc-sf-qh-list" ).animate({
                        height: nextHeight
                      }, 300);
                  }
                  
               
            });
   },
   initEvent: function() {

      // Show m2 staff details
      $(document).on('click', '.btn-ins-lc-sf-itm', function(e) {
         e.preventDefault();
         
         $.ajax({
            type: 'GET',
            url: Drupal.settings.insight.jsVars.ajaxUrl.showTeacherDetails + '?nid=' + $(this).data('nid'),
            dataType: 'html',
            success: function(html) {
               if (html) {
                  $('#mdl-wrap').html(html);
                  $('#ins-mdl').modal('show');
               }
            }
         }).done(function(data, textStatus, jqXHR) {
            
         });
         
      });
      
      $(document).on('shown.bs.modal', '#ins-mdl', function(){
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
   
         var $grid = $('.grid').imagesLoaded( function() {
            // init Masonry after all images have loaded
            $grid.masonry({
               itemSelector: '.grid-item',
               columnWidth: 1
            });
         });

      });
      
      ShortCourse.$fname.on('blur', ShortCourse.initErrStateUpdate);
      ShortCourse.$lname.on('blur', ShortCourse.initErrStateUpdate);
      ShortCourse.$email.on('blur', ShortCourse.initErrStateUpdate);
   },
   initBookNow: function() {
      $("#btnBookNow, #book-online-btn").click(function() {
         if ($('#bookschedule').val() == -1) {
            alert('Please select a schedule to book.');
         } else {
            $('#formBooking').submit();
         }
      });
   },
   resizeStudentFeedbackContainer: function() {
      ShortCourse.$studFBItems
                .css('width', ShortCourse.$studFBSlick.width());
   },
   refreshStudentFeedbackSlick: function() {
      ShortCourse.$studFBSlick
                .slick('getSlick')
                .refresh();
   },
   initWindowResizeEvent: function() {
      $(window).on('resize', function(e){
         ShortCourse.initReadMore();
         ShortCourse.resizeStudentFeedbackContainer();
         ShortCourse.refreshStudentFeedbackSlick();
         
         /* if (getViewport().width >= 768) {
               
         } */
         
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
            scrto = $(target).offset().top - 155;
         }
         
         // perform animated scrolling by getting top-position of target-element and set it as scroll target
         $('html, body').stop().animate({
               scrollTop: (scrto - 10)
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
         ShortCourse.$cdReadMore.readmore('destroy');
      } else {
         ShortCourse.$cdReadMore.readmore({
            speed: 75,
            moreLink: '<a href="#" class="btn-ins-lc-rdm" style="margin-top: 29px;" title="Read more">Read more...</a>',
            lessLink: '<a href="#" class="btn-ins-lc-rdl hidden" title="Read less">Read less</a>',
            collapsedHeight: 80
         });
      }
      
   },
   initErrStateUpdate: function(e) {
      var $self = $(this);
      
      if ($self.hasClass('ins-dd') && ($self.val() != -1)) {

         $self.removeClass('err');
         
         if ($self.siblings('.err-msg').length) {
            $self.siblings('.err-msg')
                 .remove()
         }
      } 
      
      if ($self.val()) {
         $self.removeClass('err');
         
         if ($self.siblings('.err-msg').length) {
            $self.siblings('.err-msg')
                 .remove()
         }
      }
      
   }
};

$(function(e) {
   ShortCourse.init();

   var insLazyLoad1 = new LazyLoad({
      elements_selector: "img" 
   });

   var insLazyLoad2 = new LazyLoad({
      elements_selector: ".ins-lc-bnr"
   });
   
   var insLazyLoad2 = new LazyLoad({
      elements_selector: ".ins-lc-sf-img"
   });
   
   var insLazyLoad2 = new LazyLoad({
      elements_selector: ".ins-lc-ci"
	});

   if ($('#bookschedule option').size() > 1) {
      $("#bookschedule").val($("#bookschedule option:eq(1)").val());
   } 
   
});