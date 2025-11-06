<?php
  // index.php
  // 1) pull in your calculate.php (which defines gematria() and also handles AJAX POSTs)
  require_once __DIR__ . '/../calculate.php';
  require_once __DIR__ . '/../helpers.php';

  // 2) fetch the URL‐param (for deep-linking) and, if present, run the server-side calculation
  $inputRaw = $_GET['input'] ?? '';
  $results  = $inputRaw !== '' ? gematria($inputRaw) : null;

  // SEO: make description STATIC, keep title concise (optionally dynamic)
  $SITE_NAME        = 'Calcolatore di Gematria';
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
      '%s — Valore di Gematria: %s | %s',
      ucfirst($displayInput),
      (string)$results['english']['total'],
      $SITE_NAME
    );
  } else {
    $pageTitle = 'Calcolatore di Gematria Gratuito — Ebraico, Inglese e Semplice | ' . $SITE_NAME;
  }

  // DESCRIPTION: STATIC (don't vary per query — stabilizes snippets/CTR)
  $metaDescription = 'Calcolatore di Gematria online gratuito per sistemi Ebraico, Inglese e Semplice. Calcola istantaneamente valori e significati di gematria per qualsiasi parola o frase.';

  // Canonical: point root when empty; deep-link when there's an input
  $canonicalUrl = $BASE_URL . 'it/';
  if (!empty($inputRaw)) {
    // use rawurlencode for cleaner canonical with query. Point to the root URL for queries.
    $canonicalUrl .= '?input=' . rawurlencode($inputRaw);
  }

  // Open Graph / Twitter: keep short and dependable; use static description
  $ogTitle = ($results && !empty($displayInput))
    ? sprintf('%s — Valore di Gematria: %s', $displayInput, (string)$results['english']['total'])
    : 'Calcolatore di Gematria Gratuito';

  // Optional: a share image you host (1200×630 recommended)
  $ogImage = $BASE_URL . 'assets/preview.jpg';
?>

