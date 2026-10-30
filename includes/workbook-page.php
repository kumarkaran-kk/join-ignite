<?php
// $copy contains approved copy for this page and the explicitly requested language.
$pageTitle = $copy['title'] . ' | IGNITE Kazakhstan';
$pageDescription = preg_replace('/\s+/u', ' ', $copy['intro']);
$pageStyles = ['assets/css/brainify.css', 'assets/css/brainify-motion.css', 'assets/css/pages.css', 'assets/css/workbook-content.css'];
$pageScripts = ['assets/js/pages.js', 'assets/js/workbook-pages.js'];
$bodyClass = 'content-page workbook-page';
$mainId = 'page-main';
require __DIR__ . '/header.php';
require __DIR__ . '/workbook-rich-text.php';
[$heroIntro, $openingBody] = $splitIntro($copy['intro']);
?>
<main id="page-main">
    <section class="page-hero has-image">
        <img class="page-hero-image" src="assets/images/<?= $escape($copy['image']) ?>" alt="">
        <div class="page-hero-copy">
            <a class="page-back" href="index.php"><?= $locale === 'kk' ? 'Басты бет' : ($locale === 'ru' ? 'Главная' : 'Home') ?> / <?= $escape($copy['title']) ?></a>
            <p class="brainify-eyebrow">IGNITE</p>
            <h1><?= $escape($copy['heading']) ?></h1>
            <p class="page-intro"><?= $escape($heroIntro) ?></p>
            <?php if ($openingBody || $copy['sections']): ?><a class="brainify-button" href="#page-content"><?= $locale === 'kk' ? 'Толығырақ' : ($locale === 'ru' ? 'Подробнее' : 'Explore') ?> <span aria-hidden="true">↓</span></a><?php endif; ?>
        </div>
        <div class="page-orbits" aria-hidden="true"><i></i><i></i><i></i></div>
    </section>
    <section class="page-content" id="page-content">
        <?php if ($openingBody): ?><div class="workbook-opening workbook-prose"><?php $renderRich($openingBody); ?></div><?php endif; ?>
        <?php foreach ($copy['sections'] as $section): ?>
            <div class="workbook-section workbook-<?= $escape($section['type']) ?>">
                <?php if ($section['title']): ?><h2><?= $escape($section['title']) ?></h2><?php endif; ?>
                <div class="<?= in_array($section['type'], ['cards', 'media']) ? 'page-grid' : 'workbook-items' ?><?= $section['type'] === 'media' ? ' media-grid' : '' ?>">
                <?php foreach ($section['items'] as $index => $item): ?>
                    <?php if (in_array($section['type'], ['profiles', 'accordion'])): ?>
                        <details class="workbook-disclosure" <?= isset($item['id']) ? 'id="'.$escape($item['id']).'"' : '' ?>>
                            <summary><h3><?= $escape($item['title']) ?></h3><span aria-hidden="true">+</span></summary>
                            <div class="workbook-prose"><?php $renderRich($item['body']); ?><?php if (!empty($item['href'])): ?><a class="brainify-button" href="<?= $escape($item['href']) ?>"><?= $escape($item['label'] ?? $item['title']) ?> <span aria-hidden="true">↗</span></a><?php endif; ?></div>
                        </details>
                    <?php elseif ($section['type'] === 'media'): ?>
                        <article class="page-card">
                            <div class="publication-logo"><img src="assets/images/<?= $escape($item['image']) ?>" alt="<?= $escape($item['title']) ?>"></div>
                            <h3><?= $escape($item['title']) ?></h3>
                            <a href="<?= $escape($item['href']) ?>" target="_blank" rel="noopener noreferrer">Read publication feature <span aria-hidden="true">↗</span></a>
                        </article>
                    <?php else: ?>
                        <article class="<?= $section['type'] === 'cards' ? 'page-card' : 'workbook-prose' ?>">
                            <?php if ($section['type'] === 'cards'): ?><span class="page-number"><?= sprintf('%02d', $index + 1) ?></span><?php endif; ?>
                            <?php if ($item['title']): ?><h3><?= $escape($item['title']) ?></h3><?php endif; ?>
                            <?php $renderRich($item['body']); ?>
                            <?php if (!empty($item['href'])): ?><a class="<?= $section['type'] === 'cards' ? '' : 'brainify-button' ?>" href="<?= $escape($item['href']) ?>"><?= $escape($item['label'] ?? $item['title']) ?> <span aria-hidden="true">↗</span></a><?php endif; ?>
                        </article>
                    <?php endif; ?>
                <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </section>
    <section class="page-next">
        <div><p class="brainify-eyebrow">KEEP MOVING FORWARD</p><h2>Where will you go next?</h2></div>
        <a class="brainify-button" href="<?= in_array($pageId, ['our-company', 'our-promise', 'leadership', 'advisory-board']) ? 'about.php' : 'contact.php' ?>"><?= in_array($pageId, ['our-company', 'our-promise', 'leadership', 'advisory-board']) ? 'ABOUT IGNITE' : 'Connect with IGNITE' ?> <span aria-hidden="true">↗</span></a>
    </section>
</main>
<?php require __DIR__ . '/footer.php'; ?>
