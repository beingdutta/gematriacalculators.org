<?php
  // index.php
  // 1) pull in your calculate.php (which defines gematria() and also handles AJAX POSTs)
  require_once __DIR__ . '/../calculate.php';
  require_once __DIR__ . '/../helpers.php';

  // 2) fetch the URL‐param (for deep-linking) and, if present, run the server-side calculation
  $inputRaw = $_GET['input'] ?? '';
  $results  = $inputRaw !== '' ? gematria($inputRaw) : null;

  // SEO: make description STATIC, keep title concise (optionally dynamic)
  $SITE_NAME        = 'Calculadora de Gematría';
  $BASE_URL         = 'https://gematriacalculators.org/';

  // Clean a display version of the query for title/OG only
  $displayInput = trim($inputRaw);
  if ($displayInput !== '') {
    // limit to ~60 chars to avoid super-long titles
    $displayInput = mb_strimwidth($displayInput, 0, 60, '…', 'UTF-8');
  }

  // Title: short, human-readable. If there are results, include the English total once.
  if ($results && isset($results['english']['total'])) {
    $pageTitle = sprintf(
      '%s — Valor de Gematría: %s | %s',
      ucfirst($displayInput),
      (string)$results['english']['total'],
      $SITE_NAME
    );
  } else {
    $pageTitle = 'Calculadora de Gematría Gratuita — Gematrix y Numerología | ' . $SITE_NAME;
  }

  // DESCRIPTION: STATIC (don't vary per query — stabilizes snippets/CTR)
  $metaDescription = 'La mejor Calculadora de Gematría gratuita. Obtén resultados instantáneos y precisos con nuestra herramienta de gematrix y numerología, compatible con Gematría Inglesa, Hebrea y Simple. Ideal para análisis bíblico y decodificar valores.';

  // Canonical: point root when empty; deep-link when there's an input
  $canonicalUrl = $BASE_URL . 'es/';
  if (!empty($inputRaw)) {
    // use rawurlencode for cleaner canonical with query. Point to the root URL for queries.
    $canonicalUrl .= '?input=' . rawurlencode($inputRaw);
  }

  // Open Graph / Twitter: keep short and dependable; use static description
  $ogTitle = ($results && !empty($displayInput))
    ? sprintf('%s — Valor de Gematría: %s', $displayInput, (string)$results['english']['total'])
    : 'Calculadora de Gematría Gratuita — Gematrix y Numerología';

  // Optional: a share image you host (1200×630 recommended)
  $ogImage = $BASE_URL . 'assets/preview.jpg';

  $loadingPhrases = [
    "Traduciendo palabras a números...",
    "Invocando los códigos de la creación...",
    "Decodificando los patrones numéricos ocultos...",
    "Alineando letras con valores divinos...",
    "Calculando tu secuencia de gematría...",
    "Trazando la suma vibracional de tu nombre...",
    "Revelando el significado secreto en los números..."
  ];
?>

<!DOCTYPE html>
<html lang="es" data-theme="light">
<head>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/navigation/head-tracking.php'; ?>

    <meta charset="UTF-8">
    <meta name="p:domain_verify" content="9a2f772bde6a1162d2e6c441caf23a2a"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Keep keywords minimal or remove (search engines largely ignore this) -->
    <meta name="keywords" content="calculadora de gematría, gematría hebrea, gematría inglesa, gematría simple">

    <!-- Static/clean SEO -->
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

    <!-- Additional SEO meta tags for multilingual -->
    <meta property="og:locale" content="es_ES" />
    <meta property="og:locale:alternate" content="en_US" />
    <meta property="og:locale:alternate" content="ru_RU" />
    <meta property="og:locale:alternate" content="de_DE" />
    <meta property="og:locale:alternate" content="it_IT" />
    <meta property="og:locale:alternate" content="iw_IL" />
    <meta property="og:locale:alternate" content="pl_PL" />
    <meta property="og:locale:alternate" content="pt_BR" />
    <meta property="og:locale:alternate" content="zh_CN" />

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
      "name": "Calculadora de Gematría",
      "url": "<?= htmlspecialchars($BASE_URL . 'es/', ENT_QUOTES, 'UTF-8'); ?>",
      "description": "Calculadora gratuita en línea para valores de gematría Hebrea, Inglesa y Simple.",
      "applicationCategory": "Calculator",
      "operatingSystem": "Any",
      "inLanguage": "es"
    }
    </script>

    <link rel="icon" href="/assets/talisman-site-icon.png" sizes="32x32">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="/styles/index.css">
    <link rel="stylesheet" href="/styles/mobile.css">
    <link rel="stylesheet" href="/styles/more-tools.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>
</head>

