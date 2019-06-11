
<div id="ins-mn-bdy-cntr" class="sml-bnr2 course-overview-page">
    <div id="" class="common">
        <div>
            <div class="banner-center-text" data-src="<?php echo isset($bannerImageUrl) ? $bannerImageUrl : '';?>"> 
                <div class="banner-content"> 
                <p id="mob-banner-text"><?php echo isset($bannerSlogan) ? $bannerSlogan : '';?></p> 
                </div>
            </div>
        </div>

         <?php if (isset($introductoryCourse['nid']) && $introductoryCourse['nid'] != 0): ?>
           <div class="introductory-section container grey-bg">
               <div class="border-wrapper">
                   <div class="row" id="intro-cnt">
                       <div class="col-xs-12 col-sm-6 text-col">
                          <a href="<?php echo drupal_get_path_alias("node/{$introductoryCourse['nid']}"); ?>" title="<?php echo isset($introductoryCourse['title']) ? $introductoryCourse['title'] : '';?>" class="course-link">
                              <h2 class="col-titles col-title-padding"><?php echo isset($introductoryCourse['title']) ? $introductoryCourse['title'] : '';?></h2>
                              <p class="text-uppercase sched-text"><?php echo isset($introductoryCourse['courseOverviewDescription']) ? $introductoryCourse['courseOverviewDescription'] : '';?></p>
                           </a>
                          <div class="l-c-text">
                              <a href="<?php echo drupal_get_path_alias("node/{$introductoryCourse['nid']}"); ?>" title="<?php echo $introductoryCourse['title']; ?>" class="course-link">
                                 <?php echo isset($introductoryCourse['shortDescription']) ? $introductoryCourse['shortDescription'] : ''; ?>
                              </a>
                          </div>
                          <div class="co-intro-rd-mr crs-ovw-rm">
                              <?php echo l(t('Read more'), drupal_get_path_alias("node/{$introductoryCourse['nid']}"), ['attributes' => ['title' => 'Read more', 'class' => '']]); ?>
                           </div>                    
                       </div>
                       <div class="col-xs-12 col-sm-6 media-col">
                           <div class="col-img-cont full-width">
                               <a href="<?php echo drupal_get_path_alias("node/{$introductoryCourse['nid']}"); ?>" title="<?php echo isset($introductoryCourse['title']) ? $introductoryCourse['title'] : '';?>">
                                 <img data-src="<?php echo isset($introductoryCourse['coverImageUrl']) ? $introductoryCourse['coverImageUrl'] : '';?>" class="img-responsive" title="<?php echo isset($introductoryCourse['coverImageTitle']) ? $introductoryCourse['coverImageTitle'] : '';?>" alt="<?php echo isset($introductoryCourse['coverImageAlt']) ? $introductoryCourse['coverImageAlt'] : '';?>">
                              </a>
                           </div>
                       </div>
                   </div> <!-- end of row -->
               </div>
           </div> <!-- end of section -->
        <?php endif; ?>

        <div class="residential-section container">
            <div class="border-wrapper">
                <div class="row crs-ovw-intro-wrp">
                    <div class="col-xs-12 col-sm-6 text-col short-c-col pull-right">
                    <h2 class="col-titles col-title-padding"><?php echo t('Short courses');?></h2>
                    <div class="s-dcs">
                        <?php echo isset($shortSectionDescription) ? $shortSectionDescription : '';?>
                    </div>
                    <div class="crs-ovw-rm">
                        <?php 
                           $shortSectionLinkText = (isset($shortSectionLinkText)) ? $shortSectionLinkText : 'View all short courses';
                            echo l($shortSectionLinkText, drupal_get_path_alias("short-courses"), [
                              'attributes' => [
                                 'title' => $shortSectionLinkText,
                                 'class' => ''
                              ],
                           ]);
                        ?>
                    </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 media-col crs-ovw-sc-wrp">
                        <div class="row crs-ovw-sc-row">
                           <?php if (isset($shortCourseList) && count($shortCourseList) > 0) : ?>
                              <?php foreach ($shortCourseList as $listItem) : ?>
                                 <a href="<?php echo drupal_get_path_alias("node/{$listItem['nid']}"); ?>" title="<?php echo isset($listItem['title']) ? $listItem['title'] : '';?>">
                                    <div class="col-xs-6 col-sm-6 left">
                                       <div class="course-container">
                                          <div class="course-image-container" data-src="<?php echo isset($listItem['coverImageUrl']) ? $listItem['coverImageUrl'] : '';?>">
                                          <?php if ($listItem['startDate'] != '' && isset($listItem['startDate'])): ?>
                                          <div class="course-date">
                                             <span><?php echo isset($listItem['startDate']) ? $listItem['startDate'] : '';?></span>
                                          </div>
                                          <?php endif; ?>
                                          </div>
                                          <div class="course-info">
                                             <div class="course-title-wrapper">
                                                <p class="course-title"><?php echo isset($listItem['title']) ? $listItem['title'] : '';?></p>
                                                <div class="course-details"><?php echo isset($listItem['description']) ? $listItem['description'] : '';?></div>
                                             </div>
                                          <p class="course-duration"><?php echo isset($listItem['duration']) ? $listItem['duration'] : '';?></p>
                                          </div>
                                       </div>
                                    </div>
                                 </a>
                              <?php endforeach;?>
                           <?php endif;?>
                        </div>
                    </div>
                </div> <!-- end of row -->
            </div>
        </div> <!-- end of section -->

        <?php if (isset($longCourseList) && count($longCourseList) > 0) : ?>
            <?php $ctr = 0;?>
            <?php foreach ($longCourseList as $key => $listItem) :?>

               <div class="l-course-section container grey-bg">
                   <div class="border-wrapper">
                       <div class="row crs-ovw-lc-itm <?php echo ($key == 0 ? 'first' : ''); ?>">
                           <div class="col-xs-12 col-sm-6 text-col<?php echo $ctr > 0 && $ctr%2 !== 0 ? ' pull-right' : '';?>">
                              <a href="<?php echo drupal_get_path_alias("node/{$listItem['nid']}"); ?>" title="<?php echo isset($listItem['title']) ? $listItem['title'] : '';?>" class="course-link">
                                  <h2 class="col-titles col-title-padding crs-ovw-lc-tle <?php echo ($key == 0 ? 'first' : ''); ?>"><?php echo isset($listItem['title']) ? $listItem['title'] : '';?></h2>
                                  <p class="text-uppercase sched-text"><?php echo $listItem['duration'];?></p>
                               </a>
                               <div class="l-c-text">
                                 <a href="<?php echo drupal_get_path_alias("node/{$listItem['nid']}"); ?>" title="<?php echo isset($listItem['title']) ? $listItem['title'] : '';?>" class="course-link">
                                   <?php echo isset($listItem['shortDescription']) ? $listItem['shortDescription'] : '';?>
                                 </a>
                               </div>
                              <div class="co-intro-rd-mr crs-ovw-rm">
                                 <?php echo l(t('Read more'), drupal_get_path_alias("node/{$listItem['nid']}"), ['attributes' => ['title' => 'Read more', 'class' => '']]); ?>
                              </div>
                           </div>
                           <div class="col-xs-12 col-sm-6 media-col">
                               <div class="col-img-cont full-width">
                                 <a href="<?php echo drupal_get_path_alias("node/{$listItem['nid']}"); ?>" title="<?php echo isset($listItem['title']) ? $listItem['title'] : '';?>">
                                    <img 
                                       data-src="<?php echo isset($listItem['coverImageUrl']) ? $listItem['coverImageUrl'] : '';?>" 
                                       class="img-responsive" 
                                       title="<?php echo isset($listItem['coverImageTitle']) ? $listItem['coverImageTitle'] : '';?>" 
                                       alt="<?php echo isset($listItem['coverImageTitle']) ? $listItem['coverImageTitle'] : '';?>"
                                    >
                                 </a>
                               </div>
                           </div>
                       </div> <!-- end of row -->
                   </div>
               </div> <!-- end of section -->
               <?php $ctr++;?>
            <?php endforeach;?>


        <?php endif; ?>

        <div class="e-course-section container">
            <div class="border-wrapper ex-crs">
                <div class="row crs-ovw-ex-crs-wrp">
                    <div class="col-xs-12 col-sm-6 text-col pull-right">
                       <h2 class="col-titles col-title-padding"><?php echo t('Executive courses');?></h2>
                       <p class="text-uppercase sched-text"></p>

                       <div class="s-dcs">
                           <?php echo isset($executiveSectionDescription) ? $executiveSectionDescription : '';?>
                       </div>
                       <div class="crs-ovw-rm exc-crs-lnk-wrp">
                           <?php
                               echo l(t('View all executive courses'), drupal_get_path_alias("executive-course"), [
                                 'attributes' => [
                                    'title' => 'Executive courses',
                                    'class' => '',
                                 ],
                              ]);
                           ?>
                       </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 media-col">
                        <div class="col-img-cont full-width">
                            <a href="<?php print url('executive-course'); ?>" title="course image">
                              <img 
                                 data-src="<?php echo isset($executiveSectionImgUrl) ? $executiveSectionImgUrl : '';?>" 
                                 class="img-responsive" 
                                 title="<?php echo isset($executiveSectionImgTitle) ? $executiveSectionImgTitle : '';?>" 
                                 alt="<?php echo isset($executiveSectionImgAlt) ? $executiveSectionImgAlt : '';?>"
                              >
                           </a>
                        </div>
                    </div>
                </div> <!-- end of row -->
            </div>
        </div> <!-- end of section -->

    </div>   

</div>