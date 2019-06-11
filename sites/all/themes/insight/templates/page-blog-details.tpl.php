<?php
global $base_url;
$images_path = $base_url .'/'. drupal_get_path('theme', 'insight') . '/dist/images/';
?>

<?php if (isset($site_slogan) && !empty($site_slogan)): ?>
<p class="lead"><?php print $site_slogan; ?></p>
<?php endif; ?>

<?php print isset($page['header']) ? render($page['header']) : ''; ?>


<?php if (isset($page['sidebar_first']) && !empty($page['sidebar_first'])): ?>
<aside class="col-sm-3" role="complementary">
  <?php print isset($page['sidebar_first']) ?  render($page['sidebar_first']) : ''; ?>
</aside>  <!-- /#sidebar-first -->
<?php endif; ?>


<?php if (isset($page['highlighted']) && !empty($page['highlighted'])): ?>
  <div class="highlighted jumbotron"><?php print render($page['highlighted']); ?></div>
<?php endif; ?>
<?php //if (isset($breadcrumb) && !empty($breadcrumb)): print $breadcrumb; endif;?>
<a id="main-content"></a>
<?php print isset($title_prefix) ? render($title_prefix) : ''; ?>

<?php print isset($title_suffix) ? render($title_suffix) : ''; ?>
<?php print (isset($messages) && !is_array($messages) ? $messages : ''); ?>
<?php if (isset($tabs) && !empty($tabs)): ?>
  <?php print isset($tabs) ? render($tabs) : ''; ?>
<?php endif; ?>
<?php if (isset($page['help']) && !empty($page['help'])): ?>
  <?php print render($page['help']); ?>
<?php endif; ?>
<?php if (isset($action_links) && !empty($action_links)): ?>
  <ul class="action-links"><?php print render($action_links); ?></ul>
<?php endif; ?>

<?php render($page['content']['metatags']); ?>

