<?php
  // zh/index.php - Chinese version
  require_once __DIR__ . '/../calculate.php';
  require_once __DIR__ . '/../helpers.php';

  $inputRaw = $_GET['input'] ?? '';
  $results  = $inputRaw !== '' ? gematria($inputRaw) : null;

  $SITE_NAME        = '数字占卜计算器';
  $BASE_URL         = 'https://gematriacalculators.org/';

  $displayInput = trim($inputRaw);
  if ($displayInput !== '') {
    $displayInput = mb_strimwidth($displayInput, 0, 60, '…', 'UTF-8');
  }

  if ($results && isset($results['english']['total'])) {
    $pageTitle = sprintf(
      '%s — 数字占卜值: %s | %s',
      ucfirst($displayInput),
      (string)$results['english']['total'],
      $SITE_NAME
    );
  } else {
    $pageTitle = '免费数字占卜计算器 — 希伯来文、英文和简单 | ' . $SITE_NAME;
  }

  $metaDescription = '免费在线数字占卜计算器，支持希伯来文、英文和简单计算方式。立即计算任何单词或短语的数字占卜值和含义。';

  $canonicalUrl = $BASE_URL . 'zh/';
  if (!empty($inputRaw)) {
    $canonicalUrl .= '?input=' . rawurlencode($inputRaw);
  }

  $ogTitle = ($results && !empty($displayInput))
    ? sprintf('%s — 数字占卜值: %s', $displayInput, (string)$results['english']['total'])
    : '免费数字占卜计算器';

  $ogImage = $BASE_URL . 'assets/preview.jpg';
?>

<!DOCTYPE html>
<html lang="zh" data-theme="light">
<head>
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

    <meta name="keywords" content="数字占卜计算器, 希伯来文数字占卜, 英文数字占卜, 简单数字占卜">
    <meta property="og:title" content="<?= htmlspecialchars($ogTitle, ENT_QUOTES, 'UTF-8'); ?>">
    <meta property="og:description" content="<?= htmlspecialchars($metaDescription, ENT_QUOTES, 'UTF-8'); ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= htmlspecialchars($canonicalUrl, ENT_QUOTES, 'UTF-8'); ?>">
    <meta property="og:image" content="<?= htmlspecialchars($ogImage, ENT_QUOTES, 'UTF-8'); ?>">
        <!-- Schema.org JSON-LD -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "WebApplication",
      "name": "数字占卜计算器",
      "url": "<?= htmlspecialchars($canonicalUrl, ENT_QUOTES, 'UTF-8'); ?>",
      "description": "免费在线数字占卜计算器，支持希伯来文、英文和简单计算方式。",
      "applicationCategory": "Calculator",
      "operatingSystem": "Any",
      "inLanguage": "zh"
    }
    </script>

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image"
    <meta name="twitter:title" content="<?= htmlspecialchars($ogTitle, ENT_QUOTES, 'UTF-8'); ?>">
    <meta name="twitter:description" content="<?= htmlspecialchars($metaDescription, ENT_QUOTES, 'UTF-8'); ?>">
    <meta name="twitter:image" content="<?= htmlspecialchars($ogImage, ENT_QUOTES, 'UTF-8'); ?>">
    
    <!-- Additional SEO meta tags for multilingual -->
    <meta property="og:locale" content="zh_CN" />
    <meta property="og:locale:alternate" content="en_US" />
    <meta property="og:locale:alternate" content="de_DE" />
    <meta property="og:locale:alternate" content="es_ES" />
    <meta property="og:locale:alternate" content="it_IT" />
    <meta property="og:locale:alternate" content="iw_IL" />
    <meta property="og:locale:alternate" content="pl_PL" />
    <meta property="og:locale:alternate" content="pt_BR" />
    <meta property="og:locale:alternate" content="ru_RU" />
    <link rel="icon" href="/assets/talisman-site-icon.png" sizes="32x32">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="/styles/index.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>
