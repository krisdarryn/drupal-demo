<?php
global $base_url;
$images_path = $base_url.'/'.drupal_get_path('theme', 'insight').'/dist/images/';
$mainMenuCtr = $mainSubMenuCtr = 0;
$mainMenuList = menu_tree_all_data('main-menu');
$mobileMenuList = menu_tree_all_data('menu-mobile-menu');
?>

<header id="ins-header-landing">
   <div class="mn-hdr-bg">
      <div class="main-nav">
         <div class="navbar header-navbar">
            <!-- OVERLAY -->
            <div id="mb-nav-ovly-wrp" style="display: none;">
               <div id="mb-nav-ovly"></div>
            </div>
            <!-- END OF OVERLAY -->       
            <div class="ins-pg-container-limit container">
               <div style="display: table; width: 100%;">
                  <div style="display: table-row;">
                     <a href="<?php print $base_url; ?>/home" class="hd-ins-link" style="display: table-cell;">
                        <img src="<?php print $images_path; ?>logo.png" class="img-responsive">
                        <div id="hd-ins-tag">SCHOOL OF INTERIOR DESIGN HONG KONG</div>
                     </a>                                                   
                     <div class="landing-menu-wrapper hidden-sm hidden-md hidden-lg" style="display: table-cell;vertical-align: middle;">

                        <button id="landing-menu-button" type="button" class="navbar-toggle" data-toggle="offcanvas" data-target=".navmenu">
                           <span class="icon-bar"></span>
                           <span class="icon-bar"></span>
                           <span class="icon-bar"></span>
                        </button>
            
                        <div class="menu-lbl"><?php echo t('MENU');?></div>
                     </div>
                     <nav id="mb-nav-menu" data-autohide="false" class="navmenu navmenu-default navmenu-fixed-right offcanvas" role="navigation" style>
                           
                        <div class="mb-nav-wrp">
                           <div id="ins-mb-nav-wrp">
                              <ul class="nav navmenu-nav mob-ins-navmenu">

                                 <div class="close-nav">
                                    <button type="button" class="" data-toggle="offcanvas" data-target="#mb-nav-menu" id="btn-close-nav" title="Close">
                                       <img src="<?php print $images_path; ?>ic-close-48px 2.png" alt="Close Icon">
                                       <span class="close-nav-lbl"><?php echo t('CLOSE NAVIGATION');?></span>
                                    </button>
                                 </div>

                                 <?php if (isset($mobileMenuList) && !empty($mobileMenuList)): ?>
                                    
                                    <?php foreach ($mobileMenuList as $menu): ?>
                                       <?php 
                                          $menuId = '';
                                          $isParentActive = (isset($menu['below']) && !empty($menu['below']) ? isParentMenuActive($menu['below']) : false);
                                          $parentState = ($isParentActive ? 'active' : '');
                                          
                                          if (($menu['link']['href'] != '') && ($menu['link']['href'] != '<front>') && !$menu['link']['has_children']) {
                                             $parentState = (isMenuActive($menu['link']) ? 'active' : '');
                                          }
                                    
                                          if ($mainMenuCtr == 0):
                                             $menuId = 'explore-our-courses-menu-list';
                                          elseif ($mainMenuCtr == 2):
                                             $menuId = 'discover-menu-list';
                                          elseif ($mainMenuCtr == 3):
                                             $menuId = 'collaborate-menu-list';
                                          endif;
                                       ?>
                                       <?php if (!$menu['link']['hidden']): ?>
                                          <li class="ins-mb-nav-itm mn-itm <?php print $parentState; ?>">
                                                                                          
                                             <?php if (isset($menu['below']) && !empty($menu['below'])): ?>
                                                <?php $mainSubMenuCtr = 0; ?>
                                                
                                                <a href="#<?php print $menuId; ?>" class="mn-itm-a" title="<?php print $menu['link']['link_title']; ?>" data-toggle="collapse" role="button" aria-controls="<?php print $menuId; ?>" aria-expanded="false">
                                                   <?php print $menu['link']['link_title']; ?> <i class="fa fa-chevron-down" aria-hidden="<?php print ($parentState == 'active' ? 'true' : 'false'); ?>"></i>
                                                </a>
                                             
                                                <ul class="collapse list-unstyled <?php print ($parentState == 'active' ? 'in' : ''); ?>" id="<?php print $menuId; ?>">
                                                   
                                                   <?php foreach ($menu['below'] as $subMenu): ?>
                                                      <?php if (!$subMenu['link']['hidden']): ?>
                                                         <li class="ins-mb-nav-itm sub-itm <?php print ($mainSubMenuCtr == 0 ? 'first' : ''); ?> <?php print (isMenuActive($subMenu['link']) ? 'active' : ''); ?>">
                                                            <a href="<?php print url($subMenu['link']['href']); ?>" title="<?php print $subMenu['link']['link_title']; ?>"><?php print $subMenu['link']['link_title']; ?></a>
                                                         </li>    
                                                         
                                                         <?php ++$mainSubMenuCtr; ?>
                                                      <?php endif; ?>
                                                   <?php endforeach; ?>
                                                   
                                                </ul>
                                                
                                             <?php else: ?>
                                                <a href="<?php print url($menu['link']['href']); ?>"  class="mn-itm-a" title="<?php print $menu['link']['link_title']; ?>">
                                                   <?php print $menu['link']['link_title']; ?>
                                                </a>
                                             <?php endif; ?>
                                             
                                          </li>
                                       <?php endif; ?>
                                       <?php ++$mainMenuCtr; ?>
                                    <?php endforeach;?>
                                 
                                 <?php endif; ?>

                              </ul>
                           </div>
   
                        </div>
                     </nav>
                     <div class="landing-menu-wrapper hidden-xs" style="display: table-cell;vertical-align: top; ">
                        
                        <?php if (isset($mainMenuList) && !empty($mainMenuList)): ?>
                           <ul class="nav navbar-nav navbar-right visible-sm visible-md visible-lg" id="main-nav-list">
                              <?php $mainMenuCtr = 0; ?>
                              <?php $dotCtr = 0; ?>
                              <?php foreach ($mainMenuList as $menu): ?>
                                 <?php 
                                    $menuId = null;
                                    $isParentActive = (isset($menu['below']) && !empty($menu['below']) ? isParentMenuActive($menu['below']) : false);
                                    $parentState = ($isParentActive ? 'active' : '');
                                    
                                    if (($menu['link']['href'] != '') && ($menu['link']['href'] != '<front>') && !$menu['link']['has_children']) {
                                       $parentState = (isMenuActive($menu['link']) ? 'active' : '');
                                    }
                                    
                                    if ($mainMenuCtr == 0):
                                       $menuId = 'discover-menu-list-main';
                                    elseif ($mainMenuCtr == 1):
                                       $menuId = 'collaborate-menu-list-main';
                                    endif; 
                                 ?>
                                 <?php if (!$menu['link']['hidden']): ?>
                                 <li class="main-nav-item firstmn-itm <?php print ($dotCtr == 0 ? 'first' : ''); ?> <?php print $parentState; ?>">
                                    
                                       <?php if (isset($menu['below']) && !empty($menu['below'])): ?>
                                          <a href="#<?php print $menuId; ?>" class="text-uppercase mn-itm-a" title="<?php print $menu['link']['link_title']; ?>" data-toggle="collapse" role="button" aria-controls="<?php print $menuId; ?>" aria-expanded="false">
                                             <?php print $menu['link']['link_title']; ?>
                                          </a>
                                          
                                          <?php $mainSubMenuCtr = 0; ?>
                                          
                                          <ul class="collapse list-unstyled main-nav-list-style" id="<?php print $menuId; ?>" style="position: fixed;">
                                             
                                             <?php foreach ($menu['below'] as $subMenu): ?>
                                                <?php if (!$subMenu['link']['hidden']): ?>
                                                   <li class="main-nav-item-list sub-itm <?php print ($mainSubMenuCtr == 0 ? 'first' : ''); ?> <?php print (isMenuActive($subMenu['link']) ? 'active' : ''); ?>">
                                                      <a href="<?php print url($subMenu['link']['href']); ?>" title="<?php print $subMenu['link']['link_title']; ?>"><?php echo $subMenu['link']['link_title'];?></a>                  
                                                   </li>
                                                <?php endif; ?>
                                                <?php ++$mainSubMenuCtr; ?>
                                             <?php endforeach; ?>
                                          
                                          </ul>
                                       
                                       <?php elseif (strpos($menu['link']['href'], 'http') !== false): ?>
                                          <a href="<?php print url($menu['link']['href']); ?>" id="" target="_blank" class="text-uppercase mn-itm-a" title="<?php print $menu['link']['link_title']; ?>"><?php print $menu['link']['link_title']; ?></a>
                                       <?php else: ?>
                                          <a href="<?php print url($menu['link']['href']); ?>" id="" class="text-uppercase mn-itm-a" title="<?php print $menu['link']['link_title']; ?>"><?php print $menu['link']['link_title']; ?></a>
                                       <?php endif; ?>
                                    <?php $dotCtr++; ?>
                                 </li>
                                 <?php endif; ?>
                                 <?php ++$mainMenuCtr; ?>
                              <?php endforeach; ?>
                              
                           </ul>
                        <?php endif; ?>


                     </div>
                  </div> <!-- end of table row -->
               </div> <!-- end of table-->
            </div>
         </div>
      </div>
   </div>

   <div class="landing-page-banner-container">
      <?php if (isset($bannerLinkHref) && $bannerLinkHref != ''): ?>
         <div class="landing-page-banner lp-with-banner-link hidden-xs">
            <a href="<?php print $bannerLinkHref; ?>" target="<?php print isset($bannerLinkTarget) ? $bannerLinkTarget : ''; ?>" title="">
               <img class="img img-responsive" data-src="<?php print isset($desktopBannerImageUrl) ? $desktopBannerImageUrl : ''; ?>" alt="<?php isset($desktopBannerImageAlt) ? $desktopBannerImageAlt : ''; ?>" title="<?php print isset($desktopBannerImageTitle) ? $desktopBannerImageTitle : ''; ?>"/>
               <h1 class="landing-main-text"><?php print isset($desktopBannerImageTitle) ? $desktopBannerImageTitle : ''; ?></h1>
            </a>
         </div>
         
         <div class="landing-page-banner lp-with-banner-link hidden-sm hidden-md hidden-lg">
            <a href="<?php print $bannerLinkHref; ?>" target="<?php print isset($bannerLinkTarget) ? $bannerLinkTarget : ''; ?>" title="">
               <img class="img img-responsive" data-src="<?php print isset($mobileBannerImageUrl) ? $mobileBannerImageUrl : ''; ?>" alt="<?php print isset($mobileBannerImageAlt) ? $mobileBannerImageAlt : ''; ?>" title="<?php print isset($mobileBannerImageTitle) ? $mobileBannerImageTitle : ''; ?>"/>
               <h1 class="landing-main-text"><?php print isset($mobileBannerImageTitle) ? $mobileBannerImageTitle : ''; ?></h1>
            </a>
         </div>
      <?php else: ?>
         <div class="landing-page-banner hidden-xs">
            <img class="img img-responsive" data-src="<?php print isset($desktopBannerImageUrl) ? $desktopBannerImageUrl : ''; ?>" alt="<?php print isset($desktopBannerImageAlt) ? $desktopBannerImageAlt : ''; ?>" title="<?php print isset($desktopBannerImageTitle) ? $desktopBannerImageTitle : ''; ?>"/>
            <h1 class="landing-main-text"><?php print isset($desktopBannerImageTitle) ? $desktopBannerImageTitle : ''; ?></h1>
         </div>
         
         <div class="landing-page-banner hidden-sm hidden-md hidden-lg">
            <img class="img img-responsive" data-src="<?php print isset($mobileBannerImageUrl) ? $mobileBannerImageUrl : ''; ?>" alt="<?php print isset($mobileBannerImageAlt) ? $mobileBannerImageAlt : ''; ?>" title="<?php print isset($mobileBannerImageTitle) ? $mobileBannerImageTitle : ''; ?>"/>
            <h1 class="landing-main-text"><?php print isset($mobileBannerImageTitle) ? $mobileBannerImageTitle : ''; ?></h1>
         </div>
      <?php endif; ?>
   </div>

   <div class="landing-menu-options">
      <div class="row">
         <div class="col-xs-6 landing-menu-options-wrapper left">
            <a href="<?php print $base_url; ?>/course" title="Explore our courses">
               <div class="landing-menu-options-inside left">
                  <?php print isset($courseBtnCaption) ? $courseBtnCaption : ''; ?>
               </div>
            </a>
         </div>
         
         <div class="col-xs-6 landing-menu-options-wrapper right">      
            <a href="<?php print $base_url; ?>/contact" title="Get in touch">
               <div class="landing-menu-options-inside right">
                  <?php print isset($contactBtnCaption) ? $contactBtnCaption : ''; ?>
               </div> 
            </a>      
         </div>       
      </div>
   </div>

</header>