<?php

namespace Gpio\Board;

class SampleBoard implements BoardInterface
{
    public const PATH = "/sys/class/gpio/";
    public const GPIO_PREFIX = "gpio";

    public function __construct()
    {

    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return self::PATH;
    }

    /**
     * @param int $number
     *
     * @return bool
     */
    public function hasPin(int $number): bool
    {
        return true;
    }

    /**
     * @return string
     */
    public function getGpioPrefix(): string
    {
        return self::GPIO_PREFIX;
    }
}