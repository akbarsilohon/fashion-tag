<?php
$option = get_option('fash_general', []);

$footerLogo = isset($option['footer_logo']) && !empty($option['footer_logo'])
    ? esc_url($option['footer_logo'])
    : esc_url(FASH_URI . '/assets/image/logo.png');

$footerDesc = isset($option['footer_text']) && !empty($option['footer_text'])
    ? esc_html($option['footer_text'])
    : "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since 1966.";

$instagram = isset($option['instagram']) && !empty($option['instagram'])
    ? esc_url($option['instagram'])
    : '';

$facebook = isset($option['facebook']) && !empty($option['facebook'])
    ? esc_url($option['facebook'])
    : '';

$twitter = isset($option['twitter']) && !empty($option['twitter'])
    ? esc_url($option['twitter'])
    : '';

$youtube = isset($option['youtube']) && !empty($option['youtube'])
    ? esc_url($option['youtube'])
    : '';
?>

<footer class="fash_footer">
    <div class="footer_inner">

        <div class="footer_main">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="footer_home_link">
                <img
                    src="<?php echo $footerLogo; ?>"
                    alt="<?php echo esc_attr(get_bloginfo('name')); ?>"
                    width="300"
                    height="40"
                    loading="lazy"
                    class="footer_brand"
                >
            </a>

            <p class="footer_desc">
                <?php echo $footerDesc; ?>
            </p>

            <div class="fash_site_sosmed">
                <?php if (!empty($instagram)): ?>
                    <a href="<?php echo $instagram; ?>" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
                        <i class="fa-brands fa-instagram"></i>
                    </a>
                <?php endif; ?>

                <?php if (!empty($facebook)): ?>
                    <a href="<?php echo $facebook; ?>" target="_blank" rel="noopener noreferrer" aria-label="Facebook">
                        <i class="fa-brands fa-facebook-f"></i>
                    </a>
                <?php endif; ?>

                <?php if (!empty($twitter)): ?>
                    <a href="<?php echo $twitter; ?>" target="_blank" rel="noopener noreferrer" aria-label="Twitter">
                        <i class="fa-brands fa-x-twitter"></i>
                    </a>
                <?php endif; ?>

                <?php if (!empty($youtube)): ?>
                    <a href="<?php echo $youtube; ?>" target="_blank" rel="noopener noreferrer" aria-label="YouTube">
                        <i class="fa-brands fa-youtube"></i>
                    </a>
                <?php endif; ?>
            </div>
        </div>

        <div class="fash_all_footer_widgets">
            <?php if (is_active_sidebar('fst_wgf')): ?>
                <?php dynamic_sidebar('fst_wgf'); ?>
            <?php endif; ?>
        </div>

    </div>

    <p class="footer_text">
        &copy; Copyright
        <a href="<?php echo esc_url(home_url('/')); ?>">
            <?php bloginfo('name'); ?>
        </a>
        <?php echo esc_html(date('Y')); ?>
        | All Rights Reserved
    </p>
</footer>

<?php wp_footer(); ?>
</body>
</html>