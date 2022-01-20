<?php

namespace SvnStatify\Collection;

use SplObjectStorage;

class Repository
{
    /**
     * @var SplObjectStorage<Revision>
     */
    private $revisions;

    public function __construct()
    {
        $this->revisions = new SplObjectStorage();
    }

    public function addRevision(Revision $revision) : void
    {
        $this->revisions->attach($revision);
    }

    public function getRevisions() : SplObjectStorage
    {
        return $this->revisions;
    }
}
