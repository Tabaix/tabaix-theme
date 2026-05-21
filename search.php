<?php get_header(); ?>
<main class="site-main search-results">
  <div class="container">
    <header class="archive-header">
      <h1 class="archive-title"><?php printf(esc_html__('Search Results for: %s', 'tabaix'), '<span>' . get_search_query() . '</span>'); ?></h1>
    </header>

    <?php if (have_posts()) : ?>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php while (have_posts()) : the_post(); ?>
          <?php get_template_part('template-parts/content/content', get_post_type() === 'tool' ? 'tool' : 'search'); ?>
        <?php endwhile; ?>
      </div>
      <?php the_posts_pagination(); ?>
    <?php else : ?>
      <?php get_template_part('template-parts/content/content', 'none'); ?>
    <?php endif; ?>
  </div>
</main>
<?php get_footer(); ?>
