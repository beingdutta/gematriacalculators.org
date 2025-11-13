<?php
  require_once __DIR__ . '/helpers.php';
  $SITE_NAME = 'Gematria Calculator';
  $BASE_URL = 'https://gematriacalculators.org/';
  $pageTitle = 'Privacy & GDPR Policy | ' . $SITE_NAME;
  $metaDescription = 'Privacy and GDPR policy for Gematria Calculator. Learn how we handle your data and respect your privacy.';
  $canonicalUrl = $BASE_URL . 'gdpr.php';
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
        ul { padding-left: 20px; }
    </style>
</head>
<body>
    <?php require_once __DIR__ . '/navigation/header.php'; ?>

    <div class="container">
        <div class="content-section">
            <h1>Privacy & GDPR Policy</h1>
            <p>Your privacy is important to us. This policy outlines the types of personal information we receive and collect when you use Gematria Calculator, as well as some of the steps we take to safeguard information.</p>

            <h2>Data We Collect</h2>
            <ul>
                <li><strong>Calculator Input:</strong> We process the text you enter into the calculator to provide you with gematria values. This data is processed on our server but is not stored or associated with you.</li>
                <li><strong>Analytics Data:</strong> We use Google Analytics and Microsoft Clarity to understand how our visitors use the site. This includes anonymous data such as your browser type, device, country, and pages visited. This helps us improve the user experience. These services may capture how you use and interact with our site through behavioral metrics, heatmaps, and session replay.</li>
                <li><strong>Advertising Data:</strong> We use Google AdSense to display ads. Google and its partners use cookies to serve ads based on your prior visits to this website or other websites. You may opt out of personalized advertising by visiting <a href="https://www.google.com/settings/ads" target="_blank" rel="noopener noreferrer">Ads Settings</a>.</li>
                <li><strong>Feedback:</strong> If you provide feedback through our feedback form or by email, we will collect your comments and the associated emoji/rating to improve our service.</li>
            </ul>

            <h2>Your Rights Under GDPR</h2>
            <p>If you are a resident of the European Economic Area (EEA), you have certain data protection rights. These include:</p>
            <ul>
                <li>The right to access, update, or delete the information we have on you.</li>
                <li>The right of rectification.</li>
                <li>The right to object.</li>
                <li>The right of restriction.</li>
                <li>The right to data portability.</li>
                <li>The right to withdraw consent.</li>
            </ul>
            <p>Since we do not store personal data from calculator usage, these rights primarily apply to any correspondence you may have with us via email.</p>

            <h2>Cookies</h2>
            <p>We use cookies to enhance your experience. Third-party services like Google Analytics and Google AdSense also use cookies to function. You can instruct your browser to refuse all cookies or to indicate when a cookie is being sent.</p>

            <h2>Contact Us</h2>
            <p>If you have any questions about this Privacy Policy, please contact us at <a href="mailto:admins@gematriacalculators.org">admins@gematriacalculators.org</a>.</p>
        </div>
    </div>
</body>
</html>