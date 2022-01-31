<?php

namespace SvnStatify\Exception;

use Exception;

class EmptyLogFileException extends Exception
{
    public function __construct()
    {
        $this->message = 'File with data from svn log is empty.';
    }
}
