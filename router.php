<?php
// Shared route allowlist for Apache and the PHP development server.
$path = rawurldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$base = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/.');
if (PHP_SAPI === 'cli-server') $base = '';
$route = substr($path, strlen($base));
if (PHP_SAPI === 'cli-server' && preg_match('~^/(?:assets/|(?:index|brainify)\.html$)~', $route)) return false;
$slugs = array_merge(['brainify'], array_keys(json_decode(file_get_contents(__DIR__ . '/data/pages.json'), true)));
if (preg_match('~^/(?:(en|kk|ru)/)?([a-z-]*)(?:/|\.php)?$~', $route, $matches)) {
    $slug = $matches[2];
    if ($slug === '' || $slug === 'index' || in_array($slug, $slugs, true)) {
        if (!defined('IGNITE_ROUTED')) define('IGNITE_ROUTED', true);
        $_SERVER['SCRIPT_NAME'] = $base . '/' . ($slug === '' ? 'index' : $slug) . '.php';
        require __DIR__ . '/' . ($slug === '' ? 'index' : $slug) . '.php';
        exit;
    }
}
http_response_code(404);
echo 'Page not found';
