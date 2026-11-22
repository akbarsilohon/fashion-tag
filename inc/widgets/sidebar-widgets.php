<?php

add_action('widgets_init', function(){
    register_sidebar(array(
        'name'          => 'Fashion Tag Home Widgets',
        'id'            => 'fst_wgs',
        'description'   => 'Widget di sidebar Khusus Home page di Tema Fashion Tag',
        'before_widget' => '<div class="fst_wgs-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="fst_wgs-title">',
        'after_title'   => '</h4>',
    ));

    register_sidebar(array(
        'name'          => 'Fashion Tag Singular dan Arsip Widgets',
        'id'            => 'fst_singluar_wgs',
        'description'   => 'Widget di sidebar Khusus halaman singular dan arsip page di Tema Fashion Tag',
        'before_widget' => '<div class="fst_wgs-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="fst_wgs-title">',
        'after_title'   => '</h4>',
    ));
});

register_widget( 'Fash_Tag_Recent_Posts' );
register_widget( 'Fash_Tag_Popular_Posts' );

// Class untuk artikel terbaru -------------------
class Fash_Tag_Recent_Posts extends WP_Widget {
    public function __construct(){
        parent::__construct(
            'fash_recent_post_wg',
            'Fash tag Artikel Terbaru',
            array(
                'classname'     =>  'fash-recent-post-wg',
                'description'   =>  'Widget yang menampilkan artikel terbaru'
            )
        );
    }

    public function form($instance){
        $title    = $instance['title'] ?? 'Artikel Terbaru';
        $number   = $instance['number'] ?? 5;
        $category = $instance['category'] ?? '';
        $random   = $instance['random'] ?? 0;

        $categories = get_categories(['hide_empty' => 0]); ?>
        <p>
            <label>Nama Widget:</label>
            <input class="widefat"
                type="text"
                name="<?php echo $this->get_field_name('title'); ?>"
                value="<?php echo esc_attr($title); ?>">
        </p>

        <p>
            <label>Jumlah Tampil:</label>
            <input class="tiny-text"
                type="number"
                name="<?php echo $this->get_field_name('number'); ?>"
                value="<?php echo esc_attr($number); ?>">
        </p>

        <p>
            <label>Kategori</label>
            <select class="widefat" name="<?php echo $this->get_field_name('category'); ?>">
                <option value="">Semua Kategori</option>
                <?php foreach($categories as $cat): ?>
                    <option value="<?php echo $cat->term_id; ?>"
                        <?php selected($category, $cat->term_id); ?>>
                        <?php echo esc_html($cat->name); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </p>

        <p>
            <input type="checkbox"
                name="<?php echo $this->get_field_name('random'); ?>"
                value="1"
                <?php checked($random, 1); ?>>
            <label>Random</label>
        </p>
        <?php
    }

    public function update($new_instance, $old_instance){
        $instance = [];
        $instance['title']    = sanitize_text_field($new_instance['title']);
        $instance['number']   = intval($new_instance['number']);
        $instance['category'] = sanitize_text_field($new_instance['category']);
        $instance['random']   = !empty($new_instance['random']) ? 1 : 0;
        return $instance;
    }

