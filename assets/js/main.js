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
      // No explicit class yet, toggling based on system preference
      if (systemPrefersDark) {
        document.documentElement.classList.add('light-theme');
        localStorage.setItem('tabaix-theme', 'light');
      } else {
        document.documentElement.classList.add('dark-theme');
        localStorage.setItem('tabaix-theme', 'dark');
      }
    }
  }

  toggleNavigation() {
    const expanded = this.navToggle.getAttribute('aria-expanded') === 'true';
    this.navToggle.setAttribute('aria-expanded', String(!expanded));
    this.menuWrap.classList.toggle('is-open');
  }

  filterTools(button) {
    const category = button.getAttribute('data-category');
    this.toolCategoryButtons.forEach((btn) => btn.classList.remove('active'));
    button.classList.add('active');
    const cards = document.querySelectorAll('.tool-card');
    cards.forEach((card) => {
      if (category === 'all') {
        card.style.display = '';
        return;
      }
      const cardCategory = card.dataset.category || '';
      card.style.display = cardCategory === category ? '' : 'none';
    });
  }
}

document.addEventListener('DOMContentLoaded', () => {
  new TabaixTheme();
});
