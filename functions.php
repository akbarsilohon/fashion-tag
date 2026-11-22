<?php

// Global variable fashion-tag
define('FASH_NAME', 'Fashion Tag');
define('FASH_DIR', get_template_directory());
define('FASH_URI', get_template_directory_uri());

// Upstreaming function =========================
require_once FASH_DIR . '/inc/func/deregister.php';
require_once FASH_DIR . '/inc/func/theme.php';
require_once FASH_DIR . '/inc/func/enqueues.php';


// Upstreaming admin function =====================
require_once FASH_DIR . '/admin/panel.php';

// Upstreaming widgets function ===================
require_once FASH_DIR . '/inc/widgets/footer-widget.php';
require_once FASH_DIR . '/inc/widgets/sidebar-widgets.php';