<?php

// Mendaftarkan css dan js admin ------------------
add_action('admin_enqueue_scripts', function(){
    $allowed_pages = [
        'fash', 'fash-styling', 'fash-ads-txt'
    ];

    $current_page = isset($_GET['page']) ? sanitize_text_field($_GET['page']) : '';
    if(is_admin() && in_array($current_page, $allowed_pages, true)){
        wp_enqueue_media();
        wp_enqueue_style( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css', array(), '6.5.2', 'all');
        wp_enqueue_style( 'fash-admin-css', FASH_URI . '/assets/css/admin.css', array(), fileatime( FASH_DIR . '/assets/css/admin.css'), 'all' );
        wp_enqueue_script( 'fash-admin-js', FASH_URI . '/assets/js/admin.js', array(), fileatime( FASH_DIR . '/assets/js/admin.js'), true );
    }
});