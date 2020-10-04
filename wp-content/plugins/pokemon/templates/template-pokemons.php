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

get_header(); ?>

<script>
    function updateUrl(input) {
        window.history.replaceState(null, null, "?q=" + (input).trim());
    }
</script>

<script>
    jQuery(window).ready(hideLoader); // not really working 
    
    // setTimeout(hideLoader, 1000);

    function hideLoader() {
        var container = document.getElementsByClassName("loading-process");
        for (var i = 0; i < container.length; i++) {
            jQuery('#loader').addClass('hidden');
        }

        // Load the parameter to enter field
        var url = new URL(window.location.href);
        document.getElementById("searchInput").value = url.searchParams.get("q");
    }
</script>

<div id="loader" class="lds-dual-ring overlay"></div>


<div id="pokemon-body" class="pokemon-body loading-process">
    <form class="searchForm">
        <input type="text" size="30" placeholder="Search.." id="searchInput" oninput="updateUrl(this.value);">
        <div id="hintMsg"></div>
        <div id="searching-gif" class="loadingio-spinner-dual-ring-cq5g34ha3y">
            <div class="ldio-5rw0jnyb20q">
                <div>
                </div>
                <div>
                    <div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <?php echo do_shortcode('[pokemons]'); ?>

</div>


<script>
    //setup before functions
    let typingTimer; //timer identifier
    let doneTypingInterval = 1000; //time in ms (1 seconds)
    let userInput = document.getElementById('searchInput');

    // Disable enter key
    jQuery('#searchInput').keypress(
        function(event) {
            if (event.which == '13') {
                event.preventDefault();
            }
        });

    //on keyup, start the countdown
    userInput.addEventListener('keyup', () => {
        clearTimeout(typingTimer);
        if (userInput.value) {
            typingTimer = setTimeout(doneTyping, doneTypingInterval);
        }
    });

    //user is "finished typing," do something
    function doneTyping() { //do something
        // alert("you entered " + userInput.value);

        // Get all pokemon 
        var no_of_result = 0;
        var pokemonIDs = [];
        var display_msg = '';
        // var beforeSending = false;

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
                    if (((result.name).toUpperCase()).includes((userInput.value).trim().toUpperCase())) {
                        no_of_result++;
                        console.log("Name: " + result.name + ", ID: " + result.id);
                        pokemonIDs.push(result.id);
                    }
                    display_msg = "You wrote: " + userInput.value + ", " + no_of_result + " result(s) found.";
                },
                beforeSend: function() {
                    // beforeSending = true;
                    // document.getElementById('searching-gif').style.display = "block";
                    document.getElementById('searching-gif').style.opacity = "1";
                },
                error: function() {
                    console.log("ERROR");
                }
            });

            // if (beforeSending) {
            //     console.log("hoi");
            // }
        }

        function append(p) {
            return (location.search ? location.search + "&" : "?") + p; // + location.hash
        }
        jQuery(document).ajaxStop(function() {
            document.getElementById('searching-gif').style.opacity = "0";
            document.getElementById("hintMsg").innerHTML = display_msg;

            if (no_of_result == 0) {
                // No result
            } else {
                var encryptedMsg = encodeURIComponent(window.btoa(pokemonIDs.toString()));
                history.replaceState(null, null, append("encrypt=" + encryptedMsg));

                setTimeout(function() {
                    location.reload(true);
                }, 1000);
            }

        });

    }

</script>

<?php get_footer(); ?>