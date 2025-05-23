<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
  <meta charset="UTF-8">
  <title>Lo Shu Grid Calculator</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/styles/loshu-grid.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
</head>

<body>
  <div class="container">

    <!-- ── header ───────────────────────────────────────────────────────── -->
    <header>
      <img src="/assets/header-image.webp" id="themeLogo" alt="Lo Shu Grid logo">
      <button class="theme-toggle" onclick="toggleTheme()">🌓</button>
      <h1>Lo Shu Grid Calculator</h1>
      <p class="subtitle">Decode your numerological matrix from your date of birth</p>
    </header>

    <!-- ── form ─────────────────────────────────────────────────────────── -->
    <main>
      <form id="loshuForm" class="loshu-form">
        <div class="form-row">
          <div><label for="day">Day</label><select  id="day"><option value="">Day</option></select></div>
          <div><label for="month">Month</label><select id="month"><option value="">Month</option></select></div>
          <div><label for="year">Year</label><select  id="year"><option value="">Year</option></select></div>
        </div>

        <div class="button-container">
          <button type="submit" class="calculate-btn">Calculate</button>
          <button type="button" class="download-btn" onclick="downloadPDF()">Download&nbsp;PDF</button>
          <button type="reset"  class="reset-btn"    onclick="resetForm()">Reset</button>
        </div>
      </form>

      <!-- ── loader + outputs ───────────────────────────────────────────── -->
      <div class="loading-container" id="loading"><div class="spinner"></div></div>

      <!-- everything inside #reportArea can be reused for the PDF -->
      <div id="reportArea">
        <div id="summary"         class="summary-box hidden"></div>
        <div id="gridContainer"   class="grid-wrapper hidden"></div>
        <div id="traitsContainer" class="traits-box hidden"></div>
      </div>
    </main>

    <!-- ── SEO coloured intro blocks ────────────────────────────────────── -->
    <section class="seo-blocks">
      <hr>
      <h2>Lo Shu Grid Calculator</h2>
      <p>
        Our <span class="keyword">Lo&nbsp;Shu&nbsp;grid&nbsp;calculator</span> converts your birth-date
        into the magic 3&nbsp;×&nbsp;3 matrix, instantly showing dominant and missing numbers.
      </p>
      <hr>
      <h2>Lo Shu Grid Calculator Online</h2>
      <p>
        Access the <span class="keyword">Lo&nbsp;Shu&nbsp;grid&nbsp;calculator online</span> on any
        device – no downloads, no sign-ups, 100 % privacy.
      </p>
      <hr>
      <h2>Lo Shu Grid Online Calculator</h2>
      <p>
        Use this <span class="keyword">Lo&nbsp;Shu&nbsp;grid&nbsp;online&nbsp;calculator</span> to
        reveal hidden strengths, challenges and life-path clues.
      </p>
      <hr>
      <h2>Lo Shu Grid – Calculate in Seconds</h2>
      <p>
        Click once to <span class="keyword">calculate&nbsp;your&nbsp;Lo&nbsp;Shu&nbsp;grid</span>
        – forget manual charts forever.
      </p>
      <hr>
      <h2>Lo Shu Grid Calculation Explained</h2>
      <p>
        A proper <span class="keyword">Lo&nbsp;Shu&nbsp;grid&nbsp;calculation</span> counts every
        non-zero digit in your date of birth, adds Mulank &amp; Bhagyank and maps them into the grid
        you see above.
      </p>
    </section>

    <!-- ── FAQ ──────────────────────────────────────────────────────────── -->
    <section class="faq">
      <div class="faq-item">
        <button class="faq-question" type="button">
          What is the Lo Shu Grid?
          <svg class="chevron" width="24" height="24"><path d="M6 9l6 6 6-6"/></svg>
        </button>
        <div class="faq-answer">
          The Lo Shu Grid is a numerology chart based on your birth-date that
          highlights inherent strengths, weaknesses and tendencies.
        </div>
      </div>

      <div class="faq-item">
        <button class="faq-question" type="button">
          How does this calculator work?
          <svg class="chevron" width="24" height="24"><path d="M6 9l6 6 6-6"/></svg>
        </button>
        <div class="faq-answer">
          It counts every non-zero digit in your day, month and year of birth,
          adds your Mulank and Bhagyank, then maps those frequencies onto the
          classic 3 × 3 grid.
        </div>
      </div>

      <div class="faq-item">
        <button class="faq-question" type="button">
          Can I download the result as a PDF?
          <svg class="chevron" width="24" height="24"><path d="M6 9l6 6 6-6"/></svg>
        </button>
        <div class="faq-answer">
          Yes – click “Download PDF” anytime for a vibrant report you’ll want to keep.
        </div>
      </div>
    </section>

    <!-- ── footer ───────────────────────────────────────────────────────── -->
    <footer>
      <nav class="footer-links">
        <a href="/">Home</a><a href="/more-tools.php">More&nbsp;Tools</a><a href="/blog">Blog</a>
        <a href="/about-us.html">About&nbsp;Us</a><a href="/contact-us.html">Contact&nbsp;Us</a>
        <a href="/terms.html">Terms&nbsp;&amp;&nbsp;Conditions</a><a href="/privacy.html">Privacy&nbsp;Policy</a>
      </nav>
      <small class="copyright">© <?= date('Y') ?> gematriacalculators.org</small>
    </footer>

  </div><!-- /.container -->

  <script src="/scripts/loshu-grid.js"></script>
</body>
</html>
