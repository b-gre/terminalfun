<?php

namespace BGre\TerminalFun\Menu;

use BGre\TerminalFun\KeyStroke;
use BGre\TerminalFun\Style\Formatter;
use BGre\TerminalFun\Terminal;
use BGre\TerminalFun\Terminfo;
use BGre\TerminalFun\Utility\Str;

class Menu
{
    use MenuProperties;

    protected Terminfo $terminfo;

    /** @var Item[] */
    protected array $items = [];
    /** @var Item[] */
    protected array $visibleItems = [];
    protected ?Item $focusedItem = null;

    protected string $menuStyle = 'menu';

    protected int $contentWidth = 0;
    protected int $scrollOffset = 0;
    protected ?int $width = null;
    protected ?int $height = null;

    protected ?string $quickFilter = null;

    protected array $boundKeys = [];

    protected bool $breakFromLoop;
    protected bool $confirmed;

    public function __construct(protected Formatter $formatter, protected $input, protected $output)
    {
        if (!is_resource($input) || 'stream' !== get_resource_type($input)) {
            throw new \InvalidArgumentException('output must be a stream resource');
        }
        if (!is_resource($output) || 'stream' !== get_resource_type($output)) {
            throw new \InvalidArgumentException('output must be a stream resource');
        }

        $this->terminfo = $formatter->getTerminfo();
        $this->border = new Border();

        // initialize default key bindings
        $this->boundKeys = [
            'Return' => [$this, 'confirm'],
            'Esc' => [$this, 'cancel'],
            'PgUp' => [$this, 'pageUp'],
            'Up' => [$this, 'oneUp'],
            'Home' => [$this, 'toTop'],
            'PgDown' => [$this, 'pageDown'],
            'Down' => [$this, 'oneDown'],
            'End' => [$this, 'toEnd'],
        ];
    }

    public function addItem(Item $item)
    {
        if (null === $this->focusedItem && empty($this->items)) {
            // automatically focus the first added item
            $this->focusedItem = $item;
        }
        $this->items[] = $item;
        $this->visibleItems[] = $item;
        $this->contentWidth = max($this->contentWidth, $item->getContentWidth());
    }

    public function bindKey(string $key, callable $callback)
    {
        $this->boundKeys[$key] = $callback;
    }

    public function oneDown()
    {
        $this->moveFocus(1);
    }

    public function pageDown()
    {
        $this->moveFocus($this->getHeight() - 2);
    }

    public function toTop()
    {
        $this->moveFocus(-count($this->visibleItems));
    }

    public function toEnd()
    {
        $this->moveFocus(count($this->items));
    }

    public function oneUp()
    {
        $this->moveFocus(-1);
    }

    public function pageUp()
    {
        $this->moveFocus(-$this->getHeight() + 2);
    }

    public function moveFocus(int $steps)
    {
        if (empty($this->visibleItems) || 0 === $steps) {
            return;
        }

        $redrawItems = [];
        if (
            null !== $this->focusedItem &&
            false !== $index = array_search($this->focusedItem, $this->visibleItems, true)
        ) {
            $redrawItems[] = $this->focusedItem;
            $newIndex = $index + $steps;
        } else {
            $newIndex = 0;
            $index = null;
        }

        if ($newIndex < 0) {
            $newIndex = 0;
        }

        if ($newIndex >= count($this->visibleItems)) {
            $newIndex = count($this->visibleItems) - 1;
        }

        if ($newIndex === $index) {
            return;
        }

        $contentHeight = $this->getHeight() - 2;

        while (!$this->items[$newIndex]->canBeFocused()) {
            if ($steps < 0) {
                if ($newIndex <= 0) {
                    $newIndex = $index;
                    break;
                }
                --$newIndex;
            }
            if ($steps > 0) {
                if ($newIndex >= count($this->visibleItems) - 1) {
                    $newIndex = $index;
                    break;
                }
                ++$newIndex;
            }
        }

        if (null !== $newIndex) {
            $redrawItems[] = $this->focusedItem = $this->visibleItems[$newIndex];
        } else {
            $this->focusedItem = null;
        }

        if (!$this->scrollIntoView($this->focusedItem)) {
            $this->redrawItems(...$redrawItems);
        }
    }

