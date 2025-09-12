<?php
  // index.php
  // 1) pull in your calculate.php (which defines gematria() and also handles AJAX POSTs)
  require __DIR__ . '/calculate.php';

  // 2) fetch the URL‐param (for deep-linking) and, if present, run the server-side calculation
  $inputRaw = $_GET['input'] ?? '';
  $results  = $inputRaw !== '' ? gematria($inputRaw) : null;


  // Prepare SEO strings
  if ($results) {
    $seoTitle = ucfirst($inputRaw) . ' value in Gematria is ' . $results['english']['total'] . ' | Free Gematria Calculator';
    $seoDesc  = 'Find the English, Hebrew & Simple gematria values of “'. htmlspecialchars($inputRaw, ENT_QUOTES). '” instantly. Hebrew=' . $results['hebrew']['total']. ', English=' . $results['english']['total']. ', Simple=' . $results['simple']['total'] . '.'. "Free gematria calculator | Hebrew gematria calculator | English gematria calculator.";
  } 
  else {
    $seoTitle = 'Free Gematria Calculator Online - Hebrew/English/Simple Values';
    $seoDesc  = '#2 free gematria calculator online. Compute Hebrew, English & Simple gematria values of any word instantly.';
  }
?>

<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
  
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-1DQQSD51V4"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-1DQQSD51V4');
    </script>

    <!-- Clarity tracking code -->
    <script>
        (function(c,l,a,r,i,t,y){
            c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
            t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i+"?ref=bwt";
            y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
        })(window, document, "clarity", "script", "rcxnkrgboo");
    </script>

    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4198904821948931"
     crossorigin="anonymous"></script>

    <meta charset="UTF-8">
    <meta name="p:domain_verify" content="9a2f772bde6a1162d2e6c441caf23a2a"/>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="keywords" content="gematria calculator, bible gematria calculator, gematrix, english to hebrew gematria calculator, hebrew gematria calculator, best gematria calculator, calculate gematria, gematria calculator online, gematria finder, simple gematria, free gematria calculator, gematria name calculator, jewish gematria calculator, gematria.com calculator, gematria calculator us, gematria online calculator, english gematria calculator, hebrew numerology calculator, gematria hebraica calcule online, gematriacalculator.us">

    <!-- Dynamic SEO tags for parameterized URL in SERP's-->
    <title><?= $seoTitle ?></title>
    <meta name="description" content="<?= htmlspecialchars($seoDesc, ENT_QUOTES) ?>">

    <!-- For handling empty URL parameters -->
    <?php
        $canonicalUrl = 'https://gematriacalculators.org/';
        if (!empty($inputRaw)) {
            $canonicalUrl .= 'index.php?input=' . urlencode($inputRaw);
        }
    ?>

    <link rel="canonical" href="<?= $canonicalUrl ?>">  
    <link rel="icon" href="/assets/talisman-site-icon.png" sizes="32x32">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <link rel="stylesheet" href="/styles/index.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>

</head>

