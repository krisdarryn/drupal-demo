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

<?php render($page['content']['metatags']); ?>

<div id="ins-mn-bdy-cntr" class="common sml-bnr3 page-event-detail">
   <div class="ins-sc-hd">   
   <div class="ins-lc-bnr ins-sc-bnr-d hidden-xs"></div>
      <div class="ins-lc-bnr ins-sc-bnr-m visible-xs" data-src="<?php print isset($coverImage['url']) ? $coverImage['url'] : ''; ?>"></div>
      <div class="ins-lc-bnr ins-sc-bnr-d hidden-xs" data-src="<?php print isset($eventDetails['bannerImageUrl']) ? $eventDetails['bannerImageUrl'] : ''; ?>"></div>
      <div class="ins-lc-bnr ins-sc-bnr-m visible-xs" data-src="<?php print isset($eventDetails['eventImageUrl']) ? $eventDetails['eventImageUrl'] : ''; ?>"></div>
      
      <!-- Enquire Section -->
      <div class="ins-lc-enq-cnt ins-sc-bo-cnt">
         <div class="container">
            <div class="row">
               <div class="col-xs-12 col-sm-7 col-md-6 pull-left">
                  <div class="ins-sc-enq-wrp">
                     <div class="ins-sc-enq-bd">
                        <div class="row">
                           <div class="col-xs-12 col-sm-12">
                              <div class="ins-lc-enq-hd event-det">
                                 <h1 class="ins-lc-enq-hd-t ins-lc-sc-t ins-cs-bi-hd-t" id="event-details-section"><?php print isset($eventDetails['title']) ? $eventDetails['title'] : ''; ?></h1>
                              </div>
                           </div>
                           <div class="col-xs-12 col-sm-9 clearfix">
                              <div class="ins-date-box">
                                 <p>
                                    <?php 
                                       if (
                                          $eventDetails['startDate'] &&
                                          $eventDetails['endDate'] &&
                                          ($eventDetails['startDate'] == $eventDetails['endDate'])
                                       ):
                                          print $eventDetails['startDate'];
                                       elseif ($eventDetails['startDate'] && $eventDetails['endDate']):
                                          print $eventDetails['startDate'] . ' — ' . $eventDetails['endDate'];
                                       endif;
                                       
                                    ?>
                                 </p>
                              </div>
                           </div>
                           <div class="col-xs-12 col-sm-3 btn-book-wrp">
                              <div class="ins-sc-enq-btn-wrp ins-sc-bo-btn-wrp">
                                 <?php $mailto = 'mailto:' . str_replace(" ", "",$eventDetails['email']) . '&amp;subject=' . str_replace(" ", "%20", $eventDetails['title']); ?>
                                 <a href="<?php print $mailto; ?>" class="btn btn-ins-drk btn-lc-en btn-sc-bo hidden-xs btn-ed-eq" title="<?php print $eventDetails['ctaCaption']; ?>">
                                    <span><?php print isset($eventDetails['ctaCaption']) ? $eventDetails['ctaCaption'] : ''; ?></span>   
                                 </a>
                                 <a href="<?php print $mailto; ?>" class="btn btn-ins-drk btn-lc-en btn-sc-bo visible-xs" title="<?php print isset($eventDetails['ctaCaption']) ? $eventDetails['ctaCaption'] : ''; ?>">
                                    <span><?php print isset($eventDetails['ctaCaption']) ? $eventDetails['ctaCaption'] : ''; ?></span>   
                                 </a>
                              </div>
                           </div>            
                        </div>
                     </div>
                  </div>
                  <div class="event-enquire-msg">
                     <?php print isset($eventDetails['introDescription']) ? $eventDetails['introDescription'] : ''; ?>
                  </div>
               </div>
               <div class="hidden-xs col-sm-5 col-md-push-1">
                  <div class="ins-lc-ci-wrp">
                     <div class="ins-cs-clp"></div>
                     <div class="ins-lc-ci" data-src="<?php print isset($eventDetails['eventImageUrl']) ? $eventDetails['eventImageUrl'] : ''; ?>"></div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- End of Enquire Section -->
   </div>

   <div class="ins-ev-bd">      
      <div class="ins-e-summary container">
         <div class="row">
            <div class="col-xs-12 col-sm-11 ev-summary-section">
               <?php print isset($eventDetails['description']) ? $eventDetails['description'] : ''; ?>
            </div>
         </div>    
      </div>

      <div class="container-fluid">
         <div class="row">
            <div class="col-xs-12">
               <div class="slider-container">
                  <div class="slider-section">
                     <?php if (isset($eventDetails['galleries']) && count($eventDetails['galleries']) > 0) : ?>
                     <?php foreach ($eventDetails['galleries'] as $img): ?>
                     <div>
                        <img class="sldr-images" data-lazy="<?php print isset($img['imageUrl']) ? $img['imageUrl'] : ''; ?>"/>
                        <p class="slide-desc"><?php print isset($img['caption']) ? $img['caption'] : ''; ?></p>
                     </div>
                     <?php endforeach; ?>
                     <?php endif;?>
                  </div>
               </div>
            </div>
         </div>
      </div>


      <div class="ins-e-share container">
         <div class="row">
         
               <div class="col-xs-12 event-bottom-desc">
                  <?php print isset($eventDetails['bottomDescription']) ? $eventDetails['bottomDescription'] : ''; ?>
               </div>
               
               <div class="col-xs-12 blog-share ">
                  <div class="inner-div grey-container-wrapper">
                     <div class="share-text text-uppercase"><?php print t('SHARE THIS POST');?></div>
                     <ul class="share-icons-list list-unstyled list-inline">
                        <li class="share-icons">
                           <a href="https://www.facebook.com/insightinteriorschoolhk" id="" class="text-uppercase" title="Facebook" target="_blank">
                              <img class="img img-responsive" src="<?php print $images_path; ?>mb-facebook-icon.png"></img>
                           </a> 
                        </li>
                        <li class="share-icons">
                           <a href="https://twitter.com/insightschoolhk" id="" class="text-uppercase" title="Twitter" target="_blank">
                              <img class="img img-responsive" src="<?php print $images_path; ?>mb-twitter-icon.png"></img>
                           </a>          
                        </li>

                        <li class="share-icons">
                           <a href="http://instagram.com/insightschool" id="" class="text-uppercase" title="Instagram" target="_blank">
                              <img class="img img-responsive" src="<?php print $images_path; ?>mb-instagram-icon.png"></img>
                           </a> 
                        </li>

                        <li class="share-icons">
                           <a href="https://hk.linkedin.com/company/insight-school-of-interior-design" id="" class="text-uppercase" title="LinkedIn" target="_blank">
                              <img class="img img-responsive" src="<?php print $images_path; ?>mb-linkedin-icon.png"></img>
                           </a>      
                        </li>

                        <li class="share-icons">
                           <?php $mailto = 'mailto:' . $eventDetails['email'] . '?subject=' . str_replace(" ", "%20", $eventDetails['title']); ?>
                           <a href="<?php print $mailto; ?>" id="" class="text-uppercase" title="Collaborate">
                              <img class="img img-responsive" src="<?php print $images_path; ?>email-icon.png"></img>
                           </a>    
                        </li>
                     </ul>
                  </div>
               </div> <!-- end of share -->

            </div>
         </div> <!-- end of share cont -->
      </div>
   </div> <!-- end of bd -->
   
<?php if (!empty($page['sidebar_second'])): ?>
<aside class="col-sm-3" role="complementary">
  <?php print render($page['sidebar_second']); ?>
</aside>  <!-- /#sidebar-second -->
<?php endif; ?>


<?php if (!empty($page['footer'])): ?>

    <?php print render($page['footer']); ?>

<?php endif; ?>
   
   