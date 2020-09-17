<div class="at-pagination">
    <?php
    the_posts_pagination( array(
        'mid_size'  => 2,
        'prev_text' => __( 'Previous', 'aspro' ),
        'next_text' => __( 'Next', 'aspro' ),
    ) );
    ?>
</div>