<?php

/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 *
 * @package Pokemon
 * @since 1.0.0
 * 
 * Pokemons
 * 
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

get_header(); ?>

<div id="pokemon-body" class="pokemon-body">
     
    <?php echo do_shortcode('[pokemon_single]'); ?>

</div>

<?php get_footer(); ?>