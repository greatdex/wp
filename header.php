<!doctype html>
<html>
<head>
	<title><?php bloginfo('name'); ?> | <?php wp_title(); ?></title>
	<meta http-equiv="Content-Type" content="text/html" charset="UTF-8" />

	<!--[if lt IE 9] <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script> <![endif]-->

	<link rel="stylesheet" type="text/css" media="screen, projection" href="<?php bloginfo('stylesheet_url'); ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<?php wp_head(); ?>
</head>

<body>
	<div id="wrap">
		<div id="container" class="group">

			<!--Header -->
			<header class="group">
				<h1><a href="<?php bloginfo('wpurl'); ?>"><img border=0 src="<?php print IMAGES; ?>/logo.png" alt="<?php bloginfo('name'); ?>" /></a></h1>
				<?php get_search_form(); ?>

				<?php wp_nav_menu( 
							array( 'menu' => 'Main',
								   'container' => 'nav' ) ); ?>

			</header>

			<!--End of Header-->

			<!--Main Area-->
			<div id="content" class="group">			