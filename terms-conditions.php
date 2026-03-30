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
    <meta name="description" content="Terms and conditions for using GematriaCalculators.org. Read our policies on acceptable use, intellectual property, disclaimers, and limitations of liability.">
    <title>Terms & Conditions – GematriaCalculators.org</title>
    <link rel="canonical" href="https://gematriacalculators.org/terms-conditions/">
    <link rel="icon" href="/assets/talisman-site-icon.png" sizes="32x32">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/styles/index.css">
    <link rel="stylesheet" href="/styles/terms-conditions.css">
  </head>

  <body>
    <?php require_once __DIR__ . '/navigation/header.php'; ?>
    <div class="container" style="padding-top: 2rem;">
      <header class="header">
        <h1>Terms & Conditions</h1>
        <p class="subtitle">(Understand the Use of Our Gematria Tools)</p>
      </header>

      <main>
        <div class="terms-page">
            <div class="terms-section">
            <h2>1. Acceptance of Terms</h2>
            <p>By accessing or using gematriacalculators.org, you agree to be bound by these Terms and Conditions. If you do not agree to these terms, please do not use this website. These terms apply to all visitors and users of the site, including all tools, blog articles, and associated pages.</p>
          </div>

          <div class="terms-section">
            <h2>2. Description of Service</h2>
            <p>GematriaCalculators.org provides free online tools for calculating gematria values and related numerological information. Services include a gematria calculator supporting Hebrew, English, and Simple systems, a gematria value decoder, and additional numerology tools including life path number, Lo Shu grid, Kua number, and name numerology calculators. All tools are provided free of charge and require no registration.</p>
          </div>

          <div class="terms-section">
            <h2>3. Educational Purpose</h2>
            <p>All content on this website — including calculation results, blog articles, and tool outputs — is intended for educational, research, and personal interest purposes only. Gematria results are based on established historical cipher systems and should not be relied upon for any medical, legal, financial, or other professional decisions. We do not provide spiritual guidance, religious instruction, or professional advice of any kind.</p>
          </div>

          <div class="terms-section">
            <h2>4. User Conduct</h2>
            <p>You agree to use this site only for lawful purposes and in a manner that does not infringe the rights of others. You may not attempt to reverse-engineer, scrape, reproduce, or commercially redistribute the calculators, their underlying code, or output data without prior written permission. Automated bulk querying of the calculators is prohibited.</p>
          </div>

          <div class="terms-section">
            <h2>5. Intellectual Property</h2>
            <p>The design, code, structure, and original written content of this website are the property of GematriaCalculators.org. The underlying gematria cipher systems themselves are ancient and in the public domain. You are welcome to share individual calculation results for personal or educational use, provided you credit the source.</p>
          </div>

          <div class="terms-section">
            <h2>6. Disclaimer of Warranties</h2>
            <p>This website and its tools are provided "as is" without any warranty of any kind, express or implied. We do not warrant that the calculations will always be accurate, that the service will be uninterrupted or error-free, or that defects will be corrected. Use of any calculation results is entirely at your own discretion and risk.</p>
          </div>

          <div class="terms-section">
            <h2>7. Limitation of Liability</h2>
            <p>To the fullest extent permitted by law, GematriaCalculators.org shall not be liable for any direct, indirect, incidental, or consequential damages arising from your use of this website, reliance on its content, or inability to access the service. This limitation applies regardless of the basis of the claim.</p>
          </div>

          <div class="terms-section">
            <h2>8. Third-Party Services</h2>
            <p>This site uses third-party services including Google Analytics, Microsoft Clarity, and Google AdSense. These services have their own terms of service and privacy policies. We are not responsible for the practices of any third-party service integrated into this site.</p>
          </div>

          <div class="terms-section">
            <h2>9. Governing Law</h2>
            <p>These terms are governed by applicable law. Any disputes arising from the use of this website shall be resolved in accordance with the laws of the jurisdiction in which this service operates.</p>
          </div>

          <div class="terms-section">
            <h2>10. Changes to These Terms</h2>
            <p>We may update these terms at any time. Changes will be posted on this page with the updated date. Continued use of the website after changes are posted constitutes acceptance of the revised terms. If you have questions about these terms, contact us at <a href="mailto:admins@gematriacalculators.org">admins@gematriacalculators.org</a>.</p>
            <p style="margin-top:1rem; color: var(--text-secondary); font-size: 0.9em;">Last updated: March 2026</p>
          </div>
        </div>
      </main>

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

    <script src="/scripts/index.js"></script>
  </body>
</html>
