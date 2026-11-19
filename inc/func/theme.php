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