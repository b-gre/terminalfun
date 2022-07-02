<?php

namespace BGre\TerminalFun\Menu;

use BGre\TerminalFun\KeyStroke;

class DataItem implements Item
{
    protected string $matchText;

    public function __construct(protected array $data, protected DataItemDisplay $display)
    {
        $this->matchText = $this->buildMatchText($data);
    }

    public function getContentWidth(): int
    {
        return $this->display->getContentWidth($this);
    }

    public function getMarkup(string $leftPadding, string $rightPadding, Border $border, int $width): string
    {
        $netWidth = $width
            - mb_strlen($leftPadding)
            - mb_strlen($rightPadding)
            - mb_strlen($border->leftLine)
            - mb_strlen($border->rightLine);

        return sprintf(
            '<border>%s</border><item>%s%s%s</item><border>%s</border>',
            $border->leftLine,
            $leftPadding,
            $this->display->getMarkup($this, $netWidth),
            $rightPadding,
            $border->rightLine
        );
    }

    public function canBeFocused(): bool
    {
        return true;
    }

    public function matchesFilter(array $words): bool
    {
        foreach ($words as $word) {
            if (false === strpos($this->matchText, $word)) {
                return false;
            }
        }

        return true;
    }

    public function handleKey(Menu $menu, KeyStroke $key): void
    {
    }

    public function getData(string $key)
    {
        $ref = &$this->data;
        foreach (explode('.', $key) as $part) {
            $ref = &$ref[$part];
        }

        return $ref;
    }

    protected function buildMatchText(array $data): string
    {
        $matchText = '';

        foreach ($data as $item) {
            if (is_string($item)) {
                $matchText .= ' '.mb_strtolower($item);
            } elseif (is_array($item)) {
                $matchText .= ' '.$this->buildMatchText($item);
            }
        }

        return $matchText;
    }
}