<body>
    <?php require_once __DIR__ . '/../navigation/header.php'; ?>
    
    <div class="container">

        <!-- ——— Recent Searches Ticker ——— -->
        <div class="recent-phrases ticker-bar">
            <h4>Búsquedas recientes:</h4>

            <div class="ticker">
                <div class="ticker__list">
                <!-- JS will inject .ticker__item cards here -->
                </div>
            </div>
        </div>

        <header class="header">
            <img src="/assets/talisman-header-icon.png" id="themeLogo" alt="logo del sitio calculadora de gematría">
            <h1>Calculadora de Gematría (Gematrix)</h1>
            <p class="subtitle">(Escriba una palabra, nombre o número, por ejemplo: Dios, Biblia, Hebreo – para calcular valores de gematría en línea)</p>
        </header>

        <main class="calculator">
            <div class="input-group">
                <input
                    id="inputText"
                    type="text"
                    placeholder="Calcular gematría de mi nombre..."
                    value="<?= htmlspecialchars($inputRaw, ENT_QUOTES, 'UTF-8') ?>"
                />
                <button class="secondary" onclick="clearInput()" title="Limpiar">✕</button>
            </div>

            <div class="button-container">
                <button class="calculate-btn" onclick="calculate()">Calcular Gematría</button>
                <button class="download-btn" onclick="calculateAndDownload()">Descargar PDF</button>
                <a href="/decode-gematria-value.php" class="decode-btn">Decodificar Gematría</a>
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
            <h2>Explora más herramientas para una guía diaria</h2>
            <div class="tool-grid">
                <?php
                    $tools = [
                        ['title' => 'Calculadora Simple de Puntuación Vastu', 'desc' => 'Obtén una puntuación rápida de cumplimiento Vastu para tu hogar.', 'icon' => '<i class="fa-solid fa-house"></i>', 'url' => '/more-tools/simple-vastu-score-calculator.php'],
                        ['title' => 'Calculadora de Número Kua', 'desc' => 'Encuentra tus direcciones de la suerte del Feng Shui para el éxito.', 'icon' => '<i class="fa-solid fa-compass"></i>', 'url' => '/more-tools/kua-number-calculator.php'],
                        ['title' => 'Decodificador de Números de Ángel', 'desc' => 'Descubre mensajes del universo en los números.', 'icon' => '<i class="fa-solid fa-wand-magic-sparkles"></i>', 'url' => '/more-tools/angel-number-decoder.php'],
                        ['title' => 'Calculadora del Número del Camino de Vida', 'desc' => 'Descubre tu destino principal a partir de tu fecha de nacimiento.', 'icon' => '<i class="fa-solid fa-route"></i>', 'url' => '/more-tools/life-path-number-calculator.php'],
                        ['title' => 'Calculadora de Cuadrícula Loshu', 'desc' => 'Traza tu cuadrícula de energía numerológica.', 'icon' => '<i class="fa-solid fa-table-cells"></i>', 'url' => '/more-tools/loshu-grid.php'],
                        ['title' => 'Calculadora de Numerología del Nombre', 'desc' => 'Calcula tus números de Destino y Deseo del Alma.', 'icon' => '<i class="fa-solid fa-signature"></i>', 'url' => '/more-tools/name-numerology-calculator.php'],
                    ];

                    foreach ($tools as $tool) {
                        echo '
                        <div class="tool-card">
                            <div class="tool-icon">'.$tool['icon'].'</div>
                            <h3>'.$tool['title'].'</h3>
                            <p>'.$tool['desc'].'</p>
                            <a href="'.$tool['url'].'" class="calculate-btn">Abrir Herramienta</a>
                        </div>';
                    }
                ?>
            </div>
        </section>
        <?php
        $moreToolsHtml = ob_get_clean();
        ?>

        <div class="result" id="result" style="<?= $results ? 'display:block;' : 'display:none;' ?>">
            <h2 id="resultHeader" style="text-align: center; margin-bottom: 2rem; font-size: 1.2rem; font-weight: 600; background-color: var(--background-alt); padding: 0.75rem 1rem; border-radius: var(--radius); border: 1px solid var(--border-color); box-shadow: 0 2px 4px rgba(0,0,0,0.05);">Resultado de Gematría para: <span style="color: var(--primary-color);"><?= htmlspecialchars($displayInput) ?></span></h2>
            <div class="result-card">
                <button class="copy-btn" onclick="copyValue('hebrewValue','hebrewCopyNotification')">
                    <i class="fa-regular fa-copy"></i>
                </button>
                <div class="copy-notification" id="hebrewCopyNotification">¡Copiado!</div>
                <h3>Gematría Hebrea: <span id="hebrewValue">
                <?= $results['hebrew']['total'] ?? 0 ?>
                </span></h3>
                <p id="hebrewBreakdown">
                <?php if($results): ?>
                    Cálculo: <?= implode(' + ', $results['hebrew']['breakdown']) ?>
                <?php endif ?>
                </p>
            </div>

            <div class="result-card">
                <button class="copy-btn" onclick="copyValue('englishValue','englishCopyNotification')">
                    <i class="fa-regular fa-copy"></i>
                </button>
                <div class="copy-notification" id="englishCopyNotification">¡Copiado!</div>
                <h3>Gematría Inglesa: <span id="englishValue">
                <?= $results['english']['total'] ?? 0 ?>
                </span></h3>
                <p id="englishBreakdown">
                <?php if($results): ?>
                    Cálculo: (<?= implode(' + ', $results['simple']['breakdown']) ?>) × 6
                <?php endif ?>
                </p>
            </div>

            <div class="result-card">
                <button class="copy-btn" onclick="copyValue('simpleValue','simpleCopyNotification')">
                    <i class="fa-regular fa-copy"></i>
                </button>
                <div class="copy-notification" id="simpleCopyNotification">¡Copiado!</div>
                <h3>Gematría Simple: <span id="simpleValue">
                <?= $results['simple']['total'] ?? 0 ?>
                </span></h3>
                <p id="simpleBreakdown">
                <?php if($results): ?>
                    Cálculo: <?= implode(' + ', $results['simple']['breakdown']) ?>
                <?php endif ?>
                </p>
            </div>
            <div class="button-container" style="margin-top: 2rem; justify-content: center; gap: 15px;">
                <button class="download-btn" onclick="calculateAndDownload()">Descargar PDF</button>
                <button class="calculate-btn" onclick="calculateAgain()">Calcular de Nuevo</button>
            </div>


            <!-- More Tools (Result View) -->
            <div id="more-tools-result" style="<?= $results ? 'display:block;' : 'display:none;' ?>">
                <?= $moreToolsHtml ?>
            </div>
            <div class="feedback">
                <p>¿Te resultó útil esta calculadora?</p>
                <div class="feedback-buttons">
                <button onclick="sendFeedback('😞')">😞</button>
                <button onclick="sendFeedback('😐')">😐</button>
                <button onclick="sendFeedback('😊')">😊</button>
                </div>
                <div class="feedback-message" id="feedbackMessage"></div>
            </div>
        </div>

        <p class="note" style="color: var(--error); font-weight: 400; margin-top: 0.75rem; text-align: center;">
            Para comentarios, sugerencias o mejoras de esta herramienta, envíenos un correo electrónico a <a href="mailto:admins@gematriacalculators.org" style="color: var(--error); text-decoration: underline;">admins@gematriacalculators.org</a>.
        </p>

        <!-- SEO SECTION #1 -->
        <div class="seo-section">
            <h4>Descubre Significados Numéricos Ocultos</h4>
            <p>Esta calculadora de gematría gratuita en línea funciona como una potente calculadora de nombres de gematría y admite conversiones de gematría inglesa a hebrea. Ya sea que busques una calculadora de gematría en línea para análisis bíblico o simplemente una calculadora de gematría simple para explorar significados numéricos, esta herramienta está diseñada para ti. Los usuarios a menudo buscan "calculadora gematria" o "gematria calculater", y nuestra herramienta satisface esa necesidad.</p>
            <div class="example">Ejemplo: Biblia = 38 (Hebreo), 180 (Inglés), 30 (Simple)</div>
        </div>

        <!-- More Tools (Original View) -->
        <div id="more-tools-original" style="<?= $results ? 'display:none;' : 'display:block;' ?>">
            <?= $moreToolsHtml ?>
        </div>

        <!-- SEO SECTION #2 -->
        <div class="seo-section">
            <p>Nuestra mejor calculadora de gematría (a menudo llamada gematrix) está diseñada para brindar precisión y simplicidad. Es perfecta para estudiosos, buscadores espirituales o cualquier persona interesada en los textos sagrados. Con nuestra calculadora de gematría hebrea, puedes usar nuestro decodificador de gematría para analizar nombres espirituales o explorar conexiones esotéricas. Prueba hoy la calculadora de gematría simple gratis y sumérgete en el mundo de los números con confianza. Es una gran alternativa a Gematrix.org.</p>
        </div>

        <!-- GLOBAL FEEDBACK BANNER -->
        <div class="global-feedback-message" id="globalFeedback"></div>

        <!-- Language Popup -->
        <div class="lang-popup">
            <div class="lang-popup-content">
                <button class="lang-popup-close" onclick="closeLangPopup()">&times;</button>
                <h4>Seleccionar Idioma</h4>
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
            <h2 class="faq-heading">Preguntas Frecuentes</h2>
            <div class="faq-item">
                <div class="faq-question">
                    <span>¿Qué es la Gematría?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">
                    La gematría es un código alfanumérico que asigna un valor numérico a un nombre, palabra o frase basándose en sus letras. Se utiliza comúnmente en el misticismo judío y la interpretación bíblica.
                </div>
            </div>
            <div class="faq-item">
                <div class="faq-question">
                    <span>¿Qué es una calculadora de gematría?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">
                    Una calculadora de gematría gratuita es una herramienta en línea que calcula automáticamente el valor numérico de una palabra o frase. Funciona como un generador de gematría moderno basado en sistemas de numerología antiguos.
                </div>
            </div>
            <div class="faq-item">
                <div class="faq-question">
                    <span>¿Cómo usar la calculadora de gematría en línea?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">
                    Para usar nuestra mejor calculadora de gematría gratuita en línea, simplemente escribe una palabra o frase en el cuadro de entrada, luego haz clic en “Calcular Gematría” para generar sus valores en los sistemas Hebreo, Inglés y Simple.
                </div>
            </div>
            <div class="faq-item">
                <div class="faq-question">
                    <span>¿Cómo entender la calculadora de gematría simple?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">
                    Nuestra calculadora de gematría simple asigna A=1, B=2, C=3, … Z=26, y luego suma esos valores. Ingresa una palabra como “Verdad” y mostrará el total, que puedes comparar con otras palabras que comparten el mismo valor.
                </div>
            </div>
            <div class="faq-item">
                <div class="faq-question">
                    <span>¿Cómo uso la calculadora de gematría de la Biblia?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">
                    Nuestra calculadora de gematría de la Biblia está diseñada para analizar textos y nombres bíblicos. Obtendrá valores instantáneos de gematría hebrea, inglesa y simple. Nuestra calculadora es compatible con caracteres hebreos, lo que la convierte en la mejor calculadora de gematría para la investigación bíblica. También admitimos los principios de la calculadora de gematría griega.
                </div>
            </div>
            <div class="faq-item">
                <div class="faq-question">
                    <span>¿Cómo funciona el motor de búsqueda de gematría?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">
                    Nuestro motor de búsqueda de gematría y decodificador de gematría le permiten encontrar palabras con valores numéricos específicos. Puede buscar utilizando los sistemas de gematría hebrea, inglesa o simple.
                </div>
            </div>
            <div class="faq-item">
                <div class="faq-question">
                    <span>¿Puedo calcular frases con espacios?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">
                    ¡Sí! Esta calculadora de nombres de gematría ignora automáticamente los espacios y caracteres especiales. Ofrecemos soporte para la calculadora de nombres y significados de gematría para todos los usuarios de forma gratuita.
                </div>
            </div>
            <div class="faq-item">
                <div class="faq-question">
                    <span>¿Qué es la calculadora de gematría inglesa?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">
                    Una Calculadora de Gematría Inglesa asigna valores numéricos a las letras del alfabeto inglés. Nuestra calculadora de gematría inglesa utiliza varias cifras como la Gematría Simple (A=1, B=2) para revelar capas ocultas de significado.
                </div>
            </div>
            <div class="faq-item">
                <div class="faq-question">
                    <span>¿Quién debería usar la calculadora de gematría?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">
                    Una calculadora de numerología y gematría es para cualquiera que sienta curiosidad por la estructura numérica oculta del lenguaje. Es perfecta para:
                    <ul>
                        <li>Buscadores espirituales que exploran textos sagrados como la Biblia.</li>
                        <li>Escritores y artistas que buscan inspiración creativa y profundidad simbólica.</li>
                        <li>Aficionados a la historia interesados en los métodos de interpretación antiguos.</li>
                        <li>Entusiastas de la numerología que analizan nombres, fechas y conceptos.</li>
                        <li>Cualquiera que ame los rompecabezas y encontrar patrones ocultos en el mundo que les rodea.</li>
                    </ul>
                </div>
            </div>
            <div class="faq-item">
                <div class="faq-question">
                    <span>¿Qué es la calculadora de gematría judía?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">
                    Una Calculadora de Gematría Judía (o Calculadora de Gematría Hebrea) se basa en la tradición judía de asignar valores numéricos a las letras hebreas. Este tipo de calculadora de gematría hebrea es esencial para estudiar los valores numéricos de nombres y conceptos bíblicos.
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
        resultHeaderPrefix: "Resultado de Gematría para: "
      };
    </script>
    <script src="/scripts/index.js"></script>

</body>
</html>
