<?php

/**
 * Plugin Name: Pokemon Plugin
 * Plugin URI: http://localhost:8000/
 * Description: A plugin to show Pokemon 
 * Version: 1.0.0
 * Author: JingHui
 * Author URI: http://localhost:8000/
 * License: GPLv2 or later
 * Text Domain: Pokemon-plugin
 *
 * @package PokemonPlugin
 */

use Nullix\CryptoJsAes\CryptoJsAes;
use ParagonIE\Sodium\Crypto;
use Pokemon\Pokemon;

// use Nullix\CryptoJsAes\CryptoJsAes;

// require  plugins_url(__DIR__) . "./../pokemon/assets/js/CryptoJsAes.php";

// defined( 'ABSPATH' ) || exit;
if (!defined('ABSPATH')) {
    die;
}

// if (!function_exists('add_function')) {
//     echo 'Access Denied';
//     exit;
// }

class PokemonPlugin
{
    protected $plugin_slug;
    private static $instance;
    protected $templates;

    public static function get_instance()
    {
        if (null == self::$instance) {
            self::$instance = new PokemonPlugin();
        }
        return self::$instance;
    }

    function __construct()
    {
        // add action
        add_action('init', array($this, 'cw_post_type_pokemon'));
        // add_action('init', array($this, 'pokemon_taxonomy'));
        add_shortcode('pokemons', array($this, 'pokemons_function'));
        add_shortcode('pokemon_single', array($this, 'pokemon_single_function'));
        add_shortcode('pokemon_mega_cards', array($this, 'pokemon_mega_cards_function'));

        // Custom template
        $this->templates = array();
        // Add a filter to the wp 4.7 version attributes metabox
        add_filter('theme_page_templates', array($this, 'add_new_template'));
        // Add a filter to the save post to inject out template into the page cache
        add_filter('wp_insert_post_data', array($this, 'register_project_templates'));
        // Add a filter to the template include to determine if the page has our 
        // template assigned and return it's path
        add_filter('template_include', array($this, 'view_project_template'));

        // Add your templates to this array.
        $this->templates = array(
            'templates/template-pokemons.php' => 'Pokemons',
            'templates/single-pokemons.php' => 'Pokemon',
            'templates/template-pokemon-mega-cards.php' => 'Pokemon MEGA Cards',
        );
    }

    function activate()
    {
        // Generated a CPT
        // $this->cw_post_type_pokemon();

        // Flush rewrite rules
        flush_rewrite_rules();
    }

    function deactivate()
    {
        // Flush rewrite rules
        flush_rewrite_rules();
    }

    function cw_post_type_pokemon()
    {

        $supports = array(
            'title', // post title
            'editor', // post content
            'author', // post author
            'thumbnail', // featured images
            'excerpt', // post excerpt
            'custom-fields', // custom fields
            'comments', // post comments
            'revisions', // post revisions
            'post-formats', // post formats
        );

        $labels = array(
            'name' => _x('Pokemons', 'plural'),
            'singular_name' => _x('Pokemon', 'singular'),
            'menu_name' => _x('Pokemons', 'admin menu'),
            'name_admin_bar' => _x('Pokemons', 'admin bar'),
            'add_new' => _x('Add New Pokemon', 'add new'),
            'add_new_item' => __('Add New Pokemon'),
            'new_item' => __('New Pokemon'),
            'edit_item' => __('Edit Pokemon'),
            'view_item' => __('View Pokemon'),
            'all_items' => __('All Pokemons'),
            'search_items' => __('Search Pokemons'),
            'not_found' => __('No Pokemons Found.'),
        );

        $args = array(
            'supports' => $supports,
            'labels' => $labels,
            'public' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'all-pokemons'),
            'has_archive' => true,
            'hierarchical' => false,
            'menu_icon' => 'dashicons-remove',
        );

