<?php
   if (! isset($baseUrl)) {
      global $base_url;
      $baseUrl = $base_url;
   }
?>

<?php if (isset($activePage)) : ?>
   <nav class="desk-menu-navbar visible-sm visible-md visible-lg">
       <div class="desk-menu-container container">
       <ul class="nav navbar-nav">
           <?php 

               $linkArr = [
                   'about' => 'About',
                   'staff' => 'Teachers',
                   'graduates' => 'Graduates',
                   'press' => 'Press',
                   'scholarship' => 'Scholarship',
                   'blog' => 'Blog'
               ];

               foreach ($linkArr as $linkKey => $linkVal) {
                   ?>
                   <li<?php echo $linkKey === $activePage ? ' class="active"' : '';?>>
                       <a href="<?php echo $baseUrl . '/' . $linkKey; ?>" class="btn btn-ins-white"><?php echo t($linkVal); ?></a> 
                   </li>
                   <?php
               }
           ?>
       </ul>
       </div>
   </nav>
<?php endif;?>