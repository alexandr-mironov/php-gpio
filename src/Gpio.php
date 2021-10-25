<?php

namespace Gpio;

use Gpio\Board\BoardInterface;
use Gpio\Board\SampleBoard;
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

    }

    public function getInputPin(int $number): PinInterface
    {

    }

    public function setValue(PinInterface $pin, $value)
    {

    }

    public function getPin(int $number, string $mode): PinInterface
    {

    }
}