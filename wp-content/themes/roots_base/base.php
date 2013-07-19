<?php get_template_part('templates/head'); ?>
<body <?php body_class(); ?>>
  <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=311900145614150";
      fjs.parentNode.insertBefore(js, fjs);
    }
    (document, 'script', 'facebook-jssdk'));
    </script>
  <!--[if lt IE 7]><div class="alert"><?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'roots'); ?></div><![endif]-->
  <div class="container-fluid fullboat">  
    <div class="row-fluid PCbrand">
    </div>
  </div>
  <?php
    do_action('get_header');
    // Use Bootstrap's navbar if enabled in config.php
    if (current_theme_supports('bootstrap-top-navbar')) {
      get_template_part('templates/header-top-navbar');
    } else {
      get_template_part('templates/header'); 
    }
  ?>

  <div class="wrap container-fluid" role="document">
    <div class="content row-fluid">
      <div class="main <?php echo roots_main_class(); ?>" role="main">
        <?php include roots_template_path(); ?>
      </div><!-- /.main -->
      <?php if (roots_display_sidebar()) : ?>
        <div class="<?php echo roots_sidebar_class(); ?>">

          <aside class="sidebar span12" role="complementary">
            <div class="span12 text-center mob">
            <h1>Canaille Culture<br /> is <br />Mob Culture</h1>
            <hr />
             </div>
            <?php include roots_sidebar_path(); ?>

          </aside>
        </div><!-- /.sidebar -->
      <?php endif; ?>
    </div><!-- /.content -->
  </div><!-- /.wrap -->

  <?php get_template_part('templates/footer'); ?>

</body>
</html>
