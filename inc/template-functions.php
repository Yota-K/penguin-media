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

// ページネーションのカスタマイズ
function custom_pagination($template) {
    $template = '
        <nav class="navigation %1$s" role="navigation" aria-label="%4$s">
            <div class="nav-links">%3$s</div>
        </nav>';

    return $template;
}
add_action('navigation_markup_template', 'custom_pagination');
