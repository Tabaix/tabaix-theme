<?php
/**
 * Single Post Template
 * Template Name: Post Spotlight Layout
 */
get_header(); ?>

<main class="site-main single-post-template" style="background: var(--color-bg-primary); padding: 80px 0;">
  <div class="container" style="max-width: 1040px; margin: 0 auto; display: grid; gap: 40px;">
    <?php while (have_posts()) : the_post(); ?>
      <article id="post-<?php the_ID(); ?>" <?php post_class('single-post-article'); ?> style="background: var(--color-bg-elevated); border: 1px solid var(--color-border-primary); border-radius: var(--radius-val, 1rem); overflow: hidden;">
        <div style="display: grid; grid-template-columns: 1fr 320px; gap: 0; align-items: stretch;">
          <div style="padding: 56px 48px;">
            <div class="entry-meta" style="display: flex; gap: 12px; flex-wrap: wrap; color: var(--color-secondary); font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em; margin-bottom: 22px;">
              <span><?php echo get_the_date('M j, Y'); ?></span>
              <span>·</span>
              <span><?php echo esc_html(get_the_author()); ?></span>
            </div>
            <?php the_title('<h1 style="font-size: 3rem; line-height: 1.05; margin-bottom: 1rem; color: var(--color-text-primary);">', '</h1>'); ?>
            <div style="font-size: 1rem; color: var(--color-text-secondary); line-height: 1.8; margin-bottom: 30px;"><?php echo wp_trim_words(get_the_excerpt(), 40, '...'); ?></div>
            <?php if (has_post_thumbnail()) : ?>
              <div style="border-radius: var(--radius-val, 1rem); overflow: hidden; box-shadow: 0 18px 45px rgba(15,23,42,0.08); margin-bottom: 30px;">
                <?php the_post_thumbnail('large', array('style' => 'width:100%; height:auto; display:block;')); ?>
              </div>
            <?php endif; ?>
            <div class="entry-content" style="color: var(--color-text-secondary); line-height: 1.85; font-size: 1.05rem;">
              <?php the_content(); ?>
            </div>
          </div>
          <aside style="background: var(--color-primary); color:#fff; padding: 56px 40px; display: flex; flex-direction: column; justify-content: space-between;">
            <div>
              <h2 style="font-size: 1.6rem; margin-bottom: 1rem;">Stay updated</h2>
              <p style="line-height: 1.8; color: rgba(255,255,255,0.85);">Subscribe for new articles, templates, and design resources delivered straight to your inbox.</p>
            </div>
            <a href="#" style="display: inline-block; padding: 16px 24px; border-radius: 999px; background: #fff; color: var(--color-primary); font-weight: 700; text-decoration: none; width: fit-content;">Subscribe</a>
          </aside>
        </div>
      </article>
    <?php endwhile; ?>
  </div>
</main>

<?php get_footer(); ?>