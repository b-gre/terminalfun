<?php

namespace BGre\TerminalFun\Menu\DataItemDisplay;

use BGre\TerminalFun\Menu\DataItem;

class StringData extends Display
{
    public function __construct(
        protected string $key,
        ?string $tag = null,
        bool $allOrNothing = false,
        int $minWidth = 0
    ) {
        parent::__construct($tag, $allOrNothing, $minWidth);
    }

    protected function getText(DataItem $item): string
    {
        return (string) $item->getData($this->key);
    }
}
