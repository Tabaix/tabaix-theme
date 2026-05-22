<?php
/*
Template Name: Blog Showcase Layout
*/
get_header(); ?>

<main class="site-main blog-showcase-template" style="background: var(--color-bg-primary); padding: 80px 0;">
  <div class="container" style="max-width: 1140px; margin: 0 auto;">
    <header style="text-align: center; margin-bottom: 50px;">
      <p style="text-transform: uppercase; letter-spacing: 0.22em; color: var(--color-secondary); margin-bottom: 1rem; font-weight: 700;">Blog Showcase</p>
      <h1 style="font-size: 3rem; color: var(--color-text-primary); margin-bottom: 1rem;">Showcase your best posts with editorial storytelling</h1>
      <p style="color: var(--color-text-secondary); font-size: 1.05rem; line-height: 1.8; max-width: 760px; margin: 0 auto;">This template highlights one featured post up top with stacked cards below for additional stories.</p>
    </header>

    <?php
    $featured = get_posts(array(
      'posts_per_page' => 1,
      'post_status' => 'publish',
    ));
    if (!empty($featured)) : $post = $featured[0]; setup_postdata($post); ?>
      <section class="featured-article" style="background: linear-gradient(135deg, var(--color-primary), var(--color-secondary)); color: #fff; border-radius: var(--radius-val, 1rem); padding: 48px; margin-bottom: 40px;">
        <div style="max-width: 760px;">
          <span style="display:inline-block; margin-bottom: 1rem; text-transform: uppercase; letter-spacing:0.12em; color: rgba(255,255,255,0.85); font-weight:700;">Featured Story</span>
          <?php the_title('<h2 style="font-size:3rem; margin:0 0 1rem; line-height:1.05;">', '</h2>'); ?>
          <p style="font-size:1.1rem; line-height:1.8; color: rgba(255,255,255,0.9); margin-bottom: 1.5rem;"><?php echo wp_trim_words(get_the_excerpt(), 40, '...'); ?></p>
          <a href="<?php the_permalink(); ?>" style="display:inline-block; background:#fff; color: var(--color-primary); padding: 16px 32px; border-radius: 999px; font-weight: 700;">Read the Featured Post</a>
        </div>
      </section>
      <?php wp_reset_postdata(); endif; ?>

    <section class="post-grid" style="display:grid; gap:28px; grid-template-columns: repeat(auto-fit,minmax(300px,1fr)); margin-bottom: 60px;">
      <?php
      $showcase_posts = new WP_Query(array(
        'posts_per_page' => 6,
        'post_status' => 'publish',
        'post__not_in' => array(!empty($featured) ? $featured[0]->ID : 0),
      ));
      if ($showcase_posts->have_posts()) :
        while ($showcase_posts->have_posts()) : $showcase_posts->the_post(); ?>
          <article <?php post_class('showcase-card'); ?> style="background: var(--color-bg-elevated); border: 1px solid var(--color-border-primary); border-radius: var(--radius-val, 1rem); overflow: hidden;">
            <?php if (has_post_thumbnail()) : ?>
              <div style="min-height: 220px; overflow:hidden;">
                <?php the_post_thumbnail('large', array('style' => 'width:100%; height:auto; display:block;')); ?>
              </div>
            <?php endif; ?>
            <div style="padding: 28px; display: grid; gap: 16px;">
              <span style="font-size: 0.8rem; text-transform: uppercase; letter-spacing:0.1em; color: var(--color-secondary); font-weight:700;"><?php echo esc_html(get_the_date('M j, Y')); ?></span>
              <?php the_title('<h3 style="margin:0; color: var(--color-text-primary);">', '</h3>'); ?>
              <p style="color: var(--color-text-secondary); line-height:1.75;"><?php echo wp_trim_words(get_the_excerpt(), 24, '...'); ?></p>
              <a href="<?php the_permalink(); ?>" style="color: var(--color-primary); font-weight:700;">Continue Reading</a>
            </div>
          </article>
        <?php endwhile; wp_reset_postdata(); endif; ?>
    </section>

    <section>
      <?php while (have_posts()) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class('blog-showcase-content'); ?> style="background: var(--color-bg-elevated); border: 1px solid var(--color-border-primary); border-radius: var(--radius-val, 1rem); padding: 40px;">
          <?php the_content(); ?>
        </article>
      <?php endwhile; ?>
    </section>
  </div>
</main>

<?php get_footer(); ?>