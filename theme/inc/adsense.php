<?php

if (!defined('ABSPATH')) {
  exit;
}

class Tabaix_AdSense {
  public function __construct() {
    add_action('wp_head', array($this, 'add_adsense_code'));
    add_filter('the_content', array($this, 'inject_ads'));
    add_action('wp_body_open', array($this, 'inject_header_ad'));
    add_action('wp_footer', array($this, 'inject_footer_ad'));
  }

  public function add_adsense_code() {
    if (is_admin() || !get_theme_mod('tabaix_ads_enabled', false)) {
      return;
    }
    $pub_id = get_theme_mod('tabaix_ads_pub_id', 'ca-pub-9797202524330784');
    ?>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=<?php echo esc_attr($pub_id); ?>" crossorigin="anonymous"></script>
    <?php
  }

  public function inject_header_ad() {
    if (is_admin() || !get_theme_mod('tabaix_ads_enabled', false) || !get_theme_mod('tabaix_ad_header', false)) {
      return;
    }
    $pub_id = get_theme_mod('tabaix_ads_pub_id', 'ca-pub-9797202524330784');
    ?>
    <div class="ad-container ad-header" style="max-width: var(--container-2xl); margin: 20px auto; text-align: center; padding: 0 var(--space-4);">
      <ins class="adsbygoogle"
           style="display:block"
           data-ad-client="<?php echo esc_attr($pub_id); ?>"
           data-ad-slot="2345678901"
           data-ad-format="auto"
           data-full-width-responsive="true"></ins>
      <script>
           (adsbygoogle = window.adsbygoogle || []).push({});
      </script>
    </div>
    <?php
  }

  public function inject_footer_ad() {
    if (is_admin() || !get_theme_mod('tabaix_ads_enabled', false) || !get_theme_mod('tabaix_ad_footer', false)) {
      return;
    }
    $pub_id = get_theme_mod('tabaix_ads_pub_id', 'ca-pub-9797202524330784');
    ?>
    <div class="ad-container ad-footer" style="max-width: var(--container-2xl); margin: 20px auto; text-align: center; padding: 0 var(--space-4);">
      <ins class="adsbygoogle"
           style="display:block"
           data-ad-client="<?php echo esc_attr($pub_id); ?>"
           data-ad-slot="3456789012"
           data-ad-format="auto"
           data-full-width-responsive="true"></ins>
      <script>
           (adsbygoogle = window.adsbygoogle || []).push({});
      </script>
    </div>
    <?php
  }

  public function inject_ads($content) {
    if (is_front_page() || is_singular('tool') || !get_theme_mod('tabaix_ads_enabled', false) || !get_theme_mod('tabaix_ad_in_article', true)) {
      return $content;
    }

    $paragraphs = explode('</p>', $content);
    if (count($paragraphs) > 2) {
      $ad_code = $this->get_in_article_ad();
      array_splice($paragraphs, 2, 0, $ad_code);
      $content = implode('</p>', $paragraphs);
    }

    return $content;
  }

  private function get_in_article_ad() {
    $pub_id = get_theme_mod('tabaix_ads_pub_id', 'ca-pub-9797202524330784');
    ob_start();
    ?>
    <div class="ad-container ad-in-article" style="margin: var(--space-6) 0; text-align: center;">
      <ins class="adsbygoogle"
           style="display:block; text-align:center;"
           data-ad-layout="in-article"
           data-ad-format="fluid"
           data-ad-client="<?php echo esc_attr($pub_id); ?>"
           data-ad-slot="1234567890"></ins>
      <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
      </script>
    </div>
    <?php
    return ob_get_clean();
  }
}

new Tabaix_AdSense();
