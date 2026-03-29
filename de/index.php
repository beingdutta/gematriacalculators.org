<?php
  // de/index.php - German version
  require_once __DIR__ . '/../calculate.php';
  require_once __DIR__ . '/../helpers.php';

  $inputRaw = $_GET['input'] ?? '';
  $results  = $inputRaw !== '' ? gematria($inputRaw) : null;

  $SITE_NAME = 'Gematria Rechner';
  $BASE_URL = BASE_URL;

  $displayInput = trim($inputRaw);
  if ($displayInput !== '') {
    $displayInput = mb_strimwidth($displayInput, 0, 60, '…', 'UTF-8');
  }

  if ($results && isset($results['english']['total'])) {
    $pageTitle = sprintf(
      '%s — Gematria-Wert: %s | %s',
      ucfirst($displayInput),
      (string)$results['english']['total'],
      $SITE_NAME
    );
  } else {
    $pageTitle = 'Kostenloser Gematria-Rechner — Gematrix & Numerologie | ' . $SITE_NAME;
  }

  $metaDescription = 'Der beste kostenlose Gematria-Rechner. Erhalten Sie sofortige und genaue Ergebnisse mit unserem Gematrix- und Numerologie-Tool, das englische, hebräische und einfache Gematria unterstützt. Perfekt für biblische Analysen und die Entschlüsselung von Werten.';

  $canonicalUrl = $BASE_URL . 'de/';
  if (!empty($inputRaw)) {
    $canonicalUrl .= '?input=' . rawurlencode($inputRaw);
  }

  $ogTitle = ($results && !empty($displayInput))
    ? sprintf('%s — Gematria-Wert: %s', $displayInput, (string)$results['english']['total'])
    : 'Kostenloser Gematria-Rechner — Gematrix & Numerologie';

  $ogImage = $BASE_URL . 'assets/preview.jpg';

  $loadingPhrases = [
    "Worte in Zahlen übersetzen...",
    "Die Codes der Schöpfung beschwören...",
    "Die verborgenen numerischen Muster entschlüsseln...",
    "Buchstaben mit göttlichen Werten in Einklang bringen...",
    "Deine Gematria-Sequenz berechnen...",
    "Die Schwingungssumme deines Namens nachzeichnen...",
    "Die geheime Bedeutung in Zahlen enthüllen..."
  ];
?>

