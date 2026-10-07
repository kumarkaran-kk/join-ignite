<footer id="support">
        <div class="footer-main">
            <div class="footer-brand"><a href="<?= $isHome ? '#home' : 'index.php' ?>"><img class="footer-logo" src="assets/images/logo.png"
                        alt="IGNITE Kazakhstan"></a>
                <div class="socials"><a href="https://www.facebook.com/" aria-label="Facebook"><img
                            src="assets/images/facebook.svg" alt=""></a><a href="https://twitter.com/"
                        aria-label="Twitter"><img src="assets/images/twitter.svg" alt=""></a><a
                        href="https://www.instagram.com/" aria-label="Instagram"><img src="assets/images/instagram.svg"
                            alt=""></a></div>
                <p class="footer-inquiry"><span>For inquiries, please contact:</span> <a href="mailto:spark@joinignite.com">spark@joinignite.com</a></p>
            </div>
            <div class="footer-short-links">
            <nav aria-label="Products">
                <h3>Products</h3><a href="brainify.php">brAInify</a>
            </nav>
            <nav aria-label="Resources">
                <h3>Resources</h3><a href="blog.php">Blog</a><a href="events.php">Training and Events</a>
            </nav>
            <nav aria-label="Support">
                <h3>Support</h3><a href="contact.php">Contact Us</a><a href="help.php">Help Centre</a>
            </nav>
            </div>
            <nav class="footer-about" aria-label="About">
                <h3>About</h3><a href="about.php">About IGNITE</a><a href="leadership.php">IGNITE Leadership</a><a
                    href="advisory-board.php">IGNITE Global Advisory Board</a><a href="media.php">Media</a><a
                    href="faqs.php">FAQs</a>
            </nav>
            <nav class="footer-business" aria-label="Business Opportunity">
                <h3>Business Opportunity</h3>
                <a href="business.php">The IGNITE Opportunity</a>
                <a href="become-a-brand-affiliate.php">Become a Brand Affiliate</a>
                <a href="build-your-business.php">Build Your Business</a>
            </nav>
            <nav class="footer-policies" aria-label="Policies">
                <h3><a href="policies.php">Policies</a></h3>
                <a href="ai-content-disclaimer.php">AI Content Disclaimer</a>
                <a href="shipping-policy.php">Shipping Policy</a>
                <a href="return-refund-and-exchange-policy.php">Return, Refund, and Exchange Policy</a>
                <a href="terms-and-conditions.php">Terms and Conditions</a>
                <a href="privacy-policy.php">Privacy Policy</a>
                <a href="social-media-policy.php">Social Media Policy</a>
            </nav>
        </div>
        <p class="copyright">Copyright © 2026 IGNITE Kazakhstan. No reproduction in whole or in part without written
            permission. All Rights Reserved. All trademarks and product images exhibited on this site, unless otherwise
            indicated, are the property of IGNITE Kazakhstan</p>
    </footer>
    <dialog id="information"><button class="dialog-close" aria-label="Close dialog">×</button>
        <h2></h2>
        <p></p>
    </dialog>
    <dialog id="search-dialog"><button class="dialog-close" aria-label="Close search">×</button>
        <form><label for="site-search">Search IGNITE</label><input id="site-search" type="search"
                placeholder="Search this page" required><button type="submit">Search</button></form>
        <p class="search-result" aria-live="polite"></p>
    </dialog>
    <dialog id="language-dialog"><button class="dialog-close" aria-label="Close dialog">×</button>
        <h2>Choose your language</h2>
        <nav aria-label="Language selection">
        <?php foreach ($supportedLocales as $language => $languageName): ?>
            <a data-language="<?= $language ?>" lang="<?= $language ?>" hreflang="<?= $language ?>" href="<?= $escape($localeUrl($language, $pageSlug) . '?language=' . $language) ?>" <?= $locale === $language ? 'aria-current="true"' : '' ?>><?= $languageName ?></a>
        <?php endforeach; ?>
        </nav>
    </dialog>
</body>

</html>
