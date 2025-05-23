<?php
/* ------------  de/index.php ------------- */
require __DIR__ . '/../calculate.php';

$inputRaw = $_GET['input'] ?? '';
$results  = $inputRaw !== '' ? gematria($inputRaw) : null;

/* ─── Dynamic SEO ─── */
if ($results) {
    $seoTitle = ucfirst($inputRaw).' Gematrie-Wert '
              .$results['english']['total'].' | Kostenloser Gematrie-Rechner';
    $seoDesc  = 'Berechnen Sie hebräische, englische und einfache Gematrie für „'
              .htmlspecialchars($inputRaw, ENT_QUOTES).'“ in Sekunden. '
              .'Hebräisch='.$results['hebrew']['total']
              .', Englisch='.$results['english']['total']
              .', Einfach='.$results['simple']['total'].'.';
} else {
    $seoTitle = 'Kostenloser Gematrie-Rechner online';
    $seoDesc  = '#1 kostenloser Online-Gematrie-Rechner. Hebräische, englische und einfache Werte sofort berechnen.';
}
?>
<!DOCTYPE html>
<html lang="de" data-theme="light">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title><?= $seoTitle ?></title>
  <meta name="description" content="<?= htmlspecialchars($seoDesc, ENT_QUOTES) ?>">

  <?php
    $base = 'https://gematriacalculators.org';
    $path = ltrim($_SERVER['REQUEST_URI'], '/');
  ?>
  <link rel="alternate" hreflang="en" href="<?= $base ?>/<?= $path ?>">
  <link rel="alternate" hreflang="ru" href="<?= $base ?>/ru/<?= $path ?>">
  <link rel="alternate" hreflang="de" href="<?= $base ?>/de/<?= $path ?>">
  <link rel="alternate" hreflang="x-default" href="<?= $base ?>/<?= $path ?>">

  <link rel="canonical" href="<?= $base ?>/de/<?= $path ?>">

  <link rel="icon" href="/assets/site-icon.png" sizes="32x32">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/styles/index.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>
  <script src="/scripts/index.js" defer></script>
</head>

<body>
<div class="container">

  <!--–––– Recent Searches ticker ––––-->
  <div class="recent-phrases">
    <h4>Letzte Suchanfragen:</h4>

    <!-- ——— Language Switcher ——— -->
    <?php                                    
      $qs = $_SERVER['QUERY_STRING'] ? '?'.$_SERVER['QUERY_STRING'] : '';
      $here = trim(dirname($_SERVER['SCRIPT_NAME']), '/');   // '' | ru | de
      function lang($code,$label,$qs,$here){
          $path = $code==='en' ? '/index.php'.$qs : "/$code/index.php$qs";
          return $code===$here||($code==='en'&&$here==='') ? "<strong>$label</strong>"
                                                          : "<a href=\"$path\">$label</a>";
      }
    ?>
    <nav class="lang-switcher" aria-label="Language switcher">
      <?= lang('en','EN',$qs,$here) ?> |
      <?= lang('ru','RU',$qs,$here) ?> |
      <?= lang('de','DE',$qs,$here) ?>
    </nav>

    <div class="ticker">
      <div class="ticker__list"><!-- JS füllt Einträge --></div>
    </div>
  </div>

  <header class="header">
    <img src="/assets/header-image.webp" id="themeLogo" alt="Gematrie-Logo">
    <button class="theme-toggle" onclick="toggleTheme()">🌓</button>
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
      <a href="/decode-gematria-value.html" class="decode-btn">Gematrie entschlüsseln</a>
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

    <div class="footer-links">
      <a href="/de/index.php">Startseite</a>
      <a href="/blog-collections.html">Blog</a>
      <a href="/about-us.html">Über&nbsp;uns</a>
      <a href="/contact-us.html">Kontakt</a>
      <a href="/terms-conditions.html">AGB</a>
      <a href="/privacy-policy.html">Datenschutz</a>
    </div>

    <div class="copyright">
      © 2022 gematriacalculators.org
    </div>
  </footer>

</div>
</body>
</html>
