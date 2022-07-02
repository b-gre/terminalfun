<?php

namespace BGre\TerminalFun\Style\Effects;

use BGre\TerminalFun\Color\ColorPair;
use BGre\TerminalFun\Style\EffectsStack;
use BGre\TerminalFun\Terminfo;

abstract class Effect
{
    public function changeColor(ColorPair $pair): ColorPair
    {
        return $pair;
    }

    public function getEnterCodes(Terminfo $terminfo, EffectsStack $stack): string
    {
        return '';
    }

    public function getExitCodes(Terminfo $terminfo, EffectsStack $stack): string
    {
        return '';
    }
}