        register_post_type('pokemons', $args);
    }


    /**
     * Display pokemon MEGA cards 
     *
     * @return void
     */
    function pokemon_mega_cards_function()
    {
        $data = "<div id='poke_container' class='poke-container poke-mega-cards-container'>";

        // APIs
        $cards = $this->call_pokemontcg_subtype('MEGA');

        $displayCards = "<div class='cards-slider'>";
        // echo count($cards->cards);
        for ($i = 0; $i < count($cards->cards); $i++) {
            // for ($i = 0; $i < 10; $i++) {
            $imageUrl = $cards->cards[$i]->imageUrl;
            $name = $cards->cards[$i]->name;
            if (@getimagesize($imageUrl)) {
                $displayCards .=  "<img class='pokemon-card' src='$imageUrl' alt= '$name' />";
                // $displayCards .=  "<div class='pokemon-card' style='background-image: url($imageUrl);'></div>";
            }
        }
        $displayCards .= "</div>";


        $data .= $displayCards;

        return $data . "</div>";
    }

    /**
     * Display list of pokemons including its pagination
     * (You can customize the number of pokemon you want to display, 
     * the maximum number of the pokemon, pagination logic) 
     * It will call search_pokemons_function, if users search something
     * @return void
     */
    function pokemons_function()
    {
        $displayPokemon = 10; // The number of pokemon per page
        $maxNumber = 893; // The maximum number of pokemons in the storgae
        $noOfPokemon = $displayPokemon; // Current total number of pokemon displayed
        $startFrom = 1; // Starting ID
        $pageNo = 1;
        $prevPage = 0;
        $nextPage = $pageNo + 1;
        $isMaxRange = FALSE; // check if it is on the last page
        $pagination = ''; // For html data
        $paginationNo = ceil($maxNumber / $displayPokemon);
        $paginationLength = 10; // The number between the previous and next buttons
        $startOfPagination = 1;
        $pageCtrl = 6; // Position of the number in $paginationLength (place)
        $data = "<div id='poke_container' class='poke-container'>";
        $userInput = ""; // Get from 'q' parameter

        if (isset($_GET['pageNo']) && $_GET['pageNo'] > 1) {
            $pageNo = $_GET['pageNo'];
            $startFrom = (($displayPokemon * $pageNo) - $displayPokemon) + $startFrom;
            $noOfPokemon = ($displayPokemon * $pageNo);
            $prevPage = $pageNo - 1;
            $nextPage = $pageNo + 1;
        }

        if (isset($_GET['encrypt'])) {
            $userInput = $_GET['encrypt'];
            $data .= $this->search_pokemons_function($userInput);
        } else {
            for ($startFrom; $startFrom <= $noOfPokemon; $startFrom++) {
                $pokemon = $this->call_pokeapi($startFrom);

                if (isset($pokemon) && $isMaxRange != TRUE) { // exists
                    $name = ucfirst($pokemon->name);
                    $number = str_pad($startFrom, 3, "0", STR_PAD_LEFT);
                    $types = $this->set_pokemon_types($pokemon->types);

                    $data .= "
                    <a href='/pokemon-single/?id=$startFrom'>
                        <div class='pokemon'>
                            <span class='number'>ID: $number</span>
                            <div class='img-container'>
                                <img src='https://assets.pokemon.com/assets/cms2/img/pokedex/full/$number.png' alt='$pokemon->name' />
                            </div>
                            <div class='info'>
                                <h3 class='name'>$name</h3>
                                <small class='type'>Type(s): <span class='pokemon-type'>$types</span></small>
                            </div>
                        </div>
                    </a>";
                } else if ($isMaxRange == FALSE) {
                    echo "There is no more pokemon..";
                }

                if ($startFrom >= $maxNumber) { // the current max
                    $isMaxRange = TRUE;
                }
            } // Pokemons for loop

            // Start of Pagination
            if ($pageNo > $pageCtrl) { // custom position of the number (p)
                $pagination .= "<p class='dot'>...</p>";
                $startOfPagination = (($pageNo - $pageCtrl) + 1);
                // echo (($pageNo - 6) + 1);
            }
            if ($pageNo > ($paginationNo - ($paginationLength - $pageCtrl))) {
                $startOfPagination = $paginationNo - $paginationLength + 1;
            }
            // echo ($paginationNo - ($paginationLength - 6));
            for ($i = 0; $i < $paginationLength; $i++) {
                $setPage = $i + $startOfPagination;
                if ($setPage == $pageNo) { // Current page 
                    $pagination .= "<p class='pages curr-page'>" . $setPage . "</p>";
                } else {
                    $pagination .= "<a href='/pokemon/?pageNo=$setPage' class='pages'>" . $setPage . "</a>";
                }
            }
            // Add '...'
            if ($pageNo < ($paginationNo - ($paginationLength - $pageCtrl))) {
                $pagination .= "<p class='dot'>...</p>";
            }
            // End of Pagination
            $data .= "</div>";
            $data .= "<input type='hidden' id='pageNo' name='pageNo' value='$pageNo'>
                  <input type='hidden' id='noOfPokemon' name='noOfPokemon' value='$noOfPokemon'>";

            // Add pagination only when user is not searching
            $data .= "<div class='pokemon-pagination'>
                    <a href='/pokemon/?pageNo=$prevPage' class='pokemon-previous' id='pokemon-previous'>PREVIOUS</a>$pagination<a href='/pokemon/?pageNo=$nextPage' class='pokemon-next' id='pokemon-next'>NEXT</a>
                  </div>";
        }

        return $data;
    }

    /**
     * Display search result
     *
     * @param Array $userInput (encoded)
     * @return void
     */
    function search_pokemons_function($userInput)
    {
        $data = "";
        $decodedInput = base64_decode(urldecode($userInput)); // Decode
        $array = explode(",", $decodedInput);
        $arrayLength = count($array);

        // $data .= "<div id='displayResponse'>Found $arrayLength result(s).</div>";
        echo 'Found ' . $arrayLength . ' result(s)';

        foreach ($array as $value) {
            // echo $value . PHP_EOL;
            $pokemon = $this->call_pokeapi($value);
            $name = ucfirst($pokemon->name);
            $number = str_pad($value, 3, "0", STR_PAD_LEFT);
            $types = $this->set_pokemon_types($pokemon->types);

            $data .= "
                    <a href='/pokemon-single/?id=$value'>
                        <div class='pokemon'>
                            <span class='number'>ID: $number</span>
                            <div class='img-container'>
                                <img src='https://assets.pokemon.com/assets/cms2/img/pokedex/full/$number.png' alt='$pokemon->name' />
                            </div>
                            <div class='info'>
                                <h3 class='name'>$name</h3>
                                <small class='type'>Type(s): <span class='pokemon-type'>$types</span></small>
                            </div>
                        </div>
                    </a>
                ";
        }

        return $data;
    }

    /**
     * Display a single pokemon by ID from the URL parameter
     * @return void
     */
    function pokemon_single_function()
    {
        $id = $_GET['id'];
        $data = "<div id='poke_container' class='poke-container poke-single-container'>";

        // APIs
        $pokemon = $this->call_pokeapi($id);
        $cards = $this->call_pokemontcg($pokemon->name);

        $displayCards = "<div class='cards-slider'>";
        // echo count($cards->cards);
        for ($i = 0; $i < count($cards->cards); $i++) {
            $imageUrl = $cards->cards[$i]->imageUrl; //HiRes
            if (@getimagesize($imageUrl)) {
                $displayCards .=  "<img class='pokemon-card' src='$imageUrl' alt= '$pokemon->name' />";
            }
        }
        $displayCards .= "</div>";

        $name = ucfirst($pokemon->name);
        $number = str_pad($id, 3, "0", STR_PAD_LEFT);
        $types = "";
        for ($i = 0; $i < count($pokemon->types); $i++) {
            $type = $pokemon->types[$i]->type->name;
            if ($i != 0) {
                $types .= ', ' . "<i class='energy icon-$type'></i><span>" . ucfirst($pokemon->types[$i]->type->name) . "</span>";
            } else {
                $types .= "<i class='energy icon-$type'></i><span>" . ucfirst($pokemon->types[$i]->type->name) . "</span>";
            }
        }
        $stats = "";
        for ($i = 0; $i < count($pokemon->stats); $i++) {
            $stats .= "<div class='single-stat'><small class='stat-name'>" . ucfirst($pokemon->stats[$i]->stat->name) . "</small><span class='stat-number'>" . $pokemon->stats[$i]->base_stat . "</span></div>";
        }

        $data .= "
            <div class='pokemon pokemon-single'>
                <span class='number'>ID: $number</span>
                <div class='img-container'>
                    <img src='https://pokeres.bastionbot.org/images/pokemon/$id.png' alt='$pokemon->name' />
                </div>
                <div class='info'>
                    <h1 class='name'>$name</h1>
                    <small class='type pokemon-type'>Type(s): $types</small><br>
                    <small class='weight'>Weight: <span class='pokemon-weight'>$pokemon->weight</span></small><br>

                    <div>ADD MORE DETAILS</div>
                    <div class='pokemon-stats'>$stats</div>
                </div>
                <h3>$name's card(s): </h3>
                $displayCards
            </div>";

        return $data . "</div>";
    }

    /**
     * Call PokeAPI
     *
     * @param String $id (Pokemon's ID)
     * @return response (ArrayList of Pokemon data)
     */
    function call_pokeapi($id)
    {
        $api = curl_init("https://pokeapi.co/api/v2/pokemon/" . $id);
        curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($api);
        curl_close($api);
        return json_decode($response);
    }

    /**
     * Call Pokemontcg API by subtype
     *
     * @param String $subtype
     * @return response (ArrayList of Pokemon data using subtype)
     */
    function call_pokemontcg_subtype($subtype)
    {
        $api = curl_init("https://api.pokemontcg.io/v1/cards?subtype=" . $subtype);
        curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($api);
        curl_close($api);
        return json_decode($response);
    }

    /**
     * Call Pokemontcg API by name
     *
     * @param String $name
     * @return response (ArrayList of Pokemon data which has image links)
     */
    function call_pokemontcg($name)
    {
        $api = curl_init("https://api.pokemontcg.io/v1/cards?name=" . $name);
        curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($api);
        curl_close($api);
        return json_decode($response);
    }

    /**
     * Set the types of each pokemon
     *
     * @param Array $types
     * @return result (String)
     */
    function set_pokemon_types($types)
    {
        $result = "";
        for ($i = 0; $i < count($types); $i++) {
            if ($i != 0) {
                $result .= ', ' . ucfirst($types[$i]->type->name);
            } else {
                $result .= ucfirst($types[$i]->type->name);
            }
        }
        return $result;
    }

    /**
     * Adds our template to the page dropdown for v4.7+
     *
     */
    public function add_new_template($posts_templates)
    {
        $posts_templates = array_merge($posts_templates, $this->templates);
        return $posts_templates;
    }

    /**
     * Adds our template to the pages cache in order to trick WordPress into thinking the template file exists where it doens't really exist.
     */
    public function register_project_templates($atts)
    {
        // Create the key used for the themes cache
        $cache_key = 'page_templates-' . md5(get_theme_root() . '/' . get_stylesheet());

        // Retrieve the cache list. 
        // If it doesn't exist, or it's empty prepare an array
        $templates = wp_get_theme()->get_page_templates();
        if (empty($templates)) {
            $templates = array();
        }

        // New cache, therefore remove the old one
        wp_cache_delete($cache_key, 'themes');

        // Now add our template to the list of templates by merging our templates
        // with the existing templates array from the cache.
        $templates = array_merge($templates, $this->templates);

        // Add the modified cache to allow WordPress to pick it up for listing
        // available templates
        wp_cache_add($cache_key, $templates, 'themes', 1800);

        return $atts;
    }

    /**
     * Checks if the template is assigned to the page
     */
    public function view_project_template($template)
    {
        // Get global post
        global $post;

        // Return template if post is empty
        if (!$post) {
            return $template;
        }

        // Return default template if we don't have a custom one defined
        if (!isset($this->templates[get_post_meta($post->ID,  '_wp_page_template', true)])) {
            return $template;
        }

        $file = plugin_dir_path(__FILE__) . get_post_meta($post->ID, '_wp_page_template', true);

        // Just to be safe, we check if the file exist first
        if (file_exists($file)) {
            return $file;
        } else {
            echo $file;
        }

        // Return template
        return $template;
    }
} // End of PokemonPlugin class


