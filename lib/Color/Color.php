<?php

namespace BGre\TerminalFun\Color;

use BGre\TerminalFun\Terminfo;

abstract class Color
{
    protected static bool $trueColorEnabled;

    protected string $foregroundSequence;
    protected string $backgroundSequence;

    final public static function enableTrueColor(?bool $enable)
    {
        self::$trueColorEnabled = $enable ?? self::detectTrueColor();
    }

    final public static function isTrueColorEnabled(): bool
    {
        self::$trueColorEnabled ??= self::detectTrueColor();

        return self::$trueColorEnabled;
    }

    public function render(bool $foreground, Terminfo $terminfo): string
    {
        if ($foreground) {
            return $this->foregroundSequence ?? $this->getSequence(true, $terminfo);
        }

        return $this->backgroundSequence ?? $this->getSequence(false, $terminfo);
    }

    abstract protected function getSequence(bool $foreground, Terminfo $terminfo): string;

    protected static function detectTrueColor(): bool
    {
        $colorterm = getenv('COLORTERM');

        return 'truecolor' === $colorterm || '24bit' === $colorterm;
    }

    protected function calculate8bitColor(float $r, float $g, float $b): int
    {
        if (0.1 > max(abs($r - $g), abs($g - $b), abs($r - $b))) {
            // grey colors
            return 232 + $this->scale(($r + $g + $b) / 3, 24);
        }

        return 16 + 36 * $this->scale($r, 6) + 6 * $this->scale($g, 6) + $this->scale($b, 6);
    }

    /**
     * Scale a float value into an integer range.
     *
     * @param float $value The value between 0 and 1
     * @param int   $scale Destination scale
     *
     * @return int Value betwen 0 and ($scale - 1), including both ends
     */
    protected function scale(float $value, int $scale): int
    {
        if ($value <= 0) {
            return 0;
        }

        if ($value >= 1) {
            return $scale - 1;
        }

        return (int) ($scale * $value);
    }
}
