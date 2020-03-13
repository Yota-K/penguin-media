<?php

// カスタマイザー 
function penguin_media_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'penguin_media_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'penguin_media_customize_partial_blogdescription',
		) );
	}
}
add_action('customize_register', 'penguin_media_customize_register');

// 色の設定
function penguin_media_color_customize_register( $wp_customize ) {
    $settings_ary = array(
        'setting_1' => array(
            'setting' => 'header_bg_setting',
            'default' => '#fff',
            'label_name' => 'ヘッダーの背景色',
            'priority' => 1,
        ),
        'setting_2' => array(
            'setting' => 'key_color_1',
            'default' => '#6262f7',
            'label_name' => 'キーカラー1',
            'priority' => 20,
        ),
        'setting_3' => array(
            'setting' => 'key_color_2',
            'default' => '#ccf9f1',
            'label_name' => 'キーカラー2',
            'priority' => 20,
        ),
    );

    foreach($settings_ary as $key => $setting) {
        $wp_customize->add_setting($setting['setting'], array(
            'default' => $setting['default']
        ));
        $wp_customize->add_control(
            new WP_Customize_Color_Control(
                $wp_customize,
                $setting['setting'],
                array(
                    'label' => $setting['label_name'],
                    'section' => 'colors',
                    'settings' => $setting['setting'],
                    'priority' => $setting['priority'],
                )
            )
        );
    };

}
add_action('customize_register', 'penguin_media_color_customize_register');

// 色の反映
function customizer_color() {
    ?>
    <style>
    #header {
        background: <?php echo get_theme_mod('header_bg_setting'); ?>;
    }

    .widget h2, #top-slider .swiper-container .swiper-pagination-bullets .swiper-pagination-bullet-active {
        border-color: <?php echo get_theme_mod('key_color_1'); ?>;
    }

    #top-slider .swiper-container .swiper-wrapper .swiper-slide .slide-container .swiper-txt h2 a {
        background: linear-gradient(to top, <?php echo get_theme_mod('key_color_1'); ?>, 4px, #fff 4px);
    }

    #top-slider .swiper-container .swiper-pagination-bullets .swiper-pagination-bullet-active, 
    #top-slider .swiper-container .swiper-wrapper .swiper-slide .slide-container .swiper-txt .post-info a:hover,
    #main .tagcloud a:hover,
    .post-wrapper .post-header .post-info .post-category a:hover,
    #grobal-nav .widget-title,
    #grobal-nav .menu-title,
    #grobal-nav .nav-wrapper .nav-container #site-navigation .search-form .search-submit
    {
        background: <?php echo get_theme_mod('key_color_1'); ?>;
    }

    .post-wrapper #content .entry-content .toc-container {
        border-top-color: <?php echo get_theme_mod('key_color_1'); ?>;
    }

    #main .post-list .post-box:hover {
        background: <?php echo get_theme_mod('key_color_2'); ?>;
    }
    </style>
    <?php
}
add_action('wp_head', 'customizer_color');

function penguin_media_customize_partial_blogname() {
	bloginfo( 'name' );
}

function penguin_media_customize_partial_blogdescription() {
	bloginfo( 'description' );
}
