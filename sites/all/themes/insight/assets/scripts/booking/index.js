function validateForm() {
    var errors = [];      
    
    if ($('#firstName').val() == '') {
       errors.push('Please specify the first name.');
    }
    
    if ($('#surName').val() == '') {
       errors.push('Please specify the surname.');
    }
    
    if ($('#email').val() == '') {
       errors.push('Please specify the email.');
    }
    
    if ($('#phone').val() == '') {
       errors.push('Please specify the phone.');
    }
    
    if ($('#occupation').val() == '') {
       errors.push('Please specify the occupation.');
    }
    
    if (! $("#tnc-booking").is(":checked")) {
       errors.push('Please confirm on term and conditions.');
    }
    
    if (errors.length > 0) {
       $('#errmsg').html(errors.join('<br>'));
       $('#errMsgModal').modal('show');
       $('#isSaveRegistration').val(0);
       return false;
    } else {
       $('#isSaveRegistration').val(1);
    }
 }
 
function recaptchaCallback() {
    $('#btnBookingSubmit').removeAttr('disabled');
    if( window.innerWidth < 768 ) {
      try{
        var h = $('.information-section.container').height()+$('.booking-banner').height()+$('.form-group.tnc-container').position().top;
        $('html, body').animate({ scrollTop: h }, 0);
      } catch(e){}
    }
}

$(function(e) {

   var $submitPayment = $('#submitPayment');
   var $noticePaypal = $('#noticePaypal');
   var totalFee = Drupal.settings.insight.booking.courseTotalFee;
   
   if (totalFee == '' || totalFee <= 0) {
      $submitPayment.addClass('disabled');
   }
      
   $submitPayment.click(function() {
      if (! $submitPayment.hasClass('disabled')) {
         $submitPayment.addClass('disabled');
         
         // For paypal payment.
         if ($('input[name="optpayment"]:checked').val() == 'paypal') {            
            var $btnPay = $('#custom-payment-form #edit-save');
            if ($btnPay.length > 0) {
               $btnPay.click(); // Redirect to paypal plugin form
            }
         }
         
         // For bank transfer payment
         if ($('input[name="optpayment"]:checked').val() === 'banktransfer') {
            $('#custom-payment-bank-transfer-form').submit();
         }
         
      }
   });
   
   $('#radio-banktransfer').click(function() {
      if ($('#radio-banktransfer').is(':checked')) {
         $noticePaypal.addClass('hidden');
         $submitPayment.text('Confirm your registration');
      }       
   }); 

   $oldVal = $submitPayment.html();
   
   $('#radio-paypal').click(function() {
      if ($('#radio-paypal').is(':checked')) {
         $noticePaypal.removeClass('hidden');
         $submitPayment.html($oldVal);
      }
   });
});

