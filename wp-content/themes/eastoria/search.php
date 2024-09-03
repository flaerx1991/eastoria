<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
* @package Black_Duck */

$context = Timber\Timber::get_context();
$context['title'] = 'Search results for ' . get_search_query();
$context['posts'] = new Timber\PostQuery(
	array(
	  'posts_per_page' => -1,
	  's' => get_search_query(),
	  'post_type' => 'post'
	)
);
$context['options'] = get_fields('option');

Timber\Timber::render('view-archive.twig', $context);
