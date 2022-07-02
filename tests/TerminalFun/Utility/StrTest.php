<?php

namespace Tests\BGre\TerminalFun\Utility;

use BGre\TerminalFun\Utility\Str;
use PHPUnit\Framework\TestCase;

class StrTest extends TestCase
{
    public function testTruncate()
    {
        self::assertSame('short', Str::truncateMarkup('short', 10));
        self::assertSame('sh', Str::truncateMarkup('short', 2));
        self::assertSame('so <tag>s</tag>', Str::truncateMarkup('so <tag>short</tag>, yes', 4));
        self::assertSame('<tag>shor</tag>', Str::truncateMarkup('<tag>short</tag>', 4));
    }
}