<!DOCTYPE html>
<html lang="de" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8'); ?></title>
    <meta name="description" content="<?= htmlspecialchars($metaDescription, ENT_QUOTES, 'UTF-8'); ?>">
    <link rel="canonical" href="<?= htmlspecialchars($canonicalUrl, ENT_QUOTES, 'UTF-8'); ?>">
    <meta name="keywords" content="gematria rechner, hebräische gematria, englische gematria, einfache gematria">
    <meta property="og:title" content="<?= htmlspecialchars($ogTitle, ENT_QUOTES, 'UTF-8'); ?>">
    <meta property="og:description" content="<?= htmlspecialchars($metaDescription, ENT_QUOTES, 'UTF-8'); ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= htmlspecialchars($canonicalUrl, ENT_QUOTES, 'UTF-8'); ?>">
    <meta property="og:image" content="<?= htmlspecialchars($ogImage, ENT_QUOTES, 'UTF-8'); ?>">

    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/navigation/head-tracking.php'; ?>

     
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "WebApplication",
      "name": "Gematria Rechner",
      "url": "<?= htmlspecialchars($BASE_URL . 'de/', ENT_QUOTES, 'UTF-8'); ?>",
      "description": "Kostenloser Online-Rechner für hebräische, englische und einfache Gematria-Werte.",
      "applicationCategory": "Calculator",
      "operatingSystem": "Any",
      "inLanguage": "de"
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
    <?php require_once __DIR__ . '/../navigation/header.php'; ?>
    <div class="container">
        <div class="recent-phrases ticker-bar">
            <h4>Letzte Suchen:</h4>
            <div class="ticker"><div class="ticker__list"></div></div>
        </div>
        <header class="header">
            <img src="/assets/talisman-header-icon.png" id="themeLogo" alt="Gematria-Rechner-Logo">
            <h1>Gematria-Rechner (Gematrix)</h1>
            <p class="subtitle">(Geben Sie ein Wort, einen Namen oder eine Zahl ein, z.B. Gott, Bibel, Hebräisch – um Gematria-Werte online zu berechnen)</p>
        </header>
        <main class="calculator">
            <div class="input-group">
                <input id="inputText" type="text" placeholder="Gematria meines Namens berechnen..." value="<?= htmlspecialchars($inputRaw, ENT_QUOTES, 'UTF-8') ?>" />
                <button class="secondary" onclick="clearInput()" title="Löschen">✕</button>
            </div>
            <div class="button-container">
                <button class="calculate-btn" onclick="calculate()">Gematria berechnen</button>
                <button class="download-btn" onclick="calculateAndDownload()">PDF Herunterladen</button>
                <a href="/decode-gematria-value.php" class="decode-btn">Gematria Entschlüsseln</a>
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
            <h2>Entdecken Sie weitere Tools für die tägliche Führung</h2>
            <div class="tool-grid">
                <?php
                    $tools = [
                        ['title' => 'Einfacher Vastu-Score-Rechner', 'desc' => 'Erhalten Sie eine schnelle Vastu-Konformitätsbewertung für Ihr Zuhause.', 'icon' => '<i class="fa-solid fa-house"></i>', 'url' => '/more-tools/simple-vastu-score-calculator.php'],
                        ['title' => 'Kua-Zahl-Rechner', 'desc' => 'Finden Sie Ihre Feng-Shui-Glücksrichtungen für den Erfolg.', 'icon' => '<i class="fa-solid fa-compass"></i>', 'url' => '/more-tools/kua-number-calculator.php'],
                        ['title' => 'Engelszahlen-Decoder', 'desc' => 'Entdecken Sie Botschaften des Universums in Zahlen.', 'icon' => '<i class="fa-solid fa-wand-magic-sparkles"></i>', 'url' => '/more-tools/angel-number-decoder.php'],
                        ['title' => 'Lebensweg-Zahl-Rechner', 'desc' => 'Entdecken Sie Ihr Kerndestin aus Ihrem Geburtsdatum.', 'icon' => '<i class="fa-solid fa-route"></i>', 'url' => '/more-tools/life-path-number-calculator.php'],
                        ['title' => 'Loshu-Gitter-Rechner', 'desc' => 'Erstellen Sie Ihr numerologisches Energiegitter.', 'icon' => '<i class="fa-solid fa-table-cells"></i>', 'url' => '/more-tools/loshu-grid.php'],
                        ['title' => 'Namensnumerologie-Rechner', 'desc' => 'Berechnen Sie Ihre Schicksals- und Seelenwunsch-Zahlen.', 'icon' => '<i class="fa-solid fa-signature"></i>', 'url' => '/more-tools/name-numerology-calculator.php'],
                    ];

                    foreach ($tools as $tool) {
                        echo '
                        <div class="tool-card">
                            <div class="tool-icon">'.$tool['icon'].'</div>
                            <h3>'.$tool['title'].'</h3>
                            <p>'.$tool['desc'].'</p>
                            <a href="'.$tool['url'].'" class="calculate-btn">Werkzeug öffnen</a>
                        </div>';
                    }
                ?>
            </div>
        </section>
        <?php
        $moreToolsHtml = ob_get_clean();
        ?>

        <div class="result" id="result" style="<?= $results ? 'display:block;' : 'display:none;' ?>">
            <h2 id="resultHeader" style="text-align: center; margin-bottom: 2rem; font-size: 1.2rem; font-weight: 600; background-color: var(--background-alt); padding: 0.75rem 1rem; border-radius: var(--radius); border: 1px solid var(--border-color); box-shadow: 0 2px 4px rgba(0,0,0,0.05);">Gematria-Ergebnis für: <span style="color: var(--primary-color);"><?= htmlspecialchars($displayInput) ?></span></h2>
            <div class="result-card">
                <button class="copy-btn" onclick="copyValue('hebrewValue','hebrewCopyNotification')"><i class="fa-regular fa-copy"></i></button>
                <div class="copy-notification" id="hebrewCopyNotification">Kopiert!</div>
                <h3>Hebräische Gematria: <span id="hebrewValue"><?= $results['hebrew']['total'] ?? 0 ?></span></h3>
                <p id="hebrewBreakdown"><?php if($results): ?>Berechnung: <?= implode(' + ', $results['hebrew']['breakdown']) ?><?php endif ?></p>
            </div>
            <div class="result-card">
                <button class="copy-btn" onclick="copyValue('englishValue','englishCopyNotification')"><i class="fa-regular fa-copy"></i></button>
                <div class="copy-notification" id="englishCopyNotification">Kopiert!</div>
                <h3>Englische Gematria: <span id="englishValue"><?= $results['english']['total'] ?? 0 ?></span></h3>
                <p id="englishBreakdown"><?php if($results): ?>Berechnung: (<?= implode(' + ', $results['simple']['breakdown']) ?>) × 6<?php endif ?></p>
            </div>
            <div class="result-card">
                <button class="copy-btn" onclick="copyValue('simpleValue','simpleCopyNotification')"><i class="fa-regular fa-copy"></i></button>
                <div class="copy-notification" id="simpleCopyNotification">Kopiert!</div>
                <h3>Einfache Gematria: <span id="simpleValue"><?= $results['simple']['total'] ?? 0 ?></span></h3>
                <p id="simpleBreakdown"><?php if($results): ?>Berechnung: <?= implode(' + ', $results['simple']['breakdown']) ?><?php endif ?></p>
            </div>
            <div class="button-container" style="margin-top: 2rem; justify-content: center; gap: 15px;">
                <button class="download-btn" onclick="calculateAndDownload()">PDF Herunterladen</button>
                <button class="calculate-btn" onclick="calculateAgain()">Erneut berechnen</button>
            </div>

            <!-- More Tools (Result View) -->
            <div id="more-tools-result" style="<?= $results ? 'display:block;' : 'display:none;' ?>">
                <?= $moreToolsHtml ?>
            </div>

            <div class="feedback">
                <p>War dieser Rechner hilfreich?</p>
                <div class="feedback-buttons">
                <button onclick="sendFeedback('😞')">😞</button>
                <button onclick="sendFeedback('😐')">😐</button>
                <button onclick="sendFeedback('😊')">😊</button>
                </div>
                <div class="feedback-message" id="feedbackMessage"></div>
            </div>
        </div>

        <p class="note" style="color: var(--error); font-weight: 400; margin-top: 0.75rem; text-align: center;">
            Für Feedback, Vorschläge oder Verbesserungen zu diesem Tool senden Sie uns bitte eine E-Mail an <a href="mailto:admins@gematriacalculators.org" style="color: var(--error); text-decoration: underline;">admins@gematriacalculators.org</a>.
        </p>

        <!-- SEO SECTION #1 -->
        <div class="seo-section">
            <h4>Entdecken Sie verborgene numerische Bedeutungen</h4>
            <p>Dieser kostenlose Online-Gematria-Rechner fungiert als leistungsstarker Gematria-Namensrechner und unterstützt Konvertierungen von englischer zu hebräischer Gematria. Ob Sie einen Online-Gematria-Rechner für biblische Analysen oder nur einen einfachen Gematria-Rechner zur Erkundung von Zahlenbedeutungen suchen, dieses Tool ist für Sie konzipiert. Benutzer suchen oft nach Begriffen wie "calculator gematria" oder "gematria calculater" – und dieses Tool bietet die Funktionalität, die sie suchen.</p>
            <div class="example">Beispiel: Bibel = 38 (Hebräisch), 180 (Englisch), 30 (Einfach)</div>
        </div>

        <!-- More Tools (Original View) -->
        <div id="more-tools-original" style="<?= $results ? 'display:none;' : 'display:block;' ?>">
            <?= $moreToolsHtml ?>
        </div>

        <!-- SEO SECTION #2 -->
        <div class="seo-section">
            <p>Unser bester Gematria-Rechner (oft als gematrix oder gmetrix calculator bezeichnet) ist auf Genauigkeit und Einfachheit ausgelegt. Er ist perfekt für Gelehrte, spirituell Suchende oder jeden, der sich für die heiligen Texte interessiert. Mit unserem besten hebräischen Gematria-Rechner können Sie unseren Gematria-Decoder verwenden, um spirituelle Namen zu analysieren oder esoterische Verbindungen zu erforschen. Probieren Sie noch heute den kostenlosen einfachen Gematria-Rechner aus und tauchen Sie mit Zuversicht in die Welt der Zahlen ein. Es ist eine großartige Alternative zu Gematrix.org.</p>
        </div>

        <!-- GLOBAL FEEDBACK BANNER -->
        <div class="global-feedback-message" id="globalFeedback"></div>

        <!-- Language Popup -->
        <?php
            $qs = !empty($inputRaw) ? '?input=' . rawurlencode($inputRaw) : '';
        ?>
        <div class="lang-popup">
            <div class="lang-popup-content">
                <button class="lang-popup-close" onclick="closeLangPopup()">&times;</button>
                <h4>Sprache wählen</h4>
                <div class="lang-grid">
                    <a href="<?= $BASE_URL . ltrim($qs, '?') ?>">English</a>
                    <a href="<?= $BASE_URL . 'ru/' . ltrim($qs, '?') ?>">Русский</a>
                    <a href="<?= $BASE_URL . 'de/' . ltrim($qs, '?') ?>">Deutsch</a>
                    <a href="<?= $BASE_URL . 'es/' . ltrim($qs, '?') ?>">Español</a>
                    <a href="<?= $BASE_URL . 'pt/' . ltrim($qs, '?') ?>">Português</a>
                    <a href="<?= $BASE_URL . 'it/' . ltrim($qs, '?') ?>">Italiano</a>
                    <a href="<?= $BASE_URL . 'iw/' . ltrim($qs, '?') ?>">עברית</a>
                    <a href="<?= $BASE_URL . 'pl/' . ltrim($qs, '?') ?>">Polski</a>
                    <a href="<?= $BASE_URL . 'zh/' . ltrim($qs, '?') ?>">中文</a>
                    <a href="<?= $BASE_URL . 'vi/' . ltrim($qs, '?') ?>">Tiếng Việt</a>
                </div>
            </div>
        </div>
        <footer class="footer">
            <h2 class="faq-heading">常见问题解答</h2>
            <h2 class="faq-heading">Häufig gestellte Fragen</h2>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)"><span>Was ist Gematria?</span><svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg></div>
                <div class="faq-answer">Gematria ist ein alphanumerischer Code, der einem Namen, Wort oder Satz basierend auf seinen Buchstaben einen numerischen Wert zuweist. Es wird häufig in der jüdischen Mystik und Bibelauslegung verwendet.</div>
            </div>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)"><span>Was ist ein Gematria-Rechner?</span><svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg></div>
                <div class="faq-answer">Ein <strong>kostenloser Gematria-Rechner</strong> ist ein Online-Tool, das automatisch den numerischen Wert eines Wortes oder Satzes berechnet. Er funktioniert wie ein moderner <strong>Gematria-Generator</strong>, der auf alten numerologischen Systemen basiert.</div>
            </div>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)"><span>Wie benutzt man den Online-Gematria-Rechner?</span><svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg></div>
                <div class="faq-answer">Um unseren besten <strong>kostenlosen Online-Gematria-Rechner</strong> zu verwenden, geben Sie einfach ein Wort oder einen Satz in das Eingabefeld ein und klicken Sie dann auf „Gematria berechnen“, um seine numerischen Werte in hebräischen, englischen und einfachen Systemen zu generieren.</div>
            </div>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)"><span>Wie versteht man den einfachen Gematria-Rechner?</span><svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg></div>
                <div class="faq-answer">Unser <strong>einfacher Gematria-Rechner</strong> weist A=1, B=2, C=3, … Z=26 zu und summiert dann diese Werte. Geben Sie ein Wort wie „Wahrheit“ ein, und es gibt die Gesamtsumme aus, die Sie mit anderen Wörtern vergleichen können, die denselben Wert haben.</div>
            </div>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)"><span>Wie benutze ich den Bibel-Gematria-Rechner?</span><svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg></div>
                <div class="faq-answer">Unser <strong>Bibel-Gematria-Rechner</strong> ist für die Analyse biblischer Texte und Namen konzipiert. Sie erhalten sofortige <strong>hebräische, englische und einfache Gematria</strong>-Werte. Unser Rechner unterstützt hebräische Zeichen und ist somit der beste <strong>Gematria-Rechner für die Bibelforschung</strong>. Wir unterstützen auch die Prinzipien des <strong>griechischen Gematria-Rechners</strong>.</div>
            </div>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)"><span>Wie funktioniert die Gematria-Suchmaschine?</span><svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg></div>
                <div class="faq-answer">Unsere <strong>Gematria-Suchmaschine</strong> und unser <strong>Gematria-Decoder</strong> ermöglichen es Ihnen, Wörter mit bestimmten numerischen Werten zu finden. Sie können mit den Systemen <strong>hebräische, englische oder einfache Gematria</strong> suchen.</div>
            </div>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)"><span>Kann ich Phrasen mit Leerzeichen berechnen?</span><svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg></div>
                <div class="faq-answer">Ja! Dieser <strong>Gematria-Namensrechner</strong> ignoriert automatisch Leerzeichen und Sonderzeichen. Wir unterstützen den <strong>Gematria-Rechner für Namen und Bedeutungen</strong> für alle Benutzer kostenlos.</div>
            </div>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)"><span>Was ist der englische Gematria-Rechner?</span><svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg></div>
                <div class="faq-answer">Ein <strong>englischer Gematria-Rechner</strong> weist den Buchstaben des englischen Alphabets numerische Werte zu. Unser <strong>englischer Gematria-Rechner</strong> verwendet verschiedene Chiffren wie die einfache Gematria (A=1, B=2), um verborgene Bedeutungsebenen aufzudecken.</div>
            </div>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)"><span>Wer sollte den Gematria-Rechner verwenden?</span><svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg></div>
                <div class="faq-answer">
                    Ein <strong>Numerologie- und Gematria-Rechner</strong> ist für jeden, der neugierig auf die verborgene numerische Struktur der Sprache ist. Er ist perfekt für:
                    <ul>
                        <li>Spirituell Suchende, die heilige Texte wie die Bibel erforschen.</li>
                        <li>Schriftsteller und Künstler, die nach kreativer Inspiration und symbolischer Tiefe suchen.</li>
                        <li>Geschichtsinteressierte, die sich für alte Interpretationsmethoden interessieren.</li>
                        <li>Numerologie-Enthusiasten, die Namen, Daten und Konzepte analysieren.</li>
                        <li>Jeder, der Rätsel liebt und verborgene Muster in der Welt um sich herum findet.</li>
                    </ul>
                </div>
            </div>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)"><span>Was ist der jüdische Gematria-Rechner?</span><svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg></div>
                <div class="faq-answer">Ein <strong>jüdischer Gematria-Rechner</strong> (oder <strong>hebräischer Gematria-Rechner</strong>) basiert auf der jüdischen Tradition, den hebräischen Buchstaben numerische Werte zuzuweisen. Diese Art von <strong>hebräischem Gematria-Rechner</strong> ist unerlässlich für das Studium der numerischen Werte biblischer Namen und Konzepte.</div>
            </div>
            <div class="copyright">© <?= date('Y') ?> gematriacalculators.org</div>
        </footer>
    </div>
    <script>
      window.GematriaLang = {
        loadingPhrases: <?= json_encode($loadingPhrases) ?>,
        resultHeaderPrefix: "Gematria-Ergebnis für: "
      };
    </script>
    <script src="/scripts/index.js"></script>
</body>
</html>
