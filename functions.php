<?php

/* ------------------------------
セットアップ
------------------------------ */
function penguin_media_setup() {

    // rssリンクをhead内に出力
    add_theme_support('automatic-feed-links');

    // titleタグを出力
	add_theme_support('title-tag');

    // サムネイル画像を使用可能に
	add_theme_support('post-thumbnails');

    // メニューを有効にする
    add_theme_support('menus');

    // メニューの登録を行う
    register_nav_menus(array(
        'header-nav' => 'ヘッダーメニュー',
        'footer-nav' => 'フッターメニュー',
    ));

	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	));

	add_theme_support( 'custom-background', apply_filters( 'penguin_media_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	add_theme_support( 'customize-selective-refresh-widgets' );

	add_theme_support( 'custom-logo', array(
		'height'      => 250,
		'width'       => 250,
		'flex-width'  => true,
		'flex-height' => true,
	));

	load_theme_textdomain( 'penguin_media', get_template_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'penguin_media_setup' );

/* ------------------------------
ウィジェットの定義
------------------------------ */
function penguin_media_widgets_init() {
    if ( function_exists('register_sidebar') ) {
	    register_sidebar(array(
	    	'name'          => 'サイドバー',
	    	'id'            => 'sidebar-1',
	    	'description'   => 'メインのサイドバーです。',
	    	'before_widget' => '<section id="%1$s" class="widget %2$s">',
	    	'after_widget'  => '</section>',
	    	'before_title'  => '<h2 class="widget-title">',
	    	'after_title'   => '</h2>',
	    ));

        register_sidebar(array(
            'name' => 'ナビウィジェット1',
            'id' => 'nav-widget-1',
            'description' => 'ナビゲーション上部のウィジェットエリアです。',
            'before_widget' => '<div class="widget">',
            'after_widget' => '</div>',
            'before_title' => '<h2 class="widget-title">',
            'after_title' => '</h2>',
        ));

        register_sidebar(array(
            'name' => 'ナビウィジェット2',
            'id' => 'nav-widget-2',
            'description' => 'ナビゲーション下部のウィジェットエリアです。',
            'before_widget' => '<div class="widget">',
            'after_widget' => '</div>',
            'before_title' => '<h2 class="widget-title">',
            'after_title' => '</h2>',
        ));

        register_sidebar(array(
            'name' => 'トップウィジェットエリア1',
            'id' => 'top-widget-1',
            'description' => 'トップページ上部のウィジェットエリアです。',
            'before_widget' => '<div class="widget top-widget">',
            'after_widget' => '</div>',
            'before_title' => '<h2 class="widget-title">',
            'after_title' => '</h2>',
        ));

        register_sidebar(array(
            'name' => 'トップウィジェットエリア2',
            'id' => 'top-widget-2',
            'description' => 'トップページ下部のウィジェットエリアです。',
            'before_widget' => '<div class="widget top-bottom-widget">',
            'after_widget' => '</div>',
            'before_title' => '<h2 class="widget-title">',
            'after_title' => '</h2>',
        ));

        register_sidebar(array(
            'name' => 'フッターウィジェット１',
            'id' => 'footer-widget-1',
            'description' => 'フッター下部（左側）のウィジェットエリアです。',
            'before_widget' => '<div class="widget footer-widget">',
            'after_widget' => '</div>',
            'before_title' => '<h2 class="widget-title">',
            'after_title' => '</h2>',
        ));

        register_sidebar(array(
            'name' => 'フッターウィジェット2',
            'id' => 'footer-widget-2',
            'description' => 'フッター下部（中央）のウィジェットエリアです。',
            'before_widget' => '<div class="widget footer-widget">',
            'after_widget' => '</div>',
            'before_title' => '<h2 class="widget-title">',
            'after_title' => '</h2>',
        ));

        register_sidebar(array(
            'name' => 'フッターウィジェット3',
            'id' => 'footer-widget-3',
            'description' => 'フッター下部（右側）のウィジェットエリアです。',
            'before_widget' => '<div class="widget footer-widget">',
            'after_widget' => '</div>',
            'before_title' => '<h2 class="widget-title">',
            'after_title' => '</h2>',
        ));

    }
}
add_action( 'widgets_init', 'penguin_media_widgets_init' );

/* ------------------------------
投稿一覧の横にアイキャッチを表示
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

// bundleしたjsとcssを読み込む
function penguin_media_scripts() {
    wp_enqueue_script('bundle-js', get_template_directory_uri() . '/dist/bundle.js', array(), '20191230');
}
add_action( 'wp_enqueue_scripts', 'penguin_media_scripts' );

// 管理バーの重なりを防ぐ
function adminbar_fixed_clear() {
    if ( is_user_logged_in() ) {
        ?>
        <script>
        jQuery(function($) {
            const adminBar = $('#wpadminbar').height();
            $('#header').css('margin-top', adminBar + 'px');
        });
        </script>
    <?php 
    }
}

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

// テーマ内の関数
require get_template_directory() . '/inc/custom-header.php';
require get_template_directory() . '/inc/template-functions.php';
require get_template_directory() . '/inc/customizer.php';

function penguin_media_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'penguin_media_content_width', 640 );
}
add_action( 'after_setup_theme', 'penguin_media_content_width', 0 );

if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}