    public function widget($args, $instance){
        $title    = $instance['title'] ?? '';
        $number   = $instance['number'] ?? 5;
        $category = $instance['category'] ?? '';
        $random   = $instance['random'] ?? 0;
    
        echo $args['before_widget'];
    
        if(!empty($title)){
            echo $args['before_title'] . esc_html($title) . $args['after_title'];
        }
    
        $query_args = [
            'post_type'      => 'post',
            'post_status'    => 'publish',
            'posts_per_page' => absint($number),
        ];
    
        if($category){
            $query_args['cat'] = absint($category);
        }
    
        if($random){
            $query_args['orderby'] = 'rand';
        }
    
        $q = new WP_Query($query_args);
    
        if($q->have_posts()){ ?>
            <div class="fashlist-post">
                <?php while($q->have_posts()){
                    $q->the_post(); ?>
    
                    <article id="post-<?php the_ID(); ?>" <?php post_class('fashlist-new-post'); ?>>
                        <a href="<?php the_permalink(); ?>" class="fashlist-thumb">
                            <?php if(has_post_thumbnail()){ ?>
                                <?php the_post_thumbnail('thumbnail'); ?>
                            <?php } else { ?>
                                <span class="fashlist-no-thumb" aria-hidden="true">
                                    <i class="fa-regular fa-image"></i>
                                </span>
                            <?php } ?>
                        </a>
    
                        <div class="fashlist-content">
                            <h3 class="fashlist-title">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_title(); ?>
                                </a>
                            </h3>
                        </div>
                    </article>
    
                <?php } ?>
            </div>
            <?php
        }
    
        wp_reset_postdata();
    
        echo $args['after_widget'];
    }
}

// Class untuk artikel populer --------------------
class Fash_Tag_Popular_Posts extends WP_Widget {

    public function __construct(){
        parent::__construct(
            'fash_popular_post_wg',
            'Fash tag Artikel Populer',
            array(
                'classname'   => 'fash-popular-post-wg',
                'description' => 'Widget yang menampilkan artikel paling populer'
            )
        );
    }

    public function form($instance){
        $title  = $instance['title'] ?? 'Artikel Populer';
        $number = $instance['number'] ?? 5; ?>

        <p>
            <label>Nama Widget:</label>
            <input class="widefat"
                type="text"
                name="<?php echo esc_attr($this->get_field_name('title')); ?>"
                value="<?php echo esc_attr($title); ?>">
        </p>

        <p>
            <label>Jumlah Tampil:</label>
            <input class="tiny-text"
                type="number"
                min="1"
                name="<?php echo esc_attr($this->get_field_name('number')); ?>"
                value="<?php echo esc_attr($number); ?>">
        </p>

        <?php
    }

    public function update($new_instance, $old_instance){
        $instance = [];

        $instance['title'] = sanitize_text_field($new_instance['title'] ?? '');
        $instance['number'] = max(1, absint($new_instance['number'] ?? 5));

        return $instance;
    }

    public function widget($args, $instance){
        $title  = $instance['title'] ?? '';
        $number = max(1, absint($instance['number'] ?? 5));

        echo $args['before_widget'];

        if(!empty($title)){
            echo $args['before_title'] . esc_html($title) . $args['after_title'];
        }

        $query_args = [
            'post_type'      => 'post',
            'post_status'    => 'publish',
            'posts_per_page' => $number,
            'meta_key'       => 'fash_post_views',
            'orderby'        => 'meta_value_num',
            'order'          => 'DESC',
        ];

        $q = new WP_Query($query_args);

        if($q->have_posts()){ ?>
            <div class="fashlist-post">
                <?php while($q->have_posts()){
                    $q->the_post(); ?>

                    <article id="post-<?php the_ID(); ?>" <?php post_class('fashlist-new-post'); ?>>
                        <a href="<?php echo esc_url(get_permalink()); ?>" class="fashlist-thumb">
                            <?php if(has_post_thumbnail()){ ?>
                                <?php the_post_thumbnail('thumbnail'); ?>
                            <?php } else { ?>
                                <span class="fashlist-no-thumb" aria-hidden="true">
                                    <i class="fa-regular fa-image"></i>
                                </span>
                            <?php } ?>
                        </a>

                        <div class="fashlist-content">
                            <h3 class="fashlist-title">
                                <a href="<?php echo esc_url(get_permalink()); ?>">
                                    <?php echo esc_html(get_the_title()); ?>
                                </a>
                            </h3>
                        </div>
                    </article>

                <?php } ?>
            </div>
            <?php
        }

        wp_reset_postdata();

        echo $args['after_widget'];
    }
}