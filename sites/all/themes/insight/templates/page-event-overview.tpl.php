<?php
global $base_url;
$images_path = $base_url .'/'. drupal_get_path('theme', 'insight') . '/dist/images/';
$showUpcoming = $showPast = false;

if (
   (!isset($_GET['page']) && !isset($_GET['type'])) ||
   (isset($_GET['page']) && ($_GET['page'] == 1)) ||
   (isset($_GET['type']) && $_GET['type'] && ($_GET['type'] == 'upcoming'))
) {
   $showUpcoming = true;
}

if (
   (!isset($_GET['page']) && !isset($_GET['type'])) ||
   (isset($_GET['page']) && ($_GET['page'] == 1)) ||
   (isset($_GET['type']) && $_GET['type'] && ($_GET['type'] == 'past'))
) {
   $showPast = true;
}
?>

<div id="ins-mn-bdy-cntr" class="common sml-bnr2">
   <div>
      <div class="banner-center-text" data-src="<?php print isset($bannerImageUrl) ? $bannerImageUrl : ''; ?>">; 
         <div class="banner-content"> 
         <p id="mob-banner-text"><?php print isset($bannerSlogan) ? $bannerSlogan : ''; ?></p> 
         </div>
      </div>
   </div>
   
   <div class="event-section-container container">
      
         <div class="event-section-title" <?php print (!$showUpcoming ? 'style="display: none;"' : ''); ?> >
            <h1 class="evt-ovw-h1-tle"><?php print t('Upcoming events');?></h1>
         </div>
         <div class="upcoming-events-section" <?php print (!$showUpcoming ? 'style="display: none;"' : ''); ?> >
            <div class="row zero-margin">
               <div class="event-inside col-xs-12 col-sm-12">
                  <?php $ctr = 1; ?>
                  <?php $defaultCharLimit = 244; // default char limit: 78 (event title) + 166 (event content) ?>
                  
                  <?php if (isset($upcomingEventList) && count($upcomingEventList) > 0) : ?>                  
                     <?php foreach ($upcomingEventList as $item): ?>
                        <?php $isEven = ($ctr > 0 && fmod($ctr, 2) == 0) ? TRUE : FALSE; ?>
                        
                        <div class="row event-inside-row<?php print ($isEven) ? ' clearfix' : ''; ?>">
                           <div class="col-xs-12 col-sm-8 event-image-container<?php print ($isEven) ? ' pull-right' : ''; ?>">
                              <div class="event-image" data-src="<?php print isset($item['coverImageUrl']) ? $item['coverImageUrl'] : ''; ?>">
                              </div>
                           </div>
                           
                           <div class="col-xs-12 col-sm-4 event-content-container">
                              <div class="event-content">
                                 <h3 class="event-title"><?php print isset($item['title']) ? $item['title'] : ''; ?></h3>
                                 <p class="event-date"><?php print isset($item['date']) ? $item['date'] : ''; ?></p>
                                 <p class="event-date"><?php print isset($item['time']) ? $item['time'] : ''; ?></p>
                                 
                                 <div class="event-details">
                                    <?php
                                    if (isset($item['shortIntroDescription'])) {
                                       $titleLen = (isset($item['title'])) ? strlen($item['title']): 0;
                                       $descriptionLimit = $defaultCharLimit - $titleLen;
                                       $totalLen = $titleLen + strlen($item['shortIntroDescription']);
                                       $trimmedDescription = ($totalLen > $defaultCharLimit) ? substr($item['shortIntroDescription'], 0 , $descriptionLimit).'...' : $item['shortIntroDescription'];
                                       print $trimmedDescription;
                                    }
                                    ?>
                                 </div>

                                 <div class="event-continue">
                                    <a href="<?php print drupal_get_path_alias("node/{$item['nid']}"); ?>" title="continue" class="btn-continue"><?php print isset($linkBtnCaption) ? $linkBtnCaption : t('Continue reading'); ?></a>
                                 </div>
                              </div>
                           </div>
                        </div>
                        
                        <?php $ctr++; ?>
                     <?php endforeach; ?>
                  <?php endif; ?>
               </div>
            </div>
         </div>
         <div class="event-pagination clearfix" <?php print (!$showUpcoming ? 'style="display: none;"' : ''); ?> >
            <?php
               $tmpCount1 = ceil($upcomingEventListSize / 4);
               $params = array();
               $params['href'] = "{$base_url}/event?";                           
               $params['allListSize'] = $upcomingEventListSize;
               $params['activePage'] = $page;
               
               if ($upcomingEventListSize <= 4) {
                  $params['limit'] = 2;
               } else {
                  $params['limit'] = 4;
               }
               
               $params['isUpcomingEventPagination'] = true;
               
               $block = module_invoke('custompage', 'block_view', 'pagination', $params);
               print render($block['content']);
           ?>
         </div>

         <div class="past-event-title event-section-title" <?php print (!$showPast ? 'style="display: none;"' : ''); ?> >
            <h2><?php print t('Past events');?></h2>
         </div>
         <div class="past-events-section" <?php print (!$showPast ? 'style="display: none;"' : ''); ?> >
            <div class="row zero-margin">
               <div class="event-inside col-xs-12 col-sm-12">
                  <?php $ctr = 1; ?>
                  <?php if (isset($pastEventList) && count($pastEventList) > 0) : ?>
                     <?php foreach ($pastEventList as $item): ?>
                        <?php $isEven = ($ctr > 0 && fmod($ctr, 2) == 0) ? TRUE : FALSE; ?>
                        
                        <div class="row event-inside-row<?php print ($isEven) ? ' clearfix' : ' odd'; ?>">
                           <div class="col-xs-12 col-sm-8 event-image-container<?php print ($isEven) ? ' pull-right' : ''; ?>">
                              <div class="event-image" data-src="<?php print isset($item['coverImageUrl']) ? $item['coverImageUrl'] : ''; ?>">
                              </div>
                           </div>
                           
                           <div class="col-xs-12 col-sm-4 event-content-container">
                              <div class="event-content">
                                 <h3 class="event-title"><?php print isset($item['title']) ? $item['title'] : ''; ?></h3>
                                 <p class="event-date"><?php print isset($item['date']) ? $item['date'] : ''; ?></p>
                                 <p class="event-date"><?php print isset($item['time']) ? $item['time'] : ''; ?></p>
                                 
                                 <div class="event-details">
                                    <?php
                                    if (isset($item['shortIntroDescription'])) {
                                       $titleLen = (isset($item['title'])) ? strlen($item['title']): 0;
                                       $descriptionLimit = $defaultCharLimit - $titleLen;
                                       $totalLen = $titleLen + strlen($item['shortIntroDescription']);
                                       $trimmedDescription = ($totalLen > $defaultCharLimit) ? substr($item['shortIntroDescription'], 0 , $descriptionLimit).'...' : $item['shortIntroDescription'];
                                       print $trimmedDescription;
                                    }
                                    ?>
                                 </div>

                                 <div class="event-continue">
                                    <a href="<?php print drupal_get_path_alias("node/{$item['nid']}"); ?>" title="continue" class="btn-continue"><?php print isset($linkBtnCaption) ? $linkBtnCaption : t('Continue reading'); ?></a>
                                 </div>
                              </div>
                           </div>
                        </div>
                        
                        <?php $ctr++; ?>
                     <?php endforeach; ?>       
                  <?php endif; ?>        
               </div>
            </div>
            
            <div class="event-pagination clearfix">
                  <?php
                     $params = array();
                     $params['href'] = "{$base_url}/event?";                              
                     $params['allListSize'] = $pastEventListSize;
                     $params['activePage'] = $page;
                     
                     if ($pastEventListSize <= 4) {
                        $params['limit'] = 2;
                     } else {
                        $params['limit'] = 4;
                     }
    
                     $params['isPastEventPagination'] = true;
                     
                     $block = module_invoke('custompage', 'block_view', 'pagination', $params);
                     print render($block['content']);
                 ?>
            </div>
         
         </div>
      

   </div>
   
</div>

<script type="text/javascript">
   jQuery(document).ready(function() {
      jQuery('.event-inside-row').on('click', function() {
         $(this).find('.btn-continue')[0].click();
      });

      var insLazyLoad1 = new LazyLoad({
         elements_selector: ".event-image" 
      });

      var insLazyLoad2 = new LazyLoad({
         elements_selector: ".banner-center-text"
      });
   });   

</script>