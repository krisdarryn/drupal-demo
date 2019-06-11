<?php
global $base_url;
$images_path = $base_url.'/'.drupal_get_path('theme', 'insight').'/dist/images/';
?>
   <?php
      // Header section
      $params = array(
         'desktopBannerImageUrl' => $desktopBannerImageUrl,         
         'desktopBannerImageAlt' => $desktopBannerImageAlt,
         'desktopBannerImageTitle' => $desktopBannerImageTitle,
         'mobileBannerImageUrl' => $mobileBannerImageUrl,
         'mobileBannerImageAlt' => $mobileBannerImageAlt,
         'mobileBannerImageTitle' => $mobileBannerImageTitle,
         'courseBtnCaption' => $courseBtnCaption,
         'contactBtnCaption' => $contactBtnCaption,
         'bannerLinkHref' => $bannerLinkHref,
         'bannerLinkTarget' => $bannerLinkTarget,
      );
      $block = module_invoke('custompage', 'block_view', 'custom-landing-header', $params);
      print render($block['content']);
   ?>   
   
   <div id="ins-mn-bdy-cntr" class="page-landing">
      <div class="upcoming-courses-section row container">
         <div class="col-xs-12 section-title">
            <h2 class="ld-h2-tle"><?php echo isset($courseEventSectionTitle) ? $courseEventSectionTitle : ''; ?></h2>
         </div>
         
         <div class="col-xs-12 landing-slider-section slider slider-nav">
            <?php if (isset($featuredList) && count($featuredList) > 0) : ?>
               <?php foreach ($featuredList as $item):?>
                  <div class="slider-container">
                  <a class="slider-tag" href="<?php print drupal_get_path_alias("node/{$item['nid']}") ?>" title="<?php echo $item['title']; ?>">
                     <div class="slider-image-container" data-src="<?php print $item['coverImageUrl']; ?>">
                        <div class="slider-date <?php ($item['type'] == 'event' ? print 'event' : '')?>">
                           <span><?php print isset($item['startDate']) ? $item['startDate'] : ''; ?></span>
                        </div>
                     </div>
                     <div class="slider-info">
                        <div class="course-title-wrapper">
                           <p class="slider-title ellipsis-text"><?php print isset($item['title']) ? $item['title'] : ''; ?></p>
                           <div class="slider-details"><?php print isset($item['description']) ? $item['description'] : ''; ?></div>
                        </div>
                        <div class="slider-duration">
                           <?php 
                              if ($item['type'] == 'event') {
                                 print t('Register');
                              } else  {
                                 print isset($item['duration']) ? $item['duration'] : ''; 
                              }
                           ?>
                        </div>
                     </div>
                  </a>
                  </div>
               <?php endforeach; ?>
            <?php endif; ?>
         </div>

      </div> <!-- end of upcoming courses-->
      <div class="white-wrapper-container">
      <div class="hands-on-section container">
         <div class="hands-on-slogan ld-h2-wrp">
            <h2><?php print isset($workingSectionSlogan) ? $workingSectionSlogan : ''; ?></h2>
         </div>
         <div class="graduates-work-banner row">
            <div class="graduates-banner col-xs-12 col-sm-6">
               <a href="<?php print (isset($graduateLink) && ($graduateLink != '')) ? $graduateLink : ($base_url . "/graduates");?>" title="graduates">
                  <?php if (isset($graduateBannerImageUrl) && ($graduateBannerImageUrl != '')): ?>
                  <div class="grad-bckgrnd" style="background-image: url(<?php print isset($graduateBannerImageUrl) ? $graduateBannerImageUrl : ''; ?>)" alt="<?php print isset($graduateBannerImageAlt) ? $graduateBannerImageAlt : ''; ?>" title="<?php print isset($graduateBannerImageTitle) ? $graduateBannerImageTitle : ''; ?>"></div>
                  <div class="graduates-btn">
                     <div class="hands-on-btn-wrap">
                        <div class="hands-on-btn">
                           <span><?php print isset($graduateText) ? $graduateText : ''; ?></span>
                           <span class="hands-on-divider visible-xs"></span>
                        </div>
                     </div>
                  </div>
                  <?php endif; ?>
               </a>   
            </div>
            <div class="work-banner col-xs-12 col-sm-6">
               <a href="<?php print (isset($workLink) && ($workLink != '')) ? $workLink : ($base_url . "/student-work");?>" title="work">
                  <?php if (isset($workBannerImageUrl) && ($workBannerImageUrl != '')): ?>
                  <div class="work-bckgrnd" style="background-image: url(<?php print isset($workBannerImageUrl) ? $workBannerImageUrl : ''; ?>)" alt="<?php print isset($workBannerImageAlt) ? $workBannerImageAlt : ''; ?>" title="<?php print isset($workBannerImageTitle) ? $workBannerImageTitle : ''; ?>"></div>
                  <div class="work-btn">
                     <div class="hands-on-btn-wrap">
                        <div class="hands-on-btn">
                           <span><?php print isset($workText) ? $workText : ''; ?></span>
                        </div>
                     </div>
                  </div>
                  <?php endif; ?>
               </a>
            </div>
         </div>
      </div> <!-- end of hands on section-->
      </div>


      <div class="testimonial-section row container">
         <div class="testimonial-slogan">
            <h2><?php print isset($testimonialSectionTitle) ? $testimonialSectionTitle : ''; ?></h2>
         </div>   

         <div class="landing-testimonial-slider slider slider-nav">
            <?php if (isset($testimonials) && count($testimonials) > 0) : ?>
               <?php foreach ($testimonials as $item): ?>
                  <div class="testimonial-columns">
                     <div class="testimonial-wrapper">
                        <div class="testimonial-container">
                           <div class="testimonial-text">
                              <p>"<?php print isset($item['content']) ? $item['content'] : ''; ?>"</p>
                           </div>

                           <div class="testimonial-logo">
                              <img data-src="<?php print isset($item['creditImageUrl']) ? $item['creditImageUrl'] : ''; ?>" class="img img-responsive" alt="<?php print isset($item['creditImageAlt']) ? $item['creditImageAlt'] : ''; ?>" title="<?php print isset($item['creditImageTitle']) ? $item['creditImageTitle'] : ''; ?>">
                           </div>
                        </div>
                     </div>
                  </div>
               <?php endforeach; ?>
            <?php endif; ?>
         </div>
      </div> <!-- end of testimonial -->
   </div> <!-- end of ins-mn-bdy-cntr -->