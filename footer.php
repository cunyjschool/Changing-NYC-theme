<div class="clear-both"></div>

<div class="footer">
	
	<div class="wrap">
		
		<?php
			$args = array(
				'orderby' => 'display_name',
				'role' => 'author',
			);
			$all_authors = get_users( $args );
			$authors_html = '';
			foreach ( $all_authors as $key => $author ) {
				$authors_html .= '<a href="' . get_author_posts_url( $author->ID) . '">' . $author->display_name . '</a>, ';
				if ( $key == ( count( $all_authors ) - 2 ) ) {
					$authors_html .= 'and ';
				}
			}
			$authors_html = rtrim( $authors_html, ', ' ); 
		?>
		
		<p>A project of the NY City News Service<?php if ( $authors_html ) : ?> with contributions from <?php echo $authors_html; ?><?php endif; ?></p>
		
	</div><!-- END .wrap -->
	
</div><!-- END .footer -->

<?php wp_footer(); ?>

<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>

</body>
</html>