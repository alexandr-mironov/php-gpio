<?php

namespace Gpio\Pin;

use Gpio\Board\BoardInterface;
use Gpio\Exception\GpioException;
use SplFileObject;

abstract class AbstractPin implements PinInterface
{
    public const FILE_DIRECTION = 'direction';
    public const FILE_VALUE = 'value';

    private const MODE_MAP = [
        self::DIRECTION_IN => 'r',
        self::DIRECTION_OUT => 'w',
    ];

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
        if (!array_key_exists($direction, self::MODE_MAP)) {
            throw new GpioException('Unavailable direction provided');
        }
        $this->directionDescriptor = new SplFileObject($this->targetPath . DIRECTORY_SEPARATOR . self::FILE_DIRECTION, 'w');
        $this->directionDescriptor->fwrite($direction);
        $this->valueDescriptor = new SplFileObject($this->targetPath . DIRECTORY_SEPARATOR . self::FILE_VALUE, self::MODE_MAP[$direction]);
    }

    protected function export(int $number)
    {
        $exportFile = new SplFileObject($this->board->getPath() . 'export', 'w');
        if (!$exportFile->fwrite((string)$number)) {
            throw new GpioException('Unable to export GPIO #' . $number);
        }
    }

    protected function unexport(int $number)
    {
        $exportFile = new SplFileObject($this->board->getPath() . 'unexport', 'w');
        if (!$exportFile->fwrite((string)$number)) {
            throw new GpioException('Unable to export GPIO #' . $number);
        }
    }
}