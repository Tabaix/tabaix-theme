<?php
/*
Template Name: Magazine Style Blog
*/
get_header(); ?>

<main class="site-main magazine-alt-template" style="background: var(--color-bg-primary); padding: 80px 0;">
  <div class="container" style="max-width: 1160px; margin: 0 auto; display: grid; gap: 40px;">
    <header style="text-align: center;">
      <p style="text-transform: uppercase; letter-spacing: 0.22em; color: var(--color-secondary); margin-bottom: 1rem; font-weight: 700;">Magazine Style</p>
      <h1 style="font-size: 3rem; color: var(--color-text-primary); margin-bottom: 1rem;">A visual magazine layout for your blog</h1>
      <p style="color: var(--color-text-secondary); font-size: 1.05rem; line-height: 1.8; max-width: 760px; margin: 0 auto;">Showcase multiple posts in a bold editorial style with a featured top story and supporting cards.</p>
    </header>

    <section style="display: grid; gap: 24px; grid-template-columns: 2fr 1fr; align-items: start;">
      <?php
      $magazine_posts = new WP_Query(array(
        'posts_per_page' => 7,
        'post_status' => 'publish',
      ));
      if ($magazine_posts->have_posts()) :
        $magazine_posts->the_post(); ?>
        <article style="background: var(--color-bg-elevated); border: 1px solid var(--color-border-primary); border-radius: var(--radius-val, 1rem); overflow: hidden;">
          <?php if (has_post_thumbnail()) : ?>
            <div style="min-height: 380px; overflow:hidden;">
              <?php the_post_thumbnail('large', array('style' => 'width:100%; height:auto; display:block;')); ?>
            </div>
          <?php endif; ?>
          <div style="padding: 40px;">
            <span style="display:inline-block; margin-bottom: 1rem; color: var(--color-secondary); text-transform: uppercase; letter-spacing: 0.08em; font-weight:700;">Featured Story</span>
            <?php the_title('<h2 style="font-size:2.8rem; color: var(--color-text-primary); margin:0;">', '</h2>'); ?>
            <p style="color: var(--color-text-secondary); line-height:1.8; margin-top:1.5rem;"><?php echo wp_trim_words(get_the_excerpt(), 35, '...'); ?></p>
            <a href="<?php the_permalink(); ?>" style="color: var(--color-primary); font-weight: 700;">Read More →</a>
          </div>
        </article>
        <?php
        $count = 0;
        while ($magazine_posts->have_posts()) : $magazine_posts->the_post(); $count++; ?>
          <?php if ($count === 1) : ?>
            <div style="display:grid; gap:24px;">
          <?php endif; ?>
            <article style="background: var(--color-bg-elevated); border: 1px solid var(--color-border-primary); border-radius: var(--radius-val, 1rem); padding: 28px;">
              <div style="display:flex; gap:16px; align-items:flex-start;">
                <?php if (has_post_thumbnail()) : ?>
                  <div style="flex-shrink:0; width:114px; overflow:hidden; border-radius: var(--radius-val, 1rem);">
                    <?php the_post_thumbnail('medium', array('style' => 'width:100%; height:auto; display:block;')); ?>
                  </div>
                <?php endif; ?>
                <div>
                  <span style="display:inline-block; margin-bottom:0.75rem; color: var(--color-secondary); text-transform: uppercase; letter-spacing:0.08em; font-weight:700; font-size:0.8rem;"><?php echo get_the_date('M j, Y'); ?></span>
                  <?php the_title('<h3 style="margin:0; color: var(--color-text-primary);">', '</h3>'); ?>
                  <p style="color: var(--color-text-secondary); line-height:1.7; margin:0.85rem 0 0;"><?php echo wp_trim_words(get_the_excerpt(), 22, '...'); ?></p>
                </div>
              </div>
            </article>
          <?php if ($count === 4) : ?></div><?php endif; ?>
        <?php endwhile;
        if ($count < 4) : ?></div><?php endif;
        wp_reset_postdata();
      endif; ?>
    </section>

    <section style="padding: 50px 0;">
      <?php while (have_posts()) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class('magazine-alt-content'); ?> style="background: var(--color-bg-elevated); border: 1px solid var(--color-border-primary); border-radius: var(--radius-val, 1rem); padding: 40px;">
          <?php the_content(); ?>
        </article>
      <?php endwhile; ?>
    </section>
  </div>
</main>

<?php get_footer(); ?>