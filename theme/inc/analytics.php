<?php

if (!defined('ABSPATH')) {
  exit;
}

function tabaix_add_ga4_tag() {
  if (is_admin()) {
    return;
  }
  ?>
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-XXXXXXXXXX"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'G-XXXXXXXXXX', {
      anonymize_ip: true,
      send_page_view: true,
    });
  </script>
  <?php
}
add_action('wp_head', 'tabaix_add_ga4_tag', 1);
