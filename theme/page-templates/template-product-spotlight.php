<?php
/*
Template Name: Product Spotlight
*/
get_header(); ?>

<main class="site-main product-spotlight-template" style="background: var(--color-bg-primary);">
  <section class="hero" style="padding: 90px 0; background: linear-gradient(135deg, var(--color-primary), var(--color-accent)); color: #fff;">
    <div class="container" style="max-width: 1080px; margin: 0 auto; display: grid; grid-template-columns: 1fr 1fr; gap: 40px; align-items: center;">
      <div>
        <p style="text-transform: uppercase; letter-spacing: 0.22em; margin-bottom: 1rem; color: rgba(255,255,255,0.85);">Product</p>
        <h1 style="font-size: 3rem; line-height: 1.05; margin-bottom: 1rem;">A bold product showcase with strong calls to action</h1>
        <p style="font-size: 1.05rem; color: rgba(255,255,255,0.85); margin-bottom: 1.75rem; max-width: 520px;">Perfect for product launches or lead-capture pages, this template gives buyers a polished visual experience.</p>
        <div style="display: flex; gap: 16px; flex-wrap: wrap;">
          <a href="#purchase" class="button" style="background: #fff; color: var(--color-primary); padding: 14px 28px; border-radius: 999px; font-weight: 700;">Buy Now</a>
          <a href="#details" class="button" style="background: rgba(255,255,255,0.15); color: #fff; padding: 14px 28px; border-radius: 999px; border: 1px solid rgba(255,255,255,0.3);">View Details</a>
        </div>
      </div>
      <div style="border-radius: var(--radius-val, 1rem); background: rgba(255,255,255,0.12); padding: 32px; backdrop-filter: blur(12px);">
        <img src="https://via.placeholder.com/640x440.png?text=Product+Display" alt="Product display" style="width: 100%; height: auto; display: block; border-radius: var(--radius-val, 1rem);" />
      </div>
    </div>
  </section>

  <section id="details" style="padding: 80px 0;">
    <div class="container" style="max-width: 1120px; margin: 0 auto; display: grid; gap: 32px; grid-template-columns: repeat(auto-fit,minmax(280px,1fr));">
      <?php for ($i = 1; $i <= 4; $i++) : ?>
        <div style="background: var(--color-bg-elevated); border: 1px solid var(--color-border-primary); border-radius: var(--radius-val, 1rem); padding: 28px;">
          <h2 style="font-size: 1.35rem; margin-bottom: 1rem; color: var(--color-text-primary);">Benefit <?php echo $i; ?></h2>
          <p style="color: var(--color-text-secondary); line-height: 1.75;">Highlight the product advantage, whether it’s speed, affordability, support, or reliability.</p>
        </div>
      <?php endfor; ?>
    </div>
  </section>

  <section style="padding: 80px 0; background: var(--color-bg-secondary);">
    <div class="container" style="max-width: 1080px; margin: 0 auto;">
      <?php while (have_posts()) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class('product-spotlight-content'); ?> style="background: var(--color-bg-elevated); border: 1px solid var(--color-border-primary); border-radius: var(--radius-val, 1rem); padding: 40px;">
          <?php the_content(); ?>
        </article>
      <?php endwhile; ?>
    </div>
  </section>
</main>

<?php get_footer(); ?>