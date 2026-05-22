class ImageCompressor {
  constructor() {
    this.fileInput = document.getElementById('ic-file');
    this.qualityInput = document.getElementById('ic-quality');
    this.qualityValue = document.getElementById('ic-quality-value');
    this.compressButton = document.getElementById('ic-compress');
    this.preview = document.getElementById('ic-preview');
    this.downloadLink = document.getElementById('ic-download');
    this.image = null;

    this.bindEvents();
  }

  bindEvents() {
    this.fileInput.addEventListener('change', (event) => this.handleFile(event));
    this.qualityInput.addEventListener('input', () => this.updateQuality());
    this.compressButton.addEventListener('click', () => this.compressImage());
  }

  updateQuality() {
    this.qualityValue.textContent = `${this.qualityInput.value}%`;
  }

  handleFile(event) {
    const file = event.target.files[0];
    if (!file || !file.type.startsWith('image/')) {
      return;
    }

    const reader = new FileReader();
    reader.onload = () => {
      this.image = new Image();
      this.image.onload = () => {
        this.renderPreview(this.image.src);
      };
      this.image.src = reader.result;
    };
    reader.readAsDataURL(file);
  }

  renderPreview(src) {
    this.preview.innerHTML = `<img src="${src}" alt="Compressed preview">`;
  }

  compressImage() {
    if (!this.image) {
      window.alert('Please select an image first.');
      return;
    }

    const canvas = document.createElement('canvas');
    const ratio = Math.min(1280 / this.image.width, 1280 / this.image.height, 1);
    canvas.width = Math.round(this.image.width * ratio);
    canvas.height = Math.round(this.image.height * ratio);

    const ctx = canvas.getContext('2d');
    ctx.drawImage(this.image, 0, 0, canvas.width, canvas.height);

    const quality = parseInt(this.qualityInput.value, 10) / 100;
    canvas.toBlob((blob) => {
      const url = URL.createObjectURL(blob);
      this.downloadLink.href = url;
      this.downloadLink.style.display = 'inline-flex';
      this.renderPreview(url);
    }, 'image/jpeg', quality);
  }
}

document.addEventListener('DOMContentLoaded', () => {
  new ImageCompressor();
});
