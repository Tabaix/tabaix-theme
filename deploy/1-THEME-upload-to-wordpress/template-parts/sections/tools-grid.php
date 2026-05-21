<section id="tools" class="section section-tools">
  <div class="container">
    <div class="section-header">
      <h2 class="section-title">🔧 <?php esc_html_e('Free Browser Tools', 'tabaix'); ?></h2>
      <p class="section-description"><?php esc_html_e('100+ tools. No upload. No signup. No tracking.', 'tabaix'); ?></p>
    </div>

    <div class="tool-categories" role="tablist" aria-label="<?php esc_attr_e('Tool categories', 'tabaix'); ?>">
      <button class="tool-category active" data-category="all"><?php esc_html_e('All Tools', 'tabaix'); ?></button>
      <button class="tool-category" data-category="image"><?php esc_html_e('Image', 'tabaix'); ?></button>
      <button class="tool-category" data-category="pdf"><?php esc_html_e('PDF', 'tabaix'); ?></button>
      <button class="tool-category" data-category="text"><?php esc_html_e('Text', 'tabaix'); ?></button>
      <button class="tool-category" data-category="dev"><?php esc_html_e('Developer', 'tabaix'); ?></button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
      <?php
      $tools = new WP_Query(array(
        'post_type' => 'tool',
        'posts_per_page' => 8,
        'meta_key' => 'featured',
        'meta_value' => '1',
      ));
      if ($tools->have_posts()) :
        while ($tools->have_posts()) : $tools->the_post();
          get_template_part('template-parts/content/content', 'tool');
        endwhile;
      else :
        echo '<p>' . esc_html__('No featured tools found yet.', 'tabaix') . '</p>';
      endif;
      wp_reset_postdata();
      ?>
    </div>

    <div class="section-footer">
      <a href="<?php echo esc_url(get_post_type_archive_link('tool')); ?>" class="btn btn-outline"><?php esc_html_e('Browse All Tools', 'tabaix'); ?></a>
    </div>
  </div>
</section>
