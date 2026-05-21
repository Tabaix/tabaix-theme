<?php
/**
 * Template part for displaying a curated GCC deals and affiliate products grid.
 */
?>
<section id="deals" class="section section-deals">
  <div class="container">
    <div class="section-header text-center">
      <span class="eyebrow text-primary">💰 <?php esc_html_e('Exclusive Hot Deals & Products', 'tabaix'); ?></span>
      <h2 class="section-title"><?php esc_html_e('Top Recommendations & GCC Offers', 'tabaix'); ?></h2>
      <p class="section-description mx-auto"><?php esc_html_e('Handpicked products, high-quality gear, and verified discounts curated for Saudi Arabia and GCC shoppers.', 'tabaix'); ?></p>
    </div>

    <div class="deals-grid">
      <?php
      $deals = new WP_Query(array(
        'post_type' => 'post',
        'posts_per_page' => 3,
        'category_name' => 'deals',
      ));
      if ($deals->have_posts()) :
        while ($deals->have_posts()) : $deals->the_post();
          $discount = get_post_meta(get_the_ID(), 'deal_discount', true) ?: 'Special Offer';
          $price_old = get_post_meta(get_the_ID(), 'deal_price_old', true);
          $price_new = get_post_meta(get_the_ID(), 'deal_price_new', true);
          $rating = get_post_meta(get_the_ID(), 'deal_rating', true) ?: '4.8';
          $aff_url = get_post_meta(get_the_ID(), 'deal_affiliate_url', true) ?: get_permalink();
          ?>
          <article class="deal-card">
            <div class="deal-card__badge-wrap">
              <span class="deal-card__badge"><?php echo esc_html($discount); ?></span>
            </div>
            <div class="deal-card__image-dummy">
              <span class="deal-card__icon-box">🎁</span>
            </div>
            <div class="deal-card__content">
              <div class="deal-card__rating">
                <span class="stars">⭐⭐⭐⭐⭐</span>
                <span class="rating-val"><?php echo esc_html($rating); ?></span>
              </div>
              <h3 class="deal-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
              <p class="deal-card__excerpt"><?php echo wp_trim_words(get_the_excerpt(), 18); ?></p>
              
              <div class="deal-card__pricing-footer">
                <?php if ($price_new) : ?>
                  <div class="deal-card__price">
                    <?php if ($price_old) : ?>
                      <span class="price-old"><?php echo esc_html($price_old); ?></span>
                    <?php endif; ?>
                    <span class="price-new"><?php echo esc_html($price_new); ?></span>
                  </div>
                <?php endif; ?>
                <a href="<?php echo esc_url($aff_url); ?>" class="btn btn-secondary btn-sm deal-card__btn" target="_blank" rel="noopener noreferrer">
                  <?php esc_html_e('Get Deal', 'tabaix'); ?> →
                </a>
              </div>
            </div>
          </article>
          <?php
        endwhile;
      else :
        // Gorgeous, high-converting mockup products to display if no deals are published in WP yet.
        ?>
        <!-- Mock Product 1 -->
        <article class="deal-card">
          <div class="deal-card__badge-wrap">
            <span class="deal-card__badge badge-save">SAVE 50%</span>
          </div>
          <div class="deal-card__image-dummy gradient-purple">
            <span class="deal-card__icon-box">🤖</span>
          </div>
          <div class="deal-card__content">
            <div class="deal-card__rating">
              <span class="stars">⭐⭐⭐⭐⭐</span>
              <span class="rating-val">4.9 (124 reviews)</span>
            </div>
            <h3 class="deal-card__title"><a href="#"><?php esc_html_e('Gemini Pro AI Workspace Writer', 'tabaix'); ?></a></h3>
            <p class="deal-card__excerpt"><?php esc_html_e('Supercharge your copywriting and blog production with this advanced AI editor built specifically for SEO optimization.', 'tabaix'); ?></p>
            
            <div class="deal-card__pricing-footer">
              <div class="deal-card__price">
                <span class="price-old">$99.00</span>
                <span class="price-new">$49.50</span>
              </div>
              <a href="#" class="btn btn-secondary btn-sm deal-card__btn">
                <?php esc_html_e('Get Deal', 'tabaix'); ?> →
              </a>
            </div>
          </div>
        </article>

        <!-- Mock Product 2 -->
        <article class="deal-card">
          <div class="deal-card__badge-wrap">
            <span class="deal-card__badge badge-hot">BEST SELLER</span>
          </div>
          <div class="deal-card__image-dummy gradient-gold">
            <span class="deal-card__icon-box">✈️</span>
          </div>
          <div class="deal-card__content">
            <div class="deal-card__rating">
              <span class="stars">⭐⭐⭐⭐⭐</span>
              <span class="rating-val">4.8 (89 reviews)</span>
            </div>
            <h3 class="deal-card__title"><a href="#"><?php esc_html_e('Riyadh Luxury Stay & Heritage Tour', 'tabaix'); ?></a></h3>
            <p class="deal-card__excerpt"><?php esc_html_e('Experience ancient heritage combined with ultimate modern luxury in Riyadh. Exclusive custom package for GCC travelers.', 'tabaix'); ?></p>
            
            <div class="deal-card__pricing-footer">
              <div class="deal-card__price">
                <span class="price-old">$450.00</span>
                <span class="price-new">$299.00</span>
              </div>
              <a href="#" class="btn btn-secondary btn-sm deal-card__btn">
                <?php esc_html_e('Claim Deal', 'tabaix'); ?> →
              </a>
            </div>
          </div>
        </article>

        <!-- Mock Product 3 -->
        <article class="deal-card">
          <div class="deal-card__badge-wrap">
            <span class="deal-card__badge badge-new">60% OFF</span>
          </div>
          <div class="deal-card__image-dummy gradient-blue">
            <span class="deal-card__icon-box">🔌</span>
          </div>
          <div class="deal-card__content">
            <div class="deal-card__rating">
              <span class="stars">⭐⭐⭐⭐⭐</span>
              <span class="rating-val">5.0 (64 reviews)</span>
            </div>
            <h3 class="deal-card__title"><a href="#"><?php esc_html_e('Tabaix SEO Pro Plugin Suite', 'tabaix'); ?></a></h3>
            <p class="deal-card__excerpt"><?php esc_html_e('The ultimate WordPress suite for page speed optimization, breadcrumbs schema, and high-CTR search snippets.', 'tabaix'); ?></p>
            
            <div class="deal-card__pricing-footer">
              <div class="deal-card__price">
                <span class="price-old">$79.00</span>
                <span class="price-new">$29.00</span>
              </div>
              <a href="#" class="btn btn-secondary btn-sm deal-card__btn">
                <?php esc_html_e('Buy Now', 'tabaix'); ?> →
              </a>
            </div>
          </div>
        </article>
        <?php
      endif;
      wp_reset_postdata();
      ?>
    </div>
  </div>
</section>
