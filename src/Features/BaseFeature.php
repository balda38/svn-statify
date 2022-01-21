<?php

namespace SvnStatify\Features;

use SvnStatify\Collection\Revision;

use SplObjectStorage;

abstract class BaseFeature
{
    /**
     * Get name of feature for display in report.
     */
    abstract public static function getName() : string;

    /**
     * Get description of feature for display in `--help`.
     */
    abstract public static function getDescription() : string;

    /**
     * Run analyze on specific revision for feature.
     */
    abstract public function analyzeRevision(Revision $revision) : void;

    /**
     * @todo mixed?
     *
     * @return mixed result of revisions analyzing
     */
    abstract public function getAnalyzeResult();

    /**
     * @param SplObjectStorage<Revision>
     */
    final public function processRevisions(SplObjectStorage $revisions)
    {
        while ($revisions->valid()) {
            yield $revisions->current();

            $revisions->next();
        }
    }
}
