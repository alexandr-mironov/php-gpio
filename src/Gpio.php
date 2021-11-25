<?php

namespace Gpio;

use Gpio\Board\BoardInterface;
use Gpio\Board\SampleBoard;
use Gpio\Pin\InputPin;
use Gpio\Pin\OutputPin;

class Gpio
{
    /**
     * @var BoardInterface
     */
    private $board;

    /**
     * @param BoardInterface|null $board
     */
    public function __construct(?BoardInterface $board = null)
    {
        $this->board = $board ?? new SampleBoard();
    }

    /**
     * @param int $number
     *
     * @return OutputPin
     * @throws Exception\GpioException
     */
    public function getOutputPin(int $number): OutputPin
    {
        return new OutputPin($this->board, $number);
    }

    /**
     * @param int $number
     *
     * @return InputPin
     * @throws Exception\GpioException
     */
    public function getInputPin(int $number): InputPin
    {
        return new InputPin($this->board, $number);
    }

    /**
     * @param OutputPin $pin
     * @param $value
     */
    public function setValue(OutputPin $pin, $value)
    {
        $pin->setValue($value);
    }
}