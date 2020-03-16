<?php get_header(); ?>
    <main id="main" class="container">
    <div class="top-main-container">
        <div class="post-list">

        <div class="post-header">
            <div class="post-title">
                <h1><?php the_search_query(); ?> の検索結果</h1>
            </div>
        </div>
 
        <?php
        if (have_posts() && get_search_query()) : 
            while (have_posts()) :
            the_post();
            get_template_part( 'template-parts/content', 'search' );
        endwhile;
        ?>
 
        <?php else : ?>
            <div class="col-full">
                <div class="wrap-col">
                    <p>検索キーワードに該当する記事がありませんでした。</p>
                </div>
            </div>
        <?php endif; ?>

        </div>
    </div>
    </main>
<?php get_footer(); ?>