<body>

    <div class="container">

        <!-- ——— Recent Searches Ticker ——— -->
        <div class="recent-phrases ticker-bar">
            <h4>Recent searches:</h4>

            <!-- ——— Language Switcher ——— -->
            <?php                                    
            $qs = $_SERVER['QUERY_STRING'] ? '?'.$_SERVER['QUERY_STRING'] : '';
            $here = trim(dirname($_SERVER['SCRIPT_NAME']), '/');   // '' | ru | de
            function lang($code,$label,$qs,$here){
                $path = $code==='en' ? '/index.php'.$qs : "/$code/index.php$qs";
                return $code===$here||($code==='en'&&$here==='') ? "<strong>$label</strong>": "<a href=\"$path\">$label</a>";
            }
            ?>
            <nav class="lang-switcher" aria-label="Language switcher">
            <?= lang('en','EN',$qs,$here) ?> |
            <?= lang('ru','RU',$qs,$here) ?> |
            <?= lang('de','DE',$qs,$here) ?>
            </nav>

            <div class="ticker">
            <div class="ticker__list">
                <!-- JS will inject .ticker__item cards here -->
            </div>
            </div>
        </div>

        <header class="header">
            <img src="/assets/talisman-header-icon.png" id="themeLogo" alt="gematria calculator site logo">
            <button class="theme-toggle" onclick="toggleTheme()">🌓</button>
            <h1>Free Gematria Calculator Online</h1>
            <p class="subtitle">(Type in a word or a number e.g. God, Bible, Hebrew, Holy – to calculate gematria values)</p>
        </header>

        <main class="calculator">
            <div class="input-group">
                <input
                    id="inputText"
                    type="text"
                    placeholder="Enter text to calculate…"
                    value="<?= htmlspecialchars($inputRaw, ENT_QUOTES) ?>"
                />
                <button class="secondary" onclick="clearInput()" title="Clear">✕</button>
            </div>

            <div class="button-container">
                <button class="calculate-btn" onclick="calculate()">Calculate</button>
                <button class="download-btn" onclick="calculateAndDownload()">Download PDF</button>
                <a href="/decode-gematria-value.php" class="decode-btn">Decode Gematria</a>
            </div>


            <div class="loading-container" id="loading" style="display:none">
                <div class="spinner"></div>
            </div>

            <div class="result" id="result" style="<?= $results ? 'display:block;' : 'display:none;' ?>">
                <div class="result-card">
                    <button class="copy-btn" onclick="copyValue('hebrewValue','hebrewCopyNotification')">
                        <i class="fa-regular fa-copy"></i>
                    </button>
                    <div class="copy-notification" id="hebrewCopyNotification">Copied!</div>
                    <h3>Hebrew Gematria: <span id="hebrewValue">
                    <?= $results['hebrew']['total'] ?? 0 ?>
                    </span></h3>
                    <p id="hebrewBreakdown">
                    <?php if($results): ?>
                        Calculation: <?= implode(' + ', $results['hebrew']['breakdown']) ?>
                    <?php endif ?>
                    </p>
                </div>

                <div class="result-card">
                    <button class="copy-btn" onclick="copyValue('englishValue','englishCopyNotification')">
                        <i class="fa-regular fa-copy"></i>
                    </button>
                    <div class="copy-notification" id="englishCopyNotification">Copied!</div>
                    <h3>English Gematria: <span id="englishValue">
                    <?= $results['english']['total'] ?? 0 ?>
                    </span></h3>
                    <p id="englishBreakdown">
                    <?php if($results): ?>
                        Calculation: (<?= implode(' + ', $results['simple']['breakdown']) ?>) × 6
                    <?php endif ?>
                    </p>
                </div>

                <div class="result-card">
                    <button class="copy-btn" onclick="copyValue('simpleValue','simpleCopyNotification')">
                        <i class="fa-regular fa-copy"></i>
                    </button>
                    <div class="copy-notification" id="simpleCopyNotification">Copied!</div>
                    <h3>Simple Gematria: <span id="simpleValue">
                    <?= $results['simple']['total'] ?? 0 ?>
                    </span></h3>
                    <p id="simpleBreakdown">
                    <?php if($results): ?>
                        Calculation: <?= implode(' + ', $results['simple']['breakdown']) ?>
                    <?php endif ?>
                    </p>
                </div>

                <div class="feedback">
                    <p>How accurate are these results?</p>
                    <div class="feedback-buttons">
                    <button onclick="sendFeedback('😞')">😞</button>
                    <button onclick="sendFeedback('😐')">😐</button>
                    <button onclick="sendFeedback('😊')">😊</button>
                    </div>
                    <div class="feedback-message" id="feedbackMessage"></div>
                </div>
            </div>
        </main>

        <p class="note" style="color: var(--error); font-weight: 400; margin-top: 0.75rem; text-align: center;">
            For feedback, suggestions, or improvements to this tool, please email us at <a href="mailto:admins@gematriacalculators.org" style="color: var(--error); text-decoration: underline;">admins@gematriacalculators.org</a>.
        </p>


        <!-- SEO SECTION #1 -->
        <div class="seo-section">
            <h4>Discover Hidden Numerical Meanings</h4>
            <p>This free gematria calculator online works as a powerful gematria name calculator and supports English to Hebrew gematria conversions. Whether you're looking for a gematria calculator online for biblical analysis or just a simple gematria calc to explore number meanings, this tool is designed for you. Users often search for terms like "calculator gematria", "hebrew numerology calculator", and "simple gematria calculator" — and this tool provides the functionality they seek.</p>
            <div class="example">Example: <strong>Bible</strong> = 38 (Hebrew), 180 (English), 30 (Simple)</div>
        </div>

        <div class="seo-section", style="color: green;">
            <p>International users often search using terms like <em>гематрия калькулятор</em> (Russian), <em>gematria rechner</em> (German), and <em>gematria calculadora</em> (Spanish). <br><br>This gematrix calculator tool aka gematria finder is designed to be intuitive and accessible for everyone exploring gematria.</p>
        </div>

        <!-- SEO SECTION #2 -->
        <div class="seo-section">
            <p>Our best gematria calculator us online tool or (aka gematrix calculator) is designed for accuracy, speed, and simplicity. It’s perfect for scholars, spiritual seekers, or anyone interested in the mystical traditions behind sacred texts. With our best Hebrew gematria calculator, you can decode biblical passages, analyze spiritual names, or explore esoteric connections — all in one place. Try the most simple gematria calculator free today and dive into the world of symbolic number meanings with confidence.</p>
        </div>

        <hr class="divider">
        <br>

        <!-- RECENT PHRASES -->
        <div class="recent-phrases">
            <h4>Recent words and phrases calculated include:</h4>
            <a href="#">divine harmony</a> |
            <a href="#">ancient number codes</a> |
            <a href="#">light of the creator</a> |
            <a href="#">secrets of eden</a> |
            <a href="#">wisdom beyond the veil</a> |
            <a href="#">numerical truth revealed</a> |
            <a href="#">order within the cosmos</a>
        </div>

        <!-- GLOBAL FEEDBACK BANNER -->
        <div class="global-feedback-message" id="globalFeedback"></div>

        <!-- FAQ & FOOTER -->
        <footer class="footer">
            <!-- FAQ ITEMS -->
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)">
                    <span>What is Gematria?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">
                    Gematria is an alphanumeric code of assigning a numerical value to a name, word or phrase based on its letters. It is commonly used in Jewish mysticism and biblical interpretation.
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)">
                    <span>What is a gematria calculator?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">
                    A free gematria calculator online tool or software that automatically computes the numerical value of a word, phrase, or name by assigning numeric values to each letter, based on specific gematria systems.
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)">
                    <span>How To Use Gematria Calculator Online?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">
                    To use our best free gematria calculator online, simply type a word, phrase, or name into the input box, then click “Calculate” to generate its numerical values across Hebrew, English, and Simple systems. For a record, you can also download a PDF report.
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)">
                    <span>How To Understand Simple Gematria Calculator?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">
                    Our simple gematria calculator assigns A=1, B=2, C=3, … Z=26, then sums those values. Enter a word like “Truth” and it outputs the total, which you can compare against other words sharing the same value.
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)">
                    <span>Can I calculate phrases with spaces?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">
                    Yes! This gematria name calculator automatically ignores spaces and special characters, focusing only on alphabetical letters. We support gematria calculator name and meaning for all users anytime 24*7 for free.
                </div>
            </div>

            <!-- FOOTER LINKS -->
            <div class="footer-links">
                <a href="/">Home</a>
                <a href="/more-tools.php">More Tools</a>
                <a href="/blog-collections.html">Blog</a>
                <a href="/about-us.html">About Us</a>
                <a href="/contact-us.html">Contact Us</a>
                <a href="/terms-conditions.html">Terms & Conditions</a>
                <a href="/privacy-policy.html">Privacy Policy</a>
            </div>

            <!-- COPYRIGHT NOTICE -->
            <div class="copyright">
                © 2022 gematriacalculators.org
            </div>
        </footer>
    </div>

    <div id="exitModal" class="modal">
        <div class="modal-content animate-scale">
            <button class="modal-close" id="exitModalClose" aria-label="Close Modal">
                <i class="fa-solid fa-circle-xmark"></i>
            </button>
            <h2><i class="fa-solid fa-star text-primary"></i> Don’t Leave Yet!</h2>
            <p>Have you tried our exciting new tools?</p>
            <div class="modal-links">
                <a href="http://tarotcardgenerator.online/" class="outline-button">
                    <i class="fa-solid fa-wand-magic-sparkles"></i> Daily Tarot Reader
                </a>
                <a href="https://www.snowdayscalculatorai.com/" class="outline-button">
                    <i class="fa-solid fa-snowflake"></i> US Snowday Calculator
                </a>
            </div>
            <p style="margin-top: 1rem;">
                <i class="fa-solid fa-face-smile-wink fa-lg text-primary"></i>
                Enjoy and come back soon!
            </p>
        </div>
    </div>

  <script src="/scripts/index.js"></script>
</body>
</html>
