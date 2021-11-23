<?php

namespace Gpio\Pin;

use Gpio\Board\BoardInterface;
use Gpio\Exception\GpioException;

class OutputPin extends AbstractPin
{
    /**
     * @param BoardInterface $board
     * @param int $number
     *
     * @throws GpioException
     */
    public function __construct(BoardInterface $board, int $number)
    {
        parent::__construct($board, self::DIRECTION_OUT, $number);
    }

    /**
     * @param $value
     */
    public function setValue($value)
    {
        fwrite($this->valueDescriptor, $value);
    }
}