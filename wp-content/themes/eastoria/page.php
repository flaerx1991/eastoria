<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
* @package Black_Duck */

$context = Timber\Timber::get_context(); 
$context['post'] = new Timber\Post();
$context['options'] = get_fields('option');
$context['meta'] = get_field('meta_fields');
$context['opengraph'] = get_field('open_graph_fields');
$context['twitter'] = get_field('twitter_fields');


Timber\Timber::render('view-default.twig', $context);
