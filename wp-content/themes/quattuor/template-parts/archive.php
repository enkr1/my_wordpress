<?php
/**
 * The template for displaying archive pages.
 *
 * @package Quattuor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<main id="site-content">
    
<?php
    if(!is_home()){
        the_archive_title( '<h1 class="entry-title">', '</h1>' );
        the_archive_description( '<p class="archive-description">', '</p>' );
    }
?>
  
<?php
while ( have_posts() ) {
	the_post();
	$post_link = get_permalink();
	?>
	<article class="entry-post">
		<?php
		printf( '<h2 class="%s"><a href="%s">%s</a></h2>', null, esc_url( $post_link ), esc_html( get_the_title() ) ); ?>
		
		<div class="post-meta">
           <time datetime="<?php echo esc_attr(get_the_date('c')); ?>" itemprop="datePublished"><?php echo get_the_date(); ?></time> -
           <?php the_category( ' / ' ); ?>
        </div>
		
		<?php
		if ( has_post_thumbnail() ){
			printf( '<a href="%s">%s</a>', esc_url( $post_link ), get_the_post_thumbnail( $post, 'large' ) );
		}
	
		the_excerpt();
	
		printf( '<a href="%s" class="read-more">%s</a>', esc_url( $post_link ),  esc_html__('Read More &#8594;','quattuor'));
		?>	
	</article>
<?php } 
	
the_posts_pagination( array(
		'prev_text'          => '<',
		'next_text'          => '>',
		) );
?>
</main>