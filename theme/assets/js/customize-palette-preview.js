/**
 * TABAIX Palette Customizer Live Preview
 * Updates CSS variables in real-time as user changes palette
 */
(function() {
  'use strict';

  const palettes = {
    modern: {
      primary: '#2563eb',
      primary_light: '#3b82f6',
      primary_dark: '#1d4ed8',
      secondary: '#16a34a',
      secondary_light: '#22c55e',
      secondary_dark: '#15803d',
      accent: '#f59e0b',
      accent_light: '#fbbf24',
      accent_dark: '#d97706',
      bg_primary: '#ffffff',
      bg_secondary: '#f8fafc',
      text_primary: '#0f172a',
      text_secondary: '#475569',
    },
    minimal: {
      primary: '#374151',
      primary_light: '#4b5563',
      primary_dark: '#1f2937',
      secondary: '#6366f1',
      secondary_light: '#818cf8',
      secondary_dark: '#4f46e5',
      accent: '#ec4899',
      accent_light: '#f472b6',
      accent_dark: '#db2777',
      bg_primary: '#ffffff',
      bg_secondary: '#f3f4f6',
      text_primary: '#111827',
      text_secondary: '#6b7280',
    },
    bold: {
      primary: '#9333ea',
      primary_light: '#a855f7',
      primary_dark: '#7e22ce',
      secondary: '#e11d48',
      secondary_light: '#f43f5e',
      secondary_dark: '#be123c',
      accent: '#06b6d4',
      accent_light: '#22d3ee',
      accent_dark: '#0891b2',
      bg_primary: '#ffffff',
      bg_secondary: '#f5f3ff',
      text_primary: '#2d1b4e',
      text_secondary: '#6b4c7a',
    },
    sunset: {
      primary: '#ea580c',
      primary_light: '#f97316',
      primary_dark: '#c2410c',
      secondary: '#ff6b35',
      secondary_light: '#ff8451',
      secondary_dark: '#cc5627',
      accent: '#ffd700',
      accent_light: '#ffed4e',
      accent_dark: '#ccad00',
      bg_primary: '#ffffff',
      bg_secondary: '#fffbf0',
      text_primary: '#3e2723',
      text_secondary: '#795548',
    },
    forest: {
      primary: '#059669',
      primary_light: '#10b981',
      primary_dark: '#047857',
      secondary: '#0f766e',
      secondary_light: '#14b8a6',
      secondary_dark: '#0d5c56',
      accent: '#f59e0b',
      accent_light: '#fbbf24',
      accent_dark: '#d97706',
      bg_primary: '#ffffff',
      bg_secondary: '#f0fdf4',
      text_primary: '#064e3b',
      text_secondary: '#047857',
    },
    ocean: {
      primary: '#0369a1',
      primary_light: '#0ea5e9',
      primary_dark: '#075985',
      secondary: '#06b6d4',
      secondary_light: '#67e8f9',
      secondary_dark: '#0891b2',
      accent: '#1e40af',
      accent_light: '#3b82f6',
      accent_dark: '#1e3a8a',
      bg_primary: '#ffffff',
      bg_secondary: '#f0f9ff',
      text_primary: '#001f3f',
      text_secondary: '#0c4a6e',
    },
  };

  function updatePalettePreview(paletteName) {
    const palette = palettes[paletteName];
    if (!palette) return;

    const root = document.documentElement;
    root.style.setProperty('--color-primary', palette.primary);
    root.style.setProperty('--color-primary-light', palette.primary_light);
    root.style.setProperty('--color-primary-dark', palette.primary_dark);
    root.style.setProperty('--color-secondary', palette.secondary);
    root.style.setProperty('--color-secondary-light', palette.secondary_light);
    root.style.setProperty('--color-secondary-dark', palette.secondary_dark);
    root.style.setProperty('--color-accent', palette.accent);
    root.style.setProperty('--color-accent-light', palette.accent_light);
    root.style.setProperty('--color-accent-dark', palette.accent_dark);
    root.style.setProperty('--color-bg-primary', palette.bg_primary);
    root.style.setProperty('--color-bg-secondary', palette.bg_secondary);
    root.style.setProperty('--color-text-primary', palette.text_primary);
    root.style.setProperty('--color-text-secondary', palette.text_secondary);
  }

  // Listen for palette changes in customizer
  wp.customize('tabaix_preset_palette', function(value) {
    value.bind(function(newValue) {
      updatePalettePreview(newValue);
    });
  });

  // Initialize with current value
  const currentPalette = wp.customize('tabaix_preset_palette')();
  updatePalettePreview(currentPalette);
})();
