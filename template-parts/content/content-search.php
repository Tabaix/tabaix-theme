<article id="post-<?php the_ID(); ?>" <?php post_class('search-card'); ?>>
  <header class="search-card-header">
    <h2 class="search-card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
  </header>
  <div class="search-card-excerpt">
    <?php echo wp_trim_words(get_the_excerpt(), 30); ?>
  </div>
</article>
