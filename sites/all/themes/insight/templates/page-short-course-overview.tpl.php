<?php
global $base_url;
$images_path = $base_url .'/'. drupal_get_path('theme', 'insight') . '/dist/images/';
?>

<div id="ins-mn-bdy-cntr" class="sml-bnr2">
   <div id="short-course-overview-pg-wrp" class="common">
      <div class="sc-mn-ctr">
         <div class="sc-bnr-ctr">
            <div class="banner-center-text hidden-xs" data-src="<?php print isset($bannerImageUrl) ? $bannerImageUrl : ''; ?>">
               <div class="banner-content"> 
               <p id="mob-banner-text"><?php print isset($bannerSlogan) ? $bannerSlogan : ''; ?></p> 
               </div>
            </div>
            <div class="banner-center-text hidden-sm hidden-md hidden-lg" data-src="<?php print isset($bannerImageUrl) ? $bannerImageUrl : ''; ?>">
               <div class="banner-content"> 
                  <p id="mob-banner-text"><?php print isset($bannerSlogan) ? $bannerSlogan : ''; ?></p> 
               </div>
            </div>
         </div>         

         <div class="sc-main-text-ctr container">
            <div class="row">
               <div class="col-xs-12">
                  <!--<div class="main-text hidden-sm hidden-md hidden-lg">
                     <p><?php //print isset($introDescription) ? $introDescription : ''; ?></p>
                  </div>-->
                  
                  <div class="main-text sc-ovr-main-text">
                     <h1 class="sc-h1-tle"><?php print isset($introTitle) ? $introTitle : ''; ?></h1>
                     <p><?php print isset($introDescription) ? $introDescription : ''; ?></p>     
                  </div>

                  <div class="sc-dropdown-ctr hidden-xs hidden">
                     <span><?php print t('By category');?></span>
                     <div class="dropdown sc-dropdown">
                        <button class="sc-dropdown-btn btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                           <?php print t('All courses');?>
                           <img src="<?php print $images_path; ?>down-arrow.png">
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                           <li><a href="#"><?php print t('Action');?></a></li>
                           <li><a href="#"><?php print t('Another action');?></a></li>
                           <li><a href="#"><?php print t('Something else here');?></a></li>
                           <li role="separator" class="divider"></li>
                           <li><a href="#"><?php print t('Separated link');?></a></li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         
         <div class="sc-dropdown-ctr visible-xs">
            <div class="dropdown sc-dropdown">
               <button class="sc-dropdown-btn btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                  <span id="sc-dd-selected" class="pull-left"><?php print t('All courses');?></span>
                  <img src="<?php print $images_path; ?>dropdown-arrow.png">
               </button>
               <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                  <li class="sc-dd-item active"><a data-val="<?php print t('all-courses'); ?>" href="#" class="sc-dd-item-lbl" title="<?php print t('All courses');?>"><?php print t('All courses');?></a></li>
                  <li class="sc-dd-item"><a data-val="<?php print t('pending') ;?>" href="#" class="sc-dd-item-lbl" title="<?php print t('Pending');?>"><?php print t('Pending');?></a></li>
                  
                  <?php foreach ($monthList as $keyMonth => $month) { ?>
                  <?php if(in_array($keyMonth, $availableMonth, true)){ ?>
                     <li class="sc-dd-item"><a data-val="<?php print strtolower($month); ?>" href="#" class="sc-dd-item-lbl" title="<?php print $month;?>"><?php print $month; ?></a></li>
                  <?php } ?>
                     
                  <?php } ?>
                  
               </ul>
            </div>
         </div>
         
         <!--<pre>-->
         <?php //print_r($courseList); exit;?>
         <?php // Short course list ?>
         <div class="sc-cont-wrp container">
            <div class="sc-cont-row row">
               <?php $desktopCtr = 1; // Counter used in desktop. This will include the count of month card. ?>
               <?php $mobileCtr = 1; // Counter used in mobile. This will not include the count of month card. ?>
               
               <?php if (isset($courseList) && count($courseList) > 0) : ?>
                  <?php foreach ($courseList as $keyYear => $list) { ?>
                     <?php if (isset($list) && count($list) > 0) : ?>
                        <?php foreach ($list as $keyMonth => $courses) { ?>
                           <?php $hasMonthCardDisplayed = FALSE; ?>
                           <?php if (isset($courses) && count($courses) > 0) : ?>
                              <?php foreach ($courses as $course): ?>                     
                                 <?php if (! $hasMonthCardDisplayed): ?>
                                    <div class="col-xs-6 col-sm-3 sc-top-padding month-col hidden-xs">
                                       <div class="month-cards-container">
                                          <div class="month-card">
                                             <?php if ($keyYear == 10000): ?>
                                                <p class="courses-text"><?php print t('Pending'); ?></p>
                                                <p class="month-text"><?php print t('courses'); ?></p>
                                             <?php else: ?>
                                                <p class="courses-text"><?php print t('Courses'); ?></p>
                                                <p class="month-text"><?php print t('in ') . (isset($monthList[$keyMonth]) ? $monthList[$keyMonth] : ''); ?></p>
                                             <?php endif; ?>
                                             <img src="<?php print $images_path; ?>Vector.png">
                                          </div>
                                       </div>
                                    </div>
                                    <?php $desktopCtr++; ?>
                                    <?php $hasMonthCardDisplayed = TRUE; ?>
                                 <?php endif; ?>
                                 
                                 <div class="col-xs-6 col-sm-3 <?php print (fmod($mobileCtr, 2) == 0) ? 'right' : 'left'; ?> sc-top-padding sc-course-item <?php echo (isset($monthList[$keyMonth]) ? strtolower($monthList[$keyMonth]) : 'pending'); ?>">
                                    <div class="course-container">
                                    <a class="slider-tag" href="<?php print drupal_get_path_alias("node/{$course['nid']}") ?>" title="<?php echo $course['title']; ?>">
                                       <div class="course-image-container" data-src="<?php print $course['coverImageUrl']; ?>">
                                          <?php if ($course['startDate'] != '' && isset($course['startDate'])): ?>
                                             <div class="course-date">
                                                <span><?php print $course['startDate']; ?></span>
                                             </div>
                                          <?php endif; ?>
                                       </div>
                                       <div class="course-info">
                                          <div class="course-title-wrapper">
                                             <p class="course-title"><?php print $course['title']; ?></p>
                                             <div class="course-details"><?php print $course['description']; ?></div>
                                          </div>
                                          <p class="course-duration"><?php print $course['duration']; ?></p>
                                       </div>
                                    </a>
                                    </div>
                                 </div>
                                 
                                 <?php if (fmod($mobileCtr, 2) == 0): ?>
                                    <div class="clearfix visible-xs"></div>
                                 <?php endif; ?>
                                 
                                 <?php if (fmod($desktopCtr, 4) == 0): ?>
                                    <div class="clearfix hidden-xs"></div>
                                 <?php endif; ?>
                                 
                                 <?php $desktopCtr++;?>
                                 <?php $mobileCtr++; ?>
                              <?php endforeach; ?>
                           <?php endif; ?>
                        <?php } ?>
                     <?php endif; ?>
                  <?php } ?>
               <?php endif; ?>
            </div> <!-- end of row -->
            
            <div class="row hide" id="no-sc-msg-wrp">
               <div class="col-xs-12">
                  <h3 class="text-center">There are no Short Courses for the Month of <span id="no-sc-msg"></span></h3> 
               </div>
            </div>
            
         </div> <!-- end of sc-cont-wrp -->
      </div>
   </div>
         
</div>