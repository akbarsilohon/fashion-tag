<?php
$option = get_option('fash_general', []);
$logo = isset( $option['header_logo']) && !empty($option['header_logo'])
    ? esc_url($option['header_logo'])
    : esc_url( FASH_URI . '/assets/image/logo.png');
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<header class="fash_header">
    <div class="header_inner">
        <a href="<?php bloginfo('url'); ?>" class="fash_brand_link">
            <img src="<?php echo $logo; ?>" alt="<?php bloginfo('name'); ?>" width="300" height="40" loading="eager" class="fash_brand_image">
        </a>

        <div class="fash_menu_primary">
            <?php wp_nav_menu(array(
                'theme_location'        =>  'header',
                'container'             =>  false,
                'menu_class'            =>  'fash_menu',
                'fallback_cb'           =>  false
            )); ?>
        </div>

        <span class="menu_open" id="menuOpen">
            <i class="fa-solid fa-bars"></i>
        </span>
    </div>
</header>
<div class="header_spacer"></div>
<div class="fash_flexbox">
    <div class="fash_flx_header">
        <a href="<?php bloginfo('url'); ?>" class="fash_flx_home_link">
            <img src="<?php echo $logo; ?>" alt="<?php bloginfo('name'); ?>" width="300" height="40" class="fash_flx_brand_image">
        </a>
        <span class="menu_close" id="menuClose">
            <i class="fa-solid fa-xmark"></i>
        </span>
    </div>
    <div class="fash_flx_body">
        <form action="<?php echo home_url('/'); ?>" method="get" class="fash_flx_search">
            <input type="text" name="s" id="flx_input_search" placeholder="Cari artikel atau produk.." value="<?php echo $s; ?>" autocomplete="off" required />
            <button type="submit" class="nx_flx-btn">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </form>

        <div class="fash_flx_menu">
            <?php 
                wp_nav_menu(array(
                    'theme_location'        =>  'flexbox',
                    'container'             =>  false,
                    'menu_class'            =>  'flx_menu_item',
                    'fallback_cb'           =>  false,
                ));
            ?>
        </div>
    </div>
</div>