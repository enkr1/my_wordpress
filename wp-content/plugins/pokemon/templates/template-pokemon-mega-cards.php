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
 * Pokemon Ex Cards
 * 
 */
// header('Access-Control-Allow-Origin: *');

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

get_header(); ?>

<div id="pokemon-body" class="pokemon-body">

    <?php echo do_shortcode('[pokemon_mega_cards]'); ?>

</div>

<div id="pokemon-card-modal">
    <div id="pokemon-card-special-img" class="card"></div>
    <!-- <img id="pokemon-card-img" class="card"> -->
</div>

<style class="hover"></style>

<script>
    /*

  using 
    - an animated gif of sparkles.
    - an animated gradient as a holo effect.
    - color-dodge blend mode

  this could be enhanced with some 3d effects
  which change the background positions
  
*/

    var $cards = jQuery(".card");
    var $style = jQuery(".hover");
    $cards.on("mousemove", function(e) {
        var $card = jQuery(this);
        var l = e.offsetX;
        var t = e.offsetY;
        var h = $card.height();
        var w = $card.width();
        var lp = Math.abs(Math.floor(100 / w * l) - 100);
        var tp = Math.abs(Math.floor(100 / h * t) - 100);
        var bg = `background-position: ${lp}% ${tp}%;`
        var style = `.card.active:before { ${bg} }`
        $cards.removeClass("active");
        $card.addClass("active");
        $style.html(style);
    }).on("mouseout", function() {
        $cards.removeClass("active");
    });
</script>

<?php get_footer(); ?>