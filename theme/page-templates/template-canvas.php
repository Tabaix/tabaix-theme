<?php
/*
Template Name: Raw HTML Canvas (AI Code Support)
*/
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="profile" href="https://gmpg.org/xfn/11">
  <?php wp_head(); ?>
  
  <style type="text/css">
    html, body {
      margin: 0 !important;
      padding: 0 !important;
      width: 100% !important;
      height: 100% !important;
      overflow-x: hidden;
      background: #ffffff;
      color: #000000;
    }
    .site-wrapper, .site-main, .container, .entry-content {
      max-width: none !important;
      width: 100% !important;
      padding: 0 !important;
      margin: 0 !important;
      background: none !important;
      border: none !important;
      box-shadow: none !important;
    }
    .site-header, .site-footer {
      display: none !important;
    }
  </style>
</head>
<body <?php body_class('tabaix-raw-canvas-page'); ?>>

  <div class="site-wrapper canvas-wrapper">
    <main class="site-main canvas-main">
      <?php while (have_posts()) : the_post(); ?>
        <div class="entry-content canvas-content">
          <?php the_content(); ?>
        </div>
      <?php endwhile; ?>
    </main>
  </div>

  <?php wp_footer(); ?>
</body>
</html>
