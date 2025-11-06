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
      $seoTitle = 'Калькулятор гематрии онлайн | Бесплатный инструмент для расчета гематрии';
      $seoDesc  = 'Лучший калькулятор гематрии онлайн ✓ Мгновенный расчет еврейской гематрии ✓ Греческая и английская нумерология ✓ Бесплатно и без регистрации.';
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
    <nav class="header-nav">
        <button class="mobile-menu-toggle" aria-label="Toggle menu">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
        </button>
        <div class="nav-links">
            <a href="/ru/index.php">Главная</a>
            <a href="/more-tools.php">Инструменты</a>
            <a href="/blog-collections.php">Блог</a>
            <a href="/about-us.php">О нас</a>
            <a href="/contact-us.php">Контакты</a>
            <a href="/terms-conditions.php">Условия</a>
            <a href="/privacy-policy.php">Политика конфиденциальности</a>
            <button class="lang-change-btn mobile-only" onclick="openLangPopup()">Сменить язык</button>
        </div>
        <button class="theme-toggle" onclick="toggleTheme()" aria-label="Переключить тему">
          <svg class="icon-sun" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="5"></circle><line x1="12" y1="1" x2="12" y2="3"></line><line x1="12" y1="21" x2="12" y2="23"></line><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line><line x1="1" y1="12" x2="3" y2="12"></line><line x1="21" y1="12" x2="23" y2="12"></line><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line></svg>
          <svg class="icon-moon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path></svg>
        </button>
    </nav>

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
              <span title="中文">китайский</span>!
          </p>
      </div>

      <!--–––– Recent Searches ticker ––––-->
      <div class="recent-phrases ticker-bar">
        <h4>Недавние запросы:</h4>

        <!-- ——— Language Switcher ——— -->
        <?php
          $qs = $_SERVER['QUERY_STRING'] ? '?'.$_SERVER['QUERY_STRING'] : '';
          $here = trim(dirname($_SERVER['SCRIPT_NAME']), '/');
        ?>
        <nav class="lang-switcher" aria-label="Language switcher">
          <?= lang_switcher_link('en','EN',$qs,$here) ?> |
          <?= lang_switcher_link('ru','RU',$qs,$here) ?> |
          <?= lang_switcher_link('de','DE',$qs,$here) ?> |
          <?= lang_switcher_link('es','ES',$qs,$here) ?> |
          <?= lang_switcher_link('pt','PT',$qs,$here) ?> |
          <?= lang_switcher_link('it','IT',$qs,$here) ?> |
          <?= lang_switcher_link('iw','HE',$qs,$here) ?> |
          <?= lang_switcher_link('pl','PL',$qs,$here) ?> |
          <?= lang_switcher_link('zh','CN',$qs,$here) ?>
        </nav>

        <div class="ticker">
          <div class="ticker__list"><!-- JS вставит элементы --></div>
        </div>
      </div>

      <header class="header">
        <img src="/assets/talisman-header-icon.png" id="themeLogo" alt="логотип калькулятора гематрии">
        <h1>Бесплатный онлайн-калькулятор гематрии</h1>
        <p class="subtitle">(Введите слово или число, например Бог, Библия, Иврит, Святость — чтобы вычислить значения)</p>
      </header>

      <main class="calculator">
        <div class="input-group">
          <input id="inputText"
                type="text"
                placeholder="Введите текст для расчёта…"
                value="<?= htmlspecialchars($inputRaw, ENT_QUOTES) ?>">
          <button class="secondary" onclick="clearInput()" title="Очистить">✕</button>
        </div>

        <div class="button-container">
          <button class="calculate-btn" onclick="calculate()">Рассчитать</button>
          <button class="download-btn"  onclick="calculateAndDownload()">Скачать PDF</button>
          <a href="/decode-gematria-value.html" class="decode-btn">Расшифровать гематрию</a>
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
        <p>Этот калькулятор гематрии служит мощным инструментом для расчёта числовых значений имён и слов, поддерживает перевод с английского на иврит и идеально подходит для библейского анализа или эзотерических исследований.</p>
        <div class="example">Пример: <strong>Библия</strong> = 38 (еврейская), 180 (английская), 30 (простая)</div>
      </div>

      <!-- green international note -->
      <div class="seo-section" style="color:green;">
        <p>Пользователи со всего мира ищут <em>гематрия калькулятор</em> (по-русски), <em>gematria rechner</em> (по-немецки) и <em>gematria calculadora</em> (по-испански). Наш инструмент интуитивно понятен для всех исследователей гематрии.</p>
      </div>

      <!--–––– SEO SECTION #2 ––––-->
      <div class="seo-section">
        <p>Наш лучший онлайн-калькулятор гематрии разработан для точности, скорости и простоты. Исследуйте библейские тексты, анализируйте духовные имена или ищите скрытые связи — всё в одном месте. Попробуйте бесплатный калькулятор прямо сейчас.</p>
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
            Бесплатный онлайн-инструмент или программное обеспечение для расчета гематрии, которое автоматически вычисляет числовое значение слова, фразы или имени, присваивая числовые значения каждой букве на основе определенных систем гематрии.
          </div>
        </div>
        <div class="faq-item">
          <div class="faq-question" onclick="toggleFAQ(this)">
            <span>Как пользоваться онлайн-калькулятором гематрии?</span><svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
          </div>
          <div class="faq-answer">
            Чтобы использовать наш лучший бесплатный онлайн-калькулятор гематрии, просто введите слово, фразу или имя в поле ввода, затем нажмите «Рассчитать», чтобы сгенерировать его числовые значения в системах иврита, английского и простой гематрии. Для записи вы также можете скачать отчет в формате PDF.
          </div>
        </div>
        <div class="faq-item">
          <div class="faq-question" onclick="toggleFAQ(this)">
            <span>Как понять простой калькулятор гематрии?</span><svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
          </div>
          <div class="faq-answer">
            Наш простой калькулятор гематрии присваивает A=1, B=2, C=3, … Z=26, а затем суммирует эти значения. Введите слово, например «Истина», и он выведет общую сумму, которую вы можете сравнить с другими словами, имеющими то же значение.
          </div>
        </div>
        <div class="faq-item">
          <div class="faq-question" onclick="toggleFAQ(this)">
            <span>Как использовать библейский калькулятор гематрии?</span><svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
          </div>
          <div class="faq-answer">
            Наш библейский калькулятор гематрии предназначен для анализа библейских текстов и имен. Просто введите любое слово или фразу из Библии, и вы мгновенно получите значения на иврите, английском и в простой гематрии. Наш калькулятор поддерживает как современные, так и библейские символы иврита, что делает его лучшим калькулятором гематрии для библейских исследований.
          </div>
        </div>
        <div class="faq-item">
          <div class="faq-question" onclick="toggleFAQ(this)">
            <span>Как работает поисковая система гематрии?</span><svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
          </div>
          <div class="faq-answer">
            Наша поисковая система гематрии позволяет находить слова и фразы с определенными числовыми значениями. Вы можете искать, используя системы иврита, английского или простой гематрии. Эта функция особенно полезна для библейских исследований и поиска связей между различными словами и понятиями.
          </div>
        </div>
        <div class="faq-item">
          <div class="faq-question" onclick="toggleFAQ(this)">
            <span>Можно ли рассчитывать фразы с пробелами?</span><svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
          </div>
          <div class="faq-answer">
            Да! Этот калькулятор гематрии имен автоматически игнорирует пробелы и специальные символы, сосредотачиваясь только на буквах алфавита. Мы поддерживаем калькулятор имен и значений гематрии для всех пользователей в любое время 24*7 бесплатно. Наш калькулятор особенно полезен для анализа многословных фраз из религиозных текстов.
          </div>
        </div>
        <div class="faq-item">
          <div class="faq-question" onclick="toggleFAQ(this)">
            <span>Что такое английский калькулятор гематрии?</span><svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
          </div>
          <div class="faq-answer">
            Английский калькулятор гематрии — это инструмент, который присваивает числовые значения буквам английского алфавита. В отличие от иврита, в английском нет единой древней системы, поэтому калькуляторы используют различные шифры, такие как простая гематрия (A=1, B=2), обратный порядковый (A=26, B=25) и редукция. Это позволяет вам исследовать числовые закономерности и символические связи между английскими словами, именами и фразами, раскрывая скрытые слои смысла.
          </div>
        </div>
        <div class="faq-item">
          <div class="faq-question" onclick="toggleFAQ(this)">
            <span>Кому следует использовать калькулятор гематрии?</span><svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
          </div>
          <div class="faq-answer">
            Калькулятор гематрии предназначен для всех, кто интересуется скрытой числовой структурой языка. Он идеально подходит для:
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
            Еврейский калькулятор гематрии (или калькулятор гематрии на иврите) — это инструмент, основанный на древней еврейской традиции присвоения числовых значений 22 буквам еврейского алфавита. Он в основном использует систему Миспар Хехречи (стандартную), которая является фундаментальной для каббалы и толкования Торы. Этот тип калькулятора необходим для изучения числовых значений библейских имен, понятий и стихов для раскрытия более глубоких богословских и мистических связей.
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
