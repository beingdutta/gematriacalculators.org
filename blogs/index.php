<?php
require_once __DIR__ . '/../helpers.php';

// Function to get meta tags from a file
function get_article_metadata($filepath) {
    $content = file_get_contents($filepath);
    $metadata = [
        'title' => 'Untitled Article',
        'description' => 'No description available.',
        'date' => 'Date unknown',
        'image' => '/assets/talisman-header-icon.png' // Default image
    ];

    // Extract Title
    if (preg_match('/<title>(.*?)<\/title>/i', $content, $matches)) {
        $metadata['title'] = trim(str_replace('| Complete Guide', '', str_replace('Gematria Explained:', '', $matches[1])));
    }

    // Extract Description
    if (preg_match('/<meta name="description" content="(.*?)"/i', $content, $matches)) {
        $metadata['description'] = trim($matches[1]);
    }

    // Extract Date
    if (preg_match('/<div class="article-date">(?:Published|Updated): (.*?)<\/div>/i', $content, $matches)) {
        $metadata['date'] = trim($matches[1]);
    } elseif (preg_match('/<h4 class="article-date">(?:Published|Updated): (.*?)<\/h4>/i', $content, $matches)) {
        $metadata['date'] = trim($matches[1]);
    }

    // Extract Image (optional, if you add a specific meta tag for it)
    if (preg_match('/<meta property="og:image" content="(.*?)"/i', $content, $matches)) {
        $metadata['image'] = trim($matches[1]);
    }

    return $metadata;
}

// Scan the directory for article files
$articles = [];
$files = glob(__DIR__ . '/*.php');

foreach ($files as $file) {
    if (basename($file) !== 'index.php') {
        $metadata = get_article_metadata($file);
        $articles[] = [
            'path' => '/blogs/' . basename($file),
            'title' => $metadata['title'],
            'description' => $metadata['description'],
            'date' => $metadata['date'],
            'timestamp' => strtotime($metadata['date']) ?: filemtime($file)
        ];
    }
}

// Sort articles by date, newest first
usort($articles, function($a, $b) {
    return $b['timestamp'] - $a['timestamp'];
});

