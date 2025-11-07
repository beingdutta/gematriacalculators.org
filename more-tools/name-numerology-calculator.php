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

    <!-- Clarity tracking code -->
    <script>
        (function(c,l,a,r,i,t,y){
            c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
            t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i+"?ref=bwt";
            y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
        })(window, document, "clarity", "script", "rcxnkrgboo");
    </script>

    <!-- Google AdSense -->
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4198904821948931" crossorigin="anonymous"></script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Name Numerology Calculator - Destiny, Soul Urge, Personality Numbers</title>

    <meta name="description" content="Calculate your core numerology numbers (Destiny, Soul Urge, Personality) from your full birth name using our free Name Numerology Calculator. Discover your spiritual path and hidden talents.">
    <meta name="keywords" content="name numerology calculator, destiny number calculator, soul urge calculator, personality number calculator, expression number calculator, how to calculate destiny number, vowel numerology calculator, consonant numerology calculator, full name numerology, gematria calculator, Pythagorean numerology, numerology chart, full birth name, name meaning, vowels, consonants, spiritual path">
    <meta property="og:title" content="Name Numerology Calculator - Destiny, Soul Urge, Personality Numbers">
    <meta property="og:description" content="Calculate your core numerology numbers (Destiny, Soul Urge, Personality) from your full birth name using our free Name Numerology Calculator. Discover your spiritual path and hidden talents.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://gematriacalculators.org/more-tools/name-numerology-calculator.php">
    <meta property="og:image" content="https://gematriacalculators.org/assets/preview.jpg">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Name Numerology Calculator - Destiny, Soul Urge, Personality Numbers">
    <meta name="twitter:description" content="Calculate your core numerology numbers (Destiny, Soul Urge, Personality) from your full birth name using our free Name Numerology Calculator. Discover your spiritual path and hidden talents.">
    <meta name="twitter:image" content="https://gematriacalculators.org/assets/preview.jpg">

    <link rel="canonical" href="https://gematriacalculators.org/more-tools/name-numerology-calculator.php" />
    <link rel="stylesheet" href="/styles/index.css">
    <link rel="stylesheet" href="/styles/name-numerology-calculator.css">
    <link rel="icon" href="/assets/talisman-site-icon.png" sizes="32x32">
</head>

<body>
    <?php require_once __DIR__ . '/../navigation/header.php'; ?>
    <div class="container" style="padding-top: 0.5rem;">

        <header class="header">
            <img src="/assets/talisman-header-icon.png" id="themeLogo" alt="Name Numerology Calculator Icon">
            <h1>Name Numerology Calculator</h1>
            <p class="subtitle">Uncover your Destiny, Soul Urge, and Personality Numbers</p>
        </header>

        <main>
            <form id="nameNumerologyForm" class="name-numerology-form">
                <div class="form-row">
                    <label for="fullNameInput">Enter Your Full Name (as on your birth certificate):</label>
                    <input type="text" id="fullNameInput" placeholder="e.g., John Michael Doe" required>
                </div>

                <div class="button-container">
                    <button type="submit" class="calculate-btn">Calculate Name Numbers</button>
                    <button type="reset" class="reset-btn">Reset</button>
                </div>
            </form>

            <div class="loading-container" id="loading">
                <div class="spinner"></div>
                <span id="loadingPhrase" class="loading-phrase"></span>
            </div>

            <div id="resultArea" class="result-area hidden">
                <div class="result-card">
                    <h3>Your Destiny (Expression) Number is: <span id="destinyNumber"></span></h3>
                    <p id="destinyMeaning"></p>
                </div>
                <div class="result-card">
                    <h3>Your Soul Urge (Heart's Desire) Number is: <span id="soulUrgeNumber"></span></h3>
                    <p id="soulUrgeMeaning"></p>
                </div>
                <div class="result-card">
                    <h3>Your Personality Number is: <span id="personalityNumber"></span></h3>
                    <p id="personalityMeaning"></p>
                </div>
            </div>
        </main>

        <section class="seo-blocks">
            <hr>
            <h2>What is My Name Numerology?</h2>
            <p>
                Your name is more than just a label; in numerology, it holds a profound energetic blueprint. Our <strong>Name Numerology Calculator</strong> delves into the vibrations of your full birth name to reveal three core numbers: your Destiny (Expression) Number, Soul Urge (Heart's Desire) Number, and Personality Number. These numbers offer deep insights into your innate talents, inner desires, and how others perceive you, guiding you on your <strong>spiritual path</strong>.
            </p>
            <hr>
            <h2>How to Calculate Name Numerology</h2>
            <p>
                Using the ancient Pythagorean system, each letter of your name is assigned a single digit (1-9). Our <strong>numerology chart</strong> maps these values. The <strong>destiny number calculator</strong> sums all letters, the <strong>soul urge calculator</strong> focuses on vowels, and the <strong>personality number calculator</strong> uses consonants. Each sum is then reduced to a single digit or a Master Number (11, 22), providing a comprehensive <strong>full name numerology</strong> reading.
            </p>
            <hr>
            <h2>Understanding Your Core Name Numbers</h2>
            <p>
                The <strong>Destiny Number</strong> (also known as the Expression Number) reveals your natural abilities, potential, and the path you are destined to follow. Your <strong>Soul Urge Number</strong> (or Heart's Desire) uncovers your deepest motivations, values, and what truly brings you joy. The <strong>Personality Number</strong> reflects how others see you and the outward traits you present to the world. Together, these numbers paint a complete picture of your unique energetic signature.
            </p>
        </section>

        <section class="faq">
            <h2 class="faq-heading">Frequently Asked Questions</h2>
            <div class="faq-item">
                <div class="faq-question">
                    <span>What is the difference between Life Path and Destiny Number?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">
                    Your Life Path Number (calculated from your birth date) reveals your life's purpose and lessons. Your Destiny Number (calculated from your full birth name) highlights your natural talents and how you express yourself to fulfill that purpose. Both are crucial for a complete <strong>numerology chart</strong>.
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <span>Why is my full birth name important for numerology?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">
                    Your <strong>full birth name</strong>, as it appears on your birth certificate, is considered your unique energetic signature. It's believed to be the name you were given by divine design, carrying specific vibrations that influence your personality and life's journey.
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <span>What are Master Numbers in Name Numerology?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">
                    In Name Numerology, Master Numbers (11 and 22) are not reduced further. They signify a higher potential for achievement and spiritual insight, but also come with increased challenges and responsibilities. Our <strong>expression number calculator</strong> and other tools respect these powerful numbers.
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <span>How do vowels and consonants affect my name numbers?</span>
                    <svg class="chevron" width="24" height="24" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                </div>
                <div class="faq-answer">
                    Your <strong>vowels</strong> reveal your Soul Urge (inner desires), while your <strong>consonants</strong> reflect your Personality (outward expression). This distinction is key to understanding the full spectrum of your name's numerological influence.
                </div>
            </div>
        </section>

        <footer class="footer">
            <div class="copyright">© <?= date('Y') ?> gematriacalculators.org</div>
        </footer>

    </div>

    <script src="/scripts/name-numerology-calculator.js"></script>
    <script src="/scripts/index.js"></script>
</body>
</html>