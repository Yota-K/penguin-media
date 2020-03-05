<?php
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
