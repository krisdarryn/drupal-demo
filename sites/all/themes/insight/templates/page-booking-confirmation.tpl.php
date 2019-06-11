<?php
global $base_url;
$images_path = $base_url . '/' . drupal_get_path('theme', 'insight') . '/dist/images/';
?>

<div id="ins-mn-bdy-cntr" class="common sml-bnr5">
   <div class="booking-banner-row row">
      <div class="booking-banner-col col-xs-12">
         <div class="booking-banner" style="background-image: url(<?php print isset($bannerImageUrl) ? $bannerImageUrl : ''; ?>)">
            <div class="banner-content">
               <p class="banner-text"><?php print isset($bannerSlogan) ? $bannerSlogan : ''; ?></p>
            </div>
         </div>
      </div>
   </div>

   <div class="information-section container">
      <div class="row">
         <div class="col-xs-12 col-sm-6 info-col reg-cfrm-info-col">
            <div class="progress booking-progress">
               <div class="progress-bar" role="progressbar" aria-valuenow="100%" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
                  <span class="sr-only"><?php echo t('100% Complete');?></span>
               </div>
            </div>

            <div class="col-xs-12 progress-bar-labels clearfix">
               <div class="row">
                  <div class="col-xs-4 label-col active">
                     <p class="step-text"><?php echo t('STEP 1');?></p>
                     <p><?php echo t('Registration'); ?></p>
                  </div>

                  <div class="col-xs-4 label-col active">
                     <p class="step-text"><?php echo t('STEP 2');?></p>
                     <p><?php echo t('Payment');?></p>
                  </div>

                  <div class="col-xs-4 label-col active">
                     <p class="step-text"><?php echo t('STEP 3'); ?></p>
                     <p><?php echo t('Confirmation'); ?></p>   
                  </div>
               </div>
            </div>

            <?php
            $durationTitleDate = isset($courseDetails['durationTitle']) ? '[' . $courseDetails['durationTitle'] . '] ' : '';
            $durationTitleDate .= isset($courseDetails['durationDate']) ? $courseDetails['durationDate'] : '';
            ?>
            <div class="col-xs-12 reg-message">
               <h3 class="reg-ty-hdr ref-cfrm-hdr"><img class="check-img" src="<?php print $images_path; ?>check.png"/><?php echo t('Thank you for your registraton!');?></h3>
               <div class="reg-text bs2-main-content-wrp">
                  <p class="inline-text"><?php print $registrationContent3; //t('You have successfully registered for ')?></p>
                  <p class="course-text inline-text"><?php print isset($courseDetails['title']) ? $courseDetails['title'] : ''; ?>: <?php print $durationTitleDate; ?>.</p>
                  <br>
                  <div class="bs3-confirm-msg-wrp">
                     <br>
                     <?php 
                        if (isset($registrationStatus) && ($registrationStatus == 1)) :
                           print $confirmMsgPaypal; 
                        elseif (isset($registrationStatus) && ($registrationStatus == 2)) :
                           print $confirmMsgBankTranfer; 
                        endif;
                     ?>
                  </div>

                  <div class="links-row row reg-cfrm-btn-wrp">
                     <div class="col-xs-6">
                        <a href="<?php print url('short-courses'); ?>" title="return to short courses"><?php echo t('Return to all short courses');?></a>
                     </div>
                     <div class="col-xs-6">
                        <a href="<?php print $base_url;?>" title="return home"><?php echo t('Return home');?></a>
                     </div>
                  </div>
               </div>

               <div class="col-xs-12 b-c-banner step3 hidden-xs">
                  <div class="b-c-container">
                     <div class="b-image-container" style="background-image: url(<?php print isset($courseDetails['coverImageUrl']) ? $courseDetails['coverImageUrl'] : ''; ?>)">
                        <!--<div class="b-c-date">
                           <span><?php //print isset($courseDetails['startDate']) ? $courseDetails['startDate'] : ''; ?></span>
                        </div>-->
                     </div>
                     <div class="b-c-info">
                        <p class="b-c-title"><?php print isset($courseDetails['title']) ? $courseDetails['title'] : ''; ?></p>
                        <div class="b-c-details"><?php print $durationTitleDate; ?></div>
                        <p class="b-c-duration"><?php print isset($courseDetails['duration']) ? $courseDetails['duration'] : ''; ?></p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div> <!-- end of row-->
   </div>

   <?php // Related short courses ?>
   <?php if (isset($relatedShortCourses) && $relatedShortCourses) : ?>
      <div class="related-section">
         <div class="sc-cont-wrp container">
               <?php /*$title = ((count($relatedShortCourses) > 1) ? t('These courses go') : t('This course goes')) . ' ';*/ ?>
               <h3 class="reg-related-hdr"><?php echo 'Others that attended this course were also interested in:';/*$title . t("well with the one you've purchased");*/ ?></h3>
            <div class="sc-cont-row row">
               <?php $ctr = 1; ?>
               <?php foreach ($relatedShortCourses as $course): ?>
                  <div class="col-xs-6 col-sm-3 <?php print ($ctr > 0 && fmod($ctr, 2) == 0) ? 'right' : 'left'; ?>">
                     <a class="slider-tag" href="<?php print "{$base_url}/" . drupal_get_path_alias("node/{$course['nid']}") ?>" title="<?php print isset($course['title']) ? $course['title'] : ''; ?>">
                        <div class="course-container">
                           <div class="course-image-container" style="background-image: url(<?php print isset($course['coverImageUrl']) ? $course['coverImageUrl'] : ''; ?>)">
                           <?php if ($course['startDate'] != ''): ?>
                              <div class="course-date">
                                 <span><?php print isset($course['startDate']) ? $course['startDate'] : ''; ?></span>
                              </div>
                           <?php endif; ?>
                           </div>

                           <div class="course-info">
                              <div class="course-title-wrapper">
                                 <p class="course-title"><?php print isset($course['title']) ? $course['title'] : ''; ?></p>
                                 <div class="course-details"><?php print isset($course['description']) ? $course['description'] : ''; ?></div>
                              </div>
                              <p class="course-duration"><?php print isset($course['duration']) ? $course['duration'] : '';?></p>
                           </div>
                        </div>
                     </a>
                  </div>
               <?php endforeach; ?>
            </div> <!-- end of row -->
         </div> <!-- end of sc-cont-wrp -->
      </div>
   <?php endif;?>
</div>   