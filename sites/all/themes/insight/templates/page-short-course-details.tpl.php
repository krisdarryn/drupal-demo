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
   
   <div id="ins-mn-bdy-cntr" class="common sml-bnr3 sc-page-bd">
                  
      <section id="ins-lc-wrp" data-sticky-container>
         
         <div class="ins-lc-hd">   
            <?php if (isset($bannerImage['url']) && $bannerImage['url']): ?>
               <div class="ins-lc-bnr ins-sc-bnr-d hidden-xs" style="background-image: url('<?php print $bannerImage['url']; ?>');"></div>
            <?php else: ?>
               <div class="ins-lc-bnr ins-sc-bnr-d hidden-xs"></div>
            <?php endif; ?>
            
            <div class="ins-lc-bnr ins-sc-bnr-m visible-xs" data-src="<?php print isset($coverImage['url']) ? $coverImage['url'] : ''; ?>"></div>
            
            <!-- Booking Section -->
            <div class="ins-lc-enq-cnt ins-sc-bo-cnt">
               <div class="container">
                  <div class="row">
                     <div class="col-xs-12 col-sm-7 col-md-6 col-md-push-1">
                        
                        <div class="ins-lc-enq-wrp ins-sc-bo-wrp">
                           <div class="ins-lc-enq-hd">
                              <h1 class="ins-lc-enq-hd-t ins-lc-sc-t ins-cs-bi-hd-t" id="book-online-section"><?php print isset($title) ? $title : ''; ?></h1>
                           </div>
                           <div class="ins-lc-enq-bd">
                           
                              <form id="formBooking" action="<?php print url('booking/1'); ?>" method="GET">
                                 <input type="hidden" name="course" value="<?php print $courseNid; ?>">
                                 
                                 <div class="row">
                                    <div class="ins-lc-enq-sch-wrp col-xs-12 col-sm-9">
                                       <div class="ins-lc-enq-sch-ft-wrp ins-sc-bo-bd">
                                          <div class="ins-dd-wrp"> 
                                             <img src="<?php print "{$images_path}down-arrow.png"?>" alt="Dropdown Icon" class="ins-dd-icon" />
                                             <div class="ins-dd-overlay"></div>
                                             <select class="form-control ins-tf ins-dd sched-opt" id="bookschedule" name="bookschedule">
                                                <option value="-1"><?php print t('Please Select'); ?></option>
                                                
                                                <?php if (isset($durationList) && $durationList): ?>
                                                   <?php foreach ($durationList as $duration) { ?>
                                                      <?php
                                                         if (
                                                            isset($duration['title']) &&
                                                            !empty($duration['title']) &&
                                                            isset($duration['date']) &&
                                                            !empty($duration['date'])
                                                         ):
                                                            $schedule = isset($duration['title']) ? '[' . $duration['title'] . ']' : '';
                                                            $schedule .= isset($duration['date']) ? ' ' . $duration['date'] : '';
                                                      ?>
                                                            <option value="<?php print isset($duration['grpid']) ? $duration['grpid'] : ''; ?>"><?php print $schedule; ?></option>
                                                      <?php endif; ?>
                                                   <?php } ?>
                                                <?php endif; ?>
                                             </select>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="col-xs-12 col-xs-12 col-sm-3 btn-book-wrp">
                                       <div class="ins-lc-enq-btn-wrp ins-sc-bo-btn-wrp">
                                          <button type="button" id="btnBookNow" class="btn btn-ins-drk btn-lc-en btn-sc-bo"><?php print t('Book Now'); ?></button>
                                       </div>
                                    </div>
                                 </div>
                              </form>
                              
                           </div>
                        </div>
                        
                     </div>
                     <div class="hidden-xs col-sm-5 col-md-push-1">
                        <div class="ins-lc-ci-wrp">
                           <div class="ins-cs-clp"></div>
                           <div class="ins-lc-ci" data-src="<?php print isset($coverImage['url']) ? $coverImage['url'] : ''; ?>"></div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!-- End of Enquire Section -->
         </div>
         
         <div class="ins-lc-bd">
         
            <div class="ins-lc-cnt-wrp">
            
               <!-- Sidebar Menu -->
               <div class="ins-sd-mn-wrap">
                  <div class="container">
                  <div class="row">
                     <div class="col-sm-3 col-md-push-1 hidden-xs article-cont">
                        <div class="ins-lc-sb-mn-wrp" data-margin-top="154">
                           <ul class="list-unstyled ins-sd-mn-list">
                              <li class="ins-sd-mn-itm active">
                                 <a href="#book-online-section" id="book-online-btn" class="ins-sd-mn-itm-l" title="<?php print t('Book online'); ?>"><?php print t('Book online'); ?></a>
                              </li>
                              <li class="ins-sd-mn-itm">
                                 <a href="#course-overview-section" class="ins-sd-mn-itm-l" title="<?php print t('Course overview'); ?>"><?php print t('Course overview'); ?></a>
                              </li>
                              <?php if (isset($staffs) && count($staffs) > 0) : ?>
                              <li class="ins-sd-mn-itm">
                                 <a href="#staff-section" class="ins-sd-mn-itm-l" title="<?php print t('Teacher'); ?>"><?php print t('Teachers'); ?></a>
                              </li>
                              <?php endif ?>
                              <li class="ins-sd-mn-itm">
                                 <a href="#duration-section" class="ins-sd-mn-itm-l" title="<?php print t('Duration'); ?>"><?php print t('Duration'); ?></a>
                              </li>
                              <li class="ins-sd-mn-itm">
                                 <a href="#suitability-section" class="ins-sd-mn-itm-l" title="<?php print t('Suitability'); ?>"><?php print t('Suitability'); ?></a>
                              </li>
                              <li class="ins-sd-mn-itm">
                                 <a href="#tuition-fees-section" class="ins-sd-mn-itm-l" title="<?php print t('Tuition fees'); ?>"><?php print t('Tuition fees'); ?></a>
                              </li>
                              <li class="ins-sd-mn-itm">
                                 <a href="#student-feedback-section" class="ins-sd-mn-itm-l" title="<?php print t('Student feedback'); ?>"><?php print t('Student feedback'); ?></a>
                              </li>
                              <li class="ins-sd-mn-itm">
                                 <a href="#get-notified-section" class="ins-sd-mn-itm-l" title="<?php print t('Get Notified'); ?>"><?php print t('Get Notified'); ?></a>
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
                                 <h3 class="ins-lc-sc-t" id="course-overview-section"><?php print t('Course overview'); ?></h3>
                              </div>
                              
                              <div id="ins-lc-sc-cd-rdm">
                                 <div class="ins-lc-sc-bd ins-sc-cd"> 
                                    <?php print isset($detailsOverview) ? $detailsOverview : ''; ?>
                                 </div> 
                              </div>
                              
                           </article>
                        </div>
                     </div>
                  </div>
                  <!-- End of Course details -->
                  
                  <!-- Staff -->
                  <?php if (isset($staffs) && count($staffs) > 0) : ?>
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
                                          <a href="#" class="btn-ins-lc-sf-itm" data-nid="<?php print $staff['nid']; ?>" title="<?php print t('Click for details'); ?>">
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
                                 <?php endif; ?>
                                 </div>
                              </div> 
                           </article>
                        </div>
                     </div>
                  </div>
                  <?php endif ?>
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
                                 <?php // Display duration list info ?>
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
                                                   <ul class="list-unstyled ins-lc-dr-sch-list <?php echo ($durCtr == ($key + 1) ? 'last' : ''); ?>">
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
                                                      <li class="ins-lc-dr-sch-itm"><?php print $duration['line3']; ?></li>
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
                  
                  <!-- Suitability -->
                  <div class="container">
                     <div class="row">
                        <div class="col-xs-12 col-sm-8 col-sm-push-4">
                           <article class="ins-lc-sc-wrp ins-sc-stb">
                              <div class="ins-lc-sc-hd ins-lc-rq"> 
                                 <h3 class="ins-lc-sc-t" id="suitability-section"><?php print t('Suitability'); ?></h3>
                              </div>
                              <div id="ins-lc-sc-rq-rdm"> 
                                 <ul class="ins-lc-rq-list">
                                    <?php if (isset($suitability) && count($suitability) > 0) : ?>
                                    <?php foreach ($suitability as $item) { ?>
                                       <li class="ins-lc-rq-itm last"><?php print isset($item) ? $item : ''; ?></li>
                                    <?php } ?>
                                    <?php endif; ?>
                                 </ul>
                              </div>                                          
                           </article>
                        </div>
                     </div>
                  </div>
                  <!-- End of Suitability -->
                  
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
                                    <!--
                                    <div class="ins-lc-sc-tf-wrp ins-lc-tf-t last">
                                       <div class="row">
                                          <div class="col-xs-12 col-sm-4">
                                             <h4 class="ins-lc-sc-tf-t"><?php //print t('Total fee'); ?></h4>
                                          </div>
                                          <div class="col-xs-12 col-sm-8">
                                             <p class="ins-lc-sc-tf-itm"><?php //print (isset($totalFeeCurrency) ? $totalFeeCurrency : '') . ' ' . number_format((isset($totalFee) && $totalFee ? $totalFee : 0)); ?></p>
                                             <div class="ins-lc-sc-tf-itm-nt-wrp">
                                                <p class="ins-lc-sc-tf-itm-nt"><?php //print isset($totalFeeNote) ? $totalFeeNote : ''; ?></p>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    -->
                                    <?php foreach ($durationList as $item): ?>
                                       <?php 
                                           if (
                                             isset($item['title']) &&
                                             !empty($item['title']) &&
                                             isset($item['date']) &&
                                             !empty($item['date'])
                                          ):
                                       ?>
                                          <div class="ins-lc-sc-tf-wrp ins-lc-tf-t last">
                                             <div class="row">
                                                <div class="col-xs-12 col-sm-4">
                                                   <h4 class="ins-lc-sc-tf-t"><?php print $item['title']; ?></h4>
                                                </div>
                                                <div class="col-xs-12 col-sm-8">
                                                   <p class="ins-lc-sc-tf-itm"><?php print "{$item['feeCurrency']} {$item['fee']}" ?></p>
                                                </div>
                                             </div>
                                          </div>
                                       <?php endif; ?>
                                    <?php endforeach; ?>
                                    
                                 </div> 
                              <?php elseif (isset($overrideFee) && !empty($overrideFee)): ?>
                                 <div>
                                    <?php print $overrideFee; ?>
                                 </div>
                              <?php endif; ?>
                           </article>
                        </div>
                     </div>
                  </div>
                  <!-- End of Tuition fees -->
                  
                  <!-- Student feedback -->
                  <div class="container">
                     <div class="row">
                        <div class="col-xs-12 col-sm-8 col-sm-push-4">
                           <article class="ins-lc-sc-wrp ins-lc-sf ins-sc-gn ins-sc-sf-wrp">
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
                                                      <h5 class="ins-lc-sf-c sc-stdnt-nm"><?php print $feedBack['studentName']; ?></h5>
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
                  
                  <!-- Get Notified -->
                  <div class="ins-sc-gn-bg">
                     <div class="container">
                        <div class="row">
                           <div class="col-xs-12 col-sm-8 col-sm-push-4">
                              <article class="ins-lc-sc-wrp ins-sc-gn ins-sc-gn-wrp">
                                 <div class="ins-lc-sc-hd ins-sc-gn"> 
                                    <h3 class="ins-lc-sc-t" id="get-notified-section">
                                       <span><?php print t('Please let me know when this course is next on.'); ?></span>
                                    </h3>
                                 </div>
                                 <div class="ins-lc-sc-bd ins-sc-gn-bd"> 
                                    <form class="form-horizontal" id="ins-cs-gn-frm" action="" method="post">
                                       <input type="hidden" value="<?php print isset($title) ? $title : ''; ?>" name="gn_course_name" />
                                       <div class="form-group ins-cs-frm-grp">
                                          <label class="col-xs-12 text-uppercase ins-cs-gn-lb" for="gn-first-name"><?php print t('First Name'); ?></label>
                                          <div class="col-xs-12">
                                             <input type="text" class="form-control ins-tf" id="gn-first-name" name="gn_first_name" />
                                          </div>
                                       </div>
                                       <div class="form-group ins-cs-frm-grp">
                                          <label class="col-xs-12 text-uppercase ins-cs-gn-lb" for="gn-last-name"><?php print t('Last Name'); ?></label>
                                          <div class="col-xs-12">
                                             <input type="text" class="form-control ins-tf" id="gn-last-name" name="gn_last_name" />
                                          </div>
                                       </div>
                                       <div class="form-group ins-cs-frm-grp">
                                          <label class="col-xs-12 text-uppercase ins-cs-gn-lb" for="gn-email"><?php print t('Email'); ?></label>
                                          <div class="col-xs-12">
                                             <input type="email" class="form-control ins-tf" id="gn-email" name="gn_email" />
                                          </div>
                                       </div>
                                       <div class="form-group ins-cs-frm-grp">   
                                          <div class="col-xs-12">
                                             <button type="submit" name="submit" class="btn-ing-cs-gn btn-ins-drk"><?php print t('Get Notified'); ?></button>
                                          </div>
                                       </div>
                                    </form>
                                 </div> 
                              </article>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- End of Get Notified -->
                  
               </div>
               <!-- Endo of Main Content -->
               
            </div>
            
         </div>
         
         
      </section>
      
   </div>

   <?php if (!empty($page['footer'])): ?>

       <?php print render($page['footer']); ?>

   <?php endif; ?>