<?php
/*
Template Name: Homepage Sections
*/
get_header(); ?>

<main class="site-main homepage-sections-template" style="background: var(--color-bg-primary);">
  <section class="hero" style="padding: 100px 0; background: linear-gradient(180deg, var(--color-primary), var(--color-secondary)); color: #fff; text-align: center;">
    <div class="container" style="max-width: 1080px; margin: 0 auto; padding: 0 var(--space-4);">
      <h1 style="font-size: 3.6rem; font-weight: 800; line-height: 1.05; margin-bottom: 1rem;">Design a premium homepage in minutes</h1>
      <p style="font-size: 1.25rem; color: rgba(255,255,255,0.85); margin-bottom: 2rem; max-width: 760px; margin-left: auto; margin-right: auto;">Build hero sections, feature rows, testimonials and conversion blocks with a modern page template designed for fast editing.</p>
      <a href="#features" class="button" style="display: inline-block; padding: 16px 32px; border-radius: 999px; background: #fff; color: var(--color-primary); font-weight: 700;">Start Editing</a>
    </div>
  </section>

  <section id="features" style="padding: 80px 0;">
    <div class="container" style="max-width: 1100px; margin: 0 auto; display: grid; gap: 24px; grid-template-columns: repeat(auto-fit,minmax(260px,1fr));">
      <?php for ($i = 1; $i <= 4; $i++) : ?>
        <div class="feature-card" style="background: var(--color-bg-elevated); border: 1px solid var(--color-border-primary); border-radius: var(--radius-val, 1rem); padding: 30px;">
          <h2 style="font-size: 1.5rem; margin-bottom: 1rem; color: var(--color-primary);">Feature <?php echo $i; ?></h2>
          <p style="color: var(--color-text-secondary); line-height: 1.75;">Use this section to highlight what makes your business stand out with clean content blocks that are easy to update inside the editor.</p>
        </div>
      <?php endfor; ?>
    </div>
  </section>

  <section style="padding: 80px 0; background: var(--color-bg-secondary);">
    <div class="container" style="max-width: 1040px; margin: 0 auto; display: grid; gap: 40px; grid-template-columns: 1fr 1fr; align-items: center;">
      <div>
        <h2 style="font-size: 2.5rem; margin-bottom: 1rem;">Build your home page with blocks and patterns</h2>
        <p style="color: var(--color-text-secondary); font-size: 1.1rem; line-height: 1.8;">This page template is designed to work with the WordPress editor, so you can swap sections, edit text, and move content without leaving the page.</p>
      </div>
      <div style="display: grid; gap: 16px;">
        <div style="background: var(--color-bg-primary); border: 1px solid var(--color-border-primary); border-radius: var(--radius-val, 1rem); padding: 24px;">Hero, CTA, cards, and testimonial sections can all be edited visually.</div>
        <div style="background: var(--color-bg-primary); border: 1px solid var(--color-border-primary); border-radius: var(--radius-val, 1rem); padding: 24px;">Use the block inserter to add patterns and page sections instantly.</div>
      </div>
    </div>
  </section>

  <section style="padding: 80px 0;">
    <div class="container" style="max-width: 1080px; margin: 0 auto;">
      <?php while (have_posts()) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class('homepage-sections-content'); ?> style="background: var(--color-bg-elevated); border: 1px solid var(--color-border-primary); border-radius: var(--radius-val, 1rem); padding: 40px;">
          <?php the_content(); ?>
        </article>
      <?php endwhile; ?>
    </div>
  </section>
</main>

<style>
  .homepage-sections-template .button:hover { opacity: 0.95; }
  .homepage-sections-template .feature-card { transition: transform 0.25s ease, box-shadow 0.25s ease; }
  .homepage-sections-template .feature-card:hover { transform: translateY(-6px); box-shadow: 0 18px 45px rgba(15, 23, 42, 0.08); }
</style>

<?php get_footer(); ?>