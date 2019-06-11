<?php
global $base_url;
$images_path = $base_url .'/' .drupal_get_path('theme', 'insight') . '/dist/images/';
?>

<div id="ins-mdl" class="modal fade" role="dialog">
   <div class="modal-dialog modal-xl">
      <!-- Modal content-->
      <div class="modal-content" id="ins-mdl-cntnt">
      
         <?php // Cover image for desktop ?>
         <div class="modal-header ins-mdl2-hdr hidden-xs" id="ins-mdl-hdr" style="background-image: url(<?php print isset($coverImageDesktop) ? $coverImageDesktop['url'] : ''; ?>); background-repeat: no-repeat; background-size:cover;background-position:center;">
            <div class="container">
               <button type="button" class="close" data-dismiss="modal" id="ins-mdl-cls-btn">&times;</button>
               <h4 class="modal-title ins-mdl2-title" id="ins-mdl-title"><?php print isset($headerTitle) ? $headerTitle : ''; ?></h4>
               <div class="grd-nme">
                  <?php print isset($firstName) ? $firstName : ''; ?> <span class="grd-hl"><?php print isset($lastName) ? $lastName : ''; ?></span>
               </div>
            </div>
         </div>
         
         <?php // Cover image for mobile ?>
         <div class="modal-header ins-mdl2-hdr visible-xs" id="ins-mdl-hdr" style="background-image: url(<?php print isset($coverImageMobile) ? $coverImageMobile['url'] : ''; ?>); background-repeat: no-repeat; background-size:cover;background-position:center;">
            <div class="container">
               <button type="button" class="close" data-dismiss="modal" id="ins-mdl-cls-btn">&times;</button>
               <h4 class="modal-title ins-mdl2-title" id="ins-mdl-title"><?php print isset($headerTitle) ? $headerTitle : ''; ?></h4>
               <div class="grd-nme">
                  <?php print isset($firstName) ? $firstName : ''; ?> <span class="grd-hl"><?php print isset($lastName) ? $lastName : ''; ?></span>
               </div>
            </div>
         </div>
         
			<div class="ins-mdl-bdy ins-mdl-grd container" id="ins-grdt-det">
				<div class="grd-inf-det">
					<div class="row">
						<div class="col-xs-12">
							<div class="grd-title">
									<?php print isset($occupation) ? $occupation : ''; ?> <span class="grd-hl"><?php print isset($company) ? $company : ''; ?></span>
							</div>
						</div>
						<div class="col-xs-12">
							<div class="motto-sec grd-dtl-motto-sec">
									<div class="motto-bdy">
										<div class="opn-qt hidden-xs">
												<img  class="img-responsive" src="<?php print $images_path; ?>open-quote.svg" alt="open quote svg">
										</div>
										<div class="qt-msg-holder">
												<?php print isset($motto) ? $motto : ''; ?>
										</div>
										<div class="cls-qt hidden-xs">
												<img  class="img-responsive" src="<?php print $images_path; ?>close-quote.svg" alt="close quote svg">
										</div>
									</div>
							</div>
						</div>

						<?php if (isset($biographyList[0])): ?>
						<div class="col-xs-12 col-sm-10">
								<div class="grd-inf">
									<div class="grd-inf-sec">
										<p class="grd-hl"><?php print isset($biographyList[0]['title']) ? $biographyList[0]['title'] : ''; ?></p>
									</div>
									<div class="grd-inf-sec grd-inf-desc">
										<div class="desc"<?php echo isset($biographyList[0]['content']) && strlen($biographyList[0]['content']) > 100 ? ' data-rm-f="1"' : '';?>>
											<?php print isset($biographyList[0]['content']) ? $biographyList[0]['content'] : ''; ?>
										</div>
									</div>
								</div>
						</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
			<div class="container-fluid">
				<?php if (isset($workList) && $workList): ?>
				<div class="col-xs-12">
					<div class="slider-container" id="grd-mdl-sldr">
						<div class="slider-section">
							<?php foreach ($workList as $img): ?>
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
			
			<div class="ins-mdl-bdy ins-mdl-grd container toBeToggled" id="ins-grdt-det">
				<div class="row">
				<div class="grd-inf-det">
				<?php if (isset($biographyList[1])): ?>
					<div class="col-xs-12 col-sm-10">
						<div class="grd-inf mdl-btm-text">
							<div class="grd-inf-sec">
								<p class="grd-hl"><?php print isset($biographyList[1]['title']) ? $biographyList[1]['title'] : ''; ?></p>
							</div>
							<div class="grd-inf-sec">
								<p><?php print isset($biographyList[1]['content']) ? $biographyList[1]['content'] : ''; ?></p>
							</div>
						</div>
					</div>
				<?php endif; ?>
				</div>
				</div>
			</div>
      </div>
   </div>
</div>