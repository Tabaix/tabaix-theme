<article id="post-<?php the_ID(); ?>" <?php post_class('card'); ?>>
  <?php if (has_post_thumbnail()) : ?>
    <div class="card-header">
      <a href="<?php the_permalink(); ?>">
        <?php the_post_thumbnail('large'); ?>
      </a>
    </div>
  <?php endif; ?>
  <div class="card-body">
    <h2 class="card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    <p><?php echo wp_trim_words(get_the_excerpt(), 24); ?></p>
    <a href="<?php the_permalink(); ?>" class="btn btn-outline"><?php esc_html_e('Read more', 'tabaix'); ?></a>
  </div>
</article>
