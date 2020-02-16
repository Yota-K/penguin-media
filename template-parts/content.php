<article id="post-<?php the_ID(); ?>" <?php post_class('post-wrapper'); ?>>
    <div class="share-buttons-fixed">
        <?php sns_buttons(); ?>
    </div>
    <?php penguin_breadcrumb(); ?>
    <div class="post-header">
        <div class="post-title">
            <?php if (is_singular()): ?>
                <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
            <?php else: ?>
                <?php the_title('<h2 class="entry-title">', '</h2>'); ?>
            <?php endif ?>
        </div>
        <div class="post-info">
            <?php get_post_info($post->ID); ?>
        </div>
    </div>

    <div id="content">
	    <div class="entry-content">
            <div class="single-post-thumbnail">
            <?php 
                if (has_post_thumbnail()) {
                    the_post_thumbnail();
                }
                else {
                    echo '<img class="no-image" src="'. get_template_directory_uri() .'/images/no-image.png">';
                }
            ?>
            </div>
                <div id="penguin-toc"></div>
	        	<?php
                    the_content();
                    wp_link_pages(array(
                        'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'penguin_media' ),
                        'after'  => '</div>',
                    ));
	        	?>
	    </div>
        <div class="content-info">
            <?php related_posts($post->ID); ?>
            <div class="share-buttons">
                <?php sns_buttons(); ?>
            </div>
        </div>
    </div>
</article>
