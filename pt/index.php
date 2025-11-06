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
    $pageTitle = 'Calculadora de Gematria Gratuita — Hebraica, Inglesa e Simples | ' . $SITE_NAME;
  }

  // DESCRIPTION: STATIC (don't vary per query — stabilizes snippets/CTR)
  $metaDescription = 'Calculadora de Gematria online gratuita para sistemas Hebraico, Inglês e Simples. Calcule instantaneamente valores e significados de gematria para qualquer palavra ou frase.';

  // Canonical: point root when empty; deep-link when there's an input
  $canonicalUrl = $BASE_URL . 'pt/';
  if (!empty($inputRaw)) {
    // use rawurlencode for cleaner canonical with query. Point to the root URL for queries.
    $canonicalUrl .= '?input=' . rawurlencode($inputRaw);
  }

  // Open Graph / Twitter: keep short and dependable; use static description
  $ogTitle = ($results && !empty($displayInput))
    ? sprintf('%s — Valor de Gematria: %s', $displayInput, (string)$results['english']['total'])
    : 'Calculadora de Gematria Gratuita';

  // Optional: a share image you host (1200×630 recommended)
  $ogImage = $BASE_URL . 'assets/preview.jpg';
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>
</head>

<body>
    <nav class="header-nav">
        <a href="/pt/">Início</a>
        <a href="/more-tools/">Mais Ferramentas</a>
        <a href="/blog-collections/">Blog</a>
        <a href="/about-us/">Sobre Nós</a>
        <a href="/contact-us/">Contato</a>
        <a href="/terms-conditions/">Termos e Condições</a>
        <a href="/privacy-policy/">Política de Privacidade</a>
        <button class="theme-toggle" onclick="toggleTheme()" aria-label="Alternar tema">
          <svg class="icon-sun" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="5"></circle><line x1="12" y1="1" x2="12" y2="3"></line><line x1="12" y1="21" x2="12" y2="23"></line><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line><line x1="1" y1="12" x2="3" y2="12"></line><line x1="21" y1="12" x2="23" y2="12"></line><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line></svg>
          <svg class="icon-moon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path></svg>
        </button>
    </nav>
    
    <div class="container">
        <!-- Language Support Info -->
        <div class="language-support-info" style="background: #f0f8ff; padding: 12px; margin: 2px 0 10px 0; border-radius: 8px; text-align: center; border: 1px solid #cce5ff;">
          <p style="margin: 0; color: #004085; font-size: 13px;">
                🌍 Obrigado pela confiança! Agora suportamos vários idiomas: 
                <span title="English">inglês</span>, 
                <span title="Русский">russo</span>, 
                <span title="Deutsch">alemão</span>, 
                <span title="Español">espanhol</span>, 
                <strong>português</strong>, 
                <span title="Italiano">italiano</span>, 
                <span title="עברית">hebraico</span>, 
                <span title="Polski">polonês</span> e 
                <span title="中文">chinês</span>!
            </p>
        </div>

        <!-- ——— Recent Searches Ticker ——— -->
        <div class="recent-phrases ticker-bar">
            <h4>Pesquisas recentes:</h4>

            <!-- ——— Language Switcher ——— -->
            <?php                                    
            $qs = $_SERVER['QUERY_STRING'] ? '?'.$_SERVER['QUERY_STRING'] : '';
            $here = trim(dirname($_SERVER['SCRIPT_NAME']), '/'); // '' or 'ru' or 'de' or 'es' or 'pt'
            ?>
            <nav class="lang-switcher" aria-label="Seletor de idioma">
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
                <div class="ticker__list">
                <!-- JS will inject .ticker__item cards here -->
                </div>
            </div>
        </div>

        <header class="header">
            <img src="/assets/talisman-header-icon.png" id="themeLogo" alt="logo do site calculadora de gematria">
            <h1>Calculadora de Gematria</h1>
            <p class="subtitle">(Digite uma palavra ou número, por exemplo: Deus, Bíblia, Hebraico, Santo – para calcular valores de gematria)</p>
        </header>

        <main class="calculator">
            <div class="input-group">
                <input
                    id="inputText"
                    type="text"
                    placeholder="Digite o texto para calcular..."
                    value="<?= htmlspecialchars($inputRaw, ENT_QUOTES, 'UTF-8') ?>"
                />
                <button class="secondary" onclick="clearInput()" title="Limpar">✕</button>
            </div>

            <div class="button-container">
                <button class="calculate-btn" onclick="calculate()">Calcular</button>
                <button class="download-btn" onclick="calculateAndDownload()">Baixar PDF</button>
                <a href="/decode-gematria-value/" class="decode-btn">Decodificar Gematria</a>
            </div>

            <div class="loading-container" id="loading" style="display:none">
                <div class="spinner"></div>
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
            <p>Esta calculadora de gematria gratuita online funciona como uma poderosa calculadora de nomes e suporta conversões do inglês para gematria hebraica. Seja você esteja procurando uma calculadora de gematria online para análise bíblica ou apenas uma calculadora simples para explorar significados numéricos, esta ferramenta foi projetada para você.</p>
            <div class="example">Exemplo: <strong>Bíblia</strong> = 38 (Hebraico), 180 (Inglês), 30 (Simples)</div>
        </div>

        <!-- SEO SECTION #2 -->
        <div class="seo-section">
            <p>Nossa melhor calculadora de gematria online é projetada para precisão, velocidade e simplicidade. É perfeita para estudiosos, buscadores espirituais ou qualquer pessoa interessada nas tradições místicas por trás dos textos sagrados. Com nossa calculadora de gematria hebraica, você pode decodificar passagens bíblicas, analisar nomes espirituais ou explorar conexões esotéricas — tudo em um só lugar.</p>
        </div>

        <hr class="divider">
        <br>

        <!-- GLOBAL FEEDBACK BANNER -->
        <div class="global-feedback-message" id="globalFeedback"></div>

        <!-- FAQ & FOOTER -->
        <footer class="footer">
            <!-- FAQ ITEMS -->
            <h2 class="faq-heading">Perguntas Frequentes</h2>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)"><span>O que é Gematria?</span><svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg></div>
                <div class="faq-answer">Gematria é um código alfanumérico que atribui um valor numérico a um nome, palavra ou frase com base em suas letras. É comumente usada no misticismo judaico e na interpretação bíblica.</div>
            </div>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)"><span>O que é uma calculadora de gematria?</span><svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg></div>
                <div class="faq-answer">Uma ferramenta ou software online gratuito de calculadora de gematria que calcula automaticamente o valor numérico de uma palavra, frase ou nome, atribuindo valores numéricos a cada letra, com base em sistemas específicos de gematria.</div>
            </div>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)"><span>Como usar a Calculadora de Gematria Online?</span><svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg></div>
                <div class="faq-answer">Para usar nossa melhor calculadora de gematria online gratuita, basta digitar uma palavra, frase ou nome na caixa de entrada e clicar em “Calcular” para gerar seus valores numéricos nos sistemas Hebraico, Inglês e Simples. Para registro, você também pode baixar um relatório em PDF.</div>
            </div>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)"><span>Como entender a Calculadora de Gematria Simples?</span><svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg></div>
                <div class="faq-answer">Nossa calculadora de gematria simples atribui A=1, B=2, C=3, … Z=26, e então soma esses valores. Insira uma palavra como “Verdade” e ela retornará o total, que você pode comparar com outras palavras que compartilham o mesmo valor.</div>
            </div>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)"><span>Como eu uso a calculadora de gematria da Bíblia?</span><svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg></div>
                <div class="faq-answer">Nossa calculadora de gematria da Bíblia é projetada para analisar textos e nomes bíblicos. Basta inserir qualquer palavra ou frase da Bíblia e você obterá valores instantâneos de gematria em Hebraico, Inglês e Simples. Nossa calculadora suporta caracteres hebraicos modernos e bíblicos, tornando-a a melhor calculadora de gematria para pesquisa bíblica.</div>
            </div>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)"><span>Como funciona o motor de busca de gematria?</span><svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg></div>
                <div class="faq-answer">Nosso motor de busca de gematria permite que você encontre palavras e frases com valores numéricos específicos. Você pode pesquisar usando os sistemas de gematria Hebraico, Inglês ou Simples. Este recurso é particularmente útil para pesquisa bíblica e para encontrar conexões entre diferentes palavras e conceitos.</div>
            </div>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)"><span>Posso calcular frases com espaços?</span><svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg></div>
                <div class="faq-answer">Sim! Esta calculadora de nomes de gematria ignora automaticamente espaços e caracteres especiais, focando apenas nas letras alfabéticas. Apoiamos a calculadora de nome e significado de gematria para todos os usuários a qualquer momento, 24 horas por dia, 7 dias por semana, gratuitamente. Nossa calculadora é especialmente útil para analisar frases de várias palavras de textos religiosos.</div>
            </div>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)"><span>O que é a calculadora de gematria inglesa?</span><svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg></div>
                <div class="faq-answer">Uma Calculadora de Gematria Inglesa é uma ferramenta que atribui valores numéricos às letras do alfabeto inglês. Diferente do hebraico, o inglês não possui um único sistema antigo, então as calculadoras usam várias cifras como Gematria Simples (A=1, B=2), Ordem Inversa (A=26, B=25) e Redução. Isso permite que você explore os padrões numéricos e as conexões simbólicas entre palavras, nomes e frases em inglês, revelando camadas ocultas de significado.</div>
            </div>
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)"><span>Quem deve usar a calculadora de gematria?</span><svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg></div>
                <div class="faq-answer">
                    Uma calculadora de gematria é para qualquer pessoa curiosa sobre a estrutura numérica oculta da linguagem. É perfeita para:
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
                <div class="faq-question" onclick="toggleFAQ(this)"><span>O que é a calculadora de gematria judaica?</span><svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg></div>
                <div class="faq-answer">Uma Calculadora de Gematria Judaica (ou Calculadora de Gematria Hebraica) é uma ferramenta baseada na antiga tradição judaica de atribuir valores numéricos às 22 letras do alfabeto hebraico. Ela utiliza principalmente o sistema Mispar Hechrechi (Padrão), que é fundamental para a Cabala e a interpretação da Torá. Este tipo de calculadora é essencial para estudar os valores numéricos de nomes, conceitos e versículos bíblicos para descobrir conexões teológicas и místicas mais profundas.</div>
            </div>

            <!-- COPYRIGHT NOTICE -->
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

    <script src="/scripts/index.js"></script>

</body>
</html>
