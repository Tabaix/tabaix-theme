<?php

if (!defined('ABSPATH')) {
  exit;
}

function tabaix_customize_register($wp_customize) {
  $wp_customize->add_section('tabaix_theme_options', array(
    'title' => __('Theme Settings', 'tabaix'),
    'priority' => 160,
  ));

  $wp_customize->add_setting('tabaix_accent_color', array(
    'default' => '#2563eb',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'refresh',
  ));

  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'tabaix_accent_color', array(
    'label' => __('Accent Color', 'tabaix'),
    'section' => 'tabaix_theme_options',
    'settings' => 'tabaix_accent_color',
  )));

  // Container Width
  $wp_customize->add_setting('tabaix_container_width', array(
    'default' => '1280',
    'sanitize_callback' => 'absint',
  ));
  $wp_customize->add_control('tabaix_container_width', array(
    'label' => __('Container Max Width (px)', 'tabaix'),
    'section' => 'tabaix_theme_options',
    'type' => 'number',
  ));

  // Border Radius Mode
  $wp_customize->add_setting('tabaix_border_radius', array(
    'default' => 'rounded',
    'sanitize_callback' => 'sanitize_text_field',
  ));
  $wp_customize->add_control('tabaix_border_radius', array(
    'label' => __('Global Border Radius', 'tabaix'),
    'section' => 'tabaix_theme_options',
    'type' => 'select',
    'choices' => array(
      'sharp' => __('Sharp Corners', 'tabaix'),
      'rounded' => __('Modern Rounded', 'tabaix'),
      'pill' => __('Soft Pill', 'tabaix'),
    ),
  ));

  // Hero Background Style
  $wp_customize->add_setting('tabaix_hero_style', array(
    'default' => 'gradient',
    'sanitize_callback' => 'sanitize_text_field',
  ));
  $wp_customize->add_control('tabaix_hero_style', array(
    'label' => __('Hero Background Style', 'tabaix'),
    'section' => 'tabaix_theme_options',
    'type' => 'radio',
    'choices' => array(
      'solid' => __('Solid Color', 'tabaix'),
      'gradient' => __('Glassmorphism Gradient', 'tabaix'),
      'mesh' => __('Mesh Gradient', 'tabaix'),
    ),
  ));
}
add_action('customize_register', 'tabaix_customize_register');

function tabaix_customizer_css() {
  $accent = get_theme_mod('tabaix_accent_color', '#2563eb');
  $width = get_theme_mod('tabaix_container_width', '1280');
  $radius = get_theme_mod('tabaix_border_radius', 'rounded');
  
  $radius_val = '1rem';
  if ($radius === 'sharp') $radius_val = '0px';
  if ($radius === 'pill') $radius_val = '2rem';

  ?>
  <style type="text/css">
    :root {
      --color-primary: <?php echo esc_attr($accent); ?>;
      --container-2xl: <?php echo esc_attr($width); ?>px;
    }
    .card, .tool-card, .guide-card, .deal-card, .btn {
      border-radius: <?php echo esc_attr($radius_val); ?>;
    }
  </style>
  <?php
}
add_action('wp_head', 'tabaix_customizer_css');
