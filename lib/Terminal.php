<?php

namespace BGre\TerminalFun;

class Terminal
{
    protected static int $width;
    protected static int $height;

    public static function getWidth()
    {
        if (!isset(self::$width)) {
            self::updateDimensions();
        }

        return self::$width;
    }

    public static function getHeight()
    {
        if (!isset(self::$height)) {
            self::updateDimensions();
        }

        return self::$height;
    }

    public static function updateDimensions()
    {
        try {
            self::setWithSttySize();

            return;
        } catch (\Throwable $ignore) {
        }

        try {
            self::setWithSttyA();

            return;
        } catch (\Throwable $ignore) {
        }

        self::$width = 80;
        self::$height = 24;
    }

    private static function setWithSttySize()
    {
        $dimensions = Stty::query('size');
        if (!preg_match('/^(\d+)\s+(\d+)$/', $dimensions, $matches)) {
            throw new \UnexpectedValueException('Result from stty does not match pattern');
        }

        self::$height = (int) $matches[1];
        self::$width = (int) $matches[2];
    }

    private static function setWithSttyA()
    {
        $sttyString = Stty::query('-a');
        if (preg_match('/rows.(\d+);.columns.(\d+);/i', $sttyString, $matches)) {
            // extract [w, h] from "rows h; columns w;"
            self::$width = (int) $matches[2];
            self::$height = (int) $matches[1];
        } elseif (preg_match('/;.(\d+).rows;.(\d+).columns/i', $sttyString, $matches)) {
            // extract [w, h] from "; h rows; w columns"
            self::$width = (int) $matches[2];
            self::$height = (int) $matches[1];
        } else {
            dump($sttyString);
            throw new \UnexpectedValueException('Result from stty does not match pattern');
        }
    }
}
