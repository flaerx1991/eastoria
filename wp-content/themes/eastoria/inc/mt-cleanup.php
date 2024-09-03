<?php

// disable comments
function mt_disable_comments_post_types_support() {
    $post_types = get_post_types();
    foreach ($post_types as $post_type) {
       if(post_type_supports($post_type, 'comments')) {
          remove_post_type_support($post_type, 'comments');
          remove_post_type_support($post_type, 'trackbacks');
       }
    }
 }
 add_action('admin_init', 'mt_disable_comments_post_types_support');
 
 function mt_disable_comments_status() {
    return false;
 }
 add_filter('comments_open', 'mt_disable_comments_status', 20, 2);
 add_filter('pings_open', 'mt_disable_comments_status', 20, 2);
 
 function mt_disable_comments_hide_existing_comments($comments) {
    $comments = array();
    return $comments;
 }
 add_filter('comments_array', 'mt_disable_comments_hide_existing_comments', 10, 2);

 add_action('admin_menu', function () {
    remove_menu_page('edit-comments.php');
});
 
add_action('init', function () {
    if (is_admin_bar_showing()) {
        remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
    }
});

//remove default editor from page and post
add_action( 'init', function() {
    //remove_post_type_support( 'post', 'editor' );
    remove_post_type_support( 'page', 'editor' );
}, 99);

// disable emojis in WordPress
add_action( 'init', 'mt_disable_emojis' );

function mt_disable_emojis() {
 remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
 remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
 remove_action( 'wp_print_styles', 'print_emoji_styles' );
 remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
 remove_action( 'admin_print_styles', 'print_emoji_styles' );
 remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
 remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
 add_filter( 'tiny_mce_plugins', 'mt_disable_emojis_tinymce' );
}

function mt_disable_emojis_tinymce( $plugins ) {
    if ( is_array( $plugins ) ) return array_diff( $plugins, array( 'wpemoji' ) );
    else return array();
}

// disable wp global inline styles
function mt_deregister__global_inline_styles() {
    wp_dequeue_style( 'global-styles' );
}
add_action( 'wp_enqueue_scripts', 'mt_deregister__global_inline_styles', 100 );


// disable wp-json
// Remove a specific or several endpoints
add_filter( 'rest_endpoints', function( $endpoints ) {
    unset( $endpoints['/wp/v2/users'] );
    unset( $endpoints['/wp/v2/users/(?P<id>[\\d]+)'] );
    return $endpoints;
} );
// add_filter( 'rest_authentication_errors', function( $access ){
//     return new WP_Error( 'rest_cannot_access', 'Nope :)', array( 'status' => 403 ) );
// } );
// remove_action('template_redirect', 'rest_output_link_header', PHP_INT_MAX);
// if (version_compare(get_bloginfo('version'), '4.7', '>=')) {
	
// 	add_filter('rest_authentication_errors', 'disable_wp_rest_api');	
// } else {	
// 	disable_wp_rest_api_legacy();	
// }

// function disable_wp_rest_api($access) {	
// 	if (!is_user_logged_in()) {		
// 		$message = apply_filters('disable_wp_rest_api_error', __('REST API restricted to logged in users.', 'disable-wp-rest-api'));
		
// 		return new WP_Error('rest_login_required', $message, array('status' => rest_authorization_required_code()));		
// 	}	
// 	return $access;	
// }

// function disable_wp_rest_api_legacy() {
	
//     // REST API 1.x
//     add_filter('json_enabled', '__return_false');
//     add_filter('json_jsonp_enabled', '__return_false');
	
//     // REST API 2.x
//     add_filter('rest_enabled', '__return_false');
//     add_filter('rest_jsonp_enabled', '__return_false');	
// }

// // remove REST API links from head
// remove_action( 'wp_head', 'rest_output_link_wp_head');
// remove_action( 'wp_head', 'wp_oembed_add_discovery_links');
// remove_action( 'template_redirect', 'rest_output_link_header', 11);

// remove wp generator tag from head
remove_action('wp_head', 'wp_generator');

// remove wlwmanifest from head
remove_action('wp_head', 'wlwmanifest_link');

// remove rsd link from head
remove_action('wp_head', 'rsd_link');

// remove gutenberg css from head
function mt_remove_wp_block_library_css(){
    wp_dequeue_style( 'wp-block-library' );
    wp_dequeue_style( 'wp-block-library-theme' );
    wp_dequeue_style( 'wc-blocks-style' ); // Remove WooCommerce block CSS
   } 
add_action( 'wp_enqueue_scripts', 'mt_remove_wp_block_library_css', 100 );

// remove classic theme styles from head
function mt_remove_classic_theme_styles(){
    wp_dequeue_style( 'classic-theme-styles' );
} 
add_action( 'wp_enqueue_scripts', 'mt_remove_classic_theme_styles', 100 );

//remove wp menu settings from customizer
add_action('customize_register', function ( $WP_Customize_Manager ){
    if (isset($WP_Customize_Manager->nav_menus) && is_object($WP_Customize_Manager->nav_menus)) {
        remove_filter( 'customize_refresh_nonces', array( $WP_Customize_Manager->nav_menus, 'filter_nonces' ) );
        remove_action( 'wp_ajax_load-available-menu-items-customizer', array( $WP_Customize_Manager->nav_menus, 'ajax_load_available_items' ) );
        remove_action( 'wp_ajax_search-available-menu-items-customizer', array( $WP_Customize_Manager->nav_menus, 'ajax_search_available_items' ) );
        remove_action( 'customize_controls_enqueue_scripts', array( $WP_Customize_Manager->nav_menus, 'enqueue_scripts' ) );
        remove_action( 'customize_register', array( $WP_Customize_Manager->nav_menus, 'customize_register' ), 11 );
        remove_filter( 'customize_dynamic_setting_args', array( $WP_Customize_Manager->nav_menus, 'filter_dynamic_setting_args' ), 10, 2 );
        remove_filter( 'customize_dynamic_setting_class', array( $WP_Customize_Manager->nav_menus, 'filter_dynamic_setting_class' ), 10, 3 );
        remove_action( 'customize_controls_print_footer_scripts', array( $WP_Customize_Manager->nav_menus, 'print_templates' ) );
        remove_action( 'customize_controls_print_footer_scripts', array( $WP_Customize_Manager->nav_menus, 'available_items_template' ) );
        remove_action( 'customize_preview_init', array( $WP_Customize_Manager->nav_menus, 'customize_preview_init' ) );
        remove_filter( 'customize_dynamic_partial_args', array( $WP_Customize_Manager->nav_menus, 'customize_dynamic_partial_args' ), 10, 2 );
    }
}, -1);

// disallow file edit
define('DISALLOW_FILE_EDIT', true);

// remove jquery migrate
function mt_remove_jquery_migrate( $scripts ) {
    if ( ! is_admin() && isset( $scripts->registered['jquery'] ) ) {
         $script = $scripts->registered['jquery'];
        if ( $script->deps ) $script->deps = array_diff( $script->deps, array( 'jquery-migrate' ) );
    }
}
 add_action( 'wp_default_scripts', 'mt_remove_jquery_migrate' );

 // disable empty search query
 add_action( 'pre_get_posts', function ( $q )
 {
     if( !is_admin() && $q->is_main_query() && $q->is_search() ) {
         $search_terms = $q->get( 's' );
         if ( !$search_terms ) { 
            add_action( 'wp', function () use ( $q ) {
                $q->set_404();
                status_header(404);
                nocache_headers();
            });
         }
     }
 });
