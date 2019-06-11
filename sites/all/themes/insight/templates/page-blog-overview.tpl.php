<?php
global $base_url;
?>

<div id="ins-mn-bdy-cntr">
   <div id="" class="common head-fix">
      <div class="banner-center-text" data-src="<?php print isset($bannerImageUrl) ? $bannerImageUrl : ''; ?>">
      
         <div class="banner-content">
            <p id="mob-banner-text"><?php print isset($bannerSlogan) ? $bannerSlogan : ''; ?></p>
         </div>
      </div>

      <?php
        $params = array(
        'activePage' => 'blog',
        'baseUrl' => $base_url,
        );
        $block = module_invoke('custompage', 'block_view', 'discover-secondary-menu', $params);
        print isset($block['content']) ? render($block['content']) : '';
        ?>
   </div>
      <div class="blog-section container">
         <div class="intro-panl">
            <div class="row">
               <div class="col-xs-12 col-sm-8">
                  <div class="cont-sec" id="intro-sec">
                     <div class="cont-head">
                        <?php
                           $introSectionTitle = isset($introSectionTitle) ? $introSectionTitle : '';
                           $introSectionTitle .= (isset($_GET['article']) ? ' - ' . $_GET['article'] : '');
                        ?>
                        <h1 class="au-h1-tle"><?php print $introSectionTitle; ?></h1>
                     </div>
                  </div>
               </div>
            </div>
         </div> 
         
         <div class="row zero-margin">
            <div class="blog-inside col-xs-12 col-sm-9"> 
               <?php
               $ctr = 1;
               $hasNewsletterDisplayed = FALSE;
               ?>
               <?php if (isset($blogItems) && count($blogItems) > 0) : ?>
                  <?php $defaultCharLimit = 244; // default char limit: 78 (blog title) + 166 (blog content) ?>
                  
                  <?php foreach ($blogItems as $blog): ?>
                     <?php $isEven = (fmod($ctr, 2) == 0) ? TRUE : FALSE; ?>
                     
                     <?php // Newsletter link section ?>
                     <?php if (!$hasNewsletterDisplayed && $ctr > 2): ?>
                        <div class="blog-newsletter-section negative-margin">
                           <div class="blog-newsletter-container">
                              <div class="blog-newsletter-row row zero-margin">
                                 <div class="left-row col-xs-6 clearfix">                           
                                    <div class="outer">
                                       <div class="middle">
                                          <div class="inner">
                                          <p class="visible-xs">
                                             <?php print t('Sign up for our newsletter and receive these quality articles directly in your mailbox');?>
                                             </p>
                                             <div class="left-row-text hidden-xs">
                                                <p><strong><i><?php print t('Stay informed.');?></i></strong></p>
                                                <p class="">
                                                   <?php print t('Sign up for our newsletter and receive these quality articles directly in your mailbox');?>
                                                </p>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>

                                 <div class="right-row col-xs-6">
                                    <a href="#" id="" class="hidden-xs sign-up-modal">
                                       <div class=""><?php print t('Sign up');?> <br><strong><?php print t('for our newsletter');?></strong></div>
                                    </a>
                                    <a href="#" id="" class="hidden-sm hidden-md hidden-lg sign-up-modal">
                                       <div class=""><?php print t('Sign up for');?><br><strong><?php print t('our newsletter');?></strong></div>
                                    </a>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <?php $hasNewsletterDisplayed = TRUE; ?>
                     <?php endif; ?>
                     
                     <?php // Blog item ?>
                     <div class="row blog-inside-row<?php print ($isEven)? ' clearfix even' : ''; ?>">
                        <a title="<?php print isset($blog['title']) ? $blog['title'] : ''; ?>" href="<?php print drupal_get_path_alias("node/{$blog['nid']}") . $qVal; ?>">
                           <div class="col-xs-12 col-sm-8 blog-image-container<?php print ($isEven)? ' pull-right' : ''; ?>">
                              <div class="blog-image" data-src="<?php print isset($blog['coverImageUrl']) ? $blog['coverImageUrl'] : ''; ?>"></div>
                           </div>
                           
                           <div class="col-xs-12 col-sm-4 blog-content-container">
                              <div class="blog-content">
                                 <span class="blog-date hidden-xs">
                                    <?php echo t('Posted');?> <?php print isset($blog['postedDate']) ? $blog['postedDate'] : ''; ?>
                                 </span>
                                 <h3 class="blog-title"><?php print isset($blog['title']) ? $blog['title'] : ''; ?></h3>
                                 <span class="blog-date visible-xs">
                                    <?php echo t('Posted');?> <?php print isset($blog['postedDate']) ? $blog['postedDate'] : ''; ?>
                                 </span>
                                 <p class="blog-details">
                                    <?php
                                    if (isset($blog['introContent'])) {
                                       $titleLen = (isset($blog['title'])) ? strlen($blog['title']): 0;
                                       $contentLimit = $defaultCharLimit - $titleLen;
                                       $totalLen = $titleLen + strlen($blog['introContent']);
                                       $trimmedContent = ($totalLen > $defaultCharLimit) ? substr($blog['introContent'], 0 , $contentLimit).'...' : $blog['introContent'];
                                       print $trimmedContent;
                                    }
                                    ?>
                                 </p>
                              <div class="blog-continue"><strong>                 
                                 <?php print isset($linkBtnCaption) ? $linkBtnCaption : t('Continue reading');  ?></strong>    
                                 </div>
                              </div>
                           </div>
                        </a>
                     </div>
                     
                     <?php $ctr++; ?>
                  <?php endforeach; ?>
                <?php endif;?>
               
               <?php // Newsletter link section ?>
               <?php if (! $hasNewsletterDisplayed): ?>
                  <div class="blog-newsletter-section negative-margin">
                     <div class="blog-newsletter-container">
                        <div class="blog-newsletter-row row zero-margin">
                           <div class="left-row col-xs-6 clearfix">
                              <p class="visible-xs">
                                 <?php print t('Sign up for our newsletter and receive these quality articles directly in your mailboxSign up for our newsletter and receive these quality articles directly in your mailbox');?>
                              </p>
                              <div class="left-row-text hidden-xs">
                                 <p><strong><i><?php print t('Stay informed.');?></i></strong></p>
                                 <p class="">
                                    <?php print t('Sign up for our newsletter and receive these quality articles directly in your mailbox');?>
                                 </p>
                              </div>
                           </div>

                           <div class="right-row col-xs-6">
                              <a href="#" id="" class="hidden-xs sign-up-modal">
                                 <div class=""><?php print t('Sign up');?> <br><strong><?php print t('for our newsletter');?></strong></div>
                              </a>
                              <a href="#" id="" class="hidden-sm hidden-md hidden-lg sign-up-modal">
                                 <div class=""><?php print t('Sign up for');?><br><strong><?php print t('our newsletter');?></strong></div>
                              </a>
                           </div>
                        </div>
                     </div>
                  </div>
               <?php endif; ?>
            </div>
            
            <?php if (isset($relatedArticles) && count($relatedArticles) > 0 && $allBlogListSize > 0): ?>
               <div class="related-articles hidden-xs col-sm-3" data-sticky-container>
                  <div class="related-articles-container sticky" data-margin-top="205">
                     <p class="related-title"><?php echo t('Related articles');?></p>
                        <?php foreach ($relatedArticles as $item): ?>
                            <?php if (!$item || !isset($item['name']) || !isset($item['count'])) {
                                continue;
                            } ?>
                           <?php $urlParam = drupal_http_build_query(['article' => $item['name']]); ?>
                           <p><a href="blog?<?php print $urlParam;  ?>" title="<?php print $item['name']; ?>"><?php print $item['name'] . ' (' . $item['count'] . ')'; ?></a></p>
                        <?php endforeach; ?>
                  </div>  
               </div>
            <?php endif; ?>

         </div> <!-- end of row-->
        
        <div class="blog-section hidden-xs">
            <div class="blog-pagination clearfix">
               <?php
                  // Convert the space value of url parameter
                  // Ex. $blogCategory = "Industry trends", will return like article=Industry%20trends
                  $href = $base_url;
                  if (isset($blogCategory) && $blogCategory != '') {
                     $urlParam = drupal_http_build_query(['article' => $blogCategory]);
                     $href .= '/blog?' . $urlParam . '&';
                  } else {
                     $href .= '/blog?';
                  }
               ?>
            </div>
         </div>
      <div class="row">
         <div class="col-xs-12 col-sm-9 page-col">
            <div class="blog-pagination clearfix">
               <?php

                  if (isset($allBlogListSize) && $allBlogListSize > 0 && isset($page)) {
                     $params = array(
                        'allListSize' => $allBlogListSize,         
                        'activePage' => $page,
                        'limit' => 4, // number of blog items to display per page
                        'href' => $href,
                     );
                     
                     $block = module_invoke('custompage', 'block_view', 'pagination', $params);
                     print isset($block['content']) ? render($block['content']) : '';
                  }
               ?>
            </div>
         </div>
   </div>
</div>


<div id="mdl-wrap"></div>