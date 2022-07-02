<?php

namespace BGre\TerminalFun\Menu\DataItemDisplay;

use BGre\TerminalFun\Menu\DataItem;

class ArrayData extends Display
{
    use Traits\ValueTags;

    public function __construct(
        protected string $key,
        protected string $prefix = '',
        protected string $suffix = '',
        protected string $joiner = '/',
        protected string $trueString = '☑',
        protected string $falseString = '☐',
        protected bool $valueTags = false,
        protected bool $hideEmptyList = true,
        ?string $tag = null,
        bool $allOrNothing = false,
        int $minWidth = 0
    ) {
        parent::__construct($tag, $allOrNothing, $minWidth);
    }

    public function getMarkup(DataItem $item, int $maxWidth): string
    {
        $values = $this->getValues($item);

        if ($this->hideEmptyList && empty($values)) {
            return '';
        }

        $remain = $maxWidth - mb_strlen($this->prefix) - mb_strlen($this->suffix);

        if ($remain < 0) {
            return '';
        }

        $result = $this->prefix;
        $first = true;
        foreach ($values as $value) {
            if ($remain < mb_strlen($this->joiner)) {
                break;
            }

            if ($first) {
                $first = false;
            } else {
                $result .= $this->joiner;
                $remain -= mb_strlen($this->joiner);
            }

            if ($remain < 1) {
                break;
            }

            $l = mb_strlen($value);

            $shortValue = ($l > $remain) ? mb_substr($value, 0, $remain - 1).'…' : $value;

            $result .= $this->valueTags ? $this->addValueTag($value, htmlspecialchars($shortValue)) : $shortValue;
            $remain -= mb_strlen($shortValue);
        }

        $result .= $this->suffix;

        if (null !== $this->tag) {
            $result = "<{$this->tag}>{$result}</{$this->tag}>";
        }

        return $result;
    }

    protected function getText(DataItem $item): string
    {
        $values = $this->getValues($item);

        if ($this->hideEmptyList && empty($values)) {
            return '';
        }

        return $this->prefix
            .implode($this->joiner, $values)
            .$this->suffix;
    }

    protected function getValues(DataItem $item): array
    {
        return array_map(
            function ($data): string {
                if (is_bool($data)) {
                    return $data ? $this->trueString : $this->falseString;
                }

                return (string) $data;
            },
            $item->getData($this->key)
        );
    }
}
