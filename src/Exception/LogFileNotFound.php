<?php

namespace SvnStatify\Exception;

use Exception;

class LogFileNotFoundException extends Exception
{
    public function __construct()
    {
        $this->message = 'File with data from svn log not found.';
    }
}
