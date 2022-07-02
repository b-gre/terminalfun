<?php

namespace BGre\TerminalFun\Menu;

use BGre\TerminalFun\Menu\DataItemDisplay\Display;
use BGre\TerminalFun\Utility\Str;

class DataItemDisplay
{
    /** @var Display[] */
    protected array $displays = [];
    protected ?int $expandDisplayIndex = null;

    /** @var callable[] */
    protected array $wrappers = [];

    public function addDisplay(Display $display, bool $expand = false): static
    {
        if ($expand) {
            $this->expandDisplayIndex = count($this->displays);
        }
        $this->displays[] = $display;

        return $this;
    }

    /**
     * A wrapper can modify the markup of an item after it has been built using the displays.
     *
     * @param  callable(DataItem $item, string $markup): string $wrapper
     *
     * @return void
     */
    public function addWrapper(callable $wrapper)
    {
        $this->wrappers[] = $wrapper;
    }

    public function reset()
    {
        $this->displays = [];
        $this->expandDisplayIndex = null;
        $this->wrappers = [];
    }

    public function getMarkup(DataItem $dataItem, int $width): string
    {
        $markup = null === $this->expandDisplayIndex
            ? $this->getMarkupSimple($dataItem, $width)
            : $this->getMarkupExpanding($dataItem, $width);

        foreach ($this->wrappers as $wrapper) {
            $markup = $wrapper($dataItem, $markup);
        }

        return $markup;
    }

    public function getContentWidth(DataItem $dataItem): int
    {
        return array_reduce(
            $this->displays,
            fn (int $w, Display $d) => $w + $d->getContentWidth($dataItem),
            0
        );
    }

    private function getMarkupSimple(DataItem $dataItem, int $width): string
    {
        $result = '';
        $wRemain = $width;

        foreach ($this->displays as $display) {
            $w = $display->getContentWidth($dataItem);
            $result .= $display->getMarkup($dataItem, min($w, $wRemain));
            $wRemain -= $w;
            if ($wRemain < 0) {
                break;
            }
        }

        if ($wRemain > 0) {
            $result .= Str::fill(' ', $wRemain);
        }

        return $result;
    }

    private function getMarkupExpanding(DataItem $dataItem, int $width): string
    {
        /** @var array{Display,int,int,bool} $info */
        $info = [];
        $minWidth = 0;
        $desiredWidth = 0;
        $expMinWidth = 0;
        $expDesiredWidth = 0;

        foreach ($this->displays as $i => $display) {
            $mw = $display->getMinWidth($dataItem);
            $cw = $display->getContentWidth($dataItem);
            $expand = $i === $this->expandDisplayIndex;

            if ($expand) {
                $expDesiredWidth = $cw;
                $expMinWidth = $mw;
            } else {
                $desiredWidth += $cw;
                $minWidth += $mw;
            }

            $info[] = [$display, $mw, $cw, $expand];
        }

        $wRemain = $width;

        $markupBefore = '';
        $markupAfter = '';
        $addTo = &$markupBefore;
        $factor = min(1, $width / ($expDesiredWidth + $desiredWidth));

        /** @var Display $display */
        foreach ($info as [$display, $mw, $cw, $expand]) {
            if ($expand) {
                $addTo = &$markupAfter;
                $wRemain -= $mw;
                continue;
            }

            $markup = $display->getMarkup($dataItem, max($mw, (int) round($cw * $factor)));
            $w = mb_strlen(strip_tags($markup));

            if ($w > $wRemain) {
                break;
            }

            $addTo .= $markup;
            $wRemain -= $w;
        }

        return $markupBefore
            .$this->displays[$this->expandDisplayIndex]->getMarkup($dataItem, $wRemain + $expMinWidth)
            .$markupAfter;
    }
}