    public function unfocus()
    {
        $oldFocus = $this->focusedItem;
        $this->focusedItem = null;
        if (null !== $oldFocus) {
            $this->redrawItems($oldFocus);
        }
    }

    public function getWidth(): int
    {
        return $this->width ??= min(
            Terminal::getWidth() - $this->offsetLeft,
            $this->maxWidth,
            $this->maximize
                ? PHP_INT_MAX
                : mb_strlen($this->border->leftLine)
                + mb_strlen($this->border->rightLine)
                + mb_strlen($this->leftPadding)
                + mb_strlen($this->rightPadding)
                + $this->contentWidth
        );
    }

    /**
     * @return int The width of the menu at which no items need to be truncated
     */
    public function getIdealWidth(): int
    {
        return $this->contentWidth
            + mb_strlen($this->leftPadding)
            + mb_strlen($this->rightPadding)
            + mb_strlen($this->border->leftLine)
            + mb_strlen($this->border->rightLine);
    }

    /**
     * @return int The width of the longest menu item
     */
    public function getContentWidth(): int
    {
        return $this->contentWidth;
    }

    public function getHeight(): int
    {
        return $this->height ??= min(
            Terminal::getHeight() - $this->offsetTop,
            $this->maxHeight,
            $this->maximize ? PHP_INT_MAX : count($this->items) + 2
        );
    }

    public function getInnerHeigth(): int
    {
        return $this->getHeight()
            - ($this->topLineVisible() ? 1 : 0)
            - ($this->bottomLineVisible() ? 1 : 0);
    }

    /**
     * Next calls to getWidth()/getHeight() will recalculate the menu dimension.
     *
     * @return $this
     */
    public function resetDimensions(): static
    {
        $this->width = null;
        $this->height = null;

        return $this;
    }

    public function recalculateContentWidth(): static
    {
        $this->contentWidth = 0;
        foreach ($this->items as $item) {
            $this->contentWidth = max($this->contentWidth, $item->getContentWidth());
        }

        return $this;
    }

    public function display()
    {
        $height = $this->getHeight();
        $width = $this->getWidth();
        $innerHeight = $this->getInnerHeigth();

        $lines = array_fill(0, $this->offsetTop, '');

        $linePrefix = $this->offsetLeft > 0 ? $this->terminfo->parmRightCursor($this->offsetLeft) : '';

        if ($this->topLineVisible()) {
            $lines[] = $linePrefix.$this->getTopLine($width);
        }

        for ($i = 0; $i < $innerHeight; ++$i) {
            $index = $i + $this->scrollOffset;
            if (0 <= $index && $index < count($this->visibleItems)) {
                $item = $this->visibleItems[$index];
                $lines[] = $linePrefix.$this->renderItem($item, $width);
            } else {
                $lines[] = $linePrefix.$this->formatter->render($this->wrap($this->menuStyle, sprintf(
                    '<border>%s</border>%s<border>%s</border>',
                    $this->border->leftLine,
                    Str::fill(' ', $width - mb_strlen($this->border->leftLine) - mb_strlen($this->border->rightLine)),
                    $this->border->rightLine
                )));
            }
        }

        if ($this->bottomLineVisible()) {
            $lines[] = $linePrefix.$this->getBottomLine($width);
        }

        $prefix = $this->controlCursorVisibility ? $this->terminfo->cursorInvisible() : '';
        $suffix = $this->terminfo->columnAddress(0).$this->terminfo->parmUpCursor($height - 1 + $this->offsetTop);

        fwrite($this->output, $prefix.implode(PHP_EOL, $lines).$suffix);
    }

    public function clear()
    {
        $lineErase =
            ($this->offsetLeft > 0 ? $this->terminfo->parmRightCursor($this->offsetLeft) : '').
            $this->terminfo->eraseChars($this->getWidth());

        $output = str_repeat(PHP_EOL, $this->offsetTop)
            .str_repeat($lineErase.PHP_EOL, $this->getHeight() - 1)
            .$lineErase
            .$this->terminfo->columnAddress(0)
            .$this->terminfo->parmUpCursor($this->getHeight() + $this->offsetTop - 1)
            .($this->controlCursorVisibility ? $this->terminfo->cursorVisible() : '');

        fwrite($this->output, $output);
    }

