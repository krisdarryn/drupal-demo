<?php global $base_url; ?>

<div class="login-outer-wrap">
   <div class="insight-user-login-form-wrapper">
      <?php print drupal_render_children($form) ?>
      <p class="forget-pass-link"><a href='<?php print $base_url; ?>/user/password'><?php print t('Forgot username or password?'); ?></a></p>
   </div>
</div>