function copyValue(valueId, notificationId) {
    const text = document.getElementById(valueId).textContent;
    const notif = document.getElementById(notificationId);
    if (!text || !notif) return;

    navigator.clipboard.writeText(text)
      .then(() => {
        notif.style.display = 'block';
        setTimeout(() => notif.style.display = 'none', 2000);
      })
      .catch(err => console.error('Copy failed:', err));
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

let loadingInterval = null;

// Default English phrases. This will be overridden if language-specific phrases are provided.
const defaultLoadingPhrases = [
    "Translating words into numbers...",
    "Summoning the codes of creation...",
    "Decoding the hidden numerical patterns...",
    "Aligning letters with divine values...",
    "Calculating your gematria sequence...",
    "Tracing the vibrational sum of your name...",
    "Revealing the secret meaning in numbers..."
  ];


function stopLoadingMessages() {
    clearInterval(loadingInterval);
    document.getElementById('loadingMessage').textContent = '';
}

function calculate() {
    const inputEl = document.getElementById('inputText');
    const query   = inputEl.value.trim();
    if (!query) {
      inputEl.classList.add('error');
      setTimeout(() => inputEl.classList.remove('error'), 6000);
      alert('Please enter some text to calculate!');
      return;
    }
  
    const loading = document.getElementById('loading');
    const resultDiv = document.querySelector('.result');
    const calculatorMain = document.querySelector('main.calculator');
    const globalFdbk = document.getElementById('globalFeedback');
    const header = document.querySelector('header.header');
  
    // show spinner immediately
    loading.style.display = 'flex';
    resultDiv.style.display = 'none'; // ensure results are hidden
    if (header) header.style.display = 'none';

    // Use language-specific phrases if available, otherwise use default English
    const loadingPhrases = window.GematriaLang?.loadingPhrases || defaultLoadingPhrases;

    let i = 0;
    const phraseEl = document.getElementById('loadingMessage');
    phraseEl.textContent = loadingPhrases[i];
    loadingInterval = setInterval(() => {
        i = (i + 1) % loadingPhrases.length;
        phraseEl.textContent = loadingPhrases[i];
    }, 1500);
  
    // Simulate a short delay for UX, then perform client-side calculation
    setTimeout(() => {
        try {
          const data = calculateGematria(query);

          // totals
          document.getElementById('hebrewValue').textContent  = data.hebrew.total;
          document.getElementById('englishValue').textContent = data.english.total;
          document.getElementById('simpleValue').textContent  = data.simple.total;

          // breakdowns
          document.getElementById('hebrewBreakdown').innerHTML  = 'Calculation: ' + data.hebrew.breakdown.join(' + ');
          document.getElementById('englishBreakdown').innerHTML = 'Calculation: (' + data.simple.breakdown.join(' + ') + ') × 6';
          document.getElementById('simpleBreakdown').innerHTML  = 'Calculation: ' + data.simple.breakdown.join(' + ');

          // Update Result Header
          const resultHeader = document.getElementById('resultHeader');
          if (resultHeader) {
             const prefix = window.GematriaLang?.resultHeaderPrefix || "Gematria Output for: ";
             const safeQuery = query.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/"/g, "&quot;").replace(/'/g, "&#039;");
             resultHeader.innerHTML = `${prefix} <span style="color: var(--primary-color);">${safeQuery}</span>`;
          }

          // Hide calculator and show results
          calculatorMain.style.display = 'none';
          resultDiv.style.display = 'block';
          if (header) header.style.display = 'none';
          
          // Move tools section to result area
          document.getElementById('more-tools-original').style.display = 'none';
          document.getElementById('more-tools-result').style.display = 'block';

          globalFdbk.textContent  = '✓ Results calculated successfully!';
          globalFdbk.style.display = 'block';
          setTimeout(() => globalFdbk.style.display = 'none', 3000); // Shorter display for success
        } catch (err) {
          console.error('Client-side calculation error:', err);
          globalFdbk.textContent = '⚠️ Error calculating results';
          globalFdbk.style.display = 'block';
          setTimeout(() => globalFdbk.style.display = 'none', 3000);
        } finally {
          loading.style.display = 'none';
          stopLoadingMessages();
        }
    }, 6000); // artificial delay set back to 6 seconds for better responsiveness

  }

function calculateAgain() {
    const calculatorMain = document.querySelector('main.calculator');
    const resultDiv = document.querySelector('.result');
    const header = document.querySelector('header.header');
    
    resultDiv.style.display = 'none';
    calculatorMain.style.display = 'block';
    if (header) header.style.display = 'block';
    
    // Reset tools section to original area
    document.getElementById('more-tools-original').style.display = 'block';
    document.getElementById('more-tools-result').style.display = 'none';
    
    // Optional: scroll to the top of the calculator and focus the input
    calculatorMain.scrollIntoView({ behavior: 'smooth' });
    document.getElementById('inputText').focus();
}

function clearInput() {
    document.getElementById('inputText').value = '';
    document.querySelector('.result').style.display = 'none';
    document.getElementById('loading').style.display = 'none';
    stopLoadingMessages();
    
    // Reset tools section to original area
    document.getElementById('more-tools-original').style.display = 'block';
    document.getElementById('more-tools-result').style.display = 'none';
}

function toggleMobileMenu() {
    const navLinks = document.querySelector('.nav-links');
    const body = document.body;
    navLinks.classList.toggle('active');
    body.classList.toggle('menu-open');
}

function initMobileNavigation() {
    const menuToggle = document.querySelector('.mobile-menu-toggle');
    const navLinks = document.querySelector('.nav-links');

    if (menuToggle && navLinks) {
        // Handle clicking the hamburger button
        menuToggle.addEventListener('click', (event) => {
            event.stopPropagation(); // Prevent this click from immediately closing the menu
            toggleMobileMenu();
        });

        // Add listener to close menu when clicking outside of it
        document.addEventListener('click', (event) => {
            const isClickInside = navLinks.contains(event.target) || menuToggle.contains(event.target);
            if (navLinks.classList.contains('active') && !isClickInside) {
                toggleMobileMenu();
            }
        });

        // Handle submenu toggling for mobile nav
        navLinks.querySelectorAll('.nav-dropdown-toggle').forEach(toggle => {
            toggle.addEventListener('click', function(e) {
                e.preventDefault();
                const parentDropdown = this.closest('.nav-dropdown');
                if (parentDropdown) {
                    parentDropdown.classList.toggle('open');
                }
            });
        });
    }
}

function openLangPopup() {
    const langPopup = document.querySelector('.lang-popup');
    langPopup.style.display = 'flex'; // Use flex to activate it
    setTimeout(() => langPopup.classList.add('active'), 10); // Add active class for transition
    document.body.classList.add('menu-open');

    // Close the main mobile menu if it's open
    const navLinks = document.querySelector('.nav-links');
    if (navLinks.classList.contains('active')) {
        navLinks.classList.remove('active');
    }
}

function closeLangPopup() {
    const langPopup = document.querySelector('.lang-popup');
    langPopup.classList.remove('active');
    setTimeout(() => langPopup.style.display = 'none', 300); // Hide after transition
    document.body.classList.remove('menu-open');
}

function initLanguagePopup() {
    const langPopup = document.querySelector('.lang-popup');
    if (langPopup) {
        langPopup.addEventListener('click', function(event) {
            if (event.target === this) {
                closeLangPopup();
            }
        });
    }
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
    const faqItem = element.closest('.faq-item');
    if (faqItem) {
        faqItem.classList.toggle('active');
    }
}

// Initialize mobile features
document.addEventListener('DOMContentLoaded', () => {
  // Apply saved theme on page load
  const savedTheme = localStorage.getItem('theme') || 'light';
  document.documentElement.setAttribute('data-theme', savedTheme);

  // Update theme toggle icon to reflect the current theme
  document.querySelectorAll('.theme-toggle').forEach(button => {
    const sunIcon = button.querySelector('.icon-sun');
    const moonIcon = button.querySelector('.icon-moon');
    if (sunIcon && moonIcon) {
      sunIcon.style.display = (savedTheme === 'light') ? 'block' : 'none';
      moonIcon.style.display = (savedTheme === 'dark') ? 'block' : 'none';
    }
  });

  // Update logo based on theme
  const headerImage = document.getElementById('themeLogo');
  if (headerImage) {
    if (savedTheme === 'dark') {
      headerImage.src = '/assets/talisman-wh-header-icon.png';
    } else {
      headerImage.src = '/assets/talisman-header-icon.png';
    }
  }

  initMobileNavigation();
  initLanguagePopup();
  initCookiePopup();

  // Add event listeners for all FAQ questions
  document.querySelectorAll('.faq-question').forEach(question => {
      question.addEventListener('click', () => {
          toggleFAQ(question);
      });
  });
});

// --- Cookie Settings Popup ---
function createCookiePopup() {
  const popupHTML = `
    <button class="cookie-settings-btn" onclick="openCookiePopup()">Cookie Settings</button>
    <div id="cookiePopup" class="cookie-popup">
      <div class="cookie-popup-content">
        <button class="lang-popup-close" onclick="closeCookiePopup()">&times;</button>
        <h2>Cookie Policy Summary</h2>
        <p>We use cookies to enhance your experience on our site. Here’s a quick summary:</p>
        <ul>
          <li><strong>Essential Cookies:</strong> We use a cookie to remember your theme preference (light or dark mode). This is necessary for the site to function as you expect.</li>
          <li><strong>Third-Party Cookies:</strong> Services like Google Analytics, Google AdSense, and Microsoft Clarity help us understand site traffic and show relevant ads. These services set their own cookies.</li>
        </ul>
        <p>By using our site, you consent to our use of these cookies. For more details, please see our <a href="/privacy-policy/">Privacy Policy</a>.</p>
      </div>
    </div>
  `;
  document.body.insertAdjacentHTML('beforeend', popupHTML);
}

function openCookiePopup() {
  const popup = document.getElementById('cookiePopup');
  if (popup) {
    popup.style.display = 'flex';
  }
}

function closeCookiePopup() {
  const popup = document.getElementById('cookiePopup');
  if (popup) {
    popup.style.display = 'none';
  }
}

function initCookiePopup() {
  createCookiePopup();
  const popup = document.getElementById('cookiePopup');
  if (popup) {
    popup.addEventListener('click', function(event) {
      if (event.target === this) {
        closeCookiePopup();
      }
    });
  }
}

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
            stopLoadingMessages();
        }
    }, 3000);
}

