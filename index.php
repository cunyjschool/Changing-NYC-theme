<?php get_header(); ?>

<div class="main">
	
	<?php get_sidebar('left'); ?>	
	
	<div class="wrap float-left">
		
		<?php get_template_part( 'loop', 'index' ); ?>
	
		<div class="clear"></div>

	</div><!-- END .wrap -->

</div><!-- END .main -->

<?php get_footer(); ?>