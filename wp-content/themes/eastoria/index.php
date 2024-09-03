<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
* @package Black_Duck 
*/

 $context = Timber\Timber::get_context();
 $context['options'] = get_fields('option');
//  $context['all_lang'] = icl_get_languages();
//  $context['current'] = ICL_LANGUAGE_CODE;
 Timber\Timber::render('view-index.twig', $context);
