<?php get_header();

global $wp_query;
$author_id = get_queried_object_id(); ?>

<main class="container" id="main">
    <?php if(have_posts()){ ?>
        <div class="fash_gridbox">
            <div class="fash_mainlist">
                <div class="fash_authorbox">
                    <?php
                    echo get_avatar($author_id, 150, null, get_the_author_meta('display_name', $author_id)); ?>
                    <div class="fash_author-archive_info">
                        <h4 class="fash_author-arcive_name">
                            <?php echo esc_html(get_the_author_meta('display_name', $author_id)); ?>
                        </h4>
                        <?php 
                            $desc = get_the_author_meta('description', $author_id);
                            if(!empty($desc)): 
                        ?>
                            <p class="fash_author-archive_desc">
                                <?php echo esc_html($desc); ?>
                            </p>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="fash_big_section_title">
                    <span>Post by: <?php echo esc_html(get_the_author_meta('display_name', $author_id)); ?></span>
                </div>

                <div class="fash_mainloop" id="post-container" data-page="1" data-max="<?php echo $wp_query->max_num_pages; ?>" data-author="<?php echo $author_id; ?>">
                    <?php 
                    while(have_posts()){
                        the_post(); ?>
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
                    ?>
                </div>

                <?php if($wp_query->max_num_pages > 1): ?>
                    <center>
                        <button id="load-more" class="nx-btn-loadmore"><?php echo __('Load more', 'fash-news'); ?></button>
                    </center>
                <?php endif; ?>

                <script>
                    (function(){
                        const btn = document.getElementById('load-more');
                        const container = document.getElementById('post-container');
                        if(!btn || !container) return;
                        let loading = false;
                        btn.addEventListener('click', async function(){
                            if(loading) return;
                            loading = true;
                            btn.innerText = 'Loading...';
                            const page   = parseInt(container.dataset.page) + 1;
                            const max    = parseInt(container.dataset.max);
                            const author = container.dataset.author || '';
                            try {
                                const res = await fetch('<?php echo admin_url("admin-ajax.php"); ?>', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/x-www-form-urlencoded'
                                    },
                                    body: `action=fash_author_load_more&page=${page}&author=${author}`
                                });

                                const data = await res.text();
                                if(data.trim()){
                                    container.insertAdjacentHTML('beforeend', data);

                                    container.dataset.page = page;
                                    btn.innerText = "<?php echo __('Load more', 'nexara-news'); ?>";
                                    loading = false;
                                    if(page >= max){
                                        btn.remove();
                                    }

                                } else {
                                    btn.remove();
                                }

                            } catch(err){
                                console.error(err);
                                btn.innerText = 'Error';
                                loading = false;
                            }
                        });
                    })();
                </script>
            </div>

            <?php get_sidebar(); ?>
        </div>
        <?php
    } else { ?>
        <div class="fash_nothing_post">
            <span class="box_icon_nopost">
                <i class="fa-solid fa-blog"></i>
            </span>

            <p class="fash_text_nopost">
                Belum ada postingan atau artikel yang ditulis oleh <?php echo esc_html(get_the_author_meta('display_name', $author_id)); ?>. Kunjungi di lain waktu!
            </p>
        </div>
        <?php
    } ?>
</main>

<?php
get_footer();