<?php
  // index.php
  // 1) pull in your calculate.php (which defines gematria() and also handles AJAX POSTs)
  require_once __DIR__ . '/../calculate.php';
  require_once __DIR__ . '/../helpers.php';

  // 2) fetch the URL‐param (for deep-linking) and, if present, run the server-side calculation
  $inputRaw = $_GET['input'] ?? '';
  $results  = $inputRaw !== '' ? gematria($inputRaw) : null;

  // SEO: make description STATIC, keep title concise (optionally dynamic)
  $SITE_NAME        = 'Calculadora de Gematria';
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
      '%s — Valor de Gematria: %s | %s',
      ucfirst($displayInput),
      (string)$results['english']['total'],
      $SITE_NAME
    );
  } else {
    $pageTitle = 'Calculadora de Gematria Gratuita — Gematrix e Numerologia | ' . $SITE_NAME;
  }

  // DESCRIPTION: STATIC (don't vary per query — stabilizes snippets/CTR)
  $metaDescription = 'A melhor Calculadora de Gematria gratuita. Obtenha resultados instantâneos e precisos com nossa ferramenta de gematrix e numerologia, compatível com Gematria Inglesa, Hebraica e Simples. Perfeita para análise bíblica e decodificação de valores.';

  // Canonical: point root when empty; deep-link when there's an input
  $canonicalUrl = $BASE_URL . 'pt/';
  if (!empty($inputRaw)) {
    // use rawurlencode for cleaner canonical with query. Point to the root URL for queries.
    $canonicalUrl .= '?input=' . rawurlencode($inputRaw);
  }

  // Open Graph / Twitter: keep short and dependable; use static description
  $ogTitle = ($results && !empty($displayInput))
    ? sprintf('%s — Valor de Gematria: %s', $displayInput, (string)$results['english']['total'])
    : 'Calculadora de Gematria Gratuita — Gematrix e Numerologia';

  // Optional: a share image you host (1200×630 recommended)
  $ogImage = $BASE_URL . 'assets/preview.jpg';

  $loadingPhrases = [
    "Traduzindo palavras em números...",
    "Invocando os códigos da criação...",
    "Decodificando os padrões numéricos ocultos...",
    "Alinhando letras com valores divinos...",
    "Calculando sua sequência de gematria...",
    "Traçando a soma vibracional do seu nome...",
    "Revelando o significado secreto nos números..."
  ];
?>

