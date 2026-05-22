    <footer class="site-footer" style="background: var(--color-bg-elevated); border-top: 1px solid var(--color-border-primary); padding: 80px 0 40px; margin-top: 60px;">
      <div class="container">
        
        <!-- Newsletter Section -->
        <div class="footer-newsletter" style="background: linear-gradient(135deg, var(--color-primary), #a855f7); border-radius: var(--radius-val, 1rem); padding: 40px; text-align: center; margin-bottom: 60px; color: white; box-shadow: 0 10px 30px rgba(37, 99, 235, 0.2);">
          <h3 style="font-size: 2rem; margin-top: 0; color: white;"><?php esc_html_e('Never miss a top deal again.', 'tabaix'); ?></h3>
          <p style="margin-bottom: 25px; font-size: 1.1rem; opacity: 0.9;"><?php esc_html_e('Join 24,000+ marketers and tech enthusiasts getting the best affiliate offers weekly.', 'tabaix'); ?></p>
          <form class="newsletter-form" style="display: flex; gap: 10px; max-width: 500px; margin: 0 auto;" onsubmit="event.preventDefault(); alert('Newsletter connected successfully!');">
            <input type="email" placeholder="<?php esc_attr_e('Enter your email address', 'tabaix'); ?>" required style="flex-grow: 1; padding: 15px 20px; border: none; border-radius: 8px; font-size: 1rem; outline: none;">
            <button type="submit" class="btn" style="background: #111827; color: white; border: none; padding: 15px 30px; border-radius: 8px; font-weight: bold; cursor: pointer; transition: background 0.2s;"><?php esc_html_e('Subscribe', 'tabaix'); ?></button>
          </form>
        </div>

        <?php
        $columns = get_theme_mod('tabaix_footer_columns', '4');
        $columns_style = 'repeat(auto-fit, minmax(200px, 1fr))';
        if ($columns === '1') $columns_style = '1fr';
        if ($columns === '2') $columns_style = 'repeat(2, minmax(200px, 1fr))';
        if ($columns === '3') $columns_style = 'repeat(3, minmax(200px, 1fr))';
        if ($columns === '4') $columns_style = 'repeat(4, minmax(200px, 1fr))';
        ?>
        <div class="footer-grid" style="display: grid; grid-template-columns: <?php echo esc_attr($columns_style); ?>; gap: 40px; margin-bottom: 40px;">
          
          <!-- Brand Column -->
          <?php if ($columns > 1): ?>
          <div class="footer-brand" style="grid-column: span <?php echo ($columns > 2) ? 2 : 1; ?>;">
            <a href="<?php echo esc_url(home_url('/')); ?>" style="font-size: 1.75rem; font-weight: 800; color: var(--color-text-primary); text-decoration: none; letter-spacing: -1px;">TABAIX<span style="color: var(--color-primary);">.</span></a>
            <p style="color: var(--color-text-secondary); margin-top: 15px; font-size: 0.95rem; line-height: 1.6; max-width: 300px;">
              <?php esc_html_e('The ultimate affiliate marketing hub. We curate the best products, build free SEO tools, and write in-depth guides to help you scale your business.', 'tabaix'); ?>
            </p>
            <?php if (get_theme_mod('tabaix_footer_show_social', true)): ?>
              <div class="social-links" style="display: flex; gap: 15px; margin-top: 20px;">
                <?php
                $twitter = get_theme_mod('tabaix_social_twitter', '#');
                $instagram = get_theme_mod('tabaix_social_instagram', '#');
                $facebook = get_theme_mod('tabaix_social_facebook', '#');
                $linkedin = get_theme_mod('tabaix_social_linkedin', '#');
                
                if ($twitter && $twitter !== '#') : ?>
                  <a href="<?php echo esc_url($twitter); ?>" style="color: var(--color-text-secondary);" target="_blank" rel="noopener"><svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg></a>
                <?php endif;
                if ($instagram && $instagram !== '#') : ?>
                  <a href="<?php echo esc_url($instagram); ?>" style="color: var(--color-text-secondary);" target="_blank" rel="noopener"><svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204 0.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg></a>
                <?php endif;
                if ($facebook && $facebook !== '#') : ?>
                  <a href="<?php echo esc_url($facebook); ?>" style="color: var(--color-text-secondary);" target="_blank" rel="noopener"><svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M9 8H7v3h2v9h4v-9h3.6l.4-3H13V6c0-.5.5-1 1-1h2V1h-3C10.5 1 9 2.5 9 5v3z"/></svg></a>
                <?php endif;
                if ($linkedin && $linkedin !== '#') : ?>
                  <a href="<?php echo esc_url($linkedin); ?>" style="color: var(--color-text-secondary);" target="_blank" rel="noopener"><svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M4.98 3.5c0 1.381-1.11 2.5-2.48 2.5s-2.48-1.119-2.48-2.5c0-1.38 1.11-2.5 2.48-2.5s2.48 1.12 2.48 2.5zm.02 4.5h-5v16h5v-16zm7.982 0h-4.968v16h4.969v-8.399c0-4.67 6.029-5.052 6.029 0v8.399h4.988v-10.131c0-7.88-8.922-7.593-11.018-3.714v-2.155z"/></svg></a>
                <?php endif; ?>
              </div>
            <?php endif; ?>
          </div>
          <?php endif; ?>

          <!-- Quick Links -->
          <?php if ($columns >= 3): ?>
          <div class="footer-links">
            <h4 style="margin: 0 0 20px 0; font-size: 1.1rem; color: var(--color-text-primary);"><?php esc_html_e('Platform', 'tabaix'); ?></h4>
            <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 10px;">
              <li><a href="<?php echo esc_url(home_url('/')); ?>" style="color: var(--color-text-secondary); text-decoration: none;"><?php esc_html_e('Home', 'tabaix'); ?></a></li>
              <li><a href="<?php echo esc_url(get_post_type_archive_link('tool')); ?>" style="color: var(--color-text-secondary); text-decoration: none;"><?php esc_html_e('Free Tools', 'tabaix'); ?></a></li>
              <li><a href="#" style="color: var(--color-text-secondary); text-decoration: none;"><?php esc_html_e('Affiliate Hub', 'tabaix'); ?></a></li>
              <li><a href="#" style="color: var(--color-text-secondary); text-decoration: none;"><?php esc_html_e('Blog & Guides', 'tabaix'); ?></a></li>
            </ul>
          </div>
          <?php endif; ?>

          <!-- Legal -->
          <?php if ($columns >= 2): ?>
          <div class="footer-links">
            <h4 style="margin: 0 0 20px 0; font-size: 1.1rem; color: var(--color-text-primary);"><?php esc_html_e('Legal', 'tabaix'); ?></h4>
            <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 10px;">
              <li><a href="#" style="color: var(--color-text-secondary); text-decoration: none;"><?php esc_html_e('Privacy Policy', 'tabaix'); ?></a></li>
              <li><a href="#" style="color: var(--color-text-secondary); text-decoration: none;"><?php esc_html_e('Terms of Service', 'tabaix'); ?></a></li>
              <li><a href="#" style="color: var(--color-text-secondary); text-decoration: none;"><?php esc_html_e('Earnings Disclaimer', 'tabaix'); ?></a></li>
            </ul>
          </div>
          <?php endif; ?>

        </div>

        <!-- Affiliate Disclaimer -->
        <div class="footer-disclaimer" style="padding-top: 30px; border-top: 1px solid var(--color-border-secondary); font-size: 0.85rem; color: var(--color-text-tertiary); text-align: center; line-height: 1.6;">
          <?php
          $disclaimer = get_theme_mod('tabaix_footer_disclaimer', __('TABAIX is a participant in the Amazon Services LLC Associates Program and other affiliate programs. This means that if you click on a link and make a purchase, we may earn a commission at no additional cost to you. We only recommend products and services we trust.', 'tabaix'));
          if (!empty($disclaimer)):
          ?>
          <p style="margin: 0;">
            <strong><?php esc_html_e('Affiliate Disclosure:', 'tabaix'); ?></strong> 
            <?php echo esc_html($disclaimer); ?>
          </p>
          <?php endif; ?>
          
          <p style="margin: 10px 0 0 0;">
            &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. <?php echo esc_html(get_theme_mod('tabaix_footer_copyright', __('All rights reserved.', 'tabaix'))); ?>
          </p>
        </div>

      </div>
    </footer>
  </div> <!-- Close .site-wrapper from header -->
  
  <?php wp_footer(); ?>

</body>
</html>