    public function run(): ?Item
    {
        $this->display();
        try {
            return $this->loop();
        } finally {
            $this->clear();
        }
    }

    public function loop(): ?Item
    {
        // FIXME remove
        $this->breakFromLoop = false;

        while (!$this->breakFromLoop) {
            $key = KeyStroke::read($this->input, $this->terminfo);
            $special = $key->getSpecialName();

            if (null !== $this->quickFilter && 'Esc' === $special) {
                $this->setQuickFilter(null);
            } elseif (null !== $this->quickFilter && $key->isBackspace()) {
                $this->setQuickFilter('' === $this->quickFilter ? null : mb_substr($this->quickFilter, 0, -1));
            } elseif (array_key_exists($special, $this->boundKeys)) {
                ($this->boundKeys[$special])($this, $key);
            } elseif ($this->quickFilterEnabled && $key->isLetter() && (null !== $this->quickFilter || ' ' !== $key->getRaw())) {
                $this->setQuickFilter(($this->quickFilter ?: '').$key->getRaw());
            } elseif (null !== $this->focusedItem) {
                $this->focusedItem->handleKey($this, $key);
            }
        }

        return $this->confirmed ? $this->focusedItem : null;
    }

    public function confirm()
    {
        $this->breakFromLoop = true;
        $this->confirmed = true;
    }

    public function cancel()
    {
        $this->breakFromLoop = true;
        $this->confirmed = false;
    }

    public function redrawItems(Item ...$items)
    {
        $lastIndex = $this->scrollOffset + $this->getInnerHeigth() - 1;

        $redawItems = array_filter(
            $this->visibleItems,
            fn ($item, $index) => $index >= $this->scrollOffset && $index <= $lastIndex && in_array($item, $items, true),
            ARRAY_FILTER_USE_BOTH
        );

        if (empty($redawItems)) {
            return;
        }

        $linePrefix = $this->offsetLeft > 0 ? $this->terminfo->parmRightCursor($this->offsetLeft) : '';
        $width = $this->getWidth();
        $position = 0;
        $output = str_repeat(PHP_EOL, $this->offsetTop + ($this->topLineVisible() ? 1 : 0));

        foreach ($redawItems as $index => $item) {
            $itemPos = $index - $this->scrollOffset;
            $output .= str_repeat(PHP_EOL, $itemPos - $position);
            $output .= $linePrefix.$this->renderItem($item, $width).PHP_EOL;
            $position = $itemPos + 1;
        }

        $output .= $this->terminfo->parmUpCursor($position + 1 + $this->offsetTop);

        fwrite($this->output, $output);
    }

