<?php

if (!defined('ABSPATH')) {
  exit;
}

/**
 * Register Shortcodes for Dynamic Sections to use in Gutenberg Patterns
 */
function tabaix_register_section_shortcodes() {
    add_shortcode('tabaix_tools_grid', function() {
        ob_start();
        get_template_part('template-parts/sections/tools', 'grid');
        return ob_get_clean();
    });

    add_shortcode('tabaix_guides_grid', function() {
        ob_start();
        get_template_part('template-parts/sections/guides', 'grid');
        return ob_get_clean();
    });

    add_shortcode('tabaix_deals_carousel', function() {
        ob_start();
        get_template_part('template-parts/sections/deals', 'carousel');
        return ob_get_clean();
    });
}
add_action('init', 'tabaix_register_section_shortcodes');

/**
 * Register Gutenberg Block Patterns
 */
function tabaix_register_block_patterns() {
    if (function_exists('register_block_pattern_category')) {
        register_block_pattern_category(
            'tabaix-templates',
            array('label' => __('Tabaix Templates', 'tabaix'))
        );
    }

    if (function_exists('register_block_pattern')) {
        // Full Homepage Pattern
        register_block_pattern(
            'tabaix/homepage',
            array(
                'title'       => __('Tabaix Full Homepage', 'tabaix'),
                'description' => __('A complete homepage layout with Hero, Tools, Deals, and Guides.', 'tabaix'),
                'categories'  => array('tabaix-templates'),
                'content'     => '
<!-- wp:group {"align":"full","className":"hero-section","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull hero-section bg-gray-900 text-white py-24 text-center">
<!-- wp:heading {"textAlign":"center","level":1,"style":{"typography":{"fontSize":"4rem","fontWeight":"800"}}} -->
<h1 class="wp-block-heading has-text-align-center" style="font-size:4rem;font-weight:800">Free Tools, Honest Guides</h1>
<!-- /wp:heading -->
<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"1.5rem"}}} -->
<p class="has-text-align-center" style="font-size:1.5rem">100+ browser tools with zero tracking, plus insider knowledge about Saudi Arabia.</p>
<!-- /wp:paragraph -->
<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons"><!-- wp:button {"className":"is-style-fill"} -->
<div class="wp-block-button is-style-fill"><a class="wp-block-button__link wp-element-button" href="#tools">Browse Tools</a></div>
<!-- /wp:button -->
<!-- wp:button {"className":"is-style-outline"} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="#guides">Read Guides</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->
</div>
<!-- /wp:group -->

<!-- wp:shortcode -->
[tabaix_tools_grid]
<!-- /wp:shortcode -->

<!-- wp:shortcode -->
[tabaix_deals_carousel]
<!-- /wp:shortcode -->

<!-- wp:shortcode -->
[tabaix_guides_grid]
<!-- /wp:shortcode -->
                ',
            )
        );

        // Hero Pattern
        register_block_pattern(
            'tabaix/hero',
            array(
                'title'       => __('Tabaix Hero', 'tabaix'),
                'categories'  => array('tabaix-templates'),
                'content'     => '
<!-- wp:group {"align":"full","className":"hero-section","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull hero-section bg-gray-900 text-white py-24 text-center">
<!-- wp:heading {"textAlign":"center","level":1,"style":{"typography":{"fontSize":"4rem","fontWeight":"800"}}} -->
<h1 class="wp-block-heading has-text-align-center" style="font-size:4rem;font-weight:800">Your Epic Title Here</h1>
<!-- /wp:heading -->
<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"1.5rem"}}} -->
<p class="has-text-align-center" style="font-size:1.5rem">Your amazing subtitle goes here. Make it catchy.</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
                ',
            )
        );

        // Services Section Pattern
        register_block_pattern(
            'tabaix/services',
            array(
                'title'       => __('Services Section', 'tabaix'),
                'categories'  => array('tabaix-templates'),
                'content'     => '
<!-- wp:group {"align":"full","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="padding:4rem 0;background:#f8fafc;">
<!-- wp:columns -->
<div class="wp-block-columns"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:heading {"level":2} -->
<h2>Services designed for your brand</h2>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p>Quickly add service cards, pricing, and benefit statements with this editor-friendly section.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->
<!-- wp:columns -->
<div class="wp-block-columns"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"style":{"spacing":{"padding":{"top":"24px","right":"24px","bottom":"24px","left":"24px"}},"border":{"radius":"16px"},"backgroundColor":"white"}} -->
<div class="wp-block-group has-white-background-color has-background" style="border-radius:16px;padding:24px;"><!-- wp:heading {"level":3} -->
<h3>Service One</h3>
<!-- /wp:heading --><!-- wp:paragraph -->
<p>Highlight your first service with a strong value proposition.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column --><!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"style":{"spacing":{"padding":{"top":"24px","right":"24px","bottom":"24px","left":"24px"}},"border":{"radius":"16px"},"backgroundColor":"white"}} -->
<div class="wp-block-group has-white-background-color has-background" style="border-radius:16px;padding:24px;"><!-- wp:heading {"level":3} -->
<h3>Service Two</h3>
<!-- /wp:heading --><!-- wp:paragraph -->
<p>Show why customers choose you and what makes your work reliable.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column --><!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"style":{"spacing":{"padding":{"top":"24px","right":"24px","bottom":"24px","left":"24px"}},"border":{"radius":"16px"},"backgroundColor":"white"}} -->
<div class="wp-block-group has-white-background-color has-background" style="border-radius:16px;padding:24px;"><!-- wp:heading {"level":3} -->
<h3>Service Three</h3>
<!-- /wp:heading --><!-- wp:paragraph -->
<p>Add short descriptions and calls to action to each service card.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->
</div>
<!-- /wp:group -->
                ',
            )
        );

        // Blog Grid Pattern
        register_block_pattern(
            'tabaix/blog-grid',
            array(
                'title'       => __('Blog Grid', 'tabaix'),
                'categories'  => array('tabaix-templates'),
                'content'     => '
<!-- wp:group {"align":"full","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="padding:4rem 0;background:#ffffff;">
<!-- wp:heading {"textAlign":"center"} -->
<h2 class="has-text-align-center">Recent Articles</h2>
<!-- /wp:heading -->
<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center">Show your latest posts in a modern grid layout that is easy to customize.</p>
<!-- /wp:paragraph -->
<!-- wp:columns -->
<div class="wp-block-columns"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:image {"sizeSlug":"large"} -->
<figure class="wp-block-image size-large"><img src="https://via.placeholder.com/640x400" alt=""/></figure>
<!-- /wp:image --><!-- wp:heading {"level":3} -->
<h3>Article Title</h3>
<!-- /wp:heading --><!-- wp:paragraph -->
<p>Use this section to show a featured post teaser.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --><!-- wp:column -->
<div class="wp-block-column"><!-- wp:image {"sizeSlug":"large"} -->
<figure class="wp-block-image size-large"><img src="https://via.placeholder.com/640x400" alt=""/></figure>
<!-- /wp:image --><!-- wp:heading {"level":3} -->
<h3>Article Title</h3>
<!-- /wp:heading --><!-- wp:paragraph -->
<p>Use excerpt cards with a strong read more link.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --><!-- wp:column -->
<div class="wp-block-column"><!-- wp:image {"sizeSlug":"large"} -->
<figure class="wp-block-image size-large"><img src="https://via.placeholder.com/640x400" alt=""/></figure>
<!-- /wp:image --><!-- wp:heading {"level":3} -->
<h3>Article Title</h3>
<!-- /wp:heading --><!-- wp:paragraph -->
<p>Excellent for showcasing a mix of blog posts and news updates.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->
</div>
<!-- /wp:group -->
                ',
            )
        );

        // Blog Hero Pattern
        register_block_pattern(
            'tabaix/blog-hero',
            array(
                'title'       => __('Blog Post Hero', 'tabaix'),
                'description' => __('A bold hero section for blog and editorial posts.', 'tabaix'),
                'categories'  => array('tabaix-templates'),
                'content'     => '
<!-- wp:group {"align":"full","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="padding:5rem 0;background:linear-gradient(135deg,#2563eb,#16a34a);color:#fff;text-align:center;">
<!-- wp:heading {"level":1} -->
<h1>Blog Headline That Captures Attention</h1>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p>Use this section to introduce your article with a strong opening statement and key takeaway.</p>
<!-- /wp:paragraph -->
<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons"><!-- wp:button {"className":"is-style-fill"} -->
<div class="wp-block-button is-style-fill"><a class="wp-block-button__link">Read the story</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->
</div>
<!-- /wp:group -->
                ',
            )
        );

        // Blog Masonry Pattern
        register_block_pattern(
            'tabaix/blog-masonry',
            array(
                'title'       => __('Blog Masonry', 'tabaix'),
                'description' => __('A visual masonry-style blog layout.', 'tabaix'),
                'categories'  => array('tabaix-templates'),
                'content'     => '
<!-- wp:group {"align":"full","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="padding:4rem 0;background:#ffffff;">
<!-- wp:heading {"textAlign":"center"} -->
<h2 class="has-text-align-center">Masonry Blog Layout</h2>
<!-- /wp:heading -->
<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center">Responsive cards that flow like a masonry magazine feed.</p>
<!-- /wp:paragraph -->
<!-- wp:columns -->
<div class="wp-block-columns is-layout-flex"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"style":{"spacing":{"padding":{"top":"24px","right":"24px","bottom":"24px","left":"24px"}},"backgroundColor":"vivid-cyan-blue"}} -->
<div class="wp-block-group has-vivid-cyan-blue-background-color has-background" style="padding:24px;"><!-- wp:heading {"level":3} -->
<h3>Featured Post</h3>
<!-- /wp:heading --></div>
<!-- /wp:group --></div>
<!-- /wp:column --><!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"style":{"spacing":{"padding":{"top":"24px","right":"24px","bottom":"24px","left":"24px"}},"backgroundColor":"white"}} -->
<div class="wp-block-group has-white-background-color has-background" style="padding:24px;"><!-- wp:heading {"level":3} -->
<h3>Story Card</h3>
<!-- /wp:heading --></div>
<!-- /wp:group --></div>
<!-- /wp:column --><!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"style":{"spacing":{"padding":{"top":"24px","right":"24px","bottom":"24px","left":"24px"}},"backgroundColor":"white"}} -->
<div class="wp-block-group has-white-background-color has-background" style="padding:24px;"><!-- wp:heading {"level":3} -->
<h3>Story Card</h3>
<!-- /wp:heading --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->
</div>
<!-- /wp:group -->
                ',
            )
        );

        // Homepage Starter Pattern
        register_block_pattern(
            'tabaix/homepage-starter',
            array(
                'title'       => __('Homepage Starter', 'tabaix'),
                'description' => __('A quick homepage starter layout with hero, features, and CTA.', 'tabaix'),
                'categories'  => array('tabaix-templates'),
                'content'     => '
<!-- wp:group {"align":"full","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="padding:5rem 0;background:#f8fafc;">
<!-- wp:heading {"textAlign":"center"} -->
<h2 class="has-text-align-center">Homepage Starter</h2>
<!-- /wp:heading -->
<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center">A ready-to-edit homepage section set for quick launch.</p>
<!-- /wp:paragraph -->
<!-- wp:columns -->
<div class="wp-block-columns"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:heading {"level":3} -->
<h3>Hero Section</h3>
<!-- /wp:heading --></div>
<!-- /wp:column --><!-- wp:column -->
<div class="wp-block-column"><!-- wp:heading {"level":3} -->
<h3>Feature Blocks</h3>
<!-- /wp:heading --></div>
<!-- /wp:column --><!-- wp:column -->
<div class="wp-block-column"><!-- wp:heading {"level":3} -->
<h3>Call to Action</h3>
<!-- /wp:heading --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->
</div>
<!-- /wp:group -->
                ',
            )
        );

        // Landing Starter Pattern
        register_block_pattern(
            'tabaix/landing-starter',
            array(
                'title'       => __('Landing Starter', 'tabaix'),
                'description' => __('A landing page starter with hero, benefits, and lead capture.', 'tabaix'),
                'categories'  => array('tabaix-templates'),
                'content'     => '
<!-- wp:group {"align":"full","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="padding:5rem 0;background:#ffffff;">
<!-- wp:heading {"textAlign":"center"} -->
<h2 class="has-text-align-center">Landing Page Starter</h2>
<!-- /wp:heading -->
<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center">Ideal for a marketing landing page with conversion-focused sections.</p>
<!-- /wp:paragraph -->
<!-- wp:columns -->
<div class="wp-block-columns"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"backgroundColor":"vivid-cyan-blue","style":{"spacing":{"padding":{"top":"24px","right":"24px","bottom":"24px","left":"24px"}}}} -->
<div class="wp-block-group has-vivid-cyan-blue-background-color has-background" style="padding:24px;"><!-- wp:heading {"level":3} -->
<h3>Lead Capture</h3>
<!-- /wp:heading --></div>
<!-- /wp:group --></div>
<!-- /wp:column --><!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"backgroundColor":"white","style":{"spacing":{"padding":{"top":"24px","right":"24px","bottom":"24px","left":"24px"}}}} -->
<div class="wp-block-group has-white-background-color has-background" style="padding:24px;"><!-- wp:heading {"level":3} -->
<h3>Benefits</h3>
<!-- /wp:heading --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->
</div>
<!-- /wp:group -->
                ',
            )
        );

        // Blog List Pattern
        register_block_pattern(
            'tabaix/blog-list',
            array(
                'title'       => __('Blog List', 'tabaix'),
                'categories'  => array('tabaix-templates'),
                'content'     => '
<!-- wp:group {"align":"full","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="padding:4rem 0;background:#ffffff;">
<!-- wp:heading {"textAlign":"center"} -->
<h2 class="has-text-align-center">Latest News</h2>
<!-- /wp:heading -->
<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center">List your most recent posts in a clean editorial feed with bold headlines and clear calls to action.</p>
<!-- /wp:paragraph -->
<!-- wp:group {"className":"blog-list-card","style":{"spacing":{"padding":{"top":"24px","right":"24px","bottom":"24px","left":"24px"}},"backgroundColor":"white"}} -->
<div class="wp-block-group has-white-background-color has-background" style="padding:24px;"><!-- wp:heading {"level":3} -->
<h3>Post Title Here</h3>
<!-- /wp:heading --><!-- wp:paragraph -->
<p>Short summary to draw readers in and encourage them to click through.</p>
<!-- /wp:paragraph --><!-- wp:button {"className":"is-style-outline"} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link">Read More</a></div>
<!-- /wp:button --></div>
<!-- /wp:group -->
</div>
<!-- /wp:group -->
                ',
            )
        );

        // Magazine Pattern
        register_block_pattern(
            'tabaix/magazine-alt',
            array(
                'title'       => __('Magazine Style Blog', 'tabaix'),
                'categories'  => array('tabaix-templates'),
                'content'     => '
<!-- wp:group {"align":"full","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="padding:4rem 0;background:#f8fafc;">
<!-- wp:heading {"textAlign":"center"} -->
<h2 class="has-text-align-center">Magazine Stories</h2>
<!-- /wp:heading -->
<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center">Create an editorial-style story layout with featured posts and supporting articles.</p>
<!-- /wp:paragraph -->
<!-- wp:columns -->
<div class="wp-block-columns"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:image {"sizeSlug":"large"} -->
<figure class="wp-block-image size-large"><img src="https://via.placeholder.com/700x420" alt=""/></figure>
<!-- /wp:image --><!-- wp:heading {"level":3} -->
<h3>Featured Story</h3>
<!-- /wp:heading --><!-- wp:paragraph -->
<p>Use this hero section to promote your most important update.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --><!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"style":{"spacing":{"padding":{"top":"24px","right":"24px","bottom":"24px","left":"24px"}},"backgroundColor":"white"}} -->
<div class="wp-block-group has-white-background-color has-background" style="padding:24px;"><!-- wp:heading {"level":3} -->
<h3>Supporting Story</h3>
<!-- /wp:heading --><!-- wp:paragraph -->
<p>Highlight additional articles with clear image cards.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->
</div>
<!-- /wp:group -->
                ',
            )
        );

        // Contact Section Pattern
        register_block_pattern(
            'tabaix/contact',
            array(
                'title'       => __('Contact Section', 'tabaix'),
                'categories'  => array('tabaix-templates'),
                'content'     => '
<!-- wp:group {"align":"full","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="padding:4rem 0;background:#f8fafc;">
<!-- wp:columns -->
<div class="wp-block-columns"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:heading {"level":2} -->
<h2>Contact Us</h2>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p>Place your contact form or contact details in a clean, professional layout.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --><!-- wp:column -->
<div class="wp-block-column"><!-- wp:paragraph -->
<p><strong>Email:</strong> hello@example.com</p>
<p><strong>Phone:</strong> +1 234 567 890</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->
                ',
            )
        );

        // Portfolio Section Pattern
        register_block_pattern(
            'tabaix/portfolio',
            array(
                'title'       => __('Portfolio Grid', 'tabaix'),
                'categories'  => array('tabaix-templates'),
                'content'     => '
<!-- wp:group {"align":"full","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="padding:4rem 0;background:#ffffff;">
<!-- wp:heading {"textAlign":"center"} -->
<h2 class="has-text-align-center">Portfolio Showcase</h2>
<!-- /wp:heading -->
<!-- wp:columns -->
<div class="wp-block-columns"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:image {"sizeSlug":"large"} -->
<figure class="wp-block-image size-large"><img src="https://via.placeholder.com/640x420" alt=""/></figure>
<!-- /wp:image --><!-- wp:heading {"level":3} -->
<h3>Project One</h3>
<!-- /wp:heading --></div>
<!-- /wp:column --><!-- wp:column -->
<div class="wp-block-column"><!-- wp:image {"sizeSlug":"large"} -->
<figure class="wp-block-image size-large"><img src="https://via.placeholder.com/640x420" alt=""/></figure>
<!-- /wp:image --><!-- wp:heading {"level":3} -->
<h3>Project Two</h3>
<!-- /wp:heading --></div>
<!-- /wp:column --><!-- wp:column -->
<div class="wp-block-column"><!-- wp:image {"sizeSlug":"large"} -->
<figure class="wp-block-image size-large"><img src="https://via.placeholder.com/640x420" alt=""/></figure>
<!-- /wp:image --><!-- wp:heading {"level":3} -->
<h3>Project Three</h3>
<!-- /wp:heading --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->
                ',
            )
        );

        // Testimonials Pattern
        register_block_pattern(
            'tabaix/testimonials',
            array(
                'title'       => __('Testimonials', 'tabaix'),
                'categories'  => array('tabaix-templates'),
                'content'     => '
<!-- wp:group {"align":"full","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="padding:4rem 0;background:#f8fafc;">
<!-- wp:heading {"textAlign":"center"} -->
<h2 class="has-text-align-center">What customers say</h2>
<!-- /wp:heading -->
<!-- wp:columns -->
<div class="wp-block-columns"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:quote -->
<blockquote><p>"Amazing design and easy editing. This layout helped us launch fast."</p></blockquote>
<!-- /wp:quote --></div>
<!-- /wp:column --><!-- wp:column -->
<div class="wp-block-column"><!-- wp:quote -->
<blockquote><p>"The section looks polished and loads quickly on mobile."</p></blockquote>
<!-- /wp:quote --></div>
<!-- /wp:column --><!-- wp:column -->
<div class="wp-block-column"><!-- wp:quote -->
<blockquote><p>"Perfect for showcasing testimonials in a clean editorial style."</p></blockquote>
<!-- /wp:quote --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->
                ',
            )
        );

        // Product Spotlight Pattern
        register_block_pattern(
            'tabaix/product-spotlight',
            array(
                'title'       => __('Product Spotlight', 'tabaix'),
                'categories'  => array('tabaix-templates'),
                'content'     => '
<!-- wp:group {"align":"full","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="padding:4rem 0;background:#ffffff;">
<!-- wp:columns -->
<div class="wp-block-columns"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:heading {"level":2} -->
<h2>A featured product section</h2>
<!-- /wp:heading --><!-- wp:paragraph -->
<p>Promote your product with a clear headline, benefits list, and call to action.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --><!-- wp:column -->
<div class="wp-block-column"><!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"className":"is-style-fill"} -->
<div class="wp-block-button is-style-fill"><a class="wp-block-button__link">Buy Now</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->
                ',
            )
        );

        // Split Hero Pattern
        register_block_pattern(
            'tabaix/split-hero',
            array(
                'title'       => __('Split Screen Hero', 'tabaix'),
                'categories'  => array('tabaix-templates'),
                'content'     => '
<!-- wp:group {"align":"full","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="display:grid;grid-template-columns:1fr 1fr;gap:0;min-height:500px;">
<!-- wp:group {"style":{"spacing":{"padding":{"top":"60px","right":"40px","bottom":"60px","left":"40px"}},"backgroundColor":"vivid-cyan-blue"}} -->
<div class="wp-block-group has-vivid-cyan-blue-background-color has-background" style="padding:60px 40px;"><!-- wp:heading {"level":1} -->
<h1>Strong split-screen hero</h1>
<!-- /wp:heading --><!-- wp:paragraph -->
<p>Pair a bold statement with a supporting image or feature list in this editorial layout.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --><!-- wp:group {"style":{"spacing":{"padding":{"top":"60px","right":"40px","bottom":"60px","left":"40px"}},"backgroundColor":"white"}} -->
<div class="wp-block-group has-white-background-color has-background" style="padding:60px 40px;"><!-- wp:image {"sizeSlug":"large"} -->
<figure class="wp-block-image size-large"><img src="https://via.placeholder.com/700x520" alt=""/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
                ',
            )
        );

        // Landing Alternative Pattern
        register_block_pattern(
            'tabaix/landing-alternative',
            array(
                'title'       => __('Alternative Landing Page', 'tabaix'),
                'categories'  => array('tabaix-templates'),
                'content'     => '
<!-- wp:group {"align":"full","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="padding:4rem 0;background:#f8fafc;">
<!-- wp:heading {"textAlign":"center"} -->
<h2 class="has-text-align-center">Launch your campaign with a bright landing page</h2>
<!-- /wp:heading -->
<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center">This pattern gives you a quick hero plus benefit sections in one editable layout.</p>
<!-- /wp:paragraph -->
<!-- wp:columns -->
<div class="wp-block-columns"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:heading {"level":3} -->
<h3>Fast launch</h3>
<!-- /wp:heading --></div>
<!-- /wp:column --><!-- wp:column -->
<div class="wp-block-column"><!-- wp:heading {"level":3} -->
<h3>Fully editable</h3>
<!-- /wp:heading --></div>
<!-- /wp:column --><!-- wp:column -->
<div class="wp-block-column"><!-- wp:heading {"level":3} -->
<h3>Built for conversion</h3>
<!-- /wp:heading --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->
                ',
            )
        );
    }
}
add_action('init', 'tabaix_register_block_patterns');
