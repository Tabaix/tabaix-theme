<section id="guides" class="section section-guides">
  <div class="container">
    <div class="section-header">
      <h2 class="section-title">🇸🇦 <?php esc_html_e('Saudi Arabia Guides', 'tabaix'); ?></h2>
      <p class="section-description"><?php esc_html_e('Insider knowledge from Arabic sources in English.', 'tabaix'); ?></p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <?php
      $guides = new WP_Query(array(
        'post_type' => 'post',
        'posts_per_page' => get_theme_mod('tabaix_guides_limit', 6),
        'category_name' => 'saudi-arabia',
      ));
      if ($guides->have_posts()) :
        while ($guides->have_posts()) : $guides->the_post();
          get_template_part('template-parts/content/content', 'guide');
        endwhile;
      else :
        echo '<p>' . esc_html__('No guides found for this category yet.', 'tabaix') . '</p>';
      endif;
      wp_reset_postdata();
      ?>
    </div>

    <div class="section-footer">
      <?php
      $saudi_category = get_category_by_slug('saudi-arabia');
      $saudi_link = $saudi_category ? get_category_link($saudi_category->term_id) : home_url('/guides');
      ?>
      <a href="<?php echo esc_url($saudi_link); ?>" class="btn btn-outline"><?php esc_html_e('All Saudi Arabia Guides', 'tabaix'); ?></a>
    </div>
  </div>
</section>
