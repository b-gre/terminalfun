<?php

namespace BGre\TerminalFun\Style\Effects;

use BGre\TerminalFun\Color\Color;
use BGre\TerminalFun\Color\ColorPair;
use BGre\TerminalFun\Color\HSV;

class Saturation extends Effect
{
    public function __construct(private ?float $foreground, private ?float $background)
    {
    }

    public function changeColor(ColorPair $pair): ColorPair
    {
        return new ColorPair(
            $this->adjust($pair->getForeground(), $this->foreground),
            $this->adjust($pair->getBackground(), $this->background)
        );
    }

    private function adjust(Color $color, ?float $change)
    {
        if (null === $change) {
            return $color;
        }

        $hsv = HSV::fromOther($color);

        return new HSV($hsv->getH(), $change, $hsv->getV());
    }
}
