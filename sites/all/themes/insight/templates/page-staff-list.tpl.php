<?php
global $base_url;
$insight_theme_path = $base_url.'/'.drupal_get_path('theme', 'insight');
$images_path = $insight_theme_path.'/dist/images/';
$scripts_path = $insight_theme_path.'/dist/scripts/';
?>

<div id="ins-mn-bdy-cntr">    
   <div id="" class="common head-fix">
      <div class="banner-center-text" data-src="<?php print isset($bannerImageUrl) ? $bannerImageUrl : ''; ?>">
      
         <div class="banner-content">
            <p id="mob-banner-text"><?php print isset($bannerSlogan) ? $bannerSlogan : ''; ?></p>
         </div>
      </div>

      <?php
            $params = array(
            'activePage' => 'staff',
            'baseUrl' => $base_url,
            );
            $block = module_invoke('custompage', 'block_view', 'discover-secondary-menu', $params);
            print render($block['content']);
        ?>
    </div>
    <div class="staff-section">
        <div class="container">
            <div class="intro-panl">
                <div class="row">
                <div class="col-xs-12 col-sm-8">
                    <div class="cont-sec" id="intro-sec">
                        <div class="cont-head">
                            <h1 class="au-h1-tle"><?php print isset($staffIntroTitle) ? $staffIntroTitle : ''; ?></h1>
                        </div>
                        <div class="cont-body">
                            <p><?php print isset($staffIntroContent) ? $staffIntroContent : ''; ?></p>
                        </div>
                    </div>
                </div>
                </div>
            </div> 
            <div class="tchr-panl">
               <div class="row">
                  <?php 
                     $ctr = 0;
                     $totalCount = count($teacherList);
                  ?>
                  <?php if (isset($teacherList) && count($teacherList) > 0) : ?>
                     <?php foreach ($teacherList as $teacher): ?>
                        <?php if ($ctr > 0 && fmod($ctr, 2) == 0): ?>
                           <div class="clearfix hidden-xs"></div>
                        <?php endif; ?>
                        
                        <div class="col-xs-12 col-sm-6">
                              <div onclick="" class="tchr-img-container<?php echo $totalCount < ($ctr+1) + 2 ? ' last-item' : '';?>" data-nid="<?php print isset($teacher['nid']) ? $teacher['nid'] : ''; ?>">
                                 <div class="img-bckgrnd" data-src="<?php print isset($teacher['imageUrl']) ? $teacher['imageUrl'] : ''; ?>" title="<?php print isset($teacher['imageTitle']) ? $teacher['imageTitle'] : ''; ?>">
                                 </div>
                                 <div class="tchr-inf-crd">
                                    <div class="tchr-holder">
                                          <div class="row">
                                             <div class="col-xs-12">
                                                <div class="thcr-nme">
                                                      <h3><?php print (isset($teacher['firstName']) ? $teacher['firstName'] : '') . ' ' . (isset($teacher['lastName']) ? $teacher['lastName'] : ''); ?></h3>
                                                </div>	
                                             </div>
                                             <div class="col-xs-12">
                                                <div class="tchr-pst">
                                                      <p><?php print isset($teacher['longTitle']) ? $teacher['longTitle'] : ''; ?></p>
                                                </div>
                                             </div>
                                          </div>
                                    </div>
                                 </div>
                              </div>
                        </div>
                     
                        <?php $ctr++; ?>
                     <?php endforeach; ?>
                  <?php endif; ?>
               </div>
            </div>
            
            <?php if ($allStaffListSize > 6): ?>
               <div class="see-all">
                   <div class="row">
                       <div class="col-xs-12">
                           <a href="#" class="see-all-link"><?php echo t('See all teachers');?></a>
                       </div>
                   </div>
               </div>
            <?php endif; ?>
            
            <div class="vstng-lctrs mob-marg">
                <div class="row">
                    <div class="col-xs-12 col-sm-9">
                        <div class="cont-sec">
                            <div class="cont-head">
                                <h2 class="au-h1-tle"><?php echo isset($lecturerIntroTitle) ? $lecturerIntroTitle : '';?></h2>
                            </div>
                            <div class="cont-body">
                                <p><?php echo isset($lecturerIntroContent) ? $lecturerIntroContent : '';?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12">
                    <div class="stff-lctr slider-container visible-xs">
                        <div class="slider-section">
                        <?php if (isset($lecturerList) && count($lecturerList) > 0) : ?>
                           <?php foreach ($lecturerList as $lecturer): ?>
                              <div>
                                 <img class="sldr-img-wrpr" data-lazy="<?php print isset($lecturer['imageUrl']) ? $lecturer['imageUrl'] : ''; ?>" title="<?php echo isset($lecturer['imageTitle']) ? $lecturer['imageTitle'] : '';?>">
                                 <p class="slide-desc "><?php print (isset($lecturer['firstName']) ? $lecturer['firstName'] : '') . ' ' . (isset($lecturer['lastName']) ? $lecturer['lastName'] : '') . ' / ' . (isset($lecturer['title']) ? $lecturer['title'] : ''); ?></p>
                              </div>
                           <?php endforeach; ?>
                        <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="lctr-list hidden-xs">
               <div id="lctr-pnl">
                  <div class="row">
                     <?php if (isset($lecturerList) && count($lecturerList) > 0) : ?>
                        <?php foreach ($lecturerList as $lecturer): ?>
                           <div class="col-sm-6 col-md-3">
                              <div class="lctr-itm">
                                 <div class="bse-img center-block">
                                       <div class="img-bckgrnd" data-src="<?php print isset($lecturer['imageUrl']) ? $lecturer['imageUrl'] : ''; ?>" alt="<?php print isset($lecturer['imageAlt']) ? $lecturer['imageAlt'] : ''; ?>" title="<?php print isset($lecturer['imageTitle']) ? $lecturer['imageTitle'] : ''; ?>"></div>
                                       <div class="bse-img-info">
                                          <div class="row">
                                             <div class="col-sm-12">
                                             <div class="lctr-info-det">
                                                   <div class="row">
                                                      <div class="col-sm-12">
                                                         <div class="lctr-info-det">
                                                         <p><?php print (isset($lecturer['firstName']) ? $lecturer['firstName'] : '') . ' ' . (isset($lecturer['lastName']) ? $lecturer['lastName'] : '') . ' / ' . (isset($lecturer['title']) ? $lecturer['title'] : ''); ?></p>
                                                         </div>
                                                      </div>
                                                   </div>
                                             </div>
                                             </div>
                                          </div>
                                       </div>
                                 </div>
                              </div>
                           </div>
                        <?php endforeach; ?>
                     <?php endif; ?>
                  </div>
               </div>
            </div>
        </div>
    </div>
</div>