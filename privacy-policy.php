<!DOCTYPE html>
<?php
  require_once __DIR__ . '/helpers.php';
  $qs = $_SERVER['QUERY_STRING'] ? '?'.$_SERVER['QUERY_STRING'] : '';
  $here = trim(dirname($_SERVER['SCRIPT_NAME']), '/');
?>
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
    <meta name="description" content="Privacy policy for Free Gematria Calculator Online. Learn how we protect your data and respect your privacy.">
    <meta name="keywords" content="privacy policy gematria calculator, gematria calculator data, gematria online privacy">
    <title>Privacy Policy - Advanced Gematria Calculator</title>
    <link rel="canonical" href="https://gematriacalculators.org/privacy-policy/">
    <link rel="icon" href="/assets/talisman-site-icon.png" sizes="32x32">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/styles/index.css">
    <link rel="stylesheet" href="/styles/privacy-policy.css">
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4198904821948931" crossorigin="anonymous"></script>

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
          <div class="policy-section">
            <h2>1. Introduction</h2>
            <p>Welcome to gematriacalculator.org ("Advanced Gematria Calculator"), your premier online resource for <strong>hebrew gematria calculator</strong>, <strong>biblical gematria calculator</strong>, and <strong>english gematria calculator</strong> services. This privacy policy explains how we handle information for our <strong>gematria calculator app</strong> and web platform.</p>
          </div>

          <div class="policy-section">
            <h2>2. Information Collection</h2>
            <p>Our <strong>gematria numerology calculator</strong> and <strong>gematria name calculator</strong> tools are designed with privacy in mind. We only collect:</p>
            <ul>
              <li>Text inputs for <strong>gematria value calculator</strong> processing</li>
              <li>Anonymous usage statistics for our <strong>gematria calculator online</strong> services</li>
              <li>Optional email addresses for <strong>gematria effect calculator</strong> result notifications</li>
            </ul>
          </div>

          <div class="policy-section">
            <h2>3. Data Usage</h2>
            <p>Information collected through our <strong>jewish gematria calculator</strong> and <strong>simple gematria calculator</strong> tools is used to:</p>
            <ul>
              <li>Provide accurate <strong>numerology gematria calculator</strong> results</li>
              <li>Improve <strong>gematria.com calculator</strong> functionality</li>
              <li>Enhance user experience for <strong>bible gematria calculator</strong> operations</li>
            </ul>
          </div>

          <div class="policy-section">
            <h2>4. Data Protection</h2>
            <p>We implement industry-standard security measures for our <strong>gematria calculator hebrew</strong> and <strong>gematria calculator english</strong> services, including:</p>
            <ul>
              <li>SSL encryption for all <strong>gematria calculator names</strong> calculations</li>
              <li>Regular security audits of our <strong>gematria calculator app</strong> infrastructure</li>
              <li>Limited data retention for <strong>gematria value calculator</strong> inputs</li>
            </ul>
          </div>

          <div class="policy-section">
            <h2>5. Third-Party Services</h2>
            <p>Our <strong>gematria numerology calculator</strong> may use:</p>
            <ul>
              <li>Google Analytics for <strong>gematria calculator online</strong> usage tracking</li>
              <li>Ad networks for <strong>biblical gematria calculator</strong> service support</li>
              <li>Cloud hosting for <strong>hebrew gematria calculator</strong> operations</li>
            </ul>
          </div>

          <div class="policy-section">
            <h2>6. User Rights</h2>
            <p>Users of our <strong>gematria calculator app</strong> and web tools can:</p>
            <ul>
              <li>Request deletion of <strong>gematria name calculator</strong> history</li>
              <li>Opt-out of <strong>gematria effect calculator</strong> notifications</li>
              <li>Access collected data from <strong>gematria.com calculator</strong> services</li>
            </ul>
          </div>

          <div class="policy-section">
            <h2>7. Policy Changes</h2>
            <p>Updates to this privacy policy for our <strong>english gematria calculator</strong> and other tools will be posted on this page. Continued use of our <strong>jewish gematria calculator</strong> services constitutes acceptance of changes.</p>
          </div>

          <div class="policy-section">
            <h2>8. Contact Us</h2>
            <p>For questions about our <strong>simple gematria calculator</strong> privacy practices:</p>
            <p>Email: admins@gematriacalculator.org<br>
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
