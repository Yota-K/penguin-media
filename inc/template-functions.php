<?php 

function penguin_media_body_classes( $classes ) {
    // Adds a class of hfeed to non-singular pages.
    if ( ! is_singular() ) {
        $classes[] = 'hfeed';
    }

    // Adds a class of no-sidebar when there is no sidebar present.
    if ( ! is_active_sidebar( 'sidebar-1' ) ) {
        $classes[] = 'no-sidebar';
    }

    return $classes;
}
add_filter( 'body_class', 'penguin_media_body_classes' );

function penguin_media_pingback_header() {
    if ( is_singular() && pings_open() ) {
        printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
    }
}
add_action('wp_head', 'penguin_media_pingback_header');

// 投稿日時とカテゴリーを取得
function get_post_info( $post_id ) {
        $get_the_date = get_the_date('Y.m.d', $post_id);
    ?>
        <div class="post-category"><?php the_category(' '); ?></div>
        <time class="post-published">
            <i class="far fa-clock"></i>
            <span class="date"><?php echo $get_the_date; ?></span>
        </time>
    <?php
}

// SNSボタン
function sns_buttons() {
        $url_encode = urlencode( get_permalink() );
        $title_encode = urlencode( get_the_title() ).'｜'.get_bloginfo('name');
    ?>
    <ul class="share">
        <li class="twitter">
        <a href="//twitter.com/intent/tweet?url=<?php echo $url_encode; ?>&text=<?php echo $title_encode; ?>&tw_p=tweetbutton" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;">
            <i class="fab fa-twitter"></i>
        </a>
        </li>
        <li class="facebook">
        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $url_encode; ?>&t=<?php echo $title_encode; ?>" target="blank" rel="nofollow">
            <i class="fab fa-facebook"></i>
        </a>
        </li>
        <li class="line">
        <a href="https://social-plugins.line.me/lineit/share?url=<?php echo $url_encode; ?>" target="_blank" rel="nofollow" title="Lineで共有">
            <i class="fab fa-line"></i>
        </a>
        </li>
      </ul>
    <?php
}

// 関連記事を表示
function related_posts($post_id) {
    $categories = get_the_category($post_id);
    $category_id = array();

    foreach ($categories as $category) {
        array_push($category_id, $category->cat_ID);
    }

    $args = array(
        'post__not_in' => array($post_id),
        'posts_per_page' => 3,
        'category__in' => $category_id,
        'orderby' => 'rand',
    );

    $query_instance = new WP_Query($args);
    ?>
        <div class="related-posts">
            <h2 class="related-heading">他の人はこんな記事も読んでいます</h2>
            <?php if($query_instance->have_posts()): ?>
                <?php while($query_instance->have_posts()): $query_instance->the_post(); ?>
                    <div class="related-post">
                        <div class="related-thumbnail">
                            <?php if(has_post_thumbnail()): ?>
                                <?php the_post_thumbnail(array(100, 100)); ?>
                            <?php else: ?>
                                <?php echo '<img class="no-image" src="'. get_template_directory_uri() .'/images/no-image.png">'; ?>
                            <?php endif ?>
                        </div>
                        <h3 class="related-title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h3>
                    </div>
                <?php endwhile ?>
            <?php endif ?>
        </div>
    <?php
}

// パンくず
function penguin_breadcrumb() {
    $site_title = get_bloginfo('name');
    $site_url = site_url();

    if (is_home() || is_front_page()) {
        return false;
    }

    echo '<div id="breadcrumb">' . '<ul>';
    echo '<li>' . '<a href="'. $site_url .'">'. $site_title .'</a>' . '</li>';

    //else if (is_category()) {
    //    $cat = get_queried_object();
    //    $cat_id = $cat->parent;
    //    $cat_list = [];


    //}
    //else if (is_single()) {}

    echo '</ul>' . '</div>';
}
