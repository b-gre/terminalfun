<?php

namespace BGre\TerminalFun\Menu;

trait MenuProperties
{
    protected Border $border;

    protected ?string $title = null;
    protected bool $quickFilterEnabled = true;

    protected int $offsetTop = 0;
    protected int $offsetLeft = 0;
    protected int $maxWidth = PHP_INT_MAX;
    protected int $maxHeight = PHP_INT_MAX;
    protected bool $maximize = false;
    protected bool $controlCursorVisibility = true;

    protected string $leftPadding = '  ';
    protected string $rightPadding = '  ';
    protected string $focusedLeftPadding = '» ';
    protected string $focusedRightPadding = ' «';

    public function getBorder(): Border
    {
        return $this->border;
    }

    /**
     * @return ?string
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function isQuickFilterEnabled(): bool
    {
        return $this->quickFilterEnabled;
    }

    public function setQuickFilterEnabled(bool $quickFilterEnabled): static
    {
        $this->quickFilterEnabled = $quickFilterEnabled;

        return $this;
    }

    public function getOffsetTop(): int
    {
        return $this->offsetTop;
    }

    public function setOffsetTop(int $offsetTop): static
    {
        if (0 > $offsetTop) {
            throw new \InvalidArgumentException('The top offset can not be negative');
        }

        $this->offsetTop = $offsetTop;
        $this->height = null;

        return $this;
    }

    public function getOffsetLeft(): int
    {
        return $this->offsetLeft;
    }

    public function setOffsetLeft(int $offsetLeft): static
    {
        if (0 > $offsetLeft) {
            throw new \InvalidArgumentException('The left offset can not be negative');
        }

        $this->offsetLeft = $offsetLeft;
        $this->width = null;

        return $this;
    }

    public function getLeftPadding(): string
    {
        return $this->leftPadding;
    }

    public function setLeftPadding(string $leftPadding): static
    {
        $this->leftPadding = $leftPadding;

        return $this;
    }

    public function getRightPadding(): string
    {
        return $this->rightPadding;
    }

    public function setRightPadding(string $rightPadding): static
    {
        $this->rightPadding = $rightPadding;

        return $this;
    }

    public function getFocusedLeftPadding(): string
    {
        return $this->focusedLeftPadding;
    }

    public function setFocusedLeftPadding(string $focusedLeftPadding): static
    {
        $this->focusedLeftPadding = $focusedLeftPadding;

        return $this;
    }

    public function getFocusedRightPadding(): string
    {
        return $this->focusedRightPadding;
    }

    public function setFocusedRightPadding(string $focusedRightPadding): static
    {
        $this->focusedRightPadding = $focusedRightPadding;

        return $this;
    }

    public function setMaxWidth($maxWidth = PHP_INT_MAX): static
    {
        $this->maxWidth = $maxWidth;
        $this->width = null;

        return $this;
    }

    public function getMaxWidth(): int
    {
        return $this->maxWidth;
    }

    public function setMaxHeight($maxHeight = PHP_INT_MAX): static
    {
        $this->maxHeight = $maxHeight;
        $this->height = null;

        return $this;
    }

    public function getMaxHeight(): int
    {
        return $this->maxHeight;
    }

    /**
     * If in maximize mode, the menu tries to take as much space as it can, limited by maxWidth and maxHeight.
     */
    public function setMaximize(bool $maximize): static
    {
        $this->maximize = $maximize;

        return $this;
    }

    public function getMaximize(): bool
    {
        return $this->maximize;
    }

    public function setControlCursorVisibility(bool $controlCursorVisibility): static
    {
        $this->controlCursorVisibility = $controlCursorVisibility;

        return $this;
    }

    public function getControlCursorVisibility(): bool
    {
        return $this->controlCursorVisibility;
    }

    public function getMenuStyle(): string
    {
        return $this->menuStyle;
    }

    public function setMenuStyle(string $menuStyle): static
    {
        $this->menuStyle = $menuStyle;

        return $this;
    }
}
