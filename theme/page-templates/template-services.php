<?php
/*
Template Name: Services Landing Page
*/
get_header(); ?>

<main class="site-main services-landing-template" style="background: var(--color-bg-primary);">
  <section class="hero" style="padding: 90px 0; background: linear-gradient(135deg, var(--color-secondary), var(--color-primary)); color: #fff; text-align: center;">
    <div class="container" style="max-width: 1040px; margin: 0 auto;">
      <p style="text-transform: uppercase; letter-spacing: 0.24em; margin-bottom: 1rem; font-weight: 700; color: rgba(255,255,255,0.85);">Services</p>
      <h1 style="font-size: 3.2rem; margin-bottom: 1rem; line-height: 1.05;">A clean services page for businesses and agencies</h1>
      <p style="max-width: 700px; margin: 0 auto 1.75rem; color: rgba(255,255,255,0.9); font-size: 1.05rem;">Use the editor to replace these blocks with your service descriptions, pricing, and step-by-step process.</p>
      <a href="#services" class="button" style="background: #fff; color: var(--color-primary); padding: 14px 32px; border-radius: 999px; font-weight: 700;">Explore Services</a>
    </div>
  </section>

  <section id="services" style="padding: 80px 0;">
    <div class="container" style="max-width: 1120px; margin: 0 auto; display: grid; gap: 24px; grid-template-columns: repeat(auto-fit,minmax(280px,1fr));">
      <?php for ($i = 1; $i <= 6; $i++) : ?>
        <div class="service-card" style="background: var(--color-bg-elevated); border-radius: var(--radius-val, 1rem); border: 1px solid var(--color-border-primary); padding: 32px;">
          <h2 style="font-size: 1.4rem; margin-bottom: 1rem; color: var(--color-primary);">Service <?php echo $i; ?></h2>
          <p style="color: var(--color-text-secondary); line-height: 1.7;">Briefly describe the service, the benefit to customers, and why your company is the right choice.</p>
          <a href="#" style="display: inline-block; margin-top: 1.4rem; color: var(--color-secondary); font-weight: 700;">Learn more →</a>
        </div>
      <?php endfor; ?>
    </div>
  </section>

  <section style="padding: 80px 0; background: var(--color-bg-secondary);">
    <div class="container" style="max-width: 1040px; margin: 0 auto; text-align: center;">
      <h2 style="font-size: 2.4rem; margin-bottom: 1rem; color: var(--color-text-primary);">Fast design changes from the editor</h2>
      <p style="color: var(--color-text-secondary); font-size: 1.1rem; line-height: 1.75;">This template is ideal for service pages that need professional styling and easy editing without custom code.</p>
    </div>
  </section>

  <section style="padding: 80px 0;">
    <div class="container" style="max-width: 1080px; margin: 0 auto;">
      <?php while (have_posts()) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class('services-landing-content'); ?> style="background: var(--color-bg-elevated); border: 1px solid var(--color-border-primary); border-radius: var(--radius-val, 1rem); padding: 40px;">
          <?php the_content(); ?>
        </article>
      <?php endwhile; ?>
    </div>
  </section>
</main>

<style>
  .services-landing-template .service-card { transition: transform 0.25s ease, box-shadow 0.25s ease; }
  .services-landing-template .service-card:hover { transform: translateY(-6px); box-shadow: 0 20px 40px rgba(15, 23, 42, 0.08); }
</style>

<?php get_footer(); ?>