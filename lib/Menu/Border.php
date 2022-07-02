<?php

namespace BGre\TerminalFun\Menu;

class Border
{
    public string $topLeftCorner;
    public string $topLine;
    public string $topRightCorner;
    public string $bottomLeftCorner;
    public string $bottomLine;
    public string $bottomRightCorner;
    public string $leftLine;
    public string $rightLine;

    public string $topTitleStart;
    public string $topTitleEnd;
    public string $bottomTitleStart;
    public string $bottomTitleEnd;

    /** @var array|array[]|string[][] Each array element is an array with three strings: start, repeat-char(s), end.
     *                                The array should be sorted by visual intensity (least intense first).
     */
    public array $dividers;

    public function __construct()
    {
        $this->doubleBorders();
    }

    /**
     * Apply double borders style.
     *
     * @return void
     */
    public function doubleBorders(bool $titleDecoration = false)
    {
        $this->topLeftCorner = '╔';
        $this->topRightCorner = '╗';
        $this->bottomLeftCorner = '╚';
        $this->bottomRightCorner = '╝';
        $this->topLine = $this->bottomLine = '═';
        $this->leftLine = $this->rightLine = '║';

        $this->bottomTitleStart = $this->topTitleStart = $titleDecoration ? '╡ ' : ' ';
        $this->bottomTitleEnd = $this->topTitleEnd = $titleDecoration ? ' ╞' : ' ';

        $this->dividers = [
            ['╟', '─', '╢'],
            ['╠', '═', '╣'],
        ];
    }

    public function singleBorders(bool $titleDecoration = false, bool $roundCorners = false)
    {
        $this->topLeftCorner = $roundCorners ? '╭' : '┌';
        $this->topRightCorner = $roundCorners ? '╮' : '┐';
        $this->bottomLeftCorner = $roundCorners ? '╰' : '└';
        $this->bottomRightCorner = $roundCorners ? '╯' : '┘';
        $this->topLine = $this->bottomLine = '─';
        $this->leftLine = $this->rightLine = '│';

        $this->bottomTitleStart = $this->topTitleStart = $titleDecoration ? '┤ ' : ' ';
        $this->bottomTitleEnd = $this->topTitleEnd = $titleDecoration ? ' ├' : ' ';

        $this->dividers = [
            ['├', '─', '┤'],
            ['╞', '═', '╡'],
        ];
    }

    public function noBorders()
    {
        $this->topLeftCorner = '';
        $this->topRightCorner = '';
        $this->bottomLeftCorner = '';
        $this->bottomRightCorner = '';
        $this->topLine = $this->bottomLine = '';
        $this->leftLine = $this->rightLine = '';

        $this->bottomTitleStart = $this->topTitleStart = '';
        $this->bottomTitleEnd = $this->topTitleEnd = '';

        $this->dividers = [
            ['', '─', ''],
            ['', '═', ''],
        ];
    }
}
