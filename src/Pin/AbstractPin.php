<?php

namespace Gpio\Pin;

use Gpio\Board\BoardInterface;
use Gpio\Exception\GpioException;

abstract class AbstractPin implements PinInterface
{
    public const FILE_DIRECTION = 'direction';
    public const FILE_VALUE = 'value';

    private const MODE_MAP = [
        self::DIRECTION_IN => 'r',
        self::DIRECTION_OUT => 'w',
    ];

    /** @var ?resource $directionDescriptor */
    protected $directionDescriptor = null;

    /** @var ?resource $valueDescriptor */
    protected $valueDescriptor = null;

    /** @var int $number */
    protected $number;

    /** @var string */
    private $pathPrefix;

    /** @var string */
    private $targetPath;

    /** @var string */
    protected $direction;

    /**
     * @var BoardInterface
     */
    private $board;

    /**
     * @param BoardInterface $board
     * @param string $direction
     * @param int $number
     *
     * @throws GpioException
     */
    protected function __construct(
        BoardInterface $board,
        string         $direction,
        int            $number
    )
    {
        $this->number = $number;
        $this->board = $board;
        $this->direction = $direction;
        $this->pathPrefix = $board->getPath() . $board->getGpioPrefix() . $number;
        if (!file_exists($this->pathPrefix)) {
            $this->export($number);
        }
        if (is_link($this->pathPrefix)) {
            $this->targetPath = $this->getRealPath();
        }
        if (!array_key_exists($direction, self::MODE_MAP)) {
            throw new GpioException('Unavailable direction provided');
        }

        $directionPath = $this->targetPath . DIRECTORY_SEPARATOR . self::FILE_DIRECTION;

        if (!file_exists($directionPath)) {
            throw new GpioException('Unable to locate direction file');
        }

        $this->directionDescriptor = fopen($directionPath, 'w');
        if (!$this->directionDescriptor) {
            throw new GpioException('Unable to open direction descriptor with path: ' . $directionPath);
        }

        fwrite($this->directionDescriptor, $direction);
        $this->valueDescriptor = fopen($this->targetPath . DIRECTORY_SEPARATOR . self::FILE_VALUE, self::MODE_MAP[$direction]);
    }

    /**
     * @param int $number
     * @throws GpioException
     */
    protected function export(int $number)
    {
        $exportFile = fopen($this->board->getPath() . 'export', 'w');
        if (!fwrite($exportFile, (string)$number)) {
            throw new GpioException('Unable to export GPIO #' . $number);
        }
    }

    /**
     * @param int $number
     * @throws GpioException
     */
    protected function unexport(int $number)
    {
        $exportFile = fopen($this->board->getPath() . 'unexport', 'w');
        if (!fwrite($exportFile, (string)$number)) {
            throw new GpioException('Unable to export GPIO #' . $number);
        }
    }

    /**
     * @return string
     * @throws GpioException
     */
    private function getRealPath(): string
    {
        if (!$this->pathPrefix) {
            throw new GpioException('Invalid path prefix');
        }
        $realPath = realpath($this->pathPrefix);
        if (!$realPath) {
            throw new GpioException('Invalid real path');
        }
        return $realPath;
    }
}