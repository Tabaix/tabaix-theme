<?php get_header(); ?>
<main class="site-main tag-page">
  <div class="container">
    <header class="archive-header">
      <h1 class="archive-title"><?php single_tag_title(); ?></h1>
      <?php if (tag_description()) : ?><div class="archive-description"><?php echo tag_description(); ?></div><?php endif; ?>
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
