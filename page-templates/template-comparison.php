<?php
/*
Template Name: Product Review & Comparison
*/
get_header(); ?>

<main class="site-main comparison-page-template" style="background-color: var(--color-bg-primary); padding: 60px 0;">
  <div class="container" style="max-width: var(--container-2xl, 1280px); margin: 0 auto; padding: 0 var(--space-4);">
    <?php while (have_posts()) : the_post(); ?>
      <article id="post-<?php the_ID(); ?>" <?php post_class('comparison-article'); ?>>
        
        <header class="entry-header text-center" style="margin-bottom: 50px;">
          <h1 class="entry-title" style="font-size: 2.75rem; font-weight: 800; color: var(--color-text-primary); margin-top: 0; line-height: 1.2;">
            <?php the_title(); ?>
          </h1>
          <p class="comparison-meta" style="font-size: 0.95rem; color: var(--color-text-tertiary); margin-top: 15px;">
            <?php esc_html_e('Updated on', 'tabaix'); ?> <?php echo get_the_modified_date(); ?> | <?php esc_html_e('Affiliate Disclosure: We may earn a commission on links.', 'tabaix'); ?>
          </p>
        </header>

        <div class="entry-content comparison-content">
          <?php the_content(); ?>
        </div>

      </article>
    <?php endwhile; ?>
  </div>
</main>

<style type="text/css">
  /* ---------------------------------------------------- */
  /* Premium Comparison & Review Elements Styling         */
  /* ---------------------------------------------------- */

  /* 1. Comparison Table */
  .comparison-table-wrapper {
    overflow-x: auto;
    margin: 40px 0;
    border-radius: var(--radius-val, 1rem);
    border: 1px solid var(--color-border-primary);
    box-shadow: 0 4px 15px rgba(0,0,0,0.02);
  }
  .comparison-table {
    width: 100%;
    border-collapse: collapse;
    text-align: left;
    background-color: var(--color-bg-elevated);
    font-size: 0.95rem;
  }
  .comparison-table th {
    background-color: var(--color-primary);
    color: #ffffff;
    padding: 18px 20px;
    font-weight: 700;
    font-size: 1rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
  }
  .comparison-table td {
    padding: 18px 20px;
    border-bottom: 1px solid var(--color-border-primary);
    vertical-align: middle;
    color: var(--color-text-primary);
  }
  .comparison-table tr:last-child td {
    border-bottom: none;
  }
  .comparison-table tr:hover {
    background-color: color-mix(in srgb, var(--color-bg-primary) 80%, var(--color-bg-elevated));
  }
  
  /* 2. Pros and Cons Blocks */
  .pros-cons-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 30px;
    margin: 40px 0;
  }
  .pro-block, .con-block {
    padding: 30px;
    border-radius: var(--radius-val, 1rem);
    box-shadow: 0 4px 12px rgba(0,0,0,0.01);
  }
  .pro-block {
    background-color: #f0fdf4;
    border: 1px solid #bbf7d0;
  }
  .con-block {
    background-color: #fef2f2;
    border: 1px solid #fecaca;
  }
  .pro-block h4, .con-block h4 {
    margin-top: 0;
    margin-bottom: 15px;
    font-size: 1.25rem;
    font-weight: 700;
  }
  .pro-block h4 { color: #15803d; }
  .con-block h4 { color: #b91c1c; }
  .pro-block ul, .con-block ul {
    list-style: none;
    padding-left: 0;
    margin: 0;
  }
  .pro-block li, .con-block li {
    position: relative;
    padding-left: 28px;
    margin-bottom: 12px;
    line-height: 1.5;
  }
  .pro-block li::before {
    content: "✓";
    position: absolute;
    left: 0;
    color: #16a34a;
    font-weight: bold;
    font-size: 1.1rem;
  }
  .con-block li::before {
    content: "✗";
    position: absolute;
    left: 0;
    color: #dc2626;
    font-weight: bold;
    font-size: 1.1rem;
  }

  /* 3. Product Rating Card */
  .product-review-card {
    display: flex;
    flex-wrap: wrap;
    background-color: var(--color-bg-elevated);
    border: 1px solid var(--color-border-primary);
    border-radius: var(--radius-val, 1rem);
    margin: 30px 0;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0,0,0,0.02);
  }
  .product-review-image {
    flex: 1 1 250px;
    background: #f8fafc;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
  }
  .product-review-image img {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
  }
  .product-review-details {
    flex: 2 1 400px;
    padding: 30px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
  }
  .product-review-details h3 {
    margin-top: 0;
    font-size: 1.5rem;
    color: var(--color-text-primary);
  }
  .product-score-badge {
    display: inline-flex;
    align-items: center;
    background-color: var(--color-primary);
    color: white;
    font-weight: 800;
    font-size: 1.125rem;
    padding: 6px 14px;
    border-radius: 20px;
    margin-bottom: 15px;
    width: fit-content;
  }
  
  /* Buttons */
  .btn-buy-now {
    display: inline-block;
    background: linear-gradient(135deg, #f59e0b, #ea580c);
    color: white !important;
    font-weight: 700;
    text-decoration: none !important;
    padding: 12px 25px;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(234, 88, 12, 0.2);
    transition: transform 0.2s, opacity 0.2s;
    text-align: center;
    width: fit-content;
  }
  .btn-buy-now:hover {
    transform: translateY(-2px);
    opacity: 0.95;
  }
</style>

<?php get_footer(); ?>
