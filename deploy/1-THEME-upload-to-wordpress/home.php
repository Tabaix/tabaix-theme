<?php get_header(); ?>
<main class="site-main">
  <div class="container">
    <h1 class="page-title"><?php single_post_title(); ?></h1>
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      <?php get_template_part('template-parts/content/content', get_post_format() ?: ''); ?>
    <?php endwhile; endif; ?>
  </div>
</main>
<?php get_footer(); ?>
