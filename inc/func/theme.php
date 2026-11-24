<?php

// Setup Thema ----------------------
add_action( 'after_setup_theme', function(){
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script'
    ]);
    add_theme_support('responsive-embeds');
    add_theme_support('automatic-feed-links');

    // Register Menu Header dan menu Flexbox
    register_nav_menus( array(
        'header'        =>  __('Menu Header', 'fashion-tag'),
        'flexbox'       =>  __('Menu Flexbox', 'fashion-tag')
    ));
});


// Helper untuk thumbnail -------------------------
function fash_cetak_thumbnail( $id, $size, $class, $loading ){
    $thub = null;
    if(has_post_thumbnail( $id )){
        // Jika ada thumbnail --------------------
        $thumburi = get_the_post_thumbnail_url( $id, $size );
        $thub = '<img width="300" height="300" class="'. $class .'" loading="'. $loading .'" src="'. esc_url($thumburi) .'" alt="'. esc_html( get_the_title($id)) .'">';
    } else {
        $getContent = get_the_content( null, false, $id );
        $cover = '';
        preg_match('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $getContent, $cover);
        if(!empty($cover[1])){
            // Jika tidak ada thumbnail dan ada gambar di body post
            // Ini yang akan jalan
            $thub = '<img width="300" height="300" class="'. $class .'" loading="'. $loading .'" src="'. esc_url($cover[1]) .'" alt="'. esc_html( get_the_title($id)) .'">';
        } else {
            // Jika bukan dari keduanya yang diatas
            // Ini yang akan jalan
            $thub = '<div class="fash_listnothumb">
                <i class="fa-regular fa-image"></i>
            </div>';
        }
    }

    return $thub;
}

// Mencetak kategori bersamaan dengan link nya ---------
function fash_cetak_kategori_dengan_link( $class, $faw ){
    $categories = get_the_category();
    $sparator = ', ';
    $output = '';
    $i = 1;

    if(!empty($categories)){
        foreach( $categories as $category ){
            if( $i > 1 ){
                $output .= $sparator;
            }
            $output = '<a class="'. $class .'" href="' . esc_url( get_category_link( $category->term_id ) ) . '" title="'. esc_html( $category->name ) .'"><i class="'. $faw .'"></i> ' . esc_html( $category->name ) . '</a>';
        }
    }

    echo $output;
}