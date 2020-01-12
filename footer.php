</div><!-- #content -->

<footer id="footer">
    <div class="container">
    <div class="footer-widget-areas">
        <?php if ( is_active_sidebar('footer-widget-1') ): ?>
            <?php dynamic_sidebar('footer-widget-1'); ?>
        <?php endif ?>
        <?php if ( is_active_sidebar('footer-widget-2') ): ?>
            <?php dynamic_sidebar('footer-widget-2'); ?>
        <?php endif ?>
        <?php if ( is_active_sidebar('footer-widget-3') ): ?>
            <?php dynamic_sidebar('footer-widget-3'); ?>
        <?php endif ?>
    </div>
    </div>
    <?php 
        wp_nav_menu(array(
            'theme_location' => 'footer-nav',
            'menu_id' => 'footer-menu',
        )); 
    ?>
    <p class="copy-right">
        © <?php echo date('Y'); ?> 
        <?php echo get_bloginfo('name'); ?> All rights reserved.
    </p>
</footer>
<?php wp_footer(); ?>
<?php adminbar_fixed_clear(); ?>
<?php if (is_single()): ?>
    <script>
        jQuery(function($){
           // 目次のずれを修正
           $('.toc-container ul > li > a').click(function() {
               const id = $(this).attr('href');
               const position = $(id).offset().top - 145;
               $('html, body').animate({
                   'scrollTop':position
               },500);
            });
        });
    </script>
<?php endif; ?>
</body>
</html>
