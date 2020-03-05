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

// archive.phpーの：を削除
function custom_archive_title($title) {
    if ( is_category() ) {
        $title = single_cat_title('', false);
    } 
    elseif ( is_tag() ) {
        $title = single_tag_title('', false);
	} 
    elseif ( is_tax() ) {
	    $title = single_term_title('', false);
	} 
    elseif ( is_post_type_archive() ){
		$title = post_type_archive_title('',false);
	} 
    elseif ( is_date() ) {
	    $title = get_the_time('Y年n月');
	} 
    elseif ( is_search() ) {
	    $title = '検索結果：'.esc_html( get_search_query(false) );
	} 
    elseif (is_404()) {
	    $title = '「404」ページが見つかりません';
	} 
    else {
        return false;
	}
    return $title;
}
add_filter('get_the_archive_title', 'custom_archive_title');

// 記事タイトルを32文字以内で表示
function title_limit( $post_title ) {
    $str_length = mb_strlen( $post_title );

    if ( $str_length > 33 ) {
        $title = mb_substr( $post_title, 0, 33 );
        echo $title . '...';
    }
    else {
        echo $post_title;
    }

}

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
    $site_url = home_url();

    echo '<div id="breadcrumb">' . '<ul>';
    echo '<li>' . '<i class="fa fa-home" aria-hidden="true"></i>' . '<a href="'. $site_url .'">'. $site_title .'</a>' . '</li>';

    if ( is_home() || is_front_page() ) {
        return false;
    }
    else if ( is_category() ) {
        $cat = get_queried_object();

        $cat_id = $cat->cat_ID;
        $parent_id = $cat->parent;
        $parent_index = 0;

        // 親カテゴリーのみの場合
        if ($parent_id === $parent_index) {
            $category = get_category($cat_id);
            $category_link = get_category_link($cat_id);

            echo '<li>' . '<a href="'. $category_link .'">'. $category->name .'</a>' . '</li>';
        }
        // 子カテゴリーがある場合
        else {
            $categories_str = get_category_parents($cat_id);
            $categories = explode('/', $categories_str);
            $remove_last_str = array_pop($categories);

            foreach ($categories as $category_name) {
                $category_id = get_cat_ID($category_name);
                $category_link = get_category_link($category_id);

                echo '<li>' . '<a href="'. $category_link .'">'. $category_name .'</a>' . '</li>';
            }

        }
    }
    else if ( is_single() ) {
        $categories = get_the_category();
        $category_link = get_category_link($categories[0]->cat_ID);
        $category_name = $categories[0]->name;

        echo '<li>' . '<a href="'. $category_link .'">'. $category_name .'</a>' . '</li>';

        // 子カテゴリーがある場合
        foreach($categories as $category) {
            $parent_index = 0;

            if ($category->parent !== $parent_index) {
                $category_link = get_category_link($category->cat_ID);

                echo '<li>' . '<a href="'. $category_link .'">'. $category->name .'</a>' . '</li>';
            }
        }
    }
    else if( is_page() ) {
        echo the_title('<li>', '</li>');
    }
    else if ( is_archive() ) {
        echo the_archive_title('<li>', '</li>');
    }
    else if ( is_404() ) {
        echo '<li>ページが見つかりません</li>';
    }

    echo '</ul>' . '</div>';
}

 // サイトマップ
function penguin_sitemap() {
    $site_title = get_bloginfo('name');

    $categories_args = array(
        'orderby' => 'name',
        'order' => 'ASC',
    );
    $categories = get_categories($categories_args);

    $pages = get_pages();
    ?>
        <ul id="penguin-sitemap">
            <li><a href="<?php echo home_url(); ?>"><?php echo $site_title; ?></a></li>
            <ul class="categories">
                <?php foreach($categories as $category): ?>
                    <li>
                        <a href="<?php echo get_category_link($category->term_id); ?>">
                            <?php echo $category->name; ?>
                        </a>
                        <ul class="post-name">
                            <?php 
                                $posts_args = array(
                                    'cat' => $category->term_id,
                                );
                                $query_instance = new WP_Query($posts_args);

                                if ($query_instance->have_posts()):
                                while($query_instance->have_posts()): $query_instance->the_post(); 
                            ?>
                                <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                            <?php endwhile; endif; wp_reset_postdata(); ?>
                        </ul>
                    </li>
                <?php endforeach; ?>
            </ul>
            <ul class="pages">
                <?php foreach($pages as $page): ?>
                    <li>
                        <a href="<?php echo get_page_link($page->ID); ?>"><?php echo $page->post_title; ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </ul>
    <?php
}
