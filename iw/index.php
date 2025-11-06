<?php
  // iw/index.php - Hebrew version
  require_once __DIR__ . '/../calculate.php';
  require_once __DIR__ . '/../helpers.php';

  $inputRaw = $_GET['input'] ?? '';
  $results  = $inputRaw !== '' ? gematria($inputRaw) : null;

  $SITE_NAME        = 'מחשבון גימטריה';
  $BASE_URL         = 'https://gematriacalculators.org/';

  $displayInput = trim($inputRaw);
  if ($displayInput !== '') {
    $displayInput = mb_strimwidth($displayInput, 0, 60, '…', 'UTF-8');
  }

  if ($results && isset($results['english']['total'])) {
    $pageTitle = sprintf(
      '%s — ערך גימטריה: %s | %s',
      ucfirst($displayInput),
      (string)$results['english']['total'],
      $SITE_NAME
    );
  } else {
    $pageTitle = 'מחשבון גימטריה חינם — עברית, אנגלית ופשוטה | ' . $SITE_NAME;
  }

  $metaDescription = 'מחשבון גימטריה חינם בעברית, אנגלית ופשוטה. חשב ערכי גימטריה ומשמעויות לכל מילה או ביטוי.';

  $canonicalUrl = $BASE_URL . 'iw/';
  if (!empty($inputRaw)) {
    $canonicalUrl .= '?input=' . rawurlencode($inputRaw);
  }

  $ogTitle = ($results && !empty($displayInput))
    ? sprintf('%s — ערך גימטריה: %s', $displayInput, (string)$results['english']['total'])
    : 'מחשבון גימטריה חינם';

  $ogImage = $BASE_URL . 'assets/preview.jpg';
?>

<!DOCTYPE html>
<html lang="he" dir="rtl" data-theme="light">
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8'); ?></title>
    <meta name="description" content="<?= htmlspecialchars($metaDescription, ENT_QUOTES, 'UTF-8'); ?>">
    <link rel="canonical" href="<?= htmlspecialchars($canonicalUrl, ENT_QUOTES, 'UTF-8'); ?>">

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

    <meta name="keywords" content="מחשבון גימטריה, גימטריה עברית, גימטריה אנגלית, גימטריה פשוטה">
    <meta property="og:title" content="<?= htmlspecialchars($ogTitle, ENT_QUOTES, 'UTF-8'); ?>">
    <meta property="og:description" content="<?= htmlspecialchars($metaDescription, ENT_QUOTES, 'UTF-8'); ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= htmlspecialchars($canonicalUrl, ENT_QUOTES, 'UTF-8'); ?>">
    <meta property="og:image" content="<?= htmlspecialchars($ogImage, ENT_QUOTES, 'UTF-8'); ?>">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= htmlspecialchars($ogTitle, ENT_QUOTES, 'UTF-8'); ?>">
    <meta name="twitter:description" content="<?= htmlspecialchars($metaDescription, ENT_QUOTES, 'UTF-8'); ?>">
    <meta name="twitter:image" content="<?= htmlspecialchars($ogImage, ENT_QUOTES, 'UTF-8'); ?>">

    <!-- Additional SEO meta tags for multilingual -->
    <meta property="og:locale" content="he_IL" />
    <meta property="og:locale:alternate" content="en_US" />
    <meta property="og:locale:alternate" content="ru_RU" />
    <meta property="og:locale:alternate" content="de_DE" />
    <meta property="og:locale:alternate" content="es_ES" />
    <meta property="og:locale:alternate" content="it_IT" />
    <meta property="og:locale:alternate" content="pl_PL" />
    <meta property="og:locale:alternate" content="pt_BR" />
    <meta property="og:locale:alternate" content="zh_CN" />

    <!-- Schema.org markup -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "WebApplication",
      "name": "מחשבון גימטריה",
      "url": "<?= htmlspecialchars($canonicalUrl, ENT_QUOTES, 'UTF-8'); ?>",
      "description": "מחשבון גימטריה חינם בעברית, אנגלית ופשוטה",
      "applicationCategory": "Calculator",
      "operatingSystem": "Any",
      "inLanguage": "he"
    }
    </script>
    <link rel="icon" href="/assets/talisman-site-icon.png" sizes="32x32">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="/styles/index.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>
    <script src="/scripts/index.js"></script>
