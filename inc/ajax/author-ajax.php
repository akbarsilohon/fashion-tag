<?php

// Author Ajax ==================================
add_action('wp_ajax_fash_author_load_more', 'fash_author_load_more');
add_action('wp_ajax_nopriv_fash_author_load_more', 'fash_author_load_more');

function fash_author_load_more(){
    $paged  = isset($_POST['page']) ? max(1, intval($_POST['page'])) : 1;
    $author = isset($_POST['author']) ? intval($_POST['author']) : 0;
    $args = [
        'post_type'      => 'post',
        'posts_per_page' => get_option('posts_per_page'),
        'paged'          => $paged
    ];

    if($author){
        $args['author'] = $author;
    }
    $query = new WP_Query($args);

    if($query->have_posts()){
        while($query->have_posts()){
            $query->the_post(); ?>
                <article id="post-<?php the_ID(); ?>" class="fash_listbiasa">
                    <a href="<?php the_permalink(); ?>" class="fash_listthumb_link">
                        <?php echo fash_cetak_thumbnail(get_the_ID(), 'large', 'fash_listthum_image', 'lazy'); ?>
                    </a>
                    <div class="fash_list_assets">
                        <div class="fash_list_metas">
                            <?php fash_cetak_kategori_dengan_link('fash_listcat_link', 'fa-solid fa-tag'); ?>
                            <span class="fash_list_sparator">
                                <i class="fa-solid fa-angle-right"></i>
                            </span>
                            <time class="fash_list_post_date" datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                                <?php echo esc_html(get_the_date('d F Y')); ?>
                            </time>
                        </div>

                        <a href="<?php the_permalink(); ?>" class="fash_list_heading_link">
                            <?php the_title('<h2>', '</h2>'); ?>
                        </a>

                        <?php the_excerpt(); ?>
                    </div>
                </article>
            <?php
        }
    }

    wp_reset_postdata();
    wp_die();
}