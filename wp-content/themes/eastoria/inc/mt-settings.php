<?php

if ( function_exists( 'acf_add_options_page' ) ) {
    acf_add_options_page( array(
        'menu_title'  => 'Theme Settings',
        'menu_slug'   => 'theme-settings',
        'capability'  => 'edit_posts',
        'redirect'    => true
    ) );

    acf_add_options_sub_page( array(
        'page_title'  => 'General',
        'menu_title'  => 'General',
        'parent_slug' => 'theme-settings'
    ) );

    acf_add_options_sub_page( array(
        'page_title'  => 'Header Menu',
        'menu_title'  => 'Header Menu',
        'parent_slug' => 'theme-settings'
    ) );

    acf_add_options_sub_page( array(
        'page_title'  => 'Footer Menu',
        'menu_title'  => 'Footer Menu',
        'parent_slug' => 'theme-settings'
    ) );

    acf_add_options_sub_page( array(
        'page_title'  => 'Blog',
        'menu_title'  => 'Blog',
        'parent_slug' => 'theme-settings'
    ) );
} 

