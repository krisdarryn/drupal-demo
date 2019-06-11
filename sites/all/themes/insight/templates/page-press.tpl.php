<?php
global $base_url;
$insight_theme_path = $base_url.'/'.drupal_get_path('theme', 'insight');
$images_path = $insight_theme_path.'/dist/images/';
$scripts_path = $insight_theme_path.'/dist/scripts/';
?>

<div id="ins-mn-bdy-cntr" class="common">
   <div id="" class="common head-fix">
   <!-- Banner -->
      <div class="banner-center-text" data-src="<?php print isset($bannerImageUrl) ? $bannerImageUrl : ''; ?>">
         <div class="banner-content">
            <p id="mob-banner-text"><?php print isset($bannerSlogan) ? $bannerSlogan : ''; ?></p>
         </div>
      </div>
      
      <!-- End of Banner -->
      <?php
      $params = array(
       'activePage' => 'press',
       'baseUrl' => $base_url,
      );
      $block = module_invoke('custompage', 'block_view', 'discover-secondary-menu', $params);
      print render($block['content']);
      ?>
    </div>
    
<div class="stdnt-wrks press-cnt-cont">
   <div class="container">
      <div class="press-schcs press-hd-mb-exc">

         <div class="intro-panl">
            <div class="row">
               <div class="col-xs-12 col-sm-8">
                  <div class="cont-sec" id="intro-sec">
                     <div class="cont-head">
                        <h1 class="au-h1-tle"><?php echo isset($headerTitle) ? $headerTitle : ''; ?></h1>
                     </div>
                  </div>
               </div>
            </div>
         </div> 

         <div class="row">
            <?php 
               $counter=0;
               if (isset($pressItems) && count($pressItems) > 0) :
               foreach ($pressItems as $key => $itm) { ?>
               <div class="col-xs-12 col-sm-4 shcs-bdy-col <?php echo 'press-item-' . ($key+ 1); ?> <?php echo ++$key > 3 ? 'excess-default-no' : ''; ?>">
                  <div class="shcs-bdy">
                     <div class="shcs-bdy-img-hlder">
                     <?php if (isset($itm['file']['url']) && $itm['file']['url'] != ''): ?>
                        <a href="<?php echo $itm['file']['url']; ?>" target="_blank">
                           <img class="img-responsive center-block" data-src="<?php echo $itm['coverImageUrl']; ?>" alt="<?php echo $itm['coverImageAlt']; ?>" title="<?php echo $itm['coverImageTitle']; ?>">
                        </a>
                     <?php else: ?>
                        <img class="img-responsive center-block" data-src="<?php echo $itm['coverImageUrl']; ?>" alt="<?php echo $itm['coverImageAlt']; ?>" title="<?php echo $itm['coverImageTitle']; ?>">
                     <?php endif; ?>
                     </div>
                     <div class="shcs-dsc">
                        <p><?php echo $itm['title']; ?> <span class="grd-hl"><?php echo $itm['location']; ?>, <?php echo $itm['postDate']; ?></span></p>
                     </div>
                  </div>
               </div>
            <?php
               if (++$counter % 3 == 0) {
                  echo '<div class="clearfix"></div>';
               }
               }
            ?>
            <?php endif; ?>
         </div>

            <div class="col-xs-12 visible-xs">
               <div class="shcs-bdy text-right clearfix btn-sh-mr-press-wrp hidden-sm hidden-md hidden-lg <?php echo (count($pressItems) > 3 ? 'press-render-show-more' : 'press-hide-show-more'); ?>">
                  <a href="javascript:" title="Show more" id="btn-sh-mr-press" class="read-more"><?php print t('Load more');?></a>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
