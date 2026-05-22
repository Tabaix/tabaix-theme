<div class="tool-shell image-compressor" id="image-compressor-tool">
  <header class="tool-panel-header">
    <h2><?php esc_html_e('Image Compressor', 'tabaix'); ?></h2>
    <p><?php esc_html_e('Compress JPEG images in the browser with a quality slider and download the optimized copy.', 'tabaix'); ?></p>
  </header>

  <label class="ic-dropzone" for="ic-file">
    <input type="file" id="ic-file" accept="image/*">
    <span><?php esc_html_e('Choose an image or drop it here', 'tabaix'); ?></span>
  </label>

  <div class="ic-options">
    <label>
      <span><?php esc_html_e('Quality', 'tabaix'); ?></span>
      <input type="range" id="ic-quality" min="10" max="100" value="80">
      <span id="ic-quality-value">80%</span>
    </label>
  </div>

  <button type="button" class="btn btn-primary" id="ic-compress"><?php esc_html_e('Compress Image', 'tabaix'); ?></button>

  <div class="ic-preview" id="ic-preview"></div>
  <a id="ic-download" class="btn btn-secondary" href="#" download="compressed.jpg" style="display:none;"><?php esc_html_e('Download', 'tabaix'); ?></a>
</div>
