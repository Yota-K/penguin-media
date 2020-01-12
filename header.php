<!DOCTYPE html>
<html <?php language_attributes() ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body>
	<header id="header">
        <div class="header-container">
			<?php
			the_custom_logo();
			if ( is_front_page() && is_home() ) :
				?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php
			else :
				?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php
			endif;
			$penguin_media_description = get_bloginfo( 'description', 'display' );
			if ( $penguin_media_description || is_customize_preview() ) :
				?>
				<p class="site-description"><?php echo $penguin_media_description; /* WPCS: xss ok. */ ?></p>
			<?php endif; ?>
            <div class="nav-button">
                <a class="menu-trigger" href="#">
                    <span></span>
                    <span></span>
                    <span></span>
                </a>
            </div>
		</div>
        <?php get_template_part('header-nav'); ?>
	</header>
<div id="content-wrapper">
<?php get_template_part('top-slider'); ?>
