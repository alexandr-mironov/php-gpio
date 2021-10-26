<?php

namespace Gpio\Pin;

use Gpio\Board\BoardInterface;

class OutputPin extends AbstractPin
{
    public function __construct(BoardInterface $board, int $number)
    {
        parent::__construct($board, self::DIRECTION_OUT, $number);
    }
}