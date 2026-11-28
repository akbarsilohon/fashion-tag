<?php

class Fash_Singular_Clases {
    // Render related posts ---------------------
    public static function _render_Related_Posts( $id, $count = 6 ){
        $categories = wp_get_post_categories($id);
        if (empty($categories)) return;

        $relateds = new WP_Query(array(
            'post_type'      => 'post',
            'posts_per_page' => $count,
            'post__not_in'   => array($id),
            'category__in'   => $categories,
            'orderby'        => 'date',
            'post_status'    => 'publish'
        ));

        if(!$relateds->have_posts()) return; ?>

        <div class="fash_related_container">
            <div class="fash_big_section_title">
                <span>artikel terkait</span>
            </div>

            <div class="fash_related_loop">
                <?php while( $relateds->have_posts()){
                    $relateds->the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" class="fash_related_card">
                        <?php if(has_post_thumbnail()){ ?>
                            <a href="<?php the_permalink(); ?>" class="fash_realated_thumb">
                                <?php the_post_thumbnail( 'large', array(
                                    'class'     =>  'fash_rethumb',
                                    'loading'   =>  'lazy'
                                )); ?>
                            </a>
                            <a href="<?php the_permalink(); ?>" class="fash_relink">
                                <?php the_title('<h3 class="fash_retitle">', '</h3>'); ?>
                            </a>
                            <?php
                        } ?>
                    </article>
                    <?php
                } ?>
            </div>
        </div>

        <?php
        wp_reset_postdata();
    }
}