<?php
// This ensures that the script doesn't break if `toggleMobileMenu` is not defined elsewhere.
if (!function_exists('toggleMobileMenu')) {
    function toggleMobileMenu() {
        // JavaScript function will be handled in the main script file.
    }
}
// Get the current request URI to determine the active page
$current_uri = $_SERVER['REQUEST_URI'];
?>
<nav class="header-nav">
    <button class="mobile-menu-toggle" aria-label="Toggle menu">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
    </button>
    <a href="/" class="mobile-site-title" title="Home">Gematria Calculators</a>
    <div class="nav-links">
        <?php // Add 'active' class based on the current URI ?>
        <a href="/" class="<?= ($current_uri == '/' || strpos($current_uri, 'index.php') !== false) ? 'active' : '' ?>">Home</a>
        <a href="/more-tools.php" class="<?= (strpos($current_uri, 'more-tools') !== false) ? 'active' : '' ?>">More Tools</a>
        <a href="/blog-collections.php" class="<?= (strpos($current_uri, 'blog-collections') !== false || strpos($current_uri, '/blogs/') !== false) ? 'active' : '' ?>">Blog</a>
        <a href="/about-us.php" class="<?= (strpos($current_uri, 'about-us') !== false) ? 'active' : '' ?>">About Us</a>
        <a href="/contact-us.php" class="<?= (strpos($current_uri, 'contact-us') !== false) ? 'active' : '' ?>">Contact Us</a>
        <a href="/terms-conditions.php" class="<?= (strpos($current_uri, 'terms-conditions') !== false) ? 'active' : '' ?>">Terms & Conditions</a>
        <a href="/privacy-policy.php" class="<?= (strpos($current_uri, 'privacy-policy') !== false) ? 'active' : '' ?>">Privacy Policy</a>
        <button class="lang-change-btn mobile-only" onclick="openLangPopup()">Change Language</button>
    </div>
    <button class="theme-toggle" onclick="toggleTheme()" aria-label="Toggle theme">
      <svg class="icon-sun" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="5"></circle><line x1="12" y1="1" x2="12" y2="3"></line><line x1="12" y1="21" x2="12" y2="23"></line><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line><line x1="1" y1="12" x2="3" y2="12"></line><line x1="21" y1="12" x2="23" y2="12"></line><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line></svg>
      <svg class="icon-moon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path></svg>
    </button>
</nav>