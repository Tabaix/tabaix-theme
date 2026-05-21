<aside class="sidebar">
  <div class="widget widget-search">
    <?php get_search_form(); ?>
  </div>
  <div class="widget widget-categories">
    <h3><?php esc_html_e('Categories', 'tabaix'); ?></h3>
    <ul>
      <?php wp_list_categories(array('title_li' => '')); ?>
    </ul>
  </div>
  <div class="widget widget-recent-posts">
    <h3><?php esc_html_e('Recent Posts', 'tabaix'); ?></h3>
    <ul>
      <?php
      $recent_posts = wp_get_recent_posts(array('numberposts' => 5));
      foreach ($recent_posts as $post) :
      ?>
        <li><a href="<?php echo esc_url(get_permalink($post['ID'])); ?>"><?php echo esc_html($post['post_title']); ?></a></li>
      <?php endforeach; wp_reset_postdata(); ?>
    </ul>
  </div>
</aside>
