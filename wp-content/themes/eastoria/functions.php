<?php
/**
 * Eastoria functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Black_Duck 
*/

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function matrix_custom_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Eastoria, use a find and replace
		* to change 'eastoria' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'eastoria', get_template_directory() . '/languages' );


	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	//add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );
}
add_action( 'after_setup_theme', 'matrix_custom_setup' );

/**
 * CUSTOM INCLUDES
 */

 /**
  * Load Custom functions files
  */
  require get_template_directory() . '/inc/mt-functions.php';
  require get_template_directory() . '/inc/mt-settings.php';
  require get_template_directory() . '/inc/mt-cleanup.php';
 