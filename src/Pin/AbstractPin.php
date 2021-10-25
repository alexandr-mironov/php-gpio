<?php

namespace Gpio\Pin;

use Gpio\Board\BoardInterface;
use SplFileObject;

abstract class AbstractPin implements PinInterface
{
    /** @var SplFileObject|null $directionDescriptor  */
    protected $directionDescriptor = null;

    /** @var SplFileObject|null $valueDescriptor */
    protected $valueDescriptor = null;

    /** @var int $number */
    protected $number;

    private $pathPrefix;

    public function __construct(
        BoardInterface $board,
        int $number
    ){
        $this->number = $number;
        $this->pathPrefix = $board->getPath() . $board->getGpioPrefix() . $number;
        if (!file_exists($this->pathPrefix)) {
            $this->export($number);
        }

    }

    protected function export(int $number)
    {
        $exportDescriptor = new SplFileObject($board->getPath() . 'export');
        if ($exportDescriptor->fwrite((string)$number)) {

        }
    }

    protected function unexport(int $number)
    {

    }

    public function setValue($value)
    {
        $this->valueDescriptor->fwrite($value);
    }

    private function hasDescriptor(string $descriptorName): bool
    {

    }

    private function createDescriptor()
    {

    }
}