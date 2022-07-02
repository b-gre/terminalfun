<?php

namespace BGre\TerminalFun;

/**
 * Parser for terminfo parametrized strings.
 */
class TerminfoParams
{
    public static function format(string $format, ...$args): string
    {
        $stack = [];
        $vars = [];
        $result = '';

        for ($offset = 0, $max = strlen($format); $offset < $max && false !== $offset;) {
            $p = strpos($format, '%', $offset);

            if (false === $p) {
                $result .= substr($format, $offset);
                break;
            }

            if ($p > $offset) {
                $result .= substr($format, $offset, $p - $offset);
            }

            $offset = $p + 1;

            switch ($format[$offset]) {
                case 'i':
                    if (count($args) > 0) {
                        ++$args[0];
                    }
                    if (count($args) > 1) {
                        ++$args[1];
                    }
                    break;

                case 'p':
                    $offset++;
                    $stack[] = $args[(int) $format[$offset] - 1];
                    break;

                case 'P':
                    $offset++;
                    $vars[$format[$offset]] = array_pop($stack);
                    break;

                case 'g':
                case 'G':
                    $offset++;
                    $stack[] = $vars[$format[$offset]];
                    break;

                case '{':
                    $offset++;
                    $end = strpos($format, '}', $offset);
                    $stack[] = (int) substr($format, $offset, $end - $offset);
                    $offset = $end;
                    break;

                case '\'':
                    $offset++;
                    $end = strpos($format, '\'', $offset);
                    $stack[] = substr($format, $offset, $end - $offset);
                    $offset = $end;
                    break;

                case 'l':
                    $stack[] = strlen(array_pop($stack));
                    break;

                case '+':
                    $y = array_pop($stack);
                    $x = array_pop($stack);
                    $stack[] = $x + $y;
                    break;

                case '-':
                    $y = array_pop($stack);
                    $x = array_pop($stack);
                    $stack[] = $x - $y;
                    break;

                case '*':
                    $y = array_pop($stack);
                    $x = array_pop($stack);
                    $stack[] = $x * $y;
                    break;

                case '/':
                    $y = array_pop($stack);
                    $x = array_pop($stack);
                    $stack[] = $y ? intdiv($x, $y) : 0;
                    break;

                case 'm':
                    $y = array_pop($stack);
                    $x = array_pop($stack);
                    $stack[] = $y ? $x % $y : 0;
                    break;

                case '=':
                    $stack[] = array_pop($stack) == array_pop($stack);
                    break;

                case '>':
                    $y = array_pop($stack);
                    $x = array_pop($stack);
                    $stack[] = $x > $y;
                    break;

                case '<':
                    $y = array_pop($stack);
                    $x = array_pop($stack);
                    $stack[] = $x < $y;
                    break;

                case 'A':
                    $y = array_pop($stack);
                    $x = array_pop($stack);
                    $stack[] = $x && $y;
                    break;

                case 'O':
                    $y = array_pop($stack);
                    $x = array_pop($stack);
                    $stack[] = $x || $y;
                    break;

                case '!':
                    $stack[] = !array_pop($stack);
                    break;

                case '~':
                    $stack[] = ~(int) array_pop($stack);
                    break;

                case '?':
                    break;

                case 't':
                    if (!array_pop($stack)) {
                        self::seekEndIf($format, $offset, true);
                    }
                    break;

                case 'e':
                    self::seekEndIf($format, $offset, false);
                    break;

                default:
                    if (null !== $formatString = self::getFormatString($format, $offset)) {
                        $result .= sprintf('%'.$formatString, array_pop($stack));
                    }
                    break;
            }

            ++$offset;
        }

        return $result;
    }

    protected static function getFormatString(string &$format, int &$offset): ?string
    {
        if (':' === $format[$offset]) {
            ++$offset;
        }

        $start = $offset;

        for ($max = strlen($format); $offset < $max;) {
            $c = $format[$offset];
            if (
                ('0' <= $c && $c <= '9') ||
                ' ' === $c ||
                '-' === $c ||
                '+' === $c ||
                '.' === $c
            ) {
                ++$offset;
            } elseif ('d' === $c || 'o' === $c || 'x' === $c || 'X' === $c || 's' === $c || 'c' === $c) {
                return substr($format, $start, $offset - $start + 1);
            } else {
                break;
            }
        }

        $offset = $start;

        return null;
    }

    protected static function seekEndIf(string $format, int &$offset, bool $stopAtElse)
    {
        $level = 0;

        for ($max = strlen($format); $offset < $max;) {
            $p = strpos($format, '%', $offset);

            if (false === $p) {
                $offset = $max;

                return;
            } else {
                $offset = $p + 1;
            }

            switch ($format[$offset]) {
                case '?':
                    $level++;
                    break;

                case 'e':
                    if ($stopAtElse && 0 === $level) {
                        return;
                    }
                    break;

                case ';':
                    if ($level > 0) {
                        --$level;
                    } else {
                        return;
                    }
            }
        }
    }
}
