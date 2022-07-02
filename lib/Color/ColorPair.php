<?php

namespace BGre\TerminalFun\Color;

use BGre\TerminalFun\Terminfo;

class ColorPair
{
    public function __construct(
        protected Color $foreground,
        protected Color $background
    ) {
    }

    public function getForeground(): Color
    {
        return $this->foreground;
    }

    public function getBackground(): Color
    {
        return $this->background;
    }

    public function render(Terminfo $terminfo): string
    {
        return $this->foreground->render(true, $terminfo).$this->background->render(false, $terminfo);
    }

    public function isEqual(self $other): bool
    {
        if ($this === $other) {
            return true;
        }

        return $this->foreground === $other->foreground && $this->background === $other->background;
    }
}
