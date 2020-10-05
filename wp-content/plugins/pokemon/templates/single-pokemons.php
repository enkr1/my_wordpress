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
<!-- <script>
    setTimeout(hideLoader, 1000);

    function hideLoader() {
        var container = document.getElementsByClassName("loading-process");
        for (var i = 0; i < container.length; i++) {
            jQuery('#loader').addClass('hidden');
            container[i].style.display = 'block';
        }
    }
</script>

<div id="loader" class="lds-dual-ring overlay"></div> -->

<div id="pokemon-body" class="pokemon-body single-pokemon-body">

    <?php echo do_shortcode('[pokemon_single]'); ?>

</div>

<div id="pokemon-card-modal">
    <!-- <div id="pokemon-card-img" class="card"></div> -->
    <img id="pokemon-card-img">
</div>

<?php get_footer(); ?>