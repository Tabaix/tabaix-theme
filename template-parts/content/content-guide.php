<article id="post-<?php the_ID(); ?>" <?php post_class('guide-card'); ?>>
  <div class="guide-card__image">
    <?php if (has_post_thumbnail()) : ?>
      <?php the_post_thumbnail('large'); ?>
    <?php else : ?>
      <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/placeholders/guide-thumb.svg'); ?>" alt="<?php the_title_attribute(); ?>">
    <?php endif; ?>
    <span class="guide-card__category"><?php esc_html_e('Saudi Arabia', 'tabaix'); ?></span>
  </div>
  <div class="guide-card__content">
    <h2 class="guide-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    <p class="guide-card__excerpt"><?php echo wp_trim_words(get_the_excerpt(), 24); ?></p>
    <div class="guide-card__meta">
      <time datetime="<?php echo esc_attr(get_the_date('c')); ?>"><?php echo esc_html(get_the_date()); ?></time>
      <span><?php echo esc_html(sprintf(__('%s min read', 'tabaix'), max(1, round(str_word_count(strip_tags(get_the_content())) / 200)))); ?></span>
    </div>
  </div>
</article>
