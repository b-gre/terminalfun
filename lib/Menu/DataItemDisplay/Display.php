<?php

namespace BGre\TerminalFun\Menu\DataItemDisplay;

use BGre\TerminalFun\Menu\DataItem;
use BGre\TerminalFun\Utility\Str;

abstract class Display
{
    public function __construct(
        protected ?string $tag = null,
        protected bool $allOrNothing = false,
        protected int $minWidth = 0
    ) {
    }

    public function getMarkup(DataItem $item, int $maxWidth): string
    {
        $cw = $this->getContentWidth($item);

        if ($this->allOrNothing && $cw > $maxWidth) {
            return '';
        }

        $text = $cw <= $maxWidth
            ? $this->getText($item).Str::fill(' ', $maxWidth - $cw)
            : mb_substr($this->getText($item), 0, $maxWidth - 1).'…';

        $text = htmlspecialchars($text);

        return null === $this->tag ? $text : "<{$this->tag}>{$text}</{$this->tag}>";
    }

    public function getMinWidth(DataItem $item): int
    {
        return $this->minWidth;
    }

    public function getContentWidth(DataItem $item): int
    {
        return mb_strlen($this->getText($item));
    }

    abstract protected function getText(DataItem $item): string;
}
