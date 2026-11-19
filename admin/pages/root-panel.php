<?php

function fash_panel(){
    $opt = get_option('fash_general', []); ?>

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
                <a href="<?php echo esc_url(admin_url('admin.php?page=fash')); ?>" class="active">
                    Pengaturan Umum
                </a>
                <a href="<?php echo esc_url(admin_url('admin.php?page=fash-styling')); ?>">
                    Styling
                </a>
                <a href="<?php echo esc_url(admin_url('admin.php?page=fash-ads-txt')); ?>">
                    Ads.txt
                </a>
            </nav>
        </header>

        <form method="post" action="<?php echo esc_url(admin_url('admin.php?page=fash')); ?>" class="fash-form">
            <?php wp_nonce_field('fash_save_general', 'fash_nonce'); ?>
            <!-- GENERAL SETTINGS -->
            <div class="fash-card">
                <h3 class="fash-card_title">Pengaturan Umum</h3>
                <div class="fash-field">
                    <label>Header Logo</label>
                    <div class="fash-inline">
                        <input type="text" id="fashLogoHeader_id" name="fash_general[header_logo]" value="<?php echo esc_attr($opt['header_logo'] ?? ''); ?>">
                        <button type="button" id="fashLogoHeader" class="fash-upload">
                            Upload
                        </button>
                    </div>
                </div>
                <div class="fash-field">
                    <label>Footer Logo</label>
                    <div class="fash-inline">
                        <input type="text" id="fashLogoFooter_id" name="fash_general[footer_logo]" value="<?php echo esc_attr($opt['footer_logo'] ?? ''); ?>">
                        <button type="button" id="fashLogoFooter" class="fash-upload">
                            Upload
                        </button>
                    </div>
                </div>
                <div class="fash-field">
                    <label>Footer Text</label>
                    <textarea name="fash_general[footer_text]"><?php echo esc_textarea($opt['footer_text'] ?? ''); ?></textarea>
                </div>
            </div>


            <!-- SOCIAL MEDIA -->
            <div class="fash-card">
                <h3 class="fash-card_title">Social Media</h3>
                <div class="fash-grid-2">
                    <div class="fash-field">
                        <label><i class="fab fa-instagram"></i> Instagram</label>
                        <input type="text" name="fash_general[instagram]" value="<?php echo esc_attr($opt['instagram'] ?? ''); ?>">
                    </div>
                    <div class="fash-field">
                        <label><i class="fab fa-facebook"></i> Facebook</label>
                        <input type="text" name="fash_general[facebook]" value="<?php echo esc_attr($opt['facebook'] ?? ''); ?>">
                    </div>

                    <div class="fash-field">
                        <label><i class="fab fa-x-twitter"></i> Twitter (X)</label>
                        <input type="text" name="fash_general[twitter]" value="<?php echo esc_attr($opt['twitter'] ?? ''); ?>">
                    </div>

                    <div class="fash-field">
                        <label><i class="fab fa-youtube"></i> YouTube</label>
                        <input type="text" name="fash_general[youtube]" value="<?php echo esc_attr($opt['youtube'] ?? ''); ?>">
                    </div>
                </div>
            </div>


            <div class="fash-card">
                <h3 class="fash-card_title">Custom Code</h3>
                <div class="fash-field">
                    <label>Insert Head HTML</label>
                    <textarea name="fash_general[html_head]" class="fash-code" ><?php echo esc_textarea($opt['html_head'] ?? ''); ?></textarea>
                </div>

                <div class="fash-field">
                    <label>Insert Footer HTML</label>
                    <textarea name="fash_general[html_footer]" class="fash-code" ><?php echo esc_textarea($opt['html_footer'] ?? ''); ?></textarea>
                </div>
            </div>
            <div class="fash-submit">
                <button type="submit" class="fash-save">
                    Simpan Pengaturan
                </button>
            </div>
        </form>
    </div>
    <?php
}


/**
 * SAVE GENERAL SETTINGS
 */
add_action('admin_init', function(){
    if (!isset($_POST['fash_nonce'])) {
        return;
    }

    if (!current_user_can('manage_options')) {
        return;
    }

    if (!wp_verify_nonce(
        sanitize_text_field(wp_unslash($_POST['fash_nonce'])),
        'fash_save_general'
    )) {
        return;
    }

    $data = $_POST['fash_general'] ?? [];
    if (!is_array($data)) {
        return;
    }

    $data = wp_unslash($data);
    update_option('fash_general', $data);
    wp_safe_redirect(
        add_query_arg(
            [
                'page' => 'fash',
                'settings-updated' => 'true'
            ],
            admin_url('admin.php')
        )
    );
    exit;
});

function fash_admin_notice(){
    if (!isset($_GET['page']) || $_GET['page'] !== 'fash') {
        return;
    }
    if (!isset($_GET['settings-updated']) || $_GET['settings-updated'] !== 'true') {
        return;
    }
    ?>

    <div class="notice notice-success is-dismissible">
        <p>
            <strong>Berhasil!</strong> Pengaturan berhasil disimpan.
        </p>
    </div>

    <?php
}
add_action('admin_notices', 'fash_admin_notice');