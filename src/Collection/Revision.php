<?php

namespace SvnStatify\Collection;

class Revision
{
    /**
     * @var int
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
    public $message;
    /**
     * @var array[Change]
     */
    public $changes;
}