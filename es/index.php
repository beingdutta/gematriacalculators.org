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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>
</head>

<body>
    <?php require_once __DIR__ . '/../navigation/header.php'; ?>
    
    <div class="container">

        <!-- Language Support Info -->
        <div class="language-support-info" style="background: #f0f8ff; padding: 12px; margin: 2px 0 10px 0; border-radius: 8px; text-align: center; border: 1px solid #cce5ff;">
          <p style="margin: 0; color: #004085; font-size: 13px;">
                🌍 ¡Gracias por su confianza! Ahora admitimos varios idiomas: 
                <span title="English">Inglés</span>, 
                <span title="Русский">Ruso</span>, 
                <span title="Deutsch">Alemán</span>, 
                <strong>Español</strong>, 
                <span title="Português">Portugués</span>, 
                <span title="Italiano">Italiano</span>, 
                <span title="עברית">Hebreo</span>, 
                <span title="Polski">Polaco</span> y 
                <span title="中文">Chino</span> y
                <span title="Tiếng Việt">Vietnamita</span>!
            </p>
        </div>

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

            <div class="loading-container" id="loading" style="display:none">
                <div class="spinner"></div>
                <p id="loadingMessage" class="loading-message"></p>
            </div>

            <div class="result" id="result" style="<?= $results ? 'display:block;' : 'display:none;' ?>">
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

                <div class="promotion-box">
                    <div class="promo-icon" style="font-size: 2.5rem; color: var(--primary-color); flex-shrink: 0;">
                        <i class="fa-solid fa-wand-magic-sparkles"></i>
                    </div>
                    <div class="promo-content" style="text-align: center;">
                        <p style="margin: 0; font-weight: 600; font-size: 1.05em;">Expande tu Visión Más Allá de los Números</p>
                        <p style="margin: 6px 0 0 0; font-size: 0.9em;">Mientras que la gematría revela el código numérico oculto en tu vida, el tarot ofrece un camino diferente hacia la sabiduría. Combina la lógica de los números con la intuición de las cartas para obtener una perspectiva más completa. Busca la guía de nuestro Lector de Tarot Diario gratuito para complementar tu viaje.</p>
                    </div>
                    <a href="https://tarotcardgenerator.online/" target="_blank" class="promo-btn" style="white-space: nowrap; margin-top: 1rem;">
                        Obtener una Lectura de Tarot Gratis
                    </a>
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
        </main>

        <p class="note" style="color: var(--error); font-weight: 400; margin-top: 0.75rem; text-align: center;">
            Para comentarios, sugerencias o mejoras de esta herramienta, envíenos un correo electrónico a <a href="mailto:admins@gematriacalculators.org" style="color: var(--error); text-decoration: underline;">admins@gematriacalculators.org</a>.
        </p>

        <!-- SEO SECTION #1 -->
        <div class="seo-section">
            <h4>Descubre Significados Numéricos Ocultos</h4>
            <p>Esta <strong>calculadora de gematría gratuita en línea</strong> funciona como una potente <strong>calculadora de nombres de gematría</strong> y admite conversiones de <strong>gematría inglesa a hebrea</strong>. Ya sea que busques una <strong>calculadora de gematría en línea</strong> para análisis bíblico o simplemente una <strong>calculadora de gematría simple</strong> para explorar significados numéricos, esta herramienta está diseñada para ti. Los usuarios a menudo buscan "<strong>calculadora gematria</strong>" o "<strong>gematria calculater</strong>", y nuestra herramienta satisface esa necesidad.</p>
            <div class="example">Ejemplo: <strong>Biblia</strong> = 38 (Hebreo), 180 (Inglés), 30 (Simple)</div>
        </div>

        <!-- SEO SECTION #2 -->
        <div class="seo-section">
            <p>Nuestra mejor <strong>calculadora de gematría</strong> (a menudo llamada <strong>gematrix</strong>) está diseñada para brindar precisión y simplicidad. Es perfecta para estudiosos, buscadores espirituales o cualquier persona interesada en los textos sagrados. Con nuestra <strong>calculadora de gematría hebrea</strong>, puedes usar nuestro <strong>decodificador de gematría</strong> para analizar nombres espirituales o explorar conexiones esotéricas. Prueba hoy la <strong>calculadora de gematría simple gratis</strong> y sumérgete en el mundo de los números con confianza. Es una gran alternativa a Gematrix.org.</p>
        </div>

        <hr class="divider">
        <br>

        <!-- GLOBAL FEEDBACK BANNER -->
        <div class="global-feedback-message" id="globalFeedback"></div>

        <!-- FAQ & FOOTER -->
        <footer class="footer">
            <!-- FAQ ITEMS -->
            <h2 class="faq-heading">Preguntas Frecuentes</h2>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)">
                    <span>¿Qué es la Gematría?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">
                    La gematría es un código alfanumérico que asigna un valor numérico a un nombre, palabra o frase basándose en sus letras. Se utiliza comúnmente en el misticismo judío y la interpretación bíblica.
                </div>
            </div>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)">
                    <span>¿Qué es una calculadora de gematría?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">
                    Una <strong>calculadora de gematría gratuita</strong> es una herramienta en línea que calcula automáticamente el valor numérico de una palabra o frase. Funciona como un <strong>generador de gematría</strong> moderno basado en sistemas de numerología antiguos.
                </div>
            </div>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)">
                    <span>¿Cómo usar la calculadora de gematría en línea?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">
                    Para usar nuestra mejor <strong>calculadora de gematría gratuita en línea</strong>, simplemente escribe una palabra o frase en el cuadro de entrada, luego haz clic en “Calcular Gematría” para generar sus valores en los sistemas Hebreo, Inglés y Simple.
                </div>
            </div>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)">
                    <span>¿Cómo entender la calculadora de gematría simple?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">
                    Nuestra <strong>calculadora de gematría simple</strong> asigna A=1, B=2, C=3, … Z=26, y luego suma esos valores. Ingresa una palabra como “Verdad” y mostrará el total, que puedes comparar con otras palabras que comparten el mismo valor.
                </div>
            </div>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)">
                    <span>¿Cómo uso la calculadora de gematría de la Biblia?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">
                    Nuestra <strong>calculadora de gematría de la Biblia</strong> está diseñada para analizar textos y nombres bíblicos. Obtendrá valores instantáneos de <strong>gematría hebrea, inglesa y simple</strong>. Nuestra calculadora es compatible con caracteres hebreos, lo que la convierte en la mejor <strong>calculadora de gematría para la investigación bíblica</strong>. También admitimos los principios de la <strong>calculadora de gematría griega</strong>.
                </div>
            </div>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)">
                    <span>¿Cómo funciona el motor de búsqueda de gematría?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">
                    Nuestro <strong>motor de búsqueda de gematría</strong> y <strong>decodificador de gematría</strong> le permiten encontrar palabras con valores numéricos específicos. Puede buscar utilizando los sistemas de <strong>gematría hebrea, inglesa o simple</strong>.
                </div>
            </div>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)">
                    <span>¿Puedo calcular frases con espacios?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">
                    ¡Sí! Esta <strong>calculadora de nombres de gematría</strong> ignora automáticamente los espacios y caracteres especiales. Ofrecemos soporte para la <strong>calculadora de nombres y significados de gematría</strong> para todos los usuarios de forma gratuita.
                </div>
            </div>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)">
                    <span>¿Qué es la calculadora de gematría inglesa?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">
                    Una <strong>Calculadora de Gematría Inglesa</strong> asigna valores numéricos a las letras del alfabeto inglés. Nuestra <strong>calculadora de gematría inglesa</strong> utiliza varias cifras como la Gematría Simple (A=1, B=2) para revelar capas ocultas de significado.
                </div>
            </div>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)">
                    <span>¿Quién debería usar la calculadora de gematría?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">
                    Una <strong>calculadora de numerología y gematría</strong> es para cualquiera que sienta curiosidad por la estructura numérica oculta del lenguaje. Es perfecta para:
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
                <div class="faq-question" onclick="toggleFAQ(this)">
                    <span>¿Qué es la calculadora de gematría judía?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">
                    Una <strong>Calculadora de Gematría Judía</strong> (o <strong>Calculadora de Gematría Hebrea</strong>) se basa en la tradición judía de asignar valores numéricos a las letras hebreas. Este tipo de <strong>calculadora de gematría hebrea</strong> es esencial para estudiar los valores numéricos de nombres y conceptos bíblicos.
                </div>
            </div>

            <!-- COPYRIGHT NOTICE -->
            <div class="copyright">
                © <?= date('Y') ?> gematriacalculators.org
            </div>
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
        </footer>
    </div>

    <div id="exitModal" class="modal">
        <div class="modal-content animate-scale">
            <button class="modal-close" id="exitModalClose" aria-label="Cerrar Modal">
                <i class="fa-solid fa-circle-xmark"></i>
            </button>
            <h2><i class="fa-solid fa-star text-primary"></i> ¡No te vayas todavía!</h2>
            <p>¿Has probado nuestras nuevas herramientas emocionantes?</p>
            <div class="modal-links">
                <a href="https://vpnleaderboard.com/" class="outline-button">
                    <i class="fa-solid fa-shield-halved"></i> VPN Leaderboard
                </a>
                <a href="http://tarotcardgenerator.online/" class="outline-button">
                    <i class="fa-solid fa-wand-magic-sparkles"></i> Lector de Tarot Diario
                </a>
                <a href="https://www.snowdayscalculatorai.com/" class="outline-button">
                    <i class="fa-solid fa-snowflake"></i> Calculadora de Días de Nieve EE.UU.
                </a>
            </div>
            <p style="margin-top: 1rem;">
                <i class="fa-solid fa-face-smile-wink fa-lg text-primary"></i>
                ¡Disfruta y vuelve pronto!
            </p>
        </div>
    </div>

    <script>
      window.GematriaLang = {
        loadingPhrases: <?= json_encode($loadingPhrases) ?>
      };
    </script>
    <script src="/scripts/index.js"></script>

</body>
</html>
