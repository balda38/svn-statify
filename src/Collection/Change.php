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
    private $status;

    public function setStatus(string $svnStatusSymbol) : void
    {
        $this->status = new Status($svnStatusSymbol);
    }

    public function getStatus() : Status
    {
        return $this->status;
    }
}
