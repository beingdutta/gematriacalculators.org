<?php
  // index.php
  // 1) pull in your calculate.php (which defines gematria() and also handles AJAX POSTs)
  require_once __DIR__ . '/../calculate.php';
  require_once __DIR__ . '/../helpers.php';

  // 2) fetch the URL‐param (for deep-linking) and, if present, run the server-side calculation
  $inputRaw = $_GET['input'] ?? '';
  $results  = $inputRaw !== '' ? gematria($inputRaw) : null;

  // SEO: make description STATIC, keep title concise (optionally dynamic)
  $SITE_NAME        = 'Kalkulator Gematrii';
  $BASE_URL         = 'https://gematriacalculators.org/';

  // Clean a display version of the query for title/OG only
  $displayInput = trim($inputRaw);
  if ($displayInput !== '') {
    // limit to ~60 chars to avoid super-long titles
    $displayInput = mb_strimwidth($displayInput, 0, 60, '…', 'UTF-8');
  }

  // Title: short, human-readable. If there are results, include the English total once.
  if ($results && isset($results['english']['total'])) {
    $pageTitle = sprintf(
      '%s — Wartość Gematrii: %s | %s',
      ucfirst($displayInput),
      (string)$results['english']['total'],
      $SITE_NAME
    );
  } else {
    $pageTitle = 'Darmowy Kalkulator Gematrii — Hebrajski, Angielski i Prosty | ' . $SITE_NAME;
  }

  // DESCRIPTION: STATIC (don't vary per query — stabilizes snippets/CTR)
  $metaDescription = 'Darmowy kalkulator online dla systemów gematrii hebrajskiej, angielskiej i prostej. Natychmiast oblicz wartości i znaczenia gematrii dla dowolnego słowa lub frazy.';

  // Canonical: point root when empty; deep-link when there's an input
  $canonicalUrl = $BASE_URL . 'pl/';
  if (!empty($inputRaw)) {
    // use rawurlencode for cleaner canonical with query. Point to the root URL for queries.
    $canonicalUrl .= '?input=' . rawurlencode($inputRaw);
  }

  // Open Graph / Twitter: keep short and dependable; use static description
  $ogTitle = ($results && !empty($displayInput))
    ? sprintf('%s — Wartość Gematrii: %s', $displayInput, (string)$results['english']['total'])
    : 'Darmowy Kalkulator Gematrii';

  // Optional: a share image you host (1200×630 recommended)
  $ogImage = $BASE_URL . 'assets/preview.jpg';
?>

<!DOCTYPE html>
<html lang="pl" data-theme="light">
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

    <!-- Google AdSense -->
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4198904821948931" crossorigin="anonymous"></script>

    <meta charset="UTF-8">
    <meta name="p:domain_verify" content="9a2f772bde6a1162d2e6c441caf23a2a"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Keep keywords minimal or remove (search engines largely ignore this) -->
    <meta name="keywords" content="kalkulator gematrii, gematria hebrajska, gematria angielska, prosta gematria">

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
    <link rel="alternate" hreflang="he" href="<?= $BASE_URL . 'iw/' . ltrim($qs, '?') ?>">
    <link rel="alternate" hreflang="pl" href="<?= $BASE_URL . 'pl/' . ltrim($qs, '?') ?>">
    <link rel="alternate" hreflang="x-default" href="<?= $BASE_URL . ltrim($qs, '?') ?>">

    <!-- JSON-LD: WebApplication schema for a calculator -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "WebApplication",
      "name": "Kalkulator Gematrii",
      "url": "<?= htmlspecialchars($BASE_URL . 'pl/', ENT_QUOTES, 'UTF-8'); ?>",
      "description": "Darmowy kalkulator online dla systemów gematrii hebrajskiej, angielskiej i prostej.",
      "applicationCategory": "Calculator",
      "operatingSystem": "Any",
      "inLanguage": "pl"
    }
    </script>

    <link rel="icon" href="/assets/talisman-site-icon.png" sizes="32x32">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="/styles/index.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>
</head>

