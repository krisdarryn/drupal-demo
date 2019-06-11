<div class="row">
   <?php $ctr = 0; ?>

    <?php if (isset($graduateList)) : ?>

   <?php foreach ($graduateList as $graduate): ?>
   
      <?php if ($ctr > 0 && fmod($ctr, 2) == 0): ?>
         <div class="clearfix hidden-xs-sm"></div>
      <?php endif; ?>
      
      <div class="col-xs-12 col-sm-6">
        <div class="tchr-img-container<?php echo isset($totalCount) && $totalCount < ($ctr+1) + 2 ? ' last-item' : '';?>" data-nid="<?php print isset($graduate['nid']) ? $graduate['nid'] : ''; ?>">
            <div class="img-bckgrnd" style="background-image: url(<?php print isset($graduate['profileImageUrl']) ? $graduate['profileImageUrl'] : ''; ?>)" title="<?php print isset($graduate['profileImageTitle']) ? $graduate['profileImageTitle'] : ''; ?>">
            </div>
            <div class="tchr-inf-crd grdt-inf-crd">
                <div class="tchr-holder">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="thcr-nme">
                                <h3><?php print (isset($graduate['firstName']) ? $graduate['firstName'] : '') . ' ' . (isset($graduate['lastName']) ? $graduate['lastName'] : ''); ?></h3>
                            </div>	
                        </div>
                        <div class="col-xs-12">
                            <div class="tchr-pst">
                                <p><?php print isset($graduate['occupation']) ? $graduate['occupation'] : ''; ?></p>
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