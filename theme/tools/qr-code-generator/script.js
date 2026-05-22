class QRCodeGenerator {
  constructor() {
    this.input = document.getElementById('qr-input');
    this.generateBtn = document.getElementById('qr-generate');
    this.output = document.getElementById('qr-output');
    this.downloadLink = document.getElementById('qr-download');

    this.generateBtn.addEventListener('click', () => this.generate());
    this.input.addEventListener('keypress', (event) => {
      if (event.key === 'Enter') {
        event.preventDefault();
        this.generate();
      }
    });
  }

  generate() {
    const text = this.input.value.trim();
    if (!text) {
      window.alert('Please enter text or a URL to generate your QR code.');
      return;
    }

    const size = 260;
    const url = `https://api.qrserver.com/v1/create-qr-code/?size=${size}x${size}&data=${encodeURIComponent(text)}`;
    this.output.innerHTML = `<img src="${url}" alt="QR code">`;
    this.downloadLink.href = url;
    this.downloadLink.style.display = 'inline-flex';
  }
}

document.addEventListener('DOMContentLoaded', () => {
  new QRCodeGenerator();
});
