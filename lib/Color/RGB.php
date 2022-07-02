<?php

namespace BGre\TerminalFun\Color;

use BGre\TerminalFun\Terminfo;

final class RGB extends Color
{
    /**
     * RGB constructor.
     *
     * @param float $r Red [0, 1]
     * @param float $g Green [0, 1]
     * @param float $b Blue [0, 1]
     */
    public function __construct(
        protected float $r,
        protected float $g,
        protected float $b
    ) {
    }

    public function getR(): float
    {
        return $this->r;
    }

    public function getG(): float
    {
        return $this->g;
    }

    public function getB(): float
    {
        return $this->b;
    }

    protected function getSequence(bool $foreground, Terminfo $terminfo): string
    {
        self::$trueColorEnabled ??= self::detectTrueColor();

        if (self::$trueColorEnabled || 0x1000000 === $terminfo->maxColors()) {
            return sprintf(
                "\e[%d;2;%d;%d;%dm",
                $foreground ? 38 : 48,
                $this->scale($this->r, 256),
                $this->scale($this->g, 256),
                $this->scale($this->b, 256)
            );
        }

        $tiColors = $terminfo->maxColors();
        if (256 === $tiColors) {
            return $terminfo->compileString(
                $foreground ? 'set_a_foreground' : 'set_a_background',
                $this->calculate8bitColor($this->r, $this->g, $this->b)
            );
        }

        $scale = 16 === $tiColors ? 3 : 2;
        $ri = $this->scale($this->r, $scale);
        $gi = $this->scale($this->g, $scale);
        $bi = $this->scale($this->b, $scale);

        $threshold = max(1, $ri, $gi, $bi);

        $color =
            ($ri >= $threshold ? 1 : 0) |
            (($gi >= $threshold ? 1 : 0) << 1) |
            (($bi >= $threshold ? 1 : 0) << 2);

        return 16 === $tiColors
            ? $terminfo->compileString(
                $foreground ? 'set_a_foreground' : 'set_a_background',
                $color + ($threshold > 1 ? 8 : 0)
            )
            : sprintf("\e[%d%dm", $foreground ? 3 : 4, $color);
    }
}
