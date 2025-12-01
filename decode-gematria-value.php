<!DOCTYPE html>
<?php
  require_once __DIR__ . '/helpers.php';
  $qs = $_SERVER['QUERY_STRING'] ? '?'.$_SERVER['QUERY_STRING'] : '';
  $here = trim(dirname($_SERVER['SCRIPT_NAME']), '/');
?>
<html lang="en" data-theme="light">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="Decode English Gematria totals to get the best-effort letter mappings. Reverse gematria decoding based on numerical values.">
    <meta name="keywords" content="decode gematria, reverse gematria calculator, gematria value decode, gematria letter sequence, gematria english decoder">
    <title>Decode Gematria Values - Free Gematria Calculator</title>
    <link rel="canonical" href="https://gematriacalculators.org/decode-gematria-value/">
    <link rel="icon" href="/assets/talisman-site-icon.png" sizes="32x32">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/styles/index.css">

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

    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "FAQPage",
      "mainEntity": [{
        "@type": "Question",
        "name": "What does decoding a gematria value mean?",
        "acceptedAnswer": {
          "@type": "Answer",
          "text": "Decoding attempts to reverse-map numerical totals back to possible letter combinations. It's a best-effort approximation and not always one-to-one."
        }
      },{
        "@type": "Question",
        "name": "Can gematria values be reversed with 100% accuracy?",
        "acceptedAnswer": {
          "@type": "Answer",
          "text": "No. Since multiple combinations can lead to the same total, it's impossible to decode with perfect accuracy, especially when using scaled systems like English Gematria."
        }
      },{
        "@type": "Question",
        "name": "What is the logic behind your decoder?",
        "acceptedAnswer": {
          "@type": "Answer",
          "text": "It divides the input total by 6 (for English Gematria), then greedily peels off letters from Z to A whose values add up to the original sum."
        }
      }]
    }
    </script>

  </head>

  <body>
    <?php require_once __DIR__ . '/navigation/header.php'; ?>
    <div class="container">

      <header class="header">
        <h1>Decode Gematria Values</h1>
        <p class="subtitle">
          Paste your English Gematria totals (e.g. <code>312</code> or <code>312, 678</code>)
          to get a best-effort letter sequence.
        </p>
        <p class="note" style="color: var(--error); font-weight: 500; margin-top: 0.75rem;">
          ⚠️ 100% accuracy in decoding gematria values is not guaranteed due to mathematical limitations.
        </p>
      </header>

      <main class="calculator">
        <div class="input-group">
          <input id="decodeInput" type="text" placeholder="Enter totals, e.g. 312 678 978" />
          <button class="secondary" onclick="clearDecodeInput()" title="Clear">✕</button>
        </div>

        <div class="button-container">
          <button class="calculate-btn" onclick="decode()">Decode Gematria Value</button>
        </div>

        <div class="loading-container" id="loading">
          <div class="spinner"></div>
        </div>

        <div class="result" id="decodeResult" style="display: none; border: none; box-shadow: none; padding: 1rem; background: var(--background-alt); text-align: center;">
          <h3 style="margin: 0; font-size: 1.1rem;">
            Decoded Text: <span id="decodedText" style="word-break: break-all; overflow-wrap: break-word; color: var(--primary-color); font-weight: 600;"></span>
          </h3>
        </div>
      </main>

      <!-- FAQ SECTION -->
      <div class="faq-item">
        <div class="faq-question">
          <span>What does decoding a gematria value mean?</span>
          <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
        </div>
        <div class="faq-answer">
          Decoding attempts to reverse-map numerical totals back to possible letter combinations. It's a best-effort approximation and not always one-to-one.
        </div>
      </div>

      <div class="faq-item">
        <div class="faq-question">
          <span>Can gematria values be reversed with 100% accuracy?</span>
          <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
        </div>
        <div class="faq-answer">
          No. Since multiple combinations can lead to the same total, it's impossible to decode with perfect accuracy, especially when using scaled systems like English Gematria.
        </div>
      </div>

      <div class="faq-item">
        <div class="faq-question">
          <span>What is the logic behind your decoder?</span>
          <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
        </div>
        <div class="faq-answer">
          It divides the input total by 6 (for English Gematria), then greedily peels off letters from Z to A whose values add up to the original sum.
        </div>
      </div>

      <!-- FOOTER -->
      <footer class="footer">
        <!-- Footer links are now in the header nav -->
        <div class="copyright">
          © <?= date('Y') ?> gematriacalculators.org
        </div>
        <!-- Language Popup -->
        <div class="lang-popup">
            <div class="lang-popup-content">
                <button class="lang-popup-close" onclick="closeLangPopup()">&times;</button>
                <h4>Select Language</h4>
                <div class="lang-grid">
                    <a href="<?= BASE_URL . ltrim($qs, '?') ?>">English</a>
                    <a href="<?= BASE_URL . 'ru/' . ltrim($qs, '?') ?>">Русский</a>
                    <a href="<?= BASE_URL . 'de/' . ltrim($qs, '?') ?>">Deutsch</a>
                    <a href="<?= BASE_URL . 'es/' . ltrim($qs, '?') ?>">Español</a>
                    <a href="<?= BASE_URL . 'pt/' . ltrim($qs, '?') ?>">Português</a>
                    <a href="<?= BASE_URL . 'it/' . ltrim($qs, '?') ?>">Italiano</a>
                    <a href="<?= BASE_URL . 'iw/' . ltrim($qs, '?') ?>">עברית</a>
                    <a href="<?= BASE_URL . 'pl/' . ltrim($qs, '?') ?>">Polski</a>
                    <a href="<?= BASE_URL . 'zh/' . ltrim($qs, '?') ?>">中文</a>
                </div>
            </div>
        </div>
      </footer>
    </div>

    <script src="/scripts/decode.js"></script>
    <script src="/scripts/index.js"></script>
  </body>
</html>
