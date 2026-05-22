<?php

if (!defined('ABSPATH')) {
  exit;
}

function tabaix_filter_tools_ajax() {
    check_ajax_referer('tabaix_ajax_nonce', 'nonce');

    $category = isset($_POST['category']) ? sanitize_text_field($_POST['category']) : 'all';

    $args = array(
        'post_type' => 'tool',
        'posts_per_page' => get_theme_mod('tabaix_tools_limit', 8),
        'post_status' => 'publish',
    );

    if ($category !== 'all') {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'tool-category',
                'field'    => 'slug',
                'terms'    => $category,
            ),
        );
    }

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            get_template_part('template-parts/content/content', 'tool');
        }
    } else {
        echo '<p class="w-full text-center py-8 text-gray-500">' . esc_html__('No tools found in this category.', 'tabaix') . '</p>';
    }

    wp_reset_postdata();
    wp_die();
}

add_action('wp_ajax_tabaix_filter_tools', 'tabaix_filter_tools_ajax');
add_action('wp_ajax_nopriv_tabaix_filter_tools', 'tabaix_filter_tools_ajax');
