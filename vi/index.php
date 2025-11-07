<?php
  // vi/index.php - Vietnamese version
  require_once __DIR__ . '/../calculate.php';
  require_once __DIR__ . '/../helpers.php';

  $inputRaw = $_GET['input'] ?? '';
  $results  = $inputRaw !== '' ? gematria($inputRaw) : null;

  $SITE_NAME = 'Máy tính Gematria';
  $BASE_URL = BASE_URL; 

  $displayInput = trim($inputRaw);
  if ($displayInput !== '') {
    $displayInput = mb_strimwidth($displayInput, 0, 60, '…', 'UTF-8');
  }

  if ($results && isset($results['english']['total'])) {
    $pageTitle = sprintf(
      '%s — Giá trị Gematria: %s | %s',
      ucfirst($displayInput),
      (string)$results['english']['total'],
      $SITE_NAME
    );
  } else {
    $pageTitle = 'Máy tính Gematria Miễn phí — Tiếng Do Thái, Tiếng Anh & Đơn giản | ' . $SITE_NAME;
  }

  $metaDescription = 'Máy tính Gematria trực tuyến miễn phí cho các hệ thống tiếng Do Thái, tiếng Anh và đơn giản. Tính toán ngay lập tức các giá trị và ý nghĩa gematria cho bất kỳ từ hoặc cụm từ nào.';

  $canonicalUrl = $BASE_URL . 'vi/';
  if (!empty($inputRaw)) {
    $canonicalUrl .= '?input=' . rawurlencode($inputRaw);
  }

  $ogTitle = ($results && !empty($displayInput))
    ? sprintf('%s — Giá trị Gematria: %s', $displayInput, (string)$results['english']['total'])
    : 'Máy tính Gematria Miễn phí';

  $ogImage = $BASE_URL . 'assets/preview.jpg';
?>

