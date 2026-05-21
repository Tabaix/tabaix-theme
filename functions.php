<?php
/**
 * TABAIX functions and definitions.
 */

if (!defined('ABSPATH')) {
  exit;
}

require_once get_template_directory() . '/inc/setup.php';
require_once get_template_directory() . '/inc/enqueue.php';
require_once get_template_directory() . '/inc/custom-post-types.php';
require_once get_template_directory() . '/inc/taxonomies.php';
require_once get_template_directory() . '/inc/customizer.php';
require_once get_template_directory() . '/inc/widgets.php';
require_once get_template_directory() . '/inc/schema.php';
require_once get_template_directory() . '/inc/breadcrumbs.php';
require_once get_template_directory() . '/inc/security.php';
require_once get_template_directory() . '/inc/performance.php';
require_once get_template_directory() . '/inc/adsense.php';
require_once get_template_directory() . '/inc/analytics.php';
require_once get_template_directory() . '/inc/affiliate.php';

function tabaix_setup_theme() {
  load_theme_textdomain('tabaix', get_template_directory() . '/languages');
  add_theme_support('automatic-feed-links');
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
  add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
  add_theme_support('responsive-embeds');
  add_theme_support('custom-logo', array(
    'height' => 60,
    'width' => 240,
    'flex-width' => true,
    'flex-height' => true,
  ));
  add_theme_support('editor-styles');
  add_theme_support('custom-background', array('default-color' => 'ffffff'));
  add_theme_support('custom-header', array('header-text' => false));
  register_nav_menus(array(
    'primary' => __('Primary Menu', 'tabaix'),
    'footer' => __('Footer Menu', 'tabaix'),
  ));
}
add_action('after_setup_theme', 'tabaix_setup_theme');
