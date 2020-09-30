<?php
/* Template Name: Recipes */
get_header();
query_posts(array(
    'posts_per_page' => -1,
    'post_type' => 'recipes'
)); ?>

<div class="template-recipes-container">
    <div class="template-recipes-main-display">
        <h1>My Recipes</h1>
    </div>
    <div class="template-recipe-rows-container">
        <?php
        while (have_posts()) : the_post();

            $post_thumbnail_id     = get_post_thumbnail_id();
            $product_thumbnail     = wp_get_attachment_image_src($post_thumbnail_id, $size = 'recipe-image');
            $product_thumbnail_alt = get_post_meta($post_thumbnail_id, '_wp_attachment_image_alt', true);

        ?>
            <div class="template-recipe-row">
                <?php
                if ($product_thumbnail != null) {
                ?>
                    <img src="<?php echo $product_thumbnail[0]; ?>" alt="<?php echo $product_thumbnail_alt; ?>">
                <?php
                } else {
                ?>
                    <img src="/wp-content/uploads/woocommerce-placeholder.png" alt="No Image Shown">
                <?php
                }
                ?>

                <div class="template-recipe-excerpt">
                    <p class="posted-detail">Posted by <?php the_author(); ?> <?php echo human_time_diff(get_the_time('U'), current_time('timestamp')); ?></p>
                    <h2><?php the_title(); ?></h2>
                    <p><?php the_excerpt(); ?></p>
                    <a href="<?php the_permalink() ?>">
                        <button class="template-recipe-btn">VIEW RECIPE</button>
                    </a>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<?php
get_footer();
?>