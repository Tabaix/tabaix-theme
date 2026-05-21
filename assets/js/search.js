document.addEventListener('DOMContentLoaded', () => {
  const searchInputs = document.querySelectorAll('.nav-primary__search input, .hero-search-input');
  const searchButtons = document.querySelectorAll('.hero-search-btn');

  searchButtons.forEach((button) => {
    button.addEventListener('click', () => {
      const input = document.querySelector('.hero-search-input');
      if (!input) {
        return;
      }

      const query = input.value.trim();
      if (query.length) {
        window.location.href = `${window.location.origin}?s=${encodeURIComponent(query)}`;
      }
    });
  });

  searchInputs.forEach((input) => {
    input.addEventListener('keypress', (event) => {
      if (event.key === 'Enter') {
        event.preventDefault();
        window.location.href = `${window.location.origin}?s=${encodeURIComponent(input.value.trim())}`;
      }
    });
  });
});
