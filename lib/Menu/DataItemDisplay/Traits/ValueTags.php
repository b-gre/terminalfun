<?php

namespace BGre\TerminalFun\Menu\DataItemDisplay\Traits;

trait ValueTags
{
    protected function addValueTag(string $value, string $display)
    {
        $tag = preg_replace('/[^a-z-]/', '', strtolower($value));

        return '' === $tag ? $display : "<{$tag}>{$display}</{$tag}>";
    }
}
