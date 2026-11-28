<?php get_header(); ?>

<?php
if (is_singular('post')) {
    $post_id = get_queried_object_id();
    $views = (int) get_post_meta($post_id, 'fash_post_views', true);
    update_post_meta($post_id, 'fash_post_views', $views + 1);
}
?>

<main class="container" id="main">
    <div class="fash_gridbox">
        <div class="fash_singular">
            <!-- Main artikel -->
            <article id="post-<?php the_ID(); ?>" class="fash_singular_main">
                <div class="fash_singular_header">
                    <!-- breadcrumbs -->
                    <div class="fash_breadc">
                        <a href="<?php echo home_url('/'); ?>" class="_breadc_uri">
                            <i class="fa-regular fa-house"></i>
                            Home
                        </a>
                        
                        <?php 
                        $cats = get_the_category(get_the_ID());
                        $cat = !empty($cats) ? $cats[0] : null;

                        if( !empty( $cat )){ ?>
                            <span class="_breadc_sparator">
                                <i class="fa-solid fa-angle-right"></i>
                            </span>
                            <a href="<?php echo esc_url(get_category_link($cat->term_id)); ?>" class="_breadc_uri">
                                <i class="fa-solid fa-tag"></i>
                                <?php echo esc_html($cat->name); ?>
                            </a>
                            <?php
                        }
                        ?>
                    </div>

                    <!-- Title and Info -->
                    <div class="fash_singular_info">
                        <?php
                        $author_id = get_post_field('post_author', get_the_ID());
                        $author_name = get_the_author_meta('display_name', $author_id);
                        $author_url = get_author_posts_url($author_id);
                        $author_avatar = get_avatar($author_id, 40);
                        ?>

                        <div class="fash_singular_author">
                            <a href="<?php echo esc_url($author_url); ?>" class="fash_singular_avatar">
                                <?php echo $author_avatar; ?>
                            </a>

                            <div class="fash_singular_author_detail">
                                <a href="<?php echo esc_url($author_url); ?>" class="fash_singular_author_name">
                                    <?php echo esc_html($author_name); ?>
                                </a>

                                <time datetime="<?php echo esc_attr(get_the_date('c')); ?>" class="fash_singular_date">
                                    <?php echo esc_html(get_the_date('d F Y')); ?>
                                </time>
                            </div>
                        </div>
                    </div>

                    <!-- Thumbnails -->
                    <?php if(has_post_thumbnail()){
                        the_post_thumbnail(
                            'full', 
                            array(
                                'class'     =>  'fash_singular_thumb',
                                'loading'   =>  'eager'
                            )
                        );
                    } ?>

                    <!-- The Content -->
                    <div class="fash_content">
                        <?php the_content(); ?>
                    </div>

                    <!-- Post tags -->
                    <div class="fash_singular_tags">
                        <?php
                        $tags = get_the_tags();
                        if ($tags) {
                            foreach ($tags as $tag) {
                                ?>
                                <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>" class="fash_singular_tag">
                                    <i class="fa-solid fa-hashtag"></i>
                                    <?php echo esc_html($tag->name); ?>
                                </a>
                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </article>

            <?php 
            // Render artikel terkait menggunakan OOP ---------
            Fash_Singular_Clases::_render_Related_Posts( get_the_ID(), 8);
            ?>

            <?php comments_template(); ?>
        </div>
        <?php get_sidebar(); ?>
    </div>
</main>

<?php get_footer();