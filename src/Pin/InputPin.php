<?php

namespace Gpio\Pin;

use Gpio\Board\BoardInterface;
use Gpio\Exception\GpioException;

class InputPin extends AbstractPin
{
    /**
     * @param BoardInterface $board
     * @param int $number
     *
     * @throws GpioException
     */
    public function __construct(BoardInterface $board, int $number)
    {
        parent::__construct($board, self::DIRECTION_IN, $number);
    }

    /**
     * @return int
     * @throws GpioException
     */
    public function getValue(): int
    {
        if (!$this->valueDescriptor) {
            throw new GpioException('Input pin value descriptor is empty');
        }
        rewind($this->valueDescriptor);
        return (int)fread($this->valueDescriptor, filesize($this->valueDescriptor));
    }
}