document.addEventListener('DOMContentLoaded', () => {
  const toolInterface = document.querySelector('.tool-interface');
  if (!toolInterface) {
    return;
  }

  const toolScript = toolInterface.querySelector('script');
  if (toolScript && !toolScript.src) {
    return;
  }

  const toolSlug = toolInterface.dataset.toolSlug;
  if (toolSlug) {
    const script = document.createElement('script');
    script.src = `${window.location.origin}/wp-content/themes/tabaix-theme/tools/${toolSlug}/script.js`;
    script.defer = true;
    document.body.appendChild(script);
  }
});
