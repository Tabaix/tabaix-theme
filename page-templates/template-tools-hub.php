<?php
/*
Template Name: Tools Hub
*/
get_header(); ?>
<main class="site-main tools-hub-page">
  <div class="container">
    <header class="page-header">
      <h1><?php the_title(); ?></h1>
      <p><?php esc_html_e('Explore the complete library of browser tools.', 'tabaix'); ?></p>
    </header>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
      <?php
      $tools = new WP_Query(array(
        'post_type' => 'tool',
        'posts_per_page' => 20,
      ));
      if ($tools->have_posts()) :
        while ($tools->have_posts()) : $tools->the_post();
          get_template_part('template-parts/content/content', 'tool');
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
