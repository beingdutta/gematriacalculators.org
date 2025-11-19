<?php
  require_once __DIR__ . '/helpers.php';
  $SITE_NAME = 'Gematria Calculator';
  $BASE_URL = 'https://gematriacalculators.org/';
  $pageTitle = 'Disclaimer | ' . $SITE_NAME;
  $metaDescription = 'Disclaimer for Gematria Calculator. Understand the terms of use for our numerology and gematrix tools.';
  $canonicalUrl = $BASE_URL . 'disclaimer.php';
?>
<!DOCTYPE html>
<html lang="en" data-theme="light">
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8'); ?></title>
    <meta name="description" content="<?= htmlspecialchars($metaDescription, ENT_QUOTES, 'UTF-8'); ?>">
    <link rel="canonical" href="<?= htmlspecialchars($canonicalUrl, ENT_QUOTES, 'UTF-8'); ?>">
    <link rel="icon" href="/assets/talisman-site-icon.png" sizes="32x32">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="/styles/index.css">
    <link rel="stylesheet" href="/styles/privacy-policy.css">
</head>
<body>
    <?php require_once __DIR__ . '/navigation/header.php'; ?>

    <div class="container" style="padding-top: 2rem;">
      <header class="header">
        <h1>Disclaimer</h1>
        <p class="subtitle">(Terms of Use for Our Tools)</p>
      </header>

      <main>
        <div class="policy-page">
          <div class="policy-section">
            <h2>1. General Information</h2>
            <p>The information provided by Gematria Calculator (gematriacalculators.org) is for general informational and entertainment purposes only. All information on the site is provided in good faith, however, we make no representation or warranty of any kind, express or implied, regarding the accuracy, adequacy, validity, reliability, availability, or completeness of any information on the site.</p>
          </div>
          <div class="policy-section">
            <h2>2. For Entertainment Purposes Only</h2>
            <p>The gematria calculations and their interpretations are based on historical and mystical systems of numerology. They should be considered a form of entertainment and personal exploration, not as a source of factual, professional, or divine guidance. The connections and meanings derived from gematria are subjective and open to interpretation.</p>
          </div>
          <div class="policy-section">
            <h2>3. No Professional Advice</h2>
            <p>The information on this website is not intended to be a substitute for professional advice. Any reliance you place on such information is strictly at your own risk. We disclaim all liability for any decisions or actions taken based on the content of this site, whether for financial, personal, spiritual, or other matters.</p>
          </div>
          <div class="policy-section">
            <h2>4. External Links Disclaimer</h2>
            <p>The site may contain (or you may be sent through the site) links to other websites or content belonging to or originating from third parties. Such external links are not investigated, monitored, or checked for accuracy, adequacy, validity, reliability, availability, or completeness by us. We do not warrant, endorse, guarantee, or assume responsibility for the accuracy or reliability of any information offered by third-party websites linked through the site.</p>
          </div>
        </div>
      </main>
    </div>
    <script src="/scripts/index.js"></script>
</body>
</html>