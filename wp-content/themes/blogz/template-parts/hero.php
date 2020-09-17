<?php
/**
 * Display Hero Section.
 *
 * @package BlogZ
 */

$hero_bg = get_theme_mod( 'hero_bg', get_template_directory_uri() . '/images/header.jpg' );

$hero_img     = get_theme_mod( 'hero_img', get_template_directory_uri() . '/images/logo_overlay.png' );
$hero_img_alt = blogz_get_image_alt( $hero_img );

$hero_text = get_theme_mod( 'hero_text', esc_html__( 'BlogZ. Modern & Clean and Minimal Blog WordPress Theme', 'blogz' ) );
$bg_style  = ! empty( $hero_bg ) ? 'style="background-image: url(' . esc_url( $hero_bg ) . ')"' : '';
?>

<?php if ( is_front_page() ) : ?>

<section class="section-hero bg-cover bg-overlay" <?php echo wp_kses_post( $bg_style ); ?>>
	<div class="hero__inner container">
		<?php if ( ! empty( $hero_img ) ) : ?>
			<img src="<?php echo esc_url( $hero_img ); ?>" alt="<?php echo esc_attr( $hero_img_alt ); ?>">
		<?php endif; ?>
		<p><?php echo wp_kses_post( $hero_text ); ?></p>
		<?php
		if ( function_exists( 'jetpack_social_menu' ) ) {
			jetpack_social_menu();
		}
		?>
	</div>
	<?php get_template_part( 'template-parts/home/featured-posts' ); ?>
</section>

<?php else : ?>

<div class="page-header bg-cover bg-overlay">
	<div class="container">
		<div class="header-inner">
			<?php
			if ( is_singular( 'post' ) ) {
				// Trigger the_post() to setup post data.
				the_post();

				blogz_print_single_category();
				the_title( '<h1 class="entry-title">', '</h1>' );
				echo '<div class="entry-meta">';
					echo get_avatar( get_the_author_meta( 'ID' ), 70, '', '', array( 'class' => 'byline' ) );
					blogz_posted_by();
					blogz_posted_on();
					blogz_print_comment_link();
				echo '</div>';

				rewind_posts();

			} else {
				blogz_breadcrumbs();
			}
			?>
		</div>
	</div>
</div>

<?php endif; ?>
