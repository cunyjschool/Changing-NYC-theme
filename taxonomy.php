<?php get_header(); ?>

<div class="main">
	
	<?php get_sidebar('left'); ?>	
	
	<div class="wrap">
		
		<?php get_template_part( 'loop', 'tax' ); ?>
	
		<?php get_sidebar(); ?>
	
		<div class="clear-both"></div>

	</div><!-- END .wrap -->

</div><!-- END .main -->

<?php get_footer(); ?>