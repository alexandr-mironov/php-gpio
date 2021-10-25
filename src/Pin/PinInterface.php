<?php

namespace Gpio\Pin;

interface PinInterface
{
    public const DIRECTION_OUT = 'out';
    public const DIRECTION_IN = 'in';

    public function export();
}