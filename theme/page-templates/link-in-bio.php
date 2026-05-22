<?php
/**
 * Template Name: Link in Bio (Mobile Optimized)
 * Description: A distraction-free, mobile-first template perfect for Instagram, TikTok, and Twitter link-in-bio pages.
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <?php wp_head(); ?>
  <style>
    body.template-link-in-bio {
      background: linear-gradient(135deg, var(--color-bg-secondary), var(--color-bg-primary));
      min-height: 100vh;
      display: flex;
      justify-content: center;
      padding: 40px 20px;
    }
    .lib-container {
      width: 100%;
      max-width: 480px;
      text-align: center;
    }
    .lib-avatar {
      width: 100px;
      height: 100px;
      border-radius: 50%;
      object-fit: cover;
      margin: 0 auto 20px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.1);
      border: 3px solid #fff;
    }
    .lib-title {
      font-size: 24px;
      font-weight: 800;
      margin-bottom: 10px;
      color: var(--color-text-primary);
    }
    .lib-bio {
      color: var(--color-text-secondary);
      font-size: 15px;
      margin-bottom: 30px;
    }
    .lib-links {
      display: flex;
      flex-direction: column;
      gap: 15px;
    }
    .lib-btn {
      display: block;
      width: 100%;
      padding: 16px 24px;
      background: rgba(255,255,255,0.8);
      backdrop-filter: blur(10px);
      border: 1px solid rgba(255,255,255,0.5);
      border-radius: 16px;
      color: var(--color-text-primary);
      font-weight: 700;
      text-decoration: none;
      transition: all 0.2s ease;
      box-shadow: 0 4px 6px rgba(0,0,0,0.02);
    }
    .lib-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 15px rgba(0,0,0,0.05);
      background: #fff;
      color: var(--color-primary);
    }
    .lib-btn.highlight {
      background: var(--color-primary);
      color: #fff;
      border: none;
      animation: pulse 2s infinite;
    }
    @keyframes pulse {
      0% { box-shadow: 0 0 0 0 rgba(37, 99, 235, 0.4); }
      70% { box-shadow: 0 0 0 10px rgba(37, 99, 235, 0); }
      100% { box-shadow: 0 0 0 0 rgba(37, 99, 235, 0); }
    }
    /* Hide default header and footer */
    .site-header, .site-footer { display: none !important; }
  </style>
</head>
<body <?php body_class('template-link-in-bio'); ?>>

<div class="lib-container">
  <?php
  // Use site icon if available, otherwise use logo
  $icon_url = get_site_icon_url() ? get_site_icon_url(512) : get_template_directory_uri() . '/assets/images/logo.svg';
  ?>
  <img src="<?php echo esc_url($icon_url); ?>" alt="Profile" class="lib-avatar">
  <h1 class="lib-title"><?php bloginfo('name'); ?></h1>
  <p class="lib-bio"><?php bloginfo('description'); ?></p>

  <div class="lib-links">
    <!-- Featured Amazon Deal (Dynamically grabbed) -->
    <?php
    $deals = new WP_Query(array('post_type' => 'post', 'category_name' => 'deals', 'posts_per_page' => 1));
    if ($deals->have_posts()) : while ($deals->have_posts()) : $deals->the_post();
    ?>
      <a href="<?php the_permalink(); ?>" class="lib-btn highlight">🔥 Deal of the Day: <?php the_title(); ?></a>
    <?php endwhile; wp_reset_postdata(); endif; ?>

    <!-- Standard Links -->
    <a href="<?php echo esc_url(home_url('/')); ?>" class="lib-btn">🏠 Visit Full Website</a>
    <a href="<?php echo esc_url(get_post_type_archive_link('tool')); ?>" class="lib-btn">🔧 Browse Free Tools</a>
    <a href="<?php echo esc_url(home_url('/contact')); ?>" class="lib-btn">✉️ Work With Me</a>
    
    <!-- User content from editor -->
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      <div style="margin-top:20px; text-align:left;">
        <?php the_content(); ?>
      </div>
    <?php endwhile; endif; ?>
  </div>
</div>

<?php wp_footer(); ?>
</body>
</html>
