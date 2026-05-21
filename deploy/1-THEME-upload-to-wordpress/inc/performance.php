<?php

if (!defined('ABSPATH')) {
  exit;
}

function tabaix_inline_critical_css() {
  $critical_css_path = get_template_directory() . '/assets/css/critical.css';
  if (!file_exists($critical_css_path)) {
    return;
  }

  $critical_css = file_get_contents($critical_css_path);
  if ($critical_css) {
    echo '<style id="critical-css">' . $critical_css . '</style>\n';
  }
}
add_action('wp_head', 'tabaix_inline_critical_css', 1);
