<div id="grobal-nav">
    <div class="nav-wrapper">
    <div class="nav-container">
        <button class="close-btn">
            <i class="fas fa-times"></i>
            <span class="text">CLOSE</span>
        </button>
        <nav id="site-navigation">
            <?php if ( is_active_sidebar('nav-widget-1') ): ?>
                <?php dynamic_sidebar('nav-widget-1'); ?>
            <?php endif ?>
            <?php if( has_nav_menu('header-nav') ): ?>
            <h2 class="menu-title">メインメニュー</h2>
            <?php
                wp_nav_menu(array(
                    'theme_location' => 'header-nav',
                    'menu_id'        => 'header-menu',
                ));
            ?>
            <?php endif ?>
            <?php if ( is_active_sidebar('nav-widget-2') ): ?>
                <?php dynamic_sidebar('nav-widget-2'); ?>
            <?php endif ?>
        </nav>
        <button class="close-btn">
            <i class="fas fa-times"></i>
            <span class="text">CLOSE</span>
        </button>
    </div>
    </div>
</div>
