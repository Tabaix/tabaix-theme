<?php get_header(); ?>
<main class="site-main">
  <div class="container error-404 not-found">
    <header class="page-header">
      <h1 class="page-title"><?php esc_html_e('Page not found', 'tabaix'); ?></h1>
      <p><?php esc_html_e('The content you are looking for cannot be found. Try a search or head back to the homepage.', 'tabaix'); ?></p>
    </header>
    <?php get_search_form(); ?>
    <a class="btn btn-primary" href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Return home', 'tabaix'); ?></a>
  </div>
</main>
<?php get_footer(); ?>
