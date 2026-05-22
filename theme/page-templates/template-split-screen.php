<?php
/*
Template Name: Split Screen Layout
*/
get_header(); ?>

<main class="site-main split-screen-template" style="background: var(--color-bg-primary);">
  <section style="display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); min-height: 100vh;">
    <div style="padding: 80px 60px; display: flex; flex-direction: column; justify-content: center; background: var(--color-primary); color: #fff;">
      <p style="text-transform: uppercase; letter-spacing: 0.22em; margin-bottom: 1.25rem; font-weight: 700;">Split Screen</p>
      <h1 style="font-size: 3.4rem; margin-bottom: 1.5rem; line-height: 1.05;">A dramatic layout for storytelling and conversions</h1>
      <p style="font-size: 1.1rem; line-height: 1.8; color: rgba(255,255,255,0.9); max-width: 520px;">Use this template on launch pages, product presentations, or high-impact lead generation pages.</p>
      <div style="margin-top: 2rem;"><a href="#" style="padding: 16px 28px; border-radius: 999px; background: #fff; color: var(--color-primary); font-weight: 700; display: inline-block;">Get Started</a></div>
    </div>
    <div style="padding: 80px 60px; background: var(--color-bg-secondary); display: flex; align-items: center; justify-content: center;">
      <div style="max-width: 520px;">
        <h2 style="font-size: 2rem; color: var(--color-text-primary); margin-bottom: 1rem;">A balanced editorial layout</h2>
        <p style="color: var(--color-text-secondary); line-height: 1.8; margin-bottom: 2rem;">The split-screen layout gives you a premium feel while keeping the page easy to edit with block content.</p>
        <div style="background: var(--color-bg-elevated); border: 1px solid var(--color-border-primary); border-radius: var(--radius-val, 1rem); padding: 30px;">
          <?php while (have_posts()) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('split-screen-content'); ?>>
              <?php the_content(); ?>
            </article>
          <?php endwhile; ?>
        </div>
      </div>
    </div>
  </section>
</main>

<?php get_footer(); ?>