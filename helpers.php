<?php

/**
 * Generates a language switcher link.
 *
 * @param string $code The language code (e.g., 'en', 'ru').
 * @param string $label The display label (e.g., 'EN', 'RU').
 * @param string $qs The current query string.
 * @param string $here The current language directory.
 * @return string The HTML for the language link or label.
 */
function lang_switcher_link(string $code, string $label, string $qs, string $here): string {
    $path = ($code === 'en') ? '/' . $qs : "/$code/" . $qs;
    return ($code === $here || ($code === 'en' && $here === '')) ? "<strong>$label</strong>" : "<a href=\"$path\">$label</a>";
}