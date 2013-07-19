<time class="updated" datetime="<?php echo get_the_time('c'); ?>" pubdate><?php echo get_the_date(); ?></time>
<p class="byline author vcard"><?php echo __('By', 'roots'); ?> 
	<a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" rel="author" class="fn"><?php echo get_the_author(); ?>
	</a>
</p>
	  <meta name="twitter:card" content="summary">

      <meta name="twitter:site" content="@thephoenixburns">

      <meta name="twitter:title" content="text/html; <?php get_the_title(); ?>">

      <meta name="twitter:description" content="text/html; <?php get_the_excerpt(); ?>">

      <meta name="twitter:image" content="text/html;<?php get_the_post_thumbnail(); ?>">

      <meta name="author" content="text/html; <?php get_the_author(); ?>">

      <meta name="datetime" content="text/html; <?php get_the_time('c'); ?><?php get_the_date(); ?>">

      
