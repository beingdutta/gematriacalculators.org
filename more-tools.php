<!DOCTYPE html>
<?php
  require_once __DIR__ . '/helpers.php';
  $qs = $_SERVER['QUERY_STRING'] ? '?'.$_SERVER['QUERY_STRING'] : '';
  $here = trim(dirname($_SERVER['SCRIPT_NAME']), '/');
?>
<html lang="en" data-theme="light">

    <head>
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>More Numerology & Mystical Tools - Gematria Calculators</title>
        <meta name="description" content="Explore a collection of numerology and mystical tools, including a Vastu Score Calculator, Kua Number Calculator, Angel Number Decoder, and Life Path Number Calculator.">
        <link rel="canonical" href="https://gematriacalculators.org/more-tools.php">
        <link rel="stylesheet" href="/styles/index.css">
        <link rel="stylesheet" href="/styles/more-tools.css">
        <link rel="icon" href="/assets/talisman-site-icon.png" sizes="32x32">

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <meta name="keywords" content="gematria calculator, bible gematria calculator, gematrix, english to hebrew gematria calculator, hebrew gematria calculator, best gematria calculator, calculate gematria, gematria calculator online, gematria finder, hebrew numerical value calculator, biblical gematria letter to number, gematria name calculator, jewish gematria calculator, guematria hebraica calcule online, gematria calculator us, gematria online calculator, gematra name calculator">
        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4198904821948931" crossorigin="anonymous"></script>
    </head>

    <body>
        <?php require_once __DIR__ . '/navigation/header.php'; ?>
        <div class="container" style="padding-top: 2rem;">
            <header class="header">
                <h1>Explore More Tools</h1>
                <p class="subtitle">Enhance your spiritual and numerological journey</p>
            </header>

            <main>
                <div class="tool-grid">
                    <?php
                        // Define tools array
                        $tools = [
                            ['title' => 'Simple Vastu Score Calculator', 'desc' => 'Get a quick Vastu compliance score for your home based on room placements.', 'icon' => '🏠', 'url' => '/more-tools/simple-vastu-score-calculator.php'],
                            ['title' => 'Kua Number Calculator', 'desc' => 'Find your Feng Shui lucky directions based on your birth year and gender.', 'icon' => '🧭', 'url' => '/more-tools/kua-number-calculator.php'],
                            ['title' => 'Angel Number Decoder', 'desc' => 'Uncover messages from the universe in repeating numbers.', 'icon' => '✨', 'url' => '/more-tools/angel-number-decoder.php'],
                            ['title' => 'Life Path Number Calculator', 'desc' => 'Discover your core destiny number from your birth date.', 'icon' => '✨', 'url' => '/more-tools/life-path-number-calculator.php'],
                            ['title' => 'Loshu Grid Calculator', 'desc' => 'Map out your numerological energy grid.', 'icon' => '🔢', 'url' => '/more-tools/loshu-grid.php'],
                            ['title' => 'FLAME Calculator', 'desc' => 'Find love compatibility with the classic FLAME game.', 'icon' => '❤️', 'url' => '/more-tools/flame-calculator.php'],
                            //['title' => 'Kundli Finder', 'desc' => 'Generate a basic Kundli using birth details.', 'icon' => '🪐', 'url' => '#'],
                            //['title' => 'Angel Number Decoder', 'desc' => 'Uncover meanings of recurring numbers.', 'icon' => '👼', 'url' => '#'],
                            ['title' => 'Name Numerology Calculator', 'desc' => 'Calculate your Destiny, Soul Urge, and Personality numbers.', 'icon' => '📝', 'url' => '/more-tools/name-numerology-calculator.php'],
                            //['title' => 'Name Meaning Analyzer', 'desc' => 'Decode spiritual and mystical significance of names.', 'icon' => '📝', 'url' => '#']
                        ];

                        foreach ($tools as $tool) {
                            echo '
                            <div class="tool-card">
                                <div class="tool-icon">'.$tool['icon'].'</div>
                                <h3>'.$tool['title'].'</h3>
                                <p>'.$tool['desc'].'</p>
                                <a href="'.$tool['url'].'" class="calculate-btn">Open Tool</a>
                            </div>';
                        }
                    ?>
                </div>
            </main>

            <footer class="footer">
                <!-- Footer links are now in the header nav -->

                <div class="copyright">© <?= date('Y') ?> gematriacalculators.org</div>
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
