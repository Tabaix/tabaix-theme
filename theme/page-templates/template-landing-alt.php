<?php
/*
Template Name: Alternative Landing Page
*/
get_header(); ?>

<main class="site-main landing-alt-template" style="background: var(--color-bg-primary);">
  <section style="padding: 90px 0; text-align: center; background: var(--color-bg-secondary);">
    <div class="container" style="max-width: 960px; margin: 0 auto;">
      <p style="text-transform: uppercase; letter-spacing: 0.2em; color: var(--color-secondary); margin-bottom: 1rem;">Alternative Landing</p>
      <h1 style="font-size: 3rem; line-height: 1.05; margin-bottom: 1rem; color: var(--color-text-primary);">A fresh hero and page flow for your next campaign</h1>
      <p style="color: var(--color-text-secondary); font-size: 1.05rem; max-width: 700px; margin: 0 auto;">This landing page template is built for simplicity and fast customization inside the editor.</p>
    </div>
  </section>

  <section style="padding: 80px 0;">
    <div class="container" style="max-width: 1140px; margin: 0 auto; display: grid; gap: 30px;">
      <div style="background: var(--color-bg-elevated); border: 1px solid var(--color-border-primary); border-radius: var(--radius-val, 1rem); padding: 40px;">
        <h2 style="font-size: 2rem; color: var(--color-text-primary); margin-bottom: 1rem;">Simple, editable sections</h2>
        <p style="color: var(--color-text-secondary); line-height: 1.8;">Add content blocks, testimonials, or pricing rows quickly with the page editor. Rearrange sections to fit your brand.</p>
      </div>
      <div style="display: grid; gap: 24px; grid-template-columns: repeat(auto-fit,minmax(260px,1fr));">
        <?php for ($i = 1; $i <= 3; $i++) : ?>
          <div style="background: var(--color-primary); color:#fff; border-radius: var(--radius-val, 1rem); padding: 28px;">
            <h3 style="font-size: 1.4rem; margin-bottom: 0.8rem;">Benefit <?php echo $i; ?></h3>
            <p style="line-height: 1.75;">A short description of the feature or outcome your customers will get.</p>
          </div>
        <?php endfor; ?>
      </div>
    </div>
  </section>

  <section style="padding: 80px 0; background: var(--color-bg-secondary);">
    <div class="container" style="max-width: 1080px; margin: 0 auto;">
      <?php while (have_posts()) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class('landing-alt-content'); ?> style="background: var(--color-bg-elevated); border: 1px solid var(--color-border-primary); border-radius: var(--radius-val, 1rem); padding: 40px;">
          <?php the_content(); ?>
        </article>
      <?php endwhile; ?>
    </div>
  </section>
</main>

<?php get_footer(); ?>