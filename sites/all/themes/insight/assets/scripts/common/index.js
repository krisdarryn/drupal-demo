var $footer = null;
var $mainContent = null;
var $ftLearn = null;
var $ftExplore = null;
var $ftExperience = null;
var $ftConnect = null;
var $flag = 0;
var $nlForm = null;
var $nlFirstName = null;
var $nlSurName = null;
var $nlEmail = null;
var $nlPhone = null;

$(function(e) {
   
   var bannerHeight = $('.banner-center-text').outerHeight();
   var bannerHeight2 = $('.ins-ctc-bnr').outerHeight();
   var bannerHeight3 = $('.ins-ec-hd').outerHeight();
   var bannerHeight4 = $('.ins-lc-bnr').outerHeight();
   var bannerHeight5 = $('.booking-banner').outerHeight();
   var navbarHeight = $('.desk-menu-navbar').outerHeight();
   var headerHeightOrig = $('.mn-hdr-bg').outerHeight()
   var headerHeight = headerHeightOrig + bannerHeight + bannerHeight2 + bannerHeight3 + bannerHeight4 + bannerHeight5 + navbarHeight;
   var headerBox =$('.mn-hdr-bg');
   $footer = $('#ins-ftr-cntr');
   $mainContent = $('#ins-mn-bdy-cntr');
   $ftLearn = $('#learn-menu-lists');
   $ftExplore = $('#explore-menu-lists');
   $ftExperience = $('#experience-menu-lists');
   $ftConnect = $('#connect-menu-lists');
   
   $(window).scroll(function(){
      if ($(window).scrollTop() === 0) {
         $('.mn-hdr-bg').removeClass('fixed-header');

      /**} else if ($(window).scrollTop() < (headerHeightOrig + bannerHeight + bannerHeight2)) {
         console.log(headerHeightOrig + bannerHeight + bannerHeight2);
         $('.desk-menu-navbar').removeClass('mnu-nvbar-fixed');
         $('.banner-center-text').removeClass('bnr-fixed');
         $('.ins-ctc-bnr').removeClass('bnr-fixed');**/

      } 
      
      if ($(window).scrollTop() >= headerHeightOrig) {

         if ( !$('.mn-hdr-bg').hasClass( "fixed-header" ) )  {
            TweenMax.to(headerBox, 0, {
               opacity: 0,
               onComplete: function() {
                  TweenMax.to(headerBox, 0.9, {
                     opacity: 1
                  });
               } 
            });

            $('.mn-hdr-bg').addClass('fixed-header');
            
         }
      } 
      
      if (($(window).scrollTop() >= (bannerHeight + bannerHeight2 + bannerHeight3 + bannerHeight4 + bannerHeight5 - 34)) && (getViewport().width > 768)){
         
         if ( !$('.banner-center-text').hasClass( "bnr-fixed" ) )  {
            TweenMax.to($('.banner-center-text'), 0, {
               opacity: 0,
               onComplete: function() {
                  TweenMax.to($('.banner-center-text'), 0.5, {
                     opacity: 1
                  });
               } 
            });
         }
         
         if ( !$('.ins-ctc-bnr').hasClass( "bnr-fixed" ) )  {
            TweenMax.to($('.ins-ctc-bnr'), 0, {
               opacity: 0,
               onComplete: function() {
                  TweenMax.to($('.ins-ctc-bnr'), 0.9, {
                     opacity: 1
                  });
               } 
            });
         }

         if ( !$('.ins-ec-hd').hasClass( "bnr-fixed" ) )  {
            TweenMax.to($('.ins-ec-hd'), 0, {
               opacity: 0,
               onComplete: function() {
                  TweenMax.to($('.ins-ec-hd'), 0.9, {
                     opacity: 1
                  });
               } 
            });
         }

         if ( !$('.ins-lc-bnr').hasClass( "bnr-fixed" ) )  {
            TweenMax.to($('.ins-lc-bnr'), 0, {
               opacity: 0,
               onComplete: function() {
                  TweenMax.to($('.ins-lc-bnr'), 0.9, {
                     opacity: 1
                  });
               } 
            });
         }

         if ( !$('.booking-banner').hasClass( "bnr-fixed" ) )  {
            TweenMax.to($('.booking-banner'), 0, {
               opacity: 0,
               onComplete: function() {
                  TweenMax.to($('.booking-banner'), 0.9, {
                     opacity: 1
                  });
               } 
            });
         }


         if ( !$('.desk-menu-navbar').hasClass( "mnu-nvbar-fixed" ) )  {
            TweenMax.to($('.desk-menu-navbar'), 0, {
               opacity: 0,
               onComplete: function() {
                  TweenMax.to($('.desk-menu-navbar'), 0.9, {
                     opacity: 1
                  });
               } 
            });
         }
         
         $('.desk-menu-navbar').addClass('mnu-nvbar-fixed');
         $('.banner-center-text').addClass('bnr-fixed');
         $('.ins-ctc-bnr').addClass('bnr-fixed');
         $('.ins-ec-hd').addClass('bnr-fixed');
         $('.ins-lc-bnr').addClass('bnr-fixed');
         $('.booking-banner').addClass('bnr-fixed');
         
      } else {
         $('.banner-center-text').removeClass('bnr-fixed');
         $('.ins-ctc-bnr').removeClass('bnr-fixed');
         $('.desk-menu-navbar').removeClass('mnu-nvbar-fixed');
         $('.ins-ec-hd').removeClass('bnr-fixed');
         $('.ins-lc-bnr').removeClass('bnr-fixed');
         $('.booking-banner').removeClass('bnr-fixed');
      }
   });
   
    $('#landing-menu-button').click(function () {
       $("#mb-nav-ovly-wrp").show();
     });
   
   $('#btn-close-nav').click(function () {
      $("#mb-nav-ovly-wrp").hide();
   });
   
    $('.main-nav-item').hover(
      function(e) {
         e.stopPropagation();
         $(this).find('ul').toggle();
      }
   );

   $('.main-nav-item').click(
      function(e) {
         e.stopPropagation();
         $(this).find('ul').show();
      }
   );

   $('#featured-menu-list li').each(function(index){
      if($($(this)).hasClass('active')) {
         $(this).closest('.mn-itm').addClass('active');
      }
   });
   
   onclickNewsLetter();
   initFooterCollapseEvent();
   newsletterRegistration();
});

