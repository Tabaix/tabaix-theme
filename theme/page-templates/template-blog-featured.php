<?php
/*
Template Name: Featured Blog Showcase
*/
get_header(); ?>

<main class="site-main featured-blog-template" style="background: var(--color-bg-primary); padding: 80px 0;">
  <div class="container" style="max-width: 1120px; margin: 0 auto; display: grid; gap: 40px;">
    <header style="text-align: center;">
      <p style="text-transform: uppercase; letter-spacing: 0.22em; color: var(--color-secondary); margin-bottom: 1rem; font-weight: 700;">Featured Blog</p>
      <h1 style="font-size: 3rem; color: var(--color-text-primary); margin-bottom: 1rem;">A rich editorial homepage for your best posts</h1>
      <p style="color: var(--color-text-secondary); font-size: 1.05rem; line-height: 1.8; max-width: 760px; margin: 0 auto;">Spotlight your top story, then invite readers deeper with a strong featured section and curated article cards.</p>
    </header>

    <?php
    $featured_post = get_posts(array(
      'posts_per_page' => 1,
      'post_status' => 'publish',
    ));
    if (!empty($featured_post)) : $post = $featured_post[0]; setup_postdata($post); ?>
      <section class="featured-story" style="background: linear-gradient(135deg, var(--color-primary), var(--color-secondary)); color: #fff; border-radius: var(--radius-val, 1rem); padding: 50px;">
        <div style="display: grid; gap: 24px;">
          <div style="max-width: 760px;">
            <div style="text-transform: uppercase; letter-spacing: 0.24em; margin-bottom: 1rem; color: rgba(255,255,255,0.85); font-weight: 700;">Featured Article</div>
            <?php the_title('<h2 style="font-size:3.25rem; margin:0; line-height:1.05;">', '</h2>'); ?>
            <p style="font-size:1.1rem; line-height:1.8; margin-top:1.5rem; color: rgba(255,255,255,0.9);"><?php echo wp_trim_words(get_the_excerpt(), 40, '...'); ?></p>
          </div>
          <a href="<?php the_permalink(); ?>" style="display:inline-block; width:max-content; background:#fff; color: var(--color-primary); padding: 16px 32px; border-radius:999px; font-weight:700;">Read the featured story</a>
        </div>
      </section>
      <?php wp_reset_postdata(); endif; ?>

    <section class="featured-grid" style="display:grid; gap:30px; grid-template-columns: repeat(auto-fit,minmax(280px,1fr));">
      <?php
      $blog_cards = new WP_Query(array(
        'posts_per_page' => 6,
        'post_status' => 'publish',
        'post__not_in' => array(!empty($featured_post) ? $featured_post[0]->ID : 0),
      ));
      if ($blog_cards->have_posts()) :
        while ($blog_cards->have_posts()) : $blog_cards->the_post(); ?>
          <article <?php post_class('featured-blog-card'); ?> style="background: var(--color-bg-elevated); border: 1px solid var(--color-border-primary); border-radius: var(--radius-val, 1rem); overflow: hidden; display: flex; flex-direction: column;">
            <?php if (has_post_thumbnail()) : ?>
              <div style="min-height: 210px; overflow:hidden;">
                <?php the_post_thumbnail('large', array('style' => 'width:100%; height:auto; display:block;')); ?>
              </div>
            <?php endif; ?>
            <div style="padding: 28px; display: grid; gap: 18px;">
              <div style="font-size:0.85rem; color: var(--color-secondary); text-transform: uppercase; letter-spacing: 0.08em; font-weight:700;"><?php echo get_the_date('M j, Y'); ?></div>
              <?php the_title('<h3 style="margin:0; color: var(--color-text-primary);">', '</h3>'); ?>
              <p style="color: var(--color-text-secondary); line-height: 1.7;"><?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?></p>
              <a href="<?php the_permalink(); ?>" style="color: var(--color-primary); font-weight: 700;">Continue reading</a>
            </div>
          </article>
        <?php endwhile;
        wp_reset_postdata();
      endif; ?>
    </section>

    <section style="padding: 60px 0;">
      <?php while (have_posts()) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class('featured-blog-content'); ?> style="background: var(--color-bg-elevated); border: 1px solid var(--color-border-primary); border-radius: var(--radius-val, 1rem); padding: 40px;">
          <?php the_content(); ?>
        </article>
      <?php endwhile; ?>
    </section>
  </div>
</main>

<?php get_footer(); ?>