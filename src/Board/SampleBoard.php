<?php

namespace Gpio\Board;

class SampleBoard implements BoardInterface
{
    public const PATH = '/sys/class/gpio/';
    public const GPIO_PREFIX = 'gpio';

    public function __construct()
    {

    }

    public function getPath(): string
    {
        return self::PATH;
    }

    public function hasPin(int $number): bool
    {
        return true;
    }

    public function getGpioPrefix(): string
    {
        return self::GPIO_PREFIX;
    }
}