<?php
if (!function_exists('tabaix_render_breadcrumbs')) {
  return;
}

$breadcrumbs = tabaix_get_breadcrumbs();
if (!empty($breadcrumbs)) : ?>
  <nav class="breadcrumbs" aria-label="<?php esc_attr_e('Breadcrumb', 'tabaix'); ?>">
    <ol>
      <?php foreach ($breadcrumbs as $item) : ?>
        <li><a href="<?php echo esc_url($item['url']); ?>"><?php echo esc_html($item['label']); ?></a></li>
      <?php endforeach; ?>
    </ol>
  </nav>
<?php endif; ?>
