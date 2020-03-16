<?php if (get_post_type() === 'post'): ?>
    <a href="<?php the_permalink(); ?>" class="post-box">
        <div class="post-thumbnail">
            <?php 
                if (has_post_thumbnail()) {
                    the_post_thumbnail(array(246, 138));
                }
                else {
                    echo '<img class="no-image" src="'. get_template_directory_uri() .'/images/no-image.png">';
                }
            ?>
        </div>
        <div class="post-info">
            <h2 class="post-title"><?php title_limit($post->post_title); ?></h2>
            <time class="post-published">
                <i class="far fa-clock"></i>
                <span class="date"><?php echo get_the_date('Y.m.d', $post->ID); ?></span>
            </time>
        </div>
    </a>
<?php elseif (get_post_type() === 'page'): ?>
    <a href="<?php the_permalink(); ?>" class="post-box">
        <div class="page-search-item">
            <h2 class="post-title"><?php the_title(); ?></h2>
            <time class="post-published">
                <i class="far fa-clock"></i>
                <span class="date"><?php echo get_the_date('Y.m.d', $post->ID); ?></span>
            </time>
        </div>
    </a>
<?php endif ?>
