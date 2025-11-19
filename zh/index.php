<?php
  // zh/index.php - Chinese version
  require_once __DIR__ . '/../calculate.php';
  require_once __DIR__ . '/../helpers.php';

  $inputRaw = $_GET['input'] ?? '';
  $results  = $inputRaw !== '' ? gematria($inputRaw) : null;

  $SITE_NAME = '数字占卜计算器';
  $BASE_URL = BASE_URL; // Define variable from constant

  $displayInput = trim($inputRaw); // BASE_URL is defined in helpers.php
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
    $pageTitle = '免费数字命理计算器 — Gematrix 和命理学 | ' . $SITE_NAME;
  }

  $metaDescription = '最好的免费Gematria计算器。使用我们的gematrix和命理学工具获得即时准确的结果，支持英语、希伯来语和简单Gematria。非常适合圣经分析和解码数值。';

  $canonicalUrl = $BASE_URL . 'zh/';
  if (!empty($inputRaw)) {
    $canonicalUrl .= '?input=' . rawurlencode($inputRaw);
  }

  $ogTitle = ($results && !empty($displayInput))
    ? sprintf('%s — 数字占卜值: %s', $displayInput, (string)$results['english']['total'])
    : '免费数字命理计算器 — Gematrix 和命理学';

  $ogImage = $BASE_URL . 'assets/preview.jpg';

  $loadingPhrases = [
    "将文字转化为数字...",
    "召唤创世的密码...",
    "解码隐藏的数字模式...",
    "将字母与神圣价值对齐...",
    "计算您的gematria序列...",
    "追踪您名字的振动总和...",
    "揭示数字中的秘密含义..."
  ];
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
    <link rel="alternate" hreflang="vi" href="<?= $BASE_URL . 'vi/' . ltrim($qs, '?') ?>">
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

    <!-- Google AdSense -->
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4198904821948931" crossorigin="anonymous"></script>

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
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
    <?php require_once __DIR__ . '/../navigation/header.php'; ?>
    <div class="container">
        <!-- Language Support Info -->
        <div class="language-support-info" style="background: #f0f8ff; padding: 12px; margin: 2px 0 10px 0; border-radius: 8px; text-align: center; border: 1px solid #cce5ff;">
          <p style="margin: 0; color: #004085; font-size: 13px;">
                🌍 感谢您的信任！我们现在支持多种语言：
                <span title="English">英语</span>、
                <span title="Русский">俄语</span>、
                <span title="Deutsch">德语</span>、
                <span title="Español">西班牙语</span>、
                <span title="Português">葡萄牙语</span>、
                <span title="Italiano">意大利语</span>、
                <span title="עברית">希伯来语</span>、
                <span title="Polski">波兰语</span>和
                <strong>中文</strong>和
                <span title="Tiếng Việt">越南语</span>！
            </p>
        </div>

        <div class="recent-phrases ticker-bar">
            <h4>最近搜索：</h4>
            <button class="lang-change-btn">切换语言</button>
            <div class="ticker"><div class="ticker__list"></div></div>
        </div>
        <header class="header">
            <img src="/assets/talisman-header-icon.png" id="themeLogo" alt="数字占卜计算器图标">
            <h1>Gematria 计算器 (Gematrix)</h1>
            <p class="subtitle">（输入一个单词、名字或数字，如：神、圣经、希伯来文 - 在线计算gematria值）</p>
        </header>
        <main class="calculator">
            <div class="input-group">
                <input id="inputText" type="text" placeholder="计算我名字的gematria..." value="<?= htmlspecialchars($inputRaw, ENT_QUOTES, 'UTF-8') ?>" />
                <button class="secondary" onclick="clearInput()" title="清除">✕</button>
            </div>
            <div class="button-container">
                <button class="calculate-btn" onclick="calculate()">计算 Gematria</button>
                <button class="download-btn" onclick="calculateAndDownload()">下载PDF</button>
                <a href="/decode-gematria-value.php" class="decode-btn">解码 Gematria</a>
            </div>
            <div class="loading-container" id="loading" style="display:none">
                <div class="spinner"></div>
                <p id="loadingMessage" class="loading-message"></p>
            </div>
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
                <div class="promotion-box">
                    <div class="promo-icon" style="font-size: 2.5rem; color: var(--primary-color); flex-shrink: 0;">
                        <i class="fa-solid fa-wand-magic-sparkles"></i>
                    </div>
                    <div class="promo-content" style="text-align: center;">
                        <p style="margin: 0; font-weight: 600; font-size: 1.05em;">扩展您的视野，超越数字</p>
                        <p style="margin: 6px 0 0 0; font-size: 0.9em;">虽然gematria揭示了您生活中的隐藏数字代码，但塔罗牌提供了另一条通往智慧的道路。将数字的逻辑与卡牌的直觉相结合，以获得更完整的视角。从我们的免费每日塔罗牌阅读器中寻求指导，以补充您的旅程。</p>
                    </div>
                    <a href="https://tarotcardgenerator.online/" target="_blank" class="promo-btn" style="white-space: nowrap; margin-top: 1rem;">
                        获取免费塔罗牌解读
                    </a>
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
        </div>

        <!-- SEO SECTION #2 -->
        <div class="seo-section">
            <p>我们最好的<strong>gematria计算器</strong>（通常称为<strong>gematrix</strong>或<strong>gmetrix计算器</strong>）旨在提供准确性和简便性。它非常适合学者、精神探索者或任何对神圣文本感兴趣的人。使用我们最好的<strong>希伯来gematria计算器</strong>，您可以使用我们的<strong>gematria解码器</strong>分析精神名称或探索深奥的联系。今天就免费试用最<strong>简单的gematria计算器</strong>，自信地探索数字世界。这是Gematrix.org的一个很好的替代品。</p>
        </div>

        <hr class="divider">
        <br>

        <!-- GLOBAL FEEDBACK BANNER -->
        <div class="global-feedback-message" id="globalFeedback"></div>

        <!-- Recent Searches -->
        <div class="recent-phrases">
            <h4>最近搜索：</h4>
            <a href="#">圣经</a> |
            <a href="#">埃洛希姆频率432</a> |
            <a href="#">雅威的圣光</a> |
            <a href="#">土星</a> |
            <a href="#">显而易见的隐藏真相</a> |
            <a href="#">梅塔特隆用数字说话</a> |
            <a href="#">永远和平胜过混乱</a>
        </div>
        <div class="seo-section">
            <p>我们的计算器准确、快速且易于使用。完美适合研究者、灵性探索者以及所有对数字及其秘密感兴趣的人。</p>
        </div>
        <hr class="divider"><br>
        <div class="global-feedback-message" id="globalFeedback"></div>

        <!-- Language Popup -->
        <div class="lang-popup">
            <div class="lang-popup-content">
                <button class="lang-popup-close" onclick="closeLangPopup()">&times;</button>
                <h4>选择语言</h4>
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
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)"><span>什么是Gematria？</span><svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg></div>
                <div class="faq-answer">Gematria是一种字母数字代码，它根据字母为一个名称、单词或短语分配一个数值。它常用于犹太神秘主义和圣经解释。</div>
            </div>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)"><span>什么是gematria计算器？</span><svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg></div>
                <div class="faq-answer">一个<strong>免费的gematria计算器</strong>是一个在线工具，可以自动计算一个单词或短语的数值。它作为一个现代的<strong>gematria生成器</strong>，基于古老的命理学系统。</div>
            </div>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)"><span>如何在线使用Gematria计算器？</span><svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg></div>
                <div class="faq-answer">要使用我们最好的<strong>免费在线gematria计算器</strong>，只需在输入框中输入一个单词或短语，然后点击“计算Gematria”即可生成其在希伯来语、英语和简单系统中的数值。</div>
            </div>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)"><span>如何理解简单Gematria计算器？</span><svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg></div>
                <div class="faq-answer">我们的<strong>简单gematria计算器</strong>分配A=1, B=2, C=3, … Z=26，然后将这些值相加。输入像“Truth”这样的单词，它会输出总和，您可以将其与其他具有相同值的单词进行比较。</div>
            </div>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)"><span>如何使用圣经gematria计算器？</span><svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg></div>
                <div class="faq-answer">我们的<strong>圣经gematria计算器</strong>专为分析圣经文本和名称而设计。您将立即获得<strong>希伯来语、英语和简单gematria</strong>的值。我们的计算器支持希伯来字符，使其成为<strong>圣经研究的最佳gematria计算器</strong>。我们还支持<strong>希腊gematria计算器</strong>的原则。</div>
            </div>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)"><span>gematria搜索引擎如何工作？</span><svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg></div>
                <div class="faq-answer">我们的<strong>gematria搜索引擎</strong>和<strong>gematria解码器</strong>允许您查找具有特定数值的单词。您可以使用<strong>希伯来语、英语或简单gematria</strong>系统进行搜索。</div>
            </div>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)"><span>我可以计算带空格的短语吗？</span><svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg></div>
                <div class="faq-answer">是的！这个<strong>gematria名称计算器</strong>会自动忽略空格和特殊字符。我们为所有用户免费提供<strong>gematria计算器名称和含义</strong>的支持。</div>
            </div>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)"><span>什么是英语gematria计算器？</span><svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg></div>
                <div class="faq-answer"><strong>英语Gematria计算器</strong>为英文字母分配数值。我们的<strong>gematria英语计算器</strong>使用各种密码，如简单Gematria（A=1, B=2），以揭示隐藏的意义层次。</div>
            </div>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)"><span>谁应该使用gematria计算器？</span><svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg></div>
                <div class="faq-answer">
                    <strong>命理学gematria计算器</strong>适合任何对语言隐藏的数字结构感到好奇的人。它非常适合：
                    <ul>
                        <li>探索圣经等神圣文本的精神探索者。</li>
                        <li>寻找创作灵感和象征深度的作家和艺术家。</li>
                        <li>对古代解释方法感兴趣的历史爱好者。</li>
                        <li>分析姓名、日期和概念的命理学爱好者。</li>
                        <li>任何喜欢解谜和在周围世界中寻找隐藏模式的人。</li>
                    </ul>
                </div>
            </div>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)"><span>什么是犹太gematria计算器？</span><svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg></div>
                <div class="faq-answer"><strong>犹太Gematria计算器</strong>（或<strong>希伯来Gematria计算器</strong>）基于为希伯来字母分配数值的犹太传统。这种类型的<strong>gematria希伯来计算器</strong>对于研究圣经名称和概念的数值至关重要。</div>
            </div>
            <div class="copyright">© <?= date('Y') ?> gematriacalculators.org</div>
        </footer>
    </div>
    <script src="/scripts/index.js"></script>
    <script>
      window.GematriaLang = {
        loadingPhrases: <?= json_encode($loadingPhrases) ?>
      };
    </script>
</body>
</html>
