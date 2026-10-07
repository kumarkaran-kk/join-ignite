<?php
// Page settings are defined by the calling page, never by request parameters.
require __DIR__ . '/i18n.php';
$isHome = ($pageId ?? 'home') === 'home';
$escape = static fn($value) => htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <base href="<?= $escape($basePath . '/') ?>">
    <?php foreach ($supportedLocales as $language => $languageName): ?>
        <link rel="alternate" hreflang="<?= $language ?>" href="<?= $escape($localeUrl($language, $pageSlug)) ?>">
    <?php endforeach; ?>
    <link rel="alternate" hreflang="x-default" href="<?= $escape($localeUrl('en', $pageSlug)) ?>">
    <link rel="canonical" href="<?= $escape($localeUrl($locale, $pageSlug)) ?>">
    <meta name="description" content="<?= $escape($pageDescription) ?>">
    <title><?= $escape($pageTitle) ?></title>
    <link rel="icon" href="assets/images/logo.png">
    <link rel="stylesheet" href="assets/css/globals.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/motion.css">
    <link rel="stylesheet" href="assets/css/i18n.css">
    <script>
        window.igniteMessages = <?= json_encode(array_intersect_key($translations, array_flip(['Pause animations', 'Resume animations', 'No matching content on this page.', 'This destination is not included in the supplied homepage. Its page or service URL is needed to connect this link.'])), JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?>;
        window.igniteText = text => window.igniteMessages[text] || text;
    </script>
    <?php foreach ($pageStyles as $stylesheet): ?>
        <link rel="stylesheet" href="<?= $escape($stylesheet) ?>">
    <?php endforeach; ?>
    <link rel="stylesheet" href="assets/css/mobile-header.css">
    <link rel="stylesheet" href="assets/css/footer.css">
    <link rel="stylesheet" href="assets/css/kazakhstan.css">
    <script src="assets/js/script.js" defer></script>
    <?php foreach ($pageScripts as $script): ?>
        <script src="<?= $escape($script) ?>" defer></script>
    <?php endforeach; ?>
</head>
<body<?= $isHome ? '' : ' class="brainify-page ' . $escape($bodyClass ?? '') . '"' ?>>
    <?php if (!$isHome): ?>
        <a class="brainify-skip" href="#<?= $escape($mainId ?? 'brainify-main') ?>">Skip to content</a>
    <?php endif; ?>
    <header class="<?= $isHome ? 'hero' : 'brainify-header' ?>" <?= $isHome ? ' id="home"' : '' ?>>
        <?php if ($isHome): ?>
            <div class="hero-background" data-node-id="2149:313">
                <div class="hero-track">
                    <div class="hero-slide kazakhstan-slide"><img id="hero-image" src="assets/images/kazakhstan/astana-ai.jpg" alt="Astana-inspired city illustration" fetchpriority="high"></div>
                    <div class="hero-slide kazakhstan-slide"><img src="assets/images/kazakhstan/alatau-ai.jpg" alt="Almaty-inspired mountain illustration"></div>
                    <div class="hero-slide"><img src="assets/images/hero3.png" alt=""></div>
                </div>
            </div>

        <?php endif; ?>
        <div class="navigation"><a class="brand" href="<?= $isHome ? '#home' : 'index.php' ?>" aria-label="IGNITE home"><img src="assets/images/logo.png"
                    alt="IGNITE"></a><button class="menu-toggle" aria-expanded="false"
                aria-controls="main-navigation"><span>Menu</span><span class="menu-icon" aria-hidden="true"><i></i><i></i><i></i></span></button>
            <nav id="main-navigation" aria-label="Main navigation"><a href="brainify.php" <?= $pageId === 'brainify' ? 'aria-current="page"' : '' ?>>PRODUCTS <img class="chevron"
                        src="assets/images/chevron.svg" alt=""></a><a href="business.php">BUSINESS OPPORTUNITY <img
                        class="chevron" src="assets/images/chevron.svg" alt=""></a><a href="resources.php">RESOURCES <img
                        class="chevron" src="assets/images/chevron.svg" alt=""></a><a href="about.php">ABOUT <img class="chevron"
                        src="assets/images/chevron.svg" alt=""></a><a href="help.php">SUPPORT</a></nav>
            <!-- <button
                class="search-toggle" aria-label="Search website"><img src="assets/images/search.svg" alt=""></button> -->
            <button
                class="pill language" aria-label="Language: English"><img src="assets/images/globe.svg" alt=""> EN <img
                    class="chevron" src="assets/images/languageChevron.svg" alt=""></button><a
                class="pill login" href="https://distributor.joinignite.com/">Login <img src="assets/images/arrow.svg" alt=""></a>
        </div>
        <?php if ($isHome): ?>
            <div class="hero-copy">
                <h1>FUEL YOUR LIFE<br>OWN YOUR <span>FUTURE</span></h1>
                <p>Step into a modern social enterprise built for real progress fueling your mind, body, and daily lifestyle
                    with purposeful products, ethical business solutions, and an unstoppable global movement.</p><a
                    class="hero-link" href="#products" aria-label="Explore IGNITE"><img src="assets/images/heroArrow.svg"
                        alt=""></a>
            </div><button class="hero-progress" aria-label="Show next hero slide"><span></span></button><span
                class="slide-number" aria-label="Hero slides"><span>01</span><span>02</span><span>03</span></span>

        <?php endif; ?>
    </header>
