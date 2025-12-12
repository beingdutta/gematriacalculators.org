<?php
  // index.php
  // 1) pull in your calculate.php (which defines gematria() and also handles AJAX POSTs)
  require_once __DIR__ . '/calculate.php';
  require_once __DIR__ . '/helpers.php';

  // 2) fetch the URL‐param (for deep-linking) and, if present, run the server-side calculation
  $inputRaw = $_GET['input'] ?? '';
  $results  = $inputRaw !== '' ? gematria($inputRaw) : null;

  // SEO: make description STATIC, keep title concise (optionally dynamic)
  $SITE_NAME = 'Gematria Calculator';
  $BASE_URL = 'https://gematriacalculators.org/';

  // Clean a display version of the query for title/OG only
  $displayInput = trim($inputRaw);
  if ($displayInput !== '') {
    // limit to ~60 chars to avoid super-long titles
    $displayInput = mb_strimwidth($displayInput, 0, 60, '…', 'UTF-8');
  }

  // Title: short, human-readable. If there are results, include the English total once.
  if ($results && isset($results['english']['total'])) {
    $pageTitle = sprintf(
      '%s — Gematria Value: %s | %s',
      ucfirst($displayInput),
      (string)$results['english']['total'],
      $SITE_NAME
    );
  } else {
    $pageTitle = 'Gematria Calculator - Free Gematrix & Numerology Calculator';
  }

  // DESCRIPTION: STATIC (don't vary per query — stabilizes snippets/CTR)
  $metaDescription = 'The web\'s best free Gematria Calculator. Get instant and accurate results with our gematrix and numerology tool, supporting English, Hebrew, and Simple Gematria. Perfect for biblical analysis, name meanings, and decoding values.';

  // Canonical: point root when empty; deep-link when there's an input
  $canonicalUrl = $BASE_URL;
  if (!empty($inputRaw)) {
    // use rawurlencode for cleaner canonical with query. Point to the root URL for queries.
    $canonicalUrl .= '?input=' . rawurlencode($inputRaw);
  }

  // Open Graph / Twitter: keep short and dependable; use static description
  $ogTitle = ($results && !empty($displayInput))
    ? sprintf('%s — Gematria Value: %s', $displayInput, (string)$results['english']['total'])
    : 'Gematria Calculator — Free Gematrix & Numerology Calculator';

  // Optional: a share image you host (1200×630 recommended)
  $ogImage = $BASE_URL . 'assets/preview.jpg';

  $loadingPhrases = [
    "Translating words into numbers...",
    "Summoning the codes of creation...",
    "Decoding the hidden numerical patterns...",
    "Aligning letters with divine values...",
    "Calculating your gematria sequence...",
    "Tracing the vibrational sum of your name...",
    "Revealing the secret meaning in numbers..."
  ];
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

    <!-- Yandex.Metrika counter -->
    <script type="text/javascript">
        (function(m,e,t,r,i,k,a){
            m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
            m[i].l=1*new Date();
            for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }}
            k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)
        })(window, document,'script','https://mc.yandex.ru/metrika/tag.js?id=105402705', 'ym');

        ym(105402705, 'init', {ssr:true, webvisor:true, clickmap:true, ecommerce:"dataLayer", accurateTrackBounce:true, trackLinks:true});
    </script>
    <noscript><div><img src="https://mc.yandex.ru/watch/105402705" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
    <!-- /Yandex.Metrika counter -->

    <!-- Google AdSense -->
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4198904821948931" crossorigin="anonymous"></script>

    <meta charset="UTF-8">
    <meta name="p:domain_verify" content="9a2f772bde6a1162d2e6c441caf23a2a"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Keep keywords minimal or remove (search engines largely ignore this) -->
    <meta name="keywords" content="gematria calculator, gematrix, gematria, hebrew gematria, english gematria, simple gematria, gematria decoder, numerology calculator">

    <!-- Static/clean SEO -->
    <title><?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8'); ?></title>
    <meta name="description" content="<?= htmlspecialchars($metaDescription, ENT_QUOTES, 'UTF-8'); ?>">
    <link rel="canonical" href="<?= htmlspecialchars($canonicalUrl, ENT_QUOTES, 'UTF-8'); ?>">

    <!-- Open Graph -->
    <meta property="og:title" content="<?= htmlspecialchars($ogTitle, ENT_QUOTES, 'UTF-8'); ?>">
    <meta property="og:description" content="<?= htmlspecialchars($metaDescription, ENT_QUOTES, 'UTF-8'); ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= htmlspecialchars($canonicalUrl, ENT_QUOTES, 'UTF-8'); ?>">
    <meta property="og:image" content="<?= htmlspecialchars($ogImage, ENT_QUOTES, 'UTF-8'); ?>">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= htmlspecialchars($ogTitle, ENT_QUOTES, 'UTF-8'); ?>">
    <meta name="twitter:description" content="<?= htmlspecialchars($metaDescription, ENT_QUOTES, 'UTF-8'); ?>">
    <meta name="twitter:image" content="<?= htmlspecialchars($ogImage, ENT_QUOTES, 'UTF-8'); ?>">

    <!-- Hreflang links -->
    <?php
      $qs = !empty($inputRaw) ? '?input=' . rawurlencode($inputRaw) : '';
    ?>
    <link rel="alternate" hreflang="en" href="<?= $BASE_URL . ltrim($qs, '?') ?>">
    <link rel="alternate" hreflang="ru" href="<?= $BASE_URL . 'ru/' . ltrim($qs, '?') ?>">
    <link rel="alternate" hreflang="de" href="<?= $BASE_URL . 'de/' . ltrim($qs, '?') ?>">
    <link rel="alternate" hreflang="es" href="<?= $BASE_URL . 'es/' . ltrim($qs, '?') ?>">
    <link rel="alternate" hreflang="pt" href="<?= $BASE_URL . 'pt/' . ltrim($qs, '?') ?>">
    <link rel="alternate" hreflang="it" href="<?= $BASE_URL . 'it/' . ltrim($qs, '?') ?>">
    <link rel="alternate" hreflang="iw" href="<?= $BASE_URL . 'iw/' . ltrim($qs, '?') ?>">
    <link rel="alternate" hreflang="pl" href="<?= $BASE_URL . 'pl/' . ltrim($qs, '?') ?>">
    <link rel="alternate" hreflang="zh" href="<?= $BASE_URL . 'zh/' . ltrim($qs, '?') ?>">
    <link rel="alternate" hreflang="vi" href="<?= $BASE_URL . 'vi/' . ltrim($qs, '?') ?>">
    <link rel="alternate" hreflang="x-default" href="<?= $BASE_URL . ltrim($qs, '?') ?>"> <!-- x-default should point to the primary version -->


    <!-- Enhanced JSON-LD: WebApplication schema for a calculator -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "WebApplication",
      "name": "Gematria Calculator",
      "url": "<?= htmlspecialchars($BASE_URL, ENT_QUOTES, 'UTF-8'); ?>",
      "description": "The web's best Gematria Calculator for English, Hebrew, and Simple Gematria. An essential tool for gematrix, numerology, and biblical analysis.",
      "applicationCategory": "Calculator",
      "operatingSystem": "Any",
      "inLanguage": "en",
      "offers": {
        "@type": "Offer",
        "price": "0",
        "priceCurrency": "USD"
      },
      "featureList": [
        "Hebrew Gematria Calculations",
        "English Gematria System",
        "Simple Gematria Values",
        "Bible Gematria Analysis",
        "PDF Export Feature",
        "Multi-language Support",
        "Gematria Decoder"
      ],
      "keywords": "gematria calculator, hebrew gematria, english gematria, bible gematria calculator, simple gematria calculator, gematria search engine",
      "potentialAction": {
        "@type": "UseAction",
        "target": "<?= htmlspecialchars($BASE_URL, ENT_QUOTES, 'UTF-8'); ?>"
      }
    }
    </script>

    <link rel="icon" href="/assets/talisman-site-icon.png" sizes="32x32">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="/styles/index.css">
    <link rel="stylesheet" href="/styles/more-tools.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>
