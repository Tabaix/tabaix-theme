<?php
/*
Template Name: Blog List Layout
*/
get_header(); ?>

<main class="site-main blog-list-template" style="background: var(--color-bg-primary); padding: 80px 0;">
  <div class="container" style="max-width: 1080px; margin: 0 auto; display: grid; gap: 40px;">
    <header style="text-align: center;">
      <p style="text-transform: uppercase; letter-spacing: 0.22em; color: var(--color-secondary); margin-bottom: 1rem; font-weight: 700;">Blog List</p>
      <h1 style="font-size: 3rem; color: var(--color-text-primary); margin-bottom: 1rem;">A clean list-first blog page</h1>
      <p style="color: var(--color-text-secondary); font-size: 1.05rem; line-height: 1.8; max-width: 760px; margin: 0 auto;">Perfect for editorial sites that want a simple reading experience with clear post previews and strong navigation.</p>
    </header>

    <div class="posts-list" style="display: grid; gap: 30px;">
      <?php
      $blog_list_query = new WP_Query(array(
        'posts_per_page' => 10,
        'post_status' => 'publish',
      ));
      if ($blog_list_query->have_posts()) :
        while ($blog_list_query->have_posts()) : $blog_list_query->the_post(); ?>
          <article id="post-<?php the_ID(); ?>" <?php post_class('blog-list-card'); ?> style="background: var(--color-bg-elevated); border: 1px solid var(--color-border-primary); border-radius: var(--radius-val, 1rem); padding: 36px;">
            <div style="display: grid; gap: 18px;">
              <div style="display: flex; gap: 12px; flex-wrap: wrap; color: var(--color-secondary); text-transform: uppercase; font-weight: 700; font-size: 0.8rem; letter-spacing: 0.08em;">
                <span><?php echo get_the_date('M j, Y'); ?></span>
                <span>•</span>
                <?php the_category(', '); ?>
              </div>
              <?php the_title('<h2 style="margin:0; font-size:2rem; color: var(--color-text-primary);">', '</h2>'); ?>
              <p style="color: var(--color-text-secondary); line-height: 1.8;"><?php echo wp_trim_words(get_the_excerpt(), 32, '...'); ?></p>
              <a href="<?php the_permalink(); ?>" style="color: var(--color-primary); font-weight: 700;">Read the article →</a>
            </div>
          </article>
        <?php endwhile;
        wp_reset_postdata();
      else : ?>
        <p style="color: var(--color-text-secondary);">No posts found. Add blog posts to show them here.</p>
      <?php endif; ?>
    </div>

    <section style="padding: 50px 0;">
      <?php while (have_posts()) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class('blog-list-content'); ?> style="background: var(--color-bg-elevated); border: 1px solid var(--color-border-primary); border-radius: var(--radius-val, 1rem); padding: 40px;">
          <?php the_content(); ?>
        </article>
      <?php endwhile; ?>
    </section>
  </div>
</main>

<?php get_footer(); ?>