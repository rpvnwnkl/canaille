<header class="banner" role="banner">
  
  <div class="container">
    <div class="row-fluid">
      <div class="span12">
        <nav class="nav-main" role="navigation">
          <?php
            if (has_nav_menu('primary_navigation')) :
              wp_nav_menu(array('theme_location' => 'primary_navigation', 'menu_class' => 'nav nav-pills'));
            endif;
          ?>
        </nav>
      </div>
    </div>
      <div class="row-fluid">
        <div class="span12">
          <a class="brand" href="<?php echo home_url(); ?>/"><?php bloginfo('name'); ?></a>
        </div>
      </div>
  </div>
</header>