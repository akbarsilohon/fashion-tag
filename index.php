<?php get_header(); ?>

<?php
global $wp_query;
?>

<main class="container" id="main">
    <?php if(have_posts()){ ?>

        <div class="fash_gridbox">
            <div class="fash_mainlist">

                <div class="fash_big_section_title">
                    <span>artikel terbaru</span>
                </div>

                <div
                    class="fash_mainloop"
                    id="post-container"
                    data-page="1"
                    data-has-more="<?php echo $wp_query->max_num_pages > 1 ? 'true' : 'false'; ?>"
                >

                    <?php while(have_posts()){
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

                    <?php } ?>

                </div>

                <?php if($wp_query->max_num_pages > 1): ?>
                    <center>
                        <button id="load-more" class="nx-btn-loadmore">
                            <?php echo esc_html__('Load more', 'fashion-tag'); ?>
                        </button>
                    </center>
                <?php endif; ?>

            </div>

            <?php get_sidebar(); ?>

        </div>

        <script>
            var fashMybtn_text = "<?php echo esc_js(__('Load more', 'fashion-tag')); ?>";

            (function(){
                const btn = document.getElementById('load-more');
                const container = document.getElementById('post-container');

                if(!btn || !container) return;

                let loading = false;

                btn.addEventListener('click', async function(){

                    if(loading) return;

                    loading = true;
                    btn.disabled = true;
                    btn.innerText = 'Memuat...';

                    let page = parseInt(container.dataset.page, 10) + 1;

                    try {
                        const res = await fetch('<?php echo esc_url(admin_url("admin-ajax.php")); ?>', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded'
                            },
                            body: `action=fash_load_more&page=${page}`
                        });

                        if(!res.ok){
                            throw new Error('Request gagal: ' + res.status);
                        }

                        const data = await res.text();

                        if(data.trim()){
                            container.insertAdjacentHTML('beforeend', data);
                            container.dataset.page = page;

                            if(container.dataset.hasMore === 'false'){
                                btn.remove();
                                return;
                            }

                            btn.innerText = fashMybtn_text;
                            btn.disabled = false;
                            loading = false;

                        } else {
                            btn.remove();
                        }

                    } catch(err){
                        console.error(err);
                        btn.innerText = 'Gagal memuat. Coba lagi';
                        btn.disabled = false;
                        loading = false;
                    }

                });
            })();
        </script>

    <?php } else { ?>

        <div class="fash_nothing_post">
            <span class="box_icon_nopost">
                <i class="fa-solid fa-blog"></i>
            </span>

            <p class="fash_text_nopost">
                Postingan atau artikel belum tersedia. Kunjungi di lain waktu!
            </p>
        </div>

    <?php } ?>
</main>

<?php get_footer(); ?>