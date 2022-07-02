<?php

namespace BGre\TerminalFun\Menu\DataItemDisplay;

use BGre\TerminalFun\Menu\DataItem;

class Literal extends Display
{
    public function __construct(
        protected string $literal,
        ?string $tag = null,
        bool $allOrNothing = false,
        int $minWidth = 0
    ) {
        parent::__construct($tag, $allOrNothing, $minWidth);
    }

    protected function getText(DataItem $item): string
    {
        return $this->literal;
    }
}
