<?php
/*
Template Name: Portfolio Showcase
*/
get_header(); ?>

<main class="site-main portfolio-showcase-template" style="background: var(--color-bg-primary);">
  <section class="hero" style="padding: 90px 0; text-align: center;">
    <div class="container" style="max-width: 1020px; margin: 0 auto;">
      <p style="text-transform: uppercase; letter-spacing: 0.22em; color: var(--color-secondary); font-weight: 700; margin-bottom: 1rem;">Portfolio</p>
      <h1 style="font-size: 3rem; line-height: 1.05; color: var(--color-text-primary); margin-bottom: 1rem;">Showcase your best work with bold project cards</h1>
      <p style="font-size: 1.05rem; color: var(--color-text-secondary); max-width: 720px; margin: 0 auto;">This template is perfect for agencies, freelancers, or product teams that want a strong visual case study page.</p>
    </div>
  </section>

  <section style="padding: 80px 0;">
    <div class="container" style="max-width: 1200px; margin: 0 auto; display: grid; gap: 24px; grid-template-columns: repeat(auto-fit,minmax(280px,1fr));">
      <?php for ($i = 1; $i <= 6; $i++) : ?>
        <article class="portfolio-card" style="background: var(--color-bg-elevated); border: 1px solid var(--color-border-primary); border-radius: var(--radius-val, 1rem); overflow: hidden;">
          <div style="height: 220px; background: linear-gradient(180deg, rgba(15,23,42,0.1), rgba(15,23,42,0.05)); display: flex; align-items: center; justify-content: center; font-size: 1rem; color: var(--color-text-secondary);">Project Image <?php echo $i; ?></div>
          <div style="padding: 26px;">
            <span style="display: inline-block; margin-bottom: 0.75rem; font-size: 0.8rem; font-weight: 700; color: var(--color-secondary); text-transform: uppercase; letter-spacing: 0.08em;">Case Study</span>
            <h2 style="font-size: 1.4rem; margin-bottom: 0.8rem; color: var(--color-text-primary);">Project Title <?php echo $i; ?></h2>
            <p style="color: var(--color-text-secondary); line-height: 1.75;">Describe the project outcome and impact in a short paragraph that is easy to update inside the editor.</p>
            <a href="#" style="display: inline-block; margin-top: 1rem; color: var(--color-primary); font-weight: 700;">View Project</a>
          </div>
        </article>
      <?php endfor; ?>
    </div>
  </section>

  <section style="padding: 80px 0; background: var(--color-bg-secondary);">
    <div class="container" style="max-width: 1080px; margin: 0 auto;">
      <?php while (have_posts()) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class('portfolio-showcase-content'); ?> style="background: var(--color-bg-elevated); border: 1px solid var(--color-border-primary); border-radius: var(--radius-val, 1rem); padding: 40px;">
          <?php the_content(); ?>
        </article>
      <?php endwhile; ?>
    </div>
  </section>
</main>

<?php get_footer(); ?>