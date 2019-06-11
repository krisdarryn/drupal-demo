<?php
/**
* $messages (array)
* $msgType: success/error/warning
*
* Sample data structure of $messages
*    $messages = array(
         'success' => array('Success msg1', 'Success msg2', 'Success msg3'),
         'warning' => array('warning msg1', 'warning msg2', 'warning msg3'),
         'error' => array('error msg1', 'error msg2', 'error msg3'),
      );
*/
?>


<?php if (isset($messages) && is_array($messages)) : ?>

<?php foreach ($messages as $msgType => $msgList): ?>

   <?php if (!($msgType && $msgList && is_array($msgList))) {
         continue;
   }?>

   <div class="alert alert-block alert-<?php print ($msgType == 'error') ? 'danger' : $msgType; ?> messages <?php print ($msgType == 'success') ? 'status' : $msgType; ?>">
      <a class="close" data-dismiss="alert" href="#">×</a>
      
      <?php if (count($msgList) > 1): ?>
         <ul>
         <?php foreach ($msgList as $msg): ?>
            <li><?php print $msg; ?></li>
         <?php endforeach; ?>
         </ul>
      <?php else: ?>
         <?php print $msgList[0]; ?>
      <?php endif; ?>
      
   </div>
<?php endforeach; ?>

<?php endif;?>