<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title><?php
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		bloginfo('name');
		echo " | $site_description";
	} else {
		wp_title( '|', true, 'right' );
		bloginfo('name');
	}
	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php
if ( is_singular() && get_option( 'thread_comments' ) )
	wp_enqueue_script( 'comment-reply' );

wp_head();
?>
</head>
<body <?php body_class(); ?>>
	<div id="bg">
		<div id="wrapper">
			<div id="header">
				<div id="header-top">
					<div id="blog-info">
						<h1><a href="<?php echo home_url('/'); ?>" title="<?php bloginfo( 'name' ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
						<div id="descr"><?php bloginfo( 'description' ); ?></div>
					</div>
					<div id="rss"><a href="<?php bloginfo( 'rss2_url' ); ?>" ><span><?php _e( 'Subscribe via RSS', 'cuttlefish' ); ?></span></a></div>
				</div>
				<div id="menu-decor"></div>
				<div id="menu-box">
					<div id="menu-header"></div>
					<?php echo cuttlefish_wp_nav_menu(); ?>
					<div id="menu-footer"></div>
				</div>
			</div>