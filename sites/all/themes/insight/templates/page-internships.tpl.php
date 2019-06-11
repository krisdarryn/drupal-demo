<?php
global $base_url;
$insight_theme_path = $base_url.'/'.drupal_get_path('theme', 'insight');
$images_path = $insight_theme_path.'/dist/images/';
$scripts_path = $insight_theme_path.'/dist/scripts/';
?>


<div id="ins-mn-bdy-cntr">
    <div id="" class="common head-fix">
      <div class="banner-center-text" data-src="<?php print isset($bannerImageUrl) ? $bannerImageUrl : ''; ?>">
         <div class="banner-content">
            <p id="mob-banner-text"><?php print isset($bannerSlogan) ? $bannerSlogan : ''; ?></p>
         </div>
      </div>

        <?php
            $params = array(
                'activePage' => 'internships'
            );
            $block = module_invoke('custompage', 'block_view', 'collaborate-secondary-menu', $params);
            print render($block['content']);
        ?>
    </div>


    <div class="stdnt-wrks intrnshp">
        <div class="container">
            <div class="intro-panl">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="cont-sec" id="intro-sec">
                            <div class="cont-head">
                                <h1 class="au-h1-tle"><?php echo isset($introTitle) ? $introTitle: '';?></h1>
                            </div>
                            <div class="cont-body">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-8">
                                        <div class="intr-shcs shcs-bdy add-readmore intrshp-desc-wrp" <?php echo isset($introDescription) && strlen($introDescription) > 100 ? ' data-rm-f="1"' : '';?>>
                                            <p><?php echo isset($introDescription) ? $introDescription: '';?></p>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-4">
                                        <div class="shcs-bdy prj-submit-bdy">
                                            <p><span class="grd-hl"><?php echo isset($advertisementTitle) ? $advertisementTitle: '';?></span> <?php echo isset($advertisementContent) ? $advertisementContent: '';?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php if (isset($galleries) && count($galleries) > 0) : ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="slider-container intr-shp-sldr-wrp">
                        <div class="slider-section">
                            <?php foreach ($galleries as $galleryItem) :?>
                                <div>
                                    <img class="sldr-img-wrpr" data-lazy="<?php print isset($galleryItem['imageUrl']) ? $galleryItem['imageUrl']: ''; ?>"/>
                                    <p class="slide-desc"><?php echo isset($galleryItem['caption']) ? $galleryItem['caption']: '';?></p>
                                </div>
                            <?php endforeach;?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif;?>


        <?php if (isset($companies) && count($companies) > 0) : ?>
        <div class="container">
            <div class="row">
                <div class="comp-bdy center-block">
                    <?php $ctr = 1;?>
                    <?php foreach ($companies as $company) : ?>
                        <div class="col-xs-6 cstm-col-sm-2">
                            <div class="grd-img">
                              <span class="helper"></span>
                                <img class="" data-src="<?php echo isset($company['imageUrl']) ? $company['imageUrl']: '';?>" alt="<?php echo isset($company['imageAlt']) ? $company['imageAlt']: '';?>" title="<?php echo isset($company['imageTitle']) ? $company['imageTitle']: '';?>">
                            </div>
                        </div>

                        <?php if (fmod($ctr, 5) == 0) : ?>
                            <div class="clearfix hidden-xs"></div>
                        <?php endif;?>
                        
                        <?php if (fmod($ctr, 2) == 0) : ?>
                            <div class="clearfix visible-xs"></div>
                        <?php endif;?>

                        <?php $ctr++;?>
                    <?php endforeach;?>
                </div>
            </div>
        </div>
        <?php endif;?>
    </div>
</div>