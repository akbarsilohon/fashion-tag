<?php get_header(); ?>

<div class="container">
    <div class="fash_404_box">
        <h1 class="fash_404_title">404</h1>
        <p class="fash_404_sub_title">Halaman tidak ditemukan!</p>
        <p class="fash_404_desc">Halaman yang kamu kunjungi tidak ditemukan atau sudah berpindah ke url lain. Silahkan baca artikel lain atau kembali Beranda</p>

        <a href="<?php echo esc_url(home_url('/')); ?>" class="fash_action_404">
            <i class="fa-regular fa-house"></i>
            Beranda
        </a>
    </div>

    <?php
    $recentPosts = new WP_Query(array(
        'post_type'      => 'post',
        'post_status'    => 'publish',
        'posts_per_page' => 4
    ));

    if($recentPosts->have_posts()){ ?>

        <div class="fash_404_recent_post">
            <span class="fash_404_section_title">Artikel Terbaru</span>

            <div class="fash_404_loop_posts">
                <?php while($recentPosts->have_posts()){
                    $recentPosts->the_post(); ?>

                    <article id="post-<?php the_ID(); ?>" <?php post_class('fash_404_article'); ?>>
                        <a href="<?php the_permalink(); ?>" class="fash_404_thumb_link">
                            <?php if(has_post_thumbnail()){ ?>
                                <?php the_post_thumbnail('large'); ?>
                            <?php } else { ?>
                                <span class="fashlist-no-thumb" aria-hidden="true">
                                    <i class="fa-regular fa-image"></i>
                                </span>
                            <?php } ?>
                        </a>

                        <div class="fash_404_content">
                            <h3 class="fash_404_post_title">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_title(); ?>
                                </a>
                            </h3>
                        </div>
                    </article>

                <?php } ?>
            </div>
        </div>

        <?php
    }

    wp_reset_postdata();
    ?>
</div>

<?php get_footer(); ?>