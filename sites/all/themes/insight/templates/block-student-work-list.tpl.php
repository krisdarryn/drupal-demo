<?php if (isset($projectList) && count($projectList ) > 0) : ?>
   <?php $ctr = 1;?>
      <?php foreach ($projectList as $project) : ?>
      <?php if (!$project) {
            continue;
          }?>
      <div class="col-xs-12 col-sm-4 proj" data-nid="<?php print isset($project['nid']) ? $project['nid'] : ''; ?>">
         <div class="shcs-bdy">
            <div class="shcs-bdy-img-hlder">
               <img  class="img-responsive center-block" src="<?php echo isset($project['coverImageUrl']) ? $project['coverImageUrl'] : '';?>" alt="<?php echo isset($project['coverImageAlt']) ? $project['coverImageAlt'] : '';?>" title="<?php echo isset($project['coverImageTitle']) ? $project['coverImageTitle'] : '';?>">
            </div>
            <p><?php echo isset($project['projectName']) ? $project['projectName'] : '';?> <span class="grd-hl"><?php echo (isset($project['projectLocation']) && $project['projectLocation'] != '') ? "{$project['projectLocation']}, " : '';?><?php echo isset($project['dateCreated']) ? $project['dateCreated'] : '';?></span></p>
         </div>
      </div>

      <?php if ($ctr > 0 && $ctr % 3 === 0) : ?>
         <div class="clearfix hidden-xs hidden-sm"></div>
      <?php endif;?>

      <?php $ctr++;?>
   <?php endforeach;?>
<?php endif;?>