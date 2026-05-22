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

function tabaix_defer_parsing_of_js($url) {
    if (is_admin() || false === strpos($url, '.js')) {
        return $url;
    }
    // Do not defer jQuery to avoid breaking inline scripts
    if (strpos($url, 'jquery.js') || strpos($url, 'jquery.min.js')) {
        return $url;
    }
    return str_replace(' src', ' defer="defer" src', $url);
}
add_filter('script_loader_tag', 'tabaix_defer_parsing_of_js', 10);

function tabaix_preload_fonts() {
    // Add preloads for fonts or critical assets here
    echo '<link rel="preconnect" href="https://fonts.googleapis.com">';
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>';
}
add_action('wp_head', 'tabaix_preload_fonts', 2);
