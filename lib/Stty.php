<?php

namespace BGre\TerminalFun;

/**
 * Wrapper class for stty.
 */
class Stty
{
    private static ?string $savedState = null;

    public static function saveState(bool $allowReplace = false)
    {
        if (null !== self::$savedState && !$allowReplace) {
            return;
        }

        self::$savedState = self::query('-g');
    }

    public static function restoreState()
    {
        if (null !== self::$savedState) {
            self::runStty(self::$savedState);
        }
    }

    public static function setState(string ...$states)
    {
        self::runStty(...$states);
    }

    public static function query(string ...$argument): string
    {
        return rtrim(self::runStty(...$argument), PHP_EOL);
    }

    private static function runStty(string ...$arguments): string
    {
        $descriptorspec = [
            1 => ['pipe', 'w'],
            2 => ['pipe', 'w'],
        ];

        $process = @proc_open(['stty', ...$arguments], $descriptorspec, $pipes, null, null, ['bypass_shell' => true]);

        if (!is_resource($process)) {
            throw new \RuntimeException('Failed to run stty');
        }

        $info = stream_get_contents($pipes[1]);
        $error = stream_get_contents($pipes[2]);
        fclose($pipes[1]);
        fclose($pipes[2]);
        $code = proc_close($process);

        if (0 !== $code) {
            throw new \RuntimeException(sprintf('Failed to run `stty %s`: %s', implode(' ', array_map('escapeshellarg', $arguments)), trim($error)));
        }

        return $info;
    }
}
