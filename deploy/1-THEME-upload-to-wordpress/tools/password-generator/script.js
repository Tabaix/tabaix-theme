class PasswordGenerator {
  constructor() {
    this.chars = {
      uppercase: 'ABCDEFGHIJKLMNOPQRSTUVWXYZ',
      lowercase: 'abcdefghijklmnopqrstuvwxyz',
      numbers: '0123456789',
      symbols: '!@#$%^&*()_+-=[]{}|;:,.<>?',
      ambiguous: '0Ol1I',
    };

    this.lengthSlider = document.getElementById('pg-length');
    this.lengthValue = document.getElementById('pg-length-value');
    this.passwordField = document.getElementById('pg-password');
    this.generateBtn = document.getElementById('pg-generate');
    this.copyBtn = document.getElementById('pg-copy');
    this.strengthFill = document.getElementById('pg-strength-fill');
    this.strengthLabel = document.getElementById('pg-strength-label');

    this.options = {
      uppercase: document.getElementById('pg-uppercase'),
      lowercase: document.getElementById('pg-lowercase'),
      numbers: document.getElementById('pg-numbers'),
      symbols: document.getElementById('pg-symbols'),
      excludeAmbiguous: document.getElementById('pg-exclude-ambiguous'),
    };

    this.updateLength();
    this.bindEvents();
    this.generate();
  }

  bindEvents() {
    this.lengthSlider.addEventListener('input', () => this.updateLength());
    this.generateBtn.addEventListener('click', () => this.generate());
    this.copyBtn.addEventListener('click', () => this.copy());

    Object.values(this.options).forEach((checkbox) => {
      checkbox.addEventListener('change', () => this.generate());
    });
  }

  updateLength() {
    this.lengthValue.textContent = this.lengthSlider.value;
  }

  getCharset() {
    let charset = '';
    if (this.options.uppercase.checked) charset += this.chars.uppercase;
    if (this.options.lowercase.checked) charset += this.chars.lowercase;
    if (this.options.numbers.checked) charset += this.chars.numbers;
    if (this.options.symbols.checked) charset += this.chars.symbols;

    if (this.options.excludeAmbiguous.checked) {
      charset = charset.split('').filter((char) => !this.chars.ambiguous.includes(char)).join('');
    }

    return charset;
  }

  generate() {
    const length = parseInt(this.lengthSlider.value, 10);
    const charset = this.getCharset();

    if (!charset) {
      window.alert('Please select at least one character type.');
      return;
    }

    const password = Array.from(crypto.getRandomValues(new Uint32Array(length)))
      .map((value) => charset[value % charset.length])
      .join('');

    this.passwordField.value = password;
    this.updateStrength(password);
    this.addToHistory(password);
  }

  updateStrength(password) {
    let strength = 0;
    if (password.length >= 12) strength += 20;
    if (password.length >= 16) strength += 10;
    if (password.length >= 20) strength += 10;
    if (/[a-z]/.test(password)) strength += 15;
    if (/[A-Z]/.test(password)) strength += 15;
    if (/[0-9]/.test(password)) strength += 15;
    if (/[^a-zA-Z0-9]/.test(password)) strength += 15;

    strength = Math.min(strength, 100);
    this.strengthFill.style.width = `${strength}%`;

    if (strength < 40) {
      this.strengthFill.style.backgroundColor = '#ef4444';
      this.strengthLabel.textContent = 'Weak';
    } else if (strength < 70) {
      this.strengthFill.style.backgroundColor = '#f59e0b';
      this.strengthLabel.textContent = 'Medium';
    } else {
      this.strengthFill.style.backgroundColor = '#10b981';
      this.strengthLabel.textContent = 'Strong';
    }
  }

  async copy() {
    try {
      await navigator.clipboard.writeText(this.passwordField.value);
      const textEl = this.copyBtn.querySelector('span');
      const originalText = textEl.textContent;
      textEl.textContent = 'Copied!';
      setTimeout(() => { textEl.textContent = originalText; }, 2000);
    } catch (error) {
      this.passwordField.select();
      document.execCommand('copy');
    }
  }

  addToHistory(password) {
    const historyList = document.getElementById('pg-history-list');
    const item = document.createElement('li');
    item.className = 'pg-history-item';
    item.innerHTML = `
      <span class="pg-history-password">${password}</span>
      <button type="button" class="pg-history-copy" data-password="${password}">Copy</button>
    `;

    const copyButton = item.querySelector('.pg-history-copy');
    copyButton.addEventListener('click', (event) => {
      navigator.clipboard.writeText(event.target.dataset.password);
      event.target.textContent = 'Copied!';
      setTimeout(() => { event.target.textContent = 'Copy'; }, 2000);
    });

    historyList.insertBefore(item, historyList.firstChild);
    while (historyList.children.length > 5) {
      historyList.removeChild(historyList.lastChild);
    }
  }
}

document.addEventListener('DOMContentLoaded', () => {
  new PasswordGenerator();
});
