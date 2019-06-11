<?php
global $base_url;
$images_path = $base_url . '/' . drupal_get_path('theme', 'insight') . '/dist/images/';
?>

<div id="ins-mn-bdy-cntr" class="common sml-bnr2">
   
   <section id="ins-ec-wrp">
      <div>
      <div class="banner-center-text" data-src="<?php print isset($bannerImageUrl) ? $bannerImageUrl : ''; ?>">
      
         <div class="banner-content">
            <p id="mob-banner-text"><?php print isset($bannerSlogan) ? $bannerSlogan : ''; ?></p>
         </div>
      </div>
      <div class="ins-ec-bd">
          
         <div id="ins-ec-intro">
            <div class="container">
               <div class="row">
                  <div class="col-xs-12">
                     
                     <div class="ins-ec-it-wrp">
                        <div class="ins-ec-it-hd">
                           <h1 class="ins-ec-it-tl"><?php print isset($introTitle) ? $introTitle : ''; ?></h1>
                        </div>
                        <div class="ins-ec-it-bd">
                           <?php print isset($introDescription) ? $introDescription : ''; ?>
                        </div>
                     </div>
                     
                  </div>
               </div>
            </div>
         </div>
         
         <div id="ins-ec-list">
            <div class="container">
               <?php $ctr = 1; ?>
               <?php if (isset($courseList) && count($courseList) > 0) : ?>
                  <?php foreach ($courseList as $course): ?>
                     <?php $isEven = (fmod($ctr, 2) == 0) ? TRUE : FALSE; ?>
                     <div class="ins-ec-itm <?php print ($isEven) ? 'even' : 'odd'; ?>">
                        <div class="row">
                           
                           <div class="col-xs-12 col-sm-7<?php print (! $isEven) ? ' col-sm-push-5' : ''; ?>">
                              <div class="ins-ec-img-wrp">
                                 <div class="ins-ec-img" data-src="<?php print isset($course['coverImageUrl']) ? $course['coverImageUrl'] : ''; ?>"></div>
                              </div>
                           </div>
                           
                           <div class="col-xs-12 col-sm-5<?php print (! $isEven) ? ' col-sm-pull-7' : ''; ?>">
                              <div class="ins-ec-itm-cnt-wrp">
                                 <div class="ins-ec-itm-cnt-hd">
                                    <h2 class="ins-ec-itm-tl"><?php print isset($course['title']) ? $course['title'] : ''; ?></h2>
                                 </div>
                                 <div class="ins-ec-itm-cnt-bd">
                                    <?php print isset($course['overview']) ? $course['overview'] : ''; ?>
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
         
      </div>
   
   </section>
    
</div>