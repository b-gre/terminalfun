<?php

namespace Tests\BGre\TerminalFun\Style;

use BGre\TerminalFun\Style\Style;
use PHPUnit\Framework\TestCase;

class StyleTest extends TestCase
{
    public function testSimpleMatch()
    {
        $style = new Style('night');
        self::assertEquals(100, $style->matchPriority('night'));
        self::assertEquals(100, $style->matchPriority('day', 'night'));
        self::assertEquals(0, $style->matchPriority('night', 'day'));
        self::assertEquals(0, $style->matchPriority('lollroll'));
    }

    public function testIndirectChildMatch()
    {
        $style = new Style('night bar');
        self::assertEquals(0, $style->matchPriority('night'));
        self::assertEquals(0, $style->matchPriority('bar'));
        self::assertEquals(200, $style->matchPriority('night', 'bar'));
        self::assertEquals(200, $style->matchPriority('savvy', 'night', 'bar'));
        self::assertEquals(200, $style->matchPriority('night', 'juice', 'bar'));
    }

    public function testDirectChildMatch()
    {
        $style = new Style('night>bar');
        self::assertEquals(0, $style->matchPriority('night'));
        self::assertEquals(0, $style->matchPriority('bar'));
        self::assertEquals(205, $style->matchPriority('night', 'bar'));
        self::assertEquals(205, $style->matchPriority('savvy', 'night', 'bar'));
        self::assertEquals(0, $style->matchPriority('night', 'juice', 'bar'));
    }

    public function testManySpaces()
    {
        $style = new Style('night    bar');
        self::assertEquals(200, $style->matchPriority('night', 'bar'));
        self::assertEquals(200, $style->matchPriority('savvy', 'night', 'bar'));

        $style = new Style('night     > bar');
        self::assertEquals(205, $style->matchPriority('savvy', 'night', 'bar'));
        self::assertEquals(0, $style->matchPriority('night', 'juice', 'bar'));
    }

    public function testStar()
    {
        $style = new Style('foo * bar');
        self::assertEquals(0, $style->matchPriority('foo', 'bar'));
        self::assertEquals(300, $style->matchPriority('foo', 'some', 'bar'));

        $style = new Style('foo bar *');
        self::assertEquals(0, $style->matchPriority('foo', 'bar'));
        self::assertEquals(300, $style->matchPriority('foo', 'bar', 'baz'));
    }
}
