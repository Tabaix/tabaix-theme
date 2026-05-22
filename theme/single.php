<?php get_header(); ?>

<main class="site-main" style="background: var(--color-bg-primary);">
  <?php while (have_posts()) : the_post(); ?>
    
    <!-- Hero Section -->
    <header class="entry-header" style="background: linear-gradient(180deg, var(--color-bg-secondary) 0%, var(--color-bg-primary) 100%); padding: 80px 0 40px; text-align: center; border-bottom: 1px solid var(--color-border-primary);">
      <div class="container" style="max-width: 800px;">
        <div class="entry-category" style="margin-bottom: 15px;">
          <?php 
          $categories = get_the_category();
          if (!empty($categories)) {
            echo '<a href="' . esc_url(get_category_link($categories[0]->term_id)) . '" style="background: var(--color-primary); color: #fff; padding: 6px 12px; border-radius: 9999px; font-size: 0.8rem; font-weight: bold; text-transform: uppercase; letter-spacing: 1px; text-decoration: none;">' . esc_html($categories[0]->name) . '</a>';
          }
          ?>
        </div>
        
        <?php the_title('<h1 class="entry-title" style="font-size: 3rem; font-weight: 800; line-height: 1.2; margin-bottom: 20px; color: var(--color-text-primary);">', '</h1>'); ?>
        
        <div class="entry-meta" style="display: flex; align-items: center; justify-content: center; gap: 15px; color: var(--color-text-tertiary); font-size: 0.95rem;">
          <div style="display: flex; align-items: center; gap: 8px;">
            <?php echo get_avatar(get_the_author_meta('ID'), 32, '', '', array('style' => 'border-radius: 50%;')); ?>
            <strong style="color: var(--color-text-primary);"><?php the_author(); ?></strong>
          </div>
          <span>•</span>
          <span class="posted-on"><?php echo esc_html(get_the_date()); ?></span>
          <span>•</span>
          <span class="reading-time">
            <?php 
              $content = get_post_field('post_content', get_the_ID());
              $word_count = str_word_count(strip_tags($content));
              $reading_time = ceil($word_count / 200);
              echo esc_html($reading_time) . ' min read';
            ?>
          </span>
        </div>
      </div>
    </header>

    <!-- Main Content Area -->
    <div class="container" style="max-width: 1000px; padding: 40px 20px; display: flex; gap: 40px; align-items: flex-start;">
      
      <!-- Sticky Social Sidebar -->
      <aside class="social-share-sidebar" style="position: sticky; top: 120px; display: flex; flex-direction: column; gap: 15px; width: 40px; flex-shrink: 0;">
        <span style="font-size: 0.75rem; text-transform: uppercase; color: var(--color-text-tertiary); font-weight: bold; writing-mode: vertical-rl; transform: rotate(180deg); margin-bottom: 10px;">Share</span>
        <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>" target="_blank" style="width: 40px; height: 40px; border-radius: 50%; background: var(--color-bg-elevated); border: 1px solid var(--color-border-primary); display: flex; align-items: center; justify-content: center; color: var(--color-text-secondary); transition: all 0.2s;">
          <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
        </a>
        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" target="_blank" style="width: 40px; height: 40px; border-radius: 50%; background: var(--color-bg-elevated); border: 1px solid var(--color-border-primary); display: flex; align-items: center; justify-content: center; color: var(--color-text-secondary); transition: all 0.2s;">
          <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M18.77 7.46H14.5v-1.9c0-.9.6-1.1 1-1.1h3V.5h-4.33C10.24.5 9.5 3.44 9.5 5.32v2.15h-3v4h3v12h5v-12h3.85l.42-4z"/></svg>
        </a>
      </aside>

      <!-- Content -->
      <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> style="flex-grow: 1; max-width: 800px; width: 100%;">
        
        <?php if (has_post_thumbnail()) : ?>
          <div class="entry-thumbnail" style="margin-bottom: 40px; border-radius: var(--radius-val, 1rem); overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.05);">
            <?php the_post_thumbnail('large', array('style' => 'width:100%; height:auto; display:block;')); ?>
          </div>
        <?php endif; ?>

        <div class="entry-content" style="font-size: 1.1rem; line-height: 1.8; color: var(--color-text-secondary);">
          <?php the_content(); ?>
        </div>

        <!-- Author Box -->
        <div class="author-box" style="margin-top: 60px; padding: 40px; background: var(--color-bg-elevated); border: 1px solid var(--color-border-primary); border-radius: var(--radius-val, 1rem); display: flex; gap: 20px; align-items: center;">
          <div class="author-avatar" style="flex-shrink: 0;">
            <?php echo get_avatar(get_the_author_meta('ID'), 80, '', '', array('style' => 'border-radius: 50%; box-shadow: 0 4px 10px rgba(0,0,0,0.1);')); ?>
          </div>
          <div class="author-info">
            <h4 style="margin: 0 0 5px 0; font-size: 1.25rem; color: var(--color-text-primary);">Written by <?php the_author(); ?></h4>
            <p style="margin: 0; color: var(--color-text-secondary); font-size: 0.95rem;">
              <?php 
              $author_desc = get_the_author_meta('description');
              echo $author_desc ? esc_html($author_desc) : esc_html__('An expert editor and deal hunter at TABAIX.', 'tabaix');
              ?>
            </p>
          </div>
        </div>

        <!-- Comments -->
        <div style="margin-top: 40px;">
          <?php if (comments_open() || get_comments_number()) : comments_template(); endif; ?>
        </div>
      </article>
      
    </div>
  <?php endwhile; ?>
</main>

<style>
  /* Social hover effects */
  .social-share-sidebar a:hover {
    background: var(--color-primary) !important;
    color: #fff !important;
    border-color: var(--color-primary) !important;
    transform: translateY(-2px);
  }
  
  /* Make Gutenberg content look incredible */
  .entry-content h2, .entry-content h3, .entry-content h4 {
    color: var(--color-text-primary);
    margin-top: 2em;
    margin-bottom: 0.75em;
  }
  .entry-content a {
    color: var(--color-primary);
    text-decoration: underline;
    text-underline-offset: 4px;
  }
  .entry-content ul, .entry-content ol {
    padding-left: 20px;
    margin-bottom: 1.5em;
  }
  .entry-content li {
    margin-bottom: 0.5em;
  }
  .entry-content blockquote {
    border-left: 4px solid var(--color-primary);
    padding-left: 20px;
    font-style: italic;
    color: var(--color-text-tertiary);
    background: var(--color-bg-secondary);
    padding: 20px;
    border-radius: 0 var(--radius-val, 1rem) var(--radius-val, 1rem) 0;
  }
</style>

<?php get_footer(); ?>
