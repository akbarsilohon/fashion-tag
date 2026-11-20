
<?php

add_action('widgets_init', function(){
    register_sidebar(array(
        'name'          => 'Fashion Tag Widgets Footer',
        'id'            => 'fst_wgf',
        'description'   => 'Widget di Footer Khusus Tema Fashion Tag',
        'before_widget' => '<div class="fst_wgf-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="fst_wgf-title">',
        'after_title'   => '</h4>',
    ));

    register_widget('Fash_Tag_Post_Tag');
    register_widget('Fash_Tag_Post_Cat');
    register_widget('Fash_Tag_Post_Type_Page');
});


class Fash_Tag_Post_Tag extends WP_Widget {
    public function __construct(){
        parent::__construct(
            'fst_wgf_tag_wg',
            'Fash Tag',
            array(
                'classname'   => 'fst-wgf-tag-wg',
                'description' => 'Menampilkan tag terbaru di blog kamu'
            )
        );
    }

    public function form($instance){
        $title  = $instance['title'] ?? 'Topik Populer';
        $number = $instance['number'] ?? 10;
        ?>

        <p>
            <label>Nama Widget</label>
            <input
                class="widefat"
                type="text"
                name="<?php echo esc_attr($this->get_field_name('title')); ?>"
                value="<?php echo esc_attr($title); ?>">
        </p>

        <p>
            <label>Jumlah Tampil</label>
            <input
                class="tiny-text"
                type="number"
                min="1"
                name="<?php echo esc_attr($this->get_field_name('number')); ?>"
                value="<?php echo esc_attr($number); ?>">
        </p>

        <?php
    }

    public function update($new_instance, $old_instance){
        $instance = array();

        $instance['title']  = sanitize_text_field($new_instance['title'] ?? '');
        $instance['number'] = max(1, absint($new_instance['number'] ?? 10));

        return $instance;
    }

    public function widget($args, $instance){
        $title  = $instance['title'] ?? '';
        $number = max(1, absint($instance['number'] ?? 10));

        echo $args['before_widget'];

        if(!empty($title)){
            echo $args['before_title'] . esc_html($title) . $args['after_title'];
        }

        $tags = get_terms(array(
            'taxonomy'   => 'post_tag',
            'number'     => $number,
            'hide_empty' => true,
        ));

        if(!is_wp_error($tags) && !empty($tags)){ ?>

            <div class="fash_wgpub_tags">

                <?php foreach($tags as $tag){
                    $tag_link = get_term_link($tag);

                    if(is_wp_error($tag_link)){
                        continue;
                    }
                    ?>

                    <a href="<?php echo esc_url($tag_link); ?>" class="fash_wgpub_tag_link">
                        <i class="fa-solid fa-hashtag"></i>
                        <?php echo esc_html($tag->name); ?>
                    </a>

                <?php } ?>

            </div>

        <?php }

        echo $args['after_widget'];
    }

}


class Fash_Tag_Post_Cat extends WP_Widget {
    public function __construct(){
        parent::__construct(
            'fash_cat_post',
            'Fash Category',
            array(
                'classname'   => 'fash-cat-post',
                'description' => 'Menampilkan daftar kategori artikel'
            )
        );
    }

    public function form($instance){
        $title = $instance['title'] ?? 'Fash Kategori';
        $show  = $instance['show'] ?? 0;
        ?>

        <p>
            <label>Nama Widget</label>
            <input
                class="widefat"
                type="text"
                name="<?php echo esc_attr($this->get_field_name('title')); ?>"
                value="<?php echo esc_attr($title); ?>">
        </p>

        <p>
            <input
                type="checkbox"
                name="<?php echo esc_attr($this->get_field_name('show')); ?>"
                value="1"
                <?php checked($show, 1); ?>>

            <label>Tampilkan kategori kosong</label>
        </p>

        <?php
    }

    public function update($new_instance, $old_instance){
        $instance = array();

        $instance['title'] = sanitize_text_field($new_instance['title'] ?? '');
        $instance['show']  = !empty($new_instance['show']) ? 1 : 0;

        return $instance;
    }

    public function widget($args, $instance){
        $title = $instance['title'] ?? '';
        $show  = $instance['show'] ?? 0;

        echo $args['before_widget'];

        if(!empty($title)){
            echo $args['before_title'] . esc_html($title) . $args['after_title'];
        }

        $cat_args = array(
            'taxonomy'   => 'category',
            'orderby'    => 'name',
            'order'      => 'ASC',
            'hide_empty' => $show ? false : true
        );

        $allCats = get_categories($cat_args);

        if(!empty($allCats)){ ?>
            <div class="fash-liscats">
                <?php foreach($allCats as $cat){ ?>
                    <a
                        href="<?php echo esc_url(get_category_link($cat->term_id)); ?>"
                        class="fash-cat">

                        <span class="fash-cat_text">
                            <?php echo esc_html($cat->name); ?>
                        </span>

                        <i class="fa-solid fa-angle-right"></i>
                    </a>
                <?php } ?>

            </div>

        <?php }
        echo $args['after_widget'];
    }
}

class Fash_Tag_Post_Type_Page extends WP_Widget {
    public function __construct(){
        parent::__construct(
            'fash_page_wg',
            'Fash List Page',
            array(
                'classname'   => 'fash-page-wg',
                'description' => 'Menampilkan daftar halaman WordPress'
            )
        );
    }

    public function form($instance){
        $title = $instance['title'] ?? 'Halaman';
        ?>
        <p>
            <label>Nama Widget</label>
            <input
                class="widefat"
                type="text"
                name="<?php echo esc_attr($this->get_field_name('title')); ?>"
                value="<?php echo esc_attr($title); ?>">
        </p>

        <?php
    }

    public function update($new_instance, $old_instance){
        $instance = array();

        $instance['title'] = sanitize_text_field($new_instance['title'] ?? '');

        return $instance;
    }

    public function widget($args, $instance){
        $title = $instance['title'] ?? '';

        echo $args['before_widget'];

        if(!empty($title)){
            echo $args['before_title'] . esc_html($title) . $args['after_title'];
        }

        $pages = get_pages(array(
            'sort_column' => 'menu_order, post_title',
            'sort_order'  => 'ASC',
            'post_status' => 'publish'
        ));

        if(!empty($pages)){ ?>
            <div class="fash-page-list">
                <?php foreach($pages as $page){ ?>
                    <a href="<?php echo esc_url(get_permalink($page->ID)); ?>"
                        class="fash-page-link">
                        <span class="fash-page-text">
                            <?php echo esc_html($page->post_title); ?>
                        </span>
                        <i class="fa-solid fa-angle-right"></i>
                    </a>
                <?php } ?>
            </div>
        <?php }

        echo $args['after_widget'];
    }
}