<?php
/*
Template Name: Guides Hub
*/
get_header(); ?>
<main class="site-main guides-hub-page">
  <div class="container">
    <header class="page-header">
      <h1><?php the_title(); ?></h1>
      <p><?php esc_html_e('Browse the latest Saudi Arabia guides and features.', 'tabaix'); ?></p>
    </header>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <?php
      $guides = new WP_Query(array(
        'post_type' => 'post',
        'posts_per_page' => get_theme_mod('tabaix_guides_limit', 12),
        'category_name' => 'saudi-arabia',
      ));
      if ($guides->have_posts()) :
        while ($guides->have_posts()) : $guides->the_post();
          get_template_part('template-parts/content/content', 'guide');
        endwhile;
      else :
        get_template_part('template-parts/content/content', 'none');
      endif;
      wp_reset_postdata();
      ?>
    </div>
  </div>
</main>
<?php get_footer(); ?>
