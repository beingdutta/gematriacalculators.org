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
    $pageTitle = 'Calcolatore di Gematria Gratuito — Gematrix e Numerologia | ' . $SITE_NAME;
  }

  // DESCRIPTION: STATIC (don't vary per query — stabilizes snippets/CTR)
  $metaDescription = 'Il miglior calcolatore di Gematria gratuito. Ottieni risultati immediati e precisi con il nostro strumento di gematrix e numerologia, che supporta Gematria Ebraica, Inglese e Semplice. Perfetto per analisi biblica e decodifica di valori.';

  // Canonical: point root when empty; deep-link when there's an input
  $canonicalUrl = $BASE_URL . 'it/';
  if (!empty($inputRaw)) {
    // use rawurlencode for cleaner canonical with query. Point to the root URL for queries.
    $canonicalUrl .= '?input=' . rawurlencode($inputRaw);
  }

  // Open Graph / Twitter: keep short and dependable; use static description
  $ogTitle = ($results && !empty($displayInput))
    ? sprintf('%s — Valore di Gematria: %s', $displayInput, (string)$results['english']['total'])
    : 'Calcolatore di Gematria Gratuito — Gematrix e Numerologia';

  // Optional: a share image you host (1200×630 recommended)
  $ogImage = $BASE_URL . 'assets/preview.jpg';

  $loadingPhrases = [
    "Traduzione di parole in numeri...",
    "Invocando i codici della creazione...",
    "Decodificando i modelli numerici nascosti...",
    "Allineando le lettere con i valori divini...",
    "Calcolando la tua sequenza di gematria...",
    "Tracciando la somma vibrazionale del tuo nome...",
    "Rivelando il significato segreto nei numeri..."
  ];
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
    <link rel="alternate" hreflang="vi" href="<?= $BASE_URL . 'vi/' . ltrim($qs, '?') ?>">
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
    <?php require_once __DIR__ . '/../navigation/header.php'; ?>
    
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
                <span title="中文">cinese</span> e
                <span title="Tiếng Việt">vietnamita</span>!
            </p>
        </div>

        <!-- ——— Recent Searches Ticker ——— -->
        <div class="recent-phrases ticker-bar">
            <h4>Ricerche recenti:</h4>

            <div class="ticker">
                <div class="ticker__list">
                <!-- JS will inject .ticker__item cards here -->
                </div>
            </div>
        </div>

        <header class="header">
            <img src="/assets/talisman-header-icon.png" id="themeLogo" alt="logo del sito calcolatore di gematria">
            <h1>Calcolatore di Gematria (Gematrix)</h1>
            <p class="subtitle">(Inserisci una parola, un nome o un numero es. Dio, Bibbia, Ebraico – per calcolare i valori di gematria online)</p>
        </header>

        <main class="calculator">
            <div class="input-group">
                <input
                    id="inputText"
                    type="text"
                    placeholder="Calcola la gematria del mio nome..."
                    value="<?= htmlspecialchars($inputRaw, ENT_QUOTES, 'UTF-8') ?>"
                />
                <button class="secondary" onclick="clearInput()" title="Cancella">✕</button>
            </div>

            <div class="button-container">
                <button class="calculate-btn" onclick="calculate()">Calcola Gematria</button>
                <button class="download-btn" onclick="calculateAndDownload()">Scarica PDF</button>
                <a href="/decode-gematria-value.php" class="decode-btn">Decodifica Gematria</a>
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

                <div class="promotion-box">
                    <div class="promo-icon" style="font-size: 2.5rem; color: var(--primary-color); flex-shrink: 0;">
                        <i class="fa-solid fa-wand-magic-sparkles"></i>
                    </div>
                    <div class="promo-content" style="text-align: center;">
                        <p style="margin: 0; font-weight: 600; font-size: 1.05em;">Espandi la Tua Visione Oltre i Numeri</p>
                        <p style="margin: 6px 0 0 0; font-size: 0.9em;">Mentre la gematria svela il codice numerico nascosto nella tua vita, i tarocchi offrono un percorso diverso verso la saggezza. Combina la logica dei numeri con l'intuizione delle carte per ottenere una prospettiva più completa. Cerca la guida del nostro Lettore di Tarocchi Quotidiano gratuito per completare il tuo viaggio.</p>
                    </div>
                    <a href="https://tarotcardgenerator.online/" target="_blank" class="promo-btn" style="white-space: nowrap; margin-top: 1rem;">
                        Ottieni una Lettura dei Tarocchi Gratuita
                    </a>
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
            <p>Questo <strong>calcolatore di gematria gratuito online</strong> funziona come un potente <strong>calcolatore di nomi di gematria</strong> e supporta le conversioni dalla <strong>gematria inglese a quella ebraica</strong>. Che tu stia cercando un <strong>calcolatore di gematria online</strong> per l'analisi biblica o semplicemente un <strong>calcolatore di gematria semplice</strong> per esplorare significati numerici, questo strumento è progettato per te. Gli utenti cercano spesso "<strong>calcolatore gematria</strong>" o "<strong>gematria calculater</strong>", e il nostro strumento soddisfa questa esigenza.</p>
            <div class="example">Esempio: <strong>Bibbia</strong> = 38 (Ebraico), 180 (Inglese), 30 (Semplice)</div>
        </div>

        <!-- SEO SECTION #2 -->
        <div class="seo-section">
            <p>Il nostro miglior <strong>calcolatore di gematria</strong> (spesso chiamato <strong>gematrix</strong>) è progettato per precisione e semplicità. È perfetto per studiosi, ricercatori spirituali o chiunque sia interessato ai testi sacri. Con il nostro <strong>calcolatore di gematria ebraica</strong>, puoi usare il nostro <strong>decodificatore di gematria</strong> per analizzare nomi spirituali o esplorare connessioni esoteriche. Prova oggi il <strong>calcolatore di gematria semplice gratuito</strong> e immergiti nel mondo dei numeri con fiducia. È un'ottima alternativa a Gematrix.org.</p>
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
                    <a href="/vi/<?= ltrim($qs, '?') ?>">Tiếng Việt</a>
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
                    Un <strong>calcolatore di gematria gratuito</strong> è uno strumento online che calcola automaticamente il valore numerico di una parola o frase. Funziona come un moderno <strong>generatore di gematria</strong> basato su antichi sistemi di numerologia.
                </div>
            </div>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)">
                    <span>Come si usa il calcolatore di gematria online?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">
                    Per usare il nostro miglior <strong>calcolatore di gematria gratuito online</strong>, basta digitare una parola o frase nella casella di input, quindi cliccare su “Calcola Gematria” per generare i suoi valori nei sistemi Ebraico, Inglese e Semplice.
                </div>
            </div>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)">
                    <span>Come funziona il calcolatore di gematria semplice?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">
                    Il nostro <strong>calcolatore di gematria semplice</strong> assegna A=1, B=2, C=3, … Z=26, e poi somma questi valori. Inserisci una parola come “Verità” e ti darà il totale, che puoi confrontare con altre parole che hanno lo stesso valore.
                </div>
            </div>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)">
                    <span>Come si usa il calcolatore di gematria biblica?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">
                    Il nostro <strong>calcolatore di gematria biblica</strong> è progettato per analizzare testi e nomi biblici. Otterrai valori istantanei di <strong>gematria ebraica, inglese e semplice</strong>. Il nostro calcolatore supporta caratteri ebraici, rendendolo il miglior <strong>calcolatore di gematria per la ricerca biblica</strong>. Supportiamo anche i principi del <strong>calcolatore di gematria greca</strong>.
                </div>
            </div>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)">
                    <span>Come funziona il motore di ricerca di gematria?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">
                    Il nostro <strong>motore di ricerca di gematria</strong> e <strong>decodificatore di gematria</strong> ti permettono di trovare parole con valori numerici specifici. Puoi cercare usando i sistemi di <strong>gematria ebraica, inglese o semplice</strong>.
                </div>
            </div>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)">
                    <span>Posso calcolare frasi con spazi?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">
                    Sì! Questo <strong>calcolatore di nomi di gematria</strong> ignora automaticamente spazi e caratteri speciali. Supportiamo il <strong>calcolatore di nomi e significati di gematria</strong> per tutti gli utenti gratuitamente.
                </div>
            </div>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)">
                    <span>Cos'è il calcolatore di gematria inglese?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">
                    Un <strong>Calcolatore di Gematria Inglese</strong> assegna valori numerici alle lettere dell'alfabeto inglese. Il nostro <strong>calcolatore di gematria inglese</strong> utilizza varie cifrature come la Gematria Semplice (A=1, B=2) per rivelare strati nascosti di significato.
                </div>
            </div>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)">
                    <span>Chi dovrebbe usare il calcolatore di gematria?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">
                    Un <strong>calcolatore di numerologia e gematria</strong> è per chiunque sia curioso della struttura numerica nascosta del linguaggio. È perfetto per:
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
                    Un <strong>Calcolatore di Gematria Ebraica</strong> (o <strong>Calcolatore di Gematria Ebraico</strong>) si basa sulla tradizione ebraica di assegnare valori numerici alle lettere ebraiche. Questo tipo di <strong>calcolatore di gematria ebraica</strong> è essenziale per studiare i valori numerici di nomi e concetti biblici.
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

    <script>
      window.GematriaLang = {
        loadingPhrases: <?= json_encode($loadingPhrases) ?>
      };
    </script>
    <script src="/scripts/index.js"></script>

</body>
</html>
