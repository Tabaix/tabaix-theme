<?php
if (!defined('ABSPATH')) {
  exit;
}

// 1. Add Metabox
function tabaix_add_custom_code_metabox() {
  $screens = array('post', 'page');
  foreach ($screens as $screen) {
    add_meta_box(
      'tabaix_custom_code_box',
      __('Tabaix Advanced Page Options', 'tabaix'),
      'tabaix_custom_code_box_html',
      $screen,
      'normal',
      'high'
    );
  }
}
add_action('add_meta_boxes', 'tabaix_add_custom_code_metabox');

// 2. Render Metabox HTML
function tabaix_custom_code_box_html($post) {
  wp_nonce_field('tabaix_custom_code_nonce', 'tabaix_custom_code_nonce_field');

  $raw_html = get_post_meta($post->ID, '_tabaix_raw_page_html', true);
  $disable_assets = get_post_meta($post->ID, '_tabaix_disable_theme_assets', true);
  $custom_css = get_post_meta($post->ID, '_tabaix_custom_css', true);
  $custom_js = get_post_meta($post->ID, '_tabaix_custom_js', true);
  ?>
  <div class="tabaix-meta-wrapper" style="padding: 10px 0;">
    
    <!-- Raw HTML Bypass Section -->
    <div style="margin-bottom: 20px;">
      <label for="tabaix_raw_page_html" style="display: block; font-weight: bold; margin-bottom: 5px;">
        <?php _e('Raw Page HTML (Bypass Theme Entirely)', 'tabaix'); ?>
      </label>
      <p class="description" style="margin-bottom: 8px;">
        <?php _e('Paste a complete AI-generated or custom HTML file here (including &lt;html&gt;, &lt;head&gt;, and &lt;body&gt; tags). If populated, the theme templates will be bypassed entirely, and this code will load directly on this URL slug. Perfect for ultra-fast, standalone pages.', 'tabaix'); ?>
      </p>
      <textarea name="tabaix_raw_page_html" id="tabaix_raw_page_html" rows="12" style="width: 100%; font-family: monospace; background: #f6f6f6; border-radius: 4px; padding: 10px;"><?php echo esc_textarea($raw_html); ?></textarea>
    </div>

    <hr style="border: 0; border-top: 1px solid #eee; margin: 20px 0;" />

    <!-- Dequeue Theme Assets Checkbox -->
    <div style="margin-bottom: 20px;">
      <label style="font-weight: bold;">
        <input type="checkbox" name="tabaix_disable_theme_assets" value="yes" <?php checked($disable_assets, 'yes'); ?> />
        <?php _e('Disable Theme Styles & Scripts', 'tabaix'); ?>
      </label>
      <p class="description" style="margin-left: 20px; margin-top: 5px;">
        <?php _e('Check this box to dequeue the default theme stylesheets (main.css, components.css, etc.) and JS scripts for this page. Crucial when enqueuing completely custom framework outputs to avoid conflicts.', 'tabaix'); ?>
      </p>
    </div>

    <hr style="border: 0; border-top: 1px solid #eee; margin: 20px 0;" />

    <!-- Custom CSS Overrides -->
    <div style="margin-bottom: 20px;">
      <label for="tabaix_custom_css" style="display: block; font-weight: bold; margin-bottom: 5px;">
        <?php _e('Custom Page CSS Overrides', 'tabaix'); ?>
      </label>
      <p class="description" style="margin-bottom: 8px;">
        <?php _e('Add CSS styles specific to this page only. Style rules are automatically output in the page &lt;head&gt;. Do not include &lt;style&gt; tags.', 'tabaix'); ?>
      </p>
      <textarea name="tabaix_custom_css" id="tabaix_custom_css" rows="6" style="width: 100%; font-family: monospace; background: #f6f6f6; border-radius: 4px; padding: 10px;"><?php echo esc_textarea($custom_css); ?></textarea>
    </div>

    <!-- Custom JS Overrides -->
    <div style="margin-bottom: 10px;">
      <label for="tabaix_custom_js" style="display: block; font-weight: bold; margin-bottom: 5px;">
        <?php _e('Custom Page JavaScript', 'tabaix'); ?>
      </label>
      <p class="description" style="margin-bottom: 8px;">
        <?php _e('Add custom JS scripts specific to this page only. Script code is output in the footer. Do not include &lt;script&gt; tags.', 'tabaix'); ?>
      </p>
      <textarea name="tabaix_custom_js" id="tabaix_custom_js" rows="6" style="width: 100%; font-family: monospace; background: #f6f6f6; border-radius: 4px; padding: 10px;"><?php echo esc_textarea($custom_js); ?></textarea>
    </div>

  </div>
  <?php
}

