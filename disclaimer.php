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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8'); ?></title>
    <meta name="description" content="<?= htmlspecialchars($metaDescription, ENT_QUOTES, 'UTF-8'); ?>">
    <link rel="canonical" href="<?= htmlspecialchars($canonicalUrl, ENT_QUOTES, 'UTF-8'); ?>">
    <link rel="icon" href="/assets/talisman-site-icon.png" sizes="32x32">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="/styles/index.css">
    <style>
        .container { max-width: 800px; margin: 2rem auto; padding: 0 1rem; }
        .content-section { background: var(--background-color); padding: 2rem; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.05); }
        h1 { text-align: center; margin-bottom: 1.5rem; }
        h2 { margin-top: 1.5rem; }
        p, li { line-height: 1.6; }
    </style>
</head>
<body>
    <?php require_once __DIR__ . '/navigation/header.php'; ?>

    <div class="container">
        <div class="content-section">
            <h1>Disclaimer</h1>
            <p>The information provided by Gematria Calculator (gematriacalculators.org) is for general informational and entertainment purposes only. All information on the site is provided in good faith, however, we make no representation or warranty of any kind, express or implied, regarding the accuracy, adequacy, validity, reliability, availability, or completeness of any information on the site.</p>

            <h2>For Entertainment Purposes Only</h2>
            <p>The gematria calculations and their interpretations are based on historical and mystical systems of numerology. They should be considered a form of entertainment and personal exploration, not as a source of factual, professional, or divine guidance. The connections and meanings derived from gematria are subjective and open to interpretation.</p>

            <h2>No Professional Advice</h2>
            <p>The information on this website is not intended to be a substitute for professional advice. Any reliance you place on such information is strictly at your own risk. We disclaim all liability for any decisions or actions taken based on the content of this site, whether for financial, personal, spiritual, or other matters.</p>

            <h2>External Links Disclaimer</h2>
            <p>The site may contain (or you may be sent through the site) links to other websites or content belonging to or originating from third parties. Such external links are not investigated, monitored, or checked for accuracy, adequacy, validity, reliability, availability, or completeness by us. We do not warrant, endorse, guarantee, or assume responsibility for the accuracy or reliability of any information offered by third-party websites linked through the site.</p>
        </div>
    </div>
</body>
</html>