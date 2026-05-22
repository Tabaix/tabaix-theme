class LazyLoader {
  constructor() {
    this.images = document.querySelectorAll('img[loading="lazy"]');
    this.observer = null;
    this.init();
  }

  init() {
    if ('IntersectionObserver' in window) {
      this.observer = new IntersectionObserver(
        (entries) => this.handleIntersection(entries),
        {
          rootMargin: '50px 0px',
          threshold: 0.01,
        }
      );
      this.images.forEach((img) => this.observer.observe(img));
    } else {
      this.loadAll();
    }
  }

  handleIntersection(entries) {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        this.loadImage(entry.target);
        this.observer.unobserve(entry.target);
      }
    });
  }

  loadImage(img) {
    const src = img.dataset.src || img.src;
    const srcset = img.dataset.srcset;
    if (src) {
      img.src = src;
    }
    if (srcset) {
      img.srcset = srcset;
    }
    img.classList.add('loaded');
  }

  loadAll() {
    this.images.forEach((img) => this.loadImage(img));
  }
}

document.addEventListener('DOMContentLoaded', () => {
  new LazyLoader();
});
