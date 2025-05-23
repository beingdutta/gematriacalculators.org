<?php
    /* ---------------  de/index.php --------------- */
    require __DIR__ . '/../calculate.php';
    $inputRaw = $_GET['input'] ?? '';
    $results  = $inputRaw !== '' ? gematria($inputRaw) : null;

    /* ───── Dynamic SEO ───── */
    if ($results) {
        $seoTitle = ucfirst($inputRaw).' Gematrie-Wert '
                .$results['english']['total'].' | Kostenloser Gematrie-Rechner';
        $seoDesc  = 'Ermitteln Sie hebräische, englische und einfache Gematrie für „'
                .htmlspecialchars($inputRaw,ENT_QUOTES).'“. '
                .'Hebräisch='.$results['hebrew']['total'].', '
                .'Englisch='.$results['english']['total'].', '
                .'Einfach='.$results['simple']['total'].'.';
    } else {
        $seoTitle = 'Kostenloser Gematrie-Rechner online';
        $seoDesc  = 'Berechnen Sie sofort hebräische, englische und einfache Gematrie-Werte für beliebige Wörter.';
    }
?>

<!DOCTYPE html>
<html lang="de" data-theme="light">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title><?= $seoTitle ?></title>
        <meta name="description" content="<?= htmlspecialchars($seoDesc,ENT_QUOTES) ?>">

        <!-- hreflang -->
        <?php
            $base = 'https://gematriacalculators.org';
            $path = ltrim($_SERVER['REQUEST_URI'],'/');
        ?>
        <link rel="alternate" hreflang="en" href="<?= $base ?>/<?= $path ?>">
        <link rel="alternate" hreflang="ru" href="<?= $base ?>/ru/<?= $path ?>">
        <link rel="alternate" hreflang="de" href="<?= $base ?>/de/<?= $path ?>">
        <link rel="alternate" hreflang="x-default" href="<?= $base ?>/<?= $path ?>">

        <link rel="canonical" href="<?= $base ?>/de/<?= $path ?>">
        <link rel="icon" href="/assets/site-icon.png" sizes="32x32">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="/styles/index.css">
        <script src="/scripts/index.js" defer></script>
    </head>
    <body>
        <div class="container">

        <!-- switcher -->
        <?php $qs = $_SERVER['QUERY_STRING'] ? '?'.$_SERVER['QUERY_STRING'] : ''; ?>
        <div style="text-align:right;margin:0.5rem 0">
            <a href="/index.php<?= $qs ?>">English</a> |
            <a href="/ru/index.php<?= $qs ?>">Русский</a> |
            <strong>Deutsch</strong>
        </div>

        <header class="header">
            <img src="/assets/header-image.webp" id="themeLogo" alt="Gematrie-Logo">
            <button class="theme-toggle" onclick="toggleTheme()">🌓</button>
            <h1>Kostenloser Gematrie-Rechner online</h1>
            <p class="subtitle">(Geben Sie ein Wort oder eine Zahl ein, z. B. Gott, Bibel, Hebräisch – und klicken Sie „Berechnen“)</p>
        </header>

        <main class="calculator">
            <div class="input-group">
            <input id="inputText"
                    type="text"
                    placeholder="Text eingeben…"
                    value="<?= htmlspecialchars($inputRaw,ENT_QUOTES) ?>">
            <button class="secondary" onclick="clearInput()" title="Löschen">✕</button>
            </div>

            <div class="button-container">
            <button class="calculate-btn" onclick="calculate()">Berechnen</button>
            <button class="download-btn"  onclick="calculateAndDownload()">PDF herunterladen</button>
            <a href="/decode-gematria-value.html" class="decode-btn">Gematrie entschlüsseln</a>
            </div>

            <div class="loading-container" id="loading" style="display:none"><div class="spinner"></div></div>

            <div class="result" id="result" style="<?= $results?'display:block;':'display:none;' ?>">
            <!-- Hebrew -->
            <div class="result-card">
                <button class="copy-btn" onclick="copyValue('hebrewValue','hebrewCopyNotification')">📋</button>
                <div class="copy-notification" id="hebrewCopyNotification">Kopiert!</div>
                <h3>Hebräische Gematrie: <span id="hebrewValue"><?= $results['hebrew']['total']??0 ?></span></h3>
                <p id="hebrewBreakdown">
                <?php if($results): ?>Berechnung: <?= implode(' + ',$results['hebrew']['breakdown']) ?><?php endif ?>
                </p>
            </div>
            <!-- English -->
            <div class="result-card">
                <button class="copy-btn" onclick="copyValue('englishValue','englishCopyNotification')">📋</button>
                <div class="copy-notification" id="englishCopyNotification">Kopiert!</div>
                <h3>Englische Gematrie: <span id="englishValue"><?= $results['english']['total']??0 ?></span></h3>
                <p id="englishBreakdown">
                <?php if($results): ?>Berechnung: (<?= implode(' + ',$results['simple']['breakdown']) ?>) × 6<?php endif ?>
                </p>
            </div>
            <!-- Simple -->
            <div class="result-card">
                <button class="copy-btn" onclick="copyValue('simpleValue','simpleCopyNotification')">📋</button>
                <div class="copy-notification" id="simpleCopyNotification">Kopiert!</div>
                <h3>Einfache Gematrie: <span id="simpleValue"><?= $results['simple']['total']??0 ?></span></h3>
                <p id="simpleBreakdown">
                <?php if($results): ?>Berechnung: <?= implode(' + ',$results['simple']['breakdown']) ?><?php endif ?>
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

        <p class="note" style="color:var(--error);text-align:center">
            Feedback oder Vorschläge bitte an <a href="mailto:admins@gematriacalculators.org">admins@gematriacalculators.org</a>
        </p>

        <footer class="footer">
            <div class="footer-links">
            <a href="/de/index.php">Startseite</a>
            <a href="/blog-collections.html">Blog</a>
            <a href="/about-us.html">Über uns</a>
            <a href="/contact-us.html">Kontakt</a>
            </div>
            <div class="copyright">© 2022 gematriacalculators.org</div>
        </footer>

        </div>
    </body>
</html>
