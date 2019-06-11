<h1 class="sr-only"><?php print isset($pageTitle) ? $pageTitle : ''; ?></h1>

<div id="ins-mn-bdy-cntr">

   <?php // Banner section ?>
   <div id="" class="common jb-ovrvw-fx common head-fix">
     <div class="banner-center-text" style="background-image: url(<?php print isset($bannerImage) ? $bannerImage['url'] : ''; ?>)">
      <div class="banner-content">
          <p id="mob-banner-text"><?php echo isset($bannerSlogan) ? $bannerSlogan : '';?></p>
      </div>
     </div>
   </div>
   
   <div class="stdnt-wrks jb-brd coming-soon-content">
      <div class="container">
         <div class="intro-panl">
             <div class="row">
                 <div class="col-xs-12">
                     <div class="cont-sec" id="intro-sec">
                         <div class="cont-head jbrd-head">
                             <h3><?php echo isset($headerTitle) ? $headerTitle : '';?></h3>
                         </div>
                         <div class="cont-body">
                           <?php print isset($content) ? $content : ''; ?>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
      </div>
   </div>
</div> <!-- end of bdy cntr-->
