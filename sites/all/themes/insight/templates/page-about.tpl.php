<?php
global $base_url;
$scripts_path = $base_url.'/'.drupal_get_path('theme', 'insight').'/dist/scripts/';
$images_path = $base_url .'/'. drupal_get_path('theme', 'insight') . '/dist/images/';
?>

<div id="ins-mn-bdy-cntr" class="about-page common">
   <div id="" class="common head-fix">
   <div class="banner-center-text" data-src="<?php print isset($bannerImageUrl) ? $bannerImageUrl : ''; ?>">
   
      <div class="banner-content">
         <p id="mob-banner-text"><?php print isset($bannerSlogan) ? $bannerSlogan : ''; ?></p>
      </div>
   </div>

   <?php
         $params = array(
         'activePage' => 'about',
         'baseUrl' => $base_url,
         );
         $block = module_invoke('custompage', 'block_view', 'discover-secondary-menu', $params);
         print $block ? render($block['content']) : '';
   ?>
   </div>

   <div class="about-section">
      <div class="container">
         <div class="row">
            <div class="col-xs-12 col-sm-7">
               <div class="cont-sec" id="intro-sec">
                  <div class="cont-head">
                     <h1 class="au-h1-tle"><?php print isset($sectionTitle) ? $sectionTitle : '';?></h1>
                  </div>
                  <div class="cont-body">
                     <?php if (isset($sectionContent)) { ?>
                     <div class="desc" id="about-insight-desc"<?php echo strlen($sectionContent) > 100 ? ' data-rm-f="1"' : '';?>><?php print $sectionContent; ?></div>
                     <?php } ?>
                  </div>
               </div>
            </div>

            <div class="col-xs-12 col-sm-5" id="vid-container">
               <div class="vid-body">                  
                  <?php if (isset($featureVideoClip) && $featureVideoClip != '') { ?>
                     <div class="vid-content vid-cvr vid-cvr-bg">
                        <img class="img img-responsive center-block" src="<?php print isset($featureImageUrl) ? $featureImageUrl : ''; ?>" alt="<?php print isset($featureVideoClipImgAlt) ? $featureVideoClipImgAlt : ''; ?>" title="<?php print isset($featureVideoClipImgTitle) ? $featureVideoClipImgTitle : ''; ?>">
                        
                        <div class="vid-ply-btn">
                           <img class="img img-responsive center-block" src="<?php print $images_path; ?>ply-btn.png" alt="Play Video" title="Play Video">
                        </div>
                     </div>
                     
                     <div class="frm-cvr">
                        <iframe id="vid-frame" class="vid-content" style="display:none;" src="<?php echo generateYTEmbedUrl($featureVideoClip); ?>" frameborder="0" allowfullscreen></iframe>
                     </div>
                  <?php } else { ?>
                     <div class="vid-content vid-cvr img-content">
                        <img class="img img-responsive center-block" data-src="<?php print isset($featureImageUrl) ? $featureImageUrl : ''; ?>" alt="<?php print isset($featureImageAlt) ? $featureImageAlt : ''; ?>" title="<?php print isset($featureImageTitle) ? $featureImageTitle : ''; ?>">
                     </div>
                  <?php } ?>
               </div>
            </div>
         </div>
         <div class="brk"></div>
         <div class="row">
            <div class="col-xs-12 col-sm-8">
               <div class="cont-sec" id="our-space">
                  <div class="cont-head">
                        <h2 class="au-h2-tle"><?php echo isset($placeSectionTitle) ? $placeSectionTitle : '';?></h2>
                  </div>
                  <div class="cont-body">
                        <?php echo isset($placeSectionContent) ? $placeSectionContent : '';?>
                  </div>
               </div>
            </div>
         </div>
      </div>

      <div class="container-fluid">
         <div class="row">
            <div class="col-xs-12">
               <div class="slider-container">
                  <div class="slider-section about-us-slider">
                     <?php if (isset($placeImages)) {
                     foreach ($placeImages as $img): ?>
                     <div>
                        <img class="sldr-img-wrpr" data-lazy="<?php print isset($img['imageUrl']) ? $img['imageUrl'] : ''; ?>"/>
                        <p class="slide-desc"><?php print $img['caption']; ?></p>
                     </div>
                     <?php endforeach; 
                     } ?>
                  </div>
               </div>
            </div>
         </div>
      </div>
	</div>
 </div>