<?php
/*
Template Name: Marketing Landing Page
*/
get_header(); ?>

<main class="site-main landing-page-template" style="background-color: var(--color-bg-primary); padding: 60px 0;">
  <div class="container" style="max-width: var(--container-2xl, 1280px); margin: 0 auto; padding: 0 var(--space-4);">
    <?php while (have_posts()) : the_post(); ?>
      <article id="post-<?php the_ID(); ?>" <?php post_class('landing-article'); ?> style="background: var(--color-bg-elevated); border: 1px solid var(--color-border-primary); border-radius: var(--radius-val, 1rem); padding: 50px; box-shadow: 0 4px 20px rgba(0,0,0,0.02);">
        <header class="entry-header" style="text-align: center; margin-bottom: 40px; border-bottom: 1px solid var(--color-border-primary); padding-bottom: 30px;">
          <h1 class="entry-title" style="font-size: 2.75rem; font-weight: 800; line-height: 1.2; margin-top: 0; background: linear-gradient(135deg, var(--color-primary), var(--color-secondary)); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
            <?php the_title(); ?>
          </h1>
          <?php if (has_excerpt()) : ?>
            <p class="landing-subtitle" style="font-size: 1.25rem; color: var(--color-text-secondary); max-width: 700px; margin: 20px auto 0;">
              <?php echo get_the_excerpt(); ?>
            </p>
          <?php endif; ?>
        </header>

        <div class="entry-content landing-content" style="font-size: 1.125rem; line-height: 1.8; color: var(--color-text-primary);">
          <?php the_content(); ?>
        </div>
      </article>
    <?php endwhile; ?>
  </div>
</main>

<style type="text/css">
  .landing-page-template img {
    max-width: 100%;
    height: auto;
    border-radius: var(--radius-val, 1rem);
  }
  .landing-content p {
    margin-bottom: var(--space-4, 1.5rem);
  }
  .landing-content h2 {
    font-size: 2rem;
    font-weight: 700;
    margin-top: 2rem;
    margin-bottom: 1rem;
    color: var(--color-primary);
  }
</style>

<?php get_footer(); ?>
