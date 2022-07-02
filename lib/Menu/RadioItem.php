<?php

namespace BGre\TerminalFun\Menu;

use ArrayObject;
use BGre\TerminalFun\KeyStroke;

class RadioItem extends CheckboxItem
{
    public function __construct(
        string $text,
        protected ArrayObject $group,
        bool $checked = false,
        string $checkedSymbol = '◉',
        string $uncheckedSymbol = '○'
    ) {
        parent::__construct($text, $checked, $checkedSymbol, $uncheckedSymbol);
        $this->group[] = $this;
        if ($checked) {
            $this->uncheckGroup(false);
        }
    }

    public function handleKey(Menu $menu, KeyStroke $key): void
    {
        if (' ' === $key->getRaw() && !$this->checked) {
            // space key pressed and this item is not yet checked
            $changedItems = $this->uncheckGroup(true);
            parent::setChecked(true);
            $this->triggerToggleCallback();
            $menu->redrawItems($this, ...$changedItems);
        }
    }

    public function setChecked(bool $checked): static
    {
        parent::setChecked($checked);

        if ($checked) {
            $this->uncheckGroup(false);
        }

        return $this;
    }

    private function uncheckGroup(bool $triggerCallbacks): array
    {
        $changedItems = [];

        /** @var self $item */
        foreach ($this->group as $item) {
            if ($item->isChecked() && $item !== $this) {
                $item->setChecked(false);
                $changedItems[] = $item;
                if ($item->toggleCallback) {
                    $item->triggerToggleCallback();
                }
            }
        }

        return $changedItems;
    }
}
