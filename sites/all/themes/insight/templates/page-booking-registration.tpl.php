<div id="ins-mn-bdy-cntr" class="common sml-bnr5">
   <h1 class="sr-only">Booking</h1>
   <div class="booking-banner-row row">
      <div class="booking-banner-col col-xs-12">
         <div class="booking-banner" style="background-image: url(<?php print isset($bannerImageUrl) ? $bannerImageUrl : ''; ?>)">
            <div class="banner-content container">
               <p class="banner-text"><?php print isset($bannerSlogan) ? $bannerSlogan : ''; ?></p>
            </div>
         </div>
      </div>
   </div>

   <div class="information-section container">
      <div class="row">
         <div class="col-xs-12 col-sm-6 info-col">
            <div class="progress booking-progress">
               <div class="progress-bar" role="progressbar" aria-valuenow="33.333" aria-valuemin="0" aria-valuemax="100" style="width: 33.333%;">
                  <span class="sr-only"><?php echo t('60% Complete');?></span>
               </div>
            </div>

            <div class="col-xs-12 progress-bar-labels clearfix">
               <div class="row">
                  <div class="col-xs-4 label-col active">
                     <p class="step-text"><?php echo t('STEP 1');?></p>
                     <p><?php echo t('Registration');?></p>
                  </div>

                  <div class="col-xs-4 label-col">
                     <p class="step-text"><?php echo t('STEP 2');?></p>
                     <p><?php echo t('Payment');?></p>
                  </div>

                  <div class="col-xs-4 label-col">
                     <p class="step-text"><?php echo t('STEP 3');?></p>
                     <p><?php echo t('Confirmation');?></p>   
                  </div>
               </div>
            </div>

            <div class="col-xs-12 reg-message">
               <h2 class="reg-hdr"><?php echo t('Registration');?></h2>
               <div class="reg-text reg-text-1">
                  <?php echo isset($registrationContent1) ? $registrationContent1 : ''; ?>
                  <?php
                  $durationTitleDate = isset($courseDetails['durationTitle']) ? '[' . $courseDetails['durationTitle'] . '] ' : '';
                  $durationTitleDate .= isset($courseDetails['durationDate']) ? $courseDetails['durationDate'] : '';
                  ?>
                  <p class="course-text"><?php print isset($courseDetails['title']) ? $courseDetails['title'] : ''; ?>: <?php print $durationTitleDate; ?>.</p>
               </div>
               <p class="hidden-xs"></br></p>
            </div>

            <div class="col-xs-12 b-c-banner">
               <div class="b-c-container">
                  <div class="b-image-container" style="background-image: url(<?php print isset($courseDetails['coverImageUrl']) ? $courseDetails['coverImageUrl'] : ''; ?>)">
                     <!--<div class="b-c-date">
                        <span><?php //print isset($courseDetails['startDate']) ? $courseDetails['startDate'] : ''; ?></span>
                     </div>-->
                  </div>
                  <div class="b-c-info">
                     <p class="b-c-title"><?php print isset($courseDetails['title']) ? $courseDetails['title'] : ''; ?></p>
                     <div class="b-c-details"><?php print $durationTitleDate; ?></div>
                     <p class="b-c-duration"><?php print isset($courseDetails['duration']) ? $courseDetails['duration'] : ''; ?></p>
                  </div>
               </div>
            </div>

            <div class="col-xs-12 reg-warning">
               <div class="reg-text">
                  <?php echo isset($registrationContent2) ? $registrationContent2 : ''; ?>
               </div>
            </div>

         </div>

      </div> <!-- end of row-->
      
   </div>

   <div class="row b-c-row">
      <div class="col-xs-12 contact-info-col">
         <div class="container">
            <?php               
            // Messages to be displayed here if any
            if (isset($messages) && $messages) {
               $block = module_invoke('custompage', 'block_view', 'custom-messages', array('messages' => $messages));
               print isset($block['content']) ? render($block['content']) : '';
            }
            ?>
            
            <div class="row">
               <div class="col-xs-12 col-sm-6 contact-info-detail">   
                  <h2 class="reg-hdr"><?php echo t('Contact information');?></h2>
                  <form action="" method="POST" onsubmit="return validateForm();">
                     <div class="form-group">
                        <label for="firstName"><?php echo t('FIRST NAME');?></label>
                        <input type="text" class="form-control ins-tf" id="firstName" name="firstname">
                     </div>
                     <div class="form-group">
                        <label for="surName"><?php echo t('SURNAME');?></label>
                        <input type="text" class="form-control ins-tf" id="surName" name="surname">
                     </div>
                     <div class="form-group">
                        <label for="email"><?php echo t('EMAIL');?></label>
                        <input type="text" class="form-control ins-tf" id="email" name="email">
                     </div>
                     <div class="form-group">
                        <label for="phone"><?php echo t('PHONE NUMBER');?></label>
                        <input type="text" class="form-control ins-tf" id="phone" name="phoneno">
                     </div>
                     <div class="form-group">
                        <label for="occupation"><?php echo t('OCCUPATION');?></label>
                        <input type="text" class="form-control ins-tf" id="occupation" name="occupation">
                     </div>

                     <div class="form-group tnc-container">
                        <div>
                           <div class="checkbox" id="tnc-chkbx">
                              <label class="ins-cs-gn-lb">
                                 <div class="ins-cb-wrp cleafix">
                                    <div class="pull-left ins-cb-ele">
                                    <input type="checkbox" class="sr-only ins-cb" name="tnc" id="tnc-booking" value="tnc">
                                       <div class="ins-cb-ds-wht">
                                          <div class="ins-cb-inner"></div>
                                       </div>
                                    </div>
                                    <div class="pull-left ins-cb-lb">
                                       <?php echo t('I hereby confirm that i have read and agree to');?> <a href="<?php echo (isset($termConditionFile) && $termConditionFile['url'] != '') ? $termConditionFile['url'] : '#'; ?>" title="terms and conditions" target="_blank"> <?php echo t('term and conditions');?></a>
                                    </div>
                                 </div>
                              </label>
                           </div>
                           <div class="g-recaptcha"  data-callback="recaptchaCallback" data-sitekey="6LdkLzcUAAAAAM6JJ4vtjqN65dDDy33rtJKLCu34" style="margin-bottom: 50px; margin-top: 30px;"></div>
                           
                           <div class="btn-bookin-wrpr">
                              <input type="hidden" id="isSaveRegistration" name="isSaveRegistration" value="0">
                              <button type="submit" class="btn btn-booking-submit" id="btnBookingSubmit" disabled><?php echo t('Proceed to payment');?></button>
                           </div>
                        </div>
                     </div>
                  </form>
               </div>
            </div> <!-- end of row --> 
         </div> <!-- end of container-->
      </div>
   </div>

   <div id="errMsgModal" class="modal fade" role="dialog">
     <div class="modal-dialog">

       <!-- Modal content-->
       <div class="modal-content">
         <div class="modal-header">
           <button type="button" class="close" data-dismiss="modal">&times;</button>
           <h4 class="modal-title"><?php echo t('Error message');?></h4>
               <span class="glyphicon glyphicon-alert" aria-hidden="true"></span>
               <strong><span style="margin-left: 5px;">Error message</span></strong>
            </h4>
         </div>
         <div class="modal-body">
            <div class="alert alert-block alert-danger messages error">
               <p id="errmsg"></p>
            </div>
         </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo t('Error message');?></button>
         </div>
       </div>

     </div>
   </div>
</div>