add_action('update_brewery_list', 'get_breweries_from_api');
add_action('wp_ajax_nopriv_get_breweries_from_api', 'get_breweries_from_api');
add_action('wp_ajax_get_breweries_from_api', 'get_breweries_from_api');
function get_breweries_from_api()
{
    $file = get_stylesheet_directory() . '/report.txt';
    $current_page = (!empty($_POST['current_page'])) ? $_POST['current_page'] : 1;
    $pokemons = [];

    // Should return an array of objects
    $results = wp_remote_retrieve_body(wp_remote_get('https://pokeapi.co/api/v2/pokemon?limit=100&offset=' . ($current_page - 0)));
    
    // file_put_contents($file, "Current P.: " . $current_page . "\n\n", FILE_APPEND);
    // turn it into a PHP array from JSON string
    
    // $results = $results->results;

    // file_put_contents($file, "Before decoding: '" . $results . "'\n\n", FILE_APPEND);

    $results = json_decode($results);

    // file_put_contents($file, "After decoding: '" . $results->results[0]->name . "'\n\n", FILE_APPEND);

    // file_put_contents($file, "Result: " . empty($results) . "\n\n", FILE_APPEND);

    // file_put_contents($file, "Data: '" . $results . "'\n\n", FILE_APPEND);

    // Either the API is down or something else spooky happened. Just be done.
    if (!is_array($results->results) || empty($results->results)) {

        file_put_contents($file, "False \n\n", FILE_APPEND);

        return false;
    }

    $pokemons[] = $results->results;

    file_put_contents($file, "After set: '" . $pokemons[0] . "'\n\n", FILE_APPEND);

    foreach ($pokemons[0] as $pokemon) {

    file_put_contents($file, $current_page . " Pokemon: " . $pokemon->name . "\n\n", FILE_APPEND);

        $pokemon_slug = slugify($pokemon->name . '-' . $pokemon->id);

        // only name is working 
        // file_put_contents($file, "location_area_encounters: '" . $pokemon->location_area_encounters . "'\n\n", FILE_APPEND);

        $existing_pokemon = get_page_by_path($pokemon_slug, 'OBJECT', 'pokemon');

        if ($existing_pokemon === null) {

            file_put_contents($file, "CHECK \n\n", FILE_APPEND);
            $inserted_pokemon = wp_insert_post([
                'post_name' => $pokemon_slug,
                'post_title' => $pokemon_slug,
                'post_type' => 'pokemons',
                'post_status' => 'publish'
            ]);

            if (is_wp_error($inserted_pokemon) || $inserted_pokemon === 0) {
                // die('Could not insert brewery: ' . $brewery_slug);
                // error_log( 'Could not insert brewery: ' . $brewery_slug );
                continue;
            }

            // add meta fields
            $fillable = [
                'field_5f7beb75a0d11' => 'abilities',
                'field_5f7bed0862fe6' => 'forms',
                'field_5f7bebb5a0d12' => 'base_experience',
                'field_5f7bebe8a0d13' => 'game_indices',
                'field_5f7bec02a0d14' => 'height',
                'field_5f7bec0da0d15' => 'held_items',
                'field_5f7bec20a0d16' => 'id',
                'field_5f7bec2ba0d17' => 'is_default',
                'field_5f7bec35a0d18' => 'location_area_encounters',
                'field_5f7bec4ca0d19' => 'moves',
                'field_5f7bec57a0d1a' => 'name',
                'field_5f7bec5ca0d1b' => 'order',
                'field_5f7bec63a0d1c' => 'species',
                'field_5f7bec70a0d1d' => 'sprites',
                'field_5f7bec7da0d1e' => 'stats',
                'field_5f7bec89a0d1f' => 'types',
                'field_5f7bec8fa0d20' => 'weight',
            ];

            foreach ($fillable as $key => $name) {
                update_field($key, $pokemon->$name, $inserted_pokemon);
            }
        }

        // else {

        //     $existing_pokemon_id = $existing_pokemon->ID;
        //     $exisiting_brewerey_timestamp = get_field('updated_at', $existing_pokemon_id);

        //     if ($pokemon->updated_at >= $exisiting_brewerey_timestamp) {

        //         $fillable = [
        //             'field_5f7beb75a0d11' => 'abilities',
        //             'field_5f7bed0862fe6' => 'forms',
        //             'field_5f7bebb5a0d12' => 'base_experience',
        //             'field_5f7bebe8a0d13' => 'game_indices',
        //             'field_5f7bec02a0d14' => 'height',
        //             'field_5f7bec0da0d15' => 'held_items',
        //             'field_5f7bec20a0d16' => 'id',
        //             'field_5f7bec2ba0d17' => 'is_default',
        //             'field_5f7bec35a0d18' => 'location_area_encounters',
        //             'field_5f7bec4ca0d19' => 'moves',
        //             'field_5f7bec57a0d1a' => 'name',
        //             'field_5f7bec5ca0d1b' => 'order',
        //             'field_5f7bec63a0d1c' => 'species',
        //             'field_5f7bec70a0d1d' => 'sprites',
        //             'field_5f7bec7da0d1e' => 'stats',
        //             'field_5f7bec89a0d1f' => 'types',
        //             'field_5f7bec8fa0d20' => 'weight',
        //         ];

        //         foreach ($fillable as $key => $name) {
        //             update_field($name, $pokemon->$name, $existing_pokemon_id);
        //         }
        //     }
        // }
    }

    $current_page = $current_page + 1;
    // file_put_contents($file, "New current page: '" . $current_page . "'\n\n", FILE_APPEND);

    wp_remote_post(admin_url('admin-ajax.php?action=get_breweries_from_api'), [
        'blocking' => false,
        'sslverify' => false, // we are sending this to ourselves, so trust it.
        'body' => [
            'current_page' => $current_page
        ]
    ]);

}

function slugify($text)
{
    // remove unwanted characters
    $text = preg_replace('~[^-\w]+~', '', $text);

    // trim
    $text = trim($text, '-');

    // remove duplicate -
    $text = preg_replace('~-+~', '-', $text);

    // lowercase
    $text = strtolower($text);

    if (empty($text)) {
        return 'n-a';
    }

    return $text;
}



add_action('plugins_loaded', array('PokemonPlugin', 'get_instance'));

// TO RUN style.css
add_action('wp_enqueue_scripts', 'my_plugin_enqueue_styles');
function my_plugin_enqueue_styles()
{
    wp_enqueue_style('parent-style', plugin_dir_url(__FILE__) . '/assets/css/style.css');
}

if (class_exists('PokemonPlugin')) {
    $plugin = new PokemonPlugin();
}

// Activation
register_activation_hook(__FILE__, array($plugin, 'activate'));

// Deactivation 
register_deactivation_hook(__FILE__, array($plugin, 'deactivate'));

// Uninstall
