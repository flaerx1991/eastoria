<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
* @package Black_Duck */

 $context = Timber\Timber::get_context();
 $context['options'] = get_fields('option');

 Timber\Timber::render( 'view-404.twig', $context );
