<?php
global $base_url;
$images_path = $base_url .'/'. drupal_get_path('theme', 'insight') . '/dist/images/';
?>

<?php if (!empty($site_slogan)): ?>
<p class="lead"><?php print $site_slogan; ?></p>
<?php endif; ?>

<?php print render($page['header']); ?>


<?php if (!empty($page['sidebar_first'])): ?>
<aside class="col-sm-3" role="complementary">
  <?php print render($page['sidebar_first']); ?>
</aside>  <!-- /#sidebar-first -->
<?php endif; ?>


<?php if (!empty($page['highlighted'])): ?>
  <div class="highlighted jumbotron"><?php print render($page['highlighted']); ?></div>
<?php endif; ?>
<?php //if (!empty($breadcrumb)): print $breadcrumb; endif;?>
<a id="main-content"></a>
<?php print render($title_prefix); ?>

<?php print render($title_suffix); ?>
<?php print (isset($messages) && !is_array($messages) ? $messages : ''); ?>
<?php if (!empty($tabs)): ?>
  <?php print render($tabs); ?>
<?php endif; ?>
<?php if (!empty($page['help'])): ?>
  <?php print render($page['help']); ?>
<?php endif; ?>
<?php if (!empty($action_links)): ?>
  <ul class="action-links"><?php print render($action_links); ?></ul>
<?php endif; ?>

<?php if (!empty($page['sidebar_second'])): ?>
<aside class="col-sm-3" role="complementary">
  <?php print render($page['sidebar_second']); ?>
</aside>  <!-- /#sidebar-second -->
<?php endif; ?>

<?php render($page['content']['metatags']); ?>

