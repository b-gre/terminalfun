<?php

namespace BGre\TerminalFun\Menu;

use BGre\TerminalFun\KeyStroke;
use BGre\TerminalFun\Utility\Str;

/**
 * A plain menu item.
 */
class PlainItem implements Item
{
    protected $enabled = true;

    public function __construct(protected string $text)
    {
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getContentWidth(): int
    {
        return mb_strlen(strip_tags($this->text));
    }

    /**
     * Please wrap output in the following tags:
     *    border: the left and right border
     *    item: for the content.
     *
     * @return string The text including left and right borders */
    public function getMarkup(string $leftPadding, string $rightPadding, Border $border, int $width): string
    {
        $w = $width - mb_strlen($border->leftLine) - mb_strlen($border->rightLine) - mb_strlen($leftPadding) - mb_strlen($rightPadding);
        $tlen = mb_strlen(strip_tags($this->text));

        $paddedText = $tlen <= $w ? $this->text.str_repeat(' ', $w - $tlen) : Str::truncateMarkup($this->text, $w);
        $paddedText = htmlspecialchars($paddedText);
        $paddedText = '<item>'.$leftPadding.$paddedText.$rightPadding.'</item>';

        if (!$this->enabled) {
            $paddedText = '<disabled>'.$paddedText.'</disabled>';
        }

        return sprintf(
            '<border>%s</border>%s<border>%s</border>',
            $border->leftLine,
            $paddedText,
            $border->rightLine
        );
    }

    public function canBeFocused(): bool
    {
        return $this->enabled;
    }

    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    public function setEnabled(bool $enabled): static
    {
        $this->enabled = $enabled;

        return $this;
    }

    public function matchesFilter(array $words): bool
    {
        foreach ($words as $word) {
            if (false === mb_stripos($this->text, $word)) {
                return false;
            }
        }

        return true;
    }

    public function handleKey(Menu $menu, KeyStroke $key): void
    {
        // nothing
    }
}
