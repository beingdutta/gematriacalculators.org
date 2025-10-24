/**
 * Sanitize a name: trim, to lowercase, remove spaces.
 */
function sanitizeName(name) {
  return name.trim().toLowerCase().replace(/\s+/g, '');
}

/**
 * Compute the FLAME result for two names:
 * 1) Remove all matching letters between sanitized arrays.
 * 2) Count remaining letters.
 * 3) Eliminate from ['F','L','A','M','E','S'] until one letter remains.
 */
function computeFlame(nameA, nameB) {
  let arrA = sanitizeName(nameA).split('');
  let arrB = sanitizeName(nameB).split('');

  // Remove common letters one-to-one
  for (let i = 0; i < arrA.length; i++) {
    const ch = arrA[i];
    const idx = arrB.indexOf(ch);
    if (idx !== -1) {
      arrA[i] = '';
      arrB[idx] = '';
    }
  }
  arrA = arrA.filter(c => c !== '');
  arrB = arrB.filter(c => c !== '');

  // Count leftover letters
  const count = arrA.length + arrB.length;
  if (count === 0) {
    return { letter: 'S', label: 'Siblings', emoji: '👫' };
  }

  // Start with FLAMES array
  let flames = ['F', 'L', 'A', 'M', 'E', 'S'];
  while (flames.length > 1) {
    const rem = count % flames.length;
    const idxToRemove = rem === 0 ? (flames.length - 1) : (rem - 1);
    flames.splice(idxToRemove, 1);
    flames = flames.slice(idxToRemove).concat(flames.slice(0, idxToRemove));
  }

  const finalLetter = flames[0];
  let label, emoji;
  switch (finalLetter) {
    case 'F':
      label = 'Friends';
      emoji = '🤝';
      break;
    case 'L':
      label = 'Love';
      emoji = '❤️';
      break;
    case 'A':
      label = 'Affection';
      emoji = '💖';
      break;
    case 'M':
      label = 'Marriage';
      emoji = '💍';
      break;
    case 'E':
      label = 'Enemies';
      emoji = '⚔️';
      break;
    case 'S':
      label = 'Siblings';
      emoji = '👫';
      break;
    default:
      label = 'Unknown';
      emoji = '❓';
  }

  return { letter: finalLetter, label, emoji };
}

/**
 * Show the modal with a spinner, then after 3s show the result.
 */
function runFlameCalculation() {
  const nameAEl = document.getElementById('yourName');
  const nameBEl = document.getElementById('partnerName');
  const inputError = document.getElementById('inputError');

  const nameA = nameAEl.value.trim();
  const nameB = nameBEl.value.trim();

  if (!nameA || !nameB) {
    inputError.style.display = 'block';
    setTimeout(() => { inputError.style.display = 'none'; }, 3000);
    return;
  }

  // Show modal overlay immediately
  const overlay = document.getElementById('flameModalOverlay');
  overlay.style.display = 'flex';

  // Show spinner, hide result initially
  document.getElementById('modalSpinner').style.display = 'block';
  document.getElementById('modalResult').style.display = 'none';

  // Set header text: NameA 🔥 NameB
  document.getElementById('modalNameA').textContent = nameA;
  document.getElementById('modalNameB').textContent = nameB;

  // After 3 seconds: hide spinner, compute & show result
  setTimeout(() => {
    document.getElementById('modalSpinner').style.display = 'none';

    const result = computeFlame(nameA, nameB);
    document.getElementById('displayNameA').textContent = nameA;
    document.getElementById('displayNameB').textContent = nameB;
    document.getElementById('resultEmoji').textContent = result.emoji;
    document.getElementById('resultText').textContent = result.label;

    document.getElementById('modalResult').style.display = 'block';
  }, 3000);
}

/** Close the modal overlay */
function closeFlameModal() {
  document.getElementById('flameModalOverlay').style.display = 'none';
}

/** Clear both inputs and hide the modal */
function resetFlameCalculator() {
  document.getElementById('yourName').value = '';
  document.getElementById('partnerName').value = '';
  closeFlameModal();
  document.getElementById('yourName').focus();
}

/** Toggle light/dark theme (same as index.php) */
function toggleTheme() {
  const html = document.documentElement;
  const curr = html.getAttribute('data-theme');
  const next = (curr === 'light') ? 'dark' : 'light';
  html.setAttribute('data-theme', next);
  localStorage.setItem('theme', next);
}

/** On page load, restore saved theme and set logo */
document.addEventListener('DOMContentLoaded', () => {
  const savedTheme = localStorage.getItem('theme') || 'light';
  document.documentElement.setAttribute('data-theme', savedTheme);

  const headerImg = document.getElementById('themeLogo');
  if (headerImg) {
    headerImg.src = '/assets/flame-icon-128.png';
  }

  // Set initial theme toggle icon
  const button = document.querySelector('.theme-toggle');
  if (button) {
    const sunIcon = button.querySelector('.icon-sun');
    const moonIcon = button.querySelector('.icon-moon');
    if (sunIcon && moonIcon) {
      sunIcon.style.display = (savedTheme === 'light') ? 'block' : 'none';
      moonIcon.style.display = (savedTheme === 'dark') ? 'block' : 'none';
    }
  }
});

/** FAQ toggle (same as index.php) */
function toggleFAQ(element) {
  const faqItem = element.parentElement;
  faqItem.classList.toggle('active');
}
