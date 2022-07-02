<?php

namespace BGre\TerminalFun\Style;

use BGre\TerminalFun\Style\Effects\Effect;

class Style
{
    protected string $descriptor;
    protected array $descriptorParts;

    /** @var Effect[] */
    protected array $effects;

    public function __construct(
        string $descriptor,
        Effects\Effect ...$effects
    ) {
        $this->descriptorParts = $this->splitDescriptor($descriptor);
        $this->effects = $effects;
    }

    /**
     * @return Effect[]
     */
    public function getEffects(): array
    {
        return $this->effects;
    }

    public function matchPriority(string ...$tagStack)
    {
        $descriptorParts = $this->descriptorParts;

        if (!$this->tagMatch(array_pop($descriptorParts), array_pop($tagStack))) {
            return 0;
        }

        $prio = 100;

        while (!empty($descriptorParts)) {
            $descriptorPart = array_pop($descriptorParts);

            if ('>' === substr($descriptorPart, -1)) {
                if (array_pop($tagStack) !== substr($descriptorPart, 0, -1)) {
                    return 0;
                }
                $prio += 105;
                continue;
            }

            while (!empty($tagStack)) {
                if ($this->tagMatch($descriptorPart, array_pop($tagStack))) {
                    $prio += 100;
                    continue 2;
                }
            }

            return 0;
        }

        return $prio;
    }

    protected function splitDescriptor(string $descriptor): array
    {
        $parts = [];

        for ($offset = 0, $max = strlen($descriptor); $offset < $max;) {
            $pAngle = strpos($descriptor, '>', $offset + 1);
            $pSpace = strpos($descriptor, ' ', $offset + 1);

            if (false === $pAngle && false === $pSpace) {
                $parts[] = str_replace(' ', '', substr($descriptor, $offset));
                break;
            }

            if (
                false !== $pAngle &&
                false !== $pSpace &&
                $pAngle > $pSpace &&
                '' === trim(substr($descriptor, $pSpace, $pAngle - $pSpace), ' ')
            ) {
                $pSpace = false;
            }

            if (false !== $pAngle && false !== $pSpace) {
                $p = min($pSpace, $pAngle + 1);
            } else {
                $p = false !== $pAngle ? ($pAngle + 1) : $pSpace;
            }

            $part = str_replace(' ', '', substr($descriptor, $offset, $p - $offset));
            if ('' !== $part) {
                $parts[] = $part;
            }
            $offset = $p;
        }

        return $parts;
    }

    protected function tagMatch(string $descriptorPart, string $tag): bool
    {
        return '*' === $descriptorPart || $descriptorPart === $tag;
    }
}
