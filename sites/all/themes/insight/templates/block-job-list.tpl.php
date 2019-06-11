<?php $ctr = 1;?>

<?php if (isset($jobList)) : ?>

<?php foreach ($jobList as $job) :?>
   <div class="jb-pst<?php echo (fmod($ctr, 2) == 0) ? ' jb-pst-odd' : '';?>">
      <div class="row">
          <div class="col-xs-12">
              <div class="jb-pst-hd">
                  <div class="row">
                      <div class="col-xs-5 col-sm-3">
                          <div class="jb-cmp-lgo-wrp">
                              <img class="img-responsive" src="<?php echo isset($job['featureImageUrl']) ? $job['featureImageUrl'] : '';?>" alt="<?php echo isset($job['featureImageAlt']) ? $job['featureImageAlt'] : '';?>" title="<?php echo isset($job['featureImageTitle']) ? $job['featureImageTitle'] : '';?>">
                          </div>
                      </div>
                      <div class="col-xs-7 col-sm-9">
                          <div class="row">
                              <div class="col-xs-12">
                                  <div class="row">
                                      <div class="col-xs-12 col-sm-8">
                                          <div class="comp-det">
                                              <p class="comp-nme text-uppercase"><?php echo isset($job['employer']) ? $job['employer'] : ''; ?></p>
                                              <h3 class="comp-jb"><?php echo isset($job['title']) ? $job['title'] : ''; ?></h3>
                                              <?php if ($job['jobDescriptionFileUrl'] != '') : ?>
                                              <div class="dl-jb-desc hidden-xs">
                                                  <a href="<?php echo isset($job['jobDescriptionFileUrl']) ? $job['jobDescriptionFileUrl'] : ''; ?>" class="read-more read" download><?php echo t('Download job description');?></a>
                                              </div>
                                              <?php endif; ?>
                                          </div>
                                      </div>
                                      <div class="col-xs-12 col-sm-4">
                                          <p class="jb-dt text-uppercase"> <?php echo t('Posted: ') .  isset($job['postDate']) ? $job['postDate'] : ''; ?></p>
                                      </div>
                                  </div>
                              </div>
                              <div class="col-xs-12 hidden-xs">
                                  <div class="jb-pst-det">
                                      <div class="row">
                                          <div class="col-xs-6 col-sm-3">
                                              <div class="jb-pst-det-cntnt">
                                                  <span class="text-uppercase"><?php echo t('Type'); ?></span>
                                                  <p><?php echo isset($job['jobType']) ? $job['jobType'] : ''; ?></p>
                                              </div>
                                          </div>
                                          <div class="col-xs-6 col-sm-3">
                                              <div class="jb-pst-det-cntnt">
                                                  <span class="text-uppercase"><?php echo t('Career Level'); ?></span>
                                                  <p><?php echo isset($job['careerLevel']) ? $job['careerLevel'] : ''; ?></p>
                                              </div>
                                          </div> 
                                          <div class="col-xs-6 col-sm-3">
                                              <div class="jb-pst-det-cntnt">
                                                  <span class="text-uppercase"><?php echo t('Location'); ?></span>
                                                  <p><?php echo isset($job['location']) ? $job['location'] : ''; ?></p>
                                              </div>
                                          </div>
                                          <div class="col-xs-6 col-sm-3">
                                              <div class="jb-pst-det-cntnt">
                                                  <span class="text-uppercase"><?php echo t('Salary'); ?></span>
                                                  <p><?php echo isset($job['salary']) ? $job['salary'] : ''; ?></p>
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
                                          <span class="text-uppercase"><?php echo t('Type'); ?></span>
                                          <p><?php echo isset($job['jobType']) ? $job['jobType'] : ''; ?></p>
                                      </div>
                                  </div>
                                  <div class="col-xs-6 col-sm-3">
                                      <div class="jb-pst-det-cntnt">
                                          <span class="text-uppercase"><?php echo t('Career Level');?></span>
                                          <p><?php echo isset($job['careerLevel']) ? $job['careerLevel'] : '';?></p>
                                      </div>
                                  </div> 
                                  <div class="col-xs-6 col-sm-3">
                                      <div class="jb-pst-det-cntnt">
                                          <span class="text-uppercase"><?php echo 'Location';?></span>
                                          <p><?php echo isset($job['location']) ? $job['location'] : '';?></p>
                                      </div>
                                  </div>
                                  <div class="col-xs-6 col-sm-3">
                                      <div class="jb-pst-det-cntnt">
                                          <span class="text-uppercase"><?php echo t('Salary');?></span>
                                          <p><?php echo isset($job['salary']) ? $job['salary'] : '';?></p>
                                      </div>
                                  </div>      
                                  </div>
                          </div>
                      </div>
                  </div>
                  
                  <?php if (intval($job['status']) == 0) : ?>
                     <div class="clsd-notif">
                         <span class="clsd-notif-txt text-uppercase"><?php echo t('Closed');?></span>
                     </div>
                  <?php endif;?>
              </div>
          </div>
      </div>
   </div>
   <?php $ctr++;?>
<?php endforeach;?>
<?php endif;?>