function onclickNewsLetter() {
   
   $('.sign-up-modal').on('click', function(e) {
      e.preventDefault();
      $.ajax({
         type: 'GET',
         url: Drupal.settings.insight.jsVars.ajaxUrl.showNewsletterForm,
         dataType: 'html',
         success: function(html) {
            if (html != '') {
               $('#mdl-wrap').html(html);
               $('#newsletterModal').modal('show');
               
               $nlForm = $('#newsletter-registration-form');
               $nlFirstName = $('#nl-first-name');
               $nlSurName = $('#nl-last-name');
               $nlEmail = $('#nl-email');
               $nlPhone = $('#nl_phone');
            }
         }
      });
   });
   
}

/**
* In Mobile viewport each time site map will expand
* will have to calculate padding of the main content
*
* @return void
*/
function calculateContentPad() {
   var padBot = 0;

   if (
      !$ftLearn.hasClass('in') && 
      !$ftExplore.hasClass('in') && 
      !$ftExperience.hasClass('in') && 
      !$ftConnect.hasClass('in')
   ) {
      $mainContent.css('padding-bottom', '');
   } else {
      $mainContent.css('padding-bottom', $footer.outerHeight(true) + 'px');
   }
   
}

function initFooterCollapseEvent() {
   
   $ftLearn.on('shown.bs.collapse', function() {
      calculateContentPad();
   }).on('hidden.bs.collapse', function() {
      calculateContentPad();
   });
   
   $ftExplore.on('shown.bs.collapse', function() {
      calculateContentPad();
   }).on('hidden.bs.collapse', function() {
      calculateContentPad();
   });
   
   $ftExperience.on('shown.bs.collapse', function() {
      calculateContentPad();
   }).on('hidden.bs.collapse', function() {
      calculateContentPad();
   });
   
   $ftConnect.on('shown.bs.collapse', function() {
      calculateContentPad();
   }).on('hidden.bs.collapse', function() {
      calculateContentPad();
   });
   
   $(window).on('resize', function(e){
      
      if (getViewport().width <= 768) {
         calculateContentPad();
      } 
      
      if (getViewport().width > 768) {
         $mainContent.css('padding-bottom', '');
      }
      
   });
   
}

/**
 * Newsletter Registration submit function
 *
 * @return void
 */
function newsletterRegistration() {
   
   $(document).on('submit', '#newsletter-registration-form', function(e) {
      var valid = true;
      e.preventDefault();
      $.LoadingOverlay("show");
      
      if (!$nlFirstName.val()) {
         $nlFirstName.addClass('err');
         if ($nlFirstName.siblings('.err-msg').length > 0) {
            $nlFirstName.siblings('.err-msg').remove();
         }
         $nlFirstName.after('<p class="err-msg"><i>First name is required.</i></p>');
         valid = false;
         $.LoadingOverlay("hide");
      }
      
      if (!$nlSurName.val()) {
         $nlSurName.addClass('err');
         if ($nlSurName.siblings('.err-msg').length > 0) {
            $nlSurName.siblings('.err-msg').remove();
         }
         $nlSurName.after('<p class="err-msg"><i>Surname is required.</i></p>');
         valid = false;
         $.LoadingOverlay("hide");
      }
      
      if (!$nlEmail.val()) {
         $nlEmail.addClass('err');
         if ($nlEmail.siblings('.err-msg').length > 0) {
            $nlEmail.siblings('.err-msg').remove();
         }
         $nlEmail.after('<p class="err-msg"><i>Email is required.</i></p>');
         valid = false;
         $.LoadingOverlay("hide");
      }
      
      if (valid) {
         $nlForm.find('#submit')
                .attr('disabled', 'disabled');
                
         $.post(Drupal.settings.insight.jsVars.ajaxUrl.newletterRegistration, $nlForm.serialize(), function(response) {
            var msg = '';
            
            switch (response.status) {
               case -1:
                  msg = '<div>' + response.messages.join('<br/') + '</div>';
                  break;
                  
               case 1:
                  msg = '<p>' + response.messages + '</p>';
                  $nlFirstName.val('');
                  $nlFirstName.removeClass('err');
                  $nlSurName.val('');
                  $nlSurName.removeClass('err');
                  $nlEmail.val('');
                  $nlEmail.removeClass('err');
                  $nlPhone.val('');
                  $nlPhone.removeClass('err');
                  $('.err-msg').remove();
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
                     $('#newsletterModal').modal('hide');
                     dialog.close();
                  }
               }]
            });
               
         }).done(function() {
            $nlForm.find('#submit')
                   .removeAttr('disabled');
                   
            $.LoadingOverlay("hide");
         });
      }
      
   });
   
   $(document).on('blur', '#nl-first-name', initErrStateUpdateNL);
   $(document).on('blur', '#nl-last-name', initErrStateUpdateNL);
   $(document).on('blur', '#nl-email', initErrStateUpdateNL);
}

function initErrStateUpdateNL() {
   var $self = $(this);
   
   if ($self.val()) {
      $self.removeClass('err');
      
      if ($self.siblings('.err-msg').length) {
         $self.siblings('.err-msg')
              .remove()
      }
   }
}