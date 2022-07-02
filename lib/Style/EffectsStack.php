<?php

namespace BGre\TerminalFun\Style;

use BGre\TerminalFun\Color\ColorPair;
use BGre\TerminalFun\Style\Effects\Effect;
use BGre\TerminalFun\Terminfo;

class EffectsStack
{
    protected array $effectsStack = [];
    protected array $tagStack = [];
    protected array $colorStack = [];

    protected array $states = [];
    protected ColorPair $currentPair;

    public function __construct(ColorPair $initialPair)
    {
        $this->currentPair = $initialPair;
    }

    public function getTagStack(): array
    {
        return $this->tagStack;
    }

    public function getAndIncrement(string $stateName, int $initialValue = 0)
    {
        if (!array_key_exists($stateName, $this->states)) {
            $this->states[$stateName] = $initialValue;
        }

        return $this->states[$stateName]++;
    }

    public function incrementAndGet(string $stateName, int $initialValue = 0)
    {
        if (!array_key_exists($stateName, $this->states)) {
            $this->states[$stateName] = $initialValue;
        }

        return ++$this->states[$stateName];
    }

    public function getAndDecrement(string $stateName, int $initialValue = 0)
    {
        if (!array_key_exists($stateName, $this->states)) {
            $this->states[$stateName] = $initialValue;
        }

        return $this->states[$stateName]--;
    }

    public function decrementAndGet(string $stateName, int $initialValue = 0)
    {
        if (!array_key_exists($stateName, $this->states)) {
            $this->states[$stateName] = $initialValue;
        }

        return --$this->states[$stateName];
    }

    public function enter(Terminfo $terminfo, string $tag, Effect ...$effects): string
    {
        $codes = '';

        $newPair = $this->currentPair;

        foreach ($effects as $effect) {
            $newPair = $effect->changeColor($newPair);
            $codes .= $effect->getEnterCodes($terminfo, $this);
        }

        if (!$newPair->isEqual($this->currentPair)) {
            $codes .= $newPair->render($terminfo);
        }

        $this->effectsStack[] = $effects;
        $this->tagStack[] = $tag;
        $this->colorStack[] = $this->currentPair;
        $this->currentPair = $newPair;

        return $codes;
    }

    public function leave(Terminfo $terminfo): string
    {
        /** @var Effect[] $effects */
        $effects = array_pop($this->effectsStack);
        array_pop($this->tagStack);
        $restoreColor = array_pop($this->colorStack);

        $codes = '';

        /** @var Effect $effect */
        foreach ($effects as $effect) {
            $codes .= $effect->getExitCodes($terminfo, $this);
        }

        if (!$restoreColor->isEqual($this->currentPair)) {
            $codes .= $restoreColor->render($terminfo);
        }

        $this->currentPair = $restoreColor;

        return $codes;
    }
}
