class WordCounter {
  constructor() {
    this.input = document.getElementById('wc-input');
    this.wordCount = document.getElementById('wc-word-count');
    this.charCount = document.getElementById('wc-char-count');
    this.sentenceCount = document.getElementById('wc-sentence-count');
    this.readingTime = document.getElementById('wc-reading-time');
    this.clearButton = document.getElementById('wc-clear');

    this.bindEvents();
    this.updateMetrics();
  }

  bindEvents() {
    this.input.addEventListener('input', () => this.updateMetrics());
    this.clearButton.addEventListener('click', () => this.clearText());
  }

  updateMetrics() {
    const text = this.input.value.trim();
    const words = text ? text.match(/\b\w+\b/g) || [] : [];
    const sentences = text ? text.match(/[.!?](\s|$)/g) || [] : [];

    const wordCount = words.length;
    const charCount = text.length;
    const sentenceCount = sentences.length;
    const readingMinutes = Math.max(1, Math.round(wordCount / 200));

    this.wordCount.textContent = wordCount;
    this.charCount.textContent = charCount;
    this.sentenceCount.textContent = sentenceCount;
    this.readingTime.textContent = readingMinutes;
  }

  clearText() {
    this.input.value = '';
    this.updateMetrics();
  }
}

document.addEventListener('DOMContentLoaded', () => {
  new WordCounter();
});
