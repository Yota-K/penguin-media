<?php get_header(); ?>
    <main id="main" class="container">
        <div class="top-main-container">
            <div class="post-list">
            <?php if (have_posts()): ?>
                <?php while(have_posts()): the_post(); ?>
                    <a href="<?php the_permalink(); ?>" class="post-box">
                        <div class="post-thumbnail">
                            <?php 
                                if (has_post_thumbnail()) {
                                    the_post_thumbnail();
                                }
                                else {
                                    echo '<img class="no-image" src="'. get_template_directory_uri() .'/images/no-image.png">';
                                }
                            ?>
                        </div>
                        <div class="post-info">
                            <h2 class="post-title"><?php the_title(); ?></h2>
                            <time class="post-published">
                                <i class="far fa-clock"></i>
                                <span class="date"><?php echo get_the_date('Y.m.d', $post->ID); ?></span>
                            </time>
                        </div>
                    </a>
                <?php endwhile ?>
                <?php else: ?>
                    <p>記事がありません</p>
            <?php endif ?>
            <?php the_posts_pagination(array(
                    'prev_text' => '←',
                    'next_text' => '→',
                    'type' => 'list',
                )); 
            ?>
        </div>
        <?php get_sidebar(); ?>
        </div>
    </main>
<?php get_footer(); ?>
