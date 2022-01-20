<?php

namespace SvnStatify;

use SvnStatify\Parser\Parser;

class SvnStatify
{
    /**
     * Path to file, where stored data from `svn log`.
     */
    const COLLECT_TO = __DIR__.'/../generated/output.xml';

    /**
     * @var string
     */
    private $url;

    public function __construct(string $url)
    {
        $this->url = $url;
    }

    /**
     * Output pretty information about revisions in repository to CLI.
     *
     * @todo Catching any errors/exceptions/warnings/etc. from exec()
     */
    public function outputSimple() : void
    {
        // For more details about revisions option `--verbose` needed
        $collectResult = exec('svn log --xml '.$this->url.' > '.self::COLLECT_TO);

        if ($collectResult !== false) {
            Parser::run();
        } else {
            /** @todo */
        }
    }
}
