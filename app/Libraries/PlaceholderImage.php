<?php

namespace App\Libraries;

/**
 * Draws a branded product placeholder (pastel card, hanger mark, name, colour dots)
 * so seeded products look finished until real photos are uploaded.
 */
class PlaceholderImage
{
    public const COLOR_HEX = [
        'black' => '#2b2b2b', 'blue' => '#4f86d9', 'brown' => '#8b5e3c', 'gray' => '#a09fa4', 'green' => '#4caf7a',
        'orange' => '#f28c38', 'pink' => '#f48fb1', 'red' => '#e5484d', 'white' => '#f4f4f4', 'yellow' => '#f7c948',
        'navy' => '#233b61',
    ];

    private const PALETTES = [
        ['#fde8e4', '#fbd0c9'], ['#e3f3ef', '#c9e6df'], ['#fff3d6', '#fde7ab'],
        ['#e4ecf8', '#cbd9ef'], ['#f1e8f7', '#e2d2ee'], ['#e7f4e1', '#d2e9c8'],
    ];

    /**
     * @param list<string> $colors
     */
    public static function make(string $path, string $title, string $subtitle, array $colors, int $palette, bool $hover = false): void
    {
        $w = 600;
        $h = 750;
        $im = imagecreatetruecolor($w, $h);
        imageantialias($im, true);

        [$bg, $bg2] = self::PALETTES[$palette % count(self::PALETTES)];
        if ($hover) {
            [$bg, $bg2] = [$bg2, $bg];
        }
        imagefill($im, 0, 0, self::rgb($im, $bg));

        // soft circle behind the mark
        imagefilledellipse($im, $w / 2, 285, 400, 400, self::rgb($im, $bg2));
        imagefilledellipse($im, $w / 2, 285, 330, 330, self::rgb($im, '#ffffff'));

        $mark = FCPATH . 'assets/frontend/images/favicon.png';
        if (is_file($mark)) {
            $src = imagecreatefrompng($mark);
            imagecopyresampled($im, $src, (int) ($w / 2 - 110), 175, 0, 0, 220, 220, imagesx($src), imagesy($src));
        }

        $navy = self::rgb($im, '#233b61');
        $muted = self::rgb($im, '#556f93');
        $font = self::font();

        // category label
        self::centerText($im, strtoupper($subtitle), 20, 548, $muted, $font, false);

        // product name (wrap to two lines)
        $lines = self::wrap($title, 22, $font);
        $y = 600;
        foreach (array_slice($lines, 0, 2) as $line) {
            self::centerText($im, $line, 30, $y, $navy, $font, true);
            $y += 44;
        }

        if (! is_dir(dirname($path))) {
            mkdir(dirname($path), 0775, true);
        }
        imagepng($im, $path, 7);
    }

    private static function rgb($im, string $hex): int
    {
        $hex = ltrim($hex, '#');

        return imagecolorallocate($im, hexdec(substr($hex, 0, 2)), hexdec(substr($hex, 2, 2)), hexdec(substr($hex, 4, 2)));
    }

    private static function font(): ?string
    {
        foreach (['C:/Windows/Fonts/arialbd.ttf', '/usr/share/fonts/truetype/dejavu/DejaVuSans-Bold.ttf', '/usr/share/fonts/dejavu/DejaVuSans-Bold.ttf'] as $f) {
            if (is_file($f)) {
                return $f;
            }
        }

        return null;
    }

    private static function wrap(string $text, int $maxChars, ?string $font): array
    {
        $lines = [];
        $line = '';
        foreach (explode(' ', $text) as $word) {
            if ($line !== '' && strlen($line . ' ' . $word) > $maxChars) {
                $lines[] = $line;
                $line = $word;
            } else {
                $line = trim($line . ' ' . $word);
            }
        }
        if ($line !== '') {
            $lines[] = $line;
        }

        return $lines;
    }

    private static function centerText($im, string $text, int $size, int $y, int $color, ?string $font, bool $bold): void
    {
        if (! $font) {
            imagestring($im, 5, (int) (600 / 2 - strlen($text) * 4.5), $y - 14, $text, $color);

            return;
        }
        $box = imagettfbbox($size, 0, $font, $text);
        $tw = $box[2] - $box[0];
        imagettftext($im, $size, 0, (int) ((600 - $tw) / 2), $y, $color, $font, $text);
    }
}
