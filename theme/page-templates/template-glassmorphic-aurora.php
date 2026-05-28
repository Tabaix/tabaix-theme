<?php
/*
Template Name: Glassmorphic Aurora
Description: Full-screen glassmorphic landing page design for Tabaix.
*/
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo esc_html(get_the_title() ?: 'Tabaix — Glassmorphic Aurora'); ?></title>
  <meta name="description" content="<?php echo esc_attr(get_the_excerpt() ?: '100 free browser tools. Zero server cost. Privacy first. Built by Tayyab Ali in Riyadh.'); ?>">
  <?php wp_head(); ?>
</head>
<body <?php body_class('glassmorphic-aurora-page'); ?>>
<?php wp_body_open(); ?>
<?php
$glass_hero_headline = get_post_meta(get_the_ID(), 'glass_hero_headline', true) ?: 'TABAHI BEYOND X';
$glass_hero_subtitle = get_post_meta(get_the_ID(), 'glass_hero_subtitle', true) ?: '100 free browser tools for images, PDF, video, dev, SEO and more. Zero uploads. Zero server. Your files never leave your device.';
$glass_cta_primary_label = get_post_meta(get_the_ID(), 'glass_cta_primary_label', true) ?: 'Explore 100 Tools ↗';
$glass_cta_primary_url = get_post_meta(get_the_ID(), 'glass_cta_primary_url', true) ?: '#tools';
$glass_cta_secondary_label = get_post_meta(get_the_ID(), 'glass_cta_secondary_label', true) ?: 'Read the Blog';
$glass_cta_secondary_url = get_post_meta(get_the_ID(), 'glass_cta_secondary_url', true) ?: '#blog';
$glass_tools_section_title = get_post_meta(get_the_ID(), 'glass_tools_section_title', true) ?: '100 Tools. Zero Cost. Maximum Privacy.';
$glass_tools_section_subtitle = get_post_meta(get_the_ID(), 'glass_tools_section_subtitle', true) ?: 'The best browser-based tools for images, SEO, PDF, video and dev—designed for speed and growth.';
$glass_blog_section_title = get_post_meta(get_the_ID(), 'glass_blog_section_title', true) ?: 'Truth from Riyadh.';
$glass_blog_section_subtitle = get_post_meta(get_the_ID(), 'glass_blog_section_subtitle', true) ?: 'Real stories, tool guides, and growth strategy from the Tabaix team.';
?>
<div class="aurora"><div class="a1"></div><div class="a2"></div><div class="a3"></div></div>
<div id="c"></div><div id="cr"></div>

<nav>
  <div class="nav-inner">
    <a href="/" class="nl">TABAIX</a>
    <ul class="ns"><li><a href="#tools">Tools</a></li><li><a href="#blog">Blog</a></li><li><a href="#about">About</a></li></ul>
    <a href="#tools" class="nc">Open Tools ↗</a>
  </div>
</nav>

