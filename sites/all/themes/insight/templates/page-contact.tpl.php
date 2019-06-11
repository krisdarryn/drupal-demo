<?php
global $base_url;
$insight_theme_path = $base_url.'/'.drupal_get_path('theme', 'insight');
$images_path = $insight_theme_path.'/dist/images/';
$scripts_path = $insight_theme_path.'/dist/scripts/';
?>

<h1 class="sr-only"><?php print isset($pageTitle) ? $pageTitle : ''; ?></h1>

<div id="ins-mn-bdy-cntr" class="common sml-bnr">
   <section id="ins-ctc-wrp">
      
      <!-- Banner -->
      <div class="banner-center-text" data-src="<?php print isset($bannerImageUrl) ? $bannerImageUrl : ''; ?>">
         <div class="banner-content">
            <p id="mob-banner-text"><?php print isset($bannerSlogan) ? $bannerSlogan : ''; ?></p>
         </div>
      </div>
      <!-- End of Banner -->
      
      <div class="ins-ctc-bd">
      
         <div class="ins-ctc-cnt-wrp">
            
            <!-- Contact Section -->
            <div class="ins-ctc-ct-wrp">
               <div class="container"> 
                  <div class="row">
                     <div class="col-xs-12 col-sm-4">    
                         <div class="ins-ctc-ct-itm ctc-vu-cnt">
                           <h2 class="ins-ctc-ct-tl"><?php print t('Visit us'); ?></h2>
                           <p class="ins-ctc-ct-cnt" id="ins-ctc-add"><?php print isset($address) ? $address : '';?></p>
                         </div>
                     </div>
                     <div class="col-xs-12 col-sm-4">    
                         <div class="ins-ctc-ct-itm ctc-cu-cnt">
                           <h2 class="ins-ctc-ct-tl"><?php print t('Contact us'); ?></h2>
                           <ul class="list-unstyled ins-ctc-ct-cnt ins-ctc-ct-list">
                              <li class="ins-ctc-ct-list-itm"><strong>T</strong><?php print isset($telephone) ? $telephone : '';?></li>
                              <li class="ins-ctc-ct-list-itm last"><strong>E</strong> <?php print isset($email) ? $email : '';?></li>
                           </ul>
                         </div>
                     </div>
                     <div class="col-xs-12 col-sm-4">    
                         <div class="ins-ctc-ct-itm">
                           <h2 class="ins-ctc-ct-tl ins-ctc-sm-tl"><?php print t('Follow us'); ?></h2>
                           <ul class="list-unstyled ins-ctc-ct-cnt clearfix ins-ftr-inf-list inst-sm-list">
                              <li class="footer-social-icons">
                                 <a href="https://www.facebook.com/insightinteriorschoolhk" id="" class="text-uppercase" title="Facebook" target="_blank">
                                    <img class="img img-responsive" src="<?php print "{$images_path}mb-facebook-icon.png"; ?>"></img>
                                 </a> 
                              </li>
                              <li class="footer-social-icons">
                                 <a href="https://twitter.com/insightschoolhk" id="" class="text-uppercase" title="Twitter" target="_blank">
                                    <img class="img img-responsive" src="<?php print "{$images_path}mb-twitter-icon.png"; ?>"></img>
                                 </a>          
                              </li>
                              <li class="footer-social-icons">
                                 <a href="http://instagram.com/insightschool" id="" class="text-uppercase" title="Instagram" target="_blank">
                                    <img class="img img-responsive" src="<?php print "{$images_path}mb-instagram-icon.png"; ?>"></img>
                                 </a> 
                              </li>
                              <li class="footer-social-icons">
                                 <a href="https://www.youtube.com/channel/UC2dkOE1IvcbcS5koLgiwHPw" id="" class="text-uppercase" title="Youtube" target="_blank">
                                    <img class="img img-responsive" src="<?php print "{$images_path}mb-youtube-icon.png"; ?>"></img>
                                 </a>   
                              </li>
                              <li class="footer-social-icons">
                                 <a href="http://www.pinterest.com/insightschoolhk" id="" class="text-uppercase" title="Pinterest" target="_blank">
                                    <img class="img img-responsive" src="<?php print "{$images_path}mb-pinterest-icon.png"; ?>"></img>
                                 </a>    
                              </li>
                              <li class="footer-social-icons">
                                 <a href="https://hk.linkedin.com/company/insight-school-of-interior-design" id="" class="text-uppercase" title="LinkedIn" target="_blank">
                                    <img class="img img-responsive" src="<?php print "{$images_path}mb-linkedin-icon.png"; ?>"></img>
                                 </a>      
                              </li>
                           </ul>
                         </div>
                     </div>
                  </div>
               </div>
            </div>
            <!-- End of Contact Section -->
            
            <!-- Form Section -->
            <div class="ins-ctc-fm-wrp">
               <div class="container">
                  <div class="row">
                     <div class="col-xs-12">
                        <h2 id="email-us" class="ins-ctc-fm-tl"><?php print t('Email us'); ?></h2>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-xs-12 col-md-11">
                        <div class="ins-ctc-fm-bd">
                           <form class="form-horizontal" id="ins-ctc-frm" action="" method="post">
                           
                              <div class="row">
                                 <!-- Left Col Elements -->
                                 <div class="col-xs-12 col-sm-6 col-md-5 ins-ctc-l-frm">
                                    <div class="form-group ins-ctc-fm-frm-grp">
                                       <label class="col-xs-12 text-uppercase ins-cs-gn-lb" for="fm-first-name"><?php print t('First Name'); ?></label>
                                       <div class="col-xs-12">
                                          <input type="text" value="<?php print $formStatus == -1 ? $_POST['fm_first_name'] : ''; ?>" class="form-control ins-tf <?php print ($formStatus == -1 && $_POST['fm_first_name'] == '') ? 'err' : ''; ?>" id="fm-first-name" name="fm_first_name" />
                                       </div>
                                    </div>
                                    <div class="form-group ins-ctc-fm-frm-grp">
                                       <label class="col-xs-12 text-uppercase ins-cs-gn-lb" for="fm-surname"><?php print t('Surname'); ?></label>
                                       <div class="col-xs-12">
                                          <input type="text" value="<?php print $formStatus == -1 ? $_POST['fm_surname'] : ''; ?>" class="form-control ins-tf <?php print ($formStatus == -1 && $_POST['fm_surname'] == '') ? 'err' : ''; ?>" id="fm-surname" name="fm_surname" />
                                       </div>
                                    </div>
                                    <div class="form-group ins-ctc-fm-frm-grp">
                                       <label class="col-xs-12 text-uppercase ins-cs-gn-lb" for="fm-email"><?php print t('Email'); ?></label>
                                       <div class="col-xs-12">
                                          <input type="email" value="<?php print $formStatus == -1 ? $_POST['fm_email'] : ''; ?>" class="form-control ins-tf <?php print ($formStatus == -1 && $_POST['fm_email'] == '') ? 'err' : ''; ?>" id="fm-email" name="fm_email" />
                                       </div>
                                    </div>
                                    <div class="form-group ins-ctc-fm-frm-grp">
                                       <label class="col-xs-12 text-uppercase ins-cs-gn-lb" for="fm-phone-number"><?php print t('Phone Number'); ?></label>
                                       <div class="col-xs-12">
                                          <input type="text" value="<?php print $formStatus == -1 ? $_POST['fm_phone_number'] : ''; ?>" class="form-control ins-tf" id="fm-phone-number" name="fm_phone_number" />
                                       </div>
                                    </div>
                                 </div>
                                 <!-- End of Left Col Elements -->
                                 
                                 <!-- Right Col Elements -->
                                 <div class="col-xs-12 col-sm-6 col-md-6 col-md-push-1 ins-ctc-r-frm">
                                    <div class="form-group ins-ctc-fm-frm-grp">
                                       <label class="col-xs-12 text-uppercase ins-cs-gn-lb" for="fm-interested-course"><?php print t('Which course are you interested in?'); ?></label>
                                       <div class="col-xs-12">
                                       <?php if (isset($interestedCourse) && $interestedCourse != '') { ?>
                                          <!--<input type="text" value="<?php print $interestedCourse; ?>" class="form-control ins-tf ins-ctc-read-only<?php print ($formStatus == -1) ? ' err' : ''; ?>" >
                                          <input type="hidden" value="<?php print $interestedCourse; ?>" id="fm-interested-course" name="fm_interested_course"> -->
                                          
                                          <div class="ins-dd-wrp"> 
                                             <img src="<?php print "{$images_path}down-arrow.png"; ?>" alt="Dropdown Icon" class="ins-dd-icon" />
                                             <div class="ins-dd-overlay"></div>
                                             <select class="form-control ins-tf ins-dd ins-ctc-fm-dd <?php print ($formStatus == -1 && $_POST['fm_interested_course'] == '-1') ? 'err' : ''; ?>" id="fm-interested-course" name="fm_interested_course">
                                                <option value="<?php print $interestedCourse; ?>"><?php print $interestedCourse; ?></option>
                                                <?php 
                                                   foreach($interestedCourses as $course) { 
                                                   $isSelected = (($formStatus == -1) && ($_POST['fm_interested_course'] == $course) ? 'selected' : '');
                                                ?>
                                                   <option <?php print $isSelected; ?> value="<?php print $course; ?>"><?php print $course; ?></option>
                                                <?php } ?>
                                             </select>
                                          </div>
                                          
                                       <?php } else { ?>
                                          <div class="ins-dd-wrp"> 
                                             <img src="<?php print "{$images_path}down-arrow.png"; ?>" alt="Dropdown Icon" class="ins-dd-icon" />
                                             <div class="ins-dd-overlay"></div>
                                             <select class="form-control ins-tf ins-dd ins-ctc-fm-dd <?php print ($formStatus == -1 && $_POST['fm_interested_course'] == '-1') ? 'err' : ''; ?>" id="fm-interested-course" name="fm_interested_course">
                                                <option value="-1"><?php print t('Please Select'); ?></option>
                                                <?php 
                                                   foreach($interestedCourses as $course) { 
                                                   $isSelected = (($formStatus == -1) && ($_POST['fm_interested_course'] == $course) ? 'selected' : '');
                                                ?>
                                                   <option <?php print $isSelected; ?> value="<?php print $course; ?>"><?php print $course; ?></option>
                                                <?php } ?>
                                             </select>
                                          </div>
                                       <?php } ?>
                                       </div>
                                    </div>
                                    <div class="form-group ins-ctc-fm-frm-grp">
                                       <label class="col-xs-12 text-uppercase ins-cs-gn-lb" for="fm-hear-about-us"><?php print t('Where did you hear about us?'); ?></label>
                                       <div class="col-xs-12">
                                          <div class="ins-dd-wrp"> 
                                             <img src="<?php print "{$images_path}down-arrow.png"; ?>" alt="Dropdown Icon" class="ins-dd-icon" />
                                             <div class="ins-dd-overlay"></div>
                                             <select class="form-control ins-tf ins-dd ins-ctc-fm-dd <?php print ($formStatus == -1 && $_POST['fm_hear_about_us'] == '-1') ? 'err' : ''; ?>" id="fm-hear-about-us" name="fm_hear_about_us">
                                                <option value="-1"><?php print t('Please Select'); ?></option>
                                                <?php 
                                                   foreach($heardOptions as $opt) { 
                                                   $isSelected = (($formStatus == -1) && ($_POST['fm_hear_about_us'] == $opt) ? 'selected' : '');
                                                ?>
                                                   <option <?php print $isSelected; ?> value="<?php print $opt; ?>"><?php print $opt; ?></option>
                                                <?php } ?>
                                             </select>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="form-group ins-ctc-fm-frm-grp ins-ctc-fm-lsm">
                                       <label class="col-xs-12 text-uppercase ins-cs-gn-lb" for="fm-message"><?php print t('Your message'); ?></label>
                                       <div class="col-xs-12">
                                          <textarea rows="5" placeholder="<?php print t('Please send us any questions you have about any course you might be interested in'); ?>" class="form-control ins-ta <?php print ($formStatus == -1 && $_POST['fm_message'] == '') ? 'err' : ''; ?>" id="fm-message" name="fm_message"><?php print $formStatus == -1 ? $_POST['fm_message'] : ''; ?></textarea>
                                       </div>
                                    </div>
                                     <div class="form-group ins-ctc-fm-frm-grp">
                                       <label class="col-xs-12 text-uppercase ins-cs-gn-lb">
                                          <div class="ins-cb-wrp cleafix">
                                             <div class="pull-left ins-cb-ele">
                                                <input <?php print ($formStatus == -1 && isset($_POST['fm_is_appointment_true']) ? 'checked' : ''); ?> type="checkbox" class="sr-only ins-cb" name="fm_is_appointment_true" id="fm-is-appointment-true" />
                                                <div class="ins-cb-ds"></div>
                                             </div>
                                             <div class="pull-left ins-cb-lb">
                                                <?php print t('I wish to make an appointment to visit the school'); ?>
                                             </div>
                                          </div>
                                       </label>
                                    </div>
                                    <div class="form-group ins-ctc-fm-frm-grp">
                                       <div class="col-xs-12">
                                          <button type="submit" name="submit" class="btn-ins-ctc-fm btn-ins-drk"><?php print t('Submit'); ?></button>
                                       </div>
                                    </div>
                                 </div>
                                 <!-- End of Right Col Elements -->
                              </div>
                           
                           </form>
                        </div>                                    
                     </div>
                  </div>
                  
               </div>
            </div>
            <!-- End of Form Section -->
            
            <!-- Map Section -->
            <div class="ins-ctc-gm-wrp">
               <div class="ins-ctc-gm-bd">
                  <div id="ins-ctc-gmap-cnt" class="ins-ctc-gm"></div>
               </div>
            </div>
            <!-- End of Map Section -->
            
            <!-- Route Section -->
            <div class="ins-ctc-rt-wrp">
               
               <div class="container">
                  
                  <div class="row">
                     <div class="col-xs-12 hidden-xs">
                        <h2 class="ins-ctc-rt-tl ins-rt-hd-tl"><?php print t('How to get here'); ?><h2>
                     </div>
                  </div>
                  
                  <div class="row" id="accordion">
                        
                     <div class="col-xs-12 col-sm-4">
                        <div class="ins-ctc-rt-cnt">
                           <div class="ins-ctc-rt-hd">
                              <h3 class="ins-ctc-rt-hd-tl">
                                 <span class="hidden-xs"><?php print t('By bus'); ?></span>
                                 <a class="visible-xs" role="button" data-toggle="collapse" data-parent="#accordion" href="#rt-by-bus" aria-expanded="false" aria-controls="rt-by-bus">
                                    <?php print t('By bus'); ?>
                                    <img src="<?php print "{$images_path}down-arrow.png"; ?>" alt="Dropdown Icon" class="ins-ctc-rt-hd-icon" />
                                 </a>
                              </h3>
                           </div>
                           <div class="ins-ctc-rt-bd collapse" id="rt-by-bus">
                              <div class="ins-ctc-rt-list">

                                <?php if (isset($trave_by_bus_list) && count($trave_by_bus_list) > 0) :?>

                                 <?php foreach ($trave_by_bus_list as $busItem) { ?>
                                    <div class="ins-ctc-rt-itm">
                                       <h4 class="ins-ctc-rt-tl ins-rt-bb-tl text-uppercase"><?php print isset($busItem['location']) ? $busItem['location'] : '';?></h4>
                                       <p class="ins-ctc-rt-stl ins-rt-bb-stl"><?php print isset($busItem['name']) ? $busItem['name'] : '';?></p>
                                    </div>
                                 <?php } ?>
                                 <?php endif;?>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-xs-12 col-sm-4">
                        <div class="ins-ctc-rt-cnt">
                           <div class="ins-ctc-rt-hd">
                              <h3 class="ins-ctc-rt-hd-tl">
                                 <span class="hidden-xs"><?php print t('By MTR / Minibus'); ?></span>
                                 <a class="visible-xs" role="button" data-toggle="collapse" data-parent="#accordion" href="#rt-by-mrt" aria-expanded="false" aria-controls="rt-by-mrt">
                                    <?php print t('By MTR / Minibus'); ?>
                                    <img src="<?php print "{$images_path}down-arrow.png"; ?>" alt="Dropdown Icon" class="ins-ctc-rt-hd-icon" />
                                 </a>
                              </h3>
                           </div>
                           <div class="ins-ctc-rt-bd collapse" id="rt-by-mrt">
                              <div class="ins-ctc-rt-list">
                              <?php if (isset($trave_by_mtr_list) && count($trave_by_mtr_list) > 0) :?>
                                 <?php foreach ($trave_by_mtr_list as $mtrKey => $mtrItem) { ?>
                                    <div class="ins-ctc-rt-itm ins-rt-mn-bs">
                                       <?php
                                       $letter = 'A';
                                       if ($mtrKey && $mtrKey > 0) {
                                          $letter = contact_page_mrt_opt_gen($mtrKey);
                                       }
                                       ?>
                                       <h5 class="ins-ctc-rt-tl ins-rt-opt-tl text-uppercase">Option <?php echo $letter; ?></h5>
                                       <h4 class="ins-ctc-rt-tl ins-tr-tst"><?php echo isset($mtrItem['train_name']) ? $mtrItem['train_name'] : ''; ?></h4>
                                       
                                       <div class="ins-rt-mn-bs-wrp">
                                          <h4 class="ins-ctc-rt-tl ins-rt-mn-bs-tl"><?php echo isset($mtrItem['bus_name']) ? $mtrItem['bus_name'] : ''; ?></h4>
                                          <p class="ins-ctc-rt-stl ins-rt-mn-bs-stl"><?php echo isset( $mtrItem['bus_location']) ?  $mtrItem['bus_location'] : ''; ?><p>
                                       </div>
                                    </div>
                                 <?php } ?>
                              <?php endif;?>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-xs-12 col-sm-4">
                        <div class="ins-ctc-rt-cnt">
                           <div class="ins-ctc-rt-hd">
                              <h3 class="ins-ctc-rt-hd-tl">
                                 <span class="hidden-xs"><?php print t('By car (parking)'); ?></span>
                                 <a class="visible-xs" role="button" data-toggle="collapse" data-parent="#accordion" href="#rt-by-car" aria-expanded="false" aria-controls="rt-by-car">
                                    <?php print t('By car (parking)'); ?>
                                    <img src="<?php print "{$images_path}down-arrow.png"; ?>" alt="Dropdown Icon" class="ins-ctc-rt-hd-icon" />
                                 </a>
                              </h3>
                           </div>
                           <div class="ins-ctc-rt-bd collapse" id="rt-by-car">
                              <div class="ins-ctc-rt-list">
                              <?php if (isset($trave_by_car_list) && count($trave_by_car_list) > 0) :?>
                                 <?php foreach ($trave_by_car_list as $carItem) { ?>
                                    <div class="ins-ctc-rt-itm">
                                       <h4 class="ins-ctc-rt-tl ins-rt-by-car"><?php print isset($carItem['description']) ? $carItem['description'] : ''; ?></h4>
                                       <ul class="ins-rt-by-car-list">
                                          <?php if (isset($carItem['locationList']) && count($carItem['locationList']) > 0) { ?>
                                          <?php foreach ($carItem['locationList'] as $locationItem) { ?>
                                             <li class="ins-rt-by-car-itm"><?php print $locationItem ? $locationItem : ''; ?></li>
                                          <?php } }?>
                                       </ul>
                                    </div>
                                 <?php } ?>
                              <?php endif;?>
                              </div>
                           </div>
                        </div>
                     </div>
                     
                  </div>
                  
               </div>
            </div>
            <!-- End of Route Section -->
           
         </div>
         
      </div>
      
      
   </section>
   
</div>