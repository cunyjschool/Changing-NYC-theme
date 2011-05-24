<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

	<meta name="copyright" content="Copyright <?php echo date('Y'); ?> City University of New York Graduate School of Journalism" />
	<meta http-equiv="content-language" content="en" />

	<?php cngnyc_head_title(); ?>
	
	<?php
	/**
	 * All stylesheets are enqueued in functions.php
	 */
	?>

  	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/images/favicon.ico" type="image/x-icon" />

	<?php wp_head(); ?>
  
</head>

<body <?php body_class(); ?>>

<div class="header">
	
	<div class="wrap">
		
		<?php if ( !is_single() ): ?>
		
		<a href="<?php bloginfo('url'); ?>"><img class="site-logo float-left" src="<?php bloginfo('template_directory'); ?>/img/censuslogo2_75.png" width="130px" height="75px" /></a>
		
		<div class="site-description"><?php cngnyc_project_description(); ?></div>

		<div class="clear-both"></div>

		<?php endif; ?>			
		
		<div class="float-right a-project-of">
			<a href="http://nycitynewsservice.com/">A project of&nbsp;&nbsp;&nbsp;<img class="nycitynewsservice-logo" src="<?php bloginfo('template_directory'); ?>/img/nycitynewsservice_15.png" height="15px" width="102px" /></a>
		</div>
		
		<div class="clear-right"></div>
	
	</div><!-- END .wrap -->
	
</div><!-- END .header -->