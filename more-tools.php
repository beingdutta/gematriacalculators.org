<!DOCTYPE html>
<html lang="en" data-theme="light">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>More Numerology & Mystical Tools - Gematria Calculators</title>
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
        <nav class="header-nav">
            <a href="/">Home</a>
            <a href="/more-tools.php">More Tools</a>
            <a href="/blog-collections.php">Blog</a>
            <a href="/about-us/">About Us</a>
            <a href="/contact-us/">Contact Us</a>
            <a href="/terms-conditions/">Terms & Conditions</a>
            <a href="/privacy-policy/">Privacy Policy</a>
            <button class="theme-toggle" onclick="toggleTheme()" aria-label="Toggle theme">
              <svg class="icon-sun" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="5"></circle><line x1="12" y1="1" x2="12" y2="3"></line><line x1="12" y1="21" x2="12" y2="23"></line><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line><line x1="1" y1="12" x2="3" y2="12"></line><line x1="21" y1="12" x2="23" y2="12"></line><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line></svg>
              <svg class="icon-moon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path></svg>
            </button>
        </nav>
        <div class="container" style="padding-top: 2rem;">
            <header class="header">
                <h1>Explore More Tools</h1>
                <p class="subtitle">Enhance your spiritual and numerological journey</p>
            </header>

            <main>
                <div class="tool-grid">
                    <?php
                        $tools = [
                            ['title' => 'Loshu Grid Calculator', 'desc' => 'Map out your numerological energy grid.', 'icon' => '🔢', 'url' => '/more-tools/loshu-grid.php'],
                            ['title' => 'FLAME Calculator', 'desc' => 'Find the love compatibility using the FLAME game.', 'icon' => '❤️', 'url' => '/more-tools/flame-calculator.php'],
                            //['title' => 'Kundli Finder', 'desc' => 'Generate a basic Kundli using birth details.', 'icon' => '🪐', 'url' => '#'],
                            //['title' => 'Angel Number Decoder', 'desc' => 'Uncover meanings of recurring numbers.', 'icon' => '👼', 'url' => '#'],
                            //['title' => 'Chaldean Numerology', 'desc' => 'Calculate name numbers using the Chaldean system.', 'icon' => '🔮', 'url' => '#'],
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
            </footer>
        </div>
        <script src="/scripts/index.js"></script>
    </body>

</html>
