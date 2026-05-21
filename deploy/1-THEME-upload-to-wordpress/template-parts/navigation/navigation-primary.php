<nav class="nav-primary" aria-label="<?php esc_attr_e('Primary menu', 'tabaix'); ?>">
  <div class="container nav-primary__wrapper">
    <a href="<?php echo esc_url(home_url('/')); ?>" class="nav-primary__logo">
      <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/logo.svg'); ?>" alt="<?php esc_attr_e('TABAIX logo', 'tabaix'); ?>">
      <span><?php bloginfo('name'); ?></span>
    </a>

    <button class="nav-primary__toggle" aria-expanded="false" aria-label="<?php esc_attr_e('Menu', 'tabaix'); ?>">
      <span></span>
      <span></span>
      <span></span>
    </button>

    <div class="nav-primary__menu-wrap">
      <?php
      wp_nav_menu(array(
        'theme_location' => 'primary',
        'container' => false,
        'menu_class' => 'nav-primary__menu',
      ));
      ?>
      <div class="nav-primary__search">
        <input type="search" placeholder="<?php esc_attr_e('Search tools & guides...', 'tabaix'); ?>" aria-label="<?php esc_attr_e('Search tools and guides', 'tabaix'); ?>">
      </div>
      <div class="nav-primary__theme-toggle">
        <button id="theme-toggle" class="theme-toggle-btn" aria-label="<?php esc_attr_e('Toggle Theme', 'tabaix'); ?>">
          <svg class="theme-toggle-svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle class="sun-element" cx="12" cy="12" r="5"></circle>
            <line class="sun-element" x1="12" y1="1" x2="12" y2="3"></line>
            <line class="sun-element" x1="12" y1="21" x2="12" y2="23"></line>
            <line class="sun-element" x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
            <line class="sun-element" x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
            <line class="sun-element" x1="1" y1="12" x2="3" y2="12"></line>
            <line class="sun-element" x1="21" y1="12" x2="23" y2="12"></line>
            <line class="sun-element" x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
            <line class="sun-element" x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
            <path class="moon-element" d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
          </svg>
        </button>
      </div>
    </div>
  </div>
</nav>
