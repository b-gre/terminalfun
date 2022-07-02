<?php

namespace BGre\TerminalFun;

final class KeyStroke
{
    private bool $isLetter;
    private static array $terminfoLookup;
    private static array $rawLookup;

    private ?string $specialName = null;

    public function __construct(protected string $raw, ?string $terminfoName)
    {
        $this->isLetter = ord($this->raw[0]) >= 32 && "\x7F" !== $this->raw;

        if (!$this->isLetter) {
            self::$terminfoLookup ??= self::buildTerminfoLookup();
            self::$rawLookup ??= self::buildRawLookup();
            $this->specialName = self::$terminfoLookup[$terminfoName] ?? self::$rawLookup[$this->raw] ?? 'Unknown';
        }
    }

    /**
     * Read a key stroke.
     *
     * To get single key strokes, you need to setup the terminal first.
     * This can be done by Stty::setState('-icanon');
     * To disable echoing of pressed keys, add '-echo' to the stty arguments.
     *
     * @param resource $handle   The stream handle (ususally STDIN)
     * @param Terminfo $terminfo A terminfo instance for the current terminal
     */
    public static function read($handle, Terminfo $terminfo): self
    {
        $stream = STDIN;

        stream_set_blocking($stream, false);

        $read = [$stream];
        $empty = [];

        while (!@stream_select($read, $empty, $empty, null, 0)) {
            $read = [$stream];
        }

        $char = fread($stream, 1);

        if ("\x80" <= $char) {
            // read the rest of the unicode char
            $char .= fread($stream, ["\xC0" => 1, "\xD0" => 1, "\xE0" => 2, "\xF0" => 3][$char & "\xF0"]);
        } elseif ("\x1b" === $char) {
            // when it is an escape squence, just read the remainder of the stream
            $char .= stream_get_contents($stream);
        }

        stream_set_blocking($stream, true);

        return new KeyStroke($char, $terminfo->findString($char));
    }

    public function getRaw(): string
    {
        return $this->raw;
    }

    public function getSpecialName(): ?string
    {
        return $this->specialName;
    }

    public function isBackspace(): bool
    {
        return "\x08" === $this->raw || "\x7F" === $this->raw;
    }

    public function isLetter(): bool
    {
        return $this->isLetter;
    }

    private static function buildTerminfoLookup(): array
    {
        $lookup = [
            'key_backspace' => 'Backspace',
            'tab' => 'Tab',
            'key_tab' => 'Tab',
            'key_btab' => 'Shift+Tab',
            'key_ppage' => 'PgUp',
            'key_npage' => 'PgDown',
        ];

        for ($i = 1; $i <= 12; ++$i) {
            $lookup['key_f'.$i] = 'F'.$i;
            $lookup['key_f'.($i + 12)] = 'Shift+F'.$i;
            $lookup['key_f'.($i + 24)] = 'Ctrl+F'.$i;
            $lookup['key_f'.($i + 36)] = 'Ctrl+Shift+F'.$i;
            $lookup['key_f'.($i + 48)] = 'Alt+F'.$i;
            $lookup['key_f'.($i + 60)] = 'Alt+Shift+F'.$i;
        }

        return $lookup;
    }

    private static function buildRawLookup(): array
    {
        $lookup = [
            "\x7F" => 'Backspace',
            "\e\x7F" => 'Alt+Backspace',
            "\e" => 'Esc',

            "\e[A" => 'Up',
            "\e[B" => 'Down',
            "\e[C" => 'Right',
            "\e[D" => 'Left',

            "\e[1;1A" => 'Alt+Up',
            "\e[1;1B" => 'Alt+Down',
            "\e[1;1C" => 'Alt+Right',
            "\e[1;1D" => 'Alt+Left',

            "\e[1;2A" => 'Shift+Up',
            "\e[1;2B" => 'Shift+Down',
            "\e[1;2C" => 'Shift+Right',
            "\e[1;2D" => 'Shift+Left',

            "\e[1;3A" => 'Alt+Up',
            "\e[1;3B" => 'Alt+Down',
            "\e[1;3C" => 'Alt+Right',
            "\e[1;3D" => 'Alt+Left',

            "\e[1;4A" => 'Alt+Shift+Up',
            "\e[1;4B" => 'Alt+Shift+Down',
            "\e[1;4C" => 'Alt+Shift+Right',
            "\e[1;4D" => 'Alt+Shift+Left',

            "\e[1;5A" => 'Ctrl+Up',
            "\e[1;5B" => 'Ctrl+Down',
            "\e[1;5C" => 'Ctrl+Right',
            "\e[1;5D" => 'Ctrl+Left',

            "\e[1;6A" => 'Ctrl+Shift+Up',
            "\e[1;6B" => 'Ctrl+Shift+Down',
            "\e[1;6C" => 'Ctrl+Shift+Right',
            "\e[1;6D" => 'Ctrl+Shift+Left',

            "\e[1;7A" => 'Ctrl+Alt+Up',
            "\e[1;7B" => 'Ctrl+Alt+Down',
            "\e[1;7C" => 'Ctrl+Alt+Right',
            "\e[1;7D" => 'Ctrl+Alt+Left',

            "\e[1;8A" => 'Ctrl+Alt+Shift+Up',
            "\e[1;8B" => 'Ctrl+Alt+Shift+Down',
            "\e[1;8C" => 'Ctrl+Alt+Shift+Right',
            "\e[1;8D" => 'Ctrl+Alt+Shift+Left',
        ];

        for ($i = 0; $i < 26; ++$i) {
            $lookup[chr($i + 1)] = 'Ctrl+'.chr($i + ord('A'));
            $lookup["\e".chr($i + ord('a'))] = 'Alt+'.chr($i + ord('A'));
            $lookup["\e".chr($i + ord('A'))] = 'Alt+Shift+'.chr($i + ord('A'));
            $lookup["\e".chr($i + 1)] = 'Ctrl+Alt+'.chr($i + ord('A'));
        }

        for ($i = 0; $i < 10; ++$i) {
            $lookup["\e".chr($i + ord('1'))] = 'Alt+'.chr($i + ord('1'));
        }

        $movementKeys = [
            'A' => 'Up',
            'B' => 'Down',
            'C' => 'Right',
            'D' => 'Left',
            'F' => 'End',
            'H' => 'Home',
        ];
        $movementModifiers = [
            '' => '',
            '1;2' => 'Shift+',
            '1;3' => 'Alt+',
            '1;4' => 'Alt+Shift+',
            '1;5' => 'Ctrl+',
            '1;6' => 'Ctrl+Shift+',
            '1;7' => 'Ctrl+Alt+',
            '1;9' => 'Ctrl+Alt+Shift+',
        ];

        foreach ($movementKeys as $char => $keyName) {
            foreach ($movementModifiers as $modifier => $modifierName) {
                $lookup["\e[".$modifier.$char] = $modifierName.$keyName;
            }
        }

        // Some Ctrl+<Letter> combinations are the same as control keys.
        // Overwrite those entries with the more common names
        $lookup["\n"] = 'Return';
        $lookup["\e\n"] = 'Alt+Return';

        return $lookup;
    }
}
