<?php

namespace BGre\TerminalFun\Exceptions;

class ParserException extends \UnexpectedValueException
{
    public static function at(int $lineNo, string $message)
    {
        return new self(sprintf('At line %d: %s', $lineNo, $message));
    }

    public static function unexpected(int $lineNo, string $expected, string $actual, ?string $hint = null): self
    {
        $message = sprintf(
            'At line %d: Expected %s, but got %s.',
            $lineNo,
            $expected,
            $actual ? '"'.explode(' ', $actual, 2)[0].'"' : 'nothing'
        );

        if (null !== $hint) {
            $message .= " ({$hint})";
        }

        return new self($message);
    }
}
