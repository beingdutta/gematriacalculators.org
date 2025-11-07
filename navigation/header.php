<?php
// This ensures that the script doesn't break if `toggleMobileMenu` is not defined elsewhere.
if (!function_exists('toggleMobileMenu')) {
    function toggleMobileMenu() {
        // JavaScript function will be handled in the main script file.
    }
}
// Get the current request URI to determine the active page
$current_uri = $_SERVER['REQUEST_URI'];

// Determine current language from URI
$lang_code = 'en'; // Default
if (strpos($current_uri, '/de/') !== false) $lang_code = 'de';
elseif (strpos($current_uri, '/es/') !== false) $lang_code = 'es';
elseif (strpos($current_uri, '/ru/') !== false) $lang_code = 'ru';
elseif (strpos($current_uri, '/pt/') !== false) $lang_code = 'pt';
elseif (strpos($current_uri, '/it/') !== false) $lang_code = 'it';
elseif (strpos($current_uri, '/pl/') !== false) $lang_code = 'pl';
elseif (strpos($current_uri, '/zh/') !== false) $lang_code = 'zh';
elseif (strpos($current_uri, '/iw/') !== false) $lang_code = 'iw';
elseif (strpos($current_uri, '/vi/') !== false) $lang_code = 'vi';

$lang_names = ['en' => 'English', 'de' => 'Deutsch', 'es' => 'Español', 'ru' => 'Русский', 'pt' => 'Português', 'it' => 'Italiano', 'pl' => 'Polski', 'zh' => '中文', 'iw' => 'עברית', 'vi' => 'Tiếng Việt'];
$current_lang_name = $lang_names[$lang_code] ?? 'Language';

$translations = [
    'en' => ['home' => 'Home', 'more_tools' => 'More Tools', 'blog' => 'Blog', 'about_us' => 'About Us', 'contact_us' => 'Contact Us', 'terms' => 'Terms & Conditions', 'privacy' => 'Privacy Policy', 'change_language' => 'Change Language', 'gematria' => 'GEMATRIA'],
    'de' => ['home' => 'Startseite', 'more_tools' => 'Mehr Tools', 'blog' => 'Blog', 'about_us' => 'Über uns', 'contact_us' => 'Kontakt', 'terms' => 'AGB', 'privacy' => 'Datenschutz', 'change_language' => 'Sprache ändern', 'gematria' => 'GEMATRIE'],
    'es' => ['home' => 'Inicio', 'more_tools' => 'Más Herramientas', 'blog' => 'Blog', 'about_us' => 'Sobre Nosotros', 'contact_us' => 'Contáctenos', 'terms' => 'Términos y Condiciones', 'privacy' => 'Política de Privacidad', 'change_language' => 'Cambiar Idioma', 'gematria' => 'GEMATRIA'],
    'ru' => ['home' => 'Главная', 'more_tools' => 'Инструменты', 'blog' => 'Блог', 'about_us' => 'О нас', 'contact_us' => 'Контакты', 'terms' => 'Условия', 'privacy' => 'Политика конфиденциальности', 'change_language' => 'Сменить язык', 'gematria' => 'ГЕМАТРИЯ'], // Note: 'ГЕМАТРИЯ' is the Russian translation for Gematria
    'pt' => ['home' => 'Início', 'more_tools' => 'Mais Ferramentas', 'blog' => 'Blog', 'about_us' => 'Sobre Nós', 'contact_us' => 'Contato', 'terms' => 'Termos e Condições', 'privacy' => 'Política de Privacidade', 'change_language' => 'Mudar Idioma', 'gematria' => 'GEMATRIA'],
    'it' => ['home' => 'Home', 'more_tools' => 'Altri Strumenti', 'blog' => 'Blog', 'about_us' => 'Chi Siamo', 'contact_us' => 'Contattaci', 'terms' => 'Termini e Condizioni', 'privacy' => 'Privacy Policy', 'change_language' => 'Cambia Lingua', 'gematria' => 'GEMATRIA'],
    'pl' => ['home' => 'Strona główna', 'more_tools' => 'Więcej Narzędzi', 'blog' => 'Blog', 'about_us' => 'O Nas', 'contact_us' => 'Kontakt', 'terms' => 'Regulamin', 'privacy' => 'Polityka Prywatności', 'change_language' => 'Zmień język', 'gematria' => 'GEMATRIA'],
    'zh' => ['home' => '首页', 'more_tools' => '更多工具', 'blog' => '博客', 'about_us' => '关于我们', 'contact_us' => '联系我们', 'terms' => '使用条款', 'privacy' => '隐私政策', 'change_language' => '切换语言', 'gematria' => '算术'], // Note: '算术' is a general term for arithmetic, '数字占卜' is more specific for Gematria
    'iw' => ['home' => 'דף הבית', 'more_tools' => 'עוד כלים', 'blog' => 'בלוג', 'about_us' => 'אודות', 'contact_us' => 'צור קשר', 'terms' => 'תנאים', 'privacy' => 'מדיניות פרטיות', 'change_language' => 'שנה שפה', 'gematria' => 'גימטריה'],
    'vi' => ['home' => 'Trang chủ', 'more_tools' => 'Công cụ khác', 'blog' => 'Blog', 'about_us' => 'Về chúng tôi', 'contact_us' => 'Liên hệ', 'terms' => 'Điều khoản', 'privacy' => 'Bảo mật', 'change_language' => 'Đổi ngôn ngữ', 'gematria' => 'GEMATRIA']
];

