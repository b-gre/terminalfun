<?php

namespace BGre\TerminalFun\Style;

use BGre\TerminalFun\Color\Color;
use BGre\TerminalFun\Color\ColorPair;
use BGre\TerminalFun\Color\HSV;
use BGre\TerminalFun\Color\RGB;
use BGre\TerminalFun\Exceptions\ParserException;
use BGre\TerminalFun\Style\Effects\Bold;
use BGre\TerminalFun\Style\Effects\Brighter;
use BGre\TerminalFun\Style\Effects\Effect;
use BGre\TerminalFun\Style\Effects\Hue;
use BGre\TerminalFun\Style\Effects\Italic;
use BGre\TerminalFun\Style\Effects\Saturation;
use BGre\TerminalFun\Style\Effects\SetBackground;
use BGre\TerminalFun\Style\Effects\SetForeground;
use BGre\TerminalFun\Style\Effects\SetPair;

final class Sheet
{
    private static $effects = [
        'foreground' => [SetForeground::class, ['color']],
        'background' => [SetBackground::class, ['color']],
        'pair' => [SetPair::class, ['pair']],
        'brighter' => [Brighter::class, ['float/null', 'float/null']],
        'hue' => [Hue::class, ['float/null', 'float/null']],
        'saturation' => [Saturation::class, ['float/null', 'float/null']],
        'italic' => Italic::class,
        'bold' => Bold::class,
    ];

    private static int $currentLine = 0;

    private function __construct(private ?ColorPair $initialPair, private array $styles)
    {
    }

    /**
     * Register an effect.
     *
     * @param class-string|array|callable $instructions
     */
    public static function registerEffect(string $name, $instructions): void
    {
        self::$effects[$name] = $instructions;
    }

    public static function parse(string $stylesheet)
    {
        $line = strtok($stylesheet, "\r\n");

        $styles = [];
        $initialPair = null;
        $currentSelector = null;
        $currentEffects = [];
        self::$currentLine = 0;

        $flushEffects = function () use (&$styles, &$currentEffects, &$currentSelector) {
            if (null !== $currentSelector) { // @phpstan-ignore-line
                foreach (explode(',', $currentSelector) as $part) {
                    $part = trim($part);
                    foreach ($currentEffects as $effect) { // @phpstan-ignore-line
                        $styles[$part][] = $effect;
                    }
                }
            }
            $currentEffects = [];
        };

        while (false !== $line) {
            $line = trim($line);
            ++self::$currentLine;

            if (str_starts_with($line, '- ')) {
                if (null === $currentSelector) {
                    throw new ParserException('Found an effect before the first selector');
                }
                $parts = explode(':', trim(substr($line, 2)), 2);
                $currentEffects[] = self::buildEffect(...$parts);
            }

            if (str_ends_with($line, ':')) {
                $flushEffects();
                $currentSelector = rtrim($line, ': ');
            }

            $line = strtok("\r\n");
        }

        $flushEffects();

        return new self(
            $initialPair,
            array_map(
                fn ($n, $e) => new Style($n, ...$e),
                array_keys($styles),
                $styles
            )
        );
    }

    /** parse a color from the string and remove the parsed color from the string. returns the color. */
    public static function parseColor(string &$s): Color
    {
        self::skipSpaces($s);

        if (str_starts_with($s, 'rgb(')) {
            $s = substr($s, 4);
            $color = new RGB(...self::parseArguments($s, 'float', 'float', 'float'));
            self::skipOver($s, ')');

            return $color;
        }
        if (str_starts_with($s, 'hsv(')) {
            $s = substr($s, 4);
            $color = new HSV(...self::parseArguments($s, 'float', 'float', 'float'));
            self::skipOver($s, ')');

            return $color;
        }

        throw ParserException::unexpected(self::$currentLine, 'a color', $s, 'is there a stray space before the opening "("?');
    }

    public static function parseArguments(string &$s, string ...$types): array
    {
        $arguments = [];

        foreach ($types as $type) {
            $arguments[] = self::parseValue($s, $type);
        }

        return $arguments;
    }

    public static function parseValue(string &$s, string $type)
    {
        self::skipSpaces($s);

        if (str_ends_with($type, '/null')) {
            if (str_starts_with($s, 'null')) {
                $s = substr($s, 4);

                return null;
            }

            $type = substr($type, 0, -5);
        }

        if ('' === $s) {
            throw ParserException::unexpected(self::$currentLine, $type, $s);
        }

        switch ($type) {
            case 'float':
                if ('-' === $s[0]) {
                    $factor = -1;
                    $s = substr($s, 1);
                } else {
                    $factor = 1;
                }

                if ('.' !== $s[0] && !ctype_digit($s[0])) {
                    throw ParserException::unexpected(self::$currentLine, 'a number', $s);
                }
                for ($o = 1, $max = strlen($s); $o < $max && (ctype_digit($s[$o]) || '.' === $s[$o]); ++$o) {
                }
                $value = (float) substr($s, 0, $o);
                $s = substr($s, $o);

                return $value * $factor;

            case 'color':
                return self::parseColor($s);

            case 'pair':
                $c1 = self::parseColor($s);
                self::skipSpaces($s);
                $c2 = self::parseColor($s);

                return new ColorPair($c1, $c2);

            default:
                throw new \InvalidArgumentException("Invalid type: {$type}");
        }
    }

    public static function assertEmpty(string $s, string $expected = 'end of line')
    {
        if ('' !== trim($s, ' ')) {
            throw ParserException::unexpected(self::$currentLine, $expected, $s);
        }
    }

    public static function skipSpaces(string &$s): void
    {
        $s = ltrim($s, ' ');
    }

    public static function skipOver(string &$s, string $expect, bool $firstSkipSpaces = true)
    {
        if ($firstSkipSpaces) {
            self::skipSpaces($s);
        }

        if (!str_starts_with($s, $expect)) {
            throw ParserException::unexpected(self::$currentLine, $expect, $s);
        }

        $s = substr($s, strlen($expect));
    }

    public function applyTo(Formatter $formatter)
    {
        if (null !== $this->initialPair) {
            $formatter->setInitialPair($this->initialPair);
        }

        foreach ($this->styles as $style) {
            $formatter->addStyle($style);
        }
    }

    private static function buildEffect(string $name, ?string $arguments = null): Effect
    {
        if (!array_key_exists($name, self::$effects)) {
            throw ParserException::at(self::$currentLine, "The effect '{$name}' is not known");
        }

        $instructions = self::$effects[$name];

        if (is_callable($instructions)) {
            return $instructions($arguments);
        }

        if (is_string($instructions) && is_a($instructions, Effect::class, true)) {
            return new $instructions();
        }

        if (!is_array($instructions) || 2 !== count($instructions) || !is_a($instructions[0], Effect::class, true)) {
            throw new \UnexpectedValueException("Unclear instructions to build the effect {$name}");
        }

        $arguments = self::parseArguments($arguments, ...$instructions[1]);

        return new $instructions[0](...$arguments);
    }

    private static function assertNotAtEnd(string &$s, int &$o)
    {
        if (strlen($s) <= $o) {
            throw new ParserException('Unexpected end of line');
        }
    }
}
