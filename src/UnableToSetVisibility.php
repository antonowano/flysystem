<?php

declare(strict_types=1);

namespace League\Flysystem;

use RuntimeException;

use function rtrim;

class UnableToSetVisibility extends RuntimeException implements FilesystemOperationFailed
{
    /**
     * @var string
     */
    private $location;

    /**
     * @var string
     */
    private $reason;

    public function reason(): string
    {
        return $this->reason;
    }

    public static function atLocation(string $filename, string $extraMessage = '')
    {
        $message = "'Unable to set visibility for file {$filename}. $extraMessage";
        $e = new static(rtrim($message));
        $e->reason = $extraMessage;
        $e->location = $filename;

        return $e;
    }

    public function operation(): string
    {
        return FilesystemOperationFailed::OPERATION_SET_VISIBILITY;
    }

    public function location(): string
    {
        return $this->location;
    }
}