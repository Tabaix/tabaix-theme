<?php

if (!defined('ABSPATH')) {
  exit;
}

function tabaix_theme_setup_helpers() {
  add_theme_support('post-thumbnails');
  add_image_size('tabaix-thumbnail', 800, 450, true);
  add_image_size('tabaix-small', 400, 225, true);
  add_theme_support('custom-logo', array(
    'height' => 60,
    'width' => 240,
    'flex-width' => true,
    'flex-height' => true,
  ));
  add_theme_support('customize-selective-refresh-widgets');
}
add_action('after_setup_theme', 'tabaix_theme_setup_helpers');

function tabaix_body_classes($classes) {
  if (is_singular('tool')) {
    $classes[] = 'tool-page';
  }
  if (!is_active_sidebar('sidebar-1')) {
    $classes[] = 'no-sidebar';
  }
  return $classes;
}
add_filter('body_class', 'tabaix_body_classes');
