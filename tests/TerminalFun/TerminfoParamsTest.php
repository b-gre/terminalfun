<?php

namespace Tests\TerminalFun;

use BGre\TerminalFun\TerminfoParams;
use PHPUnit\Framework\TestCase;

class TerminfoParamsTest extends TestCase
{
    /**
     * @dataProvider operatorsProvider
     */
    public function testOperators(string $format, string $expect)
    {
        self::assertSame($expect, TerminfoParams::format($format, 7, 2));
    }

    public function operatorsProvider(): array
    {
        return [
            '+' => ['>%p1%p2%+%d<', '>9<'],
            '-' => ['>%p1%p2%-%d<', '>5<'],
            '*' => ['>%p1%p2%*%d<', '>14<'],
            '/' => ['>%p1%p2%/%d<', '>3<'],
            '%' => ['>%p1%p2%m%d<', '>1<'],
            '>' => ['>%p1%p2%>%d<', '>1<'],
            '<' => ['>%p1%p2%<%d<', '>0<'],
            '=(1)' => ['>%p1%p2%=%d<', '>0<'],
            '=(2)' => ['>%p1%p1%=%d<', '>1<'],
        ];
    }

    public function testIf()
    {
        self::assertSame('>foo1<', TerminfoParams::format('>%?%p1%p2%<%tfoo%p1%d%;<', 1, 2));
        self::assertSame('><', TerminfoParams::format('>%?%p1%p2%>%tfoo%p1%d%;<', 1, 2));
    }

    public function testIfElse()
    {
        $format = '>%?%p1%{2}%<%tA%e%p1%{4}%<%tB%eC%;<';
        self::assertSame('>A<', TerminfoParams::format($format, 1));
        self::assertSame('>B<', TerminfoParams::format($format, 3));
        self::assertSame('>C<', TerminfoParams::format($format, 6));
    }

    public function testNestedIf()
    {
        $format = '>%?%p1%{4}%<%t%?%p1%{2}%<%tA%eB%;%eC%;<';
        self::assertSame('>A<', TerminfoParams::format($format, 1));
        self::assertSame('>B<', TerminfoParams::format($format, 3));
        self::assertSame('>C<', TerminfoParams::format($format, 6));

        $format = '>%?%p1%{2}%<%tA%e%?%p1%{4}%<%!%tC%eB%;%;<';
        self::assertSame('>A<', TerminfoParams::format($format, 1));
        self::assertSame('>B<', TerminfoParams::format($format, 3));
        self::assertSame('>C<', TerminfoParams::format($format, 6));
    }
}
