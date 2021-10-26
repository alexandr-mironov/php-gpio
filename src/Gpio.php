<?php

namespace Gpio;

use Gpio\Board\BoardInterface;
use Gpio\Board\SampleBoard;
use Gpio\Pin\InputPin;
use Gpio\Pin\OutputPin;
use Gpio\Pin\PinInterface;

class Gpio
{
    /**
     * @var BoardInterface
     */
    private $board;

    public function __construct(?BoardInterface $board = null)
    {
        if (is_null($board)) {
            $board = new SampleBoard();
        }
        $this->board = $board;
    }

    public function getOutputPin(int $number): PinInterface
    {
        return new OutputPin($this->board, $number);
    }

    public function getInputPin(int $number): PinInterface
    {
        return new InputPin($this->board, $number);
    }

    public function setValue(PinInterface $pin, $value)
    {
        $pin->setValue($value);
    }
}