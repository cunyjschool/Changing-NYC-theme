<?php get_header(); ?>

<div class="main">
	
	<?php get_sidebar('left'); ?>	
	
	<div class="wrap float-left">
		
		<?php get_sidebar('live'); ?>
		
		<?php get_template_part( 'loop', 'single_event' ); ?>
	
		<div class="clear-both"></div>

	</div><!-- END .wrap -->

</div><!-- END .main -->

<?php get_footer(); ?>