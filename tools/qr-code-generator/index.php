<div class="tool-shell qr-code-generator" id="qr-code-generator-tool">
  <header class="tool-panel-header">
    <h2><?php esc_html_e('QR Code Generator', 'tabaix'); ?></h2>
    <p><?php esc_html_e('Create a shareable QR code for any URL or text.', 'tabaix'); ?></p>
  </header>

  <label class="qr-field">
    <span><?php esc_html_e('Text or URL', 'tabaix'); ?></span>
    <input type="text" id="qr-input" placeholder="<?php esc_attr_e('Enter text or URL', 'tabaix'); ?>">
  </label>

  <button type="button" class="btn btn-primary" id="qr-generate"><?php esc_html_e('Generate QR Code', 'tabaix'); ?></button>

  <div class="qr-output" id="qr-output">
    <span><?php esc_html_e('Your QR code will appear here.', 'tabaix'); ?></span>
  </div>

  <a id="qr-download" class="btn btn-secondary" href="#" download="qrcode.png" style="display:none;"><?php esc_html_e('Download QR', 'tabaix'); ?></a>
</div>
