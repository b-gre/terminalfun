<?php

namespace BGre\TerminalFun\Menu;

use BGre\TerminalFun\KeyStroke;

class CheckboxItem extends PlainItem
{
    protected $toggleCallback = null;

    public function __construct(
        string $text,
        protected bool $checked = false,
        protected string $checkedSymbol = '▣',
        protected string $uncheckedSymbol = '□'
    ) {
        parent::__construct(($checked ? $checkedSymbol : $uncheckedSymbol).' '.$text);
    }

    public function handleKey(Menu $menu, KeyStroke $key): void
    {
        if (' ' === $key->getRaw()) {
            // space key pressed
            $this->setChecked(!$this->checked);
            $this->triggerToggleCallback();
            $menu->redrawItems($this);
        }
    }

    public function isChecked(): bool
    {
        return $this->checked;
    }

    public function setChecked(bool $checked): static
    {
        if ($checked === $this->checked) {
            return $this;
        }

        $this->text =
            ($checked ? $this->checkedSymbol : $this->uncheckedSymbol).
            substr($this->text, strlen($this->checked ? $this->checkedSymbol : $this->uncheckedSymbol));

        $this->checked = $checked;

        return $this;
    }

    public function onToogle(?callable $callback)
    {
        $this->toggleCallback = $callback;
    }

    protected function triggerToggleCallback()
    {
        if ($this->toggleCallback) {
            ($this->toggleCallback)($this);
        }
    }
}
