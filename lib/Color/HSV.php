<?php

namespace BGre\TerminalFun\Color;

use BGre\TerminalFun\Terminfo;

class HSV extends Color
{
    /**
     * HSV constructor.
     *
     * @param float $h Hue [0, 1]
     * @param float $s Saturation [0, 1]
     * @param float $v Value [0, 1]
     */
    public function __construct(
        protected float $h,
        protected float $s,
        protected float $v
    ) {
        $this->h = $this->h - floor($this->h);
        $this->s = max(0, min(1, $this->s));
        $this->v = max(0, min(1, $this->v));
    }

    public static function fromOther(Color $color)
    {
        if ($color instanceof self) {
            return $color;
        }

        if ($color instanceof RGB) {
            return self::fromRGB($color);
        }

        throw new \InvalidArgumentException(sprintf('Can not convert %s to HSV', get_class($color)));
    }

    public static function fromRGB(RGB $rgb)
    {
        $r = $rgb->getR();
        $g = $rgb->getG();
        $b = $rgb->getB();
        $maxRGB = max($r, $g, $b);
        $minRGB = min($r, $g, $b);
        $chroma = $maxRGB - $minRGB;

        if (abs($chroma) < 0.0001) {
            return new self(0, 0, $maxRGB);
        }

        if (abs($r - $minRGB) < 0.0001) {
            $h = 3 - (($r - $b) / $chroma);
        } elseif (abs($b - $minRGB) < 0.0001) {
            $h = 1 - (($r - $g) / $chroma);
        } else {
            $h = 5 - (($b - $r) / $chroma);
        }

        return new self($h / 6, $chroma / $maxRGB, $maxRGB);
    }

    public function getH(): float
    {
        return $this->h;
    }

    public function getS(): float
    {
        return $this->s;
    }

    public function getV(): float
    {
        return $this->v;
    }

    public function toRGB(): RGB
    {
        $hh = $this->h * 6;
        $ii = (int) $hh;
        $f = $hh - $ii;
        $m = $this->v * (1 - $this->s);
        $n = $this->v * (1 - $this->s * $f);
        $k = $this->v * (1 - $this->s * (1 - $f));

        switch ($ii) {
            case 0:
                return new RGB($this->v, $k, $m);
            case 1:
                return new RGB($n, $this->v, $m);
            case 2:
                return new RGB($m, $this->v, $k);
            case 3:
                return new RGB($m, $n, $this->v);
            case 4:
                return new RGB($k, $m, $this->v);
            default:
                return new RGB($this->v, $m, $n);
        }
    }

    protected function getSequence(bool $foreground, Terminfo $terminfo): string
    {
        return $this->toRGB()->getSequence($foreground, $terminfo);
    }
}
