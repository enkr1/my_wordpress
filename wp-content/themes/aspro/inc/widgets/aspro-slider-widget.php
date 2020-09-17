<?php

/**
 * Class Aspro_Slider_Widget
 */
class Aspro_Slider_Widget extends WP_Widget
{

    /**
     * Aspro_Slider_Widget constructor.
     */
    function __construct()
    {
        $widget_ops = array(
            'classname'      =>  'aspro_slider_widget',
            'description'    =>  esc_html__( 'Best for Front Page', 'aspro' )
        );

        parent::__construct(
            'aspro_slider_widget',
            '&nbsp;' . esc_html__( 'Aspro: Slider', 'aspro' ),
            $widget_ops
        );
    }

    /**
     * Widget update.
     *
     * @param $new_instance
     * @param $old_instance
     * @return mixed
     */
    function update( $new_instance, $old_instance ) {
        $instance             =  $old_instance;
        $instance['category'] =  absint( $new_instance['category'] );


        return $instance;
    }

    /**
     * Form view.
     *
     * @param $instance
     */
    function form( $instance )
    {
        ?>
        <div class="widget-slider">
            <p>
                <label class=""
                       for="<?php echo $this->get_field_id( 'category' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped?>">
                    <?php esc_html_e( 'Select category:', 'aspro' ); ?></label>
                    <?php
                        wp_dropdown_categories(array(
                            'show_option_none' => ' ',
                            'name' => $this->get_field_name( 'category' ), // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                            'selected' => (isset($instance['category']) && $instance['category'] != '')?absint($instance['category']):0
                        ));
                    ?>
            </p>
        </div>
        <?php
    }

    /**
     * Widget view.
     *
     * @param $args
     * @param $instance
     */
    function widget( $args, $instance ) {

        $oren_slider_category = isset($instance['category'])?$instance['category']:0;

        if($oren_slider_category && get_query_var('page') < 2 ) :

            echo $args['before_widget']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
            ?>
            <div class="at-container">
                <div class="row">
                    <div class="col-12">
                        <div class="swiper-container at-slider__container">
                            <div class="swiper-wrapper">
                                <?php
                                $cherry_biz_pro_blogs = new WP_Query(array(
                                    'post_type'      =>  'post',
                                    'category__in'   =>  absint($oren_slider_category)
                                ));

                                if($cherry_biz_pro_blogs->have_posts()) :
                                    while ($cherry_biz_pro_blogs->have_posts()):$cherry_biz_pro_blogs->the_post();
                                        ?>
                                        <div class="swiper-slide">
                                            <div class="at-banner d-flex align-items-center justify-content-center"
                                                <?php if(has_post_thumbnail()) { ?>
                                                    style="background-image: url('<?php the_post_thumbnail_url(); ?>');"
                                                <?php } ?>>
                                                <div class="at-banner__info text-center">
                                                    <h2 class="at-banner__title"><?php the_title(); ?></h2>
                                                    <p class="at-banner__content">
                                                        <?php echo wp_trim_words(get_the_excerpt(), 16); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                                                    </p>
                                                    <div class="at-banner__btn">
                                                        <a href="<?php the_permalink(); ?>" class="btn btn--white">
                                                            <?php echo esc_html__('Read More', 'aspro')?> <i class="fas fa-chevron-right"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    endwhile;
                                    wp_reset_postdata();
                                endif;
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
            echo $args['after_widget']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        endif;
    }
}


add_action( 'widgets_init', 'aspro_slider_widget' );
function aspro_slider_widget(){
    register_widget( 'Aspro_Slider_Widget' );

}

