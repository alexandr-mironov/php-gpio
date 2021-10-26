<?php

namespace Gpio\Pin;

use Gpio\Board\BoardInterface;
use Gpio\Exception\GpioException;
use SplFileObject;

abstract class AbstractPin implements PinInterface
{
    public const FILE_DIRECTION = 'direction';
    public const FILE_VALUE = 'value';

    /** @var SplFileObject|null $directionDescriptor  */
    protected $directionDescriptor = null;

    /** @var SplFileObject|null $valueDescriptor */
    protected $valueDescriptor = null;

    /** @var int $number */
    protected $number;

    private $pathPrefix;

    private $targetPath;

    protected $direction;

    protected $value;

    /**
     * @var BoardInterface
     */
    private $board;

    protected function __construct(
        BoardInterface $board,
        string $direction,
        int $number
    ){
        $this->number = $number;
        $this->board = $board;
        $this->direction = $direction;
        $this->pathPrefix = $board->getPath() . $board->getGpioPrefix() . $number;
        if (!file_exists($this->pathPrefix)) {
            $this->export($number);
        }
        $gpioFile = new SplFileObject($this->pathPrefix);
        if (!($this->targetPath = $gpioFile->getLinkTarget())) {
            throw new GpioException('Unable to read file link');
        }
    }

    protected function export(int $number)
    {
        $exportDescriptor = new SplFileObject($this->board->getPath() . 'export');
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

    private function createDescriptor(string $descriptorName)
    {

    }
}