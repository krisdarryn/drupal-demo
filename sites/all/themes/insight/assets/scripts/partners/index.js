$(function (e) {


   var insLazyLoad1 = new LazyLoad({
      elements_selector: "img" 
   });

   var insLazyLoad2 = new LazyLoad({
      elements_selector: ".banner-center-text"
   });
   
   $('#btn-sh-mr-prtnr').on('click', function(e) {
      e.preventDefault();
      
      $('.excess-default-no').slideDown(function() {
         $('.list-section-wrp').removeClass('prtnr-hd-mb-exc');
         $('#btn-sh-mr-prtnr').closest('.btn-sh-mr-prtnr-wrp')
                              .remove();
      });
      
   });
}); 