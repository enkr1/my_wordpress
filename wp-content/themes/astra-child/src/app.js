function minimizeNav() { // main-header-bar
    var elements = document.getElementsByClassName('main-header-bar');
    var requiredElement = elements[0];
    if (this.scrollY > this.innerHeight / 1.1) {
        requiredElement.style.transform = "translateY(-40%)";
        requiredElement.style.opacity = "0.8";

    } else {
        requiredElement.style.transform = "translateY(0%)";
        requiredElement.style.opacity = "1";
        // document.body.classList.remove("interest-body");
        // var img = "images/interest-main-img.jpg";
        // document.body.style.background = 'url("images/interest-main-img.jpg") no-repeat center fixed';
    }
}
window.addEventListener("scroll", minimizeNav);


const colors = {
    Fire: '#F5AC7870',
    Grass: '#A7DB8D70',
    Electric: '#FAE07870',
    Water: '#9DB7F570',
    Ground: '#EBD69D70',
    Rock: '#D1C17D70',
    Fairy: '#F4BDC970',
    Poison: '#C183C170',
    Bug: '#C6D16E70',
    Dragon: '#A27DFA70',
    Dark: '#A2928870',
    Psychic: '#FA92B270',
    Flying: '#C6B7F570',
    Fighting: '#D6787370',
    Normal: '#C6C6A770',
    Ghost: '#A292BC70',
    Ice: '#BCE6E670',
    Steel: '#D1D1E070',
    Unknown: '#9DC1B770'
};

// https://bulbapedia.bulbagarden.net/wiki/Category:Stat_color_templates
const stat_colors = {
    Hp: '#FF5959',
    Attack: '#F5AC78',
    Defense: '#FAE078',
    'Special-attack': '#9DB7F5',
    'Special-defense': '#A7DB8D',
    Speed: '#FA92B2'
}

jQuery(document).ready(function () {
    if ((window.location.pathname).includes("category/blog")) {
        // Blog side bar 
        document.getElementById("blog-sidebar-hider").addEventListener("click", hideBlogSidebar);

        function hideBlogSidebar() {
            document.getElementById('blog-sidebar').style.right = '-100%';
            document.getElementById('blog-sidebar-opener').style.opacity = '1';
            document.getElementById('blog-sidebar').style.zIndex = '-1';
            document.getElementById('blog-sidebar-hider').style.opacity = '0';
        }

        document.getElementById("blog-sidebar-opener").addEventListener("click", openBlogSidebar);

        function openBlogSidebar() {
            document.getElementById('blog-sidebar').style.right = '0';
            document.getElementById('blog-sidebar-opener').style.opacity = '0';
            document.getElementById('blog-sidebar').style.zIndex = '999';
            document.getElementById('blog-sidebar-hider').style.opacity = '1';
        }

    } else if ((window.location.pathname).includes("pokemon-single")) {
        window.onload = function () {
            // var pokemon_type = document.getElementsByClassName('pokemon-type')[0].innerHTML;

            // var pokemon_types = document.getElementsByClassName('pokemon-type');
            // var pokemon_bgs = document.getElementsByClassName('pokemon');
            // for (var i = 0; i < pokemon_types.length; i++) {
            //     // console.log(pokemon_types[i].innerHTML);
            //     var main_type = pokemon_types[i].innerHTML;
            //     if (main_type.includes(",")) {
            //         main_type = main_type.substring(0, main_type.indexOf(", "));
            //         pokemon_bgs[0].style.backgroundColor = colors[main_type];
            //     } else {
            //         pokemon_bgs[0].style.backgroundColor = colors[main_type];
            //     }
            // }

            var stat_names = document.getElementsByClassName('stat-name');
            var stat_number = document.getElementsByClassName('stat-number');
            for (var i = 0; i < stat_names.length; i++) {
                // console.log(stat_names[i].innerHTML);
                var stat_name = stat_names[i].innerHTML;
                // console.log(stat_colors[stat_name]);
                stat_number[i].style.color = stat_colors[stat_name];
            }


            var pokemon_card = document.getElementsByClassName('pokemon-card');
            for (var i = 0; i < pokemon_card.length; i++) {
                pokemon_card[i].addEventListener("click", enlargeCard)
                console.log(pokemon_card[i].innerHTML);
                // var stat_name = stat_names[i].innerHTML;
                // stat_number[i].style.color = stat_colors[stat_name];
            }

            var img = document.getElementById('pokemon-card-img');
            var modal = document.getElementById('pokemon-card-modal');

            function enlargeCard() {
                jQuery('#loader').removeClass('hidden');
                var str = this.src;
                var n = str.lastIndexOf(".");
                str = str.substring(0, n) + "_hires" + str.substring(n);
                // console.log(str);
                img.src = str;

                img.onload = function () {
                    jQuery('#loader').addClass('hidden');
                    modal.style.opacity = "1";
                    modal.style.zIndex = "9999";
                }
                // img.style.backgroundImage = "url(" + this.src + ")";
                // alert(this.src);
            }

            window.onclick = function (event) {
                if (event.target == modal) {
                    modal.style.opacity = "0";
                    modal.style.zIndex = "-1";
                }
            }


        }
    } else if ((window.location.pathname).includes("pokemon-mega-cards")) {

        var pokemon_card = document.getElementsByClassName('pokemon-card');
        for (var i = 0; i < pokemon_card.length; i++) {
            pokemon_card[i].addEventListener("click", enlargeCard)
            console.log(pokemon_card[i].innerHTML);
        }

        var modal = document.getElementById('pokemon-card-modal');

        function enlargeCard() {
            jQuery('#loader').removeClass('hidden');
            var str = this.src;
            var n = str.lastIndexOf(".");
            str = str.substring(0, n) + "_hires" + str.substring(n);

            jQuery('<img/>').attr('src', str).on('load', function () {
                jQuery(this).remove(); // prevent memory leaks as @benweet suggested
                jQuery('#loader').addClass('hidden');
                modal.style.opacity = "1";
                modal.style.zIndex = "9999";
                jQuery('#pokemon-card-special-img').css('background-image', 'url(' + str + ')');
            });

            window.onclick = function (event) {
                if (event.target == modal) {
                    modal.style.opacity = "0";
                    modal.style.zIndex = "-1";
                }
            }
        }

    } else if ((window.location.pathname).includes("pokemon")) {
        window.onload = function () {
            // var pokemon_type = document.getElementsByClassName('pokemon-type')[0].innerHTML;
            var pokemon_types = document.getElementsByClassName('pokemon-type');
            var pokemon_bgs = document.getElementsByClassName('pokemon');

            function setColors() {
                for (var i = 0; i < pokemon_types.length; i++) {
                    // console.log(pokemon_types[i].innerHTML);
                    var main_type = pokemon_types[i].innerHTML;
                    if (main_type.includes(",")) {
                        main_type = main_type.substring(0, main_type.indexOf(", "));
                        pokemon_bgs[i].style.backgroundColor = colors[main_type];
                    } else {
                        pokemon_bgs[i].style.backgroundColor = colors[main_type];
                    }
                }
            }
            setColors();
            // Pagination
            var pageNo = document.getElementById('pageNo').value;
            var noOfPokemon = document.getElementById('noOfPokemon').value;
            var prevBtn = document.getElementById("pokemon-previous");
            var nextBtn = document.getElementById("pokemon-next");
            if (pageNo <= 1 || pageNo == null) {
                prevBtn.disabled = true;
            } else if (noOfPokemon > 800) {
                nextBtn.disabled = true;
            }

        };

    } else if (window.location.pathname == '/') {
        // alert("home");
    }
});