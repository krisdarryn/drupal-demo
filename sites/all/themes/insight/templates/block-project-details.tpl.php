<?php
global $base_url;
$images_path = $base_url . '/' . drupal_get_path('theme', 'insight') . '/dist/images/';
?>

<!-- Modal -->
<div class="modal fade" id="showcaseModal" role="dialog">
   <div class="modal-dialog modal-lg">
   
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"><?php echo t('Project showcase');?></h4>
         </div>
         <div class="modal-body">
            
            <div class="first-container">
                <div class="row">

                  <div class="col-xs-12">
                     <h2 class="section-title"><?php print isset($projectName) ? $projectName : ''; ?></h2>
                  </div>

                  <div class="col-xs-12 col-sm-5 pull-right mod-img-col">
                     <div class="mod-img-cont">
                        <img src="<?php print isset($clientLogoUrl) ? $clientLogoUrl : ''; ?>" class="img-responsive">

                        <div class="project-det">
                           <h4 class="proj-name"><?php echo t('Project name');?></h4>
                           <p><?php print isset($projectName) ? $projectName : ''; ?></p>
                           <h4 class="proj-dur"><?php echo t('Project duration');?></h4>
                           <p><?php print isset($duration) ? $duration : ''; ?></p>
                           <h4 class="proj-loc"><?php echo t('Project location');?></h4>
                           <p><?php print isset($projectLocation) ? $projectLocation : ''; ?></p>
                           <h4 class="proj-client"><?php echo t('Client');?></h4>
                           <p><?php print isset($clientName) ? $clientName : ''; ?></p>
                        </div>

                     </div>
                  </div>

                  <div class="col-xs-12 col-sm-7">
                  
                     <div class="background-section">
                        <h3 class="sub-title"><?php echo t('Background');?></h3>
                        <p><?php print isset($background) ? $background : ''; ?></p>
                     </div>

                     <div class="objectives-section clearfix">
                        <h3 class="sub-title"><?php echo t('Project brief');?></h4>
                        <ul class="objectives-section-list">
                           <?php if (isset($projectBriefs) && count($projectBriefs) > 0) : ?>

                              <?php foreach ($projectBriefs as $brief): ?>
                                 <li>
                                    <p><?php print $brief; ?></p>
                                 </li>
                              <?php endforeach; ?>
                              
                           <?php endif;?>
                        </ul>
                     </div>
                     
                  </div>
               </div> <!-- end of row -->
               
               <div class="row">
                  <div class="col-xs-12">
                     <h2 id="stw-gallery-title" class="gallery-title"><?php echo t('Project gallery');?></h2>
                  </div>
               </div>
            </div>
            
            <div class="ev-detail-slider-container" id="stndtwrk-slider">
               
               <div class="second-container">
                  <div class="row stndtwrk-slider-row">
                     <?php if (isset($projectGalleries) && count($projectGalleries) > 0) : ?>
                        <div class="col-xs-12">
                           <div class="slider-container" id="grd-mdl-sldr">
                              <div class="slider-section">
                                 <?php foreach ($projectGalleries as $img): ?>
                                 <div>
                                    <img class="sldr-img-wrpr" data-lazy="<?php print isset($img['imageUrl']) ? $img['imageUrl'] : ''; ?>"/>                           
                                    <p class="slide-desc"><?php print isset($img['caption']) ? $img['caption'] : ''; ?></p>
                                 </div>
                                 <?php endforeach; ?> 
                              </div>
                           </div>
                        </div>
                     <?php endif; ?>
                  </div>
               </div>
               
            </div> <!-- end of slider container-->
            
         </div>
      </div>
      
   </div>
</div> <!-- end of modal-->