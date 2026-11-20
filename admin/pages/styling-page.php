<?php

function fash_styling_func(){
    $opt = get_option('fash_color', []);

    $get = function($key, $default) use ($opt){
        return !empty($opt[$key]) && sanitize_hex_color($opt[$key])
            ? sanitize_hex_color($opt[$key])
            : $default;
    };
?>
<div class="fash-option">
    <header class="fash-header">
        <div class="fash-header_inner">
            <div class="fash-header_left">
                <img src="<?php echo esc_url(FASH_URI . '/assets/image/dash-logo.png'); ?>" class="fash-logo" alt="<?php echo esc_attr(FASH_NAME); ?>">
                <div class="fash-header_text">
                    <h2><?php echo esc_html(FASH_NAME); ?></h2>
                    <p>Powered by Akbar Silohon</p>
                    <a href="https://www.kodinglog.com" target="_blank" rel="noopener noreferrer">
                        KodingLog.com
                    </a>
                </div>
            </div>
            <div class="fash-header_right">
                <span class="fash-badge">v1.0</span>
                <span class="fash-status">Active</span>
            </div>
        </div>

        <nav class="fash-header_menu">
            <a href="<?php echo esc_url(admin_url('admin.php?page=fash')); ?>">Pengaturan Umum</a>
            <a href="<?php echo esc_url(admin_url('admin.php?page=fash-styling')); ?>" class="active">Styling</a>
            <a href="<?php echo esc_url(admin_url('admin.php?page=fash-ads-txt')); ?>">Ads.txt</a>
        </nav>
    </header>

    <form action="<?php echo esc_url(admin_url('admin.php?page=fash-styling')); ?>" method="post" class="fash-form">
        <?php wp_nonce_field('fash_save_color', 'fash_color_nonce'); ?>

        <div class="fash-card">
            <h3 class="fash-card_title">🎨 Color System</h3>
            <div class="fash-grid-2">

                <div class="fash-field fashcolor">
                    <label>Main Color</label>
                    <input type="color" name="fash_color[main_color]" value="<?php echo $get('main_color','#3D2B25'); ?>">
                </div>

                <div class="fash-field fashcolor">
                    <label>Accent Color</label>
                    <input type="color" name="fash_color[accent_color]" value="<?php echo $get('accent_color','#A9826D'); ?>">
                </div>

                <div class="fash-field fashcolor">
                    <label>Body Background</label>
                    <input type="color" name="fash_color[body_bg]" value="<?php echo $get('body_bg','#EAE7E4'); ?>">
                </div>

                <div class="fash-field fashcolor">
                    <label>Body Text</label>
                    <input type="color" name="fash_color[body_text]" value="<?php echo $get('body_text','#3D2B25'); ?>">
                </div>

                <div class="fash-field fashcolor">
                    <label>Link Color</label>
                    <input type="color" name="fash_color[link_color]" value="<?php echo $get('link_color','#6B5146'); ?>">
                </div>

                <div class="fash-field fashcolor">
                    <label>Link Hover</label>
                    <input type="color" name="fash_color[link_hover]" value="<?php echo $get('link_hover','#A9826D'); ?>">
                </div>

                <div class="fash-field fashcolor">
                    <label>Header Background</label>
                    <input type="color" name="fash_color[header_bg]" value="<?php echo $get('header_bg','#EAE7E4'); ?>">
                </div>

                <div class="fash-field fashcolor">
                    <label>Header Link</label>
                    <input type="color" name="fash_color[header_link]" value="<?php echo $get('header_link','#3D2B25'); ?>">
                </div>

                <div class="fash-field fashcolor">
                    <label>Header Hover</label>
                    <input type="color" name="fash_color[header_hover]" value="<?php echo $get('header_hover','#A9826D'); ?>">
                </div>

                <div class="fash-field fashcolor">
                    <label>Button Background</label>
                    <input type="color" name="fash_color[btn_bg]" value="<?php echo $get('btn_bg','#3D2B25'); ?>">
                </div>

                <div class="fash-field fashcolor">
                    <label>Button Text</label>
                    <input type="color" name="fash_color[btn_text]" value="<?php echo $get('btn_text','#F7F3EF'); ?>">
                </div>

                <div class="fash-field fashcolor">
                    <label>Button Hover</label>
                    <input type="color" name="fash_color[btn_hover]" value="<?php echo $get('btn_hover','#80604F'); ?>">
                </div>

                <div class="fash-field fashcolor">
                    <label>Border Color</label>
                    <input type="color" name="fash_color[border_color]" value="<?php echo $get('border_color','#D7CCC2'); ?>">
                </div>

                <div class="fash-field fashcolor">
                    <label>Muted Text</label>
                    <input type="color" name="fash_color[muted_text]" value="<?php echo $get('muted_text','#85766E'); ?>">
                </div>

            </div>
        </div>

        <div class="fash-card">
            <h3 class="fash-card_title">Footer</h3>
            <div class="fash-grid-2">

                <div class="fash-field fashcolor">
                    <label>Footer Background</label>
                    <input type="color" name="fash_color[footer_bg]" value="<?php echo $get('footer_bg','#3D2B25'); ?>">
                </div>

                <div class="fash-field fashcolor">
                    <label>Footer Text</label>
                    <input type="color" name="fash_color[footer_text]" value="<?php echo $get('footer_text','#EAE2DC'); ?>">
                </div>

                <div class="fash-field fashcolor">
                    <label>Footer Link</label>
                    <input type="color" name="fash_color[footer_link]" value="<?php echo $get('footer_link','#F0E7DF'); ?>">
                </div>

                <div class="fash-field fashcolor">
                    <label>Footer Hover</label>
                    <input type="color" name="fash_color[footer_hover]" value="<?php echo $get('footer_hover','#C9A98F'); ?>">
                </div>

                <div class="fash-field fashcolor">
                    <label>Footer Bottom Background</label>
                    <input type="color" name="fash_color[footer_bottom_bg]" value="<?php echo $get('footer_bottom_bg','#2B1E1A'); ?>">
                </div>

            </div>
        </div>

        <div class="fash-card">
            <h3 class="fash-card_title">Homepage</h3>
            <div class="fash-grid-2">

                <div class="fash-field fashcolor">
                    <label>Homepage Link</label>
                    <input type="color" name="fash_color[homepage_link]" value="<?php echo $get('homepage_link','#3D2B25'); ?>">
                </div>

                <div class="fash-field fashcolor">
                    <label>Homepage Link Hover</label>
                    <input type="color" name="fash_color[homepage_link_hover]" value="<?php echo $get('homepage_link_hover','#A9826D'); ?>">
                </div>

            </div>
        </div>

        <div class="fash-submit">
            <button type="submit" class="fash-save">Save Style</button>
            <button type="submit"
                    class="fash_reset_color fash-reset"
                    name="fash_reset_color"
                    value="1"
                    onclick="return confirm('Reset semua warna ke default?')">
                Reset Default
            </button>
        </div>

    </form>
</div>
<?php
}


/**
 * SAVE COLOR SETTINGS
 */
add_action('admin_init', function(){

    if (!isset($_POST['fash_color_nonce'])) {
        return;
    }

    if (!current_user_can('manage_options')) {
        return;
    }

    if (!wp_verify_nonce(
        sanitize_text_field(wp_unslash($_POST['fash_color_nonce'])),
        'fash_save_color'
    )) {
        return;
    }

    if (isset($_POST['fash_reset_color'])) {
        delete_option('fash_color');

        wp_safe_redirect(
            add_query_arg(
                [
                    'page' => 'fash-styling',
                    'settings-reset' => 'true'
                ],
                admin_url('admin.php')
            )
        );
        exit;
    }

    $data = $_POST['fash_color'] ?? [];

    if (!is_array($data)) {
        return;
    }

    $clean_data = [];

    foreach ($data as $key => $value) {
        $color = sanitize_hex_color($value);

        if ($color) {
            $clean_data[sanitize_key($key)] = $color;
        }
    }

    update_option('fash_color', $clean_data);

    wp_safe_redirect(
        add_query_arg(
            [
                'page' => 'fash-styling',
                'settings-updated' => 'true'
            ],
            admin_url('admin.php')
        )
    );
    exit;
});
