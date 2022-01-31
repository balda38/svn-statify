<?php

namespace SvnStatify\Exception;

use Exception;

class LogFileRevisionPathAttributeMissedException extends Exception
{
    public static function forAttribute(string $attribute) : self
    {
        $exception = new self();
        $exception->message = 'Revision path entry has no attribute "'.$attribute.'".';

        return $exception;
    }
}
