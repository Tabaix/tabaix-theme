<div class="tool-shell password-generator" id="password-generator-tool">
  <div class="pg-display">
    <input type="text" id="pg-password" class="pg-password-field" readonly value="<?php esc_attr_e('Generate a password', 'tabaix'); ?>">
    <button type="button" class="pg-copy-btn" id="pg-copy">
      <span><?php esc_html_e('Copy', 'tabaix'); ?></span>
    </button>
  </div>

  <div class="pg-strength">
    <div class="pg-strength-bar">
      <div class="pg-strength-fill" id="pg-strength-fill"></div>
    </div>
    <span class="pg-strength-label" id="pg-strength-label">-</span>
  </div>

  <div class="pg-options">
    <div class="pg-option">
      <label class="pg-option-label">
        <span><?php esc_html_e('Password Length', 'tabaix'); ?></span>
        <span id="pg-length-value">12</span>
      </label>
      <input type="range" id="pg-length" min="4" max="64" value="12" class="pg-slider">
    </div>

    <div class="pg-option">
      <label class="pg-checkbox"><input type="checkbox" id="pg-uppercase" checked><span><?php esc_html_e('Uppercase (A-Z)', 'tabaix'); ?></span></label>
    </div>
    <div class="pg-option">
      <label class="pg-checkbox"><input type="checkbox" id="pg-lowercase" checked><span><?php esc_html_e('Lowercase (a-z)', 'tabaix'); ?></span></label>
    </div>
    <div class="pg-option">
      <label class="pg-checkbox"><input type="checkbox" id="pg-numbers" checked><span><?php esc_html_e('Numbers (0-9)', 'tabaix'); ?></span></label>
    </div>
    <div class="pg-option">
      <label class="pg-checkbox"><input type="checkbox" id="pg-symbols"><span><?php esc_html_e('Symbols (!@#$%^&*)', 'tabaix'); ?></span></label>
    </div>
    <div class="pg-option">
      <label class="pg-checkbox"><input type="checkbox" id="pg-exclude-ambiguous"><span><?php esc_html_e('Exclude Ambiguous (0, O, l, 1, I)', 'tabaix'); ?></span></label>
    </div>
  </div>

  <button type="button" class="btn btn-primary btn-lg pg-generate" id="pg-generate"><?php esc_html_e('Generate Password', 'tabaix'); ?></button>

  <div class="pg-history">
    <h3><?php esc_html_e('Recent Passwords', 'tabaix'); ?></h3>
    <ul id="pg-history-list" class="pg-history-list"></ul>
  </div>
</div>
