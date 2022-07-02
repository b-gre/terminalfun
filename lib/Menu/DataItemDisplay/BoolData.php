<?php

namespace BGre\TerminalFun\Menu\DataItemDisplay;

use BGre\TerminalFun\Menu\DataItem;

class BoolData extends Display
{
    public function __construct(
        protected string $key,
        protected string $trueString = '☑',
        protected string $falseString = '☐',
        ?string $tag = null,
        bool $allOrNothing = false,
        int $minWidth = 1
    ) {
        parent::__construct($tag, $allOrNothing, $minWidth);
    }

    protected function getText(DataItem $item): string
    {
        return $item->getData($this->key) ? $this->trueString : $this->falseString;
    }
}