<body>
    <nav class="header-nav">
        <a href="/pl/">Strona główna</a>
        <a href="/more-tools/">Więcej Narzędzi</a>
        <a href="/blog-collections/">Blog</a>
        <a href="/about-us/">O Nas</a>
        <a href="/contact-us/">Kontakt</a>
        <a href="/terms-conditions/">Regulamin</a>
        <a href="/privacy-policy/">Polityka Prywatności</a>
        <button class="theme-toggle" onclick="toggleTheme()" aria-label="Przełącz motyw">
          <svg class="icon-sun" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="5"></circle><line x1="12" y1="1" x2="12" y2="3"></line><line x1="12" y1="21" x2="12" y2="23"></line><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line><line x1="1" y1="12" x2="3" y2="12"></line><line x1="21" y1="12" x2="23" y2="12"></line><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line></svg>
          <svg class="icon-moon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path></svg>
        </button>
    </nav>
    
    <div class="container">
        <!-- Language Support Info -->
        <div class="language-support-info" style="background: #f0f8ff; padding: 12px; margin: 10px 0; border-radius: 8px; text-align: center; border: 1px solid #cce5ff;">
            <p style="margin: 0; color: #004085; font-size: 13px;">
                🌍 Dziękujemy za zaufanie! Teraz wspieramy wiele języków: 
                <span title="English">angielski</span>, 
                <span title="Русский">rosyjski</span>, 
                <span title="Deutsch">niemiecki</span>, 
                <span title="Español">hiszpański</span>, 
                <span title="Português">portugalski</span>, 
                <span title="Italiano">włoski</span>, 
                <span title="עברית">hebrajski</span>, 
                <strong>polski</strong> i 
                <span title="中文">chiński</span>!
            </p>
        </div>

        <!-- ——— Recent Searches Ticker ——— -->
        <div class="recent-phrases ticker-bar">
            <h4>Ostatnie wyszukiwania:</h4>

            <!-- ——— Language Switcher ——— -->
            <?php                                    
            $qs = $_SERVER['QUERY_STRING'] ? '?'.$_SERVER['QUERY_STRING'] : '';
            $here = trim(dirname($_SERVER['SCRIPT_NAME']), '/'); // '' or 'ru' or 'de'
            ?>
            <nav class="lang-switcher" aria-label="Przełącznik języka">
            <?= lang_switcher_link('en','EN',$qs,$here) ?> |
            <?= lang_switcher_link('ru','RU',$qs,$here) ?> |
            <?= lang_switcher_link('de','DE',$qs,$here) ?> |
            <?= lang_switcher_link('es','ES',$qs,$here) ?> |
            <?= lang_switcher_link('pt','PT',$qs,$here) ?> |
            <?= lang_switcher_link('it','IT',$qs,$here) ?> |
            <?= lang_switcher_link('iw','HE',$qs,$here) ?> |
            <?= lang_switcher_link('pl','PL',$qs,$here) ?>
            </nav>

            <div class="ticker">
                <div class="ticker__list">
                <!-- JS will inject .ticker__item cards here -->
                </div>
            </div>
        </div>

        <header class="header">
            <img src="/assets/talisman-header-icon.png" id="themeLogo" alt="logo kalkulatora gematrii">
            <h1>Kalkulator Gematrii</h1>
            <p class="subtitle">(Wpisz słowo lub liczbę np. Bóg, Biblia, Hebrajski, Święty – aby obliczyć wartości gematrii)</p>
        </header>

        <main class="calculator">
            <div class="input-group">
                <input
                    id="inputText"
                    type="text"
                    placeholder="Wprowadź tekst do obliczenia…"
                    value="<?= htmlspecialchars($inputRaw, ENT_QUOTES, 'UTF-8') ?>"
                />
                <button class="secondary" onclick="clearInput()" title="Wyczyść">✕</button>
            </div>

            <div class="button-container">
                <button class="calculate-btn" onclick="calculate()">Oblicz</button>
                <button class="download-btn" onclick="calculateAndDownload()">Pobierz PDF</button>
                <a href="/decode-gematria-value/" class="decode-btn">Dekoduj Gematrię</a>
            </div>

            <div class="loading-container" id="loading" style="display:none">
                <div class="spinner"></div>
            </div>

            <div class="result" id="result" style="<?= $results ? 'display:block;' : 'display:none;' ?>">
                <div class="result-card">
                    <button class="copy-btn" onclick="copyValue('hebrewValue','hebrewCopyNotification')">
                        <i class="fa-regular fa-copy"></i>
                    </button>
                    <div class="copy-notification" id="hebrewCopyNotification">Skopiowano!</div>
                    <h3>Gematria Hebrajska: <span id="hebrewValue">
                    <?= $results['hebrew']['total'] ?? 0 ?>
                    </span></h3>
                    <p id="hebrewBreakdown">
                    <?php if($results): ?>
                        Obliczenie: <?= implode(' + ', $results['hebrew']['breakdown']) ?>
                    <?php endif ?>
                    </p>
                </div>

                <div class="result-card">
                    <button class="copy-btn" onclick="copyValue('englishValue','englishCopyNotification')">
                        <i class="fa-regular fa-copy"></i>
                    </button>
                    <div class="copy-notification" id="englishCopyNotification">Skopiowano!</div>
                    <h3>Gematria Angielska: <span id="englishValue">
                    <?= $results['english']['total'] ?? 0 ?>
                    </span></h3>
                    <p id="englishBreakdown">
                    <?php if($results): ?>
                        Obliczenie: (<?= implode(' + ', $results['simple']['breakdown']) ?>) × 6
                    <?php endif ?>
                    </p>
                </div>

                <div class="result-card">
                    <button class="copy-btn" onclick="copyValue('simpleValue','simpleCopyNotification')">
                        <i class="fa-regular fa-copy"></i>
                    </button>
                    <div class="copy-notification" id="simpleCopyNotification">Skopiowano!</div>
                    <h3>Prosta Gematria: <span id="simpleValue">
                    <?= $results['simple']['total'] ?? 0 ?>
                    </span></h3>
                    <p id="simpleBreakdown">
                    <?php if($results): ?>
                        Obliczenie: <?= implode(' + ', $results['simple']['breakdown']) ?>
                    <?php endif ?>
                    </p>
                </div>

                <div class="feedback">
                    <p>Czy ten kalkulator był pomocny?</p>
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
            W sprawie opinii, sugestii lub ulepszeń tego narzędzia, prosimy o kontakt mailowy na adres <a href="mailto:admins@gematriacalculators.org" style="color: var(--error); text-decoration: underline;">admins@gematriacalculators.org</a>.
        </p>

        <!-- SEO SECTION #1 -->
        <div class="seo-section">
            <h4>Odkryj Ukryte Znaczenia Numeryczne</h4>
            <p>Ten darmowy kalkulator gematrii online działa jako potężne narzędzie do obliczania gematrii imion i obsługuje konwersje z języka angielskiego na hebrajski. Niezależnie od tego, czy szukasz kalkulatora gematrii online do analizy biblijnej, czy po prostu prostego kalkulatora gematrii do odkrywania znaczeń liczb, to narzędzie jest stworzone dla Ciebie. Użytkownicy często szukają terminów takich jak "kalkulator gematrii", "kalkulator numerologii hebrajskiej" i "prosty kalkulator gematrii" — i to narzędzie zapewnia poszukiwaną funkcjonalność.</p>
            <div class="example">Przykład: <strong>Biblia</strong> = 38 (Hebrajski), 180 (Angielski), 30 (Prosty)</div>
        </div>

        <!-- SEO SECTION #2 -->
        <div class="seo-section">
            <p>Nasz najlepszy kalkulator gematrii online (znany również jako kalkulator gematrix) został zaprojektowany z myślą o dokładności, szybkości i prostocie. Jest idealny dla uczonych, poszukiwaczy duchowych lub każdego zainteresowanego mistycznymi tradycjami stojącymi za świętymi tekstami. Dzięki naszemu najlepszemu kalkulatorowi gematrii hebrajskiej możesz dekodować fragmenty biblijne, analizować duchowe imiona lub odkrywać ezoteryczne powiązania — wszystko w jednym miejscu. Wypróbuj dziś najprostszy darmowy kalkulator gematrii i zanurz się w świecie symbolicznych znaczeń liczb z pewnością siebie.</p>
        </div>

        <hr class="divider">
        <br>

        <!-- GLOBAL FEEDBACK BANNER -->
        <div class="global-feedback-message" id="globalFeedback"></div>

        <!-- FAQ & FOOTER -->
        <footer class="footer">
            <!-- FAQ ITEMS -->
            <h2 class="faq-heading">Często Zadawane Pytania</h2>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)">
                    <span>Czym jest Gematria?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">
                    Gematria to alfanumeryczny kod przypisujący wartość liczbową imieniu, słowu lub frazie na podstawie jej liter. Jest powszechnie używana w mistycyzmie żydowskim i interpretacji biblijnej.
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)">
                    <span>Czym jest kalkulator gematrii?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">
                    Darmowy kalkulator gematrii online to narzędzie lub oprogramowanie, które automatycznie oblicza wartość liczbową słowa, frazy lub imienia poprzez przypisanie wartości liczbowych każdej literze, w oparciu o określone systemy gematrii.
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)">
                    <span>Jak korzystać z kalkulatora gematrii online?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">
                    Aby użyć naszego najlepszego darmowego kalkulatora gematrii online, po prostu wpisz słowo, frazę lub imię w pole tekstowe, a następnie kliknij "Oblicz", aby wygenerować wartości liczbowe w systemach hebrajskim, angielskim i prostym. Dla zapisu możesz również pobrać raport PDF.
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)">
                    <span>Jak zrozumieć prosty kalkulator gematrii?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">
                    Nasz prosty kalkulator gematrii przypisuje A=1, B=2, C=3, ... Z=26, a następnie sumuje te wartości. Wprowadź słowo, jak "Prawda", a otrzymasz sumę, którą możesz porównać z innymi słowami o tej samej wartości.
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)">
                    <span>Czy mogę obliczać frazy ze spacjami?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">
                    Tak! Ten kalkulator gematrii automatycznie pomija spacje i znaki specjalne, skupiając się tylko na literach alfabetu. Wspieramy obliczanie gematrii imion i znaczeń dla wszystkich użytkowników przez całą dobę, 7 dni w tygodniu, za darmo.
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)">
                    <span>Czym jest kalkulator gematrii angielskiej?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">
                    <strong>Kalkulator Gematrii Angielskiej</strong> to narzędzie, które przypisuje wartości liczbowe literom alfabetu angielskiego. W przeciwieństwie do hebrajskiego, angielski nie ma jednego starożytnego systemu, więc kalkulatory używają różnych szyfrów, jak Prosta Gematria (A=1, B=2), Odwrócony Porządkowy (A=26, B=25) i Redukcja. Pozwala to na odkrywanie wzorców numerycznych i symbolicznych powiązań między angielskimi słowami, imionami i frazami, ujawniając ukryte warstwy znaczenia.
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)">
                    <span>Kto powinien używać kalkulatora gematrii?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">
                    <strong>Kalkulator gematrii</strong> jest dla każdego, kto jest ciekawy ukrytej struktury numerycznej języka. Jest idealny dla:
                    <ul>
                        <li><strong>Poszukiwaczy Duchowych</strong> badających święte teksty jak Biblia.</li>
                        <li><strong>Pisarzy i Artystów</strong> szukających twórczej inspiracji i głębi symbolicznej.</li>
                        <li><strong>Pasjonatów Historii</strong> zainteresowanych starożytnymi metodami interpretacji.</li>
                        <li><strong>Entuzjastów Numerologii</strong> analizujących imiona, daty i koncepcje.</li>
                        <li><strong>Każdego, kto kocha zagadki</strong> i odkrywanie ukrytych wzorów w otaczającym świecie.</li>
                    </ul>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)">
                    <span>Czym jest żydowski kalkulator gematrii?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">
                    <strong>Żydowski Kalkulator Gematrii</strong> (lub Hebrajski Kalkulator Gematrii) to narzędzie oparte na starożytnej tradycji żydowskiej przypisywania wartości liczbowych 22 literom alfabetu hebrajskiego. Wykorzystuje głównie system <em>Mispar Hechrechi</em> (Standardowy), który jest fundamentalny dla Kabały i interpretacji Tory. Ten typ kalkulatora jest niezbędny do studiowania wartości liczbowych biblijnych imion, pojęć i wersetów, aby odkryć głębsze powiązania teologiczne i mistyczne.
                </div>
            </div>

            <!-- COPYRIGHT NOTICE -->
            <div class="copyright">
                © <?= date('Y') ?> gematriacalculators.org
            </div>
        </footer>
    </div>

    <div id="exitModal" class="modal">
        <div class="modal-content animate-scale">
            <button class="modal-close" id="exitModalClose" aria-label="Zamknij Modal">
                <i class="fa-solid fa-circle-xmark"></i>
            </button>
            <h2><i class="fa-solid fa-star text-primary"></i> Nie wychodź jeszcze!</h2>
            <p>Czy wypróbowałeś nasze ekscytujące nowe narzędzia?</p>
            <div class="modal-links">
                <a href="https://vpnleaderboard.com/" class="outline-button">
                    <i class="fa-solid fa-shield-halved"></i> VPN Leaderboard
                </a>
                <a href="http://tarotcardgenerator.online/" class="outline-button">
                    <i class="fa-solid fa-wand-magic-sparkles"></i> Czytnik Tarota
                </a>
                <a href="https://www.snowdayscalculatorai.com/" class="outline-button">
                    <i class="fa-solid fa-snowflake"></i> Kalkulator Śnieżnych Dni
                </a>
            </div>
            <p style="margin-top: 1rem;">
                <i class="fa-solid fa-face-smile-wink fa-lg text-primary"></i>
                Ciesz się i wróć wkrótce!
            </p>
        </div>
    </div>

    <script src="/scripts/index.js"></script>
</body>
</html>
