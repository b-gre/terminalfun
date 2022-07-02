<?php

namespace BGre\TerminalFun\Utility;

class Str
{
    public static function truncateMarkup(string $markup, int $length): string
    {
        $pieces = preg_split('/(<[^>]+>)/', $markup, -1, PREG_SPLIT_DELIM_CAPTURE);

        $result = '';
        $remain = $length;

        for ($i = 0; $i < count($pieces); $i += 2) {
            $piecelen = mb_strlen($pieces[$i]);
            if ($remain >= $piecelen) {
                $result .= $pieces[$i];
                $remain -= $piecelen;
            } elseif ($remain > 0) {
                $result .= mb_substr($pieces[$i], 0, $remain);
                $remain = 0;
            }

            if ($i + 1 < count($pieces)) {
                $result .= $pieces[$i + 1];
            }
        }

        return $result;
    }

    public static function fill(string $s, int $desiredLength): string
    {
        if (1 > $desiredLength) {
            return '';
        }

        $repetitions = intdiv($desiredLength, mb_strlen($s));
        $remainder = $desiredLength % mb_strlen($s);

        return ($repetitions > 0 ? str_repeat($s, $repetitions) : '').($remainder > 0 ? mb_substr($s, $remainder) : '');
    }
}
