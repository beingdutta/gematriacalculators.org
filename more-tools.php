<!DOCTYPE html>
<html lang="en" data-theme="light">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>More Numerology & Mystical Tools</title>
        <link rel="stylesheet" href="/styles/more-tools.css">
        <link rel="icon" href="/assets/site-icon.png" sizes="32x32">
    </head>

    <body>
        <div class="container">
            <header class="header">
                <img src="/assets/header-image.webp" id="themeLogo" alt="gematria calculator logo" style="width: 90px;">
                <button class="theme-toggle" onclick="toggleTheme()">🌓</button>
                <h1>Explore More Tools</h1>
                <p class="subtitle">Enhance your spiritual and numerological journey</p>
            </header>

            <main>
                <div class="tool-grid">
                    <?php
                        $tools = [
                            ['title' => 'Loshu Grid Calculator', 'desc' => 'Map out your numerological energy grid.', 'icon' => '🔢', 'url' => '/more-tools/loshu-grid.php'],
                            ['title' => 'FLAME Calculator', 'desc' => 'Find the love compatibility using the FLAME game.', 'icon' => '❤️', 'url' => '#'],
                            ['title' => 'Kundli Finder', 'desc' => 'Generate a basic Kundli using birth details.', 'icon' => '🪐', 'url' => '#'],
                            ['title' => 'Angel Number Decoder', 'desc' => 'Uncover meanings of recurring numbers.', 'icon' => '👼', 'url' => '#'],
                            ['title' => 'Chaldean Numerology', 'desc' => 'Calculate name numbers using the Chaldean system.', 'icon' => '🔮', 'url' => '#'],
                            ['title' => 'Name Meaning Analyzer', 'desc' => 'Decode spiritual and mystical significance of names.', 'icon' => '📝', 'url' => '#']
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

                <div class="footer-links">
                    <a href="/">Home</a>
                    <a href="/blog-collections.html">Blog</a>
                    <a href="/about-us.html">About Us</a>
                    <a href="/contact-us.html">Contact Us</a>
                    <a href="/terms-conditions.html">Terms & Conditions</a>
                    <a href="/privacy-policy.html">Privacy Policy</a>
                </div>

                <div class="copyright">© <?= date('Y') ?> gematriacalculators.org</div>
            </footer>
        </div>
        <script src="/scripts/index.js"></script>
    </body>

</html>
