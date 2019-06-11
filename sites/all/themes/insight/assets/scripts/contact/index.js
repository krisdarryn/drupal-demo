var Contact = {
   $address: null,
   map: null,
   $form: null,
   $fname: null,
   $sname: null,
   $email: null,
   $pnumber: null,
   $courseDD: null,
   $hearUsDD: null,
   $message: null,
   $apointment: null,
   init: function() {
      this.$address = $('#ins-ctc-add');
      this.$form = $('#ins-ctc-frm');
      this.$fname = $('#fm-first-name');
      this.$sname = $('#fm-surname');
      this.$email = $('#fm-email');
      this.$pnumber = $('#fm-phone-number');
      this.$courseDD = $('#fm-interested-course');
      this.$hearUsDD = $('#fm-hear-about-us');
      this.$message = $('#fm-message');
      this.$apointment = $('#fm-is-appointment-true');
      
      //this.formatAddress();
      this.$form.on('submit', function(e) {
         var valid = true;
         $.LoadingOverlay("show");
      
         if (!Contact.$fname.val()) {
            Contact.$fname.addClass('err');
            if (Contact.$fname.siblings('.err-msg').length > 0) {
               Contact.$fname.siblings('.err-msg').remove();
            }
            Contact.$fname.after('<p class="err-msg"><i>First name is required.</i></p>');
            valid = false;
            $.LoadingOverlay("hide");
         }
         
         if (!Contact.$sname.val()) {
            Contact.$sname.addClass('err');
            
            if (Contact.$sname.siblings('.err-msg').length > 0) {
               Contact.$sname.siblings('.err-msg').remove();
            }
            
            Contact.$sname.after('<p class="err-msg"><i>Surname is required.</i></p>');
            valid = false;
            $.LoadingOverlay("hide");
         }
         
         if (!Contact.$email.val()) {
            Contact.$email.addClass('err');
            
            if (Contact.$email.siblings('.err-msg').length > 0) {
               Contact.$email.siblings('.err-msg').remove();
            }
            
            Contact.$email.after('<p class="err-msg"><i>Email is required.</i></p>');
            valid = false;
            $.LoadingOverlay("hide");
         }
         
         if (Contact.$courseDD.val() == -1) {
            Contact.$courseDD.addClass('err');
            
            if (Contact.$courseDD.siblings('.err-msg').length > 0) {
               Contact.$courseDD.siblings('.err-msg').remove();
            }
            
            Contact.$courseDD.after('<p class="err-msg"><i>Please select a course you are interested in.</i></p>');
            valid = false;
            $.LoadingOverlay("hide");
         }
         
         if (Contact.$hearUsDD.val() == -1) {
            Contact.$hearUsDD.addClass('err');
            
            if (Contact.$hearUsDD.siblings('.err-msg').length > 0) {
               Contact.$hearUsDD.siblings('.err-msg').remove();
            }
            
            Contact.$hearUsDD.after('<p class="err-msg"><i>Please select where you heard about us.</i></p>');
            valid = false;
            $.LoadingOverlay("hide");
         }
         
         if (!Contact.$message.val()) {
            Contact.$message.addClass('err');
            
            if (Contact.$message.siblings('.err-msg').length > 0) {
               Contact.$message.siblings('.err-msg').remove();
            }
            
            Contact.$message.after('<p class="err-msg"><i>Message is required.</i></p>');
            valid = false;
            $.LoadingOverlay("hide");
         }
         
         if (!valid) {
            e.preventDefault();
         } else {
            e.preventDefault();
            Contact.$form.find('.btn-ins-ctc-fm').attr('disabled', 'disabled');
            
            $.post(Drupal.settings.insight.jsVars.baseUrl + 'contact', Contact.$form.serialize(), function(response) {
               var msg = '';
               
               switch (response.status) {
                  case -1:
                     msg = '<div>' + response.messages.join('<br/') + '</div>';
                     break;
                     
                  case 1:
                     msg = '<p>' + response.messages + '</p>';
                     Contact.$message.val('');
                     Contact.$hearUsDD.val('-1');
                     Contact.$courseDD.val('-1');
                     Contact.$email.val('');
                     Contact.$sname.val('');
                     Contact.$fname.val('');
                     Contact.$pnumber.val('');
                     Contact.$apointment.removeProp('checked');
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
                        dialog.close();
                     }
                  }]
               });

            }).done(function() {
               Contact.$form.find('.btn-ins-ctc-fm').removeAttr('disabled');
               $.LoadingOverlay("hide");
            });
            
         }
         
      });
      
      this.initAction();
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
      
   },
   initAction: function() {
      Contact.$fname.on('blur', Contact.initErrStateUpdate);
      Contact.$sname.on('blur', Contact.initErrStateUpdate);
      Contact.$email.on('blur', Contact.initErrStateUpdate);
      Contact.$courseDD.on('blur', Contact.initErrStateUpdate);
      Contact.$hearUsDD.on('blur', Contact.initErrStateUpdate);
      Contact.$message.on('blur', Contact.initErrStateUpdate);
   }
   
};

