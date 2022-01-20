<?php

namespace SvnStatify\Collection;

class Revision
{
    /**
     * @todo What type used?
     *
     * @var int|string
     */
    public $number;
    /**
     * @todo What type used?
     *
     * @var DateTime|string
     */
    public $dateTime;
    /**
     * @var string
     */
    public $author;
    /**
     * @var string
     */
    public $description;
    /**
     * @var array[Change]
     */
    public $changes;
}