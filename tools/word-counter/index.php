<div class="tool-shell word-counter" id="word-counter-tool">
  <header class="tool-panel-header">
    <h2><?php esc_html_e('Word Counter', 'tabaix'); ?></h2>
    <p><?php esc_html_e('Count words, characters, sentences and estimated reading time in real time.', 'tabaix'); ?></p>
  </header>

  <textarea id="wc-input" class="wc-input" placeholder="<?php esc_attr_e('Paste text here...', 'tabaix'); ?>"></textarea>

  <div class="wc-summary">
    <div><strong id="wc-word-count">0</strong> <?php esc_html_e('Words', 'tabaix'); ?></div>
    <div><strong id="wc-char-count">0</strong> <?php esc_html_e('Characters', 'tabaix'); ?></div>
    <div><strong id="wc-sentence-count">0</strong> <?php esc_html_e('Sentences', 'tabaix'); ?></strong></div>
    <div><strong id="wc-reading-time">0</strong> <?php esc_html_e('min read', 'tabaix'); ?></div>
  </div>

  <button type="button" class="btn btn-primary wc-clear" id="wc-clear"><?php esc_html_e('Clear', 'tabaix'); ?></button>
</div>
