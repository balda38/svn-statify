<?php

namespace SvnStatify;

use SvnStatify\Parser\Parser;
use SvnStatify\Parser\ParsedFile;

use SvnStatify\Analyzer\Analyzer;

use Exception;

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
     * @todo Catching any errors/exceptions/warnings/etc. from exec()
     *
     * @return string|false
     */
    private function processSvnLog()
    {
        echo 'Process svn log...'.PHP_EOL;
        $result = exec('svn log --xml --verbose '.$this->path.' > '.ParsedFile::getPath());
        echo 'Process svn log completed!'.PHP_EOL;

        return $result;
    }

    /**
     * Output pretty information about revisions in repository to CLI.
     */
    public function outputSimple() : void
    {
        if ($this->processSvnLog() === false) {
            echo 'Unable to read svn log from repository!'.PHP_EOL;
            exit(1);
        } else {
            try {
                $repository = Parser::run();
            } catch (Exception $e) {
                echo $e->getMessage().PHP_EOL;
                exit(1);
            }

            $analyzeResult = Analyzer::run($repository);

            /**
             * Full information about repository without analyze.
             * Simple way - forget it.
             */
            // $revisions = $repository->getRevisions();
            // while ($revisions->valid()) {
            //     $revision = $revisions->current();

            //     echo 'Number: '.$revision->number.PHP_EOL;
            //     echo 'Author: '.$revision->author.PHP_EOL;
            //     echo 'Date: '.$revision->dateTime->format('Y-m-d H:i:sO').PHP_EOL;
            //     echo 'Message: '.$revision->message.PHP_EOL;

            //     $changes = $revision->getChanges();
            //     echo PHP_EOL.'Changes:'.PHP_EOL;
            //     while ($changes->valid()) {
            //         $change = $changes->current();

            //         echo '* '.$change->getStatus().' '.$change->path.PHP_EOL;

            //         $changes->next();
            //     }
            //     echo '--------------------------------------'.PHP_EOL;

            //     $revisions->next();
            // }

            foreach ($analyzeResult as $featureResult) {
                echo $featureResult->feature.':'.PHP_EOL;
                foreach ($featureResult->getItems() as $resultItem) {
                    echo $resultItem->key.': '.$resultItem->numberOfCommits.PHP_EOL;
                }
                echo '--------------------------------------'.PHP_EOL;
            }
        }
    }
}
