<?php

namespace Gpio\Board;

class OrangePiZero2 extends SampleBoard
{
    public const PIN_MAP = [];

    public function hasPin(int $number): bool
    {
        return array_key_exists($number, self::PIN_MAP);
    }
}