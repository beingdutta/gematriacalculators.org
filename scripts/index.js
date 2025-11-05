function copyValue(valueId, notificationId) {
    const value = document.getElementById(valueId).textContent;
    const notification = document.getElementById(notificationId);
    
    navigator.clipboard.writeText(value).then(() => {
        notification.style.display = 'block';
        setTimeout(() => {
            notification.style.display = 'none';
        }, 2000);
    }).catch(err => {
        console.error('Failed to copy:', err);
    });
}

const hebrewMap = {
    'A':1, 'B':2, 'C':3, 'D':4, 'E':5, 'F':6, 'G':7, 'H':8, 'I':9, 'J':10,
    'K':10, 'L':20, 'M':30, 'N':40, 'O':50, 'P':60, 'Q':70, 'R':80, 'S':90,
    'T':100, 'U':200, 'V':300, 'W':400, 'X':500, 'Y':600, 'Z':700
};

function calculateGematria(word) {
    const upperWord = word.toUpperCase().replace(/[^A-Z]/g, '');
    let hebrew = 0, english = 0, simple = 0;
    let hebrewBreakdown = [], englishBreakdown = [], simpleBreakdown = [];

    upperWord.split('').forEach(char => {
        const hVal = hebrewMap[char] || 0;
        hebrew += hVal;
        hebrewBreakdown.push(`${char}:${hVal}`);

        const sVal = char.charCodeAt(0) - 64;
        simple += sVal;
        simpleBreakdown.push(`${char}:${sVal}`);

        const eVal = sVal * 6;
        english += eVal;
        englishBreakdown.push(`${char}:${eVal}`);
    });

    return {
        hebrew: {total: hebrew, breakdown: hebrewBreakdown},
        english: {total: english, breakdown: englishBreakdown},
        simple: {total: simple, breakdown: simpleBreakdown}
    };
}


function calculate() {
    const inputEl = document.getElementById('inputText');
    const query   = inputEl.value.trim();
    if (!query) {
      inputEl.classList.add('error');
      setTimeout(() => inputEl.classList.remove('error'), 500);
      alert('Please enter some text to calculate!');
      return;
    }
  
    const loading     = document.getElementById('loading');
    const resultDiv   = document.querySelector('.result');
    const globalFdbk  = document.getElementById('globalFeedback');
  
    // show spinner immediately
    loading.style.display   = 'flex';
    resultDiv.style.display = 'none';
  
    // wait 3s, then fire your AJAX + UI update
    setTimeout(() => {
      fetch('/calculate.php', {
        method: 'POST',
        headers: {'Content-Type':'application/x-www-form-urlencoded'},
        body: 'input=' + encodeURIComponent(query)
      })
      .then(res => res.json())
      .then(data => {
        // totals
        document.getElementById('hebrewValue').textContent  = data.hebrew.total;
        document.getElementById('englishValue').textContent = data.english.total;
        document.getElementById('simpleValue').textContent  = data.simple.total;
  
        // breakdowns
        document.getElementById('hebrewBreakdown').innerHTML  =
          'Calculation: ' + data.hebrew.breakdown.join(' + ');
        document.getElementById('englishBreakdown').innerHTML =
          'Calculation: (' + data.simple.breakdown.join(' + ') + ') × 6';
        document.getElementById('simpleBreakdown').innerHTML  =
          'Calculation: ' + data.simple.breakdown.join(' + ');
  
        resultDiv.style.display = 'block';
        globalFdbk.textContent  = '✓ Results calculated successfully!';
        globalFdbk.style.display = 'block';
        setTimeout(() => globalFdbk.style.display = 'none', 7000);
      })
      .catch(err => {
        console.error(err);
        globalFdbk.textContent = '⚠️ Error calculating results';
        globalFdbk.style.display = 'block';
        setTimeout(() => globalFdbk.style.display = 'none', 3000);
      })
      .finally(() => {
        loading.style.display = 'none';
      });
    }, 6000);
    
    // This 8000 ms (8 s) is the artificial timeout.
  }

function clearInput() {
    document.getElementById('inputText').value = '';
    document.querySelector('.result').style.display = 'none';
    document.getElementById('loading').style.display = 'none';
}

