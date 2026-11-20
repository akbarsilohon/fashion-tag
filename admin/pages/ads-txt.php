
<?php

function fash_ads_text_func(){
    if (isset($_POST['fash_ads_submit'])) {
        if (
            !isset($_POST['fash_ads_nonce']) ||
            !wp_verify_nonce(
                sanitize_text_field(wp_unslash($_POST['fash_ads_nonce'])),
                'fash_ads_save'
            ) ||
            !current_user_can('manage_options')
        ) {
            echo '<div class="notice notice-error"><p>Security check failed</p></div>';
        } else {

            $ads_content = isset($_POST['fash_ads_content'])
                ? wp_unslash($_POST['fash_ads_content'])
                : '';
            $file_path = ABSPATH . 'ads.txt';
            $saved = file_put_contents($file_path, $ads_content, LOCK_EX);
            if ($saved !== false) {
                echo '<div class="notice notice-success"><p>ads.txt berhasil disimpan</p></div>';
            } else {
                echo '<div class="notice notice-error"><p>Gagal menyimpan ads.txt. Periksa permission folder WordPress.</p></div>';
            }
        }
    }

    $existing_content = '';
    $file_path = ABSPATH . 'ads.txt';
    if (file_exists($file_path) && is_readable($file_path)) {
        $existing_content = file_get_contents($file_path);
    }

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
                <a href="<?php echo esc_url(admin_url('admin.php?page=fash-styling')); ?>">Styling</a>
                <a href="<?php echo esc_url(admin_url('admin.php?page=fash-ads-txt')); ?>" class="active">Ads.txt</a>
            </nav>
        </header>

        <form action="<?php echo esc_url(admin_url('admin.php?page=fash-ads-txt')); ?>" method="post" class="fash-form">

            <?php wp_nonce_field('fash_ads_save', 'fash_ads_nonce'); ?>

            <div class="fash-card">
                <h3 class="fash-card_title">Ads.txt Manager</h3>

                <div class="fash-field">
                    <div style="grid-column: span 2;">
                        <textarea name="fash_ads_content" rows="12" class="fash-code"><?php echo esc_textarea($existing_content); ?></textarea>
                    </div>
                </div>

                <div class="fash-submit">
                    <button type="submit" name="fash_ads_submit" class="fash-save">Save Ads.txt</button>
                </div>
            </div>

        </form>
    </div>

<?php
}