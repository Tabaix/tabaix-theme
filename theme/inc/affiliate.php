<?php

if (!defined('ABSPATH')) {
  exit;
}

class Tabaix_Affiliate_Manager {
  
  public function __construct() {
    // Register customizer settings for Affiliate Tracking ID
    add_action('customize_register', array($this, 'register_customizer_settings'));
    
    // Auto-append Amazon tags to content links
    add_filter('the_content', array($this, 'auto_tag_amazon_links'));
    
    // Amazon Button Shortcode
    add_shortcode('amazon_button', array($this, 'amazon_button_shortcode'));

    // Amazon Disclosure below post content
    add_filter('the_content', array($this, 'add_amazon_disclosure'));
  }

  public function register_customizer_settings($wp_customize) {
    $wp_customize->add_section('tabaix_affiliate_settings', array(
      'title' => __('Affiliate & Monetization', 'tabaix'),
      'priority' => 165,
    ));

    // Amazon Tracking ID
    $wp_customize->add_setting('amazon_tracking_id', array(
      'default' => '',
      'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('amazon_tracking_id', array(
      'label' => __('Amazon Tracking ID (e.g. yourtag-20)', 'tabaix'),
      'section' => 'tabaix_affiliate_settings',
      'type' => 'text',
      'description' => __('Automatically appends your tag to all Amazon links in your posts.', 'tabaix'),
    ));

    // Global Amazon Disclosure
    $wp_customize->add_setting('amazon_disclosure_text', array(
      'default' => __('As an Amazon Associate I earn from qualifying purchases.', 'tabaix'),
      'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('amazon_disclosure_text', array(
      'label' => __('Amazon Disclosure Text', 'tabaix'),
      'section' => 'tabaix_affiliate_settings',
      'type' => 'textarea',
      'description' => __('Displayed at the bottom of posts that contain Amazon links.', 'tabaix'),
    ));
  }

  public function auto_tag_amazon_links($content) {
    $amazon_tag = get_theme_mod('amazon_tracking_id');
    if (empty($amazon_tag)) {
      return $content;
    }

    // Match amazon.com and amzn.to links and append the tag safely
    $pattern = '/href=["\'](https?:\/\/(?:www\.)?amazon\.[a-z\.]{2,6}\/[^"\']+)["\']/i';
    
    $content = preg_replace_callback($pattern, function($matches) use ($amazon_tag) {
      $url = $matches[1];
      // Check if tag already exists to avoid duplication
      if (strpos($url, 'tag=') === false) {
        $separator = (parse_url($url, PHP_URL_QUERY) == NULL) ? '?' : '&';
        $url .= $separator . 'tag=' . esc_attr($amazon_tag);
      }
      return 'href="' . esc_url($url) . '" rel="nofollow sponsored" target="_blank"';
    }, $content);

    return $content;
  }

