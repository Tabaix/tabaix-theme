class TabaixTheme {
  constructor() {
    this.navToggle = document.querySelector('.nav-primary__toggle');
    this.menuWrap = document.querySelector('.nav-primary__menu-wrap');
    this.toolCategoryButtons = document.querySelectorAll('.tool-category');
    this.themeToggleBtn = document.getElementById('theme-toggle');
    this.init();
  }

  init() {
    this.initTheme();
    this.initScrollAnimations();
    this.initTabIndicator();

    if (this.navToggle && this.menuWrap) {
      this.navToggle.addEventListener('click', () => this.toggleNavigation());
    }

    if (this.toolCategoryButtons.length) {
      this.toolCategoryButtons.forEach((button) => {
        button.addEventListener('click', () => this.filterTools(button));
      });
    }

    if (this.themeToggleBtn) {
      this.themeToggleBtn.addEventListener('click', () => this.toggleTheme());
    }
  }

  /* ─── SCROLL-TRIGGERED ANIMATIONS ─── */
  initScrollAnimations() {
    if (!('IntersectionObserver' in window)) return;

    const targets = document.querySelectorAll(
      '.section-title, .section-description, .tool-card, .guide-card, .deal-card, .section-footer'
    );

    targets.forEach((el) => {
      // Skip skeleton cards and already-animated elements
      if (el.classList.contains('tool-card--skeleton')) return;
      if (el.dataset.observed) return;
      el.dataset.observed = '1';
      el.style.opacity = '0';
      el.style.transform = 'translateY(24px)';
      el.style.transition = 'opacity 0.5s ease, transform 0.5s cubic-bezier(0.34,1.56,0.64,1)';
    });

    const observer = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (!entry.isIntersecting) return;
          const el = entry.target;

          // Stagger cards by sibling index
          const siblings = el.parentElement
            ? Array.from(el.parentElement.children)
            : [];
          const idx = siblings.indexOf(el);
          const isCard = el.classList.contains('tool-card') ||
                         el.classList.contains('guide-card') ||
                         el.classList.contains('deal-card');
          el.style.transitionDelay = isCard ? `${idx * 0.07}s` : '0s';
          el.style.opacity = '1';
          el.style.transform = 'translateY(0)';
          observer.unobserve(el);
        });
      },
      { threshold: 0.12 }
    );

    targets.forEach((el) => {
      if (el.dataset.observed) observer.observe(el);
    });
  }

  /* ─── SLIDING TAB INDICATOR ─── */
  initTabIndicator() {
    const tabBar = document.querySelector('.tool-categories');
    if (!tabBar) return;
    // Prevent duplicate indicators
    if (tabBar.querySelector('.tab-indicator')) return;

    const indicator = document.createElement('span');
    indicator.className = 'tab-indicator';
    indicator.setAttribute('aria-hidden', 'true');
    tabBar.appendChild(indicator);

    const moveIndicator = (btn) => {
      const barRect = tabBar.getBoundingClientRect();
      const btnRect = btn.getBoundingClientRect();
      indicator.style.width  = `${btnRect.width}px`;
      indicator.style.height = `${btnRect.height}px`;
      indicator.style.left   = `${btnRect.left - barRect.left + tabBar.scrollLeft}px`;
      indicator.style.top    = `${btnRect.top  - barRect.top}px`;
      indicator.style.opacity = '1';
    };

    const activeBtn = tabBar.querySelector('.tool-category.active');
    if (activeBtn) {
      indicator.style.transition = 'none';
      moveIndicator(activeBtn);
      requestAnimationFrame(() => {
        indicator.style.transition =
          'left 0.35s cubic-bezier(0.4,0,0.2,1), width 0.35s cubic-bezier(0.4,0,0.2,1), top 0.35s cubic-bezier(0.4,0,0.2,1), opacity 0.2s ease';
      });
    }

    this.toolCategoryButtons.forEach((btn) => {
      btn.addEventListener('click', () => moveIndicator(btn));
    });

    window.addEventListener('resize', () => {
      const current = tabBar.querySelector('.tool-category.active');
      if (current) moveIndicator(current);
    });
  }

  /* ─── THEME ─── */
  initTheme() {
    const savedTheme = localStorage.getItem('tabaix-theme');
    const systemPrefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

    if (savedTheme === 'dark' || (!savedTheme && systemPrefersDark)) {
      document.documentElement.classList.add('dark-theme');
      document.documentElement.classList.remove('light-theme');
    } else if (savedTheme === 'light') {
      document.documentElement.classList.add('light-theme');
      document.documentElement.classList.remove('dark-theme');
    }
  }

  toggleTheme() {
    const isDark = document.documentElement.classList.contains('dark-theme');
    const systemPrefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

    if (isDark) {
      document.documentElement.classList.remove('dark-theme');
      document.documentElement.classList.add('light-theme');
      localStorage.setItem('tabaix-theme', 'light');
    } else if (document.documentElement.classList.contains('light-theme')) {
      document.documentElement.classList.remove('light-theme');
      document.documentElement.classList.add('dark-theme');
      localStorage.setItem('tabaix-theme', 'dark');
    } else {
      if (systemPrefersDark) {
        document.documentElement.classList.add('light-theme');
        localStorage.setItem('tabaix-theme', 'light');
      } else {
        document.documentElement.classList.add('dark-theme');
        localStorage.setItem('tabaix-theme', 'dark');
      }
    }
  }

  /* ─── NAVIGATION ─── */
  toggleNavigation() {
    const expanded = this.navToggle.getAttribute('aria-expanded') === 'true';
    this.navToggle.setAttribute('aria-expanded', String(!expanded));
    this.menuWrap.classList.toggle('is-open');
  }

  /* ─── AJAX TOOL FILTERING ─── */
  async filterTools(button) {
    const category = button.getAttribute('data-category');
    this.toolCategoryButtons.forEach((btn) => btn.classList.remove('active'));
    button.classList.add('active');

    const section = button.closest('.section-tools');
    const grid = section ? section.querySelector('.grid') : null;
    if (!grid) return;

    // Show skeleton cards while loading
    grid.innerHTML = Array.from({ length: 4 }).map(() => `
      <div class="tool-card tool-card--skeleton" aria-hidden="true">
        <div class="tool-card__icon" style="width:48px;height:48px;border-radius:0.5rem;">&nbsp;</div>
        <div class="tool-card__content">
          <h3 class="tool-card__title" style="height:1.2em;">&nbsp;</h3>
          <p class="tool-card__description" style="height:3em;">&nbsp;</p>
        </div>
      </div>
    `).join('');

    if (typeof tabaixAjax === 'undefined') return;

    try {
      const formData = new FormData();
      formData.append('action', 'tabaix_filter_tools');
      formData.append('nonce', tabaixAjax.nonce);
      formData.append('category', category);

      const response = await fetch(tabaixAjax.ajaxurl, {
        method: 'POST',
        body: formData
      });

      if (response.ok) {
        const html = await response.text();

        // Fade out skeleton
        grid.style.transition = 'opacity 0.15s ease';
        grid.style.opacity = '0';
        await new Promise(r => setTimeout(r, 150));

        // Inject new cards with stagger
        grid.innerHTML = html;
        grid.classList.add('tools-grid--animating');
        grid.style.opacity = '1';
        void grid.offsetHeight; // force reflow

        // Re-apply scroll observer to freshly injected cards
        this.initScrollAnimations();

        setTimeout(() => grid.classList.remove('tools-grid--animating'), 800);
      } else {
        grid.innerHTML = '<p style="text-align:center;padding:2rem;color:#ef4444;">Error loading tools.</p>';
      }
    } catch (e) {
      grid.innerHTML = '<p style="text-align:center;padding:2rem;color:#ef4444;">Network error.</p>';
    }
  }
}

document.addEventListener('DOMContentLoaded', () => {
  new TabaixTheme();
});
