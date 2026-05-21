<?php
/**
 * Template Name: Free SEO Audit Tool
 * Description: A powerful frontend Ahrefs-style Site Auditor tool driven by the custom Vercel API.
 */

get_header(); ?>

<main class="site-main seo-tool-page">
  <div class="container" style="max-width: 800px; margin: 60px auto;">
    
    <header class="page-header text-center" style="margin-bottom: 40px;">
      <h1 class="page-title" style="font-size: 2.5rem; font-weight: 800; background: linear-gradient(135deg, var(--color-primary), #a855f7); -webkit-background-clip: text; -webkit-text-fill-color: transparent;"><?php the_title(); ?></h1>
      <p style="color: var(--color-text-secondary); font-size: 1.1rem;">Enter your website URL below to get an instant, comprehensive technical SEO audit.</p>
    </header>

    <div class="seo-search-box" style="display: flex; gap: 10px; background: var(--color-bg-elevated); padding: 10px; border-radius: 9999px; box-shadow: 0 10px 25px rgba(0,0,0,0.05); border: 1px solid var(--color-border-primary);">
      <input type="url" id="seo-url-input" placeholder="https://yourwebsite.com" required style="flex-grow: 1; border: none; background: transparent; padding: 15px 25px; font-size: 1.1rem; outline: none; color: var(--color-text-primary);" />
      <button id="seo-analyze-btn" class="btn btn-primary" style="border-radius: 9999px; padding: 15px 35px; font-weight: bold; font-size: 1.1rem; border: none; background: linear-gradient(135deg, var(--color-primary), #a855f7); color: #fff; cursor: pointer; transition: transform 0.2s;">Analyze Site →</button>
    </div>

    <!-- Results Container -->
    <div id="seo-results-container" style="margin-top: 40px; display: none;">
      <!-- Main Score -->
      <div class="seo-card text-center" style="background: var(--color-bg-elevated); border: 1px solid var(--color-border-primary); border-radius: 20px; padding: 40px; margin-bottom: 20px; box-shadow: 0 4px 6px rgba(0,0,0,0.02);">
        <h3 style="margin-top: 0; color: var(--color-text-secondary);">Overall SEO Health Score</h3>
        <div id="seo-score-circle" style="font-size: 5rem; font-weight: 900; color: var(--color-primary); line-height: 1;">100</div>
        <div id="seo-target-url" style="color: var(--color-text-tertiary); font-family: monospace; margin-top: 10px;"></div>
      </div>

      <!-- Metrics Grid -->
      <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 20px;">
        <!-- Title Meta -->
        <div class="seo-card" style="background: var(--color-bg-elevated); border: 1px solid var(--color-border-primary); border-radius: 16px; padding: 20px;">
          <h4 style="margin: 0 0 10px 0; border-bottom: 1px solid var(--color-border-secondary); padding-bottom: 10px;">Title & Meta</h4>
          <p style="margin:0 0 5px 0;"><strong>Title:</strong> <span id="res-title-status"></span></p>
          <div id="res-title-text" style="font-size: 0.85rem; color: var(--color-text-secondary); margin-bottom: 10px; background: var(--color-bg-secondary); padding: 8px; border-radius: 8px;"></div>
          
          <p style="margin:0 0 5px 0;"><strong>Description:</strong> <span id="res-desc-status"></span></p>
          <div id="res-desc-text" style="font-size: 0.85rem; color: var(--color-text-secondary); background: var(--color-bg-secondary); padding: 8px; border-radius: 8px;"></div>
        </div>

        <!-- Content Structure -->
        <div class="seo-card" style="background: var(--color-bg-elevated); border: 1px solid var(--color-border-primary); border-radius: 16px; padding: 20px;">
          <h4 style="margin: 0 0 10px 0; border-bottom: 1px solid var(--color-border-secondary); padding-bottom: 10px;">Content Structure</h4>
          <p style="display: flex; justify-content: space-between;"><span>Word Count:</span> <strong id="res-words"></strong></p>
          <p style="display: flex; justify-content: space-between;"><span>H1 Tags:</span> <strong id="res-h1"></strong></p>
          <p style="display: flex; justify-content: space-between;"><span>H2 Tags:</span> <strong id="res-h2"></strong></p>
          <p style="display: flex; justify-content: space-between;"><span>H3 Tags:</span> <strong id="res-h3"></strong></p>
        </div>

        <!-- Media & Links -->
        <div class="seo-card" style="background: var(--color-bg-elevated); border: 1px solid var(--color-border-primary); border-radius: 16px; padding: 20px;">
          <h4 style="margin: 0 0 10px 0; border-bottom: 1px solid var(--color-border-secondary); padding-bottom: 10px;">Media & Links</h4>
          <p style="display: flex; justify-content: space-between; color: #dc2626;"><span>Missing Alt Tags:</span> <strong id="res-img-alt"></strong></p>
          <p style="display: flex; justify-content: space-between;"><span>Internal Links:</span> <strong id="res-int-links"></strong></p>
          <p style="display: flex; justify-content: space-between;"><span>External Links:</span> <strong id="res-ext-links"></strong></p>
          <p style="display: flex; justify-content: space-between; color: var(--color-text-tertiary);"><span>Load Time:</span> <strong id="res-time"></strong></p>
        </div>
      </div>
    </div>

    <!-- Loading State -->
    <div id="seo-loading" style="display: none; text-align: center; margin-top: 40px; color: var(--color-text-secondary);">
      <div style="font-size: 2rem; margin-bottom: 10px; animation: spin 1s linear infinite;">⚙️</div>
      <p>Crawling website & Analyzing SEO metrics...</p>
    </div>

  </div>
