<?php

namespace SvnStatify\Exception;

use Exception;

class LogFileRevisionAttributeMissedException extends Exception
{
    public static function forAttribute(string $attribute) : self
    {
        $exception = new self();
        $exception->message = 'Revision entry has no attribute "'.$attribute.'".';

        return $exception;
    }
}
