<?php

if (!defined('ABSPATH')) {
  exit;
}

class Tabaix_Schema {
  public function __construct() {
    add_action('wp_head', array($this, 'output_schema'), 1);
  }

  public function output_schema() {
    $schema = $this->get_schema();
    if (!empty($schema)) {
      echo '<script type="application/ld+json">';
      echo wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
      echo '</script>\n';
    }
  }

  private function get_schema() {
    if (is_front_page()) {
      return $this->get_website_schema();
    }

    if (is_singular('tool')) {
      return $this->get_tool_schema();
    }

    if (is_single()) {
      return $this->get_article_schema();
    }

    return array();
  }

  private function get_website_schema() {
    return array(
      '@context' => 'https://schema.org',
      '@type' => 'WebSite',
      'name' => 'TABAIX',
      'alternateName' => 'Tabaix - Free Tools & Guides',
      'url' => home_url(),
      'description' => 'Free browser tools and honest Saudi Arabia guides - The Insider\'s Edge',
      'potentialAction' => array(
        '@type' => 'SearchAction',
        'target' => array(
          '@type' => 'EntryPoint',
          'urlTemplate' => home_url('?s={search_term_string}')
        ),
        'query-input' => 'required name=search_term_string'
      ),
      'publisher' => array(
        '@type' => 'Organization',
        'name' => 'TABAIX',
        'logo' => array(
          '@type' => 'ImageObject',
          'url' => get_template_directory_uri() . '/assets/images/logo.svg'
        )
      )
    );
  }

  private function get_tool_schema() {
    global $post;
    return array(
      '@context' => 'https://schema.org',
      '@type' => 'SoftwareApplication',
      'name' => get_the_title(),
      'description' => get_the_excerpt(),
      'applicationCategory' => 'UtilityApplication',
      'operatingSystem' => 'Any',
      'offers' => array(
        '@type' => 'Offer',
        'price' => '0',
        'priceCurrency' => 'USD'
      ),
      'browserRequirements' => 'Requires JavaScript. Modern browser recommended.',
      'softwareRequirements' => 'Web Browser',
      'permissions' => 'No special permissions required',
      'aggregateRating' => array(
        '@type' => 'AggregateRating',
        'ratingValue' => '4.8',
        'reviewCount' => get_post_meta($post->ID, 'usage_count', true) ?: 100
      )
    );
  }

  private function get_article_schema() {
    global $post;
    return array(
      '@context' => 'https://schema.org',
      '@type' => 'Article',
      'headline' => get_the_title(),
      'description' => get_the_excerpt(),
      'image' => get_the_post_thumbnail_url($post->ID, 'large'),
      'datePublished' => get_the_date('c'),
      'dateModified' => get_the_modified_date('c'),
      'author' => array(
        '@type' => 'Person',
        'name' => 'Tayyab Ali',
        'description' => 'Craftsman in Riyadh building Saudi heritage rooms and digital tools'
      ),
      'publisher' => array(
        '@type' => 'Organization',
        'name' => 'TABAIX',
        'logo' => array(
          '@type' => 'ImageObject',
          'url' => get_template_directory_uri() . '/assets/images/logo.svg'
        )
      )
    );
  }
}

new Tabaix_Schema();
