<?php get_header(); ?>
<main class="site-main archive-page">
  <div class="container">
    <header class="archive-header">
      <h1 class="archive-title"><?php post_type_archive_title(); ?></h1>
      <p><?php esc_html_e('Browse the latest content and discover curated topics.', 'tabaix'); ?></p>
    </header>

    <?php if (have_posts()) : ?>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php while (have_posts()) : the_post(); ?>
          <?php get_template_part('template-parts/content/content', get_post_type() === 'tool' ? 'tool' : ''); ?>
        <?php endwhile; ?>
      </div>
      <?php the_posts_pagination(); ?>
    <?php else : ?>
      <?php get_template_part('template-parts/content/content', 'none'); ?>
    <?php endif; ?>
  </div>
</main>
<?php get_footer(); ?>
