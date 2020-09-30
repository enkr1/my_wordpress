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
        // add_action('init', array($this, 'cw_post_type_pokemon'));
        // add_action('init', array($this, 'pokemon_taxonomy'));
        add_shortcode('pokemons', array($this, 'pokemons_function'));
        add_shortcode('pokemon_single', array($this, 'pokemon_single_function'));

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
            'templates/single-pokemons.php' => 'Pokemon'
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

    function pokemons_function()
    {
        // First ini
        $displayPokemon = 10; // The number of pokemon per page
        $noOfPokemon = $displayPokemon; // Current total number of pokemon
        $pageNo = 1;
        $prevPage = 0;
        $nextPage = $pageNo + 1;
        $startFrom = 1; 

        $data = "<div id='poke_container' class='poke-container'>";

        if (isset($_GET['pageNo']) && $_GET['pageNo'] > 1) {
            //It will return true if the $variable is defined. if the variable is not defined it will return false
            $pageNo = $_GET['pageNo'];
            $startFrom = (($displayPokemon * $pageNo) - $displayPokemon) + $startFrom;
            $displayPokemon = ($displayPokemon * $pageNo);
            $prevPage = $pageNo - 1;
            $nextPage = $pageNo + 1;
        }

        // $startFrom is ID 
        for ($startFrom; $startFrom <= $displayPokemon; $startFrom++) { // Maximum number is 893
            $api = curl_init("https://pokeapi.co/api/v2/pokemon/" . $startFrom);
            curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($api);
            curl_close($api);
            $pokemon = json_decode($response);

            $name = ucfirst($pokemon->name);
            $number = str_pad($startFrom, 3, "0", STR_PAD_LEFT);
            $types = "";
            for ($i = 0; $i < count($pokemon->types); $i++) {
                if ($i != 0) {
                    $types .= ', ' . ucfirst($pokemon->types[$i]->type->name);
                } else {
                    $types .= ucfirst($pokemon->types[$i]->type->name);
                }
            }

            $data .= "
                <a href='/pokemon-single/?id=$startFrom'>
                    <div class='pokemon'>
                        <span class='number'>ID: $number</span>
                        <div class='img-container'>
                            <img src='https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/versions/generation-v/black-white/animated/$startFrom.gif' alt='$pokemon->name' />
                        </div>
                        <div class='info'>
                            <h3 class='name'>$name</h3>
                            <small class='type'>Type(s): <span class='pokemon-type'>$types</span></small>
                        </div>
                    </div>
                </a>
            ";
            $noOfPokemon = $startFrom; // Reset the last ID or total number
        }

        return $data .
            "
        </div>
        <input type='hidden' id='pageNo' name='pageNo' value='$pageNo'>
        <input type='hidden' id='noOfPokemon' name='noOfPokemon' value='$noOfPokemon'>
        <div class='pokemon-buttons'>
            <a href='/pokemon/?pageNo=$prevPage'><button class='pokemon-previous' id='pokemon-previous'>PREVIOUS</button></a><a href='/pokemon/?pageNo=$nextPage'><button class='pokemon-next' id='pokemon-next'>NEXT</button></a>
        </div>";
    }

    function pokemon_single_function()
    {
        $id = $_GET['id'];

        $data = "<div id='poke_container' class='poke-container poke-single-container'>";
        $api = curl_init("https://pokeapi.co/api/v2/pokemon/" . $id);
        curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($api);
        curl_close($api);
        $pokemon = json_decode($response);

        $name = ucfirst($pokemon->name);
        $number = str_pad($id, 3, "0", STR_PAD_LEFT);
        $types = "";
        for ($i = 0; $i < count($pokemon->types); $i++) {
            if ($i != 0) {
                $types .= ', ' . ucfirst($pokemon->types[$i]->type->name);
            } else {
                $types .= ucfirst($pokemon->types[$i]->type->name);
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
                    <img class='pokemon-img-hover' src='https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/dream-world/$id.svg' alt='$pokemon->name'/>
                </div>
                <div class='info'>
                    <h1 class='name'>$name</h1>
                    <small class='type'>Type(s): <span class='pokemon-type'>$types</span></small><br>
                    <small class='weight'>Weight: <span class='pokemon-weight'>$pokemon->weight</span></small><br>
                    <small class='type'>Type: <span class='pokemon-type'>$types</span></small>
                    <div class='pokemon-stats'>$stats</div>
                </div>
            </div>";

        return $data . "</div>";
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