function toggleTheme() {
  const html = document.documentElement;
  const currentTheme = html.getAttribute('data-theme');
  const newTheme = currentTheme === 'light' ? 'dark' : 'light';
  html.setAttribute('data-theme', newTheme);
  localStorage.setItem('theme', newTheme);

  // Swap header image immediately
  const headerImage = document.getElementById('themeLogo');
  if (headerImage) {
    if (newTheme === 'dark') {
      headerImage.src = '/assets/talisman-wh-header-icon.png';
    } else {
      headerImage.src = '/assets/talisman-header-icon.png';
    }
  }

  // Swap theme toggle icon
  document.querySelectorAll('.theme-toggle').forEach(button => {
    const sunIcon = button.querySelector('.icon-sun');
    const moonIcon = button.querySelector('.icon-moon');
    if (sunIcon && moonIcon) {
      if (newTheme === 'dark') {
        sunIcon.style.display = 'none';
        moonIcon.style.display = 'block';
      } else {
        sunIcon.style.display = 'block';
        moonIcon.style.display = 'none';
      }
    }
  });
}

// Initialize theme and header image
document.addEventListener('DOMContentLoaded', () => {
  // Mobile menu toggle
  const menuToggle = document.querySelector('.mobile-menu-toggle');
  const navLinks = document.querySelector('.nav-links');
  if (menuToggle && navLinks) {
      menuToggle.addEventListener('click', () => {
          navLinks.classList.toggle('active');
      });
  }

  // Language popup functionality
  const langChangeBtn = document.querySelector('.lang-change-btn');
  const langPopup = document.querySelector('.lang-popup');
  const langPopupClose = document.querySelector('.lang-popup-close');

  if (langChangeBtn && langPopup) {
      langChangeBtn.addEventListener('click', () => {
          langPopup.classList.add('active');
      });
  }

  if (langPopupClose && langPopup) {
      langPopupClose.addEventListener('click', () => {
          langPopup.classList.remove('active');
      });

      // Close popup when clicking outside
      langPopup.addEventListener('click', (e) => {
          if (e.target === langPopup) {
              langPopup.classList.remove('active');
          }
      });
  }

  const savedTheme = localStorage.getItem('theme') || 'light';
  document.documentElement.setAttribute('data-theme', savedTheme);

  const headerImage = document.getElementById('themeLogo');
  if (headerImage) {
    // If we've loaded in "dark" mode, use the white‐text header; otherwise use the normal PNG
    if (savedTheme === 'dark') {
      headerImage.src = '/assets/talisman-wh-header-icon.png';
    } else {
      headerImage.src = '/assets/talisman-header-icon.png';
    }
  }

  // Set initial theme toggle icon
  document.querySelectorAll('.theme-toggle').forEach(button => {
    const sunIcon = button.querySelector('.icon-sun');
    const moonIcon = button.querySelector('.icon-moon');
    if (sunIcon && moonIcon) {
      if (savedTheme === 'dark') {
        sunIcon.style.display = 'none';
        moonIcon.style.display = 'block';
      } else {
        sunIcon.style.display = 'block';
        moonIcon.style.display = 'none';
      }
    }
  });
});

function sendFeedback(emoji) {
    const feedbackMessage = document.getElementById('feedbackMessage');
    feedbackMessage.textContent = "Thanks for your feedback!";
    feedbackMessage.style.display = 'block';
    
    setTimeout(() => {
        feedbackMessage.style.display = 'none';
    }, 2000);
    
    console.log('User feedback:', emoji);
}

function toggleFAQ(element) {
    const faqItem = element.parentElement;
    faqItem.classList.toggle('active');
}

// Mobile Navigation
function initMobileNavigation() {
  const menuToggle = document.querySelector('.mobile-menu-toggle');
  const navLinks = document.querySelector('.nav-links');
  
  if (menuToggle && navLinks) {
    menuToggle.addEventListener('click', () => {
      navLinks.classList.toggle('active');
    });
  }
}

