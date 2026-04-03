<?php
  /* ------------  ru/index.php ------------- */
  require __DIR__ . '/../calculate.php';
  require_once __DIR__ . '/../helpers.php';

  $inputRaw = $_GET['input'] ?? '';
  $results  = $inputRaw !== '' ? gematria($inputRaw) : null;

  /* ─── Dynamic SEO ─── */
  if ($results) {
      $seoTitle = ucfirst($inputRaw).' — значение в гематрии '
                .$results['english']['total'].' | Онлайн-калькулятор гематрии';
      $seoDesc  = 'Узнайте еврейские, английские и простые значения слова «'
                .htmlspecialchars($inputRaw, ENT_QUOTES).'» мгновенно. '
                .'Hebrew='.$results['hebrew']['total']
                .', English='.$results['english']['total']
                .', Simple='.$results['simple']['total'].'.';
  } else {
      $seoTitle = 'Лучший Калькулятор Гематрии Онлайн | Бесплатный Gematrix, Имена и Библейская Нумерология';
      $seoDesc  = 'Лучший бесплатный калькулятор гематрии для русского, английского, еврейского и простой гематрии. Мгновенно вычисляйте значения слов, имен или фраз. Включает декодер гематрии, калькулятор имен и инструменты библейской нумерологии.';
  }

  $loadingPhrases = [
    "Перевод слов в числа...",
    "Призыв кодов творения...",
    "Расшифровка скрытых числовых узоров...",
    "Согласование букв с божественными значениями...",
    "Вычисление вашей последовательности гематрии...",
    "Отслеживание вибрационной суммы вашего имени...",
    "Раскрытие тайного смысла в числах..."
  ];
