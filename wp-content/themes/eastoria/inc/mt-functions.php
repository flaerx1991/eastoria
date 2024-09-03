<?php

// pull composer dependencies
require_once( get_template_directory().'/vendor/autoload.php' );

// init Timber
new Timber\Timber();

// set views folder to scan for .twig files
Timber\Timber::$dirname = array('views/layouts', 'views/template-parts', 'views/modules', 'views');

// enqueue assets
function matrix_custom_scripts() {

    // fonts
    //wp_enqueue_style( 'fonts', 'https://use.typekit.net/uzq4kca.css');

    // styles
    wp_enqueue_style( 'matrix-style', asset_uri('css/style.css'), array(), _S_VERSION );
    wp_enqueue_style( 'swiper', 'https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css' );
    // scripts
   // wp_enqueue_script( 'flowbite', get_template_directory_uri() . '/node_modules/flowbite/dist/flowbite.js', array(), '', true );
    //wp_enqueue_script( 'fslightbox', get_template_directory_uri() . '/node_modules/fslightbox/index.js', array(), '', true );
   // wp_enqueue_script( 'slick', asset_uri( 'js/components/slick.min.js' ), array('jquery'), _S_VERSION, true );
  

//    wp_enqueue_script('app', asset_uri('js/app.js'), array(), _S_VERSION);
   wp_enqueue_script('swiper','https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js','','',true);
 
    wp_enqueue_script( 'app', asset_uri( 'js/app.js' ), array(), _S_VERSION, true );

}
add_action( 'wp_enqueue_scripts', 'matrix_custom_scripts' );

function asset_uri( $file ) {
    return get_template_directory_uri() . '/assets/' . $file;
}

