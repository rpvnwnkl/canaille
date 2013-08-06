<header class="banner navbar navbar-static-top" role="banner">
  <div class="navbar-inner">
    <div class="container-fluid">
     <div class="row-fluid">
      <div class="span12 navbox">
        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </a>
        <nav class="nav-main nav-collapse collapse hidden-desktop" role="navigation">
          <!-- <a id="" class="dropbrand" href="<?php echo home_url(); ?>/">
          Canaille
          </a> -->
            <?php
              if (has_nav_menu('primary_navigation')) :
                wp_nav_menu(array('theme_location' => 'primary_navigation', 'menu_class' => 'nav'));
              endif;
            ?>
          <!-- <form class="navbar-search pull-right form-search">
            <input id="s" type="text" class="search-query" type="submit" placeholder="Canaille Query" name="search">
          </form> -->
          <!--<?php get_template_part('templates/searchform'); ?>-->
        </nav>
        <nav class="nav-main visible-desktop" role="navigation">
          <?php
            if (has_nav_menu('primary_navigation')) :
              wp_nav_menu(array('theme_location' => 'primary_navigation', 'menu_class' => 'nav'));
            endif;
          ?>
          <!-- <form class="navbar-search pull-right form-search">
            <input id="s" type="text" class="search-query" type="submit" placeholder="Canaille Query" name="search">
          </form> -->
          <?php get_template_part('templates/searchform'); ?>
        </nav>
      </div>
    </div>
    </div>
  </div>
  <div class="container-fluid visible-desktop">
    <div class="row-fluid">
      <div class="span12 brandbox">
        <a id="bigtitle" class="brand" href="<?php echo home_url(); ?>/">
          <?php bloginfo('name'); ?>
        </a>
        
      </div>
    </div>
  </div>
  <div class="container-fluid hidden-desktop">
    <div class="row-fluid">
      <div class="span12 brandbox text-center">
        <a id="othertitle" class="smallbrand" href="<?php echo home_url(); ?>/">
          <?php bloginfo('name'); ?>
        </a>
        
      </div>
    </div>
  </div>
    
</header>
