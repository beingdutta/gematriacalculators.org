<!DOCTYPE html>
<?php
  require_once __DIR__ . '/helpers.php';
  $qs = $_SERVER['QUERY_STRING'] ? '?'.$_SERVER['QUERY_STRING'] : '';
  $here = trim(dirname($_SERVER['SCRIPT_NAME']), '/');
?>
<html lang="en" data-theme="light">

  <head>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/navigation/head-tracking.php'; ?>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Privacy policy for Free Gematria Calculator Online. Learn how we protect your data and respect your privacy.">
    <meta name="keywords" content="privacy policy gematria calculator, gematria calculator data, gematria online privacy">
    <title>Privacy Policy - Advanced Gematria Calculator</title>
    <link rel="canonical" href="https://gematriacalculators.org/privacy-policy/">
    <link rel="icon" href="/assets/talisman-site-icon.png" sizes="32x32">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/styles/index.css">
    <link rel="stylesheet" href="/styles/privacy-policy.css">
  </head>

  <body>
    <?php require_once __DIR__ . '/navigation/header.php'; ?>
    <div class="container" style="padding-top: 2rem;">
      <header class="header">
        <h1>Privacy Policy</h1>
        <p class="subtitle">(Your Trust is Sacred to Us)</p>
      </header>

      <main>
        <div class="policy-page">
          <p style="color: var(--text-secondary); font-size: 0.9em;">Last updated: March 2025</p>

          <div class="policy-section">
            <h2>1. Introduction</h2>
            <p>Welcome to gematriacalculators.org. This Privacy Policy explains how we collect, use, and protect your information when you visit and use our website. By using our site, you agree to the practices described in this policy.</p>
          </div>

          <div class="policy-section">
            <h2>2. Information We Collect</h2>
            <p>We collect the following types of information:</p>
            <ul>
              <li><strong>Usage data:</strong> Anonymous information about how you interact with the site, collected through Google Analytics and Microsoft Clarity (pages visited, time on site, browser type, etc.).</li>
              <li><strong>Text inputs:</strong> Words or phrases you enter into the calculator. These are processed locally in your browser and are not stored on our servers.</li>
              <li><strong>Contact form submissions:</strong> If you contact us, we collect your name and email address to respond to your inquiry.</li>
              <li><strong>Cookies:</strong> We use cookies for theme preference (light/dark mode) and analytics. See Section 5 for details.</li>
            </ul>
          </div>

          <div class="policy-section">
            <h2>3. How We Use Your Information</h2>
            <p>We use collected information to:</p>
            <ul>
              <li>Operate and improve the website and calculator tools</li>
              <li>Understand how users interact with our site so we can improve it</li>
              <li>Respond to your inquiries submitted via the contact form</li>
              <li>Display relevant advertisements through Google AdSense</li>
            </ul>
          </div>

          <div class="policy-section">
            <h2>4. Data Retention</h2>
            <p>We do not store calculator inputs on our servers. Anonymous analytics data is retained according to the default retention periods of Google Analytics (26 months). Contact form data is retained only as long as needed to respond to your inquiry.</p>
          </div>

          <div class="policy-section">
            <h2>5. Cookies and Third-Party Services</h2>
            <p>Our website uses the following third-party services, which may set their own cookies:</p>
            <ul>
              <li><strong>Google Analytics:</strong> Tracks anonymous site usage statistics. <a href="https://policies.google.com/privacy" target="_blank" rel="noopener">Google Privacy Policy</a>.</li>
              <li><strong>Google AdSense:</strong> Displays advertisements. Google may use cookies to serve ads based on your interests. <a href="https://policies.google.com/technologies/ads" target="_blank" rel="noopener">Google Ads Policy</a>.</li>
              <li><strong>Microsoft Clarity:</strong> Session recording and heatmaps for UX analysis. <a href="https://privacy.microsoft.com/en-us/privacystatement" target="_blank" rel="noopener">Microsoft Privacy Statement</a>.</li>
              <li><strong>Yandex Metrica:</strong> Analytics for Russian-language users. <a href="https://yandex.com/legal/confidential/" target="_blank" rel="noopener">Yandex Privacy Policy</a>.</li>
            </ul>
            <p>You can manage or disable cookies through your browser settings. Note that disabling cookies may affect site functionality.</p>
          </div>

          <div class="policy-section">
            <h2>6. Your Rights (GDPR / CCPA)</h2>
            <p>Depending on your location, you may have the right to:</p>
            <ul>
              <li>Access the personal data we hold about you</li>
              <li>Request correction or deletion of your personal data</li>
              <li>Object to or restrict certain processing of your data</li>
              <li>Opt out of analytics tracking by using browser extensions such as the <a href="https://tools.google.com/dlpage/gaoptout" target="_blank" rel="noopener">Google Analytics Opt-out Browser Add-on</a></li>
            </ul>
            <p>To exercise any of these rights, contact us at the address below.</p>
          </div>

          <div class="policy-section">
            <h2>7. Data Security</h2>
            <p>We use HTTPS (SSL encryption) to protect data in transit. We do not store sensitive personal information on our servers. However, no internet transmission is 100% secure, and we cannot guarantee absolute security.</p>
          </div>

          <div class="policy-section">
            <h2>8. Children's Privacy</h2>
            <p>Our website is not directed at children under 13 years of age. We do not knowingly collect personal information from children. If you believe a child has provided us with personal information, please contact us and we will delete it.</p>
          </div>

          <div class="policy-section">
            <h2>9. Changes to This Policy</h2>
            <p>We may update this Privacy Policy from time to time. Changes will be posted on this page with an updated date. Continued use of the site after changes constitutes acceptance of the updated policy.</p>
          </div>

          <div class="policy-section">
            <h2>10. Contact Us</h2>
            <p>If you have any questions about this Privacy Policy or how we handle your data, please contact us:</p>
            <p>Email: <a href="mailto:admins@gematriacalculators.org">admins@gematriacalculators.org</a><br>
              Website: <a href="/">gematriacalculators.org</a>
            </p>
          </div>

        </div>
      </main>

      <footer class="footer">
        <!-- Footer links are now in the header nav -->
        <div class="copyright">
          © 2025 gematriacalculators.org
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

    <script src="/scripts/index.js"></script>
  </body>
</html>