</head>
<body>
    <nav class="header-nav">
        <button class="mobile-menu-toggle" aria-label="Toggle menu">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
        </button>
        <div class="nav-links">
            <a href="/iw/">דף הבית</a>
            <a href="/more-tools/">עוד כלים</a>
            <a href="/blog-collections/">בלוג</a>
            <a href="/about-us/">אודות</a>
            <a href="/contact-us/">צור קשר</a>
            <a href="/terms-conditions/">תנאים</a>
            <a href="/privacy-policy/">מדיניות פרטיות</a>
            <button class="lang-change-btn mobile-only" onclick="openLangPopup()">שנה שפה</button>
        </div>
        <button class="theme-toggle" onclick="toggleTheme()" aria-label="החלף ערכת נושא">
          <svg class="icon-sun" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="5"></circle><line x1="12" y1="1" x2="12" y2="3"></line><line x1="12" y1="21" x2="12" y2="23"></line><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line><line x1="1" y1="12" x2="3" y2="12"></line><line x1="21" y1="12" x2="23" y2="12"></line><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line></svg>
          <svg class="icon-moon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path></svg>
        </button>
    </nav>
    <div class="container">
        
        <!-- Language Support Info -->
        <div class="language-support-info" style="background: #f0f8ff; padding: 12px; margin: 2px 0 10px 0; border-radius: 8px; text-align: center; border: 1px solid #cce5ff;">
          <p style="margin: 0; color: #004085; font-size: 13px;">
                🌍 תודה על האמון! אנחנו כעת תומכים במספר שפות:
                <span title="English">אנגלית</span>,
                <span title="Русский">רוסית</span>,
                <span title="Deutsch">גרמנית</span>,
                <span title="Español">ספרדית</span>,
                <span title="Português">פורטוגזית</span>,
                <span title="Italiano">איטלקית</span>,
                <strong>עברית</strong>,
                <span title="Polski">פולנית</span> ו
                <span title="中文">סינית</span>!
            </p>
        </div>

        <div class="recent-phrases ticker-bar">
            <h4>חיפושים אחרונים:</h4>
            <?php $qs = $_SERVER['QUERY_STRING'] ? '?'.$_SERVER['QUERY_STRING'] : ''; $here = trim(dirname($_SERVER['SCRIPT_NAME']), '/'); ?>
            <nav class="lang-switcher" aria-label="בחירת שפה">
            <?php $here = 'iw'; // Force correct language code ?>
            <?= lang_switcher_link('en','EN',$qs,$here) ?> |
            <?= lang_switcher_link('de','DE',$qs,$here) ?> |
            <?= lang_switcher_link('es','ES',$qs,$here) ?> |
            <?= lang_switcher_link('it','IT',$qs,$here) ?> |
            <?= lang_switcher_link('iw','HE',$qs,$here) ?> |
            <?= lang_switcher_link('pl','PL',$qs,$here) ?> |
            <?= lang_switcher_link('pt','PT',$qs,$here) ?> |
            <?= lang_switcher_link('ru','RU',$qs,$here) ?> |
            <?= lang_switcher_link('zh','CN',$qs,$here) ?>
            </nav>
            <div class="ticker"><div class="ticker__list"></div></div>
        </div>
        <header class="header">
            <img src="/assets/talisman-header-icon.png" id="themeLogo" alt="לוגו מחשבון גימטריה">
            <h1>מחשבון גימטריה</h1>
            <p class="subtitle">(הקלד מילה או מספר לדוג' אלוהים, תנ"ך, עברית, קדוש – לחשב ערכי גימטריה)</p>
        </header>
        <main class="calculator">
            <div class="input-group">
                <input id="inputText" type="text" placeholder="הכנס טקסט לחישוב..." value="<?= htmlspecialchars($inputRaw, ENT_QUOTES, 'UTF-8') ?>" />
                <button class="secondary" onclick="clearInput()" title="נקה">✕</button>
            </div>
            <div class="button-container">
                <button class="calculate-btn" onclick="calculate()">חשב</button>
                <button class="download-btn" onclick="calculateAndDownload()">הורד PDF</button>
                <a href="/iw/decode-gematria-value/" class="decode-btn">פענח גימטריה</a>
            </div>
            <div class="loading-container" id="loading" style="display:none"><div class="spinner"></div></div>
            <div class="result" id="result" style="<?= $results ? 'display:block;' : 'display:none;' ?>">
                <div class="result-card">
                    <button class="copy-btn" onclick="copyValue('hebrewValue','hebrewCopyNotification')"><i class="fa-regular fa-copy"></i></button>
                    <div class="copy-notification" id="hebrewCopyNotification">הועתק!</div>
                    <h3>גימטריה עברית: <span id="hebrewValue"><?= $results['hebrew']['total'] ?? 0 ?></span></h3>
                    <p id="hebrewBreakdown"><?php if($results): ?>חישוב: <?= implode(' + ', $results['hebrew']['breakdown']) ?><?php endif ?></p>
                </div>
                <div class="result-card">
                    <button class="copy-btn" onclick="copyValue('englishValue','englishCopyNotification')"><i class="fa-regular fa-copy"></i></button>
                    <div class="copy-notification" id="englishCopyNotification">הועתק!</div>
                    <h3>גימטריה אנגלית: <span id="englishValue"><?= $results['english']['total'] ?? 0 ?></span></h3>
                    <p id="englishBreakdown"><?php if($results): ?>חישוב: (<?= implode(' + ', $results['simple']['breakdown']) ?>) × 6<?php endif ?></p>
                </div>
                <div class="result-card">
                    <button class="copy-btn" onclick="copyValue('simpleValue','simpleCopyNotification')"><i class="fa-regular fa-copy"></i></button>
                    <div class="copy-notification" id="simpleCopyNotification">הועתק!</div>
                    <h3>גימטריה פשוטה: <span id="simpleValue"><?= $results['simple']['total'] ?? 0 ?></span></h3>
                    <p id="simpleBreakdown"><?php if($results): ?>חישוב: <?= implode(' + ', $results['simple']['breakdown']) ?><?php endif ?></p>
                </div>
                <div class="feedback">
                    <p>האם המחשבון היה שימושי?</p>
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
            להצעות, משוב או שיפורים, כתבו לנו לכתובת <a href="mailto:admins@gematriacalculators.org" style="color: var(--error); text-decoration: underline;">admins@gematriacalculators.org</a>.
        </p>

        <!-- SEO SECTION #1 -->
        <div class="seo-section">
            <h4>גלו משמעויות מספריות נסתרות</h4>
            <p>מחשבון גימטריה מקוון חינם זה פועל כמחשבון גימטריה עוצמתי לשמות ותומך בהמרות גימטריה מאנגלית לעברית. בין אם אתם מחפשים מחשבון גימטריה מקוון לניתוח מקראי או סתם מחשבון גימטריה פשוט לחקר משמעויות מספרים, כלי זה מיועד עבורכם. משתמשים מחפשים לעיתים קרובות מונחים כמו "מחשבון גימטריה", "מחשבון נומרולוגיה עברית" ו"מחשבון גימטריה פשוט" – וכלי זה מספק את הפונקציונליות שהם מחפשים.</p>
            <div class="example">דוגמה: <strong>תנ"ך</strong> = 38 (עברית), 180 (אנגלית), 30 (פשוטה)</div>
        </div>

        <!-- SEO SECTION #2 -->
        <div class="seo-section">
            <p>כלי הגימטריה המקוון הטוב ביותר שלנו (הידוע גם כמחשבון גימטריקס) מיועד לדיוק, מהירות ופשטות. הוא מושלם עבור חוקרים, מחפשים רוחניים, או כל מי שמתעניין במסורות המיסטיות שמאחורי טקסטים קדושים. עם מחשבון הגימטריה העברי הטוב ביותר שלנו, תוכלו לפענח קטעים מקראיים, לנתח שמות רוחניים, או לחקור קשרים אזוטריים – הכל במקום אחד. נסו את מחשבון הגימטריה הפשוט ביותר בחינם היום וצללו לעולם של משמעויות מספרים סמליות בביטחון.</p>
        </div>

        <hr class="divider"><br>

        <!-- GLOBAL FEEDBACK BANNER -->
        <div class="global-feedback-message" id="globalFeedback"></div>

        <!-- Recent Searches -->
        <div class="recent-phrases">
            <h4>חיפושים אחרונים:</h4>
            <a href="#">התנ"ך</a> |
            <a href="#">תדר אלוהים 432</a> |
            <a href="#">אור יהוה הקדוש</a> |
            <a href="#">שבתאי</a> |
            <a href="#">אמת נסתרת לעין</a> |
            <a href="#">מטטרון מדבר במספרים</a> |
            <a href="#">שלום על פני כאוס תמיד</a>
        </div>
        <div class="seo-section">
            <p>המחשבון שלנו מדויק, מהיר וקל לשימוש. מושלם לחוקרים, מחפשים רוחניים וכל מי שמתעניין במספרים וסודותיהם.</p>
        </div>
        <hr class="divider"><br>
        <div class="global-feedback-message" id="globalFeedback"></div>

        <!-- Language Popup -->
        <div class="lang-popup">
            <div class="lang-popup-content">
                <button class="lang-popup-close" onclick="closeLangPopup()">&times;</button>
                <h4>בחירת שפה</h4>
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
                </div>
            </div>
        </div>
        <footer class="footer">
            <h2 class="faq-heading">שאלות נפוצות</h2>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)"><span>מהי גימטריה?</span><svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg></div>
                <div class="faq-answer">גימטריה היא קוד אלפאנומרי של הקצאת ערך מספרי לשם, מילה או ביטוי על בסיס אותיותיו. היא נפוצה בשימוש במיסטיקה היהודית ובפרשנות המקרא.</div>
            </div>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)"><span>מהו מחשבון גימטריה?</span><svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg></div>
                <div class="faq-answer">כלי או תוכנה מקוונים חינמיים של מחשבון גימטריה המחשבים באופן אוטומטי את הערך המספרי של מילה, ביטוי או שם על ידי הקצאת ערכים מספריים לכל אות, בהתבסס על מערכות גימטריה ספציפיות.</div>
            </div>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)"><span>כיצד להשתמש במחשבון גימטריה מקוון?</span><svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg></div>
                <div class="faq-answer">כדי להשתמש במחשבון הגימטריה המקוון החינמי הטוב ביותר שלנו, פשוט הקלד מילה, ביטוי או שם בתיבת הקלט, ואז לחץ על "חשב" כדי ליצור את ערכיו המספריים במערכות העברית, האנגלית והפשוטה. לתיעוד, תוכל גם להוריד דוח PDF.</div>
            </div>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)"><span>כיצד להבין מחשבון גימטריה פשוט?</span><svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg></div>
                <div class="faq-answer">מחשבון הגימטריה הפשוט שלנו מקצה A=1, B=2, C=3, ... Z=26, ואז מסכם את הערכים הללו. הזן מילה כמו "אמת" והוא יוציא את הסכום הכולל, אותו תוכל להשוות למילים אחרות החולקות את אותו הערך.</div>
            </div>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)"><span>כיצד אוכל להשתמש במחשבון הגימטריה של התנ"ך?</span><svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg></div>
                <div class="faq-answer">מחשבון הגימטריה של התנ"ך שלנו מיועד לניתוח טקסטים ושמות מקראיים. פשוט הזן כל מילה או ביטוי מהתנ"ך, ותקבל ערכי גימטריה מיידיים בעברית, אנגלית ופשוטה. המחשבון שלנו תומך בתווים עבריים מודרניים ומקראיים, מה שהופך אותו למחשבון הגימטריה הטוב ביותר למחקר מקראי.</div>
            </div>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)"><span>כיצד פועל מנוע החיפוש של הגימטריה?</span><svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg></div>
                <div class="faq-answer">מנוע החיפוש של הגימטריה שלנו מאפשר לך למצוא מילים וביטויים עם ערכים מספריים ספציפיים. אתה יכול לחפש באמצעות מערכות גימטריה בעברית, אנגלית או פשוטה. תכונה זו שימושית במיוחד למחקר מקראי ולמציאת קשרים בין מילים ומושגים שונים.</div>
            </div>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)"><span>האם אני יכול לחשב ביטויים עם רווחים?</span><svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg></div>
                <div class="faq-answer">כן! מחשבון שמות גימטריה זה מתעלם אוטומטית מרווחים ותווים מיוחדים, ומתמקד רק באותיות אלפביתיות. אנו תומכים במחשבון שמות ומשמעויות גימטריה לכל המשתמשים בכל עת 24*7 בחינם. המחשבון שלנו שימושי במיוחד לניתוח ביטויים מרובי מילים מטקסטים דתיים.</div>
            </div>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)"><span>מהו מחשבון הגימטריה האנגלי?</span><svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg></div>
                <div class="faq-answer">מחשבון גימטריה אנגלי הוא כלי המקצה ערכים מספריים לאותיות האלפבית האנגלי. בניגוד לעברית, לאנגלית אין מערכת עתיקה אחת, ולכן מחשבונים משתמשים בצפנים שונים כמו גימטריה פשוטה (A=1, B=2), סדר הפוך (A=26, B=25) וצמצום. זה מאפשר לך לחקור את הדפוסים המספריים והקשרים הסמליים בין מילים, שמות וביטויים באנגלית, ולחשוף רבדים נסתרים של משמעות.</div>
            </div>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)"><span>מי צריך להשתמש במחשבון הגימטריה?</span><svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg></div>
                <div class="faq-answer">
                    מחשבון גימטריה מיועד לכל מי שסקרן לגבי המבנה המספרי הנסתר של השפה. הוא מושלם עבור:
                    <ul>
                        <li>מחפשים רוחניים החוקרים טקסטים קדושים כמו התנ"ך.</li>
                        <li>סופרים ואמנים המחפשים השראה יצירתית ועומק סמלי.</li>
                        <li>חובבי היסטוריה המתעניינים בשיטות פרשנות עתיקות.</li>
                        <li>חובבי נומרולוגיה המנתחים שמות, תאריכים ומושגים.</li>
                        <li>כל מי שאוהב פאזלים ומציאת דפוסים נסתרים בעולם סביבם.</li>
                    </ul>
                </div>
            </div>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)"><span>מהו מחשבון הגימטריה היהודי?</span><svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg></div>
                <div class="faq-answer">מחשבון גימטריה יהודי (או מחשבון גימטריה עברי) הוא כלי המבוסס על המסורת היהודית העתיקה של הקצאת ערכים מספריים ל-22 אותיות האלפבית העברי. הוא משתמש בעיקר במערכת המספר ההכרחי (התקנית), שהיא יסודית לקבלה ולפרשנות התורה. סוג זה של מחשבון חיוני לחקר הערכים המספריים של שמות, מושגים ופסוקים מקראיים כדי לחשוף קשרים תיאולוגיים ומיסטיים עמוקים יותר.</div>
            </div>
            <div class="copyright">© <?= date('Y') ?> gematriacalculators.org</div>
        </footer>
    </div>
</body>
</html>
