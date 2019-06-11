<?php
global $base_url;
$images_path = $base_url . '/' . drupal_get_path('theme', 'insight') . '/dist/images/';
?>

<div id="ins-mn-bdy-cntr" class="common sml-bnr5">
   <h1 class="sr-only"><?php echo t('Booking');?></h1>
   <div class="booking-banner-row row">
      <div class="booking-banner-col col-xs-12">
         <div class="booking-banner" style="background-image: url(<?php print isset( $bannerImageUrl) ?  $bannerImageUrl : ''; ?>)">
            <div class="banner-content">
               <p class="banner-text"><?php print isset($bannerSlogan) ? $bannerSlogan : ''; ?></p>
            </div>
         </div>
      </div>
   </div>

   <div class="information-section container">
      <div class="row">
         <div class="col-xs-12 col-sm-6 info-col payment-info">
            <div class="progress booking-progress">
               <div class="progress-bar" role="progressbar" aria-valuenow="66.666" aria-valuemin="0" aria-valuemax="100" style="width: 66.666%;">
                  <span class="sr-only"><?php echo t('66.666% Complete');?></span>
               </div>
            </div>

            <div class="col-xs-12 progress-bar-labels clearfix">
               <div class="row">
                  <div class="col-xs-4 label-col active">
                     <p class="step-text"><?php echo t('STEP 1');?></p>
                     <p><?php echo t('Registration');?></p>
                  </div>

                  <div class="col-xs-4 label-col active">
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
               <h2 class="reg-hdr"><?php echo t('Payment');?></h2>
               <div class="reg-text visible-xs">
                     <p class="inline-text"><?php echo t('Thank you for your interest! You are going to register and submit payment for');?></p>
                     <?php
                     $durationTitleDate = isset($courseDetails['durationTitle']) ? '[' . $courseDetails['durationTitle'] . '] ' : '';
                     $durationTitleDate .= isset($courseDetails['durationDate']) ? $courseDetails['durationDate'] : '';
                     ?>
                     <p class="course-text inline-text"><?php print isset($courseDetails['title']) ? $courseDetails['title'] : ''; ?>: <?php print $durationTitleDate; ?>.</p>
                     <p class="hidden-xs"></br></p>
               </div>
            </div>

            <div class="col-xs-12 hidden-xs b-c-banner">
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

         </div>

      </div> <!-- end of row-->
      
   </div>

   <div class="row b-c-row">
      <div class="col-xs-12 payment-info-col">
      
         <div class="b-c-payment-container container">
            <?php               
            // Messages to be displayed here if any
            if (isset($messages) && $messages) {
               $block = module_invoke('custompage', 'block_view', 'custom-messages', array('messages' => $messages));
               print isset($block['content']) ? render($block['content']) : '';
            }
            ?>
            
            <div class="b-c-payment">
               <div class ="radio-holder">
                  <div class="btn-group">
                     <div class="radio">
                        <label class="ins-cs-gn-lb">
                           <div class="ins-cb-wrp cleafix">
                              <div class="pull-left ins-cb-ele">
                                 <input type="radio" class="sr-only ins-cb" name="optpayment" id="radio-banktransfer" value="banktransfer" data-toggle="collapse" data-target="#bt-collapse:not(.in)">
                                 <div class="ins-cb-ds-wht">
                                    <div class="ins-cb-inner"></div>
                                 </div>
                              </div>
                              <div class="pull-left ins-cb-lb">
                                 <?php echo t('Bank transfer');?>
                              </div>
                           </div>
                        </label>

                        <div class="panel-group">
                           <div class="panel panel-default">
                              <div id ="b-t-panel-heading" class="panel-heading">
                                 <div id="bt-collapse" class="collapseOne panel-collapse collapse">
                                    <div class="panel-body bank-acct-info">
                                       <p><?php echo t('Bank code: '); ?><strong><?php echo isset($bankCode) ? $bankCode : ''; ?></strong></p>
                                       <p><?php echo t('Bank name: '); ?><strong><?php echo isset($bankName) ? $bankName : ''; ?></strong></p>
                                       <p><?php echo t('Bank address: '); ?><strong><?php echo isset($bankAddress) ? $bankAddress : ''; ?></strong></p>
                                       <p><?php echo t('Account number: '); ?><strong><?php echo isset($accountNumber) ? $accountNumber : ''; ?></strong></p>
                                       <p><?php echo t('Account name: '); ?><strong><?php echo isset($accountName) ? $accountName : ''; ?></strong></p>
                                       <p><?php echo t('SWIFT code: '); ?><strong><?php echo isset($swiftCode) ? $swiftCode : ''; ?></strong></p>
                                       <p class="panel-margin"><?php echo isset($bankTransferNote) ? $bankTransferNote : ''; ?></p>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>

                     <div class="radio">
                        <label class="ins-cs-gn-lb">
                           <div class="ins-cb-wrp cleafix">
                              <div class="pull-left ins-cb-ele">
                                 <input type="radio" class="sr-only ins-cb" name="optpayment" id="radio-paypal" value="paypal" data-toggle="collapse" data-target="#bt-collapse.in" checked>
                                 <div class="ins-cb-ds-wht">
                                    <div class="ins-cb-inner"></div>
                                 </div>
                              </div>
                              <div class="pull-left ins-cb-lb">
                                 <?php echo t('Credit Card or PayPal');?>
                              </div>
                           </div>
                        </label>
                     </div>
                  </div>
               </div>
               <div class="total-holder clearfix">
                  <p class="b-c-total pull-left"><?php echo t('TOTAL');?></p>
                  <p class="b-c-price pull-right"><?php print (isset($courseDetails['feeCurrency']) ? $courseDetails['feeCurrency'] : '') . " " . (isset($courseDetails['totalFee']) ? $courseDetails['totalFee'] : ''); ?></p>
               </div>

               <div id="noticePaypal" class="paypal-notice"><?php echo isset($paypalNotice) ? $paypalNotice : ''; ?></div>

               <button type="button" id="submitPayment" class="btn btn-payment-submit<?php print (! isset($courseDetails['nid'])) ? ' disabled' : ''; ?>"><img class="lock-img" src="<?php print $images_path; ?>lock-icon.png"/><?php echo t('Securely pay');?> <?php print (isset($courseDetails['feeCurrency']) ? $courseDetails['feeCurrency'] : '') . " " . (isset($courseDetails['totalFee']) ? $courseDetails['totalFee'] : ''); ?></button>
            </div>
            
            <div class="hidden">
               <?php
               // For paypal payment
               if (isset($courseDetails)) {
                  $courseDetails['bookschedule'] = $_GET['bookschedule'];
                  $paymentFormBuild = drupal_get_form('custom_payment_form', $courseDetails);
                  echo render($paymentFormBuild);
               }
               ?>
               
               <?php 
                  $paymentBanTransferFormBuild = drupal_get_form('custom_payment_bank_transfer_form', []);
                  echo render($paymentBanTransferFormBuild);
               ?>
            </div>
         </div>
         
      </div>
   </div>
</div>