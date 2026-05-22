<?php
/*
Template Name: Contact & Lead Capture
*/
get_header(); ?>

<main class="site-main contact-template" style="background: var(--color-bg-primary); padding: 80px 0;">
  <div class="container" style="max-width: 1080px; margin: 0 auto; display: grid; gap: 40px; grid-template-columns: 1fr 1fr; align-items: start;">
    <div style="padding: 40px; background: var(--color-bg-elevated); border: 1px solid var(--color-border-primary); border-radius: var(--radius-val, 1rem);">
      <p style="text-transform: uppercase; letter-spacing: 0.24em; color: var(--color-secondary); margin-bottom: 1rem; font-weight: 700;">Get in Touch</p>
      <h1 style="font-size: 3rem; margin-bottom: 1rem; color: var(--color-text-primary);">Speak with our team and get a fast response</h1>
      <p style="color: var(--color-text-secondary); font-size: 1.05rem; line-height: 1.8;">Use this page to collect leads, show contact details, and highlight your support channels.</p>
      <div style="margin-top: 36px; display: grid; gap: 20px;">
        <div style="border-top: 1px solid var(--color-border-primary); padding-top: 20px;"><strong>Email</strong><br><a href="mailto:hello@example.com" style="color: var(--color-primary);">hello@example.com</a></div>
        <div style="border-top: 1px solid var(--color-border-primary); padding-top: 20px;"><strong>Phone</strong><br><a href="tel:+1234567890" style="color: var(--color-primary);">+1 234 567 890</a></div>
      </div>
    </div>

    <div style="background: var(--color-bg-elevated); border: 1px solid var(--color-border-primary); border-radius: var(--radius-val, 1rem); padding: 40px;">
      <h2 style="font-size: 2rem; margin-bottom: 1rem; color: var(--color-text-primary);">Request a consultation</h2>
      <p style="color: var(--color-text-secondary); margin-bottom: 24px;">Add a contact form block here, or use your preferred form plugin inside the editor.</p>
      <div style="display: grid; gap: 18px;">
        <input type="text" placeholder="Name" style="width:100%; padding: 16px; border: 1px solid var(--color-border-primary); border-radius: 12px; background: var(--color-bg-primary); color: var(--color-text-primary);">
        <input type="email" placeholder="Email" style="width:100%; padding: 16px; border: 1px solid var(--color-border-primary); border-radius: 12px; background: var(--color-bg-primary); color: var(--color-text-primary);">
        <textarea rows="6" placeholder="Message" style="width:100%; padding: 16px; border: 1px solid var(--color-border-primary); border-radius: 12px; background: var(--color-bg-primary); color: var(--color-text-primary);"></textarea>
        <button style="padding: 16px 26px; border:none; border-radius: 999px; background: var(--color-primary); color:#fff; font-weight:700; cursor:pointer;">Send Message</button>
      </div>
    </div>
  </div>

  <section style="padding: 80px 0;">
    <div class="container" style="max-width: 1080px; margin: 0 auto;">
      <?php while (have_posts()) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class('contact-content'); ?> style="background: var(--color-bg-elevated); border: 1px solid var(--color-border-primary); border-radius: var(--radius-val, 1rem); padding: 40px;">
          <?php the_content(); ?>
        </article>
      <?php endwhile; ?>
    </div>
  </section>
</main>

<?php get_footer(); ?>