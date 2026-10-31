<?php
// Third-level items follow the workbook sitemap. Destinations stay local except BA tools.
$englishPathLabel = $locale === 'kk' ? 'Ағылшын тілі бағыты' : ($locale === 'ru' ? 'Направление английского языка' : 'The Master English Path');
$nestedMenus = [
    'brainify' => [
        ['The AI Path', 'brainify.php#ai-path'],
        ['The Creator Path', 'brainify.php#creator-path'],
        ['The Financial Intelligence Path', 'brainify.php#financial-intelligence-path'],
        ['The Digital Economy Path', 'brainify.php#digital-economy-path'],
        ['The Youth Path', 'brainify.php#youth-path'],
        ['The Digital Marketing Path', 'brainify.php#digital-marketing-path'],
        [$englishPathLabel, 'brainify.php#english-path'],
    ],
    'about-ignite' => [
        ['Our Company', 'our-company.php'],
        ['Our Promise', 'our-promise.php'],
        ['IGNITE Company Profile (downloadable)', null],
        ['Our Products (downloadable)', null],
    ],
    'opportunity' => [
        ['Why Choose IGNITE', 'why-choose-ignite.php'],
        ['5 Ways to Earn', 'five-ways-to-earn.php'],
        ['The IGNITE Advantage', 'ignite-advantage.php'],
        ['Success Stories', 'success-stories.php'],
    ],
    'become-a-brand-affiliate' => [
        ['Getting Started', 'become-a-brand-affiliate.php#getting-started'],
        ['Registration', 'become-a-brand-affiliate.php#registration'],
        ['Your Next Steps', 'become-a-brand-affiliate.php#next-steps'],
    ],
    'build-your-business' => [
        ['BA Resources', 'https://distributor.joinignite.com/'],
        ['BA Tools', 'https://distributor.joinignite.com/'],
        ['Training', 'events.php'],
        ['FAQs', 'faqs.php'],
    ],
];
