<?php
/**
 * Template Name: Affiliate Deals Hub
 * Description: A gorgeous grid layout to showcase all your affiliate products, "Amazon Finds", and tech gear.
 */

get_header(); ?>

<main class="site-main affiliate-hub-page">
  <div class="container">
    <header class="page-header" style="text-align: center; margin: 60px 0;">
      <h1 class="page-title"><?php the_title(); ?></h1>
      <?php if (has_excerpt()) : ?>
        <p class="page-subtitle" style="color: var(--color-text-secondary); max-width: 600px; margin: 0 auto; font-size: 1.1rem;"><?php echo get_the_excerpt(); ?></p>
      <?php else : ?>
        <p class="page-subtitle" style="color: var(--color-text-secondary); max-width: 600px; margin: 0 auto; font-size: 1.1rem;"><?php esc_html_e('My curated list of the best tech, tools, and gear. I only recommend products I use and love.', 'tabaix'); ?></p>
      <?php endif; ?>
    </header>

    <div class="deals-grid" style="display: grid; gap: 30px; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); margin-bottom: 60px;">
      <?php
      // Query all posts in the 'deals' category
      $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
      $deals = new WP_Query(array(
        'post_type' => 'post',
        'category_name' => 'deals',
        'posts_per_page' => get_theme_mod('tabaix_deals_limit', 12),
        'paged' => $paged
      ));

      if ($deals->have_posts()) :
        while ($deals->have_posts()) : $deals->the_post();
          $discount = get_post_meta(get_the_ID(), 'deal_discount', true) ?: 'HOT DEAL';
          $price_old = get_post_meta(get_the_ID(), 'deal_price_old', true);
          $price_new = get_post_meta(get_the_ID(), 'deal_price_new', true);
          $rating = get_post_meta(get_the_ID(), 'deal_rating', true) ?: '5.0';
          $aff_url = get_post_meta(get_the_ID(), 'deal_affiliate_url', true) ?: get_permalink();
          ?>
          <article class="deal-card" style="display: flex; flex-direction: column; background: var(--color-bg-elevated); border: 1px solid var(--color-border-primary); border-radius: var(--radius-val, 1rem); overflow: hidden; transition: transform 0.2s, box-shadow 0.2s;">
            <div class="deal-card__badge-wrap" style="position: absolute; top: 15px; right: 15px; z-index: 10;">
              <span class="deal-card__badge badge-hot" style="background: linear-gradient(135deg, #f59e0b, #ea580c); color: white; padding: 4px 10px; border-radius: 20px; font-size: 0.75rem; font-weight: bold; box-shadow: 0 4px 10px rgba(245, 158, 11, 0.3);"><?php echo esc_html($discount); ?></span>
            </div>
            
            <?php if (has_post_thumbnail()) : ?>
              <div class="deal-card__image" style="height: 200px; overflow: hidden;">
                <?php the_post_thumbnail('medium_large', array('style' => 'width:100%; height:100%; object-fit:cover;')); ?>
              </div>
            <?php else : ?>
              <div class="deal-card__image-dummy gradient-blue" style="height: 200px; background: linear-gradient(135deg, #dbeafe, #bfdbfe); display: flex; align-items: center; justify-content: center; font-size: 4rem;">
                📦
              </div>
            <?php endif; ?>

            <div class="deal-card__content" style="padding: 24px; display: flex; flex-direction: column; flex-grow: 1;">
              <div class="deal-card__rating" style="font-size: 0.85rem; margin-bottom: 10px;">
                <span class="stars" style="color: #fbbf24; letter-spacing: 2px;">⭐⭐⭐⭐⭐</span>
                <span class="rating-val" style="color: var(--color-text-tertiary); font-weight: 500;"><?php echo esc_html($rating); ?></span>
              </div>
              <h3 class="deal-card__title" style="margin: 0 0 10px 0; font-size: 1.25rem;"><a href="<?php the_permalink(); ?>" style="color: var(--color-text-primary); text-decoration: none;"><?php the_title(); ?></a></h3>
              <p class="deal-card__excerpt" style="color: var(--color-text-secondary); font-size: 0.9rem; flex-grow: 1;"><?php echo wp_trim_words(get_the_excerpt(), 15); ?></p>
              
              <div class="deal-card__pricing-footer" style="display: flex; justify-content: space-between; align-items: center; margin-top: 20px; padding-top: 15px; border-top: 1px solid var(--color-border-primary);">
                <div class="deal-card__price" style="display: flex; flex-direction: column;">
                  <?php if ($price_old) : ?>
                    <span class="price-old" style="font-size: 0.75rem; color: var(--color-text-tertiary); text-decoration: line-through;"><?php echo esc_html($price_old); ?></span>
                  <?php endif; ?>
                  <span class="price-new" style="font-size: 1.5rem; font-weight: 800; color: var(--color-text-primary); line-height: 1;"><?php echo esc_html($price_new); ?></span>
                </div>
                <a href="<?php echo esc_url($aff_url); ?>" class="btn btn-secondary btn-sm" target="_blank" rel="nofollow sponsored" style="background: var(--color-primary); color: white; padding: 8px 16px; border-radius: 8px; font-weight: bold; text-decoration: none;">View Deal →</a>
              </div>
            </div>
          </article>
          <?php
        endwhile;
      else :
        echo '<p style="text-align:center; grid-column: 1 / -1;">' . esc_html__('No affiliate deals found. Create posts in the "deals" category to populate this page.', 'tabaix') . '</p>';
      endif;
      ?>
    </div>

    <!-- Pagination -->
    <div class="pagination" style="display: flex; justify-content: center; gap: 10px; margin-bottom: 60px;">
      <?php 
      echo paginate_links(array(
        'total' => $deals->max_num_pages,
        'prev_text' => __('« Previous', 'tabaix'),
        'next_text' => __('Next »', 'tabaix'),
      )); 
      wp_reset_postdata();
      ?>
    </div>

  </div>
</main>

<?php get_footer(); ?>