// Language Popup
function initLanguagePopup() {
  const langChangeBtn = document.querySelector('.lang-change-btn');
  const langPopup = document.querySelector('.lang-popup');
  const langPopupClose = document.querySelector('.lang-popup-close');

  if (langChangeBtn && langPopup) {
    langChangeBtn.addEventListener('click', () => {
      langPopup.classList.add('active');
    });
  }

  if (langPopupClose && langPopup) {
    langPopupClose.addEventListener('click', () => {
      langPopup.classList.remove('active');
    });

    // Close popup when clicking outside
    langPopup.addEventListener('click', (e) => {
      if (e.target === langPopup) {
        langPopup.classList.remove('active');
      }
    });
  }
}

// Initialize mobile features
document.addEventListener('DOMContentLoaded', () => {
  initMobileNavigation();
  initLanguagePopup();
});

// For PDF Generation.
function generatePDFContent(input, results) {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    const mainBlue = [44, 62, 80]; // Table header & branding color

    // Header
    doc.setFontSize(18);
    doc.setFont('helvetica', 'bold');
    doc.text('Gematria Calculator Results', 15, 20);

    // Date
    doc.setFontSize(10);
    doc.setFont('helvetica', 'normal');
    doc.text(`Generated: ${new Date().toLocaleString()}`, 15, 27);

    // Input Text
    doc.setFontSize(14); // Increased size
    doc.setFont('helvetica', 'bold');
    doc.setTextColor(...mainBlue); // Same shade of blue
    doc.text(`Input Text: ${input}`, 15, 45);

    // Reset before table
    doc.setFont('helvetica', 'normal');
    doc.setTextColor(0, 0, 0);

    // Results Table
    doc.autoTable({
        startY: 50,
        head: [['Type', 'Value', 'Calculation']],
        body: [
            ['Hebrew Gematria', results.hebrew.total, results.hebrew.breakdown.join(' + ')],
            ['English Gematria', results.english.total, `(${results.simple.breakdown.join(' + ')}) × 6`],
            ['Simple Gematria', results.simple.total, results.simple.breakdown.join(' + ')]
        ],
        theme: 'grid',
        styles: { fontSize: 10 },
        headStyles: { fillColor: mainBlue },
        columnStyles: {
            0: { fontStyle: 'bold' },
            1: { cellWidth: 30 },
            2: { cellWidth: 120 }
        }
    });

    // Footer note directly after table
    let y = doc.lastAutoTable.finalY + 10;
    doc.setFontSize(14); // Increased from 10
    doc.setFont('helvetica', 'italic');
    doc.setTextColor(80, 80, 80);
    doc.text('Generated by gematriacalculators.org', 15, y);

    y += 24;
    doc.setFontSize(14);
    doc.setFont('helvetica', 'bold');
    doc.setTextColor(0, 0, 0);

    const pageWidth = doc.internal.pageSize.getWidth();
    const promoHeader = 'You may like our other tools below — Click to visit:';
    doc.text(promoHeader, (pageWidth - doc.getTextWidth(promoHeader)) / 2, y);

    // Tool Links (center aligned, no emojis)
    doc.setFontSize(14);
    doc.setFont('helvetica', 'normal');
    doc.setTextColor(...mainBlue);

    y += 15;
    const link1 = 'Snowaday Calculator for US';
    const link2 = 'Online Tarot Reading';
    const link3 = 'Digipin Finder';

    doc.textWithLink(link1, (pageWidth - doc.getTextWidth(link1)) / 2, y, {
        url: 'https://www.snowdayscalculatorai.com/'
    });

    y += 15;
    doc.textWithLink(link2, (pageWidth - doc.getTextWidth(link2)) / 2, y, {
        url: 'http://tarotcardgenerator.online/'
    });

    y += 15;
    doc.textWithLink(link3, (pageWidth - doc.getTextWidth(link3)) / 2, y, {
        url: 'http://whatsmydigipin.in/'
    });

    return doc;
}



