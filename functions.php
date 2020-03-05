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

// bundleしたjsとminify化したcssを読み込む
function penguin_media_scripts() {
    wp_enqueue_style('penguin-css', get_template_directory_uri() . '/dist/css/style.css');
    wp_enqueue_script('bundle-js', get_template_directory_uri() . '/dist/bundle.js', array(), '20191230');
}
add_action('wp_enqueue_scripts', 'penguin_media_scripts');

// テーマ内の関数
require get_template_directory() . '/inc/admin-functions.php';
require get_template_directory() . '/inc/custom-header.php';
require get_template_directory() . '/inc/template-functions.php';
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/widget-functions.php';

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
