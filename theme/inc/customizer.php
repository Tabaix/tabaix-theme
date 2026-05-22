<?php

if (!defined('ABSPATH')) {
  exit;
}

function tabaix_customize_register($wp_customize) {
  // ==========================================
  // 1. Colors Panel & Section
  // ==========================================
  $wp_customize->add_section('tabaix_colors_section', array(
    'title' => __('Colors Settings', 'tabaix'),
    'priority' => 30,
  ));

  // Accent/Primary Color
  $wp_customize->add_setting('tabaix_accent_color', array(
    'default' => '#2563eb',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'refresh',
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'tabaix_accent_color', array(
    'label' => __('Accent/Primary Color', 'tabaix'),
    'section' => 'tabaix_colors_section',
  )));

  // Secondary Color
  $wp_customize->add_setting('tabaix_secondary_color', array(
    'default' => '#a855f7',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'refresh',
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'tabaix_secondary_color', array(
    'label' => __('Secondary Color', 'tabaix'),
    'section' => 'tabaix_colors_section',
  )));

  // Text Color
  $wp_customize->add_setting('tabaix_text_color', array(
    'default' => '#0f172a',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'refresh',
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'tabaix_text_color', array(
    'label' => __('Body Text Color', 'tabaix'),
    'section' => 'tabaix_colors_section',
  )));

  // Background Color
  $wp_customize->add_setting('tabaix_background_color', array(
    'default' => '#ffffff',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'refresh',
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'tabaix_background_color', array(
    'label' => __('Main Background Color', 'tabaix'),
    'section' => 'tabaix_colors_section',
  )));

  // Footer Background Color
  $wp_customize->add_setting('tabaix_footer_bg_color', array(
    'default' => '#f8fafc',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'refresh',
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'tabaix_footer_bg_color', array(
    'label' => __('Footer Background Color', 'tabaix'),
    'section' => 'tabaix_colors_section',
  )));

  // Link Color
  $wp_customize->add_setting('tabaix_link_color', array(
    'default' => '#2563eb',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'refresh',
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'tabaix_link_color', array(
    'label' => __('Link Color', 'tabaix'),
    'section' => 'tabaix_colors_section',
  )));


  // ==========================================
  // 2. Typography Section
  // ==========================================
  $wp_customize->add_section('tabaix_typography_section', array(
    'title' => __('Typography Settings', 'tabaix'),
    'priority' => 40,
  ));

  $font_choices = array(
    'Plus Jakarta Sans' => 'Plus Jakarta Sans',
    'Inter' => 'Inter',
    'Roboto' => 'Roboto',
    'Poppins' => 'Poppins',
    'Outfit' => 'Outfit',
    'Montserrat' => 'Montserrat',
    'Lora' => 'Lora',
    'Open Sans' => 'Open Sans',
  );

  // Heading Font Family
  $wp_customize->add_setting('tabaix_heading_font', array(
    'default' => 'Plus Jakarta Sans',
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'refresh',
  ));
  $wp_customize->add_control('tabaix_heading_font', array(
    'label' => __('Headings Font Family', 'tabaix'),
    'section' => 'tabaix_typography_section',
    'type' => 'select',
    'choices' => $font_choices,
  ));

  // Body Font Family
  $wp_customize->add_setting('tabaix_body_font', array(
    'default' => 'Inter',
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'refresh',
  ));
  $wp_customize->add_control('tabaix_body_font', array(
    'label' => __('Body Font Family', 'tabaix'),
    'section' => 'tabaix_typography_section',
    'type' => 'select',
    'choices' => $font_choices,
  ));

  // Body Font Size
  $wp_customize->add_setting('tabaix_body_font_size', array(
    'default' => '16',
    'sanitize_callback' => 'absint',
    'transport' => 'refresh',
  ));
  $wp_customize->add_control('tabaix_body_font_size', array(
    'label' => __('Body Font Size (px)', 'tabaix'),
    'section' => 'tabaix_typography_section',
    'type' => 'number',
    'input_attrs' => array(
      'min' => 12,
      'max' => 24,
      'step' => 1,
    ),
  ));


  // ==========================================
  // 3. Layout & Styling Settings
  // ==========================================
  $wp_customize->add_section('tabaix_theme_options', array(
    'title' => __('Layout Settings', 'tabaix'),
    'priority' => 50,
  ));

  // Container Width
  $wp_customize->add_setting('tabaix_container_width', array(
    'default' => '1280',
    'sanitize_callback' => 'absint',
    'transport' => 'refresh',
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
    'transport' => 'refresh',
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
    'transport' => 'refresh',
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


  // ==========================================
  // 4. Header Settings
  // ==========================================
  $wp_customize->add_section('tabaix_header_section', array(
    'title' => __('Header Settings', 'tabaix'),
    'priority' => 60,
  ));

  // Sticky Header Toggle
  $wp_customize->add_setting('tabaix_header_sticky', array(
    'default' => true,
    'sanitize_callback' => 'wp_validate_boolean',
    'transport' => 'refresh',
  ));
  $wp_customize->add_control('tabaix_header_sticky', array(
    'label' => __('Enable Sticky Header', 'tabaix'),
    'section' => 'tabaix_header_section',
    'type' => 'checkbox',
  ));

  // Transparent Header Toggle
  $wp_customize->add_setting('tabaix_header_transparent', array(
    'default' => false,
    'sanitize_callback' => 'wp_validate_boolean',
    'transport' => 'refresh',
  ));
  $wp_customize->add_control('tabaix_header_transparent', array(
    'label' => __('Enable Transparent Header on Homepage', 'tabaix'),
    'section' => 'tabaix_header_section',
    'type' => 'checkbox',
  ));

  // Logo Alignment
  $wp_customize->add_setting('tabaix_logo_alignment', array(
    'default' => 'left',
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'refresh',
  ));
  $wp_customize->add_control('tabaix_logo_alignment', array(
    'label' => __('Logo Alignment', 'tabaix'),
    'section' => 'tabaix_header_section',
    'type' => 'select',
    'choices' => array(
      'left' => __('Left aligned', 'tabaix'),
      'center' => __('Center aligned', 'tabaix'),
    ),
  ));


  // ==========================================
  // 5. Footer Settings
  // ==========================================
  $wp_customize->add_section('tabaix_footer_section', array(
    'title' => __('Footer Settings', 'tabaix'),
    'priority' => 70,
  ));

  // Widget Columns
  $wp_customize->add_setting('tabaix_footer_columns', array(
    'default' => '4',
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'refresh',
  ));
  $wp_customize->add_control('tabaix_footer_columns', array(
    'label' => __('Footer Columns Layout', 'tabaix'),
    'section' => 'tabaix_footer_section',
    'type' => 'select',
    'choices' => array(
      '1' => __('1 Column (Full Width)', 'tabaix'),
      '2' => __('2 Columns (Split)', 'tabaix'),
      '3' => __('3 Columns', 'tabaix'),
      '4' => __('4 Columns (Grid)', 'tabaix'),
    ),
  ));

  // Copyright Text
  $wp_customize->add_setting('tabaix_footer_copyright', array(
    'default' => __('All rights reserved.', 'tabaix'),
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'refresh',
  ));
  $wp_customize->add_control('tabaix_footer_copyright', array(
    'label' => __('Copyright Notice Text', 'tabaix'),
    'section' => 'tabaix_footer_section',
    'type' => 'text',
  ));

  // Disclaimer Text
  $wp_customize->add_setting('tabaix_footer_disclaimer', array(
    'default' => __('TABAIX is a participant in the Amazon Services LLC Associates Program and other affiliate programs. This means that if you click on a link and make a purchase, we may earn a commission at no additional cost to you. We only recommend products and services we trust.', 'tabaix'),
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'refresh',
  ));
  $wp_customize->add_control('tabaix_footer_disclaimer', array(
    'label' => __('Affiliate Disclaimer', 'tabaix'),
    'section' => 'tabaix_footer_section',
    'type' => 'textarea',
  ));

  // Show Social Media icons toggle
  $wp_customize->add_setting('tabaix_footer_show_social', array(
    'default' => true,
    'sanitize_callback' => 'wp_validate_boolean',
    'transport' => 'refresh',
  ));
  $wp_customize->add_control('tabaix_footer_show_social', array(
    'label' => __('Display Social Links in Footer', 'tabaix'),
    'section' => 'tabaix_footer_section',
    'type' => 'checkbox',
  ));


  // ==========================================
  // 6. Social Links Section
  // ==========================================
  $wp_customize->add_section('tabaix_social_section', array(
    'title' => __('Social Media Profiles', 'tabaix'),
    'priority' => 80,
  ));

  $socials = array(
    'twitter' => __('Twitter/X URL', 'tabaix'),
    'instagram' => __('Instagram URL', 'tabaix'),
    'facebook' => __('Facebook URL', 'tabaix'),
    'linkedin' => __('LinkedIn URL', 'tabaix'),
  );

  foreach ($socials as $key => $label) {
    $wp_customize->add_setting('tabaix_social_' . $key, array(
      'default' => '#',
      'sanitize_callback' => 'esc_url_raw',
      'transport' => 'refresh',
    ));
    $wp_customize->add_control('tabaix_social_' . $key, array(
      'label' => $label,
      'section' => 'tabaix_social_section',
      'type' => 'url',
    ));
  }


  // ==========================================
  // 7. Google AdSense Section
  // ==========================================
  $wp_customize->add_section('tabaix_ads_section', array(
    'title' => __('Google AdSense', 'tabaix'),
    'priority' => 90,
  ));

  // Enable Ads
  $wp_customize->add_setting('tabaix_ads_enabled', array(
    'default' => false,
    'sanitize_callback' => 'wp_validate_boolean',
    'transport' => 'refresh',
  ));
  $wp_customize->add_control('tabaix_ads_enabled', array(
    'label' => __('Enable AdSense Ads', 'tabaix'),
    'section' => 'tabaix_ads_section',
    'type' => 'checkbox',
  ));

  // Publisher ID
  $wp_customize->add_setting('tabaix_ads_pub_id', array(
    'default' => 'ca-pub-9797202524330784',
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'refresh',
  ));
  $wp_customize->add_control('tabaix_ads_pub_id', array(
    'label' => __('AdSense Publisher ID', 'tabaix'),
    'description' => __('Format: ca-pub-xxxxxxxxxxxxxxxx', 'tabaix'),
    'section' => 'tabaix_ads_section',
    'type' => 'text',
  ));

  // Placement Toggles
  $placements = array(
    'in_article' => __('Show In-Article Ads', 'tabaix'),
    'header' => __('Show Header Banner Ads', 'tabaix'),
    'footer' => __('Show Footer Banner Ads', 'tabaix'),
    'sidebar' => __('Show Sidebar Ads', 'tabaix'),
  );

  foreach ($placements as $key => $label) {
    $wp_customize->add_setting('tabaix_ad_' . $key, array(
      'default' => ($key === 'in_article'),
      'sanitize_callback' => 'wp_validate_boolean',
      'transport' => 'refresh',
    ));
    $wp_customize->add_control('tabaix_ad_' . $key, array(
      'label' => $label,
      'section' => 'tabaix_ads_section',
      'type' => 'checkbox',
    ));
  }


  // ==========================================
  // 8. SEO Tool Settings
  // ==========================================
  $wp_customize->add_section('tabaix_seo_section', array(
    'title' => __('SEO Tool Settings', 'tabaix'),
    'priority' => 100,
  ));

  $wp_customize->add_setting('tabaix_seo_api_url', array(
    'default' => 'http://localhost:3000/api/audit',
    'sanitize_callback' => 'esc_url_raw',
    'transport' => 'refresh',
  ));
  $wp_customize->add_control('tabaix_seo_api_url', array(
    'label' => __('Vercel SEO API Endpoint URL', 'tabaix'),
    'section' => 'tabaix_seo_section',
    'type' => 'url',
  ));

  // ==========================================
  // 9. Query & Content Limits
  // ==========================================
  $wp_customize->add_section('tabaix_query_section', array(
    'title' => __('Query & Content Limits', 'tabaix'),
    'priority' => 110,
  ));

  // Tools Query Limit
  $wp_customize->add_setting('tabaix_tools_limit', array(
    'default' => '20',
    'sanitize_callback' => 'absint',
    'transport' => 'refresh',
  ));
  $wp_customize->add_control('tabaix_tools_limit', array(
    'label' => __('Number of Tools per Page', 'tabaix'),
    'section' => 'tabaix_query_section',
    'type' => 'number',
    'input_attrs' => array(
      'min' => 1,
      'max' => 200,
      'step' => 1,
    ),
  ));

  // Deals Query Limit
  $wp_customize->add_setting('tabaix_deals_limit', array(
    'default' => '12',
    'sanitize_callback' => 'absint',
    'transport' => 'refresh',
  ));
  $wp_customize->add_control('tabaix_deals_limit', array(
    'label' => __('Number of Affiliate Deals per Page', 'tabaix'),
    'section' => 'tabaix_query_section',
    'type' => 'number',
    'input_attrs' => array(
      'min' => 1,
      'max' => 200,
      'step' => 1,
    ),
  ));

  // Guides Query Limit
  $wp_customize->add_setting('tabaix_guides_limit', array(
    'default' => '12',
    'sanitize_callback' => 'absint',
    'transport' => 'refresh',
  ));
  $wp_customize->add_control('tabaix_guides_limit', array(
    'label' => __('Number of Guides per Page', 'tabaix'),
    'section' => 'tabaix_query_section',
    'type' => 'number',
    'input_attrs' => array(
      'min' => 1,
      'max' => 200,
      'step' => 1,
    ),
  ));
}
add_action('customize_register', 'tabaix_customize_register');

function tabaix_customizer_css() {
  $accent = get_theme_mod('tabaix_accent_color', '#2563eb');
  $secondary = get_theme_mod('tabaix_secondary_color', '#a855f7');
  $text_color = get_theme_mod('tabaix_text_color', '#0f172a');
  $bg_color = get_theme_mod('tabaix_background_color', '#ffffff');
  $footer_bg = get_theme_mod('tabaix_footer_bg_color', '#f8fafc');
  $link_color = get_theme_mod('tabaix_link_color', '#2563eb');

  $heading_font = get_theme_mod('tabaix_heading_font', 'Plus Jakarta Sans');
  $body_font = get_theme_mod('tabaix_body_font', 'Inter');
  $body_font_size = get_theme_mod('tabaix_body_font_size', '16');

  $width = get_theme_mod('tabaix_container_width', '1280');
  $radius = get_theme_mod('tabaix_border_radius', 'rounded');
  
  $radius_val = '1rem';
  if ($radius === 'sharp') $radius_val = '0px';
  if ($radius === 'pill') $radius_val = '2rem';

  ?>
  <style type="text/css">
    :root {
      --color-primary: <?php echo esc_attr($accent); ?>;
      --color-secondary: <?php echo esc_attr($secondary); ?>;
      --color-text-primary: <?php echo esc_attr($text_color); ?>;
      --color-bg-primary: <?php echo esc_attr($bg_color); ?>;
      --color-bg-elevated: <?php echo $bg_color === '#ffffff' ? '#f8fafc' : 'color-mix(in srgb, ' . esc_attr($bg_color) . ' 94%, #000000)'; ?>;
      --color-border-primary: <?php echo $bg_color === '#ffffff' ? '#e2e8f0' : 'color-mix(in srgb, ' . esc_attr($bg_color) . ' 85%, #000000)'; ?>;
      --color-text-secondary: color-mix(in srgb, <?php echo esc_attr($text_color); ?> 80%, var(--color-bg-primary));
      --container-2xl: <?php echo esc_attr($width); ?>px;
    }
    
    body {
      font-family: '<?php echo esc_attr($body_font); ?>', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif !important;
      font-size: <?php echo esc_attr($body_font_size); ?>px !important;
      background-color: <?php echo esc_attr($bg_color); ?> !important;
      color: <?php echo esc_attr($text_color); ?> !important;
    }
    
    h1, h2, h3, h4, h5, h6 {
      font-family: '<?php echo esc_attr($heading_font); ?>', sans-serif !important;
    }
    
    a {
      color: <?php echo esc_attr($link_color); ?>;
      transition: opacity 0.2s ease;
    }
    
    a:hover {
      color: <?php echo esc_attr($accent); ?>;
      opacity: 0.85;
    }

    .site-footer {
      background: <?php echo esc_attr($footer_bg); ?> !important;
    }

    .card, .tool-card, .guide-card, .deal-card, .btn, .newsletter-card, .cta-card {
      border-radius: <?php echo esc_attr($radius_val); ?> !important;
    }
    
    <?php if (get_theme_mod('tabaix_header_sticky', true)): ?>
    .site-header {
      position: sticky !important;
      top: 0;
      z-index: 1000;
    }
    <?php else: ?>
    .site-header {
      position: relative !important;
    }
    <?php endif; ?>

    <?php if (is_front_page() && get_theme_mod('tabaix_header_transparent', false)): ?>
    .site-header {
      background: transparent !important;
      border-bottom-color: transparent !important;
      backdrop-filter: none !important;
      -webkit-backdrop-filter: none !important;
    }
    <?php endif; ?>

    @media (min-width: 768px) {
      .logo-aligned-center .nav-primary__wrapper {
        flex-direction: column !important;
        align-items: center !important;
        gap: var(--space-4) !important;
      }
      .logo-aligned-center .nav-primary__menu-wrap {
        width: 100% !important;
        justify-content: center !important;
        margin-top: var(--space-2);
      }
    }
  </style>
  <?php
}
add_action('wp_head', 'tabaix_customizer_css');
