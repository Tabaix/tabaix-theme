<?php get_header(); ?>
<main class="site-main tool-page-template">
  <div class="container">
    <?php while (have_posts()) : the_post(); ?>
      <article id="post-<?php the_ID(); ?>" <?php post_class('tool-page'); ?>>
        <header class="tool-header">
          <div class="tool-header__badge">
            <?php
              $categories = get_the_terms(get_the_ID(), 'tool-category');
              if ($categories && !is_wp_error($categories)) {
                echo esc_html($categories[0]->name);
              }
            ?>
          </div>
          <h1 class="tool-header__title"><?php the_title(); ?></h1>
          <p class="tool-header__description"><?php echo get_the_excerpt(); ?></p>
          <div class="tool-header__meta">
            <span><?php esc_html_e('✓ No Upload Required', 'tabaix'); ?></span>
            <span><?php esc_html_e('✓ Works Offline', 'tabaix'); ?></span>
            <span><?php esc_html_e('✓ 100% Free', 'tabaix'); ?></span>
          </div>
        </header>

        <?php $tool_slug = get_post_field('post_name'); ?>
        <div class="tool-interface" data-tool-slug="<?php echo esc_attr($tool_slug); ?>">
          <?php
            $tool_path = get_template_directory() . '/tools/' . $tool_slug . '/index.php';
            if (file_exists($tool_path)) {
              include $tool_path;
            } else {
              echo '<p>' . esc_html__('Tool interface not found.', 'tabaix') . '</p>';
            }
          ?>
        </div>

        <div class="tool-content">
          <?php the_content(); ?>
        </div>

        <aside class="tool-related">
          <h2><?php esc_html_e('Related Tools', 'tabaix'); ?></h2>
          <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <?php
              if ($categories && !is_wp_error($categories)) {
                $related = new WP_Query(array(
                  'post_type' => 'tool',
                  'posts_per_page' => 3,
                  'post__not_in' => array(get_the_ID()),
                  'tax_query' => array(array(
                    'taxonomy' => 'tool-category',
                    'field' => 'term_id',
                    'terms' => $categories[0]->term_id,
                  )),
                ));
                if ($related->have_posts()) {
                  while ($related->have_posts()) {
                    $related->the_post();
                    get_template_part('template-parts/content/content', 'tool');
                  }
                }
                wp_reset_postdata();
              }
            ?>
          </div>
        </aside>
      </article>
    <?php endwhile; ?>
  </div>
</main>
<?php get_footer(); ?>