  public function amazon_button_shortcode($atts, $content = null) {
    $atts = shortcode_atts(array(
      'url' => '#',
      'title' => __('Check Price on Amazon', 'tabaix'),
      'price' => '',
    ), $atts, 'amazon_button');

    $amazon_tag = get_theme_mod('amazon_tracking_id');
    $url = $atts['url'];
    
    if (!empty($amazon_tag) && strpos($url, 'amazon.') !== false && strpos($url, 'tag=') === false) {
      $separator = (parse_url($url, PHP_URL_QUERY) == NULL) ? '?' : '&';
      $url .= $separator . 'tag=' . esc_attr($amazon_tag);
    }

    ob_start();
    ?>
    <div class="amazon-btn-wrapper" style="margin: 20px 0;">
      <a href="<?php echo esc_url($url); ?>" class="btn btn-primary" target="_blank" rel="nofollow sponsored" style="background: linear-gradient(135deg, #ff9900, #e68a00); border: none; font-weight: bold; padding: 12px 24px; box-shadow: 0 4px 15px rgba(255, 153, 0, 0.3);">
        <svg style="width: 20px; height: 20px; margin-right: 8px; fill: currentColor; vertical-align: middle;" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path d="M14.7 18.5c-1.3.8-3.2 1.3-5.2 1.3-2.7 0-4.9-1.2-6.5-3.3-.3-.4-.2-.8.2-1 .3-.2.8-.5 1.1-.6.3-.1.6 0 .8.3 1.1 1.6 2.7 2.4 4.5 2.4 1.7 0 3.3-.6 4.3-1.6.3-.3.7-.4 1-.2l1.3.8c.4.2.4.6.1 1-.8 1-1.6 1.6-2.6 1.9zm5.5-2c-.3.4-.6.6-1 .5-.9-.1-1.5-.7-2.3-1.4.1.3.1.5.1.7 0 1.2-.5 1.7-1.3 1.7-.8 0-1.4-.7-1.4-1.6 0-.8.4-1.4 1.2-1.6.4-.1.8 0 1.1.1-.3-.6-.8-1-1.3-1-1.1 0-1.7 1.1-1.7 2.6 0 1.5.6 2.6 1.7 2.6 1 0 1.7-.6 2-1.3.2-.4.6-.5 1-.4l.9.3c.5.2.5.6.3 1-.7 1.3-1.9 2-3.4 2-2 0-3.4-1.5-3.4-3.7 0-2.3 1.5-3.8 3.5-3.8 2.1 0 3.2 1.4 3.7 3.3.1.5-.1.8-.5 1h-4.8c.1.9.5 1.4 1.2 1.4.6 0 1-.4 1.2-.9.1-.3.4-.4.8-.3l1 .3c.5.1.5.5.2.9zm-9.3-8.1c-.8-.2-1.3.3-1.5 1.1-.2 1.1 0 2.2.8 2.8.6.5 1.4.6 2.1.2.6-.3 1-.8 1.1-1.4 0-.1 0-.2 0-.3-.4.3-.9.4-1.4.3-.7-.1-1-.6-1.1-2.7zm3.1 3c0 .8-.5 1.3-1.3 1.4-1.1.2-2.1-.2-2.8-1-.7-.8-.9-1.9-.6-3 .3-1.2 1.2-1.9 2.4-1.9 1 0 1.7.5 2.1 1.3.1-.9.3-1.7.6-2.5.2-.6.7-.8 1.2-.6l1 .4c.6.2.7.6.5 1.2-.6 1.9-.9 3.9-.9 5.8 0 .8.2 1.2.7 1.2.4 0 .7-.2.9-.6.2-.4.6-.4 1-.2l.9.5c.5.3.5.7.2 1.1-.6.9-1.5 1.4-2.6 1.4-1.3 0-2-.8-2-2.3 0-.6.1-1.2.2-1.8-1 1-1.7 1.2-2.6 1z"/>
        </svg>
        <?php echo esc_html($atts['title']); ?> 
        <?php if (!empty($atts['price'])) : ?>
          <span style="opacity: 0.9; margin-left: 6px; padding-left: 6px; border-left: 1px solid rgba(255,255,255,0.4);"><?php echo esc_html($atts['price']); ?></span>
        <?php endif; ?>
      </a>
    </div>
    <?php
    return ob_get_clean();
  }

  public function add_amazon_disclosure($content) {
    if (is_single() && strpos($content, 'amazon.') !== false) {
      $disclosure = get_theme_mod('amazon_disclosure_text', 'As an Amazon Associate I earn from qualifying purchases.');
      if (!empty($disclosure)) {
        $content .= '<div class="amazon-disclosure" style="margin-top: 30px; padding: 15px; font-size: 0.85em; color: #666; background: #f9f9f9; border-left: 3px solid #ff9900;">' . esc_html($disclosure) . '</div>';
      }
    }
    return $content;
  }
}

new Tabaix_Affiliate_Manager();
