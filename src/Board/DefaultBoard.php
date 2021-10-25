<?php

namespace Gpio\Board;

class DefaultBoard implements BoardInterface
{
    public const PATH = '/sys/class/gpio/';

    public function __construct()
    {

    }

    public function getPath(): string
    {
        return self::PATH;
    }
}