<?php

if (!defined('ABSPATH')) {
  exit;
}

function tabaix_enqueue_assets() {
  $theme_version = wp_get_theme()->get('Version');

  wp_enqueue_style(
    'tabaix-google-fonts',
    'https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap',
    array(),
    null
  );

  wp_enqueue_style(
    'tabaix-style',
    get_stylesheet_uri(),
    array(),
    $theme_version
  );

  wp_enqueue_style(
    'tabaix-main',
    get_template_directory_uri() . '/assets/css/main.css',
    array('tabaix-style'),
    $theme_version
  );

  wp_enqueue_style(
    'tabaix-components',
    get_template_directory_uri() . '/assets/css/components.css',
    array('tabaix-main'),
    $theme_version
  );

  wp_enqueue_style(
    'tabaix-utilities',
    get_template_directory_uri() . '/assets/css/utilities.css',
    array('tabaix-main'),
    $theme_version
  );

  wp_enqueue_style(
    'tabaix-print',
    get_template_directory_uri() . '/assets/css/print.css',
    array(),
    $theme_version,
    'print'
  );

  wp_enqueue_script(
    'tabaix-main',
    get_template_directory_uri() . '/assets/js/main.js',
    array(),
    $theme_version,
    true
  );
  wp_script_add_data('tabaix-main', 'defer', true);

  wp_enqueue_script(
    'tabaix-navigation',
    get_template_directory_uri() . '/assets/js/navigation.js',
    array('tabaix-main'),
    $theme_version,
    true
  );
  wp_script_add_data('tabaix-navigation', 'defer', true);

  wp_enqueue_script(
    'tabaix-search',
    get_template_directory_uri() . '/assets/js/search.js',
    array('tabaix-main'),
    $theme_version,
    true
  );
  wp_script_add_data('tabaix-search', 'defer', true);

  wp_enqueue_script(
    'tabaix-lazy-load',
    get_template_directory_uri() . '/assets/js/lazy-load.js',
    array(),
    $theme_version,
    true
  );
  wp_script_add_data('tabaix-lazy-load', 'defer', true);

  wp_enqueue_script(
    'tabaix-analytics',
    get_template_directory_uri() . '/assets/js/analytics.js',
    array(),
    $theme_version,
    true
  );
  wp_script_add_data('tabaix-analytics', 'defer', true);

  if (is_singular('tool')) {
    $tool_slug = get_post_field('post_name');
    $tool_css = get_template_directory_uri() . '/tools/' . $tool_slug . '/styles.css';
    $tool_js = get_template_directory_uri() . '/tools/' . $tool_slug . '/script.js';

    if (file_exists(get_template_directory() . '/tools/' . $tool_slug . '/styles.css')) {
      wp_enqueue_style('tabaix-tool-' . $tool_slug, $tool_css, array('tabaix-main'), $theme_version);
    }

    if (file_exists(get_template_directory() . '/tools/' . $tool_slug . '/script.js')) {
      wp_enqueue_script('tabaix-tool-' . $tool_slug, $tool_js, array('tabaix-main'), $theme_version, true);
      wp_script_add_data('tabaix-tool-' . $tool_slug, 'defer', true);
    }
  }
}
add_action('wp_enqueue_scripts', 'tabaix_enqueue_assets');
