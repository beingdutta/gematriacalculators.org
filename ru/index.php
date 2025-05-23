<?php
    /* ---------------  ru/index.php --------------- */
    require __DIR__ . '/../calculate.php';      // path up one level
    $inputRaw = $_GET['input'] ?? '';
    $results  = $inputRaw !== '' ? gematria($inputRaw) : null;

    /* ───── Dynamic SEO tags ───── */
    if ($results) {
        $seoTitle = ucfirst($inputRaw).' — значение в гематрии '
                .$results['english']['total'].' | Онлайн-калькулятор гематрии';
        $seoDesc  = 'Узнайте еврейские, английские и простые значения слова «'
                .htmlspecialchars($inputRaw,ENT_QUOTES).'». '
                .'Hebrew='.$results['hebrew']['total'].', '
                .'English='.$results['english']['total'].', '
                .'Simple='.$results['simple']['total'].'.';
    } else {
        $seoTitle = 'Бесплатный онлайн-калькулятор гематрии';
        $seoDesc  = 'Мгновенно вычисляйте еврейскую, английскую и простую гематрию любых слов.';
    }
?>

<!DOCTYPE html>
<html lang="ru" data-theme="light">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title><?= $seoTitle ?></title>
        <meta name="description" content="<?= htmlspecialchars($seoDesc,ENT_QUOTES) ?>">

        <!-- hreflang links -->
        <?php
        $base = 'https://gematriacalculators.org';
        $path = ltrim($_SERVER['REQUEST_URI'],'/');
        ?>
        <link rel="alternate" hreflang="en" href="<?= $base ?>/<?= $path ?>">
        <link rel="alternate" hreflang="ru" href="<?= $base ?>/ru/<?= $path ?>">
        <link rel="alternate" hreflang="de" href="<?= $base ?>/de/<?= $path ?>">
        <link rel="alternate" hreflang="x-default" href="<?= $base ?>/<?= $path ?>">

        <!-- canonical -->
        <link rel="canonical" href="<?= $base ?>/ru/<?= $path ?>">

        <link rel="icon" href="/assets/site-icon.png" sizes="32x32">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="/styles/index.css">
        <script src="/scripts/index.js" defer></script>
    </head>

    <body>
        <div class="container">

        <!-- Language switcher -->
        <?php $qs = $_SERVER['QUERY_STRING'] ? '?'.$_SERVER['QUERY_STRING'] : ''; ?>
        <div style="text-align:right;margin:0.5rem 0">
            <a href="/index.php<?= $qs ?>">English</a> |
            <strong>Русский</strong> |
            <a href="/de/index.php<?= $qs ?>">Deutsch</a>
        </div>

        <header class="header">
            <img src="/assets/header-image.webp" id="themeLogo" alt="логотип калькулятора гематрии">
            <button class="theme-toggle" onclick="toggleTheme()">🌓</button>
            <h1>Бесплатный онлайн-калькулятор гематрии</h1>
            <p class="subtitle">(Введите слово или число, например Бог, Библия, Иврит — и нажмите «Рассчитать»)</p>
        </header>

        <main class="calculator">
            <div class="input-group">
            <input id="inputText"
                    type="text"
                    placeholder="Введите текст…"
                    value="<?= htmlspecialchars($inputRaw,ENT_QUOTES) ?>">
            <button class="secondary" onclick="clearInput()" title="Очистить">✕</button>
            </div>

            <div class="button-container">
            <button class="calculate-btn" onclick="calculate()">Рассчитать</button>
            <button class="download-btn"  onclick="calculateAndDownload()">Скачать PDF</button>
            <a href="/decode-gematria-value.html" class="decode-btn">Расшифровать гематрию</a>
            </div>

            <div class="loading-container" id="loading" style="display:none"><div class="spinner"></div></div>

            <div class="result" id="result" style="<?= $results?'display:block;':'display:none;' ?>">
            <!-- Hebrew -->
            <div class="result-card">
                <button class="copy-btn" onclick="copyValue('hebrewValue','hebrewCopyNotification')">📋</button>
                <div class="copy-notification" id="hebrewCopyNotification">Скопировано!</div>
                <h3>Еврейская гематрия: <span id="hebrewValue"><?= $results['hebrew']['total']??0 ?></span></h3>
                <p id="hebrewBreakdown">
                <?php if($results): ?>Расчёт: <?= implode(' + ',$results['hebrew']['breakdown']) ?><?php endif ?>
                </p>
            </div>
            <!-- English -->
            <div class="result-card">
                <button class="copy-btn" onclick="copyValue('englishValue','englishCopyNotification')">📋</button>
                <div class="copy-notification" id="englishCopyNotification">Скопировано!</div>
                <h3>Английская гематрия: <span id="englishValue"><?= $results['english']['total']??0 ?></span></h3>
                <p id="englishBreakdown">
                <?php if($results): ?>Расчёт: (<?= implode(' + ',$results['simple']['breakdown']) ?>) × 6<?php endif ?>
                </p>
            </div>
            <!-- Simple -->
            <div class="result-card">
                <button class="copy-btn" onclick="copyValue('simpleValue','simpleCopyNotification')">📋</button>
                <div class="copy-notification" id="simpleCopyNotification">Скопировано!</div>
                <h3>Простая гематрия: <span id="simpleValue"><?= $results['simple']['total']??0 ?></span></h3>
                <p id="simpleBreakdown">
                <?php if($results): ?>Расчёт: <?= implode(' + ',$results['simple']['breakdown']) ?><?php endif ?>
                </p>
            </div>

            <div class="feedback">
                <p>Насколько точны эти результаты?</p>
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
            Вопросы и предложения: <a href="mailto:admins@gematriacalculators.org">admins@gematriacalculators.org</a>
        </p>

        <!-- Translate FAQ & SEO sections later -->

        <footer class="footer">
            <div class="footer-links">
            <a href="/ru/index.php">Главная</a>
            <a href="/blog-collections.html">Блог</a>
            <a href="/about-us.html">О нас</a>
            <a href="/contact-us.html">Контакты</a>
            </div>
            <div class="copyright">© 2022 gematriacalculators.org</div>
        </footer>

        </div>
    </body>

</html>
