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


// Mendaftarkan css frontend -------------------------
add_action('wp_enqueue_scripts', function(){
    // Google Font ---------------------------------
    wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Poppins:wght@500;600;700&display=swap', array(), null, 'all' );

    // Font Awesome ---------------------------------
    wp_enqueue_style( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.1/css/all.min.css', array(), '7.3.1', 'all');

    // Main Css --------------------------------------
    wp_enqueue_style( 'fash-main-css', FASH_URI . '/assets/css/main.css', array(), fileatime(FASH_DIR . '/assets/css/main.css'), 'all' );

    if( is_home() || is_category() || is_tag() || is_author() ||is_search()){
        wp_enqueue_style( 'fash-not-singular', FASH_URI . '/assets/css/not-singular.css', array(), fileatime( FASH_DIR . '/assets/css/not-singular.css'), 'all' );
    }

    if( is_singular()){
        wp_enqueue_style( 'fash-singular', FASH_URI . '/assets/css/singular.css', array(), fileatime( FASH_DIR  . '/assets/css/singular.css'), 'all' );
    }

    // Main Js ---------------------------------------
    wp_enqueue_script( 'fash-main-js', FASH_URI . '/assets/js/main.js', array(), fileatime(FASH_DIR . '/assets/js/main.js'), true );
});


// Render CSS Variables Fashion Tag --------------------------
add_action('wp_head', 'fash_render_css_var', 1);
function fash_render_css_var(){
    $option = get_option('fash_color', []);
    $get = function($key, $default) use ($option){
        return !empty($option[$key]) && sanitize_hex_color($option[$key])
            ? sanitize_hex_color($option[$key])
            : $default;
    };

    // General Colors
    $main_color   = $get('main_color', '#3D2B25');
    $accent_color = $get('accent_color', '#A9826D');
    $body_bg      = $get('body_bg', '#EAE7E4');
    $body_text    = $get('body_text', '#3D2B25');

    // Link Colors
    $link_color = $get('link_color', '#6B5146');
    $link_hover = $get('link_hover', '#A9826D');

    // Header Colors
    $header_bg    = $get('header_bg', '#EAE7E4');
    $header_link  = $get('header_link', '#3D2B25');
    $header_hover = $get('header_hover', '#A9826D');

    // Button Colors
    $btn_bg    = $get('btn_bg', '#3D2B25');
    $btn_text  = $get('btn_text', '#F7F3EF');
    $btn_hover = $get('btn_hover', '#80604F');

    // Other Colors
    $border_color = $get('border_color', '#D7CCC2');
    $muted_text   = $get('muted_text', '#85766E');

    // Footer Colors
    $footer_bg        = $get('footer_bg', '#3D2B25');
    $footer_text      = $get('footer_text', '#EAE2DC');
    $footer_link      = $get('footer_link', '#F0E7DF');
    $footer_hover     = $get('footer_hover', '#C9A98F');
    $footer_bottom_bg = $get('footer_bottom_bg', '#2B1E1A');

    // Homepage Colors
    $homepage_link       = $get('homepage_link', '#3D2B25');
    $homepage_link_hover = $get('homepage_link_hover', '#A9826D');

    echo '<style id="fash-css-vars">
        :root {
            --fash-main-color: ' . $main_color . ';
            --fash-accent-color: ' . $accent_color . ';

            --fash-body-bg: ' . $body_bg . ';
            --fash-body-text: ' . $body_text . ';

            --fash-link-color: ' . $link_color . ';
            --fash-link-hover: ' . $link_hover . ';

            --fash-header-bg: ' . $header_bg . ';
            --fash-header-link: ' . $header_link . ';
            --fash-header-hover: ' . $header_hover . ';

            --fash-btn-bg: ' . $btn_bg . ';
            --fash-btn-text: ' . $btn_text . ';
            --fash-btn-hover: ' . $btn_hover . ';

            --fash-border-color: ' . $border_color . ';
            --fash-muted-text: ' . $muted_text . ';

            --fash-footer-bg: ' . $footer_bg . ';
            --fash-footer-text: ' . $footer_text . ';
            --fash-footer-link: ' . $footer_link . ';
            --fash-footer-hover: ' . $footer_hover . ';
            --fash-footer-bottom-bg: ' . $footer_bottom_bg . ';

            --fash-homepage-link: ' . $homepage_link . ';
            --fash-homepage-link-hover: ' . $homepage_link_hover . ';
        }
    </style>';
}