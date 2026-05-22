<?php
/*
Template Name: Blog Masonry Layout
*/
get_header(); ?>

<main class="site-main blog-masonry-template" style="background: var(--color-bg-primary); padding: 80px 0;">
  <div class="container" style="max-width: 1180px; margin: 0 auto;">
    <header style="text-align: center; margin-bottom: 50px;">
      <p style="text-transform: uppercase; letter-spacing: 0.2em; color: var(--color-secondary); margin-bottom: 1rem; font-weight: 700;">Masonry Blog</p>
      <h1 style="font-size: 3rem; color: var(--color-text-primary); margin-bottom: 1rem;">A modern masonry layout for your latest posts</h1>
      <p style="color: var(--color-text-secondary); font-size: 1.05rem; line-height: 1.8; max-width: 760px; margin: 0 auto;">Use this template for a visual, Pinterest-style blog archive with flexible cards and featured imagery.</p>
    </header>

    <?php
    $masonry_posts = new WP_Query(array(
      'posts_per_page' => 12,
      'post_status' => 'publish',
    ));
    if ($masonry_posts->have_posts()) : ?>
      <div class="masonry-grid" style="display: grid; gap: 24px; grid-template-columns: repeat(auto-fit,minmax(280px,1fr));">
        <?php while ($masonry_posts->have_posts()) : $masonry_posts->the_post(); ?>
          <article id="post-<?php the_ID(); ?>" <?php post_class('masonry-card'); ?> style="background: var(--color-bg-elevated); border: 1px solid var(--color-border-primary); border-radius: var(--radius-val, 1rem); overflow: hidden; display: flex; flex-direction: column;">
            <?php if (has_post_thumbnail()) : ?>
              <div style="overflow:hidden; min-height: 220px;">
                <?php the_post_thumbnail('large', array('style' => 'width:100%; height:auto; display:block;')); ?>
              </div>
            <?php endif; ?>
            <div style="padding: 28px; display: grid; gap: 18px;">
              <span style="font-size:0.8rem; text-transform: uppercase; letter-spacing:0.1em; color: var(--color-secondary); font-weight:700;"><?php echo esc_html(get_the_date('M j, Y')); ?></span>
              <?php the_title('<h2 style="font-size:1.65rem; margin:0; color: var(--color-text-primary);">', '</h2>'); ?>
              <p style="color: var(--color-text-secondary); line-height:1.8;"><?php echo wp_trim_words(get_the_excerpt(), 24, '...'); ?></p>
              <a href="<?php the_permalink(); ?>" style="color: var(--color-primary); font-weight: 700;">Read Story</a>
            </div>
          </article>
        <?php endwhile; wp_reset_postdata(); ?>
      </div>
    <?php else : ?>
      <p style="color: var(--color-text-secondary);">No posts found. Add blog content to display here.</p>
    <?php endif; ?>

    <section style="margin-top: 60px;">
      <?php while (have_posts()) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class('blog-masonry-content'); ?> style="background: var(--color-bg-elevated); border: 1px solid var(--color-border-primary); border-radius: var(--radius-val, 1rem); padding: 40px;">
          <?php the_content(); ?>
        </article>
      <?php endwhile; ?>
    </section>
  </div>
</main>

<?php get_footer(); ?>