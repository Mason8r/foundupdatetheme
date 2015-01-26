<?php 

include('functions/wp_foundation_navwalker.php');

add_theme_support('menus');

/**
 * Register Menus
 * http://codex.wordpress.org/Function_Reference/register_nav_menus#Examples
 */
register_nav_menus(array(
    'top-bar-l' => 'Left Top Bar', // registers the menu in the WordPress admin menu editor
    'top-bar-r' => 'Right Top Bar'
));

/**
 * Left top bar
 * http://codex.wordpress.org/Function_Reference/wp_nav_menu
 */
function foundation_top_bar_l() {
    wp_nav_menu(array( 
        'container' => false,                           // remove nav container
        'container_class' => '',           		// class of container
        'menu' => '',                      	        // menu name
        'menu_class' => 'top-bar-menu left',         	// adding custom nav class
        'theme_location' => 'top-bar-l',                // where it's located in the theme
        'before' => '',                                 // before each link <a> 
        'after' => '',                                  // after each link </a>
        'link_before' => '',                            // before each link text
        'link_after' => '',                             // after each link text
        'depth' => 5,                                   // limit the depth of the nav
    	'fallback_cb' => false,                         // fallback function (see below)
        'walker' => new top_bar_walker()
	));
}

/**
 * Right top bar
 */
function foundation_top_bar_r() {
    wp_nav_menu(array( 
        'container' => false,                           // remove nav container
        'container_class' => '',           		// class of container
        'menu' => '',                      	        // menu name
        'menu_class' => 'top-bar-menu right',         	// adding custom nav class
        'theme_location' => 'top-bar-r',                // where it's located in the theme
        'before' => '',                                 // before each link <a> 
        'after' => '',                                  // after each link </a>
        'link_before' => '',                            // before each link text
        'link_after' => '',                             // after each link text
        'depth' => 5,                                   // limit the depth of the nav
    	'fallback_cb' => false,                         // fallback function (see below)
        'walker' => new top_bar_walker()
	));
}

function sidebar_widgets_init() {
    register_sidebar( array(
        'name' => __( 'Main Sidebar', 'main-sidebar' ),
        'id' => 'sidebar-right',
        'description' => __( 'Widgets in this area will be shown on all posts.', 'main-sidebar' ),
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ) );
}
add_action( 'widgets_init', 'sidebar_widgets_init' );

/* Load Scripts */
function js_and_css()
{
	//Get custom script and foundation (after jQuery)
	wp_register_script( 'my-script', get_template_directory_uri() . '/assets/js/main.js', array( 'jquery' ), false, true  );
	wp_register_script( 'modernizer', get_template_directory_uri() . '/assets/js/vendor/modernizr.js', array( 'jquery' ), false, true  );
	wp_register_script( 'fastclick', get_template_directory_uri() . '/assets/js/vendor/fastclick.js', array( 'jquery' ), false, true  );
	wp_register_script( 'foundation', get_template_directory_uri() . '/assets/js/foundation.min.js', array( 'jquery' ), false, true  );
		
	//enqueue the script:
	wp_enqueue_script( 'foundation' );
	wp_enqueue_script( 'modernizer' );
	wp_enqueue_script( 'fastclick' );
	wp_enqueue_script( 'my-script' );
	//wp_enqueue_script( 'masonry' );

	//main style, fontawesome, foundation - do google font elsewhere
	wp_register_style( 'style' , get_stylesheet_uri() );
	wp_register_style( 'foundation' , get_template_directory_uri() . '/assets/css/foundation.min.css' );
	wp_register_style( 'normalize' , get_template_directory_uri() . '/assets/css/normalize.css' );
	wp_register_style( 'font-awesome' , '//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css' );

	wp_enqueue_style( 'noramlize' );
	wp_enqueue_style( 'foundation' );
	wp_enqueue_style( 'font-awesome' );
	wp_enqueue_style( 'style' );

}
add_action( 'wp_enqueue_scripts', 'js_and_css' );

function create_new_post_type() {

	$event_labels = array(
		'name' 			 => __('Events'),
		'singular_name'  => __('Event'),
	);
	$events = array(
		'labels'      	 => $event_labels,
		'public' 	  	 => true,
		'has_archive' 	 => true,
		'menu_position'  => 5,
		'description'    => 'Events and Webinars',
		'rewrite'     	 =>
			array('slug' => 'events'),
		'supports'    	 =>
			array( 'title',
				'comments', 'editor',
				'thumbnail', 'custom-fields', 'revisions'),
	);

	register_post_type('Events', $events);
}
//add_action('init', 'create_new_post_type');

/* Allow Features Images */
add_theme_support( 'post-thumbnails' ); 
add_image_size( 'three', 330, 9999, true );

/* Set excerpt lengh to 20 */
function custom_excerpt_length( $length ) {
	return 25;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function new_excerpt_more( $more ) {
	return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');


?>