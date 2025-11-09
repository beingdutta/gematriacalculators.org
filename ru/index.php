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
      $seoTitle = 'Калькулятор Гематрии Онлайн — Gematrix и Нумерология | Бесплатно на Русском';
      $seoDesc  = 'Лучший бесплатный калькулятор Гематрии. Получите мгновенные и точные результаты с помощью нашего инструмента gematrix и нумерологии, поддерживающего английскую, еврейскую и простую гематрию. Идеально подходит для библейского анализа и расшифровки значений.';
  }
?>
<!DOCTYPE html>
<html lang="ru" data-theme="light">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title><?= $seoTitle ?></title>
    <meta name="description" content="<?= htmlspecialchars($seoDesc, ENT_QUOTES) ?>">

    <?php
      $base = 'https://gematriacalculators.org';
      $qs = !empty($_SERVER['QUERY_STRING']) ? '?' . $_SERVER['QUERY_STRING'] : '';
      $path = 'index.php' . $qs;
    ?>
    <!-- Language alternates -->
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

    <link rel="icon" href="/assets/talisman-site-icon.png" sizes="32x32">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/styles/index.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>
    <script src="/scripts/index.js" defer></script>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4198904821948931" crossorigin="anonymous"></script>
  </head>

  <body>
    <?php require_once __DIR__ . '/../navigation/header.php'; ?>

    <div class="container">

      <!-- Language Support Info -->
      <div class="language-support-info" style="background: #f0f8ff; padding: 12px; margin: 2px 0 10px 0; border-radius: 8px; text-align: center; border: 1px solid #cce5ff;">
          <p style="margin: 0; color: #004085; font-size: 13px;">
              🌍 Спасибо за доверие! Теперь мы поддерживаем несколько языков: 
              <span title="English">английский</span>, 
              <strong>русский</strong>, 
              <span title="Deutsch">немецкий</span>, 
              <span title="Español">испанский</span>, 
              <span title="Português">португальский</span>, 
              <span title="Italiano">итальянский</span>, 
              <span title="עברית">иврит</span>, 
              <span title="Polski">польский</span> и 
              <span title="中文">китайский</span> и
              <span title="Tiếng Việt">вьетнамский</span>!
          </p>
      </div>

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
          <a href="/ru/decode-gematria-value/" class="decode-btn">Расшифровать гематрию</a>
        </div>

        <div class="loading-container" id="loading" style="display:none"><div class="spinner"></div></div>

        <div class="result" id="result" style="<?= $results ? 'display:block;' : 'display:none;' ?>">
          <!-- Hebrew -->
          <div class="result-card">
            <button class="copy-btn" onclick="copyValue('hebrewValue','hebrewCopyNotification')">📋</button>
            <div class="copy-notification" id="hebrewCopyNotification">Скопировано!</div>
            <h3>Еврейская гематрия: <span id="hebrewValue"><?= $results['hebrew']['total'] ?? 0 ?></span></h3>
            <p id="hebrewBreakdown">
              <?php if ($results): ?>Расчёт: <?= implode(' + ', $results['hebrew']['breakdown']) ?><?php endif ?>
            </p>
          </div>
          <!-- English -->
          <div class="result-card">
            <button class="copy-btn" onclick="copyValue('englishValue','englishCopyNotification')">📋</button>
            <div class="copy-notification" id="englishCopyNotification">Скопировано!</div>
            <h3>Английская гематрия: <span id="englishValue"><?= $results['english']['total'] ?? 0 ?></span></h3>
            <p id="englishBreakdown">
              <?php if ($results): ?>Расчёт: (<?= implode(' + ', $results['simple']['breakdown']) ?>) × 6<?php endif ?>
            </p>
          </div>
          <!-- Simple -->
          <div class="result-card">
            <button class="copy-btn" onclick="copyValue('simpleValue','simpleCopyNotification')">📋</button>
            <div class="copy-notification" id="simpleCopyNotification">Скопировано!</div>
            <h3>Простая гематрия: <span id="simpleValue"><?= $results['simple']['total'] ?? 0 ?></span></h3>
            <p id="simpleBreakdown">
              <?php if ($results): ?>Расчёт: <?= implode(' + ', $results['simple']['breakdown']) ?><?php endif ?>
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

      <p class="note" style="color:var(--error);font-weight:400;margin-top:0.75rem;text-align:center">
        По вопросам и предложениям пишите на <a href="mailto:admins@gematriacalculators.org" style="color:var(--error);text-decoration:underline;">admins@gematriacalculators.org</a>.
      </p>

      <!--–––– SEO SECTION #1 ––––-->
      <div class="seo-section">
        <h4>Откройте скрытые числовые значения</h4>
        <p>Наш <strong>бесплатный онлайн-калькулятор гематрии</strong> работает как мощный <strong>калькулятор имен по гематрии</strong> и поддерживает преобразование из <strong>английской гематрии в еврейскую</strong>. Ищете ли вы <strong>онлайн-калькулятор гематрии</strong> для библейского анализа или просто <strong>простой калькулятор гематрии</strong> для изучения значений чисел, этот инструмент для вас. Пользователи часто ищут "<strong>calculator gematria</strong>" или "<strong>gematria calculater</strong>", и наш инструмент удовлетворяет эту потребность.</p>
        <div class="example">Пример: <strong>Библия</strong> = 38 (еврейская), 180 (английская), 30 (простая)</div>
      </div>

      <!-- green international note -->
      <div class="seo-section" style="color:green;">
        <p>Наш <strong>онлайн-калькулятор гематрии</strong> доступен на многих языках. Пользователи ищут <em>гематрия калькулятор</em> (на русском), <em>gematria-rechner deutsch</em> (на немецком) и <em>calculadora de gematría</em> (на испанском). Наш инструмент интуитивно понятен для всех исследователей.</p>
      </div>

      <!--–––– SEO SECTION #2 ––––-->
      <div class="seo-section">
        <p>Наш лучший <strong>калькулятор гематрии</strong> (часто называемый <strong>gematrix</strong> или <strong>gmetrix calculator</strong>) разработан для точности и простоты. Он идеально подходит для ученых, духовных искателей или всех, кто интересуется священными текстами. С нашим лучшим <strong>еврейским калькулятором гематрии</strong> вы можете использовать наш <strong>декодер гематрии</strong> для анализа духовных имен или исследования эзотерических связей. Попробуйте <strong>бесплатный простой калькулятор гематрии</strong> сегодня и погрузитесь в мир чисел с уверенностью. Это отличная альтернатива Gematrix.org.</p>
      </div>

      <hr class="divider"><br>

      <!--–––– Second recent phrases list ––––-->
      <div class="recent-phrases">
        <h4>Недавние слова и фразы:</h4>
        <a href="#">the bible</a> |
        <a href="#">elohim frequency 432</a> |
        <a href="#">sacred light of yahweh</a> |
        <a href="#">the saturn</a> |
        <a href="#">truth hidden in plain sight</a> |
        <a href="#">metatron speaks in numbers</a> |
        <a href="#">peace over chaos always</a>
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
      <footer class="footer">
        <h2 class="faq-heading">Часто задаваемые вопросы</h2>
        <div class="faq-item">
          <div class="faq-question" onclick="toggleFAQ(this)">
            <span>Что такое гематрия?</span><svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
          </div>
          <div class="faq-answer">
            Гематрия — это буквенно-цифровой код присвоения числового значения имени, слову или фразе на основе его букв. Она широко используется в еврейской мистике и толковании Библии.
          </div>
        </div>
        <div class="faq-item">
          <div class="faq-question" onclick="toggleFAQ(this)">
            <span>Что такое калькулятор гематрии?</span><svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
          </div>
          <div class="faq-answer">
            <strong>Бесплатный калькулятор гематрии</strong> — это онлайн-инструмент, который автоматически вычисляет числовое значение слова или фразы. Он работает как современный <strong>генератор гематрии</strong>, основанный на древних нумерологических системах.
          </div>
        </div>
        <div class="faq-item">
          <div class="faq-question" onclick="toggleFAQ(this)">
            <span>Как пользоваться онлайн-калькулятором гематрии?</span><svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
          </div>
          <div class="faq-answer">
            Чтобы использовать наш лучший <strong>бесплатный онлайн-калькулятор гематрии</strong>, просто введите слово или фразу в поле ввода, затем нажмите «Рассчитать Гематрию», чтобы сгенерировать его числовые значения в системах иврита, английского и простой гематрии.
          </div>
        </div>
        <div class="faq-item">
          <div class="faq-question" onclick="toggleFAQ(this)">
            <span>Как понять простой калькулятор гематрии?</span><svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
          </div>
          <div class="faq-answer">
            Наш <strong>простой калькулятор гематрии</strong> присваивает A=1, B=2, C=3, … Z=26, а затем суммирует эти значения. Введите слово, например «Истина», и он выведет общую сумму, которую вы можете сравнить с другими словами, имеющими то же значение.
          </div>
        </div>
        <div class="faq-item">
          <div class="faq-question" onclick="toggleFAQ(this)">
            <span>Как использовать библейский калькулятор гематрии?</span><svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
          </div>
          <div class="faq-answer">
            Наш <strong>библейский калькулятор гематрии</strong> предназначен для анализа библейских текстов и имен. Вы мгновенно получите значения <strong>еврейской, английской и простой гематрии</strong>. Наш калькулятор поддерживает символы иврита, что делает его лучшим <strong>калькулятором гематрии для библейских исследований</strong>. Мы также поддерживаем принципы <strong>греческого калькулятора гематрии</strong>.
          </div>
        </div>
        <div class="faq-item">
          <div class="faq-question" onclick="toggleFAQ(this)">
            <span>Как работает поисковая система гематрии?</span><svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
          </div>
          <div class="faq-answer">
            Наша <strong>поисковая система гематрии</strong> и <strong>декодер гематрии</strong> позволяют находить слова с определенными числовыми значениями. Вы можете искать, используя системы <strong>еврейской, английской или простой гематрии</strong>.
          </div>
        </div>
        <div class="faq-item">
          <div class="faq-question" onclick="toggleFAQ(this)">
            <span>Можно ли рассчитывать фразы с пробелами?</span><svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
          </div>
          <div class="faq-answer">
            Да! Этот <strong>калькулятор гематрии имен</strong> автоматически игнорирует пробелы и специальные символы. Мы поддерживаем <strong>калькулятор имен и значений гематрии</strong> для всех пользователей бесплатно.
          </div>
        </div>
        <div class="faq-item">
          <div class="faq-question" onclick="toggleFAQ(this)">
            <span>Что такое английский калькулятор гематрии?</span><svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
          </div>
          <div class="faq-answer">
            <strong>Английский калькулятор гематрии</strong> присваивает числовые значения буквам английского алфавита. Наш <strong>английский калькулятор гематрии</strong> использует различные шифры, такие как простая гематрия (A=1, B=2), чтобы раскрыть скрытые слои смысла.
          </div>
        </div>
        <div class="faq-item">
          <div class="faq-question" onclick="toggleFAQ(this)">
            <span>Кому следует использовать калькулятор гематрии?</span><svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
          </div>
          <div class="faq-answer">
            <strong>Калькулятор нумерологии и гематрии</strong> предназначен для всех, кто интересуется скрытой числовой структурой языка. Он идеально подходит для:
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
          <div class="faq-question" onclick="toggleFAQ(this)">
            <span>Что такое еврейский калькулятор гематрии?</span><svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
          </div>
          <div class="faq-answer">
            <strong>Еврейский калькулятор гематрии</strong> (или <strong>калькулятор гематрии на иврите</strong>) основан на еврейской традиции присвоения числовых значений еврейским буквам. Этот тип <strong>еврейского калькулятора гематрии</strong> необходим для изучения числовых значений библейских имен и понятий.
          </div>
        </div>

        <div class="footer-links">
          <!-- Footer links are now in the header nav -->
          <!-- <a href="/ru/index.php">Главная</a>
          <a href="/blog-collections.html">Блог</a>
          <a href="/about-us.html">О&nbsp;нас</a>
          <a href="/contact-us.html">Контакты</a>
          <a href="/terms-conditions.html">Условия</a>
          <a href="/privacy-policy.html">Политика&nbsp;конфиденциальности</a> -->
        </div>

        <div class="copyright">
          © <?= date('Y') ?> gematriacalculators.org
        </div>
      </footer>

    </div>
  </body>
</html>
