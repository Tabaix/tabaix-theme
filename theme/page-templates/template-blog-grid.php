<?php
/*
Template Name: Blog Grid Layout
*/
get_header(); ?>

<main class="site-main blog-grid-template" style="background: var(--color-bg-primary); padding: 60px 0;">
  <div class="container" style="max-width: 1140px; margin: 0 auto;">
    <header style="text-align: center; margin-bottom: 50px;">
      <p style="text-transform: uppercase; letter-spacing: 0.2em; color: var(--color-secondary); margin-bottom: 1rem;">Latest Articles</p>
      <h1 style="font-size: 3rem; margin: 0; color: var(--color-text-primary);">A modern news and blog layout</h1>
      <p style="color: var(--color-text-secondary); font-size: 1.05rem; margin-top: 1rem; max-width: 740px; margin-left: auto; margin-right: auto;">Use the editor or block query patterns to publish multiple post previews in a beautiful grid.</p>
    </header>

    <div class="posts-grid" style="display: grid; gap: 30px; grid-template-columns: repeat(auto-fit,minmax(280px,1fr));">
      <?php
      $recent_posts = new WP_Query(array(
        'posts_per_page' => 8,
        'post_status' => 'publish',
      ));
      if ($recent_posts->have_posts()) :
        while ($recent_posts->have_posts()) : $recent_posts->the_post(); ?>
          <article id="post-<?php the_ID(); ?>" <?php post_class('blog-card'); ?> style="background: var(--color-bg-elevated); border: 1px solid var(--color-border-primary); border-radius: var(--radius-val, 1rem); overflow: hidden; display: flex; flex-direction: column;">
            <?php if (has_post_thumbnail()) : ?>
              <div class="card-image" style="min-height: 180px; overflow: hidden;">
                <?php the_post_thumbnail('medium_large', array('style' => 'width:100%; height:auto; display:block;')); ?>
              </div>
            <?php endif; ?>
            <div style="padding: 26px; flex: 1; display: flex; flex-direction: column; gap: 16px;">
              <div style="font-size: 0.8rem; color: var(--color-secondary); text-transform: uppercase; letter-spacing: 0.08em;"><?php echo get_the_date('M j, Y'); ?></div>
              <h2 style="font-size: 1.35rem; margin: 0; color: var(--color-text-primary);"><?php the_title(); ?></h2>
              <p style="color: var(--color-text-secondary); line-height: 1.75; flex-grow: 1;"><?php echo wp_trim_words(get_the_excerpt(), 22, '...'); ?></p>
              <a href="<?php the_permalink(); ?>" style="color: var(--color-primary); font-weight: 700;">Continue Reading →</a>
            </div>
          </article>
        <?php endwhile;
        wp_reset_postdata();
      else : ?>
        <p style="color: var(--color-text-secondary);">No posts found. Add posts to show them here.</p>
      <?php endif; ?>
    </div>

    <div style="text-align: center; margin-top: 50px;">
      <a href="<?php echo get_permalink(get_option('page_for_posts')); ?>" class="button" style="display: inline-block; padding: 14px 32px; border-radius: 999px; background: var(--color-primary); color: #fff; font-weight: 700;">View All Posts</a>
    </div>

    <section style="margin-top: 80px;">
      <?php while (have_posts()) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class('blog-grid-additional'); ?> style="background: var(--color-bg-elevated); border: 1px solid var(--color-border-primary); border-radius: var(--radius-val, 1rem); padding: 40px;">
          <?php the_content(); ?>
        </article>
      <?php endwhile; ?>
    </section>
  </div>
</main>

<?php get_footer(); ?>