<main id="primary" class="site-main glassmorphic-content">
  <section class="hero">
    <div class="hero-badge">📍 Built in Riyadh, Saudi Arabia</div>
    <h1 class="h-title">
      <?php
      $headline_parts = explode(' ', $glass_hero_headline);
      $first = array_shift($headline_parts);
      $remaining = implode(' ', $headline_parts);
      ?>
      <span class="l1"><?php echo esc_html($first); ?></span>
      <span class="l2"><?php echo esc_html($remaining); ?></span>
      <span class="l3">FREE FOREVER</span>
    </h1>
    <p class="h-sub"><?php echo wp_kses_post($glass_hero_subtitle); ?></p>
    <div class="h-ctas">
      <a href="<?php echo esc_url($glass_cta_primary_url); ?>" class="btn-g"><?php echo esc_html($glass_cta_primary_label); ?></a>
      <a href="<?php echo esc_url($glass_cta_secondary_url); ?>" class="btn-gh"><?php echo esc_html($glass_cta_secondary_label); ?></a>
      <a href="/tools" class="btn-gh">All Tools Library</a>
    </div>
    <div class="stats-row">
      <div class="stat-cell"><div class="stat-n" data-t="100">0</div><div class="stat-l">Free Tools</div></div>
      <div class="stat-cell"><div class="stat-n" data-t="10">0</div><div class="stat-l">Subdomains</div></div>
      <div class="stat-cell"><div class="stat-n" data-t="5">0</div><div class="stat-l">Income Streams</div></div>
      <div class="stat-cell"><div class="stat-n">$0</div><div class="stat-l">Server Cost</div></div>
    </div>
  </section>

  <section class="ts" id="tools">
    <div class="text-center rv"><div class="section-pill">⚡ The Arsenal</div><h2 class="st"><?php echo wp_kses_post($glass_tools_section_title); ?></h2><p class="h-sub" style="margin-top: 1rem; max-width: 720px; margin-left: auto; margin-right: auto; color: rgba(240,240,255,.7);"><?php echo wp_kses_post($glass_tools_section_subtitle); ?></p></div>
    <div class="cat-glass rv">
      <button class="cg-tab act">All 100</button>
      <button class="cg-tab">🖼 Image</button>
      <button class="cg-tab">📄 PDF</button>
      <button class="cg-tab">⚙️ Dev</button>
      <button class="cg-tab">📊 SEO</button>
      <button class="cg-tab">🎬 Video</button>
      <button class="cg-tab">🔒 Security</button>
      <button class="cg-tab">🔤 Text</button>
      <button class="cg-tab">🎵 Audio</button>
      <button class="cg-tab">📐 Calc</button>
      <button class="cg-tab">🎨 Design</button>
    </div>
    <div class="tg rv">
      <?php
      $tool_query = new WP_Query(array(
        'post_type' => 'tool',
        'posts_per_page' => 16,
        'orderby' => 'meta_value_num',
        'meta_key' => 'usage_count',
        'order' => 'DESC',
      ));
      if ($tool_query->have_posts()) :
        while ($tool_query->have_posts()) : $tool_query->the_post();
          $tool_icon = get_post_meta(get_the_ID(), 'tool_icon', true);
          $tool_featured = get_post_meta(get_the_ID(), 'featured', true);
          $tool_excerpt = wp_trim_words(get_the_excerpt(), 20, '...');
          $tool_url = get_the_permalink();
      ?>
        <a href="<?php echo esc_url($tool_url); ?>" class="tc <?php echo $tool_featured ? 'feat' : ''; ?>">
          <div class="tc-glow"></div>
          <?php if ($tool_featured) : ?><div class="tc-badge hot"><?php esc_html_e('🔥 Most Popular', 'tabaix'); ?></div><?php endif; ?>
          <div class="tc-icon"><?php echo esc_html($tool_icon ?: '⚙️'); ?></div>
          <div class="tc-n"><?php the_title(); ?></div>
          <div class="tc-d"><?php echo esc_html($tool_excerpt ?: get_the_title()); ?></div>
          <div class="tc-sub"><?php echo esc_html(get_post_type_archive_link('tool') ? 'tabaix.com/tools' : 'tabaix.com/tools'); ?></div>
        </a>
      <?php
        endwhile;
        wp_reset_postdata();
      else :
      ?>
        <div class="tc"><div class="tc-n"><?php esc_html_e('No tools are available yet. Add tool posts to display them here.', 'tabaix'); ?></div></div>
      <?php endif; ?>
    </div>
    <div class="text-center" style="margin-top:2.5rem"><a href="/tools" class="btn-gh">View All 100 Tools →</a></div>
  </section>

  <section class="bs" id="blog">
    <div class="text-center rv"><div class="section-pill">✍️ The Blog</div><h2 class="st"><?php echo wp_kses_post($glass_blog_section_title); ?></h2><p class="h-sub" style="margin-top: 1rem; max-width: 720px; margin-left: auto; margin-right: auto; color: rgba(240,240,255,.7);"><?php echo wp_kses_post($glass_blog_section_subtitle); ?></p></div>
    <div class="blog-glass-grid rv">
      <?php
      $blog_query = new WP_Query(array(
        'posts_per_page' => 4,
        'post_status' => 'publish',
      ));
      if ($blog_query->have_posts()) :
        $count = 0;
      ?>
        <?php while ($blog_query->have_posts()) : $blog_query->the_post(); $count++; ?>
          <?php if ($count === 1) : ?>
            <a href="<?php the_permalink(); ?>" class="bc feat">
              <div class="b-tag"><?php echo esc_html(get_the_category_list(', ') ?: __('Featured', 'tabaix')); ?></div>
              <h2 class="b-title"><?php the_title(); ?></h2>
              <div class="b-meta"><?php echo esc_html(get_the_author() . ' · ' . get_the_date('M Y') . ' · ' . get_post_meta(get_the_ID(), 'reading_time', true) ?: '5 min read'); ?></div>
              <div class="b-num">01</div>
            </a>
            <div class="bc-side">
          <?php else : ?>
            <a href="<?php the_permalink(); ?>" class="bc-sm">
              <div class="b-tag"><?php echo esc_html(get_the_category_list(', ') ?: __('Blog', 'tabaix')); ?></div>
              <div class="b-title"><?php the_title(); ?></div>
              <div class="b-meta"><?php echo esc_html(get_the_date('M j, Y')); ?></div>
              <div class="b-num"><?php echo esc_html(sprintf('%02d', $count)); ?></div>
            </a>
          <?php endif; ?>
        <?php endwhile; ?>
            </div>
        <?php wp_reset_postdata(); ?>
      <?php else : ?>
        <div class="bc" style="padding:3rem;">
          <h2 class="b-title"><?php esc_html_e('No blog posts found yet.', 'tabaix'); ?></h2>
          <p class="b-meta"><?php esc_html_e('Publish posts to show the latest articles here.', 'tabaix'); ?></p>
        </div>
      <?php endif; ?>
    </div>
  </section>

  <footer>
    <div class="fg">
      <div><div class="fl">TABAIX</div><p class="fdesc">100 free browser tools. Zero server cost. Privacy first. Built by Tayyab Ali in Riyadh, Saudi Arabia.</p></div>
      <div><div class="fh">Tools</div><ul class="fli"><li><a href="#">Image Tools</a></li><li><a href="#">PDF Tools</a></li><li><a href="#">Dev Tools</a></li><li><a href="/tools">All 100 Tools</a></li></ul></div>
      <div><div class="fh">Blog</div><ul class="fli"><li><a href="#">Expat Life</a></li><li><a href="#">Money</a></li><li><a href="#">Technology</a></li><li><a href="#">Reviews</a></li></ul></div>
      <div><div class="fh">Legal</div><ul class="fli"><li><a href="/privacy">Privacy Policy</a></li><li><a href="/terms">Terms</a></li><li><a href="/disclaimer">Disclaimer</a></li><li><a href="/contact">Contact</a></li></ul></div>
    </div>
    <div class="fb"><p>© 2026 Tabaix.com — Tayyab Ali, Riyadh, Saudi Arabia</p><div class="fb-l"><a href="/privacy">Privacy</a><a href="/terms">Terms</a><a href="/contact">Contact</a></div></div>
  </footer>
</main>

<?php wp_footer(); ?>
</body>
</html>
