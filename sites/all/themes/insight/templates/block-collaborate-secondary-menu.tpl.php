<?php if (isset($activePage)) : ?>


<nav class="desk-menu-navbar visible-sm visible-md visible-lg">
    <div class="desk-menu-container container">
    <ul class="nav navbar-nav">
        <?php 

            $linkArr = [
                'student-work' => 'Student Work',
                'partners' => 'Industry Partners',
                'internships' => 'Internships'
            ];

            foreach ($linkArr as $linkKey => $linkVal) {
                ?>
                <li<?php echo $linkKey === $activePage ? ' class="active"' : '';?>>
                    <a href="<?php echo drupal_get_path_alias($linkKey);?>" class="btn btn-ins-white"><?php echo t($linkVal);?></a> 
                </li>
                <?php
            }
        ?>
    </ul>
    </div>
</nav>

<?php endif;?>