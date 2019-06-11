<?php
global $base_url;
$insight_theme_path = $base_url.'/'.drupal_get_path('theme', 'insight');
$images_path = $insight_theme_path.'/dist/images/';
$scripts_path = $insight_theme_path.'/dist/scripts/';
?>

<div id="ins-mn-bdy-cntr" class="sml-bnr2">			
    <div id="" class="common jb-ovrvw-fx common head-fix">
        <div class="banner-center-text" data-src="<?php print isset($bannerImageUrl) ? $bannerImageUrl : ''; ?>">
        
            <div class="banner-content">
                <p id="mob-banner-text"><?php echo isset($bannerSlogan) ? $bannerSlogan : '';?></p>
            </div>
        </div>
    </div>

    <div class="stdnt-wrks jb-brd">
        <div class="container">
            <div class="intro-panl">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="cont-sec" id="intro-sec">
                            <div class="cont-head jbrd-head">
                                <h1 class="au-h1-tle"><?php echo isset($introSectionTitle) ? $introSectionTitle : '';?></h1>
                            </div>
                            <div class="cont-body">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-8">
                                        <div class="intr-shcs shcs-bdy">
                                            <p><?php echo isset($introSectionContent) ? $introSectionContent : '';?></p>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-4">
                                        <div class="shcs-bdy prj-submit-bdy">
                                            <p><span class="grd-hl"><?php echo isset($advertisementTitle) ? $advertisementTitle : '';?></span> <?php echo isset($advertisementContent) ? $advertisementContent : ''; ?> 
                                            <a href="mailto:<?php echo isset($advertisementEmail) ? $advertisementEmail : '';?>" target="_top"><?php echo isset($advertisementEmail) ? $advertisementEmail : '';?></a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="jb-brd-psts">
                <?php if (count($jobList) > 0) : ?>
                    <?php $ctr = 1;?>
                    <?php foreach ($jobList as $listItem) :?>
                    <div class="jb-pst<?php echo $ctr%2 === 0 ? ' jb-pst-odd' : '';?>">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="jb-pst-hd">
                                    <div class="row">
                                        <div class="col-xs-5 col-sm-3">
                                            <div class="jb-cmp-lgo-wrp">
                                                <img class="img-responsive" data-src="<?php echo isset($listItem['featureImageUrl']) ? $listItem['featureImageUrl'] : '';?>" alt="<?php echo isset($listItem['featureImageAlt']) ? $listItem['featureImageAlt'] : '';?>" title="<?php echo isset($listItem['featureImageTitle']) ? $listItem['featureImageTitle'] : '';?>">
                                            </div>
                                        </div>
                                        <div class="col-xs-7 col-sm-9">
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <div class="row">
                                                        <div class="col-xs-12 col-sm-8">
                                                            <div class="comp-det">
                                                                <p class="comp-nme text-uppercase"><?php echo isset($listItem['employer']) ? $listItem['employer'] : '';?></p>
                                                                <h3 class="comp-jb"><?php echo isset($listItem['title']) ? $listItem['title'] : '';?></h3>
                                                                <?php if ($listItem['jobDescriptionFileUrl'] != '') : ?>
                                                                <div class="dl-jb-desc hidden-xs">
                                                                    <a href="<?php echo $listItem['jobDescriptionFileUrl']; ?>" class="read-more read" download><?php print t('Download job description');?></a>
                                                                </div>
                                                                <?php endif;?>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-12 col-sm-4">
                                                            <p class="jb-dt"><?php print t('Posted');?> <?php echo $listItem['postDate'];?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 hidden-xs">
                                                    <div class="jb-pst-det">
                                                        <div class="row">
                                                            <div class="col-xs-4 col-sm-3">
                                                                <div class="jb-pst-det-cntnt">
                                                                    <span class="text-uppercase"><?php print t('Type');?></span>
                                                                    <p><?php echo isset($listItem['jobType']) ? $listItem['jobType'] : '';?></p>
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-8 col-sm-3">
                                                                <div class="jb-pst-det-cntnt">
                                                                    <span class="text-uppercase"><?php print t('Career Level');?></span>
                                                                    <p><?php echo isset($listItem['careerLevel']) ? $listItem['careerLevel'] : '';?></p>
                                                                </div>
                                                            </div> 
                                                            <div class="col-xs-4 col-sm-3">
                                                                <div class="jb-pst-det-cntnt">
                                                                    <span class="text-uppercase"><?php print t('Location');?></span>
                                                                    <p><?php echo isset($listItem['location']) ? $listItem['location'] : '';?></p>
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-8 col-sm-3">
                                                                <div class="jb-pst-det-cntnt">
                                                                    <span class="text-uppercase"><?php print t('Salary');?></span>
                                                                    <p><?php echo isset($listItem['salary']) ? $listItem['salary'] : '';?></p>
                                                                </div>
                                                            </div>     
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix hidden-sm hidden-md hidden-lg"></div>
                                        <div class="col-xs-12">
                                            <div class="jb-pst-det hidden-sm hidden-md hidden-lg">
                                                    <div class="row">
                                                    <div class="col-xs-6 col-sm-3">
                                                        <div class="jb-pst-det-cntnt">
                                                            <span class="text-uppercase"><?php print t('Type');?></span>
                                                            <p><?php echo isset($listItem['jobType']) ? $listItem['jobType'] : '';?></p>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-6 col-sm-3">
                                                        <div class="jb-pst-det-cntnt">
                                                            <span class="text-uppercase"><?php print t('Career Level');?></span>
                                                            <p><?php echo isset($listItem['careerLevel']) ? $listItem['careerLevel'] : '';?></p>
                                                        </div>
                                                    </div> 
                                                    <div class="col-xs-6 col-sm-3">
                                                        <div class="jb-pst-det-cntnt">
                                                            <span class="text-uppercase"><?php print t('Location');?></span>
                                                            <p><?php echo isset($listItem['location']) ? $listItem['location'] : '';?></p>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-6 col-sm-3">
                                                        <div class="jb-pst-det-cntnt">
                                                            <span class="text-uppercase"><?php print t('Salary');?></span>
                                                            <p><?php echo isset($listItem['salary']) ? $listItem['salary'] : '';?></p>
                                                        </div>
                                                    </div>      
                                                    <div class="col-xs-6 col-sm-3">
                                                        <div class="jb-pst-det-cntnt dl-jb-desc">
                                                         <a href="<?php echo $listItem['jobDescriptionFileUrl']; ?>" class="read-more read" download><?php print t('Download job description');?></a>
                                                        </div>
                                                    </div>   
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <?php if (intval($listItem['status']) == 0) : ?>
                                       <div class="clsd-notif">
                                           <span class="clsd-notif-txt text-uppercase"><?php print t('Closed');?></span>
                                       </div>
                                    <?php endif;?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php $ctr++;?>
                    <?php endforeach;?>
                <?php endif;?>
            </div>
            
            <?php 
             // Show more button only applied to mobile version.
             // Default number of job items to display is 8.
             ?>
             <?php if ($allJobListSize > 8): ?>
                <div class="ld-mre-pst visible-xs">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="text-right btn-jb-shw-mr-wrp">
                                <a href="javascript:" class="read-more" id="show-more"><?php print t('Show more...');?></a>
                                <input type="hidden" id="currentJobCount" value="8">
                            </div>
                        </div>
                    </div>
                </div>
             <?php endif; ?>
            
            <div class="blog-section hidden-xs">
                <div class="blog-pagination clearfix">
                <?php
                    // Header section
                    $params = array(
                        'allListSize' => $allJobListSize,         
                        'activePage' => $page,
                        'limit' => 8,
                        'href' => "{$base_url}/jobs?",
                    );
                    $block = module_invoke('custompage', 'block_view', 'pagination', $params);
                    print render($block['content']);
                ?>
                </div>
            </div>
        </div>
    </div>
</div>