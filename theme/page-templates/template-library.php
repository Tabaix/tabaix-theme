<?php
/*
Template Name: Template Library
*/
get_header(); ?>

<main class="site-main template-library-template" style="background: var(--color-bg-primary); padding: 80px 0;">
  <div class="container" style="max-width: 1140px; margin: 0 auto; display: grid; gap: 40px;">
    <header style="text-align: center;">
      <p style="text-transform: uppercase; letter-spacing: 0.22em; color: var(--color-secondary); margin-bottom: 1rem; font-weight: 700;">Template Library</p>
      <h1 style="font-size: 3rem; color: var(--color-text-primary); margin-bottom: 1rem;">Browse your theme templates and editor sections</h1>
      <p style="color: var(--color-text-secondary); font-size: 1.05rem; line-height: 1.8; max-width: 760px; margin: 0 auto;">Use this page as a visual guide to the built-in templates and Gutenberg starter patterns available in the Tabaix theme.</p>
    </header>

    <style>
      .template-library-template .library-grid {
        display: grid;
        gap: 22px;
      }
      .template-library-template .library-card {
        background: var(--color-bg-elevated);
        border: 1px solid var(--color-border-primary);
        border-radius: var(--radius-val, 1rem);
        padding: 24px;
        transition: transform 0.25s ease, box-shadow 0.25s ease;
      }
      .template-library-template .library-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 18px 35px rgba(15, 23, 42, 0.08);
      }
      .template-library-template .library-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(37, 99, 235, 0.1);
        color: var(--color-primary);
        padding: 6px 12px;
        border-radius: 999px;
        font-size: 0.8rem;
        font-weight: 700;
        margin-bottom: 16px;
      }
    </style>

    <section>
      <h2 style="font-size: 2rem; color: var(--color-text-primary); margin-bottom: 1rem;">Page Templates</h2>
      <div class="library-grid" style="grid-template-columns: repeat(auto-fit,minmax(250px,1fr));">
        <?php
        $templates = get_page_templates();
        foreach ($templates as $template_name => $template_file) : ?>
          <div class="library-card">
            <div class="library-badge"><?php echo esc_html__('Page Template', 'tabaix'); ?></div>
            <h3 style="margin-top: 0; color: var(--color-text-primary);"><?php echo esc_html($template_name); ?></h3>
            <p style="color: var(--color-text-secondary); line-height: 1.75;">Template file: <code><?php echo esc_html($template_file); ?></code></p>
            <p style="margin-bottom: 0; color: var(--color-text-secondary);">Select this template under Page Attributes when editing a page.</p>
          </div>
        <?php endforeach; ?>
      </div>
    </section>

    <section style="padding-top: 40px;">
      <h2 style="font-size: 2rem; color: var(--color-text-primary); margin-bottom: 1rem;">Editor Patterns</h2>
      <p style="color: var(--color-text-secondary); line-height: 1.75; max-width: 800px; margin-bottom: 1.5rem;">These starter layouts are available in the Gutenberg block inserter under the "Tabaix Templates" category after activating the theme.</p>
      <div class="library-grid" style="grid-template-columns: repeat(auto-fit,minmax(260px,1fr));">
        <?php
        $tabaix_patterns = array();
        if (class_exists('WP_Block_Patterns_Registry')) {
            $registry = WP_Block_Patterns_Registry::get_instance();
            $all_patterns = $registry->get_all_registered();
            foreach ($all_patterns as $pattern_name => $pattern_data) {
                if (! empty($pattern_data['categories']) && in_array('tabaix-templates', $pattern_data['categories'], true)) {
                    $tabaix_patterns[] = array(
                        'title'       => isset($pattern_data['title']) ? $pattern_data['title'] : $pattern_name,
                        'description' => isset($pattern_data['description']) ? $pattern_data['description'] : __('Block pattern from Tabaix theme', 'tabaix'),
                    );
                }
            }
        }

        if (empty($tabaix_patterns)) {
            $tabaix_patterns = array(
                array('title' => __('Full Homepage', 'tabaix'), 'description' => __('A complete homepage layout with hero, cards, and featured sections.', 'tabaix')),
                array('title' => __('Tabaix Hero', 'tabaix'), 'description' => __('A bold hero section for home and landing pages.', 'tabaix')),
                array('title' => __('Services Section', 'tabaix'), 'description' => __('Three-card service section for business websites.', 'tabaix')),
                array('title' => __('Blog Grid', 'tabaix'), 'description' => __('A responsive blog teaser grid with featured posts.', 'tabaix')),
                array('title' => __('Blog List', 'tabaix'), 'description' => __('A clean blog list layout with cards for excerpts.', 'tabaix')),
                array('title' => __('Blog Masonry', 'tabaix'), 'description' => __('A masonry-style blog layout for editorial collections.', 'tabaix')),
                array('title' => __('Blog Post Hero', 'tabaix'), 'description' => __('A strong hero section for blog and article pages.', 'tabaix')),
                array('title' => __('Magazine Style Blog', 'tabaix'), 'description' => __('An editorial layout perfect for magazine-style blogs.', 'tabaix')),
                array('title' => __('Landing Page Starter', 'tabaix'), 'description' => __('A conversion-focused landing page starter section.', 'tabaix')),
                array('title' => __('Homepage Starter', 'tabaix'), 'description' => __('A quick homepage starter layout with hero and feature cards.', 'tabaix')),
                array('title' => __('Contact Section', 'tabaix'), 'description' => __('A contact section with email and phone details.', 'tabaix')),
                array('title' => __('Portfolio Grid', 'tabaix'), 'description' => __('A polished portfolio grid section for projects.', 'tabaix')),
                array('title' => __('Testimonials', 'tabaix'), 'description' => __('A testimonial section for customer quotes.', 'tabaix')),
                array('title' => __('Product Spotlight', 'tabaix'), 'description' => __('A featured product section with CTA.', 'tabaix')),
                array('title' => __('Split Screen Hero', 'tabaix'), 'description' => __('A dramatic split-screen hero layout.', 'tabaix')),
                array('title' => __('Alternative Landing Page', 'tabaix'), 'description' => __('An alternate landing page pattern for campaigns.', 'tabaix')),
            );
        }

        foreach ($tabaix_patterns as $pattern) : ?>
          <div class="library-card">
            <div class="library-badge"><?php echo esc_html__('Block Pattern', 'tabaix'); ?></div>
            <h3 style="margin-top: 0; color: var(--color-text-primary);"><?php echo esc_html($pattern['title']); ?></h3>
            <p style="color: var(--color-text-secondary); line-height: 1.75; margin-bottom: 0.75rem;"><?php echo esc_html($pattern['description']); ?></p>
            <p style="color: var(--color-text-secondary); font-size: 0.95rem; margin-bottom: 0;">Insert via the block inserter under <strong>Tabaix Templates</strong>.</p>
          </div>
        <?php endforeach; ?>
      </div>
    </section>

    <section style="padding-top: 40px;">
      <?php while (have_posts()) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class('template-library-content'); ?> style="background: var(--color-bg-elevated); border: 1px solid var(--color-border-primary); border-radius: var(--radius-val, 1rem); padding: 40px;">
          <?php the_content(); ?>
        </article>
      <?php endwhile; ?>
    </section>
  </div>
</main>

<?php get_footer(); ?>