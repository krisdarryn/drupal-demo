var ExecutiveCourse = {
   init: function() {
      this.initReadmore();
   },
   initReadmore: function() {
      
      $('.ins-ec-itm-cnt-bd').readmore({
         collapsedHeight: 235,
         moreLink: '<a href="#" class="btn-ins-ec-itm-rm">Read more</a>',
         lessLink: '<a href="#" class="btn-ins-ec-itm-rm hidden">Close</a>',
         afterToggle: function(trigger, element, expanded) {
            
            if (expanded) {
               element.readmore('destroy');
            }
            
         }
      });
   }
};

$(function(e) {
   ExecutiveCourse.init();

   var insLazyLoad2 = new LazyLoad({
      elements_selector: ".banner-center-text"
	});
	
	var insLazyLoad2 = new LazyLoad({
      elements_selector: ".ins-ec-img"
   });
});