</main>

<style>
  @keyframes spin { 100% { transform: rotate(360deg); } }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const btn = document.getElementById('seo-analyze-btn');
  const input = document.getElementById('seo-url-input');
  const results = document.getElementById('seo-results-container');
  const loading = document.getElementById('seo-loading');

  // IMPORTANT: Once deployed to Vercel, change this URL to your live Vercel URL
  const VERCEL_API_URL = 'http://localhost:3000/api/audit'; 

  btn.addEventListener('click', async function() {
    const url = input.value;
    if (!url) return alert('Please enter a URL');

    results.style.display = 'none';
    loading.style.display = 'block';

    try {
      const response = await fetch(`${VERCEL_API_URL}?url=${encodeURIComponent(url)}`);
      const data = await response.json();
      
      loading.style.display = 'none';

      if (data.error) {
        alert(data.error);
        return;
      }

      // Populate Data
      document.getElementById('seo-score-circle').innerText = data.overall_score;
      document.getElementById('seo-score-circle').style.color = data.overall_score > 80 ? '#10b981' : (data.overall_score > 50 ? '#f59e0b' : '#ef4444');
      document.getElementById('seo-target-url').innerText = data.url;

      document.getElementById('res-title-status').innerText = data.meta.title.score === 100 ? '✅ Perfect' : '⚠️ Needs Work';
      document.getElementById('res-title-text').innerText = data.meta.title.text || 'No Title Found';
      
      document.getElementById('res-desc-status').innerText = data.meta.description.score === 100 ? '✅ Perfect' : '⚠️ Needs Work';
      document.getElementById('res-desc-text').innerText = data.meta.description.text || 'No Meta Description Found';

      document.getElementById('res-words').innerText = data.content.word_count;
      document.getElementById('res-h1').innerText = data.headings.h1;
      document.getElementById('res-h1').style.color = data.headings.h1 === 1 ? '#10b981' : '#ef4444';
      
      document.getElementById('res-h2').innerText = data.headings.h2;
      document.getElementById('res-h3').innerText = data.headings.h3;

      document.getElementById('res-img-alt').innerText = `${data.images.missing_alt} / ${data.images.total}`;
      document.getElementById('res-int-links').innerText = data.links.internal;
      document.getElementById('res-ext-links').innerText = data.links.external;
      document.getElementById('res-time').innerText = `${data.performance.load_time_ms}ms`;

      results.style.display = 'block';

    } catch (error) {
      loading.style.display = 'none';
      alert('Failed to connect to the SEO API. Ensure your Vercel server is running.');
    }
  });
});
</script>

<?php get_footer(); ?>