// Update calculateAndDownload function
function calculateAndDownload() {
    const input = document.getElementById('inputText');
    const value = input.value.trim();
    const globalFeedback = document.getElementById('globalFeedback');
    
    if(!value) {
        input.classList.add('error');
        setTimeout(() => input.classList.remove('error'), 500);
        alert('Please enter some text to calculate!');
        return;
    }

    const loading = document.getElementById('loading');
    loading.style.display = 'flex';
    
    setTimeout(() => {
        try {
            const results = calculateGematria(value);
            const doc = generatePDFContent(value, results);
            doc.save(`gematria-result-${value}.pdf`);
            
            // Show global feedback
            globalFeedback.textContent = "✓ PDF downloaded successfully!";
            globalFeedback.style.display = 'block';
            setTimeout(() => {
                globalFeedback.style.display = 'none';
            }, 3000);
            
        } catch (error) {
            console.error('PDF generation failed:', error);
            globalFeedback.textContent = "⚠️ Error generating PDF";
            globalFeedback.style.display = 'block';
            setTimeout(() => {
                globalFeedback.style.display = 'none';
            }, 3000);
        } finally {
            loading.style.display = 'none';
        }
    }, 3000);
}

// ——— Ticker population & click handler ———
document.addEventListener('DOMContentLoaded', () => {
    const recent = [
      'patterns whisper from the void',
      'geometry sings the unseen',
      'numbers weave the hidden hymn',
      'cosmos etched in ratios',
      'prime sparks of living light',
      'orbits as sacred script',
      'alpha and omega in code',
      'fractal breath of creation',
      'truth spirals through measure',
      'harmony nested in intervals',
      'the matrix hums with meaning',
      'light counts the steps of time',
      'veils lift at golden angles',
      'sigils carved in symmetry',
      'order awakening from silence'
    ];
    
    function initializeTicker() {
        const list = document.querySelector('.ticker__list');
        if (!list) return;
        
        // Clear existing content
        list.innerHTML = '';
        
        // Create three sets of items for seamless infinite scroll
        const items = [...recent, ...recent, ...recent];
        
        items.forEach(text => {
            const card = document.createElement('div');
            card.className = 'ticker__item';
            card.textContent = text;
            card.addEventListener('click', () => {
                const input = document.getElementById('inputText');
                input.value = text;
                input.focus();
            });
            list.appendChild(card);
        });
        
        // Reset animation when it completes
        const handleAnimationEnd = () => {
            list.style.animation = 'none';
            list.offsetHeight; // Trigger reflow
            list.style.animation = null;
        };
        
        list.addEventListener('animationend', handleAnimationEnd);
    }
    
    // Initialize ticker
    initializeTicker();
    
    // Reinitialize ticker if it becomes hidden (e.g., tab switch)
    document.addEventListener('visibilitychange', () => {
        if (!document.hidden) {
            initializeTicker();
        }
    });
    
    // Reinitialize every 5 minutes as a fallback
    setInterval(initializeTicker, 300000);
});


// ─── Exit-Intent / Timed Modal Logic ────────

let exitModalShown = false;
const modal       = document.getElementById('exitModal');
const closeBtn    = document.getElementById('exitModalClose');

function showExitModal() {
  if (exitModalShown) return;
  exitModalShown = true;
  modal.style.display = 'flex';
}

function hideExitModal() {
  modal.style.display = 'none';
}

// 1) Show after 25 seconds on page
window.addEventListener('DOMContentLoaded', () => {
  setTimeout(showExitModal, 30000);

  // 2) Exit-intent: when mouse leaves at the top
  document.addEventListener('mouseout', e => {
    if (!e.toElement && !e.relatedTarget && e.clientY <= 0) {
      showExitModal();
    }
  });
});

// Close handlers
closeBtn.addEventListener('click', hideExitModal);
modal.addEventListener('click', e => {
  if (e.target === modal) hideExitModal();
});

document.addEventListener('DOMContentLoaded', () => {
    // Mobile menu toggle functionality
    const menuToggle = document.querySelector('.mobile-menu-toggle');
    const navLinks = document.querySelector('.nav-links');

    if (menuToggle && navLinks) {
        menuToggle.addEventListener('click', () => {
            navLinks.classList.toggle('active');
        });
    }

    // Language change button functionality
    const langChangeBtn = document.querySelector('.lang-change-btn');
    const langPopup = document.querySelector('.lang-popup');

    if (langChangeBtn && langPopup) {
        langChangeBtn.addEventListener('click', () => {
            langPopup.classList.toggle('active');
        });
    }
});