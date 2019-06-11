<?php
global $base_url;
$images_path = $base_url . '/' . drupal_get_path('theme', 'insight') . '/dist/images/';
?>


<div id="ins-mn-bdy-cntr">
    <div id="" class="common head-fix">
        <div class="banner-center-text" data-src="<?php echo isset($bannerImageUrl) ? $bannerImageUrl : '';?>">
        
            <div class="banner-content">
                <p id="mob-banner-text"><?php echo isset($bannerSlogan) ? $bannerSlogan : '';?></p>
            </div>
        </div>

        <?php
            $params = array(
               'activePage' => 'student-work'
            );
            $block = module_invoke('custompage', 'block_view', 'collaborate-secondary-menu', $params);
            print render($block['content']);
        ?>
    </div>

    <div class="stdnt-wrks">
        <div class="container">
            <div class="intro-panl">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="cont-sec" id="intro-sec">
                            <div class="cont-head">
                                <h2 class="au-h1-tle"><?php echo isset($introTitle) ? $introTitle : '';?></h2>
                            </div>
                            <div class="cont-body">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-8">
                                        <div class="intr-shcs shcs-bdy">
                                            <p><?php echo isset($introDescription) ? $introDescription : '';?></p>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-4">
                                        <div class="shcs-bdy prj-submit-bdy">
                                            <p><span class="grd-hl"><?php echo isset($submitProjectTitle) ? $submitProjectTitle : '';?></span></p>
                                            <?php echo isset($submitProjectDescription) ? $submitProjectDescription : '';?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hidden-xs hidden-sm shcs-bdy">
                <div class="brk"></div> 
            </div>
            <div class="shcs-pnl">
                <div class="rsdncial-schcs">
                    <div class="shcs-bdy schcs-title">
                        <h1 class="std-wrk-h1-tle"><?php print t('Residential Interior Design Projects');?></h1>
                    </div>
                    <div class="row">
                        <?php if (count($residentialProjects ) > 0) : ?>
                            <?php $ctr = 1;?>
                            <?php foreach ($residentialProjects as $project) : ?>
                                <div class="col-xs-12 col-sm-4 add-hover proj" data-nid="<?php print isset($project['nid']) ? $project['nid'] : ''; ?>">
                                    <div class="shcs-bdy stnt-shcs">
                                       <div class="shcs-bdy-img-hlder shcs-bdy-img-hlder-spc" data-src="<?php echo isset($project['coverImageUrl']) ? $project['coverImageUrl'] : '';?>">
                                          <img class="img-responsive hidden-sm hidden-md hidden-lg" data-src="<?php echo isset($project['coverImageUrl']) ? $project['coverImageUrl'] : '';?>" alt="<?php echo $project['coverImageAlt'];?>" title="<?php echo $project['coverImageTitle'];?>">
                                       </div>
                                       <p><?php echo isset($project['projectName']) ? $project['projectName'] : '';?> <span class="grd-hl"><?php echo (isset($project['projectLocation']) && $project['projectLocation'] != '') ? "{$project['projectLocation']}, " : '';?><?php echo isset($project['dateCreated']) ? $project['dateCreated'] : '';?></span></p>
                                    </div>
                                </div>

                                <?php if ($ctr > 0 && $ctr % 3 === 0) : ?>
                                    <div class="clearfix hidden-xs"></div>
                                <?php endif;?>

                                <?php $ctr++;?>
                            <?php endforeach;?>
                        <?php endif;?>
                        
                        <?php if ($allResProjListSize > 3) : ?>
                           <div class="col-xs-12">
                               <div class="shcs-bdy text-right">
                                   <a href="#" id="btnLoadMoreResProj" class="read-more"><?php print t('See more');?> <span class="hidden-xs"><?php print t('Residential Interior Design Projects');?></span></a>
                                   <input type="hidden" id="residentialProjCount" value="3">
                               </div>
                           </div>
                        <?php endif;?>
                    </div>
                </div>
                <div class="brk cmrcl-brk"></div>
                <div class="cmrcial-schcs">
                    <div class="shcs-bdy schcs-title" id="cmmrcl-div">    
                        <h2 class="std-wrk-h1-tle"><?php print t('Commercial Interior Design Projects');?></h2>
                    </div> 
                    <div class="row">
                        <?php if (count($commercialProjects) > 0) : ?>
                            <?php $ctr = 1;?>
                            <?php foreach ($commercialProjects  as $project) : ?>
                                 <div class="col-xs-12 col-sm-4 add-hover proj" data-nid="<?php print isset($project['nid']) ? $project['nid'] : ''; ?>">
                                    <div class="shcs-bdy stnt-shcs">
                                        <div class="shcs-bdy-img-hlder shcs-bdy-img-hlder-spc" data-src="<?php echo isset($project['coverImageUrl']) ? $project['coverImageUrl'] : '';?>">
                                            <img class="img-responsive hidden-sm hidden-md hidden-lg" data-src="<?php echo isset($project['coverImageUrl']) ? $project['coverImageUrl'] : '';?>" alt="<?php echo isset($project['coverImageAlt']) ? $project['coverImageAlt'] : '';?>" title="<?php echo isset($project['coverImageTitle']) ? $project['coverImageTitle'] : '';?>">
                                        </div>
                                        <p><?php echo isset($project['projectName']) ? $project['projectName'] : '';?> <span class="grd-hl"><?php echo (isset($project['projectLocation']) && $project['projectLocation'] != '') ? "{$project['projectLocation']}, " : '';?><?php echo isset($project['dateCreated']) ? $project['dateCreated'] : '';?></span></p>
                                    </div>
                                </div>

                                <?php if ($ctr > 0 && $ctr % 3 === 0) : ?>
                                    <div class="clearfix hidden-xs"></div>
                                <?php endif;?>

                                <?php $ctr++;?>
                            <?php endforeach;?>
                        <?php endif;?>
                        
                        <?php if ($allComProjListSize > 3) : ?>
                           <div class="col-xs-12">
                               <div class="shcs-bdy text-right">
                                   <a href="#" id="btnLoadMoreComProj" class="read-more"><?php print t('See more');?> <span class="hidden-xs"><?php print t('Commercial Interior Design Projects');?></span></a>
                                   <input type="hidden" id="commercialProjCount" value="3">
                               </div>
                           </div>
                        <?php endif;?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="mdl-wrap"></div>
</div>