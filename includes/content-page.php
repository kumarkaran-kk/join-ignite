<?php
$catalog = json_decode(file_get_contents(__DIR__ . '/../data/pages.json'), true, 512, JSON_THROW_ON_ERROR);
if (!isset($catalog[$pageId])) {
    http_response_code(404);
    exit('Page not found');
}
$content = $catalog[$pageId];
$pageTitle = $content['title'] . ' | IGNITE Kazakhstan';
$pageDescription = $content['intro'];
$pageStyles = ['assets/css/brainify.css', 'assets/css/brainify-motion.css', 'assets/css/pages.css'];
$pageScripts = ['assets/js/pages.js'];
$bodyClass = 'content-page';
$mainId = 'page-main';
require __DIR__ . '/header.php';
?>
<main id="page-main">
    <section class="page-hero <?= isset($content['image']) ? 'has-image' : '' ?>">
        <?php if (isset($content['image'])): ?><img class="page-hero-image" src="assets/images/<?= $escape($content['image']) ?>" alt=""><?php endif; ?>
        <div class="page-hero-copy"><a class="page-back" href="index.php">Home / <?= $escape($content['title']) ?></a>
            <p class="brainify-eyebrow"><?= $escape($content['eyebrow']) ?></p>
            <h1><?= $escape($content['heading']) ?></h1>
            <p class="page-intro"><?= $escape($content['intro']) ?></p>
            <a class="brainify-button" href="#page-content">Explore <?= $escape($content['title']) ?> <span aria-hidden="true">↓</span></a>
        </div>
        <div class="page-orbits" aria-hidden="true"><i></i><i></i><i></i></div>
    </section>
    <section class="page-content" id="page-content">
        <p class="brainify-eyebrow">EXPLORE IGNITE</p>
        <h2><?= $escape($content['section']) ?></h2>
        <?php if (isset($content['sections'])): ?>
            <div class="policy-document">
                <?php foreach ($content['sections'] as $section): ?>
                    <article><h3><?= $escape($section[0]) ?></h3><p><?= $escape($section[1]) ?></p></article>
                <?php endforeach; ?>
                <a class="brainify-button" href="contact.php">Ask about this policy</a>
            </div>
        <?php endif; ?>
        <?php if (isset($content['cards'])): ?>
            <div class="page-grid">
                <?php foreach ($content['cards'] as $index => $card): ?>
                    <article class="page-card"><span class="page-number"><?= sprintf('%02d', $index + 1) ?></span>
                        <h3><?= $escape($card[0]) ?></h3>
                        <p><?= $escape($card[1]) ?></p><?php if (!empty($card[2])): ?><a href="<?= $escape($card[2]) ?>"><?= $escape($card[3]) ?> <span aria-hidden="true">↗</span></a><?php endif; ?>
                    </article>
                <?php endforeach; ?>
            </div><?php endif; ?>
        <?php if (isset($content['people'])): ?>
            <div class="page-grid people-grid"><?php foreach ($content['people'] as $person): ?>
                    <article class="page-card person-card"><span class="person-mark" aria-hidden="true">✦</span>
                        <p><?= $escape($person[1]) ?></p>
                        <h3><?= $escape($person[0]) ?></h3>
                    </article>
                <?php endforeach; ?>
            </div><?php endif; ?>
        <?php if (isset($content['media'])): ?>
            <div class="page-grid media-grid"><?php foreach ($content['media'] as $publication): ?>
                    <article class="page-card">
                        <div class="publication-logo"><img src="assets/images/<?= $escape($publication[1]) ?>" alt="<?= $escape($publication[0]) ?>"></div>
                        <p>25 April 2026 · brAInify launch</p>
                        <h3><?= $escape($publication[0]) ?></h3><a href="<?= $escape($publication[2]) ?>">Read publication feature <span aria-hidden="true">↗</span></a>
                    </article>
                <?php endforeach; ?>
            </div><?php endif; ?>
        <?php if (isset($content['faqs'])): ?>
            <div class="page-faqs"><?php foreach ($content['faqs'] as $faq): ?>
                    <details>
                        <summary><?= $escape($faq[0]) ?><span aria-hidden="true">+</span></summary>
                        <p><?= $escape($faq[1]) ?></p>
                    </details>
                <?php endforeach; ?>
            </div><?php endif; ?>
    </section>
    <section class="page-next">
        <div>
            <p class="brainify-eyebrow">KEEP MOVING FORWARD</p>
            <h2>Where will you go next?</h2>
        </div><a class="brainify-button" href="<?= $pageId === 'contact' ? 'help.php' : 'contact.php' ?>"><?= $pageId === 'contact' ? 'Explore the Help Centre' : 'Connect with IGNITE' ?> <span aria-hidden="true">↗</span></a>
    </section>
</main>
<?php require __DIR__ . '/footer.php'; ?>
