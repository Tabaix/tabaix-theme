<?php
/*
Template Name: Deals Hub
*/
get_header(); ?>
<main class="site-main deals-hub-page">
  <div class="container">
    <header class="page-header">
      <h1><?php the_title(); ?></h1>
      <p><?php esc_html_e('Find the best GCC deals and savings with curated offers.', 'tabaix'); ?></p>
    </header>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <article <?php post_class('deal-card'); ?>>
          <header class="deal-card-header">
            <?php the_title('<h2 class="deal-card-title">', '</h2>'); ?>
          </header>
          <div class="deal-card-body">
            <?php the_excerpt(); ?>
          </div>
          <a href="<?php the_permalink(); ?>" class="btn btn-outline"><?php esc_html_e('View Deal', 'tabaix'); ?></a>
        </article>
      <?php endwhile; else : get_template_part('template-parts/content/content', 'none'); endif; ?>
    </div>
  </div>
</main>
<?php get_footer(); ?>
