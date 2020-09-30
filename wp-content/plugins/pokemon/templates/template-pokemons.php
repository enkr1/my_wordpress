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
// header('Access-Control-Allow-Origin: *');

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
$pluginLoc = plugin_dir_path(__FILE__);
get_header(); ?>

<!-- <script>
    function showResult(str) {
        jQuery.ajax({
                url: 'https://pokeapi.co/api/v2/pokemon/',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                type: "GET", /* or type:"GET" or type:"PUT" */
                dataType: "json",
                success: function (result) {
                    console.log(JSON.stringify(result, null, "  "));
                },
                error: function () {
                    console.log("error");
                }
            });
    }
</script> -->

<script>
    function searchPokemon(input) {

        // Get all pokemon 
        var no_of_result = 0;
        var pokemons = [];
        var display_msg = '';

        window.history.replaceState(null, null, "?q=" + input);

        
        for (var i = 0; i < 893; i++) {
            jQuery.ajax({
                url: 'https://pokeapi.co/api/v2/pokemon/' + (i + 1),
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                type: "GET",
                /* or type:"GET" or type:"PUT" */
                dataType: "json",
                success: function(result) {
                    if ((result.name).includes(input)) {
                        no_of_result++;
                        console.log(result.name);
                    }

                    display_msg = "You wrote: " + input + ", " + no_of_result + " result found.";

                },
                error: function() {
                    console.log("ERROR");
                }
            });

        }

        jQuery(document).ajaxStop(function() {
            document.getElementById("demo").innerHTML = display_msg;
            // jQuery("#pokemon-body").load(window.location.href + " #pokemon-body>*", "");
            setTimeout(function() {
                alert('Reloading Page');
                location.reload(true);
            }, 1000);


        });
        //   var x = document.getElementById("myInput").value;
    }
</script>

<script>
    // jQuery(window).ready(hideLoader);
    setTimeout(hideLoader, 1000);

    function hideLoader() {
        var container = document.getElementsByClassName("loading-process");
        for (var i = 0; i < container.length; i++) {
            jQuery('#loader').addClass('hidden');
            container[i].style.display = 'block';
        }

        var url = new URL(window.location.href);
        var q = url.searchParams.get("q");
        console.log(q);
        document.getElementById("searchInput").value = q;
    }
</script>
<div id="loader" class="lds-dual-ring overlay"></div>

<div id="pokemon-body" class="pokemon-body loading-process" style="display:none;">
    <!-- <div id="pokemon-body" class="pokemon-body"> -->
    <form>
        <input type="text" size="30" id="searchInput" oninput="searchPokemon(this.value)">
        <!-- <input type="text" size="30" onkeyup="showResult(this.value)"> -->
        <!-- <div id="livesearch"></div> -->
        <div id="demo"></div>
    </form>

    <?php echo do_shortcode('[pokemons]'); ?>

</div>

<?php get_footer(); ?>