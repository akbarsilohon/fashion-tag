<?php get_header(); ?>

<main class="container" id="main">
    <form action="<?php echo home_url('/'); ?>" method="get" class="fash_search_page">
        <input type="text" name="s" id="search_article" value="<?php echo $s; ?>" autocomplete="off" placeholder="Cari artikel.." required>
    </form>

    <?php if(have_posts()){ ?>
        <div class="grid_search">
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
                <?php
            } ?>
        </div>
        <?php
    } else{ ?>
        <div class="fash_nothing_post">
            <span class="box_icon_nopost">
                <i class="fa-solid fa-blog"></i>
            </span>

            <p class="fash_text_nopost">
                Maaf, hasil pencarian "<?php echo $s; ?>" tidak ditemukan, silahkan cari dengan kata kunci lain, atau baca artikel lain di blog kami.
            </p>
        </div>
        <?php
    } ?>
</main>

<?php get_footer();