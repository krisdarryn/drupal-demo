var $ddSelected = null;
var $noSCWrpMsgWrp = null;
var $noSCWrpMsgLbl = null;

$(function(e) {
   $ddSelected = $('#sc-dd-selected');   
   $noSCWrpMsgWrp = $('#no-sc-msg-wrp');
   $noSCWrpMsg = $('#no-sc-msg');
   
   initAction();

   var insLazyLoad1 = new LazyLoad({
      elements_selector: ".course-image-container" 
   });

   var insLazyLoad2 = new LazyLoad({
      elements_selector: ".banner-center-text"
   });
   
});

function initAction() {
   
   $('.sc-dd-item-lbl').on('click', function(e) {
      e.preventDefault();
      var $this = $(this);
      var $parent = $this.closest('.sc-dd-item');
      
      $('.sc-dd-item').removeClass('active');
      $parent.addClass('active');
      
      $ddSelected.html($this.html());
      
      filterCourse($this.data('val'));
   });

   //updateEllipsesPosition();
}

/*function updateEllipsesPosition(){
   if ($(window).width() > 768) {
      $('.course-details').each(function(i, elem){
         if ($(elem).outerHeight() < 50){
            $(elem).css({
               'height' : '35px',
               'padding-top' : '5px'
            });
            $(elem).prev().css({
               'height' : '42px',
               '-webkit-line-clamp' : '2'
            });
         } else {
            $(elem).css({
               'height' : '56px',
               'display' : '-webkit-box'
            });

            $(elem).prev().css({
               'height' : '21px',
               '-webkit-line-clamp' : '1'
            });
         }
      });
   } 
}*/


function filterCourse($value) {
   
   $noSCWrpMsgWrp.addClass('hide');
   
   if ($value === 'all-courses') {
      $('.sc-course-item').removeClass('hidden-xs');
   } else if ($value === 'pending') {
      $('.sc-course-item').removeClass('hidden-xs');
      $('.sc-course-item:not(.pending)').addClass('hidden-xs');
   } else {
      $('.sc-course-item').removeClass('hidden-xs');
      $('.sc-course-item:not(.' + $value + ')').addClass('hidden-xs');
      
      if ($('.sc-course-item.' + $value).length <= 0) {
         $noSCWrpMsgWrp.removeClass('hide');
         $noSCWrpMsg.html($value.substr(0, 1).toUpperCase() + $value.substr(1));
      }
      
   }
   adjustClearfix();
   
}

function adjustClearfix(){
   $('.clearfix.visible-xs').remove();
   var ctr = 1; 
   $('.sc-course-item').each( function( key, value ){
      if (!$(this).hasClass("hidden-xs")) {

         if ( ctr % 1 == 0 ) {
            if ($(this).hasClass("right")) {
               $(this).removeClass( "right");
               $(this).addClass( "left");
            }
         }
         if ( ctr % 2 === 0 ) {
            $(this).addClass( "right" );
            $(this).after('<div class="clearfix visible-xs"></div>');
         }
         ctr = ctr + 1;
      }
   });
}
