<?php get_header(); ?>
<?php global $wp_query; ?>

<main class="container" id="main">
    <?php if( have_posts()){ ?>
        <div class="fash_gridbox">
            <div class="fash_mainlist">
                <div class="fash_big_section_title">
                    <span><?php echo single_cat_title('', false); ?></span>
                </div>

                <div class="fash_mainloop" id="post-container" data-page="1" data-max="<?php echo $wp_query->max_num_pages; ?>" data-category="<?php echo get_queried_object_id(); ?>">
                    <?php while( have_posts()){
                        the_post(); ?>
                        <article id="post-<?php the_ID(); ?>" class="fash_listbiasa">
                            <a href="<?php the_permalink(); ?>" class="fash_listthumb_link">
                                <?php echo fash_cetak_thumbnail(get_the_ID(), 'large', 'fash_listthum_image', 'lazy'); ?>
                            </a>
                            <div class="fash_list_assets">
                                <div class="fash_list_metas">
                                    <span class="fash_listcat_link">
                                        <i class="fa-regular fa-user"></i>
                                        <?php the_author(); ?>
                                    </span>
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
                    } ?>
                </div>

                <?php if($wp_query->max_num_pages > 1): ?>
                    <center>
                        <button id="load-more" class="nx-btn-loadmore"><?php echo __('Load more', 'fash-tag'); ?></button>
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

                            let page = parseInt(container.dataset.page) + 1;
                            let max  = parseInt(container.dataset.max);
                            let cat  = container.dataset.category || '';

                            try {
                                const res = await fetch('<?php echo admin_url("admin-ajax.php"); ?>', {
                                    method: 'POST',
                                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                                    body: `action=fash_cat_load_more&page=${page}&category=${cat}`
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
                Postingan <?php echo single_cat_title('', false); ?> belum tersedia. Kunjungi di lain waktu!
            </p>
        </div>
        <?php
    } ?>
</main>

<?php get_footer();