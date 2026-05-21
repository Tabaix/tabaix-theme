<?php

if (!defined('ABSPATH')) {
  exit;
}

class Tabaix_AdSense {
  private $ad_client = 'ca-pub-9797202524330784';

  public function __construct() {
    add_action('wp_head', array($this, 'add_adsense_code'));
    add_filter('the_content', array($this, 'inject_ads'));
  }

  public function add_adsense_code() {
    if (is_admin()) {
      return;
    }
    ?>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=<?php echo esc_attr($this->ad_client); ?>" crossorigin="anonymous"></script>
    <?php
  }

  public function inject_ads($content) {
    if (is_front_page() || is_singular('tool')) {
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
    ob_start();
    ?>
    <div class="ad-container ad-in-article">
      <ins class="adsbygoogle"
           style="display:block; text-align:center;"
           data-ad-layout="in-article"
           data-ad-format="fluid"
           data-ad-client="<?php echo esc_attr($this->ad_client); ?>"
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
