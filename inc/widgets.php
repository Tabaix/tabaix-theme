<?php

if (!defined('ABSPATH')) {
  exit;
}

function tabaix_register_widget_areas() {
  register_sidebar(array(
    'name' => __('Sidebar', 'tabaix'),
    'id' => 'sidebar-1',
    'description' => __('Main sidebar that appears on the right on blog and archive pages.', 'tabaix'),
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget' => '</section>',
    'before_title' => '<h2 class="widget-title">',
    'after_title' => '</h2>',
  ));
}
add_action('widgets_init', 'tabaix_register_widget_areas');
