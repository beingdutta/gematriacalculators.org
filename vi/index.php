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
    $pageTitle = 'Máy tính Gematria Miễn phí — Gematrix & Numerology | ' . $SITE_NAME;
  }

  $metaDescription = 'Máy tính Gematria miễn phí cho kết quả tức thì. Công cụ gematrix của chúng tôi hỗ trợ Gematria tiếng Anh, Do Thái & Đơn giản. Giải mã ý nghĩa tên và từ ngay hôm nay!';

  $canonicalUrl = $BASE_URL . 'vi/';
  if (!empty($inputRaw)) {
    $canonicalUrl .= '?input=' . rawurlencode($inputRaw);
  }

  $ogTitle = ($results && !empty($displayInput))
    ? sprintf('%s — Giá trị Gematria: %s', $displayInput, (string)$results['english']['total'])
    : 'Máy tính Gematria Miễn phí — Gematrix & Numerology';

  $ogImage = $BASE_URL . 'assets/preview.jpg';

  $loadingPhrases = [
    "Đang dịch từ ngữ thành những con số...",
    "Triệu hồi những mật mã của tạo hóa...",
    "Giải mã những mẫu số ẩn giấu...",
    "Sắp xếp các chữ cái với giá trị thiêng liêng...",
    "Tính toán chuỗi gematria của bạn...",
    "Truy tìm tổng rung động của tên bạn...",
    "Tiết lộ ý nghĩa bí mật trong những con số..."
  ];
?>

<!DOCTYPE html>
<html lang="vi" data-theme="light">
<head>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/navigation/head-tracking.php'; ?>

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
    <link rel="stylesheet" href="/styles/more-tools.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>
</head>

