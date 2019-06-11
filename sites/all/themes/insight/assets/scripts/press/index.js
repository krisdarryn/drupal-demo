var readyFunc = function () {

   var insLazyLoad1 = new LazyLoad({
      elements_selector: "img" 
   });

   var insLazyLoad2 = new LazyLoad({
      elements_selector: ".banner-center-text"
   });

   $('#btn-sh-mr-press').on('click', function(e) {
      e.preventDefault();
      $('#btn-sh-mr-press').closest('.btn-sh-mr-press-wrp').remove();
      $('.excess-default-no').slideDown(function() {
         $('.press-schcs').removeClass('press-hd-mb-exc');
      });
   
   });

};


$(readyFunc);