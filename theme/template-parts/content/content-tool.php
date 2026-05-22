<?php
  $tool_categories = get_the_terms(get_the_ID(), 'tool-category');
  $tool_category_slug = ($tool_categories && !is_wp_error($tool_categories)) ? $tool_categories[0]->slug : 'all';
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('tool-card'); ?> data-category="<?php echo esc_attr($tool_category_slug); ?>">
  <div class="tool-card__icon" aria-hidden="true">
    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 16v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
  </div>
  <div class="tool-card__content">
    <h2 class="tool-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    <p class="tool-card__description"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
    <div class="tool-card__meta">
      <?php if (get_post_meta(get_the_ID(), 'featured', true)) : ?><span class="tool-card__badge"><?php esc_html_e('Featured', 'tabaix'); ?></span><?php endif; ?>
      <span class="tool-card__badge"><?php esc_html_e('Free', 'tabaix'); ?></span>
    </div>
    <a href="<?php the_permalink(); ?>" class="tool-card__link"><?php esc_html_e('Use Tool', 'tabaix'); ?></a>
  </div>
</article>
