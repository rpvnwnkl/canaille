<footer class="content-info" role="contentinfo">
  <div class="container-fluid">
	<div class="row-fluid">
	    <div class="span12">
    		<ul class="inline dropdown"><?php dynamic_sidebar('sidebar-footer'); ?></ul>
		    <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?></p>
		</div>
	</div>
  </div>

</footer>

<?php wp_footer(); ?>
<script>
          jQuery("#bigtitle").fitText(1.0);
          jQuery("#othertitle").fitText(1.0);
        </script>
