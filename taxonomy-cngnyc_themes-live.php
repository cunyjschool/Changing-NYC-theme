<?php get_header(); ?>

<div class="main">
	
	<?php get_sidebar('left'); ?>		
	
	<div class="wrap float-left">
		
		<?php get_template_part( 'loop', 'tax_live' ); ?>
		
		<div class="clear-both"></div>		

	</div><!-- END .wrap -->

</div><!-- END .main -->

<?php get_footer(); ?>