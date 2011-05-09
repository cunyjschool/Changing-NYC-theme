<div class="content">
	
<?php if ( have_posts() ) : while (have_posts()) : the_post(); ?>
	
<div class="post live-event">				
	
	<h2><?php the_title() ?></h2>
	<?php $term_list = get_the_term_list( get_the_id(), 'cngnyc_media', false, ', ' ); ?>
	<?php if ( !empty( $term_list ) ) { $text = $term_list; } else { $text = 'Reporting'; } ?>
	<div class="meta top-meta"><?php echo $text; ?> from <span class="author"><?php if ( function_exists( 'coauthors_posts_link' ) ) { coauthors_posts_link(); } else { the_author_posts_link(); } ?></span> <span class="date"><?php the_time( 'F j, Y' ); ?></span> <span class="permalink"><a href="<?php the_permalink(); ?>">&#8734;</a></span></div>
		
	<div class="entry">
		<?php the_content(); ?>
	</div>
	
</div><!-- END .post -->
	
<?php endwhile ; endif; ?>			

</div><!-- END .content -->