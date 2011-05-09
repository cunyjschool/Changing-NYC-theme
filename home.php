<?php get_header(); ?>
	
<div class="main">
	
	<?php get_sidebar('left'); ?>
	
	<div class="wrap float-left">
		
		<?php get_sidebar('live'); ?>
		
		<?php if ( cngnyc_get_active_event() ) {
			get_template_part( 'loop', 'home_live' );
		} else {
			get_template_part( 'loop', 'home_all' );
		} ?>
	
		<?php get_sidebar(); ?>
	
		<div class="clear-both"></div>

	</div><!-- END .wrap -->

</div><!-- END .main -->

<?php get_footer(); ?>