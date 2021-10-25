<?php

namespace Gpio\Board;

interface BoardInterface
{
    public function getPath(): string;

    public function hasPin(int $number): bool;

    public function getGpioPrefix(): string;
}