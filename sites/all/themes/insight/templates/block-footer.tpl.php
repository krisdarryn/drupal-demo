<?php
global $base_url;
$images_path = $base_url.'/'.drupal_get_path('theme', 'insight').'/dist/images/';
?>

<footer id="ins-ftr-common" class="common">
   <div class="common-footer container">
      <div class="common-footer-logo visible-xs">
         <a href="<?php print $base_url; ?>/home" class="footer-ins-link"><img src="<?php print $images_path; ?>mob-logo.png" class="img-responsive"></a>
      </div>
      <div class="common-footer-links">
         <ul class="common-footer-ul list-unstyled">
            <li class="active">
               <a href="#" title="Courses"><?php echo t('COURSES');?></a>
            </li>
            <li>
               <a href="<?php print $base_url; ?>/about" title="About"><?php echo t('ABOUT');?></a>   
            </li>
            <li>
               <a href="#" title="Collaborate"><?php echo t('COLLABORATE');?></a>  
            </li>
            <li>
               <a href="<?php print $base_url; ?>/event" title="Event"><?php echo t('EVENTS');?></a>   
            </li>
            <li>
               <a href="<?php print $base_url; ?>/jobs" title="Jobs"><?php echo t('JOBS');?></a>  
            </li>
            <li>
               <a href="<?php print $base_url; ?>/contact" title="Contact"><?php echo t('CONTACT');?></a>   
            </li>
         </ul>

         <div class="common-footer-signup">
            <a href="#" id="sign-up-link" class="visible-xs">
               <div class ="footer-sign-newsletter sign-up-modal"><?php echo t('Sign up for our newsletter');?></div>
            </a> 

            <a href="#" id="sign-up-link" class="hidden-xs">
               <div class ="footer-sign-newsletter pull-right sign-up-modal"><?php echo t('Sign up');?> </br><strong><?php echo t('for our newsletter');?></strong></div>
            </a> 
         </div>
      </div>

      <div class="row common-footer-row hidden">
         <div class="col-xs-6 col-sm-1 col-md-1 common-footer-menu">
            <a href="#" title="Courses"><?php echo t('COURSES');?></a>
         </div>

         <div class="col-xs-6 col-sm-1 col-md-1 common-footer-menu">
            <a href="<?php print $base_url; ?>/about" title="About"><?php echo t('ABOUT');?></a>                  
         </div>

         <div class="col-xs-6 col-sm-1 col-md-1 common-footer-menu">
            <a href="#" title="Collaborate"><?php echo t('COLLABORATE'); ?></a>                  
         </div>
            
         <div class="col-xs-6 col-sm-1 col-md-1 common-footer-menu">
            <a href="<?php print $base_url; ?>/event" title="Event"><?php echo t('EVENTS');?></a>                  
         </div>

         <div class="col-xs-6 col-sm-1 col-md-1 common-footer-menu">
            <a href="<?php print $base_url; ?>/jobs" title="Jobs"><?php echo t('JOBS');?></a>                  
         </div>

         <div class="col-xs-6 col-sm-1 col-md-1 common-footer-menu">
            <a href="<?php print $base_url; ?>/contact" title="Contact"><?php echo t('CONTACT');?></a>                  
         </div>

         <div class="col-xs-12 sign-up-container visible-xs">
            <a href="#" id="sign-up-link" class=""><div class="footer-sign-newsletter sign-up-modal" data-toggle="modal" data-target="#newsletterModal"><?php echo t('Sign up for our newsletter');?></div></a> 
         </div>

         <div class="col-xs-12 col-md-3 col-md-push-4 sign-up-container hidden-xs hidden-sm">
            <a href="#" id="sign-up-link" class=""><div class="footer-sign-newsletter sign-up-modal pull-right" data-toggle="modal" data-target="#newsletterModal"><?php echo t('Sign up');?> </br><strong><?php echo t('for our newsletter');?></strong></div></a> 
         </div>
      </div>
      
   </div>
   <div id="mdl-wrap"></div>
</footer>

<script type="text/javascript">

   jQuery(document).ready(function (e) {
      onclickNewsLetter();
   });
   /*
   * Clicking Sign Up to 'show Newsletter modal'
   */

   function onclickNewsLetter() {
      $('.sign-up-modal').on('click', function(e) {
         e.preventDefault();
         $.ajax({
            type: 'GET',
            url: 'ajax/api/show-newsletter-form',
            dataType: 'html',
            success: function(html) {
               if (html != '') {
                  $('#mdl-wrap').html(html);
                  $('#newsletterModal').modal('show');
               }
            }
         });
      });
   }

</script>