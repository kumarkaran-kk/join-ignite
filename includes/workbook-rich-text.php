<?php
$splitIntro = static function (string $text): array {
    if (preg_match('/^(.{60,330}?[.!?])(?:\s+|$)(.*)$/us', $text, $match)) return [$match[1], trim($match[2])];
    $parts = preg_split('/\n\s*\n/u', $text, 2);
    return [$parts[0] ?? '', $parts[1] ?? ''];
};
$renderRich = static function (string $text) use ($escape): void {
    foreach (preg_split('/\n\s*\n/u', trim($text)) as $paragraph) {
        if (!$paragraph) continue;
        $lines = preg_split('/\n/u', trim($paragraph));
        if (count(array_filter($lines, static fn($line) => preg_match('/^[•\-]\s/u', trim($line)))) === count($lines)) {
            echo '<ul>';
            foreach ($lines as $line) echo '<li>' . $escape(preg_replace('/^[•\-]\s*/u', '', trim($line))) . '</li>';
            echo '</ul>';
        } else echo '<p>' . nl2br($escape($paragraph), false) . '</p>';
    }
};