$latest_article = array_shift($articles);

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
    <meta name="description" content="The Gematria Chronicles: A complete collection of articles on Gematria, numerology, and the hidden codes of the universe.">
    <title>The Gematria Chronicles - Article Index</title>
    <link rel="icon" href="/assets/talisman-site-icon.png" sizes="32x32">
    <link rel="canonical" href="https://gematriacalculators.org/blogs/">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/styles/index.css">
    <link rel="stylesheet" href="/styles/article-general-style.css">

    <style>
        :root {
            --paper-bg: #fdfdfd;
            --ink-text: #333333;
            --primary-accent: #4A90E2;
            --headline-font: 'Inter', sans-serif;
            --body-font: 'Inter', sans-serif;
            --meta-font: 'Inter', sans-serif;
            --border-color: #dddddd;
            --card-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }

        [data-theme="dark"] {
            --paper-bg: #1A1B26;
            --ink-text: #C9D1D9;
            --border-color: #30363D;
        }

        [data-theme="dark"] .article-card {
            background-color: #242936;
        }

        body {
            background-color: var(--bg);
            font-family: var(--body-font);
            color: var(--ink-text);
        }

        .newspaper-container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 20px;
        }

        .masthead {
            text-align: center;
            padding: 2rem 0;
            border-bottom: 4px double var(--ink-text);
            margin-bottom: 2rem;
        }

        .masthead h1 {
            font-family: var(--headline-font);
            font-size: 3rem;
            font-weight: 900;
            margin: 0;
            color: var(--ink-text);
        }

        .masthead .tagline {
            font-family: var(--meta-font);
            font-size: 1rem;
            color: #666;
            margin-top: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .latest-article-section {
            border-bottom: 1px solid var(--border-color);
            padding-bottom: 2rem;
            margin-bottom: 2rem;
        }

        .latest-article-section a,
        .article-card a {
            text-decoration: none;
            color: inherit;
        }

        .latest-article-section h2 a:hover,
        .article-card h3 a:hover {
            color: var(--primary-accent);
        }

        .latest-article-section h2 {
            font-family: var(--headline-font);
            font-size: 2.5rem;
            margin: 0 0 0.5rem 0;
            color: var(--ink-text);
        }

        .latest-article-section .meta {
            font-family: var(--meta-font);
            font-size: 0.9rem;
            color: #555;
            margin-bottom: 1rem;
        }

        .latest-article-section .excerpt {
            font-size: 1.1rem;
            line-height: 1.7;
            max-width: 80ch;
        }

        .read-more-btn {
            display: inline-block;
            margin-top: 1rem;
            font-family: var(--meta-font);
            font-weight: 600;
            color: var(--primary-accent);
            text-decoration: none;
            border: 1px solid var(--primary-accent);
            padding: 8px 16px;
            border-radius: 6px;
            transition: background-color 0.3s, color 0.3s;
        }

        .read-more-btn:hover {
            background-color: var(--primary-accent);
            color: var(--paper-bg);
        }

        .archive-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 2.5rem;
        }

        .article-card {
            background-color: #fff;
            border: 1px solid var(--border);
            padding: 1.5rem;
            border-radius: 8px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            display: flex;
            flex-direction: column;
        }

        .article-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .article-card h3 {
            font-family: var(--headline-font);
            font-size: 1.6rem;
            font-weight: 700;
            margin: 0 0 0.5rem 0;
        }

        .article-card .meta {
            font-family: var(--meta-font);
            font-size: 0.85rem;
            color: #666;
            margin-bottom: 0.75rem;
        }

        .article-card .excerpt {
            font-size: 1rem;
            line-height: 1.7;
            margin-bottom: 1rem;
            flex-grow: 1;
        }

        .section-title {
            font-family: var(--headline-font);
            font-size: 2rem;
            font-weight: 700;
            margin: 3rem 0 2rem 0;
            border-top: 1px solid var(--border-color);
            border-bottom: 1px solid var(--border-color);
            padding: 0.5rem 0;
        }

        @media (max-width: 768px) {
            .masthead h1 {
                font-size: 2.2rem;
            }
            .latest-article-section h2 {
                font-size: 2rem;
            }
            .archive-grid {
                grid-template-columns: 1fr;
            }
        }

    </style>
</head>
<body>
    <?php require_once __DIR__ . '/../navigation/header.php'; ?>

    <div class="newspaper-container">
        <header class="masthead">
            <h1>The Gematria Chronicles</h1>
            <div class="tagline">An Archive of Esoteric Knowledge & Digital Mysticism</div>
        </header>

        <main>
            <?php if ($latest_article): ?>
            <section class="latest-article-section">
                <article>
                    <h2><a href="<?= htmlspecialchars($latest_article['path']) ?>"><?= htmlspecialchars($latest_article['title']) ?></a></h2>
                    <div class="meta">Published on <?= htmlspecialchars($latest_article['date']) ?></div>
                    <p class="excerpt"><?= htmlspecialchars(substr($latest_article['description'], 0, 250)) ?>...</p>
                    <a href="<?= htmlspecialchars($latest_article['path']) ?>" class="read-more-btn">Continue Reading &rarr;</a>
                </article>
            </section>
            <?php endif; ?>

            <h2 class="section-title">From the Archives</h2>

            <section class="archive-grid">
                <?php if (!empty($articles)): ?>
                    <?php foreach ($articles as $article): ?>
                    <article class="article-card">
                        <h3><a href="<?= htmlspecialchars($article['path']) ?>"><?= htmlspecialchars($article['title']) ?></a></h3>
                        <div class="meta">Published on <?= htmlspecialchars($article['date']) ?></div>
                        <p class="excerpt"><?= htmlspecialchars(substr($article['description'], 0, 150)) ?>...</p>
                        <a href="<?= htmlspecialchars($article['path']) ?>" class="read-more-btn">Read More &rarr;</a>
                    </article>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No articles found in the archive.</p>
                <?php endif; ?>
            </section>
        </main>

        <footer class="footer" style="text-align: center; border-top: 4px double var(--ink-text); margin-top: 3rem; padding-top: 1rem;">
            <div class="copyright">
                © <?= date('Y') ?> gematriacalculators.org - All Rights Reserved
            </div>
        </footer>
    </div>

    <script src="/scripts/index.js"></script>
</body>
</html>