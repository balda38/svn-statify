<?php

namespace SvnStatify\Exception;

use Exception;

class InvalidLogFileException extends Exception
{
    public function __construct()
    {
        $this->message = 'File with data from svn log is invalid.';
    }
}
