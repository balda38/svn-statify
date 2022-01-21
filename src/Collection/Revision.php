<?php

namespace SvnStatify\Collection;

use SplObjectStorage;

class Revision
{
    /**
     * @var int
     */
    public $number;
    /**
     * @var DateTime
     */
    public $dateTime;
    /**
     * @var string
     */
    public $author;
    /**
     * @var string
     */
    public $message;

    /**
     * @var SplObjectStorage<Change>
     */
    private $changes;

    public function __construct()
    {
        $this->changes = new SplObjectStorage();
    }

    public function addChange(Change $change) : void
    {
        $this->changes->attach($change);
    }

    public function getChanges() : SplObjectStorage
    {
        return $this->changes;
    }
}