// COPY-TO-CLIPBOARD (reuse)
function copyValue(valueId, notificationId) {
    const text = document.getElementById(valueId).textContent;
    const notif = document.getElementById(notificationId);
    navigator.clipboard.writeText(text)
      .then(() => {
        notif.style.display = 'block';
        setTimeout(() => notif.style.display = 'none', 2000);
      })
      .catch(err => console.error('Copy failed:', err));
  }
  
  function clearDecodeInput() {
    document.getElementById('decodeInput').value = '';
    document.getElementById('decodeResult').style.display = 'none';
    document.getElementById('loading').style.display = 'none';
  }
  
  // THEME TOGGLE + INIT (reuse)
  function toggleTheme() {
    const html = document.documentElement;
    const next = html.getAttribute('data-theme') === 'light' ? 'dark' : 'light';
    html.setAttribute('data-theme', next);
    localStorage.setItem('theme', next);
  }
  document.addEventListener('DOMContentLoaded', () => {
    const saved = localStorage.getItem('theme') || 'light';
    document.documentElement.setAttribute('data-theme', saved);
    const logo = document.getElementById('themeLogo');
    if (logo) logo.src = '/assets/header-image.webp';
  });
  
  // GREEDY DECODE: sum = total/6 → peel off 26→1
  function greedyDecode(total) {
    if (total % 6 !== 0) return '';        // no exact match
    let sum = total / 6;
    const letters = [];
    while (sum > 0) {
      const val = Math.min(26, sum);
      letters.push(String.fromCharCode(64 + val));
      sum -= val;
    }
    return letters.join('');
  }
  
  // MAIN DECODE ENTRY
  function decode() {
    const inputEl = document.getElementById('decodeInput');
    const raw = inputEl.value.trim();
    if (!raw) {
      inputEl.classList.add('error');
      setTimeout(() => inputEl.classList.remove('error'), 500);
      alert('Please enter at least one numeric total to decode!');
      return;
    }
  
    const loading = document.getElementById('loading');
    loading.style.display = 'flex';
  
    setTimeout(() => {
      try {
        // pull out all numbers, decode each greedily
        const nums = raw.match(/\d+/g) || [];
        const decoded = nums
          .map(n => greedyDecode(parseInt(n, 10)))
          .join(' ');
        document.getElementById('decodedText').textContent = decoded || '(no match)';
        document.getElementById('decodeResult').style.display = 'block';
      } catch (err) {
        console.error('Decode error:', err);
        alert('Error while decoding.');
      } finally {
        loading.style.display = 'none';
      }
    }, 200);
  }
  