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
    $pageTitle = 'Darmowy Kalkulator Gematrii — Gematrix i Numerologia | ' . $SITE_NAME;
  }

  // DESCRIPTION: STATIC (don't vary per query — stabilizes snippets/CTR)
  $metaDescription = 'Najlepszy darmowy kalkulator Gematrii. Uzyskaj natychmiastowe i dokładne wyniki dzięki naszemu narzędziu gematrix i numerologii, obsługującemu gematrię angielską, hebrajską i prostą. Idealny do analizy biblijnej i dekodowania wartości.';

  // Canonical: point root when empty; deep-link when there's an input
  $canonicalUrl = $BASE_URL . 'pl/';
  if (!empty($inputRaw)) {
    // use rawurlencode for cleaner canonical with query. Point to the root URL for queries.
    $canonicalUrl .= '?input=' . rawurlencode($inputRaw);
  }

  // Open Graph / Twitter: keep short and dependable; use static description
  $ogTitle = ($results && !empty($displayInput))
    ? sprintf('%s — Wartość Gematrii: %s', $displayInput, (string)$results['english']['total'])
    : 'Darmowy Kalkulator Gematrii — Gematrix i Numerologia';

  // Optional: a share image you host (1200×630 recommended)
  $ogImage = $BASE_URL . 'assets/preview.jpg';

  $loadingPhrases = [
    "Tłumaczenie słów na liczby...",
    "Przywoływanie kodów stworzenia...",
    "Dekodowanie ukrytych wzorców numerycznych...",
    "Dopasowywanie liter do boskich wartości...",
    "Obliczanie twojej sekwencji gematrii...",
    "Śledzenie wibracyjnej sumy twojego imienia...",
    "Odkrywanie tajemniczego znaczenia w liczbach..."
  ];
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
    <link rel="alternate" hreflang="iw" href="<?= $BASE_URL . 'iw/' . ltrim($qs, '?') ?>">
    <link rel="alternate" hreflang="pl" href="<?= $BASE_URL . 'pl/' . ltrim($qs, '?') ?>">
    <link rel="alternate" hreflang="zh" href="<?= $BASE_URL . 'zh/' . ltrim($qs, '?') ?>">
    <link rel="alternate" hreflang="vi" href="<?= $BASE_URL . 'vi/' . ltrim($qs, '?') ?>">
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
    <?php require_once __DIR__ . '/../navigation/header.php'; ?>
    
    <div class="container">

        <!-- Language Support Info -->
        <div class="language-support-info" style="background: #f0f8ff; padding: 12px; margin: 2px 0 10px 0; border-radius: 8px; text-align: center; border: 1px solid #cce5ff;">
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
                <span title="中文">chiński</span> i
                <span title="Tiếng Việt">wietnamski</span>!
            </p>
        </div>

        <!-- ——— Recent Searches Ticker ——— -->
        <div class="recent-phrases ticker-bar">
            <h4>Ostatnie wyszukiwania:</h4>

            <div class="ticker">
                <div class="ticker__list">
                <!-- JS will inject .ticker__item cards here -->
                </div>
            </div>
        </div>

        <header class="header">
            <img src="/assets/talisman-header-icon.png" id="themeLogo" alt="logo kalkulatora gematrii">
            <h1>Kalkulator Gematrii (Gematrix)</h1>
            <p class="subtitle">(Wpisz słowo, imię lub liczbę np. Bóg, Biblia, Hebrajski – aby obliczyć wartości gematrii online)</p>
        </header>

        <main class="calculator">
            <div class="input-group">
                <input
                    id="inputText"
                    type="text"
                    placeholder="Oblicz gematrię mojego imienia..."
                    value="<?= htmlspecialchars($inputRaw, ENT_QUOTES, 'UTF-8') ?>"
                />
                <button class="secondary" onclick="clearInput()" title="Wyczyść">✕</button>
            </div>

            <div class="button-container">
                <button class="calculate-btn" onclick="calculate()">Oblicz Gematrię</button>
                <button class="download-btn" onclick="calculateAndDownload()">Pobierz PDF</button>
                <a href="/decode-gematria-value.php" class="decode-btn">Dekoduj Gematrię</a>
            </div>

            <div class="loading-container" id="loading" style="display:none">
                <div class="spinner"></div>
                <p id="loadingMessage" class="loading-message"></p>
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

                <div class="promotion-box">
                    <div class="promo-icon" style="font-size: 2.5rem; color: var(--primary-color); flex-shrink: 0;">
                        <i class="fa-solid fa-wand-magic-sparkles"></i>
                    </div>
                    <div class="promo-content" style="text-align: center;">
                        <p style="margin: 0; font-weight: 600; font-size: 1.05em;">Rozszerz Swoją Wiedzę Poza Liczby</p>
                        <p style="margin: 6px 0 0 0; font-size: 0.9em;">Podczas gdy gematria odkrywa ukryty kod numeryczny w Twoim życiu, tarot oferuje inną ścieżkę do mądrości. Połącz logikę liczb z intuicją kart, aby uzyskać pełniejszą perspektywę. Skorzystaj z naszego darmowego Codziennego Czytnika Tarota, aby uzupełnić swoją podróż.</p>
                    </div>
                    <a href="https://tarotcardgenerator.online/" target="_blank" class="promo-btn" style="white-space: nowrap; margin-top: 1rem;">
                        Uzyskaj Darmowe Czytanie Tarota
                    </a>
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
            <p>Ten <strong>darmowy kalkulator gematrii online</strong> działa jako potężne narzędzie do obliczania <strong>gematrii imion</strong> i obsługuje konwersje z <strong>gematrii angielskiej na hebrajską</strong>. Niezależnie od tego, czy szukasz <strong>kalkulatora gematrii online</strong> do analizy biblijnej, czy po prostu <strong>prostego kalkulatora gematrii</strong> do odkrywania znaczeń liczb, to narzędzie jest stworzone dla Ciebie. Użytkownicy często szukają terminów takich jak "<strong>kalkulator gematria</strong>" lub "<strong>gematria calculater</strong>" — i to narzędzie zapewnia poszukiwaną funkcjonalność.</p>
            <div class="example">Przykład: <strong>Biblia</strong> = 38 (Hebrajski), 180 (Angielski), 30 (Prosty)</div>
        </div>

        <!-- SEO SECTION #2 -->
        <div class="seo-section">
            <p>Nasz najlepszy <strong>kalkulator gematrii</strong> (znany również jako <strong>gematrix</strong>) został zaprojektowany z myślą o dokładności i prostocie. Jest idealny dla uczonych, poszukiwaczy duchowych lub każdego zainteresowanego świętymi tekstami. Dzięki naszemu <strong>kalkulatorowi gematrii hebrajskiej</strong> możesz użyć naszego <strong>dekodera gematrii</strong> do analizy duchowych imion lub odkrywania ezoterycznych powiązań. Wypróbuj dziś <strong>darmowy prosty kalkulator gematrii</strong> i zanurz się w świecie liczb z pewnością siebie. To świetna alternatywa dla Gematrix.org.</p>
        </div>

        <hr class="divider">
        <br>

        <!-- GLOBAL FEEDBACK BANNER -->
        <div class="global-feedback-message" id="globalFeedback"></div>

        <!-- FAQ & FOOTER -->
        <!-- Language Popup -->
        <div class="lang-popup">
            <div class="lang-popup-content">
                <button class="lang-popup-close" onclick="closeLangPopup()">&times;</button>
                <h4>Wybierz język</h4>
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
                    <strong>Darmowy kalkulator gematrii</strong> to narzędzie online, które automatycznie oblicza wartość liczbową słowa lub frazy. Działa jako nowoczesny <strong>generator gematrii</strong> oparty na starożytnych systemach numerologicznych.
                </div>
            </div>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)">
                    <span>Jak korzystać z kalkulatora gematrii online?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">
                    Aby skorzystać z naszego najlepszego <strong>darmowego kalkulatora gematrii online</strong>, wystarczy wpisać słowo lub frazę w polu tekstowym, a następnie kliknąć „Oblicz Gematrię”, aby wygenerować jego wartości w systemach hebrajskim, angielskim i prostym.
                </div>
            </div>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)">
                    <span>Jak zrozumieć prosty kalkulator gematrii?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">
                    Nasz <strong>prosty kalkulator gematrii</strong> przypisuje A=1, B=2, C=3, … Z=26, a następnie sumuje te wartości. Wpisz słowo takie jak „Prawda”, a otrzymasz sumę, którą możesz porównać z innymi słowami o tej samej wartości.
                </div>
            </div>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)">
                    <span>Jak korzystać z biblijnego kalkulatora gematrii?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">
                    Nasz <strong>biblijny kalkulator gematrii</strong> jest przeznaczony do analizy tekstów i imion biblijnych. Otrzymasz natychmiastowe wartości <strong>gematrii hebrajskiej, angielskiej i prostej</strong>. Nasz kalkulator obsługuje znaki hebrajskie, co czyni go najlepszym <strong>kalkulatorem gematrii do badań biblijnych</strong>. Wspieramy również zasady <strong>greckiego kalkulatora gematrii</strong>.
                </div>
            </div>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)">
                    <span>Jak działa wyszukiwarka gematrii?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">
                    Nasza <strong>wyszukiwarka gematrii</strong> i <strong>dekoder gematrii</strong> pozwalają znaleźć słowa o określonych wartościach liczbowych. Możesz wyszukiwać za pomocą systemów <strong>gematrii hebrajskiej, angielskiej lub prostej</strong>.
                </div>
            </div>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)">
                    <span>Czy mogę obliczać frazy ze spacjami?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">
                    Tak! Ten <strong>kalkulator gematrii imion</strong> automatycznie ignoruje spacje i znaki specjalne. Wspieramy <strong>kalkulator gematrii imion i znaczeń</strong> dla wszystkich użytkowników za darmo.
                </div>
            </div>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)">
                    <span>Czym jest kalkulator gematrii angielskiej?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">
                    <strong>Kalkulator Gematrii Angielskiej</strong> przypisuje wartości liczbowe literom alfabetu angielskiego. Nasz <strong>angielski kalkulator gematrii</strong> używa różnych szyfrów, takich jak Gematria Prosta (A=1, B=2), aby odkryć ukryte warstwy znaczenia.
                </div>
            </div>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)">
                    <span>Kto powinien używać kalkulatora gematrii?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">
                    <strong>Kalkulator numerologii i gematrii</strong> jest dla każdego, kto jest ciekawy ukrytej struktury numerycznej języka. Jest idealny dla:
                    <ul>
                        <li><strong>Poszukiwaczy Duchowych</strong> badających święte teksty jak Biblia.</li>
                        <li><strong>Pisarzy i Artystów</strong> szukających twórczej inspiracji i głębi symbolicznej.</li>
                        <li><strong>Pasjonatów Historii</strong> zainteresowanych starożytnymi metodami interpretacji.</li>
                        <li><strong>Entuzjastów Numerologii</strong> analizujących imiona, daty i koncepcje.</li>
                        <li><strong>Każdego, kto kocha zagadki</strong> i odkrywanie ukrytych wzorców w otaczającym ich świecie.</li>
                    </ul>
                </div>
            </div>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)">
                    <span>Czym jest żydowski kalkulator gematrii?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">
                    <strong>Żydowski Kalkulator Gematrii</strong> (lub <strong>Hebrajski Kalkulator Gematrii</strong>) opiera się na żydowskiej tradycji przypisywania wartości liczbowych literom hebrajskim. Ten typ <strong>hebrajskiego kalkulatora gematrii</strong> jest niezbędny do badania wartości liczbowych biblijnych imion i pojęć.
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

    <script>
      window.GematriaLang = {
        loadingPhrases: <?= json_encode($loadingPhrases) ?>
      };
    </script>
    <script src="/scripts/index.js"></script>
</body>
</html>
