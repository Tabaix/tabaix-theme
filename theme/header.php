<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="profile" href="https://gmpg.org/xfn/11">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
  <?php wp_body_open(); ?>
  <div class="site-wrapper">
    <?php
    $header_classes = array('site-header');
    $header_classes[] = 'logo-aligned-' . get_theme_mod('tabaix_logo_alignment', 'left');
    if (is_front_page() && get_theme_mod('tabaix_header_transparent', false)) {
      $header_classes[] = 'header-transparent';
    }
    ?>
    <header class="<?php echo esc_attr(implode(' ', $header_classes)); ?>">
      <?php get_template_part('template-parts/navigation/navigation', 'primary'); ?>
    </header>
