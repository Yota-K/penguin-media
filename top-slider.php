<?php if ( is_home() || is_front_page() ): ?>
<div id="top-slider">
<div class="swiper-container">
    <div class="swiper-wrapper">
    <?php 
        $args = array(
            'post_type' => 'post',
            'posts_per_page' => 5,
            'order' => 'DESC',
        ); 
        $query_instance = new WP_Query($args); 
    ?>
    <?php if ( $query_instance->have_posts() ): ?>
    <?php while ( $query_instance->have_posts()): $query_instance->the_post(); ?>
        <div  class="swiper-slide">
            <div class="slide-container">
            <div class="swiper-img">
                <?php 
                    if (has_post_thumbnail()) {
                        the_post_thumbnail();
                    }
                    else {
                        echo '<img class="no-image" src="'. get_template_directory_uri() .'/images/no-image.png">';
                    }
                ?>
            </div>
            <div class="swiper-txt">
                <h2>
                    <a href="<?php the_permalink(); ?>" class="swiper-title"><?php the_title(); ?></a>
                </h2>
                <div class="post-info">
                    <?php get_post_info($post->ID); ?>
                </div>
            </div>
            </div>
        </div>
    <?php endwhile ?>
    <?php endif ?>
    <?php wp_reset_postdata(); ?>
    </div>
    <div class="swiper-pagination"></div>
</div>
</div>
<?php endif ?>
