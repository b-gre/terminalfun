<?php

namespace BGre\TerminalFun\Style\Effects;

use BGre\TerminalFun\Color\Color;
use BGre\TerminalFun\Color\ColorPair;

final class SetForeground extends Effect
{
    public function __construct(private Color $color)
    {
    }

    public function changeColor(ColorPair $pair): ColorPair
    {
        return new ColorPair($this->color, $pair->getBackground());
    }
}
