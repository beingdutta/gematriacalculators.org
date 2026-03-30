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
    <meta name="description" content="Learn about GematriaCalculators.org — a free tool for Hebrew, English, and Simple Gematria calculations. Understand how each system works and what the calculator provides.">
    <title>About GematriaCalculators.org – How It Works & What We Offer</title>
    <link rel="icon" href="/assets/talisman-site-icon.png" sizes="32x32">
    <link rel="canonical" href="https://gematriacalculators.org/about-us/">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/styles/index.css">
    <link rel="stylesheet" href="/styles/about-us.css">
  </head>

  <body>
    <?php require_once __DIR__ . '/navigation/header.php'; ?>
    <div class="container" style="padding-top: 2rem;">
      <header class="header">
        <h1>About GematriaCalculators.org</h1>
        <p class="subtitle">How the calculator works, what systems it uses, and who it's for</p>
      </header>

      <main>
        <div class="result-card about-content">

          <h2>What Is GematriaCalculators.org?</h2>
          <p>GematriaCalculators.org is a free online tool for calculating the gematria value of any word, name, or phrase. The calculator supports three systems — Hebrew Gematria, English Gematria, and Simple Gematria — and displays the full letter-by-letter breakdown alongside the final total so you can verify every result yourself.</p>

          <p>The site was built to make gematria accessible to anyone with an interest in biblical study, Jewish mysticism, or numerology, without requiring prior knowledge of Hebrew or ancient ciphers. Whether you are a biblical scholar cross-referencing verse passages, a student learning about the Kabbalah, or simply curious about the numerical value of your own name, the calculator works the same way for everyone — type a word, click Calculate, and get your answer instantly.</p>

          <h2>The Three Calculation Systems</h2>

          <div class="result-card">
            <h3>Hebrew Gematria</h3>
            <p>Hebrew Gematria follows the traditional Mispar Hechrechi method, which assigns numerical values to the 22 letters of the Hebrew alphabet as they appear in the Torah. Aleph = 1, Bet = 2, Gimel = 3, continuing through the alphabet to Tav = 400. This system has been used for over two thousand years in Jewish scripture interpretation. When two different Hebrew words share the same numerical value, it is taken as evidence of a deeper conceptual connection between them. This is the foundational system used in Kabbalistic analysis of the Torah and Talmud.</p>
          </div>

          <div class="result-card">
            <h3>Simple Gematria</h3>
            <p>Simple Gematria assigns values based on the position of each letter in the English alphabet: A = 1, B = 2, C = 3, and so on through Z = 26. It is the most straightforward modern system and is commonly used as an entry point for people new to gematria. Because it requires no knowledge of Hebrew and uses familiar letters, it is widely applied to English words, names, and phrases. The simplicity of the cipher makes the results easy to verify by hand.</p>
          </div>

          <div class="result-card">
            <h3>English Gematria</h3>
            <p>English Gematria multiplies each letter's ordinal value by 6, giving A = 6, B = 12, C = 18, through Z = 156. This system is widely used in modern numerological analysis and produces larger values that some practitioners believe carry additional significance. The multiplication by 6 connects the system to various symbolic frameworks, including the six directions of space in sacred geometry and the six days of creation in biblical tradition.</p>
          </div>

          <h2>What the Calculator Provides</h2>
          <p>For each input, the calculator returns three values — one for each system — along with the complete calculation breakdown showing how each letter contributes to the total. Results can be exported as a PDF report, which includes the word or phrase, all three gematria values, and the full letter-by-letter calculation. The site also includes a Gematria Decoder that works in reverse: enter a number and find all known words and phrases that share that value.</p>

          <h2>Additional Tools</h2>
          <p>Beyond gematria, the site offers several related numerology tools: a Life Path Number Calculator based on birth date, a Lo Shu Grid chart generator, a Kua Number Calculator for Feng Shui, a Name Numerology Calculator for Destiny and Soul Urge numbers, and an Angel Number Decoder. These tools are offered free of charge with no registration required.</p>

          <h2>Our Approach to Accuracy</h2>
          <p>Every cipher is implemented according to its established historical definition. The Hebrew values follow the standard Mispar Hechrechi table used in academic and religious scholarship. The English and Simple systems follow their most widely documented definitions. Where the implementation deviates from niche variants of these systems, we note it explicitly. We do not interpret results — the calculator shows you the numbers and the calculation method; what those numbers mean is left to your own research and judgment.</p>

          <h2>Contact and Feedback</h2>
          <p>If you find an error in a calculation, want to suggest a feature, or have a question about how a system is implemented, you can reach us at <a href="mailto:admins@gematriacalculators.org">admins@gematriacalculators.org</a>. We read every message and use the feedback to improve the tool.</p>

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
