<?php
/*
Template Name: Blog Card Grid
*/
get_header(); ?>

<main class="site-main blog-card-grid-template" style="background: var(--color-bg-primary); padding: 80px 0;">
  <div class="container" style="max-width: 1180px; margin: 0 auto;">
    <header style="text-align: center; margin-bottom: 50px;">
      <p style="text-transform: uppercase; letter-spacing: 0.2em; color: var(--color-secondary); margin-bottom: 1rem; font-weight: 700;">Blog Cards</p>
      <h1 style="font-size: 3rem; color: var(--color-text-primary); margin-bottom: 1rem;">A polished card layout for blog content</h1>
      <p style="color: var(--color-text-secondary); font-size: 1.05rem; line-height: 1.8; max-width: 760px; margin: 0 auto;">Display posts in card format with featured images, categories, and strong calls to action.</p>
    </header>

    <?php
    $card_posts = new WP_Query(array(
      'posts_per_page' => 8,
      'post_status' => 'publish',
    ));
    if ($card_posts->have_posts()) : ?>
      <div class="card-grid" style="display:grid; gap:24px; grid-template-columns: repeat(auto-fit,minmax(280px,1fr));">
        <?php while ($card_posts->have_posts()) : $card_posts->the_post(); ?>
          <article <?php post_class('blog-card'); ?> style="background: var(--color-bg-elevated); border: 1px solid var(--color-border-primary); border-radius: var(--radius-val, 1rem); overflow: hidden; display:grid; grid-template-rows: auto 1fr;">
            <?php if (has_post_thumbnail()) : ?>
              <div style="min-height: 210px; overflow:hidden;">
                <?php the_post_thumbnail('large', array('style' => 'width:100%; height:auto; display:block;')); ?>
              </div>
            <?php endif; ?>
            <div style="padding: 26px; display:grid; gap:16px;">
              <div style="font-size:0.8rem; text-transform: uppercase; letter-spacing:0.08em; color: var(--color-secondary); font-weight:700;"><?php the_category(', '); ?></div>
              <?php the_title('<h2 style="margin:0; font-size:1.5rem; color: var(--color-text-primary);">', '</h2>'); ?>
              <p style="color: var(--color-text-secondary); line-height:1.75;"><?php echo wp_trim_words(get_the_excerpt(), 22, '...'); ?></p>
              <a href="<?php the_permalink(); ?>" style="color: var(--color-primary); font-weight:700;">Read More</a>
            </div>
          </article>
        <?php endwhile; wp_reset_postdata(); ?>
      </div>
    <?php else : ?>
      <p style="color: var(--color-text-secondary);">No posts available yet. Add content to show blog cards here.</p>
    <?php endif; ?>

    <section style="margin-top: 60px;">
      <?php while (have_posts()) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class('blog-card-grid-content'); ?> style="background: var(--color-bg-elevated); border: 1px solid var(--color-border-primary); border-radius: var(--radius-val, 1rem); padding: 40px;">
          <?php the_content(); ?>
        </article>
      <?php endwhile; ?>
    </section>
  </div>
</main>

<?php get_footer(); ?>