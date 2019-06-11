<?php
global $base_url;
$images_path = $base_url.'/'.drupal_get_path('theme', 'insight').'/dist/images/';
$footerMenuCtr = $footerSubMenuCtr = 0;
$footerMenuList = menu_tree_all_data('menu-footer-menu');
$footerMenuCount = count($footerMenuList);
?>

<footer id="ins-ftr-cntr">
   <div class="footer-container container">
      <div class="footer-overlay-wrapper">
         <div class="row footer-row">
            <div class="footer-col col-xs-12 col-sm-3 col-md-3 wht-border-right">
               <a href="<?php print $base_url; ?>/home" class="footer-ins-link"><img src="<?php print $images_path; ?>insight_logo_grey_s.png" class="" title="Title"></a>

               <div class="footer-details">
                  <p class="footer-email"><?php echo t('info@insightschoolhk.com');?></p>
                  <p class="footer-contact"><?php echo t('+852 2114 2021');?></p>
               </div>

               <div class="footer-btn">
                  <ul class="list-unstyled clearfix ins-ftr-inf-list">
                     <li class="pull-left">
                        <a href="<?php print url('contact') . '#email-us'; ?>" title="Request Information" class="text-uppercase ins-ftr-inf-item first">
                           <?php print t('Request Information'); ?>
                        </a>
                     </li>
                     <li class="pull-left">
                        <a href="#" title="Request Information" class="text-uppercase ins-ftr-inf-item sign-up-modal">
                           <?php print t('Sign up for our Newsletter'); ?>
                        </a>
                     </li>
                  </ul>

               </div>
            </div>

            <div class="col-xs-12 col-sm-9 col-md-9">
            
               <?php foreach ($footerMenuList as $menu): ?>
                  <?php 
                     $menuId = null;
                     $isParentActive = (isset($menu['below']) && !empty($menu['below']) ? isParentMenuActive($menu['below']) : false);
                     $parentState = ($isParentActive ? 'active' : '');
                     
                     if ($footerMenuCtr == 0):
                        $menuId = 'learn-menu-lists';
                     elseif ($footerMenuCtr == 1):
                        $menuId = 'explore-menu-lists';
                     elseif ($footerMenuCtr == 2):
                        $menuId = 'experience-menu-lists';
                     elseif ($footerMenuCtr == 3):
                        $menuId = 'connect-menu-lists';
                     endif;
                     
                  ?>
                  <?php if (!$menu['link']['hidden']): ?>
                  <div class="col-xs-12 col-sm-3 col-md-3 ins-footer-nav-item list-unstyled <?php ($footerMenuCtr == 0 ? 'first' : ''); ?>">
                     
                        <a href="#<?php print $menuId; ?>" class="visible-xs <?php print $parentState ; ?>" title="Learn" data-toggle="collapse" role="button" aria-controls="learn-menu-list" aria-expanded="false">
                           <div class="footer-dropdown">
                              <strong class="text-uppercase"><?php print $menu['link']['link_title']; ?></strong><span class="visible-xs glyphicon glyphicon-menu-down pull-right"></span>
                           </div>
                        </a>  
                        <div class="footer-dropdown hidden-xs <?php print $parentState; ?>">
                           <strong class="text-uppercase"><?php print $menu['link']['link_title']; ?></strong><span class="visible-xs glyphicon glyphicon-menu-down pull-right"></span>
                        </div>
                        
                        <?php if (isset($menu['below']) && !empty($menu['below'])): ?>
                           <?php $footerSubMenuCtr = 0; ?>
                           
                           <ul class="footer-dropdown-menu-list collapse list-unstyled" id="<?php print $menuId; ?>">
                              
                              <?php foreach ($menu['below'] as $subMenu): ?>
                                 <?php if (!$subMenu['link']['hidden']): ?>
                                 <li class="footer-dropdown-menu-list-itm <?php print ($footerSubMenuCtr == 0 ? 'first' : ''); ?> <?php print (isMenuActive($subMenu['link']) ? 'active' : ''); ?>">
                                    <a href="<?php print url($subMenu['link']['href']); ?>" title="<?php print $subMenu['link']['link_title']; ?>"><?php print $subMenu['link']['link_title']; ?></a>
                                 </li>
                              <?php endif; ?>
                                 
                                 <?php ++$footerSubMenuCtr; ?>
                              <?php endforeach; ?>
                              
                           </ul>
                        
                        <?php endif; ?>
                        
                        <?php if ($footerMenuCtr == ($footerMenuCount - 1)): ?>
                           <div class="col-xs-12 footer-social-container">
                                 
                              <ul class="list-unstyled clearfix ins-ftr-inf-list">
                                 <li class="footer-social-icons">
                                    <a href="https://www.facebook.com/insightinteriorschoolhk" id="" class="text-uppercase" title="Facebook" target="_blank">
                                       <img class="img img-responsive" src="<?php print $images_path; ?>mb-fb-icon.png"></img>
                                    </a> 
                                 </li>
                                 <li class="footer-social-icons">
                                    <a href="https://twitter.com/insightschoolhk" id="" class="text-uppercase" title="Twitter" target="_blank">
                                       <img class="img img-responsive" src="<?php print $images_path; ?>mb-twitter-icon-wht.png"></img>
                                    </a>          
                                 </li>

                                 <li class="footer-social-icons">
                                    <a href="http://instagram.com/insightschool" id="" class="text-uppercase" title="Instagram" target="_blank">
                                       <img class="img img-responsive" src="<?php print $images_path; ?>mb-instagram-icon-wht.png"></img>
                                    </a> 
                                 </li>

                                 <li class="footer-social-icons">
                                    <a href="https://www.youtube.com/channel/UC2dkOE1IvcbcS5koLgiwHPw" id="" class="text-uppercase" title="Youtube" target="_blank">
                                       <img class="img img-responsive" src="<?php print $images_path; ?>mb-youtube-icon-wht.png"></img>
                                    </a>   
                                 </li>

                                 <li class="footer-social-icons">
                                    <a href="http://www.pinterest.com/insightschoolhk" id="" class="text-uppercase" title="Pinterest" target="_blank">
                                       <img class="img img-responsive" src="<?php print $images_path; ?>mb-pinterest-icon-wht.png"></img>
                                    </a>    
                                 </li>

                                 <li class="footer-social-icons">
                                    <a href="https://hk.linkedin.com/company/insight-school-of-interior-design" id="" class="text-uppercase" title="LinkedIn" target="_blank">
                                       <img class="img img-responsive" src="<?php print $images_path; ?>mb-linkedin-icon-wht.png"></img>
                                    </a>      
                                 </li>

                              </ul>
                           </div>  
                           
                        <?php endif; ?> 
                  </div>
                  <?php endif; ?> 

                  <?php ++$footerMenuCtr; ?>
               <?php endforeach; ?>

            </div>    
         </div>
      </div>    
   </div>  
</footer>
<div id="mdl-wrap"></div>