<div id="ins-mn-bdy-cntr" class="common sml-bnr4 lc-page-bd">
   
   <section id="ins-lc-wrp">
      
      <div class="ins-lc-hd">   
         <?php if (isset($bannerImage['url']) && $bannerImage['url']): ?>
            <div class="ins-lc-bnr" style="background-image: url('<?php print $bannerImage['url']; ?>');"></div>
         <?php else: ?>
            <div class="ins-lc-bnr"></div>
         <?php endif; ?>
         
         <!-- Enquire Section -->
         <div class="ins-lc-enq-cnt">
            <div class="container">
               <div class="row">
                  <div class="col-xs-12 col-sm-8 col-sm-push-4">
                     
                     <div class="ins-lc-enq-wrp">
                        <div class="ins-lc-enq-hd">
                           <h1 class="ins-lc-enq-hd-t ins-lc-sc-t" id="enquire-section" ><?php print isset($title) ? $title : ''; ?></h1>
                        </div>
                        <div class="ins-lc-enq-bd">
                        
                           <div class="row">
                              <div class="ins-lc-enq-sch-wrp col-xs-12 col-sm-6 col-md-7">
                                 <?php if (isset($enquireDetails) && $enquireDetails): ?>
                                    <?php $isFirstItemDisplayed = FALSE; ?>
                                    <?php foreach ($enquireDetails as $durationTitle => $durationSchedList): ?>
                                       <div class="enq-sch-wrp<?php print (! $isFirstItemDisplayed) ? ' first' : ''; ?>">
                                          <h4 class="text-uppercase ins-lc-enq-sch-t"><?php print $durationTitle; ?></h4>
                                          <?php foreach ($durationSchedList as $durationDate): ?>
                                             <p class="ins-lc-enq-sch-itm"><?php print $durationDate; ?></p>
                                          <?php endforeach; ?>
                                       </div>
                                       <?php $isFirstItemDisplayed = TRUE; ?>
                                    <?php endforeach; ?>
                                 <?php endif; ?>
                              </div>
                              <div class="col-xs-12 col-sm-5 col-sm-push-1 col-md-5 col-md-push-0">
                                 <div class="ins-lc-enq-btn-wrp">
                                    <?php $param = isset($courseNid) ? '?cid=' . $courseNid . '#email-us' : ''; ?>
                                    <a href="<?php print $base_url; ?>/contact<?php print $param; ?>" class="btn btn-ins-drk btn-lc-en" title="Enquire">
                                       <div>
                                          <div>
                                             <span><?php print t('Enquire'); ?></span>
                                          </div>
                                       </div>
                                    </a>
                                 </div>
                                 <div class="ins-lc-enq-btn-en-wrp">
                                    <a href="#" class="btn-lc-en-eb" id="btn-lc-en-eb" title="<?php print t('Check out our early bird offer!'); ?>"><?php print t('Check out our early bird offer!'); ?></a>
                                 </div>
                                 
                              </div>
                           </div>
                           
                        </div>
                     </div>
                     
                  </div>
               </div>
            </div>
         </div>
         <!-- End of Enquire Section -->
         
      </div>
      
      <div class="ins-lc-bd" data-sticky-container>
      
         <div class="ins-lc-cnt-wrp">
                  
               <!-- Sidebar Menu -->
               <div class="ins-sd-mn-wrap">
                  <div class="container">
                  <div class="row">
                     <div class="col-sm-3 col-md-push-1 hidden-xs article-cont">
                        <div class="ins-lc-sb-mn-wrp" data-margin-top="154">
                           <ul class="list-unstyled ins-sd-mn-list">
                              <li class="ins-sd-mn-itm active">
                                 <a href="<?php print $base_url; ?>/contact<?php print $param; ?>" class="" title="Enquire"><?php print t('Enquire'); ?></a>
                              </li>
                              <li class="ins-sd-mn-itm">
                                 <a href="#course-details-section" class="ins-sd-mn-itm-l" title="Course details"><?php print t('Course overview'); ?></a>
                              </li>
                              <li class="ins-sd-mn-itm">
                                 <a href="#staff-section" class="ins-sd-mn-itm-l" title="Teacher"><?php print t('Teachers'); ?></a>
                              </li>
                              <li class="ins-sd-mn-itm">
                                 <a href="#duration-section" class="ins-sd-mn-itm-l" title="Duration"><?php print t('Duration'); ?></a>
                              </li>
                              <li class="ins-sd-mn-itm">
                                 <a href="#progression-section" class="ins-sd-mn-itm-l" title="Progression"><?php print t('Progression'); ?></a>
                              </li>                                             
                              <li class="ins-sd-mn-itm">
                                 <a href="#requirements-section" class="ins-sd-mn-itm-l" title="Requirements"><?php print t('Requirements'); ?></a>
                              </li>
                              <li class="ins-sd-mn-itm">
                                 <a href="#tuition-fees-section" class="ins-sd-mn-itm-l" title="Tuition fees"><?php print t('Tuition fees'); ?></a>
                              </li>
                              <li class="ins-sd-mn-itm">
                                 <a href="#student-work-section" class="ins-sd-mn-itm-l" title="Project showcase"><?php print t('Project showcase'); ?></a>
                              </li>
                              <li class="ins-sd-mn-itm">
                                 <a href="#student-feedback-section" class="ins-sd-mn-itm-l" title="Student feedback"><?php print t('Student feedback'); ?></a>
                              </li>
                              <li class="ins-sd-mn-itm">
                                 <a href="#graduates-section" class="ins-sd-mn-itm-l" title="Graduates" ><?php print t('Graduates'); ?></a>
                              </li>
                           <ul>
                        </div>
                     </div>
                  </div>
                  </div>
               </div>
               <!-- End of Sidebar Menu -->
               
               <!-- Main Content -->
               <div class="ins-lc-cnt-wrp">
                  
                  <!-- Course details -->
                  <div class="container">
                     <div class="row">
                        <div class="col-xs-12 col-sm-7 col-sm-push-4 article-cont">
                           <article class="ins-lc-sc-wrp ins-lc-cd">
                              <div class="ins-lc-sc-hd ins-lc-cd"> 
                                 <h3 class="ins-lc-sc-t" id="course-details-section"><?php print t('Course overview'); ?></h3>
                              </div>
                              
                              <div id="ins-lc-sc-cd-rdm">
                                 <div class="ins-lc-sc-bd ins-lc-cd"> 
                                    <?php print isset($detailsOverview) ? $detailsOverview : ''; ?>
                                 </div>
                                 <div class="ins-lc-sc-ft">
                                    <div class="ins-lc-dlfl-wrp <?php print !$syllabus['fid'] ? 'no-value': ''; ?>">
                                       <?php 
                                          if ($syllabus['fid']) {
                                             print l(t('Download syllabus'), $syllabus['url'], [
                                                'attributes' => [
                                                   'class' => 'btn-ins-lc-dlfl',
                                                   'title' => t('Download syllabus'),
                                                   'target' => '_blank',
                                                ]
                                             ]);
                                          }
                                       ?>
                                    </div>
                                 </div>
                              </div>
                           </article>
                        </div>
                     </div>
                  </div>
                  <!-- End of Course details -->
                  
                  <!-- Staff -->
                  <div class="container">
                     <div class="row">
                        <div class="col-xs-12 col-sm-8 col-sm-push-4">
                           <article class="ins-lc-sc-wrp ins-lc-st">
                              <div class="ins-lc-sc-hd ins-lc-st"> 
                                 <h3 class="ins-lc-sc-t" id="staff-section"><?php print t('Teachers'); ?></h3>
                              </div>
                              <div class="ins-lc-sc-bd ins-lc-st"> 
                                 <div class="ins-lc-sf-list">
                                    <?php if (isset($staffs) && count($staffs) > 0) : ?>
                                       <?php foreach ($staffs as $key => $staff) { ?>
                                          <div class="ins-lc-sf-itm">
                                             <a href="#" class="btn-ins-lc-sf-itm" data-nid="<?php print isset($staff['nid']) ? $staff['nid'] : ''; ?>" title="<?php print t('Click for details'); ?>">
                                                <div class="ins-lc-sf-img-wrp">
                                                   <div class="ins-lc-sf-img" data-src="<?php print isset($staff['profileImage']['url']) ? $staff['profileImage']['url'] : '' ?>"></div>
                                                </div>
                                                <div class="ins-lc-sf-cap-wrp">
                                                   <div class="ins-lc-sf-cap-bd">
                                                      <h4 class="ins-lc-sf-nm"><?php print isset($staff['fullName']) ? $staff['fullName'] : ''; ?></h4>
                                                      <h5 class="ins-lc-sf-ocp"><?php print isset($staff['shortTitle']) ? $staff['shortTitle'] : ''; ?></h5>
                                                   </div>
                                                </div>
                                             </a>
                                          </div>
                                       <?php } ?>
                                    <?php endif;?>
                                 </div>
                              </div> 
                           </article>
                        </div>
                     </div>
                  </div>
                  <!-- End of Staff -->
                  
                  <!-- Duration -->
                  <div class="container">
                     <div class="row">
                        <div class="col-xs-12 col-sm-8 col-sm-push-4">
                           <article class="ins-lc-sc-wrp ins-lc-dr">
                              <div class="ins-lc-sc-hd ins-lc-dr"> 
                                 <h3 class="ins-lc-sc-t" id="duration-section"><?php print t('Duration'); ?></h3>
                              </div>
                              
                              <?php if (isset($overrideDuration) && $overrideDuration != '') { ?>
                                 <?php // Display override duration info ?>
                                 <div>
                                    <?php print isset($overrideDuration) ? $overrideDuration : ''; ?>
                                 </div>
                              <?php } else { ?>                              
                                 <div class="ins-lc-sc-bd ins-lc-dr"> 
                                 <?php $oldVal = '';?>
                                    <?php if (isset($durationList) && $durationList) { $durCtr = count($durationList); ?>
                                       <?php foreach($durationList as $key => $duration) { ?>
                                          <div class="ins-lc-dr-ft-wrp <?php echo ($durCtr == ($key + 1) ? 'last' : ''); ?>">
                                             <div class="row">
                                                <div class="col-xs-12 col-sm-4">
                                                   <h4 class="ins-lc-dr-ft-t">
                                                   <?php if ($oldVal !== trim($duration['title'], " ")){ 
                                                      print isset($duration['title']) ? trim($duration['title'], " ") : '';
                                                      $oldVal = isset($duration['title']) ? trim($duration['title'], " ") : '';
                                                   } ?>
                                                   </h4>
                                                </div>
                                                <div class="col-xs-12 col-sm-8">
                                                   <ul class="list-unstyled ins-lc-dr-sch-list <?php echo ($durCtr == ($key + 1) ? 'last' : ''); ?> <?php echo (isset($duration['schoolCalendar']) && $duration['schoolCalendar']['url'] != '') ? '' : 'no-file'; ?>">
                                                   <?php if (isset($duration['isHideDate']) && $duration['isHideDate'] == 0): ?>
                                                      <li class="ins-lc-dr-sch-itm"><?php print isset($duration['date']) ? $duration['date'] : ''; ?></li>
                                                   <?php endif; ?>
                                                   <?php if (isset($duration['line1']) && $duration['line1'] != ''): ?>
                                                      <li class="ins-lc-dr-sch-itm"><?php print $duration['line1']; ?></li>
                                                   <?php endif; ?>
                                                   <?php if (isset($duration['line2']) && $duration['line2'] != ''): ?>
                                                      <li class="ins-lc-dr-sch-itm"><?php print $duration['line2']; ?></li>
                                                   <?php endif; ?>
                                                   <?php if (isset($duration['line3']) && $duration['line3'] != ''): ?>
                                                      <li class="ins-lc-dr-sch-itm last"><?php print $duration['line3']; ?></li>
                                                   <?php endif; ?>
                                                   </ul>
                                                   
                                                   <?php if (isset($duration['schoolCalendar']) && $duration['schoolCalendar']['url'] != ''): ?>
                                                      <div class="ins-lc-dr-sch-cld-wrp">
                                                         <?php 
                                                            print l(t('Download school calendar'), $duration['schoolCalendar']['url'], [
                                                               'attributes' => [
                                                                  'class' => 'btn-ins-lc-dr-sch-cld',
                                                                  'title' => t('Download school calendar'),
                                                                  'target' => '_blank',
                                                               ]
                                                            ]);
                                                         ?>
                                                      </div>
                                                   <?php endif; ?>
                                                </div>
                                             </div>
                                          </div>
                                       <?php } ?>
                                    <?php } ?>
                                 </div>
                              <?php } ?> 
                           </article>
                        </div>
                     </div>
                  </div>
                  <!-- End of Duration -->
                  
                  <!-- Progression -->
                  <div class="container">
                     <div class="row">
                        <div class="col-xs-12 col-sm-8 col-sm-push-4">
                           <article class="ins-lc-sc-wrp ins-lc-pg">
                              <div class="ins-lc-sc-hd ins-lc-pg"> 
                                 <h3 class="ins-lc-sc-t" id="progression-section"><?php print t('Progression'); ?></h3>
                              </div>
                              <div class="ins-lc-sc-bd ins-lc-pg"> 
                                 <p class="ins-lc-prg-dsc">
                                    <?php print isset($progression['description']) ? $progression['description'] : ''; ?>
                                 </p>
                                 <div class="ins-lc-prg-img-wrp">
                                    <?php 
                                       
                                       if ($progression['desktopImage']['fid']) {
                                          print theme_image([
                                             'path' => $progression['desktopImage']['url'],
                                             'alt' => $progression['desktopImage']['alt'],
                                             'title' => $progression['desktopImage']['title'],
                                             'attributes' => [
                                                'class' => 'img-responsive ins-lc-prg-img-d hidden-xs'
                                             ],
                                          ]);
                                       }
                                       
                                       if ($progression['mobileImage']['fid']) {
                                          print theme_image([
                                             'path' => $progression['mobileImage']['url'],
                                             'alt' => $progression['mobileImage']['alt'],
                                             'title' => $progression['mobileImage']['title'],
                                             'attributes' => [
                                                'class' => 'img-responsive ins-lc-prg-img-m visible-xs'
                                             ],
                                          ]);
                                       }
                                       
                                    ?>
                                 </div>
                              </div> 
                           </article>
                        </div>
                     </div>
                  </div>
                  <!-- End of Progression -->
                  
                  <!-- Requirements -->
                  <div class="container">
                     <div class="row">
                        <div class="col-xs-12 col-sm-8 col-sm-push-4">
                           <article class="ins-lc-sc-wrp ins-lc-rq">
                              <div class="ins-lc-sc-hd ins-lc-rq"> 
                                 <h3 class="ins-lc-sc-t" id="requirements-section"><?php print t('Requirements'); ?></h3>
                              </div>
                              <div class="ins-lc-sc-bd ins-lc-rq"> 
                                 <div id="ins-lc-sc-rq-rdm"> 
                                    <ul class="ins-lc-rq-list">
                                       <?php 
                                          $reqCtr = count($requirements);
                                          if (isset($requirements) && $reqCtr > 0) : 
                                          foreach ($requirements as $key => $requirement) { 
                                          ?>
                                             <li class="ins-lc-rq-itm <?php print (($key == ($reqCtr -1)) ? 'last' : ''); ?>"><?php print $requirement; ?></li>
                                       <?php } ?>
                                       <?php endif; ?>
                                    </ul>
                                 </div>
                              </div> 
                           </article>
                        </div>
                     </div>
                  </div>
                  <!-- End of Requirements -->
                  
                  <!-- Tuition fees -->
                  <div class="container">
                     <div class="row">
                        <div class="col-xs-12 col-sm-8 col-sm-push-4">
                           <article class="ins-lc-sc-wrp ins-lc-tf">
                              <div class="ins-lc-sc-hd ins-lc-tf"> 
                                 <h3 class="ins-lc-sc-t" id="tuition-fees-section"><?php print t('Tuition fees'); ?></h3>
                              </div>
                              <?php if (isset($overrideFee) && empty($overrideFee)): ?>
                                 <div class="ins-lc-sc-bd ins-lc-tf"> 
                                    <div class="ins-lc-sc-tf-wrp ins-lc-tf-t ">
                                       <div class="row">
                                          <div class="col-xs-12 col-sm-4">
                                             <h4 class="ins-lc-sc-tf-t"><?php print t('Total fee'); ?></h4>
                                          </div>
                                          <div class="col-xs-12 col-sm-8">
                                             <p class="ins-lc-sc-tf-itm"><?php print (isset($totalFeeCurrency) ? $totalFeeCurrency : '') . ' ' . number_format((isset($totalFee) && $totalFee ? $totalFee : 0)); ?></p>
                                             <div class="ins-lc-sc-tf-itm-nt-wrp">
                                                <p class="ins-lc-sc-tf-itm-nt"><?php print isset($totalFeeNote) ? $totalFeeNote : ''; ?></p>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="ins-lc-sc-tf-wrp ins-lc-tf-eb">
                                       <div class="row">
                                          <div class="col-xs-12 col-sm-4">
                                             <h4 class="ins-lc-sc-tf-t"><?php print t('Early bird fee'); ?></h4>
                                          </div>
                                          <div class="col-xs-12 col-sm-8">
                                             <p class="ins-lc-sc-tf-itm"><?php print isset($earlyBirdFee) ? $earlyBirdFee : ''; ?></p>
                                             <div class="ins-lc-sc-tf-itm-nt-wrp">
                                                <p class="ins-lc-sc-tf-itm-nt"><?php print isset($earlyBirdFeeNote) ? $earlyBirdFeeNote : ''; ?></p>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="ins-lc-sc-tf-wrp ins-lc-tf-if last">
                                       <div class="row">
                                          <div class="col-xs-12 col-sm-4">
                                             <h4 class="ins-lc-sc-tf-t"><?php print t('Instalment info'); ?></h4>
                                          </div>
                                          <div class="col-xs-12 col-sm-8">
                                             <?php if (isset($installmentInfo) && count($installmentInfo) > 0) : ?>
                                                <?php foreach ($installmentInfo as $key => $installmentItem) { ?>
                                                   <p class="ins-lc-sc-tf-itm"><?php print $installmentItem; ?></p>
                                                <?php } ?>
                                             <?php endif; ?>
                                             <div class="ins-lc-sc-tf-itm-nt-wrp">
                                                <p class="ins-lc-sc-tf-itm-nt">
                                                   <?php 
                                                      print t('Need help with the tuition fee? Find out more about our <a href="@url" class="btn-ins-lc-sc-intl-if" title="scholarship scheme.">scholarship scheme.</a>', [
                                                         '@url' => url('scholarship'),
                                                      ]);
                                                   ?>
                                                </p>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div> 
                              <?php else: ?>
                                 <div>
                                    <?php print $overrideFee; ?>
                                 </div>
                              <?php endif; ?>
                           </article>
                        </div>
                     </div>
                  </div>
                  <!-- End of Tuition fees -->
                  
                  <!-- Student work -->
                  <article class="ins-lc-sc-wrp ins-lc-sw ins-lc-sw-ovwrt">
                     
                     <div class="container">
                        <div class="row">
                           <div class="col-xs-12 col-sm-8 col-sm-push-4">
                              <div class="ins-lc-sc-hd ins-lc-sw"> 
                                 <h3 class="ins-lc-sc-t" id="student-work-section"><?php print t('Student work'); ?></h3>
                              </div>   
                           </div>
                        </div>
                     </div>
                     
                     <div class="container-fluid">
                        <div class="row">
                           <div class="col-xs-12 col-sm-8 col-sm-push-4">
                              <div class="ins-lc-sc-bd ins-lc-sw"> 
                                 <div class="ins-lc-sw-list">
                                    <?php if (isset($studentWorks) && count($studentWorks) > 0) : ?>
                                       <?php foreach ($studentWorks as $studentWork) { ?>
                                          <div id="ins-lc-sw-mrgn" class="ins-lc-sw-itm">
                                             <a href="#" class="btn-ins-lc-sw-itm" title="<?php print t('Click for details'); ?>" data-nid="<?php print isset($studentWork['nid']) ? $studentWork['nid'] : ''; ?>">
                                                <div> 
                                                   <img class="ins-lc-sw-img-wrp" data-lazy="<?php print isset($studentWork['coverImage']['url']) ? $studentWork['coverImage']['url'] : '';?>"/>
                                                </div>
                                                <div id="vl-mgn-top" class="ins-lc-sw-cap-wrp">
                                                   <h6 id="lc-det-cap" class="ins-lc-sw-cp ins-lc-gd-cp2"><?php print isset($studentWork['name']) ? $studentWork['name'] : ''; ?></h6>
                                                </div>
                                             </a>
                                          </div>
                                       <?php } ?>
                                    <?php endif; ?>
                                 </div>
                              </div> 
                           </div>
                        </div>
                     </div>
                  </article>
                  <!-- End of Student work -->
                  
                  <!-- Student feedback -->
                  <div class="container">
                     <div class="row">
                        <div class="col-xs-12 col-sm-8 col-sm-push-4">
                           <article class="ins-lc-sc-wrp ins-lc-sf">
                              <div class="ins-lc-sc-hd ins-lc-sf"> 
                                 <h3 class="ins-lc-sc-t" id="student-feedback-section"><?php print t('Student feedback'); ?></h3>
                              </div>
                              <div class="ins-lc-sc-bd ins-lc-sf"> 
                                 <?php 
                                    if (isset($studentFeedbacks) && !empty($studentFeedbacks)) { 
                                 ?>
                                       <div class="ins-lc-sf-qh-list">
                                       
                                          <?php foreach ($studentFeedbacks as $feedBack) { ?>
                                          
                                                <div class="ins-lc-sf-qh ins-lc-sf-qh-itm">
                                                   <div class="ins-lc-sf-qh-bd">
                                                      <div class="ins-lc-sf-q-wrp">
                                                         <div class="ins-lc-sf-lqh">
                                                            <?php 
                                                               print theme_image([
                                                                  'path' => "{$images_path}quote-left.png",
                                                                  'alt' => 'quote image',
                                                                  'title' => 'quote image',
                                                                  'attributes' => [
                                                                     'class' => 'img img-responsive'
                                                                  ],
                                                               ]);
                                                            ?>
                                                         </div>
                                                         <p class="ins-lc-sf-q"><?php print $feedBack['content']; ?></p>
                                                         <div class="ins-lc-sf-rqh">
                                                            <?php 
                                                               print theme_image([
                                                                  'path' => "{$images_path}quote-right.png",
                                                                  'alt' => 'quote image',
                                                                  'title' => 'quote image',
                                                                  'attributes' => [
                                                                     'class' => 'img img-responsive'
                                                                  ],
                                                               ]);
                                                            ?>
                                                         </div>
                                                      </div>
                                                      <h5 class="ins-lc-sf-c lc-stdnt-nm"><?php print isset($feedBack['studentName']) ? $feedBack['studentName'] : ''; ?></h5>
                                                   </div>
                                                </div>
                                                
                                          <?php } ?>
                                          
                                       </div>
                                 <?php 
                                    } 
                                 ?>
                              </div> 
                           </article>
                        </div>
                     </div>
                  </div>
                  <!-- End of Student feedback -->
                  
                  <!-- Graduates -->
                  <article class="ins-lc-sc-wrp ins-lc-gd">
                     
                     <div class="container">
                        <div class="row">
                           <div class="col-xs-12 col-sm-8 col-sm-push-4">
                              <div class="ins-lc-sc-hd ins-lc-gd"> 
                                 <h3 class="ins-lc-sc-t" id="graduates-section">Graduates</h3>
                              </div>
                           </div>
                        </div>                                    
                     </div>
                     
                     <div class="container-fluid">
                        <div class="row">
                           <div class="col-xs-12 col-sm-8 col-sm-push-4">
                              <div class="ins-lc-sc-bd ins-lc-gd"> 
                                 <div class="ins-lc-gd-list">
                                    <?php if (isset($graduates) && count($graduates) > 0) : ?>
                                       <?php foreach ($graduates as $graduate) { ?>
                                             <div class="ins-lc-gd-itm">
                                                <a href="#" class="btn-ins-lc-gd-itm" title="<?php print t('Click for details'); ?>" data-nid="<?php print $graduate['nid']; ?>">
                                                   <div class="ins-lc-gd-img-wrp"> 
                                                      <div class="ins-lc-gd-img" style="background-image: url('<?php print isset($graduate['coverImage']['url']) ? $graduate['coverImage']['url'] : ''?>');"></div>
                                                   </div>
                                                   <div id="vl-mgn-top" class="ins-lc-gd-cap-wrp">
                                                      <h6 id="lc-det-cap" class="ins-lc-gd-cp ins-lc-gd-cp2"><?php print isset($graduate['name']) ? $graduate['name'] : ''; ?></h6>
                                                   </div>
                                                </a>
                                             </div>
                                       <?php } ?>
                                    <?php endif; ?>
                                 </div>
                              </div> 
                           </div>
                        </div>
                     </div>
                  </article>
                  <!-- Graduates -->
                  
               </div>
               <!-- Endo of Main Content -->
                  
            
         </div>
         
      </div>
      
      
   </section>
   
</div>

<?php if (!empty($page['footer'])): ?>

    <?php print render($page['footer']); ?>

<?php endif; ?>