<!DOCTYPE html>
<html lang="pt" data-theme="light">
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

    <meta charset="UTF-8">
    <meta name="p:domain_verify" content="9a2f772bde6a1162d2e6c441caf23a2a"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Keep keywords minimal or remove (search engines largely ignore this) -->
    <meta name="keywords" content="calculadora de gematria, gematria hebraica, gematria inglesa, gematria simples">

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
      "name": "Calculadora de Gematria",
      "url": "<?= htmlspecialchars($BASE_URL . 'pt/', ENT_QUOTES, 'UTF-8'); ?>",
      "description": "Calculadora online gratuita para valores de gematria Hebraica, Inglesa e Simples.",
      "applicationCategory": "Calculator",
      "operatingSystem": "Any",
      "inLanguage": "pt"
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
            <h4>Pesquisas recentes:</h4>

            <div class="ticker">
                <div class="ticker__list">
                <!-- JS will inject .ticker__item cards here -->
                </div>
            </div>
        </div>

        <header class="header">
            <img src="/assets/talisman-header-icon.png" id="themeLogo" alt="logo do site calculadora de gematria">
            <h1>Calculadora de Gematria (Gematrix)</h1>
            <p class="subtitle">(Digite uma palavra, nome ou número, por exemplo: Deus, Bíblia, Hebraico – para calcular valores de gematria online)</p>
        </header>

        <main class="calculator">
            <div class="input-group">
                <input
                    id="inputText"
                    type="text"
                    placeholder="Calcular gematria do meu nome..."
                    value="<?= htmlspecialchars($inputRaw, ENT_QUOTES, 'UTF-8') ?>"
                />
                <button class="secondary" onclick="clearInput()" title="Limpar">✕</button>
            </div>

            <div class="button-container">
                <button class="calculate-btn" onclick="calculate()">Calcular Gematria</button>
                <button class="download-btn" onclick="calculateAndDownload()">Baixar PDF</button>
                <a href="/decode-gematria-value.php" class="decode-btn">Decodificar Gematria</a>
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
                    <div class="copy-notification" id="hebrewCopyNotification">Copiado!</div>
                    <h3>Gematria Hebraica: <span id="hebrewValue">
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
                    <div class="copy-notification" id="englishCopyNotification">Copiado!</div>
                    <h3>Gematria Inglesa: <span id="englishValue">
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
                    <div class="copy-notification" id="simpleCopyNotification">Copiado!</div>
                    <h3>Gematria Simples: <span id="simpleValue">
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
                        <p style="margin: 0; font-weight: 600; font-size: 1.05em;">Expanda Sua Visão Além dos Números</p>
                        <p style="margin: 6px 0 0 0; font-size: 0.9em;">Enquanto a gematria revela o código numérico oculto em sua vida, o tarô oferece um caminho diferente para a sabedoria. Combine a lógica dos números com a intuição das cartas para obter uma perspectiva mais completa. Busque orientação em nosso Leitor de Tarot Diário gratuito para complementar sua jornada.</p>
                    </div>
                    <a href="https://tarotcardgenerator.online/" target="_blank" class="promo-btn" style="white-space: nowrap; margin-top: 1rem;">
                        Obtenha uma Leitura de Tarot Gratuita
                    </a>
                </div>
                <div class="feedback">
                    <p>Esta calculadora foi útil?</p>
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
            Para feedback, sugestões ou melhorias desta ferramenta, envie um e-mail para <a href="mailto:admins@gematriacalculators.org" style="color: var(--error); text-decoration: underline;">admins@gematriacalculators.org</a>.
        </p>

        <!-- SEO SECTION #1 -->
        <div class="seo-section">
            <h4>Descubra Significados Numéricos Ocultos</h4>
            <p>Esta calculadora de gematria gratuita online funciona como uma poderosa calculadora de nomes de gematria e suporta conversões da gematria inglesa para a hebraica. Quer esteja à procura de uma calculadora de gematria online para análise bíblica ou apenas uma calculadora de gematria simples para explorar significados numéricos, esta ferramenta foi concebida para si. Os utilizadores procuram frequentemente termos como "calculadora gematria" ou "gematria calculater", e a nossa ferramenta satisfaz essa necessidade.</p>
            <div class="example">Exemplo: Bíblia = 38 (Hebraico), 180 (Inglês), 30 (Simples)</div>
        </div>

        <!-- MORE TOOLS SECTION -->
        <section class="more-tools-section">
            <h2>Explore mais ferramentas para orientação diária</h2>
            <div class="tool-grid">
                <?php
                    $tools = [
                        ['title' => 'Calculadora de Pontuação Vastu Simples', 'desc' => 'Obtenha uma pontuação rápida de conformidade Vastu para sua casa.', 'icon' => '<i class="fa-solid fa-house"></i>', 'url' => '/more-tools/simple-vastu-score-calculator.php'],
                        ['title' => 'Calculadora de Número Kua', 'desc' => 'Encontre suas direções da sorte do Feng Shui para o sucesso.', 'icon' => '<i class="fa-solid fa-compass"></i>', 'url' => '/more-tools/kua-number-calculator.php'],
                        ['title' => 'Decodificador de Números de Anjo', 'desc' => 'Descubra mensagens do universo nos números.', 'icon' => '<i class="fa-solid fa-wand-magic-sparkles"></i>', 'url' => '/more-tools/angel-number-decoder.php'],
                        ['title' => 'Calculadora de Número do Caminho da Vida', 'desc' => 'Descubra o seu destino principal a partir da sua data de nascimento.', 'icon' => '<i class="fa-solid fa-route"></i>', 'url' => '/more-tools/life-path-number-calculator.php'],
                        ['title' => 'Calculadora de Grade Loshu', 'desc' => 'Mapeie sua grade de energia numerológica.', 'icon' => '<i class="fa-solid fa-table-cells"></i>', 'url' => '/more-tools/loshu-grid.php'],
                        ['title' => 'Calculadora de Numerologia do Nome', 'desc' => 'Calcule seus números de Destino e Desejo da Alma.', 'icon' => '<i class="fa-solid fa-signature"></i>', 'url' => '/more-tools/name-numerology-calculator.php'],
                    ];

                    foreach ($tools as $tool) {
                        echo '
                        <div class="tool-card">
                            <div class="tool-icon">'.$tool['icon'].'</div>
                            <h3>'.$tool['title'].'</h3>
                            <p>'.$tool['desc'].'</p>
                            <a href="'.$tool['url'].'" class="calculate-btn">Abrir Ferramenta</a>
                        </div>';
                    }
                ?>
            </div>
        </section>

        <!-- SEO SECTION #2 -->
        <div class="seo-section">
            <p>Nossa melhor calculadora de gematria (muitas vezes referida como gematrix) é projetada para precisão e simplicidade. É perfeita para estudiosos, buscadores espirituais ou qualquer pessoa interessada nos textos sagrados. Com nossa calculadora de gematria hebraica, você pode usar nosso decodificador de gematria para analisar nomes espirituais ou explorar conexões esotéricas. Experimente a calculadora de gematria simples gratuita hoje e mergulhe no mundo dos números com confiança. É uma ótima alternativa ao Gematrix.org.</p>
        </div>

        <!-- GLOBAL FEEDBACK BANNER -->
        <div class="global-feedback-message" id="globalFeedback"></div>

        <!-- Language Popup -->
        <div class="lang-popup">
            <div class="lang-popup-content">
                <button class="lang-popup-close" onclick="closeLangPopup()">&times;</button>
                <h4>Selecionar Idioma</h4>
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
            <h2 class="faq-heading">Perguntas Frequentes</h2>
            <div class="faq-item">
                <div class="faq-question">
                    <span>O que é Gematria?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">A Gematria é um código alfanumérico que atribui um valor numérico a um nome, palavra ou frase com base em suas letras. É comumente usada no misticismo judaico e na interpretação bíblica.</div>
            </div>
            <div class="faq-item">
                <div class="faq-question">
                    <span>O que é uma calculadora de gematria?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">Uma <strong>calculadora de gematria gratuita</strong> é uma ferramenta online que calcula automaticamente o valor numérico de uma palavra ou frase. Funciona como um <strong>gerador de gematria</strong> moderno baseado em sistemas de numerologia antigos.</div>
            </div>
            <div class="faq-item">
                <div class="faq-question">
                    <span>Como usar a Calculadora de Gematria Online?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">Para usar nossa melhor <strong>calculadora de gematria online gratuita</strong>, basta digitar uma palavra ou frase na caixa de entrada e clicar em “Calcular Gematria” para gerar seus valores nos sistemas Hebraico, Inglês e Simples.</div>
            </div>
            <div class="faq-item">
                <div class="faq-question">
                    <span>Como entender a Calculadora de Gematria Simples?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">Nossa <strong>calculadora de gematria simples</strong> atribui A=1, B=2, C=3, … Z=26, e então soma esses valores. Insira uma palavra como “Verdade” e ela retornará o total, que você pode comparar com outras palavras que compartilham o mesmo valor.</div>
            </div>
            <div class="faq-item">
                <div class="faq-question">
                    <span>Como eu uso a calculadora de gematria da Bíblia?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">Nossa <strong>calculadora de gematria da Bíblia</strong> é projetada para analisar textos e nomes bíblicos. Você obterá valores instantâneos de <strong>gematria hebraica, inglesa e simples</strong>. Nossa calculadora suporta caracteres hebraicos, tornando-a a melhor <strong>calculadora de gematria para pesquisa bíblica</strong>. Também apoiamos os princípios da <strong>calculadora de gematria grega</strong>.</div>
            </div>
            <div class="faq-item">
                <div class="faq-question">
                    <span>Como funciona o motor de busca de gematria?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">Nosso <strong>motor de busca de gematria</strong> e <strong>decodificador de gematria</strong> permitem que você encontre palavras com valores numéricos específicos. Você pode pesquisar usando os sistemas de <strong>gematria hebraica, inglesa ou simples</strong>.</div>
            </div>
            <div class="faq-item">
                <div class="faq-question">
                    <span>Posso calcular frases com espaços?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">Sim! Esta <strong>calculadora de nomes de gematria</strong> ignora automaticamente espaços e caracteres especiais. Apoiamos a <strong>calculadora de nome e significado de gematria</strong> para todos os usuários gratuitamente.</div>
            </div>
            <div class="faq-item">
                <div class="faq-question">
                    <span>O que é a calculadora de gematria inglesa?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">Uma <strong>Calculadora de Gematria Inglesa</strong> atribui valores numéricos às letras do alfabeto inglês. Nossa <strong>calculadora de gematria inglesa</strong> usa várias cifras como Gematria Simples (A=1, B=2) para revelar camadas ocultas de significado.</div>
            </div>
            <div class="faq-item">
                <div class="faq-question">
                    <span>Quem deve usar a calculadora de gematria?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">
                    Uma calculadora de numerologia e gematria é para qualquer pessoa curiosa sobre a estrutura numérica oculta da linguagem. É perfeita para:
                    <ul>
                        <li>Buscadores espirituais explorando textos sagrados como a Bíblia.</li>
                        <li>Escritores e artistas em busca de inspiração criativa e profundidade simbólica.</li>
                        <li>Aficionados por história interessados em métodos de interpretação antigos.</li>
                        <li>Entusiastas da numerologia analisando nomes, datas e conceitos.</li>
                        <li>Qualquer pessoa que ame quebra-cabeças e encontrar padrões ocultos no mundo ao seu redor.</li>
                    </ul>
                </div>
            </div>
            <div class="faq-item">
                <div class="faq-question">
                    <span>O que é a calculadora de gematria judaica?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">Uma <strong>Calculadora de Gematria Judaica</strong> (ou <strong>Calculadora de Gematria Hebraica</strong>) é baseada na tradição judaica de atribuir valores numéricos às letras hebraicas. Este tipo de <strong>calculadora de gematria hebraica</strong> é essencial para estudar os valores numéricos de nomes e conceitos bíblicos.</div>
            </div>
        </section>

        <!-- FOOTER -->
        <footer class="footer">
            <div class="copyright">
                © <?= date('Y') ?> gematriacalculators.org
            </div>
        </footer>
    </div>

    <div id="exitModal" class="modal">
        <div class="modal-content animate-scale">
            <button class="modal-close" id="exitModalClose" aria-label="Fechar Modal">
                <i class="fa-solid fa-circle-xmark"></i>
            </button>
            <h2><i class="fa-solid fa-star text-primary"></i> Não Vá Embora Ainda!</h2>
            <p>Você já experimentou nossas novas ferramentas?</p>
            <div class="modal-links">
                <a href="https://vpnleaderboard.com/" class="outline-button">
                    <i class="fa-solid fa-shield-halved"></i> VPN Leaderboard
                </a>
                <a href="http://tarotcardgenerator.online/" class="outline-button">
                    <i class="fa-solid fa-wand-magic-sparkles"></i> Leitor de Tarot Diário
                </a>
                <a href="https://www.snowdayscalculatorai.com/" class="outline-button">
                    <i class="fa-solid fa-snowflake"></i> Calculadora de Dias de Neve EUA
                </a>
            </div>
            <p style="margin-top: 1rem;">
                <i class="fa-solid fa-face-smile-wink fa-lg text-primary"></i>
                Aproveite e volte logo!
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
