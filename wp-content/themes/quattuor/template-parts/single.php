<?php
/**
 * The template for displaying singular post-types: posts, pages and user-defined custom post types.
 *
 * @package HelloElementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

while ( have_posts() ) : the_post();
?>

<main id="site-content">
  <article <?php post_class( 'entry-post' ); ?>>
    
    <?php the_title( '<h1>', '</h1>' ); ?>
    <div class="post-meta">
           <time datetime="<?php echo esc_attr(get_the_date('c')); ?>" itemprop="datePublished"><?php echo get_the_date(); ?></time> -
           <?php the_category( ' / ' ); ?>
        </div>
    <div class="post-content"><?php the_content(); ?></div>
    <div class="post-tags">
		<?php the_tags(); ?>
	</div>
	<?php wp_link_pages(); ?>
	<?php comments_template(); ?>
       
  </article>

</main>
<?php
endwhile;