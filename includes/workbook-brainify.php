<?php
$pageId = 'brainify';
$pageTitle = 'brAInify | IGNITE Kazakhstan';
$pageDescription = preg_replace('/\s+/u', ' ', $copy['intro']);
$pageStyles = ['assets/css/brainify.css', 'assets/css/brainify-motion.css', 'assets/css/workbook-content.css'];
$pageScripts = ['assets/js/brainify.js'];
$bodyClass = 'workbook-page';
require __DIR__ . '/header.php';
require __DIR__ . '/workbook-rich-text.php';
[$heroIntro, $openingBody] = $splitIntro($copy['intro']);
?>
<main id="brainify-main">
    <section class="brainify-hero" id="overview">
        <div class="brainify-hero-copy">
            <p class="brainify-eyebrow">IGNITE / DIGITAL EDUCATION</p>
            <h1><?= $escape($copy['heading']) ?></h1>
            <p class="brainify-intro"><?= $escape($heroIntro) ?></p>
            <div class="brainify-actions"><a class="brainify-button" href="#knowledge-paths">Find your learning path <span aria-hidden="true">↗</span></a><a class="brainify-text-link" href="#how-it-works">How it works <span aria-hidden="true">↓</span></a></div>
        </div>
        <div class="brainify-hero-visual">
            <img src="assets/images/kazakhstan/almaty-learning.jpg" alt="Illustrative learning scene in Almaty" fetchpriority="high">
            <div class="brainify-image-caption"><span class="brainify-live-dot" aria-hidden="true"></span>A new way to learn</div>
            <div class="brainify-image-note"><strong>Learning, with direction.</strong><span>From your first step to your next possibility.</span></div>
        </div>
        <div class="brainify-facts"><div><strong>07</strong><span>Learning pathways</span></div><div><strong>03</strong><span>Progressive levels</span></div><div><strong>AI</strong><span>Personal guidance</span></div></div>
    </section>
    <section class="brainify-section workbook-prose">
        <div class="workbook-product-story">
            <details class="workbook-disclosure"><summary><h3><?= $locale === 'kk' ? 'brAInify туралы' : ($locale === 'ru' ? 'О brAInify' : 'About brAInify') ?></h3><span aria-hidden="true">+</span></summary><div class="workbook-prose"><?php $renderRich($openingBody); ?></div></details>
            <?php foreach (['promise', 'gap'] as $key): ?><details class="workbook-disclosure"><summary><h3><?= $escape($copy[$key]['title']) ?></h3><span aria-hidden="true">+</span></summary><div class="workbook-prose"><?php $renderRich($copy[$key]['body']); ?></div></details><?php endforeach; ?>
        </div>
    </section>
    <section class="brainify-paths brainify-section" id="knowledge-paths">
        <div class="workbook-prose workbook-path-intro"><details class="workbook-disclosure"><summary><h3><?= $escape($copy['pathsIntro']['title']) ?></h3><span aria-hidden="true">+</span></summary><div class="workbook-prose"><?php $renderRich($copy['pathsIntro']['body']); ?></div></details></div>
        <div class="brainify-path-grid">
            <?php foreach ($copy['paths'] as $index => $path): ?>
                <details class="brainify-path" <?= $index === 0 ? 'open' : '' ?>>
                    <summary><span class="brainify-path-number"><?= sprintf('%02d', $index + 1) ?></span><h3><?= $escape($path['title']) ?></h3><span class="brainify-expand" aria-hidden="true">+</span></summary>
                    <div class="brainify-path-description workbook-prose"><?php $renderRich($path['body']); ?><a href="#how-it-works">Explore the learning levels ↗</a></div>
                </details>
            <?php endforeach; ?>
        </div>
    </section>
    <section class="brainify-levels brainify-section" id="how-it-works">
        <p class="brainify-eyebrow">PROGRESS WITH PURPOSE</p><h2>One step builds on the next.</h2>
        <div class="brainify-level-grid">
            <?php foreach ($copy['levels'] as $index => $level): ?>
                <article><span><?= sprintf('%02d', $index + 1) ?></span><p class="workbook-level-label"><?= $escape($copy['levelLabels'][0]) ?></p><h3><?= $escape($level['title']) ?></h3><dl><dt><?= $escape($copy['levelLabels'][1]) ?></dt><dd><?= $escape($level['focus']) ?></dd><dt><?= $escape($copy['levelLabels'][2]) ?></dt><dd><?= $escape($level['gain']) ?></dd></dl></article>
            <?php endforeach; ?>
        </div>
    </section>
    <section class="brainify-section workbook-comparison">
        <div class="workbook-prose"><h2><?= $escape($copy['comparisonIntro']['title']) ?></h2><?php $renderRich($copy['comparisonIntro']['body']); ?></div>
        <div class="workbook-comparison-grid">
            <?php foreach (['before', 'after'] as $side): ?><article><h3><?= $escape($copy['comparison'][$side . 'Title']) ?></h3><ul><?php foreach ($copy['comparison'][$side] as $line): ?><li><?= $escape($line) ?></li><?php endforeach; ?></ul></article><?php endforeach; ?>
        </div>
    </section>
    <section class="brainify-mentor brainify-section" id="ai-mentor">
        <div class="brainify-mentor-art" aria-hidden="true"><div class="brainify-orbit"></div><div class="brainify-orbit second"></div><div class="brainify-mentor-core">AI</div><span class="brainify-orbit-label first">Explore</span><span class="brainify-orbit-label second">Understand</span><span class="brainify-orbit-label third">Apply</span></div>
        <div class="workbook-prose"><p class="brainify-eyebrow">GUIDANCE ALONG THE WAY</p><h2>A mentor for<br>your learning journey.</h2><?php $renderRich($copy['mentor']); ?></div>
    </section>
    <section class="brainify-audience brainify-section">
        <div class="workbook-prose"><h2><?= $escape($copy['audienceIntro']['title']) ?></h2><?php $renderRich($copy['audienceIntro']['body']); ?></div>
        <div class="brainify-audience-list workbook-audience"><?php foreach ($copy['audience'] as $description): ?><span><?= $escape($description) ?></span><?php endforeach; ?></div>
    </section>
    <section class="brainify-join brainify-section" id="get-started">
        <h2><?= $escape($copy['join']['title']) ?></h2><div class="workbook-prose"><?php $renderRich($copy['join']['body']); ?></div><a class="brainify-button" href="contact.php">Ask about brAInify <span aria-hidden="true">↗</span></a>
    </section>
</main>
<?php require __DIR__ . '/footer.php'; ?>
