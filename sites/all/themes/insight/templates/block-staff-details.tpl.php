<div id="ins-mdl" class="modal fade" role="dialog">
   <div class="modal-dialog modal-xl">
      <!-- Modal content-->
      <div class="modal-content container" id="ins-mdl-cntnt">
         <div class="modal-header" id="ins-mdl-hdr">
            <button type="button" class="close" data-dismiss="modal" id="ins-mdl-cls-btn">&times;</button>
            <h4 class="modal-title" id="ins-mdl-title"><?php print isset($headerTitle) ? $headerTitle : ''; ?></h4>
         </div>
         <div class="ins-mdl-bdy">
            <div class="row">
               <div class="col-xs-12 col-sm-7">
                  <div class="ins-mdl-bdy-sec">
                     <div class="cont-sec ins-mdl-sec" id="hd-mdl-sec">
                        <div class="cont-head stf-itr-occ-lbl">
                           <h1 id="stf-nme" class="stf-nme-hd-tle"><?php print (isset($firstName) ? $firstName : '') . ' ' . (isset($lastName) ? $lastName : ''); ?></h1>
                           <p><?php print isset($longTitle) ? $longTitle : ''; ?></p>
                        </div>
                        <div class="cont-body">
                           <div class="desc"<?php echo isset($biography) && strlen($biography) > 100 ? ' data-rm-f="1"' : '';?>><?php print isset($biography) ? $biography : ''; ?></div>                           
                           
                           <?php // Qualifications ?>
                           <div class="ins-mdl-q-sec">
                              <div class="no-pd-btm"><strong><?php print t('Qualifications');?></strong></div>
                              <ul>
                              <?php if ($qualifications && count($qualifications) > 0) : ?>
                              <?php foreach ($qualifications as $qualification): ?>
                                    <li><?php print $qualification; ?></li>
                              <?php endforeach; ?>
                              <?php endif;?>
                              </ul>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               
               <?php // Courses ?>
               <div class="col-xs-12 col-sm-5">
                  <div class="ins-mdl-bdy-sec">
                     <div class="ins-tchr-cv">
                           <div class="tchr-cv-pic" style="background-image: url(<?php print isset($imageUrl) ? $imageUrl : '' ?>)">
                           </div>
                           <div class="tchr-cv-inf">
                              <div class="row">
                                 <?php
                                 $ctr = 1;

                                 if (isset($courses) && count($courses) > 0) {
                                    foreach ($courses as $courseType => $list):
                                    ?>   
                                          <?php if ($courseType && $list)  : ?>

                                          <div class="col-xs-10 col-sm-12">
                                          <h4><?php print $courseType; ?></h4>
                                          <ul>
                                          <?php if (count($list) > 0) : ?>
                                          <?php foreach ($list as $course): ?>
                                                <li><?php print $course; ?></li>
                                          <?php endforeach; ?>
                                          <?php endif;?>
                                          </ul>
                                          </div>
                                          
                                          <?php if ($ctr > 0 && fmod($ctr, 2) == 0): ?>
                                          <div class="clearfix hidden-xs"></div>
                                          <?php endif; ?>
                                          <?php endif;?>
                                    <?php
                                    $ct++;
                                    endforeach;
                                    }
                                 ?>
                              </div>
                           </div>
                        </div>
                  </div>
               </div>
               
               <?php // Inspiration board ?>
               <div class="clearfix"></div>
               <div class="col-xs-12 col-sm-12">
                  <div class="ins-mdl-bdy-sec">
                     <div class="cont-sec ins-mdl-sec" id="insp-brd">
                        <div class="cont-head">
                           <h3><?php print isset($firstName) ? $firstName : ''; ?>'<?php print t('s inspiration wall');?></h3>
                        </div>
                        <div class="cont-body">
                           <div class="grid">
                           <?php $ctr = 0; ?>
                           
                           <?php if (isset($inspirationBoards) && $inspirationBoards && count($inspirationBoards)) :?>

                           <?php foreach ($inspirationBoards as $item): ?>
                              
                              <?php if ($item) : ?>

                              <div class="grid-item">
                                 <div class="img-itm bse-img">
                                    <img class="img-responsive" src="<?php print isset($item['imageUrl']) ? $item['imageUrl'] : ''; ?>" alt="<?php print isset($item['imageAlt']) ? $item['imageAlt'] : ''; ?>" title="<?php print isset($item['imageTitle']) ? $item['imageTitle'] : ''; ?>">
                                    <div class="bse-img-info">
                                       <div class="row">
                                          <div class="col-sm-12">
                                             <div class="lctr-info-det">
                                                <div class="row">
                                                   <div class="col-sm-12">
                                                      <div class="lctr-info-det">
                                                         <h3><?php print isset($item['title']) ? $item['title'] : ''; ?></h3>
                                                         <p><?php print isset($item['description']) ? $item['description'] : ''; ?></p>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <?php endif;?>
                              <?php $ctr++; ?>
                           <?php endforeach; ?>
                              <?php endif;?>                              
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               
            </div>
         </div>
      </div>
   </div>
</div>