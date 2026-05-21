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
require_once get_template_directory() . '/inc/custom-code.php';

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

/**
 * Hook into main query to apply Customizer content query limits on archives.
 */
function tabaix_modify_archive_queries($query) {
  if (!is_admin() && $query->is_main_query()) {
    if (is_post_type_archive('tool')) {
      $query->set('posts_per_page', get_theme_mod('tabaix_tools_limit', 20));
    }
  }
}
add_action('pre_get_posts', 'tabaix_modify_archive_queries');