// Ticker population & click handler
document.addEventListener('DOMContentLoaded', () => {
    const recent = [
      "letters alight with secret numbers",
      "each word a cipher of cosmic design",
      "where value meets vibration of language",
      "words transformed into the geometry of meaning",
      "in every phrase the hidden sum of truth",
      "from syllable to number, mystery unfolds",
      "discover the numeric heartbeat of each name",
      "your words mapped in the lattice of ratios",
      "the ciphered code behind everyday speech",
      "echoes of creation in each calculated value",
      "numbers whisper the language of meaning",
      "every name holds a hidden sum of light",
      "beneath letters the cipher of creation pulses",
      "in each symbol the architecture of truth",
      "words dancing upon the grid of cosmic code",
      "the secret measure woven into speech",
      "letters become keys to ancient numerals",
      "the silent symphony of numbers reveals itself",
      "in the calculus of names the universe listens",
      "echoes of meaning inscribed in numeric form"
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

// --- Support Modal Logic ---
document.addEventListener('DOMContentLoaded', () => {
    const supportModal = document.getElementById('supportModal');
    const closeBtn = document.getElementById('supportModalClose');
    const supportForm = document.getElementById('supportForm');

    // Modal Delay: 7 seconds.
    setTimeout(() => {
        // TEST MODE: Removed localStorage check so it always shows
        console.log('Support Modal: 7s timer fired. Showing modal (Test Mode).');
        if (supportModal) {
            supportModal.style.display = 'flex';
        }
    }, 14000);

    // Close modal handler
    if (closeBtn) {
        closeBtn.addEventListener('click', () => {
            supportModal.style.display = 'none';
        });
    }

    // Close on click outside
    window.addEventListener('click', (e) => {
        if (e.target === supportModal) {
            supportModal.style.display = 'none';
        }
    });

    // Handle Form Submit
    if (supportForm) {
        supportForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(supportForm);
            const response = formData.get('support');

            console.log('Support Modal: Submitting response:', response);

            // 1. Collapse modal immediately & save state
            supportModal.style.display = 'none';
            // TEST MODE: Commented out to prevent caching
            // localStorage.setItem('supportResponseGiven', 'true');

            // 2. Perform DB operation in background
            fetch('/save', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ response: response }),
                keepalive: true
            })
            .then(async res => {
                console.log('Support Modal: Server responded with status:', res.status);
                const text = await res.text();
                console.log('Support Modal: Server response body:', text);
                try {
                    const json = JSON.parse(text);
                    console.log('Support Modal: Parsed JSON:', json);
                } catch (e) {
                    console.error('Support Modal: Failed to parse JSON response');
                }
            })
            .catch(err => console.error('Support Modal: Fetch error:', err));

            if (response === 'Yes') {
                window.open('/donate.php', '_blank');
            }
        });
    }
});