<?php

namespace BGre\TerminalFun\Menu;

use BGre\TerminalFun\KeyStroke;

interface Item
{
    public function getContentWidth(): int;

    /**
     * Please wrap the output in the following tags:
     *    border: the left and right border
     *    item: for the content.
     *
     * @return string The text including left and right borders */
    public function getMarkup(string $leftPadding, string $rightPadding, Border $border, int $width): string;

    public function canBeFocused(): bool;

    public function matchesFilter(array $words): bool;

    public function handleKey(Menu $menu, KeyStroke $key): void;
}
