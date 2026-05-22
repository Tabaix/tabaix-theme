<?php

if (!defined('ABSPATH')) {
  exit;
}

function tabaix_security_headers() {
  if (is_admin()) {
    return;
  }

  header("Content-Security-Policy: default-src 'self'; script-src 'self' 'unsafe-inline' https://www.googletagmanager.com https://pagead2.googlesyndication.com; style-src 'self' 'unsafe-inline'; img-src 'self' data: https:; font-src 'self' data:; connect-src 'self' https://www.google-analytics.com https://www.googletagmanager.com; frame-src 'self';");
  header('X-Frame-Options: SAMEORIGIN');
  header('X-XSS-Protection: 1; mode=block');
  header('X-Content-Type-Options: nosniff');
  header('Referrer-Policy: strict-origin-when-cross-origin');
  header('Permissions-Policy: geolocation=(), microphone=(), camera=()');
}
add_action('send_headers', 'tabaix_security_headers');

function tabaix_sanitize_search_query($query) {
  return sanitize_text_field(wp_unslash($query));
}
add_filter('get_search_query', 'tabaix_sanitize_search_query');
