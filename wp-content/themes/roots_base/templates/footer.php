
<footer class="content-info" role="contentinfo">
<header class="banner navbar navbar-static-bottom" role="banner">
  <div class="navbar-inner navbar-inner-footer">
    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span12">
            <!-- <a class="btn btn-navbar hidden-phone" data-toggle="collapse" data-target=".nav-collapse">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              Menu
            </a> -->
            <a class="brand-footer" href="<?php echo home_url(); ?>/">
              <?php bloginfo('name'); ?>
            </a>
      <nav class="nav-foot footer-nav dropup text-center clearfix" role="navigation">
        <?php
          if ((has_nav_menu('footmenu')) or (has_nav_menu('custom1'))) :
            wp_nav_menu(array('theme_location' => 'footmenu', 'menu_class' => 'nav'));
          endif;
        ?>

      </nav>
       <p class="pull-right visible-desktop">&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?></p>
       <p class="text-center hidden-desktop">&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?></p>

   </div>
        </div>
    </div>
  </div>
</header>


  <!-- <div class="container-fluid">
	<div class="row-fluid">
	    <div class="span12">
    		<ul class="inline dropdown"><?php dynamic_sidebar('sidebar-footer'); ?></ul>
		    <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?></p>
		</div>
	</div>
  </div> -->

</footer>

<?php wp_footer(); ?>
<script>
          jQuery("#bigtitle").fitText(1.0);
          jQuery("#othertitle").fitText(1.0);
          jQuery(".entry-title").fitText(1.0);

          $('.typeahead').typeahead();
        </script>
