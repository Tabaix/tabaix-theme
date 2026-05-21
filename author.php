<?php get_header(); ?>
<main class="site-main author-page">
  <div class="container">
    <header class="archive-header">
      <h1 class="archive-title"><?php the_archive_title(); ?></h1>
      <?php if (is_author()) : ?><p class="archive-description"><?php echo esc_html(get_the_author_meta('description', get_query_var('author'))); ?></p><?php endif; ?>
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
