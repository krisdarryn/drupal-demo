<div class="row">
   <?php $ctr = 0; ?>

    <?php if (isset($teacherList) && $teacherList && count($teacherList) > 0) :?>

   <?php foreach ($teacherList as $teacher): ?>
        <?php if (!$teacher) {
            continue;
        } ?>
   
      <?php if ($ctr > 0 && fmod($ctr, 2) == 0): ?>
         <div class="clearfix hidden-xs-sm"></div>
      <?php endif; ?>
      
      <div class="col-xs-12 col-sm-6">
        <div class="tchr-img-container<?php echo $totalCount < ($ctr+1) + 2 ? ' last-item' : '';?>" data-nid="<?php print isset($teacher['nid']) ? $teacher['nid'] : ''; ?>">
            <div class="img-bckgrnd" style="background-image: url(<?php print isset($teacher['imageUrl']) ? $teacher['imageUrl'] : ''; ?>)" title="<?php print isset($teacher['imageTitle']) ? $teacher['imageTitle'] : ''; ?>">
            </div>
            <div class="tchr-inf-crd">
                <div class="tchr-holder">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="thcr-nme">
                                <h3><?php print (isset($teacher['firstName']) ? $teacher['firstName'] : '') . ' ' . (isset($teacher['lastName']) ? $teacher['lastName'] : ''); ?></h3>
                            </div>	
                        </div>
                        <div class="col-xs-12">
                            <div class="tchr-pst">
                                <p><?php print isset($teacher['longTitle']) ? $teacher['longTitle'] : ''; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
      
      <?php $ctr++; ?>
   <?php endforeach; ?>
<?php endif;?>
</div>