<?php get_header(); ?>

<main class="site-main">
  <div class="container">
    <?php if (have_posts()) : ?>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php while (have_posts()) : the_post(); ?>
          <?php get_template_part('template-parts/content/content', get_post_type() === 'tool' ? 'tool' : get_post_type()); ?>
        <?php endwhile; ?>
      </div>

      <?php the_posts_pagination(array(
        'mid_size' => 2,
        'prev_text' => __('Previous', 'tabaix'),
        'next_text' => __('Next', 'tabaix')
      )); ?>
    <?php else : ?>
      <?php get_template_part('template-parts/content/content', 'none'); ?>
    <?php endif; ?>
  </div>
</main>

<?php get_footer(); ?>
