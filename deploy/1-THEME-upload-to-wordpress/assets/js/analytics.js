function tabaixTrackEvent(action, category, label) {
  if (typeof gtag === 'function') {
    gtag('event', action, {
      event_category: category,
      event_label: label,
    });
  }
}

document.addEventListener('DOMContentLoaded', () => {
  document.body.addEventListener('click', (event) => {
    const target = event.target.closest('a, button');
    if (!target) {
      return;
    }
    if (target.matches('.btn-primary, .btn-outline, .tool-card__link, .tool-header__meta span')) {
      const label = target.textContent.trim();
      tabaixTrackEvent('click', 'engagement', label);
    }
  });
});