</head>
<body>
    <nav class="header-nav">
        <a href="/zh/">首页</a>
        <a href="/more-tools/">更多工具</a>
        <a href="/blog-collections/">博客</a>
        <a href="/about-us/">关于我们</a>
        <a href="/contact-us/">联系我们</a>
        <a href="/terms-conditions/">使用条款</a>
        <a href="/privacy-policy/">隐私政策</a>
        <button class="theme-toggle" onclick="toggleTheme()" aria-label="切换主题">
          <svg class="icon-sun" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="5"></circle><line x1="12" y1="1" x2="12" y2="3"></line><line x1="12" y1="21" x2="12" y2="23"></line><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line><line x1="1" y1="12" x2="3" y2="12"></line><line x1="21" y1="12" x2="23" y2="12"></line><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line></svg>
          <svg class="icon-moon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path></svg>
        </button>
    </nav>
    <div class="container">
        <div class="recent-phrases ticker-bar">
            <h4>最近搜索：</h4>
            <?php $qs = $_SERVER['QUERY_STRING'] ? '?'.$_SERVER['QUERY_STRING'] : ''; $here = 'zh'; ?>
            <nav class="lang-switcher" aria-label="语言选择">
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
            <img src="/assets/talisman-header-icon.png" id="themeLogo" alt="数字占卜计算器图标">
            <h1>数字占卜计算器</h1>
            <p class="subtitle">（输入一个单词或数字，如：神、圣经、希伯来文、圣洁 - 计算数字占卜值）</p>
        </header>
        <main class="calculator">
            <div class="input-group">
                <input id="inputText" type="text" placeholder="输入文字计算..." value="<?= htmlspecialchars($inputRaw, ENT_QUOTES, 'UTF-8') ?>" />
                <button class="secondary" onclick="clearInput()" title="清除">✕</button>
            </div>
            <div class="button-container">
                <button class="calculate-btn" onclick="calculate()">计算</button>
                <button class="download-btn" onclick="calculateAndDownload()">下载PDF</button>
                <a href="/zh/decode-gematria-value/" class="decode-btn">解码数字占卜</a>
            </div>
            <div class="loading-container" id="loading" style="display:none"><div class="spinner"></div></div>
            <div class="result" id="result" style="<?= $results ? 'display:block;' : 'display:none;' ?>">
                <div class="result-card">
                    <button class="copy-btn" onclick="copyValue('hebrewValue','hebrewCopyNotification')"><i class="fa-regular fa-copy"></i></button>
                    <div class="copy-notification" id="hebrewCopyNotification">已复制！</div>
                    <h3>希伯来文数字占卜: <span id="hebrewValue"><?= $results['hebrew']['total'] ?? 0 ?></span></h3>
                    <p id="hebrewBreakdown"><?php if($results): ?>计算: <?= implode(' + ', $results['hebrew']['breakdown']) ?><?php endif ?></p>
                </div>
                <div class="result-card">
                    <button class="copy-btn" onclick="copyValue('englishValue','englishCopyNotification')"><i class="fa-regular fa-copy"></i></button>
                    <div class="copy-notification" id="englishCopyNotification">已复制！</div>
                    <h3>英文数字占卜: <span id="englishValue"><?= $results['english']['total'] ?? 0 ?></span></h3>
                    <p id="englishBreakdown"><?php if($results): ?>计算: (<?= implode(' + ', $results['simple']['breakdown']) ?>) × 6<?php endif ?></p>
                </div>
                <div class="result-card">
                    <button class="copy-btn" onclick="copyValue('simpleValue','simpleCopyNotification')"><i class="fa-regular fa-copy"></i></button>
                    <div class="copy-notification" id="simpleCopyNotification">已复制！</div>
                    <h3>简单数字占卜: <span id="simpleValue"><?= $results['simple']['total'] ?? 0 ?></span></h3>
                    <p id="simpleBreakdown"><?php if($results): ?>计算: <?= implode(' + ', $results['simple']['breakdown']) ?><?php endif ?></p>
                </div>
                <div class="feedback">
                    <p>这个计算器对您有帮助吗？</p>
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
            如有反馈、建议或改进意见，请发送邮件至 <a href="mailto:admins@gematriacalculators.org" style="color: var(--error); text-decoration: underline;">admins@gematriacalculators.org</a>。
        </p>
        <div class="seo-section">
            <h4>探索隐藏的数字含义</h4>
            <p>这个数字占卜计算器让您能够计算希伯来文和英文中的单词、名字和短语的数字值。非常适合研究圣经、数字学和探索数字的神秘意义。</p>
            <div class="example">示例: <strong>圣经</strong> = 38 (希伯来文), 180 (英文), 30 (简单)</div>
        </div>
        <div class="seo-section">
            <p>我们的计算器准确、快速且易于使用。完美适合研究者、灵性探索者以及所有对数字及其秘密感兴趣的人。</p>
        </div>
        <hr class="divider"><br>
        <div class="global-feedback-message" id="globalFeedback"></div>
        <footer class="footer">
            <h2 class="faq-heading">常见问题</h2>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)"><span>什么是数字占卜？</span><svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg></div>
                <div class="faq-answer">数字占卜是一种根据字母对应数字值的方法。在犹太神秘主义和圣经解释中常常使用。</div>
            </div>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)"><span>什么是数字占卜计算器？</span><svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg></div>
                <div class="faq-answer">数字占卜计算器是一个根据选定的系统自动计算单词或短语数字值的工具。</div>
            </div>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)"><span>如何使用计算器？</span><svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg></div>
                <div class="faq-answer">输入一个单词、短语或名字，然后点击"计算"。结果将显示希伯来文、英文和简单三种计算方式。</div>
            </div>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)"><span>简单数字占卜如何工作？</span><svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg></div>
                <div class="faq-answer">在简单数字占卜中，A=1, B=2, ... Z=26。计算器会将所有字母的值相加得出总值。</div>
            </div>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)"><span>可以计算带空格的短语吗？</span><svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg></div>
                <div class="faq-answer">可以，空格和特殊字符会被忽略——只计算字母。</div>
            </div>
            <div class="copyright">© <?= date('Y') ?> gematriacalculators.org</div>
        </footer>
    </div>
    <script src="/scripts/index.js"></script>
</body>
</html>