$(function(e) {
   Contact.init();
   initScrollTo();

   var insLazyLoad2 = new LazyLoad({
    elements_selector: ".banner-center-text"
  });
  
});

function initScrollTo(){
   var $hash = window.location.hash;
   var $hdr = $('header').outerHeight();
   var $smlBnr = 27;

   if ($hash === '#email-us') {
      $("html, body").animate({
        scrollTop: ($('.ins-ctc-ct-wrp').offset().top - 40) - ($hdr + $smlBnr)
    }, 1500);
   }
}

function initMap() {
   var uluru = {lat: 22.2672478, lng: 114.243525 };
   var gMapStyle = [
          {
              "featureType": "administrative",
              "elementType": "all",
              "stylers": [
                  {
                      "saturation": "-100"
                  }
              ]
          },
          {
              "featureType": "administrative.province",
              "elementType": "all",
              "stylers": [
                  {
                      "visibility": "off"
                  }
              ]
          },
          {
              "featureType": "landscape",
              "elementType": "all",
              "stylers": [
                  {
                      "saturation": -100
                  },
                  {
                      "lightness": 65
                  },
                  {
                      "visibility": "on"
                  }
              ]
          },
          {
              "featureType": "poi",
              "elementType": "all",
              "stylers": [
                  {
                      "saturation": -100
                  },
                  {
                      "lightness": "50"
                  },
                  {
                      "visibility": "simplified"
                  }
              ]
          },
          {
              "featureType": "road",
              "elementType": "all",
              "stylers": [
                  {
                      "saturation": "-100"
                  }
              ]
          },
          {
              "featureType": "road.highway",
              "elementType": "all",
              "stylers": [
                  {
                      "visibility": "simplified"
                  }
              ]
          },
          {
              "featureType": "road.arterial",
              "elementType": "all",
              "stylers": [
                  {
                      "lightness": "30"
                  }
              ]
          },
          {
              "featureType": "road.local",
              "elementType": "all",
              "stylers": [
                  {
                      "lightness": "40"
                  }
              ]
          },
          {
              "featureType": "transit",
              "elementType": "all",
              "stylers": [
                  {
                      "saturation": -100
                  },
                  {
                      "visibility": "simplified"
                  }
              ]
          },
          {
              "featureType": "water",
              "elementType": "geometry",
              "stylers": [
                  {
                      "hue": "#ffff00"
                  },
                  {
                      "lightness": -25
                  },
                  {
                      "saturation": -97
                  }
              ]
          },
          {
              "featureType": "water",
              "elementType": "labels",
              "stylers": [
                  {
                      "lightness": -25
                  },
                  {
                      "saturation": -100
                  }
              ]
          }
      ];
   var map = new google.maps.Map(document.getElementById('ins-ctc-gmap-cnt'), {
      zoom: 17,
      center: uluru,
      styles: gMapStyle
   });
   
   var marker = new google.maps.Marker({
      position: uluru,
      map: map,
      icon: Drupal.settings.insight.jsVars.imgUrl + 'grayscale-dot.png'
   });
   
   /* map.addListener(window, 'resize', function() {
      map.setCenter(uluru);
   }); */
}