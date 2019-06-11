<?php
// Needed parameters are $allListSize and $activePage
?>

<?php if (isset($allListSize) && isset($activePage) && isset($limit) && isset($href) && count($allListSize) > 0) { ?>
   <nav class="pull-right" aria-label="Page navigation">
        <ul class="pagination">
            <?php 
                $pageCount = ceil($allListSize / $limit);
                $startCount = 1;
                $addBreakCount = 4;
                $breakFlag = false;
                $extFlag = true;
                $breakCount = $activePage + 4;
                if ($pageCount > 8) {

                    if ($activePage - 2 > 1) {
                        $startCount = $activePage - 2;
                    } else if (($pageCount - ($activePage+2)) <= 3) {
                        $extFlag = false;
                        $startCount = $pageCount - 7;
                    }

                    $breakCount = $startCount + 4;
                }
            ?>

            <?php for ($i = $startCount; $i <= $pageCount; $i++) :?>
               <li <?php echo $i === $activePage ? 'class="active"' : '';?>>
                  
                  <?php if (isset($isUpcomingEventPagination) && $isUpcomingEventPagination): ?>
                  
                     <?php if ($i == 1): ?>
                        <a<?php echo $i === $breakCount && $extFlag ? ' class=""' : ''; ?> href="<?php echo drupal_get_path_alias(rtrim($href, '?')); ?>"><?php echo $i;?></a>
                     <?php else: ?>
                        <a<?php echo $i === $breakCount && $extFlag ? ' class=""' : ''; ?> href="<?php echo drupal_get_path_alias($href); ?>type=upcoming&page=<?php echo $i;?>"><?php echo $i;?></a>
                     <?php endif; ?>
                     
                  <?php elseif (isset($isPastEventPagination) && $isPastEventPagination): ?>
                     
                     <?php if ($i == 1): ?>
                        <a<?php echo $i === $breakCount && $extFlag ? ' class=""' : ''; ?> href="<?php echo drupal_get_path_alias(rtrim($href, '?')); ?>"><?php echo $i;?></a>
                     <?php else: ?>
                        <a<?php echo $i === $breakCount && $extFlag ? ' class=""' : ''; ?> href="<?php echo drupal_get_path_alias($href); ?>type=past&page=<?php echo $i;?>"><?php echo $i;?></a>
                     <?php endif; ?>
                     
                  <?php else: ?>
                     <a<?php echo $i === $breakCount && $extFlag ? ' class=""' : ''; ?> href="<?php echo drupal_get_path_alias($href); ?>page=<?php echo $i;?>"><?php echo $i;?></a>
                  <?php endif; ?>
               </li>
                <?php 
                    if ($i === $breakCount && $pageCount > $breakCount) {
                        $breakFlag = true;
                        break;
                    }
                ?>
            <?php endfor;?>

            <?php if ($breakFlag) : ?>
                <?php if ($extFlag) : ?>
                <li><span class="extender">...</span></li><li>
                <?php endif;?>
                <?php for ($i = ($pageCount - 2); $i <= $pageCount; $i++): ?>
                    <?php if ($i > ($activePage+2)) : ?>
                        <li><a<?php echo $i === $pageCount ? ' class="last"' : ''; ?> href="<?php echo $href; ?>page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                    <?php endif;?>
                <?php endfor;?>
            <?php endif;?>
        </ul>
   </nav>
<?php } ?>