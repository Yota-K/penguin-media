<article id="post-<?php the_ID(); ?>" <?php post_class('post-wrapper'); ?>>
    <?php penguin_breadcrumb(); ?>
    <div class="post-header">
        <div class="post-title">
            <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
        </div>
    </div>

    <div id="content">
        <div class="entry-content">
            <?php
                the_content();

                wp_link_pages(array(
                    'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'penguin_media' ),
                    'after'  => '</div>',
                ));
            ?>
            <?php if( is_page('sitemap') ): ?>
                <?php penguin_sitemap(); ?>
            <?php endif ?>
        </div>
	</div>
</article>
