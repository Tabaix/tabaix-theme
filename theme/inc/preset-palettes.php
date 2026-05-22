<?php
if (!defined('ABSPATH')) {
  exit;
}

/**
 * TABAIX Preset Color Palettes
 * Allows users to quickly switch between pre-built color schemes
 */

// Define preset palettes
function tabaix_get_preset_palettes() {
  return array(
    'modern' => array(
      'label' => __('Modern Blue', 'tabaix'),
      'primary' => '#2563eb',
      'primary_light' => '#3b82f6',
      'primary_dark' => '#1d4ed8',
      'secondary' => '#16a34a',
      'secondary_light' => '#22c55e',
      'secondary_dark' => '#15803d',
      'accent' => '#f59e0b',
      'accent_light' => '#fbbf24',
      'accent_dark' => '#d97706',
      'bg_primary' => '#ffffff',
      'bg_secondary' => '#f8fafc',
      'text_primary' => '#0f172a',
      'text_secondary' => '#475569',
    ),
    'minimal' => array(
      'label' => __('Minimal Gray', 'tabaix'),
      'primary' => '#374151',
      'primary_light' => '#4b5563',
      'primary_dark' => '#1f2937',
      'secondary' => '#6366f1',
      'secondary_light' => '#818cf8',
      'secondary_dark' => '#4f46e5',
      'accent' => '#ec4899',
      'accent_light' => '#f472b6',
      'accent_dark' => '#db2777',
      'bg_primary' => '#ffffff',
      'bg_secondary' => '#f3f4f6',
      'text_primary' => '#111827',
      'text_secondary' => '#6b7280',
    ),
    'bold' => array(
      'label' => __('Bold Purple', 'tabaix'),
      'primary' => '#9333ea',
      'primary_light' => '#a855f7',
      'primary_dark' => '#7e22ce',
      'secondary' => '#e11d48',
      'secondary_light' => '#f43f5e',
      'secondary_dark' => '#be123c',
      'accent' => '#06b6d4',
      'accent_light' => '#22d3ee',
      'accent_dark' => '#0891b2',
      'bg_primary' => '#ffffff',
      'bg_secondary' => '#f5f3ff',
      'text_primary' => '#2d1b4e',
      'text_secondary' => '#6b4c7a',
    ),
    'sunset' => array(
      'label' => __('Sunset Orange', 'tabaix'),
      'primary' => '#ea580c',
      'primary_light' => '#f97316',
      'primary_dark' => '#c2410c',
      'secondary' => '#ff6b35',
      'secondary_light' => '#ff8451',
      'secondary_dark' => '#cc5627',
      'accent' => '#ffd700',
      'accent_light' => '#ffed4e',
      'accent_dark' => '#ccad00',
      'bg_primary' => '#ffffff',
      'bg_secondary' => '#fffbf0',
      'text_primary' => '#3e2723',
      'text_secondary' => '#795548',
    ),
    'forest' => array(
      'label' => __('Forest Green', 'tabaix'),
      'primary' => '#059669',
      'primary_light' => '#10b981',
      'primary_dark' => '#047857',
      'secondary' => '#0f766e',
      'secondary_light' => '#14b8a6',
      'secondary_dark' => '#0d5c56',
      'accent' => '#f59e0b',
      'accent_light' => '#fbbf24',
      'accent_dark' => '#d97706',
      'bg_primary' => '#ffffff',
      'bg_secondary' => '#f0fdf4',
      'text_primary' => '#064e3b',
      'text_secondary' => '#047857',
    ),
    'ocean' => array(
      'label' => __('Ocean Blue', 'tabaix'),
      'primary' => '#0369a1',
      'primary_light' => '#0ea5e9',
      'primary_dark' => '#075985',
      'secondary' => '#06b6d4',
      'secondary_light' => '#67e8f9',
      'secondary_dark' => '#0891b2',
      'accent' => '#1e40af',
      'accent_light' => '#3b82f6',
      'accent_dark' => '#1e3a8a',
      'bg_primary' => '#ffffff',
      'bg_secondary' => '#f0f9ff',
      'text_primary' => '#001f3f',
      'text_secondary' => '#0c4a6e',
    ),
  );
}

// Register Customizer Controls
function tabaix_register_preset_palettes($wp_customize) {
  $palettes = tabaix_get_preset_palettes();
  $palette_choices = wp_list_pluck($palettes, 'label');

  // Palette Selector Setting
  $wp_customize->add_setting('tabaix_preset_palette', array(
    'default' => 'modern',
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'postMessage',
  ));

  // Palette Selector Control
  $wp_customize->add_control('tabaix_preset_palette', array(
    'type' => 'select',
    'section' => 'colors',
    'label' => __('Color Palette', 'tabaix'),
    'description' => __('Choose a preset color palette to instantly change your theme colors.', 'tabaix'),
    'choices' => $palette_choices,
    'priority' => 5,
  ));
}
add_action('customize_register', 'tabaix_register_preset_palettes');

// Generate CSS from selected palette
function tabaix_enqueue_palette_css() {
  $palette_name = get_theme_mod('tabaix_preset_palette', 'modern');
  $palettes = tabaix_get_preset_palettes();
  
  if (!isset($palettes[$palette_name])) {
    $palette_name = 'modern';
  }
  
  $palette = $palettes[$palette_name];
  
  $css = ':root {';
  $css .= '--color-primary: ' . esc_attr($palette['primary']) . ';';
  $css .= '--color-primary-light: ' . esc_attr($palette['primary_light']) . ';';
  $css .= '--color-primary-dark: ' . esc_attr($palette['primary_dark']) . ';';
  $css .= '--color-secondary: ' . esc_attr($palette['secondary']) . ';';
  $css .= '--color-secondary-light: ' . esc_attr($palette['secondary_light']) . ';';
  $css .= '--color-secondary-dark: ' . esc_attr($palette['secondary_dark']) . ';';
  $css .= '--color-accent: ' . esc_attr($palette['accent']) . ';';
  $css .= '--color-accent-light: ' . esc_attr($palette['accent_light']) . ';';
  $css .= '--color-accent-dark: ' . esc_attr($palette['accent_dark']) . ';';
  $css .= '--color-bg-primary: ' . esc_attr($palette['bg_primary']) . ';';
  $css .= '--color-bg-secondary: ' . esc_attr($palette['bg_secondary']) . ';';
  $css .= '--color-text-primary: ' . esc_attr($palette['text_primary']) . ';';
  $css .= '--color-text-secondary: ' . esc_attr($palette['text_secondary']) . ';';
  $css .= '}';
  
  wp_add_inline_style('tabaix-style', $css);
}
add_action('wp_enqueue_scripts', 'tabaix_enqueue_palette_css', 15);

// Customizer Live Preview Script
function tabaix_palette_customize_preview() {
  wp_enqueue_script(
    'tabaix-palette-preview',
    get_template_directory_uri() . '/assets/js/customize-palette-preview.js',
    array('customize-preview'),
    TABAIX_VERSION,
    true
  );
}
add_action('customize_preview_init', 'tabaix_palette_customize_preview');
