<?php get_header(); ?>

<div class="main">
	
	<?php get_sidebar('left'); ?>
	
	<div class="wrap">
		
		<div class="content">
			
		<?php $theme_terms = get_terms( 'cngnyc_themes', $args ); ?>
		
		<?php foreach ( $theme_terms as $single_term ) : ?>
			
			<?php if ( !empty( $single_term->description ) ): ?>
				<div class="theme-description float-right"><?php echo $single_term->description; ?></div>
			<?php endif; ?>
			
			<h2><a href="<?php bloginfo('url'); ?>/<?php echo cngnyc_get_term_base( $single_term ) . '/' . $single_term->slug . '/'; ?>"><?php echo $single_term->name; ?></a></h2>
			
			
			<div class="clear-both"></div>
			
		<?php endforeach; ?>

		</div><!-- END .content -->
	
		<?php get_sidebar(); ?>
	
		<div class="clear"></div>

	</div><!-- END .wrap -->

</div><!-- END .main -->

<?php get_footer(); ?>