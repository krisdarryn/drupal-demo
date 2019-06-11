var $btnLoadMoreResProj = null;
var $btnLoadMoreComProj = null;
var $residentialProjCount = null;
var $commercialProjCount = null;

var readyStateFunc = function (){


   if (getViewport().width < 768) {
      var insLazyLoad1 = new LazyLoad({
         elements_selector: "img" 
      });
   }


   $(window).resize(function() {
      if (getViewport().width < 768) {
         var insLazyLoad1 = new LazyLoad({
            elements_selector: "img" 
         });
      }
   });

   var insLazyLoad2 = new LazyLoad({
      elements_selector: ".banner-center-text"
   });

   var insLazyLoad3 = new LazyLoad({
      elements_selector: ".shcs-bdy-img-hlder" 
   });

   $btnLoadMoreResProj = $('#btnLoadMoreResProj'); // Button to load more residential projects
   $btnLoadMoreComProj = $('#btnLoadMoreComProj'); // Button to load more commercial projects
   $residentialProjCount = $('#residentialProjCount'); // Number of residential projects displayed
   $commercialProjCount = $('#commercialProjCount'); // Number of commercial projects displayed
   
   onclickSeeMoreResidentialProj();
   onclickSeeMoreCommercialProj();
   onclickProject();

};

/*
   * Clicking on button 'See more'
   * Loads 6 more residential project items
   */
  function onclickSeeMoreResidentialProj() {
   $btnLoadMoreResProj.on('click', function(e) {
      e.preventDefault();
      var $parent = $(this).closest('.shcs-bdy');
      
      $parent.css('position', 'relative');
      $parent.append('<div class="active-smridp" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 10;"></div>');
      
      $.ajax({
         type: 'GET',
         url: Drupal.settings.insight.jsVars.ajaxUrl.loadMoreResidentialProj + '?currentProjCount=' + $residentialProjCount.val(),
         dataType: 'html',
         success: function(html) {
            $parent.removeAttr('style');
            $parent.find('.active-smridp')
                   .remove();
                   
            if (html !== '') {
               // Display the new fetched residential project items
               $('.rsdncial-schcs .row').append(html);
               onclickProject(); // Bind project item on click event
               
               // Update current number of displayed residential project items
               var newProjCount = parseInt($residentialProjCount.val()) + 6;
               $residentialProjCount.val(newProjCount);
               
               // Hide see more button if no more residential projects to load
               if (newProjCount > Drupal.settings.insight.studentWorkVars.allResProjListSize) {
                  $btnLoadMoreResProj.parent().parent().addClass('hidden');
               }
            }
         }
      });
   });
}

/*
* Clicking on button 'See more'
* Loads 6 more commercial project items
*/
function onclickSeeMoreCommercialProj() {
   $btnLoadMoreComProj.on('click', function(e) {
      e.preventDefault();
      var $parent = $(this).closest('.shcs-bdy');
      
      $parent.css('position', 'relative');
      $parent.append('<div class="active-smcidp" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 10;"></div>');
      
      $.ajax({
         type: 'GET',
         url: Drupal.settings.insight.jsVars.ajaxUrl.loadMoreCommercialProj + '?currentProjCount=' + $commercialProjCount.val(),
         dataType: 'html',
         success: function(html) {
            $parent.removeAttr('style');
            $parent.find('.active-smcidp')
                   .remove();
            
            if (html !== '') {
               // Display the new fetched commercial project items
               $('.cmrcial-schcs .row').append(html);
               onclickProject(); // Bind project item on click event
               
               // Update current number of displayed commercial project items
               var newProjCount = parseInt($commercialProjCount.val()) + 6;
               $commercialProjCount.val(newProjCount);
               
               // Hide see more button if no more commercial projects to load
               if (newProjCount > Drupal.settings.insight.studentWorkVars.allComProjListSize) {
                  $btnLoadMoreComProj.parent().parent().addClass('hidden');
               }
            }
         }
      });
   });
}

/*
* Clicking on project item will show its details in a modal
* Applied to first group of project items loaded
*/

function onclickProject() {      
   $('.proj').on('click', function() {         
      $.ajax({
         type: 'GET',
         url: Drupal.settings.insight.jsVars.ajaxUrl.showProjectDetails + '?nid=' + $(this).data('nid'),
         dataType: 'html',
         success: function(html) {
            if (html !== '') {
               $('#mdl-wrap').html(html);
               $('#showcaseModal').modal('show');
               onshownProjectModal();
            }
         }
      });
   }).removeClass('proj');
}

function onshownProjectModal() {
   $('#showcaseModal').on('shown.bs.modal', function () {
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
         $.each(slick.$slides, function(index, element) {
            var $element = $(element);
            $element.css('width', ($element.find('.sldr-img-wrpr').width() + 15) + 'px');
         });
      }).slick({
         cssEase: 'linear',
         lazyLoad: 'progressive',
         slidesToShow: 1,
         slidesToScroll: 1,
         variableWidth: true,
         dots: false,
         infinite: false,
         nextArrow:"<img class='next-slide-btn slick-next hidden-xs' src='" + Drupal.settings.insight.jsVars.imgUrl + "next-arrow-slide.svg'>",
         prevArrow:"<img id='prevBtnShwcse' class='prev-slide-btn slick-prev hidden-xs' src='" + Drupal.settings.insight.jsVars.imgUrl + "prev-arrow-slide.svg'>",
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

  });
}

$(readyStateFunc);