<div id="ins-mn-bdy-cntr">
   <div id="" class="common">
   <div class="banner-center-text" style="background-image: url(<?php print isset($bannerImageUrl) ? $bannerImageUrl : ''; ?>)">
      <div class="banner-content">
         <p id="mob-banner-text"><?php print isset($bannerSlogan) ? $bannerSlogan : ''; ?></p>
      </div>
   </div>
   <?php
    $params = array(
    'activePage' => 'blog'
    );
    $block = module_invoke('custompage', 'block_view', 'discover-secondary-menu', $params);
    print isset($block['content']) ? render($block['content']) : '';
  ?>

      <div class="blog-detail-section">
         <div class="section-title visible-xs container">
            <h2><?php echo t('Our blog');?></h2>
         </div>
         <div class="container image-holder-cont">
         <div class="row">
            <div class="col-xs-12 image-holder">
               <div class="blg-mn-img" data-src="<?php print isset($coverImageUrl) ? $coverImageUrl : ''; ?>"></div>
            </div>
            <div class="col-xs-12 col-sm-7">
               <div class="cont-sec" id="intro-sec">
                  <div class="cont-head">
                     <h1><?php print isset($title) ? $title : ''; ?></h1>
                  </div>
               </div>
            </div>
         </div>
         </div>   
            
            <?php $ctr = 0; ?>

            <?php if (isset($contents) && count($contents) > 0 && isset($imagesPlacement) && isset($images) && count($images) > 0 && isset($quotePlacement)) : ?>

            <?php foreach ($contents as $item) { ?>
               
               <?php // Image slider ?>

               <div class="container-fluid">
                  <div class="row">
                  <?php if ($imagesPlacement == $ctr): ?>
                     <div class="col-xs-12">
                        <div class="slider-container">
                           <div class="slider-section" id="ins-blog-det-sld">
                              <?php foreach ($images as $img): ?>
                              <div>
                                 <img class="sldr-img-wrpr" data-lazy="<?php print isset($img['imageUrl']) ? $img['imageUrl'] : ''; ?>"> 
                                 <p class="slide-desc"><?php print isset($img['caption']) ? $img['caption'] : ''; ?></p>
                              </div>
                              <?php endforeach; ?>
                           </div>
                        </div>
                     </div>
                  <?php endif; ?>
                  </div>
               </div>
               
               <?php // Quote ?>

               
               <?php if ($quotePlacement == $ctr): ?>
               <div class="container">
               <div class="row">
                  <div class="col-xs-12 blog-quote-container toBeToggled">
                     <div class="blog-quote">
                        <div class="quotes-holder">
                           <div class="left-quote-holder">
                              <img class="img img-responsive" src="<?php print $images_path; ?>quote-left.png" alt="quote image"/>
                           </div>
                           <div class="quote-text"><?php print isset($quote) ? $quote : ''; ?></div>
                           <div class="right-quote-holder">
                              <img class="img img-responsive" src="<?php print $images_path; ?>quote-right.png" alt="quote image"/> 
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               </div>
               <?php endif; ?>
            
               <?php // Blog content ?>
               <div class="container">
               <div class="row">
               <div class="col-xs-12 blog-detail-detail<?php print ($ctr == 0) ? ' mobile-main-detail' : ' toBeToggled'; ?>"<?php echo isset($item['content']) && strlen($item['content']) > 100 ? ' data-rm-f="1"' : '';?>>
                  <?php 
                     if (isset($item['title']) && ($item['title'] != '')){
                        print '<h2>' . $item['title'] . '</h1>';
                     }
                  ?>
                  <span class="blog-detail-date hidden-sm hidden-md hidden-lg"><?php print isset($postedDate) && ($ctr == 0) ? 'Posted ' . $postedDate : ''; ?></span>
                  <div class="full-detail blg-dtl-desc"><?php print isset($item['content']) ? $item['content'] : ''; ?></div>
               </div>
               </div>
               </div>
               <?php $ctr++; ?>
            <?php } ?>

            <?php endif;?>

            <?php // date content ?>
            <div class="container dt-cnter hidden-xs">
               <div class="row">
                  <div class="col-xs-12">
                     <h2><strong>Posted <?php print isset($postedDate) ? $postedDate : ''; ?></strong></h2>
                  </div>
               </div>
            </div>
            
            <div class="container">
            <div class="row">
            <div class="col-xs-12 blog-navigation visible-xs">
               <div class="row">
                  <div class="col-xs-6">
                     <?php
                        if (isset($previousBlogNid ) && $previousBlogNid > 0) {
                           print l(t('Previous post'), drupal_get_path_alias("node/{$previousBlogNid}"), [
                              'title' => 'Previous post',
                              'query' => drupal_get_query_parameters(),
                           ]);
                        }                       
                     ?>
                  </div>
                  <div class="col-xs-6">
                     <?php 
                        if (isset($nextBlogNid) && $nextBlogNid > 0) {
                           print l(t('Next post'), drupal_get_path_alias("node/{$nextBlogNid}") , [
                              'title' => 'Next post',
                              'query' => drupal_get_query_parameters(),
                           ]);
                        }                       
                     ?>
                  </div>
               </div>
            </div>
            </div>
            </div>

            <div class="container">
            <div class="row">
            <div class="col-xs-12 blog-share ">
               <div class="inner-div grey-container-wrapper">
                  <div class="share-text" id="bg-share-text"><?php print t('SHARE THIS POST');?></div>
                  <ul id="bl-sm-lst" class="share-icons-list list-unstyled list-inline">
                     <li class="share-icons">
                        <a href="" id="" class="text-uppercase" title="Collaborate">
                           <img class="img img-responsive" id="bl-fb-sm-img" src="<?php print $images_path; ?>mb-facebook-icon.png"></img>
                        </a> 
                     </li>
                     <li class="share-icons">
                        <a href="" id="" class="text-uppercase" title="Collaborate">
                           <img class="img img-responsive" src="<?php print $images_path; ?>mb-twitter-icon.png"></img>
                        </a>          
                     </li>

                     <li class="share-icons">
                        <a href="" id="" class="text-uppercase" title="Collaborate">
                           <img class="img img-responsive" src="<?php print $images_path; ?>mb-instagram-icon.png"></img>
                        </a> 
                     </li>

                     <li class="share-icons">
                        <a href="" id="" class="text-uppercase" title="Collaborate">
                           <img class="img img-responsive" src="<?php print $images_path; ?>mb-linkedin-icon.png"></img>
                        </a>      
                     </li>

                     <li class="share-icons">
                        <a href="" id="" class="text-uppercase" title="Collaborate">
                           <img class="img img-responsive" src="<?php print $images_path; ?>email-icon.png"></img>
                        </a>    
                     </li>
                  </ul>
               </div>
               
            </div>
            </div>
            </div>

            <div class="container">
            <div class="row">
            <div class="col-xs-12 blog-navigation hidden-xs">
               <div class="row">
                  <div class="col-xs-6">
                     <?php 
                        if (isset($previousBlogNid) && $previousBlogNid > 0) {
                           print l(t('Previous post'), drupal_get_path_alias("node/{$previousBlogNid}"), [
                              'title' => 'Previous post',
                              'query' => drupal_get_query_parameters(),
                           ]);
                        }                       
                     ?>
                  </div>
                  <div class="col-xs-6">
                     <?php 
                        if (isset($nextBlogNid) && $nextBlogNid > 0) {
                           print l(t('Next post'), drupal_get_path_alias("node/{$nextBlogNid}"), [
                              'title' => 'Next post',
                              'query' => drupal_get_query_parameters(),
                           ]);
                        }                       
                     ?>
                  </div>
               </div>
            </div>
            </div>
            
         </div>
      </div>
   </div>
   
</div>

<?php if (isset($page['sidebar_second']) && !empty($page['sidebar_second'])): ?>
<aside class="col-sm-3" role="complementary">
  <?php print render($page['sidebar_second']); ?>
</aside>  <!-- /#sidebar-second -->
<?php endif; ?>


<?php if (isset($page['footer']) && !empty($page['footer'])): ?>

    <?php print render($page['footer']); ?>

<?php endif; ?>