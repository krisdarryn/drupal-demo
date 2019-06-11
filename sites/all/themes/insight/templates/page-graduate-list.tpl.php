<?php
global $base_url;
$scripts_path = $base_url . '/' . drupal_get_path('theme', 'insight') . '/dist/scripts/';
?>

<div id="ins-mn-bdy-cntr">
   <div id="" class="common head-fix">
      <div class="banner-center-text" style="background-image: url(<?php print isset($bannerImageUrl) ? $bannerImageUrl : ''; ?>)">
      
         <div class="banner-content">
            <p id="mob-banner-text"><?php print isset($bannerSlogan) ? $bannerSlogan : ''; ?></p>
         </div>
      </div>

        <?php
            $params = array(
                'activePage' => 'graduates',
                'baseUrl' => $base_url,
            );
            $block = module_invoke('custompage', 'block_view', 'discover-secondary-menu', $params);
            print render($block['content']);
        ?>
      </div>
      <div class="graduates-section">
      <div class="container">
         <div class="intro-panl">
            <div class="row">
               <div class="col-xs-12 col-sm-8">
                  <div class="cont-sec" id="intro-sec">
                     <div class="cont-head">
                        <h1 class="au-h1-tle"><?php print isset($introSectionTitle) ? $introSectionTitle : ''; ?></h1>
                     </div>
                     <div class="cont-body">
                        <p><?php print isset($introSectionContent) ? $introSectionContent : ''; ?></p>
                     </div>
                  </div>
               </div>
            </div>
         </div> 
         <div class="tchr-panl">
            <div class="row">
                <?php 
                    $ctr = 0;
                    $totalCount = count($graduateList);
                ?>

               <?php if (isset($graduateList) && $totalCount > 0) : ?>
                  <?php foreach ($graduateList as $graduate): ?>
                  
                     <?php if ($ctr > 0 && fmod($ctr, 2) == 0): ?>
                        <div class="clearfix hidden-xs-sm"></div>
                     <?php endif; ?>


                     <div class="col-xs-12 col-sm-6">
                           <div onclick="" class="tchr-img-container<?php echo (isset($totalCount) ? $totalCount : 0) < ($ctr+1) + 2 ? ' last-item' : '';?>" data-nid="<?php print isset($graduate['nid']) ? $graduate['nid'] : ''; ?>">
                              <div class="img-bckgrnd" data-src="<?php print $graduate['profileImageUrl']; ?>" title="<?php print isset($graduate['profileImageTitle']) ? $graduate['profileImageTitle'] : ''; ?>">
                              </div>
                            <div class="tchr-inf-crd grdt-inf-crd">
                                 <div class="tchr-holder">
                                       <div class="row">
                                          <div class="col-xs-12">
                                             <div class="thcr-nme">
                                                   <h3><?php print (isset($graduate['firstName']) ? $graduate['firstName'] : '') . ' ' . (isset($graduate['lastName']) ? $graduate['lastName'] : ''); ?></h3>
                                             </div>	
                                          </div>
                                          <div class="col-xs-12">
                                             <div class="tchr-pst">
                                                   <p><?php print isset($graduate['occupation']) ? $graduate['occupation'] : ''; ?></p>
                                                   <p><strong><?php print isset($graduate['company']) ? $graduate['company'] : ''; ?></strong></p>
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
         
         <?php if ($allGraduateListSize > $initialNumDisplay): ?>
            <div class="see-all">
               <div class="row">
                  <div class="col-xs-12">
                     <a href="#" class="see-all-link"><?php echo t('See all graduates');?></a>
                  </div>
               </div>
            </div>
         <?php endif; ?>
         
        <div class="vstng-lctrs grd-std-wrk-lst">
            <div class="row">
                <div class="col-xs-12">
                    <div class="cont-sec">
                    
                        <div class="cont-head">
                            <h2 class="grd-h2-tle"><?php echo t('Where our students work now');?></h2>
                        </div>
                        
                        <div class="lg-bdy">
                           <?php if (isset($employmentList) && $employmentList) : ?>                           
                              <?php // For desktop. Display all employments ?>
                              <div class="employmentList hidden-xs">
                                 <div class="row">
                                    <?php $ctr = 1;?>
                                    <?php foreach ($employmentList as $item): ?>
                                       <?php if (isset($item['image']['url']) && $item['image']['url'] != ''): ?>                                          
                                          <div class="cstm-col-sm-2 grd-img">
                                              <span class="helper"></span>
                                             <img class="" data-src="<?php print $item['image']['url']; ?>" alt="<?php print $item['image']['alt']; ?>" title="<?php print $item['image']['title']; ?>">
                                          </div>
                                          
                                          <?php if (fmod($ctr, 5) == 0) : ?>
                                              <div class="clearfix"></div>
                                          <?php endif;?>
                                          
                                       <?php endif; ?>
                                    <?php $ctr++;?>
                                    <?php endforeach; ?>
                                 </div>
                              </div>
                              
                              <?php // For mobile. Display initial of 6 employments ?>
                              <input type="hidden" id="employmentDisplayCount" value="6">
                              <div id="mobileEmploymentList" class="employmentList visible-xs">
                                 <div class="row">
                                    <?php $ctr = 1;?>
                                    <?php foreach ($employmentList as $item): ?>
                                       <?php if (isset($item['image']['url']) && $item['image']['url'] != ''): ?>
                                          <div class="col-xs-6 grd-img">
                                            <span class="helper"></span>
                                             <img class="" data-src="<?php print $item['image']['url']; ?>" alt="<?php print $item['image']['alt']; ?>" title="<?php print $item['image']['title']; ?>">
                                          </div>
                                          
                                          <?php if (fmod($ctr, 2) == 0) : ?>
                                              <div class="clearfix"></div>
                                          <?php endif;?>
                                          
                                       <?php endif; ?>
                                       <?php
                                       $ctr++;
                                       
                                       if ($ctr > 6) {
                                          break;
                                       }
                                       ?>
                                    <?php endforeach; ?>
                                 </div>
                              </div>
                              
                              <?php if (count($employmentList) > 6): ?>
                                 <div class="visible-xs text-right">
                                    <a href="#" class="read-more" id="btnLoadMoreEmployment"><?php print t('Load more');?></a>
                                 </div>
                              <?php endif; ?>
                           <?php endif; ?>    
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
      </div>
   </div>

   <div id="mdl-wrap"></div>
</div>