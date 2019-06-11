var $CURRENT_JOB_COUNT = null;
var newJobCount = 0;

var readyFunc = function () {

   var insLazyLoad1 = new LazyLoad({
      elements_selector: "img" 
   });

   var insLazyLoad2 = new LazyLoad({
      elements_selector: ".banner-center-text"
   });

    $CURRENT_JOB_COUNT = $('#currentJobCount');

    $('#show-more').on('click', function(e) {
        e.preventDefault();

        $.ajax({
           type: 'GET',
           url: Drupal.settings.insight.jsVars.ajaxUrl.showMoreJobs + '?currentJobCount=' + $CURRENT_JOB_COUNT.val(),
           dataType: 'html',
           success: function(html) {
              // Display the new fetched job items
              $('.jb-brd-psts').append(html);
              
              // Update current number of displayed job items
              newJobCount = parseInt($CURRENT_JOB_COUNT.val()) + 8;
              $CURRENT_JOB_COUNT.val(newJobCount);
              
              // Hide show more button if no more jobs to load
              if (newJobCount > Drupal.settings.insight.jobVars.allJobListSize) {
                 $('.ld-mre-pst .row').addClass('hidden');
              }
           }
        });
     });

};

$(readyFunc);