<?php

if (!defined('ABSPATH')) {
  exit;
}

function tabaix_get_breadcrumbs() {
  $breadcrumbs = array();
  $breadcrumbs[] = array('url' => home_url('/'), 'label' => __('Home', 'tabaix'));

  if (is_singular('tool')) {
    $terms = get_the_terms(get_the_ID(), 'tool-category');
    if ($terms && !is_wp_error($terms)) {
      $term = $terms[0];
      $breadcrumbs[] = array('url' => get_post_type_archive_link('tool'), 'label' => __('Tools', 'tabaix'));
      $breadcrumbs[] = array('url' => get_term_link($term), 'label' => $term->name);
    }
    $breadcrumbs[] = array('url' => get_permalink(), 'label' => get_the_title());
  } elseif (is_single()) {
    $breadcrumbs[] = array('url' => get_permalink(), 'label' => get_the_title());
  } elseif (is_archive()) {
    $breadcrumbs[] = array('url' => get_post_type_archive_link(get_post_type()), 'label' => get_the_archive_title());
  }

  return $breadcrumbs;
}

function tabaix_render_breadcrumbs() {
  $breadcrumbs = tabaix_get_breadcrumbs();
  if (empty($breadcrumbs)) {
    return;
  }

  echo '<nav class="breadcrumbs" aria-label="breadcrumb"><ol>'; 
  foreach ($breadcrumbs as $item) {
    echo '<li><a href="' . esc_url($item['url']) . '">' . esc_html($item['label']) . '</a></li>';
  }
  echo '</ol></nav>';
}
