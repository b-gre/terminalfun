<?php

namespace BGre\TerminalFun\Menu;

use BGre\TerminalFun\KeyStroke;
use BGre\TerminalFun\Utility\Str;

class Divider implements Item
{
    public function __construct(protected int $level = 0)
    {
    }

    public function __toString()
    {
        return '';
    }

    public function getContentWidth(): int
    {
        return 0;
    }

    public function getMarkup(string $leftPadding, string $rightPadding, Border $border, int $width): string
    {
        $level = min($this->level, count($border->dividers) - 1);
        $divider = current(array_slice($border->dividers, $level, 1));

        return '<border>'
            .$divider[0]
            .Str::fill($divider[1], $width - mb_strlen($divider[0]) - mb_strlen($divider[2]))
            .$divider[2]
            .'</border>';
    }

    public function canBeFocused(): bool
    {
        return false;
    }

    public function matchesFilter(array $words): bool
    {
        return true;
    }

    public function handleKey(Menu $menu, KeyStroke $key): void
    {
        // nothing
    }
}
