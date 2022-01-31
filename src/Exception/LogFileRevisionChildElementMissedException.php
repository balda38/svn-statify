<?php

namespace SvnStatify\Exception;

use Exception;

class LogFileRevisionChildElementMissedException extends Exception
{
    public static function forChild(string $child) : self
    {
        $exception = new self();
        $exception->message = 'Revision entry has no child element "'.$child.'".';

        return $exception;
    }
}
