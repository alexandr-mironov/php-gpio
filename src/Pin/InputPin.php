<?php

namespace Gpio\Pin;

use Gpio\Board\BoardInterface;
use Gpio\Exception\GpioException;

class InputPin extends AbstractPin
{
    public function __construct(BoardInterface $board, int $number)
    {
        parent::__construct($board, self::DIRECTION_IN, $number);
    }

    /**
     * @return false|string
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