<?php

namespace SvnStatify;

use SvnStatify\Parser\Parser;

class SvnStatify
{
    /**
     * It could mean path to dir in system or URL.
     *
     * @var string
     */
    private $path;

    public function __construct(string $path)
    {
        $this->path = $path;
    }

    /**
     * @return string|false
     */
    private function processSvnLog()
    {
        echo 'Process svn log...'.PHP_EOL;
        $result = exec('svn log --xml --verbose '.$this->path.' > '.Parser::getPathToFileForCollect());
        echo 'Process svn log completed!'.PHP_EOL;

        return $result;
    }

    /**
     * Output pretty information about revisions in repository to CLI.
     *
     * @todo Catching any errors/exceptions/warnings/etc. from exec()
     */
    public function outputSimple() : void
    {
        if ($this->processSvnLog() !== false) {
            $revisions = Parser::run()->getRevisions();

            while ($revisions->valid()) {
                $revision = $revisions->current();

                echo 'Number: '.$revision->number.PHP_EOL;
                echo 'Author: '.$revision->author.PHP_EOL;
                echo 'Date: '.$revision->dateTime->format('Y-m-d H:i:s').'UTC'.PHP_EOL;
                echo 'Message: '.$revision->message.PHP_EOL;

                $changes = $revision->getChanges();
                echo PHP_EOL.'Changes:'.PHP_EOL;
                while ($changes->valid()) {
                    $change = $changes->current();

                    echo '* '.$change->getStatus().' '.$change->path.PHP_EOL;

                    $changes->next();
                }
                echo '--------------------------------------'.PHP_EOL;

                $revisions->next();
            }
        } else {
            /** @todo */
        }
    }
}
