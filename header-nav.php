<div id="grobal-nav">
    <div class="nav-container">
    <nav id="site-navigation">
        <?php if ( is_active_sidebar('nav-widget-1') ): ?>
            <?php dynamic_sidebar('nav-widget-1'); ?>
        <?php endif ?>
        <?php
            wp_nav_menu(array(
                'theme_location' => 'header-nav',
                'menu_id'        => 'header-menu',
            ));
        ?>
        <?php if ( is_active_sidebar('nav-widget-2') ): ?>
            <?php dynamic_sidebar('nav-widget-2'); ?>
        <?php endif ?>
    </nav>
    </div>
</div>
