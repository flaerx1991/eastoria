<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
* @package Black_Duck */

 $context = Timber\Timber::get_context();
 $context['posts'] = new Timber\PostQuery();
 $context['options'] = get_fields('option');
 $context['post'] = new Timber\Post();

 Timber\Timber::render('view-archive.twig', $context);


 