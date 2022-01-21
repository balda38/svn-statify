<?php

namespace SvnStatify\Collection;

class Status
{
    const ADDED = 'A';
    const MODIFIED = 'M';
    const DELETED = 'D';

    /**
     * @var string
     */
    private $svnStatusSymbol;

    public function __construct(string $svnStatusSymbol)
    {
        $this->svnStatusSymbol = $svnStatusSymbol;
    }

    public function __toString()
    {
        return $this->represent();
    }

    public function represent() : string
    {
        $list = self::list();

        return array_key_exists($this->svnStatusSymbol, $list)
            ? $list[$this->svnStatusSymbol]
            : 'Unknown'
        ;
    }

    /**
     * Return titles of statuses.
     */
    public static function list() : array
    {
        return [
            self::ADDED => 'Added',
            self::MODIFIED => 'Modified',
            self::DELETED => 'Deleted',
        ];
    }
}
