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
<!-- <div id="loader" class="lds-dual-ring overlay"></div> -->
<!-- style="display:none;" -->
<div id="pokemon-body" class="pokemon-body loading-process">

    <?php echo do_shortcode('[pokemons]'); ?>

</div>

<?php get_footer(); ?>