// 3. Save Metabox Data
function tabaix_save_custom_code_data($post_id) {
  if (!isset($_POST['tabaix_custom_code_nonce_field'])) {
    return;
  }
  if (!wp_verify_nonce($_POST['tabaix_custom_code_nonce_field'], 'tabaix_custom_code_nonce')) {
    return;
  }
  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return;
  }
  if (!current_user_can('edit_post', $post_id)) {
    return;
  }

  // Raw HTML
  if (isset($_POST['tabaix_raw_page_html'])) {
    update_post_meta($post_id, '_tabaix_raw_page_html', wp_unslash($_POST['tabaix_raw_page_html']));
  }

  // Disable Theme Assets
  $disable_assets = isset($_POST['tabaix_disable_theme_assets']) ? 'yes' : 'no';
  update_post_meta($post_id, '_tabaix_disable_theme_assets', $disable_assets);

  // Custom CSS
  if (isset($_POST['tabaix_custom_css'])) {
    update_post_meta($post_id, '_tabaix_custom_css', wp_unslash($_POST['tabaix_custom_css']));
  }

  // Custom JS
  if (isset($_POST['tabaix_custom_js'])) {
    update_post_meta($post_id, '_tabaix_custom_js', wp_unslash($_POST['tabaix_custom_js']));
  }
}
add_action('save_post', 'tabaix_save_custom_code_data');

// 4. Raw HTML Page Bypass Hook
function tabaix_serve_raw_html_bypass() {
  if (is_singular()) {
    $raw_html = get_post_meta(get_the_ID(), '_tabaix_raw_page_html', true);
    if (!empty($raw_html)) {
      // Output the complete raw code and terminate execution immediately
      echo $raw_html;
      exit;
    }
  }
}
add_action('template_redirect', 'tabaix_serve_raw_html_bypass', 1);

// 5. Dequeue Theme Assets Hook
function tabaix_dequeue_theme_assets() {
  if (is_singular()) {
    $disable = get_post_meta(get_the_ID(), '_tabaix_disable_theme_assets', true);
    if ($disable === 'yes') {
      wp_dequeue_style('tabaix-style');
      wp_dequeue_style('tabaix-main');
      wp_dequeue_style('tabaix-components');
      wp_dequeue_style('tabaix-utilities');
      wp_dequeue_style('tabaix-google-fonts');

      wp_dequeue_script('tabaix-main');
      wp_dequeue_script('tabaix-navigation');
      wp_dequeue_script('tabaix-search');
      wp_dequeue_script('tabaix-lazy-load');
      wp_dequeue_script('tabaix-analytics');
    }
  }
}
add_action('wp_enqueue_scripts', 'tabaix_dequeue_theme_assets', 999);

// 6. Inject Custom CSS Hook
function tabaix_inject_custom_css() {
  if (is_singular()) {
    $custom_css = get_post_meta(get_the_ID(), '_tabaix_custom_css', true);
    if (!empty($custom_css)) {
      echo "\n<!-- Tabaix Custom Page CSS -->\n";
      echo "<style id=\"tabaix-custom-page-css\" type=\"text/css\">\n";
      echo esc_html($custom_css) . "\n";
      echo "</style>\n";
    }
  }
}
add_action('wp_head', 'tabaix_inject_custom_css', 200);

// 7. Inject Custom JS Hook
function tabaix_inject_custom_js() {
  if (is_singular()) {
    $custom_js = get_post_meta(get_the_ID(), '_tabaix_custom_js', true);
    if (!empty($custom_js)) {
      echo "\n<!-- Tabaix Custom Page JS -->\n";
      echo "<script id=\"tabaix-custom-page-js\" type=\"text/javascript\">\n";
      echo $custom_js . "\n";
      echo "</script>\n";
    }
  }
}
add_action('wp_footer', 'tabaix_inject_custom_js', 200);
