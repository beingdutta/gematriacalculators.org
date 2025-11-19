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
    <meta name="description" content="About Free Gematria Calculator Online - Learn about our mission to provide the best numerology calculation tools for spiritual and biblical research.">
    <meta name="keywords" content="about gematria calculator, gematria calculator team, numerology tool mission, biblical numerology about">
    <title>About Our Free Gematria Calculator Online</title>
    <link rel="icon" href="/assets/talisman-site-icon.png" sizes="32x32">
    <link rel="canonical" href="https://gematriacalculators.org/about-us/">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/styles/index.css">
    <link rel="stylesheet" href="/styles/about-us.css">
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4198904821948931" crossorigin="anonymous"></script>
  </head>

  <body>
    <?php require_once __DIR__ . '/navigation/header.php'; ?>
    <div class="container" style="padding-top: 2rem;">
      <header class="header">
        <h1>About Our Free Gematria Calculator</h1>
        <p class="subtitle">(Discover the Story Behind Your Favorite Numerology Tool)</p>
      </header>

      <main>
        <div class="result-card about-content">
          <h4>Our Spiritual Numerology Mission</h4>
          <p>Founded in 2025, Free Gematria Calculator Online was created by a team of numerology enthusiasts and software developers passionate about making ancient wisdom accessible in the digital age. Our journey began when we recognized the need for a reliable, user-friendly tool that could handle multiple gematria systems while maintaining historical accuracy.</p>
          <div class="example">
            "We believe numbers hold sacred keys to understanding spiritual truths"
          </div>

          <h4>What Makes Us Different?</h4>
          <ul>
            <li>✓ Three-in-One Calculator: Hebrew, English & Simple systems</li>
            <li>✓ Academic-Grade Accuracy with User-Friendly Design</li>
            <li>✓ Free Download of PDF Report With Your Name And Gematria Values</li>
            <li>✓ Regular Updates Based on User Feedback</li>
          </ul>

          <h4>Our Core Values</h4>
          <div class="result-card">
            <h3>Spiritual Integrity</h3>
            <p>We maintain strict adherence to traditional gematria calculator systems while making them accessible to modern users. Our Hebrew calculations follow the Mispar Hechrachi method, preserving authentic biblical numerology.</p>
          </div>

          <div class="result-card">
            <h3>Educational Focus</h3>
            <p>Beyond just numbers, we provide breakdowns showing exactly how each value is calculated. Our blog and FAQ sections help users deepen their understanding of gematria's rich history.</p>
          </div>

          <div class="result-card">
            <h3>Community-Driven</h3>
            <p>With over 250+ calculations performed monthly, we continuously improve our hebrew, jewish, greek gematria calculator based on user suggestions. The recent phrases section reflects real searches from our spiritual community.</p>
          </div>

          <h4>Popular Calculations from Our Community</h4>
          <div class="recent-phrases">
            <a href="#">sacred geometry</a> |
            <a href="#">tree of life</a> |
            <a href="#">divine feminine</a> |
            <a href="#">christ consciousness</a> |
            <a href="#">kabbalah codes</a>
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