$menu_texts = $translations[$lang_code] ?? $translations['en'];

// Define base paths for links
$base_path = ($lang_code !== 'en') ? '/' . $lang_code : '';

// Define menu items
$menu_items = [
    ['key' => 'home', 'path' => $base_path ?: '/'],
    ['key' => 'more_tools', 'path' => '/more-tools.php'],
    ['key' => 'blog', 'path' => '/blog-collections.php'],
    ['key' => 'about_us', 'path' => '/about-us.php'],
    ['key' => 'contact_us', 'path' => '/contact-us.php'],
    ['key' => 'terms', 'path' => '/terms-conditions.php'],
    ['key' => 'privacy', 'path' => '/privacy-policy.php'],
];

// For RTL languages, reverse the order of menu items to maintain visual LTR flow
$rtl_languages = ['iw']; // Add other RTL language codes if necessary
if (in_array($lang_code, $rtl_languages)) {
    $menu_items = array_reverse($menu_items);
}

?>
<nav class="header-nav">
    <button class="mobile-menu-toggle" aria-label="Toggle menu">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
    </button>
    <a href="<?= $base_path ?: '/' ?>" class="mobile-site-title" title="Home"><?= htmlspecialchars($menu_texts['gematria']) ?></a>
    <div class="nav-links">
        <?php foreach ($menu_items as $item):
            $is_active = false;
            if ($item['key'] === 'home') {
                $is_active = ($current_uri === ($base_path ?: '/')) || (strpos($current_uri, 'index.php') !== false && (strpos($current_uri, $base_path) !== false || $base_path === ''));
            } else {
                $is_active = strpos($current_uri, trim($item['path'], '/')) !== false;
            }
        ?>
            <a href="<?= $item['path'] ?>" class="<?= $is_active ? 'active' : '' ?>"><?= htmlspecialchars($menu_texts[$item['key']]) ?></a>
        <?php endforeach; ?>
        <button class="lang-change-btn mobile-only" onclick="openLangPopup()"><?= htmlspecialchars($menu_texts['change_language']) ?></button>
    </div>
    <button class="lang-switcher-btn" onclick="openLangPopup()" aria-label="Change language"><?= htmlspecialchars($current_lang_name) ?></button>
    <button class="theme-toggle" onclick="toggleTheme()" aria-label="Toggle theme">
      <svg class="icon-sun" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="5"></circle><line x1="12" y1="1" x2="12" y2="3"></line><line x1="12" y1="21" x2="12" y2="23"></line><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line><line x1="1" y1="12" x2="3" y2="12"></line><line x1="21" y1="12" x2="23" y2="12"></line><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line></svg>
      <svg class="icon-moon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path></svg>
    </button>
</nav>