</head>


<body>

    <?php require_once __DIR__ . '/navigation/header.php'; ?>
    
    <div class="container">
        <!-- ——— Recent Searches Ticker ——— -->
        <div class="recent-phrases ticker-bar">
            <h4>Recent searches:</h4>

            <div class="ticker">
                <div class="ticker__list">
                <!-- JS will inject .ticker__item cards here -->
                </div>
            </div>
        </div>

        <header class="header" id="main-header" style="<?= $results ? 'display:none;' : '' ?>">
            <!-- Logo removed for a cleaner look -->
            <h1>Gematria Calculator (Gematrix)</h1>
            <p class="subtitle">Decode the numerical values of words, names, and phrases with English, Hebrew, and Simple Gematria.</p>
        </header>


        <main class="calculator" id="main-calculator" style="<?= $results ? 'display:none;' : '' ?>">
            <div class="input-group">
                <input
                    id="inputText"
                    type="text"
                    placeholder="Calculate gematria of my name..."
                    value="<?= htmlspecialchars($inputRaw, ENT_QUOTES, 'UTF-8') ?>"
                />
                <button class="secondary" onclick="clearInput()" title="Clear">✕</button>
            </div>

            <div class="button-container">
                <button class="calculate-btn" onclick="document.getElementById('main-calculator').style.display='none'; document.getElementById('main-header').style.display='none'; calculate()">Calculate Gematria</button>
                <button class="download-btn" onclick="calculateAndDownload()">Download PDF</button>
                <a href="/decode-gematria-value/" class="decode-btn">Decode Gematria</a>
            </div>
        </main>

        <div class="loading-container" id="loading" style="display:none">
            <div class="spinner"></div>
            <p id="loadingMessage" class="loading-message"></p>
        </div>

        <?php
        // Capture More Tools HTML for reuse in both locations
        ob_start();
        ?>
        <section class="more-tools-section">
            <h2>Explore More Tools for Daily Guidance</h2>
            <div class="tool-grid">
                <?php
                    $tools = [
                        ['title' => 'Simple Vastu Score Calculator', 'desc' => 'Get a quick Vastu compliance score for your home.', 'icon' => '<i class="fa-solid fa-house"></i>', 'url' => '/more-tools/simple-vastu-score-calculator.php'],
                        ['title' => 'Kua Number Calculator', 'desc' => 'Find your Feng Shui lucky directions for success.', 'icon' => '<i class="fa-solid fa-compass"></i>', 'url' => '/more-tools/kua-number-calculator.php'],
                        ['title' => 'Angel Number Decoder', 'desc' => 'Uncover messages from the universe in numbers.', 'icon' => '<i class="fa-solid fa-wand-magic-sparkles"></i>', 'url' => '/more-tools/angel-number-decoder.php'],
                        ['title' => 'Life Path Number Calculator', 'desc' => 'Discover your core destiny from your birth date.', 'icon' => '<i class="fa-solid fa-route"></i>', 'url' => '/more-tools/life-path-number-calculator.php'],
                        ['title' => 'Loshu Grid Calculator', 'desc' => 'Map out your numerological energy grid.', 'icon' => '<i class="fa-solid fa-table-cells"></i>', 'url' => '/more-tools/loshu-grid.php'],
                        ['title' => 'Name Numerology Calculator', 'desc' => 'Calculate your Destiny and Soul Urge numbers.', 'icon' => '<i class="fa-solid fa-signature"></i>', 'url' => '/more-tools/name-numerology-calculator.php'],
                    ];

                    foreach ($tools as $tool) {
                        echo '
                        <div class="tool-card">
                            <div class="tool-icon">'.$tool['icon'].'</div>
                            <h3>'.$tool['title'].'</h3>
                            <p>'.$tool['desc'].'</p>
                            <a href="'.$tool['url'].'" class="calculate-btn">Open Tool</a>
                        </div>';
                    }
                ?>
            </div>
        </section>
        <?php
        $moreToolsHtml = ob_get_clean();
        ?>

        <div class="result" id="result" style="<?= $results ? 'display:block;' : 'display:none;' ?>">
            <h2 id="resultHeader" style="text-align: center; margin-bottom: 2rem; font-size: 1.2rem; font-weight: 600; background-color: var(--background-alt); padding: 0.75rem 1rem; border-radius: var(--radius); border: 1px solid var(--border-color); box-shadow: 0 2px 4px rgba(0,0,0,0.05);">Gematria Output for: <span style="color: var(--primary-color);"><?= htmlspecialchars($displayInput) ?></span></h2>
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
            <div class="button-container" style="margin-top: 2rem; justify-content: center; gap: 15px;">
                <button class="download-btn" onclick="calculateAndDownload()">Download PDF</button>
                <button class="calculate-btn" onclick="calculateAgain(); clearInput(); document.getElementById('main-calculator').style.display='block'; document.getElementById('main-header').style.display='block'">Calculate Again</button>
            </div>

            <div class="promotion-box"> <!-- Recommended CSS: display: flex; align-items: center; gap: 15px; -->
                <div class="promo-icon" style="font-size: 2.5rem; color: var(--primary-color); flex-shrink: 0;">
                    <i class="fa-solid fa-wand-magic-sparkles"></i>
                </div>
                <div class="promo-content" style="text-align: center;"> <!-- Recommended CSS: flex-grow: 1; -->
                    <p style="margin: 0; font-weight: 600; font-size: 1.05em;">Expand Your Insight Beyond Numbers</p>
                    <p style="margin: 6px 0 0 0; font-size: 0.8em;">While gematria reveals the hidden numerical code in your life, tarot offers a different path to wisdom. Combine the logic of numbers with the intuition of the cards to gain a more complete perspective. Seek guidance from our free Daily Tarot Reader to complement your journey.</p>
                </div>
                <a href="https://tarotcardgenerator.online/" target="_blank" class="promo-btn" style="white-space: nowrap; margin-top: 0.1rem;">
                    Get a Free Tarot Reading
                </a>
            </div>

            <!-- More Tools (Result View) -->
            <div id="more-tools-result" style="<?= $results ? 'display:block;' : 'display:none;' ?>">
                <?= $moreToolsHtml ?>
            </div>

            <div class="feedback">
                <p>Was this calculator helpful?</p>
                <div class="feedback-buttons">
                <button onclick="sendFeedback('😞')">😞</button>
                <button onclick="sendFeedback('😐')">😐</button>
                <button onclick="sendFeedback('😊')">😊</button>
                </div>
                <div class="feedback-message" id="feedbackMessage"></div>
            </div>
        </div>

        <p class="note" style="color: var(--error); font-weight: 400; margin-top: 0.75rem; text-align: center;">
            For feedback, suggestions, or improvements to this tool, please email us at <a href="mailto:admins@gematriacalculators.org" style="color: var(--error); text-decoration: underline;">admins@gematriacalculators.org</a>.
        </p>

        <!-- SEO SECTION #1 -->
        <div class="seo-section">
            <h4>Discover Hidden Numerical Meanings</h4>
            <p>Our free gematria calculator online works as a powerful gematria name calculator and supports English to Hebrew gematria conversions. Whether you're looking for an online gematria calculator for biblical analysis or just a simple gematria calc to explore number meanings, this tool is designed for you. Users often search for terms like "calculator gematria", "hebrew numerology calculator", and "gematria calculater" — and this tool provides the functionality they seek. Even if you misspell it as 'gemetria' or 'germatria', our engine understands you.</p>
            <div class="example">Example: Bible = 38 (Hebrew), 180 (English), 30 (Simple)</div>
        </div>

        <!-- More Tools (Original View) -->
        <div id="more-tools-original" style="<?= $results ? 'display:none;' : 'display:block;' ?>">
            <?= $moreToolsHtml ?>
        </div>

        <!-- SEO SECTION #2 -->
        <div class="seo-section">
            <p>Our best gematria calculator (often referred to as a gematrix or gmetrix calculator) is designed for accuracy, speed, and simplicity. It’s perfect for scholars, spiritual seekers, or anyone interested in the mystical traditions behind sacred texts. With our best Hebrew gematria calculator, you can use our gematria decoder on biblical passages, analyze spiritual names, or explore esoteric connections — all in one place. Try the most simple gematria calculator free today and dive into the world of symbolic number meanings with confidence. This tool is a great alternative to other platforms like Gematrix.org or the Gematrinator.</p>
        </div>

        <!-- GLOBAL FEEDBACK BANNER -->
        <div class="global-feedback-message" id="globalFeedback"></div>

        <!-- Language Popup -->
        <div class="lang-popup">
            <div class="lang-popup-content">
                <button class="lang-popup-close" onclick="closeLangPopup()">&times;</button>
                <h4>Select Language</h4>
                <div class="lang-grid">
                    <a href="/<?= ltrim($qs, '?') ?>">English</a>
                    <a href="/ru/<?= ltrim($qs, '?') ?>">Русский</a>
                    <a href="/de/<?= ltrim($qs, '?') ?>">Deutsch</a>
                    <a href="/es/<?= ltrim($qs, '?') ?>">Español</a>
                    <a href="/pt/<?= ltrim($qs, '?') ?>">Português</a>
                    <a href="/it/<?= ltrim($qs, '?') ?>">Italiano</a>
                    <a href="/iw/<?= ltrim($qs, '?') ?>">עברית</a>
                    <a href="/pl/<?= ltrim($qs, '?') ?>">Polski</a>
                    <a href="/zh/<?= ltrim($qs, '?') ?>">中文</a>
                    <a href="/vi/<?= ltrim($qs, '?') ?>">Tiếng Việt</a>
                </div>
            </div>
        </div>

        <!-- FAQ Section -->
        <section class="faq-section">
            <h2 class="faq-heading">Frequently Asked Questions</h2>
            <div class="faq-item">
                <div class="faq-question">
                    <span>What is Gematria?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">
                    Gematria is an alphanumeric code of assigning a numerical value to a name, word or phrase based on its letters. It is commonly used in Jewish mysticism and biblical interpretation.
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <span>What is a gematria calculator?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">
                    A free gematria calculator is an online tool that automatically computes the numerical value of a word, phrase, or name by assigning numeric values to each letter. It's a modern gematria generator based on ancient numerology systems.
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <span>What is the meaning of Gematria?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">
                    The meaning of Gematria lies in its use as a method of exegesis, or critical interpretation, for uncovering the deeper, hidden meanings within sacred texts. By converting words and phrases into numerical values, Gematria reveals relationships between different concepts that are not apparent from the plain text. For example, in bible gematria, finding that two different words share the same numerical value can suggest a conceptual or spiritual connection between them, offering a new layer of understanding.
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <span>How To Use Gematria Calculator Online?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">
                    To use our best free gematria calculator online, simply type a word, phrase, or name into the input box, then click “Calculate Gematria” to generate its numerical values across Hebrew, English, and Simple systems. For a record, you can also download a PDF report.
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <span>How To Understand Simple Gematria Calculator?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">
                    Our simple gematria calculator assigns A=1, B=2, C=3, … Z=26, then sums those values. Enter a word like “Truth” and it outputs the total, which you can compare against other words sharing the same value.
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <span>How do I use the Bible gematria calculator?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">
                    Our Bible gematria calculator is designed for analyzing biblical texts and names. Simply enter any word or phrase from the Bible, and you'll get instant Hebrew, English, and Simple gematria values. Our calculator supports both modern and biblical Hebrew characters, making it the best gematria calculator for biblical research. We also support Greek Gematria calculator principles for New Testament analysis.
                </div>
            </div>
            
            <div class="faq-item">
                <div class="faq-question">
                    <span>How does the gematria search engine work?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">
                    Our gematria search engine and gematria decoder allow you to find words and phrases with specific numerical values. You can search using Hebrew, English, or Simple gematria systems. This feature is particularly useful for biblical research and finding connections between different words and concepts.
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <span>Can I calculate phrases with spaces?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">
                    Yes! This gematria name calculator automatically ignores spaces and special characters, focusing only on alphabetical letters. We support gematria calculator names and meaning for all users anytime 24*7 for free. Our calculator is especially useful for analyzing multi-word phrases from religious texts.
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <span>What is the English gematria calculator?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">
                    An English Gematria Calculator is a tool that assigns numerical values to the letters of the English alphabet. Unlike Hebrew, English doesn't have a single ancient system, so our gematria english calculator uses various ciphers like Simple Gematria (A=1, B=2), Reverse Ordinal (A=26, B=25), and Reduction. This allows you to explore the numerical patterns and symbolic connections between English words, names, and phrases, revealing hidden layers of meaning.
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <span>Who should use the gematria calculator?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">
                    A numerology gematria calculator is for anyone curious about the hidden numerical structure of language. It's perfect for:
                    <ul>
                        <li>Spiritual Seekers exploring sacred texts like the Bible.</li>
                        <li>Writers and Artists looking for creative inspiration and symbolic depth.</li>
                        <li>History Buffs interested in ancient interpretive methods.</li>
                        <li>Numerology Enthusiasts analyzing names, dates, and concepts.</li>
                        <li>Anyone who loves puzzles and finding hidden patterns in the world around them.</li>
                    </ul>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <span>What is the Jewish gematria calculator?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">
                    A Jewish Gematria Calculator (or Gematria Calculator Hebrew) is a tool based on the ancient Jewish tradition of assigning numerical values to the 22 letters of the Hebrew alphabet. It primarily uses the <em>Mispar Hechrechi</em> (Standard) system, which is fundamental to Kabbalah and the interpretation of the Torah. This type of gematria hebrew calculator is essential for studying the numerical values of biblical names, concepts, and verses to uncover deeper theological and mystical connections.
                </div>
            </div>
        </section>

        <!-- FOOTER -->
        <footer class="footer">
            <div class="copyright">
                © <?= date('Y') ?> gematriacalculators.org
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
                <a href="https://vpnleaderboard.com/" class="outline-button">
                    <i class="fa-solid fa-shield-halved"></i> VPN Leaderboard
                </a>
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

    <script>
      window.GematriaLang = {
        loadingPhrases: <?= json_encode($loadingPhrases) ?>,
        resultHeaderPrefix: "Gematria Output for: "
      };
    </script>
    <script src="/scripts/index.js"></script>

</body>
</html>
