<?php
  /* ------------  ru/index.php ------------- */
  require __DIR__ . '/../calculate.php';

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
      $seoTitle = 'Бесплатный онлайн-калькулятор гематрии';
      $seoDesc  = '#1 бесплатный калькулятор гематрии. Вычисляйте еврейские, английские и простые значения любых слов мгновенно.';
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
      $path = ltrim($_SERVER['REQUEST_URI'], '/');           // index.php?input=...
    ?>
    <link rel="alternate" hreflang="en" href="<?= $base ?>/<?= $path ?>">
    <link rel="alternate" hreflang="ru" href="<?= $base ?>/ru/<?= $path ?>">
    <link rel="alternate" hreflang="de" href="<?= $base ?>/de/<?= $path ?>">
    <link rel="alternate" hreflang="x-default" href="<?= $base ?>/<?= $path ?>">

    <link rel="canonical" href="<?= $base ?>/ru/<?= $path ?>">

    <link rel="icon" href="/assets/site-icon.png" sizes="32x32">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/styles/index.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>
    <script src="/scripts/index.js" defer></script>
  </head>

  <body>
    <div class="container">

      <!--–––– Recent Searches ticker ––––-->
      <div class="recent-phrases">
        <h4>Недавние запросы:</h4>

        <!-- ——— Language Switcher ——— -->
        <?php                                    
          $qs = $_SERVER['QUERY_STRING'] ? '?'.$_SERVER['QUERY_STRING'] : '';
          $here = trim(dirname($_SERVER['SCRIPT_NAME']), '/');   // '' | ru | de
          function lang($code,$label,$qs,$here){
              $path = $code==='en' ? '/index.php'.$qs : "/$code/index.php$qs";
              return $code===$here||($code==='en'&&$here==='') ? "<strong>$label</strong>"
                                                              : "<a href=\"$path\">$label</a>";
          }
        ?>
        <nav class="lang-switcher" aria-label="Language switcher">
          <?= lang('en','EN',$qs,$here) ?> |
          <?= lang('ru','RU',$qs,$here) ?> |
          <?= lang('de','DE',$qs,$here) ?>
        </nav>

        <div class="ticker">
          <div class="ticker__list"><!-- JS вставит элементы --></div>
        </div>
      </div>

      <header class="header">
        <img src="/assets/header-image.webp" id="themeLogo" alt="логотип калькулятора гематрии">
        <button class="theme-toggle" onclick="toggleTheme()">🌓</button>
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

      <!--–––– FAQ ––––-->
      <footer class="footer">
        <div class="faq-item">
          <div class="faq-question" onclick="toggleFAQ(this)">
            <span>Что такое гематрия?</span><svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
          </div>
          <div class="faq-answer">
            Гематрия — это система, в которой каждой букве присваивается числовое значение; используется в иудейской мистике и библейской интерпретации.
          </div>
        </div>

        <div class="faq-item">
          <div class="faq-question" onclick="toggleFAQ(this)">
            <span>Что такое калькулятор гематрии?</span><svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
          </div>
          <div class="faq-answer">
            Это онлайн-инструмент, который автоматически вычисляет числовое значение слова или фразы по выбранной системе гематрии.
          </div>
        </div>

        <div class="faq-item">
          <div class="faq-question" onclick="toggleFAQ(this)">
            <span>Как пользоваться калькулятором?</span><svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
          </div>
          <div class="faq-answer">
            Введите слово, фразу или имя в поле ввода и нажмите «Рассчитать». Инструмент покажет значения для еврейской, английской и простой систем.
          </div>
        </div>

        <div class="faq-item">
          <div class="faq-question" onclick="toggleFAQ(this)">
            <span>Как работает простая гематрия?</span><svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
          </div>
          <div class="faq-answer">
            В простой системе A=1, B=2, … Z=26. Калькулятор суммирует значения всех букв и показывает итог.
          </div>
        </div>

        <div class="faq-item">
          <div class="faq-question" onclick="toggleFAQ(this)">
            <span>Можно ли рассчитывать фразы с пробелами?</span><svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
          </div>
          <div class="faq-answer">
            Да, пробелы и специальные символы игнорируются — учитываются только буквы.
          </div>
        </div>

        <div class="footer-links">
          <a href="/ru/index.php">Главная</a>
          <a href="/blog-collections.html">Блог</a>
          <a href="/about-us.html">О&nbsp;нас</a>
          <a href="/contact-us.html">Контакты</a>
          <a href="/terms-conditions.html">Условия</a>
          <a href="/privacy-policy.html">Политика&nbsp;конфиденциальности</a>
        </div>

        <div class="copyright">
          © 2022 gematriacalculators.org
        </div>
      </footer>

    </div>
  </body>
</html>
