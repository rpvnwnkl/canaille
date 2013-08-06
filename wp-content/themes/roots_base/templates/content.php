<article <?php post_class(); ?>>
  
  <?php if (has_post_thumbnail()) : ?>
	<div class="row-fluid">
	  	<div class="span12">
	  		<div class="row-fluid">
	  			<div class="head-bg">
		  			<div class="span12 left-shift">
		  				<div class="row-fluid visible-desktop">
							<div class="span8">
								<header>
								    <a href="<?php the_permalink(); ?>"><h1 class="entry-title"><?php the_title(); ?></h1></a>
							    </header>
							</div>
						</div>
							<header class="hidden-desktop">
							    <a href="<?php the_permalink(); ?>"><h1 class="entry-title"><?php the_title(); ?></h1></a>
						    </header>
					</div>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span8">
				    <h4 class="entry-cats"><a href="<?php get_category_link(); ?>"><?php the_category('&#8194;/&#8194;'); ?></a></h4>
				    <?php get_template_part('templates/entry-meta'); ?>
					    <div class="entry-summary">
						    <?php the_excerpt(); ?>
						</div>
				</div>
				<div class="span4">
					<div class="entry-thumbnail">
						<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
					</div>
				</div>
			</div>
	    </div>
    </div> 
  <?php else : ?>
    <header>
	    <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		    <?php get_template_part('templates/entry-meta'); ?>
    </header>
	<div class="entry-summary">
	    <?php the_excerpt(); ?>
	</div>
  <?php endif; ?>
</article>
