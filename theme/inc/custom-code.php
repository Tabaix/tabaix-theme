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

    <?php if ($post->post_type === 'page' && get_post_meta($post->ID, '_wp_page_template', true) === 'page-templates/template-glassmorphic-aurora.php') : ?>
      <style>
        .tabaix-block-editor { display: grid; gap: 18px; margin-top: 20px; }
        .tabaix-block-card { border: 1px solid #e2e8f0; border-radius: 16px; background: #ffffff; box-shadow: 0 8px 24px rgba(15, 23, 42, 0.06); overflow: hidden; }
        .tabaix-block-card__header { padding: 18px 22px; background: #f8fafc; border-bottom: 1px solid #e2e8f0; font-weight: 700; font-size: 1rem; color: #111827; }
        .tabaix-block-card__body { padding: 20px; display: grid; gap: 16px; }
        .tabaix-block-card label { display: block; margin-bottom: 6px; font-weight: 600; color: #111827; }
        .tabaix-block-card input[type="text"],
        .tabaix-block-card input[type="url"],
        .tabaix-block-card textarea { width: 100%; padding: 12px 14px; border: 1px solid #d1d5db; border-radius: 12px; background: #f8fafc; font-family: inherit; color: #111827; }
        .tabaix-block-card textarea { min-height: 110px; resize: vertical; }
        .tabaix-block-card .tabaix-grid-2 { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 16px; }
      </style>
      <hr style="border: 0; border-top: 1px solid #eee; margin: 20px 0;" />
      <h2 style="margin-top: 0; font-size: 1.2rem;"><?php esc_html_e('Glassmorphic Page Blocks', 'tabaix'); ?></h2>
      <?php
      $glass_hero_headline = get_post_meta($post->ID, 'glass_hero_headline', true);
      $glass_hero_subtitle = get_post_meta($post->ID, 'glass_hero_subtitle', true);
      $glass_cta_primary_label = get_post_meta($post->ID, 'glass_cta_primary_label', true);
      $glass_cta_primary_url = get_post_meta($post->ID, 'glass_cta_primary_url', true);
      $glass_cta_secondary_label = get_post_meta($post->ID, 'glass_cta_secondary_label', true);
      $glass_cta_secondary_url = get_post_meta($post->ID, 'glass_cta_secondary_url', true);
      $glass_tools_section_title = get_post_meta($post->ID, 'glass_tools_section_title', true);
      $glass_tools_section_subtitle = get_post_meta($post->ID, 'glass_tools_section_subtitle', true);
      $glass_blog_section_title = get_post_meta($post->ID, 'glass_blog_section_title', true);
      $glass_blog_section_subtitle = get_post_meta($post->ID, 'glass_blog_section_subtitle', true);
      ?>
      <div class="tabaix-block-editor">
        <div class="tabaix-block-card">
          <div class="tabaix-block-card__header"><?php esc_html_e('Hero Block', 'tabaix'); ?></div>
          <div class="tabaix-block-card__body">
            <div>
              <label for="glass_hero_headline"><?php esc_html_e('Headline', 'tabaix'); ?></label>
              <input type="text" name="glass_hero_headline" id="glass_hero_headline" value="<?php echo esc_attr($glass_hero_headline); ?>" />
            </div>
            <div>
              <label for="glass_hero_subtitle"><?php esc_html_e('Subtitle', 'tabaix'); ?></label>
              <textarea name="glass_hero_subtitle" id="glass_hero_subtitle"><?php echo esc_textarea($glass_hero_subtitle); ?></textarea>
            </div>
          </div>
        </div>

        <div class="tabaix-block-card">
          <div class="tabaix-block-card__header"><?php esc_html_e('CTA Buttons', 'tabaix'); ?></div>
          <div class="tabaix-block-card__body tabaix-grid-2">
            <div>
              <label for="glass_cta_primary_label"><?php esc_html_e('Primary CTA Label', 'tabaix'); ?></label>
              <input type="text" name="glass_cta_primary_label" id="glass_cta_primary_label" value="<?php echo esc_attr($glass_cta_primary_label); ?>" />
            </div>
            <div>
              <label for="glass_cta_primary_url"><?php esc_html_e('Primary CTA URL', 'tabaix'); ?></label>
              <input type="url" name="glass_cta_primary_url" id="glass_cta_primary_url" value="<?php echo esc_attr($glass_cta_primary_url); ?>" />
            </div>
            <div>
              <label for="glass_cta_secondary_label"><?php esc_html_e('Secondary CTA Label', 'tabaix'); ?></label>
              <input type="text" name="glass_cta_secondary_label" id="glass_cta_secondary_label" value="<?php echo esc_attr($glass_cta_secondary_label); ?>" />
            </div>
            <div>
              <label for="glass_cta_secondary_url"><?php esc_html_e('Secondary CTA URL', 'tabaix'); ?></label>
              <input type="url" name="glass_cta_secondary_url" id="glass_cta_secondary_url" value="<?php echo esc_attr($glass_cta_secondary_url); ?>" />
            </div>
          </div>
        </div>

        <div class="tabaix-block-card">
          <div class="tabaix-block-card__header"><?php esc_html_e('Tools Section', 'tabaix'); ?></div>
          <div class="tabaix-block-card__body">
            <div>
              <label for="glass_tools_section_title"><?php esc_html_e('Section Title', 'tabaix'); ?></label>
              <input type="text" name="glass_tools_section_title" id="glass_tools_section_title" value="<?php echo esc_attr($glass_tools_section_title); ?>" />
            </div>
            <div>
              <label for="glass_tools_section_subtitle"><?php esc_html_e('Section Subtitle', 'tabaix'); ?></label>
              <textarea name="glass_tools_section_subtitle" id="glass_tools_section_subtitle"><?php echo esc_textarea($glass_tools_section_subtitle); ?></textarea>
            </div>
          </div>
        </div>

        <div class="tabaix-block-card">
          <div class="tabaix-block-card__header"><?php esc_html_e('Blog Section', 'tabaix'); ?></div>
          <div class="tabaix-block-card__body">
            <div>
              <label for="glass_blog_section_title"><?php esc_html_e('Section Title', 'tabaix'); ?></label>
              <input type="text" name="glass_blog_section_title" id="glass_blog_section_title" value="<?php echo esc_attr($glass_blog_section_title); ?>" />
            </div>
            <div>
              <label for="glass_blog_section_subtitle"><?php esc_html_e('Section Subtitle', 'tabaix'); ?></label>
              <textarea name="glass_blog_section_subtitle" id="glass_blog_section_subtitle"><?php echo esc_textarea($glass_blog_section_subtitle); ?></textarea>
            </div>
          </div>
        </div>
      </div>
    <?php endif; ?>
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

  // Glassmorphic page fields
  $glass_fields = array(
    'glass_hero_headline',
    'glass_hero_subtitle',
    'glass_cta_primary_label',
    'glass_cta_primary_url',
    'glass_cta_secondary_label',
    'glass_cta_secondary_url',
    'glass_tools_section_title',
    'glass_tools_section_subtitle',
    'glass_blog_section_title',
    'glass_blog_section_subtitle',
  );

  foreach ($glass_fields as $field) {
    if (isset($_POST[$field])) {
      update_post_meta($post_id, $field, wp_unslash($_POST[$field]));
    }
  }
}
add_action('save_post', 'tabaix_save_custom_code_data');

// 4. Theme admin page for quick starter pages
function tabaix_get_builder_templates() {
  $templates = get_page_templates();
  $builder_templates = array();

  foreach ($templates as $template_name => $template_file) {
    if (!is_string($template_file)) {
      continue;
    }
    $template_path = get_template_directory() . '/' . $template_file;
    if (file_exists($template_path)) {
      $builder_templates[$template_file] = $template_name;
    }
  }

  return $builder_templates;
}

function tabaix_get_builder_template_defaults($template_file) {
  $defaults = array(
    'post_title' => '',
    'post_name' => '',
    'post_excerpt' => '',
    'meta' => array(),
  );

  if ($template_file === 'page-templates/template-glassmorphic-aurora.php') {
    $defaults['post_title'] = 'Glassmorphic Aurora';
    $defaults['post_name'] = 'glassmorphic-aurora';
    $defaults['post_excerpt'] = '100 free browser tools. Zero server cost. Privacy first. Built by Tayyab Ali in Riyadh.';
    $defaults['meta'] = array(
      'glass_hero_headline' => 'TABAHI BEYOND X',
      'glass_hero_subtitle' => '100 free browser tools for images, PDF, video, dev, SEO and more. Zero uploads. Zero server. Your files never leave your device.',
      'glass_cta_primary_label' => 'Explore 100 Tools ↗',
      'glass_cta_primary_url' => '#tools',
      'glass_cta_secondary_label' => 'Read the Blog',
      'glass_cta_secondary_url' => '#blog',
      'glass_tools_section_title' => '100 Tools. Zero Cost. Maximum Privacy.',
      'glass_tools_section_subtitle' => 'The best browser-based tools for images, SEO, PDF, video and dev—designed for speed and growth.',
      'glass_blog_section_title' => 'Truth from Riyadh.',
      'glass_blog_section_subtitle' => 'Real stories, tool guides, and growth strategy from the Tabaix team.',
    );
  }

  return $defaults;
}

function tabaix_get_builder_page_by_template($template_file) {
  $pages = get_posts(array(
    'post_type' => 'page',
    'posts_per_page' => 1,
    'meta_key' => '_wp_page_template',
    'meta_value' => $template_file,
    'post_status' => array('publish', 'draft', 'pending', 'future'),
  ));

  return !empty($pages) ? $pages[0] : null;
}

function tabaix_get_builder_template_fields($template_file) {
  switch ($template_file) {
    case 'page-templates/template-glassmorphic-aurora.php':
      return array(
        array(
          'id' => 'hero',
          'title' => __('Hero Block', 'tabaix'),
          'fields' => array(
            array('key' => 'glass_hero_headline', 'label' => __('Headline', 'tabaix'), 'type' => 'text'),
            array('key' => 'glass_hero_subtitle', 'label' => __('Subtitle', 'tabaix'), 'type' => 'textarea'),
          ),
        ),
        array(
          'id' => 'cta',
          'title' => __('CTA Buttons', 'tabaix'),
          'fields' => array(
            array('key' => 'glass_cta_primary_label', 'label' => __('Primary CTA Label', 'tabaix'), 'type' => 'text'),
            array('key' => 'glass_cta_primary_url', 'label' => __('Primary CTA URL', 'tabaix'), 'type' => 'text'),
            array('key' => 'glass_cta_secondary_label', 'label' => __('Secondary CTA Label', 'tabaix'), 'type' => 'text'),
            array('key' => 'glass_cta_secondary_url', 'label' => __('Secondary CTA URL', 'tabaix'), 'type' => 'text'),
          ),
        ),
        array(
          'id' => 'tools',
          'title' => __('Tools Section', 'tabaix'),
          'fields' => array(
            array('key' => 'glass_tools_section_title', 'label' => __('Section Title', 'tabaix'), 'type' => 'text'),
            array('key' => 'glass_tools_section_subtitle', 'label' => __('Section Subtitle', 'tabaix'), 'type' => 'textarea'),
          ),
        ),
        array(
          'id' => 'blog',
          'title' => __('Blog Section', 'tabaix'),
          'fields' => array(
            array('key' => 'glass_blog_section_title', 'label' => __('Section Title', 'tabaix'), 'type' => 'text'),
            array('key' => 'glass_blog_section_subtitle', 'label' => __('Section Subtitle', 'tabaix'), 'type' => 'textarea'),
          ),
        ),
      );
    default:
      return array();
  }
}

function tabaix_render_builder_template_block_card($block, $values) {
  ?>
  <div class="tabaix-block-card">
    <div class="tabaix-block-card__header"><?php echo esc_html($block['title']); ?></div>
    <div class="tabaix-block-card__body">
      <?php foreach ($block['fields'] as $field) : ?>
        <div>
          <label for="<?php echo esc_attr($field['key']); ?>"><?php echo esc_html($field['label']); ?></label>
          <?php if ($field['type'] === 'textarea') : ?>
            <textarea name="<?php echo esc_attr($field['key']); ?>" id="<?php echo esc_attr($field['key']); ?>"><?php echo esc_textarea(isset($values[$field['key']]) ? $values[$field['key']] : ''); ?></textarea>
          <?php else : ?>
            <input type="text" name="<?php echo esc_attr($field['key']); ?>" id="<?php echo esc_attr($field['key']); ?>" value="<?php echo esc_attr(isset($values[$field['key']]) ? $values[$field['key']] : ''); ?>" />
          <?php endif; ?>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
  <?php
}

function tabaix_save_builder_page_fields() {
  if (!current_user_can('edit_theme_options')) {
    wp_die(__('You do not have permission to save this page.', 'tabaix'));
  }

  check_admin_referer('tabaix_save_builder_page_fields', 'tabaix_builder_fields_nonce');

  $page_id = isset($_POST['tabaix_builder_page_id']) ? intval($_POST['tabaix_builder_page_id']) : 0;
  $template_file = isset($_POST['tabaix_builder_template']) ? sanitize_text_field(wp_unslash($_POST['tabaix_builder_template'])) : '';

  if (!$page_id || empty($template_file)) {
    wp_die(__('Invalid page or template.', 'tabaix'));
  }

  $page = get_post($page_id);
  if (!$page || $page->post_type !== 'page') {
    wp_die(__('The selected page could not be found.', 'tabaix'));
  }

  $current_template = get_post_meta($page_id, '_wp_page_template', true);
  if ($current_template !== $template_file) {
    wp_die(__('Template mismatch for the selected page.', 'tabaix'));
  }

  $blocks = tabaix_get_builder_template_fields($template_file);
  if (empty($blocks)) {
    wp_die(__('No editable blocks are defined for this template.', 'tabaix'));
  }

  foreach ($blocks as $block) {
    foreach ($block['fields'] as $field) {
      if (isset($_POST[$field['key']])) {
        update_post_meta($page_id, $field['key'], wp_unslash($_POST[$field['key']]));
      }
    }
  }

  $redirect_url = add_query_arg(
    array(
      'page' => 'tabaix-page-builder',
      'template' => rawurlencode($template_file),
      'saved' => 1,
      'page_id' => $page_id,
    ), admin_url('themes.php')
  );

  wp_redirect($redirect_url);
  exit;
}
add_action('admin_post_tabaix_save_builder_page_fields', 'tabaix_save_builder_page_fields');

function tabaix_register_theme_admin_menu() {
  add_theme_page(
    __('Tabaix Page Builder', 'tabaix'),
    __('Tabaix Page Builder', 'tabaix'),
    'edit_theme_options',
    'tabaix-page-builder',
    'tabaix_page_builder_admin_page'
  );
}
add_action('admin_menu', 'tabaix_register_theme_admin_menu');

function tabaix_page_builder_admin_page() {
  $templates = tabaix_get_builder_templates();
  $selected_template = isset($_GET['template']) ? sanitize_text_field(wp_unslash($_GET['template'])) : '';
  $preview_title = '';
  $preview_slug = '';
  $builder_page = null;
  $builder_page_id = 0;
  $builder_fields = array();
  $builder_values = array();

  if (!empty($selected_template) && isset($templates[$selected_template])) {
    $preview_title = sanitize_text_field($templates[$selected_template]);
    $preview_slug = sanitize_title($preview_title);
    $builder_page = tabaix_get_builder_page_by_template($selected_template);
    $builder_page_id = $builder_page ? $builder_page->ID : 0;
    $builder_fields = tabaix_get_builder_template_fields($selected_template);

    if (!empty($builder_fields)) {
      if ($builder_page) {
        foreach ($builder_fields as $block) {
          foreach ($block['fields'] as $field) {
            $builder_values[$field['key']] = get_post_meta($builder_page_id, $field['key'], true);
          }
        }
      } else {
        $defaults = tabaix_get_builder_template_defaults($selected_template);
        $builder_values = isset($defaults['meta']) ? $defaults['meta'] : array();
      }
    }
  }
  ?>
  <div class="wrap">
    <h1><?php esc_html_e('Tabaix Page Builder', 'tabaix'); ?></h1>
    <?php if (isset($_GET['created'])) : ?>
      <div class="notice notice-success is-dismissible"><p><?php esc_html_e('Template page created successfully.', 'tabaix'); ?></p></div>
    <?php endif; ?>
    <?php if (isset($_GET['saved'])) : ?>
      <div class="notice notice-success is-dismissible"><p><?php esc_html_e('Template content blocks saved successfully.', 'tabaix'); ?></p></div>
    <?php endif; ?>
    <p><?php esc_html_e('Create a new page using any of your theme page templates. This lets you add future custom page designs and use them without code.', 'tabaix'); ?></p>

    <form method="get" action="">
      <input type="hidden" name="page" value="tabaix-page-builder" />
      <table class="form-table" role="presentation">
        <tbody>
          <tr>
            <th scope="row"><label for="tabaix_builder_template"><?php esc_html_e('Page Template', 'tabaix'); ?></label></th>
            <td>
              <select name="template" id="tabaix_builder_template" onchange="this.form.submit()" style="max-width: 400px;">
                <option value=""><?php esc_html_e('Select a template', 'tabaix'); ?></option>
                <?php foreach ($templates as $template_file => $template_name) : ?>
                  <option value="<?php echo esc_attr($template_file); ?>" <?php selected($selected_template, $template_file); ?>><?php echo esc_html($template_name); ?></option>
                <?php endforeach; ?>
              </select>
              <p class="description"><?php esc_html_e('Choose a page template to preview or edit its blocks.', 'tabaix'); ?></p>
            </td>
          </tr>
        </tbody>
      </table>
    </form>

    <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
      <?php wp_nonce_field('tabaix_create_builder_page', 'tabaix_builder_nonce'); ?>
      <input type="hidden" name="action" value="tabaix_create_builder_page">
      <input type="hidden" name="tabaix_builder_template" value="<?php echo esc_attr($selected_template); ?>">

      <table class="form-table" role="presentation">
        <tbody>
          <tr>
            <th scope="row"><label for="tabaix_builder_title"><?php esc_html_e('Page Title', 'tabaix'); ?></label></th>
            <td>
              <input name="tabaix_builder_title" type="text" id="tabaix_builder_title" value="<?php echo esc_attr($preview_title); ?>" class="regular-text" />
              <p class="description"><?php esc_html_e('Optional custom title for the new page.', 'tabaix'); ?></p>
            </td>
          </tr>
          <tr>
            <th scope="row"><label for="tabaix_builder_slug"><?php esc_html_e('Page Slug', 'tabaix'); ?></label></th>
            <td>
              <input name="tabaix_builder_slug" type="text" id="tabaix_builder_slug" value="<?php echo esc_attr($preview_slug); ?>" class="regular-text" />
              <p class="description"><?php esc_html_e('Optional URL slug for the new page. If left blank, one is generated from the title.', 'tabaix'); ?></p>
            </td>
          </tr>
        </tbody>
      </table>

      <div style="display:flex;gap:10px;flex-wrap:wrap;">
        <button type="submit" name="tabaix_builder_action" value="edit_post" class="button button-primary"><?php esc_html_e('Create Page and Edit', 'tabaix'); ?></button>
        <button type="submit" name="tabaix_builder_action" value="edit_blocks" class="button button-secondary"><?php esc_html_e('Create Page & Edit Blocks', 'tabaix'); ?></button>
      </div>
    </form>

    <?php if (!empty($builder_fields)) : ?>
      <style>
        .tabaix-builder-block-editor { display: grid; gap: 18px; margin-top: 28px; }
        .tabaix-block-card { border: 1px solid #d1d5db; border-radius: 20px; background: #ffffff; box-shadow: 0 14px 35px rgba(15, 23, 42, 0.05); overflow: hidden; }
        .tabaix-block-card__header { padding: 18px 22px; background: #f8fafc; border-bottom: 1px solid #e2e8f0; font-weight: 700; font-size: 1rem; color: #111827; }
        .tabaix-block-card__body { padding: 20px; display: grid; gap: 16px; }
        .tabaix-block-card label { display: block; margin-bottom: 6px; font-weight: 600; color: #111827; }
        .tabaix-block-card input[type="text"],
        .tabaix-block-card textarea { width: 100%; padding: 12px 14px; border: 1px solid #d1d5db; border-radius: 12px; background: #f8fafc; font-family: inherit; color: #111827; }
        .tabaix-block-card textarea { min-height: 110px; resize: vertical; }
        .tabaix-builder-actions { display: flex; flex-wrap: wrap; gap: 12px; align-items: center; margin-bottom: 18px; }
      </style>

      <h2><?php esc_html_e('Template Content Blocks', 'tabaix'); ?></h2>
      <div class="tabaix-builder-actions">
        <?php if ($builder_page_id) : ?>
          <a href="<?php echo esc_url(get_edit_post_link($builder_page_id)); ?>" class="button"><?php esc_html_e('Open Page Editor', 'tabaix'); ?></a>
          <a href="<?php echo esc_url(get_permalink($builder_page_id)); ?>" target="_blank" class="button button-secondary"><?php esc_html_e('View Page', 'tabaix'); ?></a>
          <span style="margin-left:auto;color:#475569;"><?php esc_html_e('Editing live page content blocks.', 'tabaix'); ?></span>
        <?php else : ?>
          <span style="color:#475569;"><?php esc_html_e('No page exists yet for this template. Create the page first to save block fields.', 'tabaix'); ?></span>
        <?php endif; ?>
      </div>

      <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" id="tabaix_builder_fields_form">
        <?php wp_nonce_field('tabaix_save_builder_page_fields', 'tabaix_builder_fields_nonce'); ?>
        <input type="hidden" name="action" value="tabaix_save_builder_page_fields">
        <input type="hidden" name="tabaix_builder_page_id" value="<?php echo esc_attr($builder_page_id); ?>">
        <input type="hidden" name="tabaix_builder_template" value="<?php echo esc_attr($selected_template); ?>">

        <div class="tabaix-builder-block-editor">
          <?php foreach ($builder_fields as $block) : ?>
            <?php tabaix_render_builder_template_block_card($block, $builder_values); ?>
          <?php endforeach; ?>
        </div>

        <?php if ($builder_page_id) : ?>
          <p><button type="submit" class="button button-primary"><?php esc_html_e('Save Template Blocks', 'tabaix'); ?></button></p>
        <?php endif; ?>
      </form>
    <?php endif; ?>

    <hr />

    <h2><?php esc_html_e('Existing Builder Pages', 'tabaix'); ?></h2>
    <p><?php esc_html_e('Pages created by the builder will appear below. Click Edit to customize content or page fields.', 'tabaix'); ?></p>
    <table class="widefat striped">
      <thead>
        <tr>
          <th><?php esc_html_e('Page Title', 'tabaix'); ?></th>
          <th><?php esc_html_e('Template', 'tabaix'); ?></th>
          <th><?php esc_html_e('Actions', 'tabaix'); ?></th>
        </tr>
      </thead>
      <tbody>
        <?php
        $builder_pages = get_posts(array(
          'post_type' => 'page',
          'posts_per_page' => -1,
          'post_status' => array('publish', 'draft', 'pending', 'future'),
          'meta_query' => array(
            array(
              'key' => '_wp_page_template',
              'value' => array_keys($templates),
              'compare' => 'IN',
            ),
          ),
        ));

        if ($builder_pages) :
          foreach ($builder_pages as $page) :
            $template_file = get_post_meta($page->ID, '_wp_page_template', true);
            $template_name = isset($templates[$template_file]) ? $templates[$template_file] : $template_file;
        ?>
          <tr>
            <td><?php echo esc_html($page->post_title); ?></td>
            <td><?php echo esc_html($template_name); ?></td>
            <td><a href="<?php echo esc_url(get_edit_post_link($page->ID)); ?>"><?php esc_html_e('Edit', 'tabaix'); ?></a></td>
          </tr>
        <?php endforeach; else : ?>
          <tr><td colspan="3"><?php esc_html_e('No builder pages found yet.', 'tabaix'); ?></td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
  <?php
}

function tabaix_create_builder_page() {
  if (!current_user_can('edit_theme_options')) {
    wp_die(__('You do not have permission to create this page.', 'tabaix'));
  }
  check_admin_referer('tabaix_create_builder_page', 'tabaix_builder_nonce');

  $template_file = isset($_POST['tabaix_builder_template']) ? sanitize_text_field(wp_unslash($_POST['tabaix_builder_template'])) : '';
  $action = isset($_POST['tabaix_builder_action']) ? sanitize_text_field(wp_unslash($_POST['tabaix_builder_action'])) : 'edit_post';
  $templates = tabaix_get_builder_templates();

  if (empty($template_file) || !isset($templates[$template_file])) {
    wp_die(__('Please select a valid page template.', 'tabaix'));
  }

  $existing_pages = get_pages(array(
    'meta_key' => '_wp_page_template',
    'meta_value' => $template_file,
    'post_type' => 'page',
    'post_status' => array('publish', 'draft', 'pending', 'future'),
  ));

  if (!empty($existing_pages)) {
    $page_id = $existing_pages[0]->ID;
  } else {
    $defaults = tabaix_get_builder_template_defaults($template_file);
    $page_title = isset($_POST['tabaix_builder_title']) && trim($_POST['tabaix_builder_title']) ? sanitize_text_field(wp_unslash($_POST['tabaix_builder_title'])) : ($defaults['post_title'] ?: $templates[$template_file]);
    $page_slug = isset($_POST['tabaix_builder_slug']) && trim($_POST['tabaix_builder_slug']) ? sanitize_title(wp_unslash($_POST['tabaix_builder_slug'])) : sanitize_title($page_title);

    $page_data = array(
      'post_title' => $page_title,
      'post_name' => $page_slug,
      'post_type' => 'page',
      'post_status' => 'publish',
      'post_content' => '',
      'post_excerpt' => $defaults['post_excerpt'],
      'comment_status' => 'closed',
      'ping_status' => 'closed',
    );

    $page_id = wp_insert_post($page_data);

    if (!is_wp_error($page_id)) {
      update_post_meta($page_id, '_wp_page_template', $template_file);
      foreach ($defaults['meta'] as $meta_key => $meta_value) {
        update_post_meta($page_id, $meta_key, $meta_value);
      }
    }
  }

  $edit_link = get_edit_post_link($page_id);
  if ($action === 'edit_post' && $edit_link) {
    wp_redirect($edit_link);
    exit;
  }

  if ($action === 'edit_blocks') {
    wp_redirect(add_query_arg(array(
      'page' => 'tabaix-page-builder',
      'created' => 1,
      'page_id' => $page_id,
      'template' => rawurlencode($template_file),
    ), admin_url('themes.php')));
    exit;
  }

  wp_redirect(add_query_arg(array('page' => 'tabaix-page-builder', 'created' => 1, 'post' => $page_id), admin_url('themes.php')));
  exit;
}
add_action('admin_post_tabaix_create_builder_page', 'tabaix_create_builder_page');

// 5. Raw HTML Page Bypass Hook
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
