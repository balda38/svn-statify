<?php

namespace SvnStatify\Collection;

class Change
{
    /**
     * @var string path to file or dir was changed.
     */
    public $path;
    /**
     * @var Status
     */
    public $status;
}