<!DOCTYPE html>
<html lang="vi" data-theme="light">
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

    <meta name="keywords" content="máy tính gematria, gematria tiếng do thái, gematria tiếng anh, gematria đơn giản">

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
      "name": "Máy tính Gematria",
      "url": "<?= htmlspecialchars($BASE_URL . 'vi/', ENT_QUOTES, 'UTF-8'); ?>",
      "description": "Máy tính Gematria trực tuyến miễn phí cho các hệ thống tiếng Do Thái, tiếng Anh và đơn giản.",
      "applicationCategory": "Calculator",
      "operatingSystem": "Any",
      "inLanguage": "vi"
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
                🌍 Cảm ơn sự tin tưởng của bạn! Chúng tôi hiện hỗ trợ nhiều ngôn ngữ: 
                <span title="English">Tiếng Anh</span>, 
                <span title="Русский">Tiếng Nga</span>, 
                <span title="Deutsch">Tiếng Đức</span>, 
                <span title="Español">Tiếng Tây Ban Nha</span>, 
                <span title="Português">Tiếng Bồ Đào Nha</span>, 
                <span title="Italiano">Tiếng Ý</span>, 
                <span title="עברית">Tiếng Do Thái</span>, 
                <span title="Polski">Tiếng Ba Lan</span>, 
                <span title="中文">Tiếng Trung</span> và
                <strong>Tiếng Việt</strong>!
            </p>
        </div>

        <!-- ——— Recent Searches Ticker ——— -->
        <div class="recent-phrases ticker-bar">
            <h4>Tìm kiếm gần đây:</h4>

            <div class="ticker">
                <div class="ticker__list">
                <!-- JS will inject .ticker__item cards here -->
                </div>
            </div>
        </div>

        <header class="header">
            <img src="/assets/talisman-header-icon.png" id="themeLogo" alt="logo trang web máy tính gematria">
            <h1>Máy tính Gematria</h1>
            <p class="subtitle">(Nhập một từ hoặc một số, ví dụ: Chúa, Kinh Thánh, Tiếng Do Thái, Thánh – để tính giá trị gematria)</p>
        </header>

        <main class="calculator">
            <div class="input-group">
                <input
                    id="inputText"
                    type="text"
                    placeholder="Nhập văn bản để tính toán..."
                    value="<?= htmlspecialchars($inputRaw, ENT_QUOTES, 'UTF-8') ?>"
                />
                <button class="secondary" onclick="clearInput()" title="Xóa">✕</button>
            </div>

            <div class="button-container">
                <button class="calculate-btn" onclick="calculate()">Tính toán</button>
                <button class="download-btn" onclick="calculateAndDownload()">Tải xuống PDF</button>
                <a href="/vi/decode-gematria-value/" class="decode-btn">Giải mã Gematria</a>
            </div>

            <div class="loading-container" id="loading" style="display:none">
                <div class="spinner"></div>
            </div>

            <div class="result" id="result" style="<?= $results ? 'display:block;' : 'display:none;' ?>">
                <div class="result-card">
                    <button class="copy-btn" onclick="copyValue('hebrewValue','hebrewCopyNotification')">
                        <i class="fa-regular fa-copy"></i>
                    </button>
                    <div class="copy-notification" id="hebrewCopyNotification">Đã sao chép!</div>
                    <h3>Gematria tiếng Do Thái: <span id="hebrewValue">
                    <?= $results['hebrew']['total'] ?? 0 ?>
                    </span></h3>
                    <p id="hebrewBreakdown">
                    <?php if($results): ?>
                        Phép tính: <?= implode(' + ', $results['hebrew']['breakdown']) ?>
                    <?php endif ?>
                    </p>
                </div>

                <div class="result-card">
                    <button class="copy-btn" onclick="copyValue('englishValue','englishCopyNotification')">
                        <i class="fa-regular fa-copy"></i>
                    </button>
                    <div class="copy-notification" id="englishCopyNotification">Đã sao chép!</div>
                    <h3>Gematria tiếng Anh: <span id="englishValue">
                    <?= $results['english']['total'] ?? 0 ?>
                    </span></h3>
                    <p id="englishBreakdown">
                    <?php if($results): ?>
                        Phép tính: (<?= implode(' + ', $results['simple']['breakdown']) ?>) × 6
                    <?php endif ?>
                    </p>
                </div>

                <div class="result-card">
                    <button class="copy-btn" onclick="copyValue('simpleValue','simpleCopyNotification')">
                        <i class="fa-regular fa-copy"></i>
                    </button>
                    <div class="copy-notification" id="simpleCopyNotification">Đã sao chép!</div>
                    <h3>Gematria đơn giản: <span id="simpleValue">
                    <?= $results['simple']['total'] ?? 0 ?>
                    </span></h3>
                    <p id="simpleBreakdown">
                    <?php if($results): ?>
                        Phép tính: <?= implode(' + ', $results['simple']['breakdown']) ?>
                    <?php endif ?>
                    </p>
                </div>

                <div class="feedback">
                    <p>Máy tính này có hữu ích không?</p>
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
            Để có phản hồi, đề xuất hoặc cải tiến cho công cụ này, vui lòng gửi email cho chúng tôi tại <a href="mailto:admins@gematriacalculators.org" style="color: var(--error); text-decoration: underline;">admins@gematriacalculators.org</a>.
        </p>

        <!-- SEO SECTION #1 -->
        <div class="seo-section">
            <h4>Khám phá ý nghĩa số bị ẩn</h4>
            <p>Máy tính gematria trực tuyến miễn phí này hoạt động như một máy tính tên gematria mạnh mẽ và hỗ trợ chuyển đổi gematria từ tiếng Anh sang tiếng Do Thái. Cho dù bạn đang tìm kiếm một máy tính gematria trực tuyến để phân tích kinh thánh hay chỉ là một phép tính gematria đơn giản để khám phá ý nghĩa của các con số, công cụ này được thiết kế dành cho bạn.</p>
            <div class="example">Ví dụ: <strong>Kinh Thánh</strong> = 38 (Tiếng Do Thái), 180 (Tiếng Anh), 30 (Đơn giản)</div>
        </div>

        <!-- SEO SECTION #2 -->
        <div class="seo-section">
            <p>Máy tính gematria tốt nhất của chúng tôi trực tuyến được thiết kế cho độ chính xác, tốc độ và sự đơn giản. Nó hoàn hảo cho các học giả, những người tìm kiếm tâm linh, hoặc bất kỳ ai quan tâm đến các truyền thống thần bí đằng sau các văn bản thiêng liêng. Với máy tính gematria tiếng Do Thái của chúng tôi, bạn có thể giải mã các đoạn kinh thánh, phân tích các tên tâm linh, hoặc khám phá các kết nối bí truyền — tất cả ở một nơi.</p>
        </div>

        <hr class="divider">
        <br>

        <!-- GLOBAL FEEDBACK BANNER -->
        <div class="global-feedback-message" id="globalFeedback"></div>

        <!-- Language Popup -->
        <div class="lang-popup">
            <div class="lang-popup-content">
                <button class="lang-popup-close" onclick="closeLangPopup()">&times;</button>
                <h4>Chọn ngôn ngữ</h4>
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

        <!-- FAQ & FOOTER -->
        <footer class="footer">
            <!-- FAQ ITEMS -->
            <h2 class="faq-heading">Các câu hỏi thường gặp</h2>
            <div class="faq-item">
                <div class="faq-question">
                    <span>Gematria là gì?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">
                    Gematria là một mã chữ-số gán một giá trị số cho một tên, từ hoặc cụm từ dựa trên các chữ cái của nó. Nó thường được sử dụng trong thần bí Do Thái và giải thích Kinh Thánh.
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <span>Máy tính gematria là gì?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">
                    Một công cụ hoặc phần mềm máy tính gematria trực tuyến miễn phí tự động tính toán giá trị số của một từ, cụm từ hoặc tên bằng cách gán giá trị số cho mỗi chữ cái, dựa trên các hệ thống gematria cụ thể.
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <span>Làm thế nào để sử dụng Máy tính Gematria trực tuyến?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">
                    Để sử dụng máy tính gematria trực tuyến miễn phí tốt nhất của chúng tôi, chỉ cần nhập một từ, cụm từ hoặc tên vào hộp nhập liệu, sau đó nhấp vào “Tính toán” để tạo ra các giá trị số của nó trên các hệ thống tiếng Do Thái, tiếng Anh và đơn giản. Để lưu lại, bạn cũng có thể tải xuống báo cáo PDF.
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <span>Làm thế nào để hiểu Máy tính Gematria đơn giản?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">
                    Máy tính gematria đơn giản của chúng tôi gán A=1, B=2, C=3, … Z=26, sau đó cộng các giá trị đó lại. Nhập một từ như “Sự thật” và nó sẽ xuất ra tổng, bạn có thể so sánh với các từ khác có cùng giá trị.
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <span>Làm cách nào để sử dụng máy tính gematria Kinh Thánh?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">
                    Máy tính gematria Kinh Thánh của chúng tôi được thiết kế để phân tích các văn bản và tên trong Kinh Thánh. Chỉ cần nhập bất kỳ từ hoặc cụm từ nào từ Kinh Thánh, và bạn sẽ nhận được ngay các giá trị gematria tiếng Do Thái, tiếng Anh và đơn giản. Máy tính của chúng tôi hỗ trợ cả ký tự tiếng Do Thái hiện đại và Kinh Thánh, làm cho nó trở thành máy tính gematria tốt nhất cho nghiên cứu Kinh Thánh.
                </div>
            </div>
            
            <div class="faq-item">
                <div class="faq-question">
                    <span>Công cụ tìm kiếm gematria hoạt động như thế nào?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">
                    Công cụ tìm kiếm gematria của chúng tôi cho phép bạn tìm các từ và cụm từ có giá trị số cụ thể. Bạn có thể tìm kiếm bằng các hệ thống gematria tiếng Do Thái, tiếng Anh hoặc đơn giản. Tính năng này đặc biệt hữu ích cho nghiên cứu Kinh Thánh và tìm kiếm mối liên hệ giữa các từ và khái niệm khác nhau.
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <span>Tôi có thể tính các cụm từ có dấu cách không?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">
                    Có! Máy tính tên gematria này tự động bỏ qua dấu cách và các ký tự đặc biệt, chỉ tập trung vào các chữ cái. Chúng tôi hỗ trợ máy tính tên và ý nghĩa gematria cho tất cả người dùng mọi lúc 24*7 miễn phí. Máy tính của chúng tôi đặc biệt hữu ích để phân tích các cụm từ nhiều từ từ các văn bản tôn giáo.
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <span>Máy tính gematria tiếng Anh là gì?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">
                    Một <strong>Máy tính Gematria tiếng Anh</strong> là một công cụ gán giá trị số cho các chữ cái trong bảng chữ cái tiếng Anh. Không giống như tiếng Do Thái, tiếng Anh không có một hệ thống cổ xưa duy nhất, vì vậy các máy tính sử dụng nhiều mật mã khác nhau như Gematria đơn giản (A=1, B=2), Thứ tự đảo ngược (A=26, B=25), và Rút gọn. Điều này cho phép bạn khám phá các mẫu số và các kết nối biểu tượng giữa các từ, tên và cụm từ tiếng Anh, tiết lộ các lớp ý nghĩa ẩn giấu.
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <span>Ai nên sử dụng máy tính gematria?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">
                    Một <strong>máy tính gematria</strong> dành cho bất kỳ ai tò mò về cấu trúc số ẩn của ngôn ngữ. Nó hoàn hảo cho:
                    <ul>
                        <li><strong>Những người tìm kiếm tâm linh</strong> khám phá các văn bản thiêng liêng như Kinh Thánh.</li>
                        <li><strong>Nhà văn và nghệ sĩ</strong> tìm kiếm nguồn cảm hứng sáng tạo và chiều sâu biểu tượng.</li>
                        <li><strong>Những người yêu thích lịch sử</strong> quan tâm đến các phương pháp giải thích cổ xưa.</li>
                        <li><strong>Những người đam mê số học</strong> phân tích tên, ngày tháng và các khái niệm.</li>
                        <li><strong>Bất kỳ ai yêu thích câu đố</strong> và tìm kiếm các mẫu ẩn trong thế giới xung quanh họ.</li>
                    </ul>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <span>Máy tính gematria Do Thái là gì?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">
                    Một <strong>Máy tính Gematria Do Thái</strong> (hoặc Máy tính Gematria tiếng Do Thái) là một công cụ dựa trên truyền thống Do Thái cổ xưa về việc gán giá trị số cho 22 chữ cái của bảng chữ cái tiếng Do Thái. Nó chủ yếu sử dụng hệ thống <em>Mispar Hechrechi</em> (Tiêu chuẩn), là nền tảng cho Kabbalah và việc giải thích Torah. Loại máy tính này rất cần thiết để nghiên cứu các giá trị số của tên, khái niệm và câu Kinh Thánh để khám phá các mối liên hệ thần học và thần bí sâu sắc hơn.
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
            <button class="modal-close" id="exitModalClose" aria-label="Đóng Modal">
                <i class="fa-solid fa-circle-xmark"></i>
            </button>
            <h2><i class="fa-solid fa-star text-primary"></i> Đừng rời đi vội!</h2>
            <p>Bạn đã thử các công cụ mới thú vị của chúng tôi chưa?</p>
            <div class="modal-links">
                <a href="https://vpnleaderboard.com/" class="outline-button">
                    <i class="fa-solid fa-shield-halved"></i> Bảng xếp hạng VPN
                </a>
                <a href="http://tarotcardgenerator.online/" class="outline-button">
                    <i class="fa-solid fa-wand-magic-sparkles"></i> Người đọc Tarot hàng ngày
                </a>
                <a href="https://www.snowdayscalculatorai.com/" class="outline-button">
                    <i class="fa-solid fa-snowflake"></i> Máy tính ngày tuyết rơi ở Mỹ
                </a>
            </div>
            <p style="margin-top: 1rem;">
                <i class="fa-solid fa-face-smile-wink fa-lg text-primary"></i>
                Hãy tận hưởng và sớm quay lại nhé!
            </p>
        </div>
    </div>

    <script src="/scripts/index.js"></script>

</body>
</html>