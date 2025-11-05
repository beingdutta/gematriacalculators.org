<?php
  /* ------------  de/index.php ------------- */
  require __DIR__ . '/../calculate.php';
  require_once __DIR__ . '/../helpers.php';

  $inputRaw = $_GET['input'] ?? '';
  $results  = $inputRaw !== '' ? gematria($inputRaw) : null;

  // SEO: make description STATIC, keep title concise (optionally dynamic)
  $SITE_NAME        = 'Gematrie-Rechner';
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
      '%s — Gematrie-Wert: %s | %s',
      ucfirst($displayInput),
      (string)$results['english']['total'],
      $SITE_NAME
    );
  } else {
      $pageTitle = 'Kostenloser Gematrie-Rechner — Hebräisch, Englisch & Einfach | ' . $SITE_NAME;
  }

  // DESCRIPTION: STATIC (don’t vary per query — stabilizes snippets/CTR)
  $metaDescription = 'Kostenloser Online-Gematrie-Rechner für hebräische, englische und einfache Systeme. Berechnen Sie sofort Gematrie-Werte und Bedeutungen für jedes Wort oder jede Phrase.';

  // Canonical: point root when empty; deep-link when there’s an input
  $canonicalUrl = $BASE_URL . 'de/';
  if (!empty($inputRaw)) {
    // use rawurlencode for cleaner canonical with query. Point to index.php for queries.
    $canonicalUrl = $BASE_URL . 'de/index.php?input=' . rawurlencode($inputRaw);
  }
