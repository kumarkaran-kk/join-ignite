<?php
// The plain PHP server falls back to index.php for directory-style URLs.
// Dispatch those requests as well, even when no router was supplied at startup.
if (PHP_SAPI === 'cli-server' && !defined('IGNITE_ROUTED') &&
    !in_array(parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH), ['/', '/index.php', '/index'], true)) {
    require __DIR__ . '/router.php';
    exit;
}
$pageId = 'home';
$pageTitle = 'IGNITE Kazakhstan';
$pageDescription = 'IGNITE fuels your mind, body, and lifestyle with purposeful products, ethical business solutions, and practical learning experiences.';
$pageStyles = ['assets/css/coverage.css'];
$pageScripts = ['assets/js/motion.js', 'assets/js/coverage.js'];
require __DIR__ . '/includes/header.php';
?>
<main>
        <section class="learning" id="products">
            <div class="learning-copy">
                <h2>SMARTER LEARNING<br>REAL-WORLD SKILLS</h2>
                <p>Discover brAInify — an AI-powered learning experience designed to help you build practical skills,
                    unlock new possibilities, and stay ahead in a rapidly changing world. Explore learning paths built
                    to turn AI knowledge into real-world action.</p>
            </div>
            <div class="learning-image" id="brainify"><img src="assets/images/kazakhstan/almaty-learning.jpg"
                    alt="Illustrative learning scene in Almaty" loading="lazy"><a class="pill" href="brainify.php">Explore
                    brAInify <img src="assets/images/arrow.svg" alt=""></a></div>
        </section>
        <section class="about" id="about"><img class="about-background" src="assets/images/about.png" alt="">
            <h2>This is IGNITE</h2>
            <p>A global social enterprise built around people, purpose, and products that create real value. Discover
                our story, our promise, and the people shaping what comes next.</p><a class="pill"
                href="about.php">Learn More <img src="assets/images/smallArrow.svg" alt=""></a>
        </section>
        <!-- Original news section retained for reference.
        <section class="news" id="resources"><img class="news-background" src="assets/images/news.png" alt="">
            <div class="news-copy">
                <h2>IN THE <span>NEWS</span></h2>
                <p>From local stories to global conversations, see how IGNITE is making its mark across markets
                    worldwide. Explore the latest media features covering our vision, innovation, products, and people.
                </p>
            </div>
            <div class="news-items">
                <article class="news-item active">
                    <div class="news-logo"><img src="assets/images/africa.png" alt="Africa Trade Monitor"></div><button
                        class="news-selector" aria-expanded="true"><img src="assets/images/newsArrow.svg" alt="">
                        <h3>Africa Trade Monitor</h3><span>01</span>
                    </button>
                </article>
                <article class="news-item">
                    <div class="news-logo"><img src="assets/images/financial.png" alt="The Financial Capital"></div><button
                        class="news-selector" aria-expanded="false"><img src="assets/images/newsArrow.svg" alt="">
                        <h3>The Financial Capital</h3><span>02</span>
                    </button>
                </article>
                <article class="news-item">
                    <div class="news-logo"><img src="assets/images/asia.png" alt="Asia Viral News"></div><button
                        class="news-selector" aria-expanded="false"><img src="assets/images/newsArrow.svg" alt="">
                        <h3>Asia Viral News</h3><span>03</span>
                    </button>
                </article>
                <article class="news-item">
                    <div class="news-logo"><img src="assets/images/world.png" alt="The World Agenda"></div><button
                        class="news-selector" aria-expanded="false"><img src="assets/images/newsArrow.svg" alt="">
                        <h3>The World Agenda</h3><span>04</span>
                    </button>
                </article>
            </div>
            <div class="news-dots" aria-label="Featured news"><button class="active" aria-label="Africa Trade Monitor"
                    aria-pressed="true"></button><button aria-label="The Financial Capital"
                    aria-pressed="false"></button><button aria-label="Asia Viral News"
                    aria-pressed="false"></button><button aria-label="The World Agenda" aria-pressed="false"></button>
            </div>
        </section>
        -->
        <section class="coverage" id="resources" aria-labelledby="coverage-title" aria-roledescription="carousel">
            <span class="coverage-label">PR COVERAGE</span>
            <h2 id="coverage-title">In The News</h2>
            <p class="coverage-description">From local stories to global conversations, see how IGNITE is making its
                mark across markets worldwide. Explore the latest media features covering our vision, innovation,
                products, and people.</p>
            <div class="coverage-slider">
                <button class="coverage-arrow coverage-prev" type="button" aria-label="Previous publication"
                    aria-controls="coverage-track"><svg viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M6 10.3 17 4a2 2 0 0 1 3 1.7v12.6a2 2 0 0 1-3 1.7L6 13.7a2 2 0 0 1 0-3.4Z" />
                    </svg></button>
                <div class="coverage-window">
                    <div class="coverage-track" id="coverage-track">
                        <div class="coverage-card"><img src="assets/images/world.png" alt="The World Agenda"></div>
                        <div class="coverage-card"><img src="assets/images/voyage.png" alt="Voyage Times"></div>
                        <div class="coverage-card"><img src="assets/images/tech-asialogue.png" alt="Tech Asialogue"></div>
                        <div class="coverage-card"><img src="assets/images/africa.png" alt="Africa Trade Monitor"></div>
                        <div class="coverage-card"><img src="assets/images/financial.png" alt="Financial Capital"></div>
                    </div>
                </div>
                <button class="coverage-arrow coverage-next" type="button" aria-label="Next publication"
                    aria-controls="coverage-track"><svg viewBox="0 0 24 24" aria-hidden="true">
                        <path d="m18 10.3-11-6A2 2 0 0 0 4 6v12a2 2 0 0 0 3 1.7l11-6a2 2 0 0 0 0-3.4Z" />
                    </svg></button>
            </div>
            <a class="coverage-cta" href="media.php">View All Media Coverage</a>
            <div class="coverage-dots" aria-label="Choose first publication">
                <button type="button" aria-label="Show The World Agenda" aria-pressed="true"></button>
                <button type="button" aria-label="Show Voyage Times" aria-pressed="false"></button>
                <button type="button" aria-label="Show Tech Asialogue" aria-pressed="false"></button>
                <button type="button" aria-label="Show Africa Trade Monitor" aria-pressed="false"></button>
                <button type="button" aria-label="Show Financial Capital" aria-pressed="false"></button>
            </div>
        </section>
        <section class="business" id="business-opportunity">
            <div class="journey" data-node-id="2149:342">
                <div class="journey-track" aria-hidden="true">
                    <div class="journey-slide"><img src="assets/images/journey.png" alt=""></div>
                    <div class="journey-slide"><img src="assets/images/journey-choice.png" alt=""></div>
                    <div class="journey-slide"><img src="assets/images/journey-future.png" alt=""></div>
                </div>
                <h2 aria-label="Your journey. Your choice. Your future."><span class="journey-words"
                        aria-hidden="true"><span>YOUR JOURNEY</span><span>YOUR CHOICE</span><span>YOUR
                            FUTURE</span></span></h2>
            </div>
            <div class="business-copy"><img class="business-background" src="assets/images/business.png" alt="">
                <p>Whether you’re exploring our products or ready to build a business, IGNITE connects you with a global
                    community, powerful tools, and the freedom to create your own path and unlock your limitless
                    potential.</p><a class="pill" href="business.php">Start Your IGNITE Business <img
                        src="assets/images/smallArrow.svg" alt=""></a>
            </div>
        </section>
    </main>
<?php require __DIR__ . '/includes/footer.php'; ?>
