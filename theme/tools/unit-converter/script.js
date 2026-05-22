class UnitConverter {
  constructor() {
    this.valueInput = document.getElementById('uc-value');
    this.fromSelect = document.getElementById('uc-from');
    this.toSelect = document.getElementById('uc-to');
    this.output = document.getElementById('uc-output');
    this.convertBtn = document.getElementById('uc-convert');

    this.convertBtn.addEventListener('click', () => this.convert());
    this.convert();
  }

  convert() {
    const value = parseFloat(this.valueInput.value) || 0;
    const from = this.fromSelect.value;
    const to = this.toSelect.value;
    const fromType = this.getType(from);
    const toType = this.getType(to);

    if (fromType !== toType) {
      this.output.textContent = 'Conversion not supported between different unit types.';
      return;
    }

    const baseValue = this.toBase(value, from, fromType);
    const result = this.fromBase(baseValue, to, toType);

    this.output.textContent = `${result.toLocaleString(undefined, { maximumFractionDigits: 4 })} ${this.getLabel(to)}`;
  }

  getType(unit) {
    if (['meters', 'kilometers', 'miles'].includes(unit)) {
      return 'length';
    }
    if (['kilograms', 'pounds'].includes(unit)) {
      return 'weight';
    }
    if (['celsius', 'fahrenheit'].includes(unit)) {
      return 'temperature';
    }
    return '';
  }

  toBase(value, unit, type) {
    if (type === 'length') {
      switch (unit) {
        case 'kilometers': return value * 1000;
        case 'miles': return value * 1609.34;
        default: return value;
      }
    }

    if (type === 'weight') {
      switch (unit) {
        case 'pounds': return value * 0.453592;
        default: return value;
      }
    }

    if (type === 'temperature') {
      return unit === 'fahrenheit' ? (value - 32) * (5 / 9) : value;
    }

    return value;
  }

  fromBase(value, unit, type) {
    if (type === 'length') {
      switch (unit) {
        case 'kilometers': return value / 1000;
        case 'miles': return value / 1609.34;
        default: return value;
      }
    }

    if (type === 'weight') {
      switch (unit) {
        case 'pounds': return value / 0.453592;
        default: return value;
      }
    }

    if (type === 'temperature') {
      return unit === 'fahrenheit' ? value * (9 / 5) + 32 : value;
    }

    return value;
  }

  getLabel(unit) {
    switch (unit) {
      case 'kilometers': return 'km';
      case 'meters': return 'm';
      case 'miles': return 'mi';
      case 'kilograms': return 'kg';
      case 'pounds': return 'lb';
      case 'fahrenheit': return '°F';
      case 'celsius': return '°C';
      default: return unit;
    }
  }
}

document.addEventListener('DOMContentLoaded', () => {
  new UnitConverter();
});
