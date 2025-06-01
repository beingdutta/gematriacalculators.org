<!DOCTYPE html>
<html lang="en" data-theme="light">

  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Play the classic FLAME game: enter two names and find out if you are Friends, Love, Affection, Marriage, Enemies, or Siblings.">

    <title>FLAME Calculator – Free Gematria/FLAME Tools</title>
    <link rel="canonical" href="https://gematriacalculators.org/more-tools/flame-calculator.php" />
    <link rel="icon" href="/assets/flame-calculator-site-icon.png" sizes="32x32">

    <!-- Import the site-wide CSS (colors, typography, reset, header/footer, FAQ styles, etc.) -->
    <link rel="stylesheet" href="/styles/index.css" />

    <!-- Page-specific CSS overrides -->
    <link rel="stylesheet" href="/styles/flame-calculator.css" />
  </head>

<body>
  <div class="container">

    <!-- ============================
         HEADER (IDENTICAL TO index.php STYLE)
       ============================ -->
    <header class="header">
      <img src="/assets/flame-icon-128.png" id="themeLogo" alt="site logo" />
      <button class="theme-toggle" onclick="toggleTheme()">🌓</button>
      <h1>FLAME Calculator</h1>
      <p class="subtitle">(Enter two names to discover your relationship outcome)</p>
    </header>

    <!-- ============================
         MAIN FLAME CALCULATOR AREA
       ============================ -->
    <main class="calculator">
      <!-- Three-column row: left label+input / flame icon / right label+input -->
      <div class="flame-row">
        <!-- Left column -->
        <div class="flame-col">
          <label for="yourName">Your Name</label>
          <input id="yourName" type="text" placeholder="Enter your name…" />
        </div>

        <!-- Center flame icon -->
        <div class="flame-col flame-center">
          <img src="/assets/heart.png" alt="Flame Icon" class="flame-main-icon" />
        </div>

        <!-- Right column -->
        <div class="flame-col">
          <label for="partnerName">Your Partner’s Name</label>
          <input id="partnerName" type="text" placeholder="Enter partner’s name…" />
        </div>
      </div>

      <!-- Buttons: Calculate + Reset -->
      <div class="button-container">
        <button class="calculate-btn" onclick="runFlameCalculation()">Calculate</button>
        <button class="secondary" onclick="resetFlameCalculator()">Reset</button>
      </div>

      <!-- Inline error if fields are blank -->
      <div id="inputError" class="error-message">Please enter both names.</div>
    </main>


    <!-- ============================
         SEO TEXT (WITH GREYED <hr> SEPARATORS)
       ============================ -->
    <hr class="grey-rule" />
    <section class="seo-section">
      <h2>Discover Your FLAME Outcome in Seconds</h2>
      <p>
        The classic <strong>FLAME</strong> game has entertained generations. Simply type in two names and find out if you end up as 
        <em>Friends</em>, <em>Love</em>, <em>Affection</em>, <em>Marriage</em>, <em>Enemies</em>, or <em>Siblings</em>. 
        No paper, no pencil—just a quick online tool that does the counting and elimination for you.
      </p>
    </section>
    <hr class="grey-rule" />
    <section class="seo-section">
      <p>
        Enter your name on the left, your partner’s name on the right, and click “Calculate.” We’ll show a fun 3-second spinner 
        (in a modal) and then reveal your final FLAME result, complete with an emoji and a brief explanation. 
        If you want to play again, hit “Calculate Again” inside the popup.
      </p>
    </section>
    <hr class="grey-rule" />
    <section class="seo-section">
      <p>
        This tool is 100% mobile-friendly. Whether you’re on a phone, tablet, or desktop, the FLAME calculation happens instantly, 
        letting you share results with friends or just enjoy a blast from the past.
      </p>
    </section>
    <hr class="grey-rule" />


    <!-- ============================
         FAQ SECTION (NO HEADING, FIVE COLLAPSIBLES)
       ============================ -->
    <section class="faq-section">
      <div class="faq-item">
        <div class="faq-question" onclick="toggleFAQ(this)">
          <span>What is a FLAME calculator?</span>
          <svg class="chevron" width="24" height="24" viewBox="0 0 24 24">
            <path d="M6 9l6 6 6-6" />
          </svg>
        </div>
        <div class="faq-answer">
          A FLAME calculator is a fun, nostalgic game that takes two names, removes matching letters one-by-one, counts the 
          remaining letters, and then eliminates letters from F-L-A-M-E-S based on that count. 
          The final letter left stands for:
          <strong>F</strong> = Friends, <strong>L</strong> = Love, <strong>A</strong> = Affection, 
          <strong>M</strong> = Marriage, <strong>E</strong> = Enemies, <strong>S</strong> = Siblings.
        </div>
      </div>

      <div class="faq-item">
        <div class="faq-question" onclick="toggleFAQ(this)">
          <span>How do you remove letters?</span>
          <svg class="chevron" width="24" height="24" viewBox="0 0 24 24">
            <path d="M6 9l6 6 6-6" />
          </svg>
        </div>
        <div class="faq-answer">
          First, we strip out spaces and lowercase both names. Then, for each character in Name A, 
          if it appears in Name B, we remove that character from both names (only once per match). 
          After that, we count how many letters remain total. That number drives the elimination process in the FLAMES array.
        </div>
      </div>

      <div class="faq-item">
        <div class="faq-question" onclick="toggleFAQ(this)">
          <span>How do you decide which letter to remove in FLAMES?</span>
          <svg class="chevron" width="24" height="24" viewBox="0 0 24 24">
            <path d="M6 9l6 6 6-6" />
          </svg>
        </div>
        <div class="faq-answer">
          After counting the leftover letters, you take that number (say 8) and count through the array 
          <code>['F','L','A','M','E','S']</code> in a circular fashion. The 8th letter is removed first. 
          Then you continue from the very next letter, counting again up to 8, and remove that one. 
          Repeat until only one letter remains.
        </div>
      </div>

      <div class="faq-item">
        <div class="faq-question" onclick="toggleFAQ(this)">
          <span>Can I calculate more than once?</span>
          <svg class="chevron" width="24" height="24" viewBox="0 0 24 24">
            <path d="M6 9l6 6 6-6" />
          </svg>
        </div>
        <div class="faq-answer">
          Of course! Once your result appears in the modal, click “Calculate Again” to clear both fields and run a brand-new calculation.
        </div>
      </div>

      <div class="faq-item">
        <div class="faq-question" onclick="toggleFAQ(this)">
          <span>Can I use the FLAMES calculator for any names?</span>
          <svg class="chevron" width="24" height="24" viewBox="0 0 24 24">
            <path d="M6 9l6 6 6-6" />
          </svg>
        </div>
        <div class="faq-answer">
          Yes! You can use the FLAMES calculator with any two names—your own and your friend’s, crush’s, or partner’s—to see your FLAMES relationship result.
        </div>
      </div>

      <div class="faq-item">
        <div class="faq-question" onclick="toggleFAQ(this)">
          <span>Is the FLAMES game suitable for all ages?</span>
          <svg class="chevron" width="24" height="24" viewBox="0 0 24 24">
            <path d="M6 9l6 6 6-6" />
          </svg>
        </div>
        <div class="faq-answer">
          Absolutely. The FLAMES game is a light-hearted name compatibility test that’s suitable for kids, teens, and adults looking for a fun love or friendship predictor.
        </div>
      </div>
    </section>


    <!-- ============================
         FOOTER MENU (IDENTICAL TO index.php)
       ============================ -->
    <hr class="grey-rule" />
    <footer class="footer">
      <div class="footer-links">
        <a href="/">Home</a>
        <a href="/more-tools.html">More Tools</a>
        <a href="/blog-collections.html">Blog</a>
        <a href="/about-us.html">About Us</a>
        <a href="/contact-us.html">Contact Us</a>
        <a href="/terms-conditions.html">Terms & Conditions</a>
        <a href="/privacy-policy.html">Privacy Policy</a>
      </div>
      <div class="copyright">
        © 2025 gematriacalculators.org
      </div>
    </footer>
  </div>


  <!-- ============================
       MODAL OVERLAY & CONTENT
     ============================ -->
  <div id="flameModalOverlay" class="modal-overlay">
    <div class="modal" role="dialog" aria-modal="true" aria-labelledby="flameModalHeader">
      <!-- Close “×” button -->
      <button class="modal-close" onclick="closeFlameModal()">×</button>

      <!-- Modal header: “NameA 🔥 NameB” -->
      <div class="modal-header" id="flameModalHeader">
        <span id="modalNameA">NameA</span>
        <span class="flame-icon-large">🔥</span>
        <span id="modalNameB">NameB</span>
      </div>

      <!-- Modal body: Spinner first, then result -->
      <div class="modal-body">
        <!-- Large spinner (orange) -->
        <div id="modalSpinner" class="spinner-large"></div>

        <!-- Hidden until after 3s: result block -->
        <div id="modalResult" class="modal-result-content" style="display: none;">
          <p>
            The relationship between 
            <strong><span id="displayNameA"></span></strong> and 
            <strong><span id="displayNameB"></span></strong> 
            will ultimately lead to:
          </p>
          <span id="resultEmoji" class="result-emoji">❤️</span>
          <div id="resultText" class="result-text">Marriage</div>
        </div>
      </div>

      <!-- Modal footer: “Calculate Again” -->
      <div class="modal-footer">
        <button class="calculate-again" onclick="resetFlameCalculator()">Calculate Again</button>
      </div>
    </div>
  </div>

  <!-- ============================
       PAGE-SPECIFIC JavaScript
     ============================ -->
  <script src="/scripts/flame-calculator.js"></script>
</body>
</html>
