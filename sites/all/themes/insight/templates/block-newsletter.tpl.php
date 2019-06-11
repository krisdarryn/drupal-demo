<?php
global $base_url;
$images_path = $base_url.'/'.drupal_get_path('theme', 'insight').'/dist/images/';
?>

<!-- Modal -->
<div class="modal fade" id="newsletterModal" tabindex="-1" role="dialog" aria-labelledby="newlsetterModalLabel">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content" id="newsLetterContent">
         <div class="modal-header hidden-sm hidden-md hidden-lg">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="newletterModalLabel"></h4>
         </div>
         <div class="modal-body" id="newsLetterBody">

            <div class="row">
               <div class="nl-m-banner col-xs-12 col-sm-6">
                  <div class="dummy hidden-xs">
                     <div class="dummy-inside hidden-xs">
                     </div>
                  </div>
                  <div class="nl-banner-cont" style="background-image: url(<?php print $images_path; ?>newsletter-modal-bg.png);">
                     <h1 class="nl-title nl-h1-tle">
                        <?php echo isset($introTitle) ? $introTitle : ''; ?>
                     </h1>
                     <p>
                        <?php echo isset($introDescription) ? $introDescription : ''; ?>
                     </p>
                  </div>
               </div>

               <div class="nl-m-form col-xs-12 col-sm-6">
                  <div class="form-holder clearfix">
                     <form action="<?php print url('ajax/api/newsletter-regsiter'); ?>" method="POST" id="newsletter-registration-form">
                        <div class="form-group ins-cs-frm-grp">
                           <label class="col-xs-12 text-uppercase ins-cs-gn-lb" for="nl-first-name"><?php echo t('First Name');?></label>
                           <div class="col-xs-12">
                              <input type="text" class="form-control ins-tf" id="nl-first-name" name="nl_first_name" />
                           </div>
                        </div>
                        <div class="form-group ins-cs-frm-grp">
                           <label class="col-xs-12 text-uppercase ins-cs-gn-lb" for="nl-last-name"><?php echo t('Surname');?></label>
                           <div class="col-xs-12">
                              <input type="text" class="form-control ins-tf" id="nl-last-name" name="nl_last_name" />
                           </div>
                        </div>
                        <div class="form-group ins-cs-frm-grp">
                           <label class="col-xs-12 text-uppercase ins-cs-gn-lb" for="nl-email"><?php echo t('Email');?></label>
                           <div class="col-xs-12">
                              <input type="email" class="form-control ins-tf" id="nl-email" name="nl_email" />
                           </div>
                        </div>
                        <div class="form-group ins-cs-frm-grp">
                           <label class="col-xs-12 text-uppercase ins-cs-gn-lb" for="nl-phone"><?php echo t('Phone Number');?></label>
                           <div class="col-xs-12">
                              <input type="text" class="form-control ins-tf" id="nl_phone" name="nl_phone" />
                           </div>
                        </div>
                        <div class="form-group ins-cs-frm-grp">   
                           <div class="col-xs-12 nl-btn-holder">
                              <button type="submit" name="submit" class="btn-ing-cs-gn btn-ins-drk" id="submit"><?php echo t('Sign up');?></button>
                           </div>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>

      </div>
   </div>
</div>