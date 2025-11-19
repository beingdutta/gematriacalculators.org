<?php
  // iw/index.php - Hebrew version
  require_once __DIR__ . '/../calculate.php';
  require_once __DIR__ . '/../helpers.php';

  $inputRaw = $_GET['input'] ?? '';
  $results  = $inputRaw !== '' ? gematria($inputRaw) : null;

  $SITE_NAME = 'מחשבון גימטריה';
  $BASE_URL = BASE_URL; // Define variable from constant

  $displayInput = trim($inputRaw); // BASE_URL is defined in helpers.php
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
    $pageTitle = 'מחשבון גימטריה חינם — Gematrix ונומרולוגיה | ' . $SITE_NAME;
  }

  $metaDescription = 'מחשבון הגימטריה החינמי הטוב ביותר. קבל תוצאות מיידיות ומדויקות עם כלי ה-gematrix והנומרולוגיה שלנו, התומך בגימטריה אנגלית, עברית ופשוטה. מושלם לניתוח תנ"כי ופענוח ערכים.';

  $canonicalUrl = $BASE_URL . 'iw/';
  if (!empty($inputRaw)) {
    $canonicalUrl .= '?input=' . rawurlencode($inputRaw);
  }

  $ogTitle = ($results && !empty($displayInput))
    ? sprintf('%s — ערך גימטריה: %s', $displayInput, (string)$results['english']['total'])
    : 'מחשבון גימטריה חינם — Gematrix ונומרולוגיה';

  $ogImage = $BASE_URL . 'assets/preview.jpg';

  $loadingPhrases = [
    "מתרגם מילים למספרים...",
    "מזמן את צפני הבריאה...",
    "מפענח את התבניות המספריות הנסתרות...",
    "מיישר אותיות עם ערכים אלוהיים...",
    "מחשב את רצף הגימטריה שלך...",
    "עוקב אחר הסכום הרטטי של שמך...",
    "חושף את המשמעות הסודית במספרים..."
  ];
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

    <!-- Yandex.Metrika counter -->
    <script type="text/javascript">
        (function(m,e,t,r,i,k,a){
            m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
            m[i].l=1*new Date();
            for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }}
            k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)
        })(window, document,'script','https://mc.yandex.ru/metrika/tag.js?id=105402705', 'ym');

        ym(105402705, 'init', {ssr:true, webvisor:true, clickmap:true, ecommerce:"dataLayer", accurateTrackBounce:true, trackLinks:true});
    </script>
    <noscript><div><img src="https://mc.yandex.ru/watch/105402705" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
    <!-- /Yandex.Metrika counter -->

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
    <link rel="alternate" hreflang="vi" href="<?= $BASE_URL . 'vi/' . ltrim($qs, '?') ?>">
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
    <?php require_once __DIR__ . '/../navigation/header.php'; ?>
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
                <span title="中文">סינית</span> ו
                <span title="Tiếng Việt">וייטנאמית</span>!
            </p>
        </div>

        <div class="recent-phrases ticker-bar">
            <h4>חיפושים אחרונים:</h4>
            <div class="ticker"><div class="ticker__list"></div></div>
        </div>
        <header class="header">
            <img src="/assets/talisman-header-icon.png" id="themeLogo" alt="לוגו מחשבון גימטריה">
            <h1>מחשבון גימטריה (Gematrix)</h1>
            <p class="subtitle">(הקלד מילה, שם או מספר, לדוגמה: אלוהים, תנ"ך, עברית – לחישוב ערכי גימטריה אונליין)</p>
        </header>
        <main class="calculator">
            <div class="input-group">
                <input id="inputText" type="text" placeholder="חשב גימטריה של שמי..." value="<?= htmlspecialchars($inputRaw, ENT_QUOTES, 'UTF-8') ?>" />
                <button class="secondary" onclick="clearInput()" title="נקה">✕</button>
            </div>
            <div class="button-container">
                <button class="calculate-btn" onclick="calculate()">חשב גימטריה</button>
                <button class="download-btn" onclick="calculateAndDownload()">הורד PDF</button>
                <a href="/decode-gematria-value.php" class="decode-btn">פענח גימטריה</a>
            </div>
            <div class="loading-container" id="loading" style="display:none">
                <div class="spinner"></div>
                <p id="loadingMessage" class="loading-message"></p>
            </div>
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
                <div class="promotion-box">
                    <div class="promo-icon" style="font-size: 2.5rem; color: var(--primary-color); flex-shrink: 0;">
                        <i class="fa-solid fa-wand-magic-sparkles"></i>
                    </div>
                    <div class="promo-content" style="text-align: center;">
                        <p style="margin: 0; font-weight: 600; font-size: 1.05em;">הרחב את התובנה שלך מעבר למספרים</p>
                        <p style="margin: 6px 0 0 0; font-size: 0.9em;">בעוד שהגימטריה חושפת את הקוד המספרי החבוי בחייך, הטארוט מציע דרך אחרת לחוכמה. שלב את ההיגיון של המספרים עם האינטואיציה של הקלפים כדי לקבל פרספקטיבה מלאה יותר. חפש הדרכה מקורא הטארוט היומי החינמי שלנו כדי להשלים את מסעך.</p>
                    </div>
                    <a href="https://tarotcardgenerator.online/" target="_blank" class="promo-btn" style="white-space: nowrap; margin-top: 1rem;">
                        קבל קריאת טארוט בחינם
                    </a>
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
            <p><strong>מחשבון הגימטריה המקוון החינמי</strong> שלנו פועל כ<strong>מחשבון שמות גימטריה</strong> חזק ותומך בהמרות מ<strong>גימטריה אנגלית לעברית</strong>. בין אם אתם מחפשים <strong>מחשבון גימטריה מקוון</strong> לניתוח תנ"כי או סתם <strong>מחשבון גימטריה פשוט</strong> לחקר משמעויות מספרים, כלי זה מיועד עבורכם. משתמשים מחפשים לעיתים קרובות "<strong>calculator gematria</strong>" או "<strong>gematria calculater</strong>" – והכלי שלנו עונה על צורך זה.</p>
            <div class="example">דוגמה: <strong>תנ"ך</strong> = 38 (עברית), 180 (אנגלית), 30 (פשוטה)</div>
        </div>

        <!-- SEO SECTION #2 -->
        <div class="seo-section">
            <p><strong>מחשבון הגימטריה</strong> הטוב ביותר שלנו (המכונה לעתים קרובות <strong>gematrix</strong> או <strong>gmetrix calculator</strong>) מיועד לדיוק ופשטות. הוא מושלם עבור חוקרים, מחפשים רוחניים, או כל מי שמתעניין בטקסטים קדושים. עם <strong>מחשבון הגימטריה העברי</strong> הטוב ביותר שלנו, תוכלו להשתמש ב<strong>מפענח הגימטריה</strong> שלנו כדי לנתח שמות רוחניים או לחקור קשרים אזוטריים. נסו את <strong>מחשבון הגימטריה הפשוט החינמי</strong> היום וצללו לעולם המספרים בביטחון. זהו חלופה מצוינת ל-Gematrix.org.</p>
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
                    <a href="<?= $BASE_URL . 'ru/' . ltrim($qs, '?') ?>">Русский</a>
                    <a href="<?= $BASE_URL . ltrim($qs, '?') ?>">English</a>
                    <a href="<?= $BASE_URL . 'es/' . ltrim($qs, '?') ?>">Español</a>
                    <a href="<?= $BASE_URL . 'de/' . ltrim($qs, '?') ?>">Deutsch</a>
                    <a href="<?= $BASE_URL . 'it/' . ltrim($qs, '?') ?>">Italiano</a>
                    <a href="<?= $BASE_URL . 'pt/' . ltrim($qs, '?') ?>">Português</a>
                    <a href="<?= $BASE_URL . 'pl/' . ltrim($qs, '?') ?>">Polski</a>
                    <a href="<?= $BASE_URL . 'iw/' . ltrim($qs, '?') ?>">עברית</a>
                    <a href="<?= $BASE_URL . 'zh/' . ltrim($qs, '?') ?>">中文</a>
                    <a href="<?= $BASE_URL . 'vi/' . ltrim($qs, '?') ?>">Tiếng Việt</a>
                </div>
            </div>
        </div>
        <footer class="footer">
            <h2 class="faq-heading">שאלות נפוצות</h2>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)"><span>מהי גימטריה?</span><svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg></div>
                <div class="faq-answer">גימטריה היא קוד אלפאנומרי המקצה ערך מספרי לשם, מילה או ביטוי על בסיס אותיותיו. היא נפוצה בשימוש במיסטיקה היהודית ובפרשנות המקרא.</div>
            </div>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)"><span>מהו מחשבון גימטריה?</span><svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg></div>
                <div class="faq-answer"><strong>מחשבון גימטריה חינמי</strong> הוא כלי מקוון המחשב באופן אוטומטי את הערך המספרי של מילה או ביטוי. הוא פועל כ<strong>מחולל גימטריה</strong> מודרני המבוסס על מערכות נומרולוגיה עתיקות.</div>
            </div>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)"><span>כיצד להשתמש במחשבון גימטריה מקוון?</span><svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg></div>
                <div class="faq-answer">כדי להשתמש ב<strong>מחשבון הגימטריה המקוון החינמי</strong> הטוב ביותר שלנו, פשוט הקלד מילה או ביטוי בתיבת הקלט, ואז לחץ על "חשב גימטריה" כדי ליצור את ערכיו במערכות העברית, האנגלית והפשוטה.</div>
            </div>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)"><span>כיצד להבין מחשבון גימטריה פשוט?</span><svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg></div>
                <div class="faq-answer"><strong>מחשבון הגימטריה הפשוט</strong> שלנו מקצה A=1, B=2, C=3, ... Z=26, ואז מסכם את הערכים הללו. הזן מילה כמו "אמת" והוא יוציא את הסכום הכולל, אותו תוכל להשוות למילים אחרות החולקות את אותו הערך.</div>
            </div>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)"><span>כיצד אוכל להשתמש במחשבון הגימטריה של התנ"ך?</span><svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg></div>
                <div class="faq-answer"><strong>מחשבון הגימטריה של התנ"ך</strong> שלנו מיועד לניתוח טקסטים ושמות מקראיים. תקבל ערכי <strong>גימטריה בעברית, אנגלית ופשוטה</strong> באופן מיידי. המחשבון שלנו תומך בתווים עבריים, מה שהופך אותו ל<strong>מחשבון הגימטריה הטוב ביותר למחקר מקראי</strong>. אנו תומכים גם בעקרונות של <strong>מחשבון גימטריה יווני</strong>.</div>
            </div>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)"><span>כיצד פועל מנוע החיפוש של הגימטריה?</span><svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg></div>
                <div class="faq-answer"><strong>מנוע החיפוש של הגימטריה</strong> ו<strong>מפענח הגימטריה</strong> שלנו מאפשרים לך למצוא מילים עם ערכים מספריים ספציפיים. אתה יכול לחפש באמצעות מערכות <strong>גימטריה בעברית, אנגלית או פשוטה</strong>.</div>
            </div>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)"><span>האם אני יכול לחשב ביטויים עם רווחים?</span><svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg></div>
                <div class="faq-answer">כן! <strong>מחשבון שמות גימטריה</strong> זה מתעלם אוטומטית מרווחים ותווים מיוחדים. אנו תומכים ב<strong>מחשבון שמות ומשמעויות גימטריה</strong> לכל המשתמשים בחינם.</div>
            </div>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)"><span>מהו מחשבון הגימטריה האנגלי?</span><svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg></div>
                <div class="faq-answer"><strong>מחשבון גימטריה אנגלי</strong> מקצה ערכים מספריים לאותיות האלפבית האנגלי. <strong>מחשבון הגימטריה האנגלי</strong> שלנו משתמש בצפנים שונים כמו גימטריה פשוטה (A=1, B=2) כדי לחשוף רבדים נסתרים של משמעות.</div>
            </div>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)"><span>מי צריך להשתמש במחשבון הגימטריה?</span><svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg></div>
                <div class="faq-answer">
                    <strong>מחשבון נומרולוגיה וגימטריה</strong> מיועד לכל מי שסקרן לגבי המבנה המספרי הנסתר של השפה. הוא מושלם עבור:
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
                <div class="faq-answer"><strong>מחשבון גימטריה יהודי</strong> (או <strong>מחשבון גימטריה עברי</strong>) מבוסס על המסורת היהודית של הקצאת ערכים מספריים לאותיות העבריות. סוג זה של <strong>מחשבון גימטריה עברי</strong> חיוני לחקר הערכים המספריים של שמות ומושגים מקראיים.</div>
            </div>
            <div class="copyright">© <?= date('Y') ?> gematriacalculators.org</div>
        </footer>
    </div>
    <script>
      window.GematriaLang = {
        loadingPhrases: <?= json_encode($loadingPhrases) ?>
      };
    </script>
</body>
</html>