?>
<!DOCTYPE html>
<html lang="de" data-theme="light">
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

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title><?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8'); ?></title>
    <meta name="description" content="<?= htmlspecialchars($metaDescription, ENT_QUOTES, 'UTF-8'); ?>">
    
    <!-- Additional SEO meta tags for multilingual -->
    <meta property="og:locale" content="de_DE" />
    <meta property="og:locale:alternate" content="en_US" />
    <meta property="og:locale:alternate" content="ru_RU" />
    <meta property="og:locale:alternate" content="es_ES" />
    <meta property="og:locale:alternate" content="it_IT" />
    <meta property="og:locale:alternate" content="iw_IL" />
    <meta property="og:locale:alternate" content="pl_PL" />
    <meta property="og:locale:alternate" content="pt_BR" />
    <meta property="og:locale:alternate" content="zh_CN" />

    <!-- Hreflang links -->
    <?php $qs = !empty($inputRaw) ? '?input=' . rawurlencode($inputRaw) : ''; ?>
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

    <!-- Schema.org markup -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "WebApplication",
      "name": "Gematrie-Rechner",
      "url": "<?= htmlspecialchars($canonicalUrl, ENT_QUOTES, 'UTF-8'); ?>",
      "description": "Kostenloser Online-Rechner für hebräische, englische und einfache Gematrie-Werte.",
      "applicationCategory": "Calculator",
      "operatingSystem": "Any",
      "inLanguage": "de"
    }
    </script>

    <link rel="canonical" href="<?= htmlspecialchars($canonicalUrl, ENT_QUOTES, 'UTF-8'); ?>">

    <link rel="icon" href="/assets/talisman-site-icon.png" sizes="32x32">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/styles/index.css">
    <link rel="stylesheet" href="/styles/mobile.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>
    <script src="/scripts/index.js" defer></script>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4198904821948931" crossorigin="anonymous"></script>
  </head>

  <body>
    <nav class="header-nav">
        <a href="/de/index.php">Startseite</a>
        <a href="/more-tools.php">Mehr Tools</a>
        <a href="/blog-collections.php">Blog</a>
        <a href="/about-us.php">Über uns</a>
        <a href="/contact-us.php">Kontakt</a>
        <a href="/terms-conditions.php">AGB</a>
        <a href="/privacy-policy.php">Datenschutz</a>
        <button class="theme-toggle" onclick="toggleTheme()" aria-label="Toggle theme">
          <svg class="icon-sun" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="5"></circle><line x1="12" y1="1" x2="12" y2="3"></line><line x1="12" y1="21" x2="12" y2="23"></line><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line><line x1="1" y1="12" x2="3" y2="12"></line><line x1="21" y1="12" x2="23" y2="12"></line><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line></svg>
          <svg class="icon-moon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path></svg>
        </button>
    </nav>

    <div class="container">

      <!-- Language Support Info -->
      <div class="language-support-info" style="background: #f0f8ff; padding: 12px; margin: 2px 0 10px 0; border-radius: 8px; text-align: center; border: 1px solid #cce5ff;">
          <p style="margin: 0; color: #004085; font-size: 13px;">
              🌍 Danke für Ihr Vertrauen! Wir unterstützen jetzt mehrere Sprachen: 
              <span title="English">Englisch</span>, 
              <span title="Русский">Russisch</span>, 
              <strong>Deutsch</strong>, 
              <span title="Español">Spanisch</span>, 
              <span title="Português">Portugiesisch</span>, 
              <span title="Italiano">Italienisch</span>, 
              <span title="עברית">Hebräisch</span>, 
              <span title="Polski">Polnisch</span> und 
              <span title="中文">Chinesisch</span>!
          </p>
      </div>

      <!--–––– Recent Searches ticker ––––-->
      <div class="recent-phrases ticker-bar">
        <h4>Letzte Suchanfragen:</h4>

        <!-- ——— Language Switcher ——— -->
        <?php                                    
          $qs = $_SERVER['QUERY_STRING'] ? '?'.$_SERVER['QUERY_STRING'] : '';
          $here = trim(dirname($_SERVER['SCRIPT_NAME']), '/');
        ?>
        <nav class="lang-switcher" aria-label="Sprachwechsler">
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
          <div class="ticker__list"><!-- JS füllt Einträge --></div>
        </div>
      </div>

      <header class="header">
        <img src="/assets/talisman-header-icon.png" id="themeLogo" alt="Gematrie-Logo">
        <h1>Kostenloser Gematrie-Rechner online</h1>
        <p class="subtitle">(Geben Sie ein Wort oder eine Zahl ein, z.&nbsp;B. Gott, Bibel, Hebräisch, Heilig – um Werte zu berechnen)</p>
      </header>

      <main class="calculator">
        <div class="input-group">
          <input id="inputText"
                type="text"
                placeholder="Text eingeben …"
                value="<?= htmlspecialchars($inputRaw, ENT_QUOTES) ?>">
          <button class="secondary" onclick="clearInput()" title="Löschen">✕</button>
        </div>

        <div class="button-container">
          <button class="calculate-btn" onclick="calculate()">Berechnen</button>
          <button class="download-btn"  onclick="calculateAndDownload()">PDF herunterladen</button>
          <a href="/de/decode-gematria-value/" class="decode-btn">Gematrie entschlüsseln</a>
        </div>

        <div class="loading-container" id="loading" style="display:none"><div class="spinner"></div></div>

        <div class="result" id="result" style="<?= $results ? 'display:block;' : 'display:none;' ?>">
          <!-- Hebrew -->
          <div class="result-card">
            <button class="copy-btn" onclick="copyValue('hebrewValue','hebrewCopyNotification')">📋</button>
            <div class="copy-notification" id="hebrewCopyNotification">Kopiert!</div>
            <h3>Hebräische Gematrie: <span id="hebrewValue"><?= $results['hebrew']['total'] ?? 0 ?></span></h3>
            <p id="hebrewBreakdown">
              <?php if ($results): ?>Berechnung: <?= implode(' + ', $results['hebrew']['breakdown']) ?><?php endif ?>
            </p>
          </div>
          <!-- English -->
          <div class="result-card">
            <button class="copy-btn" onclick="copyValue('englishValue','englishCopyNotification')">📋</button>
            <div class="copy-notification" id="englishCopyNotification">Kopiert!</div>
            <h3>Englische Gematrie: <span id="englishValue"><?= $results['english']['total'] ?? 0 ?></span></h3>
            <p id="englishBreakdown">
              <?php if ($results): ?>Berechnung: (<?= implode(' + ', $results['simple']['breakdown']) ?>) × 6<?php endif ?>
            </p>
          </div>
          <!-- Simple -->
          <div class="result-card">
            <button class="copy-btn" onclick="copyValue('simpleValue','simpleCopyNotification')">📋</button>
            <div class="copy-notification" id="simpleCopyNotification">Kopiert!</div>
            <h3>Einfache Gematrie: <span id="simpleValue"><?= $results['simple']['total'] ?? 0 ?></span></h3>
            <p id="simpleBreakdown">
              <?php if ($results): ?>Berechnung: <?= implode(' + ', $results['simple']['breakdown']) ?><?php endif ?>
            </p>
          </div>

          <div class="feedback">
            <p>Wie genau sind diese Ergebnisse?</p>
            <div class="feedback-buttons">
              <button onclick="sendFeedback('😞')">😞</button>
              <button onclick="sendFeedback('😐')">😐</button>
              <button onclick="sendFeedback('😊')">😊</button>
            </div>
            <div class="feedback-message" id="feedbackMessage"></div>
          </div>
        </div>
      </main>

      <p class="note" style="color:var(--error);font-weight:400;margin-top:0.75rem;text-align:center">
        Fragen oder Feedback an <a href="mailto:admins@gematriacalculators.org" style="color:var(--error);text-decoration:underline;">admins@gematriacalculators.org</a>
      </p>

      <!--–––– SEO SECTION #1 ––––-->
      <div class="seo-section">
        <h4>Entdecken Sie verborgene Zahlenbedeutungen</h4>
        <p>Dieser Gematrie-Rechner dient Forschern, Bibel-Interessierten und Esoterikern gleichermaßen. Berechnen Sie Zahlenwerte für Namen, Wörter oder ganze Passagen schnell und präzise.</p>
        <div class="example">Beispiel: <strong>Bibel</strong> = 38 (hebräisch), 180 (englisch), 30 (einfach)</div>
      </div>

      <div class="seo-section" style="color:green;">
        <p>Internationale Nutzer suchen nach Begriffen wie <em>гематрия калькулятор</em> (Russisch), <em>gematria rechner</em> (Deutsch) und <em>gematria calculadora</em> (Spanisch). Unser Tool ist für alle Sprachen leicht verständlich.</p>
      </div>

      <div class="seo-section">
        <p>Unser kostenloser Gematrie-Rechner vereint Genauigkeit, Geschwindigkeit und Benutzerfreundlichkeit. Entschlüsseln Sie biblische Texte, analysieren Sie spirituelle Namen oder erforschen Sie verborgene Zusammenhänge – alles an einem Ort.</p>
      </div>

      <hr class="divider"><br>

      <div class="recent-phrases">
        <h4>Aktuell berechnete Wörter und Phrasen:</h4>
        <a href="#">the bible</a> |
        <a href="#">elohim frequency 432</a> |
        <a href="#">sacred light of yahweh</a> |
        <a href="#">the saturn</a> |
        <a href="#">truth hidden in plain sight</a> |
        <a href="#">metatron speaks in numbers</a> |
        <a href="#">peace over chaos always</a>
      </div>

      <!--–––– FAQ ––––-->
      <footer class="footer">
        <div class="faq-item">
          <div class="faq-question" onclick="toggleFAQ(this)">
            <span>Was ist Gematrie?</span><svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
          </div>
          <div class="faq-answer">
            Gematrie ist ein alphanumerischer Code, bei dem Buchstaben eines Wortes in Zahlen umgewandelt werden. Häufig genutzt in jüdischer Mystik und Bibelauslegung.
          </div>
        </div>

        <div class="faq-item">
          <div class="faq-question" onclick="toggleFAQ(this)">
            <span>Was ist ein Gematrie-Rechner?</span><svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
          </div>
          <div class="faq-answer">
            Ein Online-Tool, das den Zahlenwert eines Wortes oder einer Phrase automatisch nach einer gewählten Gematrie-Methode berechnet.
          </div>
        </div>

        <div class="faq-item">
          <div class="faq-question" onclick="toggleFAQ(this)">
            <span>Wie nutze ich den Rechner?</span><svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
          </div>
          <div class="faq-answer">
            Geben Sie ein Wort, eine Phrase oder einen Namen ein und klicken Sie „Berechnen“. Die hebräischen, englischen und einfachen Werte erscheinen sofort.
          </div>
        </div>

        <div class="faq-item">
          <div class="faq-question" onclick="toggleFAQ(this)">
            <span>Wie funktioniert die einfache Gematrie?</span><svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
          </div>
          <div class="faq-answer">
            Die einfache Methode ordnet A=1, B=2 … Z=26 zu. Der Rechner summiert alle Buchstabenwerte zu einem Gesamtergebnis.
          </div>
        </div>

        <div class="faq-item">
          <div class="faq-question" onclick="toggleFAQ(this)">
            <span>Kann ich Phrasen mit Leerzeichen berechnen?</span><svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
          </div>
          <div class="faq-answer">
            Ja. Leerzeichen und Sonderzeichen werden ignoriert – es zählen nur die Buchstaben.
          </div>
        </div>

        <div class="faq-item">
          <div class="faq-question" onclick="toggleFAQ(this)">
            <span>Was ist der englische Gematrie-Rechner?</span><svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
          </div>
          <div class="faq-answer">
            Ein <strong>englischer Gematrie-Rechner</strong> ist ein Werkzeug, das den Buchstaben des englischen Alphabets numerische Werte zuweist. Im Gegensatz zum Hebräischen hat das Englische kein einheitliches altes System, daher verwenden Rechner verschiedene Chiffren wie die Einfache Gematrie (A=1, B=2), die umgekehrte ordinale Gematrie (A=26, B=25) und die Reduktion. Dies ermöglicht es Ihnen, die numerischen Muster und symbolischen Verbindungen zwischen englischen Wörtern, Namen und Phrasen zu erforschen und verborgene Bedeutungsebenen aufzudecken.
          </div>
        </div>

        <div class="faq-item">
          <div class="faq-question" onclick="toggleFAQ(this)">
            <span>Wer sollte den Gematrie-Rechner verwenden?</span><svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
          </div>
          <div class="faq-answer">
            Ein <strong>Gematrie-Rechner</strong> ist für jeden gedacht, der neugierig auf die verborgene numerische Struktur der Sprache ist. Er ist perfekt für:
            <ul>
                <li><strong>Spirituell Suchende</strong>, die heilige Texte wie die Bibel erforschen.</li>
                <li><strong>Schriftsteller und Künstler</strong>, die nach kreativer Inspiration und symbolischer Tiefe suchen.</li>
                <li><strong>Geschichtsinteressierte</strong>, die sich für alte Interpretationsmethoden interessieren.</li>
                <li><strong>Numerologie-Enthusiasten</strong>, die Namen, Daten und Konzepte analysieren.</li>
                <li><strong>Jeden, der Rätsel liebt</strong> und gerne verborgene Muster in der Welt um sich herum findet.</li>
            </ul>
          </div>
        </div>

        <div class="faq-item">
          <div class="faq-question" onclick="toggleFAQ(this)">
            <span>Was ist der jüdische Gematrie-Rechner?</span><svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
          </div>
          <div class="faq-answer">
            Ein <strong>jüdischer Gematrie-Rechner</strong> (oder hebräischer Gematrie-Rechner) ist ein Werkzeug, das auf der alten jüdischen Tradition basiert, den 22 Buchstaben des hebräischen Alphabets numerische Werte zuzuweisen. Er verwendet hauptsächlich das <em>Mispar Hechrechi</em> (Standard)-System, das für die Kabbala und die Interpretation der Tora von grundlegender Bedeutung ist. Diese Art von Rechner ist unerlässlich für das Studium der numerischen Werte biblischer Namen, Konzepte und Verse, um tiefere theologische und mystische Verbindungen aufzudecken.
          </div>
        </div>

        <div class="footer-links">
          <!-- Footer links are now in the header nav -->
          <!-- <a href="/de/index.php">Startseite</a>
          <a href="/blog-collections.html">Blog</a>
          <a href="/about-us.html">Über&nbsp;uns</a>
          <a href="/contact-us.html">Kontakt</a>
          <a href="/terms-conditions.html">AGB</a>
          <a href="/privacy-policy.html">Datenschutz</a> -->
        </div>

        <div class="copyright">
          © <?= date('Y') ?> gematriacalculators.org
        </div>
      </footer>

    </div>
  </body>
</html>
