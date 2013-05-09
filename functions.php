<?php

define( 'TEMPPATH', get_bloginfo('stylesheet_directory'));
define( 'IMAGES', TEMPPATH."/img");

add_theme_support('nav-menus');
if ( function_exists( 'register_nav_menus' ) ) {
	register_nav_menus(
		array(
			'main' => 'Main Nav'
			)
		);
}

if ( function_exists( 'register_sidebar' ) ) {
	register_sidebar( array (
		'name' => __( 'Primary Sidebar', 'primary-sidebar' ),
		'id' => 'primary-widget-area',
		'description' => __( 'The Primary Widget Area', 'dir' ),
		'before_widget' => '<div class="widget">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>'

		) );
}

require_once('business.php');

function biz_excerpt_more($more) {
	return '<a href="'.get_permalink().'"> Continue... </a>';
}

add_filter('excerpt_more', 'biz_excerpt_more', 999);

?>