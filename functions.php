<?php

//add_theme_support('post-thumbnails');
//add_theme_support('nav-menus');
//add_theme_support('automatic-feed-links');
//add_theme_support('post-formats', array('aside', 'gallery'));

if (is_admin()) { 
	return;
}

function theme_wp_title( $title, $sep ) {
    global $paged, $page;
    if ( is_feed() ) {
        return $title;
    }
    if ( $paged >= 2 || $page >= 2 ) {
        $title = "$title $sep " . sprintf( 'Page %s', max( $paged, $page ) );
    }
    return $title;
}
add_filter( 'wp_title', 'theme_wp_title', 10, 2 );

function theme_init() {
  add_filter('show_admin_bar', '__return_false');
  remove_action( 'wp_head', 'rsd_link' ); // EditURI link
  remove_action( 'wp_head', 'feed_links_extra', 3 ); // Category feed links
  remove_action( 'wp_head', 'feed_links', 2 ); // Post and comment feed links
  remove_action( 'wp_head', 'wlwmanifest_link' ); // Windows Live Writer
  remove_action( 'wp_head', 'index_rel_link' ); // Index link
  remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); // Previous link
  remove_action( 'wp_head', 'start_post_rel_link', 10, 0 ); // Start link
  remove_action( 'wp_head', 'rel_canonical', 10, 0 ); // Canonical
  remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 ); // Shortlink
  remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 ); // Links for adjacent posts
  remove_action( 'wp_head', 'wp_generator' ); // WP version
}
add_action('init', 'theme_init');

function theme_wp_enqueue_scripts() {
	wp_deregister_script('jquery');
	wp_register_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js');
	
    wp_register_script("theme.js", get_bloginfo('template_url', 'display') . '/theme.js', array('jquery'));
    wp_enqueue_script("theme.js");
    
    wp_register_style("theme.css", get_bloginfo('template_url', 'display') . '/theme.css', array(), false, "all");
    wp_enqueue_style("theme.css");
    
    if (is_singular() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'theme_wp_enqueue_scripts', 1000);
?>