
<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class(); ?>>

    <header>
      <h1 class="entry-title"><?php the_title(); ?></h1>
      <?php get_template_part('templates/entry-meta'); ?>
      
    </header>
    <div class="entry-content">
      <?php the_content(); ?>
    </div>
    <hr />
    <!--
    <div class="fb-like" data-href="http://developers.facebook.com/docs/reference/plugins/like" data-send="false" data-layout="button_count" data-width="450" data-show-faces="true"></div>
    <script src="//platform.linkedin.com/in.js" type="text/javascript">
     lang: en_US
    </script>
    <script type="IN/Share"></script>-->
    <!-- Place this tag where you want the share button to render. -->
<!--     <div class="g-plus" data-action="share" data-annotation="bubble"></div> -->

    <!-- Place this tag after the last share tag. -->
    // <script type="text/javascript">
    //   (function() {
    //     var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    //     po.src = 'https://apis.google.com/js/plusone.js';
    //     var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
    //   })();
    // </script>
   <!--  <a href="https://twitter.com/share" class="twitter-share-button" data-via="thephoenixburns" data-hashtags="revolution">Tweet</a>
    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
     -->
    <footer>
      <?php wp_link_pages(array('before' => '<nav class="page-nav"><p>' . __('Pages:', 'roots'), 'after' => '</p></nav>')); ?>
    </footer>

    <?php comments_template('/templates/comments.php'); ?>
  </article>
<?php endwhile; ?>
