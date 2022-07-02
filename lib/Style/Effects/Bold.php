<?php

namespace BGre\TerminalFun\Style\Effects;

use BGre\TerminalFun\Style\EffectsStack;
use BGre\TerminalFun\Terminfo;

final class Bold extends Effect
{
    public function getEnterCodes(Terminfo $terminfo, EffectsStack $stack): string
    {
        return 0 === $stack->getAndIncrement('bold') ? "\e[1m" : '';
    }

    public function getExitCodes(Terminfo $terminfo, EffectsStack $stack): string
    {
        return 0 === $stack->decrementAndGet('bold') ? "\e[22m" : '';
    }
}