    public function scrollIntoView(Item $item)
    {
        $index = array_search($item, $this->visibleItems);

        if (false === $index || empty($this->visibleItems)) {
            return false;
        }

        $innerHeight = $this->getInnerHeigth();

        if (0 >= $innerHeight) {
            return false;
        }

        while ($index >= $this->scrollOffset + $innerHeight) {
            $this->scrollOffset += $innerHeight;
        }

        while ($index < $this->scrollOffset) {
            $this->scrollOffset -= $innerHeight;
        }

        $this->scrollOffset = max(0, min(count($this->visibleItems) - $innerHeight, $this->scrollOffset));

        $this->display();

        return true;
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function getVisibleItems(): array
    {
        return $this->visibleItems;
    }

    public function getFocusedItem(): ?Item
    {
        return $this->focusedItem;
    }

    protected function getTopLine(int $width): string
    {
        return $this->formatter->render(
            $this->wrap($this->menuStyle, $this->wrap('border', $this->getBorderLine(
                $width,
                $this->border->topLeftCorner,
                $this->border->topLine,
                $this->border->topRightCorner,
                $this->border->topTitleStart,
                $this->title,
                $this->border->topTitleEnd
            )))
        );
    }

    protected function getBottomLine(int $width): string
    {
        if (null === $this->quickFilter) {
            return $this->formatter->render(
                $this->wrap($this->menuStyle, $this->wrap('border', $this->getBorderLine(
                    $width,
                    $this->border->bottomLeftCorner,
                    $this->border->bottomLine,
                    $this->border->bottomRightCorner,
                    $this->border->bottomTitleStart,
                    null,
                    $this->border->bottomTitleEnd
                )))
            );
        }

        $maxWidth = $this->getWidth() - mb_strlen($this->border->bottomLeftCorner) - mb_strlen($this->border->bottomRightCorner);
        $qfLen = min($maxWidth, mb_strlen($this->quickFilter));

        return $this->formatter->render($this->wrap(
            $this->menuStyle,
            '<border>'.$this->border->bottomLeftCorner.'</border>'
                .'<quickfilter>'.htmlspecialchars(mb_substr($this->quickFilter, -$qfLen, $qfLen))
                .Str::fill(' ', $maxWidth - $qfLen).'</quickfilter>'
                .'<border>'.$this->border->bottomRightCorner.'</border>'
        ));
    }

    protected function getBorderLine(
        int $width,
        string $leftCorner,
        string $fillString,
        string $rightCorner,
        string $titleStart,
        ?string $title,
        string $titleEnd
    ): string {
        $fillLen = $width - mb_strlen($leftCorner) - mb_strlen($rightCorner);

        $maxTitleLen = $fillLen
            - mb_strlen($titleStart)
            - mb_strlen($titleEnd);

        $line = $leftCorner
            .($fillLen > 0 ? str_repeat($fillString, $fillLen) : '')
            .$rightCorner;

        if (null === $title || 0 >= $maxTitleLen) {
            return $leftCorner
                .Str::fill($fillString, $fillLen)
                .$rightCorner;
        }

        $title = $this->border->topTitleStart.mb_substr($this->title, 0, $maxTitleLen).$this->border->topTitleEnd;
        $titlePos = ($width - mb_strlen($title)) / 2;
        $line = mb_substr($line, 0, $titlePos).$title.mb_substr($line, $titlePos + mb_strlen($title));

        return $line;
    }

    protected function wrap(string $tag, string $content): string
    {
        return "<{$tag}>{$content}</{$tag}>";
    }

    protected function setQuickFilter(?string $newFilter)
    {
        if ($this->quickFilter === $newFilter) {
            return;
        }

        $words = array_filter(explode(' ', mb_strtolower($newFilter)));

        if (null === $newFilter) {
            $this->visibleItems = $this->items;
        } elseif (str_starts_with($newFilter, $this->quickFilter)) {
            $this->visibleItems = array_values(array_filter(
                $this->visibleItems,
                static fn (Item $i) => $i->matchesFilter($words)
            ));
        } else {
            $this->visibleItems = array_values(array_filter(
                $this->items,
                static fn (Item $i) => $i->matchesFilter($words)
            ));
        }

        $this->quickFilter = $newFilter;

        if (in_array($this->focusedItem, $this->visibleItems, true)) {
            $this->scrollIntoView($this->focusedItem);
        } else {
            $this->scrollOffset = 0;
            $this->display();
        }
    }

    protected function renderItem(Item $item, int $width)
    {
        $isFocused = $item === $this->focusedItem;

        $markup = $item->getMarkup(
            $isFocused ? $this->focusedLeftPadding : $this->leftPadding,
            $isFocused ? $this->focusedRightPadding : $this->rightPadding,
            $this->border,
            $width
        );

        if ($isFocused) {
            $markup = $this->wrap('focused', $markup);
        }

        // dump($markup); sleep(10000);

        return $this->formatter->render($this->wrap($this->menuStyle, $markup));
    }

    protected function topLineVisible(): bool
    {
        return '' !== $this->border->topLine || null !== $this->title;
    }

    protected function bottomLineVisible(): bool
    {
        return '' !== $this->border->bottomLine || null !== $this->quickFilter;
    }
}
