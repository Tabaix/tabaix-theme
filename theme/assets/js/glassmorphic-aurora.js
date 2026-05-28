const tabaixGlassCursor = document.getElementById('c');
const tabaixGlassRing = document.getElementById('cr');
let tabaixMouseX = 0;
let tabaixMouseY = 0;
let tabaixRingX = 0;
let tabaixRingY = 0;

if (tabaixGlassCursor && tabaixGlassRing) {
  document.addEventListener('mousemove', (event) => {
    tabaixMouseX = event.clientX;
    tabaixMouseY = event.clientY;
    tabaixGlassCursor.style.transform = `translate(${tabaixMouseX - 5}px, ${tabaixMouseY - 5}px)`;
  });

  (function animateRing() {
    tabaixRingX += (tabaixMouseX - tabaixRingX) * 0.1;
    tabaixRingY += (tabaixMouseY - tabaixRingY) * 0.1;
    tabaixGlassRing.style.transform = `translate(${tabaixRingX - 20}px, ${tabaixRingY - 20}px)`;
    requestAnimationFrame(animateRing);
  })();

  document.querySelectorAll('a,button').forEach((element) => {
    element.addEventListener('mouseenter', () => {
      tabaixGlassRing.style.width = '60px';
      tabaixGlassRing.style.height = '60px';
    });
    element.addEventListener('mouseleave', () => {
      tabaixGlassRing.style.width = '40px';
      tabaixGlassRing.style.height = '40px';
    });
  });
}

document.querySelectorAll('[data-t]').forEach((counter) => {
  new IntersectionObserver((entries) => {
    if (entries[0].isIntersecting) {
      const target = +counter.dataset.t;
      let start = null;
      function step(timestamp) {
        if (!start) start = timestamp;
        const progress = Math.min((timestamp - start) / 1400, 1);
        const value = Math.round(Math.pow(progress, 3) * target);
        counter.textContent = value;
        if (progress < 1) requestAnimationFrame(step);
      }
      requestAnimationFrame(step);
    }
  }, { threshold: 0.5 }).observe(counter);
});

document.querySelectorAll('.rv').forEach((element, index) => {
  new IntersectionObserver((entries) => {
    if (entries[0].isIntersecting) {
      element.style.transitionDelay = `${(index % 5) * 0.07}s`;
      element.classList.add('on');
    }
  }, { threshold: 0.05 }).observe(element);
});

document.querySelectorAll('.cg-tab').forEach((tab) => {
  tab.addEventListener('click', function () {
    document.querySelectorAll('.cg-tab').forEach((item) => item.classList.remove('act'));
    this.classList.add('act');
  });
});
