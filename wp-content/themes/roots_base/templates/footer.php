
<header class="banner navbar navbar-static-bottom" role="banner">
  <div class="navbar-inner navbar-inner-footer">
    <div class="container-fluid">
      <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
      <a class="brand-footer" href="<?php echo home_url(); ?>/">
        <?php bloginfo('name'); ?>
      </a>
      <nav class="nav-foot nav-collapse collapse footer-nav dropup" role="navigation">
        <?php
          if ((has_nav_menu('footmenu')) or (has_nav_menu('custom1'))) :
            wp_nav_menu(array('theme_location' => 'footmenu', 'menu_class' => 'nav'));
          endif;
        ?>

      </nav>
      <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?></p>
    </div>
  </div>
</header>

<footer class="content-info" role="contentinfo">
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
        </script>
