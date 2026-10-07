<?php
// Local dictionaries keep translations independent of page layout and external services.
$supportedLocales = ['kk' => 'Қазақша', 'ru' => 'Русский'];
$requestPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
$basePath = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/.');
$relativePath = substr($requestPath, strlen($basePath));
$hasExplicitLocale = preg_match('~^/(en|kk|ru)(?:/|$)~', $relativePath, $localeMatch);
$locale = $hasExplicitLocale ? $localeMatch[1] : 'kk';
$pageSlug = ($pageId ?? 'home') === 'home' ? '' : ($pageId === 'brainify' ? 'brainify' : $pageId);
$localeUrl = static function ($language, $slug = '') use ($basePath) {
    return $basePath . '/' . $language . '/' . ($slug === '' ? '' : $slug . '/');
};
if (isset($_GET['language']) && is_string($_GET['language']) && (isset($supportedLocales[$_GET['language']]) || $_GET['language'] === 'en')) {
    $chosen = $_GET['language'] === 'en' ? 'kk' : $_GET['language'];
    setcookie('ignite_language', $chosen, ['expires' => time() + 31536000, 'path' => $basePath . '/', 'secure' => !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off', 'httponly' => true, 'samesite' => 'Lax']);
    header('Location: ' . $localeUrl($chosen, $pageSlug), true, 302); exit;
}
// Unprefixed entry URLs use a saved choice, or Kazakh for new visitors.
// Existing English URLs fall back to Kazakh while English is unavailable.
if ($hasExplicitLocale && $locale === 'en') {
    $query = $_GET ? '?' . http_build_query($_GET) : '';
    header('Location: ' . $localeUrl('kk', $pageSlug) . $query, true, 302); exit;
}
// Explicit supported language URLs always win.
if (!$hasExplicitLocale) {
    $preferred = $_COOKIE['ignite_language'] ?? 'kk';
    if (!is_string($preferred) || !isset($supportedLocales[$preferred])) $preferred = 'kk';
    $query = $_GET ? '?' . http_build_query($_GET) : '';
    header('Location: ' . $localeUrl($preferred, $pageSlug) . $query, true, 302); exit;
}
$translations = json_decode(file_get_contents(__DIR__ . '/../locales/' . $locale . '.json'), true, 512, JSON_THROW_ON_ERROR);
$clientDictionary = __DIR__ . '/../locales/client-' . $locale . '.json';
if (is_file($clientDictionary)) {
    $translations = array_replace($translations, json_decode(file_get_contents($clientDictionary), true, 512, JSON_THROW_ON_ERROR));
}
$translate = static function ($text) use ($translations) {
    $key = preg_replace('/\s+/u', ' ', trim($text));
    return $translations[$key] ?? $text;
};
$routeIds = array_merge(['index', 'brainify'], array_keys(json_decode(file_get_contents(__DIR__ . '/../data/pages.json'), true)));
ob_start(static function ($html) use ($locale, $translate, $localeUrl, $routeIds, $pageSlug) {
    $dom = new DOMDocument('1.0', 'UTF-8');
    $previous = libxml_use_internal_errors(true);
    $dom->loadHTML('<?xml encoding="UTF-8">' . $html, LIBXML_NONET);
    libxml_clear_errors(); libxml_use_internal_errors($previous);
    $xpath = new DOMXPath($dom);
    foreach ($xpath->query('//text()[not(ancestor::script) and not(ancestor::style) and not(ancestor::svg)]') as $node) {
        $translated = $translate($node->nodeValue);
        if ($translated !== $node->nodeValue) {
            preg_match('/^(\s*).*?(\s*)$/su', $node->nodeValue, $space);
            $node->nodeValue = ($space[1] ?? '') . $translated . ($space[2] ?? '');
        }
    }
    foreach ($xpath->query('//*') as $element) {
        foreach (['aria-label', 'placeholder', 'alt', 'title'] as $attribute) {
            if ($element->hasAttribute($attribute)) $element->setAttribute($attribute, $translate($element->getAttribute($attribute)));
        }
        if ($element->nodeName === 'meta' && $element->getAttribute('name') === 'description') $element->setAttribute('content', $translate($element->getAttribute('content')));
        if ($element->nodeName === 'a') {
            $href = $element->getAttribute('href');
            if (str_starts_with($href, '#')) $element->setAttribute('href', $localeUrl($locale, $pageSlug) . $href);
            if (preg_match('~^([a-z-]+)\.php(#[^ ]*)?$~', $href, $match) && in_array($match[1], $routeIds, true)) {
                $element->setAttribute('href', $localeUrl($locale, $match[1] === 'index' ? '' : $match[1]) . ($match[2] ?? ''));
            }
        }
    }
    $dom->documentElement->setAttribute('lang', $locale);
    foreach (iterator_to_array($dom->childNodes) as $node) if ($node->nodeType === XML_PI_NODE) $dom->removeChild($node);
    return $dom->saveHTML();
});