?>
<!DOCTYPE html>
<html lang="ru" data-theme="light">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title><?= $seoTitle ?></title>
    <meta name="description" content="<?= htmlspecialchars($seoDesc, ENT_QUOTES) ?>">

    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/navigation/head-tracking.php'; ?>


    <?php
      $base = 'https://gematriacalculators.org';
      $qs = !empty($_SERVER['QUERY_STRING']) ? '?' . $_SERVER['QUERY_STRING'] : '';
      $path = 'index.php' . $qs;
    ?>
    <meta name="keywords" content="лучший калькулятор гематрии, бесплатный калькулятор гематрии, калькулятор гематрии онлайн, калькулятор имен гематрии, библейская гематрия, декодер гематрии, гематрия онлайн, еврейская гематрия, английская гематрия, нумерология"> <!-- Language alternates -->
    <link rel="alternate" hreflang="en" href="<?= $base ?>/<?= $path ?>">
    <link rel="alternate" hreflang="de" href="<?= $base ?>/de/<?= $path ?>">
    <link rel="alternate" hreflang="es" href="<?= $base ?>/es/<?= $path ?>">
    <link rel="alternate" hreflang="it" href="<?= $base ?>/it/<?= $path ?>">
    <link rel="alternate" hreflang="iw" href="<?= $base ?>/iw/<?= $path ?>">
    <link rel="alternate" hreflang="pl" href="<?= $base ?>/pl/<?= $path ?>">
    <link rel="alternate" hreflang="pt" href="<?= $base ?>/pt/<?= $path ?>">
    <link rel="alternate" hreflang="ru" href="<?= $base ?>/ru/<?= $path ?>">
    <link rel="alternate" hreflang="zh" href="<?= $base ?>/zh/<?= $path ?>">
    <link rel="alternate" hreflang="vi" href="<?= $base ?>/vi/<?= $path ?>">
    <link rel="alternate" hreflang="x-default" href="<?= $base ?>/<?= $path ?>">
    
    <!-- Additional SEO meta tags for multilingual -->
    <meta property="og:locale" content="ru_RU" />
    <meta property="og:locale:alternate" content="en_US" />
    <meta property="og:locale:alternate" content="de_DE" />
    <meta property="og:locale:alternate" content="es_ES" />
    <meta property="og:locale:alternate" content="it_IT" />
    <meta property="og:locale:alternate" content="he_IL" />
    <meta property="og:locale:alternate" content="pl_PL" />
    <meta property="og:locale:alternate" content="pt_BR" />
    <meta property="og:locale:alternate" content="zh_CN" />
    <link rel="alternate" hreflang="x-default" href="<?= $base ?>/<?= $path ?>">

    <link rel="canonical" href="<?= $base ?>/ru/<?= $path ?>">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="icon" href="/assets/talisman-site-icon.png" sizes="32x32">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/styles/index.css">
    <link rel="stylesheet" href="/styles/more-tools.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>
    <script src="/scripts/index.js" defer></script>
  </head>

  <body>
    <?php require_once __DIR__ . '/../navigation/header.php'; ?>

    <div class="container">

      <!--–––– Recent Searches ticker ––––-->
      <div class="recent-phrases ticker-bar">
        <h4>Недавние запросы:</h4>

        <div class="ticker">
          <div class="ticker__list"><!-- JS вставит элементы --></div>
        </div>
      </div>

      <header class="header">
        <img src="/assets/talisman-header-icon.png" id="themeLogo" alt="логотип калькулятора гематрии">
        <h1>Калькулятор Гематрии (Gematrix)</h1>
        <p class="subtitle">(Введите слово, имя или число, например Бог, Библия, Иврит — чтобы вычислить значения гематрии онлайн)</p>
      </header>

      <main class="calculator">
        <div class="input-group">
          <input id="inputText"
                type="text"
                placeholder="Рассчитать гематрию моего имени..."
                value="<?= htmlspecialchars($inputRaw, ENT_QUOTES) ?>">
          <button class="secondary" onclick="clearInput()" title="Очистить">✕</button>
        </div>

        <div class="button-container">
          <button class="calculate-btn" onclick="calculate()">Рассчитать Гематрию</button>
          <button class="download-btn"  onclick="calculateAndDownload()">Скачать PDF</button>
          <a href="/decode-gematria-value.php" class="decode-btn">Расшифровать гематрию</a>
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
          <h2>Исследуйте больше инструментов для ежедневного руководства</h2>
          <div class="tool-grid">
              <?php
                  $tools = [
                      ['title' => 'Простой калькулятор оценки Васту', 'desc' => 'Получите быструю оценку соответствия Васту для вашего дома.', 'icon' => '<i class="fa-solid fa-house"></i>', 'url' => '/more-tools/simple-vastu-score-calculator.php'],
                      ['title' => 'Калькулятор числа Куа', 'desc' => 'Найдите свои счастливые направления по Фэн-шуй для успеха.', 'icon' => '<i class="fa-solid fa-compass"></i>', 'url' => '/more-tools/kua-number-calculator.php'],
                      ['title' => 'Декодер ангельских чисел', 'desc' => 'Раскройте послания вселенной в числах.', 'icon' => '<i class="fa-solid fa-wand-magic-sparkles"></i>', 'url' => '/more-tools/angel-number-decoder.php'],
                      ['title' => 'Калькулятор числа жизненного пути', 'desc' => 'Узнайте свою основную судьбу по дате рождения.', 'icon' => '<i class="fa-solid fa-route"></i>', 'url' => '/more-tools/life-path-number-calculator.php'],
                      ['title' => 'Калькулятор сетки Ло-шу', 'desc' => 'Составьте карту своей нумерологической энергетической сетки.', 'icon' => '<i class="fa-solid fa-table-cells"></i>', 'url' => '/more-tools/loshu-grid.php'],
                      ['title' => 'Калькулятор нумерологии имени', 'desc' => 'Рассчитайте свои числа Судьбы и Душевного стремления.', 'icon' => '<i class="fa-solid fa-signature"></i>', 'url' => '/more-tools/name-numerology-calculator.php'],
                  ];

                  foreach ($tools as $tool) {
                      echo '
                      <div class="tool-card">
                          <div class="tool-icon">'.$tool['icon'].'</div>
                          <h3>'.$tool['title'].'</h3>
                          <p>'.$tool['desc'].'</p>
                          <a href="'.$tool['url'].'" class="calculate-btn">Открыть инструмент</a>
                      </div>';
                  }
              ?>
          </div>
      </section>
      <?php
      $moreToolsHtml = ob_get_clean();
      ?>

      <div class="result" id="result" style="<?= $results ? 'display:block;' : 'display:none;' ?>">
        <h2 id="resultHeader" style="text-align: center; margin-bottom: 2rem; font-size: 1.2rem; font-weight: 600; background-color: var(--background-alt); padding: 0.75rem 1rem; border-radius: var(--radius); border: 1px solid var(--border-color); box-shadow: 0 2px 4px rgba(0,0,0,0.05);">Результат гематрии для: <span style="color: var(--primary-color);"><?= htmlspecialchars($displayInput) ?></span></h2>
        <!-- Hebrew -->
        <div class="result-card">
          <button class="copy-btn" onclick="copyValue('hebrewValue','hebrewCopyNotification')"><i class="fa-regular fa-copy"></i></button>
          <div class="copy-notification" id="hebrewCopyNotification">Скопировано!</div>
          <h3>Еврейская гематрия: <span id="hebrewValue"><?= $results['hebrew']['total'] ?? 0 ?></span></h3>
          <p id="hebrewBreakdown">
            <?php if ($results): ?>Расчёт: <?= implode(' + ', $results['hebrew']['breakdown']) ?><?php endif ?>
          </p>
        </div>
        <!-- English -->
        <div class="result-card">
          <button class="copy-btn" onclick="copyValue('englishValue','englishCopyNotification')"><i class="fa-regular fa-copy"></i></button>
          <div class="copy-notification" id="englishCopyNotification">Скопировано!</div>
          <h3>Английская гематрия: <span id="englishValue"><?= $results['english']['total'] ?? 0 ?></span></h3>
          <p id="englishBreakdown">
            <?php if ($results): ?>Расчёт: (<?= implode(' + ', $results['simple']['breakdown']) ?>) × 6<?php endif ?>
          </p>
        </div>
        <!-- Simple -->
        <div class="result-card">
          <button class="copy-btn" onclick="copyValue('simpleValue','simpleCopyNotification')"><i class="fa-regular fa-copy"></i></button>
          <div class="copy-notification" id="simpleCopyNotification">Скопировано!</div>
          <h3>Простая гематрия: <span id="simpleValue"><?= $results['simple']['total'] ?? 0 ?></span></h3>
          <p id="simpleBreakdown">
            <?php if ($results): ?>Расчёт: <?= implode(' + ', $results['simple']['breakdown']) ?><?php endif ?>
          </p>
        </div>

        <div class="button-container" style="margin-top: 2rem; justify-content: center; gap: 15px;">
            <button class="download-btn" onclick="calculateAndDownload()">Скачать PDF</button>
            <button class="calculate-btn" onclick="calculateAgain()">Рассчитать снова</button>
        </div>


          <!-- More Tools (Result View) -->
          <div id="more-tools-result" style="<?= $results ? 'display:block;' : 'display:none;' ?>">
              <?= $moreToolsHtml ?>
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

      <p class="note" style="color:var(--error);font-weight:400;margin-top:0.75rem;text-align:center">
        По вопросам и предложениям пишите на <a href="mailto:admins@gematriacalculators.org" style="color:var(--error);text-decoration:underline;">admins@gematriacalculators.org</a>.
      </p>

      <!--–––– SEO SECTION #1 ––––-->
      <div class="seo-section">
        <h4>Откройте скрытые числовые значения</h4>
        <p>Наш бесплатный онлайн-калькулятор гематрии работает как мощный калькулятор имен по гематрии и поддерживает преобразование из английской гематрии в еврейскую. Ищете ли вы онлайн-калькулятор гематрии для библейского анализа или просто простой калькулятор гематрии для изучения значений чисел, этот инструмент для вас. Пользователи часто ищут "calculator gematria" или "gematria calculater", и наш инструмент удовлетворяет эту потребность.</p>
        <div class="example">Пример: Библия = 38 (еврейская), 180 (английская), 30 (простая)</div>
      </div>

        <!-- More Tools (Original View) -->
        <div id="more-tools-original" style="<?= $results ? 'display:none;' : 'display:block;' ?>">
            <?= $moreToolsHtml ?>
        </div>

      <!-- green international note -->
      <div class="seo-section" style="color:green;">
        <p>Наш <strong>онлайн-калькулятор гематрии</strong> доступен на многих языках. Пользователи ищут <em>гематрия калькулятор</em> (на русском), <em>gematria-rechner deutsch</em> (на немецком) и <em>calculadora de gematría</em> (на испанском). Наш инструмент интуитивно понятен для всех исследователей.</p>
      </div>

      <!--–––– SEO SECTION #2 ––––-->
      <div class="seo-section">
        <p>Наш лучший калькулятор гематрии (часто называемый gematrix или gmetrix calculator) разработан для точности и простоты. Он идеально подходит для ученых, духовных искателей или всех, кто интересуется священными текстами. С нашим лучшим еврейским калькулятором гематрии вы можете использовать наш декодер гематрии для анализа духовных имен или исследования эзотерических связей. Попробуйте бесплатный простой калькулятор гематрии сегодня и погрузитесь в мир чисел с уверенностью. Это отличная альтернатива Gematrix.org.</p>
      </div>

      <!-- Language Popup -->
      <div class="lang-popup">
          <div class="lang-popup-content">
              <button class="lang-popup-close" onclick="closeLangPopup()">&times;</button>
              <h4>Выберите язык</h4>
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
      <!--–––– FAQ ––––-->
      <section class="faq-section">
        <h2 class="faq-heading">Часто задаваемые вопросы</h2>
        <div class="faq-item">
          <div class="faq-question">
            <span>Что такое гематрия?</span><svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
          </div>
          <div class="faq-answer">
            Гематрия — это буквенно-цифровой код присвоения числового значения имени, слову или фразе на основе его букв. Она широко используется в еврейской мистике и толковании Библии.
          </div>
        </div>
        <div class="faq-item">
          <div class="faq-question">
            <span>Что такое калькулятор гематрии?</span><svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
          </div>
          <div class="faq-answer">
            Бесплатный калькулятор гематрии — это онлайн-инструмент, который автоматически вычисляет числовое значение слова или фразы. Он работает как современный генератор гематрии, основанный на древних нумерологических системах.
          </div>
        </div>
        <div class="faq-item">
          <div class="faq-question">
            <span>Как пользоваться онлайн-калькулятором гематрии?</span><svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
          </div>
          <div class="faq-answer">
            Чтобы использовать наш лучший бесплатный онлайн-калькулятор гематрии, просто введите слово или фразу в поле ввода, затем нажмите «Рассчитать Гематрию», чтобы сгенерировать его числовые значения в системах иврита, английского и простой гематрии.
          </div>
        </div>
        <div class="faq-item">
          <div class="faq-question">
            <span>Как понять простой калькулятор гематрии?</span><svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
          </div>
          <div class="faq-answer">
            Наш простой калькулятор гематрии присваивает A=1, B=2, C=3, … Z=26, а затем суммирует эти значения. Введите слово, например «Истина», и он выведет общую сумму, которую вы можете сравнить с другими словами, имеющими то же значение.
          </div>
        </div>
        <div class="faq-item">
          <div class="faq-question">
            <span>Как использовать библейский калькулятор гематрии?</span><svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
          </div>
          <div class="faq-answer">
            Наш библейский калькулятор гематрии предназначен для анализа библейских текстов и имен. Вы мгновенно получите значения еврейской, английской и простой гематрии. Наш калькулятор поддерживает символы иврита, что делает его лучшим калькулятором гематрии для библейских исследований. Мы также поддерживаем принципы греческого калькулятора гематрии.
          </div>
        </div>
        <div class="faq-item">
          <div class="faq-question">
            <span>Как работает поисковая система гематрии?</span><svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
          </div>
          <div class="faq-answer">
            Наша поисковая система гематрии и декодер гематрии позволяют находить слова с определенными числовыми значениями. Вы можете искать, используя системы еврейской, английской или простой гематрии.
          </div>
        </div>
        <div class="faq-item">
          <div class="faq-question">
            <span>Можно ли рассчитывать фразы с пробелами?</span><svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
          </div>
          <div class="faq-answer">
            Да! Этот калькулятор гематрии имен автоматически игнорирует пробелы и специальные символы. Мы поддерживаем калькулятор имен и значений гематрии для всех пользователей бесплатно.
          </div>
        </div>
        <div class="faq-item">
          <div class="faq-question">
            <span>Что такое английский калькулятор гематрии?</span><svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
          </div>
          <div class="faq-answer">
            Английский калькулятор гематрии присваивает числовые значения буквам английского алфавита. Наш английский калькулятор гематрии использует различные шифры, такие как простая гематрия (A=1, B=2), чтобы раскрыть скрытые слои смысла.
          </div>
        </div>
        <div class="faq-item">
          <div class="faq-question">
            <span>Кому следует использовать калькулятор гематрии?</span><svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
          </div>
          <div class="faq-answer">
            Калькулятор нумерологии и гематрии предназначен для всех, кто интересуется скрытой числовой структурой языка. Он идеально подходит для:
            <ul>
              <li>Духовных искателей, исследующих священные тексты, такие как Библия.</li>
              <li>Писателей и художников, ищущих творческое вдохновение и символическую глубину.</li>
              <li>Любителей истории, интересующихся древними методами толкования.</li>
              <li>Энтузиастов нумерологии, анализирующих имена, даты и понятия.</li>
              <li>Всех, кто любит головоломки и находит скрытые закономерности в окружающем мире.</li>
            </ul>
          </div>
        </div>
        <div class="faq-item">
          <div class="faq-question">
            <span>Что такое еврейский калькулятор гематрии?</span><svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
          </div>
          <div class="faq-answer">
            Еврейский калькулятор гематрии (или калькулятор гематрии на иврите) основан на еврейской традиции присвоения числовых значений еврейским буквам. Этот тип еврейского калькулятора гематрии необходим для изучения числовых значений библейских имен и понятий.
          </div>
        </div>
      </section>

      <footer class="footer">
        <div class="copyright">
          © <?= date('Y') ?> gematriacalculators.org
        </div>
      </footer>

    </div>
    <script>
      window.GematriaLang = {
        loadingPhrases: <?= json_encode($loadingPhrases) ?>,
        resultHeaderPrefix: "Результат гематрии для: "
      };
    </script>
  </body>
</html>
