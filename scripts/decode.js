function clearDecodeInput() {
  document.getElementById('decodeInput').value = '';
  document.getElementById('decodeResult').style.display = 'none';
  document.getElementById('loading').style.display = 'none';
}

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