<body>
    <?php require_once __DIR__ . '/../navigation/header.php'; ?>
    
    <div class="container">
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
            <h1>Máy tính Gematria (Gematrix)</h1>
            <p class="subtitle">(Nhập một từ, tên hoặc số, ví dụ: Chúa, Kinh Thánh, Tiếng Do Thái – để tính giá trị gematria trực tuyến)</p>
        </header>

        <main class="calculator">
            <div class="input-group">
                <input
                    id="inputText"
                    type="text"
                    placeholder="Tính gematria của tên tôi..."
                    value="<?= htmlspecialchars($inputRaw, ENT_QUOTES, 'UTF-8') ?>"
                />
                <button class="secondary" onclick="clearInput()" title="Xóa">✕</button>
            </div>

            <div class="button-container">
                <button class="calculate-btn" onclick="calculate()">Tính Gematria</button>
                <button class="download-btn" onclick="calculateAndDownload()">Tải xuống PDF</button>
                <a href="/decode-gematria-value.php" class="decode-btn">Giải mã Gematria</a>
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
            <h2>Khám phá thêm các công cụ để được hướng dẫn hàng ngày</h2>
            <div class="tool-grid">
                <?php
                    $tools = [
                        ['title' => 'Máy tính điểm Vastu đơn giản', 'desc' => 'Nhận điểm tuân thủ Vastu nhanh chóng cho ngôi nhà của bạn.', 'icon' => '<i class="fa-solid fa-house"></i>', 'url' => '/more-tools/simple-vastu-score-calculator.php'],
                        ['title' => 'Máy tính số Kua', 'desc' => 'Tìm hướng may mắn theo Phong thủy để thành công.', 'icon' => '<i class="fa-solid fa-compass"></i>', 'url' => '/more-tools/kua-number-calculator.php'],
                        ['title' => 'Bộ giải mã số thiên thần', 'desc' => 'Khám phá thông điệp từ vũ trụ trong các con số.', 'icon' => '<i class="fa-solid fa-wand-magic-sparkles"></i>', 'url' => '/more-tools/angel-number-decoder.php'],
                        ['title' => 'Máy tính số đường đời', 'desc' => 'Khám phá vận mệnh cốt lõi của bạn từ ngày sinh.', 'icon' => '<i class="fa-solid fa-route"></i>', 'url' => '/more-tools/life-path-number-calculator.php'],
                        ['title' => 'Máy tính lưới Lạc Thư', 'desc' => 'Lập bản đồ lưới năng lượng số học của bạn.', 'icon' => '<i class="fa-solid fa-table-cells"></i>', 'url' => '/more-tools/loshu-grid.php'],
                        ['title' => 'Máy tính thần số học theo tên', 'desc' => 'Tính toán các con số Định mệnh và Thôi thúc Linh hồn của bạn.', 'icon' => '<i class="fa-solid fa-signature"></i>', 'url' => '/more-tools/name-numerology-calculator.php'],
                    ];

                    foreach ($tools as $tool) {
                        echo '
                        <div class="tool-card">
                            <div class="tool-icon">'.$tool['icon'].'</div>
                            <h3>'.$tool['title'].'</h3>
                            <p>'.$tool['desc'].'p>
                            <a href="'.$tool['url'].'" class="calculate-btn">Mở Công cụ</a>
                        </div>';
                    }
                ?>
            </div>
        </section>
        <?php
        $moreToolsHtml = ob_get_clean();
        ?>

        <div class="result" id="result" style="<?= $results ? 'display:block;' : 'display:none;' ?>">
            <h2 id="resultHeader" style="text-align: center; margin-bottom: 2rem; font-size: 1.2rem; font-weight: 600; background-color: var(--background-alt); padding: 0.75rem 1rem; border-radius: var(--radius); border: 1px solid var(--border-color); box-shadow: 0 2px 4px rgba(0,0,0,0.05);">Kết quả Gematria cho: <span style="color: var(--primary-color);"><?= htmlspecialchars($displayInput) ?></span></h2>
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

            <div class="button-container" style="margin-top: 2rem; justify-content: center; gap: 15px;">
                <button class="download-btn" onclick="calculateAndDownload()">Tải xuống PDF</button>
                <button class="calculate-btn" onclick="calculateAgain()">Tính lại</button>
            </div>


            <!-- More Tools (Result View) -->
            <div id="more-tools-result" style="<?= $results ? 'display:block;' : 'display:none;' ?>">
                <?= $moreToolsHtml ?>
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

        <p class="note" style="color: var(--error); font-weight: 400; margin-top: 0.75rem; text-align: center;">
            Để có phản hồi, đề xuất hoặc cải tiến cho công cụ này, vui lòng gửi email cho chúng tôi tại <a href="mailto:admins@gematriacalculators.org" style="color: var(--error); text-decoration: underline;">admins@gematriacalculators.org</a>.
        </p>

        <!-- SEO SECTION #1 -->
        <div class="seo-section">
            <h4>Khám phá ý nghĩa số bị ẩn</h4>
            <p>Máy tính gematria trực tuyến miễn phí này hoạt động như một máy tính tên gematria mạnh mẽ và hỗ trợ chuyển đổi gematria từ tiếng Anh sang tiếng Do Thái. Cho dù bạn đang tìm kiếm một máy tính gematria trực tuyến để phân tích kinh thánh hay chỉ là một phép tính gematria đơn giản để khám phá ý nghĩa của các con số, công cụ này được thiết kế dành cho bạn. Người dùng thường tìm kiếm "máy tính gematria" hoặc "gematria calculater", và công cụ của chúng tôi đáp ứng nhu cầu đó.</p>
            <div class="example">Ví dụ: Kinh Thánh = 38 (Tiếng Do Thái), 180 (Tiếng Anh), 30 (Đơn giản)</div>
        </div>

        <!-- More Tools (Original View) -->
        <div id="more-tools-original" style="<?= $results ? 'display:none;' : 'display:block;' ?>">
            <?= $moreToolsHtml ?>
        </div>

        <!-- SEO SECTION #2 -->
        <div class="seo-section">
            <p>Máy tính gematria tốt nhất của chúng tôi (thường được gọi là gematrix) được thiết kế cho độ chính xác và sự đơn giản. Nó hoàn hảo cho các học giả, những người tìm kiếm tâm linh, hoặc bất kỳ ai quan tâm đến các văn bản thiêng liêng. Với máy tính gematria tiếng Do Thái của chúng tôi, bạn có thể sử dụng bộ giải mã gematria của chúng tôi để phân tích các tên tâm linh hoặc khám phá các kết nối bí truyền. Hãy thử máy tính gematria đơn giản miễn phí ngay hôm nay và đắm mình vào thế giới của những con số một cách tự tin. Đây là một sự thay thế tuyệt vời cho Gematrix.org.</p>
        </div>

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

        <!-- FAQ Section -->
        <section class="faq-section">
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
                    Một máy tính gematria miễn phí là một công cụ trực tuyến tự động tính toán giá trị số của một từ hoặc cụm từ. Nó hoạt động như một bộ tạo gematria hiện đại dựa trên các hệ thống số học cổ đại.
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <span>Làm thế nào để sử dụng Máy tính Gematria trực tuyến?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">
                    Để sử dụng máy tính gematria trực tuyến miễn phí tốt nhất của chúng tôi, chỉ cần nhập một từ hoặc cụm từ vào hộp nhập liệu, sau đó nhấp vào “Tính Gematria” để tạo ra các giá trị số của nó trên các hệ thống tiếng Do Thái, tiếng Anh và đơn giản.
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
                    Máy tính gematria Kinh Thánh của chúng tôi được thiết kế để phân tích các văn bản và tên trong Kinh Thánh. Bạn sẽ nhận được ngay các giá trị gematria tiếng Do Thái, tiếng Anh và đơn giản. Máy tính của chúng tôi hỗ trợ ký tự tiếng Do Thái, làm cho nó trở thành máy tính gematria tốt nhất cho nghiên cứu Kinh Thánh. Chúng tôi cũng hỗ trợ các nguyên tắc của máy tính gematria Hy Lạp.
                </div>
            </div>
            
            <div class="faq-item">
                <div class="faq-question">
                    <span>Công cụ tìm kiếm gematria hoạt động như thế nào?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">
                    Công cụ tìm kiếm gematria và bộ giải mã gematria của chúng tôi cho phép bạn tìm các từ có giá trị số cụ thể. Bạn có thể tìm kiếm bằng các hệ thống gematria tiếng Do Thái, tiếng Anh hoặc đơn giản.
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <span>Tôi có thể tính các cụm từ có dấu cách không?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">
                    Có! Máy tính tên gematria này tự động bỏ qua dấu cách và các ký tự đặc biệt. Chúng tôi hỗ trợ máy tính tên và ý nghĩa gematria cho tất cả người dùng miễn phí.
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <span>Máy tính gematria tiếng Anh là gì?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">
                    Một Máy tính Gematria tiếng Anh gán giá trị số cho các chữ cái trong bảng chữ cái tiếng Anh. Máy tính gematria tiếng Anh của chúng tôi sử dụng nhiều mật mã khác nhau như Gematria đơn giản (A=1, B=2) để tiết lộ các lớp ý nghĩa ẩn giấu.
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <span>Ai nên sử dụng máy tính gematria?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">
                    Một máy tính số học gematria dành cho bất kỳ ai tò mò về cấu trúc số ẩn của ngôn ngữ. Nó hoàn hảo cho:
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
                    Một Máy tính Gematria Do Thái (hoặc Máy tính Gematria tiếng Do Thái) dựa trên truyền thống Do Thái về việc gán giá trị số cho các chữ cái tiếng Do Thái. Loại máy tính gematria tiếng Do Thái này rất cần thiết để nghiên cứu các giá trị số của tên và khái niệm trong Kinh Thánh.
                </div>
            </div>
        </section>

        <!-- FOOTER -->
        <footer class="footer">
            <div class="copyright">
                © <?= date('Y') ?> gematriacalculators.org
            </div>
        </footer>
    </div>


    <script>
      window.GematriaLang = {
        loadingPhrases: <?= json_encode($loadingPhrases) ?>,
        resultHeaderPrefix: "Kết quả Gematria cho: "
      };
    </script>
    <script src="/scripts/index.js"></script>

</body>
</html>