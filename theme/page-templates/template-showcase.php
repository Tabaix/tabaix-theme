<?php
/*
Template Name: Content Showcase
*/
get_header(); ?>

<main class="site-main showcase-template" style="background: var(--color-bg-primary); padding: 80px 0;">
  <div class="container" style="max-width: 1140px; margin: 0 auto;">
    <header style="text-align: center; margin-bottom: 60px;">
      <p style="text-transform: uppercase; letter-spacing: 0.22em; color: var(--color-secondary); margin-bottom: 1rem; font-weight: 700;">Showcase</p>
      <h1 style="font-size: 3rem; color: var(--color-text-primary); margin-bottom: 1rem;">A flexible page for case studies and content highlights</h1>
      <p style="color: var(--color-text-secondary); font-size: 1.05rem; line-height: 1.8; max-width: 760px; margin: 0 auto;">Use this template to arrange large content sections, highlight visuals, and make every page look premium.</p>
    </header>

    <section style="display: grid; gap: 30px;">
      <?php for ($i = 1; $i <= 3; $i++) : ?>
        <div style="display: grid; gap: 20px; background: var(--color-bg-elevated); border: 1px solid var(--color-border-primary); border-radius: var(--radius-val, 1rem); overflow: hidden;">
          <div style="background: linear-gradient(180deg, var(--color-primary), var(--color-secondary)); color:#fff; padding: 40px;">
            <h2 style="font-size: 2rem; margin: 0;">Section <?php echo $i; ?></h2>
          </div>
          <div style="padding: 36px;">
            <p style="color: var(--color-text-secondary); line-height: 1.8;">This section can present product details, customer stories, and bold calls to action that are easy to update.</p>
            <a href="#" style="color: var(--color-primary); font-weight: 700;">Read more →</a>
          </div>
        </div>
      <?php endfor; ?>
    </section>

    <section style="padding: 60px 0; background: var(--color-bg-secondary);">
      <div class="container" style="max-width: 1080px; margin: 0 auto;">
        <?php while (have_posts()) : the_post(); ?>
          <article id="post-<?php the_ID(); ?>" <?php post_class('showcase-content'); ?> style="background: var(--color-bg-elevated); border: 1px solid var(--color-border-primary); border-radius: var(--radius-val, 1rem); padding: 40px;">
            <?php the_content(); ?>
          </article>
        <?php endwhile; ?>
      </div>
    </section>
  </div>
</main>

<?php get_footer(); ?>