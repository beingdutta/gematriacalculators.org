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
    $pageTitle = 'Calculadora de Gematría Gratuita — Hebrea, Inglesa y Simple | ' . $SITE_NAME;
  }

  // DESCRIPTION: STATIC (don't vary per query — stabilizes snippets/CTR)
  $metaDescription = 'Calculadora de Gematría gratuita en línea para sistemas Hebreo, Inglés y Simple. Calcula instantáneamente valores y significados de gematría para cualquier palabra o frase.';

  // Canonical: point root when empty; deep-link when there's an input
  $canonicalUrl = $BASE_URL . 'es/';
  if (!empty($inputRaw)) {
    // use rawurlencode for cleaner canonical with query. Point to the root URL for queries.
    $canonicalUrl .= '?input=' . rawurlencode($inputRaw);
  }

  // Open Graph / Twitter: keep short and dependable; use static description
  $ogTitle = ($results && !empty($displayInput))
    ? sprintf('%s — Valor de Gematría: %s', $displayInput, (string)$results['english']['total'])
    : 'Calculadora de Gematría Gratuita';

  // Optional: a share image you host (1200×630 recommended)
  $ogImage = $BASE_URL . 'assets/preview.jpg';
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
                <span title="中文">Chino</span>!
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
            <h1>Calculadora de Gematría</h1>
            <p class="subtitle">(Escriba una palabra o número, por ejemplo: Dios, Biblia, Hebreo, Santo – para calcular valores de gematría)</p>
        </header>

        <main class="calculator">
            <div class="input-group">
                <input
                    id="inputText"
                    type="text"
                    placeholder="Ingrese texto para calcular..."
                    value="<?= htmlspecialchars($inputRaw, ENT_QUOTES, 'UTF-8') ?>"
                />
                <button class="secondary" onclick="clearInput()" title="Limpiar">✕</button>
            </div>

            <div class="button-container">
                <button class="calculate-btn" onclick="calculate()">Calcular</button>
                <button class="download-btn" onclick="calculateAndDownload()">Descargar PDF</button>
                <a href="/es/decode-gematria-value/" class="decode-btn">Decodificar Gematría</a>
            </div>

            <div class="loading-container" id="loading" style="display:none">
                <div class="spinner"></div>
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
            <p>Esta calculadora de gematría gratuita en línea funciona como una potente calculadora de nombres y admite conversiones de inglés a gematría hebrea. Ya sea que busques una calculadora de gematría en línea para análisis bíblico o simplemente una calculadora de gematría simple para explorar significados numéricos, esta herramienta está diseñada para ti.</p>
            <div class="example">Ejemplo: <strong>Biblia</strong> = 38 (Hebreo), 180 (Inglés), 30 (Simple)</div>
        </div>

        <!-- SEO SECTION #2 -->
        <div class="seo-section">
            <p>Nuestra mejor calculadora de gematría en línea está diseñada para brindar precisión, velocidad y simplicidad. Es perfecta para estudiosos, buscadores espirituales o cualquier persona interesada en las tradiciones místicas detrás de los textos sagrados. Con nuestra calculadora de gematría hebrea, puedes decodificar pasajes bíblicos, analizar nombres espirituales o explorar conexiones esotéricas, todo en un solo lugar.</p>
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
                    Una herramienta o software de calculadora de gematría en línea gratuita que calcula automáticamente el valor numérico de una palabra, frase o nombre asignando valores numéricos a cada letra, basándose en sistemas específicos de gematría.
                </div>
            </div>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)">
                    <span>¿Cómo usar la calculadora de gematría en línea?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">
                    Para usar nuestra mejor calculadora de gematría gratuita en línea, simplemente escribe una palabra, frase o nombre en el cuadro de entrada, luego haz clic en “Calcular” para generar sus valores numéricos en los sistemas Hebreo, Inglés y Simple. Para tener un registro, también puedes descargar un informe PDF.
                </div>
            </div>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)">
                    <span>¿Cómo entender la calculadora de gematría simple?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">
                    Nuestra calculadora de gematría simple asigna A=1, B=2, C=3, … Z=26, y luego suma esos valores. Ingresa una palabra como “Verdad” y mostrará el total, que puedes comparar con otras palabras que comparten el mismo valor.
                </div>
            </div>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)">
                    <span>¿Cómo uso la calculadora de gematría de la Biblia?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">
                    Nuestra calculadora de gematría de la Biblia está diseñada para analizar textos y nombres bíblicos. Simplemente ingrese cualquier palabra o frase de la Biblia y obtendrá valores instantáneos de gematría en hebreo, inglés y simple. Nuestra calculadora es compatible con caracteres hebreos tanto modernos como bíblicos, lo que la convierte en la mejor calculadora de gematría para la investigación bíblica.
                </div>
            </div>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)">
                    <span>¿Cómo funciona el motor de búsqueda de gematría?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">
                    Nuestro motor de búsqueda de gematría le permite encontrar palabras y frases con valores numéricos específicos. Puede buscar utilizando los sistemas de gematría hebreo, inglés o simple. Esta característica es particularmente útil para la investigación bíblica y para encontrar conexiones entre diferentes palabras y conceptos.
                </div>
            </div>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)">
                    <span>¿Puedo calcular frases con espacios?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">
                    ¡Sí! Esta calculadora de nombres de gematría ignora automáticamente los espacios y caracteres especiales, centrándose solo en las letras del alfabeto. Ofrecemos soporte para la calculadora de nombres y significados de gematría para todos los usuarios en cualquier momento, 24/7 de forma gratuita. Nuestra calculadora es especialmente útil para analizar frases de varias palabras de textos religiosos.
                </div>
            </div>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)">
                    <span>¿Qué es la calculadora de gematría inglesa?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">
                    Una Calculadora de Gematría Inglesa es una herramienta que asigna valores numéricos a las letras del alfabeto inglés. A diferencia del hebreo, el inglés no tiene un único sistema antiguo, por lo que las calculadoras utilizan varias cifras como la Gematría Simple (A=1, B=2), el Ordinal Inverso (A=26, B=25) y la Reducción. Esto le permite explorar los patrones numéricos y las conexiones simbólicas entre palabras, nombres y frases en inglés, revelando capas ocultas de significado.
                </div>
            </div>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)">
                    <span>¿Quién debería usar la calculadora de gematría?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">
                    Una calculadora de gematría es para cualquiera que sienta curiosidad por la estructura numérica oculta del lenguaje. Es perfecta para:
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
                    Una Calculadora de Gematría Judía (o Calculadora de Gematría Hebrea) es una herramienta basada en la antigua tradición judía de asignar valores numéricos a las 22 letras del alfabeto hebreo. Utiliza principalmente el sistema Mispar Hechrechi (Estándar), que es fundamental para la Cábala y la interpretación de la Torá. Este tipo de calculadora es esencial para estudiar los valores numéricos de nombres, conceptos y versículos bíblicos para descubrir conexiones teológicas y místicas más profundas.
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

    <script src="/scripts/index.js"></script>

</body>
</html>
