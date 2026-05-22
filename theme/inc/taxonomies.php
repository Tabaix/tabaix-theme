<?php

if (!defined('ABSPATH')) {
  exit;
}

function tabaix_register_tool_taxonomy() {
  register_taxonomy('tool-category', 'tool', array(
    'hierarchical' => true,
    'labels' => array(
      'name' => __('Tool Categories', 'tabaix'),
      'singular_name' => __('Tool Category', 'tabaix'),
      'search_items' => __('Search Tool Categories', 'tabaix'),
      'all_items' => __('All Tool Categories', 'tabaix'),
      'parent_item' => __('Parent Tool Category', 'tabaix'),
      'parent_item_colon' => __('Parent Tool Category:', 'tabaix'),
      'edit_item' => __('Edit Tool Category', 'tabaix'),
      'update_item' => __('Update Tool Category', 'tabaix'),
      'add_new_item' => __('Add New Tool Category', 'tabaix'),
    ),
    'show_ui' => true,
    'show_in_rest' => true,
    'rewrite' => array('slug' => 'tool-category'),
  ));

  register_taxonomy('tool-tag', 'tool', array(
    'hierarchical' => false,
    'labels' => array(
      'name' => __('Tool Tags', 'tabaix'),
      'singular_name' => __('Tool Tag', 'tabaix'),
      'search_items' => __('Search Tool Tags', 'tabaix'),
      'all_items' => __('All Tool Tags', 'tabaix'),
      'edit_item' => __('Edit Tool Tag', 'tabaix'),
      'update_item' => __('Update Tool Tag', 'tabaix'),
      'add_new_item' => __('Add New Tool Tag', 'tabaix'),
    ),
    'show_ui' => true,
    'show_in_rest' => true,
    'rewrite' => array('slug' => 'tool-tag'),
  ));
}
add_action('init', 'tabaix_register_tool_taxonomy');
