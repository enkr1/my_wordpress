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

<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.0.0/crypto-js.min.js"></script>

<!-- <script src="reach.your.crypto.js/rollups/aes.js"></script> -->

<script>
    function updateUrl(input) {
        window.history.replaceState(null, null, "?q=" + (input).trim());
    }

    // var getAJAXRequests = (function() {
    //     var oldSend = XMLHttpRequest.prototype.send,
    //         currentRequests = [];

    //     XMLHttpRequest.prototype.send = function() {
    //         currentRequests.push(this); // add this request to the stack
    //         oldSend.apply(this, arguments); // run the original function

    //         // add an event listener to remove the object from the array
    //         // when the request is complete
    //         this.addEventListener('readystatechange', function() {
    //             var idx;

    //             if (this.readyState === XMLHttpRequest.DONE) {
    //                 idx = currentRequests.indexOf(this);
    //                 if (idx > -1) {
    //                     currentRequests.splice(idx, 1);
    //                 }
    //             }
    //         }, false);
    //     };

    //     return function() {
    //         alert("hey");
    //         return currentRequests;
    //     }
    // }());
    // getAJAXRequests();
</script>

<script>
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

                    if ((result.name).includes((userInput.value).trim())) {
                        no_of_result++;
                        console.log("Name: " + result.name + ", ID: " + result.id);
                        pokemonIDs.push(result.id);
                    }
                    display_msg = "You wrote: " + userInput.value + ", " + no_of_result + " result found.";
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
            // document.getElementById('searching-gif').style.display = "none";
            document.getElementById('searching-gif').style.opacity = "0";

            document.getElementById("hintMsg").innerHTML = display_msg;
            // jQuery("#pokemon-body").load(window.location.href + " #pokemon-body>*", "");

            if (no_of_result == 0) {
                // No result
            } else {

                // let key = CryptoJS.enc.Hex.parse("0123456789abcdef0123456789abcdef");
                // let iv = CryptoJS.enc.Hex.parse("abcdef9876543210abcdef9876543210");
                // let encryptedMsg = aes.encrypt(msg, key, {
                //     iv: iv,
                //     padding: padZeroPadding
                // }).toString();

                // var encryptedMsg = CryptoJS.AES.encrypt(pokemonIDs.toString(), "123");

                // var encryptedMsg = CryptoJS.AES.encrypt(JSON.stringify(pokemonIDs.toString()), "123", {
                //     format: CryptoJSAesJson
                // }).toString();


                // var encryptedMsg = CryptoJS.AES.encrypt(pokemonIDs.toString(), "1");



                // history.replaceState(null, null, append("encrypt=" + encryptedMsg));
                var encryptedMsg = encodeURIComponent(window.btoa(pokemonIDs.toString()));
                history.replaceState(null, null, append("encrypt=" + encryptedMsg));
                // console.log(pokemonIDs.toString());

                setTimeout(function() {
                    location.reload(true);
                }, 1000);
            }

        });

    }

    // var CryptoJSAesJson = {
    //     stringify: function(cipherParams) {
    //         var j = {
    //             ct: cipherParams.ciphertext.toString(CryptoJS.enc.Base64)
    //         };
    //         if (cipherParams.iv) j.iv = cipherParams.iv.toString();
    //         if (cipherParams.salt) j.s = cipherParams.salt.toString();
    //         return JSON.stringify(j);
    //     },
    //     parse: function(jsonStr) {
    //         var j = JSON.parse(jsonStr);
    //         var cipherParams = CryptoJS.lib.CipherParams.create({
    //             ciphertext: CryptoJS.enc.Base64.parse(j.ct)
    //         });
    //         if (j.iv) cipherParams.iv = CryptoJS.enc.Hex.parse(j.iv)
    //         if (j.s) cipherParams.salt = CryptoJS.enc.Hex.parse(j.s)
    //         return cipherParams;
    //     }
    // }
</script>

<?php get_footer(); ?>