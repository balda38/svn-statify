<?php

namespace SvnStatify;

use SvnStatify\Parser\Parser;

class SvnStatify
{
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
        $collectResult = exec('svn log --xml '.$this->url.' > '.Parser::getPathToFileForCollect());

        if ($collectResult !== false) {
            Parser::run();
        } else {
            /** @todo */
        }
    }
}
