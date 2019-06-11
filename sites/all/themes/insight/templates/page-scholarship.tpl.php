<?php global $base_url; ?>

<div id="ins-mn-bdy-cntr" class="scholarship-page">
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
               'activePage' => 'scholarship',
               'baseUrl' => $base_url,
            );
            $block = module_invoke('custompage', 'block_view', 'discover-secondary-menu', $params);
            print render($block['content']);
        ?>
   </div> <!-- end of container -->
      
   <div id="ins-ssp-wrap">
      <div class="ins-ssp-intro-section">
         <div class="container">
            <div class="intro-panl">
               <div class="row">
                  <?php if (isset($contents) && $contents): 
                     $first = true;
                  ?>
                     <?php foreach ($contents as $key => $item): ?>
                        <div class="col-xs-12 col-sm-8">
                           <div class="cont-sec <?php print ($first) ? 'addReadMore' : 'toBeToggled'?>">
                              <?php $first = false; ?>
                              <div class="cont-head">
                                 <?php if ($key == 0) { ?>
                                    <h1 class="au-h1-tle"><?php print $item['title']; ?></h1>
                                 <?php } else { ?>
                                    <h2 class="au-h1-tle"><?php print $item['title']; ?></h2>
                                 <?php } ?>
                              </div>
                              <div class="cont-body">
                                 <?php print $item['content']; ?>
                              </div>
                           </div>
                        </div>
                     <?php endforeach; ?>
                  <?php endif; ?>
               </div>
            </div> 
         </div>
      </div>
      <div class="container-fluid schlshp-gallery-wrap" id="schlshp-gallery-container">
         <div class="row">
            <div class="col-xs-12">
               <div class="slider-container">
               <div class="slider-section">
               <?php if (isset($galleries) && count($galleries) > 0) : ?>
                  <?php foreach ($galleries as $img): ?>
                  <div>
                     <img class="sldr-img-wrpr" data-lazy="<?php print isset($img['imageUrl']) ? $img['imageUrl'] : ''; ?>"/>
                     <p class="slide-desc"><?php print isset($img['caption']) ? $img['caption'] : ''; ?></p>
                  </div>
                  <?php endforeach; ?> 
               <?php endif; ?> 
               
               </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div> <!-- end of bdy cntr-->