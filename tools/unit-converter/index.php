<div class="tool-shell unit-converter" id="unit-converter-tool">
  <header class="tool-panel-header">
    <h2><?php esc_html_e('Unit Converter', 'tabaix'); ?></h2>
    <p><?php esc_html_e('Convert length, weight, and temperature units instantly.', 'tabaix'); ?></p>
  </header>

  <div class="uc-grid">
    <label class="uc-field">
      <span><?php esc_html_e('Value', 'tabaix'); ?></span>
      <input type="number" id="uc-value" value="1" step="any">
    </label>

    <label class="uc-field">
      <span><?php esc_html_e('From', 'tabaix'); ?></span>
      <select id="uc-from">
        <option value="meters"><?php esc_html_e('Meters', 'tabaix'); ?></option>
        <option value="kilometers"><?php esc_html_e('Kilometers', 'tabaix'); ?></option>
        <option value="miles"><?php esc_html_e('Miles', 'tabaix'); ?></option>
        <option value="pounds"><?php esc_html_e('Pounds', 'tabaix'); ?></option>
        <option value="kilograms"><?php esc_html_e('Kilograms', 'tabaix'); ?></option>
        <option value="celsius"><?php esc_html_e('Celsius', 'tabaix'); ?></option>
      </select>
    </label>

    <label class="uc-field">
      <span><?php esc_html_e('To', 'tabaix'); ?></span>
      <select id="uc-to">
        <option value="kilometers"><?php esc_html_e('Kilometers', 'tabaix'); ?></option>
        <option value="meters"><?php esc_html_e('Meters', 'tabaix'); ?></option>
        <option value="miles"><?php esc_html_e('Miles', 'tabaix'); ?></option>
        <option value="kilograms"><?php esc_html_e('Kilograms', 'tabaix'); ?></option>
        <option value="pounds"><?php esc_html_e('Pounds', 'tabaix'); ?></option>
        <option value="fahrenheit"><?php esc_html_e('Fahrenheit', 'tabaix'); ?></option>
      </select>
    </label>
  </div>

  <button type="button" class="btn btn-primary" id="uc-convert"><?php esc_html_e('Convert', 'tabaix'); ?></button>

  <div class="uc-result">
    <span><?php esc_html_e('Result', 'tabaix'); ?></span>
    <strong id="uc-output">0</strong>
  </div>
</div>
