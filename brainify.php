<?php
$pageId = 'brainify';
$pageTitle = 'brAInify | AI-Assisted Learning | IGNITE Kazakhstan';
$pageDescription = 'Explore brAInify from IGNITE: six digital learning pathways, three progressive levels and personalised AI guidance.';
$pageStyles = ['assets/css/brainify.css', 'assets/css/brainify-motion.css'];
$pageScripts = ['assets/js/brainify.js'];
require __DIR__ . '/includes/header.php';
?>
<main id="brainify-main">
        <section class="brainify-hero" id="overview">
            <div class="brainify-hero-copy">
                <p class="brainify-eyebrow">IGNITE / DIGITAL EDUCATION</p>
                <h1>Your next chapter.<br><span>Powered by learning.</span></h1>
                <p class="brainify-intro">Meet brAInify: IGNITE’s AI-assisted learning platform. Explore practical
                    digital skills with structured pathways and guidance that adapts to you.</p>
                <div class="brainify-actions"><a class="brainify-button" href="#knowledge-paths">Find your learning path
                        <span aria-hidden="true">↗</span></a><a class="brainify-text-link" href="#how-it-works">How it
                        works <span aria-hidden="true">↓</span></a></div>
            </div>
            <div class="brainify-hero-visual">
                <img src="assets/images/kazakhstan/almaty-learning.jpg" alt="Illustrative learning scene in Almaty" fetchpriority="high">
                <div class="brainify-image-caption"><span class="brainify-live-dot" aria-hidden="true"></span> A new way
                    to learn</div>
                <div class="brainify-image-note"><strong>Learning, with direction.</strong><span>From your first step to
                        your next possibility.</span></div>
            </div>
            <div class="brainify-facts">
                <div><strong>06</strong><span>Learning pathways</span></div>
                <div><strong>03</strong><span>Progressive levels</span></div>
                <div><strong>AI</strong><span>Personal guidance</span></div>
            </div>
        </section>
        <section class="brainify-promise brainify-section">
            <p class="brainify-eyebrow">ROOM TO GROW</p>
            <h2>Big possibilities.<br><span>Approachable first steps.</span></h2>
            <p>Build confidence with accessible lessons, useful tools and projects that connect learning to everyday
                challenges.</p>
        </section>
        <section class="brainify-paths brainify-section" id="knowledge-paths">
            <div class="brainify-section-heading">
                <div>
                    <p class="brainify-eyebrow">CHOOSE YOUR DIRECTION</p>
                    <h2>Six paths.<br>A world of possibilities.</h2>
                </div>
                <p>Choose a subject to explore.</p>
            </div>
            <div class="brainify-path-grid">
                <details class="brainify-path" open>
                    <summary><span class="brainify-path-number">01 / AI</span>
                        <h3>Artificial intelligence</h3><span class="brainify-expand" aria-hidden="true">+</span>
                    </summary>
                    <div class="brainify-path-description">
                        <p>Use AI tools, develop workflows and create automated systems.</p><a
                            href="#how-it-works">Explore the learning levels ↗</a>
                    </div>
                </details>
                <details class="brainify-path">
                    <summary><span class="brainify-path-number">02 / CREATE</span>
                        <h3>Content creation</h3><span class="brainify-expand" aria-hidden="true">+</span>
                    </summary>
                    <div class="brainify-path-description">
                        <p>Develop your niche, produce content and build creator businesses.</p><a
                            href="#how-it-works">Explore the learning levels ↗</a>
                    </div>
                </details>
                <details class="brainify-path">
                    <summary><span class="brainify-path-number">03 / FINANCE</span>
                        <h3>Financial intelligence</h3><span class="brainify-expand" aria-hidden="true">+</span>
                    </summary>
                    <div class="brainify-path-description">
                        <p>Study markets, risk management and disciplined trading practices.</p><a
                            href="#how-it-works">Explore the learning levels ↗</a>
                    </div>
                </details>
                <details class="brainify-path">
                    <summary><span class="brainify-path-number">04 / DIGITAL</span>
                        <h3>The digital economy</h3><span class="brainify-expand" aria-hidden="true">+</span>
                    </summary>
                    <div class="brainify-path-description">
                        <p>Understand blockchain, wallets, digital assets and security.</p><a
                            href="#how-it-works">Explore the learning levels ↗</a>
                    </div>
                </details>
                <details class="brainify-path">
                    <summary><span class="brainify-path-number">05 / YOUTH</span>
                        <h3>Young innovators</h3><span class="brainify-expand" aria-hidden="true">+</span>
                    </summary>
                    <div class="brainify-path-description">
                        <p>Discover coding, creative projects and early entrepreneurship.</p><a
                            href="#how-it-works">Explore the learning levels ↗</a>
                    </div>
                </details>
                <details class="brainify-path">
                    <summary><span class="brainify-path-number">06 / MARKETING</span>
                        <h3>Digital marketing</h3><span class="brainify-expand" aria-hidden="true">+</span>
                    </summary>
                    <div class="brainify-path-description">
                        <p>Explore audiences, funnels, analytics and marketing automation.</p><a
                            href="#how-it-works">Explore the learning levels ↗</a>
                    </div>
                </details>
            </div>
        </section>
        <section class="brainify-levels brainify-section" id="how-it-works">
            <p class="brainify-eyebrow">PROGRESS WITH PURPOSE</p>
            <h2>One step builds on the next.</h2>
            <div class="brainify-level-grid">
                <article><span>01</span>
                    <h3>Foundation</h3>
                    <p>Understand the essentials.</p>
                </article>
                <article><span>02</span>
                    <h3>Builder</h3>
                    <p>Practise with useful tools.</p>
                </article>
                <article><span>03</span>
                    <h3>Master</h3>
                    <p>Develop your own systems.</p>
                </article>
            </div>
        </section>
        <section class="brainify-mentor brainify-section" id="ai-mentor">
            <div class="brainify-mentor-art" aria-hidden="true">
                <div class="brainify-orbit"></div>
                <div class="brainify-orbit second"></div>
                <div class="brainify-mentor-core">AI</div><span class="brainify-orbit-label first">Explore</span><span
                    class="brainify-orbit-label second">Understand</span><span
                    class="brainify-orbit-label third">Apply</span>
            </div>
            <div>
                <p class="brainify-eyebrow">GUIDANCE ALONG THE WAY</p>
                <h2>A mentor for<br>your learning journey.</h2>
                <p>The AI mentor explains concepts, recommends lessons and helps you apply new skills. Videos,
                    challenges and certifications support your progress.</p><a class="brainify-text-link"
                    href="#get-started">Take the next step ↗</a>
            </div>
        </section>
        <section class="brainify-audience brainify-section">
            <p class="brainify-eyebrow">YOUR STARTING POINT IS ENOUGH</p>
            <h2>For wherever you are now.</h2>
            <div class="brainify-audience-list"><span>Aspiring entrepreneurs</span><span>Career
                    builders</span><span>Students</span><span>Lifelong learners</span></div>
        </section>
        <section class="brainify-join brainify-section" id="get-started">
            <p class="brainify-eyebrow">MAKE SPACE FOR WHAT’S NEXT</p>
            <h2>Start with curiosity.<br>Keep growing.</h2><a class="brainify-button"
                href="contact.php">Ask about brAInify <span aria-hidden="true">↗</span></a>
        </section>
    </main>
<?php require __DIR__ . '/includes/footer.php'; ?>
