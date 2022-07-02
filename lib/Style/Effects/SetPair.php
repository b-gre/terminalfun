<?php

namespace BGre\TerminalFun\Style\Effects;

use BGre\TerminalFun\Color\ColorPair;

final class SetPair extends Effect
{
    public function __construct(private ColorPair $pair)
    {
    }

    public function changeColor(ColorPair $pair): ColorPair
    {
        return $this->pair;
    }
}
