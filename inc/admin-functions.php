<?php

/* ------------------------------
 投稿一覧画面
------------------------------ */

// アイキャッチ用のカラムを追加
function add_column($column) {
    $column['thumbnail'] = 'アイキャッチ';
    return $column;
}
add_filter('manage_posts_columns', 'add_column');

// アイキャッチを表示
function add_postlist_eyecatch($column, $post_id) {
    if ($column === 'thumbnail') {
        $thumbnail = get_the_post_thumbnail($post_id, array(100, 100), 'thumbnail');

        if (empty($thumbnail)) {
            echo 'ー';
        }

        echo $thumbnail;
    }
}
add_filter('manage_posts_custom_column', 'add_postlist_eyecatch', 10, 2);

/* ------------------------------
 投稿編集画面
------------------------------ */

// 投稿画面のサムネイルの警告文
function thumbnail_attention($content) {
    return $content .= '<p>推奨サイズ：246px × 138px</p>';
}
add_filter('admin_post_thumbnail_html', 'thumbnail_attention');
