<?php

namespace BGre\TerminalFun\Style\Effects;

use BGre\TerminalFun\Color\Color;
use BGre\TerminalFun\Color\ColorPair;
use BGre\TerminalFun\Color\HSV;

final class Brighter extends Effect
{
    public function __construct(private ?float $changeForeground, private ?float $changeBackground)
    {
    }

    public function changeColor(ColorPair $pair): ColorPair
    {
        return new ColorPair(
            $this->adjust($pair->getForeground(), $this->changeForeground),
            $this->adjust($pair->getBackground(), $this->changeBackground)
        );
    }

    private function adjust(Color $color, ?float $change)
    {
        if (null === $change || abs($change) < 0.0001) {
            return $color;
        }

        $hsv = HSV::fromOther($color);

        return new HSV($hsv->getH(), $hsv->getS(), $hsv->getV() + $change);
    }
}
