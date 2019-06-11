<?php
global $base_url;
$insight_theme_path = $base_url.'/'.drupal_get_path('theme', 'insight');
$images_path = $insight_theme_path.'/dist/images/';
$scripts_path = $insight_theme_path.'/dist/scripts/';
?>


<div id="ins-mn-bdy-cntr" class="partner-page">
<!-- Place page layout codes here -->
<div class="page-cont-mn">
   <div id="" class="common head-fix">
   <div class="banner-center-text" data-src="<?php print isset($bannerImageUrl) ? $bannerImageUrl : ''; ?>">
      <div class="banner-content">
         <p id="mob-banner-text"><?php print isset($bannerSlogan) ? $bannerSlogan : ''; ?></p>
      </div>
   </div>

   <?php
    $params = array(
        'activePage' => 'partners'
    );
    $block = module_invoke('custompage', 'block_view', 'collaborate-secondary-menu', $params);
    print render($block['content']);
    ?>
    </div>
   <div class="partner-mn-cont">

      <div class="container">
      <div class="intro-panl">
         <div class="row">
            <div class="col-xs-12 col-sm-8">
               <div class="cont-sec" id="intro-sec">
                  <div class="cont-head">
                     <h1 class="au-h1-tle"><?php print isset($introTitle) ? $introTitle : ''; ?></h1>
                  </div>
                  <div class="cont-body prtnr-cont-body">
                     <p><?php print isset($introDescription) ? $introDescription : ''; ?></p>
                  </div>
               </div>
            </div>
         </div>
      </div> 
      </div>

      <div class="list-section container">
         <div class="list-section-wrp prtnr-hd-mb-exc">
            <?php 
            $count=0;
            if (isset($partnerList) && count($partnerList) > 0) :
               foreach($partnerList as $key => $list){ ?>
                  
                  <?php if ($list['isLive']){ ?>
                     <div class="partner-cont clearfix <?php echo (++$count%2 ? "odd" : "even") ?> <?php echo 'partner-item-' . ($key+ 1); ?> <?php echo ++$key > 3 ? 'excess-default-no' : ''; ?>">
                        <div class="row">
                           <div class="col-xs-12 col-sm-3 <?php echo ($count%2 ? "col-odd" : "col-even") ?> hidden-xs">
                              <div class="img-cont">
                                 <img data-src="<?php print isset($list['coverImageUrl']) ? $list['coverImageUrl'] : ''; ?>" class="img-responsive">
                              </div>
                           </div>
                           
                           <div class="col-xs-12 col-sm-9">
                              <div class="partner-det clearfix">
                                 <div class="img-cont hidden-sm hidden-md hidden-lg">
                                    <img data-src="<?php echo isset($list['coverImageUrl']) ? $list['coverImageUrl'] : ''; ?>" class="img-responsive">
                                 </div>
                                 <h2><?php print isset($list['title']) ? $list['title'] : ''; ?></h2>
                                 <?php print isset($list['content']) ? $list['content'] : ''; ?>
                              </div>
                           </div>
                        </div>
                     </div> <!-- end of partner-cont odd-->
                  <?php } ?>
                  
               <?php } ?>
            <?php endif; ?>
         </div> <!-- end of partner-cont wrp-->

         <div class="partner-cont clearfix btn-sh-mr-prtnr-wrp hidden-sm hidden-md hidden-lg <?php echo (count($partnerList) > 3 ? 'partner-render-show-more' : 'partner-hide-show-more'); ?>">
            <a href="#" title="Show more" id="btn-sh-mr-prtnr" class="pull-right"><?php print t('Show more...');?></a>
         </div>

         </div>
      </div> <!-- end of list section -->
   </div>
</div>