<!DOCTYPE html>
<html lang="it" data-theme="light">
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
    <meta name="keywords" content="calcolatore gematria, gematria ebraica, gematria inglese, gematria semplice">

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

    <!-- Additional SEO meta tags for multilingual -->
    <meta property="og:locale" content="it_IT" />
    <meta property="og:locale:alternate" content="en_US" />
    <meta property="og:locale:alternate" content="ru_RU" />
    <meta property="og:locale:alternate" content="de_DE" />
    <meta property="og:locale:alternate" content="es_ES" />
    <meta property="og:locale:alternate" content="iw_IL" />
    <meta property="og:locale:alternate" content="pl_PL" />
    <meta property="og:locale:alternate" content="pt_BR" />
    <meta property="og:locale:alternate" content="zh_CN" />

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
    <link rel="alternate" hreflang="x-default" href="<?= $BASE_URL . ltrim($qs, '?') ?>">

    <!-- JSON-LD: WebApplication schema for a calculator -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "WebApplication",
      "name": "Calcolatore di Gematria",
      "url": "<?= htmlspecialchars($BASE_URL . 'it/', ENT_QUOTES, 'UTF-8'); ?>",
      "description": "Calcolatore online gratuito per valori di gematria Ebraica, Inglese e Semplice.",
      "applicationCategory": "Calculator",
      "operatingSystem": "Any",
      "inLanguage": "it"
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
        <button class="mobile-menu-toggle" aria-label="Toggle menu">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
        </button>
        <a href="/it/" class="mobile-site-title">GEMATRIA</a>
        <div class="nav-links">
            <a href="/it/">Home</a>
            <a href="/more-tools/">Altri Strumenti</a>
            <a href="/blog-collections/">Blog</a>
            <a href="/about-us/">Chi Siamo</a>
            <a href="/contact-us/">Contattaci</a>
            <a href="/terms-conditions/">Termini e Condizioni</a>
            <a href="/privacy-policy/">Privacy Policy</a>
            <button class="lang-change-btn mobile-only" onclick="openLangPopup()">Cambia Lingua</button>
        </div>
        <button class="theme-toggle" onclick="toggleTheme()" aria-label="Cambia tema">
          <svg class="icon-sun" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="5"></circle><line x1="12" y1="1" x2="12" y2="3"></line><line x1="12" y1="21" x2="12" y2="23"></line><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line><line x1="1" y1="12" x2="3" y2="12"></line><line x1="21" y1="12" x2="23" y2="12"></line><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line></svg>
          <svg class="icon-moon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path></svg>
        </button>
    </nav>
    
    <div class="container">
        <!-- Language Support Info -->
        <div class="language-support-info" style="background: #f0f8ff; padding: 12px; margin: 2px 0 10px 0; border-radius: 8px; text-align: center; border: 1px solid #cce5ff;">
          <p style="margin: 0; color: #004085; font-size: 13px;">
                🌍 Grazie per la fiducia! Ora supportiamo diverse lingue: 
                <span title="English">inglese</span>, 
                <span title="Русский">russo</span>, 
                <span title="Deutsch">tedesco</span>, 
                <span title="Español">spagnolo</span>, 
                <span title="Português">portoghese</span>, 
                <strong>italiano</strong>, 
                <span title="עברית">ebraico</span>, 
                <span title="Polski">polacco</span> e 
                <span title="中文">cinese</span>!
            </p>
        </div>

        <!-- ——— Recent Searches Ticker ——— -->
        <div class="recent-phrases ticker-bar">
            <h4>Ricerche recenti:</h4>

            <!-- ——— Language Switcher ——— -->
            <?php                                    
            $qs = $_SERVER['QUERY_STRING'] ? '?'.$_SERVER['QUERY_STRING'] : '';
            $here = trim(dirname($_SERVER['SCRIPT_NAME']), '/'); // '' or 'ru' or 'de' or 'es' or 'pt' or 'it'
            ?>
            <nav class="lang-switcher" aria-label="Selettore lingua">
            <?= lang_switcher_link('en','EN',$qs,$here) ?> |
            <?= lang_switcher_link('ru','RU',$qs,$here) ?> |
            <?= lang_switcher_link('de','DE',$qs,$here) ?> |
            <?= lang_switcher_link('es','ES',$qs,$here) ?> |
            <?= lang_switcher_link('pt','PT',$qs,$here) ?> |
            <?= lang_switcher_link('it','IT',$qs,$here) ?> |
            <?= lang_switcher_link('iw','HE',$qs,$here) ?> |
            <?= lang_switcher_link('pl','PL',$qs,$here) ?> |
            <?= lang_switcher_link('zh','CN',$qs,$here) ?>
            </nav>

            <div class="ticker">
                <div class="ticker__list">
                <!-- JS will inject .ticker__item cards here -->
                </div>
            </div>
        </div>

        <header class="header">
            <img src="/assets/talisman-header-icon.png" id="themeLogo" alt="logo del sito calcolatore di gematria">
            <h1>Calcolatore di Gematria</h1>
            <p class="subtitle">(Inserisci una parola o un numero es. Dio, Bibbia, Ebraico, Santo – per calcolare i valori di gematria)</p>
        </header>

        <main class="calculator">
            <div class="input-group">
                <input
                    id="inputText"
                    type="text"
                    placeholder="Inserisci il testo da calcolare..."
                    value="<?= htmlspecialchars($inputRaw, ENT_QUOTES, 'UTF-8') ?>"
                />
                <button class="secondary" onclick="clearInput()" title="Cancella">✕</button>
            </div>

            <div class="button-container">
                <button class="calculate-btn" onclick="calculate()">Calcola</button>
                <button class="download-btn" onclick="calculateAndDownload()">Scarica PDF</button>
                <a href="/it/decode-gematria-value/" class="decode-btn">Decodifica Gematria</a>
            </div>

            <div class="loading-container" id="loading" style="display:none">
                <div class="spinner"></div>
            </div>

            <div class="result" id="result" style="<?= $results ? 'display:block;' : 'display:none;' ?>">
                <div class="result-card">
                    <button class="copy-btn" onclick="copyValue('hebrewValue','hebrewCopyNotification')">
                        <i class="fa-regular fa-copy"></i>
                    </button>
                    <div class="copy-notification" id="hebrewCopyNotification">Copiato!</div>
                    <h3>Gematria Ebraica: <span id="hebrewValue">
                    <?= $results['hebrew']['total'] ?? 0 ?>
                    </span></h3>
                    <p id="hebrewBreakdown">
                    <?php if($results): ?>
                        Calcolo: <?= implode(' + ', $results['hebrew']['breakdown']) ?>
                    <?php endif ?>
                    </p>
                </div>

                <div class="result-card">
                    <button class="copy-btn" onclick="copyValue('englishValue','englishCopyNotification')">
                        <i class="fa-regular fa-copy"></i>
                    </button>
                    <div class="copy-notification" id="englishCopyNotification">Copiato!</div>
                    <h3>Gematria Inglese: <span id="englishValue">
                    <?= $results['english']['total'] ?? 0 ?>
                    </span></h3>
                    <p id="englishBreakdown">
                    <?php if($results): ?>
                        Calcolo: (<?= implode(' + ', $results['simple']['breakdown']) ?>) × 6
                    <?php endif ?>
                    </p>
                </div>

                <div class="result-card">
                    <button class="copy-btn" onclick="copyValue('simpleValue','simpleCopyNotification')">
                        <i class="fa-regular fa-copy"></i>
                    </button>
                    <div class="copy-notification" id="simpleCopyNotification">Copiato!</div>
                    <h3>Gematria Semplice: <span id="simpleValue">
                    <?= $results['simple']['total'] ?? 0 ?>
                    </span></h3>
                    <p id="simpleBreakdown">
                    <?php if($results): ?>
                        Calcolo: <?= implode(' + ', $results['simple']['breakdown']) ?>
                    <?php endif ?>
                    </p>
                </div>

                <div class="feedback">
                    <p>Questo calcolatore è stato utile?</p>
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
            Per feedback, suggerimenti o miglioramenti di questo strumento, inviaci una email a <a href="mailto:admins@gematriacalculators.org" style="color: var(--error); text-decoration: underline;">admins@gematriacalculators.org</a>.
        </p>

        <!-- SEO SECTION #1 -->
        <div class="seo-section">
            <h4>Scopri Significati Numerici Nascosti</h4>
            <p>Questo calcolatore di gematria gratuito online funziona come un potente calcolatore di nomi e supporta le conversioni dall'inglese alla gematria ebraica. Che tu stia cercando un calcolatore di gematria online per l'analisi biblica o semplicemente un calcolatore di gematria semplice per esplorare significati numerici, questo strumento è progettato per te.</p>
            <div class="example">Esempio: <strong>Bibbia</strong> = 38 (Ebraico), 180 (Inglese), 30 (Semplice)</div>
        </div>

        <!-- SEO SECTION #2 -->
        <div class="seo-section">
            <p>Il nostro miglior calcolatore di gematria online è progettato per precisione, velocità e semplicità. È perfetto per studiosi, ricercatori spirituali o chiunque sia interessato alle tradizioni mistiche dietro i testi sacri. Con il nostro calcolatore di gematria ebraica, puoi decodificare passaggi biblici, analizzare nomi spirituali o esplorare connessioni esoteriche, tutto in un unico posto.</p>
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
                <h4>Seleziona Lingua</h4>
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
                </div>
            </div>
        </div>
        <footer class="footer">
            <!-- FAQ ITEMS -->
            <h2 class="faq-heading">Domande Frequenti</h2>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)">
                    <span>Che cos'è la Gematria?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">
                    La Gematria è un codice alfanumerico che assegna un valore numerico a un nome, parola o frase basandosi sulle sue lettere. È comunemente usata nel misticismo ebraico e nell'interpretazione biblica.
                </div>
            </div>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)">
                    <span>Cos'è un calcolatore di gematria?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">
                    Uno strumento o software online gratuito per il calcolo della gematria che calcola automaticamente il valore numerico di una parola, frase o nome assegnando valori numerici a ciascuna lettera, basandosi su specifici sistemi di gematria.
                </div>
            </div>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)">
                    <span>Come si usa il calcolatore di gematria online?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">
                    Per usare il nostro miglior calcolatore di gematria gratuito online, basta digitare una parola, frase o nome nella casella di input, quindi cliccare su “Calcola” per generare i suoi valori numerici nei sistemi Ebraico, Inglese e Semplice. Per avere una registrazione, puoi anche scaricare un report PDF.
                </div>
            </div>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)">
                    <span>Come funziona il calcolatore di gematria semplice?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">
                    Il nostro calcolatore di gematria semplice assegna A=1, B=2, C=3, … Z=26, e poi somma questi valori. Inserisci una parola come “Verità” e ti darà il totale, che puoi confrontare con altre parole che hanno lo stesso valore.
                </div>
            </div>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)">
                    <span>Come si usa il calcolatore di gematria biblica?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">
                    Il nostro calcolatore di gematria biblica è progettato per analizzare testi e nomi biblici. Basta inserire qualsiasi parola o frase dalla Bibbia e otterrai valori istantanei di gematria ebraica, inglese e semplice. Il nostro calcolatore supporta caratteri ebraici sia moderni che biblici, rendendolo il miglior calcolatore di gematria per la ricerca biblica.
                </div>
            </div>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)">
                    <span>Come funziona il motore di ricerca di gematria?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">
                    Il nostro motore di ricerca di gematria ti permette di trovare parole e frasi con valori numerici specifici. Puoi cercare usando i sistemi di gematria ebraico, inglese o semplice. Questa funzione è particolarmente utile per la ricerca biblica e per trovare connessioni tra parole e concetti diversi.
                </div>
            </div>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)">
                    <span>Posso calcolare frasi con spazi?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">
                    Sì! Questo calcolatore di nomi di gematria ignora automaticamente spazi e caratteri speciali, concentrandosi solo sulle lettere dell'alfabeto. Supportiamo il calcolatore di nomi e significati di gematria per tutti gli utenti in qualsiasi momento 24/7 gratuitamente. Il nostro calcolatore è particolarmente utile per analizzare frasi composte da più parole tratte da testi religiosi.
                </div>
            </div>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)">
                    <span>Cos'è il calcolatore di gematria inglese?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">
                    Un Calcolatore di Gematria Inglese è uno strumento che assegna valori numerici alle lettere dell'alfabeto inglese. A differenza dell'ebraico, l'inglese non ha un unico sistema antico, quindi i calcolatori utilizzano varie cifrature come la Gematria Semplice (A=1, B=2), l'Ordinale Inverso (A=26, B=25) e la Riduzione. Ciò consente di esplorare i modelli numerici e le connessioni simboliche tra parole, nomi e frasi inglesi, rivelando strati nascosti di significato.
                </div>
            </div>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)">
                    <span>Chi dovrebbe usare il calcolatore di gematria?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">
                    Un calcolatore di gematria è per chiunque sia curioso della struttura numerica nascosta del linguaggio. È perfetto per:
                    <ul>
                        <li>Ricercatori spirituali che esplorano testi sacri come la Bibbia.</li>
                        <li>Scrittori e artisti in cerca di ispirazione creativa e profondità simbolica.</li>
                        <li>Appassionati di storia interessati a metodi interpretativi antichi.</li>
                        <li>Appassionati di numerologia che analizzano nomi, date e concetti.</li>
                        <li>Chiunque ami i puzzle e trovare schemi nascosti nel mondo che li circonda.</li>
                    </ul>
                </div>
            </div>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)">
                    <span>Cos'è il calcolatore di gematria ebraica?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">
                    Un Calcolatore di Gematria Ebraica (o Calcolatore di Gematria Ebraico) è uno strumento basato sull'antica tradizione ebraica di assegnare valori numerici alle 22 lettere dell'alfabeto ebraico. Utilizza principalmente il sistema Mispar Hechrechi (Standard), che è fondamentale per la Cabala e l'interpretazione della Torah. Questo tipo di calcolatore è essenziale per studiare i valori numerici di nomi, concetti e versetti biblici per scoprire connessioni teologiche e mistiche più profonde.
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
            <button class="modal-close" id="exitModalClose" aria-label="Chiudi Modal">
                <i class="fa-solid fa-circle-xmark"></i>
            </button>
            <h2><i class="fa-solid fa-star text-primary"></i> Non Andare Via Ancora!</h2>
            <p>Hai provato i nostri nuovi strumenti?</p>
            <div class="modal-links">
                <a href="https://vpnleaderboard.com/" class="outline-button">
                    <i class="fa-solid fa-shield-halved"></i> VPN Leaderboard
                </a>
                <a href="http://tarotcardgenerator.online/" class="outline-button">
                    <i class="fa-solid fa-wand-magic-sparkles"></i> Lettore di Tarocchi Quotidiano
                </a>
                <a href="https://www.snowdayscalculatorai.com/" class="outline-button">
                    <i class="fa-solid fa-snowflake"></i> Calcolatore Giorni di Neve USA
                </a>
            </div>
            <p style="margin-top: 1rem;">
                <i class="fa-solid fa-face-smile-wink fa-lg text-primary"></i>
                Divertiti e torna presto!
            </p>
        </div>
    </div>

    <script src="/scripts/index.js"></script>

</body>
</html>
