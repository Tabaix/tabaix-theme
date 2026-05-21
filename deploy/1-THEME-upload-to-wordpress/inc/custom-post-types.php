<?php

if (!defined('ABSPATH')) {
  exit;
}

function tabaix_register_tool_post_type() {
  $labels = array(
    'name' => __('Tools', 'tabaix'),
    'singular_name' => __('Tool', 'tabaix'),
    'add_new' => __('Add New Tool', 'tabaix'),
    'add_new_item' => __('Add New Tool', 'tabaix'),
    'edit_item' => __('Edit Tool', 'tabaix'),
    'new_item' => __('New Tool', 'tabaix'),
    'view_item' => __('View Tool', 'tabaix'),
    'search_items' => __('Search Tools', 'tabaix'),
    'not_found' => __('No tools found', 'tabaix'),
    'not_found_in_trash' => __('No tools found in Trash', 'tabaix'),
    'menu_name' => __('Tools', 'tabaix'),
  );

  $args = array(
    'labels' => $labels,
    'public' => true,
    'has_archive' => true,
    'rewrite' => array('slug' => 'tools'),
    'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
    'show_in_rest' => true,
    'menu_position' => 5,
    'menu_icon' => 'dashicons-admin-tools',
    'capability_type' => 'post',
  );

  register_post_type('tool', $args);
}
add_action('init', 'tabaix_register_tool_post_type');

function tabaix_register_tool_meta() {
  register_post_meta('tool', 'tool_color', array(
    'type' => 'string',
    'single' => true,
    'show_in_rest' => true,
    'default' => '#3b82f6',
  ));

  register_post_meta('tool', 'tool_icon', array(
    'type' => 'string',
    'single' => true,
    'show_in_rest' => true,
  ));

  register_post_meta('tool', 'featured', array(
    'type' => 'boolean',
    'single' => true,
    'show_in_rest' => true,
    'default' => false,
  ));

  register_post_meta('tool', 'difficulty', array(
    'type' => 'string',
    'single' => true,
    'show_in_rest' => true,
    'default' => 'easy',
  ));

  register_post_meta('tool', 'usage_count', array(
    'type' => 'integer',
    'single' => true,
    'show_in_rest' => true,
    'default' => 0,
  ));
}
add_action('init', 'tabaix_register_tool_meta');
