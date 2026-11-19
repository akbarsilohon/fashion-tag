<?php

add_action('admin_menu', function(){
    $icon_url = FASH_URI . '/assets/image/icon.svg';
    add_menu_page( 'Panel ' . FASH_NAME, FASH_NAME, 'manage_options','fash', 'fash_panel', $icon_url, 1 );
    add_submenu_page( 'fash', 'Pengaturan Umum', 'Pengaturan Umum', 'manage_options', 'fash', 'fash_panel' );
    add_submenu_page( 'fash', 'Styling', 'Styling', 'manage_options', 'fash-styling', 'fash_styling_func' );
    add_submenu_page( 'fash', 'Ads.txt', 'Ads.txt', 'manage_options', 'fash-ads-txt', 'fash_ads_text_func' );
});

require_once FASH_DIR . '/admin/pages/root-panel.php';