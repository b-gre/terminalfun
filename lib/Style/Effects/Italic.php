<?php

namespace BGre\TerminalFun\Style\Effects;

use BGre\TerminalFun\Style\EffectsStack;
use BGre\TerminalFun\Terminfo;

final class Italic extends Effect
{
    public function getEnterCodes(Terminfo $terminfo, EffectsStack $stack): string
    {
        return 0 === $stack->getAndIncrement('italic') ? $terminfo->enterItalicsMode() : '';
    }

    public function getExitCodes(Terminfo $terminfo, EffectsStack $stack): string
    {
        return 0 === $stack->decrementAndGet('italic') ? $terminfo->exitItalicsMode() : '';
    }
}
